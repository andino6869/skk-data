<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Mitglied bearbeiten - Check");
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
	// Die ID für den Datenabgleich holen:
	$ID = strGetParam($objDBCon, "ID");

	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "A")==0)
	{
		// Prüfen, ob sich der Benutzer gerade selbst ändert.
		$curNr = base64_decode($ux);
		$curNr = strrev($curNr);

		if ($ID != $curNr)
		{
			// Keine Gültigkeit mehr!
			include("../../includes/forms/middler.php");
			include("../forms/navigation_access_denied.php");
			include("../../includes/forms/footer.php");

			exit;
		}
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("../_admin_param_dx.php");

	// Die Inhalte überprüfen:
	$errText="";

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

	// ################################################################################
	// Datei - Upload nur dann anbieten, wenn Vor- und Nachname eingegeben worden sind:
	if (trim($Vorname)!="" && trim($Nachname)!="")
	{
		$file = $_FILES["file"]["name"];
		
		if (strlen(trim($file)) <> 0) 
		{
			include("../../includes/files/upload.php");
			$file = "'".$file."'";
		}
		else 
		{
			$file = "null";
		}

		// Soll das bisherige Bild gelöscht werden?
		$delpicture = strGetParam($objDBCon, "delpicture");

		// Ist der Löschschalter nicht gesetzt und wird kein neues Bild hinterlegt?
		if (strtolower($delpicture)!="on" && (strtolower($file)=="null" || trim($file)==""))
		{
			// Der Schalter für das Löschen wurde nicht gesetzt!
			// Gibt es ein altes Bild?
			$oldpicture = strGetParam($objDBCon, "oldpicture");
			
			// Gibt es ein Bild, das gesichert werden muss?
			if (trim($oldpicture)!="")
			{
				$file = "'".$oldpicture."'";
			}
		}
		else
		{
			// Gibt es ein altes Bild?
			$oldpicture = strGetParam($objDBCon, "oldpicture");
			
			if (strtolower($delpicture)=="on")
			{
				// Der Schalter für das Löschen wurde gesetzt!
				// Gibt es ein Bild, das gelöscht werden kann?
				if (is_file("pics/".$oldpicture))
				{
					unlink("pics/".$oldpicture);
				}
			}
			else
			{
				// Gibt es ein Bild, das gesichert werden muss?
				if (trim($oldpicture)!="")
				{
					$file = "'".$oldpicture."'";
				}
			}
		}
	}
	else
	{
		// Wurde eine Datei ausgewählt?
		$file = strGetParam($objDBCon, "file", "", "NULL");

		if (trim($file)=="")
		{
			$file = "NULL";
		}
		else
		{
			$errText = $errText."Sie haben ein Bild ausgewählt, das jedoch ohne Angabe des Vor- bzw. Nachnamens nicht hochgeladen werden kann.<BR>";
		}
	}

	if (strlen(trim($file)) == 0)
	{
		$file = "NULL";
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
	// IP:
	$ip = strGetParam($objDBCon, "ip", "TRUE", "NULL");

	// #########
	// Lastlogin:
	$lastlogin = strGetParam($objDBCon, "lastlogin", "TRUE", "NULL");
	
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

	// ######################
	// Gab es Fehler?
	if (trim($errText)!="")
	{
		echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
		echo "<b>Das aktuelle Mitglied konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
		echo "<I>".$errText."</I>".chr(13).chr(10);
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
		$strSQL = "UPDATE skk_members SET modifieddate='$now', modifier='$curUser' WHERE id=$ID AND del='N' ";
		$strSQL = $strSQL."AND modifieddate IS NULL;";

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
			echo "<b>Das aktuelle Mitglied konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
			echo $strSQL."<BR>".chr(13).chr(10);
			echo mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
		}

		// DER INSERT:
	  	$now = date("Y-m-d H:i:s");

		// Achtung, optionale Felder müssen ohne Anführungszeichen stehen!
		$strSQL = "insert into skk_members (id, name, vorname, dwz, elo, title, sex, mail, telephone, mobile, ";
		$strSQL = $strSQL."addrstreet, addrzipcode, addrcity, entrydate, birthdate, birthplace, info, pwd, ";
		$strSQL = $strSQL."active, membertype, picture, sendmailifnewcomment, usecms, creator, createdate, del, ip, lastlogin) VALUES ";
		$strSQL = $strSQL."($ID, '$Nachname', '$Vorname', $DWZ, $ELO, $Titel, $sex, $Email, $Telefon, $Mobil, ";
		$strSQL = $strSQL."$Strasse, $PLZ, $Ort, $entrydate, $birthdate, $Geburtsort, $info, $password, ";
		$strSQL = $strSQL."$active, $Merkmal, $file, $sendmailifnewcomment, $usecms, '$curUser', '$now', 'N', $ip, $lastlogin)";


		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
			echo "<b>Das aktuelle Mitglied konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
			echo $strSQL."<BR>".chr(13).chr(10);
			echo mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
		}
		else
		{
			echo "<SPAN CLASS=he1>Mitglied bearbeiten (MEMBER - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);
			echo "Vielen Dank!<BR><BR>".chr(13).chr(10);
			echo "Das Mitglied <b>$Vorname $Nachname</b> wurde erfolgreich ge&auml;ndert und ist wieder online.<BR><BR>".chr(13).chr(10);
			include("../_admin_ok_link.php");
		}
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>