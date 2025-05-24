<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################
	function get_deadlines_get($objDBCon, $strSQL)
	// Liest die Inhalte der Termintabelle in ein Array aus.
	{
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
  				$Datum[$i] = $row->deadlinedate;
  				$Kategorie[$i] = $row->category;
  				$Termin[$i] = $row->deadline;
  				$Art[$i] = $row->kind;
  				$i++;
  			}
  		}
	}
?>