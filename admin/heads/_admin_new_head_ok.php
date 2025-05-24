<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neue Vorstandsdaten eintragen - Check");
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
	// 1.) 1. Vorstand:
	$firsthead = strGetParam($objDBCon, "firsthead");

	if (trim($firsthead)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld 1. Vorstand.<BR>";
	}
	
	$firsthead = mysqli_real_escape_string ($objDBCon, $firsthead);
	
	// ######################
	// 2. Vorstand:
	$secondhead = strGetParam($objDBCon, "secondhead");

	if (trim($secondhead)=="")
	{
		$secondhead = "NULL";
	}
	else
	{
		$secondhead = "'".mysqli_real_escape_string ($objDBCon, $secondhead)."'";
	}

	// #############
	// Kassierer:
	$cashier = strGetParam($objDBCon, "cashier");

	if (trim($cashier)=="")
	{
		$cashier = "NULL";
	}
	else
	{
		$cashier = "'".mysqli_real_escape_string ($objDBCon, $cashier)."'";
	}


	// #############
	// Spielleiter:
	$gameleader = strGetParam($objDBCon, "gameleader");
	
	if (trim($gameleader)=="")
	{
		$gameleader = "NULL";
	}
	else
	{
		$gameleader="'".mysqli_real_escape_string ($objDBCon, $gameleader)."'";
	}


	// #############
	// Materialwart:
	$stuffhead = strGetParam($objDBCon, "stuffhead");

	if (trim($stuffhead)=="")
	{
		$stuffhead = "NULL";
	}
	else
	{
		$stuffhead="'".mysqli_real_escape_string ($objDBCon, $stuffhead)."'";
	}


	// #############
	// Schriftführer:
	$writehead = strGetParam($objDBCon, "writehead");
	
	if (trim($writehead)=="")
	{
		$writehead = "NULL";
	}
	else
	{
		$writehead="'".mysqli_real_escape_string ($objDBCon, $writehead)."'";
	}


	// #############
	// Jugendleiter:
	$youthhead = strGetParam($objDBCon, "youthhead");
	
	if (trim($youthhead)=="")
	{
		$youthhead = "NULL";
	}
	else
	{
		$youthhead="'".mysqli_real_escape_string ($objDBCon, $youthhead)."'";
	}

	// #############
	// Das Jahr:
	$year = strGetParam($objDBCon, "year");
	$year="'".mysqli_real_escape_string ($objDBCon, $year)."'";

	
	// #########################
	// Die Überschrift ausgeben:
	$objectclassicon = "heads.png";
	include("../forms/objectclassicon.php");
	
	echo "<SPAN CLASS=he1>Neue Vorstandsdaten speichern (HEADS - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);
	
	// ##################
	// 2.) Gab es Fehler?
	if (trim($errText)!="")
	{
		include("../_admin_eingabe_fehler.php");
	}
	else
	{
		// Wurden diese Daten bereits gespeichert?
		$strSQL = "SELECT id FROM skk_heads WHERE year=$year ";
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
			$strSQL = "insert into skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, ";
			$strSQL = $strSQL."writehead, youthhead, creator, createdate, del) VALUES ";
			$strSQL = $strSQL."($year, '$firsthead', $secondhead, $cashier, $gameleader, $stuffhead, ";
			$strSQL = $strSQL."$writehead, $youthhead, '$curUser', '$now', 'N')";

			if (!mysqli_query ($objDBCon, $strSQL))
			{			
				$errText = "Neue Vorstandsdaten konnten nicht gespeichert werden!<BR>".$strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
				include("../_admin_eingabe_fehler.php");
			}
			else
			{	  		
		  		// ##########################################
		  		// UPDATE: Neues Objekt in Schreibtischliste:
		  		$strCurrentTable = "skk_heads";
		  		
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
		  			echo "Die neuen Vorstandsdaten wurden erfolgreich gespeichert.<BR><BR>".chr(13).chr(10);
		  			 
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









