<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################
	function get_links_get($objDBCon)
	// Gibt den Inhalt der Linktabelle aus.
	{
		// Haben wir eine Verbindung zur Datenbank?
		if ($objDBCon == "")
		{
			exit;
		}
		// Liest die monatsbezogenen Mitteilungen für die Startseite aus.
		// Angepasst auf die Stratoseite!
		$rs = mysqli_query($objDBCon, "SELECT text FROM skk_links WHERE del='N' AND modifieddate IS NULL AND text IS NOT NULL;");
		$RecordCount = mysqli_num_rows($rs);

		if ($RecordCount > 0)
		{
			$i = 0;
				
			while ($row = $rs->fetch_object())
			{
				$text[$i] = $row->text;
				//$text[$i] = str_replace(chr(61).chr(92).chr(34), chr(61).chr(34), $text[$i]);
				//$text[$i] = str_replace(chr(92).chr(34).chr(32), chr(34).chr(32), $text[$i]);
				
				echo formatoutput($text[$i]);
				
				$i++;
			}
		}
	}
?>