<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Benutzerpasswort ändern", "TRUE");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
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
	if (isset($_GET["ux"])
	{
		$ux = $_GET["ux"];
	}

	if (isset($_REQUEST["ux"])
	{
		$ux = $_REQUEST["ux"];
	}
	$curUser = strGetCurrentUserByID($objDBCon, $ux);


	// ##############################################
	// 4.) Den aktuellen Dispatcher ermitteln:
	if (isset($_GET["dx"])
	{
		$dx = $_GET["dx"];
	}

	if (isset($_REQUEST["ux"])
	{
		$dx = $_REQUEST["dx"];
	}

	if ($dx=="")
	{
		$dx=0;
	}


	// ##############################################
	// 5.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "R")==0)
	{
		// Keine G&uuml;ltigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}

	// ##################################
	echo "<SPAN CLASS=he1>Benutzerpasswort &auml;ndern</SPAN><BR><BR>".chr(13).chr(10);

	echo "<FORM ACTION='_admin_member_new_pwd_ok.php'>";

	// Die aktuellen Benutzerdaten und den Dispatcher sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	echo "<table border=1 width='100%'>";

	echo "<tr>";
	echo "<td width='50%' bgcolor='#C0C0C0'>Aktueller Benutzer:</td>";
	echo "<td width='50%'>";
	echo $curUser ;
	echo "</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td width='50%' bgcolor='#C0C0C0'>Altes Passwort (min. 6 Zeichen, max. 12 Zeichen):</td>";
	echo "<td width='50%'>";
	echo "<INPUT TYPE=PASSWORD SIZE=12 maxlength=12 NAME='px_old' style='width:100%'>";
	echo "</td>";
	echo "</tr>";

	echo "<tr>";
	echo "<td bgcolor='#C0C0C0'>Neues Passwort (min. 6 Zeichen, max. 12 Zeichen):</td>";
	echo "<td>";
	echo "<INPUT TYPE=PASSWORD SIZE=12 maxlength=12 NAME='px_new' style='width:100%'>";
	echo "</td>";
	echo "</tr>";

	echo "<tr>";
	echo "<td bgcolor='#C0C0C0'>Passwort  best&auml;tigen (min. 6 Zeichen, max. 12 Zeichen):</td>";
	echo "<td>";
	echo "<INPUT TYPE=PASSWORD SIZE=12 maxlength=12 NAME='px_valid' style='width:100%'>";
	echo "</td>";
	echo "</tr>";

	echo "</table>";
	echo "<BR><INPUT TYPE=SUBMIT VALUE='Passwort &auml;ndern'></td>";
	echo "</FORM>";

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>