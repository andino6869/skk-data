<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Gemeldeten Spieler im AFRO - Turnier bearbeiten");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>
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
	include("_admin_param_ux.php");

	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "A")==0)
	{
		// Keine Gültigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("_admin_param_dx.php");

	echo "<SPAN CLASS=he1>Gemeldeten Spieler im AFRO - Turnier bearbeiten (AFRO - PLAYER - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// Die Daten holen:
	$curYear = substr(date("Y-m-t"),0,4);

	$strSQL = "select * from skk_afro_players WHERE del='N' AND modifieddate IS NULL AND curyear >= $curYear ";
	$strSQL = $strSQL."ORDER BY surname DESC, firstname, curyear ASC;";
	
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Konnten Datensätz ermittelt werden:
	if ($RecordCount > 0)
	{
		echo "<form method=post action='_admin_edit_afro_player.php'>".chr(13).chr(10);

		// Die aktuellen Benutzerdaten sichern:
		echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
		echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

		// Die Tabelle erstellen:
		echo "<TABLE width='100%' border=1>".chr(13).chr(10);
		echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Spieler:</U></B>";

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>W&auml;hlen Sie hier den Spieler aus, dessen Daten Sie bearbeiten m&ouml;chten.</I>";
		}
		echo "</TD></TR>".chr(13).chr(10);
		echo "<TR><TD width='100%'><SELECT NAME='ID' style='width:100%'>".chr(13).chr(10);

		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
	  		$surname[$i] = $row->surname;
	  		$firstname[$i] = $row->firstname;
	  		$ID[$i] = $row->id;
	  		$birthdate[$i] = $row->birthdate;
	  		echo "<OPTION Value='".$ID[$i]."'>".formatoutput($surname[$i])." ".formatoutput($firstname[$i]).", geboren am ";
	  		echo substr($birthdate[$i],8,2).".".substr($birthdate[$i],5,2).".".substr($birthdate[$i],0,4).chr(13).chr(10);
	  		$i++;
	  	}

		echo "</SELECT></TD>".chr(13).chr(10);
		echo "</tr>".chr(13).chr(10);
		echo "</table>".chr(13).chr(10);

		echo "<BR><INPUT TYPE=submit Value='Spieler bearbeiten'>".chr(13).chr(10);

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
			echo "Die hier angezeigten Datens&auml;tze stammen aus der Tabelle 'skk_afro_players' und sind nach dem Nach- und Vornamen der Spieler aufsteigend sortiert.<BR><BR>".chr(13).chr(10);
		}
		echo "</FORM>".chr(13).chr(10);
	}
	else
	{
		echo "<BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
		echo "In der Tabelle 'skk_afro_players' befinden sich derzeit keine bearbeitbaren Datens&auml;tze.<BR><BR>".chr(13).chr(10);
		include("_admin_ok_link.php");
	}

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>

