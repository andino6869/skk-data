<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neue Tabelle publizieren", "TRUE");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/content_get.php")?>
<?php include("../includes/db/team_get.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/date/date.php")?>
<?php
	// 1.) Das Verbindungsobjekt ermitteln:
	$con = GetCon();

	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	writeNavigationBar(999, $con, "FALSE");

	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	if (trim($ux)=="")
	{
		$ux = $_GET["ux"];
	}

	if (trim($ux)=="")
	{
		$ux = $_REQUEST["ux"];
	}

	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($con, $ux, "R")==0)
	{
		// Keine Gültigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	if (trim($dx)=="")
	{
		$dx = $_GET["dx"];
	}

	if (trim($dx)=="")
	{
		$dx = $_REQUEST["dx"];
	}

	if ($dx=="")
	{
		$dx=0;
	}

	echo "<SPAN CLASS=he1>Neue Tabelle publizieren (CONTENT - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##################################
	include("forms/fields_not_null.php");
	echo "<BR>Eine hier hinterlegte Tabelle kann dann z.B. für 'News und Meldungen' mit verwendet werden.<BR>".chr(13).chr(10);

	echo "<FORM METHOD=POST ACTION='_admin_contenteingabe_ok.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	echo "<TABLE width='100%' border=1>".chr(13).chr(10);

	// Titel:
	echo "<TR><TD width='100%'  bgcolor='#C0C0C0'><B><U>Titel (max. 255 Zeichen): </U></B> *".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR><I>Geben Sie hier den Titel der neuen Tabelle an. Diese erscheint als erste Zeile zu dieser Tabelle ".chr(13).chr(10);
		echo "in der jeweiligen News - Liste. Die Angabe dieses Werte ist obligatorisch.</I>";
	}

	echo "</TD></TR>".chr(13).chr(10);

	// ##############################################
	// Deafultwert vorsteuern:
	$now = date("Y-m-d H:i:s");
	$curYear = substr($now,0,4);
	$curMonth = substr($now,5,2);

	// In welchem Monat stehen wir gerade?
	if ($curMonth > 8)
	{
		// Es hat im aktuellen Jahr die neue Saison begonnen:
		$nextYear = $curYear + 1;
	}
	else
	{
		// Wir brauchen auch das Vorjahr!
		$nextYear = $curYear;
		$curYear = $curYear - 1;
	}

	echo "<TR><TD width='100%'><INPUT TYPE=TEXT SIZE=50 MAXLENGTH=255 style='width:100%' NAME=Titel VALUE='<Mannschaft / Ereignis, etc.> Saison ".$curYear." / ".$nextYear."'></TD></TR>";

	// Kategorie:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Kategorie:</U></B> *";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>Diese Angabe hat nur deklaratorischen Wert und wird derzeit nicht weiter ausgewertet.</I>";
	}

	echo "</TD></TR>";

	echo "<TR>".chr(13).chr(10);
	echo "<TD><SELECT NAME=Kategorie style='width:100%'><OPTION>Verein<OPTION>Jugend<OPTION>AFRO<OPTION>Verband</TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);


	// Tabelle:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Tabelle:</U></B> *";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>Hier geben Sie den Tabelleningalt ein. Es sind alle g&auml;ngigen HTML - Tags zugelassen. ";
		echo "Ferner k&ouml;nnen nun auch die Zeichen ' und \" im Text verwendet werden.</I>";
	}
	echo "</TD></TR>";


	echo "<TR>".chr(13).chr(10);
	echo "<TD><TEXTAREA COLS=50 ROWS=20 style='width:100%' NAME=Content>";

	// Defaultwert:
	//echo "<TABLE BORDER=1 Width='100%'><TR bgcolor='#C0C0C0'><TD width='100%' colspan='5'></TD></TR><TR><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD></TR></TABLE>";

	echo "</TEXTAREA></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "</TABLE>";
	echo "<BR><INPUT TYPE=Submit VALUE='Tabelle speichern'>";

	echo "</FORM>";

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($ux, $dx);

	include("../includes/forms/footer.php");
?>













































