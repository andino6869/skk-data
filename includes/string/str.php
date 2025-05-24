<?PHP

	function intCountStringElement($strContent, $strSearch)
	{
		$intCount = 0;
		$strCurrentString = "";

		for ($intI=0; $intI<strlen($strContent); $intI++)
		{
			// Zeichenkette um ein Element erweitern:
			$strCurrentString  = $strCurrentString.$strContent[$intI];

			// Nach dem Element suchen:
			$intPos = strpos($strCurrentString, $strSearch);

			if ($intPos !== false)
			{
				// Element wurde einmal mehr gefunden:
				$intCount ++;
				$strCurrentString = "";
			}
		}

		return $intCount;
	}

	function strReplaceRNInMemoField($strFieldContent)
	{
		// Verarbeitet \r\n's zuerst, so dass sie nicht doppelt konvertiert werden
		$order   = array("\r\n", "\n", "\r");
		$strFieldContent = str_replace($order, "<BR>", $strFieldContent);
		$strFieldContent = str_replace(" />", ">", $strFieldContent);
		//$strFieldContent = str_replace(" ", "&nbsp;", $strFieldContent);
		return $strFieldContent;
	}

	function strCheckMemoFieldContent($strFieldContent, $Fieldname)
	{
		// Prüft den Inhalt eines Memofeldes und gibt entsprechende Fehlermeldungen zurück:
		// Bei Rückgabe = "" gab es keine Fehler!
		$strTmp = strtolower($strFieldContent);
		$strRet ="";

		// ####################
		// Die HTML - TAGS prüfen:
		// HTML
		$pos=strpos($strTmp , "<html>");

		if (!($pos === false))
		{
			$strRet =$strRet."Das Feld ". $Fieldname." beinhaltet einen beginnenden HTML - Tag.<BR>";
		}

		$pos=strpos($strTmp , "</html>");

		if (!($pos === false))
		{
			$strRet =$strRet."Das Feld ". $Fieldname." beinhaltet einen endenden HTML - Tag.<BR>";
		}

		// BODY:
		$pos=strpos($strTmp , "<body>");

		if (!($pos === false))
		{
			$strRet =$strRet."Das Feld ". $Fieldname." beinhaltet einen beginnenden BODY - Tag.<BR>";
		}

		$pos=strpos($strTmp , "</body>");

		if (!($pos === false))
		{
			$strRet =$strRet."Das Feld ". $Fieldname." beinhaltet einen endenden BODY - Tag.<BR>";
		}

		// TITLE:
		$pos=strpos($strTmp , "<title>");

		if (!($pos === false))
		{
			$strRet =$strRet."Das Feld ". $Fieldname." beinhaltet einen beginnenden TITLE - Tag.<BR>";
		}

		$pos=strpos($strTmp , "</title>");

		if (!($pos === false))
		{
			$strRet =$strRet."Das Feld ". $Fieldname." beinhaltet einen endenden TITLE - Tag.<BR>";
		}


		// Anzahl der TABLE - Tags:
		$intOpen = 0;
		$intClose = 0;

		// ##################
		// UPDATE 23.10.2015:
		// Bei einer TABLE können auch Formatierungsinformationen mit hinterlegt sein,
		// weswegen die Anzahl dann nicht stimmen kann!
		$intOpen = intCountStringElement($strTmp, "<table");
		$intClose = intCountStringElement($strTmp, "</table");
		// UPDATE ENDE
		// ###########

		if ($intOpen != $intClose)
		{
			$strRet =$strRet."Die Anzahl der offenen und geschlossenen TABLE - Tag stimmen im Feld ". $Fieldname." nicht überein.<BR>";
		}
		return $strRet;
	}


	function strRPICHR($strEntry)
	// Replace function for all illegal characters for
	// the parameter string.
   	{
		$strEntry = str_replace("<", " ", $strEntry);
		$strEntry = str_replace(";", " ", $strEntry);
		$strEntry = str_replace(chr(34), " ", $strEntry);
		$strEntry = str_replace(">", " ", $strEntry);
		$strEntry = str_replace("#", " ", $strEntry);
		$strEntry = str_replace("'", " ", $strEntry);
		$strEntry = str_replace("/", " ", $strEntry);

		$strEntry = mysql_escape_string($strEntry);

		$strEntry = trim($strEntry);
		return $strEntry;
	}


	function strReplaceHTMLTAGS($objDBCon, $strEntry)
	// Replace function for all illegal characters for
	// the parameter string.
   	{
   		$strEntry = str_replace("<HTML>", "", $strEntry);
   		$strEntry = str_replace("</HTML>", "", $strEntry);
   		$strEntry = str_replace("www", "", $strEntry);
   		$strEntry = str_replace("WWW", "", $strEntry);
   		$strEntry = str_replace("http", "", $strEntry);
   		$strEntry = str_replace("Http", "", $strEntry);
   		$strEntry = str_replace("HTtp", "", $strEntry);
   		$strEntry = str_replace("HTTp", "", $strEntry);
   		$strEntry = str_replace("HTTP", "", $strEntry);
		$strEntry = str_replace("<", "&lt;", $strEntry);
		$strEntry = str_replace(chr(34), " ", $strEntry);
		$strEntry = str_replace(">", "&gt;", $strEntry);
		$strEntry = str_replace("#", " ", $strEntry);
		$strEntry = str_replace("&", "&amp;", $strEntry);

		// Die Umlaute:
		$strEntry = str_replace("ä", "&auml;", $strEntry);
		$strEntry = str_replace("Ä", "&Auml;", $strEntry);
		$strEntry = str_replace("ö", "&ouml;", $strEntry);
		$strEntry = str_replace("Ö", "&Ouml;", $strEntry);
		$strEntry = str_replace("ü", "&uuml;", $strEntry);
		$strEntry = str_replace("Ü", "&Uuml;", $strEntry);
		$strEntry = str_replace("ß", "&szlig;", $strEntry);

		//$strEntry = mysqli_escape_string($objDBCon, $strEntry);
		
		// Zeilenumbrüche:
		$strEntry = str_replace("\\r\\n", "<BR>", $strEntry);
		$strEntry = str_replace("\r\n", "<BR>", $strEntry);
		$strEntry = str_replace("\n", "<BR>", $strEntry);
		$strEntry = str_replace("\r", "<BR>", $strEntry);

		$strEntry = str_replace("mailto:", "", $strEntry);

		$strEntry = trim($strEntry);
		return $strEntry;
	}



	function bCheckIllegalStatements($strStatement)
	{
		// Prüft den Inhalt auf unzulässige Worte ab und
		// gibt True zurück, wenn solche vorhanden sind, ansonsten False.
		// 1. Alles verkleinern:
		$str = strtolower($strStatement);

		// Eine Maskierung der einzelnen Begriffe verhindern:
		$str = str_replace(".", "", $str);
		$str = str_replace("-", "", $str);
		$str = str_replace("%", "", $str);
		$str = str_replace(",", "", $str);
		$str = str_replace("_", "", $str);
		$str = str_replace(" ", "", $str);
		$str = str_replace("!", "", $str);
		$str = str_replace("?", "", $str);
		$str = str_replace(";", "", $str);
		$str = str_replace(":", "", $str);
		$str = str_replace("#", "", $str);

		// 2.) Die Werte suchen:
		// Bereich: Wixer
		$pos=strpos($str, "fixer");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "fixxer");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "wixer");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "wixxer");

		if (!($pos === false))
		{
			return true;
		}

		// Bereich: Depp:
		$pos=strpos($str, "depp");

		if (!($pos === false))
		{
			return true;
		}

		// Bereich: Arschloch:
		$pos=strpos($str, "arschloch");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "@rschloch");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "ashhole");

		if (!($pos === false))
		{
			return true;
		}

		// Bereich: Idiot
		$pos=strpos($str, "idiot");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "fick");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "fuck");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "sackgesicht");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "befruchter");

		if (!($pos === false))
		{
			return true;
		}

		// Schänder:
		$pos=strpos($str, "schänder");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "sch&auml;nder");

		if (!($pos === false))
		{
			return true;
		}

		// Bereich Blödmann:
		$pos=strpos($str, "blödmann");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "bl&ouml;dmann");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "drecksack");

		if (!($pos === false))
		{
			return true;
		}

		// Rechte Szene:
		$pos=strpos($str, "hitler");

		if (!($pos === false))
		{
			return true;
		}

		// Sex:
		$pos=strpos($str, "sex");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "porno");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "dildo");

		if (!($pos === false))
		{
			return true;
		}
		return false;
	}



	function bCheckEnglishStatements($strStatement, $allowAT = 'FALSE')
	{
		// Prüft den Inhalt auf unzulässige englische Worte ab und
		// gibt True zurück, wenn solche vorhanden sind, ansonsten False.
		// 1. Alles verkleinern:
		$str = strtolower($strStatement);

		// 2.) Die Werte suchen:
		// Bereich: of
		$pos=strpos($str, " of ");

		if (!($pos === false))
		{
			return true;
		}

		// ###############################################
		// Anpassung wegen E-Mail von Lothar am 30.12.2022
		/*$pos=strpos($str, " off");

		if (!($pos === false))
		{
			return true;
		}*/
		// ################################################

		$pos=strpos($str, " my ");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, " body ");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, " awe ");

		if (!($pos === false))
		{
			return true;
		}

		// Bereich "if"
		$pos=strpos($str, " if ");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "if ");

		if (!($pos === false))
		{
			return true;
		}

		// Bereich "When":
		$pos=strpos($str, "when");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, " when ");

		if (!($pos === false))
		{
			return true;
		}
		
		$pos=strpos($str, "shit");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, " you ");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, " suck ");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, " sucker ");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, " to ");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, " want ");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, " respected ");

		if (!($pos === false))
		{
			return true;
		}

		// ################################
		// Bereich URL:
		// Achtung! Burlafingen als Stadt berücksichtigen! Daher nicht direkt auf URL prüfen!
		$pos=strpos($str, " url:");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, ".com");

		if (!($pos === false))
		{
			return true;
		}
		
		$pos=strpos($str, "href");

		if (!($pos === false))
		{
			return true;
		}


		if ($allowAT=="FALSE")
		{
			$pos=strpos($str, "@");

			if (!($pos === false))
			{
				return true;
			}
		}

		$pos=strpos($str, "mailto");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "http");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "\\");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "//");

		if (!($pos === false))
		{
			return true;
		}

		// #########################
		// Neuer Bereich:
		$pos=strpos($str, " time ");

		if (!($pos === false))
		{
			return true;
		}

		$pos=strpos($str, "automatic");

		if (!($pos === false))
		{
			return true;
		}

		// ##################
		// UPDATE 15.02.2017:
		// Automatisierter Angriff auf Weihnachtsopenbericht 2016
		$pos=strpos($str, "hello");
		
		if (!($pos === false))
		{
			return true;
		}
		// UPDATE ENDE
		// ###########
		return false;
	}


	function formatoutput($strEntry)
	{
		// #######################
		// Deutsche Sonderzeichen:
		$strEntry = str_replace("ä", "&auml;", $strEntry);
		$strEntry = str_replace("Ä", "&Auml;", $strEntry);
		$strEntry = str_replace("ö", "&ouml;", $strEntry);
		$strEntry = str_replace("Ö", "&Ouml;", $strEntry);
		$strEntry = str_replace("ü", "&uuml;", $strEntry);
		$strEntry = str_replace("Ü", "&Uuml;", $strEntry);
		$strEntry = str_replace("ß", "&szlig;", $strEntry);
				
		// ####################
		// HTML-eigene Zeichen:
		//$strEntry = str_replace(chr(34), "&quot;", $strEntry);
		//$strEntry = str_replace("&", "&amp;", $strEntry);
		//$strEntry = str_replace("<", "&lt;", $strEntry);
		//$strEntry = str_replace(">", "&gt;", $strEntry);
		//$strEntry = str_replace("'", "&apos;", $strEntry);
		
		// ############
		// Zahlenwerte:
		$strEntry = str_replace("²", "&sup2;", $strEntry);
		$strEntry = str_replace("³", "&sup3;", $strEntry);
		$strEntry = str_replace("½", "&frac12;", $strEntry);
		$strEntry = str_replace("¼ ", "&frac14;", $strEntry);
		$strEntry = str_replace("¾", "&frac34;", $strEntry);
		 
		// Zeilenumbrüche:
		$strEntry = str_ireplace(array("\r","\n",'\r','\n'),'', $strEntry);
				
		$strEntry = str_replace("\\".chr(39), chr(39), $strEntry);
		$strEntry = str_replace(chr(92).chr(39), chr(39), $strEntry);
		$strEntry = str_replace(chr(92).chr(39), chr(39), $strEntry);
		$strEntry = str_replace("\\".chr(34), chr(34), $strEntry);

		// CMS - Steuerelement:
		$strEntry = str_replace("<br />", "<br>", $strEntry);
		$strEntry = str_replace("<td><br>", "", $strEntry);
		$strEntry = str_replace("Â", "", $strEntry);

		return $strEntry;
	}


	function checkmove($strMove)
	{
		// Überprüft die Korrektheit eines Schachzugs.
		// 1.) Passt die Länge?
		// Beachte Rochade: 0-0!!!

		// Rochadezüge:
		if (trim($strMove)=="0-0")
		{
			return "";
		}

		if (trim($strMove)=="0-0-0")
		{
			return "";
		}

		if (strlen($strMove) < 5)
		{
			return "Der Zug '".$strMove."' ist zu kurz.<BR>";
		}

		if (strlen($strMove) > 10)
		{
			return "Der Zug '".$strMove."' ist zu lang.<BR>";
		}

		// ###########################
		// 2.) Inhalt
		$s = substr($strMove, 0, 1);

		// Der erste Wert:
		switch ($s)
		{
			case "a";
			case "b";
			case "c";
			case "d";
			case "e";
			case "f";
			case "g";
			case "h";
			case "K";
			case "D";
			case "L";
			case "T";
			case "S";
			case "0";
				// OK
				break;


			default:
				return "Der Zug '".$strMove."' ist im ersten Zeichen ung&uuml;ltig.<BR>";
		}

		// Der Rest:
		for ($i=2;$i<=strlen($strMove);$i++)
		{
			$s = substr($strMove, $i-1, 1);

			switch ($s)
			{
				case "a";
				case "b";
				case "c";
				case "d";
				case "e";
				case "f";
				case "g";
				case "h";
				case "x";
				case "1";
				case "2";
				case "3";
				case "4";
				case "5";
				case "6";
				case "7";
				case "8";
				case "+";
				case "#";
				case "-";
				case "=";
				case ".";
				case "p";
				case " ";
					// OK
					break;


				default:
					return "Der Zug '".$strMove."' ist inhaltlich ung&uuml;ltig.<BR>";
			}
		}

		// Der letzte Part muss eine Zahl sein:
		$strMove = str_replace("+", "", $strMove);
		$strMove = str_replace("#", "", $strMove);

		// Achtung, Umwandlungszüge!!!
		$strMove = str_replace("=", "", $strMove);
		$strMove = str_replace("K", "", $strMove);
		$strMove = str_replace("D", "", $strMove);
		$strMove = str_replace("L", "", $strMove);
		$strMove = str_replace("T", "", $strMove);
		$strMove = str_replace("S", "", $strMove);

		$s = substr($strMove, strlen($strMove)-1, 1);

		switch ($s)
		{
			case "1";
			case "2";
			case "3";
			case "4";
			case "5";
			case "6";
			case "7";
			case "8";
			case ".";
				// OK
				return "";


			default:
				return "Der Zug '".$strMove."' ist am Ende ung&uuml;ltig.<BR>";
		}
	}



	function strtranslatemove($strMove)
	{
		// Setzt ein Feld auf dem Schachbrett in das FEN - Format um.
		$strMove = trim(strtolower($strMove));

		// Die Zahl umcodieren:
		switch ($strMove)
		{
			// 8. Reihe:
			case "a8":
				return "00";
			case "b8":
				return "01";
			case "c8":
				return "02";
			case "d8":
				return "03";
			case "e8":
				return "04";
			case "f8":
				return "05";
			case "g8":
				return "06";
			case "h8":
				return "07";

			// 7. Reihe:
			case "a7":
				return "08";
			case "b7":
				return "09";
			case "c7":
				return "10";
			case "d7":
				return "11";
			case "e7":
				return "12";
			case "f7":
				return "13";
			case "g7":
				return "14";
			case "h7":
				return "15";

			// 6. Reihe:
			case "a6":
				return "16";
			case "b6":
				return "17";
			case "c6":
				return "18";
			case "d6":
				return "19";
			case "e6":
				return "20";
			case "f6":
				return "21";
			case "g6":
				return "22";
			case "h6":
				return "23";

			// 5. Reihe:
			case "a5":
				return "24";
			case "b5":
				return "25";
			case "c5":
				return "26";
			case "d5":
				return "27";
			case "e5":
				return "28";
			case "f5":
				return "29";
			case "g5":
				return "30";
			case "h5":
				return "31";

			// 4. Reihe:
			case "a4":
				return "32";
			case "b4":
				return "33";
			case "c4":
				return "34";
			case "d4":
				return "35";
			case "e4":
				return "36";
			case "f4":
				return "37";
			case "g4":
				return "38";
			case "h4":
				return "39";

			// 3. Reihe:
			case "a3":
				return "40";
			case "b3":
				return "41";
			case "c3":
				return "42";
			case "d3":
				return "43";
			case "e3":
				return "44";
			case "f3":
				return "45";
			case "g3":
				return "46";
			case "h3":
				return "47";

			// 2. Reihe:
			case "a2":
				return "48";
			case "b2":
				return "49";
			case "c2":
				return "50";
			case "d2":
				return "51";
			case "e2":
				return "52";
			case "f2":
				return "53";
			case "g2":
				return "54";
			case "h2":
				return "55";

			// 1. Reihe:
			case "a1":
				return "56";
			case "b1":
				return "57";
			case "c1":
				return "58";
			case "d1":
				return "59";
			case "e1":
				return "60";
			case "f1":
				return "61";
			case "g1":
				return "62";
			case "h1":
				return "63";

		}
	}

	function strtranslateenpassantmove($strMoveA, $strMoveB)
	{
		// Setzt einen en passant - Zug  auf dem Schachbrett in das FEN - Format um.
		$strA = trim(strtolower($strMoveA));
		$strB = trim(strtolower($strMoveB));

		$newField = "";

		// Weiss oder Schwarz?
		$pos=strpos($strA, "5");

		if (!($pos === false))
		{
			// Es geht um die 5. Reihe!
			$newField = "5";
		}
		else
		{
			// Es geht um die 4. Reihe!
			$newField = "4";
		}

		// in welche Spalte wurde gezogen?
		$strB = substr($strB,0,1);
		$newField = $strB.$newField;

		// Den Zug kodieren:
		$newField = strtranslatemove($newField);
		return $newField;
	}
	
	function strFormatSQL_WHERE($strFieldName, $strFieldValue, $bUseSemikolon = "FALSE")
	{
		// Formatiert für die WHERE - Kondition einer SQL-Abfrage für das übergebene Feld
		// den passenden String und gibt diesen zurück.
		if (trim(strtolower($strFieldValue))== "null")
		{
			return $strFieldName." IS NULL";
		}
		else
		{
			if ($bUseSemikolon == "FALSE")
			{
				return $strFieldName." = ".$strFieldValue; 
			}
			else
			{
				return $strFieldName." = '".$strFieldValue."'";
			}
		}
	}
	
	function strFormatSQL_INSERT($strFieldValue, $bUseSemikolon = "FALSE")
	{
		// Formatiert für den INSERT den passenden String und gibt diesen zurück.
		if (trim(strtolower($strFieldValue))== "null")
		{
			return "NULL";
		}
		else
		{
			if ($bUseSemikolon == "FALSE")
			{
				return $strFieldValue;
			}
			else
			{
				return "'".$strFieldValue."'";
			}
		}
	}
	
	
	function strReplaceCodePageChrs($strValueToReplace)
	{
	    // ###############################
	    // Problem seit Update 11.09.2023:
	    // Sonderzeichen werden in der Datenbank falsch abgelegt.
	    $strTmp = $strValueToReplace;
	    
	    $pos = strpos($strTmp , "Ã");
	    
	    if (!($pos === false))
	    {
	        //echo "CCC".$strValueToReplace;
	    }
	        
	    $strValueToReplace = str_replace("Ã¼", "&uuml;", $strValueToReplace);
	       
	    return $strValueToReplace;
	}
?>
