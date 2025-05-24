<?php
	// #############################################################################################################
	// Prüfen, ob es für den aktuellen Benutzer bereits ein Schreibtischobjekt gibt und wenn nicht, dieses erzeugen:
	// ###################################
	// Modul-Update August 2019
	// ###################################

	$tmp = base64_decode($ux);
	$tmp = strrev($tmp);

	$strSQL = "SELECT * FROM skk_userdesks WHERE userid=".$tmp." AND modifieddate IS NULL;";
	
	if (bCheckRecordset($objDBCon, $strSQL)==0)
	{
		$now = date("Y-m-d H:i:s");
		$strSQL = "INSERT INTO skk_userdesks (skk_userdesks, userid, createdate, creator) VALUES ('Schreibtisch von ".$ulx." ".$ulx."', '".$tmp."', '".$now."', 'SYSTEM');";

		if (!(mysqli_query ($objDBCon, $strSQL)))
		{
			$errText = $strSQL."<BR>".mysql_error($objDBCon)."<BR>".chr(13).chr(10);
			include("_admin_eingabe_fehler.php");
		}			
	}
?>