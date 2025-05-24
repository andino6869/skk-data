<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################
	function get_comment_get($objDBCon, $strSQL)
	{
		// #####################################################
		// Liest den Inhalt der Turniertabelle in ein Array aus.
		// Haben wir eine Verbindung zur Datenbank?
		if ($objDBCon == "")
		{
			exit;
		}

		$rs = mysql_query($objDBCon, $strSQL);
		$RecordCount = mysql_numrows($rs);
		
		if ($RecordCount > 0)
		{
			$i = 0;
			
			while ($row = $rs->fetch_object())
			{
				$ID[$i] = $row->id;
				$Nr[$i] = $row->nr;
				$Datum[$i] = $row->createdate;
				$NameAntwort[$i] = $row->nameanswer;
				$Antwort[$i] = $row->answer;
				$i++;
			}
		}
	}
?>