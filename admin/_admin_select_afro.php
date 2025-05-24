<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - AFRO - Daten bearbeiten");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// 1.) Das Verbindungsobjekt ermitteln:
	$objDBCon = GetCon();

	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon, "FALSE");

	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("_admin_param_ux.php");

	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "A")==0)
	{
		// Keine Gültigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("_admin_param_dx.php");
	
	$objectclassicon = "afro.gif";
	include("forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>AFRO - Daten bearbeiten (AFRO - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);
	echo "<form method=post action='_admin_edit_afro.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	// Die Tabelle erstellen:
	echo "<TABLE width='100%' border=1>".chr(13).chr(10);
	echo "<TR><TD width='100%'  bgcolor='#C0C0C0'><B><U>Eintrag:</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>W&auml;hlen Sie hier den AFRO - Seitenbereich aus, den Sie bearbeiten m&ouml;chten.</I>";
	}
	echo "</TD></TR>".chr(13).chr(10);

	echo "<TR><TD width='100%'><SELECT NAME=Nr style='width:100%'>".chr(13).chr(10);

	echo "<OPTION Value='0'>AFRO - Anfahrt bearbeiten".chr(13).chr(10);
	echo "<OPTION Value='1'>AFRO - Ausschreibung bearbeiten".chr(13).chr(10);
	echo "<OPTION Value='2'>AFRO - Ergebnisse bearbeiten".chr(13).chr(10);
	echo "<OPTION Value='3'>AFRO - Hoteldaten bearbeiten".chr(13).chr(10);
	echo "<OPTION Value='4'>AFRO - Kontaktdaten bearbeiten".chr(13).chr(10);
	echo "<OPTION Value='5'>AFRO - Seiteneinstellungen bearbeiten".chr(13).chr(10);
	echo "<OPTION Value='6'>AFRO - Tabellen bearbeiten".chr(13).chr(10);

	echo "</SELECT></TD>".chr(13).chr(10);
	echo "</tr>".chr(13).chr(10);
	echo "</table>".chr(13).chr(10);

	echo "<BR><INPUT TYPE=submit Value='AFRO - Daten bearbeiten'>".chr(13).chr(10);
	echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'".chr(13).chr(10);
	
	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
		echo "News und Meldungen für ein AFRO bearbeiten Sie über den gleichnamigen Bereich im Redaktionssystem ".chr(13).chr(10);
		echo "und w&auml;hlen dort als Kategorie bitte 'AFRO' aus.<BR><BR>".chr(13).chr(10);
		echo "Downloads für ein AFRO bearbeiten Sie &uuml;ber den Download - Bereich im Redaktionssystem ".chr(13).chr(10);
		echo "und w&auml;hlen dort als Kategorie bitte 'AFRO' aus.<BR><BR>".chr(13).chr(10);
	}

	echo "</FORM>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>

