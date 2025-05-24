<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neue Vorstandsdaten eintragen");
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
	
	$objectclassicon = "heads.png";
	include("../forms/objectclassicon.php");

	echo "<SPAN CLASS=he1>Neue Vorstandsdaten eintragen (HEADS - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##################################
	include("../forms/fields_not_null.php");

    echo "<form method=post action='_admin_new_head_ok.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	echo "<table cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
	echo "<tr><td>Vorstandsdaten f&uuml;r das Jahr: *</td><td>".chr(13).chr(10);

	$now = date("Y-m-d H:i:s");
	$curYear = substr($now,0,4);

	// Die letzten 10 Jahre bearbeitbar machen:
	$firstYear = $curYear - 10;
	$NextYear = $curYear + 1;

	echo "<SELECT NAME=year>";

	for ($i=$firstYear;$i<=$NextYear;$i++)
	{
		if ($i == $curYear)
		{
			echo "<OPTION Value='$i' SELECTED>", $i.chr(13).chr(10);
		}
		else
		{
			echo "<OPTION Value='$i'>", $i.chr(13).chr(10);
		}
	}

	echo "</SELECT>".chr(13).chr(10);
	echo "</td></tr>".chr(13).chr(10);

	echo "<tr><td>1. Vorstand (max. 255 Zeichen): *</td><td><INPUT TYPE=Text NAME=firsthead size=50></td></tr>".chr(13).chr(10);
	echo "<tr><td>2. Vorstand (max. 100 Zeichen):</td><td><INPUT TYPE=Text NAME=secondhead size=50></td></tr>".chr(13).chr(10);
	echo "<tr><td>Kassierer (max. 100 Zeichen):</td><td><INPUT TYPE=Text NAME=cashier size=50></td></tr>".chr(13).chr(10);
	echo "<tr><td>Spielleiter (max. 100 Zeichen):</td><td><INPUT TYPE=Text NAME=gameleader size=50></td></tr>".chr(13).chr(10);
	echo "<tr><td>Materialwart (max. 100 Zeichen):</td><td><INPUT TYPE=Text NAME=stuffhead size=50></td></tr>".chr(13).chr(10);
	echo "<tr><td>Schriftf&uuml;hrer (max. 100 Zeichen):</td><td><INPUT TYPE=Text NAME=writehead size=50></td></tr>".chr(13).chr(10);
	echo "<tr><td>Jugendleiter (max. 100 Zeichen):</td><td><INPUT TYPE=Text NAME=youthhead size=50></td></tr>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD>&nbsp;</TD>".chr(13).chr(10);
	echo "<TD><INPUT TYPE=Submit VALUE='Vorstandsdaten speichern'>".chr(13).chr(10);
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