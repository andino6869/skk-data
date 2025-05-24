<?php include("../includes/forms/header.php")?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################
	
	// Datenbankverbindung aufbauen:
	$objDBCon = GetCon();
	
	// UPDATE Schneider 05.05.2008:
	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	writeNavigationBar(999, $objDBCon);
	// UPDATE Ende

	echo "<SPAN CLASS=he1>Partien</SPAN><BR><BR>";

	// Die Daten holen:

	$strSQL = "UPDATE skk_matches SET hits=".($Hits[0]+1).", votes=".($Stimmen+1).", ";
	$strSQL = $strSQL."marks=".($Bewertung_alt+$Bewertung)." WHERE id=".$ID." AND del='N' AND modifieddate IS NULL;";

	if (!mysqli_query ($objDBCon, $strSQL))
	{
		echo "<SPAN CLASS=he2>Herzlichen Dank für die Bewertung!</SPAN><BR><BR>";
		echo "Sie haben der Partie <b>$Bewertung von 10</b> möglichen Punkten gegeben.";
		echo "Damit hat die Partie jetzt insgesamt <b>";
		echo ($Stimmen+1);
		echo "</b> Bewertungen und einen Schnitt von <b>";
		echo number_format(($Bewertung_alt+$Bewertung)/($Stimmen+1),2);
		echo "</b> Punkten.<BR><BR>";
	}
	else
	{
		echo "Abfrage war NICHT erfolgreich!<BR>";
		echo mysqli_error($objDBCon)."<BR>";
		echo "Statement: ".$strSQL."<BR>";
		echo "<B>Ihre Daten wurden NICHT gespeichert!</B>";
	}


	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>";

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>



























