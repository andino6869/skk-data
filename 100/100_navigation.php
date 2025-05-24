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
	
		// ###################
		// Das Bild einhängen:
		echo "<TD align='center' bgcolor=#CC9900 width=33%><img border='0'";
		
		if (is_file("pics/forms/Rechts.png"))
		{
		    echo "src='pics/forms/Rechts.png' ";
		}
		else
		{
		    if (is_file("../pics/forms/Rechts.png"))
		    {
		        echo " src='..pics/forms/Rechts.png' ";
		    }
		    else
		    {
		        echo " src='../../pics/forms/Rechts.png' ";
		    }
		}
		
		echo " title='100 Jahre Schachklub Kriegshaber' width='120' height='40'></TD>";
		
		echo "<TD colspan=3 bgcolor=#CC9900 align='center'>".chr(13).chr(10);
		echo "<P>".chr(13).chr(10);
		
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
		
		// ###################
		// Das Bild einhängen:
		echo "<TD align='center' bgcolor=#CC9900 width=33%><img border='0'";
		echo " <img border='0'";
		
		if (is_file("pics/forms/Links.png"))
		{
		    echo "src='pics/forms/Links.png' ";
		}
		else
		{
		    if (is_file("../pics/forms/Links.png"))
		    {
		        echo " src='..pics/forms/Links.png' ";
		    }
		    else
		    {
		        echo " src='../../pics/forms/Links.png' ";
		    }
		}
		
		echo " title='100 Jahre Schachklub Kriegshaber' width='120' height='40'></TD>";
				
		echo "</TR></TABLE>".chr(13).chr(10);
		
		echo "<TABLE width=100%><TD colspan=2 valign=top align=center>".chr(13).chr(10);
		echo "<TABLE bgcolor=#FFFFFF cellpadding=10 cellspacing=0 border=0 width='100%'>".chr(13).chr(10);
		echo "<TR><TD WIDTH='75%' VALIGN=top>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
	}
?>