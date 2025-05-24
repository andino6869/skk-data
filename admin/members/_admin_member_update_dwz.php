<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Synchronisiere DWZ / ELO - Zahlen");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>

<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// 1.) Das Verbindungsobjekt ermitteln:
	$objDBCon = GetCon();

	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon, "FALSE");

	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("../_admin_param_ux.php");

	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "A")==0)
	{
		// Keine Gültigkeit mehr!
		include("../../includes/forms/middler.php");
		include("../forms/navigation_access_denied.php");
		include("../../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("../_admin_param_dx.php");

	echo "<SPAN CLASS=he1>Synchronisiere DWZ / ELO - Zahlen des deutschen Schachbunds mit der Mitgliederliste des SKK (MEMBER - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ###################################
	// ELO / DWZ - Zahlen synchronisieren:
	// Hierzu prüfen, ob die Liste des deutschen Schachbunds verfügbar ist:
	$bAvailable = "FALSE";
	$timeout = 10; //timeout in sekunden
	$strUrl = "schachbund.de";

	if(@fsockopen($strUrl, "80", $errno, $errstr, $timeout))
	{
		$bAvailable = "TRUE";
	}
	else
	{
		$bAvailable = "FALSE";
	}

	// Gibt es etwas zu tun?
	if ($bAvailable=="TRUE")
	{
		// ###############################################
		// Die alte Datei wieder löschen, falls vorhanden:
		if (is_file("/var/www/skk/htdocs/tmp/memberdwzelolist.htm"))
		{
			unlink ("/var/www/skk/htdocs/tmp/memberdwzelolist.htm");
		}

		// #########################
		// UPDATE 30.04.2014:
		// Der Link hat sich geändert:
		//$f="http://www.schachbund.de/dwz/db/verein-prn.html?zps=27113";
		$f="http://www.schachbund.de/verein.html?zps=27113";

		// ##########################################################
		// Den aktuelle Stand lokal in das DWZ - Verzeichnis sichern:
		$strContent = implode("", file("http://www.schachbund.de/verein.html?zps=27113&template=/template/drucker.tpl"));

		$f1 = fopen("/var/www/skk/htdocs/tmp/memberdwzelolist.htm", "w");
		fputs($f1, $strContent);
		fclose($f1);

		// ###########################################
		// Inhalt aus der Datei in ein Array einlesen:
		$f1 ="/var/www/skk/htdocs/tmp/memberdwzelolist.htm";
		$file=file ($f);

		// #######################################################################
		// Bei dem neuen Format des Schachbunds gibt es keine Zeilenumbrüche mehr.
		// Daher muss die Aufbereitung des Inhalts anders als bisher erfolgen!
		// Den ganzen Inhalt einlesen:
		$strLine = $file[0];

		// Die Position der Rangliste ermitteln:
		$intStartPos = strpos($strLine, "Rangliste");
		$strLine = substr($strLine, $intStartPos);

		// Das Ende der Tabelle ermitteln:
		$intEndPos = strpos($strLine, "Abfrage");
		$strLine = substr($strLine, 1, ($intEndPos-1));

		// Der gesamte verwertbare Dateiinhalt steht nun in strLine!
		// #########################################################

		$strSQL = "";

		// Die Feldinhalte:
		$firstname = "";
		$lastname = "";
		$dwz = "";
		$elo = "";
		$title = "";

		// ########################
		// Die Tabellenüberschrift:
		echo "Aktualisiere Mitgliedsdaten des Schachklub Kriegshaber:<BR><BR>".chr(13).chr(10);
		echo "<TABLE BORDER='1' width='100%'>".chr(13).chr(10);
		echo "<tr>".chr(13).chr(10);
		echo "<td width='30%' bgcolor='#C0C0C0'>Nachname:</td>".chr(13).chr(10);
    	echo "<td width='30%' bgcolor='#C0C0C0'>Vorname:</td>".chr(13).chr(10);

		echo "<td width='13%' bgcolor='#C0C0C0'>DWZ alt:</td>".chr(13).chr(10);
    	echo "<td width='13%' bgcolor='#C0C0C0'>ELO alt:</td>".chr(13).chr(10);
		echo "<td width='13%' bgcolor='#C0C0C0'>Datum alt:</td>".chr(13).chr(10);

	    echo "<td width='13%' bgcolor='#C0C0C0'>DWZ neu:</td>".chr(13).chr(10);
    	echo "<td width='13%' bgcolor='#C0C0C0'>ELO neu:</td>".chr(13).chr(10);
	    echo "<td width='13%' bgcolor='#C0C0C0'>Titel:</td>".chr(13).chr(10);
		echo "</tr>".chr(13).chr(10);


		// ############################################
		// Jetzt alle Inhalte durchgehen:
		$ArrOfMembers = explode("<tr class", $strLine);
		$count = count($ArrOfMembers);

		// Beim 2. Wert anfangen, da im ersten die Kopfzeile steht!
		for ($intI = 1; $intI < $count; $intI++) 
		{
			// ############################
			// Die Bestandteilte ermitteln:
			// Die Sonderzeichen korrekt ersetzen:
			// HTML:
			$ArrOfMembers[$intI]= str_replace(chr(10), " ", $ArrOfMembers[$intI]);
			$ArrOfMembers[$intI]= str_replace(chr(13), " ", $ArrOfMembers[$intI]);
			$ArrOfMembers[$intI]= str_replace("&ouml;", "ö", $ArrOfMembers[$intI]);
			$ArrOfMembers[$intI]= str_replace("&nbsp;", " ", $ArrOfMembers[$intI]);
			$ArrOfMembers[$intI]= str_replace("&auml;", "ä", $ArrOfMembers[$intI]);
			$ArrOfMembers[$intI]= str_replace("&uuml;", "ü", $ArrOfMembers[$intI]);
			$ArrOfMembers[$intI]= str_replace("&Ouml;", "Ö", $ArrOfMembers[$intI]);
			$ArrOfMembers[$intI]= str_replace("&Auml;", "Ä", $ArrOfMembers[$intI]);
			$ArrOfMembers[$intI]= str_replace("&Uuml;", "Ü", $ArrOfMembers[$intI]);
			$ArrOfMembers[$intI]= str_replace("&szlig;", "ß", $ArrOfMembers[$intI]);

			// Unicode:
			$ArrOfMembers[$intI]= str_replace("Ã¶", "ö", $ArrOfMembers[$intI]);
			$ArrOfMembers[$intI]= str_replace("Ã¼", "ü", $ArrOfMembers[$intI]);
			$ArrOfMembers[$intI]= str_replace("ÃŸ", "ß", $ArrOfMembers[$intI]);
			$ArrOfMembers[$intI]= str_replace("Ã¤", "ä", $ArrOfMembers[$intI]);
			$ArrOfMembers[$intI]= str_replace("Ã–", "Ö", $ArrOfMembers[$intI]);

			$ArrOfMembersItems = explode("<td", $ArrOfMembers[$intI]);

			// Der Dateiaufbau lautet:
			// <tr class="dwz_tabzeile">
			// <td>1.</td>
			// <td><a href="spieler.html?zps=27113-0121">0121</a></td>
			// <td></td>
			// <td class="align-left nowrap"><a href="spieler.html?pkz=10246649">Wolfsteiner,Helmut</a></td>
			// <td>&nbsp;</td>
			// <td>14/2014</td>
			// <td class="nowrap">2372 -&nbsp;&nbsp;85</td>
			// <td>2369</td>
			// <td>FM</td>
			// </tr>

			// ##########################
			// Vor- und Nachname:
			$lastname = $ArrOfMembersItems[4];
			$intPos = strpos($lastname , "<a href");
			$lastname = substr($lastname, $intPos);

			$lastname = str_replace("</a>", "", $lastname);
			$lastname = str_replace("</td>", "", $lastname);
			
			$intPos = strpos($lastname , ">");
			$lastname = substr($lastname, $intPos);
			$lastname = str_replace(">", "", $lastname);
		
			// Jetzt sollten wir Nachnamen, Vorname haben:
			$ArrOfNames = explode(",", $lastname);
			$lastname = $ArrOfNames[0];

			// Der Vorname:
			$countNames = count($ArrOfNames);

			$firstname = "";

			for ($intJ = 1; $intJ < $countNames; $intJ++)
			{	
				$firstname = $firstname.$ArrOfNames[$intJ];

				if ($intJ < ($countNames - 1))
				{
					$firstname = $firstname.",";
				}
			}


			// ####
			// DWZ:
			$dwz = $ArrOfMembersItems[7];

			$dwz = str_replace("</td>", "", $dwz);
			$intPos = strpos($dwz, ">");
			$dwz = substr($dwz, $intPos);
			$dwz = str_replace(">", "", $dwz);
			$ArrOfNames = explode(" ", $dwz);
			$dwz = $ArrOfNames[0];


			if (strlen(trim($dwz)) == 0)
			{
				$dwz = "NULL";
			}

			// ####
			// ELO:
			$elo = $ArrOfMembersItems[8];
			$elo = str_replace("</td>", "", $elo);
			$elo = str_replace(">", "", $elo);
			
			if (strlen(trim($elo)) == 0)
			{
				$elo = "NULL";
			}

			// ######
			// Titel:
			$title = $ArrOfMembersItems[9];
			$title = str_replace("</td>", "", $title);
			$title = str_replace(">", "", $title);
			$title = str_replace("</tr", "", $title);
			$title = trim($title);


			if (strlen(trim($title)) == 0)
			{
				$title = "NULL";
			}
			else
			{
				$title = "'".$title."'";
			}

			// ###################################################
			// Nun prüfen, ob ein Update durchgeführt werden kann:
			// SQL - Anweisung ausführen, falls möglich:
			if (!($lastname == "") && !($dwz == "NULL"))
			{
				// Die alten Daten aus der Tabelle holen:
				$strSQL = "select * from skk_members WHERE name='".$lastname."' AND ";
				$strSQL = $strSQL."vorname='".$firstname."' AND del='N' AND modifieddate IS NULL;";

				$rs = mysqli_query($objDBCon, $strSQL);
				$RecordCount = mysqli_num_rows($rs);

				if ($RecordCount > 0)
				{
					$j = 0;
			
					while ($row = $rs->fetch_object())
					{
						$OLD_DWZ[$j] = $row->dwz;
					    $OLD_ELO[$j] = $row->elo;
						$OLD_CREATEDATE[$j] =$row->createdate;
						$j++;
					}
				}

				// Die Daten aktualisieren:
				$now = date("Y-m-d H:i:s");

				$strSQL = "UPDATE skk_members SET dwz='$dwz', elo='$elo', title=$title, createdate='".$now."' WHERE ";
				$strSQL = $strSQL."name='$lastname' AND vorname='$firstname' AND del='N' AND modifieddate IS NULL;";

				if (!mysqli_query ($objDBCon, $strSQL))
				{
					echo("Database update error: $strSQL<P>");
					echo mysql_error($objDBCon);

					include("../../includes/forms/middler.php");
					include("../forms/navigation.php");
					include("../../includes/forms/footer.php");
					exit;
				}

				// Den Erfolg festhalten:
				echo "<tr>".chr(13).chr(10);
			    echo "<td width='15%'>".$lastname."</td>".chr(13).chr(10);
			    echo "<td width='15%'>".$firstname."</td>".chr(13).chr(10);

				echo "<td width='10%'>".$OLD_DWZ[0]."</td>".chr(13).chr(10);
			    echo "<td width='10%'>".$OLD_ELO[0]."</td>".chr(13).chr(10);
				echo "<td width='20%'>".$OLD_CREATEDATE[0]."</td>".chr(13).chr(10);

			    echo "<td width='10%'>$dwz</td>".chr(13).chr(10);
			    echo "<td width='10%'>$elo</td>".chr(13).chr(10);

			    if ($title=="NULL")
		    	{
		    		echo "<td width='10%'>&nbsp;</td>".chr(13).chr(10);
			    }
			    else
			    {
			    	echo "<td width='10%'>$title</td>".chr(13).chr(10);
			    }
				echo "</tr>".chr(13).chr(10);

				// Die Feldinhalte wieder zurücksetzen:
				$firstname = "";
				$lastname = "";
				$elo = "";
				$title = "";
				$dwz = "";
			}	

		}

		echo "</TABLE><BR><BR>".chr(13).chr(10);
		echo "Die Mitgliedsdaten wurden erfolgreich synchronisiert.".chr(13).chr(10);
	}
	else
	{
		echo "<font color='#FF0000' size=4><BR><b>Fehler beim Synchronisieren</b><BR><BR></font>".chr(13).chr(10);
		echo "<b>Die Seite des deutschen Schachbundes ist derzeit nicht verf&uuml;gbar. Die Inhalte k&ouml;nnen daher nicht aktualisiert werden.</b><BR><BR>".chr(13).chr(10);
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>