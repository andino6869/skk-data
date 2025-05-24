<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neue Tabelle publizieren - Check");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/content_get.php")?>
<?php include("../includes/db/team_get.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/date/date.php")?>
<?php include("../includes/string/str.php")?>
<?php
	// 1.) Das Verbindungsobjekt ermitteln:
	$con = GetCon();

	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $con, "FALSE");


	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	if (trim($ux)=="")
	{
		$ux = $_GET["ux"];
	}

	if (trim($ux)=="")
	{
		$ux = $_REQUEST["ux"];
	}
	$curUser = strGetCurrentUserByID($con, $ux);


	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($con, $ux, "R")==0)
	{
		// Keine Gültigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	if (trim($dx)=="")
	{
		$dx = $_GET["dx"];
	}

	if (trim($dx)=="")
	{
		$dx = $_REQUEST["dx"];
	}

	if ($dx=="")
	{
		$dx=0;
	}

	// Die Inhalte überprüfen:
	$errText="";

	// ######################
	// Titel:
	if (trim($Titel)=="")
	{
		$Titel=$_GET["Titel"];
	}

	if (trim($Titel)=="")
	{
		$Titel=$_REQUEST["Titel"];
	}

	if (trim($Titel)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Titel.<BR>";
	}

	// Den Inhalt prüfen:
	$strErr = strCheckMemoFieldContent($Titel, "Titel");
	$errText = $errText.$strErr;

	$Titel=mysql_escape_string($Titel);


	// ######################
	// Kategorie:
	if (trim($Kategorie)=="")
	{
		$Kategorie=$_GET["Kategorie"];
	}

	if (trim($Kategorie)=="")
	{
		$Kategorie=$_REQUEST["Kategorie"];
	}

	if (trim($Kategorie)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Kategorie.<BR>";
	}
	$Kategorie=mysql_escape_string($Kategorie);


	// ######################
	// Content:
	if (trim($Content)=="")
	{
		$Content=$_GET["Content"];
	}

	if (trim($Content)=="")
	{
		$Content=$_REQUEST["Content"];
	}

	if (trim($Content)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Content.<BR>";
	}
	else
	{
		// Den Inhalt prüfen:
		$strErr = strCheckMemoFieldContent($Content, "Content");
		$errText = $errText.$strErr;

		$Content = mysql_escape_string($Content);
	}

	// ######################
	$curUser = strGetCurrentUser($con);

	// Gab es Fehler?
	if (trim($errText)!="")
	{
		echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
		echo "<b>Die neue Tabelle konnte leider aus folgenden Gründen nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
		echo "<BR><I>".$errText."</I>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "Bitte wechseln Sie zurück auf die letzte Webseite und überprüfen Sie Ihre Eingaben.".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
	}
	else
	{
		// Wurde diese Meldung bereits gespeichert?
		$strSQL = "SELECT id FROM skk_content WHERE title='$Titel' AND content='$content' ";
		$strSQL = $strSQL."AND category='$Kategorie' AND ";
		$strSQL = $strSQL."del='N' AND modifieddate IS NULL;";

		if (bCheckRecordset($con, $strSQL)==1)
		{
			echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
			echo "<b>Die neue Tabelle konnte leider aus folgenden Gründen nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
			echo "<BR><I>Die neue Tabelle wurde bereits in der Datenbank gespeichert!</I>".chr(13).chr(10);
			echo "<BR><BR>".chr(13).chr(10);
			echo "Bitte wechseln Sie zurück auf die letzte Webseite und überprüfen Sie Ihre Eingaben.".chr(13).chr(10);
			echo "<BR><BR>".chr(13).chr(10);
			echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
		}
		else
		{
		  	$now = date("Y-m-d H:i");

			// Achtung, Content muss ohne Anführungszeichen stehen!
			$strSQL = "insert into skk_content (contentdate, title, category, content, ";
			$strSQL = $strSQL."creator, createdate, del) VALUES ";
			$strSQL = $strSQL."('$now','$Titel','$Kategorie',";
			$strSQL = $strSQL."'$Content','$curUser','$now', 'N')";

			echo "<SPAN CLASS=he1>Neue Tabelle publizieren (Content - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

			if (!mysql_query ($strSQL, $con))
			{
				echo "Tabelle konnte nicht publiziert werden!<BR>".chr(13).chr(10);
				echo mysql_error().chr(13).chr(10);
				echo "<BR>Statement: " . $strSQL . "<BR>".chr(13).chr(10);
			}
			else
			{
		  		echo "Vielen Dank für die neue Tabelle!<BR><BR>".chr(13).chr(10);
		  		echo "Die Tabelle mit dem Titel <b>".$Titel."</b> ist jetzt online verf&uuml;gbar.".chr(13).chr(10);
			}
		}
	}

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($ux, $dx);

	include("../includes/forms/footer.php");
?>
