<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Kommentar bearbeiten - Check");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/date/date.php")?>
<?php include("../_admin_param.php")?>
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

	// ##############################################
	// 6.) Den bisherigen Kommentar ermitteln:
	$ID = strGetParam($objDBCon, "ID");
	$os = strGetParam($objDBCon, "os");
	$ip = strGetParam($objDBCon, "ip");
	$nr = strGetParam($objDBCon, "nr");
	
	// ######################
	$now = date("Y-m-d H:i:s");

	// Die Inhalte überprüfen:
	$errText="";

	// ####################################################################################
	// 1.) Melder:
	$nameanswer = strGetParam($objDBCon, "nameanswer");

	if (trim($nameanswer)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Name des Melder.<BR>";
	}
	$nameanswer = mysqli_escape_string($objDBCon, $nameanswer);

	// ####################################################################################
	// 2.) Meldung:
	$answer = strGetParam($objDBCon, "answer");

	if (trim($answer)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Kommentar.<BR>";
	}
	$answer = mysqli_escape_string($objDBCon, $answer);
	$answer = strReplaceRNInMemoField($answer);


	// ###################################################################
	// Gab es Fehler?
	if (trim($errText)!="")
	{
		echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
		echo "<b>Der Kommentar konnte leider aus folgenden Gr&uuml;nden nicht aktualisiert werden:</b><BR><BR>".chr(13).chr(10);
		echo "<BR><I>".$errText."</I>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
	}
	else
	{
		echo "<SPAN CLASS=he1>Kommentar aktualisieren (COMMENTS - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);
		$now = date("Y-m-d H:i:s");

		// Der UPDATE:
		$strSQL = "UPDATE skk_comments SET modifier='$curUser', modifieddate='$now' WHERE ID=$ID";

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo "Der Kommentar konnte nicht aktualisiert werden!<BR>".chr(13).chr(10);
			echo mysqli_error($objDBCon).chr(13).chr(10);
			echo "<BR>Statement: " . $strSQL . "<BR>".chr(13).chr(10);
		}
		else
		{
			$strSQL = "insert into skk_comments (id, nr, os, ip, nameanswer, answer, creator, createdate, del) VALUES ";
			$strSQL = $strSQL."($ID, $nr, '$os', '$ip', '$nameanswer', '$answer', '$curUser', '$now', 'N')";

			if (!mysqli_query ($objDBCon, $strSQL))
			{
				echo "Kommentar konnte nicht aktualisiert werden!<BR>".chr(13).chr(10);
				echo mysqli_error($objDBCon).chr(13).chr(10);
				echo "<BR>Statement: " . $strSQL . "<BR>".chr(13).chr(10);
			}
			else
			{
		  		echo "Vielen Dank f&uuml;r die Aktualisierung des Kommentars.<BR><BR>".chr(13).chr(10);
		  		include("../_admin_ok_link.php");
			}
		}
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>
