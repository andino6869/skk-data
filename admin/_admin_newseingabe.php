<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neue Meldung publizieren", "TRUE");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/content_get.php")?>
<?php include("../includes/db/team_get.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/date/date.php")?>
<?php include("_admin_param.php")?>
<?php include("../includes/string/str.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// 1.) Das Verbindungsobjekt ermitteln:
	$objDBCon = GetCon();

	// 2.) In Abh&auml;ngigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon, "FALSE");

	// ##################################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
  	include("_admin_param_ux.php");

	// ##############################################
	// 4.) Den aktuellen Dispatcher ermitteln:
	include("_admin_param_dx.php");

	// ##############################################
	// 5.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "R")==0)
	{
		// Keine G&uuml;ltigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}

	$objectclassicon = "thunder.gif";
	include("forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Neue Meldung publizieren (NEWS - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##################################
	include("forms/fields_not_null.php");

	echo "<FORM METHOD=POST ACTION=".chr(34)."_admin_newseingabe_ok.php".chr(34)." enctype=".chr(34)."multipart/form-data".chr(34).">".chr(13).chr(10);

	// Die aktuellen Benutzerdaten und den Dispatcher sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	// Die Kopfdaten:
	// Headline:
	echo "<TABLE width='100%' border=1>".chr(13).chr(10);
	echo "<TR><TD width='100%'  bgcolor='#C0C0C0'><B><U>Headline (max. 255 Zeichen):</U></B> *".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR><I>Geben Sie hier die &uuml;berschrift der neuen Meldung an. Diese erscheint als erste Zeile dieser Meldung ".chr(13).chr(10);
		echo "in der jeweiligen News - Liste. Die Angabe dieses Werte ist obligatorisch.</I>";
	}

	echo "</TD></TR>".chr(13).chr(10);
	echo "<TR><TD width='100%'><INPUT TYPE=TEXT size='100' MAXLENGTH=255 style='width:100%' NAME=Headline></TD></TR>";

	// Headline kurz:
	echo "<TR><TD width='100%'  bgcolor='#C0C0C0'><B><U>Tooltiptext (max. 100 Zeichen):</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo"<BR><BR>";
		echo "<I>Geben Sie hier optional die zweite &uuml;berschrift der neuen Meldung an. Diese Zeile erscheint als Tooltiptext dieser Meldung ";
		echo "in der jeweiligen News - Liste und in der Meldung selbst. Haben Sie ein Bild bei dieser Meldung hinterlegt, dann ";
		echo "erscheint diese Zeile direkt im Anschluss an das Bild in der Meldung.</I>";
	}
	echo "</TD></TR>";
	echo "<TR><TD width='100%'><INPUT TYPE=TEXT size='100' MAXLENGTH=100 style='width:100%' NAME=Headline2></TD></TR>";


	// Autor:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Autor dieser Meldung:</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>Dieser Wert wird automatisch aus Ihren Logindaten generiert. Der Autor einer Meldung kann nachtr&auml;glich nicht mehr ge&auml;ndert ";
		echo "werden! Sie &uuml;bernehmen als Autor auch die redaktionelle Verantwortung f&uuml;r diese Meldung.</I>";
	}

	echo "</TD></TR>";
	echo "<TR><TD width='100%'>".$curUser."</TD></TR>";

	// ##########
	// Kategorie:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Kategorie:</U></B> *";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>Beachten Sie bei der Auswahl der Kategorie bitte folgendes:<BR>";
		echo "<ul>";
  		echo "<li>Eintr&auml;ge der Kategorie 'AFRO' tauchen auch in der News - Liste auf der AFRO - Seite auf.</li>";
  		echo "<li>Eintr&auml;ge der Kategorie 'Jugend' tauchen auch in der News - Liste auf der JUGEND - Seite auf.</li>";
  		echo "<li>Eintr&auml;ge der Kategorie 'Alle' tauchen in der News - Liste auf der SKK - Seite auf.</li>";
  		echo "<li>Eintr&auml;ge der Kategorie 'Sport' tauchen in der Sport - Liste auf der SKK - Seite auf.</li>";
  		echo "<li>Eintr&auml;ge der Kategorie '100-Jahre-Feier' tauchen in der News - Liste auf der 100 Jahre - Seite auf.</li>".chr(13).chr(10);
		echo "</ul>";
		echo "Je nach gew&auml;hlter Kategorie wird diese Meldung dann in der News-Liste mit einem anderen f&uuml;hrenden Icon dargestellt.</I>";
	}

	echo "</TD></TR>";

	echo "<TR><TD width='100%'><SELECT NAME=Kategorie style='width:100%'";
	echo "TITLE='Eintr&auml;ge der Kategorie AFRO tauchen AUCH auf der AFRO - Seite auf. Eintr&auml;ge der Kategorie Jugend tauchen AUCH auf der JUGEND - Seite auf.'>";

	echo "<OPTION>AFRO";
	echo "<OPTION SELECTED>Alle";
	echo "<OPTION>Jugend";
	echo "<OPTION>Sport";
	echo "<OPTION>100-Jahre-Feier</SELECTED>";

	echo "</TD></TR>";

	// #####################
 	// Das Bild zur Meldung:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Bilddatei zur Meldung:</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>Erlaubt sind hier folgende Dateitypen: jpg, jpeg, gif und png.<BR>";
		echo "Die maximal zul&auml;ssige Dateigr&ouml;&szlig;e darf 100 KB nicht &uuml;berschreiten.</I>";
	}
	echo "</TD></TR>";
	echo "<TR><TD width=".chr(34)."100%".chr(34)."><input type=".chr(34)."file".chr(34)." size=".chr(34)."100".chr(34)." name=".chr(34)."file".chr(34)."></TD></TR>";

	// #########
	// Kurztext:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Kurztext (max. 255 Zeichen):</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>Dieser Kurztext ist optional und wird als einleitender Satz in der jeweiligen Liste der Neuigkeiten mit ausgegeben. ";
		echo "Ferner k&ouml;nnen nun auch die Zeichen ' und \" im Text verwendet werden.</I>";
	}
	echo "</TD></TR>";
	echo "<TR><TD width='100%'><INPUT TYPE=TEXT size='255' MAXLENGTH=255 style='width:100%' Name='Kurztext'></TD></TR>";

	// ##########
	// Haupttext:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Haupttext:</U></B> *";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>Hier geben Sie den eigentlichen Nachrichtentext ein. Es sind alle g&auml;ngigen HTML - Tags zugelassen. ";
		echo "Ferner k&ouml;nnen nun auch die Zeichen ' und \" im Text verwendet werden.</I>";
	}
	// ##################
	echo "</TD></TR>";
	
	// ##################
	// UPDATE 25.10.2015:
	// Diagramme mit einbinden:
	include("_admin_news_diagramme.php");
	// UPDATE Ende
	// ###########
	
	// #############################
	// Wurde schon etwas eingegeben?
	$Text = strGetParam($objDBCon, "Text");

	echo "<TR><TD width='100%'>";
	echo "<textarea id='Text' name='Text' rows='30' cols='80' style='width:100%'>";
	echo $Text."</TEXTAREA></TD></TR>";
	echo "</TABLE>";

	// ###############################
	// Das aktuelle Datum vorsteuern:
	echo "<TABLE width='100%' border=1>";
	echo "<TR><TD width='75%' bgcolor='#C0C0C0'><B><U>Datum der Meldung:</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>Hier geben Sie das Datum der Meldung ein. Es wird Ihnen automatisch das Systemdatum vorgeschagen. ";
		echo "Das hier gew&auml;hlte Datum ist ma&szlig;geblich f&uuml;r die Zuordnung der Meldung in der Liste der News zu einem ";
		echo "bestimmten Monat und ein bestimmtes Jahr. Das Eingabeformat ist TT.MM.JJJJ.</I>";
	}

	echo "</TD>";
	echo "<TD width='25%'>";

	// Das aktuelle Datum vorsteuern:
	$now = date("Y-m-d");
	$curYear = substr($now,0,4);
	$curMonth = substr($now,5,2);
	$curDay = substr($now,8,2);

 	writeDateField("newsdate_day", "newsdate_month", "newsdate_year", $curDay, $curMonth, $curYear, "FALSE");

 	echo "</TD></TR>";

	// Deadline - Datum:
	echo "<TR><TD width='75%' bgcolor='#C0C0C0'><B><U>Ablaufdatum der Meldung:</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>M&ouml;chten Sie eine Meldung hinterlegen, die abl&auml;uft, d.h., die ab einem gewissen Zeitpunkt nicht mehr";
		echo "angezeigt werden soll, dann k&ouml;nnen Sie hier ein Ablaufdatum hinterlegen, ab dem diese Meldung nicht ";
		echo "mehr angezeigt werden soll.<BR>";
		echo "Das Eingabeformat ist TT.MM.JJJJ.</I>";
	}
	echo "</TD>";

	echo "<TD width='25%'>";

	// Ein leeres Datum vorsteuern:
	$now = date("Y-m-d");
	$curYear = substr($now,0,4);
	$curMonth = substr($now,5,2);
	$curDay = substr($now,8,2);

 	writeDateField("deadlinedate_day", "deadlinedate_month", "deadlinedate_year", "-", "-", "-", "TRUE");

 	echo "</TD></TR>";

 	// Ausblenden:
 	echo "</TABLE>";

	echo "<TABLE width='100%' border=1>";
	echo "<TR><TD width='100%'  bgcolor='#C0C0C0'><B><U>Zuordnung der Meldung zur Mannschaft</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>Im Folgenden haben Sie optional die M&ouml;glichkeit, diese Meldung einer Mannschaft bzw. einer Tabelle zuzuordnen.";
		echo " Dies hat zur Folge, dass in der Detailansicht der Nachricht nach der &Uuml;berschrift und gegebenenfalls ";
		echo "einem Bild eine weitere Betreffszeile erscheint, zu welcher Mannschaft diese Nachricht geh&ouml;rt bzw. ";
		echo "das hier referenzierte Tabellenobjekt.</I>";
	}
	echo "</TD></TR>";
	echo "</TABLE>";

	echo "<TABLE width='100%' border=1>";
	writeTeam($objDBCon, "");

	// ################:
	// Kommentar erlauben:
	echo "</TABLE>";
	echo "<TABLE width='100%' border=1><TR><TD width='75%' bgcolor='#C0C0C0'><B><U>Kommentare zulassen:</U></B> *";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Wenn Sie hier ein JA ausw&auml;hlen, dann k&ouml;nnen WEB - Seitenbesucher, sofern bei Ihren ";
		echo "Kontaktdaten eine Emailadresse hinterlegt ist, bei diesem Bericht Kommentare hinterlassen. ";
		echo "Die Kommentarfunktion kann &uuml;ber NEIN entsprechend auch ausgeschaltet werden. ";
		echo "Sie steht nur zur Verf&uuml;gung, wenn bei Ihnen derzeit eine Emailadresse hinterlegt worden ist.</I>".chr(13).chr(10);
	}

	echo"</TD>".chr(13).chr(10);
	echo "<TD width='25%'><SELECT NAME=allowcomment style='width:100%' TITLE='Die Kommentarfunktion ein- und ausschalten.'>".chr(13).chr(10);
	echo "<OPTION>JA<OPTION SELECTED>NEIN</SELECT></TD></TR>".chr(13).chr(10);


	echo "</TR>".chr(13).chr(10);

	echo "</TABLE>";
	echo "<BR><INPUT TYPE=Submit VALUE='Meldung speichern'>".chr(13).chr(10);
	echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'".chr(13).chr(10);
	
	echo "</FORM>";

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>





























