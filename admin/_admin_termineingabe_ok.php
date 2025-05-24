<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neuen Termin publizieren - Check");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/date/date.php")?>
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
	
	// #######
	// Termin:
	$Termin = strGetParam($objDBCon, "Termin");
	
	if (trim($Termin)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Termin.<BR>";
	}
	$Termin = mysqli_escape_string($objDBCon, $Termin);


	// ######################
	// Kategorie:
	$Kategorie = strGetParam($objDBCon, "Kategorie");

	if (trim($Kategorie)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Kategorie.<BR>";
	}
	$Kategorie = mysqli_escape_string($objDBCon, $Kategorie);

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

 	$deadlinedate = $newsdate_year.".".$newsdate_month.".".$newsdate_day;

	// ######################
	// Art:
 	$Art = strGetParam($objDBCon, "Art");
 	
	if (trim($Art)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Art.<BR>";
	}
	$Art = mysqli_escape_string($objDBCon, $Art);

	// ##################
	// Ausgabe des Icons:
	$objectclassicon = "deadline.gif";
	include("forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Neuen Termin publizieren (DEADLINE - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);
	
	// ##############
	// Gab es Fehler?
	if (trim($errText)!="")
	{
		include("_admin_eingabe_fehler.php");
	}
	else
	{
		// Wurde diese Meldung bereits gespeichert?
		$strSQL = "SELECT id FROM skk_deadline WHERE deadlinedate='$deadlinedate' AND deadline='$Termin' AND ";
		$strSQL = $strSQL."category='$Kategorie' AND kind='$Art' AND del='N' AND modifieddate IS NULL;";

		if (bCheckRecordset($objDBCon, $strSQL)==1)
		{
			$errText = "Der aktuelle Termin wurde bereits in der Tabelle gespeichert!";
			include("_admin_eingabe_fehler.php");
		}
		else
		{
		  	$now = date("Y-m-d H:i");

			$strSQL = "insert into skk_deadline (deadlinedate, deadline, category, kind, creator, createdate, del) VALUES ";
			$strSQL = $strSQL."('$deadlinedate','$Termin','$Kategorie','$Art','$curUser','$now','N')";

			if (!mysqli_query ($objDBCon, $strSQL))
			{
				echo "Termin konnte nicht publiziert werden!<BR>".chr(13).chr(10);
				echo mysqli_error($objDBCon).chr(13).chr(10);
				echo "<BR>Statement: " . $strSQL . "<BR>".chr(13).chr(10);
			}
			else
			{
				
				// ##########################################
				// UPDATE: Neues Objekt in Schreibtischliste:
				$strCurrentTable = "skk_deadline";
				$Autor = $curUser;
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
		  			echo "Vielen Dank f&uuml;r den neuen Termin!<BR><BR>".chr(13).chr(10);
					echo "Der Termin mit dem Titel <b>$Termin</b> ist jetzt online.<BR><BR>".chr(13).chr(10);
				
					include("_admin_ok_link.php");
				}
			}
		}
	}

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>


