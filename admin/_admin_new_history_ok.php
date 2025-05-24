<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Vereinsgeschichte erweitern - Check");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("_admin_param.php")?>
<?php include("../includes/string/str.php")?>
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
	if (IsSessionValid($objDBCon, $ux, "H")==0)
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

	// ######################
	// Die Inhalte überprüfen:
	$errText="";
	$Text = strGetParam($objDBCon, "Text");

	if (trim($Text)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Seiteninhalt.<BR>";
	}
	else
	{
		$Text = str_replace("'", chr(34), $Text);
		$Text = mysqli_escape_string($objDBCon, $Text);
		$Text = strReplaceRNInMemoField($Text);
	}

	// ######################
	// Die Seitenzahl:
	$part = strGetParam($objDBCon, "part");
	
	// ######################
	// Gab es Fehler?
	if (trim($errText)!="")
	{
		echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
		echo "<b>Die aktuelle Geschichtsseite konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
		echo "<I>".$errText."</I>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
	}
	else
	{
		// Die Änderungen durchf&uuml;hren:
		$now = date("Y-m-d H:i:s");

		// DER INSERT:
		$strSQL="INSERT INTO skk_history (text, part, creator, createdate, del) VALUES (";
		$strSQL=$strSQL."'$Text', $part, '$curUser', '$now', 'N');";

		echo "<SPAN CLASS=he1>Vereinsgeschichte erweitern (HISTORY - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
			echo "<b>Die aktuelle &Auml;nderung konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
			echo $strSQL."<BR>".chr(13).chr(10);
			echo mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
		}
		else
		{
			echo "Die neue Vereinsgeschichtsseite wurde erfolgreich gespeichert.<BR><BR>".chr(13).chr(10);
			include("_admin_ok_link.php");
		}
	}

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>





























