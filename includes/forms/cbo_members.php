<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################
	include("../includes/string/str.php");

	function FillCBOWithMembers($objDBCon, $strCBOName, $strIDDefault)
	{
		// ############################################
	 	// UPDATE Schneider 08.05.2008:
	 	// Dynamisch die Werte aus der Datenbank lesen:

		// ###########################
	 	// 1.) Gibt es diesen Spieler?
		$strSQL = "SELECT * FROM skk_members WHERE del='N' AND modifieddate IS NULL ORDER BY name ASC, vorname ASC;";

		$rs = mysqli_query($objDBCon, $strSQL);
 		$RecordCount = mysqli_num_rows($rs);

		// Erstellen der Combobox:
		echo "<SELECT NAME='".$strCBOName."' style='width:100%'>".chr(13).chr(10);

		// Ausgabe der Mitglieder in einer Combobox:
		if ($RecordCount > 0)
		{
			// Freihalteposition
			echo "<OPTION Value=''>", "".chr(13).chr(10);

			// Die Daten in ein Array lesen:
			$i = 0;
				
			while ($row = $rs->fetch_object())
			{
				// Daten aus Ergebnis holen:
				$ID[$i] = $row->id;
				$Name[$i] = formatoutput($row->name);
				$Vorname[$i] = formatoutput($row->vorname);
				
				if ($ID[$i] == $strIDDefault)
				{
					echo "<OPTION Value='",$ID[$i],"' SELECTED>", $Name[$i]." ".$Vorname[$i]."</OPTION>".chr(13).chr(10);
				}
				else
				{
					echo "<OPTION Value='",$ID[$i],"'>", $Name[$i]." ".$Vorname[$i]."</OPTION>".chr(13).chr(10);
				}
				
				$i++;
			}
		}
		else
		{
			echo "<OPTION SELECTED>Keine Datensätze gefunden!</OPTION>".chr(13).chr(10);
	  	}
	  	echo "</SELECT>".chr(13).chr(10);
	}
?>


