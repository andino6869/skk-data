<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Termine");
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
	writeNavigationBar(4, $objDBCon);
	// UPDATE Ende


	// UPDATE Schneider 05.05.2008:
	// Es interessieren nur noch Termine der aktuellen Saison, die über einen Inhalt verfügen!
	// $q="select * from skk_termine WHERE Kategorie='Alle' AND Datum>'2006-10-31' AND Datum <'2006-12-01' ORDER BY Datum DESC";
	// Die Ansicht soll wie bei den News erfolgen:
	$Monat[12]="Dezember";
    $Monat[11]="November";
    $Monat[10]="Oktober";
    $Monat[9]="September";
    $Monat[8]="August";
    $Monat[7]="Juli";
    $Monat[6]="Juni";
    $Monat[5]="Mai";
    $Monat[4]="April";
    $Monat[3]="März";
    $Monat[2]="Februar";
    $Monat[1]="Januar";

	$now = date("Y-m-d");
	$curYear = substr($now,0,4);
	$curMonth = substr($now,5,2);

	// Neue Saison?
	if ($curMonth > 8)
	{
		$YearOne = $curYear;
		$YearTwo = $curYear + 1;
	}
	else
	{
		$YearOne = $curYear - 1;
		$YearTwo = $curYear;
	}

	echo "<SPAN CLASS=he1>Alle Termine aus der Saison ".$YearOne." / ".$YearTwo."</SPAN><BR><BR><BR><BR>".chr(13).chr(10);

	$strSQL  ="SELECT * FROM skk_deadline WHERE deadlinedate BETWEEN '".$YearOne."-09-01' ";
	$strSQL = $strSQL."AND '".$YearTwo."-09-01' AND ";
	$strSQL = $strSQL."deadline IS NOT NULL AND del='N' AND modifieddate IS NULL ORDER BY deadlinedate DESC";
	
	// ####################
	// Die Daten ermitteln:
	$rs = mysqli_query ($objDBCon, $strSQL);
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

	if ($RecordCount > 0)
	{
		// Für das aktuelle Datum den ersten Eintrag erstellen:
		echo "<SPAN CLASS='red_head'>".$Monat[(double)substr($Datum[0],5,2)]." ".substr($Datum[0],0,4)."</SPAN>".chr(13).chr(10);
    	echo "<HR noshade size=1 color=cc3300>".chr(13).chr(10);

    		// Die Daten ausgeben:
		for($i=0;$i<$num;$i++)
		{
			echo "<table border=0 width='100%'><tr><td width='15%' colspan=2>".chr(13).chr(10);

			echo "<a href='termin.php?ID_Event=".$ID[$i]."'>";

			$strItem = $Art[$i];
			$strItem = str_replace("\'", "'", $strItem);
			$strItem = str_replace("\\".chr(34), chr(34), $strItem);

			echo "<b>".$strItem."</b>".chr(13).chr(10);
		  	echo "</td></tr>".chr(13).chr(10);
		  	echo "<tr><td>[".substr($Datum[$i], 8, 2).".".substr($Datum[$i],5,2).".".substr($Datum[$i],0,4)."]".chr(13).chr(10);
		  	echo "</td><td width='85%'>".chr(13).chr(10);

		  	$strItem = $Termin[$i];
			$strItem = str_replace("\'", "'", $strItem);
			$strItem = str_replace("\\".chr(34), chr(34), $strItem);

		  	echo $strItem."</td></tr></table><BR>".chr(13).chr(10);

		  	if($i<$num-1)
		  	{
		   		if (substr($Datum[$i],5,2)!=substr($Datum[$i+1],5,2))
		   		{
		   			echo "<SPAN CLASS='red_head'>".$Monat[(double)substr($Datum[$i+1],5,2)]." ".substr($Datum[$i+1],0,4)."</SPAN>".chr(13).chr(10);
	    			echo "<HR noshade size=1 color=cc3300>".chr(13).chr(10);
		   		}
		   	}
		}
	}
	else
	{
		echo "Es befinden sich derzeit keine Datens&auml;tze in der Tabelle mit den Terminen.".chr(13).chr(10);
	}


	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");
	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php")
?>




