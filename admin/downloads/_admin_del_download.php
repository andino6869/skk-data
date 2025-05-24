<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Download l&ouml;schen");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/string/str.php")?>
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
	include("../_admin_param_ux.php");


	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "H")==0)
	{
		// Keine Gültigkeit mehr!
		include("../../includes/forms/middler.php");
		include("../forms/navigation_access_denied.php");
		include("../../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("../_admin_param_dx.php");

	$objectclassicon = "download.jpg";
	include("../forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Download l&ouml;schen (DOWNLOAD - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// Die Daten holen:
	$strSQL = "select * from skk_downloads WHERE del='N' AND modifieddate IS NULL ORDER BY viewname DESC";
	
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Konnten Datensätz ermittelt werden:
	if ($RecordCount > 0)
	{
		echo "<form method=post action='_admin_del_download_ok.php'>".chr(13).chr(10);

		// Die aktuellen Benutzerdaten sichern:
		echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
		echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

		// Die Tabelle erstellen:
		echo "<TABLE width='100%' border=1>".chr(13).chr(10);
		echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Download:</U></B>";

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>W&auml;hlen Sie hier den Download aus, den Sie l&ouml;schen m&ouml;chten.</I>";
		}
		
		echo "</TD></TR>".chr(13).chr(10);
		echo "<TR><TD width='100%'><SELECT NAME=ID style='width:100%'>".chr(13).chr(10);

		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$viewname[$i] = formatoutput($row->viewname);
			$ID[$i] = $row->id;
			echo "<OPTION Value='",$ID[$i],"'>",$viewname[$i].chr(13).chr(10);
			$i++;
		}

	  	echo "</SELECT></TD>".chr(13).chr(10);
		echo "</tr>".chr(13).chr(10);
		echo "</table>".chr(13).chr(10);

		echo "<BR><INPUT TYPE=submit Value='Download entfernen'>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'><BR><BR>".chr(13).chr(10);

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
			echo "Die hier angezeigten Datens&auml;tze stammen aus der Tabelle 'skk_downloads' und sind nach dem Anzeigenamen aufsteigend sortiert.<BR><BR>".chr(13).chr(10);
			echo "Wenn Sie diese Aktion durchf&uuml;hren, ".chr(13).chr(10);
			echo "werden alle Daten zu diesem Download aus der Tabelle 'skk_downloads' gel&ouml;scht!<BR><BR>".chr(13).chr(10);
		}
		echo "</FORM>".chr(13).chr(10);
	}
	else
	{
		echo "<BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
		echo "In der Tabelle 'skk_downloads' befinden sich derzeit keine bearbeitbaren Datens&auml;tze.<BR>".chr(13).chr(10);
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>





























