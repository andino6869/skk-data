<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Tabelle l&ouml;schen");
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
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($con, $ux, "R")==0)
	{
		// Keine Gültigkeit mehr!
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

	echo "<SPAN CLASS=he1>Tabelle l&ouml;schen (CONTENT - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// Die Daten holen:
	$strSQL = "select * from skk_content WHERE del='N' AND modifieddate IS NULL ORDER BY title DESC";
	$result = mysql_query($strSQL);
	$num = mysql_numrows($result);

	// Konnten Datensätz ermittelt werden:
	if ($num>0)
	{
		echo "<form method=post action='_admin_contentdel_ok.php'>".chr(13).chr(10);

		// Die aktuellen Benutzerdaten sichern:
		echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
		echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

		
		echo "<TABLE width='100%' border=1>".chr(13).chr(10);
		echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Eintrag:</U></B>";

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>W&auml;hlen Sie hier die Tabelle aus, die Sie l&ouml;schen m&ouml;chten. Die hier angezeigten Datens&auml;tze stammen aus der Tabelle 'skk_content' und sind nach dem Titel ".chr(13).chr(10);
			echo "der Tabelle absteigend sortiert.</I>";
		}
		echo "</TD></TR>".chr(13).chr(10);

		
		// Ausgabe der Auswahliste:
		echo "<TR><TD width='100%'><SELECT NAME=ID style='width:100%'>".chr(13).chr(10);

		for ($i=0;$i<$num;$i++)
		{
			$nrak = $num - $i - 1;

		  	$Titel[$i] = mysql_result($result,$nrak,"title");
		  	$ID[$i] = mysql_result($result,$nrak,"ID");
		  	echo "<OPTION Value='",$ID[$i],"'>", $Titel[$i].chr(13).chr(10);
		}
		echo "</SELECT></TD>".chr(13).chr(10);
		echo "</tr>".chr(13).chr(10);
		echo "</table>".chr(13).chr(10);

		echo "<BR><INPUT TYPE=submit Value='Tabelle entfernen'>".chr(13).chr(10);
	}
	else
	{
		echo "<BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
		echo "In der Tabelle 'skk_content' befinden sich derzeit keine bearbeitbaren Datens&auml;tze.<BR>".chr(13).chr(10);
	}

	echo "</FORM>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($ux, $dx);

	include("../includes/forms/footer.php");
?>





























