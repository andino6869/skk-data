<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Galerie löschen - Check");
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
	if (IsSessionValid($objDBCon, $ux, "R")==0)
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
	$errText = "";

	// ######################
	// Die aktuelle ID:
	$ID = strGetParam($objDBCon, "ID");

	// ####################################################################################
	// 6.) Die Anzahl der Bilder ermitteln:
	// Prüfen, ob Bilder bereits hinterlegt worden sind:
	$strSQL = "select * from skk_galery_pics WHERE id_galery=".$ID." AND del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Sind bereits Bilder vorhanden?
	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			// Den Namen des bisherigen Bildes ermitteln:
			$picture[$i] = $row->picture;

			// Gibt es ein Bild, das gelöscht werden kann?
			if (is_file("../../pics/galery/".$picture[$i]))
			{
				unlink("../../pics/galery/".$picture[$i]);
			}

			// UPDATE in der Datenbank:
			$now = date("Y-m-d H:i:s");

			$strSQL = "UPDATE skk_galery_pics SET del='N', modifieddate='".$now."', modifier='".$curUser."' ";
			$strSQL = $strSQL." WHERE id_galery=".$ID." AND picture='".$picture[$i]."' AND del='N' AND modifieddate IS NULL;";

			if (!mysql_query ($objDBCon, $strSQL))
			{
				$errText = $errText.mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
			}
			$i++;
		}
	}

	// ######################
	$now = date("Y-m-d H:i");

	$strSQL = "UPDATE skk_galery SET del='J', modifieddate='$now', modifier='$curUser' WHERE ID=$ID AND del='N' AND ";
	$strSQL = $strSQL."modifieddate IS NULL;";

	// #############################
	$objectclassicon = "galery.gif";
	include("../forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Fotogalerie l&ouml;schen (GALERY - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	if (!mysqli_query ($objDBCon, $strSQL) || trim($errText)!="")
	{
		echo "Galerie konnte nicht gel&ouml;scht werden!<BR>".chr(13).chr(10);
		echo mysqli_error($objDBCon).chr(13).chr(10);
		echo "<BR>Statement: " . $strSQL . "<BR>".chr(13).chr(10);
	}
	else
	{
  		echo "Die Galerie wurde erfolgreich gel&ouml;scht.<BR><BR>".chr(13).chr(10);
  		include("../_admin_ok_link.php");
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>
















