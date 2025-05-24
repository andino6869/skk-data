<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################

	function writeTeam($objDBCon, $curTeamID)
	{
	 	// UPDATE Schneider 08.05.2008:
	 	// Dynamisch die Werte aus der Datenbank lesen:
		// Haben wir eine Verbindung zur Datenbank?
		if ($objDBCon == "")
		{
			exit;
		}

		$strSQL = "select * from skk_teams WHERE del='N' AND modifieddate IS NULL ORDER BY team DESC";
		$rs = mysqli_query($objDBCon, $strSQL);
 		$RecordCount = mysqli_num_rows($rs);
 		
 		if ($RecordCount > 0)
 		{
 			// Ausgabe aller Mannschaften inkl. ihrer Liga:
 			$i = 0;
 			
 			echo "<TR><TD width='33%'  bgcolor='#C0C0C0'>Mannschaft (sortiert nach Mannschaftsnamen):</TD>";
 			echo "<TD width='66%'><SELECT NAME=team style='width:100%'>";
 			
 			// Leeren Eintrag erzeugen:
 			echo "<OPTION VALUE='0'>";
 			
 			while ($row = $rs->fetch_object())
 			{
 				$curTeam = $row->team;
 				$id = $row->id;
 				
 				if ($curTeamID==$id)
 				{
 					echo "<OPTION VALUE='$id' SELECTED>".$curTeam."</OPTION>";
 				}
 				else
 				{
 					echo "<OPTION VALUE='$id'>".$curTeam."</OPTION>";
 				}
 				
 				$i++;
 			}
 		
		  	echo "</TD>";
		}
		else
		{
			echo "<TR><TD width='33%'  bgcolor='#C0C0C0'>Hinweis:</TD><TD width='66%'><B>Es sind derzeit keine Mannschaften in der Datenbank hinterlegt.</B></TD>";
		}
		echo "</TR>";
	}
?>