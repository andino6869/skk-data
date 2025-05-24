<?php 
	// ############################
	// Das Standardbild vorbelegen:
	if (!(isset($currentImage)))
	{
		$currentImage= "critical.gif";
	}
	
	if ($currentImage=="")
	{
		$currentImage= "critical.gif";
	}

	// Die Position der Dateien kann anders lauten!
	if (is_file("../pics/admin/".$currentImage))
	{
		echo "<IMG SRC='../pics/admin/".$currentImage."' border=0>".chr(13).chr(10);
	}
	else
	{
		if (is_file("../../pics/admin/".$currentImage))
		{
			echo "<IMG SRC='../../pics/admin/".$currentImage."' border=0>".chr(13).chr(10);
		}
		else
		{
			echo "<IMG SRC='../../../pics/admin/".$currentImage."' border=0>".chr(13).chr(10);
		}
	}
?>