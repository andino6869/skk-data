<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neue Partie publizieren - Check", "FALSE");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/date/date.php")?>
<?php include("../../includes/string/str.php")?>
<?php include("../_admin_param.php")?>
<?php include("../../includes/string/str.php")?>
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
	include("../_admin_param_ux.php");

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
	include("../_admin_param_dx.php");

	// Die Inhalte überprüfen:
	$errText = "";

	// ##############################################
	// 6.) Die Feldinhalte durchgehen
	// 6.1.) Spieler 1:
	$player1 = strGetParam($objDBCon, "player1");

	if (trim($player1)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Spieler Weiss.<BR>";
	}
	$player1 = mysqli_escape_string($objDBCon, $player1);

	// #################################
	// 6.2.) Spieler 2:
	$player2 = strGetParam($objDBCon, "player2");

	if (trim($player2)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Spieler Schwarz.<BR>";
	}
	$player2 = mysqli_escape_string($objDBCon, $player2);

	// ######################
	// 6.3.) Vereine (kein Pflichtfeld!):
	$club1 = strGetParam($objDBCon, "club1");

	if (trim($club1)=="")
	{
		$club1="NULL";
	}
	else
	{
		$club1="'".mysqli_escape_string($objDBCon, $club1)."'";
	}

	// Schwarz:
	$club2 = strGetParam($objDBCon, "club2");

	if (trim($club2)=="")
	{
		$club2="NULL";
	}
	else
	{
		$club2="'".mysqli_escape_string($objDBCon, $club2)."'";
	}

	// ######################
	// Das Spieldatum
	// Der Tag:
	$game_day = strGetParam($objDBCon, "game_day");

	// Der Monat:
	$game_month = strGetParam($objDBCon, "game_month");
	
	// Das Jahr:
	$game_year = strGetParam($objDBCon, "game_year");

	// ################################################
	// Soll das Datum überhaupt verwendet werden?
	if (($game_month == "-") || ($game_day == "-") ||  ($game_year == "-"))
	{
		// Es soll kein Ablaufdatum gesetzt werden:
		$gamedate = "NULL";
	}
	else
	{
		$bCheckdate = checkdate($game_month, $game_day, $game_year);

		if ( !$bCheckdate )
		{
			$errText = $errText."Das eingegebene Datum ist nicht korrekt.<BR>";
		}
		else
		{
			// Ablaufdatum kann verwendet werden:
			$gamedate = "'".mysqli_escape_string($objDBCon, $game_year."-".$game_month."-".$game_day)."'";
		}
	}


	// #################################
	// 6.4.) Veranstaltung (Pflichtfeld!):
	$event = strGetParam($objDBCon, "event");

	if (trim($event)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Veranstaltung.<BR>";
	}
	$event = mysqli_escape_string($objDBCon, $event);


	// #################################
	// 6.5.) Runde:
	$round = strGetParam($objDBCon, "round");

	if (trim($round)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Runde.<BR>";
	}
	$round = mysqli_escape_string($objDBCon, $round);


	// #################################
	// 6.6.) Brett:
	$board = strGetParam($objDBCon, "board");

	if (trim($board)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Brett.<BR>";
	}
	$board = mysqli_escape_string($objDBCon, $board);


	// #################################
	// 6.7.) Ergebnis:
	$result = strGetParam($objDBCon, "result");

	if (trim($result)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Ergebnis.<BR>";
	}
	$result = mysqli_escape_string($objDBCon, $result);


	// ######################
	// 6.8.) Passwort (kein Pflichtfeld!):
	$password = strGetParam($objDBCon, "password");

	if (trim($password)=="")
	{
		$password="NULL";
	}
	else
	{
		$password="'".mysqli_escape_string($objDBCon, $password)."'";
	}

	// ######################
	// 6.9.) Kommentar (kein Pflichtfeld!):
	$comment = strGetParam($objDBCon, "comment");

	if (trim($comment)=="")
	{
		$comment="NULL";
	}
	else
	{
		$comment="'".mysqli_escape_string($objDBCon, $comment)."'";
		$comment = strReplaceRNInMemoField($comment);
	}

	// ######################
	// 6.10.) Züge:
	$arrmoves = "";
	$bemptymove = "FALSE";

	for ($i=1;$i<101;$i++)
	{
		$moveWhite = "";
		$moveBlack= "";

		// Züge erfragen:
		// Weiss:
		$moveWhite = strGetParam($objDBCon, "moveWhite".$i);
		
		// Schwarz:
		$moveBlack = strGetParam($objDBCon, "moveBlack".$i);

		// ############################
		// Den letzten Zug erreicht?
		if (trim($moveWhite)=="" && trim($moveBlack)=="")
		{
			break;
		}

		// #####################
		// Zug Weiss vergessen:
		if (trim($moveWhite)=="")
		{
			$errText = $errText."Es wurden im ".$i." Zug der Zug von Weiss vergessen.<BR>";
		}
		else
		{
			// Den Zug fachlich auf seine Korrektheit prüfen:
			$strTmp = $moveWhite;
			$strTmp = checkmove($strTmp);

			$errText = $errText.$strTmp;

			// Zug Schwarz vergessen:
			$pos=strpos($arrmoves, "NULL");

			if (!($pos === false))
			{
				$errText = $errText."Es wurden im ".($i-1)." Zug der Zug von Schwarz vergessen.<BR>";
			}
		}

		// Zug einfügen:
		// Weiss:
		if (trim($arrmoves)=="")
		{
			$arrmoves = $moveWhite.";";
		}
		else
		{
			$arrmoves = $arrmoves.";".$moveWhite.";";
		}

		// Schwarz:
		// Letzter Zug???
		if (trim($moveBlack)=="")
		{
			$moveBlack = "NULL";
		}
		else
		{
			// Den Zug fachlich auf seine Korrektheit prüfen:
			$strTmp = $moveBlack;
			$strTmp = checkmove($strTmp);

			$errText = $errText.$strTmp;
		}

		$arrmoves = $arrmoves.$moveBlack.";";
	}

	// ###################################
	// 7.) Wurden überhaupt Züge erfasst?
	if (trim($arrmoves)=="")
	{
		$errText = $errText."Es wurden keine Z&uuml;ge erfasst.<BR>";
	}
	else
	{
		$arrmoves = str_replace(";;", ";", $arrmoves);
	}


	// ###################################
	// 8.) Gab es Fehler?
	if (trim($errText)!="")
	{
		echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
		echo "<b>Die neue Partie konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
		echo "<BR><I>".$errText."</I>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
	}
	else
	{
		// Wurde diese Partie bereits gespeichert?
		$strSQL = "SELECT id FROM skk_games WHERE player1='$player1' AND player2='$player2' ";
		$strSQL = $strSQL."AND event='$event' AND comment=$comment AND ";
		$strSQL = $strSQL."del='N' AND modifieddate IS NULL;";

		if (bCheckRecordset($objDBCon, $strSQL)==1)
		{
			echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
			echo "<b>Die neue Partie konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
			echo "<BR><I>Die aktuelle Partie wurde bereits in der Datenbank gespeichert!</I>".chr(13).chr(10);
			echo "<BR><BR>".chr(13).chr(10);
			echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
			echo "<BR><BR>".chr(13).chr(10);
			echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
		}
		else
		{
			// Neue Partie speichern:
			$now = date("Y-m-d H:i:s");

			$strSQL = "insert into skk_games (player1, player2, club1, club2, event, ";
			$strSQL = $strSQL."round, result, board, comment, password, moves, gamedate, creator, createdate, del) VALUES ";
			$strSQL = $strSQL."('$player1','$player2', $club1, $club2,'$event','$round', '$result', ";
			$strSQL = $strSQL."'$board', $comment, $password, '$arrmoves', $gamedate, '$curUser', '$now', 'N')";

			echo "<SPAN CLASS=he1>Neue Partie publizieren (GAMES - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

			if (!mysqli_query ($objDBCon, $strSQL))
			{
				echo "Partie konnte nicht publiziert werden!<BR>".chr(13).chr(10);
				echo mysqli_error($objDBCon).chr(13).chr(10);
				echo "<BR>Statement: " . $strSQL . "<BR>".chr(13).chr(10);
			}
			else
			{
				// ##########################################
				// UPDATE: Neues Objekt in Schreibtischliste:
				$strCurrentTable = "skk_games";
				$Autor = $curUser;
				include("../_admin_userdesk_contents.php");
				// UPDATE ENDE
				// ###########
				
				if (!mysqli_query ($objDBCon, $strSQL))
				{
					$errText = $strSQL."<BR>".mysqli_error($objDBCon)."<BR>".chr(13).chr(10);
					include("_admin_eingabe_fehler.php");
				}
				else
				{
		  			echo "Vielen Dank f&uuml;r die neue Partie!<BR>".chr(13).chr(10);
		  			echo "Die Partie ist jetzt online.<BR><BR>".chr(13).chr(10);
		  			
		  			include("../_admin_ok_link.php");
				}
			}
		}
	}


	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>