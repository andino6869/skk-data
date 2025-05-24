<?php include("../includes/forms/header.php")?>
<?php
	writeheader("DWZ");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>

<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// UPDATE Schneider 05.05.2008:
	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	writeNavigationBar(3, $objDBCon);
	// UPDATE Ende


	echo "<SPAN CLASS=he1>DWZ Liste des SK Kriegshaber</SPAN><BR><BR>".chr(13).chr(10);

	// ################################################################
	// 1.) Auf dieser WEB - Seite sind die gemeldeten Spieler des SKK´s
	// hinterlegt:
	if (IsUrlAvailable("schachbund.de")=="TRUE")
	{
		// UPDATE 29.04.2014:
		// Der Link hat sich geändert:
		//$f="http://www.schachbund.de/dwz/db/verein-prn.html?zps=27113";
		$f="http://www.schachbund.de/verein.html?zps=27113";
		$strModus = "NET";

		// Den aktuelle Stand lokal in das DWZ - Verzeichnis sichern:
		$strContent = implode("", file("http://www.schachbund.de/verein.html?zps=27113&template=/template/drucker.tpl"));
		$f1 = fopen("dwz/dwz.htm", "w");
		fputs($f1, $strContent);
		fclose($f1);

		$ret = chmod("dwz/dwz.htm", 0666);
	}
	else
	{
		$strModus = "LOCAL";
	}

	// ###############################################
	// 2.) Inhalt aus der Datei in ein Array einlesen:
	$f="dwz/dwz.htm";
	$file=file ($f);

	$bStartWriting = "FALSE";
	$bStartWritingDone = "FALSE";

	if ($strModus == "LOCAL")
	{
		echo "<B>Die aktuelle DWZ - Liste wurde lokal ausgelesen und ist m&ouml;glicherweise veraltet!</B><BR><BR>".chr(13).chr(10);
	}

	// Bei dem neuen Format des Schachbunds gibt es keine Zeilenumbrüche mehr.
	// Daher muss die Aufbereitung des Inhalts anders als bisher erfolgen!
	// Den ganzen Inhalt einlesen:
	$strLine = $file[0];

	// Die Position der Rangliste ermitteln:
	$intStartPos = strpos($strLine, "Rangliste");
	$strLine = substr($strLine, $intStartPos - 1);

	// Das Ende der Tabelle ermitteln:
	$intEndPos = strpos($strLine, "Abfrage");
	$strLine = substr($strLine, 1, ($intEndPos-1));

	// Die Verlinkung zu den einzelnen Spielern herstellen:
	// z.B. http://www.schachbund.de/spieler.html?pkz=10246649
	$strLine = str_replace("spieler.html", "http://www.schachbund.de/spieler.html", $strLine);

	// Sonderzeichen korrekt umsetzen:
	$strLine = str_replace("Ã¶", "&ouml;", $strLine);
	$strLine = str_replace("Ã¼", "&uuml;", $strLine);
	$strLine = str_replace("ÃŸ", "&szlig;", $strLine);
	$strLine = str_replace("Ã¤", "&auml;", $strLine);
	$strLine = str_replace("Ã–", "&Ouml;", $strLine);

	// Tabelle ausgeben:
	echo $strLine;					


	for($i=0;$i<=count($file)-1;$i++)
	{
		// Soll eine Ausgabe erfolgen?
		$strLine = strtolower($file[$i]);

		// Der DWZ - Stand:
		// UPDATE 03.10.2014:
		// Seitenaufbau hat sich erneut geändert!
		// if (strpos($strLine, "stand dwz")>0)
		if (strpos($strLine, "id=".chr(34)."dewistable")>0)
		{
			$bStartWriting="TRUE";			
		}

		if (strpos($strLine, "abfrage")>0)
		{
			$bStartWriting="FALSE";
		}

		// Zeile zum ausgeben?
		if ($bStartWriting=="TRUE")
		{
		    $bStartWritingDone="TRUE";
		    
			// Die Tabelle besser sichtbar machen:
			$strLine = str_replace("table border=".chr(34)."0".chr(34), "table border=".chr(34)."1".chr(34), $strLine);
			$strLine = str_replace("width=".chr(34)."90%".chr(34), "width=".chr(34)."100%".chr(34), $strLine);

			// Den Link auf den Spieler korrekt setzen:
			// http://www.schachbund.de/dwz/db/spieler.html?zps=27113-121

			// UPDATE 29.04.2014: URL hat sich geändert!
			// http://www.schachbund.de/spieler.html?pkz=10246649
			$strLine = str_replace("spieler.html", "http://www.schachbund.de/spieler.html", $file[$i]);
			$strLine = str_replace("Spieler.html", "http://www.schachbund.de/Spieler.html", $strLine);

			$strLine = str_replace("Ã¶", "&ouml;", $strLine);
			$strLine = str_replace("Ã¼", "&uuml;", $strLine);
			$strLine = str_replace("ÃŸ", "&szlig;", $strLine);
			$strLine = str_replace("Ã¤", "&auml;", $strLine);
			$strLine = str_replace("Ã–", "&Ouml;", $strLine);

			if (strpos($strLine, "Verbandszugeh&ouml;rigkeiten")>0) 
			{
				$bStartWriting="FALSE";	
				echo "</TABLE>";
			}
			else 
			{
				echo $strLine.chr(13).chr(10);
	
				// Ende?
				$strLine = strtolower($file[$i]);
	
				if (strpos($strLine, "</table>")>0)
				{
					$i=count($file) + 1;
				}
			}
		}
	}
	
	// Prüfen, ob überhaupt etwas geschriebne worden ist:
	if ($bStartWritingDone == "FALSE")
	{
	    echo "<B>Die DWZ - Liste konnte von der Homepage des deutschen Schachbunds nicht ausgelesen. <BR>M&ouml;glicherweise steht dieser Service derzeit nicht zur Verf&uuml;gung.</B><BR><BR>".chr(13).chr(10);
	}

	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>



























