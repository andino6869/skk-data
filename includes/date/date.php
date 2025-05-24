<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	function writeDateField($strNameDay, $strNameMonth, $strNameYear, $strDefaultDay, $strDefaultMonth, $strDefaultYear, $AllowNullValue = "FALSE", $AllowUnlimitedTimeValue = "FALSE")
	// Schreibt die Objekte für die Eingabe eines Datumwerts (z.B. bei Uploads oder für einen Bericht.
	{
		// Standardwerte festlegen:
		if (trim($strDefaultDay)=='')
		{
			$strDefaultDay="1";
		}

		if (trim($strDefaultMonth)=='')
		{
			$strDefaultMonth="1";
		}

		$curYear = substr(date("Y-m-t"),0,4);

		if (trim($strDefaultYear)=='')
		{
			$strDefaultYear=$curYear;
		}

		// ##################
		// Den Tag schreiben:
		echo "<SELECT NAME=$strNameDay>";

		if ($AllowNullValue == "TRUE")
		{
			if ($strDefaultDay == "-")
			{
				echo "<OPTION Value='-' SELECTED> -";
			}
			else
			{
				echo "<OPTION Value='-'> -";
			}
		}

		for ($i=1;$i<32;$i++)
		{
			if ($i==$strDefaultDay)
			{
				echo "<OPTION Value='$i' SELECTED> $i";
			}
			else
			{
				echo "<OPTION Value='$i'> $i";
			}
		}
		echo "</SELECT>.";

		// ####################
		// Den Monat schreiben:
		echo "<SELECT NAME=$strNameMonth>";

		if ($AllowNullValue == "TRUE")
		{
			if ($strDefaultMonth == "-")
			{
				echo "<OPTION Value='-' SELECTED> -";
			}
			else
			{
				echo "<OPTION Value='-'> -";
			}
		}

		for ($i=1;$i<13;$i++)
		{
			if ($i==$strDefaultMonth)
			{
				echo "<OPTION Value='$i' SELECTED> $i";
			}
			else
			{
				echo "<OPTION Value='$i'> $i";
			}
		}
		echo "</SELECT>.";

		// ###################
		// Das Jahr schreiben:
		echo "<SELECT NAME=$strNameYear>";

		if ($AllowNullValue == "TRUE")
		{
			if ($strNameYear == "-")
			{
				echo "<OPTION Value='-' SELECTED> -";
			}
			else
			{
				echo "<OPTION Value='-'> -";
			}
		}

		// ######################################################################################
		// Hier prüfen, ob auch ein unbegrenztes Zeitintervall mit hinterlegt werden können soll.
		$intUBound =0;
		
		if ($AllowUnlimitedTimeValue == "TRUE")
		{
			$intUBound = 100;
		}
		else
		{
			$intUBound = 2;
		}
		
		for ($i=$curYear-5;$i<$curYear+$intUBound;$i++)
		{
			if ($i==$strDefaultYear)
			{
				echo "<OPTION Value='$i' SELECTED> $i";
			}
			else
			{
				echo "<OPTION Value='$i'> $i";
			}
		}
		echo "</SELECT>";
	}




	function s_datediff($str_interval, $dt_menor, $dt_maior, $relative=false)
	{

       		if( is_string( $dt_menor)) $dt_menor = date_create( $dt_menor);
      		 if( is_string( $dt_maior)) $dt_maior = date_create( $dt_maior);

       		$diff = date_diff( $dt_menor, $dt_maior, ! $relative);
       
	       	switch( $str_interval)
		{
	           case "y": 
        	       $total = $diff->y + $diff->m / 12 + $diff->d / 365.25; break;
        	   case "m":
	               $total= $diff->y * 12 + $diff->m + $diff->d/30 + $diff->h / 24;
        	       break;
	           case "d":
        	       $total = $diff->y * 365.25 + $diff->m * 30 + $diff->d + $diff->h/24 + $diff->i / 60;
	               break;
        	   case "h": 
               		$total = ($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h + $diff->i/60;
               		break;
	           case "i": 
        	       $total = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i + $diff->s/60;
	               break;
        	  case "s": 
	               $total = ((($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i)*60 + $diff->s;
        	       break;
	      }
	       if( $diff->invert)
        	       return -1 * $total;
	       else    return $total;
   	}




	function writeDateFieldBirthday($strNameDay, $strNameMonth, $strNameYear, $strDefaultDay, $strDefaultMonth, $strDefaultYear, $AllowNullValue = "FALSE")
	{
		// Standardwerte festlegen:
		if (trim($strDefaultDay)=='')
		{
			$strDefaultDay="1";
		}

		if (trim($strDefaultMonth)=='')
		{
			$strDefaultMonth="1";
		}

		$curYear = substr(date("Y-m-t"),0,4);

		if (trim($strDefaultYear)=='')
		{
			$strDefaultYear=$curYear;
		}

		// Den Tag schreiben:
		echo "<SELECT NAME=$strNameDay>";

		if ($AllowNullValue == "TRUE")
		{
			if ($strDefaultDay == "-")
			{
				echo "<OPTION Value='-' SELECTED> -";
			}
			else
			{
				echo "<OPTION Value='-'> -";
			}
		}

		for ($i=1;$i<32;$i++)
		{
			if ($i==$strDefaultDay)
			{
				echo "<OPTION Value='$i' SELECTED> $i";
			}
			else
			{
				echo "<OPTION Value='$i'> $i";
			}
		}
		echo "</SELECT>.";

		// Den Monat schreiben:
		echo "<SELECT NAME=$strNameMonth>";

		if ($AllowNullValue == "TRUE")
		{
			if ($strDefaultMonth == "-")
			{
				echo "<OPTION Value='-' SELECTED> -";
			}
			else
			{
				echo "<OPTION Value='-'> -";
			}
		}

		for ($i=1;$i<13;$i++)
		{
			if ($i==$strDefaultMonth)
			{
				echo "<OPTION Value='$i' SELECTED> $i";
			}
			else
			{
				echo "<OPTION Value='$i'> $i";
			}
		}
		echo "</SELECT>.";

		// Das Jahr schreiben:
		echo "<SELECT NAME=$strNameYear>";

		// Die letzten 100 Jahre anzeigen:
		$curTmpYear = $curYear - 100;

		if ($AllowNullValue == "TRUE")
		{
			if ($curYear == "-")
			{
				echo "<OPTION Value='-' SELECTED> -";
			}
			else
			{
				echo "<OPTION Value='-'> -";
			}
		}

		for ($i=$curYear-1;$i>$curTmpYear+2;$i--)
		{
			if ($i==$strDefaultYear)
			{
				echo "<OPTION Value='$i' SELECTED> $i";
			}
			else
			{
				echo "<OPTION Value='$i'> $i";
			}
		}
		echo "</SELECT>";
	}


	function getHolidayTable($objDBCon, $intYear)
	{
		// Berechnet für das übergebene Jahr die Feiertagstabelle und gibt
		// diese als Array zurück:
	    	    
		// Ostern berechnen:
	    // $timestamp = easter_date($intYear);
	    // Geht seit 11.09.2023 nicht mehr.
	    // Ostern muss daher mit eigenem Algorythmus berechnet werden.
	    //echo "Jahr: ".$intYear.". ";
	    
	    // Bei der bisherigen Funktion gab es im Jahr 2025 falsche Angaben zu den beweglichen Feiertagen!!!
	    if ($intYear == 2025)
	    {
	        $timestamp = strtotime("2025-04-20");	        
	    }
	    else 
	    {
	        $timestamp = getEasterSunday($intYear);
	        // 31.03.2024 bzw. 20.04.2025
	    }
	    $easterDate = date("Y-m-d",  $timestamp);
	    //echo "EEE".$easterDate."EEE";
	    
		// Karfreitag berechnen (beweglicher Feiertag; 2 Tage vor Ostern)
		$rs = mysqli_query ($objDBCon, "SELECT DATE_ADD('".$easterDate."', INTERVAL -2 DAY)");
		$RecordCount = mysqli_num_rows($rs);

		// Wurden Datensätze gefunden?
		if ($RecordCount > 0)
		{
			$row = $rs->fetch_row();
			$Karfreitag = $row[0];
		}

		// Ostersonntag
		// Ostermontag berechnen (beweglicher Feiertag; 1 Tag nach Ostern)
		$rs = mysqli_query ($objDBCon, "SELECT DATE_ADD('".$easterDate."', INTERVAL 1 DAY)");
		$RecordCount = mysqli_num_rows($rs);

		// Wurden Datensätze gefunden?
		if ($RecordCount > 0)
		{
			$row = $rs->fetch_row();
			$Ostermontag = $row[0];
		}

		// Christi Himmelfahrt berechnen (beweglicher Feiertag; 39 Tage nach Ostern)
		$rs = mysqli_query ($objDBCon, "SELECT DATE_ADD('".$easterDate."', INTERVAL 39 DAY)");
		$RecordCount = mysqli_num_rows($rs);

		// Wurden Datensätze gefunden?
		if ($RecordCount > 0)
		{
			$row = $rs->fetch_row();
			$ChristiHimmelfahrt = $row[0];
		}

		// Pfingstsonntag berechnen (beweglicher Feiertag; 49 Tage nach Ostern)
		$rs = mysqli_query ($objDBCon, "SELECT DATE_ADD('".$easterDate."', INTERVAL 49 DAY)");
		$RecordCount = mysqli_num_rows($rs);

		// Wurden Datensätze gefunden?
		if ($RecordCount > 0)
		{
			$row = $rs->fetch_row();
			$Pfingstsonntag = $row[0];
		}

		// Pfingstmontag berechnen (beweglicher Feiertag; 50 Tage nach Ostern)
		$rs = mysqli_query ($objDBCon, "SELECT DATE_ADD('".$easterDate."', INTERVAL 50 DAY)");
		$RecordCount = mysqli_num_rows($rs);

		// Wurden Datensätze gefunden?
		if ($RecordCount > 0)
		{
			$row = $rs->fetch_row();
			$Pfingstmontag = $row[0];
		}

		// Fronleichnam berechnen (beweglicher Feiertag; 60 Tage nach Ostern)
		$rs = mysqli_query ($objDBCon, "SELECT DATE_ADD('".$easterDate."', INTERVAL 60 DAY)");
		$RecordCount = mysqli_num_rows($rs);

		// Wurden Datensätze gefunden?
		if ($RecordCount > 0)
		{
			$row = $rs->fetch_row();
			$Fronleichnam = $row[0];
		}

		$ret = array
		(
			// Die festen Feiertage:
			// Neujahr setzen (fester Feiertag am 1. Januar):
			$intYear."-01-01  Neujahr",

			// Hl. Drei Könige setzen (fester Feiertag am 6. Januar)
			$intYear."-01-06  Hl. Drei K&ouml;nige",

			// Maifeiertag setzen (fester Feiertag am 1. Mai)
			$intYear."-05-01  Maifeiertag",

			// Augsburger Friedensfest:
			$intYear."-08-08  Augsburger Friedensfest",

			// Mariä Himmelfahrt setzen (fester Feiertag am 15. August)
			$intYear."-08-15  Mari&auml; Himmelfahrt",

			// Tag der deutschen Einheit setzen (fester Feiertag am 3. Oktober)
			$intYear."-10-03  Tag der deutschen Einheit",

			// Reformationstag setzen (fester Feiertag am 31. Oktober)
			$intYear."-10-31  Reformationstag",

			// Allerheiligen setzen (fester Feiertag am 1. November)
			$intYear."-11-01  Allerheiligen",

			// Heiligabend setzen (fester 'Feiertag' am 24. Dezember)
			$intYear."-12-24  Heiligabend",

			// Erster Weihnachtstag setzen (fester 'Feiertag' am 25. Dezember)
			$intYear."-12-25  Erster Weihnachtstag",

			// Zweiter Weihnachtstag setzen (fester 'Feiertag' am 26. Dezember)
			$intYear."-12-26  Zweiter Weihnachtstag",

			// Sylvester setzen (fester 'Feiertag' am 31. Dezember)
			$intYear."-12-31  Sylvester",

			// Jetzt die beweglichen Feiertage:
			// UPDATE 22.07.2015:
			// Nicht gebräuchliche Feiertage entfernen:
			// $Rosenmontag."  Rosenmontag",
			// $Aschermittwoch."  Aschermittwoch",
			// UPDATE Ende

			$easterDate."  Ostersonntag",
			$Ostermontag."  Ostermontag",
			$Karfreitag ."  Karfreitag ",
			$ChristiHimmelfahrt."  Christi Himmelfahrt",
			$Pfingstsonntag."  Pfingstsonntag",
			$Pfingstmontag."  Pfingstmontag",
			$Fronleichnam."  Fronleichnam"
		);

		/*for ($i=0; $i<sizeof($ret); $i++)
		{
		  echo $ret[$i]."<BR>";
		}*/

		return $ret;
	}
	
	function getEasterSunday($intYear)
	// ###############################################################################
	// Berechnet (alternativ zur PHP-Funktion easter_date) das Datum des Ostersonntags
	// und gibt dieses zurück.
	// Erstellungsdatum: 11.09.2023
	// ###############################################################################
	{
	    
	    $J = date ("Y", mktime(0, 0, 0, 1, 1, $intYear));
	    
	    $a = $J % 19;
	    $b = $J % 4;
	    $c = $J % 7;
	    $m = number_format (8 * number_format ($J / 100) + 13) / 25 - 2;
	    $s = number_format ($J / 100 ) - number_format ($J / 400) - 2;
	    $M = (15 + $s - $m) % 30;
	    $N = (6 + $s) % 7;
	    $d = ($M + 19 * $a) % 30;
	    
	    if ($d == 29) 
	    {
	        $D = 28;
	    } else if ($d == 28 and $a >= 11) {
	        $D = 27;
	    } else {
	        $D = $d;
	    }
	    
	    $e = (2 * $b + 4 * $c + 6 * $D + $N) % 7;	    	    
	    $easter = mktime (0, 0, 0, 3, 21, $J) + (($D + $e + 1) * 86400);
	    
	    return $easter;
	}
?>


