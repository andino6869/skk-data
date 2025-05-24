<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Kommentar l&ouml;schen");
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

	echo "<SPAN CLASS=he1>Liste der Besucherkommentar nach Erstellungsdatum absteigend (COMMENT - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// Die Daten holen:
	$strSQL = "select * from skk_comments WHERE del='N' AND modifieddate IS NULL ORDER BY createdate ASC";
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Konnten Datensätz ermittelt werden:
	if ($RecordCount > 0)
	{
		// Die aktuellen Benutzerdaten sichern:
		echo "<table cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);
		echo "<tr bgcolor='#dddddd'>";
		echo "<td>Name:</td>".chr(13).chr(10);
		echo "<td>Kommentar:</td>".chr(13).chr(10);
		echo "<td>Datum:</td>".chr(13).chr(10);
		echo "</tr>";

		$i = 0;
		
		while ($row = $rs->fetch_object())
		{
			$nameanswer[$i] = formatoutput($row->nameanswer);
			$answer[$i] = formatoutput($row->answer);
			$createdate[$i] = $row->createdate;
			$i++;
		}

		for ($i=0; $i<$RecordCount; $i++)
	  	{
			echo "<TR><TD>".$nameanswer[$i]."</TD><TD>".$answer[$i]."</TD><TD>".$createdate[$i]."</TD></TR>".chr(13).chr(10);
	  	}

		echo "</table>".chr(13).chr(10);
	}
	else
	{
		echo "<BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
		echo "In der Tabelle 'skk_comments' befinden sich derzeit keine Datens&auml;tze.<BR>".chr(13).chr(10);
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>