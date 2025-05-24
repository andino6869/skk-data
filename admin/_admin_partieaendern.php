<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Partie bearbeiten");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/date/date.php")?>
<?php include("../includes/db/connection.php")?>

<?php
	// 1.) Das Verbindungsobjekt ermitteln:
	$con = GetCon();

	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $con, "FALSE");


	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	if (trim($ux)=="")
	{
		$ux = $_GET["ux"];
	}

	if (trim($ux)=="")
	{
		$ux = $_REQUEST["ux"];
	}
	$curUser = strGetCurrentUserByID($con, $ux);


	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($con, $ux, "R")==0)
	{
		// Keine Gültigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}

	echo "<SPAN CLASS=he1>Partie bearbeiten (MATCH - Tabelle)</SPAN><BR><BR>";

	// #####################
	// Die ID erfragen:
	if (trim($Nr) == "")
	{
		$Nr = $_REQUEST["Nr"];
	}

	if (trim($Nr) == "")
	{
		$Nr = $_GET["Nr"];
	}

	// #####################
	// Die Daten aus der Datenbank ermitteln:
	$strSQL ="select * from skk_matches WHERE ID=".$Nr." AND del='N' AND modifieddate IS NULL;";

	$result = mysql_query($strSQL);
	$num = mysql_numrows($result);

	if ($num > 0)
	{
	 	for ($i=0;$i<$num;$i++)
	  	{
	   	   $nrak = $num - $i - 1;
	   	   $ID[$i] = mysql_result($result,$nrak,"id");
	   	   $Datum[$i] = mysql_result($result,$nrak,"matchdate");
		   $Titel[$i] = mysql_result($result,$nrak,"title");
		   $Aufstellung[$i] = mysql_result($result,$nrak,"nomination");
		   $Partiedaten[$i] = mysql_result($result,$nrak,"matchdata");
		   $Zuege[$i] = mysql_result($result,$nrak,"moves");
		   $Kurztext[$i] = mysql_result($result,$nrak,"shorttext");
		   $Hits[$i] = mysql_result($result,$nrak,"hits");
		   $Bewertung[$i] = mysql_result($result,$nrak,"marks");
		   $Stimmen[$i] = mysql_result($result,$nrak,"votes");
	    }
	}


	// #####################
	include("forms/fields_not_null.php");

	// #####################
	echo "<FORM METHOD=POST ACTION='_admin_partieaendern_ok.php'>".chr(13).chr(10);
	echo "<INPUT TYPE=HIDDEN NAME=ID Value=".$ID[0].">".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);

	echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo " <TD>Titel: *</TD>".chr(13).chr(10);
	echo "<TD><INPUT TYPE=TEXT SIZE=40 MAXLENGTH=100 NAME=Titel VALUE=".$Titel[0]."></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top>Datum (Format TT.MM.JJJJ): *</TD><TD>".chr(13).chr(10);

	$curYear = substr($Datum[0],0,4);
	$curMonth = substr($Datum[0],5,2);
	$curDay = substr($Datum[0],8,2);

 	writeDateField("matchdate_day", "matchdate_month", "matchdate_year", $curDay, $curMonth, $curYear);

 	echo "</TD>".chr(13).chr(10);
 	echo "</TR>".chr(13).chr(10);

	echo "<TR>".chr(13).chr(10);
	echo "<TD>Kurztext: *</TD>".chr(13).chr(10);
	echo "<TD><TEXTAREA COLS=40 ROWS=20 NAME=Kurztext>".$Kurztext[0]."</TEXTAREA></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD>Aufstellung: *</TD>".chr(13).chr(10);
	echo "<TD><TEXTAREA COLS=40 ROWS=20 NAME=Aufstellung>".$Aufstellung[0]."</TEXTAREA></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD>Partiedaten: *</TD>".chr(13).chr(10);
	echo "<TD><TEXTAREA COLS=40 ROWS=20 NAME=Partiedaten>".$Partiedaten[0]."</TEXTAREA></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD>Züge: *</TD>".chr(13).chr(10);
	echo "<TD><TEXTAREA COLS=40 ROWS=20 NAME=Zuege>".$Zuege[0]."</TEXTAREA></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD>&nbsp;</TD>".chr(13).chr(10);
	echo "<TD><INPUT TYPE=Submit VALUE='Partie speichern'></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "</TABLE>".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($ux);

	include("../includes/forms/footer.php");
?>


























