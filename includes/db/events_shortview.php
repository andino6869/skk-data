<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################

	include("../includes/db/event_get.php");


	function get_events_shortview($objDBCon)
	{
		echo "<font color=cc3300><b>Terminvorschau</B></font><HR noshade size=1>";
		// UPDATE Schneider 05.05.2008:
		// Es macht nur Sinn, solche Termine anzuzeigen, die auch tatsächlich über einen
		// Inhalt verfügen! Ferner soll der Auszug nicht zu groß werden, daher nur auf
		// einen Monat in die Zukunft beschränken.
		$curMonth = substr(date("Y-m-t"),5,2);
		$curYear = substr(date("Y-m-t"),0,4);

		if ($curMonth == "12")
		{
			$curMonth = 1;
			$curYear = $curYear + 1;
		}
		else
		{
			$curMonth=$curMonth + 1;

			// Benötigen wir eine führende 0?
			if (strlen($curMonth)==1)
			{
				$curMonth="0".$curMonth;
			}
		}

		$strSQL = "select * from skk_deadline WHERE (deadlinedate >'".date("Y-m-d")."' AND deadlinedate<'".$curYear."-".$curMonth."-31') AND deadline IS NOT NULL AND del='N' AND modifieddate IS NULL ORDER BY deadlinedate DESC";

		// Die Datenbanktabelle mit den Terminen auslesen:
		get_events_get($objDBCon, $strSQL);

		$founddatings = "FALSE";

		// Die ermittelten Inhalte durchgehen:
		for($i=0;$i<=2;$i++)
	 	{
			// Gibt es zu dem aktuellen Termin einen Inhalt?
			if ($Termin[$i] != '')
			{
				// Es wurde ein brauchbarer Termin gefunden:
				$founddatings = "TRUE";

		  		echo "<table border=0 cellspacing=0 cellpadding=0><tr><td>";
		  		echo "<a STYLE='font-size:7pt;color:#cc3300;font-weight:normal;' href='termin.php?ID_Event=".$ID[$i]."'>".$Art[$i];
		  		echo " (".substr($Datum[$i], 8, 2).".".substr($Datum[$i],5,2).".".substr($Datum[$i],0,4).")</A>";
		  		// UPDATE Schneider: Termin wird künftig aus Platzgründen
		  		// nicht mehr mit ausgegeben!
		  		echo "</td><tr><td><SPAN CLASS=sm>";
		  		echo "</SPAN>";
		  		echo "</td></tr></table><BR>";
	 		}
	 	}

	 	// Wurde überhaupt etwas gefunden?
	 	if ($founddatings == "FALSE")
	 	{
	 		// Ausgabe durchführen, dass derzeit keine Termine vorliegen!
			echo "<table border=0 cellspacing=0 cellpadding=0><tr><td>";
		  	echo "<a STYLE='font-size:7pt;color:#cc3300;font-weight:normal;'>Es liegen derzeit keine Termine vor!</A>";
		  	echo "</td><tr><td><SPAN CLASS=sm>";
		  	echo "</SPAN>";
		  	echo "</td></tr></table><BR>";
	 	}
	 	// UPDATE Ende.
		echo "<A HREF='../sites/events.php'> &nbsp; <IMG SRC='../pics/icons/pfeilrotaufgelb.gif' border=0> Weitere Termine</A>";
	}
?>