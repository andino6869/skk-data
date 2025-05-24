<?PHP
	// ##############################################
	// Schreibt den Inhalt der News & Meldungen in
	// eine RSS - Datei für die News - Tickerfunktionalität.

	function createRSSFile($strMode, $objDBCon)
	{
		// #####################################################
		// 1.) Es reichen die Daten von einer kompletten Saison.
		$now = date("Y-m-d H:i:s");
		$curYear = substr($now,0,4);
		$curMonth = substr($now,5,2);
		$strProtocol = "https";

		// In welchem Monat stehen wir gerade?
		// Dabei den Anzeige-Modus beachten!
		if ($strMode=="AFRO")
		{
			// Das aktuelle Jahr passt für den SELECT.
		}
		else
		{
			if ($curMonth > 8)
			{
				// Es hat im aktuellen Jahr die neue Saison begonnen:
			}
			else
			{
				// Wir brauchen auch das Vorjahr!
				$curYear = $curYear - 1;
			}
		}

		// ##########################################
		// GUID vergeben, falls noch nicht geschehen:
		$strSQL = "select * from skk_news WHERE rssguid IS NULL AND del='N'";

		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

		// Die Aktualisierung durchführen:
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$curID = $row->id;

			// GUID erstellen:
			$strGUID = md5(uniqid(rand(), true));
			$strSQL = "UPDATE skk_news SET rssguid='".$strGUID."' WHERE id=".$curID." AND del='N';";
			
			if (!mysqli_query ($objDBCon, $strSQL))
			{
				echo "<BR>RSS-GUID bei der aktuellen Meldung konnte nicht aktualisiert werden!<BR>".chr(13).chr(10);
				echo mysqli_error($objDBCon).chr(13).chr(10);
				echo "<BR>Statement: ".$strSQL."<BR>".chr(13).chr(10);
			}
			$i++;
		}

		// #########################################################
		// 2.) Daten aus Datenbank holen:
		if ($strMode!="AFRO")
		{
		    if ($strMode=="100-Jahre-Feier")
		    {
		        $strSQL = "select * from skk_news WHERE modifieddate IS NULL AND ";
		        $strSQL = $strSQL."del='N' AND (fadeifdeadlinereached = 'N' OR (fadeifdeadlinereached != 'N' AND ";
		        $strSQL = $strSQL."deadlinedate>'".$now."')) AND category='100-Jahre-Feier' ";
		        $strSQL = $strSQL."ORDER BY newsdate ASC";
		    }
		    else 
		    {
    			$strSQL = "select * from skk_news WHERE newsdate>'".(string)$curYear."-09-01' AND modifieddate IS NULL AND ";
    			$strSQL = $strSQL."del='N' AND (fadeifdeadlinereached = 'N' OR (fadeifdeadlinereached != 'N' AND ";
    			$strSQL = $strSQL."deadlinedate>'".$now."')) ";
    			$strSQL = $strSQL."ORDER BY newsdate ASC";
		    }
		}
		else
		{
			$strSQL = "select * from skk_news WHERE newsdate>'".(string)$curYear."-01-01' AND modifieddate IS NULL AND ";
			$strSQL = $strSQL."del='N' AND (fadeifdeadlinereached = 'N' OR (fadeifdeadlinereached != 'N' AND ";
			$strSQL = $strSQL."deadlinedate>'".$now."')) AND category='AFRO' ";
			$strSQL = $strSQL."ORDER BY newsdate ASC";
		}

		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

		// Das Ausgabe - Array erstellen:
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$ID[$i] = $row->id;
			$Erstellungsdatum[$i] = $row->createdate;
			$Headline[$i] = $row->headline;
			$Kurztext[$i] = $row->shorttext;
			$rssguid[$i] = $row->rssguid;
			$i++;
		}

		// #########################################################
		// 3.) Gibt es Datensätze?
		if ($RecordCount > 0)
		{
			// Die alte Datei wieder löschen, falls vorhanden:
			if ($strMode=="AFRO")
			{
				if (is_file("../rss/rss_afro.xml"))
				{
					unlink ("../rss/rss_afro.xml");
				}

				// Die Datei neu schreiben:
				$xmlFile = "../rss/rss_afro.xml";
			}
			else
			{
			    if ($strMode=="100-Jahre-Feier")
			    {
			        if (is_file("../rss/rss_100.xml"))
			        {
			            unlink ("../rss/rss_100.xml");
			        }
			        
			        // Die Datei neu schreiben:
			        $xmlFile = "../rss/rss_100.xml";
			    }
			    else 
			    {
			        if (is_file("../rss/rss.xml"))
			        {
			            unlink ("../rss/rss.xml");
			        }
			        
			        // Die Datei neu schreiben:
			        $xmlFile = "../rss/rss.xml";
			    }
			}

			// Datei zum Schreiben öffnen:
			$fp = fopen($xmlFile, "w");

			// Den Header schreiben:
			$strStream = "<?xml version=".chr(34)."1.0".chr(34)."?>".chr(13).chr(10);
			fwrite($fp, $strStream);

			$strStream = "<rss version=".chr(34)."2.0".chr(34)." xmlns:atom=".chr(34)."http://www.w3.org/2005/Atom".chr(34).">".chr(13).chr(10);
			fwrite($fp, $strStream);

			// Den Kanal definieren:
			$strStream = "<channel>".chr(13).chr(10);
			fwrite($fp, $strStream);

			// Welche Art Stream?
			if ($strMode=="AFRO")
			{
				$strStream = "<title>SK Kriegshaber: AFRO - Nachrichten</title>".chr(13).chr(10);
			}
			else
			{
			    if ($strMode=="100-Jahre-Feier")
			    {
			        $strStream = "<title>SK Kriegshaber: 100-Jahre-Feier Nachrichten</title>".chr(13).chr(10);
			    }
			    else 
			    {
			        $strStream = "<title>SK Kriegshaber: Nachrichten</title>".chr(13).chr(10);
			    }				
			}
			fwrite($fp, $strStream);

			if ($strMode=="AFRO")
			{
				$strStream = "<description>News und Meldungen vom AFRO ".$curYear."</description>".chr(13).chr(10);
			}
			else
			{
			    if ($strMode=="100-Jahre-Feier")
			    {
			        $strStream = "<description>News und Meldungen zur 100-Jahre-Feier des Schachklubs Kriegshaber</description>".chr(13).chr(10);
			    }
			    else 
			    {
			        $strStream = "<description>News und Meldungen vom Schachklub Kriegshaber</description>".chr(13).chr(10);
			    }				
			}
			fwrite($fp, $strStream);

			// Link auf die Hauptseite (ohne RSS - Ordner):
			// UPDATE 11.09.2021:
			// URL auf HTTPS angepasst.
			$strStream = "<link>".$strProtocol."://www.skk.de</link>".chr(13).chr(10);
			fwrite($fp, $strStream);
			// UPDATE Ende

			// Die Spracheinstellungen:
			$strStream = "<language>de-de</language>".chr(13).chr(10);
			fwrite($fp, $strStream);

			// ################################
			// Die News ausgeben:
			for($i = 0; $i < $RecordCount; $i++)
			{
				$strStream = "<item>".chr(13).chr(10);
				fwrite($fp, $strStream);

				// Titel:
				$strStream = $Headline[$i];
				$strStream = strUpdateStream($strStream);				
				$strStream = "<title>".$strStream."</title>".chr(13).chr(10);

				fwrite($fp, $strStream);

				// Beschreibung:
				if (trim($Kurztext[$i])!="")
				{
					$strStream = $Kurztext[$i];
					$strStream = strUpdateStream($strStream);
					$strStream = "<description>".$strStream."</description>".chr(13).chr(10);

					fwrite($fp, $strStream);
				}

				// Link:
				$strCurrentID = $ID[$i];

				// UPDATE 11.09.2021:
				// URL auf HTTPS angepasst.
				$strStream = "<link>".$strProtocol."://www.skk.de/sites/message.php?Nr=".$strCurrentID."</link>".chr(13).chr(10);
				fwrite($fp, $strStream);
				// UPDATE Ende

				// GUID:
				$strGUID = $rssguid[$i];

				// Laut Matthias: isPermaLink="false"
				$strStream = "<guid isPermaLink=".chr(34)."false".chr(34).">".$strGUID."</guid>".chr(13).chr(10);
				fwrite($fp, $strStream);

				$tmpDate = date("r", strtotime($Erstellungsdatum[$i]));
				$strStream = "<pubDate>".$tmpDate."</pubDate>".chr(13).chr(10);
				fwrite($fp, $strStream);

				$strStream = "</item>".chr(13).chr(10);
				fwrite($fp, $strStream);
			}

			// Die Datei abschließen:
			// Empfehlung laut RSS - Checker:
			// UPDATE 11.09.2021:
			// URL auf HTTPS angepasst.
			if ($strMode!="AFRO")
			{
			    if ($strMode=="100-Jahre-Feier")
			    {
			        $strStream = "<atom:link href=".chr(34).$strProtocol."://www.skk.de/rss/rss_100.xml".chr(34)." rel=".chr(34)."self".chr(34)." type=".chr(34)."application/rss+xml".chr(34)." />";
			    }
			    else 
			    {
			        $strStream = "<atom:link href=".chr(34).$strProtocol."://www.skk.de/rss/rss.xml".chr(34)." rel=".chr(34)."self".chr(34)." type=".chr(34)."application/rss+xml".chr(34)." />";
			    }			    
			}
			else
			{
			    $strStream = "<atom:link href=".chr(34).$strProtocol."://www.skk.de/rss/rss_afro.xml".chr(34)." rel=".chr(34)."self".chr(34)." type=".chr(34)."application/rss+xml".chr(34)." />";
			}

			fwrite($fp, $strStream);
            // UPDATE Ende

			$strStream = "</channel>".chr(13).chr(10);
			fwrite($fp, $strStream);

			$strStream = "</rss>".chr(13).chr(10);
			fwrite($fp, $strStream);

			fclose($fp);

			// ######################################
			// Die Rechte umsetzen:
			chmod($xmlFile, 0777);
		}
	}
	
	function strUpdateStream($strStream)
	{
	    $strStream = str_replace("&auml;", "ae", $strStream);
	    $strStream = str_replace("&Auml;", "Ae", $strStream);
	    $strStream = str_replace("&ouml;", "oe", $strStream);
	    $strStream = str_replace("&Ouml;", "Oe", $strStream);
	    $strStream = str_replace("&uuml;", "ue", $strStream);
	    $strStream = str_replace("&Uuml;", "Ue", $strStream);
	    $strStream = str_replace("&szlig;", "ss", $strStream);
	    
	    $strStream = str_replace("ä", "ae", $strStream);
	    $strStream = str_replace("Ä", "Ae", $strStream);
	    $strStream = str_replace("ö", "oe", $strStream);
	    $strStream = str_replace("Ö", "Oe", $strStream);
	    $strStream = str_replace("ü", "ue", $strStream);
	    $strStream = str_replace("Ü", "ue", $strStream);
	    $strStream = str_replace("ß", "ss", $strStream);
	    
	    $strStream = str_replace("\'", "'", $strStream);
	    $strStream = str_replace(chr(92).chr(34), chr(34), $strStream);
	    $strStream = str_replace(chr(34), "", $strStream);
	    $strStream = str_replace("<", "", $strStream);
	    $strStream = str_replace(">", "", $strStream);
	    
	    $strStream = str_replace("\'", "'", $strStream);
	    $strStream = str_replace(chr(92).chr(34), chr(34), $strStream);
	    $strStream = str_replace("´", "", $strStream);
	    $strStream = str_replace("„", "", $strStream);
	    $strStream = str_replace("“", "", $strStream);
	    $strStream = str_replace("&nbsp;", " ", $strStream);
	    $strStream = str_replace("&frac12;", ",5", $strStream);
	    $strStream = str_replace("½", ",5", $strStream);
	    
	    $strStream = str_replace(chr(150), "", $strStream);
	    $strStream = str_replace("  ", " ", $strStream);
	    $strStream = str_replace("  ", " ", $strStream);
	    $strStream = str_replace("…", "", $strStream);
	    
	    // Ergänzung Matthias vom 13.01.2010:
	    $strStream = str_replace("&", "&amp;", $strStream);
	    $strStream = str_replace("<", "&lt;", $strStream);
	    $strStream = str_replace(">", "&gt;", $strStream);
	    $strStream = str_replace(chr(34), "&quot;", $strStream);
	    $strStream = str_replace("'", "&apos;", $strStream);
	    
	    
	    // CMS - Steuerelement:
	    $strStream = str_replace("<br />", "<br>", $strStream);
	    $strStream = str_replace("<td><br>", "", $strStream);
	    
	    return $strStream;
	}
?>