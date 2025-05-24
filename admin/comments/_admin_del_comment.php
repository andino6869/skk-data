<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Kommentar l&ouml;schen");
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


	// ##################################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("../_admin_param_ux.php");

	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "R")==0)
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

	echo "<SPAN CLASS=he1>Kommentar l&ouml;schen (COMMENT - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);
	echo "<form method=post action='_admin_del_comment_ok.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	// Die Daten holen:
	$strSQL = "select * from skk_comments WHERE del='N' AND modifieddate IS NULL ORDER BY nameanswer DESC";
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// ####################################
	// Konnten Datensätze ermittelt werden:
	if ($RecordCount > 0)
	{
		echo "<table border=1 width='100%'>".chr(13).chr(10);
		echo "<tr><td bgcolor='#C0C0C0'><B><U>Eintrag:</B></U>".chr(13).chr(10);

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR><I>Die hier angezeigten Datens&auml;tze stammen aus der Tabelle 'skk_comments' und sind nach dem Erstellungsdatum aufsteigend sortiert.</I>";
		}

		echo "</td></TR><TR><td><SELECT NAME=ID style='width:100%'>".chr(13).chr(10);

		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$createdate[$i] = $row->createdate;
			$nameanswer[$i] = $row->nameanswer;
			$answer[$i] = $row->answer;
			$ID[$i] = $row->id;
			
			if (strlen($nameanswer[$i]. " - ".$answer[$i]) > 50)
			{
				echo "<OPTION Value='",$ID[$i],"'>",substr($nameanswer[$i]." - ".$answer[$i],0,49)." ...".chr(13).chr(10);
			}
			else
			{
				echo "<OPTION Value='",$ID[$i],"'>",$nameanswer[$i]." - ".$answer[$i].chr(13).chr(10);
			}
			
			$i++;
		}

		echo "</SELECT>".chr(13).chr(10);
		echo "</td></tr>".chr(13).chr(10);
		echo "</table>".chr(13).chr(10);

		echo "<BR><INPUT TYPE=submit Value='Kommentar l&ouml;schen'>".chr(13).chr(10);

		echo "<BR><BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
		echo "Wenn Sie diese Aktion durchf&uuml;hren, ".chr(13).chr(10);
		echo "wird der aktuelle Kommentar aus der Tabelle 'skk_comments' als gel&ouml;scht markiert!<BR><BR>".chr(13).chr(10);
	}
	else
	{
		echo "<BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
		echo "In der Tabelle 'skk_comments' befinden sich derzeit keine bearbeitbaren Datens&auml;tze.<BR>".chr(13).chr(10);
	}

	echo "</FORM>".chr(13).chr(10);

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>