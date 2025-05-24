<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Jahrbuch");
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

	// 1.) Das Verbindungsobjekt ermitteln:
	$objDBCon = GetCon();

	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon, "FALSE");

	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("_admin_param_ux.php");

	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "R")==0)
	{
		// Keine Gültigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("_admin_param_dx.php");

	// 6.) Ausgabe der Kopfzeile:
    $now = date("Y-m-d");
    $curYear = substr($now,0,4);
    $curMonth = substr($now,5,2);

    // Neue Saison?
    // UPDATE: September soll noch mit zur alten Saison zählen!
    if ($curMonth > 9)
    {
		$YearOne = $curYear;
		$YearTwo = $curYear + 1;
    }
    else
    {
		$YearOne = $curYear - 1;
		$YearTwo = $curYear;
    }

    echo "<SPAN CLASS=he1>Jahresbericht f&uuml;r die Saison ".$YearOne."/".$YearTwo."</SPAN><BR><BR><BR>".chr(13).chr(10);

    // ##################################################################
    // 7.) Daten lesen:
    $strSQL = "select * from skk_news WHERE newsdate>='".(string)$YearOne."-09-01' AND ";
    $strSQL = $strSQL."newsdate<'".(string)$YearTwo."-09-01' AND DEL='N' AND modifieddate IS NULL ";
    $strSQL = $strSQL."ORDER BY newsdate DESC;";

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
	       $Headline[$i] = formatoutput($row->headline);
	       $Headline2[$i] = formatoutput($row->headline2);
	       $Autor[$i] = formatoutput($row->author);
	       $Kurztext[$i] = formatoutput($row->shorttext);
	       $contentid[$i] = $row->contentid;
	       $teamid[$i] = $row->teamid;
	       $Text[$i] = formatoutput($row->text);
	       $Tabelle[$i] = $row->newstable;
	       $Hits[$i] = $row->hits;
	       $picture[$i] =$row->picture;
	       $creator[$i] =$row->creator;
	       $i++;
	    }

	    // 8.) Die Monatsintervalle:
	    $Monat[12]="Dezember";
	    $Monat[11]="November";
	    $Monat[10]="Oktober";
	    $Monat[9]="September";
	    $Monat[8]="August";
	    $Monat[7]="Juli";
	    $Monat[6]="Juni";
	    $Monat[5]="Mai";
	    $Monat[4]="April";
	    $Monat[3]="März";
	    $Monat[2]="Februar";
	    $Monat[1]="Januar";
	
	    // 6.) Für das erste Datum den ersten Eintrag erstellen:
	    echo "<SPAN CLASS='red_head'>".$Monat[(double)substr($Datum[0],5,2)]." ".substr($Datum[0],0,4)."</SPAN>".chr(13).chr(10);
	    echo "<HR noshade size=1 color='#5B2E00'><BR>".chr(13).chr(10);


	    // 7.) Daten ausgeben:
	    for($i=0;$i<$RecordCount;$i++)
	    {
		  // 8.) Daten ausgeben:
		  // Kopfzeile:
		  echo "<SPAN CLASS=he1>".formatoutput($Headline[$i])."</SPAN><BR><BR>".chr(13).chr(10);
	
		  // ##########################
		  // Hat dieses Event ein Bild?
		  if($picture[$i]!="")
		  {
			if (is_file("pics/".$picture[$i]))
			{
				echo "<p align='left'><IMG SRC='pics/$picture[$i]' width='150' height='150'></p>".chr(13).chr(10);
			}
		 }

	  	// ######
	  	// Autor:
        echo "<I>Bericht von ".$Autor[$i];
	  	echo " vom ".substr($Datum[$i], 8, 2).".".substr($Datum[$i],5,2).".".substr($Datum[$i],0,4);

	  	// ###############################################################
	  	// Gab es zwischenzeitlich eine Änderung an der Meldung durch eine
	  	// andere Person?
	  	if (strtolower(trim($Autor[$i])) != strtolower(trim($creator[$i])) && (trim($creator[$i]) != ""))
        {
    		// Stammt diese Änderung von der Altdatenübernahme???
	    	if (strtoupper(trim($creator[$i])) != "ALTDATENÜBERNAHME PROWIDE")
    		{
    			echo ", zuletzt ge&auml;ndert von: ".trim($creator[$i])." (am ";
	    		echo substr($createdate[$i], 8, 2).".".substr($createdate[$i],5,2).".".substr($createdate[$i],0,4).")".chr(13).chr(10);
    		}
	   }

	  echo "</I><BR><BR>".chr(13).chr(10);
	  echo "<SPAN CLASS=he2>".formatoutput($Headline2[$i])."</SPAN><BR><BR>".chr(13).chr(10);

      // 9.) Hat dieses Event ein Mannschaftsobjekt?
      if($teamid[$i]!="")
      {
        // Die Tabellendaten ermitteln:
        $strSQL = "SELECT * FROM skk_teams WHERE id=".$teamid[$i]." AND del='N' AND modifieddate IS NULL;";
        
        $rsTeams = mysqli_query($objDBCon, $strSQL);
        $RecordCountTeams = mysqli_num_rows($rsTeams);
        
        // Konnte ein Datensatz gefunden werden?
        if ($RecordCountTeams > 0 )
        {
        	$j = 0;
			
			while ($rowTeams = $rsTeams->fetch_object())
			{
	            $ID[$j] = $rowTeams->id;
	            $team[$j] = formatoutput($rowTeams->team);
	            $league[$j] = formatoutput($rowTeams->league);
	            $j++;
          	}

          	echo "<BR><BR>Betrifft Mannschaft: ".$team[0]." (".$league[0].")<BR><BR>".chr(13).chr(10);
        }
      }

      // 10.) Hat dieses Event ein Inhaltsobjekt?
      if($contentid[$i]!="")
      {
        // Die Tabellendaten ermitteln:
        $strSQL = "SELECT * FROM skk_content WHERE id=".$contentid[$i]." AND del='N' AND modifieddate IS NULL;";

        $rsContent = mysqli_query($objDBCon, $strSQL);
        $RecordCountContent = mysqli_num_rows($rsContent);

        // Konnte ein Datensatz gefunden werden?
        if ($RecordCountContent > 0 )
        {
        	$j = 0;
			
			while ($rowContent = $rsContent->fetch_object())
			{
	            $ID[$j] = $rowContent->id;
	            $Datum[$j] = $rowContent->contentdate;
	            $Titel[$j] = $rowContent->title;
	            $Kategorie[$j] = $rowContent->category;
	            $Content[$j] = $rowContent->content;
	            $j++;
          	}

		  $strItem = formatoutput($Content[0]);
          echo "<BR><BR>".$Content[0]."<BR><BR>";
        }
      }

      // 11.) Ausgabe des Textes:
      $strItem = formatoutput($Text[$i]);

      echo "<DIV ALIGN=JUSTIFY>".$strItem."</DIV><BR><BR>".chr(13).chr(10);

	// ###################
      // 12.) Monatswechsel?
        if($i<$RecordCount-2)
      {
        // Der nächste Monat?
        //echo substr($Datum[$i],5,2) ." > ".substr($Datum[$i+1],5,2);

        if (substr($Datum[$i],5,2) < substr($Datum[$i+1],5,2))
        {
          echo "<SPAN CLASS='red_head'> ".$Monat[substr($Datum[$i],5,2)+1]." ".substr($Datum[$i],0,4)."</SPAN><HR noshade size=1 color='#5B2E00'><BR>".chr(13).chr(10);
        }
        else
        {
          // UPDATE Schneider 05.05.2008
          // Der Jahreswechsel wurde bis dato vergessen!
          if (substr($Datum[$i],5,2) == "01" && substr($Datum[$i+1],5,2) == "12")
          {
            echo "<SPAN CLASS='red_head'> Dezember ".substr($Datum[$i+1],0,4)."</SPAN><HR noshade size=1 color='#5B2E00'><BR>".chr(13).chr(10);
          }
          // UPDATE Ende
        }
      }
    }
  }
  else
  {
    echo "Es konnten keine Daten aus Datenbank gelesen werden.<BR>".chr(13).chr(10);
  }

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>















