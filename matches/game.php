<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Partie");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>
<?php
	// Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// UPDATE Schneider 05.05.2008:
	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	writeNavigationBar(999, $objDBCon);
	// UPDATE Ende

	echo "<SPAN CLASS=he1>Partie</SPAN><BR><BR>".chr(13).chr(10);

	// Die ID ermitteln:
	if (isset($_GET["Nr"])) 
	{
		$Nr = $_REQUEST["Nr"];
	}

	if (trim($Nr)=="")
	{
		$Nr = $_GET["Nr"];
	}

	// Die Partiedaten holen:
	$strSQL = "select * from skk_games WHERE id=".$Nr." AND del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
		
		while ($row = $rs->fetch_object())
		{
         	$id[$i] = $row->id;

         	$player1[$i] = formatoutput($row->player1);
         	$player2[$i] = formatoutput($row->player2);

         	$club1[$i] = formatoutput($row->club1);
         	$club2[$i] = formatoutput($row->club2);

         	$event[$i] = formatoutput($row->event);
         	$round[$i] = $row->round;
         	$resultgame[$i] = $row->result;
         	$board[$i] = $row->board;

         	$comment[$i] = formatoutput($row->comment);
         	$password[$i] = $row->password;

         	$moves[$i] = $row->moves;
         	$gamedate[$i] = $row->gamedate;
         	
         	$i++;
		}

		// Ist diese Partie verschlüsselt?
		if (trim($password[0])!="")
		{
			// Passwort ermitteln:
			if (trim($px)=="")
			{
				$px = $_REQUEST["px"];
			}

			if (trim($px)=="")
			{
				$px = $_GET["px"];
			}

			// Passt die Eingabe?
			if ($px != $password[0])
			{
				// Nein, sie passt nicht:
				echo "<FORM ACTION='game.php?$Nr'>";
				echo "<INPUT TYPE='HIDDEN' NAME='Nr' Value='$Nr'>".chr(13).chr(10);
				echo "<table>";
				echo "<tr>";
				echo "<td>Diese Partie ist mit einem Passwort gesch&uuml;tzt. <BR>Bitte geben Sie dieses hier ein:</td>";
				echo "<td>";
	  			echo "<INPUT TYPE=PASSWORD SIZE=30 maxlength=25 NAME=px>";
				echo "</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td></td>";
				echo "<td>";
	  			echo "<INPUT TYPE=SUBMIT VALUE='Best&auml;tigen'>";
				echo "</td>";
				echo "</tr>";
				echo "</table>";
				echo "</FORM>";

				$bOK = "FALSE";
			}
			else
			{
				$bOK = "TRUE";
			}
		}
		else
		{
			$bOK = "TRUE";
		}

		// Soll eine Anzeige dr Partie erfolgen?
		if ($bOK == "TRUE")
		{
			include("../matches/daten/part1.php");

			// Die Grundaufstellung:
			// echo 'zg=new Array("rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR 1 x","5236","1026","5042");';
			echo 'zg=new Array("rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR 1 x",';

			// Der Rest setzt sich aus den Zügen zusammen, die bisher erfasst worden sind:
			// NULL als Dummy entfernen:
			$moves[0] = str_replace(";NULL", "", $moves[0]);

			// Array aufbauen:
			$arrmoves = explode(";", $moves[0]);

			for ($i=0;$i<count($arrmoves);$i++)
			{
				// Wenn du die Felder des Bretts beginnend mit 0 durchnummerierst,
				// erhältst du eine Abbildung der Koordinaten nach 0..63, also a8=00,
				// b8=01, ..., g8=06, ..., c7=10, d7=11, ..., h1=63.
				// Dann kannst du 1. c2-c4 als 5034 darstellen (c2=50, c4=34) und den Rest
				// der Züge analog.
				$strMove = $arrmoves[$i];

				// Die Sonderzeichen entfernen:
				$strMove = str_replace("+", "", $strMove);
				$strMove = str_replace("#", "", $strMove);

				$strMove = str_replace("-", "", $strMove);
				$strMove = str_replace("x", "", $strMove);

				// Sonderzug Bauernumwandlung:
				$strChange = "";
				$pos=strpos($strMove, "=");

				if (!($pos === false))
				{
					// Es handelt sich um eine Bauernumwandlung.
					// z.B. 5260q = Dame!

					// Das letzte Element ermitteln:
					$strChange = strtolower(substr($strMove, strlen($strMove)-1, 1));

					// KQRBNP für weiße Figuren
					// kqrbnp für schwarze Figuren
					// Rock = Turm
					// Bishop = Läufer
					// Khight = Springer
					// Pawn = Bauer

					$strChange = str_replace("d", "q", $strChange);
					$strChange = str_replace("t", "r", $strChange);
					$strChange = str_replace("s", "k", $strChange);
					$strChange = str_replace("l", "b", $strChange);


					// Zug von Weiß oder Schwarz?
					if (($i % 2) == 0)
					{
						// Weiß
						// Wir brauchen Großbuchstaben:
						$strChange = strtoupper($strChange);

					}
				}

				// Die Figurenkürzel entfernen:
				$strMove = str_replace("K", "", $strMove);
				$strMove = str_replace("D", "", $strMove);
				$strMove = str_replace("L", "", $strMove);
				$strMove = str_replace("S", "", $strMove);
				$strMove = str_replace("T", "", $strMove);


				// Rochadezüge:
				if ((trim($strMove)=="00") || (trim($strMove)=="000"))
				{
					// Zug von Weiß oder Schwarz?
					if (($i % 2) == 0)
					{
						// Weiß
						if ((trim($strMove)=="00") && (strlen(trim($strMove))==2))
						{
							echo chr(34)."60626361".chr(34);
						}
						else
						{
							echo chr(34)."60585659".chr(34);
						}
					}
					else
					{
						// Schwarz:
						if ((trim($strMove)=="00") && (strlen(trim($strMove))==2))
						{
							echo chr(34)."04060705".chr(34);
						}
						else
						{
							echo chr(34)."04020003".chr(34);
						}
					}
				}
				else
				{
					// En passant?
					// f5xg6 e.p.
					$pos=strpos(strtolower($strMove), "e.p.");

					if (!($pos === false))
					{
						// Ja, es ist ein en passant Zug.
						$bEP = "TRUE";
						$strMove = str_replace("e.p.", "", $strMove);
					}
					else
					{
						$bEP = "FALSE";
					}

					$strMoveA = substr($strMove,0,2);
					$strMoveB = substr($strMove,2,2);

					// Die Züge codieren:
					$strMoveA = strtranslatemove($strMoveA);
					$strMoveB = strtranslatemove($strMoveB);

					// Ist en passant ein Thema?
					if ($bEP=="TRUE")
					{
						$EP = strtranslateenpassantmove( substr($strMove,0,2), substr($strMove,2,2));
						echo chr(34).$strMoveA.$EP.$EP.$strMoveB;
					}
					else
					{
						echo chr(34).$strMoveA.$strMoveB;
					}

					// Umwandlungszüge beachten!!!
					// z.B. 5260q = Dame!
					if (trim($strChange!=""))
					{
						echo $strChange.chr(34);
					}
					else
					{
						echo chr(34);
					}
				}

				if ($i<(count($arrmoves)-1))
				{
					echo ",";
				}
				else
				{
					echo ");";
				}
			}

			//"5034","1026","5742","0621","6245","1127","3427pAA","2127PAA");';

			// FEN - Code zielweise zu lesen.
			// Weiße Figuren werden immer groß geschrieben (K, Q, B, N, R, P).
			// Schwarze Figuren werden immer klein geschrieben (k, q, b, n, r, p).

			include("../matches/daten/part2.php");

			// Die Partiedaten:
			echo "<span class='VH'><span class='hPlayers'>";
			echo $player1[0];

			if (trim($club1[0]))
			{
				echo " (".$club1[0].")";
			}

			echo " - ";

			echo $player2[0];

			if (trim($club2[0]))
			{
				echo " (".$club2[0].")";
			}

			// Das Ereignis:
			echo "</span><span class='hEvent'><br>";
			echo $event[0];

			// Datum:
			if (trim($gamedate[0])!="")
			{
				$curYear = substr($gamedate[0],0,4);
				$curMonth = substr($gamedate[0],5,2);
				$curDay = substr($gamedate[0],8,2);

				echo ", ".$curDay.".".$curMonth.".".$curYear;
			}

			if (trim($round[0])!="-")
			{
				echo ", Runde: ".$round[0];
			}

			// Brett:
			if (trim($board[0])!="-")
			{
				echo ", Brett: ".$board[0];
			}

			echo "</span></span><br><br>";
         	echo $comment[0];

			// Die Züge ausgeben:
			include("../matches/daten/part3.php");

			// Array aufbauen:
			$arrmoves = explode(";", $moves[0]);

			//'<table BORDER=0>\r\n<tr><td COLSPAN=2>\r\n<span class="V0"><a href="javascript:c(0,1)" ID="l1">1.e4</a> <a href="javascript:c(0,2)" ID="l2">c5</a> <a href="javascript:c(0,3)" ID="l3">2.c3</a>\r\n <a href="javascript:c(0,4)" ID="l4">d5</a> <a href="javascript:c(0,5)" ID="l5">3.exd5</a> <a href="javascript:c(0,6)" ID="l6">Dxd5</a>\r\n <a href="javascript:c(0,7)" ID="l7">4.d4</a> <a href="javascript:c(0,8)" ID="l8">Sf6</a> <a href="javascript:c(0,9)" ID="l9">5.Sf3</a>\r\n <a href="javascript:c(0,10)" ID="l10">Lg4</a> <a href="javascript:c(0,11)" ID="l11">6.Le2</a> <a href="javascript:c(0,12)" ID="l12">e6</a>\r\n <a href="javascript:c(0,13)" ID="l13">7.<nobr>O-O</nobr></a> <a href="javascript:c(0,14)" ID="l14">Le7</a>\r\n <a href="javascript:c(0,15)" ID="l15">8.h3</a> <a href="javascript:c(0,16)" ID="l16">Lh5</a> <a href="javascript:c(0,17)" ID="l17">9.c4</a>\r\n <a href="javascript:c(0,18)" ID="l18">Dd6</a> <a href="javascript:c(0,19)" ID="l19">10.Sc3</a> <a href="javascript:c(0,20)" ID="l20">cxd4</a>\r\n <a href="javascript:c(0,21)" ID="l21">11.Sxd4</a> <a href="javascript:c(0,22)" ID="l22">Lxe2</a> <a href="javascript:c(0,23)" ID="l23">12.Sdxe2</a>\r\n <a href="javascript:c(0,24)" ID="l24">Dxd1</a> <a href="javascript:c(0,25)" ID="l25">13.Txd1</a> <a href="javascript:c(0,26)" ID="l26">Sc6</a>\r\n <a href="javascript:c(0,27)" ID="l27">14.Le3</a> <a href="javascript:c(0,28)" ID="l28"><nobr>O-O</nobr></a> <a href="javascript:c(0,29)" ID="l29">15.Tac1</a>\r\n <a href="javascript:c(0,30)"
			echo '<table BORDER=0><tr><td COLSPAN=2><span class="V0">';
			$moveNumber = 0;

			for ($i=0;$i<count($arrmoves);$i++)
			{
				if (trim($arrmoves[$i])!="")
				{
					$j = $i + 1;

					// Nach zwei Zügen kommt die Zugnummer:
					if ($j % 2 == 1)
					{
						$moveNumber++;
						echo '<a href="javascript:c(0,'.$j.')" ID="l'.$j.'">'.$moveNumber.'.<I>'.$arrmoves[$i].'</I></a> ';
					}
					else
					{
						echo '<a href="javascript:c(0,'.$j.')" ID="l'.$j.'">&nbsp;<I>'.$arrmoves[$i].'</I></a>&nbsp;&nbsp;&nbsp;';
					}
				}
			}
			echo '</span><br><br><span class="VH">Ergebnis: '.$resultgame[0].'</span></td></tr></table></TABLE>';


			// echo $Zuege[0];
		}
	}
	else
	{
		echo "Die Partiedaten konnten leider nicht ermittelt werden.".chr(13).chr(10);
	}

	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");
	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php")
?>



























