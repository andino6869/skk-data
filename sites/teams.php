<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Mannschaften");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>

<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################
	
	$objDBCon = GetCon();

	// UPDATE Schneider 05.05.2008:
	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	writeNavigationBar(5, $objDBCon);
	// UPDATE Ende

	// #####################
	// Die Mannschaftsdaten:
	$strSQL = "select * from skk_teams WHERE del='N' AND modifieddate IS NULL ORDER BY team ASC;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Dynamische Ausgabe der Anzahl unserer Mannschaften:
	if ($RecordCount > 0)
	{
		// Alle Mannschaften ausgeben:
		$i = 0;
			
		while ($rsRow = $rs->fetch_assoc())
		{
			$curID[$i] = $rsRow["id"];
			$curTeam[$i] = $rsRow["team"];
		   	$curLevel[$i] = $rsRow["league"];
		   	$NumberOfPlayers[$i]= $rsRow["numberofplayers"];

			echo "<SPAN CLASS=he1><IMG SRC='../pics/admin/team.png' width='17' height='17'> ".formatoutput($curTeam[$i])." (Aktuelle Liga: ".formatoutput($curLevel[$i]).")</SPAN><BR><BR>";
			
			// Nach der aktuellen Tabelle über die Neuigkeiten suchen:
			$strSQL = "SELECT MAX(createdate), contentid, del, modifieddate, teamid FROM skk_news GROUP BY ";
			$strSQL = $strSQL."teamid, contentid, del, modifieddate HAVING del='N' AND modifieddate IS NULL ";
			$strSQL = $strSQL."AND teamid=".$curID[$i];

			$rsNews = mysqli_query($objDBCon, $strSQL);
			$RecordCountNews = mysqli_num_rows($rsNews);
			
			// Konnte etwas gefunden werden?
			if ($RecordCountNews > 0)
			{
				$row = $rsNews->fetch_object();
				$contentID = $row->contentid;

				if ($contentID != "")
				{
					// Die Tabelle holen:
					$strSQL = "SELECT content, createdate FROM skk_content WHERE id=".$contentID." AND del='N' AND modifieddate IS NULL;";
					
					$rsContent = mysqli_query($objDBCon, $strSQL);
					$RecordCountContent = mysqli_num_rows($rsContent);
					
					// Konnte etwas gefunden werden?
					if ($RecordCountContent > 0)
					{
						$row = $rsContent->fetch_object();
						$content = $row->content;
						$contentcreatedate = $row->createdate;


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
			for ($j=1;$j<=16;$j++)
	  		{

				// ###########################
	  			// Die Spielerdaten ermitteln:
				//$id_member[$j] = mysql_result($result,$nrak,"P".$j);
	  			$id_member = $rsRow["P".$j];
				// $strSQL = "SELECT name, vorname, dwz, elo, title, picture FROM skk_members WHERE ID=".$id_member[$j]." AND del='N' AND modifieddate IS NULL;";
	  			$strSQL = "SELECT name, vorname, dwz, elo, title, picture FROM skk_members WHERE ID=".$id_member." AND del='N' AND modifieddate IS NULL;";
	  			
				$rsMember = mysqli_query($objDBCon, $strSQL);
				$RecordCountMember = mysqli_num_rows($rsMember);
				
				// Konnten die Spielerdaten ermittelt werden?
				if ($RecordCountMember > 0)
				{
					// #########################################
					// Sind wir bei den Ersatzspieler angelangt?
					if ((($NumberOfPlayers[$i]) + 1) == $j)
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
					
					// Ausgabe der Spielerdaten:
					$row = $rsMember->fetch_object();
					
					$Name = $row->name;
	  				$Vorname = $row->vorname;
	  				$DWZ = $row->dwz;
	  				$ELO = $row->elo;
	  				$Titel = $row->title;
	  				$Bild = $row->picture;

					if (trim($Name)!="")
					{
						 // Die Brettnummer:
						if ($j%2==0)
			   			{
			   				echo "<tr width='15%' bgcolor=eeeeee><td><p align='center'>$j</p></td>".chr(13).chr(10);
			   			}
			  			else
			   			{
			   				echo "<tr width='15%' bgcolor=fefefe><td><p align='center'>$j</p></td>".chr(13).chr(10);
			   			}

						echo "<td>".formatoutput($Name)."</td>".chr(13).chr(10);
						echo "<td>".formatoutput($Vorname)."</td>".chr(13).chr(10);
						echo "<td><p align='center'>$DWZ</p></td>".chr(13).chr(10);
						echo "<td><p align='center'>$ELO</p></td>".chr(13).chr(10);
						echo "<td><p align='center'>$Titel</p></td>".chr(13).chr(10);

						if (is_file("../admin/members/pics/".$Bild))
						{
							echo "<td><p align='center'><IMG SRC='../admin/members/pics/".$Bild."' width='50' height='50'></p></td>".chr(13).chr(10);
						}
						else
						{
							echo "<td><p align='center'><IMG SRC='../admin/members/pics/dummy.png' width='50' height='50'></p></td>".chr(13).chr(10);
						}
						$bErsatzSpieler = "TRUE";
						echo "</tr>".chr(13).chr(10);
					}
				}				
	  		}
	  		echo "</table>".chr(13).chr(10);

	  		if ($bErsatzSpieler=="FALSE")
	  		{
	  			echo "<BR>Es wurden für diese Mannschaft keine Ersatzspieler hinterlegt.<BR><BR>".chr(13).chr(10);
	  			$bErsatzSpieler = "".chr(13).chr(10);
	  		}

	  		if ($RecordCountNews > 0)
	  		{
	  			// #############################
				// Den Link auf die News setzen:
				echo "<BR><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' height='10' width='15'>".chr(13).chr(10);
				echo "<a href='team_news.php?curTeam=".$curTeam[$i]."&curTeamID=".$curID[$i]."' title='Link auf News & Meldungen zu dieser Mannschaft ";
				echo "aus der aktuellen Saison.'>News & Meldungen zu dieser Mannschaft</A><BR>".chr(13).chr(10);
	  		}


	  		if (($i+1) < $RecordCount)
	  		{
	  			echo "<BR><BR><hr><BR><BR>".chr(13).chr(10);
	  		}
	  		
	  		$i++;
		}
	}
	else
	{
		echo "Es konnten keine Daten aus der Tabelle mit den Mannschaftsdaten selektiert werden.".chr(13).chr(10);
	}

	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");
	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php")
?>