<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Tabelle bearbeiten", "TRUE");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/content_get.php")?>
<?php include("../includes/db/team_get.php")?>
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

	echo "<SPAN CLASS=he1>Tabelle bearbeiten (CONTENT - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);


	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	if (trim($dx)=="")
	{
		$dx = $_GET["dx"];
	}

	if (trim($dx)=="")
	{
		$dx = $_REQUEST["dx"];
	}

	if ($dx=="")
	{
		$dx=0;
	}

	// #####################
	// 6.) Die ID erfragen:
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
	$strSQL ="select * from skk_content WHERE ID=".$Nr." AND del='N' AND modifieddate IS NULL;";

	$result = mysql_query($strSQL);
	$num = mysql_numrows($result);

	if ($num > 0)
	{
		for ($i=0;$i<$num;$i++)
		{
			$nrak = $num - $i - 1;
			$ID[$i] = mysql_result($result,$nrak,"id");
			$Datum[$i] = mysql_result($result,$nrak,"contentdate");
			$Titel[$i] = mysql_result($result,$nrak,"title");
			$Kategorie[$i] = mysql_result($result,$nrak,"category");
			$Content[$i] = mysql_result($result,$nrak,"content");
		}
	}

	// #####################
	include("forms/fields_not_null.php");
	echo "<BR>Eine hier hinterlegte Tabelle kann dann z.B. für 'News und Meldungen' mit verwendet werden.<BR>".chr(13).chr(10);

	// #####################
	echo "<FORM METHOD=POST ACTION='_admin_contentaendern_ok.php'>".chr(13).chr(10);
   	echo "<INPUT TYPE=HIDDEN NAME=ID Value=$ID[0]>".chr(13).chr(10);


   	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);
   	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
   	echo "<INPUT TYPE='HIDDEN' NAME='Datum' Value='".$Datum[0]."'>".chr(13).chr(10);

	echo "<TABLE width='100%' border=1>".chr(13).chr(10);

	// Titel:
	echo "<TR><TD width='100%'  bgcolor='#C0C0C0'><B><U>Titel (max. 255 Zeichen): </U></B> *".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR><I>Geben Sie hier den Titel der neuen Tabelle an. Diese erscheint als erste Zeile zu dieser Tabelle ".chr(13).chr(10);
		echo "in der jeweiligen News - Liste. Die Angabe dieses Werte ist obligatorisch.</I>";
	}

	echo "</TD></TR>".chr(13).chr(10);
	echo "<TR><TD width='100%'><INPUT TYPE=TEXT SIZE=50 MAXLENGTH=255 style='width:100%' NAME=Titel VALUE='".$Titel[0]."'></TD></TR>";


	// Kategorie:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Kategorie:</U></B> *";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>Diese Angabe hat nur deklaratorischen Wert und wird derzeit nicht weiter ausgewertet.</I>";
	}

	echo "</TD></TR>";

	echo "<TR>".chr(13).chr(10);

	if($Kategorie[0]=="Verein")
	{
		echo "<TD><SELECT NAME=Kategorie style='width:100%'><OPTION SELECTED>Verein<OPTION>Jugend<OPTION>AFRO<OPTION>Verband</SELECT></TD>".chr(13).chr(10);
	}
	if($Kategorie[0]=="Jugend")
	{
		echo "<TD><SELECT NAME=Kategorie style='width:100%'><OPTION>Verein<OPTION SELECTED>Jugend<OPTION>AFRO<OPTION>Verband</SELECT></TD>".chr(13).chr(10);
	}
	if($Kategorie[0]=="AFRO")
	{
		echo "<TD><SELECT NAME=Kategorie style='width:100%'><OPTION>Verein<OPTION>Jugend<OPTION SELECTED>AFRO<OPTION>Verband</SELECT></TD>".chr(13).chr(10);
	}
	if($Kategorie[0]=="Verband")
	{
		echo "<TD><SELECT NAME=Kategorie style='width:100%'><OPTION>Verein<OPTION>Jugend<OPTION>AFRO<OPTION SELECTED>Verband</SELECT></TD>".chr(13).chr(10);
	}

 	echo "</TR>".chr(13).chr(10);


 	// Tabelle:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Tabelle:</U></B> *";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>Hier geben Sie den Tabelleningalt ein. Es sind alle g&auml;ngigen HTML - Tags zugelassen. ";
		echo "Ferner k&ouml;nnen nun auch die Zeichen ' und \" im Text verwendet werden.</I>";
	}
	echo "</TD></TR>";

 	echo "<TR>".chr(13).chr(10);
 	echo "<TD><TEXTAREA COLS=40 ROWS=20 style='width:100%' NAME=Content>".$Content[0]."</TEXTAREA></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "</TABLE>";

	echo "<BR><INPUT TYPE=Submit VALUE='Tabelle speichern'>";
	echo "</FORM>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($ux);

	include("../includes/forms/footer.php");
?>
































