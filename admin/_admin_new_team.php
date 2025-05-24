<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neue Mannschaft hinzuf&uuml;gen");
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
	if (IsSessionValid($objDBCon, $ux, "H")==0)
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

	$curYear = substr(date("Y-m-t"),0,4);
	$curYearNext = $curYear + 1;
	
	$objectclassicon = "team.jpg";
	include("forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Neue Mannschaft f&uuml;r die Saison $curYear / $curYearNext hinzuf&uuml;gen. (TEAM - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##################################
	include("forms/fields_not_null.php");

	echo "<FORM METHOD=POST ACTION='_admin_new_team_ok.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	echo "<TABLE width='100%' border=1>".chr(13).chr(10);

	// Name:
	echo "<TR><TD width='100%'  bgcolor='#C0C0C0'><B><U>Mannschaftsbezeichnung / Liga (max. 255 Zeichen): </U></B> *".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR><I>Geben Sie hier den Namen oder die Bezeichnung der neuen Mannschaft an. Dieser Name ";
		echo "erscheint dann auch in der Auswahlliste bei News & Meldungen. Die Angabe dieses Werte ist obligatorisch.</I>";
	}

	echo "</TD></TR>".chr(13).chr(10);
 	echo "<TR>".chr(13).chr(10);
 	echo "<TD><INPUT TYPE=TEXT SIZE=50 MAXLENGTH=100 style='width:100%' NAME=Mannschaft ></TD>".chr(13).chr(10);
 	echo "</TR>".chr(13).chr(10);

 	// Anzahl der Stammspieler:
	echo "<TR><TD width='100%'  bgcolor='#C0C0C0'><B><U>Anzahl der Stammspieler: </U></B> *".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR><I>Geben Sie hier die Anzahl der Stammspieler f&uuml;r diese Mannschaft ein. Es wird Ihnen ";
		echo "sp&auml;ter automatisch die gleiche Anzahl an m&ouml;glichen Ersatzspielern vorgesteuert.</I>";
	}

	echo "</TD></TR>".chr(13).chr(10);

 	echo "<TR>".chr(13).chr(10);
 	echo "<TD><SELECT NAME=numberofplayers>".chr(13).chr(10);
	echo "<OPTION>4</OPTION>".chr(13).chr(10);
	echo "<OPTION>6</OPTION>".chr(13).chr(10);
	echo "<OPTION>8</OPTION>".chr(13).chr(10);
	echo "<OPTION>10</OPTION>".chr(13).chr(10);
	echo "<OPTION>12</OPTION>".chr(13).chr(10);
	echo "</SELECT></TD>".chr(13).chr(10);
 	echo "</TR>".chr(13).chr(10);

	// Liga:
	echo "<TR><TD width='100%'  bgcolor='#C0C0C0'><B><U>Liga: </U></B> *".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR><I>Geben Sie hier die Liga an, in welcher diese Mannschaft spielt.</I>";
	}

	echo "</TD></TR>".chr(13).chr(10);

 	echo "<TR>".chr(13).chr(10);
 	echo "<TD><SELECT NAME=Liga style='width:100%'>".chr(13).chr(10);
	echo "<OPTION>Kreisklasse C</OPTION>".chr(13).chr(10);
	echo "<OPTION>Kreisklasse B</OPTION>".chr(13).chr(10);
	echo "<OPTION>Kreisklasse A</OPTION>".chr(13).chr(10);
	echo "<OPTION>Kreisklasse III</OPTION>".chr(13).chr(10);
	echo "<OPTION>Kreisklasse II</OPTION>".chr(13).chr(10);
	echo "<OPTION>Kreisklasse I</OPTION>".chr(13).chr(10);
	echo "<OPTION>Schwabenliga II Nord</OPTION>".chr(13).chr(10);
	echo "<OPTION>Schwabenliga II S&uuml;d</OPTION>".chr(13).chr(10);
	echo "<OPTION>Schwabenliga I</OPTION>".chr(13).chr(10);
	echo "<OPTION>Regionalliga S&uuml;d-West</OPTION>".chr(13).chr(10);
	echo "<OPTION>Landesliga S&uuml;d</OPTION>".chr(13).chr(10);
	echo "<OPTION>Oberliga</OPTION>".chr(13).chr(10);
	echo "<OPTION>2. Bundesliga</OPTION>".chr(13).chr(10);
	echo "<OPTION>1. Bundesliga</OPTION>".chr(13).chr(10);
 	echo "</SELECT></TD>".chr(13).chr(10);
 	echo "</TR>".chr(13).chr(10);
  	echo "</TABLE>".chr(13).chr(10);

 	echo "<BR><INPUT TYPE=Submit VALUE='Neue Mannschaft speichern'>".chr(13).chr(10);
 	echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>











































