<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Fotogalerie l&ouml;schen");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/date/date.php")?>
<?php include("../../includes/string/str.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// 1.) Das Verbindungsobjekt ermitteln:
	$objDBCon = GetCon();

	// 2.) In Abh&auml;ngigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon, "FALSE");

	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("../_admin_param_ux.php");

	// ##############################################
	// 4.) Den aktuellen Dispatcher ermitteln:
	include("../_admin_param_dx.php");

	// ##############################################
	// 5.) Ist der aktuelle Login noch g&uuml;ltig?
	if (IsSessionValid($objDBCon, $ux, "R")==0)
	{
		// Keine G&uuml;ltigkeit mehr!
		include("../../includes/forms/middler.php");
		include("../forms/navigation_access_denied.php");
		include("../../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	$objectclassicon = "galery.gif";
	include("../forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Fotogalerie l&ouml;schen (GALERY - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);
	echo "<form method=post action='_admin_del_galery_ok.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	// Die Daten holen:
	$strSQL = "select * from skk_galery WHERE del='N' AND modifieddate IS NULL ORDER BY galery DESC";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Konnten Einträge gefunden werden?
	if ($RecordCount > 0)
	{
		echo "<TABLE width='100%' border=1>".chr(13).chr(10);
		echo "<TR><TD width='100%'  bgcolor='#C0C0C0'><B><U>Eintrag:</U></B>";

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>W&auml;hlen Sie hier die Galerie aus, die Sie l&ouml;schen m&ouml;chten. Die hier angezeigten Datens&auml;tze stammen aus der Tabelle 'skk_galery' und sind nach dem Galerienamen ".chr(13).chr(10);
			echo " aufsteigend sortiert. <BR><BR>Hinweis:<BR><BR><B>Es werden auch ALLE Bilddateien zu dieser Galerie mit gel&ouml;scht!<B></I>";
		}
		echo "</TD></TR>".chr(13).chr(10);

		// Ausgabe der Auswahliste:
		echo "<TR><TD width='100%'><SELECT NAME=ID style='width:100%'>".chr(13).chr(10);

		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$galery[$i] = formatoutput($row->galery);
			$ID[$i] = $row->id;
			echo "<OPTION Value='",$ID[$i],"'>", $galery[$i].chr(13).chr(10);
			$i++;
		}
		
		echo "</SELECT></TD>".chr(13).chr(10);
		echo "</tr>".chr(13).chr(10);
		echo "</table>".chr(13).chr(10);

		echo "<BR><INPUT TYPE=submit Value='Galerie l&ouml;schen'>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'><BR><BR>".chr(13).chr(10);
	}
	else
	{
		echo "<BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
		echo "In der Tabelle 'skk_galery' befinden sich derzeit keine bearbeitbaren Datens&auml;tze.<BR>".chr(13).chr(10);
	}

	echo "</FORM>".chr(13).chr(10);

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>




























