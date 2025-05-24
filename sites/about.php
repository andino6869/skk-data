<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Wir &uuml;ber uns");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/db/about_get.php")?>

<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################
	$objDBCon = GetCon();

	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	writeNavigationBar(1, $objDBCon);

	// Den Vorspann aus der Datenbank holen:
	get_about_get($objDBCon);

	echo "<B>Mannschaften:</B><BR><BR>".chr(13).chr(10);

	$rs = mysqli_query ($objDBCon, "select * from skk_teams WHERE del='N' AND modifieddate IS NULL ORDER BY team DESC");
	$RecordCount = mysqli_num_rows($rs);

	// Dynamische Ausgabe der Anzahl unserer Mannschaften:
	if ($RecordCount == 0)
	{
		echo "Wir nehmen zur Zeit mit keiner Mannschaft an den Mannschaftsk&auml;mpfen in Augsburg, ".chr(13).chr(10);
		echo "Schwaben und Bayern teil.<BR>".chr(13).chr(10);
	}
	else
	{
		if ($RecordCount == 1)
		{
			echo "Wir nehmen zur Zeit mit 1 Mannschaft an den Mannschaftsk&auml;mpfen in Augsburg, ".chr(13).chr(10);
		}
		else
		{
			echo "Wir nehmen zur Zeit mit ".$RecordCount." Mannschaften an den Mannschaftsk&auml;mpfen in Augsburg, ".chr(13).chr(10);
		}

		echo "Schwaben und Bayern teil. Dabei sind unsere Teams in folgenden Ligen aktiv:<BR>".chr(13).chr(10);
	}

	echo "<UL>";

	// Ausgabe aller Mannschaften inkl. ihrer Liga:
	if ($RecordCount > 0)
	{
		while ($row = $rs->fetch_object())
		{
			$ID = $row->id;
			$curTeam = formatoutput($row->team);
			$curLevel = formatoutput($row->league);
			echo "<LI><A HREF='team.php?ID=$ID'><U>$curTeam: $curLevel</U></LI><BR>".chr(13).chr(10);
		}
	}
	else
	{
		// echo "<LI><B>Es sind derzeit keine Mannschaften in der Datenbank hinterlegt.</B></LI>";
	}

	echo "</UL>".chr(13).chr(10);
?>
<!-- UPDATE Ende -->

<A HREF="../sites/journey.php"><IMG SRC="../pics/icons/pfeilrotaufgelb.gif" BORDER=0> Der Weg zum SK Kriegshaber - Anfahrtsskizze</A><BR>
<A HREF="../sites/history.php?hx=1"><IMG SRC="../pics/icons/pfeilrotaufgelb.gif" BORDER=0> Geschichte des Klubs</A><BR>
<BR><BR>
</DIV>

<?php
	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");
	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>";

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php")
?>