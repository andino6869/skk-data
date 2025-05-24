<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################

	function get_matches_get($objDBCon, $strSQL)
	// Liest die Inhalte der Partietabelle in ein Array aus.
	{
		// Haben wir eine Verbindung zur Datenbank?
		if ($objDBCon == "")
		{
			exit;
		}

		$rs = mysqli_query($objDBCon, $strSQL);
 		$RecordCount = mysqli_num_rows($rs);
 		
 		if ($RecordCount > 0)
 		{
 			$i = 0;
 			
 			while ($row = $rs->fetch_object())
 			{
 				$ID[$i] = $row->id;
 				$Datum[$i] = $row->matchdate;
 				$Titel[$i] = $row->title;
 				$Aufstellung[$i] = $row->nomination;
 				$Partiedaten[$i] = $row->matchdata;
 				$Zuege[$i] = $row->moves;
 				$Kurztext[$i] = $row->shorttext;
 				$Hits[$i] = $row->hits;
 				$Bewertung[$i] = $row->marks;
 				$Stimmen[$i] = $row->votes;
 				$i++;
 			}
 		}
	}
?>