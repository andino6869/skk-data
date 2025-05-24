<?php include("afro_header.php")?>
<?php
	writeheader("Ausschreibung");
?>
<?php include("afro_navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>

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
  	writeNavigationBar(1, $objDBCon);

	// 4.) Den Seiteninhalt aus der Datenbank holen:
	$strSQL = "SELECT text FROM skk_afro_writeout WHERE del='N' AND modifieddate IS NULL AND text IS NOT NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$text[$i] = $row->text;
			echo formatoutput($text[$i]);
			$i++;
		}
	}
	else
	{
		echo "Es sind derzeit keine <B>Ausschreibungsdaten</B> für das nächste Augsburger Friedensfest Schachopen (AFRO) hinterlegt.".chr(13).chr(10);
	}

	include("afro_middler.php");
	include("afro_user_registration.php");

	get_user_registration($objDBCon);

	include("afro_downloads.php");
	get_downloads($objDBCon);

	echo "<BR><BR><font color=#4300FF><b>Nachrichten - Ticker:</B></font><HR noshade size=1>".chr(13).chr(10);
	echo '<A HREF="../rss/rss_afro.xml"><img src="../rss/rss.jpg" width="10" height="10" border=0 alt="RSS 2.0">&nbsp;&nbsp;AFRO - Nachrichten Ticker einrichten</a>';

	include("afro_footer.php");
?>