<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neue Fotogalerie erstellen - Check");
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
	include("../_admin_param_dx.php");

	// Die Inhalte überprüfen:
	$errText="";

	// ####################################################################################
	// 6.) Galerie:
	$galery = strGetParam($objDBCon, "galery");

	if (trim($galery)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Name der Fotogalerie.<BR>";
	}
	$galery = mysqli_escape_string($objDBCon, $galery);

	// ######################
	// 7.) Kategorie:
	$category = strGetParam($objDBCon, "category");
	
	if (trim($category)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Kategorie.<BR>";
	}
	$category = mysqli_escape_string($objDBCon, $category);


	// ######################
	// 8.) Das Datum:
	// Der Tag:
	$galerydate_day = strGetParam($objDBCon, "galerydate_day");
	
	// Der Monat:
	$galerydate_month = strGetParam($objDBCon, "galerydate_month");
	
	// Das Jahr:
	$galerydate_year = strGetParam($objDBCon, "galerydate_year");
	
	// Ein gültiges Datum?
	$bCheckdate = checkdate($galerydate_month, $galerydate_day, $galerydate_year);

	if ( !$bCheckdate )
	{
		$errText = $errText."Das eingegebene Datum ist nicht korrekt.<BR>";
	}

 	$galerydate = mysqli_escape_string($objDBCon, $galerydate_year."-".$galerydate_month."-".$galerydate_day);

 	// #########################
 	// Die Überschrift ausgeben:
 	$objectclassicon = "galery.gif";
 	include("../forms/objectclassicon.php");
 	echo "<SPAN CLASS=he1>Neue Fotogalerie speichern (GALERY - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);
 	
 	// ##################
	// 9.) Gab es Fehler?
	if (trim($errText)!="")
	{
		include("../_admin_eingabe_fehler.php");
	}
	else
	{
		// Wurden diese Daten bereits gespeichert?
		$strSQL = "SELECT id FROM skk_galery WHERE galery='".$galery."' ";
		$strSQL = $strSQL." AND del='N' AND modifieddate IS NULL;";

		if (bCheckRecordset($objDBCon, $strSQL)==1)
		{
			$errText = "Die aktuelle Fotogalerie wurde bereits in der Datenbank gespeichert!";
			include("../_admin_eingabe_fehler.php");
		}
		else
		{
		  	$now = date("Y-m-d H:i:s");

			// Achtung, optionale Felder m&uuml;ssen ohne Anf&uuml;hrungszeichen stehen!
			$strSQL = "insert into skk_galery (galery, galerydate, category, creator, createdate, del) VALUES ";
			$strSQL = $strSQL."('".$galery."', '".$galerydate."', '".$category."', '".$curUser."', '".$now."', 'N')";

			if (!mysqli_query ($objDBCon, $strSQL))
			{
				$errText = $strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
				include("../_admin_eingabe_fehler.php");
			}
			else
			{
				// ##########################################
				// UPDATE: Neues Objekt in Schreibtischliste:
				$strCurrentTable = "skk_galery";
				include("../_admin_userdesk_contents.php");
				// UPDATE ENDE
				// ###########
				
				if (!mysqli_query ($objDBCon, $strSQL))
				{
					$errText = $strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
					include("../_admin_eingabe_fehler.php");
				}
				else
				{
					echo "Die neuen Fotogalerie wurden erfolgreich gespeichert und kann nun mit den Bildern bef&uuml;llt werden.<BR>".chr(13).chr(10);
	
					// Die neue ID ermitteln:
					$strSQL = "select * from skk_galery WHERE del='N' AND modifieddate IS NULL AND createdate='".$now."' ";
					$strSQL = $strSQL."AND creator='".$curUser."' ORDER BY galery DESC";
	
					$rs = mysqli_query($objDBCon, $strSQL);
					$RecordCount = mysqli_num_rows($rs);
	
					// Konnten Einträge gefunden werden?
					if ($RecordCount > 0)
					{
						$i = 0;
			
						while ($row = $rs->fetch_object())
						{
						  	$ID[$i] = $row->id;
						  	$i++;
						}
						echo "<p><a href='_admin_edit_galery.php?Nr=".$ID[0]."&ux=".$ux."&dx=".$dx."'><IMG SRC='../../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Um nun Bilder einzustellen, folgen Sie bitte diesem Link.</a></p>";
					}
				}
			}
		}
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>









