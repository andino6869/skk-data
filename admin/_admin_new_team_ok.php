<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neue Mannschaft hinzuf&uuml;gen - Check");
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
	
	$errText = "";

	// ######################
	// Mannschaft:
	$Mannschaft = strGetParam($objDBCon, "Mannschaft");
	
	if (trim($Mannschaft)=="")
	{
		$errText = $errText ."Das Feld 'Mannschaft' ist aktuell noch leer.";
	}
	$Mannschaft = mysqli_escape_string($objDBCon, $Mannschaft);

	// ######################
	// Liga:
	$Liga = strGetParam($objDBCon, "Liga");
	
	if (trim($Liga)=="")
	{
		$errText = $errText ."Das Feld 'Liga' ist aktuell noch leer.";
	}
	$Liga = mysqli_escape_string($objDBCon, $Liga);

	// ######################
	// Stammspieler:
	$numberofplayers = strGetParam($objDBCon, "numberofplayers");
	

	if (trim($numberofplayers)=="")
	{
		$errText = $errText ."Das Feld 'Anzahl Stammspieler' ist aktuell noch leer.";
	}
	$numberofplayers = mysqli_escape_string($objDBCon, $numberofplayers);

	// #########################
	// Die Überschrift ausgeben:
	$objectclassicon = "team.jpg";
	include("forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Neue Mannschaft erstellen (TEAM - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ######################
	// Gab es Fehler?
	if (trim($errText)!="")
	{
		include("_admin_eingabe_fehler.php");
	}
	else
	{
		$now = date("Y-m-d H:i");
		$curYear = substr($now,0,4);
		$nextYear = $curYear + 1;
		
		$strSQL = "insert into skk_teams (team, league, numberofplayers, season, creator, createdate, del) VALUES ";
		$strSQL = $strSQL."('$Mannschaft','$Liga',$numberofplayers, '".strval($curYear)."/".strval($nextYear)."','$curUser','$now','N')";
		
		if (!mysqli_query ($objDBCon, $strSQL))
		{
			$errText = $strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
			include("_admin_eingabe_fehler.php");
		}
		else
		{		
			// ##########################################
			// UPDATE: Neues Objekt in Schreibtischliste:
			$strCurrentTable = "skk_teams";
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
				echo "Die neue Mannschaft <b>$Mannschaft</b> ist jetzt gespeichert und online.<BR><BR>".chr(13).chr(10);
				include("_admin_ok_link.php");
			}
		}
	}

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux);

	include("../includes/forms/footer.php");
?>