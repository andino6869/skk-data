<?php include("100_header.php")?>
<?php
	writeheader("News & Meldungen");
?>
<?php include("100_navigation.php")?>
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
		
	// #########################################################
	// 3.) Zugriffscounter erhöhen:
	$strSQL = "SELECT MAX(numberofhits) AS hits FROM skk_100_hits;";
	
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

	$strSQL = "UPDATE skk_100_hits SET modifieddate='".$now."' WHERE modifieddate IS NULL AND curyear=".$curYear." AND del='N';";

	if (!mysqli_query ($objDBCon, $strSQL))
	{
		echo("Database update error: $strSQL<P>");
		echo mysql_error($objDBCon);
	}

	// Neue Zahl setzen:
	$strSQL = "INSERT INTO skk_100_hits (numberofhits, curyear, creator, createdate) VALUES (".$counter.", ".$curYear.", 'SYSTEM', '".$now."');";

	if (!mysqli_query ($objDBCon, $strSQL))
	{
		echo("Database update error: $strSQL<P>");
		echo mysql_error($objDBCon);
	}

    // ##########################################################################
	// 4.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(0, $objDBCon);

    // ##############################
	// 5.) Daten aus Datenbank holen:
	$strSQL = "select * from skk_news WHERE modifieddate IS NULL AND ";
	$strSQL = $strSQL."del='N' AND category='100-Jahre-Feier' AND (fadeifdeadlinereached = 'N' OR (fadeifdeadlinereached != 'N' AND deadlinedate>'$now')) ORDER BY newsdate DESC";
	
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
	    //echo "<td background='../pics/forms/tab_innen.gif' width=15></td>".chr(13).chr(10);
		echo "<B>Es liegen derzeit keine Neuigkeiten zur 100-Jahre-Feier vor.</B>".chr(13).chr(10);
		echo "</td></tr></table><BR>".chr(13).chr(10);
	}

	// Daten ausgeben:
	for($i=0; $i<$RecordCount; $i++)
	{
		echo "<table border=0><tr><td width='100%' valign=top>".chr(13).chr(10);
		echo "<IMG SRC='../pics/icons/100.gif' height='15' width='15'>".chr(13).chr(10);
		
		$strItem = $Headline[$i];
		$strItem = str_replace("\'", "'", $strItem);
		$strItem = str_replace("\\".chr(34), chr(34), $strItem);

		echo "<a href='100_message.php?Nr=".$ID[$i]."' title='Kategorie: $Kategorie[$i]'>".$strItem."</A><BR>".chr(13).chr(10);

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

	include("100_middler.php");
	include("100_downloads.php");
	get_downloads($objDBCon);

	// ############################################################
	// RSS - Funktionalität:
	if (is_file("../rss/rss_100.xml"))
	{
	   echo "<BR><BR><SPAN CLASS=red_head>Nachrichten - Ticker:</SPAN><HR noshade size=1>".chr(13).chr(10);
	   echo '<A HREF="../rss/rss_100.xml"><img src="../rss/rss.jpg" width="10" height="10" border=0 alt="RSS 2.0">&nbsp;&nbsp;100 Jahre - Nachrichten Ticker einrichten</a>';
	}
	
	include("100_footer.php");
?>