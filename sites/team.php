<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Mannschaft");
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
	writeNavigationBar(1, $objDBCon);
	// UPDATE Ende

	// #####################
	// Die ID erfragen:
	if (isset($_GET["ID"]))
	{
		$ID = $_GET["ID"];
	}
	else 
	{
		if (isset($_REQUEST["ID"]))
		{
			$ID = $_REQUEST["ID"];
		}
		else 
		{
			$ID = "";
		}
	}

	// Die Mannschaftsdaten:
	$strSQL = "select * from skk_teams WHERE del='N' AND modifieddate IS NULL AND id=".$ID;

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// ###################################################
	// Dynamische Ausgabe der Anzahl unserer Mannschaften:
	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$curID = $row->id;
			$curTeam = $row->team;
			$curLevel = $row->league;
			$NumberOfPlayers= $row->numberofplayers;
			$i++;
		}

		echo "<SPAN CLASS=he1>Mannschaft: $curTeam</SPAN><BR><BR>";
		echo "Aktuelle Liga: $curLevel<BR><BR><BR>";

		// Nach der aktuellen Tabelle über die Neuigkeiten suchen:
		$strSQL = "SELECT contentid FROM skk_news WHERE ";
		$strSQL = "SELECT MAX(createdate), contentid, del, modifieddate, teamid FROM skk_news GROUP BY ";
		$strSQL = $strSQL."teamid, contentid, del, modifieddate HAVING del='N' AND modifieddate IS NULL ";
		$strSQL = $strSQL."AND teamid=".$curID;

		$rsNews = mysqli_query($objDBCon, $strSQL);
		$RecordCountNews = mysqli_num_rows($rsNews);

		// Konnte etwas gefunden werden?
		if ($RecordCountNews > 0)
		{	
			while ($row = $rsNews->fetch_object())
			{
				$contentID = trim($row->contentid);			
			}
			
			if ($contentID != "")
			{
				// Die Tabelle holen:
				$strSQL = "SELECT content, createdate FROM skk_content WHERE id=".$contentID." AND del='N' AND modifieddate IS NULL;";

				$rsContent = mysqli_query($objDBCon, $strSQL);
				$RecordCountContent = mysqli_num_rows($rsContent);

				// Konnte etwas gefunden werden?
				if ($RecordCountContent > 0)
				{
					// ##############################################
					// Die Tabelle nur ausgeben, wenn sich diese in der 
					// aktuellen Saison befindet.
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
					
					while ($row = $rsContent->fetch_object())
					{
						$content = $row->content;
						$contentcreatedate = $row->createdate;
					}
					
					// Ausgabe???
					$tabYear = substr($contentcreatedate,0,4);
					$tabMonth = substr($contentcreatedate,5,2);

					if ($tabYear.".".$tabMonth.".01" > $curYear.".".$curMonth."01")
					{
						// Die Ausgabe umformatieren:
						$contentcreatedate = substr($contentcreatedate,8,2).".".substr($contentcreatedate,5,2).".".substr($contentcreatedate,0,4);
	
						echo "Die aktuellste Tabelle zu dieser Mannschaft (Stand ".$contentcreatedate."):<BR><BR>".chr(13).chr(10);
						echo $content.chr(13).chr(10);
						echo "<BR><BR>".chr(13).chr(10);
					}
				}
			}
		}

		echo "<B>Stammspieler:</B><BR><BR>".chr(13).chr(10);
		echo "<table border='1' width='100%'>".chr(13).chr(10);

		echo "<tr>".chr(13).chr(10);
    	echo "<td width='5%' bgcolor='#C0C0C0'><p align='center'>Brett:</p></td>".chr(13).chr(10);
    	echo "<td width='25%' bgcolor='#C0C0C0'>Nachname:</td>".chr(13).chr(10);
    	echo "<td width='25%' bgcolor='#C0C0C0'>Vorname:</td>".chr(13).chr(10);
    	echo "<td width='15%' bgcolor='#C0C0C0''><p align='center'>DWZ:</p></td>".chr(13).chr(10);
    	echo "<td width='10%' bgcolor='#C0C0C0''><p align='center'>ELO:</p></td>".chr(13).chr(10);
    	echo "<td width='10%' bgcolor='#C0C0C0''><p align='center'>Titel:</p></td>".chr(13).chr(10);
    	echo "<td width='15%' bgcolor='#C0C0C0''><p align='center'>Bild:</p></td>".chr(13).chr(10);
  		echo "</tr>";

		// Die Spieler ausgeben:
		for ($i=1; $i<=16; $i++)
  		{
  			if (($NumberOfPlayers + 1) == $i)
			{
				echo "</table><BR><BR>".chr(13).chr(10);

				echo "<B>Ersatzspieler:</B><BR><BR>".chr(13).chr(10);
				echo "<table border='1' width='100%'>".chr(13).chr(10);

				echo "<tr>".chr(13).chr(10);
		    	echo "<td width='5%' bgcolor='#C0C0C0'><p align='center'>Nr.</p></td>".chr(13).chr(10);
		    	echo "<td width='25%' bgcolor='#C0C0C0'>Nachname:</td>".chr(13).chr(10);
		    	echo "<td width='25%' bgcolor='#C0C0C0'>Vorname:</td>".chr(13).chr(10);
		    	echo "<td width='15%' bgcolor='#C0C0C0''><p align='center'>DWZ:</p></td>".chr(13).chr(10);
		    	echo "<td width='10%' bgcolor='#C0C0C0''><p align='center'>ELO:</p></td>".chr(13).chr(10);
		    	echo "<td width='10%' bgcolor='#C0C0C0''><p align='center'>Titel:</p></td>".chr(13).chr(10);
		    	echo "<td width='15%' bgcolor='#C0C0C0''><p align='center'>Bild:</p></td>".chr(13).chr(10);
		  		echo "</tr>".chr(13).chr(10);
		  		$bErsatzSpieler = "FALSE";
			}

  			// Die Spielerdaten ermitteln:
			$id_member = $rs->P$i;
			//$id_member = mysql_result($result,$nrak,"P".$i);
			$strSQL = "SELECT name, vorname, dwz, elo, title, picture FROM skk_members WHERE ID=".$id_member." AND del='N' AND modifieddate IS NULL;";

			$rsMember = mysqli_query($objDBCon, $strSQL);
			$RecordCountMember = mysqli_num_rows($rsMember);
			
			if ($RecordCountMember > 0)
			{
				$intMember = 0;
				
				while ($row = $rsMember->fetch_object())
				{
					$Name = $row->name;
					$Vorname = $row->vorname;
					$DWZ = $row->dwz;
					$ELO = $row->elo;
					$Titel = $row->title;
					$Bild = $row->picture;
					$intMember++;
				}
				
				if (trim($Name)!="")
				{
					 // Die Brettnummer:
					if ($i%2==0)
		   			{
		   				echo "<tr width='15%' bgcolor=eeeeee><td><p align='center'>$i</p></td>".chr(13).chr(10);
		   			}
		  			else
		   			{
		   				echo "<tr width='15%' bgcolor=fefefe><td><p align='center'>$i</p></td>".chr(13).chr(10);
		   			}

					echo "<td>$Name</td>".chr(13).chr(10);
					echo "<td>$Vorname</td>".chr(13).chr(10);
					echo "<td><p align='center'>$DWZ</p></td>".chr(13).chr(10);

					if (trim($ELO)=="")
					{
						echo "<td><p align='center'>&nbsp;</p></td>".chr(13).chr(10);
					}
					else
					{
						echo "<td><p align='center'>$ELO</p></td>".chr(13).chr(10);
					}


					if (trim($Titel)=="")
					{
						echo "<td><p align='center'>&nbsp;</p></td>".chr(13).chr(10);
					}
					else
					{
						echo "<td><p align='center'>$Titel</p></td>".chr(13).chr(10);
					}

					if (is_file("../admin/members/pics/$Bild"))
					{
						echo "<td><p align='center'><IMG SRC='../admin/members/pics/$Bild' width='75' height='75'></p></td>".chr(13).chr(10);
					}
					else
					{
						echo "<td>&nbsp;</td>".chr(13).chr(10);
					}

					$bErsatzSpieler = "TRUE";
				}
			}

			echo "</tr>".chr(13).chr(10);
  		}

  		echo "</table>".chr(13).chr(10);

  		if ($bErsatzSpieler=="FALSE")
  		{
  			echo "<BR>Es wurden für diese Mannschaft keine Ersatzspieler hinterlegt.<BR>".chr(13).chr(10);
  		}

  		if ($RecordCountNews > 0)
  		{
  			// #############################
			// Den Link auf die News setzen:
			echo "<BR><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' height='10' width='15'>".chr(13).chr(10);
			echo "<a href='team_news.php?curTeam=".$curTeam."&curTeamID=".$curID."' title='Link auf News & Meldungen zu dieser Mannschaft ";
			echo "aus der aktuellen Saison.'>News & Meldungen zu dieser Mannschaft</A><BR>".chr(13).chr(10);
  		}
	}

	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");
	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php")
?>