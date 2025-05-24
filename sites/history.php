<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Geschichte des SK Kriegshaber");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>

<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	writeNavigationBar(999, $objDBCon);

	// ##############################################
	// Den aktuellen Teil ermitteln:
	if (isset($_GET["hx"]))
	{
		$hx = $_GET["hx"];
	}
	else
	{
		$hx = $_REQUEST["hx"];
	}

	if ($hx=="")
	{
		$hx=1;
	}

	// ########################
	// Die Geschichte auslesen:
	$rs = mysqli_query($objDBCon, "SELECT text FROM skk_history WHERE del='N' AND part=".$hx." AND modifieddate IS NULL AND text IS NOT NULL;");
	$RecordCount = mysqli_num_rows($rs);

	$i = 0;
		
	while ($row = $rs->fetch_object())
	{
		$text[$i] = $row->text;
		echo formatoutput($text[$i]);
		$i++;
	}
	
	if ($hx > 1 )
	{
		$hxprev = $hx - 1;
		echo "<A HREF='../sites/history.php?hx=".$hxprev."'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> ";
		echo "Zur&uuml;ck zu Teil ".$hxprev." der Vereinsgeschichte</A><BR>";
	}

	// ###################################
	// Prüfen, ob es einen Folgepart gibt:
	$hx = $hx + 1;

	$rs = mysqli_query($objDBCon, "SELECT text FROM skk_history WHERE del='N' AND part=".$hx." AND modifieddate IS NULL AND text IS NOT NULL;");
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0 )
	{
		echo "<A HREF='../sites/history.php?hx=".$hx."'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> ";
		echo "Zu Teil ".$hx." der Vereinsgeschichte</A><BR>";
	}

	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>";

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>
























