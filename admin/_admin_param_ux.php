<?PHP
	if (!(isset($ux)))
	{
		$ux = "";
	}
	 
	if (isset($_GET["ux"]))
	{
		$ux = $_GET["ux"];
	}
	
	if (trim($ux)=="")
	{
		if (isset($_REQUEST["ux"]))
		{
			$ux = $_REQUEST["ux"];
		}
	}
	
	$curUser = strGetCurrentUserByID($objDBCon, $ux);
?>