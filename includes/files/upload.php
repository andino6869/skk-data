<?php
	// Variabeln festlegen:
	// UPDATE 29.04.2014: Es war expliziter Wunsch der Vorstandschaft, die Upload-Größe 
	// insbesondere für Bildergalerien zu erhöhen.
	// $max_byte_size = 256000; //250 KB!
	// Neuer Wert: 1MB
	$max_byte_size = 1024000;
	$allowed_file_types = "(jpg|jpeg|gif|png|xlsx|docx|rtf|tif|pdf|pgn|zip)";

	if ($_FILES["file"]["error"] != UPLOAD_ERR_OK)
	{
		switch ($_FILES["file"]["error"]) 
		{
			case UPLOAD_ERR_INI_SIZE:
				$errText = $errText."Die hochgeladene Datei &uuml;bersteigt die zul&auml;ssige Dateigröße aus der php.ini.<BR>";
				break;
			case UPLOAD_ERR_FORM_SIZE:
				$errText = $errText."Die hochgeladene Datei übersteigt die im Formular hinterlegte zul&auml;ssige Dateigröße.<BR>";
				break;
			case UPLOAD_ERR_PARTIAL:
				$errText = $errText."Die Datei wurde nur teilweise hochgeladen.<BR>";
				break;
			case UPLOAD_ERR_NO_FILE:
				$errText = $errText."Die Datei wurde nicht hochgeladen.<BR>";
				break;
			case UPLOAD_ERR_NO_TMP_DIR:
				$errText = $errText."Das temporäre Verzeichnis für den Updload konnte nicht gefunden werden.<BR>";
				break;
			case UPLOAD_ERR_CANT_WRITE:
				$errText = $errText."Die hochgeladene Datei konnte nicht auf die Festplatte geschrieben werden.<BR>";
				break;
			case UPLOAD_ERR_EXTENSION:
				$errText = $errText."Der Dateiupload wurde von der Erweiterung gestoppt.<BR>";
				break;
		
			default:
				$errText = $errText."Unbekannter Uploadfehler.<BR>";
				break;
		}

		$file = "NULL";
	}
	else 
	{	
		// Wurde wirklich eine Datei hochgeladen?
		if (is_uploaded_file($_FILES["file"]["tmp_name"]))
		{			
			// Gültige Endung? ($ = Am Ende des Dateinamens) (/i = Groß- Kleinschreibung nicht berücksichtigen)
			if(preg_match("/\." . $allowed_file_types . "$/i", $_FILES["file"]["name"]))
			{
				//echo "Dateiendung entspricht den Vorgaben!<BR>";
				// Ist die Datei auch nicht zu groß
				if($_FILES["file"]["size"] <= $max_byte_size)
				{
					//echo "Dateigröße entspricht den Vorgaben!<BR>";
					$uploaddir = getcwd();
						
					// ###############################################################
					// In Abhängigkeit des aktuellen Skripts den Ablageort definieren:
					$strCurrentCaller = strtolower($_SERVER['PHP_SELF']);
					
					$pos = strpos($strCurrentCaller, "download");
					
					if (!($pos === false))
					{						
						// Wir brauchen das Downloadverzeichnis:
						$uploaddir = "../../downloads/";
					}
					else
					{
						// Wir brauchen das Bilderverzeichnis:
						$uploaddir = $uploaddir."/pics/";
					}
					
					// #########################################
					// Die Sonderzeichen im Dateinamen ersetzen:
					$uploadfile = $_FILES["file"]["name"];
					$strNewFileName = "";

					for ($i = 0; $i < strlen($uploadfile); $i++)
					{
						$strChr = utf8_decode(substr($uploadfile, $i, 1));
						
						switch ($strChr)
						{
							case "ä":
								$strNewFileName = $strNewFileName."ae";
								break;
							case "Ä":
								$strNewFileName = $strNewFileName."Ae";
								break;
							case "ö":
								$strNewFileName = $strNewFileName."oe";
								break;
							case "Ö":
								$strNewFileName = $strNewFileName."Oe";
								break;
							case "ü":
								$strNewFileName = $strNewFileName."ue";
								break;
							case "Ü":
								$strNewFileName = $strNewFileName."Ue";
								break;
							case "ß":
								$strNewFileName = $strNewFileName."ss";
								break;
							case "?":
								$strNewFileName = $strNewFileName."_";
								break;
							default:
								$strNewFileName = $strNewFileName.substr($uploadfile, $i, 1);
						}
					}

					$uploadfile = $strNewFileName;

					// ###########################
					// Alles OK -> Datei kopieren:
					//echo "Verschiebe ".$_FILES["file"]["tmp_name"]." nach ".$uploaddir.$uploadfile;
					
					if(move_uploaded_file($_FILES["file"]["tmp_name"], $uploaddir.$uploadfile))
					{
						// Datei erfolgreich hochgeladen!
						//echo "Dateiname $uploadfile erfolgreich hochgeladen!<BR>";
						$file = $uploadfile;
	
						chmod($uploaddir.$uploadfile, 0777);
					}
					else
					{
						$errText = $errText."Die gew&auml;hlte Datei konnte nicht hochgeladen werden.<BR>";
					}
				}
				else
				{
					$errText = $errText."Die Datei darf nur eine Gr&ouml;&szlig;e von " . $max_byte_size . " Byte besitzen.<BR>";
				}
	
			}
			else
			{
				$errText = $errText."Die Datei besitzt eine ung&uuml;ltige Endung.<BR>";
			}
		}
		else
		{
			// Es wurde keine Datei mit angegeben!
			$file = "NULL";
		}
	}
?>
