<?php include("100_header.php")?>
<?php
	writeheader("Meldung");
?>
<?php include("100_navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include_once("../includes/string/str.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// 1.) Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	// Achtung, hier soll alles wieder angezeigt werden, daher 999!
	writeNavigationBar(999, $objDBCon);

	// 2.) Abfrage an die Datenbank für die aktuelle Meldung:
	if (!isset($Nr))
	{
		$Nr = "";
	}

	if (trim($Nr)=="")
	{
		$Nr = $_GET["Nr"];
	}

	if (trim($Nr)=="")
	{
		$Nr = $_REQUEST["Nr"];
	}

	$strSQL="select * from skk_news WHERE id=".$Nr." AND del='N' AND modifieddate IS NULL";

	// 3.) Daten lesen:
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
			$picture[$i] = $row->picture;
			$allowcomment[$i] = $row->allowcomment;
			$createdate[$i] = $row->createdate;
			$creator[$i] = $row->creator;
			$i++;
		}
	}
	else
	{
		echo "Daten konnten nicht aus Datenbank gelesen werden.<BR>".chr(13).chr(10);
	}

	// 4.) Daten ausgeben:
	echo "<SPAN CLASS=he1>".$Headline[0]."</SPAN><BR><BR>".chr(13).chr(10);

	// Hat dieses Event ein Bild?
	if($picture[0]!="")
	{
		if (is_file("../admin/pics/".$picture[0]))
		{
			echo "<p align='left'><a href='../admin/pics/".$picture[0]."'>";
			

			// Die Auflösung berechnen:
			list($picwidth, $picheight, $pictype, $picattr) = getimagesize("../admin/pics/".$picture[0]);

			echo "<IMG border='1' SRC='../admin/pics/$picture[0]' alt='Klicken Sie auf das Bild, um ";
			echo "eine Darstellung in voller Gr&ouml;ße zu erreichen.' ";

			if ($picwidth > 300)
			{
				$fac = ($picwidth / 300);
				$picwidth = round($picwidth / $fac, 0);
				$picheight = round($picheight / $fac, 0);
			}

			echo "width='".$picwidth."' height='".$picheight."'></a></p>".chr(13).chr(10);
		}
	}

	echo "<SPAN CLASS=he2>".$Headline2[0]."</SPAN><BR><BR>".chr(13).chr(10);


	// 5.) Hat dieses Event ein Inhaltsobjekt?
	if($contentid[0]!="")
	{
		// Die Tabellendaten ermitteln:
		$strSQL = "SELECT * FROM skk_content WHERE id=".$contentid[0]." AND del='N' AND modifieddate IS NULL;";
		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

		// Konnte ein Datensatz gefunden werden?
		if ($RecordCount > 0 )
		{
			$i = 0;
				
			while ($row = $rs->fetch_object())
			{
				$ID[$i] = $row->id;
				$Datum[$i] = $row->contentdate;
				$Titel[$i] = $row->title;
				$Kategorie[$i] = $row->category;
				$Content[$i] = $row->content;
				$i++;
			}
			
			echo "<BR><BR>".formatoutput($Content[0])."<BR><BR>".chr(13).chr(10);
		}
	}

	echo "<DIV ALIGN=JUSTIFY>".formatoutput($Text[0])."</DIV><BR><BR>".chr(13).chr(10);

	// 6.) Die Anzahl der Aufrufe aktualisieren:
	$strSQL = "UPDATE skk_news SET hits=".($Hits[0]+1)." WHERE ID=".$Nr." AND del='N' AND modifieddate IS NULL";

	if (!mysqli_query ($objDBCon, $strSQL))
	{
		echo("Fehler beim Aktualisieren des Zählers!<P>");
		echo mysql_error($objDBCon);
	}

	// ##############
	// 7.) Der Autor:
	echo "<TABLE width='100%'>".chr(13).chr(10);
	echo "<TR><TD width='33%'>Autor dieser Meldung:</TD><TD width='66%'>".$Autor[0]."</TD></TR>";
	$strAuthor = $Autor[0];

	// Gab es zwischenzeitlich eine Änderung an der Meldung durch eine
	// andere Person?

	if (strtolower(trim($Autor[0])) != strtolower(trim($creator[0])))
   	 {
    		// Stammt diese Änderung von der Altdatenübernahme???
	    	if (strtoupper(trim($creator[0])) != "ALTDATENÜBERNAHME PROWIDE")
    		{
    			echo "<TR><TD>Zuletzt ge&auml;ndert von: </TD><TD>".$creator[0]." (am ";
	    		echo substr($createdate[0], 8, 2).".".substr($createdate[0],5,2).".".substr($createdate[0],0,4).")</TD></TR>".chr(13).chr(10);
    		}
	}

	// ################
	// 8.) Die Aufrufe:
	if ($Hits[0]=="0")
	{
		echo "<TR><TD>Aufrufe:</TD><TD>Dieser Artikel wurde bisher noch nicht gelesen.</TD></TR>".chr(13).chr(10);
	}
	else
	{
		echo "<TR><TD>Aufrufe:</TD><TD>Dieser Artikel wurde bisher ".$Hits[0]." Mal gelesen.</TD></TR>".chr(13).chr(10);
	}
	echo "</TABLE>";

	// ####################
	// 9.) Die Kommentare:
 	$Nr2 = $Nr;
	$strSQL="select * from skk_comments WHERE Nr=".$Nr." AND DEL='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	$i = 0;
				
	while ($row = $rs->fetch_object())
	{
   		$ID[$i] = $row->id;
   		$Nr[$i] = $row->nr;
   		$Datum[$i] = $row->createdate;
   		$NameAntwort[$i] = $row->nameanswer;
   		$Antwort[$i] = $row->answer;
   		
   		$i++;
  	}

	if ($RecordCount > 0)
	{
	  echo "<BR><BR><SPAN CLASS=red_head>Kommentare zu dieser Meldung:</SPAN><BR>".chr(13).chr(10);
	  echo "<HR noshade color='C3CCD0' size=1>".chr(13).chr(10);
	  echo "<table width='100%'>".chr(13).chr(10);

	  for($i=0; $i<$RecordCount; $i++)
	  {
		$strItem = formatoutput($NameAntwort[$i]);
		echo "<tr><td valign=top width='33%'><b>von ".($strItem).":</b></td>".chr(13).chr(10);

		$strItem = formatoutput($Antwort[$i]);
		echo "<td width='66%'>".$strItem."</td></tr>".chr(13).chr(10);
	  }

	  echo "</table>".chr(13).chr(10);
	}

	// #############################################
	// Kommentareingabe ermöglichen, falls zulässig:
	// D.h., falls Autor eine Emailadresse hat!
	$strSQL = "SELECT * FROM skk_members WHERE del='N' AND active!='N'";
	$strSQL = $strSQL." AND (mail IS NOT NULL AND mail !='');";
	$bFound = "FALSE";
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$row = $rs->fetch_object();
		
		$strTmpName = "";
   		$strTmpName = trim($row->vorname);
   		$strTmpName = $strTmpName." ".trim($row->name);
		$strTmpMail = trim($row->mail);

	   	if ($strAuthor == $strTmpName)
   		{
   			$bFound = "TRUE";
   		}
	}

	// ###########################################################################
	// Konnte der Benutzer mit Emailadresse gefunden werden und darf ein Kommentar gepostet werden?
	if( ($bFound == "TRUE") && (strtolower($allowcomment[0])=='j'))
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<B>Ja, ich m&ouml;chte zu diesem Artikel etwas sagen:</B>".chr(13).chr(10);
		echo "<FORM METHOD=POST ACTION='../sites/comment_ok.php'>".chr(13).chr(10);
		echo "<INPUT TYPE=HIDDEN VALUE='".$_GET["Nr"]."' NAME=Nr>".chr(13).chr(10);

		echo "<TABLE width='100%' border=1 bgcolor='#C0C0C0'>".chr(13).chr(10);
		echo "<TR><TD width='100%'><I><U>Hinweis:</U><BR><BR>Pflichtfelder f&uuml;r die Eingabe sind mit einem * gekennzeichnet. Aus Sicherheitsgr&uuml;nden sind ".chr(13).chr(10);
		echo "englischsprachige Begriffe bei der Eingabe unzul&auml;ssig, ebenso HTML - Tags, Emailadressen und Hyperlinks.".chr(13).chr(10);
		echo "</I></TD></TR>".chr(13).chr(10);
		echo "</TABLE>".chr(13).chr(10);

	 	echo "<TABLE width='100%' border=1>".chr(13).chr(10);
		echo "<TR><TD width='33%'><U><B>Name (max. 255 Zeichen): *</U></B></TD>".chr(13).chr(10);
	 	echo "<TD width='66%'><INPUT TYPE=TEXT SIZE=255 maxlength='255' style='width:100%' NAME=NameAntwort ".chr(13).chr(10);
	 	echo "TITLE='Geben Sie hier bitte Ihren Namen ein. Dieser wird dann zusammen mit Ihrem Kommentar bei ".chr(13).chr(10);
	 	echo "dieser Meldung angezeigt.'></TD>".chr(13).chr(10);
		echo "</TR>".chr(13).chr(10);
		echo "<TR>".chr(13).chr(10);
	 	echo "<TD VALIGN=top><U><B>Kommentar (max. 1024 Zeichen): *</U></B></TD>".chr(13).chr(10);
	 	echo "<TD VALIGN=top><TEXTAREA COLS=50 ROWS=8 NAME=Antwort maxlength='1024' style='width:100%' TITLE='Geben Sie hier Ihren Kommentar zu dieser Meldung ein.'></TEXTAREA></TD>".chr(13).chr(10);
		echo "</TR></TABLE>".chr(13).chr(10);

		echo "<TABLE width='100%'><TR>".chr(13).chr(10);
	 	echo "<TD width='33%' VALIGN=top>&nbsp;</TD>".chr(13).chr(10);
	 	echo "<TD width='66%' VALIGN=top><INPUT TYPE=SUBMIT VALUE='Kommentar speichern'></TD>".chr(13).chr(10);
		echo "</TR>".chr(13).chr(10);
		echo "</TABLE>".chr(13).chr(10);
		echo "</FORM>".chr(13).chr(10);
	}

	// Der übliche Rest:
  	include("100_middler.php");

	include("100_downloads.php");
	get_downloads($objDBCon);
	include("100_footer.php");
?>















