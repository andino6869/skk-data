<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Partie l&ouml;schen");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php
	// 1.) Das Verbindungsobjekt ermitteln:
	$con = GetCon();

	// 2.) In Abh�ngigkeit von der aktuellen Position wird nun der Navigationsbar
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
	// 4.) Ist der aktuelle Login noch g�ltig?
	if (IsSessionValid($con, $ux, "R")==0)
	{
		// Keine G�ltigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}
	echo "<SPAN CLASS=he1>Partie l&ouml;schen (MATCH - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// Die Daten holen:
	$strSQL = "select * from skk_matches WHERE del='N' AND modifieddate IS NULL ORDER BY matchdate DESC";
	$result = mysql_query($strSQL);
	$num = mysql_numrows($result);

	// Konnten Datens�tz ermittelt werden:
	if ($num>0)
	{
		echo "<form method=post action='_admin_partiedel_ok.php'>".chr(13).chr(10);

		// Die aktuellen Benutzerdaten sichern:
		echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);


		echo "<table cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
		echo "<tr><td>Titel</td><td>".chr(13).chr(10);

		echo "<SELECT NAME=ID>";

		for ($i=0;$i<$num;$i++)
	  	{
	  		$nrak = $num - $i - 1;

	  		$Titel[$i] = mysql_result($result,$nrak,"title");
	  		$ID[$i] = mysql_result($result,$nrak,"ID");
	  		echo "<OPTION Value='",$ID[$i],"'>",$Titel[$i];
	  	}

	  	echo "</SELECT>".chr(13).chr(10);
		echo "</tr><tr><td>&nbsp;</td><td>".chr(13).chr(10);
		echo "<INPUT TYPE=submit Value='Partie entfernen'>".chr(13).chr(10);
		echo "</td>".chr(13).chr(10);
		echo "</table>".chr(13).chr(10);
		echo "<BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
		echo "Die hier angezeigten Datens&auml;tze stammen aus der Tabelle 'skk_matches' und sind nach dem Datum der Partie absteigend sortiert.<BR><BR>".chr(13).chr(10);
		echo "Wenn Sie diese Aktion durchf&uuml;hren, ".chr(13).chr(10);
		echo "werden alle Daten zu dieser Partie aus der Tabelle 'skk_matches' gel&ouml;scht!<BR><BR>".chr(13).chr(10);
	}
	else
	{
		echo "<BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
		echo "In der Tabelle 'skk_matches' befinden sich derzeit keine bearbeitbaren Datens&auml;tze.<BR>".chr(13).chr(10);
	}


	echo "</FORM>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($ux);

	include("../includes/forms/footer.php");
?>





























