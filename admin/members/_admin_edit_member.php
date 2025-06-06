<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Mitglied bearbeiten");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/date/date.php")?>
<?php include("../_admin_param.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################
	
	// 1.) Das Verbindungsobjekt ermitteln:
	$objDBCon = GetCon();

	// 2.) In Abh�ngigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon, "FALSE");


	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("../_admin_param_ux.php");

	// ################
	// Die ID erfragen:
	$Nr = strGetParam($objDBCon, "Nr");

	// ##############################################
	// 4.) Ist der aktuelle Login noch g�ltig?
	if (IsSessionValid($objDBCon, $ux, "A")==0)
	{
		// Pr�fen, ob sich der Benutzer gerade selbst �ndert.
		$curNr = base64_decode($ux);
		$curNr = strrev($curNr);

		if ($Nr != $curNr)
		{
			// Keine G�ltigkeit mehr!
			include("../../includes/forms/middler.php");
			include("../forms/navigation_access_denied.php");
			include("../../includes/forms/footer.php");

			exit;
		}
	}

	// #######################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("../_admin_param_dx.php");
	
	// ################
	// Bild hinzuf�gen:
	$objectclassicon = "team.jpg";
	include("../forms/objectclassicon.php");
	
	echo "<SPAN CLASS=he1> Mitgliedsdaten bearbeiten (MEMBER - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);


	// #############################
	// 6.) Die Mitgliedsdaten holen:
	$strSQL = "select * from skk_members WHERE id=".$Nr." AND del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
    	$row = $rs->fetch_object();
    	
    	$ID[0] = $row->id;
        $Nachname[0] = $row->name;
        $Vorname[0] = $row->vorname;

    	$DWZ[0] = $row->dwz;
        $ELO[0] = $row->elo;
        $Titel[0] = $row->title;

        $Email[0] = $row->mail;
        $Telefon[0] = $row->telephone;
        $Mobiltelefon[0] = $row->mobile;

        $Geschlecht[0] = $row->sex;
        $picture[0] = $row->picture;

	    $Strasse[0] = $row->addrstreet;
    	$PLZ[0] = $row->addrzipcode;
        $Ort[0] = $row->addrcity;

        $Eintrittsdatum[0] = $row->entrydate;
        $Geburtsdatum[0] = $row->birthdate;
        $Geburtsort[0] = $row->birthplace;

        $active[0] = $row->active;
        $password[0]= $row->pwd;
        $membertype[0] = $row->membertype;
        $sendmailifnewcomment[0] = $row->sendmailifnewcomment;
        $info[0] = $row->info;

        $ip[0]= $row->ip;
        $lastlogin[0] = $row->lastlogin;
		$usecms[0] = $row->UseCMS;
	}

	// #####################
  	include("../forms/fields_not_null.php");

	// #####################
  	echo "<FORM METHOD=POST ACTION='_admin_edit_member_ok.php' enctype='multipart/form-data'>".chr(13).chr(10);
  	echo "<INPUT TYPE=HIDDEN NAME=ID Value=".$ID[0].">".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
  	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
  	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

  	echo "<table cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);


	// #########
	// Nachname:
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Nachname (max. 50 Zeichen): *</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Tragen Sie hier bitte den Nachnamen des Mitglieds ein. Dieser wird u.a. f&uuml;r ein Login im Redaktionssystem ben&ouml;tigt.</I>";
	}

	echo "</TD>".chr(13).chr(10);
	echo "<td><INPUT TYPE=Text NAME=Nachname size=50 VALUE='".$Nachname[0]."' style='width:100%'></td></tr>".chr(13).chr(10);


	// #########
	// Vorname:
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0' width='50%'><B><U>Vorname (max. 50 Zeichen): *</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Tragen Sie hier bitte den Vornamen des Mitglieds ein. Dieser wird u.a. f&uuml;r ein Login im Redaktionssystem ben&ouml;tigt.</I>";
	}

	echo "</TD>".chr(13).chr(10);
	echo "<td width='50%'><INPUT TYPE=Text NAME=Vorname VALUE='".$Vorname[0]."' style='width:100%' size=50></td></tr>".chr(13).chr(10);


	// ##########
	// Geschlecht:
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Geschlecht: *</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Tragen Sie hier bitte das Geschlecht des Mitglieds ein. Dieses wird u.a. in der DWZ - Liste ";
		echo "mit ausgegeben.</I>";
	}

	echo "</td><td>".chr(13).chr(10);

  	echo "<SELECT NAME=sex style='width:100%'>".chr(13).chr(10);

	if (strtolower ($Geschlecht[0])=="m" || trim($Geschlecht[0])=="")
  	{
    	echo "<OPTION Value='M' SELECTED>", "M&auml;nnlich".chr(13).chr(10);
    	echo "<OPTION Value='W'>", "Weiblich".chr(13).chr(10);
  	}
  	else
  	{
    	echo "<OPTION Value='M'>", "M&auml;nnlich".chr(13).chr(10);
    	echo "<OPTION Value='W' SELECTED>", "Weiblich".chr(13).chr(10);
  	}

	echo "</SELECT>".chr(13).chr(10);
	echo "</td></tr>".chr(13).chr(10);


	// ##########
	// Bild:
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Neues Bild:</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Erlaubte Dateitypen: jpg, jpeg, gif, png / Max. Gr&ouml;&szlig;e: 100 KB / Keine Sonderzeichen im Dateinamen. Bild wird u.a. in der Liste der Mannschaften mit angezeigt.</I>";
	}
	echo "</td><td><input type='file' name='file' style='width:100%'></td></tr>".chr(13).chr(10);

	// Wurde ein Bild hinterlegt?
  	$uploaddir = getcwd();
  	$uploadfile = $uploaddir."/pics/".$picture[0];

  	if (is_file($uploadfile))
  	{
    		echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Aktuelles Bild:</U></B></td>".chr(13).chr(10);
	    	echo "<td><img src='pics/".$picture[0]."' align='left' width='75' height='75'></TD></tr>".chr(13).chr(10);

    		echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Aktuelles Bild l&ouml;schen:</U></B></td>".chr(13).chr(10);
	    	echo "<td><INPUT TYPE='CHECKBOX' NAME='delpicture'</td></tr>".chr(13).chr(10);
    		echo "<INPUT TYPE=HIDDEN NAME=oldpicture VALUE='".$picture[0]."'>".chr(13).chr(10);
  	}


	// ############
	// Adressdaten:
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Strasse (max. 50 Zeichen):</U></B></td><td><INPUT TYPE=Text NAME=Strasse VALUE='".$Strasse[0]."' style='width:100%' size=50></td></tr>".chr(13).chr(10);
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>PLZ (max. 5 Zeichen):</U></B></td><td><INPUT TYPE=Text NAME=PLZ  VALUE='".$PLZ[0]."' size=5></td></tr>".chr(13).chr(10);
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Ort (max. 50 Zeichen):</U></B></td><td><INPUT TYPE=Text NAME=Ort VALUE='".$Ort[0]."' style='width:100%' size=50></td></tr>".chr(13).chr(10);


	// ############
	// Email:
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Email (max. 100 Zeichen):</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Wenn Sie hier eine Email hinterlegen, dann kann dieses Mitglied im Rahmen einer Serienemailabfertigung oder beim Speichern eines neuen Kommentars automatisch angeschrieben werden.</I>";
	}
	echo "</TD><td><INPUT TYPE=Text NAME=Email size=50 VALUE='".$Email[0]."' style='width:100%'></td></tr>".chr(13).chr(10);

	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Telefon (max. 50 Zeichen):</U></B></td><td><INPUT TYPE=Text NAME=Telefon VALUE='".$Telefon[0]."' size=50 style='width:100%'></td></tr>".chr(13).chr(10);
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Mobiltelefon  (max. 50 Zeichen):</U></B></td><td><INPUT TYPE=Text NAME=Mobil VALUE='".$Mobiltelefon[0]."' size=50 style='width:100%'></td></tr>".chr(13).chr(10);


	// ############
	// Eintrittsdatum:
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Eintrittsdatum (Format: TT.MM.JJJJ):</U></B>";
	echo "</TD><TD>".chr(13).chr(10);

	if (trim($Eintrittsdatum[0])=="")
	{
		writeDateFieldBirthday("entry_day", "entry_month", "entry_year", "-", "-", "-", "TRUE");
	}
	else
	{
		$curYear = substr($Eintrittsdatum[0],0,4);
  		$curMonth = substr($Eintrittsdatum[0],5,2);
  		$curDay = substr($Eintrittsdatum[0],8,2);

  		writeDateFieldBirthday("entry_day", "entry_month", "entry_year", $curDay, $curMonth, $curYear, "TRUE");
	}


  	echo "</TD></TR>".chr(13).chr(10);


  	// ############
	// Geburtsdatum:
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Geburtsdatum (Format: TT.MM.JJJJ):</U></B>".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Personen, die j&uuml;nger sind als 20 Jahre, werden im Bereich der Jugend - DWZ - Listen ebenfalls mit aufgef&uuml;hrt.</I>";
	}
	echo "</TD><TD>".chr(13).chr(10);

	if (trim($Geburtsdatum[0])=="")
	{
		writeDateFieldBirthday("birth_day", "birth_month", "birth_year", "-", "-", "-", "TRUE");
	}
	else
	{
		$curYear = substr($Geburtsdatum[0],0,4);
  		$curMonth = substr($Geburtsdatum[0],5,2);
  		$curDay = substr($Geburtsdatum[0],8,2);

		writeDateFieldBirthday("birth_day", "birth_month", "birth_year", $curDay, $curMonth, $curYear, "TRUE");
	}

  	echo "</TD></TR>".chr(13).chr(10);


	// ##################
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Geburtsort (max. 50 Zeichen):</U></B></td><td><INPUT TYPE=Text NAME=Geburtsort VALUE='".$Geburtsort[0]."' style='width:100%' size=50></td></tr>".chr(13).chr(10);
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>DWZ:</U></B></td><td><INPUT TYPE=Text NAME=DWZ size=10 VALUE='".$DWZ[0]."' style='width:100%'></td></tr>".chr(13).chr(10);
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>ELO:</U></B></td><td><INPUT TYPE=Text NAME=ELO size=10 VALUE='".$ELO[0]."' style='width:100%'></td></tr>".chr(13).chr(10);


	// ############
	// Titel:
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Titel: *</U></B>".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Bitte w&auml;hlen Sie hier einen FIDE - Titel aus. Sollten das Mitglied derzeit ";
		echo "keinen FIDE - Titel haben, dann w&auml;hlen Sie bitte ".chr(34)."-".chr(34)." aus.</I>";
	}

	echo "</TD><TD><SELECT NAME=title style='width:100%' TITLE='Bitte w�hlen Sie hier Ihren aktuellen FIDE - Titel aus. Sollten Sie derzeit ";
	echo "keinen FIDE - Titel haben, dann w�hlen Sie bitte ".chr(34)."-".chr(34)." aus.'>";

	switch ($Titel[0])
	{
		case "CM":
			echo "<OPTION VALUE='-'>-".chr(13).chr(10);
			echo "<OPTION VALUE='CM' SELECTED>Candidate Master".chr(13).chr(10);
			echo "<OPTION VALUE='FM'>FIDE Meister".chr(13).chr(10);
			echo "<OPTION VALUE='IM'>Internationaler Meister".chr(13).chr(10);
			echo "<OPTION VALUE='GM'>Gro&szlig;meister".chr(13).chr(10);
			echo "<OPTION VALUE='WGM'>Woman Grand Master".chr(13).chr(10);
			break;

		case "FM":
			echo "<OPTION VALUE='-'>-".chr(13).chr(10);
			echo "<OPTION VALUE='CM'>Candidate Master".chr(13).chr(10);
			echo "<OPTION VALUE='FM' SELECTED>FIDE Meister".chr(13).chr(10);
			echo "<OPTION VALUE='IM'>Internationaler Meister".chr(13).chr(10);
			echo "<OPTION VALUE='GM'>Gro&szlig;meister".chr(13).chr(10);
			echo "<OPTION VALUE='WGM'>Woman Grand Master".chr(13).chr(10);
			break;

		case "IM":
			echo "<OPTION VALUE='-'>-".chr(13).chr(10);
			echo "<OPTION VALUE='CM'>Candidate Master".chr(13).chr(10);
			echo "<OPTION VALUE='FM'>FIDE Meister".chr(13).chr(10);
			echo "<OPTION VALUE='IM' SELECTED>Internationaler Meister".chr(13).chr(10);
			echo "<OPTION VALUE='GM'>Gro&szlig;meister".chr(13).chr(10);
			echo "<OPTION VALUE='WGM'>Woman Grand Master".chr(13).chr(10);
			break;

		case "GM":
			echo "<OPTION VALUE='-'>-".chr(13).chr(10);
			echo "<OPTION VALUE='CM'>Candidate Master".chr(13).chr(10);
			echo "<OPTION VALUE='FM'>FIDE Meister".chr(13).chr(10);
			echo "<OPTION VALUE='IM'>Internationaler Meister".chr(13).chr(10);
			echo "<OPTION VALUE='GM' SELECTED>Gro&szlig;meister".chr(13).chr(10);
			echo "<OPTION VALUE='WGM'>Woman Grand Master".chr(13).chr(10);
			break;

		case "WGM":
			echo "<OPTION VALUE='-'>-".chr(13).chr(10);
			echo "<OPTION VALUE='CM'>Candidate Master".chr(13).chr(10);
			echo "<OPTION VALUE='FM'>FIDE Meister".chr(13).chr(10);
			echo "<OPTION VALUE='IM'>Internationaler Meister".chr(13).chr(10);
			echo "<OPTION VALUE='GM'>Gro&szlig;meister".chr(13).chr(10);
			echo "<OPTION VALUE='WGM' SELECTED>Woman Grand Master".chr(13).chr(10);
			break;

		default:
			echo "<OPTION VALUE='-' SELECTED>-".chr(13).chr(10);
			echo "<OPTION VALUE='CM'>Candidate Master".chr(13).chr(10);
			echo "<OPTION VALUE='FM'>FIDE Meister".chr(13).chr(10);
			echo "<OPTION VALUE='IM'>Internationaler Meister".chr(13).chr(10);
			echo "<OPTION VALUE='GM'>Gro&szlig;meister".chr(13).chr(10);
			echo "<OPTION VALUE='WGM'>Woman Grand Master".chr(13).chr(10);
	}

	echo "</SELECT></TD>".chr(13).chr(10);
 	echo "</TR>".chr(13).chr(10);


	// #############
	// Mitgliedstyp:
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Mitgliedstyp: *</U></B></td><td>".chr(13).chr(10);
	echo "<SELECT NAME=Merkmal>".chr(13).chr(10);

	if (strtolower ($info[0])=="a" || trim($info[0])=="")
  	{
    	echo "<OPTION Value='A' SELECTED>", "Aktiv".chr(13).chr(10);
    	echo "<OPTION Value='P'>", "Passiv".chr(13).chr(10);
	}
  	else
  	{
    	echo "<OPTION Value='A'>", "Aktiv".chr(13).chr(10);
    	echo "<OPTION Value='P' SELECTED>", "Passiv".chr(13).chr(10);
  	}

	echo "</SELECT>".chr(13).chr(10);
  	echo "</td></tr>".chr(13).chr(10);


	// ######################
	// Administrationsrechte:
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Administrationsrechte: *</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Hier vergeben Sie die Zugriffsberechtigungen f&uuml;r den aktuellen Benutzer.".chr(13).chr(10);
	  	echo "Dabei k&ouml;nnen Sie folgende Einstellungen w&auml;hlen:<BR><BR>".chr(13).chr(10);
	  	echo "- Keine Zugriffsrechte auf den Administrationbereich (Die Person darf sich nicht im Adminbereich anmelden)<BR><BR>".chr(13).chr(10);
	  	echo "- Online-Redakteur (erm&ouml;glicht die Bearbeitung von News, Terminen und Tabellen)<BR><BR>".chr(13).chr(10);
	  	echo "- Online-Redakteur und Homepageverwalter (erm&ouml;glicht zus&auml;tzlich die Bearbeitung der Seiteninhalte wie Jugend oder Links)<BR><BR>".chr(13).chr(10);
	  	echo "- Administrator (Die Person erh&auml;lt Vollzugriff auf alle Seiteninhalte)</I>";
	}

	echo "</td><td>";
  	echo "<SELECT NAME=active style='width:100%' TITLE='Hier vergeben Sie die Zugriffsberechtigungen f&uuml;r den aktuellen Benutzer.".chr(13).chr(10);
  	echo "Dabei k&ouml;nnen Sie folgende Einstellungen w&auml;hlen:".chr(13).chr(10).chr(13).chr(10);
  	echo "- Keine Zugriffsrechte auf den Administrationbereich (Die Person darf sich nicht im Adminbereich anmelden)".chr(13).chr(10);
  	echo "- Online-Redakteur (erm&ouml;glicht die Bearbeitung von News, Terminen und Tabellen)".chr(13).chr(10);
  	echo "- Online-Redakteur und Homepageverwalter (erm&ouml;glicht zus&auml;tzlich die Bearbeitung der Seiteninhalte wie Jugend oder Links)".chr(13).chr(10);
  	echo "- Administrator (Die Person erh&auml;lt Vollzugriff auf alle Seiteninhalte)'>";

  	// #########################################################
  	// Keine zus�tzlichen Rechte f�r Normalanwender erm�glichen!
  	// UPDATE 23.10.2015:
	switch (strtolower(trim($active[0])))
	{
	 	case "n":
	  		echo "<OPTION Value='N' SELECTED>", "Keine Zugriffsrechte auf den Administrationbereich".chr(13).chr(10);
	    	echo "<OPTION Value='R'>", "Online-Redakteur".chr(13).chr(10);
	    	echo "<OPTION Value='H'>", "Online-Redakteur und Homepageverwalter".chr(13).chr(10);
	    	echo "<OPTION Value='A'>", "Administrator".chr(13).chr(10);
	  		break;

		case "r":
			echo "<OPTION Value='N'>", "Keine Zugriffsrechte auf den Administrationbereich".chr(13).chr(10);
	    	echo "<OPTION Value='R' SELECTED>", "Online-Redakteur".chr(13).chr(10);
	    	echo "<OPTION Value='H'>", "Online-Redakteur und Homepageverwalter".chr(13).chr(10);
	    	echo "<OPTION Value='A'>", "Administrator".chr(13).chr(10);
	  		break;

		case "h":
			echo "<OPTION Value='N'>", "Keine Zugriffsrechte auf den Administrationbereich".chr(13).chr(10);
	    	echo "<OPTION Value='R'>", "Online-Redakteur".chr(13).chr(10);
	    	echo "<OPTION Value='H' SELECTED>", "Online-Redakteur und Homepageverwalter".chr(13).chr(10);
	    	echo "<OPTION Value='A'>", "Administrator".chr(13).chr(10);
	  		break;

		case "a":
			echo "<OPTION Value='N'>", "Keine Zugriffsrechte auf den Administrationbereich".chr(13).chr(10);
	    	echo "<OPTION Value='R'>", "Online-Redakteur".chr(13).chr(10);
	    	echo "<OPTION Value='H'>", "Online-Redakteur und Homepageverwalter".chr(13).chr(10);
	    	echo "<OPTION Value='A' SELECTED>", "Administrator".chr(13).chr(10);
	  		break;

		default:
			echo "<OPTION Value='N' SELECTED>", "Keine Zugriffsrechte auf den Administrationbereich".chr(13).chr(10);
	    	echo "<OPTION Value='R'>", "Online-Redakteur".chr(13).chr(10);
	    	echo "<OPTION Value='H'>", "Online-Redakteur und Homepageverwalter".chr(13).chr(10);
	    	echo "<OPTION Value='A'>", "Administrator".chr(13).chr(10);
	  		break;

	}

  	echo "</SELECT>".chr(13).chr(10);
  	echo "</td></tr>".chr(13).chr(10);


	// #########################
	// Passwort:
	echo "<tr>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Passwort (max. L&auml;nge 12):</U></B>".chr(13).chr(10);

	// Passwort dekodieren (Reihenfolge wird umgekehrt und BASE64 - kodiert):
  	$password[0] = base64_decode($password[0]);
  	$password[0] = strrev($password[0]);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Passwort f&uuml;r den Administrations- bzw. Redaktionsbereich.</I>";
	}

	echo "</td>";
	echo "<td><INPUT TYPE=PASSWORD SIZE=12 maxlength=12 VALUE='".$password[0]."' NAME=password></td></tr>".chr(13).chr(10);


	// #########################
	// Automatische Emailnachricht:
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Automatische Emailnachricht: *</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Dieses Mitglied per Email benachrichtigen, wenn neue Kommentare eingepflegt worden sind (ben&ouml;tigt eine Emailadresse bei diesem Mitglied).</I>";
	}

	echo "</td><td>".chr(13).chr(10);
	echo "<SELECT NAME=sendmailifnewcomment>".chr(13).chr(10);


	if (strtolower ($sendmailifnewcomment[0])=="j")
	{
	    echo "<OPTION Value='N'>", "Nein".chr(13).chr(10);
	    echo "<OPTION Value='J' SELECTED>", "Ja".chr(13).chr(10);
	}
	else
	{
	    echo "<OPTION Value='N' SELECTED>", "Nein".chr(13).chr(10);
	    echo "<OPTION Value='J'>", "Ja".chr(13).chr(10);
	}

	echo "</SELECT>".chr(13).chr(10);
	echo "</td></tr>".chr(13).chr(10);


	// ##############
	// CMS verwenden:
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Redakteur verwendet Content Management System: *</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Wird hier ein Ja gesetzt, dann k�nnen alle gr&ouml;&szlig;eren Eingabefelder ohne HTML - Kenntnisse &uuml;ber word&auml;hnliche Schaltfl&auml;chen bedient werden.</I>";
	}

	echo "</td><td>".chr(13).chr(10);
	echo "<SELECT NAME=usecms>".chr(13).chr(10);


	if (strtolower ($usecms[0])=="j")
	{
	    echo "<OPTION Value='N'>", "Nein".chr(13).chr(10);
	    echo "<OPTION Value='J' SELECTED>", "Ja".chr(13).chr(10);
	}
	else
	{
	    echo "<OPTION Value='N' SELECTED>", "Nein".chr(13).chr(10);
	    echo "<OPTION Value='J'>", "Ja".chr(13).chr(10);
	}

	echo "</SELECT>".chr(13).chr(10);
	echo "</td></tr>".chr(13).chr(10);


	// #########################
	// Bemerkung:
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Bemerkung (max. 50 Zeichen):</U></B></td><td>";
	echo "<INPUT TYPE=Text NAME=info VALUE='".$info[0]."' style='width:100%' size=50></td></tr>".chr(13).chr(10);

	// #########################
	// Sessondaten:
  	echo "<INPUT TYPE=HIDDEN NAME=ip Value='".$ip[0]."'>".chr(13).chr(10);
  	echo "<INPUT TYPE=HIDDEN NAME=lastlogin Value='".$lastlogin[0]."'>".chr(13).chr(10);

  	echo "</table>".chr(13).chr(10);
  	echo "<BR><INPUT TYPE=submit VALUE='Mitgliedsdaten &auml;ndern'>".chr(13).chr(10);
  	echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'".chr(13).chr(10);
  	echo "</FORM>".chr(13).chr(10);

  	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
  	include("../forms/navigation.php");
  	writenavigation($objDBCon, $ux, $dx);

  	include("../../includes/forms/footer.php");
?>