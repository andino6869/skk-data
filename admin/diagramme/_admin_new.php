<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neues Schachdiagramm hinzuf&uuml;gen");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/date/date.php")?>

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
	include("../_admin_param_ux.php");


	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "R")==0)
	{
		// Keine Gültigkeit mehr!
		include("../../includes/forms/middler.php");
		include("../forms/navigation_access_denied.php");
		include("../../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("../_admin_param_dx.php");

	$objectclassicon = "schachbrett.png";
	include("../forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Neues Schachdiagramm hinzuf&uuml;gen (Diagramm - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##################################
	include("../forms/fields_not_null.php");
    echo "<BR><BR><form method=".Chr(34)."POST".Chr(34)." action=".Chr(34)."_admin_new_ok.php".Chr(34)." enctype=".Chr(34)."multipart/form-data".Chr(34).">".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE=".Chr(34)."HIDDEN".Chr(34)." NAME=".Chr(34)."ux".Chr(34)." Value=".Chr(34)."$ux".Chr(34).">".chr(13).chr(10);
	echo "<INPUT TYPE=".Chr(34)."HIDDEN".Chr(34)." NAME=".Chr(34)."dx".Chr(34)." Value=".Chr(34)."$dx".Chr(34).">".chr(13).chr(10);
	echo "<INPUT TYPE=".Chr(34)."HIDDEN".Chr(34)." NAME=".Chr(34)."MAX_FILE_SIZE".Chr(34)." value=".Chr(34)."1024000".Chr(34).">".chr(13).chr(10);
	
	// Die Tabelle erstellen:
	echo "<TABLE width=".Chr(34)."100%".Chr(34)." border=1>".chr(13).chr(10);

	// ##########
	// Die Datei:
	echo "<TR><TD width=".Chr(34)."100%".Chr(34)." bgcolor=".Chr(34)."#C0C0C0".Chr(34)."><B><U>Datei f&uuml;r Schachdiagramm:</U></B> *".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Erlaubte Dateitypen: gif, jpg, png / Max. ";
		echo "Gr&ouml;&szlig;e: 1024 KB / Keine Leer- und Sonderzeichen im Dateinamen.</I>".chr(13).chr(10);
	}
	echo "</TD></TR>".chr(13).chr(10);

	echo "<TR><TD width=".Chr(34)."100%".Chr(34)."><input type=".Chr(34)."file".Chr(34)." name=".Chr(34)."diagramm_file".Chr(34)." style=".Chr(34)."width:100%".Chr(34)."></td></tr>".chr(13).chr(10);

	// ##########################
	// Titel des Schachdiagramms:
	echo "<TR><TD width=".Chr(34)."100%".Chr(34)." bgcolor=".Chr(34)."#C0C0C0".Chr(34)."><B><U>Titel des Schachdiagramms (max. 100 Zeichen):</U></B> *".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Geben Sie hier die Beschreibung an, mit der dieses Diagramm beschriftet werden soll.</I>".chr(13).chr(10);
	}
	echo "</TD></TR>".chr(13).chr(10);
	echo "<TR><TD width=".Chr(34)."100%".Chr(34)."><INPUT TYPE=Text style=".Chr(34)."width:100%".Chr(34)." NAME=diagramm_title TITLE=".Chr(34)."Geben Sie hier den Titel an, mit dem das Diagramm dann angezeigt werden soll.".Chr(34)." size=100></td></tr>".chr(13).chr(10);
	
	// #####
	// Höhe:
	echo "<TR><TD width=".Chr(34)."100%".Chr(34)." bgcolor=".Chr(34)."#C0C0C0".Chr(34)."><B><U>Optionale H&ouml;he des Schachdiagramms:</U></B>".chr(13).chr(10);
	
	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Geben Sie hier optional die H&ouml;he des Schachdiagramms an, wie dieses dann dargestellt werden soll.</I>".chr(13).chr(10);
	}
	echo "</TD></TR>".chr(13).chr(10);
	echo "<TR><TD width=".Chr(34)."100%".Chr(34)."><INPUT TYPE=Text style=".Chr(34)."width:100%".Chr(34)." NAME=diagramm_height TITLE=".Chr(34)."Geben Sie hier optional die H&ouml;he des Schachdiagramms an, wie dieses dann dargestellt werden soll.".Chr(34)." size=4></td></tr>".chr(13).chr(10);
	
	// #######
	// Breite:
	echo "<TR><TD width=".Chr(34)."100%".Chr(34)." bgcolor=".Chr(34)."#C0C0C0".Chr(34)."><B><U>Optionale Breite des Schachdiagramms:</U></B>".chr(13).chr(10);
	
	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Geben Sie hier optional die Breite des Schachdiagramms an, wie dieses dann dargestellt werden soll.</I>".chr(13).chr(10);
	}
	echo "</TD></TR>".chr(13).chr(10);
	echo "<TR><TD width=".Chr(34)."100%".Chr(34)."><INPUT TYPE=Text style=".Chr(34)."width:100%".Chr(34)." NAME=diagramm_width TITLE=".Chr(34)."Geben Sie hier optional die Breite des Schachdiagramms an, wie dieses dann dargestellt werden soll.".Chr(34)." size=4></td></tr>".chr(13).chr(10);	
	
	
	echo "</table>".chr(13).chr(10);
	echo "<BR><INPUT TYPE=".Chr(34)."submit".Chr(34)." VALUE=".Chr(34)."Diagramm absenden".Chr(34).">".chr(13).chr(10);
	echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'><BR><BR>".chr(13).chr(10);
	
	echo "</FORM>".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>