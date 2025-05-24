<?php
    require_once 'calendar.php';

	echo calendar();

    echo "<form method='POST'>";

	if ($date == "")
	{
		$date=$_REQUEST["date"];
	}

	if ($date == "")
	{
		$date=$_GET["date"];
	}

  	echo "<input type='text' name='T1' size='20' value='".$date."'>";
	echo "</form>";

?>