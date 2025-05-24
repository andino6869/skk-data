<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Gemeldeten Spieler im AFRO - Turnier bearbeiten");
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

	// 2.) In Abh‰ngigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon, "FALSE");

	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("_admin_param_ux.php");

	// ##############################################
	// 4.) Ist der aktuelle Login noch g¸ltig?
	if (IsSessionValid($objDBCon, $ux, "A")==0)
	{
		// Keine G¸ltigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}
	
	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("_admin_param_dx.php");
	
	echo "<SPAN CLASS=he1>Gemeldeten Spieler im AFRO - Turnier bearbeiten (AFRO - PLAYER - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// #####################
	// Die ID erfragen:
	$ID = strGetParam($objDBCon, "ID");
	
	// #####################
	$strSQL = "select * from skk_afro_players WHERE id=".$ID." AND del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
		   	$tournament[$i] = $row->tournament;
		   	$surname[$i] = $row->surname;
		   	$firstname[$i] = $row->firstname;
		   	$addrstreet[$i] = $row->addrstreet;
		   	$addrzipcode[$i] = $row->addrzipcode;
		   	$addrcity[$i] = $row->addrcity;
		   	$telephone[$i] = $row->telephone;
		   	$email[$i] = $row->email;
		   	$birthdate[$i] = $row->birthdate;
		   	$dwz[$i] = $row->dwz;
		   	$elo[$i] = $row->elo;
		   	$title[$i] = $row->title;
		   	$organization[$i] = $row->organization;
		   	$ip[$i] = $row->ip;
		   	$os[$i] = $row->os;
		   	$curyear[$i] = $row->curyear;
		   	$verified[$i] = $row->verified;
		   	$i++;
		}
	}

	// #####################
	// Datenausgabe:
	echo "<FORM METHOD=POST ACTION='_admin_edit_afro_player_ok.php'>".chr(13).chr(10);
	echo "<INPUT TYPE=HIDDEN NAME=ID Value='".$ID."'>".chr(13).chr(10);
	echo "<INPUT TYPE=HIDDEN NAME=ip Value='".$ip[0]."'>".chr(13).chr(10);
	echo "<INPUT TYPE=HIDDEN NAME=os Value='".$os[0]."'>".chr(13).chr(10);
	echo "<INPUT TYPE=HIDDEN NAME=curyear Value='".$curyear[0]."'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);

	echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);


	echo "<TD WIDTH='33%'>AFRO - Turnier: *</TD>".chr(13).chr(10);
	echo "<TD WIDTH='66%'><SELECT NAME='tournament' TITLE='Beachten Sie bitte die unterschiedlichen Konditionen ";
	echo "(DWZ - Grenzen, Preisgelder, etc.) f¸r die jeweiligen Turniere, bevor Sie sich anmelden.'>".chr(13).chr(10);

	// Das Turnier:
	if ($tournament[0]=="A")
	{
		echo "<OPTION VALUE='A' SELECTED>A-Turnier (alle Spieler)<OPTION VALUE='B'>B-Turnier (bis DWZ 1900)".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION VALUE='A'>A-Turnier (alle Spieler)<OPTION VALUE='B' SELECTED>B-Turnier (bis DWZ 1900)".chr(13).chr(10);
	}

	echo "</SELECT></TD>".chr(13).chr(10);
 	echo "</TR>".chr(13).chr(10);


	echo "<tr><td>Nachname (max. 255 Zeichen): *</td><td><INPUT TYPE=TEXT SIZE='66%' VALUE='$surname[0]' ";
	echo "TITLE='Bitte tragen Sie hier Ihren Nachnamen inkl. etwaiger Pr‰fixe wie von oder zu ein.' ";
	echo "MAXLENGTH=255 NAME=surname></td></tr>".chr(13).chr(10);

	echo "<tr><td>Vorname (max. 255 Zeichen): *</td><td><INPUT TYPE=TEXT SIZE='66%' VALUE='$firstname[0]' ";
	echo "TITLE='Bitte tragen Sie hier Ihren Vornamen ein.' MAXLENGTH=255 NAME=firstname></td></tr>".chr(13).chr(10);

