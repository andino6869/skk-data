<?php include("afro_header.php")?>
<?php
	writeheader("Impressum");
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
	echo "<SPAN CLASS=he1>Impressum</SPAN><BR><BR>";
	echo "<TABLE>";
	echo "<TR><TD width=200 VALIGN=TOP><b>Kontakt</b></TD>";
    echo "<TD>";
    echo "SK Kriegshaber e.V.<BR>";
    echo "Ulmer Str. 182<BR>";
    echo "86156 Augsburg<BR>";
    echo "Telefon 0821-401267<BR><BR>";
    echo "</TD></TR>";
	echo "<TR><TD width=200 VALIGN=TOP><b>Programmierung und Entwicklung:</b></TD><TD>Stefan Schneider<BR><BR></TD></TR>";
	echo "<TR><TD width=200 VALIGN=TOP><b>Systemkonfiguration und Administration:</b></TD><TD>Andreas Stör und Elmar Bartel<BR><BR></TD></TR>";
	echo "<TR><TD width=200 VALIGN=TOP><b>Version</b></TD><TD>2.0.2 vom 01.12.2008<BR><BR></TD></TR>";
    echo "<TR><TD colspan=2><b>Copyright © 1999-";
	echo substr(date("Y-m-t"),0,4);
	echo " - alle Rechte vorbehalten.</b>";
	echo "</TD></TR>";
	echo "</TABLE>";

	include("afro_middler.php");
	include("afro_user_registration.php");

	get_user_registration($con);

	echo "<BR><BR><BR><BR>";

	include("afro_downloads.php");
	get_downloads();
	include("afro_footer.php");
?>