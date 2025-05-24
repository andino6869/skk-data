<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Suchergebnisse Turnier");
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
	if (isset($_REQUEST["tournament"])) 
	{
		$tournament = $_REQUEST["tournament"];
	}
	else
	{
		if (isset($_GET["tournament"]))
		{
			$tournament=$_GET["tournament"];
		}
		else 
		{
			$tournament = "";
		}
	}

	echo "<TABLE cellpadding=5 cellspacing=0 border=0>";
	echo "<TR><TD>";

	// #############################
  	// 4.) Plausichecks:
  	// 4.1.) Leere Eingabe:
  	if (trim($tournament) == '')
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
    	echo "</TD><TD><B>Sie haben kein Vereinsturnier angegeben.<BR>";

		// Seite finalisieren:
    	echo "</TD></TR></TABLE>".chr(13).chr(10);

		include("../includes/forms/middler.php");
		include("../includes/db/deadlines_shortview.php");

		get_deadlines_shortview($con);
		echo "<BR><BR><BR><BR>".chr(13).chr(10);

		include("../includes/forms/downloads.php");
		get_downloads();
		include("../includes/forms/footer.php");
		exit;
  	}

	// #########################################################
	// 5.) Reichen die Daten von der aktuellen Saison.
  	$buseyear = "FALSE";
  	
  	if (isset($_POST["TOURNAMENT_CURRENTSEASON"]))
  	{	
		if ($_POST["TOURNAMENT_CURRENTSEASON"])
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
  	}

  	$bShowContent = "FALSE";
  	
  	if (isset($_POST["TOURNAMENT_SHOWCONTENT"]))
  	{	
		if ($_POST["TOURNAMENT_SHOWCONTENT"])
		{
			$bShowContent = "TRUE";
		}
  	}


	// #########################################################
	// 6.) News & Meldungen aus Datenbank holen:
	$strSQL = "select * from skk_news WHERE (headline LIKE ".chr(34)."%".$tournament."%".chr(34)." OR ";
	$strSQL = $strSQL."headline2 LIKE ".chr(34)."%".$tournament."%".chr(34)." OR ";
	$strSQL = $strSQL."shorttext LIKE ".chr(34)."%".$tournament."%".chr(34).") ";

	if ($buseyear == "TRUE")
	{
		$strSQL = $strSQL."AND newsdate>'".(string)$curYear."-09-01' ";
	}
	$strSQL = $strSQL."AND modifieddate IS NULL AND del='N' ORDER BY newsdate ASC";

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
		echo "<table border=0 width='100%'><tr><td width=500 valign=top>".chr(13).chr(10);
	    echo "<td></td>".chr(13).chr(10);
		echo "<B>Es konnten keine Datens&auml;tze zum Vereinsturnier <I>'".$tournament."'</I> gefunden werden.</B>".chr(13).chr(10);
		echo "</td></tr></table><BR>".chr(13).chr(10);
	}
	else
	{
		// Für das aktuelle Datum den ersten Eintrag erstellen:
		echo "<SPAN CLASS='red_head' width='100%'>F&uuml;r das Vereinsturnier <I>'".$tournament."'</I> konnten insgesamt ";
		echo $RecordCount." News & Meldungen gefunden werden. <BR>Die Sortierung erfolgt nach Datum absteigend.".chr(13).chr(10);

		if ($RecordCount > 50)
		{
			echo "Es werden hier aus Performancegr&uuml;nden nur die ersten 50 gefundenen Datens&auml;tze aufgelistet.";
		}

		echo "</SPAN>";
		echo "<HR noshade size=1><BR>".chr(13).chr(10);

		// Daten ausgeben:
		// Max. sollen 50 Einträge ausgegeben werden.
		$counter = 0;

		// #######################################
		// Sollen die Inhalte gleich mit ausgegeben werden?
		if ($bShowContent == "TRUE")
		{
			// Daten ausgeben:
			for($i=0; $i<$RecordCount; $i++)
    		{
	  			echo "<BR><SPAN CLASS=he1>".formatoutput($Headline[$i])."</SPAN><BR><BR>".chr(13).chr(10);

				// #######################################
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
		      	if ($teamid[$i]!="")
		      	{
			        // Die Tabellendaten ermitteln:
			        $strSQL = "SELECT * FROM skk_teams WHERE id=".$teamid[$i]." AND del='N' AND modifieddate IS NULL;";

			        $rsTeams = mysqli_query($objDBCon, $strSQL);
			        $RecordCountTeams = mysqli_num_rows($rsTeams);

			        // Konnte ein Datensatz gefunden werden?
			        if ($RecordCountTeams > 0 )
			        {
			        	$intTeam = 0;
			        		
			        	while ($row = $rsTeams->fetch_object())
			        	{
			        		$ID[$intTeam] = $row->id;
			        		$team[$intTeam] = $row->team;
			        		$league[$intTeam] = $row->league;
			        		$intTeam++;
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
        			if ($RecordCountContent > 0 )
        			{
        				$intContent = 0;
        				 
        				while ($row = $rsContent->fetch_object())
        				{
        					$ID[$intContent] = $row->id;
			            	$Datum[$intContent] = $row->contentdate;
			            	$Titel[$intContent] = $row->title;
			            	$Kategorie[$intContent] = $row->category;
			            	$Content[$intContent] = $row->content;
			            	
        					$intContent++;
        				}
        			
						$strItem = formatoutput($Content[0]);
          			  	echo "<BR><BR>".$Content[0]."<BR><BR>";
        			}
      			}

				// #######################################
		        // Ausgabe des Textes:
      		    $strItem = formatoutput($Text[$i]);

      			echo "<DIV ALIGN=JUSTIFY>".$strItem."</DIV><BR><BR>".chr(13).chr(10);

      			if (($i < 20) && ($i < $RecordCount - 1))
      			{
      				echo "<HR>";
      			}

      			// Soll noch etwas ausgegeben werden?
				// Max. die letzten 50 Meldungen:
				$counter++;

				if ($counter==50)
				{
					break;
				}
    		}
		}
		else
		{
			// #######################################
			// Es erfolgt die Ausgabe als Liste:
			for($i=0; $i<$RecordCount; $i++)
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
					echo "<IMG SRC='../pics/forms/thunder.gif' height='10' width='15'>".chr(13).chr(10);
			    }
			    else
			    {
			    	if (trim(strtolower($Kategorie[$i]))=="afro")
			    	{
			    		echo "<IMG SRC='../pics/forms/afro.gif' height='15' width='15'>".chr(13).chr(10);
			    	}
			    	else
			    	{
			    		echo "<IMG SRC='../pics/forms/youth.gif' height='15' width='15'>".chr(13).chr(10);
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
	writeseekarea("", "TRUE", "FALSE");

	// ######################################
	// Die neue Vereinsturniersuche:
	include("../includes/forms/tournaments.php");
	writetournamentarea($objDBCon, $tournament, $buseyear, $bShowContent);

	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>