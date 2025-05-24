<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Termine");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/db/deadlines_get.php");?>
<?php include("../includes/date/date.php")?>
<?php include("../includes/string/str.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// Die Daten ermitteln:
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
   	$Monat[3]="M&auml;rz";
   	$Monat[2]="Februar";
   	$Monat[1]="Januar";

	$now = date("Y-m-d H:i:s");
	
	$curYear = substr($now,0,4);
	$curMonth = substr($now,5,2);
	$curDay = substr($now,8,2);

	// In welchem Monat stehen wir gerade?
	if ($curMonth > 8)
	{
		// Es hat im aktuellen Jahr die neue Saison begonnen:
	}
	else
	{
		// Wir brauchen auch das Vorjahr!
		$curYear = $curYear - 1;
	}

	// ###########################################
	// Welcher Zeithorizont soll abgefragt werden?
	if (!(isset($UseFuture)))
	{
		$UseFuture = "";
	}
	
	if (trim($UseFuture) == "")
	{
		$UseFuture = $_REQUEST["UseFuture"];
	}

	if (trim($UseFuture) == "")
	{
		$UseFuture = $_GET["UseFuture"];
	}

	if (trim($UseFuture) == "")
	{
		$UseFuture = "FALSE";
	}

	// #############################
	// Den Startzeitpunkt ermitteln:
	$nextYear = $curYear + 1;
	
	if ($UseFuture == "FALSE")
	{
		echo "<SPAN CLASS=he1>Alle Termine aus der Saison ".(string)$curYear." / ".$nextYear."</SPAN><BR><BR><BR><BR>".chr(13).chr(10);
		$strSQL = "select MIN(deadlinedate) from skk_deadline WHERE (category='Alle' OR category='Erwachsene' OR category='Jugend' OR category='100-Jahre-Feier') AND deadlinedate>='".(string)$curYear."-09-01' AND ";		
	}
	else 
	{
		echo "<SPAN CLASS=he1>Alle Termine aus der Saison ".(string)$curYear." / ".$nextYear." ab heute</SPAN><BR><BR><BR><BR>".chr(13).chr(10);
		$strSQL = "select MIN(deadlinedate) from skk_deadline WHERE (category='Alle' OR category='Erwachsene' OR category='Jugend' OR category='100-Jahre-Feier') AND deadlinedate>='".substr($now,0,4)."-".$curMonth."-".$curDay."' AND ";
	}
	
	$strSQL = $strSQL."deadline IS NOT NULL AND del='N' AND modifieddate IS NULL ORDER BY deadlinedate DESC";

	// ################################
	// Die Daten abfragen und ausgeben:
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);
	
	// Wurde ein Datensatz gefunden?
	if ($RecordCount > 0)
	{
		$row = $rs->fetch_row();
		$curDate = $row[0];
	}
	else
	{
		$curDate = "";
	}

	if (($RecordCount == 0) || ($curDate == ""))
	{
		echo "Es sind derzeit keine Eintr&auml;ge in der Termintabelle hinterlegt, die j&uuml;nger als ".$curDay.".".$curMonth.".".$curYear." sind.<BR>".chr(13).chr(10);
	}
	else
	{
		$curMonth = substr($curDate,5,2);

		// Das Zieldatum ermitteln:
		$strSQL = "select MAX(deadlinedate) from skk_deadline WHERE (category='Alle' OR category='Erwachsene' OR category='Jugend' OR category='100-Jahre-Feier') AND deadlinedate>'".(string)$curYear."-09-01' AND ";
		$strSQL = $strSQL."deadline IS NOT NULL AND del='N' AND modifieddate IS NULL ORDER BY deadlinedate DESC";
		
		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

		$row = $rs->fetch_row();
		$maxDate = $row[0];

		// Für das aktuelle Datum den ersten Eintrag erstellen:
		echo "<SPAN CLASS='red_head'>".$Monat[(double)substr($curDate,5,2)]." ".substr($curDate,0,4)."</SPAN>".chr(13).chr(10);
    	echo "<HR noshade size=1 color='#5B2E00'>".chr(13).chr(10);
    	
		// Die Feiertagstabelle für das aktuelle Jahr ermitteln:
		$arrHolidays = getHolidayTable($objDBCon, substr($curDate,0,4));
		
		// Von dem Minimaldatum aus jeden Datumwert prüfen,
		// ob es einen Termin gibt:
		while ($curDate <= $maxDate)
		{
			// Feld zurücksetzen:
			$strDeadline = "";

			// Für das aktuelle Datum die Inhalte einsammeln:
			$strSQL = "select * from skk_deadline WHERE (category='Alle' OR category='Erwachsene' OR category='Jugend' OR category='100-Jahre-Feier') AND deadlinedate='".$curDate."' AND ";
			$strSQL = $strSQL."deadline IS NOT NULL AND del='N' AND modifieddate IS NULL ORDER BY kind ASC;";

			$rs = mysqli_query($objDBCon, $strSQL);
			$RecordCount = mysqli_num_rows($rs);

			if ($RecordCount > 0)
			{
				// ######################################
				// Alle Termine an diesem Tag einsammeln:
				$i = 0;
				
				while ($row = $rs->fetch_object())
				{
					$Kategorie[$i] = $row->category;
					$Termin[$i] = $row->deadline;
					$Art[$i] = $row->kind;
					$id[$i] = $row->id;
					
					// #####################################
					// UPDATE 12.09.2023:
					// Neu, jetzt auch als Link mit angeben:
					$strDeadline = $strDeadline."<SPAN CLASS=sm>".chr(13).chr(10);
					$strDeadline = $strDeadline."<A HREF='termin.php?ID_Event=".$id[$i]."'>";
					
					// Welches Icon soll ausgeben werden?
					if (strtolower($Kategorie[$i])=="jugend")
					{
						$strDeadline = $strDeadline."<IMG SRC='../pics/icons/youth.gif' height='10' width='15'>".chr(13).chr(10);
					}
					else
					{
					    if (strtolower($Kategorie[$i])=="100-jahre-feier")
					    {					        
					      $strDeadline = $strDeadline."<IMG SRC='../pics/icons/100.gif' height='10' width='15'>".chr(13).chr(10);
					    }
					    else
					    {
						  $strDeadline = $strDeadline."<IMG SRC='../pics/icons/thunder.gif' height='10' width='15'>".chr(13).chr(10);
					    }
					}

					$strItem = trim(strReplaceHTMLTAGS($objDBCon, $Art[$i]));
					$strDeadline = $strDeadline.$strItem;
					
					// Escape - Zeichen entfernen:
					$strItem = strReplaceHTMLTAGS($objDBCon, $Termin[$i]);
					$strItem = str_replace("\'", "'", $strItem);
					$strItem = str_replace("\\".chr(34), chr(34), $strItem);
										
					$strDeadline = strReplaceCodePageChrs($strDeadline)."</A></SPAN><BR>".strReplaceCodePageChrs($strItem);
					// UPDATE Ende
					// ###########
					
					if ($i < $RecordCount -1)
					{
						$strDeadline = $strDeadline."<BR><BR>";
					}
					
					$i++;
				}
			}

			// ########################
			// Den Wochentag ermitteln:
			$year = substr($curDate,0,4);
			$month = substr($curDate,5,2);
			$day = substr($curDate, 8, 2);

			$tstamp=mktime(0,0,0,$month,$day,$year);
		    $Tdate = getdate($tstamp);
		    $wday = $Tdate["wday"];

			// zwischen 0 (für Sonntag) und 6 (für Sonnabend)
 			switch($wday)
    			{
        		case 0;
        			$wday ="So.";
		    	    break;
		    	case 1;
        			$wday ="Mo.";
		    	    break;
		    	case 2;
        			$wday ="Di.";
		    	    break;
		    	case 3;
        			$wday ="Mi.";
		    	    break;
		    	case 4;
        			$wday ="Do.";
		    	    break;
		    	case 5;
        			$wday ="Fr.";
		    	    break;
		    	case 6;
        			$wday ="Sa.";
		    	    break;
    			}

			// ############################
			// Liegt ein Monatswechsel vor?
			if ($curMonth != substr($curDate,5,2))
			{
				echo "<BR><BR><SPAN CLASS='red_head'>".$Monat[(double)substr($curDate,5,2)]." ".substr($curDate,0,4)."</SPAN>".chr(13).chr(10);
	    		echo "<HR noshade size=1 color='#5B2E00'>".chr(13).chr(10);
	    		$curMonth = substr($curDate,5,2);
			}

			// ############################
			// Brauchen wir die Feiertagstabelle für das nächste Jahr?
			if ($curYear != substr($curDate,0,4))
			{
				// Die Feiertagstabelle für das aktuelle Jahr ermitteln:
				$arrHolidays = getHolidayTable($objDBCon, substr($curDate,0,4));
			}

			// ############################
			// Prüfen, ob der aktuelle Tag ein Feiertag ist:
			$bIsHoliday = "FALSE";

			for ($i=0; $i<sizeof($arrHolidays); $i++)
			{
				// Kommt das aktuelle Datum in dem Feiertagseintrag vor?
				$pos = strpos($arrHolidays[$i], $curDate);

				if (!($pos === false))
				{
					// Eintrag gefunden!
					$bIsHoliday = "TRUE";

					// Den Namen des Feiertags mit ausgeben:
					list ($holidaydate, $holidayname) = explode('  ', $arrHolidays[$i]);

					if (trim($strDeadline)=="")
					{
						$strDeadline = "<I>".$holidayname."</I>";
					}
					else
					{
						$strDeadline = "<I>".$holidayname."</I><BR><BR>".$strDeadline;
					}

					break;
				}
			}

			// ############################
			// Die Ausgabe des Tages:
			if (trim($strDeadline==""))
			{
				$strDeadline = "";
			}

			if ((strtolower($wday)=="sa.") || (strtolower($wday)=="so."))
			{
				echo "<table border=1 width='100%' bgcolor='#C0C0C0'>".chr(13).chr(10);

				if (strtolower($wday)=="so.")
				{
					echo "<tr><td width='5%'><font color='#CC3300'><B>".$wday."</B></font></td><td width='10%'>".substr($curDate,8,2).".".substr($curDate,5,2).".".substr($curDate,0,4);
				}
				else
				{
					echo "<tr><td width='5%'><B>".$wday."</B></td><td width='10%'>".substr($curDate,8,2).".".substr($curDate,5,2).".".substr($curDate,0,4);
				}
			}
			else
			{
				// Feiertag?
				if ($bIsHoliday == "TRUE")
				{
					echo "<table border=1 width='100%' bgcolor='#C0C0C0'>".chr(13).chr(10);
					echo "<tr><td width='5%'><font color='#CC3300'><B>".$wday."</B></font></td><td width='10%'>".substr($curDate,8,2).".".substr($curDate,5,2).".".substr($curDate,0,4);
				}
				else
				{
					echo "<table border=1 width='100%' bgcolor='#FFFFFF'>".chr(13).chr(10);
					echo "<tr><td width='5%'>".$wday."</td><td width='10%'>".substr($curDate,8,2).".".substr($curDate,5,2).".".substr($curDate,0,4);
				}
			}

			echo "</td><td width='80%'>".$strDeadline."</td></tr></table>".chr(13).chr(10);

			// Das nächste Datum berechnen:
			$rs = mysqli_query ($objDBCon, "SELECT DATE_ADD('".$curDate."', INTERVAL 1 DAY)");
			$RecordCount = mysqli_num_rows($rs);

			// Wurden Datensätze gefunden?
			if ($RecordCount == 0)
			{
				break;
			}

			$row = $rs->fetch_row();
			$curDate = $row[0];
			
			if ($wday == "So.")
			{
			    echo "<BR>".chr(13).chr(10);
			}
		}
	}

	// Hier dann keinen Ausblick auf anstehende Termine machen!
	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>






