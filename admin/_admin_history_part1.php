<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Geschichte des SK Kriegshaber - Teil 1");
?>
<?php include("../includes/forms/navigation.php")?>
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
	// 4.) Ist der aktuelle Login noch g&uuml;ltig?
	if (IsSessionValid($con, $ux, "H")==0)
	{
		// Keine G&uuml;ltigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}

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

	echo "<SPAN CLASS=he1>'Geschichte des SK Kriegshaber - Teil 1' bearbeiten (HISTORY - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// Die Daten aus der Datenbank ermitteln:
	$strSQL ="select text from skk_about WHERE del='N' AND modifieddate IS NULL;";

	$result = mysql_query($strSQL);
	$num = mysql_numrows($result);

	if ($num > 0)
	{
		for ($i=0;$i<$num;$i++)
		{
		   $nrak = $num - $i - 1;
		   $Text[$i] = mysql_result($result,$nrak,"text");
		}
	}

	include("forms/fields_not_null.php");

	echo "<FORM METHOD=POST ACTION='_admin_about_ok.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);

	echo "<TABLE cellpadding=5 cellspacing=0 border=1>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Seiteninhalt:</U></B> *";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Geben Sie hier den Inhalt der Seite 'Wir &uuml;ber uns' ein. Es sind alle g&auml;ngigen HTML - Tags zugelassen. ".chr(13).chr(10);
		echo "Ferner können nun auch die Zeichen ' und \" im Text verwendet werden.</I>";
	}
	echo "</TD></TR>".chr(13).chr(10);

	$strItem = $Text[0];
	$strItem = str_replace("\'", "'", $strItem);
	$strItem = str_replace("\\".chr(34), chr(34), $strItem);

	echo "<TR><TD><TEXTAREA COLS=80 ROWS=30 ";
	echo "style='width:100%' NAME=Text>".$strItem."</TEXTAREA></TD>";


	echo "</TR>".chr(13).chr(10);
	echo "</TABLE>".chr(13).chr(10);

	echo "<INPUT TYPE=Submit VALUE='Inhalt speichern'>".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($ux, $dx);

	include("../includes/forms/footer.php");
?>