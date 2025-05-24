<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Archiv der Jugendsch&auml;cher");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// #############################
	// 1.) Datenbankverbindung aufbauen:
	$objDBCon = GetCon();


	// ##############################################
	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	// Welcher Seiteninhalt soll angezeigt werden?
	writeNavigationBar(11, $objDBCon);

	echo "</CENTER>".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);

	// #########################################################
	// 3.) Gab es Probleme beim Verbindungsaufbau?
	if ($objDBCon == "")
	{
		echo "<BR>Problem mit dem Verbindungsaufbau zur Datenbank: Das Verbindungsobjekt konnte nicht erzeugt werden!<BR>".chr(13).chr(10);
		echo "</BODY></HTML>".chr(13).chr(10);
		exit;
	}

	// #########################################################
	// 4.) Ausgabe der Überschrift:
	echo "<SPAN CLASS=he1>Liste der digitaliserten Jugendsch&auml;cher</SPAN><BR><BR>".chr(13).chr(10);

	// #########################################################
	// 5.) Daten aus Datenbank holen:
	$strSQL = "select * from skk_chessbooks WHERE modifieddate IS NULL AND ";
	$strSQL = $strSQL."del='N'";
	$strSQL = $strSQL." ORDER BY chessbook_date DESC";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Wurden Datensätze gefunden?
	if ($RecordCount > 0)

		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$ID[$i] = $row->id;
			$chessbook_number[$i] = $row->chessbook_number;
			$chessbook_file[$i] = $row->chessbook_file;
			$chessbook_topic[$i] = $row->chessbook_topic;
			$chessbook_date[$i] = $row->chessbook_date;
			i++;
		}
	}
	
	// Gibt es Datensätze?
	if ($RecordCount == 0)
	{
		echo "<table border=0><tr><td width=500 valign=top>".chr(13).chr(10);
	    echo "<td width=15></td>".chr(13).chr(10);
		echo "<B>Es sind derzeit keine Jugendsch&auml;cher hinterlegt.</B>".chr(13).chr(10);
		echo "</td></tr></table><BR>".chr(13).chr(10);
	}
	else
	{
		// #################################
		// Merker setzen:
		$bSetYear = "TRUE";

		// Daten ausgeben:
		$counter = 0;

		for($i=0;$i<$num;$i++)
		{
			// #################################
			// Ausgabe der Monatsansicht:
			if ($bSetYear == "TRUE")
			{
		    	echo "<BR><BR><SPAN CLASS='red_head'>Ausgaben aus dem Jahr ".substr($chessbook_date[$i],0,4)."</SPAN>";
				echo "<HR noshade size=1 color='#5B2E00'>".chr(13).chr(10);
				$bSetYear = "TRUE";
			}

			// #################################
			// Der Link auf die Bildergalerie
			echo "<table border=0><tr><td width='100%' valign=top>".chr(13).chr(10);
			echo "<A HREF='chessbooks/".$chessbook_file[$i]."'>".chr(13).chr(10);

			// ###################################
			// Welches Icon soll angezeigt werden?
			echo "<IMG SRC='../pics/filetypes/pdf.jpg' border=0 WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>".chr(13).chr(10);

			// ######################################
			// Das Datum und Thema des Jugendschachs:
			echo "Nr. ".$chessbook_number[$i]." vom ".substr($chessbook_date[$i], 8, 2).".".substr($chessbook_date[$i],5,2).".".substr($chessbook_date[$i],0,4)." - ".$chessbook_topic[$i].chr(13).chr(10);
			
			// Die Grösse der Datei herausfinden:
			$curfilesize = filesize("chessbooks/".$chessbook_file[$i]);
			$curfilesize = round($curfilesize / 1024, 2);
			
			if ($curfilesize>1024)
			{
				$curfilesize=round($curfilesize / 1024, 2);
				echo "(Dateigr&ouml;&szlig;e: $curfilesize MB)".chr(13).chr(10);
			}
			else
			{
				echo "(Dateigr&ouml;&szlig;e: $curfilesize KB)".chr(13).chr(10);
			}
			
			echo "</A></td></tr></table>".chr(13).chr(10);

			// ########################
			// Ein neues Jahr erreicht?
			if($i<$num-1)
			{
				// Jahreswechsel?
				if (substr($chessbook_date[$i],0,4) < substr($chessbook_date[$i+1],0,4))
				{
					$bSetYear = "TRUE";
				}
				else
				{
					$bSetYear = "FALSE";
				}
			}
		}
	}

	include("../includes/forms/middler.php");

	// ######################################
	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>
