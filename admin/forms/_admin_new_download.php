<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neuen Download hinzuf&uuml;gen");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/date/date.php")?>

<?php
	// 1.) Das Verbindungsobjekt ermitteln:
	$con = GetCon();

	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $con, "FALSE");


	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("../_admin_param_ux.php");


	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($con, $ux, "H")==0)
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

	$objectclassicon = "download.jpg";
	include("../forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Neuen Download hinzuf&uuml;gen (DOWNLOAD - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##################################
	include("../forms/fields_not_null.php");
    echo "<form method=".Chr(34)."POST".Chr(34)." action=".Chr(34)."_admin_new_download_ok.php".Chr(34)." enctype=".Chr(34)."multipart/form-data".Chr(34)." >".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE=".Chr(34)."HIDDEN".Chr(34)." NAME=".Chr(34)."ux".Chr(34)." Value=".Chr(34)."$ux".Chr(34).">".chr(13).chr(10);
	echo "<INPUT TYPE=".Chr(34)."HIDDEN".Chr(34)." NAME=".Chr(34)."dx".Chr(34)." Value=".Chr(34)."$dx".Chr(34).">".chr(13).chr(10);
	echo "<INPUT TYPE=".Chr(34)."HIDDEN".Chr(34)." NAME=".Chr(34)."MAX_FILE_SIZE".Chr(34)." value=".Chr(34)."1024000".Chr(34).">".chr(13).chr(10);

	// Die Tabelle erstellen:
	echo "<TABLE width=".Chr(34)."100%".Chr(34)." border=1>".chr(13).chr(10);

	// ##########
	// Die Datei:
	echo "<TR><TD width=".Chr(34)."100%".Chr(34)." bgcolor=".Chr(34)."#C0C0C0".Chr(34)."><B><U>Datei für Download: *</U></B>".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Erlaubte Dateitypen: doc, rtf, tif, pdf, pgn, zip / Max. ";
		echo "Gr&ouml;ße: 1024 KB / Keine Leer- und Sonderzeichen im Dateinamen.</I>".chr(13).chr(10);
	}
	echo "</TD></TR>".chr(13).chr(10);

	echo "<TR><TD width=".Chr(34)."100%".Chr(34)."><input type=".Chr(34)."file".Chr(34)." name=".Chr(34)."file".Chr(34)." style=".Chr(34)."width:100%".Chr(34)."></td></tr>".chr(13).chr(10);

	// ###########
	// Gültigkeit:
	echo "<TR><TD width=".Chr(34)."100%".Chr(34)." bgcolor=".Chr(34)."#C0C0C0".Chr(34)."><B><U>Download soll g&uuml;ltig sein bis (Format: TT.MM.JJJJ): *</U></B>";
	echo "</TD></TR>".chr(13).chr(10);

	echo "<TR><TD width=".Chr(34)."100%".Chr(34).">";

	writeDateField("expire_day", "expire_month", "expire_year", "","","");

	echo "</TD></TR>".chr(13).chr(10);

	// Kategorie:
	echo "<TR><TD width=".Chr(34)."100%".Chr(34)." bgcolor=".Chr(34)."#C0C0C0".Chr(34)."><B><U>Kategorie:</U></B>".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Beim Wert ".Chr(34)."Alle".Chr(34)." wird dieser Donwload generell angeboten. Bei AFRO NUR auf der AFRO - Seite!</I>".chr(13).chr(10);
	}
	echo "</TD></TR>".chr(13).chr(10);


	echo "<TR><TD width=".Chr(34)."100%".Chr(34)."><SELECT NAME=category style=".Chr(34)."width:100%".Chr(34)." TITLE=".Chr(34)."Beim Wert Alle wird dieser Download generell angeboten. Bei AFRO NUR auf der AFRO - Seite!".Chr(34).">".chr(13).chr(10);
	echo "<OPTION Value=".Chr(34)."0".Chr(34).">Alle".chr(13).chr(10);
	echo "<OPTION Value=".Chr(34)."1".Chr(34).">AFRO".chr(13).chr(10);
	echo "</SELECT>".chr(13).chr(10);
	echo "</td></tr>".chr(13).chr(10);

	// Anzeigename:
	echo "<TR><TD width=".Chr(34)."100%".Chr(34)." bgcolor=".Chr(34)."#C0C0C0".Chr(34)."><B><U>Anzeigename im Downloadbereich (max. 100 Zeichen):</U></B>".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Geben Sie hier die Beschreibung an, wie dieser Link im Browserfenster dann angezeigt werden soll.</I>".chr(13).chr(10);
	}
	echo "</TD></TR>".chr(13).chr(10);
	echo "<TR><TD width=".Chr(34)."100%".Chr(34)."><INPUT TYPE=Text style=".Chr(34)."width:100%".Chr(34)." NAME=viewname TITLE=".Chr(34)."Geben Sie hier die Beschreibung an, wie dieser Link im Browserfenster dann angezeigt werden soll.".Chr(34)." size=50></td></tr>".chr(13).chr(10);
	echo "</table>".chr(13).chr(10);

	echo "<BR><INPUT TYPE=".Chr(34)."submit".Chr(34)." VALUE=".Chr(34)."Download absenden".Chr(34).">".chr(13).chr(10);
	echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'><BR><BR>".chr(13).chr(10);
	
	echo "</FORM>".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($ux, $dx);

	include("../../includes/forms/footer.php");
?>