<?php include("afro_header.php")?>
<?php
	writeheader("News & Meldungen");
?>
<?php include("afro_navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include_once("../includes/date/date.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################
	
	// 1.) Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// Gab es Probleme?
	if ($objDBCon == "")
	{
		echo "<BR>Problem mit dem Verbindungsaufbau zur Datenbank: Das Verbindungsobjekt konnte nicht erzeugt werden!<BR>";
		echo "</BODY></HTML>".chr(13).chr(10);
		exit;
	}

	// 2.) Prüfen, ob der Zugang auf die AFRO - Seite aktuell überhaupt erlaubt ist:
	if (bIsAFROValid($objDBCon)==0)
	{
		// Keine Gültigkeit mehr!
		include("afro_middler.php");
		include("afro_footer.php");

		exit;
	}

	// #########################################################
	// 3.) Zugriffscounter erhöhen:
	$strSQL = "SELECT MAX(numberofhits) AS hits FROM skk_afro_hits;";
	
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount == 0)
	{
		$counter = 1;
	}
	else
	{
		$row = $rs->fetch_object();		
		$numberofhits = $row->hits;
		$counter = $numberofhits + 1;
	}

	// Bisherige Zugriffszahl sichern:
	$now = date("Y-m-d H:i:s");
	$curYear = substr($now,0,4);

	$strSQL = "UPDATE skk_afro_hits SET modifieddate='".$now."' WHERE modifieddate IS NULL AND curyear=".$curYear." AND del='N';";

	if (!mysqli_query ($objDBCon, $strSQL))
	{
		echo("Database update error: $strSQL<P>");
		echo mysql_error($objDBCon);
	}

	// Neue Zahl setzen:
	$strSQL = "INSERT INTO skk_afro_hits (numberofhits, curyear, creator, createdate) VALUES (".$counter.", ".$curYear.", 'SYSTEM', '".$now."');";

	if (!mysqli_query ($objDBCon, $strSQL))
	{
		echo("Database update error: $strSQL<P>");
		echo mysql_error($objDBCon);
	}


	// 4.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(0, $objDBCon);


	// Es werden nur die Daten aus dem aktuellen Jahr angezeigt!
	$curYear = substr(date("Y-m-t"),0,4);

	// Daten aus Datenbank holen:
	$strSQL = "select * from skk_news WHERE newsdate BETWEEN '".(string)$curYear."-01-01' AND '".(string)$curYear."-12-31' AND modifieddate IS NULL AND ";
	$strSQL = $strSQL."del='N' AND category='AFRO' AND (fadeifdeadlinereached = 'N' OR (fadeifdeadlinereached != 'N' AND deadlinedate>'$now')) ORDER BY newsdate DESC";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

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
			$contentid[$i] = $row->contentid;
			$teamid[$i] = $row->teamid;
			$Text[$i] = $row->text;
			$Tabelle[$i] = $row->newstable;
			$Hits[$i] = $row->hits;
			$Ausblenden[$i] = $row->fadeifdeadlinereached;
			$i++;
		}
	}
	
	// ###################
	// Gibt es Datensätze?
	if ($RecordCount == 0)
	{
		echo "<table border=0><tr><td width='100%' valign=top>".chr(13).chr(10);
	    echo "<td background='../pics/forms/tab_innen.gif' width=15></td>".chr(13).chr(10);
		echo "<B>Es liegen derzeit keine Neuigkeiten zum Augsburger Friedensfest Schachopen vor.</B>".chr(13).chr(10);
		echo "</td></tr></table><BR>".chr(13).chr(10);
	}

	// Daten ausgeben:
	for($i=0; $i<$RecordCount; $i++)
	{
		echo "<table border=0><tr><td width='100%' valign=top>".chr(13).chr(10);
		echo "<IMG SRC='../pics/icons/afro.gif' height='15' width='15'>".chr(13).chr(10);
		
		$strItem = $Headline[$i];
		$strItem = str_replace("\'", "'", $strItem);
		$strItem = str_replace("\\".chr(34), chr(34), $strItem);

		echo "<a href='afro_message.php?Nr=".$ID[$i]."' title='Kategorie: $Kategorie[$i]'>".$strItem."</A><BR>".chr(13).chr(10);

		echo "[".substr($Datum[$i], 8, 2).".".substr($Datum[$i],5,2).".".substr($Datum[$i],0,4)."]".chr(13).chr(10);

		$strItem = $Autor[$i];
		$strItem = str_replace("\'", "'", $strItem);
		$strItem = str_replace("\\".chr(34), chr(34), $strItem);

	    echo "<I> von ".$strItem."</I>".chr(13).chr(10);
	    echo "<BR><DIV ALIGN=justify>".chr(13).chr(10);

	    $strItem = $Kurztext[$i];
		$strItem = str_replace("\'", "'", $strItem);
		$strItem = str_replace("\\".chr(34), chr(34), $strItem);

		echo $strItem."</DIV></td></tr></table><BR>".chr(13).chr(10);
	}

	include("afro_middler.php");
	include("afro_user_registration.php");

	get_user_registration($objDBCon);

	include("afro_downloads.php");
	get_downloads($objDBCon);

	// ############################################################
	// RSS - Funktionalität:
	echo "<BR><BR><font color=#4300FF><b>Nachrichten - Ticker:</B></font><HR noshade size=1>".chr(13).chr(10);
	echo '<A HREF="../rss/rss_afro.xml"><img src="../rss/rss.jpg" width="10" height="10" border=0 alt="RSS 2.0">&nbsp;&nbsp;AFRO - Nachrichten Ticker einrichten</a>';

	// ###########################
	// UPDATE 18.07.2015
	// Wetterbericht für Augsburg
	$newDate = date("Y-m-d H:i:s", mktime(0, 0, 0, 8, 5, date("Y")));
	$interval = round(s_datediff("d", $now, $newDate));
	
	// Anzeige erst ein paar Tage vor Turnierbeginn freischalten bzw. nach dem Turnier wie deaktivieren!
	if (($interval < 5) && ($interval > -10))
	{
		echo "<BR><BR><BR><font color=#4300FF><b>Wettervorhersage:</B></font><HR noshade size=1>".chr(13).chr(10);

		echo "<TABLE align='center' width='100%'>".chr(13).chr(10);
		echo "<TR><TD WIDTH='100%' align='center'>".chr(13).chr(10);
		echo "<div id=".chr(34)."cont_b973a83cb704d0c06465cbf7ffcabeab".chr(34).">";
		echo "<span id=".chr(34)."h_b973a83cb704d0c06465cbf7ffcabeab".chr(34).">Wetter Augsburg</span>";
		echo "<script type=".chr(34)."text/javascript".chr(34)." async src=".chr(34)."https://www.daswetter.com/wid_loader/b973a83cb704d0c06465cbf7ffcabeab".chr(34)."></script>";
		echo "</div>";
		echo "</TD></TR></TABLE>".chr(13).chr(10);
	}
	// UPDATE Ende
	// #########################################

	include("afro_footer.php");
?>