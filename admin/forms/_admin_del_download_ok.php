<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Download l&ouml;schen - Check");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php
	// 1.) Das Verbindungsobjekt ermitteln:
	$con = GetCon();

	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $con, "FALSE");


	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("../_admin_param_ux.php");


	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($con, $ux, "H")==0)
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

	// Den Dateinamen ermitteln:
	$strSQL = "SELECT filename FROM skk_downloads WHERE ID=$ID AND del='N' AND ";
	$strSQL = $strSQL."modifieddate IS NULL;";

	$result = mysql_query($strSQL);
	$num = mysql_numrows($result);

	// Konnten Datensätz ermittelt werden:
	if ($num>0)
	{
	  	$file = mysql_result($result,$nrak,"filename");
	}

	// UPDATE durchführen:
	$strSQL = "UPDATE skk_downloads SET del='J', modifieddate='$now', modifier='$curUser' WHERE ID=$ID AND del='N' AND ";
	$strSQL = $strSQL."modifieddate IS NULL;";

	$objectclassicon = "download.jpg";
	include("../forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Download l&ouml;schen (DOWNLOAD - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	if (!mysql_query ($strSQL, $con))
	{

		echo "Download konnte nicht gel&ouml;scht werden!<BR>".chr(13).chr(10);
		echo mysql_error().chr(13).chr(10);
		echo "<BR>Statement: ".$strSQL."<BR>".chr(13).chr(10);
	}
	else
	{
		// Die Datei löschen:
		$file = "../../downloads/".$file;
		if(is_file("$file"))
		{
			unlink("$file");
		}

  		echo "Der Download wurde erfolgreich gel&ouml;scht.<BR><BR>".chr(13).chr(10);
  		include("../_admin_ok_link.php");
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($ux, $dx);

	include("../../includes/forms/footer.php");
?>






























