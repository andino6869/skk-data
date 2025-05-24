<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Partien");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>

<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################
	
	// Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// UPDATE Schneider 05.05.2008:
	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	writeNavigationBar(7, $objDBCon);
	// UPDATE Ende

	// UPDATE Schneider 06.05.2008:
	// Nur sinnvolle Datensätze ausgeben:
	$now = date("Y-m-d H:i:s");
	$curYear = substr($now,0,4);
	$curMonth = substr($now,5,2);

	// In welchem Monat stehen wir gerade?
	if ($curMonth > 8)
	{
		// Es hat im aktuellen Jahr die neue Saison begonnen:
		$curYear = $curYear - 0;
	}
	else
	{
		// Wir brauchen auch das Vorjahr!
		$curYear = $curYear - 1;
	}

	echo "<SPAN CLASS=he1>Archivierte Partien seit 01.09.$curYear (absteigend nach Datum sortiert)</SPAN><BR><BR>".chr(13).chr(10);
	echo "Hinweis: F&uuml;r eine korrekte Darstellung der Partien m&uuml;ssen Javaskripte in Ihrem Browser zugelassen sein.<BR>".chr(13).chr(10);
	echo "Partien, die mit einem Passwort gesch&uuml;tzt worden sind, werden mit einem Schloss dargestellt.<BR><BR>";

	$strSQL = "select * from skk_games where gamedate IS NOT NULL AND gamedate>='".(string)$curYear."-09-01' ";
	$strSQL = $strSQL."AND del='N' and modifieddate IS NULL ORDER ";
	$strSQL = $strSQL."BY gamedate DESC";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
	   	   $ID[$i] = $row->id;

	   	   $player1[$i] = $row->player1;
	   	   $player2[$i] = $row->player2;

	   	   $club1[$i] = $row->club1;
	   	   $club2[$i] = $row->club2;

		   $event[$i] = $row->event;
		   $gamedate[$i] = $row->gamedate;
		   $password[$i] = $row->password;

		   $creator[$i] = $row->creator;
		   
		   $i++;
	    }

		for($i=0; $i<$RecordCount; $i++)
		{
			echo "<table border=0><tr><td valign=top colspan=4 width=520>".chr(13).chr(10);

			$strItem = $player1[$i];

			// Der Verein Spieler Weiss:
			if (trim($club1[$i]) != "")
			{
				$strItem = $strItem." (".$club1[$i].") - ";
			}
			else
			{
				$strItem = $strItem." - ";
			}

			$strItem = $strItem.$player2[$i];

			// Der Verein Spieler Schwarz:
			if (trim($club2[$i]) != "")
			{
				$strItem = $strItem." (".$club2[$i].")";
			}


			// Partie verschlüsselt?
			if (trim($password[$i])=="")
			{
				echo "<IMG SRC='../pics/icons/matches.jpg' width=13 heigth=13 border=0><a href='../matches/game.php?Nr=".$ID[$i]."'> ".formatoutput($strItem)."</A>".chr(13).chr(10);
			}
			else
			{
				echo "<IMG SRC='../pics/icons/locked.jpg' width=13 heigth=13 border=0><a href='../matches/game.php?Nr=".$ID[$i]."'> ".formatoutput($strItem)."</A>".chr(13).chr(10);
			}

			$strItem = $event[$i];
			$strItem = str_replace("\'", "'", $strItem);
			$strItem = str_replace("\\".chr(34), chr(34), $strItem);

		  	echo "</td></tr><tr><td colspan=4 width=520>".formatoutput($strItem).chr(13).chr(10);
		  	echo "</td></tr>".chr(13).chr(10);
			echo "<tr><td width='100%'>[gespielt am: ".substr($gamedate[$i], 8, 2).".".substr($gamedate[$i],5,2).".".substr($gamedate[$i],0,4).", erfasst von ".$creator[$i]."]".chr(13).chr(10);
		  	echo "</table><BR><BR>".chr(13).chr(10);
		 }
	}
	else
	{
		echo "Es sind derzeit keine Partien eingestellt.".chr(13).chr(10);
	}

	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>

























