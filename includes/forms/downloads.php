<?php
// ###################################
// Modul-Update August 2019
// ###################################

// UPDATE Schneider 05.05.2008:
// Mit den folgenden Zeilen lassen sich
// alle Dateien in dem Verzeichnis files
// dynamisch auslesen. Damit gibt es keine
// fest kodierten Downloads mehr, allein der
// Inhalt des Ordners "downloads" ist künftig maßgeblich.

// Den Kopfbereich schreiben:
function get_downloads($objDBCon)
{
	echo "<SPAN CLASS=red_head>Aktuelle Downloads:</SPAN><HR noshade size=1>".chr(13).chr(10);

	// Zwei Verzeichnisse zurück wechseln:

	// UPDATE 22.07.2015 wegen Errlog PHP Einträge. Permission denied!
	//$handle=opendir ("../");
	// UPDATE Ende

	$handle = opendir ("../downloads/");
	$filesfound = "FALSE";
	$filesfound = "FALSE";
	$messagedone = "FALSE";
	$fileoutput = "FALSE";

	while ($curfile = readdir ($handle))
	{
		// Keine Verzeichnisnavigation anzeigen:
		if ($curfile != ".")
		{
			if ($curfile != "..")
			{
				// Es wurden Dateien gefunden!
				$filesfound="TRUE";
				$bIsFolder="FALSE";
				
				// Die Grösse der Datei herausfinden:
				$curfilesize = filesize("../downloads/$curfile");
				$curfilesize = round($curfilesize / 1024, 2);


				// Prüfen, ob es in der Datenbank einen Anzeigenamen für diese
				// Datei gibt:
				$strSQL = "select viewname, category from skk_downloads WHERE filename='$curfile' AND del='N' ";
				$strSQL = $strSQL."AND modifieddate IS NULL ORDER BY viewname ASC";
	
				$rs = mysqli_query($objDBCon, $strSQL);
 				$RecordCount = mysqli_num_rows($rs);

 				if ($RecordCount == 0)
 				{
 					// Der Dateiname wird der Anzeigename!
					// Dies ist der Fall für Dateien, die nicht in Datenbank, aber im Dateisystem vorhanden sind.
 					$strviewname = $curfile;
 					$showlink = "TRUE";
 					$filesfound = "TRUE";
 				}
 				else
 				{
 					// ############################
 					// Der alternative Anzeigename:
 					$row = $rs->fetch_object();
 					$category = $row->category;
 					
					if ($category == "ALLE")
					{
						$strviewname = $row->viewname;
						$showlink = "TRUE";
						$filesfound = "TRUE";
					}
					else
					{
						$showlink = "FALSE";
					}
 				}
				
 				// ################################
				// Soll der Link ausgegeben werden?
				if ($showlink == "TRUE")
				{
					// Es wird mindestens ein Link ausgegeben:
					$fileoutput = "TRUE";

					// Die Daten ausgeben:
					echo "<table><tr><td>".chr(13).chr(10);
					echo "<A HREF='../downloads/$curfile'>".chr(13).chr(10);

					// Prüfen, welches Icon gebraucht wird:
					// Multimedia - Dateien:
					if (strpos($curfile, ".mp3")>0 || strpos($curfile, ".mid")>0 || strpos($curfile, ".mpeg")>0 )
					{
						echo "<IMG SRC='../pics/filetypes/multimedia.jpg' border=0 WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE></A>".chr(13).chr(10);
					}
					// PDF - Dokumente:
					elseif (strpos($curfile, ".pdf")>0 || strpos($curfile, ".PDF")>0)
					{
						echo "<IMG SRC='../pics/filetypes/pdf.jpg' border=0 WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE></A>".chr(13).chr(10);
					}
					// Archive:
					elseif (strpos($curfile, ".zip")>0 || strpos($curfile, ".rar")>0 || strpos($curfile, ".ZIP")>0 || strpos($curfile, ".RAR")>0)
					{
						echo "<IMG SRC='../pics/filetypes/zip.jpg' border=0 WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE></A>".chr(13).chr(10);
					}
					// Bilder:
					elseif (strpos($curfile, ".jpg")>0 || strpos($curfile, ".gif")>0 || strpos($curfile, ".jpeg")>0 || strpos($curfile, ".JPG")>0 || strpos($curfile, ".GIF")>0 || strpos($curfile, ".JPEG")>0)
					{
						echo "<IMG SRC='../pics/filetypes/grafics.jpg' border=0 WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE></A>".chr(13).chr(10);
					}
					// PGN-Dateien:
					elseif (strpos($curfile, ".pgn")>0 || strpos($curfile, ".PGN")>0)
					{
						echo "<IMG SRC='../pics/filetypes/pgn.gif' border=0 WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE></A>".chr(13).chr(10);
					}
					// Textverarbeitung:
					elseif (strpos($curfile, ".txt")>0 || strpos($curfile, ".TXT")>0 || strpos($curfile, ".doc")>0 || strpos($curfile, ".DOC")>0 || strpos($curfile, ".rtf")>0 || strpos($curfile, ".RTF")>0)
					{
						echo "<IMG SRC='../pics/filetypes/text.gif' border=0 WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE></A>".chr(13).chr(10);
					}
					// Excel-Dateien:
					elseif (strpos($curfile, ".xlsx")>0 || strpos($curfile, ".XLSX")>0)
					{
						echo "<IMG SRC='../pics/filetypes/excel.png' border=0 WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE></A>".chr(13).chr(10);
					}
					// Ordner:
					elseif (strpos($curfile, ".")==0)
					{
						echo "<IMG SRC='../pics/filetypes/folder.gif' border=0 WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE></A>".chr(13).chr(10);
						$bIsFolder="TRUE";
					}
					else
					{
						// Alle anderen Dateitypen:
						echo "<IMG SRC='../pics/filetypes/others.jpg' border=0 WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE></A>".chr(13).chr(10);
					}

					echo "</td><td>";
					
					// UPDATE:
					// Die Umlaute:
					$strviewname = str_replace("ä", "&auml;", $strviewname);
					$strviewname = str_replace("Ä", "&Auml;", $strviewname);
					$strviewname = str_replace("ö", "&ouml;", $strviewname);
					$strviewname = str_replace("Ö", "&Ouml;", $strviewname);
					$strviewname = str_replace("ü", "&uuml;", $strviewname);
					$strviewname = str_replace("Ü", "&Uuml;", $strviewname);
					$strviewname = str_replace("ß", "&szlig;", $strviewname);
					// UPDATE Ende
					
					echo "<SPAN CLASS=a_footer><A HREF='../downloads/$curfile'>$strviewname</A></SPAN><BR>".chr(13).chr(10).chr(13).chr(10);

					// Ausgabe in MB oder KB?
					if ($bIsFolder=="FALSE")
					{
						// Kein Verzeichnis, es erfolgt die reguläre Ausgabe:
						if ($curfilesize>1024)
						{
							$curfilesize=round($curfilesize / 1024, 2);
							echo "<SPAN CLASS=sm>(Dateigr&ouml;&szlig;e: $curfilesize MB)</SPAN>".chr(13).chr(10);
						}
						else
						{
							echo "<SPAN CLASS=sm>(Dateigr&ouml;&szlig;e: $curfilesize KB)</SPAN>".chr(13).chr(10);
						}
					}
					else
					{
						// Wir haben ein Verzeichnis!
						echo "<SPAN CLASS=sm>(Ordner)</SPAN>".chr(13).chr(10);
					}

					echo "</td></tr></table><BR>".chr(13).chr(10);
				}
			}
		}

		// Gibt es derzeit Downloads mit der Kategorie 'Alle'?
		// Die Anzeige soll ferner nicht für Ordnerwechsel erscheinen!
		if ($filesfound=="FALSE" && $curfile != "." && $curfile != "..")
		{
			if ($messagedone=="FALSE")
			{

				echo "<table><tr><td>".chr(13).chr(10);
				echo "</td><td>".chr(13).chr(10);
				echo "<SPAN CLASS=sm><A>Es stehen derzeit keine Downloads zur Verf&uuml;gung.</A></SPAN><BR>".chr(13).chr(10);
				echo "</td></tr></table><BR>".chr(13).chr(10);

				$messagedone="TRUE";
			}
		}
	}

	// Gibt es derzeit Downloads?
	if ($filesfound=="FALSE")
	{
		if ($messagedone=="FALSE")
		{
			echo "<table><tr><td>".chr(13).chr(10);
			echo "</td><td>".chr(13).chr(10);
			echo "<SPAN CLASS=sm><A>Es stehen derzeit keine Downloads zur Verf&uuml;gung.</A></SPAN><BR>".chr(13).chr(10);
			echo "</td></tr></table><BR>".chr(13).chr(10);
		}
	}
	else
	{
		// Wurde bis jetzt kein Link ausgegeben?
		if ($fileoutput=="FALSE")
		{
			echo "<table><tr><td>".chr(13).chr(10);
			echo "</td><td>".chr(13).chr(10);
			echo "<SPAN CLASS=sm><A>Es stehen derzeit keine Downloads zur Verf&uuml;gung.</A></SPAN><BR>".chr(13).chr(10);
			echo "</td></tr></table><BR>".chr(13).chr(10);
		}
	}

	// Handle wieder schliessen:
	closedir($handle);
	// UPDATE Ende.
}

?>
