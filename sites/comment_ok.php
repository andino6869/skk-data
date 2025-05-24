<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Kommentar zu News & Meldungen");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/forms/messagebox.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/string/str.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../admin/_admin_param.php")?>

<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// #############################
	// 1.) Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// #############################
	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon);

	// Gab es Probleme?
	if ($objDBCon == "")
	{
		echo "<BR>Problem mit dem Verbindungsaufbau zur Datenbank: Das Verbindungsobjekt konnte nicht erzeugt werden!<BR>";
		echo "</BODY></HTML>";
		exit;
	}

	echo "<TABLE cellpadding=5 cellspacing=0 border=0>";
	echo "<TR><TD>";

	// ##################################
	// 3.) Die Schreibanfrage festhalten:
	// Das aktuele Datum hinterlegen:
  	$now = date("Y-m-d H:i:s");

  	// Die IP - Adresse des Anfragers:
  	$ip = $_SERVER['REMOTE_ADDR'];

        // Das Betriebssystem des Anfragers:
  	$os = $_SERVER['HTTP_USER_AGENT'];

  	// Ermittelt den zur angegebenen IP-Adresse passenden Internet-Hostnamen:
	$pc = gethostbyaddr($ip);

  	// Argumente ausführungssicher machen:
  	$ip = mysqli_escape_string($objDBCon, $ip);
	$os = mysqli_escape_string($objDBCon, $os);
	$pc = mysqli_escape_string($objDBCon, $pc);
	
  	$strSQL = "INSERT INTO skk_comments_requests (ip, os, createdate, creator) VALUES ";
  	$strSQL = $strSQL."('".$ip."', '".$os."', '".$now."', '".$pc."')";

  	// ###################
  	// Variable initieren:
  	$strMessage = "";
  	
	if (!(mysqli_query($objDBCon, $strSQL)))
	{
		// #######################
		// Fehlermeldung ausgeben:
		$strMessage = "</TD><TD><B>Es konnte Ihre Kommentarschreibanfragen nicht gespeichert werden.<BR></TD></TR></TABLE>";
		MessageBox($strMessage, $objDBCon);
	}

	// #######################################
	// 4.) Die Anzahl der Anfragen überprüfen:
	if (bCheckCommentTimeInterval($objDBCon)==0)
	{
		// #######################
		// Fehlermeldung ausgeben:
		$strMessage = "</TD><TD><B>Es wurden zu viele Kommentarschreibanfragen innerhalb der letzten ";
		$strMessage = $strMessage."10 Minuten gestartet.<BR>";
	        $strMessage = $strMessage."Ihre Daten wurden somit NICHT gespeichert! Probieren Sie es zu einem sp&auml;teren Zeitpunkt nochmal.</B>".chr(13).chr(10);
    	        $strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
		MessageBox($strMessage, $objDBCon);
	}

	// #################################################################
	// 5.) Die Angaben prüfen, ob überhaupt etwas eingegeben worden ist:
	$strTmpName = strGetParam($objDBCon, "NameAntwort");
	$strTmpAnswer = strGetParam($objDBCon, "Antwort");
	
	if (isset($_POST['chkSaveOK']))
	{
		$strSaveOK = "OK";
	}
	else 
	{
		$strSaveOK = "NOK";
	}
	
	// #############################################################
  	// 6.) Illegale Charakter entfernen (inkl. mysql_escape_string):
	$strTmpName = strReplaceHTMLTAGS($objDBCon, $strTmpName);
	$strTmpAnswer = strReplaceHTMLTAGS($objDBCon, $strTmpAnswer);
	$strSaveOK = strReplaceHTMLTAGS($objDBCon, $strSaveOK);

	// #############################
  	// 7.) Plausichecks:
  	// 7.1.) Leere Eingabe:
  	if (trim($strTmpName) == '' || trim($strTmpAnswer) == '')
  	{
		$strMessage = "</TD><TD><B>Sie haben entweder keinen Namen oder keine Antwort hinterlegt.<BR>";
		$strMessage = $strMessage."Die Daten wurden NICHT gespeichert!</B>".chr(13).chr(10);
		$strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
		MessageBox($strMessage, $objDBCon);
  	}

	// #############################
  	// 7.2.) Zu kurze Eingabe:
	if (strlen($strTmpName) < 4 || strlen($strTmpAnswer) < 4)
        {
  		$strMessage = "</TD><TD><B>Sie haben einen zu kurzen Namen oder kurze Antwort hinterlegt (mind. 4 Zeichen).<BR>";
  		$strMessage = $strMessage."Die Daten wurden NICHT gespeichert!</B>".chr(13).chr(10);
  		$strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
		MessageBox($strMessage, $objDBCon);
	}

	// #############################
  	// 7.3.) Wurden Kraftausdrücke
  	// 7.3.1.) im Namen hinterlegt?
	if (bCheckIllegalStatements($strTmpName)===true)
	{
	  	$strMessage = "</TD><TD><B>Sie haben in Ihrem Namen unangemessene Vulg&auml;rsprache verwendet.<BR>";
	  	$strMessage = $strMessage."Die Daten wurden NICHT gespeichert!</B>".chr(13).chr(10);
	  	$strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
  		MessageBox($strMessage, $objDBCon);
	}

	// ##################################
  	// 7.3.2.) in der Antwort hinterlegt?
	if (bCheckIllegalStatements($strTmpAnswer)===true)
	{
		$strMessage = "</TD><TD><B>Sie haben in Ihrer Antwort unangemessene Vulg&auml;rsprache verwendet.<BR>";
		$strMessage = $strMessage."Die Daten wurden NICHT gespeichert!</B>".chr(13).chr(10);
		$strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
		MessageBox($strMessage, $objDBCon);
	}
	
	// #################################################################
  	// 5.4.) Wurden englische Worte oder weitere HTML - Tags hinterlegt?
  	// 5.4.1.) im Namen hinterlegt?
	if (bCheckEnglishStatements($strTmpName)===true)
	{
		$strMessage = "</TD><TD><B>Sie haben in Ihrem Namen unzul&auml;ssigerweise englische Begriffe oder HTML - Tags verwendet.<BR>";
		$strMessage = $strMessage."Die Daten wurden NICHT gespeichert!</B>".chr(13).chr(10);
		$strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
		MessageBox($strMessage, $objDBCon);
	}

	// ##################################
  	// 5.4.2.) in der Antwort hinterlegt? 	
	if (bCheckEnglishStatements($strTmpAnswer)===true)
	{
		$strMessage = "</TD><TD><B>Sie haben in Ihrer Antwort unzul&auml;ssigerweise englische Begriffe oder HTML - Tags verwendet.<BR>";
		$strMessage = $strMessage."Die Daten wurden NICHT gespeichert!</B>".chr(13).chr(10);
		$strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
		MessageBox($strMessage, $objDBCon);
	}

	// ###############################
	// 5.5.) Wurde zu viel eingegeben?
	if (strlen($strTmpName) > 255 || strlen($strTmpAnswer) > 1024)
        {
  		$strMessage = "</TD><TD><B>Sie haben einen zu langen Namen (aktuell ".strlen($strTmpName)." Zeichen) oder ".chr(13).chr(10);
    	        $strMessage = $strMessage."eine zu lange Antwort hinterlegt (aktuell ".strlen($strTmpAnswer)." Zeichen).<BR>".chr(13).chr(10);
    	        $strMessage = $strMessage."Es sind nur 255 Zeichen im Namen und 1024 Zeichen in der Antwort zul&auml;ssig.<BR><BR>";
  		$strMessage = $strMessage."Die Daten wurden NICHT gespeichert!</B>".chr(13).chr(10);
  		$strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
  		MessageBox($strMessage, $objDBCon);
	}
	
	// #######################################################
	// UPDATE 15.02.2017
	// Angriff auf Bericht zum Weihnachtsopen 2016
	// 5.6.) Prüfen, ob im Namen Zahlen verwendet worden sind:
	// Achtung, Leerzeichen wird als Zahl interpretiert!!!
	// UPDATE 29.02.2024: Problem beim Aufruf von ctype_alpha
	// Daher auskommentiert.
	$strTmp = str_replace(" ", "", $strTmpName);
	
	/*if (!(ctype_alpha($strTmp)))
	{
		$strMessage = "</TD><TD><B>Sie haben in Ihrem Namen unzul&auml;ssigerweise Zahlen bzw. Sonderzeichen eingegeben!<BR>";
		$strMessage = $strMessage."Die Daten wurden NICHT gespeichert!</B>".chr(13).chr(10);
		$strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
		MessageBox($strMessage, $objDBCon);
	}*/
	
	// ################################
	// 5.7.) Betriebssystem überprüfen:
	// WWW-Mechanize/1.73
	$pos = strpos(strtolower($os), "www");
	
	if (!($pos === false))
	{
		$strMessage = "</TD><TD><B>Das von Ihnen eingesetzte System ist nicht vertrauensw&uuml;rdig!<BR>";
		$strMessage = $strMessage."Die Daten wurden NICHT gespeichert!</B>".chr(13).chr(10);
		$strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
		MessageBox($strMessage, $objDBCon);
	}
	
	$pos = strpos(strtolower($os), "mechanize");
	
	if (!($pos === false))
	{
		$strMessage = "</TD><TD><B>Das von Ihnen eingesetzte System ist nicht vertrauensw&uuml;rdig!<BR>";
		$strMessage = $strMessage."Die Daten wurden NICHT gespeichert!</B>".chr(13).chr(10);
		$strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
		MessageBox($strMessage, $objDBCon);
	}
	
	// UPDATE ENDE
	// ###########
	
	// UPDATE 02.11.2019:
	// Anwender bestätigt Speichern der Daten:
	$pos = strpos(strtolower($strSaveOK), "nok");
	
	if ((!($pos === false)) || trim($strSaveOK)=="")
	{
		$strMessage = "</TD><TD><B>Sie haben dem Speichern der Daten NICHT zugestimmt!<BR>";
		$strMessage = $strMessage."Die Daten k&ouml;nnen daher NICHT gespeichert!</B>".chr(13).chr(10);
		$strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
		MessageBox($strMessage, $objDBCon);
	}
	
	
	// ################################
	// 6.) Die Umgebungsdaten abfragen:
	// Ermittelt den zur angegebenen IP-Adresse passenden Internet-Hostnamen:
	$pc = gethostbyaddr($ip);
	
	// ############################
	// Gibt es den Datensatz schon?
	// UPDATE 31.03.2016:
	// Problem mit gleichem Namen und gleichem Text beheben (z.B. beim Mittwochstraining): 
	$curYear = substr($now,0,4);
	$curMonth = substr($now,5,2);
	$curDay = substr($now,8,2);
	
	$strSQL = "SELECT * FROM skk_comments WHERE nameanswer='".$strTmpName."' AND answer='".$strTmpAnswer."' AND ip='".$ip."' AND ";
	$strSQL = $strSQL."(createdate < now() AND createdate > '".$curYear."-".$curMonth."-".$curDay." 00:00:00')".chr(13).chr(10);
	// UPDATE Ende
		
	// ##################################
	// 6.1.) Gibt es diese Meldung schon?
	if (bCheckRecordset($objDBCon, $strSQL)==1)
	{	
		$strMessage = "</TD><TD><B>Ihre Antwort wurde bereits abgespeichert.".chr(13).chr(10);
		$strMessage = $strMessage."Die Daten wurden NICHT nochmals gespeichert!</B>".chr(13).chr(10);
		$strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
		MessageBox($strMessage, $objDBCon);
	}

	// ###############################
	// 6.2.) Neuen Kommentar einfügen:
	$Nr = strGetParam($objDBCon, "Nr");
	
	$strSQL = "insert into skk_comments (createdate, Nr, nameanswer, answer, creator, ip, os) VALUES ";
	$strSQL = $strSQL."('$now','".$Nr."','".$strTmpName."','".$strTmpAnswer."','".$pc."','".$ip."','".$os."')";

	// Daten schreiben:
	if (!(mysqli_query($objDBCon, $strSQL)))
	{	
		$strMessage = "</TD><TD><B>Abfrage war NICHT erfolgreich!<BR>".mysql_error()."<BR>".chr(13).chr(10);
		$strMessage = $strMessage."Die Daten wurden NICHT nochmals gespeichert!</B>".chr(13).chr(10);
		$strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
		MessageBox($strMessage, $objDBCon);
	}
	else
	{
		// ################################
		// Namen speichern für die Ausgabe:
		$strComName = $strTmpName;
		
		// ##############################################
		// 6.3.) Die Daten wurde erfolgreich geschrieben!
		// Nun prüfen, ob Mitglieder wegen dieses neuen Kommentars
		// benachrichtigt werden müssen:

		// #################################
		// 6.3.1.) Die Zuordnung herstellen:
		$strSQL = "SELECT author, headline FROM skk_news WHERE id=".$Nr." AND del='N' AND modifieddate IS NULL AND author IS NOT NULL;";

		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

		if ($RecordCount > 0)
		{
			$i = 0;
				
			while ($row = $rs->fetch_object())
			{
				$strAuthor = $row->author;
				$strHeadline = $row->headline;
				$i++;
			}
			
			// ####################################################
			// 6.3.2.) Jetzt die aktive Mitgliederliste durchgehen:
			$strSQL = "SELECT * FROM skk_members WHERE del='N' AND active!='N'";
			$strSQL = $strSQL." AND (mail IS NOT NULL AND mail !='') AND modifieddate IS NULL;";
			
			$rs = mysqli_query($objDBCon, $strSQL);
			$RecordCount = mysqli_num_rows($rs);
			
			$bFound = "FALSE";
			
			if ($RecordCount > 0)
			{
				$i = 0;
				
				while ($row = $rs->fetch_object())
				{
					$strTmpName = "";
					
					$strTmpName = trim($row->vorname);
					$strTmpName = $strTmpName." ".trim($row->name);
					$mailaddress = trim($row->mail);
					
					// Passt der Name?
					if ($strAuthor == $strTmpName)
					{
						// ##################################
						// 6.3.3.) Jetzt die Email versenden:
						$mailsubject = "SKK-Homepage Neuer Kommentar zu Bericht '".$strHeadline."'" ;
						$mailmessage = "<html><head><title>SKK-Homepage Neuer Kommentar zu Bericht '".$strHeadline."'</title></head>";
						$mailmessage = $mailmessage."<body>Hallo lieber Nutzer des Redaktionssystems, <BR><BR>zu dem oben genannten Bericht wurde zwischenzeitlich von dem Besucher '".$strComName."' folgender Kommentar abgegeben: '".$strTmpAnswer."'.<BR><BR>";
						$mailmessage = $mailmessage."Mit freundlichen Gr&uuml&szlig;en<BR><BR><BR>";
						$mailmessage = $mailmessage."Ihr Redaktionssystem<BR><BR>";
						$mailmessage = $mailmessage."Hinweis: Bei der vorliegenden Emailadresse handelt es sich um eine reine Funktionsadresse f&uuml;r den Versand von Emails, auf die nicht geantwortet wird.</body></html>";
						
						// für HTML-E-Mails muss der 'Content-type'-Header gesetzt werden
						$header  = 'MIME-Version: 1.0' . "\r\n";
						$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$header .= 'From: webmaster@skk.de' . "\r\n" .'Reply-To: webmaster@skk.de' . "\r\n";
							
						mail($mailaddress, $mailsubject, $mailmessage, $header, "-f webmaster@skk.de");
		   			}
		   			
		   			$i++;
				}
			}
		}
		// ###############################
		// Nachricht an Anwender ausgeben:		
		$strMessage = $strMessage."</TD><TD>Der Kommentar von '".$strComName."' wurde erfolgreich gespeichert und wird in der Folge beim Bericht mit aufgef&uuml;hrt.<BR><BR>".chr(13).chr(10)."Vielen Dank f&uuml;r Ihr Feedback!<BR><BR>".chr(13).chr(10);
		$strMessage = $strMessage."</TD></TR></TABLE>".chr(13).chr(10);
		MessageBox($strMessage, $objDBCon, 3);
	}
?>
