<?PHP

	function strGetParam($objDBCon, $strParamName, $strUseSQLStringTag = "FALSE", $strDefaultValue = "")
	{
		// ########################################################################################
		// Ermittelt aus den übergebenen Parameter $strParamName den aktuellen Wert und gibt diesen
		// gegebenenfalls in vorformatierter Form wieder zurück. 
		// ########################################################################################
		$VarToStoreValue = "";
		
		if (isset($_GET[$strParamName]))
		{
			$VarToStoreValue=$_GET[$strParamName];
		}
		
		if (isset($_REQUEST[$strParamName]))
		{
			$VarToStoreValue=$_REQUEST[$strParamName];
		}
		
		$VarToStoreValue = mysqli_escape_string($objDBCon, $VarToStoreValue);
		
		if (trim($VarToStoreValue) == "" && trim($strDefaultValue) != "")
		{
			$VarToStoreValue = $strDefaultValue;
		}	
		else
		{
			if ($strUseSQLStringTag=="TRUE")
			{
				$VarToStoreValue = "'".$VarToStoreValue."'";
			}
		}
		return $VarToStoreValue;
	}
?>