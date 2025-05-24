<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Jugend");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>
<?php include("../includes/db/youth_get.php")?>

<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// UPDATE Schneider 05.05.2008:
	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	writeNavigationBar(2, $objDBCon);
	// UPDATE Ende


	// UPDATE Schneider 05.05.2008:
	// Es reichen die Daten von einer kompletten Saison.
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

	$strSQL = "select * from skk_news WHERE category='Jugend' AND newsdate>'".(string)$curYear."-09-01' AND modifieddate IS NULL AND ";
	$strSQL = $strSQL."del='N'  AND (fadeifdeadlinereached = 'N' OR (fadeifdeadlinereached != 'N' AND deadlinedate>'$now')) ORDER BY newsdate ASC";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	echo "<SPAN CLASS=he1>Jugendschach</SPAN><BR><BR>".chr(13).chr(10);

	echo "<IMG SRC='../pics/icons/pfeilrotaufgelb.gif'>".chr(13).chr(10);
	echo "<a href='#News'>News & Meldungen aus dem Jugendbereich</a><BR><BR>";

	// Den Inhalt der Jugenseite ausgeben:
	get_youth_get($objDBCon);

	echo "<a name='News'></a>";
	echo "<BR><BR><SPAN CLASS=he1>News und Aktuelles aus dem Jugendbereich (absteigend sortiert nach Datum)</SPAN><BR><BR>".chr(13).chr(10);

	// ###################
	// Die Daten ausgeben:
	$counter = 0;

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$ID[$i] = $row->id;
			$Datum[$i] = $row->newsdate;
			$Kategorie[$i] = $row->category;
			$Headline[$i] = $row->headline;
			$Headline2[$i] = $row->headline2;
			$Autor[$i] = $row->author;
			$Kurztext[$i] = $row->shorttext;
			$Contentid[$i] = $row->contentid;
			$Text[$i] = $row->text;
			$Tabelle[$i] = $row->newstable;
			$Hits[$i] = $row->hits;
			$creator[$i] = $row->creator;
			$createdate[$i] = $row->createdate;
			
			$i++;
		}

		// ########################
		// Es wurde Daten gefunden.
		for($i=0; $i<$RecordCount; $i++)
		{
	  		echo "<table border=0><tr><td width='100%' valign=top>";

	  		$strItem = $Headline[$i];
			$strItem = str_replace("\'", "'", $strItem);
			$strItem = str_replace("\\".chr(34), chr(34), $strItem);

	  		echo "<a href='message.php?Nr=".$ID[$i]."'>".$strItem."</A>".chr(13).chr(10);
	  		echo "<BR>".chr(13).chr(10);
	  		echo "<IMG SRC='../pics/forms/youth.gif' height='15' width='15'>".chr(13).chr(10);
	  		echo " [".substr($Datum[$i], 8, 2).".".substr($Datum[$i],5,2).".".substr($Datum[$i],0,4)."]".chr(13).chr(10);

	  		$strItem = formatoutput($Autor[$i]);

	  		echo "<I> von ".$strItem."</I>".chr(13).chr(10);

		    // Gab es zwischenzeitlich eine Änderung an der Meldung durch eine
		    // andere Person?
		    if (strtolower(trim($Autor[$i])) != strtolower(trim($creator[$i])))
		    {
		    	// Stammt diese Änderung von der Altdatenübernahme???
		    	if (strtoupper(trim($creator[$i])) != "ALTDATENÜBERNAHME PROWIDE")
		    	{
		    		echo "<I>, zuletzt ge&auml;ndert von ".$creator[$i]." am ";
		    		echo substr($createdate[$i], 8, 2).".".substr($createdate[$i],5,2).".".substr($createdate[$i],0,4)."</I>".chr(13).chr(10);
		    	}
			}

	  		$strItem = formatoutput($Kurztext[$i]);

			if (trim($strItem)!="")
			{
				echo "<DIV ALIGN=justify>".chr(13).chr(10);
	  			echo $strItem."</DIV>";
			}
			echo "</td></tr></table><BR><BR>".chr(13).chr(10);

	  		// Soll noch etwas ausgegeben werden?
			// Max. die letzten 10 Meldungen:
			$counter++;

			if ($counter==10)
			{
				break;
			}
		}
	}
	else
	{
		echo "<I>Es liegen derzeit keine aktuellen Neuigkeiten in der Kategorie 'Jugend' vor.</I><BR><BR>".chr(13).chr(10);

		// Den Link auf die Jugenseite nur dann anbieten, wenn diese Seite verfügbar ist:
		if (IsUrlAvailable("skkjugend.de")=="TRUE")
		{
			echo "Aktuelle Informationen zu diesem Themenbereich können auch auf der <BR><BR>".chr(13).chr(10);
			echo "<A HREF='http://www.skkjugend.de'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0>Jugendseite des SK Kriegshaber</A><BR><BR>".chr(13).chr(10);
			echo " nachgelesen werden.<BR><BR><BR>".chr(13).chr(10);
		}
	}

	echo "&nbsp; <A HREF='../sites/message_archive.php?mx=YOUTH' title='Folgen Sie bitte diesem Link, ";
	echo "um &auml;ltere News und Meldungen aus dem Jugendbereich einzusehen.'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Archiv &auml;lterer Meldungen aus dem Jugendbereich</A><BR>".chr(13).chr(10);

	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>





























