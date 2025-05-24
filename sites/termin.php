<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Termin");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// Die Datenbankverbindung herstellen:
	$objDBCon = GetCon();

	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	writeNavigationBar(999, $objDBCon);

	// Es macht nur Sinn, solche Termine anzuzeigen, die auch tatsächlich über einen
	// Inhalt verfügen!
	if (!(isset($ID_Event)))
	{
		$ID_Event = "";
	}

	if (trim($ID_Event)=='')
	{
		$ID_Event=$_REQUEST["ID_Event"];
	}

	if (trim($ID_Event)=='')
	{
		$ID_Event=$_GET["ID_Event"];
	}

	$strSQL="select * from skk_deadline WHERE ID=".$ID_Event." AND del='N' AND modifieddate IS NULL;";

	// Die Datenbanktabelle mit dem Termin auslesen:
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$ID[$i] = $row->id;
			$Datum[$i] = $row->deadlinedate;
			$Kategorie[$i] = $row->category;
			$Termin[$i] = $row->deadline;
			$Art[$i] = $row->kind;
			$i++;
		}
	}

	$founddatings = "FALSE";

	// Die ermittelten Inhalte durchgehen:
	for($i=0;$i<=2;$i++)
 	{
		// Gibt es zu dem aktuellen Termin einen Inhalt?
		if (isset($Termin[$i]))
		{
			if ($Termin[$i] != '')
			{
				// Es wurde ein brauchbarer Termin gefunden:
				$founddatings = "TRUE";
				echo "<B>Termin - ID in der Datenbank:</B><BR>$ID[$i]<BR><BR>".chr(13).chr(10);
				echo "<B>Datum:</B><BR>".substr($Datum[$i], 8, 2).".".substr($Datum[$i],5,2).".".substr($Datum[$i],0,4)."<BR><BR>".chr(13).chr(10);

				$strItem = $Termin[$i];
				$strItem = str_replace("\'", "'", $strItem);
				$strItem = str_replace("\\".chr(34), chr(34), $strItem);

				echo "<B>Beschreibung:</B><BR>".$strItem."<BR><BR>".chr(13).chr(10);
				echo "<B>Art des Termins (Mannschaftskampf, Monatsblitz, etc.):</B><BR>".formatoutput($Art[$i])."<BR><BR>".chr(13).chr(10);
				echo "<B>Kategorie / Zielgruppe:</B><BR>".formatoutput($Kategorie[$i])."<BR><BR>".chr(13).chr(10);
 			}
		}
 	}

 	// Wurde überhaupt etwas gefunden?
 	if ($founddatings == "FALSE")
 	{
 		// Ausgabe durchführen, dass derzeit keine Termine vorliegen!
		echo "<B>Fehler beim Ermitteln der Daten aus der Datenbank für die aktuelle ID $ID[$i]!!!</B><BR><BR>".chr(13).chr(10);
 	}
 	// UPDATE Ende.*/
 	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
 ?>


