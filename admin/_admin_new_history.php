<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Vereinsgeschichte erweitern", "TRUE");
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
	// 4.) Ist der aktuelle Login noch g&uuml;ltig?
	if (IsSessionValid($objDBCon, $ux, "H")==0)
	{
		// Keine G&uuml;ltigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("_admin_param_dx.php");

	$objectclassicon = "history.gif";
	include("forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Vereinsgeschichte erweitern (HISTORY - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// Die Daten aus der Datenbank ermitteln:
	// Hier überprüfen, wie viele Seiten Vereinsgeschichte es schon gibt und diese hochzählen:
	$strSQL = "SELECT text FROM skk_history WHERE del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Die nächste Seite soll entstehen:
	$RecordCount = $RecordCount + 1;

	include("forms/fields_not_null.php");

	echo "<FORM METHOD=POST ACTION='_admin_new_history_ok.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='part' Value='$RecordCount'>".chr(13).chr(10);

	echo "<TABLE cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Aktuelle Seitenzahl:</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Hier sehen Sie die aktuelle Seitenzahl. Ist diese gr&ouml;&szlig;er als 1, dann ";
		echo "sind bereits weitere Seiten mit der Geschichte des Schachklub Kriegshaber hinterlegt.</I>";
	}
	echo "</TD></TR>".chr(13).chr(10);
	echo "<TR><TD>".$RecordCount."</TD></TR>";

	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Seiteninhalt:</U></B> *";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Geben Sie hier den Inhalt der Seite Nummer ".$RecordCount." ein. Es sind alle g&auml;ngigen HTML - Tags zugelassen. ".chr(13).chr(10);
		echo "Ferner k&ouml;nnen nun auch die Zeichen ' und \" im Text verwendet werden.</I>";
	}
	echo "</TD></TR>".chr(13).chr(10);


	echo "<TR><TD><TEXTAREA COLS=80 ROWS=30 ";
	echo "style='width:100%' NAME=Text></TEXTAREA></TD>";


	echo "</TR>".chr(13).chr(10);
	echo "</TABLE><BR>".chr(13).chr(10);

	echo "<INPUT TYPE=Submit VALUE='Geschichte speichern'>".chr(13).chr(10);
	echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>