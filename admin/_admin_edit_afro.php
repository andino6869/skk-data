<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - AFRO - Daten bearbeiten", "TRUE");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/date/date.php")?>
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
	if (IsSessionValid($objDBCon, $ux, "A")==0)
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

	// #####################
	// Die ID erfragen:
	$Nr = strGetParam($objDBCon, "Nr");

	echo "<SPAN CLASS=he1>";

	switch ($Nr)
	{
		case "0":
			echo "AFRO - Anfahrt bearbeiten";
			$strSQL ="select text from skk_afro_journey WHERE del='N' AND modifieddate IS NULL;";
			break;

		case "1":
			echo "AFRO - Ausschreibung bearbeiten";
			$strSQL ="select text from skk_afro_writeout WHERE del='N' AND modifieddate IS NULL;";
			break;

		case "2":
			echo "AFRO - Ergebnisse bearbeiten";
			$strSQL ="select text from skk_afro_results WHERE del='N' AND modifieddate IS NULL;";
			break;

		case "3":
			echo "AFRO - Hoteldaten bearbeiten";
			$strSQL ="select text from skk_afro_hotel WHERE del='N' AND modifieddate IS NULL;";
			break;

		case "4":
			echo "AFRO - Kontaktdaten bearbeiten";
			$strSQL ="select text from skk_afro_contact WHERE del='N' AND modifieddate IS NULL;";
			break;

		case "5":
			echo "AFRO - Seiteneinstellungen bearbeiten";
			// Achtung, hier ein anderes Tabellenformat!
			$strSQL ="select * from skk_afro_config WHERE del='N' AND modifieddate IS NULL;";
			break;

		case "6":
			echo "AFRO - Tabellen bearbeiten";
			$strSQL ="select text from skk_afro_tables WHERE del='N' AND modifieddate IS NULL;";
			break;
	}

	echo "<BR></SPAN><BR><BR>".chr(13).chr(10);

	// Die Daten aus der Datenbank ermitteln:
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		if ($Nr != 5)
		{
			$i = 0;
			
			while ($row = $rs->fetch_object())
			{
			   $Text[$i] = $row->text;
			   $i++;
			}
		}
		else
		{
			// Sonderfall Konfiguration:
			$i = 0;
			
			while ($row = $rs->fetch_object())
			{
			   $allowusermessage[$i] = $row->allowusermessage;
			   $allowusermessageto[$i] = $row->allowusermessageto;
			   $showafrolink[$i] = $row->showafrolink;
			   $maxnumberofplayers[$i] = $row->maxnumberofplayers;
			   $i++;
			}
		}

	}

	include("forms/fields_not_null.php");

	echo "<FORM METHOD=POST ACTION='_admin_edit_afro_ok.php'>".chr(13).chr(10);

	// Welcher Seitenbereich?
	echo "<INPUT TYPE=HIDDEN NAME=Nr Value=$Nr>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	// Die Tabelle erstellen:
	echo "<TABLE width='100%' border=1>".chr(13).chr(10);

	if ($Nr != 5)
	{
		echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Seiteninhalt:</U></B>";

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Der Seiteninhalt, der aktuell bearbeitet werden kann.</I>";
		}
		echo "</TD></TR>".chr(13).chr(10);

		echo "<TR><TD width='100%'><TEXTAREA WIDTH='100%' style='width:100%' COLS=60 ROWS=20 NAME=Text>".$Text[0]."</TEXTAREA></TD>".chr(13).chr(10);
	 	echo "</TR>";
	}
	else
	{
		// Anmelden von Spielern aktuell zulassen:
		echo "<TR><TD width='75%' bgcolor='#C0C0C0'><B>Anmelden von Spielern f&uuml;r das n&auml;chste ";
		echo "AFRO - Turnier aktuell zulassen: *</B>";

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Wenn Sie hier 'Ja' ausw&auml;hlen, dann k&ouml;nnen auf der AFRO - Seite neue Spieler ";
			echo "erfasst und die Liste der bisher erfassten Spieler f&uuml;r das aktuelle Turnier eingesehen werden.</I>";
		}

		echo "</td><td width='25%'>".chr(13).chr(10);
  		echo "<SELECT NAME=allowusermessage style='width:100%'>".chr(13).chr(10);

  		if (strtolower($allowusermessage[0])=="n")
  		{
    		echo "<OPTION Value='N' SELECTED>", "Nein".chr(13).chr(10);
    		echo "<OPTION Value='J'>", "Ja".chr(13).chr(10);
  		}
  		else
  		{
    		echo "<OPTION Value='N'>", "Nein".chr(13).chr(10);
    		echo "<OPTION Value='J' SELECTED>", "Ja".chr(13).chr(10);
  		}

  		echo "</SELECT>".chr(13).chr(10);
  		echo "</td></tr>".chr(13).chr(10);

		// Anmeldung gültig bis:
		echo "<TR><TD width='75%' bgcolor='#C0C0C0'><B>Das Anmelden neuer Spieler soll m&ouml;glich sein bis (Format: TT.MM.JJJJ): *</B>";

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Bis zu dem hier gew&auml;hlten Datum ist es m&ouml;glich, dass sich dann Spieler f&uuml;r das aktuelle Turnier anmelden k&ouml;nnen.</I>";
		}

		echo "</TD><TD>".chr(13).chr(10);

	    $curYear = substr($allowusermessageto[0],0,4);
	    $curMonth = substr($allowusermessageto[0],5,2);
	    $curDay = substr($allowusermessageto[0],8,2);

	    writeDateField("allowusermessageto_day", "allowusermessageto_month", "allowusermessageto_year", $curDay, $curMonth, $curYear);

	    echo "</TD></TR>".chr(13).chr(10);

		// ##########################################
		// Link auf die AFRO - Homepage anzeigen:
		echo "<tr><td width='75%' bgcolor='#C0C0C0'><B>Link auf die AFRO - Seite in der Homepage des SKK anzeigen: *</B>";

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Wird dieser Wert hier auf 'Nein' gesetzt, dann kann die AFRO - Seite von außen nicht mehr aufgerufen werden.</I>";
		}

		echo "</td><td>".chr(13).chr(10);
  		echo "<SELECT NAME=showafrolink style='width:100%'>".chr(13).chr(10);

		if (strtolower ($showafrolink[0])=="n")
  		{
    		echo "<OPTION Value='N' SELECTED>", "Nein".chr(13).chr(10);
    		echo "<OPTION Value='J'>", "Ja".chr(13).chr(10);
  		}
  		else
  		{
    		echo "<OPTION Value='N'>", "Nein".chr(13).chr(10);
    		echo "<OPTION Value='J' SELECTED>", "Ja".chr(13).chr(10);
  		}

  		// ##########################################
		// Max. Teilnehmerzahl festlegen:
  		echo "<tr><td width='75%' bgcolor='#C0C0C0'><B>Max. Teilnehmerzahl f&uuml;r dieses Turnier: *</B>";

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Hier k&ouml;nnen Sie die max. zul&auml;ssige Teilnehmerzahl f&uuml;r das AFRO - Turnier festlegen. Wird diese Zahl bei den Voranmeldungen erreicht, dann k&ouml;nnen sich keine weiteren Spieler mehr anmelden.</I>";
		}

		echo "</td><td>".chr(13).chr(10);
  		echo "<SELECT NAME=maxnumberofplayers style='width:100%'>".chr(13).chr(10);

		switch ($maxnumberofplayers[0])
		{
			case "200":
				echo "<OPTION Value='200' SELECTED>", "200".chr(13).chr(10);
				echo "<OPTION Value='240'>", "240".chr(13).chr(10);
				echo "<OPTION Value='260'>", "260".chr(13).chr(10);
				echo "<OPTION Value='280'>", "280".chr(13).chr(10);
				echo "<OPTION Value='300'>", "300".chr(13).chr(10);
				break;

			case "240":
				echo "<OPTION Value='200'>", "200".chr(13).chr(10);
				echo "<OPTION Value='240' SELECTED>", "240".chr(13).chr(10);
				echo "<OPTION Value='260'>", "260".chr(13).chr(10);
				echo "<OPTION Value='280'>", "280".chr(13).chr(10);
				echo "<OPTION Value='300'>", "300".chr(13).chr(10);
				break;

			case "260":
				echo "<OPTION Value='200'>", "200".chr(13).chr(10);
				echo "<OPTION Value='240'>", "240".chr(13).chr(10);
				echo "<OPTION Value='260' SELECTED>", "260".chr(13).chr(10);
				echo "<OPTION Value='280'>", "280".chr(13).chr(10);
				echo "<OPTION Value='300'>", "300".chr(13).chr(10);
				break;

			case "280":
				echo "<OPTION Value='200'>", "200".chr(13).chr(10);
				echo "<OPTION Value='240'>", "240".chr(13).chr(10);
				echo "<OPTION Value='260'>", "260".chr(13).chr(10);
				echo "<OPTION Value='280' SELECTED>", "280".chr(13).chr(10);
				echo "<OPTION Value='300'>", "300".chr(13).chr(10);
				break;

			case "300":
				echo "<OPTION Value='200'>", "200".chr(13).chr(10);
				echo "<OPTION Value='240'>", "240".chr(13).chr(10);
				echo "<OPTION Value='260'>", "260".chr(13).chr(10);
				echo "<OPTION Value='280'>", "280".chr(13).chr(10);
				echo "<OPTION Value='300' SELECTED>", "300".chr(13).chr(10);
				break;

			default:
				echo "<OPTION Value='200' SELECTED>", "200".chr(13).chr(10);
				echo "<OPTION Value='240'>", "240".chr(13).chr(10);
				echo "<OPTION Value='260'>", "260".chr(13).chr(10);
				echo "<OPTION Value='280'>", "280".chr(13).chr(10);
				echo "<OPTION Value='300'>", "300".chr(13).chr(10);
				break;
  		}

	}

	echo "</TABLE>".chr(13).chr(10);

	// Die Schaltfläche zum Abschluss:
 	echo "<BR><INPUT TYPE=Submit VALUE='&Auml;nderungen speichern'></TD>".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>