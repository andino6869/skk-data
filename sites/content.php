<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Turniere, Ergebnisse, Tabellen");
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
	writeNavigationBar(6, $objDBCon);
	// UPDATE Ende

    // UPDATE Schneider 05.05.2008:
    // Es reichen die Daten des letzten Jahres.
	$now = date("Y-m-d H:i:s");
	$curYear = substr($now,0,4);
	$curMonth = substr($now,5,2);

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


	echo "<SPAN CLASS=he1>Turniere, Ergebnisse, Tabellen ab 01.09.$curYear (sortiert nach Kategorie und Datum)</SPAN><BR><BR>".chr(13).chr(10);

	$strSQL = "select * from skk_content WHERE contentdate>'".(string)$curYear."-09-01' AND ";
	$strSQL = $strSQL."title IS NOT NULL AND title != ''AND del='N' AND modifieddate IS NULL ORDER BY category DESC, contentdate ASC";

	// UPDATE Ende
	$rs = mysqli_query($objDBCon, $strSQL);
 	$RecordCount = mysqli_num_rows($rs);

	// Konnten Datensätze gefunden werden?
	if ($RecordCount == 0)
	{
		echo "<BR><BR>Es sind aktuell keine Turnierdaten vorhanden!<BR>".chr(13).chr(10);
	}
	else
	{
		$i = 0;
		
		while ($row = $rs->fetch_object())
		{
			$ID[$i] = $row->id;
			$Datum[$i] = $row->contentdate;
			$Titel[$i] = $row->title;
			$Kategorie[$i] = $row->category;
			$Content[$i] = $row->content;
			
			$i++;
		}
		
		// Die Daten ausgeben:
		for($i=0;$i<$num;$i++)
		{
			// Beim ersten Eintrag muss immer eine Ausgabe erfolgen!
			if ($i==0)
			{
				if($Kategorie[$i]=="AFRO")
			  	{
			  		echo "<BR><BR><SPAN CLASS=red_head><IMG SRC='../pics/forms/afro.gif' border=0> Kategorie: AFRO - Turnier <IMG SRC='../pics/forms/afro.gif' border=0 width='15' height='15'></SPAN><BR><HR noshade size=1 color=cc3300>".chr(13).chr(10);
			  	}

			  	if($Kategorie[$i]=="Jugend")
			  	{
			  		echo "<BR><BR><SPAN CLASS=red_head><IMG SRC='../pics/icons/youth.gif' border=0> Kategorie: Jugendturniere <IMG SRC='../pics/icons/youth.gif' width='15' height='15' border=0></SPAN><BR><HR noshade size=1 color=cc3300>".chr(13).chr(10);
			  	}

			  	if($Kategorie[$i]=="Verband")
			  	{
			  		echo "<BR><BR><SPAN CLASS=red_head><IMG SRC='../pics/icons/content.jpg' width=15 border=0> Kategorie: Vereinsinterne Turniere <IMG SRC='../pics/icons/content.jpg' width=15 height='15' border=0></SPAN><BR><HR noshade size=1 color=cc3300>".chr(13).chr(10);
			  	}
			}
			else
			{
				if($i>0 && $Kategorie[$i]!=$Kategorie[$i-1] && $Kategorie[$i]=="AFRO")
			  	{
			  		echo "<BR><BR><SPAN CLASS=red_head><IMG SRC='../pics/forms/afro.gif' border=0> Kategorie: AFRO - Turnier <IMG SRC='../pics/forms/afro.gif' border=0></SPAN><BR><HR noshade size=1 color=cc3300>".chr(13).chr(10);
			  	}

			  	if($i>0 && $Kategorie[$i]!=$Kategorie[$i-1] && $Kategorie[$i]=="Jugend")
			  	{
			  		echo "<BR><BR><SPAN CLASS=red_head><IMG SRC='../pics/icons/youth.gif' border=0> Kategorie: Jugendturniere <IMG SRC='../pics/icons/youth.gif' border=0></SPAN><BR><HR noshade size=1 color=cc3300>".chr(13).chr(10);
			  	}

			  	if($i>0 && $Kategorie[$i]!=$Kategorie[$i-1] && ($Kategorie[$i]=="Verband" || $Kategorie[$i]=="Verein"))
			  	{
			  		echo "<BR><BR><SPAN CLASS=red_head><IMG SRC='../pics/icons/content.jpg' width=15 border=0> Kategorie: Vereins- und Verbandsturniere <IMG SRC='../pics/icons/content.jpg' width=15 border=0></SPAN><BR><HR noshade size=1 color=cc3300>".chr(13).chr(10);
			  	}
			}

		  	echo "<table border=0><tr><td width=500 valign=top>".chr(13).chr(10);
		  	echo "<a href='content_view.php?Nr=".$ID[$i]."'>".chr(13).chr(10);
		  	echo "<IMG SRC='../pics/icons/pfeilrotaufgelb.gif' border=0> &nbsp;".chr(13).chr(10);
		  	echo $Titel[$i]."</A><BR>&nbsp;&nbsp;&nbsp;&nbsp;[".substr($Datum[$i], 8, 2).".".substr($Datum[$i],5,2).".".substr($Datum[$i],0,4)."]".chr(13).chr(10);
		  	echo "</td></tr></table>".chr(13).chr(10);
		}
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





