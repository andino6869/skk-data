<?php include("../includes/forms/header.php")?>
<?php
  writeheader("Admin - Gemeldeten Spieler im AFRO - Turnier bearbeiten - Check");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/date/date.php")?>
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

  	// 6.) Die Inhalte überprüfen:
  	$errText="";

  	// ####################################################################################
  	// 6.1.) Das Turnier:
  	$tournament = strGetParam($objDBCon, "tournament");
  	
	if (trim($tournament)=="")
  	{
    	$errText = $errText."Es fehlt ein Eintrag im Feld Turnier.<BR>";
  	}
  	$tournament=mysqli_escape_string($objDBCon, $tournament);


  	// ####################################################################################
  	// 6.2.) Der Name:
  	// Nachname:
  	$surname = strGetParam($objDBCon, "surname");

	if (trim($surname)=="")
	{
	    $errText = $errText."Es fehlt ein Eintrag im Feld Nachname.<BR>";
	}
	else
	{
	    if (strlen($surname) < 4)
	    {
	    $errText = $errText."Der eingegebene Nachname ist zu kurz.<BR>";
	    }
	}
	$surname = mysqli_escape_string($objDBCon, $surname);


  	// ######################
  	// 6.3.) Vorname:
	$firstname = strGetParam($objDBCon, "firstname");
	
	if (trim($firstname)=="")
  	{
    	$errText = $errText."Es fehlt ein Eintrag im Feld Vorname.<BR>";
  	}
  	else
  	{
    	if (strlen($firstname) < 3)
    	{
      		$errText = $errText."Der eingegebene Vorname ist zu kurz.<BR>";
    	}
  	}
  	$firstname=mysqli_escape_string($objDBCon, $firstname);

	// #############
  	// 9.) Geburtsdatum:
  	// Der Tag:
  	$birth_day = strGetParam($objDBCon, "birth_day");
  	
	// Der Monat:
  	$birth_month = strGetParam($objDBCon, "birth_month");

  	// Das Jahr:
  	$birth_year = strGetParam($objDBCon, "birth_year");

  	// Ein gültiges Datum?
  	$bCheckdate = checkdate($birth_month, $birth_day, $birth_year);

  	if ( !$bCheckdate )
  	{
    	$errText = $errText."Das eingegebene Geburtsdatum ist nicht korrekt.<BR>";
  	}

   	$birthdate = mysqli_escape_string($objDBCon, $birth_year.".".$birth_month.".".$birth_day);

  	// #############
  	// 10.) Weitere Daten:
  	// 10.1.) DWZ:
   	$DWZ = strGetParam($objDBCon, "DWZ");

  	// Kein Pflichtfeld!
  	if ((trim($DWZ)=="") || (trim($DWZ)=="-"))
  	{
    	$DWZ = "NULL";
  	}
  	else
  	{
    	$DWZ=mysqli_escape_string($objDBCon, $DWZ);
  	}

  	// #########
  	// 10.2.) ELO:
  	$ELO = strGetParam($objDBCon, "ELO");
  	
  	// Kein Pflichtfeld!
  	if ((trim($ELO)=="") || (trim($ELO)=="-"))
  	{
    	$ELO = "NULL";
  	}
  	else
  	{
    	$ELO = mysqli_escape_string($objDBCon, $ELO);
  	}

  	// #########
  	// 10.3.) Titel:
  	$title = strGetParam($objDBCon, "title");

  	// Kein Pflichtfeld!
 	if (trim($title)=="")
  	{
    	$title = "'-'";
  	}
  	else
  	{
    	$title="'".mysqli_escape_string($objDBCon, $title)."'";
  	}

  	// ####################################################################################
  	// 10.4.) Der Verein:
  	$organization = strGetParam($objDBCon, "organization");

  	if (trim($organization)=="")
  	{
    	$errText = $errText."Es fehlt ein Eintrag im Feld Verein.<BR>";
  	}
  	else
  	{
    	if (strlen($organization) < 4)
    	{
      	$errText = $errText."Die eingegebene Vereinsbezeichnung ist zu kurz.<BR>";
    	}
  	}

  	$organization = mysqli_escape_string($objDBCon, $organization);

  	// #############################
  	// 10.5.) Anmeldung bestätigt:
  	$verified = strGetParam($objDBCon, "verified");
  	
  	// ######################
  	// 11.) Passt die DWZ zum Turnier?
  	if ($DWZ > 1900 && $tournament=='B')
  	{
    	$errText = $errText."Ihre DWZ ist für die Teilnahme im B - Turnier zu hoch!<BR>";
  	}

  	// ######################
  	echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
  	echo "<TR><TD>".chr(13).chr(10);

  	// ######################
  	// 10.) Gab es Fehler?
  	if (trim($errText)!="")
  	{
    	// 10.1.) Die Position der Dateien kann anders lauten!
    	if (is_file("../pics/admin/critical.gif"))
    	{
     		 echo "<IMG SRC='../pics/admin/critical.gif' border=0>";
    	}
    	else
    	{
      	if (is_file("../../pics/admin/critical.gif"))
      	{
        	echo "<IMG SRC='../../pics/admin/critical.gif' border=0>";
      	}
      	else
      	{
       		echo "<IMG SRC='../../../pics/admin/critical.gif' border=0>";
      	}
    }
    echo "</TD><TD><b>Die Daten konnten leider aus folgenden Gr&uuml;nden nicht aktualisiert werden:</b><BR><BR>".chr(13).chr(10);
    echo "<BR><I>".$errText."</I>".chr(13).chr(10);
    echo "<BR><BR>".chr(13).chr(10);
    echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
    echo "<BR><BR>".chr(13).chr(10);
    echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
  }
  else
  {
    // #############################
    // 10.2.) Den UPDATE durchführen:
    $now = date("Y-m-d H:i:s");

    // ######################
    // Die fehlenden Infos holen:
    // Die ID:
    $ID = strGetParam($objDBCon, "ID");

    // Die IP - Adresse:
    $ip = strGetParam($objDBCon, "ip");

    // OS:
    $os = strGetParam($objDBCon, "os");
    
    // Das betroffene Jahr:
    $curyear = strGetParam($objDBCon, "curyear");
    
    // Den SQL - String zusammenbauen:
    $strSQL = "UPDATE skk_afro_players SET modifieddate='".$now."', modifier='".$curUser."' WHERE del='N' ";
    $strSQL = $strSQL."AND modifieddate IS NULL AND id=".$ID.";";

    // Daten schreiben:
    if (!mysqli_query ($objDBCon, $strSQL))
    {
      // Die Position der Dateien kann anders lauten!
      if (is_file("../pics/admin/critical.gif"))
      {
        echo "<IMG SRC='../pics/admin/critical.gif' border=0>".chr(13).chr(10);
      }
      else
      {
        if (is_file("../../pics/admin/critical.gif"))
        {
          echo "<IMG SRC='../../pics/admin/critical.gif' border=0>".chr(13).chr(10);
        }
        else
        {
          echo "<IMG SRC='../../../pics/admin/critical.gif' border=0>".chr(13).chr(10);
        }
      }
      echo "</TD><TD>UPDATE war NICHT erfolgreich!<BR>".chr(13).chr(10);
      echo mysql_error($objDBCon)."<BR>".chr(13).chr(10);
      echo "Statement: ".$strSQL."<BR>".chr(13).chr(10);
      echo "<B>Ihre Daten wurden NICHT gespeichert!</B>".chr(13).chr(10);
    }
    else
    {
      // ######################
      // UPDATE war erfolgreich!
      // 10.3.) Den INSERT zusammenbauen:
      $strSQL = "insert into skk_afro_players (id, surname, firstname, ";
      $strSQL = $strSQL."birthdate, dwz, elo, title, organization, curyear, tournament, createdate, creator, ip, os, verified) VALUES (";
      $strSQL = $strSQL."$ID, '$surname', '$firstname', ";
      $strSQL = $strSQL."'".$birthdate."', $DWZ, $ELO, $title, '$organization', $curyear, '$tournament', ";
      $strSQL = $strSQL."'$now', '$curUser', '$ip', '$os', ";
          
      if (strtolower(trim($verified))=="nein")
      {
      	$strSQL = $strSQL."'N'";
      }
      else 
      {
       	$strSQL = $strSQL."'J'";
      }
          
      $strSQL = $strSQL.");";

      // Daten schreiben:
      if (!mysqli_query ($objDBCon, $strSQL))
      {
        // Die Position der Dateien kann anders lauten!
        if (is_file("../pics/admin/critical.gif"))
        {
          echo "<IMG SRC='../pics/admin/critical.gif' border=0>".chr(13).chr(10);
        }
        else
        {
          if (is_file("../../pics/admin/critical.gif"))
          {
            echo "<IMG SRC='../../pics/admin/critical.gif' border=0>".chr(13).chr(10);
          }
          else
          {
            echo "<IMG SRC='../../../pics/admin/critical.gif' border=0>".chr(13).chr(10);
          }
        }
          echo "</TD><TD>INSERT war NICHT erfolgreich!<BR>".chr(13).chr(10);
        echo mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
        echo "Statement: ".$strSQL."<BR>".chr(13).chr(10);
        echo "<B>Ihre Daten wurden NICHT gespeichert!</B>".chr(13).chr(10);
      }
      else
      {
        // Die Position der Dateien kann anders lauten!
        if (is_file("../pics/admin/success.gif"))
        {
          echo "<IMG SRC='../pics/admin/success.gif' border=0>".chr(13).chr(10);
        }
        else
        {
          if (is_file("../../pics/admin/success.gif"))
          {
            echo "<IMG SRC='../../pics/admin/success.gif' border=0>".chr(13).chr(10);
          }
          else
          {
            echo "<IMG SRC='../../../pics/admin/success.gif' border=0>".chr(13).chr(10);
          }
        }
        echo "</TD><TD><B>Vorgang erfolgreich!</B><BR><BR>".chr(13).chr(10);
        echo "$firstname $surname wurde erfolgreich aktualisiert.<BR><BR>".chr(13).chr(10);
        include("_admin_ok_link.php");
      }
    }
  }

  echo "</TD></TR></TABLE>".chr(13).chr(10);

  include("../includes/forms/middler.php");

  // Die Navigation schreiben:
  include("forms/navigation.php");
  writenavigation($objDBCon, $ux, $dx);

  include("../includes/forms/footer.php");
?>