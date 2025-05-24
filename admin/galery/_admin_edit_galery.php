<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Fotogalerie bearbeiten");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/date/date.php")?>
<?php include("../../includes/string/str.php")?>
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

	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("../_admin_param_ux.php");


	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "R")==0)
	{
		// Keine Gültigkeit mehr!
		include("../../includes/forms/middler.php");
		include("../forms/navigation_access_denied.php");
		include("../../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("../_admin_param_dx.php");

	$objectclassicon = "galery.gif";
	include("../forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Galerie bearbeiten (GALERY - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ################
	// Die ID erfragen:
	$Nr = strGetParam($objDBCon, "Nr");
	
	// #############################
	// 6.) Die Galeriedaten holen:
	$strSQL = "select * from skk_galery WHERE id=".$Nr." AND del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
         	$ID[$i] = $row->id;
         	$galery[$i] = $row->galery;
         	$category[$i] = $row->category;
         	$galerydate[$i] = $row->galerydate;
         	$i++;
		}
	}

	// #####################
  	include("../forms/fields_not_null.php");

	// #####################
  	echo "<FORM METHOD=POST ACTION='_admin_edit_galery_ok.php?ux=".$ux."&dx=".$dx."&Nr=".$Nr."' enctype='multipart/form-data'>".chr(13).chr(10);
  	echo "<INPUT TYPE=HIDDEN NAME='Nr' Value='".$Nr."'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
  	echo "<INPUT TYPE=HIDDEN NAME='ux' Value='$ux'>".chr(13).chr(10);
  	echo "<INPUT TYPE=HIDDEN NAME='dx' Value='$dx'>".chr(13).chr(10);

  	echo "<table cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);


	// #########
	// Name:
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Name der Fotogalerie (max. 100 Zeichen): *</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Hier geben Sie den Namen der Fotogalerie ein.</I>";
	}
	echo "</TD></TR>".chr(13).chr(10);
	echo "<tr><td><INPUT TYPE=Text NAME=galery style='width:100%' VALUE='".formatoutput($galery[0])."' size=100 MAXLENGTH=100></td></tr>".chr(13).chr(10);


	// #######################
	// Kategorie:
	echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Kategorie:</U></B> *";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>";
		echo "<I>Je nach gew&auml;hlter Kategorie wird diese Fotogalerie dann in der Liste mit einem anderen f&uuml;hrenden Icon dargestellt.</I>";
	}

	echo "</TD></TR>";

	echo "<TR><TD width='100%'>";
	echo "<SELECT NAME=category style='width:100%'>";

	if ($category[0]=="Erwachsene") { echo "<OPTION>Erwachsene<OPTION>Jugend<OPTION>AFRO<OPTION>Sport</SELECT></TD></TR>".chr(13).chr(10); }
	if ($category[0]=="Jugend"){ echo "<OPTION>Erwachsene<OPTION SELECTED>Jugend<OPTION>AFRO<OPTION>Sport</SELECT></TD></TR>".chr(13).chr(10); }
	if ($category[0]=="AFRO"){ echo "<OPTION>Erwachsene<OPTION>Jugend<OPTION SELECTED>AFRO<OPTION>Sport</SELECT></TD></TR>".chr(13).chr(10); }
	if ($category[0]=="Sport"){ echo "<OPTION>Erwachsene<OPTION>Jugend<OPTION>AFRO<OPTION SELECTED>Sport</SELECT></TD></TR>".chr(13).chr(10); }

	echo "</TABLE>".chr(13).chr(10);

	// Das Datum holen:
	echo "<TABLE width='100%' border=1>".chr(13).chr(10);
	echo "<TR><TD width='50%' bgcolor='#C0C0C0'><B><U>Datum der Fotogalerie: *</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Hier geben Sie das Datum der Meldung ein. Es wird Ihnen automatisch das Systemdatum vorgeschagen. ";
		echo "Das hier gew&auml;hlte Daum ist ma&szlig;geblich f&uuml;r die Zuordnung der Meldung in der Liste der News zu einem ";
		echo "bestimmten Monat und ein bestimmtes Jahr. Das Eingabeformat ist TT.MM.JJJJ.</I>";
	}
	echo "</TD>".chr(13).chr(10);
	echo "<TD width='50%'>".chr(13).chr(10);

	// Das Datum vorsteuern:
	$curYear = substr($galerydate[0],0,4);
	$curMonth = substr($galerydate[0],5,2);
	$curDay = substr($galerydate[0],8,2);

 	writeDateField("galerydate_day", "galerydate_month", "galerydate_year", $curDay, $curMonth, $curYear, "FALSE");

 	echo "</TD></TR></TABLE>".chr(13).chr(10);
	echo "<table cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);

	// #################
	// Liste der Bilder:

	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Bilder in dieser Galerie:</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Erlaubte Dateitypen: jpg, jpeg, gif, png / Max. Gr&ouml;&szlig;e: 250 KB / Keine Sonderzeichen im ";
		echo "Dateinamen. Mehrere Bilddateien k&ouml;nnen zeitgleich als ZIP-Datei hochgeladen werden. Diese darf jedoch nicht gr&ouml;&szlig;er als 10 MB sein!</I>";
	}

	echo "</td></tr></table>";
	echo "<table cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);

	// Stelle für das neue Anlegen eines weiteren Bildes:
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Neue Bilddatei:</U></B></td><td><input type='file' name='file' style='width:100%'></td></tr>".chr(13).chr(10);
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Kommentar zu neuer Bilddatei:</U></B></TD><td><INPUT TYPE=Text NAME='newcomment' style='width:100%' size=100 MAXLENGTH=255></td></tr>".chr(13).chr(10);
	
	// Upload für ZIP-Archiv:
	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Neue Bilddateien als Zip-Archiv hochladen:</U></B></td><td><input type='file' name='filezip' style='width:100%'></td></tr>".chr(13).chr(10);
	
	
  	echo "</table>".chr(13).chr(10);

  	// Die aktuelle Zahl der Bilder sichern:
  	echo "<INPUT TYPE=HIDDEN NAME='numberofpictures' VALUE='".$RecordCount."'>".chr(13).chr(10);
  	echo "<BR><INPUT TYPE=submit VALUE='Galerie aktualisieren'>".chr(13).chr(10);
  	echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'><BR><BR>".chr(13).chr(10);

	// #################################################
	// Der Teil mit den Bildern:
	// Prüfen, ob Bilder bereits hinterlegt worden sind:
	$strSQL = "select * from skk_galery_pics WHERE id_galery=".$Nr." AND del='N' AND modifieddate IS NULL ORDER BY filecreatedate ASC;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		echo "<table cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);

		echo "<TR>".chr(13).chr(10);
		echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Bereits vorhandene Bilder in dieser Galerie (Anzahl ".$num.", sotiert nach Erstellungsdatum):</U></B>";
		
		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Erlaubte Dateitypen: jpg, jpeg, gif, png / Max. Gr&ouml;&szlig;e: 250 KB / Keine Sonderzeichen im ";
			echo "Dateinamen. Mehrere Bilddateien k&ouml;nnen zeitgleich als ZIP-Datei hochgeladen werden. Diese darf jedoch nicht gr&ouml;&szlig;er als 10 MB sein!</I>";
		}
			
		echo "</td></tr></table>";
		echo "<table cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);
		
		// Es wurden bereits Bilder hinterlegt:
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
         	$picture[$i] = $row->picture;
         	$comment[$i] = $row->comment;

         	// Wurde ein Bild hinterlegt?
			// ######################
		  	// $uploaddir = getcwd();
			// Neues Upload - Verzeichnis!
		  	$uploadfile = $picture[$i];

		  	if (is_file($uploadfile))
		  	{
		    	echo "<tr><TD valign=top bgcolor='#C0C0C0' width='50%'><B><U>Bild:</U></B></td>".chr(13).chr(10);

		    	// Die Auflösung berechnen:
				list($picwidth, $picheight, $pictype, $picattr) = getimagesize($uploadfile);


				if ($picwidth > 75)
				{
					$fac = ($picwidth / 75);
					$picwidth = round($picwidth / $fac, 0);
					$picheight = round($picheight / $fac, 0);
				}

		    	echo "<td width='50%'><img src='".$picture[$i]."' align='left' width='".$picwidth."' height='".$picheight."'>";
				echo "</TD></tr>".chr(13).chr(10);

				// Der interne Dateiname:
				echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Interner Dateiname des Bildes:</U></B></td>";
				echo "<TD>".$picture[$i]."</td></tr>".chr(13).chr(10);
				
				// Erstellungsdatum:
				$createtime = date("Y-m-d H:i:s", filemtime($picture[$i]));
				echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Erstellungsdatum der Bilddatei:</U></B></td>";
				echo "<TD>".substr($createtime,8,2).".".substr($createtime,5,2).".".substr($createtime,0,4)." ".substr($createtime,11,8)."</td></tr>".chr(13).chr(10);
				
				// Bild löschen:
		    	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Bild l&ouml;schen:</U></B></td>".chr(13).chr(10);
		    	echo "<td><INPUT TYPE='CHECKBOX' NAME='delpicture".$i."'</td></tr>".chr(13).chr(10);

		    	// Kommentar:
		    	echo "<tr><TD valign=top bgcolor='#C0C0C0'><B><U>Kommentar:</U></B></td>";
				echo "<TD><INPUT TYPE=Text NAME='comment".$i."' style='width:100%' value='".$comment[$i]."' size=100 MAXLENGTH=255></td></tr>".chr(13).chr(10);

		    	echo "<tr><TD><INPUT TYPE=HIDDEN NAME='oldpicture".$i."' VALUE='".$picture[$i]."'></TD><TD></TD></TR>".chr(13).chr(10);
		  	}
		  	$i++;
		}
		echo "</TABLE>";
	}


  	echo "</FORM>".chr(13).chr(10);

  	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
  	include("../forms/navigation.php");
  	writenavigation($objDBCon, $ux, $dx);

  	include("../../includes/forms/footer.php");
?>