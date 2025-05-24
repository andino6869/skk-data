<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################
	
	function get_events_get($objDBCon, $strSQL)
	// Liest die Inhalte der Termintabelle in ein Array aus.
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
  			$row = $rs->fetch_object()
  			$text = $row->text;
  			
   			echo $text;
  		}
	}
?>