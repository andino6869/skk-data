<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Mannschaft bearbeiten - Check");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
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
	if (IsSessionValid($objDBCon, $ux, "H")==0)
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

	// #######################
	// Die Inhalte überprüfen:
	$errText="";

	// ######################
	// Mannschaft:
	$Mannschaft = strGetParam($objDBCon, "Mannschaft");
	
	if (trim($Mannschaft)=="")
	{
		$errText = $errText ."Das Feld 'Mannschaft' ist aktuell noch leer.";
	}
	$Mannschaft = mysqli_escape_string($objDBCon, $Mannschaft);


	// ######################
	// Liga:
	$Liga = strGetParam($objDBCon, "Liga");
	
	if (trim($Liga)=="")
	{
		$errText = $errText ."Das Feld 'Liga' ist aktuell noch leer.";
	}
	$Liga = mysqli_escape_string($objDBCon, $Liga);

	// ######################
	// Season:
	$Season = strGetParam($objDBCon, "Season");
	
	if (trim($Season)=="")
	{
	    $errText = $errText ."Das Feld 'Season' ist aktuell noch leer.";
	}
	$Season = mysqli_escape_string($objDBCon, $Season);
	
	// ######################
	// Stammspieler:
	$numberofplayers = strGetParam($objDBCon, "numberofplayers");
	
	if (trim($numberofplayers)=="")
	{
		$errText = $errText ."Das Feld 'Anzahl Stammspieler' ist aktuell noch leer.";
	}
	$numberofplayers = mysqli_escape_string($objDBCon, $numberofplayers);

	// ######################
	// Season:
	$Season = strGetParam($objDBCon, "Season");
	
	if (trim($Season)=="")
	{
		$errText = $errText ."Das Feld 'Season' ist aktuell noch leer.<BR>";
	}
	$Season = mysqli_escape_string($objDBCon, $Season);

	// ######################
	$curUser = strGetCurrentUser($objDBCon);

	// ######################
	$ID = strGetParam($objDBCon, "ID");
	
	// Die Spieler einsammeln:
	$bEmpty = "FALSE";

	// Neuer Plausicheck: Die Bretter zwischen einzelnen Spielern dürfen nicht leer sein!
	// Ein Spieler darf nicht zeitgleich an mehreren Brettern spielen!
	$arrID = array(17);

	for ($i=1;$i<17;$i++)
	{
		$arrID[$i]="";
	}
	
	for ($i=1;$i<17;$i++)
	{
		$ID_member = strGetParam($objDBCon, "P".$i);
		
		if (trim($ID_member)=="")
		{
			$bEmpty = "TRUE";
		}
		else
		{
			// Wurde vorher bereits eine leere Eingabe gemacht?
			if ($bEmpty == "TRUE")
			{
				$errText = $errText ."Sie haben bei der Eingabe einzelne Bretter unbesetzt gelassen!<BR>";
				break;
			}
		}

		// Wurde der aktuelle Spieler schon zugewiesen?
		for ($j=1; $j<17; $j++)
		{
			if (($arrID[$j]==$ID_member) && (trim($arrID[$j])!=""))
			{
				$errText = $errText ."Sie haben ein Mitglied mehrfach einzelnen Brettern zugeordnet!<BR>";
				break;
			}
		}

		// Array befüllen:
		$arrID[$i]=$ID_member;
	}

	
	// #########################
	// Die Überschrift ausgeben:
	$objectclassicon = "team.jpg";
	include("forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Mannschaft aktualisieren (TEAM - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##############
	// Gab es Fehler?
	if (trim($errText)!="")
	{
		include("_admin_eingabe_fehler.php");
	}
	else
	{
		// Die Änderungen durchf&uuml;hren:
		$now = date("Y-m-d H:i:s");

		// Der UPDATE:
		$strSQL = "UPDATE skk_teams SET modifieddate='$now', modifier='$curUser' WHERE id=$ID AND del='N' ";
		$strSQL = $strSQL."AND modifieddate IS NULL;";

		if (!mysqli_query ($objDBCon, $strSQL))
		{		
			$errText = "Die aktuelle Mannschaft konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:<BR><BR>".$strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
			include("_admin_eingabe_fehler.php");
		}
		else
		{
			// DER INSERT:
			$strSQL = "insert into skk_teams (id, team, league, numberofplayers, season, creator, createdate, del, ";
			$strSQL = $strSQL."P1, P2, P3, P4, P5, P6, P7, P8, P9, P10, P11, P12, P13, P14, P15, P16) VALUES ";
			$strSQL = $strSQL."($ID, '$Mannschaft','$Liga',$numberofplayers,'$Season','$curUser','$now','N', ";

			// Die Spieler einsammeln:

			for ($i=1;$i<17;$i++)
			{
				$ID_member = strGetParam($objDBCon, "P".$i);
				
				if (trim($ID_member)=="")
				{
					$ID_member = "0";

				}

				$strSQL = $strSQL.$ID_member;

				if ($i<16)
				{
					$strSQL = $strSQL.", ";
				}
				else
				{
					$strSQL = $strSQL.");";
				}
			}

			// ##############################
			if (!mysqli_query ($objDBCon, $strSQL))
			{
				$errText = "Die aktuelle Mannschaft konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:<BR><BR>".$strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
				include("_admin_eingabe_fehler.php");
			}
			else
			{
				echo "Die Mannschaft <b>$Mannschaft</b> wurde erfolgreich aktualisiert.<BR><BR>".chr(13).chr(10);				
				include("_admin_ok_link.php");
			}
		}
	}

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>