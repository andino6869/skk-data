<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - AFRO - Daten bearbeiten - Check");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
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
	if (IsSessionValid($objDBCon, $ux, "A")==0)
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

	// #####################
	// Die ID erfragen:
	$Nr = strGetParam($objDBCon, "Nr");
	
	// ######################
	// Die Inhalte überprüfen:
	$errText="";

	// Wurden Texte bearbeitet?
	if ($Nr!=5)
	{
		$Text = strGetParam($objDBCon, "Text");

		if (trim($Text)=="")
		{
			$errText = $errText."Es fehlt ein Eintrag im Feld Seiteninhalt.<BR>";
		}
		else
		{
			$Text = str_replace("'", chr(34), $Text);
		}
	}
	else
	{
		// Es wurden Systemeinstellungen bearbeitet!
		// Anmelden erlauben:
		$allowusermessage = strGetParam($objDBCon, "allowusermessage");
		
		// ###################################################################
		// Anmelden bis:
		// Der Tag:
		$allowusermessageto_day = strGetParam($objDBCon, "allowusermessageto_day");

		// Der Monat:
		$allowusermessageto_month = strGetParam($objDBCon, "allowusermessageto_month");

		// Das Jahr:
		$allowusermessageto_year = strGetParam($objDBCon, "allowusermessageto_year");
		
		// Ein gültiges Datum?
		$bCheckdate = checkdate($allowusermessageto_month, $allowusermessageto_day, $allowusermessageto_year);

		if ( !$bCheckdate )
		{
			$errText = $errText."Das eingegebene Eintrittsdatum ist kein gültiges Datum.<BR>";
		}

	 	$allowusermessageto = mysqli_escape_string($objDBCon, $allowusermessageto_year.".".$allowusermessageto_month.".".$allowusermessageto_day);

		// Macht die Eingabe Sinn?
		$now = date("Y.m.d");

		if ($allowusermessageto < $now)
		{
			$errText = $errText."Das Anmeldedatum liegt bereits in der Vergangenheit.<BR>";
		}

		// Den Link auf den Bereich AFRO anbieten:
		$showafrolink = strGetParam($objDBCon, "showafrolink");
		
		// Max. Anzahl Spieler:
		$maxnumberofplayers = strGetParam($objDBCon, "maxnumberofplayers");
	}

	// ######################
	// Gab es Fehler?
	if (trim($errText)!="")
	{
		echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
		echo "<b>Die aktuelle &Auml;nderung konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
		echo "<I>".$errText."</I>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "Bitte wechseln Sie zurück auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
	}
	else
	{
		// Die Änderungen durchführen:
		$now = date("Y-m-d H:i:s");

		// Den Tabellennamen ermitteln:
		switch ($Nr)
		{
		case "0":
			$strTable = "skk_afro_journey";
			break;

		case "1":
			$strTable = "skk_afro_writeout";
			break;

		case "2":
			$strTable = "skk_afro_results";
			break;

		case "3":
			$strTable = "skk_afro_hotel";
			break;

		case "4":
			$strTable = "skk_afro_contact";
			break;

		case "5":
			$strTable = "skk_afro_config";
			break;

		case "6":
			$strTable = "skk_afro_tables";
		}


		// Der UPDATE:
		$strSQL = "UPDATE $strTable SET modifieddate='$now', modifier='$curUser' WHERE del='N' ";
		$strSQL = $strSQL."AND modifieddate IS NULL;";

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
			echo "<b>Die aktuelle &Auml;nderung konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
			echo $strSQL."<BR>".chr(13).chr(10);
			echo mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
		}

		// DER INSERT:
		if ($Nr!=5)
		{
			$strSQL="INSERT INTO $strTable (text, creator, createdate, del) VALUES (";
			$strSQL=$strSQL."'$Text', '$curUser', '$now', 'N');";
		}
		else
		{
			$strSQL="INSERT INTO $strTable (allowusermessage, allowusermessageto, showafrolink, maxnumberofplayers, ";
			$strSQL=$strSQL."creator, createdate, del) VALUES (";
			$strSQL=$strSQL."'$allowusermessage', '$allowusermessageto', '$showafrolink', $maxnumberofplayers, '$curUser', '$now', 'N');";
		}


		echo "<SPAN CLASS=he1>'AFRO - Inhalte' bearbeiten (AFRO - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
			echo "<b>Die aktuelle &Auml;nderung konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
			echo $strSQL."<BR>".chr(13).chr(10);
			echo mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
			include("_admin_eingabe_fehler.php");
		}
		else
		{
			echo "AFRO - Daten wurden erfolgreich gespeichert.<BR><BR>".chr(13).chr(10);
			include("_admin_ok_link.php");
		}
	}

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>





























