<?PHP
	function writeLink($strLinkFile, $strTitle, $strImageActive, $strImageSelected, $strActive, $picWidth, $param = '')
	{

		// Den Link setzen:
		if ($strActive=="TRUE")
		{
			// Soll ein Parameter mitgegeben werden?
			if (trim($param)!="")
			{
				if (is_file($strLinkFile))
				{
					echo "<A HREF='".$strLinkFile."?".$param."'>";
				}
				else
				{
					if (is_file("../".$strLinkFile))
					{
						echo "<A HREF='../".$strLinkFile."?".$param."'>";
					}
					else
					{
						echo "<A HREF='../../".$strLinkFile."?".$param."'>";
					}
				}
			}
			else
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
						echo "<A HREF='../../".$strLinkFile."'>";
					}
				}
			}
		}


		echo " <img border='1'";

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

		// Der Titel:
		$picWidth = $picWidth * 1.8;
		echo " title='".$strTitle."' width='".$picWidth."' height='40' ";

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
	function writeNavigationBar($curtab, $con, $writeButtons = "TRUE")
	{
		// #######################################
		// Stylesheet verwenden!			
		echo "<TABLE width='100%' border='1'>";
		$strToolTip = "";

		if ($writeButtons=="TRUE")
		{
			echo "<TR height=60><BR>".chr(13).chr(10);
			echo "<TD colspan=3 align='center' bgcolor=#CC9900>".chr(13).chr(10);
			echo "<P>".chr(13).chr(10);

			// #############
			if ($curtab==0)
			{
				// News sind deaktiviert!
				// echo " News & Meldungen |";
				writeLink("", "", "newsgrey.tif", "", "FALSE", 145);
			}
			else
			{
			    $strToolTip = "Hier k&ouml;nnen Sie die aktuellen News und Meldungen einsehen.";
			    
				// News sind aktiv!
				if (is_file("../sites/index.php"))
				{
					//echo "<A HREF='../sites/index.php'> News & Meldungen</A> |";
				    writeLink("../sites/index.php", $strToolTip, "newsdeactive.tif", "newsactive.tif", "TRUE", 145, "mx=PARENTS");
				}
				else
				{
					//echo "<A HREF='../../sites/index.php'> News & Meldungen</A> |";
				    writeLink("../../sites/index.php", $strToolTip, "newsdeactive.tif", "newsactive.tif", "TRUE", 145, "mx=PARENTS");
				}

			}

			// ############
			if ($curtab==1)
			{
				// echo " Wir über uns |";
				writeLink("", "", "aboutgrey.tif", "", "FALSE", 100);
			}
			else
			{
			    $strToolTip = "Hier stellt sich der Schachklub Kriegshaber vor.";
			    
				if (is_file("../sites/about.php"))
				{
					// echo "<A HREF='../sites/about.php'> Wir über uns</A> |";
				    writeLink("../sites/about.php", $strToolTip, "aboutdeactive.tif", "aboutactive.tif", "TRUE", 100);
				}
				else
				{
					// echo "<A HREF='../../sites/about.php'> Wir über uns</A> |";
				    writeLink("../../sites/about.php", $strToolTip, "aboutdeactive.tif", "aboutactive.tif", "TRUE", 100);
				}
			}

			// ############
			if ($curtab==2)
			{
				// echo " Jugend |";
				writeLink("", "", "youthgrey.tif", "", "FALSE", 70);
			}
			else
			{
			    $strToolTip = "Hier finden Sie Informationen &uuml;ber das Jugendtraining des Schachklub Kriegshaber.";
			    
				if (is_file("../sites/youth.php"))
				{
					//echo "<A HREF='../sites/youth.php'> Jugend</A> |";
				    writeLink("../sites/youth.php", $strToolTip, "youthdeactive.tif", "youthactive.tif", "TRUE", 70, "mx=YOUTH");
				}
				else
				{
					// echo "<A HREF='../../sites/youth.php'> Jugend</A> |";
				    writeLink("../../sites/youth.php", $strToolTip, "youthdeactive.tif", "youthactive.tif", "TRUE", 70, "mx=YOUTH");
				}
			}

			// ############
			if ($curtab==3)
			{
				// echo " DWZ |";
				writeLink("", "", "dwzgrey.tif", "", "FALSE", 50);
			}
			else
			{
			    $strToolTip = "Hier finden Sie die DWZ - Liste der Mitglieder des Schachklub Kriegshaber.";
			    
				if (is_file("../sites/dwz.php"))
				{
	                //				echo "<A HREF='../sites/dwz.php'> DWZ</A> |";
				    writeLink("../sites/dwz.php", $strToolTip, "dwzdeactive.tif", "dwzactive.tif", "TRUE", 50);
				}
				else
				{
					//echo "<A HREF='../../sites/dwz.php'> DWZ</A> |";
				    writeLink("../../sites/dwz.php", $strToolTip, "dwzdeactive.tif", "dwzactive.tif", "TRUE", 50);
				}
			}

			if ($curtab==4)
			{
				//echo " Termine |";
				writeLink("", "", "deadlinegrey.tif", "", "FALSE", 70);
			}
			else
			{
			    $strToolTip = "Hier finden Sie eine Liste der demn&auml;chst anstehenden Termine.";
			    
				if (is_file("../sites/deadlines.php"))
				{
					//echo "<A HREF='../sites/deadlines_future.php'> Termine</A> |";
				    writeLink("../sites/deadlines.php", $strToolTip, "deadlinedeactive.tif", "deadlineactive.tif", "TRUE", 70, "UseFuture=TRUE");
				}
				else
				{
					//echo "<A HREF='../../sites/deadlines_future.php'> Termine</A> |";
				    writeLink("../../sites/deadlines.php", $strToolTip, "deadlinedeactive.tif", "deadlineactive.tif", "TRUE", 70, "UseFuture=TRUE");
				}
			}

			if ($curtab==5)
			{
				//echo " Mannschaften |";
				writeLink("", "", "teamgrey.tif", "", "FALSE", 110);
			}
			else
			{
			    $strToolTip = "Hier erhalten Sie einen &Uuml;berblick &uuml;ber alle Mannschaften des Schachklub Kriegshaber.";
			    
				if (is_file("../sites/deadlines.php"))
				{
					// echo "<A HREF='../sites/teams.php'> Mannschaften</A> |";
				    writeLink("../sites/teams.php", $strToolTip, "teamdeactive.tif", "teamactive.tif", "TRUE", 110);
				}
				else
				{
					// echo "<A HREF='../../sites/teams.php'> Mannschaften</A> |";
				    writeLink("../../sites/teams.php", $strToolTip, "teamdeactive.tif", "teamactive.tif", "TRUE", 110);
				}
			}

			// ########################################################
			// UPDATE August 2015: Keine Verwendung, daher deaktiviert!
			/*if ($curtab==6)
			{
				// echo " Turniere |";
				writeLink("", "", "matchgrey.jpg", "", "FALSE", 65);
			}
			else
			{
				if (is_file("../sites/content.php"))
				{
					//echo "<A HREF='../sites/content.php'> Turniere</A> |";
					writeLink("../sites/content.php", "Hier erhalten Sie einen Überblick über alle aktuell hinterlegten Turniertabellen.", "matchdeactive.jpg", "matchactive.jpg", "TRUE", 65);
				}
				else
				{
					//echo "<A HREF='../../sites/content.php'> Turniere</A> |";
					writeLink("../sites/content.php", "Hier erhalten Sie einen Überblick über alle aktuell hinterlegten Turniertabellen.", "matchdeactive.jpg", "matchactive.jpg", "TRUE", 65);
				}
			}*/
			// UPDATE Ende!
			// ############
			
			// Das Partienfeature wird nicht mehr verwendet!
			if ($curtab==7)
			{
				//echo " Partien |";
				writeLink("", "", "gamesgrey.tif", "", "FALSE", 70);
			}
			else
			{
			    $strToolTip = "Hier k&ouml;nnen Partien aus der aktuellen Saison nachgespielt werden.";
			    
				if (is_file("../sites/matches.php"))
				{
					//echo "<A HREF='../sites/matches.php'> Partien</A> |";
				    writeLink("../sites/matches.php", $strToolTip, "gamesdeactive.tif", "gamesactive.tif", "TRUE", 70);
				}
				else
				{
					//echo "<A HREF='../../sites/matches.php'> Partien</A> |";
				    writeLink("../sites/matches.php", $strToolTip, "gamesdeactive.tif", "gamesactive.tif", "TRUE", 70);
				}
			}


			// #######################################################
			if ($curtab==8)
			{
				// echo " Links";
				writeLink("", "", "linksgrey.tif", "", "FALSE", 50);
			}
			else
			{
			    $strToolTip = "Hier finden Sie Hyperlinks auf Verb&auml;nde und andere Schachvereine.";
			    
				if (is_file("../sites/links.php"))
				{
					// echo "<A HREF='../sites/links.php'> Links</A>";
				    writeLink("../sites/links.php", $strToolTip, "linksdeactive.tif", "linksactive.tif", "TRUE", 50);
				}
				else
				{
					//echo "<A HREF='../../sites/links.php'> Links</A>";
				    writeLink("../../sites/links.php", $strToolTip, "linksdeactive.tif", "linksactive.tif", "TRUE", 50);
				}
			}

			// #######################################################
			if ($curtab==9)
			{
				// echo " Galerie";
				writeLink("", "", "galerygrey.tif", "", "FALSE", 90);
			}
			else
			{
			    $strToolTip = "Hier finden Sie die aktuellen Fotogalerien des Schachklub Kriegshaber.";
			    
				if (is_file("../sites/galery.php"))
				{
				    writeLink("../sites/galery.php", $strToolTip, "galerydeactive.tif", "galeryactive.tif", "TRUE", 90);
				}
				else
				{
				    writeLink("../../sites/galery.php", $strToolTip, "galerydeactive.tif", "galeryactive.tif", "TRUE", 90);
				}
			}

			// NEU: Die Sportseite:
			if ($curtab==10)
			{
				writeLink("", "", "sportgrey.tif", "", "FALSE", 50);
			}
			else
			{
			    $strToolTip = "Hier k&ouml;nnen die Meldungen zu Sportereignissen eingesehen werden, bei denen Mitglieder des Schachklub Kriegshaber mit beteiligt waren.";
			    
				if (is_file("../sites/index.php"))
				{
				    writeLink("../sites/index.php", $strToolTip, "sportdeactive.tif", "sportactive.tif", "TRUE", 50, "mx=SPORT");
				}
				else
				{
				    writeLink("../../sites/index.php", $strToolTip, "sportdeactive.tif", "sportactive.tif", "TRUE", 50, "mx=SPORT");
				}
			}

			// ##############################
			// UPDATE 01.10.2016
			// NEU: Die Archivseite:
			/*if ($curtab==11)
			{
				writeLink("", "", "archiv_grey.tif", "", "FALSE", 60);
			}
			else
			{
				if (is_file("../sites/archiv.php"))
				{
					writeLink("../sites/archiv.php", "Hier k&ouml;nnen Sie die digitalisierten Jugendschachausgaben des Schachklub Kriegshaber einsehen.", "archiv_deactive.tif", "archiv_active.tif", "TRUE", 60);
				}
				else
				{
					writeLink("../../sites/archiv.php", "Hier k&ouml;nnen Sie die digitalisierten Jugendschachausgaben des Schachklub Kriegshaber einsehen.", "archiv_deactive.tif", "archiv_active.tif", "TRUE", 60);
				}
			}*/
			
			// Es erfolgt die Anzeige, wenn die Dateien vorhanden sind und der Link angezeigt werden soll:
			$strSQL="SELECT * FROM skk_afro_config WHERE showafrolink='J' AND modifieddate IS NULL AND DEL='N';";

			if (bCheckRecordset($con, $strSQL)=="1")
			{
			    $strToolTip = "Hier finden Sie Hintergrundinformationen und Statistiken zu dem j&auml;hrlich stattfindenen Augsburger Friedensfest Schachopen.";
			    
				if (is_file("../afro/index.php"))
				{
					// echo "<A HREF='../sites/links.php'> Links</A>";
				    writeLink("../afro/index.php", $strToolTip, "afrodeactive.tif", "afroactive.tif", "TRUE", 50);
				}
				else
				{
					//echo "<A HREF='../../sites/links.php'> Links</A>";
				    writeLink("../../afro/index.php", $strToolTip, "afrodeactive.tif", "afroactive.tif", "TRUE", 50);
				}
			}

			echo "</P></TD>".chr(13).chr(10);
			echo "</TR>".chr(13).chr(10);
		}

		echo "<TR>".chr(13).chr(10);
		echo "<TD colspan=3 valign=top align=center>".chr(13).chr(10);
		echo "<TABLE bgcolor=ffffff cellpadding=10 cellspacing=0 border=0 width='100%'>".chr(13).chr(10);
		echo "<TR><TD WIDTH='75%' VALIGN=top>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		
		// ##################
		// UPDATE 23.09.2020:
		// Den Zugriff durch Crawler und Bots verhindern!
		// Die IP - Adresse des Anfragers:
		$ip = $_SERVER['REMOTE_ADDR'];
				
		// Ermittelt den zur angegebenen IP-Adresse passenden Internet-Hostnamen:
		$pc = strtolower(gethostbyaddr($ip));
		
		// Jetzt prüfen, ob der Hostname anteilig in der Liste mit geführt wird:
		$strSQL = "SELECT server_name FROM skk_not_allowed_bots WHERE modifieddate IS NULL AND DEL='N';";
		
		$rs = mysqli_query($con, $strSQL);
		$RecordCount = mysqli_num_rows($rs);
		
		if ($RecordCount > 0)
		{
		    $i = 0;
            
		    // Jetzt die Liste durchgehen und nach dem aktuellen Hostnamen suchen:
		    while ($row = $rs->fetch_object())
		    {
		        $server_name[$i] = $row->server_name;
		        
		        $pos=strpos($pc, $server_name[$i]);
		        
		        if (!($pos === false))
		        {
		            if (trim($strToolTip)=="")
		            {
		                $strToolTip = "Herzlichen Willkommen auf der Homepage des Schachklub Kriegshaber.";
		            }
		            
		            echo "<B>".$strToolTip."</B><BR>";
		            echo "<B>Sie erhalten weiteren Zugriff auf die Inhalte der Seite, wenn sie kein Crawler oder Bot sind.</B><BR><BR>";
		            echo "</TD>".chr(13).chr(10);
		            echo "</TR>".chr(13).chr(10);
		            echo "</TABLE></TABLE>".chr(13).chr(10);
                    echo "<p align='center'><font face='Arial' color='#FFFFFF'>Powered by PHP ".(float)phpversion()."</font></p>".chr(13).chr(10);
                    echo "</BODY>".chr(13).chr(10);
                    echo "</HTML>".chr(13).chr(10);
                    
                    // ###########################
                    // Den Zugriff protokollieren:
                    $now = date("Y-m-d H:i:s");
                    
                    $strSQL = "INSERT INTO skk_not_allowed_bots_log (server_name, ip, createdate, creator) VALUES (";
                    $strSQL = $strSQL ."'$pc', '$ip', '$now', 'SYSTEM');";
                    
                    if (!mysqli_query ($con, $strSQL))
                    {
                        echo("Database insert error: $strSQL<P>");
                        echo mysqli_error($con);
                    }
                    
                    exit;
		        }
		        
		        $i++;  
		    }
		}
		// UPDATE Ende!
		// ############
	}
?>