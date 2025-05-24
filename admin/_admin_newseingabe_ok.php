<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neue Meldung publizieren - Check");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/content_get.php")?>
<?php include("../includes/db/team_get.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/date/date.php")?>
<?php include("../includes/string/str.php")?>
<?php include("_admin_param.php")?>
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
	include("_admin_param_ux.php");

	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "R")==0)
	{
		// Keine Gültigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("_admin_param_dx.php");

	// Die Inhalte überprüfen:
	$errText="";

	// ######################
	// Kopfzeile 1:
	$Headline = strGetParam($objDBCon, "Headline");

	if (trim($Headline)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Headline.<BR>";
	}

	// Den Inhalt prüfen:
	$strErr = strCheckMemoFieldContent($Headline, "Headline");
	$errText = $errText.$strErr;

	//$Headline = mysqli_escape_string($objDBCon, $Headline);

	// ################################
	// Kopfzeile 2 (kein Pflichtfeld!):
	$Headline2 = strGetParam($objDBCon, "Headline2");
	
	if (trim($Headline2)=="")
	{
		$Headline2="NULL";
	}
	else
	{
		// Den Inhalt prüfen:
		$strErr = strCheckMemoFieldContent($Headline2, "Headline2");
		$errText = $errText.$strErr;

		//$Headline2 = mysqli_escape_string($objDBCon, $Headline2);
	}

	// ######################
	// Text:
	$Text = strGetParam($objDBCon, "Text");

	if (trim($Text)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Text.<BR>";
	}

	// ##################
	// UPDATE 25.10.2015:
	include("_admin_news_diagramme_resolve.php");
	// UPDATE Ende
	// ###########
	
	// ##################
	// Den Inhalt prüfen:
	$strErr = strCheckMemoFieldContent($Text, "Text");
	$errText = $errText.$strErr;

	// Problem mit der CMS - Engine:
	$Text = str_replace("<br />", "<br>", $Text);
	$Text = str_replace("'", chr(34), $Text);
	//$Text = mysqli_escape_string($objDBCon, $Text);
	//$Text = strReplaceRNInMemoField($Text);

	// ######################
	// Kurztext (kein Pflichtfeld!):
	$Kurztext = strGetParam($objDBCon, "Kurztext");
	
	if (trim($Kurztext)=="")
	{
		$Kurztext = "NULL";
	}
	else
	{
		// Den Inhalt prüfen:
		$strErr = strCheckMemoFieldContent($Text, "Kurztext");
		$errText = $errText.$strErr;

		// Problem mit der CMS - Engine:
		$Kurztext = str_replace("<p>", "", $Kurztext);
		$Kurztext = str_replace("</p>", "", $Kurztext);
		$Kurztext = str_replace("<P>", "", $Kurztext);
		$Kurztext = str_replace("</P>", "", $Kurztext);

		//$Kurztext= mysqli_escape_string($objDBCon, $Kurztext);
		//$Kurztext = strReplaceRNInMemoField($Kurztext);
		$Kurztext = str_replace("'", chr(34), $Kurztext);
	}

	// ######################
	// Kategorie:
	$Kategorie = strGetParam($objDBCon, "Kategorie");
	
	if (trim($Kategorie)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Kategorie.<BR>";
	}
	//$Kategorie= mysqli_real_escape_string($objDBCon, $Kategorie);

	// Die Bilddatei:
	// UPDATE 30.04.2014: Angabe des Namens im Array
	include("_admin_file_upload.php");

	// ######################
	// Tabelle / Inhalt:
	// Hier wird nur die ID mit übergeben!
	$Content = strGetParam($objDBCon, "Content");
	
	// Das Inhaltsobjekt ist optional!
	if ((trim($Content)=="") || (trim($Content)=="0"))
	{
		$Content = "NULL";
	}
	else
	{
		//$Content= mysqli_real_escape_string(objDBCon, $Content);
	}

	// ######################
	// Team:
	// Hier wird nur die ID mit übergeben!
	$team = strGetParam($objDBCon, "team");

	// Das Inhaltsobjekt ist optional!
	if ((trim($team)=="") || (trim($team)=="0"))
	{
		$team = "NULL";
	}
	else
	{
		//$team = mysqli_escape_string($objDBCon, $team);
	}

	// ######################
	// Der Tag:
	$newsdate_day = strGetParam($objDBCon, "newsdate_day");

	// Der Monat:
	$newsdate_month = strGetParam($objDBCon, "newsdate_month");

	// Das Jahr:
	$newsdate_year = strGetParam($objDBCon, "newsdate_year");

	// Ein gültiges Datum?
	$bCheckdate = checkdate($newsdate_month, $newsdate_day, $newsdate_year);

	if ( !$bCheckdate )
	{
		$errText = $errText."Das eingegebene Datum ist nicht korrekt.<BR>";
	}

 	$newsdate = mysqli_escape_string($objDBCon, $newsdate_year."-".$newsdate_month."-".$newsdate_day);

	// ######################
	// Das Ablaufdatum
	// Der Tag:
 	$deadlinedate_day = strGetParam($objDBCon, "deadlinedate_day");
 	
 	if (strlen($deadlinedate_day)==1) 
 	{
 		$deadlinedate_day = "0".$deadlinedate_day;
 	}
 	
	// Der Monat:
 	$deadlinedate_month = strGetParam($objDBCon, "deadlinedate_month");

 	if (strlen($deadlinedate_month)==1) 
 	{
 		$deadlinedate_month = "0".$deadlinedate_month;
 	}
 	
	// Das Jahr:
 	$deadlinedate_year = strGetParam($objDBCon, "deadlinedate_year");
 	
	// ################################################
	// Soll das Ablaufdatum überhaupt verwendet werden?
	if (($deadlinedate_month == "-") || ($deadlinedate_day == "-") ||  ($deadlinedate_year == "-"))
	{
		// Es soll kein Ablaufdatum gesetzt werden:
		$fadeifdeadlinereached = "N";
		$deadlinedate = "NULL";
	}
	else
	{
		$bCheckdate = checkdate($deadlinedate_month, $deadlinedate_day, $deadlinedate_year);

		if ( !$bCheckdate )
		{
			$errText = $errText."Das eingegebene Ablaufdatum ist nicht korrekt.<BR>";
		}
		else
		{
			// Ablaufdatum kann verwendet werden:
			$deadlinedate = $deadlinedate_year."-".$deadlinedate_month."-".$deadlinedate_day;
			$fadeifdeadlinereached = "J";
		}
	}

	// ####################
	// Kommentare zulassen:
	$allowcomment = strGetParam($objDBCon, "allowcomment");
	
	// Kein Pflichtfeld!
	if (trim($allowcomment)=="")
	{
		$allowcomment = "N";
	}
	else
	{
		$allowcomment = mysqli_escape_string($objDBCon, substr($allowcomment, 0, 1));
	}

	// #########################
	// Die Überschrift ausgeben:
	$objectclassicon = "thunder.gif";
	include("forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Neue Meldung publizieren (NEWS - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);
	
	// Gab es Fehler?
	if (trim($errText)!="")
	{
		include("_admin_eingabe_fehler.php");
	}
	else
	{
		// Wurde diese Meldung bereits gespeichert?
		$strSQL = "SELECT id FROM skk_news WHERE ";
		$strSQL = $strSQL.strFormatSQL_WHERE("headline", $Headline, "TRUE")." AND ";
		$strSQL = $strSQL.strFormatSQL_WHERE("headline2", $Headline2, "TRUE")." AND ";
		$strSQL = $strSQL.strFormatSQL_WHERE("headline2", $Headline2, "TRUE")." AND ";
		$strSQL = $strSQL.strFormatSQL_WHERE("category", $Kategorie, "TRUE")." AND ";
		$strSQL = $strSQL.strFormatSQL_WHERE("picture", $file, "TRUE")." AND ";
		$strSQL = $strSQL.strFormatSQL_WHERE("text", $Text, "TRUE")." AND ";
		$strSQL = $strSQL.strFormatSQL_WHERE("shorttext", $Kurztext, "TRUE")." AND ";
		$strSQL = $strSQL.strFormatSQL_WHERE("fadeifdeadlinereached", $fadeifdeadlinereached, "TRUE")." AND ";
		$strSQL = $strSQL."del='N' AND modifieddate IS NULL;";

		if (bCheckRecordset($objDBCon, $strSQL) > 0)
		{
			// ##################################
			// Meldung wurde bereits gespeichert!
			$errText = "Die aktuelle Meldung wurde bereits in der Datenbank gespeichert!";
			include("_admin_eingabe_fehler.php");
		}
		else
		{
			// ######################
			// Neue Meldung einfügen:
		  	$Text = str_replace("\n", "<BR>", $Text);
		  	$now = date("Y-m-d H:i:s");

			$strSQL = "INSERT INTO skk_news (newsdate, headline, headline2, category, text, ";
			$strSQL = $strSQL."shorttext, picture, contentid, teamid, author, allowcomment, hits, creator, createdate, deadlinedate, fadeifdeadlinereached, del) VALUES ";
			$strSQL = $strSQL."(";
			$strSQL = $strSQL.strFormatSQL_INSERT($newsdate, "TRUE").", ";
			$strSQL = $strSQL.strFormatSQL_INSERT($Headline, "TRUE").", ";
			$strSQL = $strSQL.strFormatSQL_INSERT($Headline2, "TRUE").", ";
			$strSQL = $strSQL.strFormatSQL_INSERT($Kategorie, "TRUE").", ";
			$strSQL = $strSQL.strFormatSQL_INSERT($Text, "TRUE").", ";
			$strSQL = $strSQL.strFormatSQL_INSERT($Kurztext, "TRUE").", ";
			$strSQL = $strSQL.strFormatSQL_INSERT($file, "TRUE").", ";
			$strSQL = $strSQL.strFormatSQL_INSERT($Content, "FALSE").", ";
			$strSQL = $strSQL.strFormatSQL_INSERT($team, "FALSE").", ";
			$strSQL = $strSQL."'$curUser', ";
			$strSQL = $strSQL.strFormatSQL_INSERT($allowcomment, "TRUE").", ";
			$strSQL = $strSQL."0, ";
			$strSQL = $strSQL."'$curUser', ";
			$strSQL = $strSQL."'$now', ";
			$strSQL = $strSQL.strFormatSQL_INSERT($deadlinedate, "TRUE").", ";
			$strSQL = $strSQL.strFormatSQL_INSERT($fadeifdeadlinereached, "TRUE").", ";
			$strSQL = $strSQL."'N')";

			if (!mysqli_query ($objDBCon, $strSQL))
			{
				$errText = $strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
				include("_admin_eingabe_fehler.php");
			}
			else
			{		  		
		  		// ##########################################
		  		// UPDATE: Neues Objekt in Schreibtischliste:
		  		$strCurrentTable = "skk_news";
		  		include("_admin_userdesk_contents.php");
		  		// UPDATE ENDE
		  		// ###########
		  		
		  		if (!mysqli_query ($objDBCon, $strSQL))
		  		{
		  			$errText = $strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
		  			include("_admin_eingabe_fehler.php");
		  		}
		  		else
		  		{
		  			echo "Vielen Dank f&uuml;r die neue Meldung!<BR><BR>".chr(13).chr(10);
		  			echo "Der Artikel mit dem Titel <b>".$Headline."</b> ist jetzt online.<BR><BR>".chr(13).chr(10);
		  			
		  			include("_admin_ok_link.php");
		  		}
		  		
		  		// Den RSS - Feed aktualisieren:
				include("_admin_new_rss.php");
				createRSSFile($Kategorie, $objDBCon);
			}
		}
	}

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>


