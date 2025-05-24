<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neues Vereinslokal eintragen - Check");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/date/date.php")?>
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

	// ##############################################
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
	$year = strGetParam($objDBCon, "year");
	$year="'".mysqli_escape_string($objDBCon, $year)."'";

	// #########################
	// Die Überschrift ausgeben:
	$objectclassicon = "locals.png";
	include("../forms/objectclassicon.php");
	
	echo "<SPAN CLASS=he1>Neues Vereinslokal speichern (LOCALS - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##################
	// 2.) Gab es Fehler?
	if (trim($errText)!="")
	{
		include("../_admin_eingabe_fehler.php");
	}
	else
	{
		// Wurden diese Daten bereits gespeichert?
		$strSQL = "SELECT id FROM skk_locals WHERE year=$year ";
		$strSQL = $strSQL." AND del='N' AND modifieddate IS NULL;";

		if (bCheckRecordset($objDBCon, $strSQL)==1)
		{			
			$errText = "Die Daten f&uuml;r das Jahr $year sind bereits in der Datenbank gespeichert!";
			include("../_admin_eingabe_fehler.php");
		}
		else
		{
		  	$now = date("Y-m-d H:i:s");

			// Achtung, optionale Felder m&uuml;ssen ohne Anf&uuml;hrungszeichen stehen!
			$strSQL = "insert into skk_locals (year, local, creator, createdate, del) VALUES ";
			$strSQL = $strSQL."($year, '$skklocal', '$curUser', '$now', 'N')";

			if (!mysqli_query ($objDBCon, $strSQL))
			{
				
				$errText = "Das neue Vereinslokal konnte nicht gespeichert werden!<BR>".$strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
				include("../_admin_eingabe_fehler.php");
			}
			else
			{
				// ##########################################
				// UPDATE: Neues Objekt in Schreibtischliste:
				$strCurrentTable = "skk_locals";
				
				include("../_admin_userdesk_contents.php");
				// UPDATE ENDE
				// ###########
				
				if (!mysqli_query ($objDBCon, $strSQL))
				{
					$errText = $strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
					include("../_admin_eingabe_fehler.php");
				}
				else
				{
					echo "Vielen Dank f&uuml;r die neue Datenerfassung!<BR>".chr(13).chr(10);
					echo "Das neue Vereinslokal wurden erfolgreich gespeichert.<BR><BR>".chr(13).chr(10);
				
					include("../_admin_ok_link.php");
				}
			}
		}
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>









