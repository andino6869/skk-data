<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Fotogalerie");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/db/news_get.php")?>
<?php include("../includes/db/content_get.php")?>
<?php include("../includes/db/comment_get.php")?>
<?php include("../includes/string/str.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// 1.) Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	// Achtung, hier soll alles wieder angezeigt werden, daher 999!
	writeNavigationBar(999, $objDBCon);

	// #############################
	// 3.) Die Angaben prüfen, ob überhaupt etwas eingegeben worden ist:
	if ($Seek == "")
	{
		$Seek=$_REQUEST["Seek"];
	}

	if ($Seek == "")
	{
		$Seek=$_GET["Seek"];
	}

	$Seek = strReplaceHTMLTAGS($Seek);


	// #############################
  	// 4.) Plausichecks:
  	// 4.1.) Leere Eingabe:
  	if (trim($Seek) == '')
  	{
  		echo "<TABLE cellpadding=5 cellspacing=0 border=0>";
		echo "<TR><TD>";

  		// Die Position der Dateien kann anders lauten!
		if (is_file("../pics/admin/critical.gif"))
		{
			echo "<IMG SRC='../pics/admin/critical.gif' border=0>";
		}
		else
		{
			if (is_file("../../pics/admin/critical.gif"))
			{
				echo "<IMG SRC='../../pics/admin/critical.gif' border=0>";
			}
			else
			{
				echo "<IMG SRC='../../../pics/admin/critical.gif' border=0>";
			}
		}
    	echo "</TD><TD><B>Sie haben keine Suchzeichenkette angegeben.<BR>";

		// Seite finalisieren:
    	echo "</TD></TR></TABLE>".chr(13).chr(10);

		include("../includes/forms/middler.php");
		include("../includes/db/deadlines_shortview.php");

		get_deadlines_shortview($objDBCon);
		echo "<BR><BR><BR><BR>".chr(13).chr(10);

		include("../includes/forms/downloads.php");
		get_downloads($objDBCon);
		include("../includes/forms/footer.php");
		exit;
  	}

	// #############################
  	// 4.2.) Zu kurze Eingabe:
	if (strlen($Seek) < 4)
    {
    	echo "<TABLE cellpadding=5 cellspacing=0 border=0>";
		echo "<TR><TD>";

		// Die Position der Dateien kann anders lauten!
		if (is_file("../pics/admin/critical.gif"))
		{
			echo "<IMG SRC='../pics/admin/critical.gif' border=0>";
		}
		else
		{
			if (is_file("../../pics/admin/critical.gif"))
			{
				echo "<IMG SRC='../../pics/admin/critical.gif' border=0>";
			}
			else
			{
				echo "<IMG SRC='../../../pics/admin/critical.gif' border=0>";
			}
		}
    	echo "</TD><TD><B>Sie haben eine zu kurze Suchzeichenkette hinterlegt (mind. 4 Zeichen).<BR>";

  		// Seite finalisieren:
    	echo "</TD></TR></TABLE>".chr(13).chr(10);

		include("../includes/forms/middler.php");
		include("../includes/db/deadlines_shortview.php");

		get_deadlines_shortview($objDBCon);
		echo "<BR><BR><BR><BR>".chr(13).chr(10);

		include("../includes/forms/downloads.php");
		get_downloads($objDBCon);
		include("../includes/forms/footer.php");
		exit;
	}

	// Zusätzliche unbrauchbare Zeichen entfernen:
	$Seek = str_replace("%", "", $Seek);
	$Seek = str_replace("*", "", $Seek);


	// #########################################################
	// 5.) Reichen die Daten von der aktuellen Saison.
	if ($_POST["CURRENTSEASON"])
	{
		$now = date("Y-m-d H:i:s");
		$curYear = substr($now,0,4);
		$curMonth = substr($now,5,2);

		// In welchem Monat stehen wir gerade?
		if ($curMonth > 8)
		{
			// Es hat im aktuellen Jahr die neue Saison begonnen:
		}
		else
		{
			// Wir brauchen auch das Vorjahr!
			$curYear = $curYear - 1;
		}
		$buseyear = "TRUE";
	}
	else
	{
		$buseyear = "FALSE";
	}


	// #########################################################
	// 6.) Bilder aus Datenbank holen:
	$strSQL = "select * from skk_galery_pics WHERE (picture LIKE ".chr(34)."%".$Seek."%".chr(34)." OR ";
	$strSQL = $strSQL."comment LIKE ".chr(34)."%".$Seek."%".chr(34).") ";

	if ($buseyear == "TRUE")
	{
		$strSQL = $strSQL."AND createdate>'".(string)$curYear."-09-01' ";
	}
	$strSQL = $strSQL."AND modifieddate IS NULL AND del='N' ORDER BY createdate DESC";

	$rsPICS = mysqli_query($objDBCon, $strSQL);
	$numPICS = mysql_numrows($rsPICS);

	if ($numPICS > 0)
	{
		// Tabelle ausgeben
		echo "<table cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);
		$counter = 0;

		// Es wurden Bilder hinterlegt:
    	for ($i=0;$i<$numPICS;$i++)
    	{
    		// Max. 21 Bilder ausgeben:
    		if ($counter==21)
			{
				break;
			}

      		$nrak = $numPICS - $i - 1;
         	$fldpicture[$i] = mysql_result($resultPICS,$nrak,"picture");
         	$fldcomment[$i] = mysql_result($resultPICS,$nrak,"comment");

         	// Wurde ein Bild hinterlegt?
		  	$uploadfile = "../admin/galery/pics/".$fldpicture[$i];

		  	if (is_file($uploadfile))
		  	{
		  		// Drei Bilder pro Zeile!
		  		switch ($counter)
				{
					case "0":
						echo "<TR><TD width='33%'>";
						break;

					case "1":
						echo "</TD><TD width='33%'>";
						break;

					case "2":
						echo "</TD><TD width='33%'>";
						break;

					case "3":
						// Neue Zeile!
						echo "</TD></TR><TR><TD width='33%'>";
						$counter = 0;
						break;
				}

				echo "<p align='center'><a href='".$uploadfile."'>";

				// Die Auflösung berechnen:
				list($picwidth, $picheight, $pictype, $picattr) = getimagesize($uploadfile);

				echo "<IMG border='1' SRC='".$uploadfile."' alt='Klicken Sie auf das Bild, um ";
				echo "eine Darstellung in voller Gr&ouml;ße zu erreichen.' ";

				if ($picwidth > 200)
				{
					$fac = ($picwidth / 200);
					$picwidth = round($picwidth / $fac, 0);
					$picheight = round($picheight / $fac, 0);
				}

				echo "width='".$picwidth."' height='".$picheight."'></a>".chr(13).chr(10);
				echo "<BR>Kommentar:<BR>";

				if (trim($fldcomment[$i])!="")
				{
					$strItem = formatoutput($fldcomment[$i]);
					echo $strItem;
				}
				else
				{
					echo "-";
				}

				echo "</p>";

				$counter++;
		  	}
		}
		echo "</TD></TR></TABLE>";
	}
	else
	{
		echo "<table border=0><tr><td width=500 valign=top>".chr(13).chr(10);
	    echo "<td></td>".chr(13).chr(10);
		echo "<B>Es konnten keine passenden Datens&auml;tze im Bereich 'Fotogalerie' gefunden werden.</B>".chr(13).chr(10);
		echo "</td></tr></table><BR>".chr(13).chr(10);
	}

	include("../includes/forms/middler.php");

	// ######################################
	// Die neue Suchfunktion:
	include("../includes/forms/seekgalery.php");
	writeseekgalery("", $buseyear);

	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>















