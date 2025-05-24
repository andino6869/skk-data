<?php
	function writeLink($strLinkFile, $strTitle, $strImageActive, $strImageSelected, $strActive, $picWidth, $bBackToBase = "FALSE")
	{
		// ##########################
		// Prüfen, ob der Link passt:
		// In welchem Basisverzeichnis sind wir aktiv?
		if ($bBackToBase == "FALSE")
		{
			$strBaseDir = "afro";
			
			// ########################
			// Den Pfad richtig setzen:
			if (!(is_file($strLinkFile)))
			{
				if (is_file($strBaseDir."/".$strLinkFile))
				{
					$strLinkFile = $strBaseDir."/".$strLinkFile;
				}
				else
				{
					$strLinkFile = "../".$strBaseDir."/".$strLinkFile;
				}
			}
		}
		else 
		{
			$strBaseDir = "sites";
			
			if (is_file($strBaseDir."/".$strLinkFile))
			{
				$strLinkFile = $strBaseDir."/".$strLinkFile;
			}
			else
			{
				$strLinkFile = "../".$strBaseDir."/".$strLinkFile;
			}
		}
		
		
				
		// ################
		// Den Link setzen:
		if ($strActive=="TRUE")
		{

			if (is_file($strLinkFile))
			{
				echo "<A HREF='".$strLinkFile."'>";
			}
			else
			{
				if (is_file("../".$strLinkFile))
				{
					echo "<A HREF='../".$strLinkFile."'>";
				}
				else
				{
					// #####################################
					// Sonderfall Navigation zurück zum SKK!
					if (is_file("../sites/".$strLinkFile))
					{
						echo "<A HREF='../sites/".$strLinkFile."'>";
					}
					else
					{
						echo "<A HREF='../../".$strLinkFile."'>";
					}
				}
			}
		}


		echo " <img border='1'";

		// ###################
		// Das Bild einhängen:
		if (is_file("pics/forms/".$strImageActive))
		{
			echo "src='pics/forms/".$strImageActive."' ";
		}
		else
		{
			if (is_file("../pics/forms/".$strImageActive))
			{
				echo " src='../pics/forms/".$strImageActive."' ";
			}
			else
			{
				echo " src='../../pics/forms/".$strImageActive."' ";
			}
		}

		// ##########
		// Der Titel:
		$picWidth = $picWidth * 1.8;
		echo " title='".$strTitle."' width='$picWidth' height='40' ";

		// Das alternative Bild:
		if ($strActive=="TRUE")
		{
 			if (is_file("pics/forms/".$strImageSelected))
			{
				// echo "onmouseover='flipImage('pics/forms/".$strImageSelected."')'";
				echo "onMouseOver=".chr(34)."flipImage(event, 'pics/forms/".$strImageSelected."')".chr(34);
			}
			else
			{
				if (is_file("../pics/forms/".$strImageSelected))
				{
					// onMouseOver="flipImage(event, 'URL')"
					// echo "onmouseover='flipImage('../pics/forms/".$strImageSelected."')'";
					echo "onMouseOver=".chr(34)."flipImage(event, '../pics/forms/".$strImageSelected."')".chr(34);
				}
				else
				{
					// echo "onmouseover='flipImage('../../pics/forms/".$strImageSelected."')'";
					echo "onMouseOver=".chr(34)."flipImage(event, '../../pics/forms/".$strImageSelected."')".chr(34);
				}
			}

			if (is_file("pics/forms/".$strImageActive))
			{
				// echo "onmouseout='flipImage('pics/forms/".$strImageActive."')'";
				echo " onMouseOut=".chr(34)."flipImage(event, 'pics/forms/".$strImageActive."')".chr(34);
			}
			else
			{
				if (is_file("../pics/forms/".$strImageActive))
				{
					// echo "onmouseout='flipImage('../pics/forms/".$strImageActive."')'";
					echo " onMouseOut=".chr(34)."flipImage(event, '../pics/forms/".$strImageActive."')".chr(34);
				}
				else
				{
					// echo "onmouseout='flipImage('../../pics/forms/".$strImageActive."')'";
					echo " onMouseOut=".chr(34)."flipImage(event, '../../pics/forms/".$strImageActive."')".chr(34);
				}
			}
		}
 		echo "></a>".chr(13).chr(10).chr(13).chr(10);
	}


	// UPDATE Schneider 05.05.2008
	// In Abhängigkeit des Parameters curtab werden manche Links
	// zur Verfügung gestellt und manche nicht.
	function writeNavigationBar($curtab, $con)
	{
		echo "<TABLE width='100%' border='1'><TR height=60><BR>".chr(13).chr(10);
		echo "<TD colspan=3 bgcolor=#EEEEEE align='center'>".chr(13).chr(10);
		echo "<P>".chr(13).chr(10);

		if ($curtab==0)
		{
			// News sind deaktiviert!
			writeLink("", "", "afronewsgrey.jpg", "", "FALSE", 145);
		}
		else
		{
			$strCurrentTitle = "Hier können Sie die aktuellen News und Meldungen zum Augsburger Friedensfestschachturnier einsehen.";
			writeLink("index.php", $strCurrentTitle, "afronewsdeactive.jpg", "afronewsactive.jpg", "TRUE", 145);
		}

		// ##############
		// Ausschreibung:
		if ($curtab==1)
		{
			writeLink("", "", "afroausschreibunggrey.jpg", "", "FALSE", 110);
		}
		else
		{
			$strCurrentTitle = "Hier finden Sie die Turnierausschreibung f&uuml;r das aktuelle Friedensfestschachopen.";
			writeLink("afro_writeout.php", $strCurrentTitle, "afroausschreibungdeactive.jpg", "afroausschreibungactive.jpg", "TRUE", 110);			
		}
		
		// ########
		// Anfahrt:
		if ($curtab==2)
		{
			// echo " Jugend |";
			writeLink("", "", "afroanfahrtgrey.jpg", "", "FALSE", 70);
		}
		else
		{
			$strCurrentTitle = "Hier finden Sie Informationen &uuml;ber den Anfahrtsweg zum Austragungsort des Turniers.";
			writeLink("afro_journey.php", $strCurrentTitle, "afroanfahrtdeactive.jpg", "afroanfahrtactive.jpg", "TRUE", 70);
		}

		// ###########
		// Ergebnisse:
		if ($curtab==3)
		{
			writeLink("", "", "afroergebnissegrey.jpg", "", "FALSE", 100);
		}
		else
		{
			$strCurrentTitle = "Hier finden Sie die Ergebnisse der letzten AFRO - Turniere.";
			writeLink("afro_results.php", $strCurrentTitle, "afroergebnissedeactive.jpg", "afroergebnisseactive.jpg", "TRUE", 100);
		}

		// #######
		// Hotels:
		if ($curtab==4)
		{
			writeLink("", "", "afrohotelsgrey.jpg", "", "FALSE", 60);
		}
		else
		{
			$strCurrentTitle = "Hier finden Sie Informationen &uuml;ber in der N&auml;he liegende Hotels und Unterk&uuml;nfte.";
			writeLink("afro_hotels.php", $strCurrentTitle, "afrohotelsdeactive.jpg", "afrohotelsactive.jpg", "TRUE", 60);
		}

		// ########
		// Kontakt:
		if ($curtab==5)
		{
			writeLink("", "", "afrokontaktgrey.jpg", "", "FALSE", 70);
		}
		else
		{
			$strCurrentTitle = "Hier erhalten Sie einen &Uuml;berblick über Kontaktdaten und Ansprechpartner zu diesem Turnier.";
			writeLink("afro_contact.php", $strCurrentTitle, "afrokontaktdeactive.jpg", "afrokontaktactive.jpg", "TRUE", 70);
		}

		// #########
		// Tabellen:
		if ($curtab==6)
		{
			writeLink("", "", "afrotabellengrey.jpg", "", "FALSE", 85);
		}
		else
		{
			$strCurrentTitle = "Hier erhalten Sie einen &Uuml;berblick &uuml;ber alle aktuell hinterlegten AFRO - Turniertabellen.";
			writeLink("afro_tables.php", $strCurrentTitle, "afrotabellendeactive.jpg", "afrotabellenactive.jpg", "TRUE", 85);
		}

		// #######################
		// Schachklub Kriegshaber:
		if ($curtab==7)
		{			
			writeLink("", "", "afroskkgrey.jpg", "", "FALSE", 50);
		}
		else
		{
			$strCurrentTitle = "Hier gelangen Sie auf die Homepage des Schachklub Kriegshaber.";
			writeLink("index.php", $strCurrentTitle, "afroskkdeactive.jpg", "afroskkactive.jpg", "TRUE", 50, "TRUE");
		}


		echo "</P></TD>".chr(13).chr(10);
		echo "</TR>".chr(13).chr(10);
		echo "<TR>".chr(13).chr(10);
		echo "<TD colspan=3 background='../pics/icons/bgdot.gif' valign=top align=center>".chr(13).chr(10);
		echo "<TABLE bgcolor=ffffff cellpadding=10 cellspacing=0 border=0 width='100%'>".chr(13).chr(10);
		echo "<TR><TD WIDTH='75%' VALIGN=top>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
	}
?>