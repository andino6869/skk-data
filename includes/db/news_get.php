<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################
	
	function get_news_get($objDBCon, $strSQL)
	// Liest die Inhalte der Termintabelle in ein Array aus.
	{
		// Haben wir eine Verbindung zur Datenbank?
		if ($objDBCon == "")
		{
			return "";
		}

		// Liest die monatsbezogenen Mitteilungen für die Startseite aus.
		// Angepasst auf die Stratoseite!
		$rs = mysqli_query($objDBCon, $strSQL);
 		$RecordCount = mysqli_num_rows($rs);
 		
 		if ($RecordCount > 0)
 		{
 			$i = 0;
		
 			while ($row = $rs->fetch_object())
 			{
 				$ID[$i] = $row->id;
 				$Datum[$i] = $row->newsdate;
 				$Kategorie[$i] = $row->category;
 				$Headline[$i] = $row->headline;
 				$Headline2[$i] = $row->headline2;
 				$Autor[$i] = $row->author;
 				$Kurztext[$i] = $row->shorttext;
 				$content[$i] = $row->contentid;
 				$teamid[$i] = $row->teamid;
 				$Text[$i] = $row->text;
 				$Tabelle[$i] = $row->newstable;
 				$Hits[$i] = $row->hits;
 				
 				$i++;	
 			}
		}
		else
		{
			return "";
		}
	}
?>