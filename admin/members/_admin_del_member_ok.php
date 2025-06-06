<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Mitglied l&ouml;schen - Check");
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

	// 2.) In Abh�ngigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon, "FALSE");

	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("../_admin_param_ux.php");

	// ##############################################
	// 4.) Ist der aktuelle Login noch g�ltig?
	if (IsSessionValid($objDBCon, $ux, "A")==0)
	{
		// Keine G�ltigkeit mehr!
		include("../../includes/forms/middler.php");
		include("../forms/navigation_access_denied.php");
		include("../../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("../_admin_param_dx.php");

	// ######################
	// Die ID:
	$ID = strGetParam($objDBCon, "ID");

	// ######################
	$now = date("Y-m-d H:i:s");

	$strSQL = "UPDATE skk_members SET del='J', modifieddate='$now', modifier='$curUser' WHERE ID=$ID AND del='N' AND ";
	$strSQL = $strSQL."modifieddate IS NULL;";

	echo "<SPAN CLASS=he1>Mitglied l&ouml;schen (MEMBER - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	if (!mysql_query ($objDBCon, $strSQL))
	{

		echo "Das Mitglied konnte nicht gel&ouml;scht werden!<BR>".chr(13).chr(10);
		echo mysqli_error($objDBCon).chr(13).chr(10);
		echo "<BR>Statement: " . $strSQL . "<BR>".chr(13).chr(10);
	}
	else
	{
  		echo "Das Mitglied wurde erfolgreich gel&ouml;scht.".chr(13).chr(10);
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>






























