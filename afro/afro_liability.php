<?php include("afro_header.php")?>
<?php
	writeheader("Haftungsausschluss");
?>
<?php include("afro_navigation.php")?>
<?php include("../includes/db/connection.php")?>

<?php
	// 1.) Datenbankverbindung aufbauen:
	$con = GetCon();

	// Gab es Probleme?
	if ($con == "")
	{
		echo "<BR>Problem mit dem Verbindungsaufbau zur Datenbank: Das Verbindungsobjekt konnte nicht erzeugt werden!<BR>";
		echo "</BODY></HTML>";
		exit;
	}

	// 2.) Prüfen, ob der Zugang auf die AFRO - Seite aktuell überhaupt erlaubt ist:
	if (bIsAFROValid($con)==0)
	{
		// Keine Gültigkeit mehr!
		include("afro_middler.php");
		include("afro_footer.php");

		exit;
	}

	// 3.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $con);

	// 4.) Den Seiteninhalt ausgeben:
		echo "<SPAN CLASS=he1>Haftungsausschluss</SPAN><BR><BR>";
		echo "<DIV ALIGN=JUSTIFY>";
	
		echo "Links, die sich auf dieser Web-Seite befinden, gew&auml;hren m&ouml;glicherweise Zugang zu Web-Seiten, die seitens des Schachklub Kriegshaber nicht überwacht werden. ";
		echo "Solange der Schachklub Kriegshaber keinen Einfluss &uuml;ber den Inhalt dieser Seiten hat, macht sich der Schachklub Kriegshaber oder seine Vorstandschaft diese nicht zu eigen ";
		echo "und ist f&uuml;r diese somit auch nicht verantwortlich oder haftbar zu machen. Insbesondere sollte ein Link nicht die Notwendigkeit begr&uuml;nden, diesem auch zu folgen.";
		echo "<BR><BR>";

		echo "Die im Bereich 'News & Meldungen' bzw. in den 'Kommentaren' ge&auml;ußerten Meinungen und Ansichten sind ";
		echo "nicht zwangsl&auml;ufig auch die Meinung und Ansicht des Schachklub Kriegshaber oder dessen Vorstandsmitglieder. Generell ist jeder ";
		echo "Redakteur und jeder Kommentator f&uuml;r seine gehosteten Eintr&auml;ge selbst verantwortlich.";
		echo "<BR><BR>";
		echo "</DIV>";

	include("afro_middler.php");
	include("afro_user_registration.php");

	get_user_registration($con);

	echo "<BR><BR><BR><BR>";

	include("afro_downloads.php");
	get_downloads();
	include("afro_footer.php");
?>