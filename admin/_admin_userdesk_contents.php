<?php 
	// ####################################
	// Die ID des Schreibtisches ermitteln:
	$tmp = base64_decode($ux);
	$tmp = strrev($tmp);
	
	$strSQL = "SELECT * FROM skk_userdesks WHERE userid=".$tmp.";";
	$strDeskID = strGetValueFromTable($objDBCon, $strSQL, "id");
	
	// #####################################################
	// Die Objekt-ID des gerade erzeugten Objekts ermitteln:
	// Sofern wir gerade keinen Autor haben, wird der aktuelle Benutzer verwendet!
	if (!(isset($Autor)))
	{
		$Autor = $curUser;
	}
	
	$strSQL = "SELECT * FROM ".$strCurrentTable." WHERE creator='".$Autor."' AND createdate='".$now."' AND modifieddate IS NULL;";	
	$strCurrentObjectID = strGetValueFromTable($objDBCon, $strSQL, "id");
	
	// Konnte keine ID ermittelt werden?
	if (trim($strCurrentObjectID)=="NULL")
	{
		$strSQL = "SELECT MAX(ID) AS MAX_ID FROM ".$strCurrentTable." WHERE creator='".$Autor."' AND modifieddate IS NULL;";
		$strCurrentObjectID = strGetValueFromTable($objDBCon, $strSQL, "MAX_ID");
	}
	
	// Die Position auf dem Schreibtisch ermitteln:
	$strSQL = "SELECT MAX(userdesk_position) AS Res FROM skk_userdesks_contents WHERE id_userdesks=".$strDeskID.";";
	$strCurrentUserdesk_Position = strGetValueFromTable($objDBCon, $strSQL, "Res");
	$strCurrentUserdesk_Position = $strCurrentUserdesk_Position + 1;
	
	// Die Daten schreiben:
	$strSQL = "INSERT INTO skk_userdesks_contents (id_userdesks, objecttable, objectid, userdesk_position, creator, createdate) VALUES (".$strDeskID.", ";
	$strSQL = $strSQL. "'".$strCurrentTable."', ".$strCurrentObjectID.", ".$strCurrentUserdesk_Position.", '$Autor', '$now')";
	
?>