<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Suchergebnisse Recherche");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/string/str.php")?>
<?php include("../includes/db/connection.php")?>


<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// #############################
	// 1.) Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// #############################
	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon);

	// Gab es Probleme?
	if ($objDBCon == "")
	{
		echo "<BR>Problem mit dem Verbindungsaufbau zur Datenbank: Das Verbindungsobjekt konnte nicht erzeugt werden!<BR>";
		echo "</BODY></HTML>";
		exit;
	}

	// #############################
	// 3.) Die Angaben prüfen, ob überhaupt etwas eingegeben worden ist:
	if (isset($_GET["Seek"]))
	{
		$Seek=$_GET["Seek"];
	}
	else
	{
		if (isset($_REQUEST["Seek"]))
		{
			$Seek = $_REQUEST["Seek"];
		}
		else 
		{
			if (isset($_POST["Seek"]))
			{
				$Seek=$_POST["Seek"];
			}
			else 
			{
				$Seek = "";
			}
		}
	}
	
	$Seek = strReplaceHTMLTAGS($objDBCon, $Seek);

	echo "<TABLE cellpadding=5 cellspacing=0 border=0>";
	echo "<TR><TD>";

	// #############################
  	// 4.) Plausichecks:
  	// 4.1.) Leere Eingabe:
  	if (trim($Seek) == '')
  	{
  		// Die Position der Dateien kann anders lauten!
		if (is_file("../pics/admin/critical.gif"))
		{
			echo "<IMG SRC='../pics/admin/critical.gif' border=0>";
		}
		else
		{
			if (is_file("../../pics/admin/critical.gif"))
			{
				echo "<IMG SRC='../../pics/admin/critical.gif' border=0>";
			}
			else
			{
				echo "<IMG SRC='../../../pics/admin/critical.gif' border=0>";
			}
		}
    	echo "</TD><TD><B>Sie haben keine Suchzeichenkette angegeben.<BR>";

		// Seite finalisieren:
    	echo "</TD></TR></TABLE>".chr(13).chr(10);

		include("../includes/forms/middler.php");
		include("../includes/db/deadlines_shortview.php");

		get_deadlines_shortview($objDBCon);
		echo "<BR><BR><BR><BR>".chr(13).chr(10);

		include("../includes/forms/downloads.php");
		get_downloads($objDBCon);
		include("../includes/forms/footer.php");
		exit;
  	}

	// #############################
  	// 4.2.) Zu kurze Eingabe:
	if (strlen($Seek) < 4)
    {
		// Die Position der Dateien kann anders lauten!
		if (is_file("../pics/admin/critical.gif"))
		{
			echo "<IMG SRC='../pics/admin/critical.gif' border=0>";
		}
		else
		{
			if (is_file("../../pics/admin/critical.gif"))
			{
				echo "<IMG SRC='../../pics/admin/critical.gif' border=0>";
			}
			else
			{
				echo "<IMG SRC='../../../pics/admin/critical.gif' border=0>";
			}
		}
    	echo "</TD><TD><B>Sie haben eine zu kurze Suchzeichenkette hinterlegt (mind. 4 Zeichen).<BR>";

  		// Seite finalisieren:
    	echo "</TD></TR></TABLE>".chr(13).chr(10);

		include("../includes/forms/middler.php");
		include("../includes/db/deadlines_shortview.php");

		get_deadlines_shortview($objDBCon);
		echo "<BR><BR><BR><BR>".chr(13).chr(10);

		include("../includes/forms/downloads.php");
		get_downloads($objDBCon);
		include("../includes/forms/footer.php");
		exit;
	}

	// Zusätzliche unbrauchbare Zeichen entfernen:
	$Seek = str_replace("%", "", $Seek);
	$Seek = str_replace("*", "", $Seek);

	// #########################################################
	// 5.) Reichen die Daten von der aktuellen Saison.
	if (isset($_POST["CURRENTSEASON"]))
	{
		if ($_POST["CURRENTSEASON"])
		{
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
			$buseyear = "TRUE";
		}
		else
		{
			$buseyear = "FALSE";
		}
	}
	else 
	{
		$buseyear = "FALSE";
	}

	if (isset($_POST["SHOWCONTENT"]))
	{
		if ($_POST["SHOWCONTENT"])
		{
			$bShowContent = "TRUE";
		}
		else
		{
			$bShowContent = "FALSE";
		}
	}
	else 
	{
		$bShowContent = "FALSE";
	}


	// #########################################################
	// 6.) News & Meldungen aus Datenbank holen:
	$strSQL = "select * from skk_news WHERE (headline LIKE ".chr(34)."%".$Seek."%".chr(34)." OR ";
	$strSQL = $strSQL."headline2 LIKE ".chr(34)."%".$Seek."%".chr(34)." OR ";
	$strSQL = $strSQL."shorttext LIKE ".chr(34)."%".$Seek."%".chr(34)." OR ";
	$strSQL = $strSQL."text LIKE ".chr(34)."%".$Seek."%".chr(34).") ";

	if ($buseyear == "TRUE")
	{
		$strSQL = $strSQL."AND newsdate>'".(string)$curYear."-09-01' ";
	}
	$strSQL = $strSQL."AND modifieddate IS NULL AND del='N' ORDER BY newsdate DESC";

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
			$creator[$i] = $row->creator;
			$createdate[$i] = $row->createdate;
			$picture[$i] = $row->picture;
			$i++;
		}
	}
	
	// Gibt es Datensätze?
	if ($RecordCount == 0)
	{
		echo "<table border=0><tr><td width=500 valign=top>".chr(13).chr(10);
	    echo "<td></td>".chr(13).chr(10);
		echo "<B>Es konnten keine passenden Datens&auml;tze im Bereich 'News & Meldungen' gefunden werden.</B>".chr(13).chr(10);
		echo "</td></tr></table><BR>".chr(13).chr(10);
	}
	else
	{
		// Für das aktuelle Datum den ersten Eintrag erstellen:
		echo "<SPAN CLASS='red_head' width='100%'>F&uuml;r die Suchzeichenkette <I>'".$Seek."'</I> konnten insgesamt ";
		echo $RecordCount." News & Meldungen gefunden werden.".chr(13).chr(10);

		if ($RecordCount > 20)
		{
			echo "Es werden hier aus Performancegr&uuml;nden nur die ersten 20 gefundenen Datens&auml;tze aufgelistet.";
		}

		echo "</SPAN>";
		echo "<HR noshade size=1 color='#5B2E00'><BR><BR>".chr(13).chr(10);

		// Daten ausgeben:
		// Max. sollen 20 Einträge ausgegeben werden.
		$counter = 0;

		// #######################################
		// Sollen die Inhalte gleich mit ausgegeben werden?
		if ($bShowContent == "TRUE")
		{
			// Daten ausgeben:
			for($i=0;$i<$RecordCount;$i++)
    		{
	  			echo "<BR><SPAN CLASS=he1>".formatoutput($Headline[$i])."</SPAN><BR><BR>".chr(13).chr(10);

				// ##########################
				// Hat dieses Event ein Bild?
				if($picture[$i]!="")
				{
					if (is_file("pics/".$picture[$i]))
					{
						echo "<p align='left'><IMG SRC='pics/$picture[$i]' width='150' height='150'></p>".chr(13).chr(10);
					}
				}

		      	echo "<I>Eintrag vom ".substr($Datum[$i], 8, 2).".".substr($Datum[$i],5,2).".".substr($Datum[$i],0,4)." von ".$Autor[$i]."</I><BR><BR>".chr(13).chr(10);
			  	echo "<SPAN CLASS=he2>".formatoutput($Headline2[$i])."</SPAN><BR><BR>".chr(13).chr(10);

				// #######################################
	  			// 9.) Hat dieses Event ein Mannschaftsobjekt?
		      	if($teamid[$i]!="")
		      	{
			        // Die Tabellendaten ermitteln:
			        $strSQL = "SELECT * FROM skk_teams WHERE id=".$teamid[$i]." AND del='N' AND modifieddate IS NULL;";
			        
			        $rsTeams = mysqli_query($objDBCon, $strSQL);
			        $RecordCountTeams = mysqli_num_rows($rsTeams);

			        // Konnte ein Datensatz gefunden werden?
			        if ($RecordCountTeams > 0 )
			        {
			        	$i = 0;
			        		
			        	while ($row = $rsTeams->fetch_object())
			        	{
			        		$ID[$j] = $row->id;
			        		$team[$j] = $row->team;
			        		$league[$j] = $row->league;
			        		$i++;
			        	}
			        	
		          		echo "<BR><BR>Betrifft Mannschaft: ".$team[0]." (".$league[0].")<BR><BR>".chr(13).chr(10);
		        	}
		      	}

				// #######################################
      			// Hat dieses Event ein Inhaltsobjekt?
      			if($contentid[$i]!="")
      			{
			        // Die Tabellendaten ermitteln:
        			$strSQL = "SELECT * FROM skk_content WHERE id=".$contentid[$i]." AND del='N' AND modifieddate IS NULL;";

        			$rsContent = mysqli_query($objDBCon, $strSQL);
			        $RecordCountContent = mysqli_num_rows($rsContent);

			        // Konnte ein Datensatz gefunden werden?
        			if ($RecordCountContent > 0)
        			{
        				$i = 0;
        				 
        				while ($row = $rsContent->fetch_object())
        				{
        					$ID[$j] = $row->id;
        					$Datum[$j] = $row->contentdate;
        					$Titel[$j] = $row->title;
        					$Kategorie[$j] = $row->category;
        					$Content[$j] = $row->content;
        					$i++;
        				
			          	}

		  			  	$strItem = formatoutput($Content[0]);
          			  	echo "<BR><BR>".$Content[0]."<BR><BR>";
        			}
      			}

				// #######################################
		        // Ausgabe des Textes:
      		    $strItem = formatoutput($Text[$i]);

      			echo "<DIV ALIGN=JUSTIFY>".$strItem."</DIV><BR><BR>".chr(13).chr(10);

      			if (($i < 20) && ($i < $num - 1))
      			{
      				echo "<HR>";
      			}

      			// Soll noch etwas ausgegeben werden?
				// Max. die letzten 20 Meldungen:
				$counter++;

				if ($counter==20)
				{
					break;
				}
    		}
		}
		else
		{
			// #################################
			// Es erfolgt die Ausgabe als Liste:
			for($i=0;$i<$RecordCount;$i++)
			{
				echo "<table border=0><tr><td width='100%' valign=top>".chr(13).chr(10);
				echo "<a href='message.php?Nr=".$ID[$i]."' title='Kategorie: ".$Kategorie[$i].chr(13).chr(10);

				if (trim($Headline2[$i]!=""))
				{
					$strItem = formatoutput($Headline2[$i]);
					echo chr(13).chr(10)."Headline 2: ".chr(13).chr(10).$strItem;
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


				// Welches Icon soll ausgegeben werden?
			    if (trim(strtolower($Kategorie[$i]))=="alle")
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
			    		echo "<IMG SRC='../pics/icons/youth.gif' height='15' width='15'>".chr(13).chr(10);
			    	}
			    }

				echo "[".substr($Datum[$i], 8, 2).".".substr($Datum[$i],5,2).".".substr($Datum[$i],0,4)."]".chr(13).chr(10);
			    echo "<I> von ".trim($Autor[$i])."</I>".chr(13).chr(10);

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

			    echo "<DIV ALIGN=justify>".chr(13).chr(10);

			    $strItem = formatoutput($Kurztext[$i]);
				echo $strItem."</DIV></td></tr></table><BR>".chr(13).chr(10);

				// Soll noch etwas ausgegeben werden?
				// Max. die letzten 20 Meldungen:
				$counter++;

				if ($counter==20)
				{
					break;
				}
			}
		}
	}


	echo "</TD></TR></TABLE>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// ######################################
	// Die neue Suchfunktion:
	include("../includes/forms/seekarea.php");
	writeseekarea($Seek, $buseyear, $bShowContent);

	// ######################################
	// Die neue Vereinsturniersuche:
	include("../includes/forms/tournaments.php");
	writetournamentarea($objDBCon, "", "TRUE", "FALSE");

	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>