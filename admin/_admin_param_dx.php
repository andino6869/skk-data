<?PHP
	if (!(isset($dx)))
	{
		$dx = "";
	}
	
	if (isset($_GET["dx"]))
	{
		$dx = $_GET["dx"];
	}
	
	if (isset($_REQUEST["dx"]))
	{
		$dx = $_REQUEST["dx"];
	}

	if ($dx=="")
	{
		$dx=0;
	}
?>