<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neue Partie publizieren");
?>
<?php include("../includes/forms/navigation.php")?>
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
	$curUser = strGetCurrentUserByID($con, $ux);


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

	echo "<SPAN CLASS=he1>Neue Partie publizieren (MATCH - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##################################
	include("forms/fields_not_null.php");

	echo "<FORM METHOD=POST ACTION='_admin_partieeingabe_ok.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);

	echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD>Titel: *</TD>".chr(13).chr(10);
	echo "<TD><INPUT TYPE=TEXT SIZE=40 MAXLENGTH=100 NAME=Titel></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD>Datum (Format: TT.MM.JJJJ):</TD><TD>".chr(13).chr(10);

	writeDateField("matchdate_day", "matchdate_month", "matchdate_year", "","","");

	echo "</TD></TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD>Kurztext: *</TD>".chr(13).chr(10);
	echo "<TD><TEXTAREA COLS=40 ROWS=20 NAME=Kurztext></TEXTAREA></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD>Aufstellung: *</TD>".chr(13).chr(10);
	echo "<TD><TEXTAREA COLS=40 ROWS=20 NAME=Aufstellung></TEXTAREA></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD>Partiedaten: *</TD>".chr(13).chr(10);
	echo "<TD><TEXTAREA COLS=40 ROWS=20 NAME=Partiedaten></TEXTAREA></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD>Züge: *</TD>".chr(13).chr(10);
	echo "<TD><TEXTAREA COLS=40 ROWS=20 NAME=Zuege></TEXTAREA></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD>&nbsp;</TD>".chr(13).chr(10);
	echo "<TD><INPUT TYPE=Submit VALUE='Partie speichern'></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "</TABLE>".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($ux);

	include("../includes/forms/footer.php");
?>

































