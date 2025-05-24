<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Vereinslokal bearbeiten - Check");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../_admin_param.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// 1.) Das Verbindungsobjekt ermitteln:
	$objDBCon = GetCon();

	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon, "FALSE");

	// ###################################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("../_admin_param_ux.php");
	
	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "H")==0)
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
	
	// Die Inhalte überprüfen:
	$errText="";

	// ####################################################################################
	// 1.) Vereinslokal:
	$skklocal = strGetParam($objDBCon, "skklocal");
	
	if (trim($skklocal)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Vereinslokal.<BR>";
	}
	$skklocal = mysqli_escape_string($objDBCon, $skklocal);

	// #############
	// Das Jahr:
	$year = strGetParam($objDBCon, "skklocal");
	$year="'".mysqli_escape_string($objDBCon, $year)."'";

	// ######################
	$ID = strGetParam($objDBCon, "ID");

	// 2.) Gab es Fehler?
	if (trim($errText)!="")
	{
		echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
		echo "<b>Die Vereinslokaldaten konnten leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
		echo "<BR><I>".$errText."</I>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
	}
	else
	{
		// Die Änderungen durchf&uuml;hren:
		$now = date("Y-m-d H:i:s");

		// Der UPDATE:
		$strSQL = "UPDATE skk_locals SET modifieddate='$now', modifier='$curUser' WHERE id=$ID AND del='N' ";
		$strSQL = $strSQL."AND modifieddate IS NULL;";

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
			echo "<b>Die Vereinslokaldaten konnten leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
			echo $strSQL."<BR>".chr(13).chr(10);
			echo mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
		}
		else
		{
			// Achtung, optionale Felder m&uuml;ssen ohne Anf&uuml;hrungszeichen stehen!
			$strSQL = "insert into skk_locals (id, year, local, creator, createdate, del) VALUES ";
			$strSQL = $strSQL."($ID, $year, '$skklocal', '$curUser', '$now', 'N')";

			echo "<SPAN CLASS=he1>Vereinslokaldaten speichern (LOCALS - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

			if (!mysqli_query ($objDBCon, $strSQL))
			{
				echo "Die Vereinslokaldaten konnten nicht gespeichert werden!<BR>".chr(13).chr(10);
				echo mysqli_error($objDBCon).chr(13).chr(10);
				echo "<BR>Statement: " . $strSQL . "<BR>".chr(13).chr(10);
			}
			else
			{
		  		echo "Vielen Dank f&uuml;r die Datenerfassung!<BR>".chr(13).chr(10);
		  		echo "Die Vereinslokaldaten wurden erfolgreich aktualisiert.<BR><BR>".chr(13).chr(10);
		  		include("../_admin_ok_link.php");
			}
		}
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>