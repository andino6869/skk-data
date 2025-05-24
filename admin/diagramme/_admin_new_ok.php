<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neues Schachdiagramm hinzuf&uuml;gen - Check");
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
	$errText = "";

	// ####################################################################################
	// 1.) Titel des Schachdiagramms:
	$diagramm_title = strGetParam($objDBCon, "diagramm_title");
	
	$diagramm_title=mysqli_escape_string($objDBCon, $diagramm_title);
	
	if (trim($diagramm_title)=="")
	{
		$errText = $errText."Es wurde kein Diagramm - Titel mit angegeben!<BR>";
	}
	
	// ###################################################################
	// #######################################
	// 2.) Die Datei:
	// UPDATE 30.04.2014: Array muss nun direkt auf den Namen verweisen, da ansonsten 
	// die Upload - Zeichenkette leer ist.
	$diagramm_file = $_FILES["diagramm_file"]["name"];

	if (trim($diagramm_file)=="")
	{
		$diagramm_file = strGetParam($objDBCon, "diagramm_file");
	}

	// UPDATE: Trim allein reicht nicht aus!
	if (strlen(trim($diagramm_file)) <> 0)
	{
		// ###########################################
		// Dateinamen müssen eindeutig sein, da ansonsten bestehende Dateien
		// neu hochgeladene Dateien verdrängen:
		// Daher kein Include an dieser Stelle, da Sonderlösung gefahren wird:
		// Variabeln festlegen
		$max_byte_size = 1024000; //1024 KB!
		$allowed_file_types = "(jpg|jpeg|gif|png)";
		
		// Wurde wirklich eine Datei hochgeladen?
		if(is_uploaded_file($_FILES["diagramm_file"]["tmp_name"]))
		{
			// echo "Datei wurde erfolgreich hochgeladen!<BR>";
		
			// Gültige Endung? ($ = Am Ende des Dateinamens) (/i = Groß- Kleinschreibung nicht berücksichtigen)
			if(preg_match("/\." . $allowed_file_types . "$/i", $_FILES["diagramm_file"]["name"]))
			{
				//echo "Dateiendung entspricht den Vorgaben!<BR>";
		
				// Ist die Datei auch nicht zu groß
				if($_FILES["diagramm_file"]["size"] <= $max_byte_size)
				{
					// ###############################################
					// echo "Dateigröße entspricht den Vorgaben!<BR>";
					// $uploaddir = getcwd();
					// Neues Ablageverzeichnis, dass ohne Sicherheitszertifikat zugänglich ist:
					$uploaddir = "../../pics/diagramme/";
		
					// ####################################################
					// Den Dateinamen eindeutig gestalten mit ID und Datum:
					$strnow = date("Y-m-d H:i:s");
					$strnow = str_replace("-", "", $strnow);
					$strnow = str_replace(":", "", $strnow);
					$strnow = str_replace(" ", "", $strnow);
					$uploadfile = $uploaddir.$strnow."_".$_FILES["diagramm_file"]["name"];
					$diagramm_file = $strnow."_".$_FILES["diagramm_file"]["name"];
					
					//echo "Zieldatei ist: ".$uploadfile."<BR>";
		
		
					// Alles OK -> Datei kopieren
					if(move_uploaded_file($_FILES["diagramm_file"]["tmp_name"], $uploadfile))
					{
						// Datei erfolgreich hochgeladen!
						//echo "Dateiname $uploadfile erfolgreich hochgeladen!<BR>";
						//$diagramm_file = "'".$uploadfile."'";
		
						chmod($uploadfile, 0644);
					}
					else
					{
						$errText = $errText."Die gewählte Bilddatei konnte nicht hochgeladen werden.<BR>";
					}
				}
				else
				{
					$errText = $errText."Die Datei darf nur eine Gr&ouml;&szlig;e von " . $max_byte_size . " Byte besitzen.<BR>";
				}
		
			}
			else
			{
				$errText = $errText."Die Datei besitzt eine ungü&uuml;ltige Endung.<BR>";
			}
		}
		else
		{
			// Es wurde keine Datei mit angegeben!
			$errText = $errText."Es wurde keine Diagramm - Datei mit angegeben!<BR>";
		}	
	}
	else
	{
		$errText = $errText."Es wurde keine Diagramm - Datei mit angegeben!<BR>";
	}

	// ####################################################################################
	// 4.) Höhe:
	$diagramm_height = strGetParam($objDBCon, "diagramm_height", "", "NULL");

	// Nur Zahlen zulassen!
	if (is_numeric($diagramm_height)==0)
	{
		$diagramm_height = "NULL";
	}	
	
	// ####################################################################################
	// 5.) Breite:
	$diagramm_width = strGetParam($objDBCon, "diagramm_width", "", "NULL");
	
	// Nur Zahlen zulassen!
	if (is_numeric($diagramm_width)==0)
	{
		$diagramm_width = "NULL";
	}

	// ##################################
	// Daten speichern:
	$objectclassicon = "schachbrett.png";
	include("../forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Neues Schachdiagramm speichern (DIAGRAMM - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ###################################################################
	// Gab es Fehler?
	if (trim($errText)!="")
	{
		include("../_admin_eingabe_fehler.php");
	}
	else
	{
		// Wurde dieses Diagramm bereits gespeichert?
		// File hat bereits die Anf&uuml;hrungszeichen!
		// Achtung, es wird hier bewusst nur auf den Dateinamen abgestellt!!!!
		$strSQL = "SELECT id FROM skk_diagramme WHERE diagramm_file='$diagramm_file'";
		$strSQL = $strSQL." AND del='N' AND modifieddate IS NULL;";

		if (bCheckRecordset($objDBCon, $strSQL)==1)
		{
			$errText = "Das aktuelle Diagramm wurde bereits in der Datenbank gespeichert!";
			include("../_admin_eingabe_fehler.php");
		}
		else
		{
		  	$now = date("Y-m-d H:i:s");

			$strSQL = "insert into skk_diagramme (diagramm_title, diagramm_file, diagramm_width, diagramm_height, creator, createdate, del) VALUES ";
			$strSQL = $strSQL."('$diagramm_title', '$diagramm_file', $diagramm_width, $diagramm_height, '$curUser', '$now', 'N')";

			if (!mysqli_query ($objDBCon, $strSQL))
			{
				$errText = $strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
		  		include("../_admin_eingabe_fehler.php");
			}
			else
			{
				// ##########################################
				// UPDATE: Neues Objekt in Schreibtischliste:
				$strCurrentTable = "skk_diagramme";
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
			  		echo "Das Diagramm <b>../pics/diagramme/".$diagramm_file."</b> steht unter dem Titel '".$diagramm_title."' nun zur Verf&uuml;gung.<BR><BR>".chr(13).chr(10);					
					include("../_admin_ok_link.php");
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