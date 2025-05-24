<?php
	// #####################################################################
	// Konstruktur für das Hochladen einer Datei auf dem aktuellen Formular.
	if (isset($_FILES["file"]))
	{
		$strTMP = $_FILES["file"]["name"];
	
		if (trim($strTMP) != "")
		{
			if (is_file("../includes/files/upload.php"))
			{
				include("../includes/files/upload.php");
			}
			else
			{
				include("../../includes/files/upload.php");
			}
		}
		else
		{
			$file = "NULL";
		}
	}
	else
	{
		$file = "NULL";
	}
?>