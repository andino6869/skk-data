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

	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	// Achtung, hier soll alles wieder angezeigt werden, daher 999!
	writeNavigationBar(999, $objDBCon);

	// 2.) Abfrage an die Datenbank für die aktuelle Galerie:
	if (isset($_GET["Nr"]))
	{
		$Nr = $_GET["Nr"];
	}
	else
	{
		$Nr = $_REQUEST["Nr"];
	}

	$strSQL="select * from skk_galery WHERE id=".$Nr." AND del='N' AND modifieddate IS NULL";

	// 3.) Daten lesen:
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$ID[$i] = $row->id;
			$galery[$i] = $row->galery;
			$creator[$i] = $row->creator;
			$createdate[$i] = $row->createdate;
			$i++;
		}
	}
	else
	{
		echo "Daten konnten nicht aus Datenbank gelesen werden.<BR>".chr(13).chr(10);
	}

	// ###################
	// 4.) Daten ausgeben:
	$strItem = formatoutput($galery[0]);

	echo "<SPAN CLASS=he1>".$strItem."</SPAN><BR><BR>".chr(13).chr(10);
	echo "<HR>".chr(13).chr(10);

	// ###################
	// 5.) Bilder ausgeben:
	$strSQL = "select * from skk_galery_pics WHERE id_galery=".$Nr." AND del='N' AND modifieddate IS NULL ORDER BY createdate ASC;";

	$rsPICS = mysqli_query($objDBCon, $strSQL);
	$RecordCountPICS = mysqli_num_rows($rsPICS);
	
	if ($RecordCountPICS > 0)
	{
		// Tabelle ausgeben
		echo "<table cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);
		$counter = 0;

		// Es wurden Bilder hinterlegt:
		$i = 0;
			
		while ($row = $rsPICS->fetch_object())
   		{
       		$fldpicture[$i] = $row->picture; 
       		$fldcomment[$i] = $row->comment; 

			// ##########################
         	// Wurde ein Bild hinterlegt?
			// Neues Verzeichnis:
         	$uploadfile = $fldpicture[$i];
         		
         	if (!(is_file($uploadfile)))
         	{
         		$arrTmp = explode("/", $uploadfile);
         		$uploadfile = $arrTmp[count($arrTmp)-1];
         		         		
         		if (is_file("pics/galery/".$uploadfile))
         		{
         			$uploadfile = "pics/galery/".$uploadfile;
         		}
         		else
         		{	
         			if (is_file("../pics/galery/".$uploadfile))
         			{
         				$uploadfile = "../pics/galery/".$uploadfile;
         			}
         			else 
         			{
         				$uploadfile = "../../pics/galery/".$uploadfile;
         			}
         		}
         	}		
		  	         	
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
				
				if (trim($fldcomment[$i])!="")
				{
					echo "<BR>Kommentar:<BR>";
					$strItem = formatoutput($fldcomment[$i]);
					echo $strItem;
				}

				echo "</p>";

				$counter++;
		  	}
		  	
		  	$i++;
		}
		echo "</TD></TR></TABLE>";
	}

	// 6.) Der Autor:
	echo "<BR><BR>Autor: ".$creator[0]."<BR><BR>";

	include("../includes/forms/middler.php");

	// ######################################
	// Die neue Suchfunktion:
	include("../includes/forms/seekgalery.php");
	writeseekgalery("", "TRUE");

	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>















