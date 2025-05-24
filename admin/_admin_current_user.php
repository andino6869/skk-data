<?php
	// ######################
	// Benutzervorname:
	if (trim($userfirstname)=="")
	{
		$userfirstname=$_GET["userfirstname"];
	}

	if (trim($userfirstname)=="")
	{
		$userfirstname=$_REQUEST["userfirstname"];
	}

	// Benutzernachname:
	if (trim($userlastname)=="")
	{
		$userlastname=$_GET["userlastname"];
	}

	if (trim($userlastname)=="")
	{
		$userlastname=$_REQUEST["userlastname"];
	}
?>