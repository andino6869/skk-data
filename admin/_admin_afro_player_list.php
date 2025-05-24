<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Gemeldete Spieler im AFRO - Turnier");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("_admin_afro_players_get.php")?>
<?php include("_admin_param.php")?>
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
	
	// 6.) Den Seiteninhalt ausgeben:
	$now = date("Y-m-d H:i:s");

	echo "<table width='700' border='0'>".chr(13).chr(10);
	echo "<tbody><tr>".chr(13).chr(10);
	echo "<td>".chr(13).chr(10);
	echo "<font size='4' color='#c3ccd0'><br><b>Teilnehmerliste AFRO ".substr($now,0,4)."</b><br><br></font>".chr(13).chr(10);

	// Wie soll sortiert werden?
	$orderby = strGetParam($objDBCon, "orderby");

	if ($orderby == "ELO")
	{
		$orderby = "ORDER BY elo, dwz";
	}

	if ($orderby == "ALPHA")
	{
		$orderby = "ORDER BY surname DESC, firstname DESC";
	}

	// Die Speiler aus dem A - Turnier lesen:
	get_player($objDBCon, "A", $orderby);

	echo "<BR><BR><BR>".chr(13).chr(10);

	// Die Spieler aus dem B - Turnier lesen:
	get_player($objDBCon, "B", $orderby);


	echo "</td>".chr(13).chr(10);
	echo "</tr>".chr(13).chr(10);
	echo "</tbody></table>".chr(13).chr(10);


	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>















