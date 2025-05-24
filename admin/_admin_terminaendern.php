<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Termin bearbeiten");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/date/date.php")?>
<?php include("../includes/db/connection.php")?>
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
	include("_admin_param_ux.php");

	$objectclassicon = "deadline.gif";
	include("forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Termin bearbeiten (DEADLINE - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);
	
	// ################
	// Die ID erfragen:
	$Nr = strGetParam($objDBCon, "Nr");
	
	// #####################
	// Die Daten aus der Datenbank ermitteln:
	$strSQL ="select * from skk_deadline WHERE ID=".$Nr." AND del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
		   $ID[$i] = $row->id;
		   $Termin[$i] = $row->deadline;
		   $Kategorie[$i] = $row->category;
		   $Datum[$i] = $row->deadlinedate;
		   $Art[$i] = $row->kind;
		   $i++;
		}
	}

	// #####################
	include("forms/fields_not_null.php");

	// #####################
	echo "<FORM METHOD=POST ACTION='_admin_terminaendern_ok.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

    echo "<INPUT TYPE=HIDDEN NAME=ID Value=$ID[0]>".chr(13).chr(10);
	echo "<TABLE cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0' width='33%'><B><U>Termin (max. 255 Zeichen): *</B></U></TD>".chr(13).chr(10);
	echo "<TD VALIGN=top width='66%'><TEXTAREA COLS=40 ROWS=6 NAME=Termin style='width:100%'>".$Termin[0]."</TEXTAREA></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Datum (Format: TT.MM.JJJJ): *</B></U></TD><TD>".chr(13).chr(10);

	$curYear = substr($Datum[0],0,4);
	$curMonth = substr($Datum[0],5,2);
	$curDay = substr($Datum[0],8,2);

 	writeDateField("deadlinedate_day", "deadlinedate_month", "deadlinedate_year", $curDay, $curMonth, $curYear);

	echo "</TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Art: *</B></U><BR>z.B. 1. Mannschaft oder Klubturnier etc., max. 100 Zeichen, entspricht der &Uuml;berschrift</TD>".chr(13).chr(10);
	echo "<TD><INPUT TYPE=TEXT SIZE=40 MAXLENGTH=100 NAME=Art style='width:100%' VALUE='".$Art[0]."'></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Kategorie: *</B></U></TD>".chr(13).chr(10);

	if($Kategorie[0]=="Alle") { echo "<TD><SELECT NAME=Kategorie style='width:100%'><OPTION SELECTED>Alle<OPTION>Jugend<OPTION>100-Jahre-Feier</SELECT></TD>".chr(13).chr(10); }
	if($Kategorie[0]=="Jugend"){ echo "<TD><SELECT NAME=Kategorie style='width:100%'><OPTION>Alle<OPTION SELECTED>Jugend<OPTION>100-Jahre-Feier</SELECT></TD>".chr(13).chr(10); }
	if($Kategorie[0]=="100-Jahre-Feier"){ echo "<TD><SELECT NAME=Kategorie style='width:100%'><OPTION>Alle<OPTION>Jugend<OPTION SELECTED>100-Jahre-Feier</SELECT></TD>".chr(13).chr(10); }
	
	echo "</TR>".chr(13).chr(10);
	echo "</TABLE>".chr(13).chr(10);
	echo "<BR><INPUT TYPE=Submit VALUE='Termin speichern'>".chr(13).chr(10);
	echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'></td>".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>































