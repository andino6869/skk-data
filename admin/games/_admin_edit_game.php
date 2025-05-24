<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Partie bearbeiten", "TRUE");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/date/date.php")?>
<?php include("../_admin_param.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// 1.) Das Verbindungsobjekt ermitteln:
	$objDBCon = GetCon();

	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon, "FALSE");

	// ##################################################
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

	// #######################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("../_admin_param_dx.php");

	// ######################
	// Die aktuelle ID:
	$Nr = strGetParam($objDBCon, "Nr");

	// #############################
	// 6.) Die Partiedaten holen:
	$strSQL = "select * from skk_games WHERE id=".$Nr." AND del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
         	$id[$i] = $row->id;

         	$player1[$i] = $row->player1;
         	$player2[$i] = $row->player2;

         	$club1[$i] = $row->club1;
         	$club2[$i] = $row->club2;

         	$event[$i] = $row->event;
         	$round[$i] = $row->round;
         	$resultgame[$i] = $row->result;
         	$board[$i] = $row->board;

         	$comment[$i] = $row->comment;
         	$password[$i] = $row->password;

         	$moves[$i] = $row->moves;
         	$gamedate[$i] = $row->gamedate;
         	
         	$i++;
		}
	}

	echo "<SPAN CLASS=he1>Partie bearbeiten (GAMES - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##################################
	include("../forms/fields_not_null.php");

    echo "<form method=post action='_admin_edit_game_ok.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='ID' Value='$Nr'>".chr(13).chr(10);

	echo "<TABLE cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);

	echo "<tr>";
	echo "<td valign=top bgcolor='#C0C0C0' width='50%'><B><U>Spieler Weiss: *</U></B></td>".chr(13).chr(10);
	echo "<td valign=top bgcolor='#C0C0C0' width='50%'><B><U>Spieler Schwarz: *</U></B></td>".chr(13).chr(10);
	echo "</tr>";

	echo "<tr>";
	echo "<td><INPUT TYPE=Text NAME='player1' style='width:100%' value='".$player1[0]."' maxlength=255></td>".chr(13).chr(10);
	echo "<td><INPUT TYPE=Text NAME='player2' style='width:100%' value='".$player2[0]."' maxlength=255></td>".chr(13).chr(10);
	echo "</tr>";

	echo "<tr>";
	echo "<td valign=top bgcolor='#C0C0C0' width='50%'><B><U>Verein:</U></B></td>".chr(13).chr(10);
	echo "<td valign=top bgcolor='#C0C0C0' width='50%'><B><U>Verein:</U></B></td>".chr(13).chr(10);
	echo "</tr>";

	echo "<tr>";
	echo "<td><INPUT TYPE=Text NAME='club1' value='".$club1[0]."' style='width:100%' maxlength=255></td>".chr(13).chr(10);
	echo "<td><INPUT TYPE=Text NAME='club2' value='".$club2[0]."' style='width:100%' maxlength=255></td>".chr(13).chr(10);
	echo "</tr>";

	echo "</table>".chr(13).chr(10);
	echo "<TABLE cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);

	echo "<tr>";

	// ############
	echo "<TD valign=top bgcolor='#C0C0C0' width='25%'><B><U>Datum (Format: TT.MM.JJJJ):</U></B></TD>".chr(13).chr(10);
	echo "<td valign=top bgcolor='#C0C0C0' width='75%'><B><U>Veranstaltung (z.B. AFRO, Mannschaftkampf, Klubturnier, ...): *</U></B></td>".chr(13).chr(10);
	echo "</tr>";
	echo "<tr>";

	echo "<TD>".chr(13).chr(10);

	// Ein leeres Datum vorsteuern:
	// Das Datum vorsteuern:
	$curYear = substr($gamedate[0],0,4);
	$curMonth = substr($gamedate[0],5,2);
	$curDay = substr($gamedate[0],8,2);

	writeDateField("game_day", "game_month", "game_year", $curDay, $curMonth, $curYear, "TRUE");

	echo "</TD>".chr(13).chr(10);
	echo "<td><INPUT TYPE=Text NAME='event' style='width:100%' value='".$event[0]."' maxlength=255></td>".chr(13).chr(10);
	echo "</tr>";

	echo "</table>".chr(13).chr(10);

	// #################################
	// Runde, Brett, Ergebnis, Passwort:
	echo "<TABLE cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);

	echo "<tr>";
	echo "<td valign=top bgcolor='#C0C0C0' width='25%'><B><U>Runde:</U></B></td>".chr(13).chr(10);
	echo "<td valign=top bgcolor='#C0C0C0' width='25%'><B><U>Brett:</U></B></td>".chr(13).chr(10);
	echo "<td valign=top bgcolor='#C0C0C0' width='25%'><B><U>Ergebnis:</U></B></td>".chr(13).chr(10);
	echo "<td valign=top bgcolor='#C0C0C0' width='25%'><B><U>Passwort:</U></B></td>".chr(13).chr(10);
	echo "</tr>";

	echo "<tr>";

  	echo "<TD><SELECT NAME='round' style='width:100%'>";

  	if ($round[0]=="-")
  	{
  		echo "<OPTION Value='-' SELECTED>", "-".chr(13).chr(10);
  	}
  	else
  	{
  		echo "<OPTION Value='-'>", "-".chr(13).chr(10);
  	}

	for ($i=1;$i<31;$i++)
    {
    	if ($round[0]==$i)
	  	{
	  		echo "<OPTION Value='".$i."' SELECTED>", $i.chr(13).chr(10);
	  	}
	  	else
	  	{
	  		echo "<OPTION Value='".$i."'>", $i.chr(13).chr(10);
	  	}
    }

	echo "</SELECT></TD>".chr(13).chr(10);

	// ##################################################
	// Brett:
  	echo "<TD><SELECT NAME='board' style='width:100%'>";

  	if ($board[0]=="-")
  	{
  		echo "<OPTION Value='-' SELECTED>", "-".chr(13).chr(10);
  	}
  	else
  	{
  		echo "<OPTION Value='-'>", "-".chr(13).chr(10);
  	}

	for ($i=1;$i<17;$i++)
    {
   		if ($board[0]==$i)
	  	{
	  		echo "<OPTION Value='".$i."' SELECTED>", $i.chr(13).chr(10);
	  	}
	  	else
	  	{
	  		echo "<OPTION Value='".$i."'>", $i.chr(13).chr(10);
	  	}
    }

	echo "</SELECT></TD>".chr(13).chr(10);

	// ###################################################
	// Ergebnis:
	echo "<TD><SELECT NAME='result' style='width:100%'>";

	if ($resultgame[0]=="1-0")
	{
		echo "<OPTION Value='1-0' SELECTED>", "1-0".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION Value='1-0'>", "1-0".chr(13).chr(10);
	}

	if ($resultgame[0]=="1/2")
	{
		echo "<OPTION Value='1/2' SELECTED>", "1/2".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION Value='1/2'>", "1/2".chr(13).chr(10);
	}

    if ($resultgame[0]=="0-1")
	{
		echo "<OPTION Value='0-1' SELECTED>", "0-1".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION Value='0-1'>", "0-1".chr(13).chr(10);
	}


	echo "</SELECT></TD>".chr(13).chr(10);

	// Passwort:
	echo "<td><INPUT TYPE=Text NAME='password' value='".$password[0]."' style='width:100%' maxlength=25></td>".chr(13).chr(10);
	echo "</TR>";
	echo "</table>".chr(13).chr(10);

	// #################################
	// Kommentar:
	echo "<TABLE cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Kommentar:</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Geben Sie hier einen Kommentar zu dieser Partie ein. Es sind alle g&auml;ngigen HTML - Tags zugelassen. ".chr(13).chr(10);
		echo "Ferner k&ouml;nnen nun auch die Zeichen ' und \" im Text verwendet werden.</I>";
	}
	echo "</TD></TR>".chr(13).chr(10);

	echo "<TR><TD><TEXTAREA COLS=80 ROWS=30 ";
	echo "style='width:100%' NAME='comment'>".$comment[0]."</TEXTAREA></TD>";


	echo "</TR>".chr(13).chr(10);
	echo "</TABLE>".chr(13).chr(10);

	// ################################
	// Züge:
	echo "<TABLE cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Z&uuml;ge: *</U></B>";

	echo "<BR><BR>".chr(13).chr(10);
	echo "<I>Geben Sie hier bitte die Z&uumlge zu dieser Partie ein unter Angabe des Start- und Zielfeldes. Es sind folgende Notationen erlaubt:<BR><BR>";
	echo "Th1-h4, c2-c4, Lf1-c4, Dh1-h8#, 0-0-0, e7-e8=D, f5xg6 e.p., ... . <BR><BR>Die Zeichen + und # k&ouml;nnen optional bei Bedarf mit angegeben werden. Bitte ";
	echo "geben Sie auf jeden Fall das Start- und Zielfeld mit einem '-' bzw. 'x' beim Schlagen einer Figur mit an. ";
	echo "Die Angabe von Ausrufe- und Fragezeichen bzw. Kommentaren ist derzeit bei den einzelnen Z&uuml;gen unzul&auml;ssig.</I>";

	echo "</TD></TR>".chr(13).chr(10);
	echo "</TABLE>".chr(13).chr(10);

	// ##################################
	// Die Züge als solches:
	echo "<TABLE cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);
	echo "<TR><TD width='33%'>";

	// Die ersten 33 Züge:
	echo "<TABLE cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);

	// NULL als Dummy entfernen:
	$moves[0] = str_replace(";NULL", "", $moves[0]);

	// Array aufbauen:
	$arrmoves = explode(";", $moves[0]);
	$intArrPos = 0;

	for ($i=1;$i<34;$i++)
    {
    	echo "<TR>";
   		echo "<td width='20%'>".$i.".</td><td width='40%'><INPUT TYPE=Text NAME='moveWhite$i' style='width:100%' maxlength=10";

		// Sind noch Züge für die Ausgabe da?
   		if ($intArrPos<count($arrmoves))
   		{
   			echo " value='".$arrmoves[$intArrPos]."'";
   			$intArrPos++;
   		}

		echo "></td>";
    	echo "<td width='40%'><INPUT TYPE=Text NAME='moveBlack$i' style='width:100%' maxlength=10";

    	// Sind noch Züge für die Ausgabe da?
   		if ($intArrPos<count($arrmoves))
   		{
   			echo " value='".$arrmoves[$intArrPos]."'";
   			$intArrPos++;
   		}

		echo "></td>";
    	echo "</TR>";
    }

	echo "</TABLE>".chr(13).chr(10);
	echo "</TD><TD width='33%'>";

	// Die zweiten 33 Züge:
	echo "<TABLE cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);

	for ($i=34;$i<67;$i++)
    {
    	echo "<TR>";

    	if ($i==40)
    	{
    		echo "<td width='20%'><B><U>".$i.".</td><td width='40%'><INPUT TYPE=Text NAME='moveWhite$i' style='width:100%' maxlength=10";

			// Sind noch Züge für die Ausgabe da?
	   		if ($intArrPos<count($arrmoves))
	   		{
	   			echo " value='".$arrmoves[$intArrPos]."'";
	   			$intArrPos++;
	   		}

			echo "></td>";
    		echo "<td width='40%'><INPUT TYPE=Text NAME='moveBlack$i' style='width:100%' maxlength=10></U></B></td>";
    	}
    	else
    	{
    		echo "<td width='20%'>".$i.".</td><td width='40%'><INPUT TYPE=Text NAME='moveWhite$i' style='width:100%' maxlength=10";

	    	// Sind noch Züge für die Ausgabe da?
	   		if ($intArrPos<count($arrmoves))
	   		{
	   			echo " value='".$arrmoves[$intArrPos]."'";
	   			$intArrPos++;
	   		}

			echo "></td>";
    		echo "<td width='40%'><INPUT TYPE=Text NAME='moveBlack$i' style='width:100%' maxlength=10></td>";
    	}
    	echo "</TR>";
    }

	echo "</TABLE>".chr(13).chr(10);
	echo "</TD><TD width='33%'>";

	// Die dritten 33 Züge:
	echo "<TABLE cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);

	for ($i=67;$i<100;$i++)
    {
    	echo "<TR>";
    	echo "<td width='20%'>".$i.".</td><td width='40%'><INPUT TYPE=Text NAME='moveWhite$i' style='width:100%' maxlength=10>";

    	// Sind noch Züge für die Ausgabe da?
   		if ($intArrPos<count($arrmoves))
   		{
   			echo " value='".$arrmoves[$intArrPos]."'";
   			$intArrPos++;
   		}

		echo "</td>";
    	echo "<td width='40%'><INPUT TYPE=Text NAME='moveBlack$i' style='width:100%' maxlength=10></td>";
    	echo "</TR>";
    }

	echo "</TD></TR></TABLE>".chr(13).chr(10);
	echo "</TABLE>".chr(13).chr(10);

	echo "<BR><INPUT TYPE=Submit VALUE='Partie aktualisieren'>".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>

