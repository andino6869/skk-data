<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Turnierdaten Bearbeiten");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/date/date.php")?>
<?
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
	echo "<SPAN CLASS=he1>Turnierdaten bearbeiten (TOURNAMENT - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);
	echo "<form method=post action='_admin_edit_tournament.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	// Die Daten holen:
	$strSQL = "select * from skk_tournaments WHERE del='N' AND modifieddate IS NULL ORDER BY tournament DESC";

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
			echo "<I>W&auml;hlen Sie hier das Turnier aus, die Sie bearbeiten m&ouml;chten. Die hier angezeigten Datens&auml;tze stammen aus der Tabelle 'skk_tournaments' und sind nach dem Turnier ".chr(13).chr(10);
			echo " aufsteigend sortiert.</I>";
		}
		echo "</TD></TR>".chr(13).chr(10);

		// Ausgabe der Auswahliste:
		echo "<TR><TD width='100%'><SELECT NAME=Nr style='width:100%'>".chr(13).chr(10);

		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
		  	$tournament[$i] = $row->tournament;
		  	$ID[$i] = $row->ID;
		  	echo "<OPTION Value='",$ID[$i],"'>", $tournament[$i].chr(13).chr(10);
		  	$i++;
		}
		echo "</SELECT></TD>".chr(13).chr(10);
		echo "</tr>".chr(13).chr(10);
		echo "</table>".chr(13).chr(10);

		echo "<BR><INPUT TYPE=submit Value='Turnier bearbeiten'>".chr(13).chr(10);
	}
	else
	{
		echo "<BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
		echo "In der Tabelle 'skk_tournaments' befinden sich derzeit keine bearbeitbaren Datens&auml;tze.<BR>".chr(13).chr(10);
	}

	echo "</FORM>".chr(13).chr(10);

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>




