/*
	echo "<tr><td>Strasse (max. 255 Zeichen):</td><td><INPUT TYPE=TEXT SIZE='66%' VALUE='$addrstreet[0]' ";
	echo "TITLE='Hier kˆnnen Sie bei Bedarf die Strasse Ihres Wohnortes hinterlegen. Die korrekte Angabe Ihrer ";
	echo "Wohnanschrift ermˆglicht es uns gegebenenfalls, Ihnen etwaige Preise postalisch zuzustellen, sofern ";
	echo "Sie bei der Siegerehrung verhindert sein sollten.' MAXLENGTH=255 NAME=addrstreet></td></tr>".chr(13).chr(10);

	echo "<tr><td>PLZ (max. 10 Zeichen):</td><td><INPUT TYPE=TEXT SIZE=5  VALUE='$addrzipcode[0]' TITLE='Hier kˆnnen Sie bei Bedarf die ";
	echo "Postleitzahl Ihres Wohnortes hinterlegen. Die korrekte Angabe Ihrer Wohnanschrift ermˆglicht es uns ";
	echo "gegebenenfalls, Ihnen etwaige Preise postalisch zuzustellen, sofern Sie bei der Siegerehrung verhindert ";
	echo "sein sollten.' NAME=addrzipcode></td></tr>".chr(13).chr(10);

	echo "<tr><td>Ort (max. 255 Zeichen):</td><td><INPUT TYPE=TEXT SIZE='66%' VALUE='$addrcity[0]' TITLE='Hier kˆnnen Sie bei Bedarf ";
	echo "Ihrens Wohnort hinterlegen. Die korrekte Angabe Ihrer Wohnanschrift ermˆglicht es uns gegebenenfalls, ";
	echo "Ihnen etwaige Preise postalisch zuzustellen, sofern Sie bei der Siegerehrung verhindert sein sollten.' ";
	echo "MAXLENGTH=255 NAME=addrcity></td></tr>".chr(13).chr(10);

	echo "<tr><td>Telefon (max. 255 Zeichen):</td><td><INPUT TYPE=TEXT SIZE='66%' VALUE='$telephone[0]' MAXLENGTH=255 NAME=telephone ";
	echo "TITLE='Hier kˆnnen Sie bei Bedarf Ihre Telefonnummer hinterlegen, unter der Sie erreichbar sind.'></td></tr>".chr(13).chr(10);

	echo "<tr><td>Email (max. 255 Zeichen):</td><td><INPUT TYPE=TEXT SIZE='66%' VALUE='$email[0]' MAXLENGTH=255 NAME=email ";
	echo "TITLE='Hier kˆnnen Sie bei Bedarf Ihre Telefonnummer hinterlegen, unter der Sie erreichbar sind.'></td></tr>".chr(13).chr(10);
*/
	
	// Das Geburtsdatum:
	echo "</TD></TR>".chr(13).chr(10);
	echo "<TD>Geburtsdatum (Format: TT.MM.JJJJ):</TD><TD>".chr(13).chr(10);

  	$curYear = substr($birthdate[0],0,4);
  	$curMonth = substr($birthdate[0],5,2);
  	$curDay = substr($birthdate[0],8,2);

  	writeDateFieldBirthday("birth_day", "birth_month", "birth_year", $curDay, $curMonth, $curYear);

  	echo "</TD></TR>".chr(13).chr(10);

	// #################################
	// DWZ:
	echo "<tr><td>DWZ: *</td>".chr(13).chr(10);

	echo "<TD><SELECT NAME=DWZ TITLE='Bitte w‰hlen Sie hier Ihre aktuelle DWZ - Zahl aus. Sollten Sie derzeit ";
	echo "keine DWZ - Zahl haben, dann w‰hlen Sie bitte ".chr(34)."-".chr(34)." aus.'>".chr(13).chr(10);

	if (($dwz[0]=="-") || ($dwz[0]==""))
	{
		echo "<OPTION VALUE='-' SELECTED>-".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION VALUE='-'>-".chr(13).chr(10);
	}

	for ($i=500;$i<2800;$i++)
	{
		if ($dwz[0]==$i)
		{
			echo "<OPTION VALUE='$i' SELECTED>".$i.chr(13).chr(10);
		}
		else
		{
			echo "<OPTION VALUE='$i'>".$i.chr(13).chr(10);
		}
	}

	echo "</SELECT></TD>".chr(13).chr(10);
 	echo "</TR>".chr(13).chr(10);


	// #################################
	// ELO:
	echo "<tr><td>ELO: *</td>".chr(13).chr(10);

	echo "<TD><SELECT NAME=ELO TITLE='Bitte w‰hlen Sie hier Ihre aktuelle ELO - Zahl aus. Sollten Sie derzeit ";
	echo "keine ELO - Zahl haben, dann w‰hlen Sie bitte ".chr(34)."-".chr(34)." aus.'>".chr(13).chr(10);

	if (($elo[0]=="-") || ($elo[0]==""))
	{
		echo "<OPTION VALUE='-' SELECTED>-".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION VALUE='-'>-".chr(13).chr(10);
	}

	for ($i=500;$i<2800;$i++)
	{
		if ($elo[0]==$i)
		{
			echo "<OPTION VALUE='$i' SELECTED>".$i.chr(13).chr(10);
		}
		else
		{
			echo "<OPTION VALUE='$i'>".$i.chr(13).chr(10);
		}
	}

	echo "</SELECT></TD>".chr(13).chr(10);
 	echo "</TR>".chr(13).chr(10);

	// ###########################################
	// Titel:
	echo "<tr><td>Titel: *</td>".chr(13).chr(10);
	echo "<TD><SELECT NAME=title TITLE='Bitte w‰hlen Sie hier Ihren aktuellen FIDE - Titel aus. Sollten Sie derzeit ";
	echo "keinen FIDE - Titel haben, dann w‰hlen Sie bitte ".chr(34)."-".chr(34)." aus.'>".chr(13).chr(10);

	if ($title[0]=="-")
	{
		echo "<OPTION VALUE='-' SELECTED>-".chr(13).chr(10);
	}
	else
	{	
		echo "<OPTION VALUE='-'>-".chr(13).chr(10);
	}

	if ($title[0]=="CM")
	{
		echo "<OPTION VALUE='CM' SELECTED>Candidate Master".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION VALUE='CM'>Candidate Master".chr(13).chr(10);
	}

	if ($title[0]=="FM")
	{
		echo "<OPTION VALUE='FM' SELECTED>FIDE Meister".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION VALUE='FM'>FIDE Meister".chr(13).chr(10);
	}

	if ($title[0]=="IM")
	{
		echo "<OPTION VALUE='IM' SELECTED>Internationaler Meister".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION VALUE='IM'>Internationaler Meister".chr(13).chr(10);
	}

	if ($title[0]=="GM")
	{
		echo "<OPTION VALUE='GM' SELECTED>Gro&szlig;meister".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION VALUE='GM'>Gro&szlig;meister".chr(13).chr(10);
	}

	if ($title[0]=="WGM")
	{
		echo "<OPTION VALUE='WGM' SELECTED>Woman Grand Master".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION VALUE='WGM'>Woman Grand Master".chr(13).chr(10);
	}

	echo "</SELECT></TD>".chr(13).chr(10);
 	echo "</TR>".chr(13).chr(10);

	// Verein:
	echo "<tr><td>Verein (max. 255 Zeichen): *</td>";
	echo "<td><INPUT TYPE=TEXT SIZE='66%' MAXLENGTH=255 NAME=organization ";
	echo "VALUE='$organization[0]' TITLE='Hier geben Sie bitte den Verein an, bei dem Sie Mitglied sind. Sind Sie derzeit kein ";
	echo "Vereinsmitglied, dann tragen Sie hier bitte ".chr(34)."vereinslos".chr(34)." ein.'></td></tr>".chr(13).chr(10);
	
	// ####################
	// Anmeldung best‰tigt:
	echo "<tr><td>Anmeldung best&auml;tigt: *</td>".chr(13).chr(10);
	
	echo "<TD><SELECT NAME=verified TITLE='Bitte w‰hlen Sie hier aus, ob die Anmeldung des Teilnehmers best‰tigt worden ist. ";
	echo "Nicht best‰tigte Teilnehmer tauchen nicht in der offiziellen Teilnehmerliste mit auf.'>".chr(13).chr(10);
	
	if ($verified[0]=="" || $verified[0]=="n" || $verified[0]=="N")
	{
		echo "<OPTION VALUE='NEIN' SELECTED>NEIN".chr(13).chr(10);
		echo "<OPTION VALUE='JA'>JA".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION VALUE='JA' SELECTED>JA".chr(13).chr(10);
		echo "<OPTION VALUE='NEIN'>NEIN".chr(13).chr(10);
	}
	echo "</SELECT></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	
	// ####################
	// Tabelle abschlieﬂen:	
	echo "<TR><TD>&nbsp;</TD>".chr(13).chr(10);
	echo "<TD><INPUT TYPE=SUBMIT VALUE='Spielerdaten aktualisieren'><BR><BR>".chr(13).chr(10);
	echo "</td></TR>".chr(13).chr(10);
	echo "</table>".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>















