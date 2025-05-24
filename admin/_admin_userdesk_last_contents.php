<?php include_once ("../includes/string/str.php")?>	
<?php 
	
	// #####################################################################
	// Die zehn zuletzt neu erzeugten Objekte auf dem Schreibtisch ausgeben:
	// ###################################
	// Modul-Update August 2019
	// ###################################
	$strSQL = "SELECT * FROM skk_userdesks WHERE userid=".$tmp.";";
	$strDeskID = strGetValueFromTable($objDBCon, $strSQL, "id");
	
	// ############################
	// UPDATE: Dubletten entfernen:
	$strSQL = "SELECT * FROM skk_userdesks_contents WHERE id_userdesks=".$strDeskID." AND del='N' ORDER BY UNIX_TIMESTAMP('createdate') DESC;";
	
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);
	
	$prevID = 0;
	$curID = 0;
	$nrak = 0;
	
	for ($i=0; $i<$RecordCount; $i++)
	{
		$row = $rs->fetch_object();
				
		$curID = $row->objectid;
		$curcreatedate = $row->createdate;
		
		if ($curID == $prevID)
		{
			$now = date("Y-m-d H:i:s");
			$strSQL = "UPDATE skk_userdesks_contents SET modifieddate='$now', modifier='SYSTEM' WHERE id_userdesks=".$strDeskID." AND objectid=$curID AND createdate='$curcreatedate'";
			
			if (!mysqli_query ($objDBCon, $strSQL))
			{
				echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
				echo "<b>Die aktuelle Tabelle konnte leider aus folgenden Gründen nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
				echo $strSQL."<BR>".chr(13).chr(10);
				echo mysql_error($objDBCon)."<BR>".chr(13).chr(10);
			}
		}
		
		$prevID = $curID;
	}	
	// UPDATE Ende
	// ###########
	
	$strSQL = "SELECT * FROM skk_userdesks_contents WHERE id_userdesks=".$strDeskID." AND modifieddate IS NULL AND del='N' ORDER BY createdate DESC;";
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);
	
	for ($i=0; $i<$RecordCount && $i<10; $i++)
	{
		$row = $rs->fetch_object();
		$id_userdesks[$i] = $row->id_userdesks;
		$objecttable[$i] = $row->objecttable;
		$objectid[$i] = $row->objectid;
		$createdate[$i] = $row->createdate;	
	}
		
	if ($RecordCount > 0)
	{	
		// ###############################
		// Die Schreibtischliste ausgeben:
		$bHeaderDeskDeskWritten= "FALSE";
		
		for ($i=0; $i<$RecordCount && $i<10; $i++)
		{
			// ###################################################
			// Die Daten aus der dazugehörigen objektklasse lesen:
			$strSQL = "select * from skk_objectclasses where objectclasstable='$objecttable[$i]' AND del='N' AND modifieddate IS NULL;";

			$rsObj = mysqli_query($objDBCon, $strSQL);
			$RecordCountObj = mysqli_num_rows($rsObj);
			
			$rowObj = $rsObj->fetch_object();
			$objectclassshownname = $rowObj->objectclassshownname;
			$objectclassicon =  $rowObj->objectclassicon;
			$objectclasseditform =  $rowObj->objectclasseditform;
			$colsinseekform =  $rowObj->colsinseekform;

			// ######################################################################
			// Prüfen, ob das Zielobjekt zwischenzeitlich nicht  gelöscht worden ist:
			$strSQL = "select * from ".$objecttable[$i]." WHERE id=".$objectid[$i]." AND del='N' AND modifieddate IS NULL;";
			
			if (bCheckRecordset($objDBCon, $strSQL)==1)
			{
				// #############################################
				// Den Tabellenheader beim ersten Mal schreiben:
				if ($bHeaderDeskDeskWritten == "FALSE")
				{
					echo "<SPAN CLASS=he1>Ihre zehn zuletzt neu erzeugten Objekte</SPAN><BR><BR>".chr(13).chr(10);
					
					echo "<TABLE border='1' width='100%' bgcolor='#C0C0C0'>".chr(13).chr(10);
					echo "<TR>";
					echo "<TD width='60%'>Objekt</TD>";
					echo "<TD width='20%'>Typ</TD>";
					echo "<TD width='10%'>Erzeugt am</TD>";
					echo "</TR>".chr(13).chr(10);
					
					$bHeaderDeskDeskWritten= "TRUE";
				}
				
				// ###############################
				// Je Datensatz ein Form aufbauen:
				echo "<TR bgcolor='#FFFFFF'><TD width='60%'><form method='POST' action='".$objectclasseditform."?Nr=".$objectid[$i]."'>".chr(13).chr(10);
				
				// Die aktuellen Benutzerdaten sichern:
				echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
				echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);
				echo "<INPUT TYPE='HIDDEN' NAME='Nr' Value='$objectid[$i]'>".chr(13).chr(10);
				echo "<input type='submit' value='Objekt bearbeiten' name='B".$i."'> ".chr(13).chr(10);
				
				// #################################
				// Die Objektklassengrafik ausgeben:
				include("forms/objectclassicon.php");
				
				// #########################
				// Den Objektnamen ausgeben:
				$strSQL = "select ".$colsinseekform." from ".$objecttable[$i]." where id='$objectid[$i]' AND del='N' AND modifieddate IS NULL;";
				
				$rsObj = mysqli_query($objDBCon, $strSQL);
				$RecordCountObj = mysqli_num_rows($rsObj);
				
				// Die betroffenen Felder ermitteln:
				$arrFields = explode(",", $colsinseekform);
				$max = sizeof($arrFields);
								
				// #################################################################
				// Die jeweiligen Feldinhalte als Objektnamen in der Liste ausgeben:
				$rowObj = $rsObj->fetch_assoc();
				
				for ($j=0; $j<$max; $j++)
				{					
					$strTmp = $rowObj[$arrFields[$j]];
					echo formatoutput($strTmp);
				
					if ($j<($max-1))
					{
						echo " - ";
					}
				}
				
				echo "</form></TD>";
					
				// ##########################
				// Die Objektklasse ausgeben:
				echo "<TD width='20%'>".$objectclassshownname."</TD>";
	
				// ##########################
				// Das Erzeugedatum ausgeben:
				echo "<TD width='20%'>".substr($createdate[$i],8,2).".".substr($createdate[$i],5,2).".".substr($createdate[$i],0,4)." ".substr($createdate[$i],11,8)."</TD>";
				echo "</TR>".chr(13).chr(10);
			}
		}
		
		echo "</TABLE>".chr(13).chr(10);
	}

?>