<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neue Partie publizieren - Check");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/date/date.php")?>

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
	$Titel=mysql_escape_string($Titel);


	// ######################
	// Der Tag:
	if (trim($matchdate_day)=="")
	{
		$matchdate_day=$_GET["matchdate_day"];
	}

	if (trim($matchdate_day)=="")
	{
		$matchdate_day=$_REQUEST["matchdate_day"];
	}

	// Der Monat:
	if (trim($matchdate_month)=="")
	{
		$matchdate_month=$_GET["matchdate_month"];
	}

	if (trim($matchdate_month)=="")
	{
		$matchdate_month=$_REQUEST["matchdate_month"];
	}

	// Das Jahr:
	if (trim($matchdate_year)=="")
	{
		$matchdate_year=$_GET["matchdate_year"];
	}

	if (trim($matchdate_year)=="")
	{
		$matchdate_year=$_REQUEST["matchdate_year"];
	}

	// Ein gültiges Datum?
	$bCheckdate = checkdate($matchdate_month, $matchdate_day, $matchdate_year);

	if ( !$bCheckdate )
	{
		$errText = $errText."Das eingegebene Datum ist nicht korrekt.<BR>";
	}

 	$matchdate = mysql_escape_string($matchdate_year.".".$matchdate_month.".".$matchdate_day);


	// ######################
	// Kurztext:
	if (trim($Kurztext)=="")
	{
		$Kurztext=$_GET["Kurztext"];
	}

	if (trim($Kurztext)=="")
	{
		$Kurztext=$_REQUEST["Kurztext"];
	}

	if (trim($Kurztext)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Kurztext.<BR>";
	}
	$Kurztext=mysql_escape_string($Kurztext);



	// ######################
	// Aufstellung:
	if (trim($Aufstellung)=="")
	{
		$Aufstellung=$_GET["Aufstellung"];
	}

	if (trim($Aufstellung)=="")
	{
		$Aufstellung=$_REQUEST["Aufstellung"];
	}

	if (trim($Aufstellung)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Aufstellung.<BR>";
	}

	// ######################
	// Partiedaten:
	if (trim($Partiedaten)=="")
	{
		$Partiedaten=$_GET["Partiedaten"];
	}

	if (trim($Partiedaten)=="")
	{
		$Partiedaten=$_REQUEST["Partiedaten"];
	}

	if (trim($Partiedaten)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Partiedaten.<BR>";
	}

	// ######################
	// Züge:
	if (trim($Zuege)=="")
	{
		$Zuege=$_GET["Zuege"];
	}

	if (trim($Zuege)=="")
	{
		$Zuege=$_REQUEST["Zuege"];
	}

	if (trim($Zuege)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Züge.<BR>";
	}

	// Gab es Fehler?
	if (trim($errText)!="")
	{
		echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
		echo "<b>Die neue Partie konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
		echo "<BR><I>".$errText."</I>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
	}
	else
	{
		// Wurde diese Meldung bereits gespeichert?
		$strSQL = "SELECT id FROM skk_matches WHERE title='$Titel' AND shorttext='$Kurztext' ";
		$strSQL = $strSQL."AND matchdate='$matchdate' AND moves='$Zuege' AND ";
		$strSQL = $strSQL."del='N' AND modifieddate IS NULL;";

		if (bCheckRecordset($con, $strSQL)==1)
		{
			echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
			echo "<b>Die neue Partie konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
			echo "<BR><I>Die aktuelle Partie wurde bereits in der Datenbank gespeichert!</I>".chr(13).chr(10);
			echo "<BR><BR>".chr(13).chr(10);
			echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
			echo "<BR><BR>".chr(13).chr(10);
			echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
		}
		else
		{
		  	$now = date("Y-m-d H:i:s");

			// Achtung, Content muss ohne Anf&uuml;hrungszeichen stehen!
			$strSQL = "insert into skk_matches (matchdate, title, shorttext, nomination, matchdata, moves, creator, createdate, del) VALUES ";
			$strSQL = $strSQL."('$matchdate','$Titel','$Kurztext','$Aufstellung','$Partiedaten','$Zuege',";
			$strSQL = $strSQL."'$curUser','$now', 'N')";

			echo "<SPAN CLASS=he1>Neue Partie publizieren (MATCH - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

			if (!mysql_query ($strSQL, $con))
			{
				echo "Partie konnte nicht publiziert werden!<BR>".chr(13).chr(10);
				echo mysql_error().chr(13).chr(10);
				echo "<BR>Statement: " . $strSQL . "<BR>".chr(13).chr(10);
			}
			else
			{
		  		echo "Vielen Dank f&uuml;r die neue Partie!<BR><BR>".chr(13).chr(10);
		  		echo "Die Partie mit dem Titel <b>".$Titel."</b> ist jetzt online.".chr(13).chr(10);
			}
		}
	}

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($ux);

	include("../includes/forms/footer.php");
?>




































