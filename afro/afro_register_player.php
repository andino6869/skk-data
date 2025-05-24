<?php include("afro_header.php")?>
<?php
	writeheader("Anmeldung");
?>
<?php include("afro_navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/date/date.php")?>
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


 	// 4.) Ausgabe des Seiteninhalts:
	echo "<SPAN CLASS=he1>Anmeldung zum Augsburger Friedensfest Schach-Open ";
	echo substr(date("Y-m-t"),0,4);
	echo "</SPAN><BR><BR><BR>".chr(13).chr(10);

	echo "Bitte f&uuml;llen Sie die nachfolgenden Felder f&uuml;r die Anmeldung sorgf&auml;ltig aus.<BR><BR>".chr(13).chr(10);

	// #####################
	include("../admin/forms/fields_not_null.php");

	echo "<BR><BR>Die hier ermittelten Daten dienen ausschlie&szlig;lich zur Abwicklung der Turnierveranstaltung und werden im ";
	echo "Anschluss an das Turnier mit Ausnahme der Felder, die f&uuml;r eine Auswertung der DWZ- und ELO-Zahlen ben&ouml;tigt ";
	echo "werden, wieder gel&ouml;scht. ";
	echo "Wir weisen darauf hin, dass wir k&uuml;nftig bei einem Fehlen w&auml;hrend der Siegerehrung keine postalischen Zustellversuche ";
	echo "von Sachpreisen und Preisgeldern mehr unternehmen werden. <BR><BR>";
	echo "Aufgrund einiger Scherzanmeldungen bei den letzten Veranstaltungen wird im Rahmen der Anmeldung nun Ihre <B>IP-Adresse</B> mit protokolliert. <BR>";
	echo "Ihre Anmeldung ist ferner durch Bet&auml;tigung eines Links, der an die nun obligatorisch mit anzugebende <B>Emailadresse</B> gesendet wird, mit zu best&auml;tigen. <BR>";
	echo "Andernfalls gelten Sie f&uuml;r dieses Turnier als <B>nicht angemeldet</B> und tauchen in der Folge auch <B>nicht</B> in der Teilnehmerliste mit auf. <BR><BR>";
	echo "Durch Nutzung dieser Seite erkl&auml;ren Sie sich mit den genannten Konditionen automatisch einverstanden.<BR>";
	 

	// #####################
	echo "<FORM METHOD=POST ACTION='afro_register_player_ok.php'>".chr(13).chr(10);

	echo "<BR><table cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);

	echo "<TD WIDTH='33%'>Turnier, das Sie mitspielen m&ouml;chten: *</TD>".chr(13).chr(10);
	echo "<TD WIDTH='66%'><SELECT NAME=tournament TITLE='Beachten Sie bitte die unterschiedlichen Konditionen ".chr(13).chr(10);
	echo "(DWZ - Grenzen, Preisgelder, etc.) f&uuml;r die jeweiligen Turniere, bevor Sie sich anmelden.'>".chr(13).chr(10);
	echo "<OPTION VALUE='A' SELECTED>A-Turnier (alle Spieler)<OPTION VALUE='B'>B-Turnier (bis DWZ 1900)</SELECT></TD>".chr(13).chr(10);
 	echo "</TR>".chr(13).chr(10);

	// Nachname:
	echo "<tr><td>Nachname (max. 255 Zeichen): *</td><td><INPUT TYPE=TEXT SIZE='66%' ".chr(13).chr(10);
	echo "TITLE='Bitte tragen Sie hier Ihren Nachnamen inkl. etwaiger Präfixe wie von oder zu ein.' ".chr(13).chr(10);
	echo "MAXLENGTH=255 NAME=surname></td></tr>".chr(13).chr(10);

	// Vorname:
	echo "<tr><td>Vorname (max. 255 Zeichen): *</td><td><INPUT TYPE=TEXT SIZE='66%' ".chr(13).chr(10);
	echo "TITLE='Bitte tragen Sie hier Ihren Vornamen ein.' MAXLENGTH=255 NAME=firstname></td></tr>".chr(13).chr(10);
	
	// Emailadresse:
	echo "<tr><td>Email-Adresse (max. 255 Zeichen): *</td><td><INPUT TYPE=TEXT SIZE='66%' ".chr(13).chr(10);
	echo "TITLE='Bitte tragen Sie hier eine gültige Emailadresse ein.' MAXLENGTH=255 NAME=mailaddress></td></tr>".chr(13).chr(10);
	
	// Geburtsdatum:
	echo "<TD>Geburtsdatum (Format: TT.MM.JJJJ): *</TD><TD>".chr(13).chr(10);
	writeDateFieldBirthday("birth_day", "birth_month", "birth_year", "","","");
	echo "</TD></TR>".chr(13).chr(10);
	
	// DWZ:
	echo "<tr><td>DWZ: *</td>".chr(13).chr(10);

	echo "<TD><SELECT NAME=DWZ TITLE='Bitte wählen Sie hier Ihre aktuelle DWZ - Zahl aus. Sollten Sie derzeit ";
	echo "keine DWZ - Zahl haben, dann wählen Sie bitte ".chr(34)."-".chr(34)." aus.'><OPTION VALUE='-' SELECTED>-".chr(13).chr(10);

	for ($i=500;$i<2800;$i++)
	{
		echo "<OPTION VALUE='$i'>".$i.chr(13).chr(10);
	}

	echo "</SELECT></TD>".chr(13).chr(10);
 	echo "</TR>".chr(13).chr(10);

	echo "<tr><td>ELO: *</td>";

	echo "<TD><SELECT NAME=ELO TITLE='Bitte wählen Sie hier Ihre aktuelle ELO - Zahl aus. Sollten Sie derzeit ";
	echo "keine ELO - Zahl haben, dann wählen Sie bitte ".chr(34)."-".chr(34)." aus.'><OPTION VALUE='-' SELECTED>-".chr(13).chr(10);

	for ($i=500;$i<2800;$i++)
	{
		echo "<OPTION VALUE='$i'>".$i.chr(13).chr(10);
	}

	echo "</SELECT></TD>".chr(13).chr(10);
 	echo "</TR>".chr(13).chr(10);

	echo "<tr><td>Titel:</td>".chr(13).chr(10);

	echo "<TD><SELECT NAME=title TITLE='Bitte wählen Sie hier Ihren aktuellen FIDE - Titel aus. Sollten Sie derzeit ";
	echo "keinen FIDE - Titel haben, dann wählen Sie bitte ".chr(34)."-".chr(34)." aus.'><OPTION VALUE='-' SELECTED>-".chr(13).chr(10);

	echo "<OPTION VALUE='CM'>Candidate Master".chr(13).chr(10);
	echo "<OPTION VALUE='FM'>FIDE Meister".chr(13).chr(10);
	echo "<OPTION VALUE='IM'>Internationaler Meister".chr(13).chr(10);
	echo "<OPTION VALUE='GM'>Gro&szlig;meister".chr(13).chr(10);
	echo "<OPTION VALUE='WGM'>Woman Grand Master".chr(13).chr(10);

	echo "</SELECT></TD>".chr(13).chr(10);
 	echo "</TR>".chr(13).chr(10);

	echo "<tr><td>Verein (max. 255 Zeichen): *</td><td><INPUT TYPE=TEXT SIZE='66%' MAXLENGTH=255 NAME=organization ";
	echo "TITLE='Hier geben Sie bitte den Verein an, bei dem Sie Mitglied sind. Sind Sie derzeit kein ";
	echo "Vereinsmitglied, dann tragen Sie hier bitte ".chr(34)."vereinslos".chr(34)." ein.'></td></tr>".chr(13).chr(10);
	echo "<TR><TD>&nbsp;</TD>";
	echo "<TD><INPUT TYPE=SUBMIT VALUE='Ja, ich will mich verbindlich anmelden'><BR><BR>".chr(13).chr(10);
	echo "</td></TR>".chr(13).chr(10);
	echo "</table>".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);

	// Achtung, hier kein Link auf "Ich möchte mich anmelden"!
	include("afro_middler.php");

	echo "<BR><BR>".chr(13).chr(10);

	include("afro_downloads.php");
	get_downloads($objDBCon);
	include("afro_footer.php");
?>