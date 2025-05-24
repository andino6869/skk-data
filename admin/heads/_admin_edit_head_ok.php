<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Vorstandsdaten bearbeiten - Check");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../_admin_param.php")?>
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
	
	// Die Inhalte überprüfen:
	$errText="";

	// ####################################################################################
	// 1.) 1. Vorstand:
	$firsthead = strGetParam($objDBCon, "firsthead");

	if (trim($firsthead)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld 1. Vorstand.<BR>";
	}
	$firsthead = mysqli_escape_string($objDBCon, $firsthead);

	// ######################
	// 2. Vorstand:
	$secondhead = strGetParam($objDBCon, "secondhead");

	if (trim($secondhead)=="")
	{
		$secondhead = "NULL";
	}
	else
	{
		$secondhead="'".mysqli_escape_string($objDBCon, $secondhead)."'";
	}

	// #############
	// Kassierer:
	$cashier = strGetParam($objDBCon, "cashier");

	if (trim($cashier)=="")
	{
		$cashier = "NULL";
	}
	else
	{
		$cashier="'".mysqli_escape_string($objDBCon, $cashier)."'";
	}

	// #############
	// Spielleiter:
	$gameleader = strGetParam($objDBCon, "gameleader");

	if (trim($gameleader)=="")
	{
		$gameleader = "NULL";
	}
	else
	{
		$gameleader="'".mysqli_escape_string($objDBCon, $gameleader)."'";
	}

	// #############
	// Materialwart:
	$stuffhead = strGetParam($objDBCon, "stuffhead");

	if (trim($stuffhead)=="")
	{
		$stuffhead = "NULL";
	}
	else
	{
		$stuffhead="'".mysqli_escape_string($objDBCon, $stuffhead)."'";
	}

	// #############
	// Schriftführer:
	$writehead = strGetParam($objDBCon, "writehead");
	
	if (trim($writehead)=="")
	{
		$writehead = "NULL";
	}
	else
	{
		$writehead="'".mysqli_escape_string($objDBCon, $writehead)."'";
	}

	// #############
	// Jugendleiter:
	$youthhead = strGetParam($objDBCon, "youthhead");

	if (trim($youthhead)=="")
	{
		$youthhead = "NULL";
	}
	else
	{
		$youthhead="'".mysqli_escape_string($objDBCon, $youthhead)."'";
	}

	// #############
	// Das Jahr:
	$year = strGetParam($objDBCon, "year");
	$year="'".mysqli_escape_string($objDBCon, $year)."'";

	// ######################
	$ID = strGetParam($objDBCon, "ID");

	// 2.) Gab es Fehler?
	if (trim($errText)!="")
	{
		echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
		echo "<b>Die Vorstandsdaten konnten leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
		echo "<BR><I>".$errText."</I>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
	}
	else
	{
		// Die Änderungen durchf&uuml;hren:
		$now = date("Y-m-d H:i:s");

		// Der UPDATE:
		$strSQL = "UPDATE skk_heads SET modifieddate='$now', modifier='$curUser' WHERE id=$ID AND del='N' ";
		$strSQL = $strSQL."AND modifieddate IS NULL;";

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
			echo "<b>Die Vorstandsdaten konnten leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
			echo $strSQL."<BR>".chr(13).chr(10);
			echo mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
		}
		else
		{
			// Achtung, optionale Felder m&uuml;ssen ohne Anf&uuml;hrungszeichen stehen!
			$strSQL = "insert into skk_heads (id, year, firsthead, secondhead, cashier, gameleader, stuffhead, ";
			$strSQL = $strSQL."writehead, youthhead, creator, createdate, del) VALUES ";
			$strSQL = $strSQL."($ID, $year, '$firsthead', $secondhead, $cashier, $gameleader, $stuffhead, ";
			$strSQL = $strSQL."$writehead, $youthhead, '$curUser', '$now', 'N')";

			echo "<SPAN CLASS=he1>Vorstandsdaten speichern (HEADS - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

			if (!mysqli_query ($objDBCon, $strSQL))
			{
				echo " Vorstandsdaten konnten nicht gespeichert werden!<BR>".chr(13).chr(10);
				echo mysqli_error($objDBCon).chr(13).chr(10);
				echo "<BR>Statement: " . $strSQL . "<BR>".chr(13).chr(10);
			}
			else
			{
		  		echo "Vielen Dank f&uuml;r die Datenerfassung!<BR>".chr(13).chr(10);
		  		echo "Die Vorstandsdaten wurden erfolgreich aktualisiert.<BR><BR>".chr(13).chr(10);
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