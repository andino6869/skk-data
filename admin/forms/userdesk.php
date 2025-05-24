<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	$id = base64_decode($ux);
	$id = strrev($id);
	
	$strSQL = "SELECT * FROM skk_userdesks WHERE del='N' AND userid=".$id.";";
	
	if (bCheckRecordset($objDBCon, $strSQL)==0)
	{
		// ##############################################
		// Es muss ein neuer Schreibtisch erzeugt werden:
		$curUser = strGetCurrentUserByID($objDBCon, $ux);
		$now = date("Y-m-d H:i:s");
			
		$strSQL = "INSERT INTO skk_userdesks (skk_userdesks, userid, creator, createdate, del) VALUES ('Schreibtisch $curUser', $id, '$curUser', '$now', 'N');";
			
		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo "<font color='#FF0000' size=4><BR><b>Fehler beim Erzeugen des Schreibtischobjekts</b><BR><BR></font>".chr(13).chr(10);
			echo "<b>Die aktuelle &Auml;nderung konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
			echo $strSQL."<BR>".chr(13).chr(10);
			echo mysql_error($objDBCon)."<BR>".chr(13).chr(10);
		}
	}
?>