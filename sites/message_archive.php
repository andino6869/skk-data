<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Wir &uuml;ber uns");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	// Achtung, hier soll alles wieder angezeigt werden, daher 999!
	writeNavigationBar(999, $objDBCon);

	// ##############################################
	// Den aktuellen Modus ermitteln:
	if (isset($_GET["mx"])) 
	{
		$mx = $_GET["mx"];
	}

	if (trim($mx)=="")
	{
		$mx = $_REQUEST["mx"];
	}

	// Welcher Seiteninhalt soll angezeigt werden?
	switch ($mx)
	{
		case "YOUTH":
			echo "<SPAN CLASS=he1>Meldungsarchiv (NEWS - Tabelle), Bereich 'Jugend', Inhalt absteigend sortiert nach Datum</SPAN><BR><BR>".chr(13).chr(10);
			break;

		case "SPORT":
			echo "<SPAN CLASS=he1>Meldungsarchiv (NEWS - Tabelle), Bereich 'SKK - Sport', Inhalt absteigend sortiert nach Datum</SPAN><BR><BR>".chr(13).chr(10);
			break;

		case "AFRO":
			echo "<SPAN CLASS=he1>Meldungsarchiv (NEWS - Tabelle), Bereich 'AFRO', Inhalt absteigend sortiert nach Datum</SPAN><BR><BR>".chr(13).chr(10);
			break;

		default:
			echo "<SPAN CLASS=he1>Meldungsarchiv (NEWS - Tabelle), Bereich 'Erwachsene und Jugend', Inhalt absteigend sortiert nach Datum</SPAN><BR><BR>".chr(13).chr(10);
	}
	$Monat[12]="Dezember";
	$Monat[11]="November";
	$Monat[10]="Oktober";
	$Monat[9]="September";
	$Monat[8]="August";
	$Monat[7]="Juli";
	$Monat[6]="Juni";
	$Monat[5]="Mai";
	$Monat[4]="April";
	$Monat[3]="M&auml;rz";
	$Monat[2]="Februar";
	$Monat[1]="Januar";

	$now = date("Y-m-d H:i:s");
	$curMonth = substr($now,5,2);
	$strSQL = "select * from skk_news WHERE del='N' AND modifieddate IS NULL AND ";

	// Welcher Seiteninhalt soll angezeigt werden?
	switch ($mx)
	{
		case "YOUTH":
			$strSQL = $strSQL."category='Jugend' AND ";
			break;

		case "SPORT":
			$strSQL = $strSQL."category='Sport' AND ";
			break;

		case "AFRO":
			$strSQL = $strSQL."category='AFRO' AND ";
			break;

		default:
			$strSQL = $strSQL."(category='Alle' OR category='Erwachsene' OR category='Jugend' OR category='AFRO') AND ";
	}

	$strSQL = $strSQL."(fadeifdeadlinereached = 'N' OR (fadeifdeadlinereached != 'N' AND newsdate>'".$now."')) ";
	$strSQL = $strSQL."ORDER BY newsdate DESC";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$ID[$i] = $row->id;
			$Datum[$i] = $row->newsdate;
			$Kategorie[$i] = $row->category;
			$Headline[$i] = $row->headline;
			$Headline2[$i] = $row->headline2;
			$Autor[$i] = $row->author;
			$Kurztext[$i] = $row->shorttext;
			$contentid[$i] = $row->contentid;
			$teamid[$i] = $row->teamid;
			$Text[$i] = $row->text;
			$Tabelle[$i] = $row->newstable;
			$Hits[$i] = $row->hits;
			$i++;
		}
	}

	if ($RecordCount==0)
	{
		echo "<SPAN CLASS='red_head'>Es konnten keine Datens&auml;tze aus der News - Tabelle ermittelt werden.</SPAN>".chr(13).chr(10);
	}
	else
	{
		// Marker setzen, dass bisher noch keine Monatsüberschrift ausgegeben worden ist:
		$bSetMonth = "FALSE";

		for($i=0;$i<$RecordCount;$i++)
		{
			// ####################################
			// Die Monatsausgabe überprüfen:
			if ($bSetMonth == "FALSE")
			{
				// Ausgabe des aktuellen Monats:
				echo "<BR><BR><SPAN CLASS='red_head'>".$Monat[(double)substr($Datum[$i],5,2)]." ".substr($Datum[$i],0,4)."</SPAN>".chr(13).chr(10);
				echo "<HR noshade size=1 color='#5B2E00'>".chr(13).chr(10);

				$bSetMonth = "TRUE";
			}

			// Ausgabe der Neuigkeit:
			echo "<table border=0><tr><td width='100%' valign=top>".chr(13).chr(10);

		  	// ####################################
		    	// Welches Icon soll ausgegeben werden?
			if ((trim(strtolower($Kategorie[$i]))=="alle") || (trim(strtolower($Kategorie[$i]))=="erwachsene"))
			{
				echo "<IMG SRC='../pics/icons/thunder.gif' height='10' width='10'>".chr(13).chr(10);
			}
			else
			{
				if (trim(strtolower($Kategorie[$i]))=="afro")
				{
					echo "<IMG SRC='../pics/icons/afro.gif' height='10' width='10'>".chr(13).chr(10);
				}
				else
				{
					if (trim(strtolower($Kategorie[$i]))=="sport")
					{
						echo "<IMG SRC='../pics/icons/sport.gif' height='10' width='10'>".chr(13).chr(10);
					}
					else
					{
						echo "<IMG SRC='../pics/icons/youth.gif' height='10' width='10'>".chr(13).chr(10);
					}
				}
			}

			// ####################################
			// Mit Titel:
  			echo "<a href='message.php?Nr=".$ID[$i]."' title='Kategorie: ".$Kategorie[$i].chr(13).chr(10);

			// ####################################
			// Mit Headline 2?
			if (trim($Headline2[$i]!=""))
			{
				$strItem = formatoutput($Headline2[$i]);
				echo chr(13).chr(10)."Headline 2: ".chr(13).chr(10).$strItem;
			}

			// ####################################
			// Ausgabe der Headline 1:
			$strItem = formatoutput($Headline[$i]);

			echo "'> [".substr($Datum[$i], 8, 2).".".substr($Datum[$i],5,2).".".substr($Datum[$i],0,4)."]  ";
  			echo $strItem."</A>".chr(13).chr(10);
  			echo "</td></tr></table>".chr(13).chr(10);

			// Ausgabe des nächsten Monats für den Fall, dass es noch nachfolgende Datensätze gibt?
			if($i<$RecordCount-1)
  			{
  				// Jahreswechsel?
				if (substr($Datum[$i],0,4) > substr($Datum[$i+1],0,4))
				{
					$bSetMonth = "FALSE";
				}
				else
				{
					// Der nächste Monat?
					if (substr($Datum[$i],5,2) > substr($Datum[$i+1],5,2))
					{
						$bSetMonth = "FALSE";
					}
					else
					{
						// Der Jahreswechsel wurde bis dato vergessen!
						if (substr($Datum[$i],5,2) == "01" && substr($Datum[$i+1],5,2) == "12")
						{
							$bSetMonth = "FALSE";
						}
					}
  				}
			}
		}
	}

	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>





