<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Administrations- und Redaktionssystem - Index");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>

<?php
	// 1.) Datenbankverbindung aufbauen:
	$con = GetCon();

	// In Abh&auml;ngigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $con, "FALSE");

	echo "<SPAN CLASS=he1>Administrations- und Redaktionssystem</SPAN><BR><BR>".chr(13).chr(10);

	// ############################
	// Die Benutzerdaten ermitteln:
	// Der Nachname:
	if (!(isset($ulx)))
	{
		$ulx = "";
	}
	
	if (trim($ulx)=="")
	{
		$ulx = $_POST["ulx"];
	}

	if (trim($ulx)=="")
	{
		$ulx = $_GET["ulx"];
	}

	// ############
	// Der Vorname:
	if (!(isset($ufx)))
	{
		$ufx = "";
	}

	if (trim($ufx)=="")
	{
		$ufx = $_POST["ufx"];
	}

	if (trim($ufx)=="")
	{
		$ufx = $_GET["ufx"];
	}

	// Wird ux gebraucht?
	if (trim($ulx)=="")
	{
		$ux = $_POST["ux"];

		if (trim($ux)=="")
		{
			$ux = $_POST["ux"];
		}

		if (trim($ux)=="")
		{
			$ux = $_GET["ux"];
		}

		if (trim($ux)!="")
		{
			// Daten aus der Tabelle holen:
			$id = base64_decode($ux);
			$id = strrev($id);

			$strSQL = "SELECT name, vorname FROM skk_members WHERE lastlogin IS NOT NULL AND del='N' ";
			$strSQL = $strSQL."AND active!='N' AND id=$id AND modifieddate IS NULL AND ip IS NOT NULL;";

			$result = mysql_query($strSQL);
			$num = mysql_numrows($result);

			if ($num > 0)
			{
		   		$nrak = $num - 1;
		   		$ulx = mysql_result($result,$nrak,"name");
		   		$ufx = mysql_result($result,$nrak,"vorname");
			}
		}
	}

	// ##############################################
	// 2.) Prüfen, ob die aktuelle IP - Adresse angemeldet ist:
	if (trim($ulx)=="")
	{
		$ip = $_SERVER['REMOTE_ADDR'];

		// Sonderfall AOL:
		if (trim($ip)=="")
		{
			$ip = "NO_IP_HEADER";
		}

		$strSQL = "SELECT * FROM skk_members WHERE lastlogin IS NOT NULL AND del='N' AND active!='N' ";
		$strSQL = $strSQL."AND modifieddate IS NULL AND ip='".$ip."';";
	}

	else
	{
		$strSQL = "SELECT * FROM skk_members WHERE lastlogin IS NOT NULL AND del='N' AND active!='N' ";
		$strSQL = $strSQL."AND modifieddate IS NULL AND name='".$ulx."' AND vorname='".$ufx."';";
	}

	// ############################
	// Ist der Benutzer angemeldet?
	if (bCheckRecordset($con, $strSQL)==0)
	{
		// Datensatz konnte nicht gefunden werden!
		// Damit wurde unter der aktuellen IP - Adresse noch kein Login
		// vorgenommen!

		// 2.) Prüfen, ob ein gültiger Login vorliegt:
		// Die Daten ermitteln:
		$px = $_POST["px"];

		if (trim($px)=="")
		{
			$px = $_REQUEST["px"];
		}

		// Passwort kodieren (Reihenfolge wird umgekehrt und BASE64 - kodiert):
		$px = strrev($px);
		$px = base64_encode($px);

		$strMessage = "";

		// Ungültige Zeichen entfernen:
		$ulx=mysql_escape_string($ulx);
		$ufx=mysql_escape_string($ufx);
		$px=mysql_escape_string($px);

		// #########################
		// 2.1.) Fehlen Namensdaten:
		if (trim($ulx)=='' OR trim($ufx)=='')
		{
			// Der Anwender hat keine vollständigen Daten hinterlegt!
			echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
			echo "<TR><TD>".chr(13).chr(10);

			// #########################
			// Icon für Fehler ausgeben:
			include("_admin_get_image.php");

			echo "</TD><TD>Die Zugangsdaten sind leider falsch!<BR>".chr(13).chr(10);
			echo "Sie haben keinen Vor-/Nachnamen eingegeben.</TD></TABLE><BR>".chr(13).chr(10);
			echo "<a href='javascript:history.back()'><IMG SRC='../pics/admin/arrow.gif' border=0> Zur&uuml;ck zum Anmeldefenster.</a>".chr(13).chr(10);
			include("../includes/forms/middler.php");
			include("forms/navigation_access_denied.php");
			include("../includes/forms/footer.php");

			// Abbruch!
			exit;
		}

		// #############################################
		// 2.2.) Die Sicherheitseinstellungen abfragen:
		// 2.2.1.) Max. zulässigen Zeitstempel prüfen:
		$tx = $_POST["tx"];

		if (trim($tx)=="")
		{
			$tx = $_GET["tx"];
		}

		$tx = base64_decode($tx);
		$tx = strrev($tx);
		$now = date("Y-m-d H:i:s");

		if ($now > $tx)
		{
			// Zeitstempel ist abgelaufen!!!!!
			echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
			echo "<TR><TD>".chr(13).chr(10);

			// #########################
			// Icon für Fehler ausgeben:
			include("_admin_get_image.php");

			echo "</TD><TD>Die Zugangsdaten sind leider falsch!<BR>".chr(13).chr(10);
			echo "Der Zeitstempel f&uuml;r das Login ist abgelaufen. Bitte laden Sie die Seite f&uuml;r das Login erneut vom Server.</TD></TABLE><BR>".chr(13).chr(10);
			echo "<a href='_admin.php'>";

			$currentImage = "arrow.gif";
			include("_admin_get_image.php");
			
			echo "Zur&uuml;ck zum Anmeldefenster.</a>".chr(13).chr(10);
			include("../includes/forms/middler.php");
			include("forms/navigation_access_denied.php");
			include("../includes/forms/footer.php");

			// Abbruch!
			exit;
		}

		// ############################################
		// 2.2.2.) Prüfe IP - Adresse:
		$ix = $_POST["ix"];

		if (trim($ix)=="")
		{
			$ix = $_GET["ix"];
		}

		if (trim($ix)=="")
		{
			$ix = $_REQUEST["ix"];
		}

		$ix = base64_decode($ix);
		$ix = strrev($ix);

		// Die IP - Adresse ermitteln:
		$ip = $_SERVER['REMOTE_ADDR'];

		// Sonderfall AOL:
		if (trim($ip)=="")
		{
			$ip = "NO_IP_HEADER";
		}

		if ($ix != $ip)
		{
			// Zeitstempel ist abgelaufen!!!!!
			echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
			echo "<TR><TD>".chr(13).chr(10);

			// #########################
			// Icon für Fehler ausgeben:
			include("_admin_get_image.php");

			echo "</TD><TD>Die Zugangsdaten sind leider falsch!<BR>".chr(13).chr(10);
			echo "Die IP - Adresse f&uuml;r das Login ist ung&uuml;ltig. Bitte laden Sie die Seite f&uuml;r das Login erneut vom Server.</TD></TABLE><BR>".chr(13).chr(10);
			echo "<a href='javascript:history.back()'><IMG SRC='../pics/admin/arrow.gif' border=0> Zur&uuml;ck zum Anmeldefenster.</a>".chr(13).chr(10);
			include("../includes/forms/middler.php");
			include("forms/navigation_access_denied.php");
			include("../includes/forms/footer.php");

			// Abbruch!
			exit;
		}

		// ###############################################
		// 2.3.) Gibt es diesen Benutzer in der Datenbank?
		$strSQL = "SELECT * FROM skk_members WHERE name='$ulx' AND vorname='$ufx' ";
		$strSQL = $strSQL."AND PWD='$px' AND active!='N' AND del='N' AND PWD!='start123' AND ";
		$strSQL = $strSQL."PWD IS NOT NULL AND PWD !='' AND modifieddate IS NULL;";

		if (bCheckRecordset($con, $strSQL)==1)
		{
			$result = mysql_query($strSQL);
			$num = mysql_numrows($result);

			// ##############################################
			// Die ID des Benutzers speichern und umkodieren:
			$ux = mysql_result($result,0,"id");
			$ux = strrev($ux);
			$ux = base64_encode($ux);

			// Es erfolgte ein neuer zulässiger Login mit Passwort.
			// Login festhalten:
			$now = date("Y-m-d H:i:s");

			$strSQL = "UPDATE skk_members SET lastlogin = '$now', ip='".$ip."' WHERE ";
			$strSQL = $strSQL."name='$ulx' AND vorname='$ufx' AND PWD='$px' AND ";
			$strSQL = $strSQL."active!='N' AND modifieddate IS NULL AND del='N'";

			// Info in Datenbank festhalten:
			if (!mysql_query ($strSQL, $con))
			{
				// Es gab ein Problem beim Speichern der Session in der Datenbank!
				echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
				echo "<TR><TD>".chr(13).chr(10);

				// #########################
				// Icon für Fehler ausgeben:
				include("_admin_get_image.php");

				echo "</TD><TD>$strSQL.<BR>".chr(13).chr(10);
				echo mysql_error()."<BR>".chr(13).chr(10);
				echo "Aufgrund des aufgetretenen Problems kann Ihnen kein Zugriff auf die Adminseite gew&auml;hrt werden!</TD></TABLE><BR>".chr(13).chr(10);

				include("../includes/forms/middler.php");
				include("forms/navigation_access_denied.php");
				include("../includes/forms/footer.php");

				exit;
			}
			else
			{
				// Session konnte erfolgreich gespeichert werden!
				echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
				echo "<TR><TD>".chr(13).chr(10);

				// #########################
				// Icon für Erfolg ausgeben:
				$currentImage = "success.gif";
				include("_admin_get_image.php");

				echo "</TD><TD>Hallo $ufx $ulx, herzlich willkommen im Admin-Bereich des Schachklub Kriegshabers.<BR>".chr(13).chr(10);
				echo "Ihr aktueller Login f&uuml;r den Adminbereich fand am <B>".chr(13).chr(10);

				// 2008-11-26 20:44:46
				if (isset($lastlogin[0]))
				{
					if (trim($lastlogin[0])=="")
					{
						$curDate = date("Y-m-d H:i:s");
					}
					else
					{
						$curDate = $lastlogin[0];
					}
				}
				else
				{
					$curDate = date("Y-m-d H:i:s");
				}
				
				// #####################
				// Die Zeit formatieren:
				echo substr($curDate,8,2).".";
				echo substr($curDate,5,2).".";
				echo substr($curDate,0,4)." um ";
				echo substr($curDate,11,2).":";
				echo substr($curDate,14,2)." Uhr";

				echo "</B> statt.<BR><BR> Die Logindauer betr&auml;gt <B>3 (drei) Stunden</B>.".chr(13).chr(10);

				// ##############################################
				// Das Ablaufdatum ermitteln:
				$result = mysql_query ("SELECT DATE_ADD('$curDate', INTERVAL 3 HOUR)");
				$num = mysql_numrows($result);

				// Wurden Datensätze gefunden?
				if ($num > 0)
				{
					$tmpDate = mysql_result($result,0,0);
					echo "<BR><BR>Ihr Login l&auml;uft damit ab um <B>";

					echo substr($tmpDate,8,2).".";
					echo substr($tmpDate,5,2).".";
					echo substr($tmpDate,0,4)." um ";
					echo substr($tmpDate,11,2).":";
					echo substr($tmpDate,14,2)." Uhr</B>.";
				}

				echo "</TD></TABLE><BR>".chr(13).chr(10);

				// Den Dispatcher ermitteln:
				$dx = $_POST["dx"];

				if (trim($dx)=="")
				{
					$dx = $_GET["dx"];
				}

				// ########################################
				// Redaktioneller Hinweis zur Emailadresse:
				include_once("_admin_message.php");

				// ########################
				// Auswahl des Dispatchers:
				echo "<form method='POST' action='_admin_index.php'>".chr(13).chr(10);
				echo "<input type='hidden' name='ux' value=".$ux.">";
				echo "<input type='hidden' name='ufx' value=".$ufx.">";
				echo "<input type='hidden' name='ulx' value=".$ulx.">";

				echo "<BR><BR>".chr(13).chr(10);
				echo "<TABLE border='1' width='100%'>".chr(13).chr(10);
				echo "<TR><TD width='33%'>".chr(13).chr(10);
				echo "Kontextbezogene Hilfe in den Formularen:</TD><TD width='66%'>".chr(13).chr(10);

				// Ausgabe der Auswahliste:
				echo "<SELECT NAME=dx style='width:100%'>".chr(13).chr(10);

				if ($dx == "1")
				{
					echo "<OPTION Value='0'> Keine kontextbezogene Hilfe verwenden".chr(13).chr(10);
					echo "<OPTION Value='1' SELECTED> Kontextbezogene Hilfe verwenden".chr(13).chr(10);
				}
				else
				{
					echo "<OPTION Value='0' SELECTED> Keine kontextbezogene Hilfe verwenden".chr(13).chr(10);
					echo "<OPTION Value='1'> Kontextbezogene Hilfe verwenden".chr(13).chr(10);
				}

				echo "</SELECT></TD></TR></TABLE>";
				echo "<BR><input type='submit' value='Einstellung anwenden' name='B1'>".chr(13).chr(10);
				echo "</form>".chr(13).chr(10);

				include("_admin_userdesk.php");
				
				// #######################################
				// Die letzten erzeugten Objekte anzeigen:
				include("_admin_userdesk_last_contents.php");
				// ###########
				
				include("../includes/forms/middler.php");

				// Die Navigation schreiben:
				include("forms/navigation.php");

				if ($dx == "1")
				{
					writenavigation($ux, $dx);
				}
				else
				{
					writenavigation($ux);
				}
			}
		}
		else
		{
			// ##################################################
			// Prüfen, ob einer neuer Login erstellt werden soll:
			// Achtung, hier wird das Passwort bewusst nicht decodiert!
			// Standardpasswort soll sein: start123

			$px=$_POST["px"];
			$px=mysql_escape_string($px);

			$strSQL = "SELECT * FROM skk_members WHERE name='$ulx' AND vorname='$ufx' AND active!='N' AND del='N' AND pwd='".$px."';";

			if (bCheckRecordset($con, $strSQL)==1)
			{
				// Dieses Mitglied darf sich aufschalten, hat aber noch kein Passwort!
				echo "<TABLE cellpadding=5 cellspacing=0 border=0>";
				echo "<TR><TD>";

				// #########################
				// Icon für Info ausgeben:
				$currentImage = "info.gif";
				include("_admin_get_image.php");

				// ##############################################
				// Die ID des Benutzers speichern und umkodieren:
				$strSQL = "SELECT id FROM skk_members WHERE name='$ulx' AND vorname='$ufx' AND active!='N' AND del='N' AND pwd='".$px."';";

				$result = mysql_query($strSQL);
				$num = mysql_numrows($result);

				$ux = mysql_result($result,0,"id");
				$ux = strrev($ux);
				$ux = base64_encode($ux);

				echo "</TD><TD>Hallo $ufx $ulx, <BR><BR> bitte geben Sie noch ein Passwort f&uuml;r das weitere Aufschalten in den Adminsitrationsbereich ein.<BR>".chr(13).chr(10);
				echo "Das Passwort muss mindestens 6 Zeichen lang sein (max. L&auml;nge 12 Zeichen).</TD></TR></TABLE><BR>".chr(13).chr(10);
				include("_admin_login_new_pwd.php");
			}
			else
			{
				// Es gab ein Problem beim Speichern der Session in der Datenbank!
				echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
				echo "<TR><TD>";

				include("_admin_get_image.php");
				
				echo "</TD><TD>Die Zugangsdaten sind leider falsch oder Ihr Benutzeraccount wurde deaktiviert!<BR>".chr(13).chr(10);
				echo "Konsultieren Sie gegebenenfalls Ihren Fachadministrator.</TD></TR></TABLE><BR>".chr(13).chr(10);
			}
			include("../includes/forms/middler.php");
			include("forms/navigation_access_denied.php");
		}
	}
	else
	{
		// Es gibt eine aktuelle Session!
		// Session konnte erfolgreich gespeichert werden!
		echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
		echo "<TR><TD>".chr(13).chr(10);

		// #########################
		// Icon für Erfolg ausgeben:
		$currentImage = "success.gif";
		include("_admin_get_image.php");
				
		echo "</TD><TD>Hallo $ufx $ulx, herzlich willkommen im Admin-Bereich des Schachklub Kriegshabers.<BR>".chr(13).chr(10);

		// Den Zeitpunkt des Logins ermitteln:
		$strSQL = "SELECT * FROM skk_members WHERE lastlogin IS NOT NULL AND del='N' AND active!='N'";
		$strSQL = $strSQL." AND name='".$ulx."' AND vorname='".$ufx."';";

		$result = mysql_query($strSQL);
		$num = mysql_numrows($result);


		if ($num>0)
		{
			for ($i=0;$i<$num;$i++)
		  	{
		   		$nrak = $num - $i - 1;
		   		$lastlogin[$i] = mysql_result($result,$nrak,"lastlogin");
		  	}
		  	echo "Ihr aktueller Login f&uuml;r den Adminbereich fand um <B>";

		  	// 2008-11-26 20:44:46
			echo substr($lastlogin[0],8,2).".";
			echo substr($lastlogin[0],5,2).".";
			echo substr($lastlogin[0],0,4)." um ";
			echo substr($lastlogin[0],11,2).":";
			echo substr($lastlogin[0],14,2)." Uhr";

			echo "</B> statt.<BR><BR> Die Logindauer betr&auml;gt <B>3 (drei) Stunden</B>.".chr(13).chr(10);

			// ##############################################
			// Die ID des Benutzers speichern und umkodieren:
			$ux = mysql_result($result,0,"id");
			$ux = strrev($ux);
			$ux = base64_encode($ux);

			$result = mysql_query ("SELECT DATE_ADD('$lastlogin[0]', INTERVAL 3 HOUR)");
			$num = mysql_numrows($result);

			// Wurden Datens&auml;tze gefunden?
			if ($num > 0)
			{
				$tmpDate = mysql_result($result,0,0);
				echo "<BR><BR>Ihr Login l&auml;uft damit ab um <B>";

				echo substr($tmpDate,8,2).".";
				echo substr($tmpDate,5,2).".";
				echo substr($tmpDate,0,4)." um ";
				echo substr($tmpDate,11,2).":";
				echo substr($tmpDate,14,2)." Uhr</B>.".chr(13).chr(10);
			}
		}
		else
		{
			echo "Ihr aktueller Login f&uuml;r den Adminbereich ist nun <B>3 (drei) Stunden</B> lang g&uuml;ltig.<BR><BR>".chr(13).chr(10);
		}
		echo "</TD></TR></TABLE>".chr(13).chr(10);

		// ########################################
		// Redaktioneller Hinweis zur Emailadresse:
		include_once("_admin_message.php");

		// Den Dispatcher ermitteln:
		$dx = $_POST["dx"];

		if (trim($dx)=="")
		{
			$dx = $_GET["dx"];
		}
	
		// ###############
		// UX - Parameter:
		if (trim($ux)=="")
		{
			$ux = $_POST["ux"];
		}

		if (trim($ux)=="")
		{
			$ux = $_GET["ux"];
		}

		// ##################################################
		// UPDATE: Schreibtisch erzeugen, falls erforderlich:
		include("_admin_userdesk.php");
		// UPDATE Ende
		

		// ########################################
		// Den Dispatcher speichern, falls möglich:
		$tmp = base64_decode($ux);
		$tmp = strrev($tmp);
			
		if ($dx != "")
		{
			$strSQL = "UPDATE skk_userdesks SET UseHelp=";
		
			if ($dx == "0")
			{
				$strSQL = $strSQL."'N'";
			}
			else
			{
				$strSQL = $strSQL."'J'";
			}
				
			$strSQL = $strSQL." WHERE userid=".$tmp." AND modifieddate IS NULL;";
				
			if (!mysql_query ($strSQL, $con))
			{
				$errText = $strSQL."<BR>".mysql_error()."<BR>".chr(13).chr(10);
				include("_admin_eingabe_fehler.php");
			}
		}
		
		// ########################
		// Auswahl des Dispatchers:
		echo "<form method='POST' action='_admin_index.php'>".chr(13).chr(10);
		echo "<input type='hidden' name='ux' value=".$ux.">";
		echo "<input type='hidden' name='ufx' value=".$ufx.">";
		echo "<input type='hidden' name='ulx' value=".$ulx.">";

		echo "<BR><BR>".chr(13).chr(10);
		echo "<TABLE border='1' width='100%'>".chr(13).chr(10);
		echo "<TR><TD width='33%'>".chr(13).chr(10);
		echo "Kontextbezogene Hilfe in den Formularen:</TD><TD width='66%'>".chr(13).chr(10);
		echo "<SELECT NAME=dx style='width:100%'>".chr(13).chr(10);

		// ################################################
		// Die Benutzereinstellung aus der Datenbank holen:	
		$strSQL = "SELECT * FROM skk_userdesks WHERE userid=".$tmp." AND modifieddate IS NULL AND UseHelp='N';";
		
		if (bCheckRecordset($con, $strSQL)==1)
		{
			$dx = "0";
		}
		else 
		{
			$dx = "1";
		}
				
		if ($dx == "1")
		{
			echo "<OPTION Value='0'> Keine kontextbezogene Hilfe verwenden".chr(13).chr(10);
			echo "<OPTION Value='1' SELECTED> Kontextbezogene Hilfe verwenden".chr(13).chr(10);
		}
		else
		{
			echo "<OPTION Value='0' SELECTED> Keine kontextbezogene Hilfe verwenden".chr(13).chr(10);
			echo "<OPTION Value='1'> Kontextbezogene Hilfe verwenden".chr(13).chr(10);
		}

		echo "</SELECT></TD></TR></TABLE>".chr(13).chr(10);
		echo "<BR><input type='submit' value='Einstellung anwenden' name='Button1'>".chr(13).chr(10);
		echo "</form>".chr(13).chr(10);
		
		// #######################################
		// Die letzten erzeugten Objekte anzeigen:
		include("_admin_userdesk_last_contents.php");
		// ###########
		
		include("../includes/forms/middler.php");

		// Die Navigation schreiben:
		include("forms/navigation.php");

		if ($dx == "1")
		{
			writenavigation($ux,$dx);
		}
		else
		{
			writenavigation($ux);
		}
	}
	include("../includes/forms/footer.php");
?>




