<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################
	function get_content_get($objDBCon, $strSQL)
	{
		// Liest den Inhalt der Turniertabelle in ein Array aus.
		// Haben wir eine Verbindung zur Datenbank?
		if ($objDBCon == "")
		{
			exit;
		}

		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

		// Wurden Datensätze gefunden?
		if ($RecordCount > 0)
		{
			$i = 0;
			
			while ($row = $rs->fetch_object())
			{
				$ID[$i] = $row->id;
				$Datum[$i] = $row->contentdate;
				$Titel[$i] = $row->title;
				$Kategorie[$i] = $row->category;
				$Content[$i] = $row->content;
				$i++;
			}
		}
	}


	function writeContent($objDBCon, $strDefaultTitle)
	{
		// ########################################
		// Haben wir eine Verbindung zur Datenbank?
		if ($objDBCon == "")
		{
			exit;
		}

		$strSQL = "select * from skk_content WHERE title IS NOT NULL AND title != '' AND del='N' AND ";
		$strSQL = $strSQL."modifieddate IS NULL ORDER BY title DESC";
		
	 	$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

		if ($RecordCount > 0)
		{
			echo "<tr>";
			echo "<TD width='33%'  bgcolor='#C0C0C0'>Tabelle einf&uuml;gen (sortiert nach Titel):</td>";
			echo "<td width='66%'>";
			echo "<SELECT NAME=Content style='width:100%'>";

			// Leeren Eintrag erzeugen:
			echo "<OPTION VALUE='0'>";

		 	$i = 0;
			
			while ($row = $rs->fetch_object())
			{
				$Titel[$i] = $row->title;
				$ID[$i] = $row->id;
				
				echo "<OPTION VALUE='$ID[$i]'>".$Titel[$i];
				$i++;
			}
			
			echo "</SELECT>";
			echo "</td>";
	 		echo "<TR>";
		}
		else
		{
			echo "<tr>";
			echo "<TD width='33%' bgcolor='#C0C0C0'>Hinweis:</td>";
			echo "<td width='66%'><B>Es sind derzeit keine Tabellen / Contentinhalte in der Datenbank hinterlegt.</B>";
			echo "</td>";
	 		echo "<TR>";
		}
	}
?>






