<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################
	include_once '../includes/string/str.php';

	function get_about_get($objDBCon)
	// Gibt den Inhalt der Linktabelle aus.
	{
		// ########################################
		// Haben wir eine Verbindung zur Datenbank?
		if ($objDBCon =="")
		{
			exit;
		}
		// ##############################################################
		// Liest die monatsbezogenen Mitteilungen für die Startseite aus.
		// Angepasst auf die Stratoseite!
		$rs = mysqli_query($objDBCon, "SELECT text FROM skk_about WHERE del='N' AND modifieddate IS NULL AND text IS NOT NULL;");
		$RecordCount = mysqli_num_rows($rs);

		if ($RecordCount > 0)
		{
			$i = 0;
			
			while ($row = $rs->fetch_object())
			{
				$text[$i] = $row->text;
				$strEntry = formatoutput($text[$i]);
				echo $strEntry;
				$i++;
			}
		}
	}
?>