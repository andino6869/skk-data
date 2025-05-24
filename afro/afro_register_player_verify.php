<?php include("afro_header.php")?>
<?php
	writeheader("Best&auml;titgen der Anmeldung zum AFRO-Turnier");
?>
<?php include("afro_navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/date/date.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/string/str.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// 1.) Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// Gab es Probleme?
	if ($objDBCon == "")
	{
		echo "<BR>Problem mit dem Verbindungsaufbau zur Datenbank: Das Verbindungsobjekt konnte nicht erzeugt werden!<BR>";
		echo "</BODY></HTML>".chr(13).chr(10);
		exit;
	}

	// 2.) Prüfen, ob der Zugang auf die AFRO - Seite aktuell überhaupt erlaubt ist:
	if (bIsAFROValid($objDBCon)==0)
	{
		// Keine Gültigkeit mehr!
		include("afro_middler.php");
		include("afro_footer.php");

		exit;
	}

	// ###########################################################################
	// 3.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar.
	// geschrieben:
  	writeNavigationBar(999, $objDBCon);


	// 4.) Die Inhalte überprüfen:
	$errText="";

	// ####################################################################################
	// 4.1.) Die Seed:
	if (!isset($vx))
	{
		$vx= "";
	}

	if (trim($vx)=="")
	{
		$vx=$_GET["vx"];
	}

	if (trim($vx)=="")
	{
		$vx=$_REQUEST["vx"];
	}

	if (trim($vx)=="")
	{
		$errText = $errText."Es fehlt die Pr&uumlfsumme.<BR>".chr(13).chr(10);
	}

	// Eingabe prüfen:
	if (strlen($vx)<>10)
	{
		$errText = $errText."Die Pr&uumlfsumme ist ung%&uuml;ltig!<BR>".chr(13).chr(10);
	}
	//$vx = mysqli_escape_string($vx);
	
	// ####################################################################################
	// 4.2.) Der Zeitstempel:
	if (!isset($dx))
	{
		$dx= "";
	}

	if (trim($dx)=="")
	{
		$dx=$_GET["dx"];
	}

	if (trim($dx)=="")
	{
		$dx=$_REQUEST["dx"];
	}

	if (trim($dx)=="")
	{
		$errText = $errText."Es fehlt das Meldedatum.<BR>";
	}
	else
	{
		if (strlen($dx) > 19)
		{
			$errText = $errText."Das Meldedatum ist zu lang.<BR>";
		}
	}

	// Eingabe prüfen:
	// $dx = mysqli_escape_string($dx);
	
	
	// ####################
	// 5.) DB-Logik prüfen:
	$now = date("Y-m-d H:i:s");
	
	// 5.1.) Checksumme:
	$strSQL = "SELECT * FROM skk_afro_players WHERE verifyseed='".$vx."'";
	
	if (bCheckRecordset($objDBCon, $strSQL)==0)
	{
		$errText = $errText."Die &uuml;bergebene Checksumme ist ung&uuml;ltig.<BR>";
	}
	else 
	{
		// 5.2.) Checksumme:
		$strSQL = "SELECT * FROM skk_afro_players WHERE verifyseed='".$vx."' AND verified='N'";
		
		if (bCheckRecordset($objDBCon, $strSQL)==0)
		{
			$errText = $errText."Sie haben Ihre Anmeldung bereits best&auml;tigt!<BR>";
		}
		else 
		{
			// 5.3.) Meldedatum:
			$strSQL = "SELECT * FROM skk_afro_players WHERE verifyseed='".$vx."' AND verified='N' AND verifieddate>='".$now."'";
			
			if (bCheckRecordset($objDBCon, $strSQL)==0)
			{
				$errText = $errText."Der Zeitstempel ist für eine g&uuml;ltige Anmeldung bereits zu alt.<BR>";
				$errText = $errText."F&uuml;hren Sie die Registrierung gegebenenfalls erneut aus.<BR>";
			}
			else 
			{
				// 5.4.) Erstellungsdatum prüfen:			
				$strSQL = "SELECT * FROM skk_afro_players WHERE verifyseed='".$vx."' AND verified='N' AND verifieddate>='".$now."' AND createdate='".$dx."'";
				
				if (bCheckRecordset($objDBCon, $strSQL)==0)
				{
					$errText = $errText."Das &uuml;bergebene Datum konnte nicht gefunden werden!<BR>";
				}
			}
		}
	}

	// ##############################
	// 6.) Das Prüfergebnis ausgeben:
	echo "<TABLE cellpadding=5 cellspacing=0 border=0>";
	echo "<TR><TD>";

	// ####################
	// 6.1.) Gab es Fehler?
	if (trim($errText)!="")
	{
		// 6.6.1.) Die Position der Dateien kann anders lauten!
		if (is_file("../pics/admin/critical.gif"))
		{
			echo "<IMG SRC='../pics/admin/critical.gif' border=0>";
		}
		else
		{
			if (is_file("../../pics/admin/critical.gif"))
			{
				echo "<IMG SRC='../../pics/admin/critical.gif' border=0>";
			}
			else
			{
				echo "<IMG SRC='../../../pics/admin/critical.gif' border=0>";
			}
		}
		
    	echo "</TD><TD><b>Die Anmeldung konnte leider aus folgenden Gr&uuml;nden nicht best&auml;tigt werden:</b><BR><BR>";
		echo "<BR><I>".$errText."</I>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
	}
	else
	{
  	  	// ###############################
  	  	// 6.2.) Den UPDATE zusammenbauen:
		$strSQL = "UPDATE skk_afro_players SET verified='J', creator='USER_FORM_VERIFY' WHERE verifyseed='".$vx."' AND createdate='".$dx."';";

		// Daten schreiben:
		if (!mysqli_query ($objDBCon, $strSQL))
		{
			// Die Position der Dateien kann anders lauten!
			if (is_file("../pics/admin/critical.gif"))
			{
				echo "<IMG SRC='../pics/admin/critical.gif' border=0>".chr(13).chr(10);
			}
			else
			{
				if (is_file("../../pics/admin/critical.gif"))
				{
					echo "<IMG SRC='../../pics/admin/critical.gif' border=0>".chr(13).chr(10);
				}
				else
				{
					echo "<IMG SRC='../../../pics/admin/critical.gif' border=0>".chr(13).chr(10);
				}
			}
			
	    	echo "</TD><TD>Abfrage war NICHT erfolgreich!<BR>".chr(13).chr(10);
			echo mysql_error($objDBCon)."<BR>".chr(13).chr(10);
			echo "Statement: ".$strSQL."<BR>".chr(13).chr(10);
			echo "<B>Ihre Daten wurden NICHT gespeichert!</B>".chr(13).chr(10);
		}
		else
		{
			// Die Position der Dateien kann anders lauten!
			if (is_file("../pics/admin/success.gif"))
			{
				echo "<IMG SRC='../pics/admin/success.gif' border=0>".chr(13).chr(10);
			}
			else
			{
				if (is_file("../../pics/admin/success.gif"))
				{
					echo "<IMG SRC='../../pics/admin/success.gif' border=0>".chr(13).chr(10);
				}
				else
				{
					echo "<IMG SRC='../../../pics/admin/success.gif' border=0>".chr(13).chr(10);
				}
			}
	    	echo "</TD><TD><B>Anmeldung wurde best&auml;tigt!</B><BR><BR>".chr(13).chr(10);	    		    	
	    	echo "Sehr geehrte(r) Teilnehmer(in), <BR><BR>";		    		
    		echo "Ihre Anmeldung f&uuml;r das AFRO - Turnier ".substr($now,0,4)." wurde best&auml;tigt.<BR>".chr(13).chr(10);
    		echo "Sie k&ouml;nnen nun Ihre Daten &uuml;ber den Bereich <B>'Wer hat sich schon angemeldet'</B> einsehen.<BR><BR>".chr(13).chr(10);
		}
	}

	echo "</TD></TR></TABLE>".chr(13).chr(10);

	// Der übliche Rest:
  	include("afro_middler.php");
	include("afro_user_registration.php");

	get_user_registration($objDBCon);

	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("afro_downloads.php");
	get_downloads($objDBCon);
	include("afro_footer.php");
?>