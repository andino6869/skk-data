<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Partie l&ouml;schen - Check");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
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

	// ######################
	// Die ID:
	if (trim($ID)=="")
	{
		$ID=$_GET["ID"];
	}

	if (trim($ID)=="")
	{
		$ID=$_REQUEST["ID"];
	}

	// ######################
	$now = date("Y-m-d H:i:s");

	$strSQL = "UPDATE skk_matches SET del='J', modifieddate='$now', modifier='$curUser' WHERE ID=$ID AND del='N' AND ";
	$strSQL = $strSQL."modifieddate IS NULL;";

	echo "<SPAN CLASS=he1>Partie l&ouml;schen (MATCH - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	if (!mysql_query ($strSQL, $con))
	{

		echo "Partie konnte nicht gel&ouml;scht werden!<BR>".chr(13).chr(10);
		echo mysql_error().chr(13).chr(10);
		echo "<BR>Statement: " . $strSQL . "<BR>".chr(13).chr(10);
	}
	else
	{
  		echo "Die Partie wurde erfolgreich gel&ouml;scht.".chr(13).chr(10);
	}

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($ux);

	include("../includes/forms/footer.php");
?>





























