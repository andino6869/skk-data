<?php include("afro_header.php")?>
<?php
	writeheader("Tabellen");
?>
<?php include("afro_navigation.php")?>
<?php include("../includes/db/connection.php")?>

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

	// 3.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(6, $objDBCon);


	/// 4.) Die AFRO - Tabellen aus dem aktuellen Jahr:
	// Es reichen die Daten des letzten Jahres.
	$now = date("Y-m-d H:i:s");
	$curYear = substr($now,0,4);

	$strSQL = "select * from skk_content WHERE contentdate>'".(string)$curYear."-01-01' AND ";
	$strSQL = $strSQL."title IS NOT NULL AND title != ''AND del='N' AND modifieddate IS NULL ";
    $strSQL = $strSQL."AND category = 'AFRO' ORDER BY title DESC, contentdate DESC";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Konnten Datensätze gefunden werden?
	if ($RecordCount != 0)
	{
		echo "<h3><span style='font-size: large; mso-font-kerning: 14.0pt; color: #c3ccd0'>Alle Tabellen aus dem AFRO ".$curYear ."</span></h3><BR>".chr(13).chr(10);
		
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$ID[$i] = $row->id;
			$Datum[$i] = $row->contentdate;
			$Titel[$i] = $row->title;
			$Kategorie[$i] = $row->category;
			$Content[$i] = $row->content;
			$creator[$i] = $row->creator;
			$i++;
		}
		
		// Die Daten ausgeben:
		for($i=0;$i<$RecordCount;$i++)
		{
		  	echo "<table border=0><tr><td width='100%' valign=top>".chr(13).chr(10);
		  	echo "<a href='afro_content_view.php?Nr=".$ID[$i]."'>".chr(13).chr(10);
		  	echo "<IMG SRC='../pics/icons/pfeilrotaufgelb.gif' border=0> &nbsp;".chr(13).chr(10);
		  	echo $Titel[$i]."</A><BR>&nbsp;&nbsp;&nbsp;&nbsp;[".substr($Datum[$i], 8, 2).".".substr($Datum[$i],5,2).".".substr($Datum[$i],0,4)."]".chr(13).chr(10);
			echo "<I> von ".trim($creator[$i])."</I>".chr(13).chr(10);
		  	echo "</td></tr></table>".chr(13).chr(10);
		}

		echo "<HR><BR>";
	}


	// 5.) Den Seiteninhalt aus der Datenbank holen:
	// Gibt den Inhalt der Linktabelle aus.
	$strSQL = "SELECT text FROM skk_afro_tables WHERE del='N' AND modifieddate IS NULL AND text IS NOT NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
   			$text[$i] = $row->text;
   			echo $text[$i];
   			$i++;
  		}
	}
	else
	{
		echo "Es sind derzeit keine <B>Tabellen</B> für das Augsburger Friedensfest Schachopen (AFRO) hinterlegt.".chr(13).chr(10);
	}

	include("afro_middler.php");
	include("afro_user_registration.php");

	get_user_registration($objDBCon);

	include("afro_downloads.php");
	get_downloads($objDBCon);
	include("afro_footer.php");
?>