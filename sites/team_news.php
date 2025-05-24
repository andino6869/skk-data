<?php include("../includes/forms/header.php")?>
<?php
	writeheader("News & Meldungen f&uuml;r Mannschaft");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// ##############################################
	// Das aktuelle Team ermitteln:
	if (!(isset($curTeam)))
	{
		$curTeam = "";
	}

	if (trim($curTeam)=="")
	{
		$curTeam = $_GET["curTeam"];
	}

	if (trim($curTeam)=="")
	{
		$curTeam = $_REQUEST["curTeam"];
	}

	if (trim($curTeam)=="")
	{
		$curTeam = $_POST["curTeam"];
	}


	// #############################
	// 1.) Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// #########################################################
	// 2.) Gab es Probleme beim Verbindungsaufbau?
	if ($objDBCon == "")
	{
		echo "<BR>Problem mit dem Verbindungsaufbau zur Datenbank: Das Verbindungsobjekt konnte nicht erzeugt werden!<BR>".chr(13).chr(10);
		echo "</BODY></HTML>".chr(13).chr(10);
		exit;
	}

	writeNavigationBar(999, $objDBCon);

	// ##############################################
	// 3.) Es reichen die Daten von einer kompletten Saison.
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

	// ##############################################
	// 4.) ID des aktuellen Teams.
	if (!(isset($curTeamID)))
	{
		$curTeamID = "";
	}
	
	if (trim($curTeamID)=="")
	{
		$curTeamID = $_GET["curTeamID"];
	}

	if (trim($curTeamID)=="")
	{
		$curTeamID = $_REQUEST["curTeamID"];
	}

	if (trim($curTeamID)=="")
	{
		$curTeamID = $_POST["curTeamID"];
	}

	// #########################################################
	// 5.) Daten aus Datenbank holen:
	$strSQL = "select * from skk_news WHERE newsdate>'".(string)$curYear."-09-01' AND modifieddate IS NULL AND ";
	$strSQL = $strSQL."del='N' AND teamid=".$curTeamID." AND (fadeifdeadlinereached = 'N' OR (fadeifdeadlinereached != 'N' AND ";
	$strSQL = $strSQL."deadlinedate>'".$now."')) ";
	$strSQL = $strSQL." ORDER BY newsdate ASC";

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
			$i++;
		}
	}
	
	echo "<SPAN CLASS=he1>Meldungen zur '".$curTeam."' aus der aktuellen Saison</SPAN><BR><BR>".chr(13).chr(10);

	// Gibt es Datensätze?
	if ($RecordCount == 0)
	{
		echo "<table border=0><tr><td width=500 valign=top>".chr(13).chr(10);
	    echo "<td width=15></td>".chr(13).chr(10);
		echo "<B>Es liegen derzeit keine Neuigkeiten f&uuml;r die Mannschaft ".$curTeam." vor.</B>".chr(13).chr(10);
		echo "</td></tr></table><BR>".chr(13).chr(10);
	}
	else
	{
		// Ausgabe der gefundenen Datensätze:
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
		    if ((trim(strtolower($Kategorie[$i]))=="alle") || (trim(strtolower($Kategorie[$i]))=="erwachsene"))
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
		    		echo substr($createdate[$i], 8, 2).".".substr($createdate[$i],5,2).".".substr($createdate[$i],0,4)."</I>";
		    	}
			}

		    echo "<DIV ALIGN=justify>";

		    $strItem = formatoutput($Kurztext[$i]);
			echo $strItem."</DIV></td></tr></table><BR>".chr(13).chr(10);
		}
	}

	include("../includes/forms/middler.php");

	// ######################################
	// Die neue Suchfunktion:
	include("../includes/forms/seekarea.php");
	writeseekarea("", "TRUE", "FALSE");

	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>