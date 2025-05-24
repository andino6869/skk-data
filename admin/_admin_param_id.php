<?PHP
	if (!(isset($ID)))
	{
		$ID = "";
	}
	
	if (trim($ID) == "")
	{
	  $ID = $_REQUEST["ID"];
	}

	if (trim($ID) == "")
	{
	  $ID = $_GET["ID"];
	}
?>