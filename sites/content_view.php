<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Ansicht des Inhalts");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	$objDBCon = GetCon();

	// UPDATE Schneider 05.05.2008:
	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	writeNavigationBar(999, $objDBCon);
	// UPDATE Ende

	if (trim($Nr)=="")
	{
		$Nr = $_REQUEST["Nr"];
	}

	if (trim($Nr)=="")
	{
		$Nr = $_GET["Nr"];
	}

	$strSQL = "select * from skk_content WHERE ID=".$Nr." AND del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$Titel[$i] = $row->title;
			$Content[$i] = $row->content;
			$i++;
		}
		
		$strItem = $Titel[0];
		$strItem = str_replace("\'", "'", $strItem);
		$strItem = str_replace("\\".chr(34), chr(34), $strItem);

		echo "<SPAN CLASS=he1>".$strItem."</SPAN><BR><BR>".chr(13).chr(10);

		$strItem = $Content[0];
		$strItem = str_replace("\'", "'", $strItem);
		$strItem = str_replace("\\".chr(34), chr(34), $strItem);

		echo $strItem.chr(13).chr(10);
	}
	else
	{
		echo "Der hinterlegte Content konnte nicht in der Datenbank gefunden werden!<BR>".chr(13).chr(10);
	}


	echo "<BR><BR>".chr(13).chr(10);

	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>




















