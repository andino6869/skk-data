<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Vorst&auml;nde und Vereinslokale");
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

	// UPDATE Schneider 05.05.2008:
	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	writeNavigationBar(999, $objDBCon);
	// UPDATE Ende


	echo "<SPAN CLASS=he1>Vorst&auml;nde des SK Kriegshaber</SPAN><BR><BR>".chr(13).chr(10);


	// #####################
	// Die Vorstandsdaten:
	$strSQL = "select * from skk_heads WHERE del='N' AND modifieddate IS NULL ORDER BY year DESC;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Dynamische Ausgabe der Vorstände:
	if ($RecordCount > 0)
	{
		// Die Überschrift ausgeben:
		echo "<table cellspacing=0 cellpadding=3 border=1 width='100%'>".chr(13).chr(10);
		echo "<TR bgcolor=dddddd>".chr(13).chr(10);
		echo "<TD valign=top width=50><B>Jahr</B></TD>".chr(13).chr(10);
		echo "<TD valign=top><B>1.Vorstand</B></TD>".chr(13).chr(10);
		echo "<TD valign=top><B>2.Vorstand</B></TD>".chr(13).chr(10);
		echo "<TD valign=top><B>Kassier</B></TD>".chr(13).chr(10);
		echo "<TD valign=top><B>Spielleiter</B></TD>".chr(13).chr(10);
		echo "<TD valign=top><B>Materialwart</B></TD>".chr(13).chr(10);
		echo "<TD valign=top><B>Schriftf&uuml;hrer</B></TD>".chr(13).chr(10);
		echo "<TD valign=top><B>Jugendleiter</B></TD>".chr(13).chr(10);
		echo "</TR>".chr(13).chr(10);

		// Alle Personen ausgeben:
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$year[$i] = $row->year;
			$firsthead[$i] = formatoutput($row->firsthead);
			$secondhead[$i] = formatoutput($row->secondhead);
			$cashier[$i] = formatoutput($row->cashier);
			$gameleader[$i]= formatoutput($row->gameleader);
			$stuffhead[$i]= formatoutput($row->stuffhead);
			$writehead[$i]= formatoutput($row->writehead);
			$youthhead[$i]= formatoutput($row->youthhead);
			
			// Die Daten in der Tabelle ausgeben:
			echo "<TR bgcolor=eeeeee>".chr(13).chr(10);
			echo "<TD valign=top>$year[$i]</TD>".chr(13).chr(10);

			if (trim($firsthead[$i])=="")
			{
				echo "<TD valign=top>&nbsp;</TD>".chr(13).chr(10);
			}
			else
			{
				echo "<TD valign=top>$firsthead[$i]</TD>".chr(13).chr(10);
			}

			if (trim($secondhead[$i])=="")
			{
				echo "<TD valign=top>&nbsp;</TD>".chr(13).chr(10);
			}
			else
			{
				echo "<TD valign=top>$secondhead[$i]</TD>".chr(13).chr(10);
			}

			if (trim($cashier[$i])=="")
			{
				echo "<TD valign=top>&nbsp;</TD>".chr(13).chr(10);
			}
			else
			{
				echo "<TD valign=top>$cashier[$i]</TD>".chr(13).chr(10);
			}

			if (trim($gameleader[$i])=="")
			{
				echo "<TD valign=top>&nbsp;</TD>".chr(13).chr(10);
			}
			else
			{
				echo "<TD valign=top>$gameleader[$i]</TD>".chr(13).chr(10);
			}

			if (trim($stuffhead[$i])=="")
			{
				echo "<TD valign=top>&nbsp;</TD>".chr(13).chr(10);
			}
			else
			{
				echo "<TD valign=top>$stuffhead[$i]</TD>".chr(13).chr(10);
			}

			if (trim($writehead[$i])=="")
			{
				echo "<TD valign=top>&nbsp;</TD>".chr(13).chr(10);
			}
			else
			{
				echo "<TD valign=top>$writehead[$i]</TD>".chr(13).chr(10);
			}

			if (trim($youthhead[$i])=="")
			{
				echo "<TD valign=top>&nbsp;</TD>".chr(13).chr(10);
			}
			else
			{
				echo "<TD valign=top>$youthhead[$i]</TD>".chr(13).chr(10);
			}

			echo "</TR>".chr(13).chr(10);
			
			$i++;
		}

		echo "</table>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
	}
	else
	{
		echo "<BR>Es sind derzeit keine Vorstandsdaten hinterlegt worden. <BR><BR>".chr(13).chr(10);
	}


	// #####################
	// Die Spiellokale:
	echo "<SPAN CLASS=he1>Spiellokale des SK Kriegshaber</SPAN><BR><BR>".chr(13).chr(10);

	$strSQL = "select * from skk_locals WHERE del='N' AND modifieddate IS NULL ORDER BY year DESC;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Dynamische Ausgabe der Vorstände:
	if ($RecordCount > 0)
	{
		// Die Überschrift ausgeben:
		echo "<table cellspacing=0 cellpadding=3 border=1 width='100%'>".chr(13).chr(10);
		echo "<TR bgcolor=dddddd>".chr(13).chr(10);
		echo "<TD valign=top width=50><B>Jahr</B></TD>".chr(13).chr(10);
		echo "<TD valign=top width='85%'><B>Spiellokal</B></TD>".chr(13).chr(10);
		echo "</TR>".chr(13).chr(10);

		// Alle Mannschaften ausgeben:
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$year[$i] = $row->year;
			$local[$i] = formatoutput($row->local);

			// Die Daten in der Tabelle ausgeben:
			echo "<TR bgcolor=eeeeee>".chr(13).chr(10);
			echo "<TD valign=top>$year[$i]</TD>".chr(13).chr(10);

			if (trim($local[$i])=="")
			{
				echo "<TD valign=top>&nbsp;</TD>".chr(13).chr(10);
			}
			else
			{
				echo "<TD valign=top>$local[$i]</TD>".chr(13).chr(10);
			}

			echo "</TR>".chr(13).chr(10);
			$i++;
		}

		echo "</table>".chr(13).chr(10);
		echo "<BR>".chr(13).chr(10);
	}
	else
	{
		echo "<BR>Es sind derzeit keine Spiellokalsdaten hinterlegt worden. <BR>".chr(13).chr(10);
	}

	include("../includes/forms/footer.php");
?>

























