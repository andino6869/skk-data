<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neue Fotogalerie erstellen");
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

	// #############################
	// 6.) Die Überschrift ausgeben:
	$objectclassicon = "galery.gif";
	include("../forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Neue Fotogalerie erstellen (GALERY - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##################################
	include("../forms/fields_not_null.php");
    echo "<form method=post action='_admin_new_galery_ok.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	echo "<TABLE cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);

	// Objektname:
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Name der Fotogalerie (max. 255 Zeichen): *</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Hier geben Sie den Namen der Fotogalerie ein, die Sie neu erstellen m&ouml;chten. ";
		echo "Im Anschluss k&ouml;nnen der Galerie dann die Bilder zugeordnet werden.</I>";
	}
	echo "</TD></TR>".chr(13).chr(10);
	echo "<tr><td><INPUT TYPE=Text NAME=galery style='width:100%' size=255 MAXLENGTH=255></td></tr>".chr(13).chr(10);

	// #######################
	// Kategorie:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Kategorie:</U></B> *";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>Je nach gew&auml;hlter Kategorie wird diese Fotogalerie dann in der Liste mit einem anderen f&uuml;hrenden Icon dargestellt.</I>";
	}

	echo "</TD></TR>";

	echo "<TR><TD width='100%'>";
	echo "<SELECT NAME=category style='width:100%'>";
	echo "<OPTION VALUE='AFRO' CHECKED>AFRO";
	echo "<OPTION VALUE='Erwachsene'>Erwachsene";
	echo "<OPTION VALUE='Jugend'>Jugend";
	echo "<OPTION VALUE='Sport'>Sport</SELECTED></TD></TR>";

	// ###############################
	// Das aktuelle Datum vorsteuern:
	echo "</TABLE><TABLE cellpadding=5 cellspacing=0 border=1 width='100%'>";
	echo "<TR><TD width='75%' bgcolor='#C0C0C0'><B><U>Datum der Fotogalerie: *</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>Hier geben Sie das Datum der Fotogalerie ein. Es wird Ihnen automatisch das Systemdatum vorgeschagen. ";
		echo "Das hier gew&auml;hlte Daum ist ma&szlig;geblich f&uuml;r die Zuordnung der Fotogalerie in der Liste der News zu einem ";
		echo "bestimmten Monat und ein bestimmtes Jahr. Das Eingabeformat ist TT.MM.JJJJ.</I>";
	}

	echo "</TD>";
	echo "<TD width='25%'>";

	// Das aktuelle Datum vorsteuern:
	$now = date("Y-m-d");
	$curYear = substr($now,0,4);
	$curMonth = substr($now,5,2);
	$curDay = substr($now,8,2);

 	writeDateField("galerydate_day", "galerydate_month", "galerydate_year", $curDay, $curMonth, $curYear, "FALSE");

 	echo "</TD></TR>";


	echo "</table>".chr(13).chr(10);
	echo "<BR><INPUT TYPE=Submit VALUE='Neue Galerie speichern'>".chr(13).chr(10);
	echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>