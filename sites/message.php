<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Meldung");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/db/news_get.php")?>
<?php include("../includes/db/content_get.php")?>
<?php include("../includes/db/comment_get.php")?>
<?php include("../includes/string/str.php")?>
<?php include_once("../includes/date/date.php")?>
<?php include("../admin/_admin_param.php")?>
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
	$Nr = strGetParam($objDBCon, "Nr");
	$strSQL = "select * from skk_news WHERE id=".$Nr." AND del='N' AND modifieddate IS NULL";

	// ################
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
			$creator[$i] = $row->creator;
			$createdate[$i] = $row->createdate;
			$allowcomment[$i] = $row->allowcomment;
			$i++;   
		}

		// ###################
		// 4.) Daten ausgeben:
		$strItem = formatoutput($Headline[0]);

		echo "<SPAN CLASS=he1>".$strItem."</SPAN><BR><BR>".chr(13).chr(10);

		// Hat dieses Event ein Bild?
		//echo $picture[0];
		
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

		$strItem = formatoutput($Headline2[0]);


		if (trim($strItem)!="")
		{
			echo "<SPAN CLASS=he2>".$strItem."</SPAN><BR><BR>".chr(13).chr(10);
		}

		// ###########################################
		// 5.) Hat dieses Event ein Mannschaftsobjekt?
		if($teamid[0]!="")
		{
			// Die Tabellendaten ermitteln:
			$strSQL = "SELECT * FROM skk_teams WHERE id=".$teamid[0]." AND del='N' AND modifieddate IS NULL;";
			$rs = mysqli_query($objDBCon, $strSQL);
			$RecordCount = mysqli_num_rows($rs);

			// Konnte ein Datensatz gefunden werden?
			if ($RecordCount > 0 )
			{
				$i = 0;
					
				while ($row = $rs->fetch_object())
				{
					$ID[$i] = $row->id;
					$team[$i] = formatoutput($row->team);
					$league[$i] = formatoutput($row->league);
					$i++;
				}
				
				echo "<BR>Betrifft Mannschaft: ".$team[0]." (".$league[0].")<BR><BR>".chr(13).chr(10);
			}
		}

		// #######################################
		// 6.) Hat dieses Event ein Inhaltsobjekt?
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
					$Datum[$i] = formatoutput($row->contentdate);
					$Titel[$i] = formatoutput($row->title);
					$Kategorie[$i] = formatoutput($row->category);
					$Content[$i] = formatoutput($row->content);
					$i++;
				}
				
				// Escape - Zeichen entfernen:
				$strItem = $Content[0];
				$strItem = str_replace("\'", "'", $strItem);
				$strItem = str_replace("\\".chr(34), chr(34), $strItem);

				echo "<BR>".$strItem."<BR>".chr(13).chr(10);
			}
		}

		// Escape - Zeichen entfernen:
		$strItem = formatoutput($Text[0]);
		echo "<DIV ALIGN=JUSTIFY>".$strItem."</DIV><BR><BR>".chr(13).chr(10);

		// #########################################
		// 7.) Die Anzahl der Aufrufe aktualisieren:
		$intCounterOld = intval(trim($Hits[0]), 10);
		$intCounterNew = $intCounterOld + 1;

		$strSQL = "UPDATE skk_news SET hits=".strval($intCounterNew)." WHERE ID=".$Nr." AND del='N' AND modifieddate IS NULL";
		//echo "CCC".$strSQL."CCC".chr(13).chr(10);

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo "Fehler beim Aktualisieren des Z&auml;hlers!<P>".chr(13).chr(10);
			echo mysqli_error($objDBCon);
		}
		
		// ##################
		// UPDATE 23.05.2020:
		// Die IP - Adresse des Anfragers:
		$ip = $_SERVER['REMOTE_ADDR'];
		
		// Das Betriebssystem des Anfragers:
		$os = $_SERVER['HTTP_USER_AGENT'];
		
		// Ermittelt den zur angegebenen IP-Adresse passenden Internet-Hostnamen:
		$pc = gethostbyaddr($ip);
		
		// Argumente ausführungssicher machen:
		$ip = mysqli_escape_string($objDBCon, $ip);
		$os = mysqli_escape_string($objDBCon, $os);
		$pc = mysqli_escape_string($objDBCon, $pc);
		
		$strSQL = "INSERT INTO skk_news_hits (news_id, hits_old, hits_new, ip, os, pc, creator) VALUES (";
		$strSQL = $strSQL.$Nr.", ".strval($intCounterOld).", ".strval($intCounterNew).", '".$ip."', '".$os."', '".$pc."', 'SYSTEM');";
		    
		if (!mysqli_query ($objDBCon, $strSQL))
		{
		    //echo "Fehler beim Aktualisieren des Z&auml;hlers in der Tabelle skk_news_hits!<P>".chr(13).chr(10);
		    //echo mysqli_error($objDBCon);
		}
		    
		// UPDATE Ende
		// ###########

		// ##############
		// 8.) Der Autor:
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
		// 9.) Die Aufrufe:
		$strSQL = "SELECT news_id FROM skk_news_hits WHERE news_id = ".$Nr;
		$rsCalls = mysqli_query($objDBCon, $strSQL);
		$CallRecordCount = mysqli_num_rows($rsCalls);
		
		if ($CallRecordCount == 0)
		{
			echo "<TR><TD>Aufrufe:</TD><TD>Dieser Artikel wurde bisher noch nicht gelesen.</TD></TR>".chr(13).chr(10);
		}
		else
		{
		    echo "<TR><TD>Aufrufe:</TD><TD>Dieser Artikel wurde bisher ".$CallRecordCount." Mal gelesen.</TD></TR>".chr(13).chr(10);
		}
		
		echo "</TABLE>";

		// ####################
		// 10.) Die Kommentare:
 		$Nr2 = $Nr;
		$strSQL="select * from skk_comments WHERE Nr=".$Nr." AND DEL='N' AND modifieddate IS NULL ORDER BY UNIX_TIMESTAMP('createdate') DESC;";

		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

		if ($RecordCount > 0 )
		{
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
		}

		if ($RecordCount > 0)
		{
	 	 	echo "<BR><BR><SPAN CLASS=red_head>Kommentare zu dieser Meldung:</SPAN><BR>".chr(13).chr(10);
		  	echo "<HR noshade color='#5B2E00' size=1>".chr(13).chr(10);
		  	echo "<table width='100%' border=1>".chr(13).chr(10);
		  	echo "<tr><td bgcolor='#C0C0C0' valign=top width='33%'><i>Name und Zeitpunkt</i></td><td bgcolor='#C0C0C0' width='66%'><i>Kommentar</i></td>".chr(13).chr(10);
		  	
		  	for($i = 0; $i < $RecordCount; $i++)
		  	{
				$strItem = formatoutput($NameAntwort[$i]);
				echo "<tr><td valign=top width='33%'><b>".($strItem)."</b> schrieb am ".substr($Datum[$i], 8, 2).".".substr($Datum[$i],5,2).".".substr($Datum[$i],0,4)." gegen ".substr($Datum[$i], 11, 5)." Uhr</td>".chr(13).chr(10);

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
			$i = 0;
			
			while ($row = $rs->fetch_object())
			{
				$strTmpName = "";				
				$strTmpName = trim($row->vorname);
				$strTmpName = $strTmpName." ".trim($row->name);
				$strTmpMail = trim($row->mail);
				
				if ($strAuthor == $strTmpName)
				{
					$bFound = "TRUE";
				}
				
				$i++;
			}
		}
	}

	// ############################################################################################
	// Konnte der Benutzer mit Emailadresse gefunden werden und darf ein Kommentar gepostet werden?
	if( ($bFound == "TRUE") && (strtolower($allowcomment[0])=='j'))
	{
		// ##################
		// UPDATE 13.07.2015:
		// Die Kommentarfunktion nur dann anbieten, wenn der Bericht nicht älter als ein Jahr ist!
		$now = date("Y-m-d H:i:s");
		$interval = round(s_datediff("d", $now, $Datum[0]));

		// UPDATE: 07.02.2016:
		// Verkürzung auf 90 Tage statt bisher 1 Jahr!
		if ($interval < 90)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<B>Ja, ich m&ouml;chte zu diesem Artikel etwas sagen:</B><BR><BR>".chr(13).chr(10);
			echo "<FORM METHOD=POST ACTION=".chr(34)."comment_ok.php".chr(34).">".chr(13).chr(10);
			echo "<INPUT TYPE=HIDDEN VALUE=".chr(34)."".$_GET["Nr"]."".chr(34)." NAME=Nr>".chr(13).chr(10);

			echo "<TABLE width=".chr(34)."100%".chr(34)." border=1 bgcolor=".chr(34)."#C0C0C0".chr(34).">".chr(13).chr(10);
			echo "<TR><TD width=".chr(34)."100%".chr(34)."><I><U>Hinweis:</U><BR><BR>Pflichtfelder f&uuml;r die Eingabe sind mit einem * gekennzeichnet. Aus Sicherheitsgr&uuml;nden sind ".chr(13).chr(10);
			echo "englischsprachige Begriffe bei der Eingabe unzul&auml;ssig, ebenso HTML - Tags, Emailadressen und Hyperlinks. Wir weisen darauf hin, dass die jeweilige IP-Adresse ";
			echo "des Verfassers beim Erzeugen eines Kommentars mit protokolliert wird. Durch Nutzen der Kommentarfunktion erkl&auml;ren Sie sich hiermit einverstanden.".chr(13).chr(10);
			echo "</I></TD></TR>".chr(13).chr(10);
			echo "</TABLE>".chr(13).chr(10);

	 		echo "<TABLE width=".chr(34)."100%".chr(34)." border=1>".chr(13).chr(10);
			echo "<TR><TD width=".chr(34)."33%".chr(34)."><SPAN CLASS=".chr(34)."Pflichteingabe".chr(34).">Name (max. 255 Zeichen): *</SPAN></TD>".chr(13).chr(10);
	 		echo "<TD width=".chr(34)."66%".chr(34)."><INPUT TYPE=TEXT SIZE=255 maxlength=".chr(34)."255".chr(34)." style=".chr(34)."width:100%".chr(34)." NAME=NameAntwort ".chr(13).chr(10);
	 		echo "TITLE='Geben Sie hier bitte Ihren Namen ein. Dieser wird dann zusammen mit Ihrem Kommentar bei ".chr(13).chr(10);
	 		echo "dieser Meldung angezeigt.'></TD>".chr(13).chr(10);
			echo "</TR>".chr(13).chr(10);
			echo "<TR>".chr(13).chr(10);
	 		echo "<TD VALIGN=top><SPAN CLASS=".chr(34)."Pflichteingabe".chr(34).">Kommentar (max. 1024 Zeichen): *</SPAN></TD>".chr(13).chr(10);
	 		echo "<TD VALIGN=top><TEXTAREA COLS=50 ROWS=8 NAME=Antwort maxlength='1024' style=".chr(34)."width:100%".chr(34)." TITLE=".chr(34)."Geben Sie hier Ihren Kommentar zu dieser Meldung ein.".chr(34)."></TEXTAREA></TD>".chr(13).chr(10);
			echo "</TR>".chr(13).chr(10);
			
			// UPDATE: 02.11.2019:
			// Nach neuer Rechtslage bedarf das Speichern der Anwenderdaten dessen explizite Zustimmung!
			echo "<TR>".chr(13).chr(10);
			echo "<TD VALIGN=top><SPAN CLASS=".chr(34)."Pflichteingabe".chr(34).">Mit dem Speichern der oben genannten Daten bin ich einverstanden: *<SPAN></TD>".chr(13).chr(10);
			echo "<TD VALIGN=top><INPUT TYPE=".chr(34)."CHECKBOX".CHR(34)." Name=".chr(34)."chkSaveOK".chr(34)."/></TD>".chr(13).chr(10);
			echo "</TR>".chr(13).chr(10);
			echo "</TABLE>".chr(13).chr(10);
			
			echo "<TABLE width=".chr(34)."100%".chr(34)."><TR>".chr(13).chr(10);
	 		echo "<TD width=".chr(34)."33%".chr(34)." VALIGN=top>&nbsp;</TD>".chr(13).chr(10);
	 		echo "<TD width=".chr(34)."66%".chr(34)." VALIGN=top><INPUT TYPE=SUBMIT VALUE=".chr(34)."Kommentar speichern".chr(34)."></TD>".chr(13).chr(10);
			echo "</TR>".chr(13).chr(10);
			echo "</TABLE>".chr(13).chr(10);
			echo "</FORM>".chr(13).chr(10);
		}
		else
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<B>Der vorliegende Bericht ist &auml;lter als ein Jahr und kann daher nicht mehr mit Kommentaren versehen werden!</B>".chr(13).chr(10);
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















