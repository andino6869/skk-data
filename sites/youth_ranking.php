<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Jugend DWZ Rangliste");
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
	writeNavigationBar(999, $objDBCon);
	// UPDATE Ende
?>

<SPAN CLASS=he1>Jugendschach</SPAN><BR><BR>
<SPAN CLASS=he2>Alle Jugendliche im Verein (mit und ohne offizielle DWZ-Zahl)</SPAN><BR><BR>

<?php
	  // UPDATE Schneider 06.05.2008:
	  // Daten aus der Mitgliederdatenbank mit denen des deutschen Schachbund abgleichen.

	  // 1.) Datei mit den Inhalten des deutschen Schachbunds holen:
	  if (IsUrlAvailable("schachbund.de")=="TRUE")
	  {
	    $f="http://www.schachbund.de/dwz/db/verein-prn.html?zps=27113";
	    $strModus = "NET";

	    // Den aktuelle Stand lokal in das DWZ - Verzeichnis sichern:
	    $strContent = implode("", file("http://www.schachbund.de/dwz/db/verein-prn.html?zps=27113"));
	    $f1 = fopen("dwz/dwz.htm", "w");
	    fputs($f1, $strContent);
	    fclose($f1);
	  }
	  else
	  {
	    $strModus = "LOCAL";
	    echo "<B>Die aktuelle DWZ - Liste wurde lokal ausgelesen und ist möglicherweise veraltet!</B><BR><BR>".chr(13).chr(10);
	  }

	  // 2.) Inhalt aus der Datei in ein Array einlesen:
	  $f="dwz/dwz.htm";
	  $file=file ($f);

	  // 3.) Daten aus der Mitgliederdatenbank holen:
	  // Dabei brauchen wir nur Jugendliche, also Personen, die jünger als 20
	  // Jahre sind.
	  $curYear = substr(date("Y-m-t"),0,4);
	  $curMonth = substr(date("Y-m-t"),5,2);
	  $curYear = $curYear - 20;

	  $strSQL = "select * from skk_members WHERE birthdate>'".(string)$curYear."-".(string)$curMonth."-01' AND del='N' AND modifieddate IS NULL ORDER BY Name DESC";
	  $rs = mysqli_query($objDBCon, $strSQL);
	  $RecordCount = mysqli_num_rows($rs);

	  // 4.) Konnten Datensätze gefunden werden?
	  if ($RecordCount > 0)
	  {
	    // 4.1.) Den Tabellenkopf schreiben:
		echo "<table border='0' width='100%'>".chr(13).chr(10);
		echo "<tr>".chr(13).chr(10);
	    echo "<td width='25%' bgcolor='#C0C0C0'><p align='left'>Spielername:</p></td>".chr(13).chr(10);
	    echo "<td width='25%' bgcolor='#C0C0C0'><p align='center'>Jahrgang:</td>".chr(13).chr(10);
	    echo "<td width='15%' bgcolor='#C0C0C0'><p align='center'>DWZ:</p></td>".chr(13).chr(10);
	    echo "<td width='10%' bgcolor='#C0C0C0'><p align='center'>ELO:</p></td>".chr(13).chr(10);
	    echo "<td width='10%' bgcolor='#C0C0C0'><p align='center'>Titel:</p></td>".chr(13).chr(10);
	    echo "<td width='15%' bgcolor='#C0C0C0'><p align='center'>Bild:</p></td>".chr(13).chr(10);
	  	echo "</tr>".chr(13).chr(10);

	    // #####################################
	    // Die Daten aus der Datenbank ausgeben:
	  	$i = 0;
	  		
	  	while ($row = $rs->fetch_object())
	  	{
	  		$Name[$i] = $row->name;
	  		$Vorname[$i] = $row->vorname;
	  		$Geburtsdatum[$i] = $row->birthdate;
	  		$DWZ[$i] = $row->dwz;
	  		$ELO[$i] = $row->elo;
	  		$Titel[$i] = $row->title;
	  		$Bild[$i] = $row->picture;

		    // Die DWZ ermitteln:
		    $dwz="-";

	      	// Den Dateiinhalt nach dem aktuellen Namen durchsuchen:
		    for($j=0;$j<=count($file)-1;$j++)
		    {
	      	  // Den Namen gefunden?
		        if (strpos($file[$j], $Name[$i])>0 && strpos($file[$j], $Vorname[$i])>0)
		        {
	      	    	// Die Zeile mit der DWZ - Zahl auslesen:
		          	$dwz=$file[$j + 3];

		          	// Nicht gebrauchte Zeichen entfernen:
	      	    	$dwz = str_replace("<td class=\"dwz_tabzeile\"", "", $dwz);
		          	$dwz = str_replace("align=\"center\"", "", $dwz);
		          	$dwz = str_replace("nowrap>", "", $dwz);
		          	$dwz = str_replace("&nbsp;&nbsp;", " ", $dwz);
		          	$dwz = str_replace("  ", " ", $dwz);
		          	$dwz = str_replace("</td>", "", $dwz);

					// Schleife verlassen:
	      	    	$j=count($file);
		        }
		    }

	        if($i%2==0) { echo "<TR bgcolor=\"#eeeeee\">"; }
	        if($i%2==1) { echo "<TR bgcolor=\"#fefefe\">"; }
	        echo "<td align='left'>".$Name[$i].", ".$Vorname[$i]."</td>".chr(13).chr(10);
	        echo "<td align='center'>".substr($Geburtsdatum[$i],0,4)."</td>".chr(13).chr(10);

	        if (($dwz=="-") || (trim($dwz)==""))
	        {
	        	echo "<td align='center'>".$dwz[$i]."</td>".chr(13).chr(10);
	        }
	        else
	        {
	        	echo "<td align='center'>".$dwz."</td>".chr(13).chr(10);
	        }

		    echo "<td align='center'>".substr($ELO[$i],0,4)."</td>".chr(13).chr(10);
		    echo "<td align='center'>".substr($Titel[$i],0,4)."</td>".chr(13).chr(10);

		    if (is_file("../admin/members/pics/".$Bild[$i]))
		    {
				echo "<td><p align='center'><IMG SRC='../admin/members/pics/".$Bild[$i]."' width='75' height='75'></p></td>".chr(13).chr(10);
		    }
		    else
		    {
				echo "<td>&nbsp;</td>".chr(13).chr(10);
		    }

	      	echo "</tr>".chr(13).chr(10);
	      	$i++;
	    }
	    echo "</TABLE>".chr(13).chr(10);
	  }
	  else
	  {
	    echo "Es sind derzeit keine Datensätze hinterlegt.".chr(13).chr(10);
	  }

	  include("../includes/forms/middler.php");
	  include("../includes/db/deadlines_shortview.php");

	  get_deadlines_shortview($objDBCon);
	  echo "<BR><BR><BR><BR>".chr(13).chr(10);

	  include("../includes/forms/downloads.php");
	  get_downloads($objDBCon);
	  include("../includes/forms/footer.php");
?>






























