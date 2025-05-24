<?php include("afro_header.php")?>
<?php
	writeheader("Pr&uuml;fen der Anmeldung zum AFRO-Turnier");
?>
<?php include("afro_navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/date/date.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/string/str.php")?>
<?php include("../admin/_admin_param.php")?>
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
	// 4.1.) Das Turnier:
	$tournament = strGetParam($objDBCon, "tournament");
	
	if (trim($tournament)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Turnier.<BR>".chr(13).chr(10);
	}

	// Eingabe prüfen:
	$tournament = strReplaceHTMLTAGS($objDBCon, $tournament);

	if (bCheckIllegalStatements($tournament)===true)
	{
		$errText = $errText."Sie haben in Feld Turnier unangemessene Vulg&auml;rsprache verwendet.<BR>".chr(13).chr(10);
	}

	if (bCheckEnglishStatements($tournament)===true)
	{
		$errText = $errText."Sie haben in Feld Turnier unzul&auml;ssigerweise englische Begriffe oder HTML - Tags verwendet.<BR>".chr(13).chr(10);
	}
	$tournament = mysqli_escape_string($objDBCon, $tournament);
	
	// ####################################################################################
	// 4.2.) Der Name:
	// Nachname:
	$surname = strGetParam($objDBCon, "surname");
	
	if (trim($surname)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Nachname.<BR>";
	}
	else
	{
		// ##################
		// UPDATE 12.06.2015:
		// Kurznamen wie Li sollen ebenfalls möglich sein
		if (strlen($surname) < 2)
		{
			$errText = $errText."Der eingegebene Nachname ist zu kurz.<BR>";
		}
		// UPDATE ENDE
		// ###########
	}

	// Eingabe prüfen:
	$surname = strReplaceHTMLTAGS($objDBCon, $surname);

	if (bCheckIllegalStatements($surname)===true)
	{
		$errText = $errText."Sie haben in Feld Nachname unangemessene Vulg&auml;rsprache verwendet.<BR>".chr(13).chr(10);
	}

	if (bCheckEnglishStatements($surname)===true)
	{
		$errText = $errText."Sie haben in Feld Nachname unzul&auml;ssigerweise englische Begriffe oder HTML - Tags verwendet.<BR>".chr(13).chr(10);
	}
	$surname = mysqli_escape_string($objDBCon, $surname);
	
	// ######################
	// 4.3.) Vorname:
	$firstname = strGetParam($objDBCon, "firstname");
	
	if (trim($firstname)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Vorname.<BR>";
	}
	else
	{
		if (strlen($firstname) < 3)
		{
			$errText = $errText."Der eingegebene Vorname ist zu kurz.<BR>";
		}
	}

	// Eingabe prüfen:
	$firstname = strReplaceHTMLTAGS($objDBCon, $firstname);

	if (bCheckIllegalStatements($firstname)===true)
	{
		$errText = $errText."Sie haben in Feld Vorname unangemessene Vulg&auml;rsprache verwendet.<BR>".chr(13).chr(10);
	}

	if (bCheckEnglishStatements($firstname)===true)
	{
		$errText = $errText."Sie haben in Feld Vorname unzul&auml;ssigerweise englische Begriffe oder HTML - Tags verwendet.<BR>".chr(13).chr(10);
	}
	$firstname = mysqli_escape_string($objDBCon, $firstname);

	// ######################
	// 4.4.) Mailadresse:
	$mailaddress = strGetParam($objDBCon, "mailaddress");
	
	if (trim($mailaddress)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Mailadresse.<BR>";
	}
	else
	{
		if (strlen($mailaddress) < 6)
		{
			$errText = $errText."Die eingegebene Mailadresse ist zu kurz.<BR>";
		}
		else 
		{
			if (preg_match('/^[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)*\@[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)+$/i', $mailaddress))
			{
				// Struktur der Emailadresse passt!
			}
			else
			{
				$errText = $errText."Sie haben in Feld Email einen unzulässigen Eintrag vorgenommen.<BR>".chr(13).chr(10);
			}
		}
	}
	
	// ###############
	// Eingabe prüfen:
	$mailaddress = strReplaceHTMLTAGS($objDBCon, $mailaddress);
	$mailaddress = mysqli_escape_string($objDBCon, $mailaddress);


	// #################
	// 5.) Geburtsdatum:
	// Der Tag:
	$birth_day = strGetParam($objDBCon, "birth_day");
	
	// Der Monat:
	$birth_month = strGetParam($objDBCon, "birth_month");
	
	// Das Jahr:
	$birth_year = strGetParam($objDBCon, "birth_year");
	
	// Ein gültiges Datum?
	$bCheckdate = checkdate($birth_month, $birth_day, $birth_year);

	if ( !$bCheckdate )
	{
		$errText = $errText."Das eingegebene Geburtsdatum ist nicht korrekt.<BR>";
	}
	else
	{
		// Prüfen, ob das Geburtsjahr Sinn macht:
		$now = date("Y-m-d H:i:s");
		$curYear = substr($now,0,4);


		if ($curYear - 4 <= $birth_year)
		{
			$errText = $errText."Das eingegebene Geburtsjahr ist zu jung.<BR>";
		}
	}

 	$birthdate = mysqli_escape_string($objDBCon, $birth_year.".".$birth_month.".".$birth_day);


	// #############
	// 6.) Weitere Daten:
	// 6.1.) DWZ:
 	$DWZ = strGetParam($objDBCon, "DWZ");
 	
	// Kein Pflichtfeld!
	if ((trim($DWZ)=="") || (trim($DWZ)=="-"))
	{
		$DWZ = "NULL";
	}
	else
	{
		$DWZ = mysqli_escape_string($objDBCon, $DWZ);
	}

	// ##########
	// 6.2.) ELO:
	$ELO = strGetParam($objDBCon, "ELO");

	// Kein Pflichtfeld!
	if ((trim($ELO)=="") || (trim($ELO)=="-"))
	{
		$ELO = "NULL";
	}
	else
	{
		$ELO = mysqli_escape_string($objDBCon, $ELO);
	}

	// ############
	// 6.3.) Titel:
	$title = strGetParam($objDBCon, "title");
	
	// Kein Pflichtfeld!
	if (trim($title)=="" || trim($title)=="-")
	{
		$title = "'-'";
	}
	else
	{
		$title = "'".mysqli_escape_string($objDBCon, $title)."'";

		// Machen Titel und ELO Sinn?
		if ($ELO == "NULL")
		{
			$errText = $errText."Sie haben einen Titel, jedoch keine ELO - Zahl mit angegeben.<BR>";
		}
		else
		{
			$ELOtmp = intval($ELO);

			// Kleiner als 1800:
			if ($ELOtmp < 1800)
			{
				$errText = $errText."Ihre ELO - Zahl steht im Widerspruch zu Ihrem Titel. Die angegebene ELO muss gr&ouml;ßer sein als 1800.<BR>";
			}
		}
	}

	// ####################################################################################
	// 6.4.) Der Verein:
	$organization = strGetParam($objDBCon, "organization");
	
	if (trim($organization)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Verein.<BR>";
	}
	else
	{
		if (strlen($organization) < 4)
		{
			$errText = $errText."Die eingegebene Vereinsbezeichnung ist zu kurz.<BR>";
		}
	}

	// Eingabe prüfen:
	$organization = strReplaceHTMLTAGS($objDBCon, $organization);
	$organization = mysqli_escape_string($objDBCon, $organization);
	
	
	if (bCheckIllegalStatements($organization)===true)
	{
		$errText = $errText."Sie haben in Feld Verein unangemessene Vulg&auml;rsprache verwendet.<BR>".chr(13).chr(10);
	}

	if (bCheckEnglishStatements($organization)===true)
	{
		$errText = $errText."Sie haben in Feld Verein unzul&auml;ssigerweise englische Begriffe oder HTML - Tags verwendet.<BR>".chr(13).chr(10);
	}

	// ###################################
	// 7.) Daten im Zusammenwirken prüfen:
	// 7.1.) Namen und Verein:
	if (($surname == $firstname) || ($organization == $firstname) || ($organization == $surname))
	{
		$errText = $errText."Sie haben in Feld Vorname und Nachname bzw. Verein offenbar Unsinn eingegeben.<BR>".chr(13).chr(10);
	}
	
	// ##########################################
	// 7.2.) Keine Zahlenwerte und Sonderzeichen:
	$strTmp = str_replace(" ", "", $surname);
	$strTmp = str_replace("-", "", $surname);
	
	/* if (!(ctype_alpha($strTmp)))
	{
		$errText = $errText."Sie haben in Feld Nachname unzul&auml;ssigerweise Zahlen eingegeben.<BR>".chr(13).chr(10);
	}*/
	
	$strTmp = str_replace(" ", "", $firstname);
	$strTmp = str_replace("-", "", $firstname);
	
	/*if (!(ctype_alpha($strTmp)))
	{
		$errText = $errText."Sie haben in Feld Vorname unzul&auml;ssigerweise Zahlen eingegeben.<BR>".chr(13).chr(10);
	}*/
	
	// #############################################################################
	// 8.) Mail-SPAM vermeiden, falls bisher kein Fehler festgestellt werden konnte:
	// UPDATE 08.06.2018: Spezialnachmeldemöglichkeit für Thomas vorsehen.
	// UPDATE 21.06.2022: Spezialnachmeldemöglichkeit für Eckhardt vorsehen.
	if ((strtolower($mailaddress) != "thomas.staedele@gmail.com") && (strtolower($mailaddress) != "augsburg_afro@yahoo.de") && (strtolower($mailaddress) != "frank_afro@yahoo.de"))
	{
		$now = date("Y-m-d H:i:s");
		$curyear = substr($now,0,4);
			
		if (trim($errText)=="")
		{
			$strSQL = "SELECT * FROM skk_afro_players WHERE mailaddress='".$mailaddress."' AND curyear=".$curyear.";";
			
			$rs = mysqli_query($objDBCon, $strSQL);
			$RecordCount = mysqli_num_rows($rs);
			
			if ($RecordCount > 4)
			{
				$errText = $errText."Sie haben die Mailadresse '".$mailaddress."' mehr als <B>f&uuml;nf</B> Mal f&uuml;r eine Anmeldung verwendet.<BR>";
				$errText = $errText."Verwenden Sie f&uuml;r weitere Registrierungen aus Sicherheitsgr&uuml;nden bitte eine andere Emailadresse.<BR>";
			}
		}
		
		// ##########################################
		// Die IP - Adresse des Anfragers mit prüfen:
		$ip=$_SERVER['REMOTE_ADDR'];
		$ip=mysqli_escape_string($objDBCon, $ip);
		
		$strSQL = "SELECT * FROM skk_afro_players WHERE ip='".$ip."' AND curyear=".$curyear.";";
		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);
		
		if ($RecordCount > 4)
		{
			$errText = $errText."Sie haben Ihre IP-Adresse mehr als <B>f&uuml;nf</B> Mal f&uuml;r eine Anmeldung verwendet.<BR>";
		}
	}
	
	// UPDATE 08.06.2018 Ende.
	// #######################
	
	// ##############################
	// 9.) Passt die DWZ zum Turnier?
	if (($DWZ > 1900) && ($tournament=='B'))
	{
		$errText = $errText."Ihre DWZ ist für die Teilnahme im B - Turnier zu hoch!<BR>";
	}

	// ######################
	echo "<TABLE cellpadding=5 cellspacing=0 border=0>";
	echo "<TR><TD>";

	// ######################
	// 10.) Gab es Fehler?
	if (trim($errText)!="")
	{
		// 10.1.) Die Position der Dateien kann anders lauten!
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
		
    	echo "</TD><TD><b>Sie konnten leider aus folgenden Gr&uuml;nden nicht als neuer Spieler registriert werden:</b><BR><BR>";
		echo "<BR><I>".$errText."</I>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
	}
	else
	{		
		// #########################################################################
		// 10.2.) Wurde dieser Spieler für das diesjährige AFRO bereits registriert?
		$strSQL = "SELECT id FROM skk_afro_players WHERE firstname='$firstname' AND surname='$surname' ";
		$strSQL = $strSQL."AND birthdate='$birthdate' AND curyear=".substr($now,0,4)." AND ";
		$strSQL = $strSQL."del='N' AND modifieddate IS NULL;";

		if (bCheckRecordset($objDBCon, $strSQL)==1)
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
			
	    	echo "</TD><TD><b>Sie konnten leider aus folgenden Gr&uuml;nden nicht als neuer Spieler registriert werden:</b><BR><BR>".chr(13).chr(10);
			echo "<BR><I>Sie sind bereits f&uuml;r das diesj&auml;hrige AFRO angemeldet.</I>".chr(13).chr(10);
			echo "<BR><BR>";
			echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie gegebenenfalls Ihre Eingaben.".chr(13).chr(10);
			echo "<BR><BR>".chr(13).chr(10);
			echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
		}
		else
		{
			// ######################
			// 10.3.) Die Daten schreiben:
			// Das Betriebssystem des Anfragers:
	  	  	$os=$_SERVER['HTTP_USER_AGENT'];
	  	  	$os=mysqli_escape_string($objDBCon, $os);

	  	  	// Die Seed ermitteln:
	  	  	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	  	  	$max = strlen($chars);
	  	  	$strseed = '';
	  	  	
	  	  	// Die Zeichenkette der Länge 10 erstellen:
	  	  	for($i = 0; $i < 10; $i++)
	  	  	{
	  	  		$strseed .= $chars{rand(0, $max-1)};
	  	  	}		
	  	  	
	  	  	// #########################
	  	  	// Den INSERT zusammenbauen:
	  	  	// Das Bestätigung nur für zwei Tage zulassen, danach ist Lnik nicht mehr gültig!
	  	  	$verifieddate = date_create($now);
	  	  	date_add($verifieddate, date_interval_create_from_date_string('2 days'));  	  	
	  	  	
	  	  	$strSQL = "insert into skk_afro_players (surname, firstname, mailaddress, verified, verifyseed, addrstreet, addrzipcode, addrcity, telephone, email, ";
	  	  	$strSQL = $strSQL."birthdate, dwz, elo, title, organization, curyear, tournament, createdate, creator, ip, os, verifieddate) VALUES (";
	  	  	$strSQL = $strSQL."'$surname', '$firstname', '$mailaddress', 'N', '$strseed', NULL, NULL, NULL, NULL, '$mailaddress', ";
	  	  	$strSQL = $strSQL."'".$birthdate."', $DWZ, $ELO, $title, '$organization', ".substr($now,0,4).", '$tournament', ";
	  	  	$strSQL = $strSQL."'$now', 'USER_FORM', '$ip', '$os', '".date_format($verifieddate, 'Y-m-d')."');";

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
				echo mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
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
		    	echo "</TD><TD><B>Anfrage wurde registriert!</B><BR><BR>".chr(13).chr(10);
		    	
		    	// ##########################
		    	// Jetzt die Email versenden:		    	
		    	$mailsubject = "Anmeldung zum AFRO-Turnier ".substr($now,0,4)." - ".$tournament." Turnier" ;
		    	$mailmessage = "<html><head><title>Anmeldung zum AFRO-Turnier ".substr($now,0,4)." - ".$tournament."</title></head>";
		    	$mailmessage = $mailmessage."<body>Sehr geehrte(r) $firstname $surname,<BR><BR>";
		    	$mailmessage = $mailmessage."bitte folgende Sie diesem Link, um Ihre Anmeldung abzuschlie&szlig;en: <BR><BR>";
		    	$mailmessage = $mailmessage."<a href='http://www.skk.de/afro/afro_register_player_verify.php?vx=".$strseed."&dx=".$now."'>Anmeldung zum AFRO-Turnier (".$tournament." Turnier) bestätigen</A><BR><BR>";
		    	$mailmessage = $mailmessage."Die Best&auml;tigung muss sp&auml;testens ".substr(date_format($verifieddate, 'Y-m-d'), 8, 2).".".substr(date_format($verifieddate, 'Y-m-d'), 5, 2).".".substr(date_format($verifieddate, 'Y-m-d'), 0, 4).", 00:00 Uhr erfolgen, da ansonsten der Link ung&uuml;ltig wird.<BR><BR>";
		    	$mailmessage = $mailmessage."Mit freundlichen Gr&uuml&szlig;en<BR><BR><BR>";
		    	$mailmessage = $mailmessage."Ihr AFRO-Team</body></html>";
		    	
		    	// für HTML-E-Mails muss der 'Content-type'-Header gesetzt werden
		    	$header  = 'MIME-Version: 1.0' . "\r\n";
		    	$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		    	$header .= 'From: webmaster@skk.de' . "\r\n" .'Reply-To: webmaster@skk.de' . "\r\n";
		    	
		    	echo "Sehr geehrte(r) $firstname $surname, <BR><BR>";
		    	
		    	if (mail($mailaddress, $mailsubject, $mailmessage, $header, "-f webmaster@skk.de"))
		    	{		    		
		    		echo "zur Best&auml;tigung Ihrer Anmeldung f&uuml;r das AFRO - Turnier ".substr($now,0,4)." erhalten Sie in K&uuml;rze eine Email.<BR>".chr(13).chr(10);
		    		echo "Bitte bet&auml;tigen Sie den dortigen Link zeitnah, um Ihre Anmeldung abzuschlie&szlig;en.<BR><BR>".chr(13).chr(10);
		    		echo "Sie k&ouml;nnen Ihre Daten <B>nach</B> erfolgte Anmeldebest&auml;tigung &uuml;ber den Bereich <B>'Wer hat sich schon angemeldet'</B> einsehen.<BR><BR>".chr(13).chr(10);
		    	}
		    	else 
		    	{
		    		echo "Der Versand der automatisch generierten Email war <B>nicht</B> m&ouml;glich. Bitte versuchen Sie es gegebenenfalls sp&auml;ter noch einmal.";	
		    	}
			}
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