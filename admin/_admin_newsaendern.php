<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - News & Meldungen bearbeiten", "TRUE");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/content_get.php")?>
<?php include("../includes/db/team_get.php")?>
<?php include("../includes/date/date.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>
<?php include("_admin_param.php")?>

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
	if (IsSessionValid($objDBCon, $ux, "R")==0)
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

	// ##############################################
	$objectclassicon = "thunder.gif";
	include("forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>News & Meldungen bearbeiten (NEWS - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// #####################
	// Die ID erfragen:
	$Nr = strGetParam($objDBCon, "Nr");
	
	// #####################
	// Die Daten aus der Datenbank ermitteln:
	$strSQL ="select * from skk_news WHERE ID=".$Nr." AND del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
		   $ID[$i] = $row->id;
		   $Datum[$i] = $row->newsdate;
		   $Kategorie[$i] = $row->category;
		   $Headline[$i] = $row->headline;
		   $Headline2[$i] = $row->headline2;
		   $Autor[$i] = $row->author;
		   $Kurztext[$i] = $row->shorttext;
		   $Content[$i] = $row->contentid;
		   $teamid[$i] = $row->teamid;
		   $Text[$i] = $row->text;
		   $Tabelle[$i] = $row->newstable;
		   $Hits[$i] = $row->hits;
		   $deadlinedate[$i] = $row->deadlinedate;
		   $fadeifdeadlinereached[$i] = $row->fadeifdeadlinereached;
		   $picture[$i] = $row->picture;
		   $allowcomment[$i] = $row->allowcomment;
		   
		   $i++;
		}
	}


	// #####################
	include("forms/fields_not_null.php");

	// #####################
	echo "<FORM METHOD=".Chr(34)."POST".Chr(34)." ACTION=".Chr(34)."_admin_newsaendern_ok.php".Chr(34)." enctype=".Chr(34)."multipart/form-data".Chr(34).">".chr(13).chr(10);
	echo "<INPUT TYPE=HIDDEN NAME=ID Value=".Chr(34).$ID[0].Chr(34).">".chr(13).chr(10);
	echo "<INPUT TYPE=HIDDEN NAME=hits Value=".Chr(34).$Hits[0].Chr(34).">".chr(13).chr(10);
	echo "<INPUT TYPE=HIDDEN NAME=Autor Value=".Chr(34).$Autor[0].Chr(34).">".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE=".Chr(34)."HIDDEN".Chr(34)." NAME=".Chr(34)."ux".Chr(34)." Value=".Chr(34)."$ux".Chr(34).">".chr(13).chr(10);
	echo "<INPUT TYPE=".Chr(34)."HIDDEN".Chr(34)." NAME=".Chr(34)."dx".Chr(34)." Value=".Chr(34)."$dx".Chr(34).">".chr(13).chr(10);

	// Die Kopfdaten:
	// Headline:
	echo "<TABLE width=".Chr(34)."100%".Chr(34)." border=1>".chr(13).chr(10);
	echo "<TR><TD width=".Chr(34)."100%".Chr(34)."  bgcolor=".Chr(34)."#C0C0C0".Chr(34)."><B><U>Headline (max. 255 Zeichen):</U></B> *";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Geben Sie hier die &Uuml;berschrift der neuen Meldung an. Diese erscheint als erste Zeile dieser Meldung ".chr(13).chr(10);
		echo "in der jeweiligen News - Liste. Die Angabe dieses Werte ist obligatorisch.</I>";
	}
	echo "</TD></TR>".chr(13).chr(10);

	$strItem = formatoutput($Headline[0]);

	echo "<TR><TD width=".Chr(34)."100%".Chr(34)."><INPUT TYPE=TEXT SIZE=".Chr(34)."100".Chr(34)." MAXLENGTH=255 style=".Chr(34)."width:100%".Chr(34)." NAME=Headline VALUE=".Chr(34)."".$strItem."".Chr(34)."></TD></TR>".chr(13).chr(10);


	// Headline kurz:
	echo "<TR><TD width=".Chr(34)."100%".Chr(34)."  bgcolor=".Chr(34)."#C0C0C0".Chr(34)."><B><U>Tooltiptext (max. 100 Zeichen):</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Geben Sie hier optional die zweite &Uuml;berschrift der neuen Meldung an. Diese Zeile erscheint als Tooltiptext dieser Meldung ";
		echo "in der jeweiligen News - Liste und in der Meldung selbst. Haben Sie ein Bild bei dieser Meldung hinterlegt, dann ";
		echo "erscheint diese Zeile direkt im Anschluss an das Bild in der Meldung.</I>";
	}
	echo "</TD></TR>".chr(13).chr(10);

	$strItem = formatoutput($Headline2[0]);
	echo "<TR><TD width='100%'><INPUT TYPE=TEXT SIZE='100' MAXLENGTH=100 NAME=Headline2 style='width:100%' VALUE='".$strItem."'></TD></TR>".chr(13).chr(10);

	// ##########################
	// Autor:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Autor dieser Meldung:</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Dieser Wert wird automatisch aus Ihren Logindaten generiert. Der Autor einer Meldung kann nachtr&auml;glich nicht mehr ge&auml;ndert ";
		echo "werden! Sie &uuml;bernehmen als Autor auch die redaktionelle Verantwortung f&uuml;r diese Meldung.</I>";
	}
	echo "</TD></TR>".chr(13).chr(10);
	echo "<TR><TD width='100%'>".$Autor[0]."</TD></TR>".chr(13).chr(10);

	// Kategorie:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Kategorie:</U></B> *";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Beachten Sie bei der Auswahl der Kategorie bitte folgendes:<BR>".chr(13).chr(10);
		echo "<ul>";
  		echo "<li>Eintr&auml;ge der Kategorie 'AFRO' tauchen in der News - Liste auf der AFRO - Seite auf.</li>".chr(13).chr(10);
  		echo "<li>Eintr&auml;ge der Kategorie 'Jugend' tauchen in der News - Liste auf der JUGEND - Seite auf.</li>".chr(13).chr(10);
  		echo "<li>Eintr&auml;ge der Kategorie 'Alle' tauchen in der News - Liste auf der SKK - Seite auf.</li>".chr(13).chr(10);
  		echo "<li>Eintr&auml;ge der Kategorie 'Sport' tauchen in der News - Liste auf der Sport - Seite auf.</li>".chr(13).chr(10);
  		echo "<li>Eintr&auml;ge der Kategorie '100-Jahre-Feier' tauchen in der News - Liste auf der 100 Jahre - Seite auf.</li>".chr(13).chr(10);
		echo "</ul>".chr(13).chr(10);
		echo "Je nach gew&auml;hlter Kategorie wird diese Meldung dann in der News-Liste mit einem anderen f&uuml;hrenden Icon dargestellt.</I>";
	}

	echo"</TD></TR>".chr(13).chr(10);
	echo "<TR><TD width='100%'><SELECT NAME=Kategorie style='width:100%' TITLE='Eintr&auml;ge der Kategorie AFRO tauchen AUCH auf der AFRO - Seite auf. Eintr&auml;ge der Kategorie Jugend tauchen AUCH auf der JUGEND - Seite auf.'>".chr(13).chr(10);

	if(($Kategorie[0]=="Erwachsene") || ($Kategorie[0]=="Alle")) { echo "<OPTION>Alle<OPTION>Jugend<OPTION>AFRO<OPTION>Sport<OPTION>100-Jahre-Feier</SELECT></TD></TR>".chr(13).chr(10); }
	if($Kategorie[0]=="Jugend"){ echo "<OPTION>Alle<OPTION SELECTED>Jugend<OPTION>AFRO<OPTION>Sport<OPTION>100-Jahre-Feier</SELECT></TD></TR>".chr(13).chr(10); }
	if($Kategorie[0]=="AFRO"){ echo "<OPTION>Alle<OPTION>Jugend<OPTION SELECTED>AFRO<OPTION>Sport<OPTION>100-Jahre-Feier</SELECT></TD></TR>".chr(13).chr(10); }
	if($Kategorie[0]=="Sport"){ echo "<OPTION>Alle<OPTION>Jugend<OPTION>AFRO<OPTION SELECTED>Sport<OPTION>100-Jahre-Feier</SELECT></TD></TR>".chr(13).chr(10); }
	if($Kategorie[0]=="100-Jahre-Feier"){ echo "<OPTION>Alle<OPTION>Jugend<OPTION>AFRO<OPTION>Sport<OPTION SELECTED>100-Jahre-Feier</SELECT></TD></TR>".chr(13).chr(10); }
	
	// #####################
 	// Das Bild zur Meldung:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Bilddatei zur Meldung:</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Erlaubt sind hier folgende Dateitypen: jpg, jpeg, gif und png.<BR>";
		echo "Die maximal zul&auml;ssige Dateigr&ouml;&szlig;e darf 1024 KB nicht &uuml;berschreiten.";
		echo "</I>";
	}
	echo "</TD></TR>".chr(13).chr(10);
	echo "<TR><TD width='100%'><input type=".Chr(34)."file".Chr(34)." style=".Chr(34)."width:100%".Chr(34)." name=".Chr(34)."file".Chr(34)."></TD></TR>".chr(13).chr(10);

	// ##########################
	// Wurde ein Bild hinterlegt?
	$uploaddir = getcwd();
	$uploadfile = $uploaddir."/pics/".$picture[0];

	if (is_file($uploadfile))
	{
	    echo "<tr><td width='100%' bgcolor='#C0C0C0'>Aktuelles Bild:</td><TR>".chr(13).chr(10);
	    echo "<tr><td><img src='pics/".$picture[0]."'";

	    // Die Auflösung berechnen:
		list($picwidth, $picheight, $pictype, $picattr) = getimagesize("../admin/pics/".$picture[0]);

		echo "<IMG border='1' SRC='../admin/pics/$picture[0]' alt='Klicken Sie auf das Bild, um ";
		echo "eine Darstellung in voller Gr&ouml;ße zu erreichen.' align='left' ";

		if ($picwidth > 75)
		{
			$fac = ($picwidth / 75);
			$picwidth = round($picwidth / $fac, 0);
			$picheight = round($picheight / $fac, 0);
		}

	    echo "width='".$picwidth."' height='".$picheight."'></TD></tr>".chr(13).chr(10);

	    echo "<tr><td>Aktuelles Bild l&ouml;schen: <INPUT TYPE='CHECKBOX' NAME='delpicture'</td></tr>".chr(13).chr(10);
	    echo "<INPUT TYPE=HIDDEN NAME=oldpicture VALUE='".$picture[0]."'>".chr(13).chr(10);
	}

	// #########
	// Kurztext:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Kurztext (max. 255 Zeichen):</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Dieser Kurztext ist optional und wird als einleitender Satz in der jeweiligen Liste der Neuigkeiten mit ausgegeben. ".chr(13).chr(10);
		echo "Ferner k&ouml;nnen nun auch die Zeichen ' und \" im Text verwendet werden.</I>";
	}
	echo "</TD></TR>".chr(13).chr(10);

	$strItem = formatoutput($Kurztext[0]);
	echo "<TR><TD width='100%'><INPUT TYPE=TEXT size='255' MAXLENGTH=255 style='width:100%' Name='Kurztext' Value='".$strItem."'></TD></TR>".chr(13).chr(10);

	// ##########
	// Haupttext:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Haupttext:</U></B> *";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Hier geben Sie den eigentlichen Nachrichtentext ein. Es sind alle g&auml;ngigen HTML - Tags zugelassen. ".chr(13).chr(10);
		echo "Ferner k&ouml;nnen nun auch die Zeichen ' und \" im Text verwendet werden.</I>";
	}
	echo "</TD></TR>".chr(13).chr(10);
	
	// ##################
	// UPDATE 25.10.2015:
	// Diagramme mit einbinden:
	include("_admin_news_diagramme.php");
	// UPDATE Ende
	// ###########
	
	$strItem = formatoutput($Text[0]);

	echo "<TR><TD width='100%'><TEXTAREA ROWS=30 COLS=80 style='width:100%' NAME=Text>$strItem</TEXTAREA></TD></TR>".chr(13).chr(10);
	echo "</TABLE>".chr(13).chr(10);

	// ################
	// Das Datum holen:
	echo "<TABLE width='100%' border=1>".chr(13).chr(10);
	echo "<TR><TD width='75%' bgcolor='#C0C0C0'><B><U>Datum der Meldung:</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Hier geben Sie das Datum der Meldung ein. Es wird Ihnen automatisch das Systemdatum vorgeschagen. ";
		echo "Das hier gew&auml;hlte Daum ist ma&szlig;geblich f&uuml;r die Zuordnung der Meldung in der Liste der News zu einem ";
		echo "bestimmten Monat und ein bestimmtes Jahr. Das Eingabeformat ist TT.MM.JJJJ.</I>";
	}
	echo "</TD>".chr(13).chr(10);
	echo "<TD width='25%'>".chr(13).chr(10);

	// Das aktuelle Datum vorsteuern:
	$curYear = substr($Datum[0],0,4);
	$curMonth = substr($Datum[0],5,2);
	$curDay = substr($Datum[0],8,2);

 	writeDateField("newsdate_day", "newsdate_month", "newsdate_year", $curDay, $curMonth, $curYear, "FALSE");

 	echo "</TD></TR>".chr(13).chr(10);

	// Deadline - Datum:
	echo "<TR><TD width='75%' bgcolor='#C0C0C0'><B><U>Ablaufdatum der Meldung:</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>M&ouml;chten Sie eine Meldung hinterlegen, die abl&auml;uft, d.h., die ab einem gewissen Zeitpunkt nicht mehr";
		echo "angezeigt werden soll, dann k&ouml;nnen Sie hier ein Ablaufdatum hinterlegen, ab dem diese Meldung nicht ";
		echo "mehr angezeigt werden soll.<BR>Das Eingabeformat ist TT.MM.JJJJ.</I>";
	}
	echo "</TD>".chr(13).chr(10);
	echo "<TD width='25%'>".chr(13).chr(10);

	// Das aktuelle Datum vorsteuern:
	if (trim($deadlinedate[0])=="")
	{
		$curYear = "-";
		$curMonth = "-";
		$curDay = "-";
	}
	else
	{
		$curYear = substr($deadlinedate[0],0,4);
		$curMonth = substr($deadlinedate[0],5,2);
		$curDay = substr($deadlinedate[0],8,2);
	}

 	writeDateField("deadlinedate_day", "deadlinedate_month", "deadlinedate_year", $curDay, $curMonth, $curYear, "TRUE");

 	echo "</TD></TR>".chr(13).chr(10);

 	echo "</TABLE>".chr(13).chr(10);

	echo "<TABLE width='100%' border=1>".chr(13).chr(10);
	echo "<TR><TD width='100%'  bgcolor='#C0C0C0'><B><U>Zuordnung der Meldung zur Mannschaft</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Im Folgenden haben Sie optional die M&ouml;glichkeit, diese Meldung einer Mannschaft bzw. einer Tabelle zuzuordnen.";
		echo " Dies hat zur Folge, dass in der Detailansicht der Nachricht nach der &Uuml;berschrift und gegebenenfalls ";
		echo "einem Bild eine weitere Betreffszeile erscheint, zu welcher Mannschaft diese Nachricht geh&ouml;rt bzw. ";
		echo "das hier referenzierte Tabellenobjekt.</I>";
	}
	echo "</TD></TR>";
	echo "</TABLE>".chr(13).chr(10);

	echo "<TABLE width='100%' border=1>".chr(13).chr(10);

	// #############
	// Die Mannschaft:
	writeTeam($objDBCon, $teamid[0]);

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

	if(strtolower($allowcomment[0])=="j")
	{
		echo "<OPTION SELECTED>JA<OPTION>NEIN</SELECT></TD></TR>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>JA<OPTION SELECTED>NEIN</SELECT></TD></TR>".chr(13).chr(10);

	}

	echo "</tr>".chr(13).chr(10);

	echo "</TABLE>".chr(13).chr(10);
	echo "<BR><INPUT TYPE=Submit VALUE='Meldung aktualisieren'>".chr(13).chr(10);
	echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);


	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>
































