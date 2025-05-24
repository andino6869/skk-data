<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################
	
	function get_deadlines_shortview($objDBCon)
	{
		echo "<SPAN CLASS='red_head'>".chr(13).chr(10);
		echo "Terminvorschau:<HR noshade size=1>".chr(13).chr(10);
		echo "</SPAN>".chr(13).chr(10);
		// UPDATE Schneider 05.05.2008:
		// Es macht nur Sinn, solche Termine anzuzeigen, die auch tatsächlich über einen
		// Inhalt verfügen! Ferner soll der Auszug nicht zu groß werden, daher nur auf
		// einen Monat in die Zukunft beschränken.


		// ###########################################
		$rs = mysqli_query ($objDBCon, "SELECT DATE_ADD(now(), INTERVAL 1 MONTH)");
		$RecordCount = mysqli_num_rows($rs);

		// Wurden Datensätze gefunden?
		if ($RecordCount > 0)
		{
			// Das Temporärdatum ermitteln:
			$rs->data_seek(0);
			$row = $rs->fetch_row();
			$tmpDate = $row[0];
		}
		
		// ##################################################################################################
		// Achtung, kein Zeitstempel, da ansonsten die Termine des heutigen Tages nicht mit angezeigt werden.
		$now = date("Y-m-d");

		$strSQL = "select * from skk_deadline WHERE (deadlinedate >='".$now."' AND ";
		$strSQL = $strSQL."deadlinedate<'".$tmpDate."') AND deadline IS NOT NULL AND del='N' ";
		$strSQL = $strSQL."AND modifieddate IS NULL ORDER BY deadlinedate ASC, kind ASC;";

		// ###############################################
		// Die Datenbanktabelle mit den Terminen auslesen:
		$rs = mysqli_query($objDBCon, $strSQL);
 		$RecordCount = mysqli_num_rows($rs);
 		 		
 		if ($RecordCount > 0)
 		{
 			$i = 0;
 			
 			while ($row = $rs->fetch_object())
 			{
 				$ID[$i] = $row->id;
 				$Termin[$i] = $row->deadline;
 				$Kategorie[$i] = $row->category;
 				$Datum[$i] = $row->deadlinedate;
 				$Art[$i] = $row->kind;
 				$i++;
 			}
 		}

		$founddatings = "FALSE";

		// ###################################
		// Die ermittelten Inhalte durchgehen:
		for($i=0;$i<=3;$i++)
	 	{
			// Gibt es zu dem aktuellen Termin einen Inhalt?
			if (isset($Termin[$i]))
			{
				if ($Termin[$i] != '')
				{
					// Es wurde ein brauchbarer Termin gefunden:
					$founddatings = "TRUE";
				
					// ########################
					// Den Wochentag ermitteln:
					$year = substr($Datum[$i],0,4);
					$month = substr($Datum[$i],5,2);
					$day = substr($Datum[$i], 8, 2);
				
					$tstamp=mktime(0,0,0,$month,$day,$year);
					$Tdate = getdate($tstamp);
					$wday = $Tdate["wday"];
				
					// zwischen 0 (für Sonntag) und 6 (für Sonnabend)
					switch($wday)
					{
						case 0;
							$wday ="Sonntag";
							break;
						case 1;
							$wday ="Montag";
							break;
						case 2;
							$wday ="Dienstag";
							break;
						case 3;
							$wday ="Mittwoch";
							break;
						case 4;
							$wday ="Donnerstag";
							break;
						case 5;
							$wday ="Freitag";
							break;
						case 6;
							$wday ="Samstag";
							break;
					}
				
					echo "<table border=0 width='100%' cellspacing=0 cellpadding=0><tr><td>".chr(13).chr(10);
					echo "<SPAN CLASS=sm>".chr(13).chr(10);
					echo "<A HREF='termin.php?ID_Event=".$ID[$i]."'><IMG SRC='../pics/icons/deadline.gif' border=0 width=12 heigth=12>".chr(13).chr(10);
					
					$Art[$i] = str_replace("ä", "&auml;", $Art[$i]);
					$Art[$i] = str_replace("Ä", "&Auml;", $Art[$i]);
					$Art[$i] = str_replace("ö", "&ouml;", $Art[$i]);
					$Art[$i] = str_replace("Ö", "&Ouml;", $Art[$i]);
					$Art[$i] = str_replace("ü", "&uuml;", $Art[$i]);
					$Art[$i] = str_replace("Ü", "&Uuml;", $Art[$i]);
					$Art[$i] = str_replace("ß", "&szlig;", $Art[$i]);
					
					echo $Art[$i];
					echo " am ".$wday.", ".substr($Datum[$i], 8, 2).".".substr($Datum[$i],5,2).".".substr($Datum[$i],0,4)."</A>".chr(13).chr(10);
					echo "</SPAN>".chr(13).chr(10);
				
				
					// UPDATE Schneider: Termin wird künftig aus Platzgründen
					// nicht mehr mit ausgegeben!
					echo "</td><tr><td><SPAN CLASS=sm>";
					echo "</SPAN>";
					echo "</td></tr></table><BR>".chr(13).chr(10);
				}
			}
	 	}

	 	// Wurde überhaupt etwas gefunden?
	 	if ($founddatings == "FALSE")
	 	{
	 		// Ausgabe durchführen, dass derzeit keine Termine vorliegen!
			echo "<table border=0 cellspacing=0 cellpadding=0><tr><td>".chr(13).chr(10);
			echo "<SPAN CLASS=sm>".chr(13).chr(10);
		  	echo "<a>Es liegen derzeit keine Termine vor!</A>".chr(13).chr(10);
			echo "</SPAN>".chr(13).chr(10);
		  	echo "</td><tr><td><SPAN CLASS=sm>".chr(13).chr(10);
		  	echo "</SPAN>".chr(13).chr(10);
		  	echo "</td></tr></table><BR>".chr(13).chr(10);
	 	}
	 	// UPDATE Ende.
	 	echo "<SPAN CLASS=sm>".chr(13).chr(10);
		echo "<A HREF='../sites/deadlines.php?UseFuture=FALSE'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' border=0> Alle Saisontermine</A><BR><BR>".chr(13).chr(10);
		echo "<A HREF='../sites/deadlines.php?UseFuture=TRUE'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' border=0> K&uuml;nftige Termine</A>".chr(13).chr(10);
		echo "</SPAN>".chr(13).chr(10);
	}
?>