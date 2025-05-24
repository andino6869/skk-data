<?php include("../includes/forms/header.php")?>
<?php
	writeheader("News & Meldungen");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include_once("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>
<?php include("../admin/_admin_param.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// #############################
	// 1.) Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// ##############################################
	// 2.) Den aktuellen Modus ermitteln:
	$mx = strGetParam($objDBCon, "mx", "FALSE", "PARENTS");
	$aid = strGetParam($objDBCon, "aid", "FALSE", 1);
	
	// ##############################################
	// 3.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	// Welcher Seiteninhalt soll angezeigt werden?
	switch ($mx)
	{
		case "YOUTH":
			writeNavigationBar(2, $objDBCon);
			break;

		case "SPORT":
			writeNavigationBar(10, $objDBCon);
			break;

		case "AFRO":
			writeNavigationBar(11, $objDBCon);
			break;

		default:
			writeNavigationBar(0, $objDBCon);
	}

	echo "<CENTER>".chr(13).chr(10);

	if ($mx == "SPORT")
	{
		echo "<IMG SRC='../pics/forms/sport_index.jpg' BORDER=1 HEIGHT=150 WIDTH=190>";
		echo "<IMG SRC='../pics/forms/sport_skk.jpg' BORDER=1 HEIGHT=150 WIDTH=150>";
		echo "<IMG SRC='../pics/forms/sport_skk2.jpg' BORDER=1 HEIGHT=150 WIDTH=190><BR><BR><BR><BR>".chr(13).chr(10);
	}
	else
	{
		echo "<font face=".chr(34)."Arial".chr(34)." color=".chr(34)."#666666".chr(34)." size='4'>Herzlich Willkommen beim Schachklub Kriegshaber</font><BR><BR>".chr(13).chr(10);
	}

	// ##############################################
	// 4.) Den Link auf die Jugenseite nur dann anbieten, wenn diese Seite verfügbar ist:
	// Laut Email von Markus Buchberger vom 02.03.2009 mit sofortiger Wirkung zu deaktivieren.
	switch ($mx)
	{
		/*case "YOUTH":
			if (IsUrlAvailable("skkjugend.de")=="TRUE")
			{
				echo "<A HREF='http://www.skkjugend.de'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Jugendseite des SK Kriegshaber</A><BR><BR><BR><BR>".chr(13).chr(10);
			}
			break;*/

		case "PARENTS":

			// Es erfolgt die AFRO - Anzeige, wenn die Dateien vorhanden sind und der Link angezeigt werden soll:
			$strSQL = "SELECT * FROM skk_afro_config WHERE showafrolink='J' AND modifieddate IS NULL AND DEL='N';";

			if (bCheckRecordset($objDBCon, $strSQL)=="1")
			{
				if (is_file("../afro/index.php"))
				{
					echo "<A HREF='../afro/index.php'>"; 
				}
				else
				{
					echo "<A HREF='../../afro/index.php'>"; 
				}
				
				if (is_file("pics/icons/pfeilrotaufgelb.gif"))
				{
					echo "<IMG SRC='pics/icons/pfeilrotaufgelb.gif' BORDER=0> AFRO - Turnier - Seite</A><BR><BR>";
				}
				else 
				{
					if (is_file("../pics/icons/pfeilrotaufgelb.gif"))
					{
						echo "<IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> AFRO - Turnier - Seite</A><BR><BR>";
					}
					else
					{
						echo "<IMG SRC='../../pics/icons/pfeilrotaufgelb.gif' BORDER=0> AFRO - Turnier - Seite</A><BR><BR>";
					} 
				}
			}

			// ##################
			// UPDATE 10.08.2014:
			// Sportseite wurde nicht weiter gepflegt, daher nicht mehr anbieten!
			//if (IsUrlAvailable("sport.skk.de")=="TRUE")
			//{
			//	echo "<A HREF='http://sport.skk.de'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Sporthomepage des SK Kriegshaber</A><BR><BR><BR><BR>".chr(13).chr(10);
			//}

			// #########
			// Jubiläum:
			
			// Es erfolgt die AFRO - Anzeige, wenn die Dateien vorhanden sind und der Link angezeigt werden soll:
			$strSQL = "SELECT * FROM skk_news WHERE category='100-Jahre-Feier' AND modifieddate IS NULL AND DEL='N';";
			
			if (bCheckRecordset($objDBCon, $strSQL)=="1")
			{
    			if (is_file("../100/index.php"))
    			{
    			    echo "<A HREF='../100/index.php'>";
    			}
    			else
    			{
    			    echo "<A HREF='../../100/index.php'>";
    			}
    			
    			if (is_file("pics/icons/pfeilrotaufgelb.gif"))
    			{
    			    echo "<IMG SRC='pics/icons/pfeilrotaufgelb.gif' BORDER=0> Sonderseite zum 100 j&auml;hrigen Bestehen</A><BR><BR>";
    			}
    			else
    			{
    			    if (is_file("../pics/icons/pfeilrotaufgelb.gif"))
    			    {
    			        echo "<IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Sonderseite zum 100 j&auml;hrigen Bestehen</A><BR><BR>";
    			    }
    			    else
    			    {
    			        echo "<IMG SRC='../../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Sonderseite zum 100 j&auml;hrigen Bestehen</A><BR><BR>";
    			    }
    			}
			}
		default:
	}

	// ##############################################
	echo "</CENTER>".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);

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

	// ##############################################
	// 5.) Es reichen die Daten von einer kompletten Saison.
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

	// #########################################################
	// 6.) Gab es Probleme beim Verbindungsaufbau?
	if ($objDBCon == "")
	{
		echo "<BR>Problem mit dem Verbindungsaufbau zur Datenbank: Das Verbindungsobjekt konnte nicht erzeugt werden!<BR>".chr(13).chr(10);
		echo "</BODY></HTML>".chr(13).chr(10);
		exit;
	}

	// #########################################################
	// 7.) Zugriffscounter erhöhen:
	$strSQL = "SELECT MAX(numberofhits) AS hits FROM skk_hits;";
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount==0)
	{
		$intCounter = 1;
	}
	else
	{
		// $nrak = $num - 0 - 1;
		// $numberofhits = mysql_result($result,$nrak,"hits");		
		$rs->data_seek(0);
		$row = $rs->fetch_row();
		$numberofhits = intval($row[0]);
				
		$intCounter = $numberofhits + 1;
	}

	// Bisherige Zugriffszahl sichern:
	$strSQL = "UPDATE skk_hits SET modifieddate='".$now."' WHERE modifieddate IS NULL AND del='N';";

	if (!mysqli_query ($objDBCon, $strSQL))
	{
		echo("Database update error: $strSQL<P>");
		echo mysqli_error($objDBCon);
	}

	// Neue Zahl setzen:
	$strSQL = "INSERT INTO skk_hits (numberofhits, creator, createdate) VALUES (".strval($intCounter).", 'SYSTEM', '".$now."');";

	if (!mysqli_query ($objDBCon, $strSQL))
	{
		echo("Database update error: $strSQL<P>");
		echo mysqli_error($objDBCon);
	}


	// #########################################################
	// 8.) Daten aus Datenbank holen:
	$strSQL = "select * from skk_news WHERE newsdate>='".(string)$curYear."-09-01' AND modifieddate IS NULL AND ";
	$strSQL = $strSQL."del='N' AND (fadeifdeadlinereached = 'N' OR (fadeifdeadlinereached != 'N' AND ";
	$strSQL = $strSQL."deadlinedate>'".$now."')) ";

	// Welcher Seiteninhalt soll angezeigt werden?

	switch ($mx)
	{
		/*case "YOUTH":
			$strSQL = $strSQL."AND (category='Jugend')";
			break;*/

		case "SPORT":
			$strSQL = $strSQL."AND (category='SPORT')";			
			break;

		/*case "AFRO":
			$strSQL = $strSQL."AND (category='AFRO')";
			break;*/
		/* UPDATE DAvid Schury - Email vom 27.05.2012: Auch Jugendnachrichten sollen auf der Hauptseite mit dem entsprechenden Icon angezeigt werden!*/
		default:
			$strSQL = $strSQL."AND (category='Alle' OR category='Erwachsene' OR category='AFRO' OR category='Jugend' OR category='SPORT')";
	}

	$strSQL = $strSQL." ORDER BY newsdate DESC";

	// ####################
	// Abfrage durchführen:
	$result = mysqli_query($objDBCon, $strSQL);
	$num = mysqli_num_rows($result);
	$i = 0;
	
	while ($row = $result->fetch_object())
	{
	
		$ID[$i] = $row->id;
		$Datum[$i] = $row->newsdate;
		$Kategorie[$i] = $row->category;
		$Headline[$i] = $row->headline;
		$Headline2[$i] = $row->headline2;
		$Autor[$i] = $row->author;
		$Kurztext[$i] = $row->shorttext;
		$objDBContentid[$i] = $row->contentid;
		$teamid[$i] = $row->teamid;
		$Text[$i] = $row->text;
		$Tabelle[$i] = $row->newstable;
		$Hits[$i] = $row->hits;
		$Ausblenden[$i] = $row->fadeifdeadlinereached;
		$creator[$i] = $row->creator;
		$createdate[$i] = $row->createdate;

		$i++;
	}
	
    // ###################
	// Gibt es Datensätze?
	if ($num == 0)
	{
		echo "<table border=0><tr><td width=500 valign=top>".chr(13).chr(10);
	   	echo "<td width=15></td>".chr(13).chr(10);
		echo "<B>Es liegen derzeit keine Neuigkeiten im aktuellen Bereich vor.</B>".chr(13).chr(10);
		echo "</td></tr></table><BR>".chr(13).chr(10);
	}
	else
	{
		// Für das aktuelle Datum den ersten Eintrag erstellen:
		echo "<SPAN CLASS=".chr(34)."red_head".chr(34).">".$Monat[(double)substr(date("Y-m-t"),5,2)]." ".substr(date("Y-m-t"),0,4)."</SPAN>".chr(13).chr(10);
		echo "<HR noshade size=1 color='#5B2E00'>".chr(13).chr(10);

		// Passt der erste Datensatz zum aktuellen Datum?
		if (substr($Datum[0],5,2) != $curMonth)
		{
		    echo "<table border=0><tr>";
	        echo "<td width=500 valign=top><I>Es liegen f&uuml;r den aktuellen Monat keine Neuigkeiten vor.</I>".chr(13).chr(10);
			echo "</td></tr></table><BR>".chr(13).chr(10);
			echo "<SPAN CLASS='red_head'>".$Monat[(double)substr($Datum[0],5,2)]." ".substr($Datum[0],0,4)."</SPAN>".chr(13).chr(10);
	    	echo "<HR noshade size=1 color='#5B2E00'>".chr(13).chr(10);
		}
	}

	// Daten ausgeben:
	$counter = 0;

	for($i=0; $i < $num; $i++)
	{
		echo "<table border=0><tr><td width='100%' valign=top>".chr(13).chr(10);
		
		// ####################################
		// Welches Icon soll ausgegeben werden?
		if (trim(strtolower($Kategorie[$i]))=="alle" || trim(strtolower($Kategorie[$i]))=="erwachsene")
		{
		    echo "<IMG SRC='../pics/icons/thunder.gif' height='10' width='15'>".chr(13).chr(10);
		}
		else
		{
		    if (trim(strtolower($Kategorie[$i]))=="afro")
		    {
		        echo "<IMG SRC='../pics/icons/afro.gif' height='15' width='15'>".chr(13).chr(10);
		    }
		    else
		    {
		        if (trim(strtolower($Kategorie[$i]))=="sport")
		        {
		            echo "<IMG SRC='../pics/icons/sport.gif' height='15' width='15'>".chr(13).chr(10);
		        }
		        else
		        {
		            echo "<IMG SRC='../pics/icons/youth.gif' height='15' width='15'>".chr(13).chr(10);
		        }
		    }
		}
		
		// ##################
		// Ausgabe des Links:
		echo "<a href='message.php?Nr=".$ID[$i]."' title='Kategorie: ".$Kategorie[$i];

		if (trim($Headline2[$i]!=""))
		{
			$strItem = formatoutput($Headline2[$i]);
			echo chr(13).chr(10).chr(13).chr(10).$strItem;
		}

		// Die eigentliche Schlagzeile:
		$strItem = formatoutput($Headline[$i]);

		if (trim($strItem)!="")
		{
			echo "'>".$strItem."</A><BR>".chr(13).chr(10);
		}
		else
		{
			echo "'></A><BR>".chr(13).chr(10);
		}

		echo "[".substr($Datum[$i], 8, 2).".".substr($Datum[$i],5,2).".".substr($Datum[$i],0,4)."]".chr(13).chr(10);
	    echo "<I> von ".trim($Autor[$i])."</I>";

	    // Gab es zwischenzeitlich eine Änderung an der Meldung durch eine
	    // andere Person?
	    if (strtolower(trim($Autor[$i])) != strtolower(trim($creator[$i])))
	    {
	    	// Stammt diese Änderung von der Altdatenübernahme???
	    	if (strtoupper(trim($creator[$i])) != "ALTDATENÜBERNAHME PROWIDE")
	    	{
	    		echo "<I>, zuletzt ge&auml;ndert von ".$creator[$i]." am ";
	    		echo substr($createdate[$i], 8, 2).".".substr($createdate[$i],5,2).".".substr($createdate[$i],0,4)."</I>";
	    	}
		}

		// Hat der Kurztext einen eigenen HTML - TAG?
		if (substr(trim($Kurztext[$i]),0,1)!="<")
		{
			echo "<DIV ALIGN=justify>";
		}

	    $strItem = formatoutput($Kurztext[$i]);
		echo $strItem;

		// HTML - TAG beenden:
		if (substr(trim($Kurztext[$i]),0,1)!="<")
		{
			echo "</DIV>";
		}
		echo "</td></tr></table><BR>".chr(13).chr(10);

		// Soll noch etwas ausgegeben werden?
		// Max. die letzten 10 Meldungen:
		$counter++;

		if ($counter==10)
		{
			break;
		}

	    if($i<$num-1)
		{
			// Jahreswechsel?
			if (substr($Datum[$i],0,4) > substr($Datum[$i+1],0,4))
			{
				echo "<SPAN CLASS='red_head'> ".$Monat[substr($Datum[$i+1],5,2)]." ".substr($Datum[$i+1],0,4)."</SPAN><HR noshade size=1 color='#5B2E00'>".chr(13).chr(10);
			}
			else
			{
				// Der nächste Monat?
				if (substr($Datum[$i],5,2) > substr($Datum[$i+1],5,2))
				{
					echo "<SPAN CLASS='red_head'> ".$Monat[substr($Datum[$i],5,2)-1]." ".substr($Datum[$i],0,4)."</SPAN><HR noshade size=1 color='#5B2E00'>".chr(13).chr(10);
				}
				else
				{
					// UPDATE Schneider 05.05.2008
					// Der Jahreswechsel wurde bis dato vergessen!
					if (substr($Datum[$i],5,2) == "01" && substr($Datum[$i+1],5,2) == "12")
					{
						echo "<SPAN CLASS='red_head'> Dezember ".substr($Datum[$i+1],0,4)."</SPAN><HR noshade size=1 color='#5B2E00'>".chr(13).chr(10);
					}
					// UPDATE Ende
				}
			}
		}
	}

	echo "&nbsp; <A HREF='../sites/message_archive.php?mx=".$mx."' title='Folgen Sie bitte diesem Link, ";
	echo "um &auml;ltere News und Meldungen aus diesem Bereich einzusehen.'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Archiv &auml;lterer Meldungen</A><BR>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// ######################################
	// Die neue Suchfunktion:
	include("../includes/forms/seekarea.php");
	writeseekarea("", "TRUE", "FALSE");

	if ($mx == "PARENTS")
	{
		// ######################################
		// Die neue Vereinsturniersuche:
		include("../includes/forms/tournaments.php");
		writetournamentarea($objDBCon, "", "TRUE", "FALSE");
	}

	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);

	// ############################################################
	// RSS - Funktionalität:	
	echo "<BR><BR>Nachrichten - Ticker:<HR noshade size=1>".chr(13).chr(10);
	echo "<SPAN CLASS=sm>".chr(13).chr(10);
	echo '<A HREF="../rss/rss.xml"><img src="../rss/rss.jpg" width="10" height="10" border=0 alt="RSS 2.0">&nbsp;&nbsp;Schachklub Kriegshaber Nachrichten Ticker einrichten</a>'.chr(13).chr(10);
	echo "</SPAN>";
	
	include("../includes/forms/footer.php");
?>
