<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Termin bearbeiten - Check");
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

	// #######################
	// Die Inhalte überprüfen:
	$errText="";

	// #######################
	// Kategorie:
	$Kategorie = strGetParam($objDBCon, "Kategorie");

	if (trim($Kategorie)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Kategorie.<BR>";
	}
	$Kategorie = mysqli_escape_string($objDBCon, $Kategorie);

	// #######################
	// Termin:
	$Termin = strGetParam($objDBCon, "Termin");

	if (trim($Termin)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Termin.<BR>";
	}
	$Termin = mysqli_escape_string($objDBCon, $Termin);


	// #######################
	// Art:
	$Art = strGetParam($objDBCon, "Art");

	if (trim($Art)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Art.<BR>";
	}
	$Art = mysqli_escape_string($objDBCon, $Art);


	// ######################
	$ID = strGetParam($objDBCon, "ID");
	
	// ######################
	// Der Tag:
	$deadlinedate_day = strGetParam($objDBCon, "deadlinedate_day");
	
	// Der Monat:
	$deadlinedate_month = strGetParam($objDBCon, "deadlinedate_month");
	
	// Das Jahr:
	$deadlinedate_year = strGetParam($objDBCon, "deadlinedate_year");

	// Ein gültiges Datum?
	$bCheckdate = checkdate($deadlinedate_month, $deadlinedate_day, $deadlinedate_year);

	if ( !$bCheckdate )
	{
		$errText = $errText."Das eingegebene Datum ist nicht korrekt.<BR>";
	}

 	$deadlinedate = $deadlinedate_year.".".$deadlinedate_month.".".$deadlinedate_day;

 	// ##################
 	// Ausgabe des Icons:
 	$objectclassicon = "deadline.gif";
 	include("forms/objectclassicon.php");
 	echo "<SPAN CLASS=he1>Termin bearbeiten (DEADLINE - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);
 	
	// ######################
	// Gab es Fehler?
	if (trim($errText)!="")
	{
		include("_admin_eingabe_fehler.php");
	}
	else
	{
		// Die Änderungen durchf&uuml;hren:
		$now = date("Y-m-d H:i:s");

		// Der UPDATE:
		$strSQL = "UPDATE skk_deadline SET modifieddate='$now', modifier='$curUser' WHERE id=$ID AND del='N' ";
		$strSQL = $strSQL."AND modifieddate IS NULL;";

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			$errText = $strSQL."<BR>".mysql_error($objDBCon)."<BR>".chr(13).chr(10);
			include("_admin_eingabe_fehler.php");
		}

		// DER INSERT:
		$strSQL="INSERT INTO skk_deadline (id, deadline, deadlinedate, category, kind, creator, createdate, del) VALUES (";
		$strSQL=$strSQL."$ID, '$Termin', '$deadlinedate', '$Kategorie', '$Art', '$curUser', '$now', 'N');";

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			$errText = $strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
			include("_admin_eingabe_fehler.php");
		}
		else
		{
			echo "Vielen Dank!<BR><BR>".chr(13).chr(10);
			echo "Der Termin mit dem Titel <b>$Termin</b> ist jetzt ge&auml;ndert und wieder online.<BR><BR>".chr(13).chr(10);
			
			include("_admin_ok_link.php");
		}
	}

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>

