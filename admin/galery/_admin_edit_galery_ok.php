<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Galerie bearbeiten - Check");
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

	// ######################
	// 9.) Die aktuelle ID:
 	$Nr = strGetParam($objDBCon, "Nr");

	// ####################################################################################
	// 10.) Den Dateiupload durchführen, falls notwendig:
	// UPDATE 30.04.2014: Array muss nun direkt auf den Namen verweisen, da ansonsten 
	// die Upload - Zeichenkette leer ist.
	$file = $_FILES["file"]["name"];

	if (trim($file)=="")
	{
		$file = strGetParam($objDBCon, "file");
	}

	// UPDATE: Trim allein reicht nicht aus!
	if (strlen(trim($file)) <> 0)
	{
		// ###########################################
		// include("../../includes/files/upload.php");
		// Update 31.12.2011:
		// Dateinamen müssen eindeutig sein, da ansonsten bestehende Dateien
		// neu hochgeladene Dateien verdrängen:
		// Daher kein Include an dieser Stelle, da Sonderlösung gefahren wird:
		// Variabeln festlegen
		$max_byte_size = 1024000; //1024 KB!
		$allowed_file_types = "(jpg|jpeg|gif|png)";

		// Wurde wirklich eine Datei hochgeladen?
		if(is_uploaded_file($_FILES["file"]["tmp_name"]))
		{
			// echo "Datei wurde erfolgreich hochgeladen!<BR>";

			// Gültige Endung? ($ = Am Ende des Dateinamens) (/i = Groß- Kleinschreibung nicht berücksichtigen)
			if(preg_match("/\." . $allowed_file_types . "$/i", $_FILES["file"]["name"]))
			{
				//echo "Dateiendung entspricht den Vorgaben!<BR>";

				// Ist die Datei auch nicht zu groß
				if($_FILES["file"]["size"] <= $max_byte_size)
				{
					// ###############################################
					// echo "Dateigröße entspricht den Vorgaben!<BR>";
					// $uploaddir = getcwd();
					// Neues Ablageverzeichnis, dass ohne Sicherheitszertifikat zugänglich ist:
					$uploaddir = "../../pics/galery/";

					// ####################################################
					// Den Dateinamen eindeutig gestalten mit ID und Datum:
					$strnow = date("Y-m-d H:i:s");
					$strnow = str_replace("-", "", $strnow);
					$strnow = str_replace(":", "", $strnow);
					$strnow = str_replace(" ", "", $strnow);
					$uploadfile = $uploaddir.$Nr."_".$strnow."_".$_FILES["file"]["name"];

					//echo "Zieldatei ist: ".$uploadfile."<BR>";


					// Alles OK -> Datei kopieren
					if(move_uploaded_file($_FILES["file"]["tmp_name"], $uploadfile))
					{
						// Datei erfolgreich hochgeladen!
						//echo "Dateiname $uploadfile erfolgreich hochgeladen!<BR>";
						$file = "'".$uploadfile."'";

						chmod($uploadfile, 0644);
					}
					else
					{
						$errText = $errText."Die gew&auml;hlte Bilddatei konnte nicht hochgeladen werden.<BR>";
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
	
	
	// #######################################################################
	// 10.1.) Den Dateiupload für ein ZIP-Archiv durchführen, falls notwendig:
	// Die Datei ermitteln, falls hinterlegt:
	$filezip = $_FILES["filezip"]["name"];
	
	if (trim($filezip)=="")
	{
		$filezip = strGetParam($objDBCon, "filezip");
	}
	
	// Wurde eine Datei hinterlegt?
	if (strlen(trim($filezip)) <> 0)
	{
		$max_byte_size = 1048576000; // 10 MB!
		$allowed_file_types = "(zip)";
	
		// Wurde wirklich eine Datei hochgeladen?
		if(is_uploaded_file($_FILES["filezip"]["tmp_name"]))
		{
			// echo "Datei wurde erfolgreich hochgeladen!<BR>";
	
			// Gültige Endung? ($ = Am Ende des Dateinamens) (/i = Groß- Kleinschreibung nicht berücksichtigen)
			if(preg_match("/\." . $allowed_file_types . "$/i", $_FILES["filezip"]["name"]))
			{
				// echo "Dateiendung entspricht den Vorgaben!<BR>";
	
				// Ist die Datei auch nicht zu groß
				if($_FILES["filezip"]["size"] <= $max_byte_size)
				{
					// ###############################################
					// echo "Dateigröße entspricht den Vorgaben!<BR>";
					// $uploaddir = getcwd();
					// Neues Ablageverzeichnis, dass ohne Sicherheitszertifikat zugänglich ist:
					$uploaddir = "../../pics/galery/";
	
					// ####################################################
					// Den Dateinamen eindeutig gestalten mit ID und Datum:
					$strnow = date("Y-m-d H:i:s");
					$strnow = str_replace("-", "", $strnow);
					$strnow = str_replace(":", "", $strnow);
					$strnow = str_replace(" ", "", $strnow);
					$uploadfile = $uploaddir.$Nr."_".$strnow."_".$_FILES["filezip"]["name"];
	
					//echo "Zieldatei ist: ".$uploadfile."<BR>";
					// Alles OK -> Datei kopieren
					if(move_uploaded_file($_FILES["filezip"]["tmp_name"], $uploadfile))
					{
						// Datei erfolgreich hochgeladen!
						//echo "Dateiname $uploadfile erfolgreich hochgeladen!<BR>";
						$filezip = "'".$uploadfile."'";
	
						chmod($uploadfile, 0644);
						
						// ########################################
						// Alte Dateien im TMP-Verzeichnis löschen:
						$path = pathinfo(realpath($uploadfile), PATHINFO_DIRNAME);
						$path = $path."/TMP";
												
						$handle = opendir($path);
						if($handle)
						{
							while ( false !== ($curfile = readdir($handle)) )
							{
								if ( $curfile != "." and $curfile != ".." )
								{
									unlink($path."/".$curfile);
								}
							}
						}
						
						// ##################################################
						// Jetzt den Inhalt in das TMP-Verzeichnis entpacken:
						$zip = new ZipArchive;
						$res = $zip->open($uploadfile);
						
						if ($res === TRUE) 
						{
							$zip->extractTo($path);
							$zip->close();
							// echo "Glückwunsch! $file wurde erfolgreich nach $path exportiert.";
							
							// ################################################################
							// Alle Dateien eindeutig umbenennen, damit diese eindeutig werden:
							$handle = opendir($path);						
														
							while ($tmpfile = readdir ($handle)) 
							{							
								if ($tmpfile != '.' && $tmpfile != '..' && !is_dir($path."/".$tmpfile)) 
								{				
									// Alle Dateien ID und Datum benennen:							
									rename($path."/".$tmpfile, $path."/".$Nr."_".$strnow."_".$tmpfile);
																									
									// #####################################################
									// Datei in das Verzeichnis mit den Bildern verschieben:
									if (!copy($path."/".$Nr."_".$strnow."_".$tmpfile, $uploaddir.$Nr."_".$strnow."_".$tmpfile))
									{
										$errText = $errText.$strSQL."<BR>Datei ".$Nr."_".$strnow."_".$tmpfile." konnte nicht kopiert werden.";
									}
									else 
									{
										// ####################################
										// INSERT in die Datenbank durchführen:
										$now = date("Y-m-d H:i:s");
										$createtime = date("Y-m-d H:i:s", filemtime($uploaddir.$Nr."_".$strnow."_".$tmpfile));
										
										$strSQL = "INSERT INTO skk_galery_pics (id_galery, picture, filecreatedate, creator, createdate, del) VALUES ";
										$strSQL = $strSQL."(".$Nr.", '".$uploaddir.$Nr."_".$strnow."_".$tmpfile."', '".$createtime."', '".$curUser."', '".$now."', 'N')";
											
										if (!mysqli_query ($objDBCon, $strSQL))
										{
											$errText = $errText.$strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
										}
										
										unlink($path."/".$Nr."_".$strnow."_".$tmpfile);
									}	
								}
							}
							
							closedir($handle);

							// ###################
							// ZIP-Archiv löschen:
							unlink($uploadfile);
						} 
						else 
						{
							$errText = $errText."Die Datei $uploadfile konnte nicht gefunden/geöffnet werden.";
						}
					}
					else
					{
						$errText = $errText."Das gewählte Archiv konnte nicht hochgeladen werden.<BR>";
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
			$filezip="NULL";
		}
	}


	// ####################################################################################
	// 11.) Die Anzahl der Bilder ermitteln:
	$numberofpictures = strGetParam($objDBCon, "numberofpictures");
	
	// Sind bereits Bilder vorhanden?
	if ($numberofpictures > 0)
	{

		// Sollen Bilder gelöscht werden?
		for ($i=0;$i<$numberofpictures;$i++)
		{
			// Soll das bisherige Bild gelöscht werden?
			$del = strGetParam($objDBCon, "delpicture".$i);
			
			// Den Namen des bisherigen Bildes ermitteln:
			$oldpic = strGetParam($objDBCon, "oldpicture".$i);
			
			if (strtolower($del)=="on")
			{
				// Der Schalter für das Löschen wurde gesetzt!


				// Gibt es ein Bild, das gelöscht werden kann?
				if (is_file("../../pics/galery/".$oldpic))
				{
					unlink("../../pics/galery/".$oldpic);
				}

				// UPDATE in der Datenbank:
				$now = date("Y-m-d H:i:s");

				$strSQL = "UPDATE skk_galery_pics SET del='N', modifieddate='".$now."', modifier='".$curUser."' ";
				$strSQL = $strSQL." WHERE id_galery=".$Nr." AND picture='".$oldpic."' AND del='N' AND modifieddate IS NULL;";

				if (!mysqli_query ($objDBCon, $strSQL))
				{
					$errText = $errText.mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
				}
			}
			else
			{
				// Den Kommentar aktualisieren:
				// UPDATE:
				$now = date("Y-m-d H:i:s");

				$strSQL = "UPDATE skk_galery_pics SET modifieddate='".$now."', modifier='".$curUser."' WHERE ";
				$strSQL = $strSQL."id_galery=".$Nr." AND picture='".$oldpic."' AND del='N' AND modifieddate IS NULL;";

				if (!mysqli_query ($objDBCon, $strSQL))
				{
					$errText = $errText.mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
				}

				// Neuer INSERT:
				// Neuer Kommentar???
				$comment = strGetParam($objDBCon, "comment".$i);
				
				if (trim($comment)=="")
				{
					$comment = "NULL";
				}
				else
				{
					$comment = "'".mysqli_escape_string($objDBCon, $comment)."'";
				}

				if (trim($oldpic)!="" && trim($oldpic)!="NULL")
				{					
					// ###########################################################
					// Den Zeitstempel der Datei als Erstellungsdatum hinterlegen:
					if (file_exists($oldpic)) 
					{
						$createtime = date("Y-m-d H:i:s", filemtime($oldpic));
					}	
									
					$strSQL = "INSERT INTO skk_galery_pics (id_galery, picture, comment, filecreatedate, creator, createdate, del) VALUES ";
					$strSQL = $strSQL."(".$Nr.", '".$oldpic."', ".$comment.", '".$createtime."', '".$curUser."', '".$now."', 'N')";

					if (!mysqli_query ($objDBCon, $strSQL))
					{
						$errText = $errText.mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
					}
				}
			}
		}
	}

	// ####################################################################################
	// 9.) Das neue Bild speichern, falls notwendig:
	if ((trim($file)!="") && (trim($file)!="NULL"))
	{
		$newcomment = strGetParam($objDBCon, "newcomment", "TRUE", "NULL");
		
		$now = date("Y-m-d H:i:s");

		$strSQL = "INSERT INTO skk_galery_pics (id_galery, picture, comment, creator, createdate, del) VALUES ";
		$strSQL = $strSQL."(".$Nr.", ".$file.", ".$newcomment.", '".$curUser."', '".$now."', 'N')";

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			$errText = $errText.$strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
		}
	}
	
	// #########################
	// Die Überschrift ausgeben:
	$objectclassicon = "galery.gif";
	include("../forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Galerie bearbeiten (GALERY - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);
	
	
	// ####################################################################################
	// Gab es Fehler?
	if (trim($errText)!="")
	{
		include("../_admin_eingabe_fehler.php");
	}
	else
	{
		// ####################################################################################
		// 10.) Den Namen der Galerie aktualisieren:
		// UPDATE:
		$now = date("Y-m-d H:i:s");

		$strSQL = "UPDATE skk_galery SET modifieddate='".$now."', modifier='".$curUser."' WHERE ";
		$strSQL = $strSQL."id=".$Nr." AND del='N' AND modifieddate IS NULL;";

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			$errText = $strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
			include("../_admin_eingabe_fehler.php");
		}

		$strSQL = "INSERT INTO skk_galery (id, galery, galerydate, category, creator, createdate, del) VALUES ";
		$strSQL = $strSQL."(".$Nr.", '".$galery."', '".$galerydate."', '".$category."', '".$curUser."', '".$now."', 'N')";

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			$errText = $strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
			include("../_admin_eingabe_fehler.php");
		}
	}


	// ###################################################
	// 11.) Kann die Bearbeitung fortgesetzt werden?
	if (trim($errText)=="")
	{
		// #############################
		// 12.) Die Galerie holen:
		$strSQL = "select * from skk_galery WHERE id=".$Nr." AND del='N' AND modifieddate IS NULL;";

		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

		if ($RecordCount > 0)
		{
			$i = 0;
			
			while ($row = $rs->fetch_object())
			{
	         	$ID[$i] = $row->id;
	         	$fldgalery[$i] = $row->galery;
	         	$fldcategory[$i] = $row->category;
         		$fldgalerydate[$i] = $row->galerydate;
         		$i++;
			}
		}

		// #####################
	  	include("../forms/fields_not_null.php");

		// #####################
	  	echo "<FORM METHOD=POST ACTION='_admin_edit_galery_ok.php?ux=".$ux."&dx=".$dx."&Nr=".$Nr."' enctype='multipart/form-data'>".chr(13).chr(10);
	  	echo "<INPUT TYPE=HIDDEN NAME='Nr' Value='".$Nr."'>".chr(13).chr(10);

		// Die aktuellen Benutzerdaten sichern:
	  	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	  	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	  	echo "<table cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);


		// #########
		// Name:
		echo "<TR>".chr(13).chr(10);
		echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Name der Fotogalerie (max. 100 Zeichen): *</U></B>";

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Hier geben Sie den Namen der Fotogalerie ein.</I>";
		}
		echo "</TD></TR>".chr(13).chr(10);

		echo "<tr><td><INPUT TYPE=Text NAME=galery style='width:100%' VALUE='".$fldgalery[0]."' size=100 MAXLENGTH=100></td></tr>".chr(13).chr(10);

		// #######################
		// Kategorie:
		echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Kategorie:</U></B> *";

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>";
			echo "<I>Je nach gew&auml;hlter Kategorie wird diese Fotogalerie dann in der Liste mit einem anderen f&uuml;hrenden Icon dargestellt.</I>";
		}

		echo "</TD></TR>";

		echo "<TR><TD width='100%'>";
		echo "<SELECT NAME=category style='width:100%'>";

		if ($fldcategory[0]=="Erwachsene") { echo "<OPTION>Erwachsene<OPTION>Jugend<OPTION>AFRO<OPTION>Sport</SELECT></TD></TR>".chr(13).chr(10); }
		if ($fldcategory[0]=="Jugend"){ echo "<OPTION>Erwachsene<OPTION SELECTED>Jugend<OPTION>AFRO<OPTION>Sport</SELECT></TD></TR>".chr(13).chr(10); }
		if ($fldcategory[0]=="AFRO"){ echo "<OPTION>Erwachsene<OPTION>Jugend<OPTION SELECTED>AFRO<OPTION>Sport</SELECT></TD></TR>".chr(13).chr(10); }
		if ($fldcategory[0]=="Sport"){ echo "<OPTION>Erwachsene<OPTION>Jugend<OPTION>AFRO<OPTION SELECTED>Sport</SELECT></TD></TR>".chr(13).chr(10); }

		echo "</TABLE>".chr(13).chr(10);

		// Das Datum holen:
		echo "<TABLE width='100%' border=1>".chr(13).chr(10);
		echo "<TR><TD width='50%' bgcolor='#C0C0C0'><B><U>Datum der Fotogalerie: *</U></B>";

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Hier geben Sie das Datum der Meldung ein. Es wird Ihnen automatisch das Systemdatum vorgeschagen. ";
			echo "Das hier gew&auml;hlte Daum ist ma&szlig;geblich f&uuml;r die Zuordnung der Meldung in der Liste der News zu einem ";
			echo "bestimmten Monat und ein bestimmtes Jahr. Das Eingabeformat ist TT.MM.JJJJ.</I>";
		}
		echo "</TD>".chr(13).chr(10);
		echo "<TD width='50%'>".chr(13).chr(10);

		// Das aktuelle Datum vorsteuern:
		$curYear = substr($fldgalerydate[0],0,4);
		$curMonth = substr($fldgalerydate[0],5,2);
		$curDay = substr($fldgalerydate[0],8,2);

	 	writeDateField("galerydate_day", "galerydate_month", "galerydate_year", $curDay, $curMonth, $curYear, "FALSE");

	 	echo "</TD></TR></TABLE>".chr(13).chr(10);


	 	// Stelle für das neue Anlegen eines weiteren Bildes:
	 	echo "<table cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);
		echo "<p><a name='NEWPIC'></a></p>";
		echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Neue Bilddatei:</U></B></td><td><input type='file' name='file' style='width:100%'></td></tr>".chr(13).chr(10);
		echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Kommentar zur neuen Bilddatei:</U></B></TD><td><INPUT TYPE=Text NAME='newcomment' style='width:100%' size=100 MAXLENGTH=255></td></tr>".chr(13).chr(10);

		// Upload für ZIP-Archiv:
		echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Neue Bilddateien als Zip-Archiv hochladen:</U></B></td><td><input type='file' name='filezip' style='width:100%'></td></tr>".chr(13).chr(10);
		
	  	echo "</table>".chr(13).chr(10);

	  	// Die aktuelle Zahl der Bilder sichern:
	  	echo "<BR><INPUT TYPE=submit VALUE='Galerie aktualisieren'>".chr(13).chr(10);
	  	include ("../_admin_ok_link.php");
	  	echo "<BR><BR>".chr(13).chr(10);

		// #################
		// Liste der Bilder:


		// #################################################
		// Der Teil mit den Bildern:
		// Prüfen, ob Bilder bereits hinterlegt worden sind:
		$strSQL = "select * from skk_galery_pics WHERE id_galery=".$Nr." AND del='N' AND modifieddate IS NULL ORDER BY date_format(filecreatedate, '%d-%M-%Y') ASC";

		$rsPICS = mysqli_query($objDBCon, $strSQL);
		$RecordCountPICS = mysqli_num_rows($rsPICS);

		echo "<INPUT TYPE=HIDDEN NAME='numberofpictures' VALUE='".$RecordCountPICS."'>".chr(13).chr(10);

		if ($RecordCountPICS > 0)
		{
			echo "<table cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);
			echo "<TR>".chr(13).chr(10);
			echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Bereits vorhandene Bilder in dieser Galerie (Anzahl ".$RecordCountPICS.", sotiert nach Erstellungsdatum):</U></B>";

			// Hilfe anzeigen?
			if ($dx==1)
			{
				echo "<BR><BR>".chr(13).chr(10);
				echo "<I>Erlaubte Dateitypen: jpg, jpeg, gif, png / Max. Gr&ouml;&szlig;e: 250 KB / Keine Sonderzeichen im ";
				echo "Dateinamen. Mehrere Bilddateien k&ouml;nnen zeitgleich als ZIP-Datei hochgeladen werden. Diese darf jedoch nicht gr&ouml;&szlig;er als 10 MB sein!</I>";
			}
			
			echo "</td></tr></table>";
			echo "<table cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);

			// Es wurden bereits Bilder hinterlegt:
			$i = 0;
			
			while ($rowPICS = $rsPICS->fetch_object())
			{
        	 	$fldpicture[$i] = $rowPICS->picture;
        	 	$fldcomment[$i] = $rowPICS->comment;

				// ##########################
         		// Wurde ein Bild hinterlegt?
				// ACHTUNG! Neues Bilderverzeichnis wegen Zertifikatsfehler:
			  	// $uploaddir = getcwd();
			  	// $uploadfile = $uploaddir."/pics/".$fldpicture[$i];
				$uploadfile = $fldpicture[$i];

			  	if (is_file($uploadfile))
			  	{
			    	echo "<tr><TD width='50%' valign=top bgcolor='#C0C0C0'><B><U>Bild:</U></B></td>".chr(13).chr(10);

			    	// Die Auflösung berechnen:
					list($picwidth, $picheight, $pictype, $picattr) = getimagesize($uploadfile);

					if ($picwidth > 75)
					{
						$fac = ($picwidth / 75);
						$picwidth = round($picwidth / $fac, 0);
						$picheight = round($picheight / $fac, 0);
					}

			    	echo "<td width='50%'><img src='".$fldpicture[$i]."' align='left' width='".$picwidth."' height='".$picheight."'>";
					echo "</TD></tr>".chr(13).chr(10);

					// Der interne Dateiname:
					echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Interner Dateiname des Bildes:</U></B></td>";
					echo "<TD>".$fldpicture[$i]."</td></tr>".chr(13).chr(10);
					
					// Erstellungsdatum:
					$createtime = date("Y-m-d H:i:s", filemtime($fldpicture[$i]));
					echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Erstellungsdatum der Bilddatei:</U></B></td>";
					echo "<TD>".substr($createtime,8,2).".".substr($createtime,5,2).".".substr($createtime,0,4)." ".substr($createtime,11,8)."</td></tr>".chr(13).chr(10);
					
					// Bild löschen:
			    	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Bild l&ouml;schen:</U></B></td>".chr(13).chr(10);
			    	echo "<td><INPUT TYPE='CHECKBOX' NAME='delpicture".$i."'</td></tr>".chr(13).chr(10);

			    	// Kommentar:
			    	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Kommentar:</U></B></td>";
					echo "<TD><INPUT TYPE=Text NAME='comment".$i."' style='width:100%' value='".$fldcomment[$i]."' size=100 MAXLENGTH=255></td></tr>".chr(13).chr(10);

					// Alte ID:
			    	echo "<tr><TD><INPUT TYPE=HIDDEN NAME='oldpicture".$i."' VALUE='".$fldpicture[$i]."'></TD><TD></TD></TR>".chr(13).chr(10);
			  	}
			  	$i++;
			}
			echo "</TABLE>";
		}

	  	echo "</FORM>".chr(13).chr(10);
	  	echo "</DIV>".chr(13).chr(10);
	}

  	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
  	include("../forms/navigation.php");
  	writenavigation($objDBCon, $ux, $dx);

  	include("../../includes/forms/footer.php");
?>
