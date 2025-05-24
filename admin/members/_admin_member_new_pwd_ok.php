<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Passwort ändern - Check");
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
	if (isset($_GET["ux"]))
	{
		$ux = $_GET["ux"];
	}

	if (isset($_REQUEST["ux"]))
	{
		$ux = $_REQUEST["ux"];
	}
	$curUser = strGetCurrentUserByID($objDBCon, $ux);


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
	if (isset($_GET["dx"]))
	{
		$dx = $_GET["dx"];
	}

	if (isset($_REQUEST["dx"]))
	{
		$dx = $_REQUEST["dx"];
	}

	if ($dx=="")
	{
		$dx=0;
	}


	// Die Inhalte überprüfen:
	$errText = "";


	// ##############################################
	// 6.) Die Daten holen:
	if (isset($_GET["px_old"]))
	{
		$px_old = $_GET["px_old"];
	}

	if (isset($_REQUEST["px_old"]))
	{
		$px_old = $_REQUEST["px_old"];
	}

	// Das neue Passwort:
	if (isset($_GET["px_new"]))
	{
		$px_new = $_GET["px_new"];
	}

	if (isset($_REQUEST["px_new"]))
	{
		$px_new = $_REQUEST["px_new"];
	}

	// Das neue Passwort bestätigen:
	if (isset($_GET["px_valid"]))
	{
		$px_valid= $_GET["px_valid"];
	}

	if (isset($_REQUEST["px_valid"]))
	{
		$px_valid= $_REQUEST["px_valid"];
	}

	$strMessage = "";

	// ##############################################
	// 7.) Daten überprüfen:
	// 7.1.) Länge: 
	if (strlen(trim($px_new)) < 6)
	{
		$strMessage = "Das von Ihnen eingebene neue Passwort ist zu kurz!<BR>";
	}

	if (strlen(trim($px_new)) > 12)
	{
		$strMessage = "Das von Ihnen eingebene neue Passwort ist zu lang!<BR>";
	}

	// ##############################################
	// 7.2.) Passt die Bestätigung?
	if ($px_new != $px_valid)
	{
		$strMessage = $strMessage."Das von Ihnen eingebene neue Passwort ist nicht identisch mit der Best&auml;tigungseingabe!<BR>";
	}

	// ##############################################
	// 7.3.) Gleiches Passwort?
	if ($px_new == $px_old)
	{
		$strMessage = $strMessage."Das von Ihnen eingebene neue Passwort entspricht dem alten Passwort!<BR>";
	}

	// ##############################################
	// 7.4.) Die ID des Benutzers ermitteln und dekodieren:
	if (isset($_GET["ux"]))
	{
		$ux = $_GET["ux"];
	}

	if (isset($_REQUEST["ux"]))
	{
		$ux = $_REQUEST["ux"];
	}

	$id = base64_decode($ux);
	$id = strrev($id);

	// ##############################################
	// 8.) Eingabe bisher korrekt?
	if ($strMessage == "")
	{
		// 8.1.) Gibt es diesen Benutzer?
		$px_SQL = strrev($px_old);
		$px_SQL = base64_encode($px_SQL);
		$px_SQL = "'".mysqli_escape_string($objDBCon, $px_SQL)."'";

		$strSQL = "select * from skk_members WHERE id=".$id." AND pwd=".$px_SQL." AND del='N' AND modifieddate IS NULL;";

		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

		if ($RecordCount > 0)
		{
			// Ja, es gibt diesen Benutzer!
			// Daten aktualisieren:
			// Passwort kodieren (Reihenfolge wird umgekehrt und BASE64 - kodiert):
			$px_SQL = strrev($px_new);
			$px_SQL = base64_encode($px_SQL);

			$px_SQL = mysqli_real_escape_string($objDBCon, $px_SQL);
			$now = date("Y-m-d H:i");

			$strSQL = "UPDATE skk_members SET PWD='".$px_SQL."', createdate='".$now."' ";
			$strSQL = $strSQL."WHERE id=".$id." AND del='N' AND modifieddate IS NULL;";

			// Ausführen:
			if (!mysql_query ($objDBCon, $strSQL))
			{
				echo "Database update error!<P>".chr(13).chr(10);
				echo $strSQL."<BR>".chr(13).chr(10);
				echo mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
				echo "Aufgrund des aufgetretenen Problems kann das Passwort nicht aktualisiert werden!".chr(13).chr(10);
			}
			else
			{
				echo "<SPAN CLASS=he1>Passwort aktualisieren</SPAN><BR><BR>".chr(13).chr(10);
				echo "Ihr Passwort wurde erfolgreich aktualisiert.<BR>".chr(13).chr(10);
			}
		}
		else
		{
			// Es konnte kein passendes Benutzerobjekt ermittelt werden!
			echo "<font color='#FF0000' size=4><BR><b>Fehler beim Aktualisieren</b><BR><BR></font>".chr(13).chr(10);
			echo "<b>Das aktuelle Mitglied konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
			echo "<I>Das eingegebene Passwort passt nicht zum aktuellen Benutzer.</I>".chr(13).chr(10);
			echo "<BR><BR>".chr(13).chr(10);
			echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
			echo "<BR><BR>".chr(13).chr(10);
			echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
		}
	}
	else
	{
		// Es konnte kein passendes Benutzerobjekt ermittelt werden!
		echo "<font color='#FF0000' size=4><BR><b>Fehler beim Aktualisieren</b><BR><BR></font>".chr(13).chr(10);
		echo "<b>Das aktuelle Mitglied konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
		echo "<I>".$strMessage."</I>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
	}

  	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
  	include("../forms/navigation.php");
  	writenavigation($objDBCon, $ux, $dx);

  	include("../../includes/forms/footer.php");
?>








