<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neues Passwort speichern - Check");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("_admin_param.php")?>
<?php
	$objDBCon = GetCon();

	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon, "FALSE");

	echo "<SPAN CLASS=he1>Admin-Bereich</SPAN><BR><BR>".chr(13).chr(10);

	// 1.) Die Daten holen:
	$ulx = strGetParam($objDBCon, "ulx");
	$ufx = strGetParam($objDBCon, "ufx");
	$px = strGetParam($objDBCon, "px");
	$px_valid = strGetParam($objDBCon, "px_valid");

	$strMessage = "";

	// 2.) Daten überprüfen:
	if (strlen(trim($px)) < 6)
	{
		$strMessage = "Das von Ihnen eingebene Passwort ist zu kurz!<BR>";
	}

	if (strlen(trim($px)) > 12)
	{
		$strMessage = "Das von Ihnen eingebene Passwort ist zu lang!<BR>";
	}

	if ($px != $px_valid)
	{
		$strMessage = $strMessage."Das von Ihnen eingebene Passwort ist nicht identisch!<BR>";
	}


	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	$ux = strGetParam($objDBCon, "ux");

	$id = base64_decode($ux);
	$id = strrev($id);


	// 3.) Eingabe korrekt?
	if ($strMessage == "")
	{
		// Daten aktualisieren:
		// Passwort kodieren (Reihenfolge wird umgekehrt und BASE64 - kodiert):
		$px = strrev($px);
		$px = base64_encode($px);

		// Kein mysqli_real_escape_string, da dieser das Passwort verfälscht und in der Folge 
		// zu Problemen bei der Session führt.
		// $px = mysqli_real_escape_string($objDBCon, $px);
		$now = date("Y-m-d H:i");

		$strSQL = "UPDATE skk_members SET PWD='$px', lastlogin='$now', ip='".$_SERVER['REMOTE_ADDR']."' ";
		$strSQL = $strSQL."WHERE id=".$id." AND active!='N' AND del='N' AND (pwd IS NULL OR pwd='start123' OR pwd='');";

		// Ausführen:
		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo "Database update error!<P>".chr(13).chr(10);
			echo $strSQL."<BR>".chr(13).chr(10);
			echo mysql_error($objDBCon)."<BR>".chr(13).chr(10);
			echo "Aufgrund des aufgetretenen Problems kann Ihnen kein Zugriff auf die Adminseite gew&auml;hrt werden!".chr(13).chr(10);

			include("../includes/forms/middler.php");
			include("forms/navigation_access_denied.php");
		}
		else
		{
			echo "Ihr Passwort wurde erfolgreich aktualisiert.<BR>".chr(13).chr(10);
			echo "Ihr aktueller Login f&uuml;r den Adminbereich ist nun <B>3 (drei) Stunden</B> lang g&uuml;ltig.<BR><BR>".chr(13).chr(10);

			$strSQL = "SELECT DATE_ADD('$now', INTERVAL 3 HOUR)";
			
			$rs = mysqli_query($objDBCon, $strSQL);
			$RecordCount = mysqli_num_rows($rs);

			// Wurden Datensätze gefunden?
			if ($RecordCount > 0)
			{
				$row = $rs->fetch_row();
				$tmpDate = $row[0];
				echo "<BR><BR>Ihr Login l&auml;uft damit ab um <B>".chr(13).chr(10);

				echo substr($tmpDate,8,2).".";
				echo substr($tmpDate,5,2).".";
				echo substr($tmpDate,0,4)." um ";
				echo substr($tmpDate,11,2).":";
				echo substr($tmpDate,14,2)." Uhr</B>.".chr(13).chr(10);
			}

			include("../includes/forms/middler.php");

			// Die Navigation schreiben:
			include("forms/navigation.php");
			writenavigation($objDBCon, $ux);
		}
	}
	else
	{
		// Problem ausgeben:
		echo "<B>".$strMessage."</B>".chr(13).chr(10);
		include("_admin_login_new_pwd.php");
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
	}
?>
<?php include("../includes/forms/footer.php")?>








