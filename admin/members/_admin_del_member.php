<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Mitglied l&ouml;schen");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
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
	if (IsSessionValid($objDBCon, $ux, "A")==0)
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

	echo "<SPAN CLASS=he1>Mitglied l&ouml;schen (MEMBER - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// Die Daten holen:
	$strSQL = "select * from skk_members WHERE del='N' AND modifieddate IS NULL ORDER BY name DESC";
	
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Konnten Datensätz ermittelt werden:
	if ($RecordCount > 0)
	{
		echo "<form method=post action='_admin_del_member_ok.php'>".chr(13).chr(10);

		// Die aktuellen Benutzerdaten sichern:
		echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
		echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

		echo "<table cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);
		echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Mitglied:</U></B>".chr(13).chr(10);

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Die hier angezeigten Datens&auml;tze stammen aus der Tabelle 'skk_members' und sind nach Vor- ";
			echo "und Nachnamen des Mitglieds aufsteigend sortiert.<BR><BR>".chr(13).chr(10);
			echo "Wenn Sie diese Aktion durchf&uuml;hren, ".chr(13).chr(10);
			echo "werden alle Daten zu diesem Mitglied in der Tabelle 'skk_members' als gel&ouml;scht markiert!</I>";
		}

		echo "</TD><TR>".chr(13).chr(10);
		echo "<TR><TD><SELECT NAME=ID style='width:100%'>".chr(13).chr(10);

		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$Nachname[$i] = $row->name;
			$Vorname[$i] = $row->vorname;
			$ID[$i] = $row->ID;
			echo "<OPTION Value='",$ID[$i],"'>",$Nachname[$i]." ".$Vorname[$i].chr(13).chr(10);
			$i++;
		}

	  	echo "</SELECT>".chr(13).chr(10);
		echo "</tr>".chr(13).chr(10);
		echo "</table><BR>".chr(13).chr(10);
		echo "<INPUT TYPE=submit Value='Mitglied l&ouml;schen'>".chr(13).chr(10);

		echo "</FORM>".chr(13).chr(10);
	}
	else
	{
		echo "<BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
		echo "In der Tabelle 'skk_members' befinden sich derzeit keine bearbeitbaren Datens&auml;tze.<BR>".chr(13).chr(10);
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>





























