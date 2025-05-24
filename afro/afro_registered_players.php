<?php include("afro_header.php")?>
<?php
	writeheader("Angemeldete Spieler");
?>
<?php include("afro_navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("afro_registered_players_get.php")?>
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
  	writeNavigationBar(999, $objDBCon);

	// 4.) Den Seiteninhalt ausgeben:
	echo "<table width='100%' border='0'>".chr(13).chr(10);
	echo "<tbody><tr>".chr(13).chr(10);
	echo "<td>".chr(13).chr(10);
	echo "<font size='4' color='#c3ccd0'><br><b>Voranmeldungen</b><br><br></font>".chr(13).chr(10);


	// Die Speiler aus dem A - Turnier lesen:
	get_player($objDBCon, "A");

	echo "<BR><BR><BR>".chr(13).chr(10);

	// Die Spieler aus dem B - Turnier lesen:
	get_player($objDBCon, "B");


	echo "</td>".chr(13).chr(10);
	echo "</tr>".chr(13).chr(10);
	echo "</tbody></table>".chr(13).chr(10);


	// Der übliche Rest:
  	include("afro_middler.php");
	include("afro_user_registration.php");

	get_user_registration($objDBCon);

	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("afro_downloads.php");
	get_downloads($objDBCon);
	include("afro_footer.php");
?>