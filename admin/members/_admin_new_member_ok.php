<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neues Mitglied eintragen - Check");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/date/date.php")?>
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
	$errText = "";

	// ####################################################################################
	// 1.) Der Name:
	// Nachname:
	$Nachname = strGetParam($objDBCon, "Nachname");

	if (trim($Nachname)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Nachname.<BR>";
	}

	// ######################
	// Vorname:
	$Vorname = strGetParam($objDBCon, "Vorname");

	if (trim($Vorname)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Vorname.<BR>";
	}

	// #############
	// Geschlecht:
	$sex = strGetParam($objDBCon, "sex", "TRUE", "NULL");
	
	// Datei - Upload nur dann anbieten, wenn Vor- und Nachname eingegeben worden sind:
	if (trim($Vorname)!="" && trim($Nachname)!="")
	{
		$file = $_FILES["file"]["name"];

		$file = strGetParam($objDBCon, "file", "", "NULL");
		
		if ((trim($file)!="") && (trim($file)!="NULL"))
		{
			include("../../includes/files/upload.php");
		}
	}
	else
	{
		// Wurde eine Datei ausgewählt?
		$file = strGetParam($objDBCon, "file", "", "NULL");

		if (trim($file)=="")
		{
			$file="NULL";
		}
		else
		{
			$errText = $errText."Sie haben ein Bild ausgew&auml;hlt, das jedoch ohne Angabe des Vor- bzw. Nachnamens nicht hochgeladen werden kann.<BR>";
		}
	}
	

	// ###################################################################
	// 2.) Adressdaten:
	// Strasse:
	$Strasse = strGetParam($objDBCon, "Strasse", "TRUE", "NULL");

	// #####################
	// PLZ:
	$PLZ = strGetParam($objDBCon, "PLZ", "TRUE", "NULL");
	
	// #####################
	// Ort:
	$Ort = strGetParam($objDBCon, "Ort", "TRUE", "NULL");

	// ###################################################################
	// 3.) Verbindungsdaten:
	// Email:
	$Email = strGetParam($objDBCon, "Email", "TRUE", "NULL");

	// #############
	// Telefon:
	$Telefon = strGetParam($objDBCon, "Telefon", "TRUE", "NULL");

	// #############
	// Mobil:
	$Mobil = strGetParam($objDBCon, "Mobil", "TRUE", "NULL");
	
	// ###################################################################
	// 4.) Die Datumsfelder:
	// Eintrittsdatum:
	// Der Tag:
	$entry_day = strGetParam($objDBCon, "entry_day");
	
	// Der Monat:
	$entry_month = strGetParam($objDBCon, "entry_month");
	
	// Das Jahr:
	$entry_year = strGetParam($objDBCon, "entry_year");

	// ################################################
	// Soll das Eintrittsdatum überhaupt verwendet werden?
	if (($entry_month == "-") || ($entry_day == "-") ||  ($entry_year == "-"))
	{
		// Nein!
		$entrydate = "NULL";
	}
	else
	{
		$bCheckdate = checkdate($entry_month, $entry_day, $entry_year);

		if ( !$bCheckdate )
		{
			$errText = $errText."Das eingegebene Eintrittsdatum ist nicht korrekt.<BR>";
		}
		else
		{
			// Eintrittsdatum kann verwendet werden:
			$entrydate = "'".mysqli_escape_string($objDBCon, $entry_year."-".$entry_month."-".$entry_day)."'";
		}
	}

	// Geburtsdatum:
	// Der Tag:
	$birth_day = strGetParam($objDBCon, "birth_day");

	// Der Monat:
	$birth_month = strGetParam($objDBCon, "birth_month");
	
	// Das Jahr:
	$birth_year = strGetParam($objDBCon, "birth_year");
	
	// ################################################
	// Soll das Geburtsdatum überhaupt verwendet werden?
	if (($birth_year == "-") || ($birth_month == "-") ||  ($birth_day == "-"))
	{
		// Nein!
		$birthdate = "NULL";
	}
	else
	{
		$bCheckdate = checkdate($birth_month, $birth_day, $birth_year);

		if ( !$bCheckdate )
		{
			$errText = $errText."Das eingegebene Geburtsdatum ist nicht korrekt.<BR>";
		}
		else
		{
			// Eintrittsdatum kann verwendet werden:
			$birthdate = "'".mysqli_escape_string($objDBCon, $birth_year."-".$birth_month."-".$birth_day)."'";
		}
	}

	if (($entrydate < $birthdate) && ($entrydate != "NULL") && ($birthdate != "NULL"))
	{
		$errText = $errText."Das Eintrittsdatum ist &auml;lter als das Geburtsdatum.<BR>";
	}

	// ###################################################################
	// 5.) Weitere Daten:
	// Geburtsort:
	$Geburtsort = strGetParam($objDBCon, "Geburtsort", "TRUE", "NULL");
	
	// ####
	// DWZ:
	$DWZ = strGetParam($objDBCon, "DWZ", "TRUE", "NULL");
	
	// ####
	// ELO:
	$ELO = strGetParam($objDBCon, "ELO", "TRUE", "NULL");
	
	// ###########
	// Titel:
	$Titel = strGetParam($objDBCon, "Titel", "TRUE", "NULL");
	
	// #########
	// Merkmal:
	$Merkmal = strGetParam($objDBCon, "Merkmal", "TRUE", "NULL");
	
	// #########
	// Aktiv:
	$active = strGetParam($objDBCon, "active", "TRUE", "NULL");
	
	// #########
	// Passwort:
	// ##################
	// UPDATE 24.09.2020:
	// Die Dekodierung hat bisher gefehlt!
	if (isset($_GET["password"]))
	{
	    $password=$_GET["password"];
	}
	
	if (isset($_REQUEST["password"]))
	{
	    $password=$_REQUEST["password"];
	}
	
	if ($password <> "")
	{
	    $password = strrev($password);
	    $password = "'".base64_encode($password)."'";
	}
	else 
	{
	    $password = "NULL";
	}  
	// UPDATE Ende
	// ###########

	// ##############
	// CMS verwenden:
	$usecms = strGetParam($objDBCon, "usecms", "TRUE", "NULL");
	
	// #########
	// Info:
	$info = strGetParam($objDBCon, "info", "TRUE", "NULL");
	
	// #########
	// Emailnachricht bei Kommentar:
	$sendmailifnewcomment = strGetParam($objDBCon, "sendmailifnewcomment", "TRUE", "NULL");

	if (trim($sendmailifnewcomment)=="'J'")
	{
		if (trim($Email)=="NULL")
		{
			$errText = $errText."Sie müssen noch eine Emailadresse eingeben, wenn Sie das Feature der automatischen Benachrichtigung verwenden möchten.<BR>";
		}
	}

	// Gab es Fehler?
	if (trim($errText)!="")
	{
		echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
		echo "<b>Das neue Mitglied konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
		echo "<BR><I>".$errText."</I>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
	}
	else
	{
		// Wurde dieses Mitglied bereits gespeichert?
		$strSQL = "SELECT id FROM skk_members WHERE vorname='$Vorname' AND name='$Nachname' ";
		$strSQL = $strSQL."AND birthdate='$birthdate' AND ";
		$strSQL = $strSQL."del='N' AND modifieddate IS NULL;";

		if (bCheckRecordset($objDBCon, $strSQL)==1)
		{
			echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
			echo "<b>Das neue Mitglied konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
			echo "<BR><I>Das Mitglied ist bereits in der Datenbank gespeichert!</I>".chr(13).chr(10);
			echo "<BR><BR>".chr(13).chr(10);
			echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
			echo "<BR><BR>".chr(13).chr(10);
			echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
		}
		else
		{
		  	$now = date("Y-m-d H:i:s");

			// Achtung, optinale Felder m&uuml;ssen ohne Anf&uuml;hrungszeichen stehen!
			$strSQL = "insert into skk_members (name, vorname, dwz, elo, title, sex, mail, telephone, mobile, ";
			$strSQL = $strSQL."addrstreet, addrzipcode, addrcity, entrydate, birthdate, birthplace, info, pwd, ";
			$strSQL = $strSQL."active, membertype, picture, sendmailifnewcomment, usecms, creator, createdate, del) VALUES ";
			$strSQL = $strSQL."('$Nachname', '$Vorname', $DWZ, $ELO, $Titel, $sex, $Email, $Telefon, $Mobil, ";
			$strSQL = $strSQL."$Strasse, $PLZ, $Ort, $entrydate, $birthdate, $Geburtsort, $info, $password, ";
			$strSQL = $strSQL."$active, $Merkmal, $file, $sendmailifnewcomment, $usecms, '$curUser', '$now', 'N')";


			echo "<SPAN CLASS=he1>Neues Mitglied speichern (MEMBER - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

			if (!mysqli_query ($objDBCon, $strSQL))
			{
				echo "Neues Mitglied konnte nicht gespeichert werden!<BR>".chr(13).chr(10);
				echo mysqli_error($objDBCon).chr(13).chr(10);
				echo "<BR>Statement: ".$strSQL."<BR>".chr(13).chr(10);
			}
			else
			{
		  		echo "Vielen Dank f&uuml;r die neue Datenerfassung!<BR><BR>".chr(13).chr(10);
		  		echo "Das neue Mitglied <b>".$Vorname." ".$Nachname."</b> wurde erfolgreich gespeichert.<BR><BR>".chr(13).chr(10);
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









