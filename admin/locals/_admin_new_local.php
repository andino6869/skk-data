<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neues Vereinslokal eintragen");
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
	if (IsSessionValid($objDBCon, $ux, "H")==0)
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
	
	$objectclassicon = "locals.png";
	include("../forms/objectclassicon.php");

	echo "<SPAN CLASS=he1>Neues Vereinslokal eintragen (LOCALS - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##################################
	include("../forms/fields_not_null.php");

    echo "<form method=post action='_admin_new_local_ok.php?ux=".$ux."&dx=".$dx."'>".chr(13).chr(10);

    // Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	echo "<table cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
	echo "<tr><td>Vereinslokal im Jahr: *</td><td>".chr(13).chr(10);

	$now = date("Y-m-d H:i:s");
	$curYear = substr($now,0,4);
	$LastYear = $curYear - 1;
	$NextYear = $curYear + 1;

	echo "<SELECT NAME=year>".chr(13).chr(10);

	echo "<OPTION Value='$LastYear'>", $LastYear.chr(13).chr(10);
	echo "<OPTION Value='$curYear'>", $curYear.chr(13).chr(10);
	echo "<OPTION Value='$NextYear'>", $NextYear.chr(13).chr(10);
	echo "</SELECT>".chr(13).chr(10);
	echo "</td></tr>".chr(13).chr(10);

	echo "<tr><td>Vereinslokal in diesem Jahr (max. 255 Zeichen): *</td><td><INPUT TYPE=Text NAME=skklocal size=50></td></tr>".chr(13).chr(10);

	echo "<TR>".chr(13).chr(10);
	echo "<TD>&nbsp;</TD>".chr(13).chr(10);
	echo "<TD><INPUT TYPE=Submit VALUE='Vereinslokaldaten speichern'>".chr(13).chr(10);
	echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);

	echo "</table>".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>