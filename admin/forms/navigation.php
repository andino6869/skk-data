<?php
	// Als Parameter wird hier die verschlüsselte USER - ID mit übergeben:
	// $ux: Die verschlüsselte ID des aktuellen Benutzers:
	// $dx: Angabe des Dispatchers (Sollen die Hilfetexte angezeigt werden oder nicht?)
	// ###################################
	// Modul-Update August 2019
	// ###################################

function writenavigationItem($strGraphicFile, $strURLToCall = "", $strURLParams = "", $strCaption = "", $strCurrentTitle = "", $strGraphicWidth = "", $strGraphicHeigth = "")
{
	// Schreibt in Abhängigkeit der gerade aktuellen Verzeichnisposition 
	// Die Grafik samt URL in das Menü.
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	
	if (is_file("../pics/admin/".$strGraphicFile))
	{
		if (is_file($strURLToCall))
		{
			echo "<A HREF='".$strURLToCall.$strURLParams."' TITLE='".$strCurrentTitle."'><IMG SRC='../pics/admin/".$strGraphicFile."' ".trim($strGraphicWidth." ".$strGraphicHeigth)." border=0>".chr(13).chr(10);
		}
		else
		{
			echo "<A HREF='../".$strURLToCall.$strURLParams."' TITLE='".$strCurrentTitle."'><IMG SRC='../pics/admin/".$strGraphicFile."' ".trim($strGraphicWidth." ".$strGraphicHeigth)." border=0>".chr(13).chr(10);
		}
	}
	else
	{
		if (is_file("../../pics/admin/".$strGraphicFile))
		{
			echo "<A HREF='../".$strURLToCall.$strURLParams."' TITLE='".$strCurrentTitle."'><IMG SRC='../../pics/admin/".$strGraphicFile."' ".trim($strGraphicWidth." ".$strGraphicHeigth)." border=0>".chr(13).chr(10);
		}
		else
		{
			echo "<A HREF='../../".$strURLToCall.$strURLParams."' TITLE='".$strCurrentTitle."'><IMG SRC='../../../pics/admin/".$strGraphicFile."' ".trim($strGraphicWidth." ".$strGraphicHeigth)." border=0>".chr(13).chr(10);
		}
	}
	
	echo $strCaption."</A><BR>".chr(13).chr(10);
}



function writenavigationItemHeader($strGraphicFile, $strCaption)
{
	// Schreibt die Teilüberschriften in dem Menü samt Trennzeile.
	echo "<BR><HR noshade size=1>".chr(13).chr(10);
	
	if (is_file("../pics/admin/".$strGraphicFile))
	{
		echo "<IMG SRC='../pics/admin/".$strGraphicFile."' border=0 width=10 hight=10>".chr(13).chr(10);
	}
	else
	{
		if (is_file("../../pics/admin/".$strGraphicFile))
		{
			echo "<IMG SRC='../../pics/admin/".$strGraphicFile."' border=0 width=10 hight=10>".chr(13).chr(10);
		}
		else
		{
			echo "<IMG SRC='../../../pics/admin/".$strGraphicFile."' border=0 width=10 hight=10>".chr(13).chr(10);
		}
	}
	
	echo "<SPAN CLASS=red_head>".chr(13).chr(10);
	echo $strCaption.chr(13).chr(10);
	echo "</SPAN>".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);
}



  function writenavigation($objDBCon, $ux, $dx = 0)
  {
    // Das Sicherheitslevel des Benutzers ermitteln:
    $id = base64_decode($ux);
    $id = strrev($id);

    // Die Daten aus der Datenbank ermitteln:
    $strSQL = "select active from skk_members WHERE id=".$id." AND del='N' AND modifieddate IS NULL;";

    $rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

    // Welches Sicherheitslevel ist zulässig?
    if ($RecordCount > 0)
    {
      // R = Redakteur
      // H = Redakteur und Homepagepflege
      // A = Admin
      $row = $rs->fetch_object();
      $cursecuritylevel = $row->active;
    }
    else
    {
      // Anwender ist nur Redakteur:
      $cursecuritylevel = "R";
    }
    
    echo "<SPAN CLASS=red_head>";
	echo "Funktionsmen&uuml;<HR noshade size=1>".chr(13).chr(10);
	echo "</SPAN><BR>";

	// ########################################
	// Hier beginnt das Menü:

	// ########################################
	// 1.) Administration:

    // ########################################
	// 1.1.) Benutzer abmelden:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um sich wieder aus dem Administrationsbereich abzumelden.";
	writenavigationItem("close.png", "_admin_logout.php","?ux=".$ux."&dx=".$dx, " Aus dem Reaktionssystem abmelden", $strCurrentTitle);
	
    // ###################################################
    // 1.2.) Zurück auf die Startseite:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um wieder auf die erste Seite des Administrationsbereichs zu wechseln.";
	writenavigationItem("home.png", "_admin_index.php","?ux=".$ux."&dx=".$dx, " Startseite des Reaktionssystems aufrufen", $strCurrentTitle);
	
    // ###################################################
    // 1.3.) Mitgliedsdaten ändern:
	$Nr = base64_decode($ux);
	$Nr = strrev($Nr);

	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um Ihre eigenen Mitgliedsdaten zu &auml;ndern.";
	writenavigationItem("member.png", "members/_admin_edit_member.php","?ux=".$ux."&dx=".$dx."&Nr=".$Nr, " Die eigenen Mitgliedsdaten &auml;ndern", $strCurrentTitle, "width='12'", "heigth='12'");
	

	// ########################################
	// 2.) News & Meldungen:
	writenavigationItemHeader("thunder.png", "News & Meldungen");

	// ########################################
	// 2.1.) Neu:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine neue Meldung zu erzeugen.";
	writenavigationItem("new.png", "_admin_newseingabe.php","?ux=".$ux."&dx=".$dx, " Neu erzeugen", $strCurrentTitle);
	
	// ########################################
	// 2.2.) Bearbeiten:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine bereits vorhandene Meldung zu bearbeiten.";
	writenavigationItem("edit.png", "_admin_select.php","?ux=".$ux."&dx=".$dx."&objectclass=NEWS", " Bearbeiten", $strCurrentTitle);
	
	// ########################################
	// 2.3.) Löschen:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine bereits vorhandene Meldung zu l&ouml;schen.";
	writenavigationItem("delete.png", "_admin_delete.php","?ux=".$ux."&dx=".$dx."&objectclass=NEWS", " L&ouml;schen", $strCurrentTitle);

	
	// ########################################
	// 2.1.) Schachdiagramme:
	writenavigationItemHeader("schachbrett.png", "Schachdiagramme");
	
	// ########################################
	// 2.1.1.) Neu:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eines Schachdiagramm hochzuladen.";
	writenavigationItem("new.png", "diagramme/_admin_new.php","?ux=".$ux."&dx=".$dx, " Neu erzeugen", $strCurrentTitle);
	
	// ########################################
	// 2.1.2.) Bearbeiten:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine bereits vorhandenes Schachdiagramm zu bearbeiten.";
	writenavigationItem("edit.png", "_admin_select.php","?ux=".$ux."&dx=".$dx."&objectclass=DIAGRAMME", " Bearbeiten", $strCurrentTitle);
	
	// ########################################
	// 2.1.3.) Löschen:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um ein bereits vorhandenes Schachdiagramm zu l&ouml;schen.";
	writenavigationItem("delete.png", "_admin_delete.php","?ux=".$ux."&dx=".$dx."&objectclass=DIAGRAMME", " L&ouml;schen", $strCurrentTitle);
	
	
	// ##############################
	// Admin oder Homepagerverwalter:
 	if (($cursecuritylevel=="A") || ($cursecuritylevel=="H"))
	{
	 	// ########################################
		// 3.) Wir über uns:
	 	writenavigationItemHeader("about.png", "Wir &uuml;ber uns");
	 	
	 	// #################
 		// 3.1.) Bearbeiten:
	 	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um den Inhalt der Seite zu bearbeiten.";
	 	writenavigationItem("edit.png", "_admin_about.php","?ux=".$ux."&dx=".$dx, " Seite bearbeiten", $strCurrentTitle);
	 	
		// ################
		// 3.2.) Vorstände:
	 	echo "<BR>";
	 	
	 	// 3.2.1.) Neu:
	 	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen neuen Vorstand einzugeben.";
	 	writenavigationItem("new.png", "heads/_admin_new_head.php","?ux=".$ux."&dx=".$dx, " Vorstand neu eingeben", $strCurrentTitle);
	 	
	 	// 3.2.2.) Vorstand bearbeiten:
	 	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen vorhandenen Vorstand zu bearbeiten.";
	 	writenavigationItem("edit.png", "_admin_select.php","?ux=".$ux."&dx=".$dx."&objectclass=HEADS", " Vorstand bearbeiten", $strCurrentTitle);

	 	// 3.2.3.) Vorstand löschen:
	 	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen vorhandenen Vorstand zu l&ouml;schen.";
	 	writenavigationItem("delete.png", "_admin_delete.php","?ux=".$ux."&dx=".$dx."&objectclass=HEADS", " Vorstand l&ouml;schen", $strCurrentTitle);

		// ######################################
		// 3.3.) Vereinslokal:
	 	echo "<BR>";
		
	 	// 3.3.1.) Vereinslokal eingeben:
	 	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um ein neues Vereinslokal einzugeben.";
	 	writenavigationItem("new.png", "locals/_admin_new_local.php","?ux=".$ux."&dx=".$dx, " Vereinslokal neu eingeben", $strCurrentTitle);

	 	// 3.3.2.) Vereinslokal bearbeiten:
	 	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um ein vorhandenes Vereinslokal zu bearbeiten.";
	 	writenavigationItem("edit.png","_admin_select.php","?ux=".$ux."&dx=".$dx."&objectclass=LOCALS", " Vereinslokal bearbeiten", $strCurrentTitle);
	 	
	 	// 3.3.3.) Vereinslokal löschen:
	 	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um ein vorhandenes Vereinslokal zu l&ouml;schen.";
	 	writenavigationItem("delete.png", "_admin_delete.php","?ux=".$ux."&dx=".$dx."&objectclass=LOCALS", " Vereinslokal l&ouml;schen", $strCurrentTitle);
	 	 

		// #################
		// 3.4.) Geschichte:
		echo "<BR>";
		
		// 3.4.1.) Vereinslokal eingeben:
		$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine weitere Vereinsgeschichte einzugeben.";
		writenavigationItem("new.png", "_admin_new_history.php","?ux=".$ux."&dx=".$dx, " Geschichte neu eingeben", $strCurrentTitle);
		
		// 3.4.2.) Vereinslokal bearbeiten:
		$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine vorhandene Vereinsgeschichte zu bearbeiten.";
		writenavigationItem("edit.png", "_admin_select.php","?ux=".$ux."&dx=".$dx."&objectclass=HISTORY", " Geschichte bearbeiten", $strCurrentTitle);
		 
		// 3.4.3.) Vereinslokal löschen:
		$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine vorhandene Vereinsgeschichte zu l&ouml;schen.";
		writenavigationItem("delete.png", "_admin_delete.php","?ux=".$ux."&dx=".$dx."&objectclass=HISTORY", " Geschichte l&ouml;schen", $strCurrentTitle);
		
	    
		// ##############
		// 3.5.) Anfahrt:
		echo "<BR>";
		
		// 3.5.1.) Anfahrt bearbeiten:
		$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um die Anfahrt zum Vereinsheim zu bearbeiten.";
		writenavigationItem("edit.png", "_admin_journey.php","?ux=".$ux."&dx=".$dx, " Anfahrt bearbeiten", $strCurrentTitle);
		
		
 		// ########################################
		// 4.) Jugend:
		writenavigationItemHeader("youth.png", "Jugendseite");
		
		// 4.1.) Seite bearbeiten:
		$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um die Jugendseite des Vereins zu bearbeiten.";
		writenavigationItem("edit.png", "_admin_youth.php","?ux=".$ux."&dx=".$dx, " Seite bearbeiten", $strCurrentTitle);
	 }


   	// ###########
	// 5. Termine:
	writenavigationItemHeader("deadline.gif", "Termine");
	 
	// ########################################
	// 5.1.) Neu:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen neue Termin zu erzeugen.";
	writenavigationItem("new.png", "_admin_termineingabe.php","?ux=".$ux."&dx=".$dx, " Neu erzeugen", $strCurrentTitle);
	
	// ########################################
	// 5.2.) Bearbeiten:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen bereits vorhandenen Termin zu bearbeiten.";
	writenavigationItem("edit.png", "_admin_select.php","?ux=".$ux."&dx=".$dx."&objectclass=DEADLINES", " Bearbeiten", $strCurrentTitle);
	
	// ########################################
	// 5.3.) Löschen:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen bereits vorhandenen Termin zu l&ouml;schen.";
	writenavigationItem("delete.png", "_admin_delete.php","?ux=".$ux."&dx=".$dx."&objectclass=DEADLINES", " L&ouml;schen", $strCurrentTitle);
	
	
    // ###########################################
    // 6.) Mannschaften
	// Admin oder Homepagerverwalter:
    if (($cursecuritylevel=="A") || ($cursecuritylevel=="H"))
    {
    	writenavigationItemHeader("team.png", "Mannschaften");
    	
    	// ########################################
    	// 6.1.) Neu:
    	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine neue Mannschaft zu erzeugen.";
    	writenavigationItem("new.png", "_admin_new_team.php","?ux=".$ux."&dx=".$dx, " Neu erzeugen", $strCurrentTitle);
    	
    	// ########################################
    	// 6.2.) Bearbeiten:
    	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen bereits vorhandene Mannschaft zu bearbeiten.";
    	writenavigationItem("edit.png", "_admin_select.php","?ux=".$ux."&dx=".$dx."&objectclass=TEAMS", " Bearbeiten", $strCurrentTitle);
    	
    	// ########################################
    	// 6.3.) Löschen:
    	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen bereits vorhandene Mannschaft zu l&ouml;schen.";
    	writenavigationItem("delete.png", "_admin_delete.php","?ux=".$ux."&dx=".$dx."&objectclass=TEAMS", " L&ouml;schen", $strCurrentTitle);
    }

	// ###########################################
	// 7.) Partien
    writenavigationItemHeader("matches.png", "Partien");
    
    // ########################################
    // 7.1.) Neu:
    $strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine neue Partie zu erzeugen.";
    writenavigationItem("new.png", "games/_admin_new_game.php","?ux=".$ux."&dx=".$dx, " Neu erzeugen", $strCurrentTitle);
    
    // ########################################
    // 7.2.) Bearbeiten:
    $strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen bereits vorhandene Partie zu bearbeiten.";
    writenavigationItem("edit.png", "_admin_select.php","?ux=".$ux."&dx=".$dx."&objectclass=GAMES", " Bearbeiten", $strCurrentTitle);
    
    // ########################################
    // 7.3.) Löschen:
    $strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen bereits vorhandene Partie zu l&ouml;schen.";
    writenavigationItem("delete.png", "_admin_delete.php","?ux=".$ux."&dx=".$dx."&objectclass=GAMES", " L&ouml;schen", $strCurrentTitle);
    

    // ###########################################
    // 8.) Links
    // Admin oder Homepagerverwalter:
    if (($cursecuritylevel=="A") || ($cursecuritylevel=="H"))
    {
    	writenavigationItemHeader("arrow.gif", "Link - Seite");
    	
    	// ########################################
    	// 8.1.) Bearbeiten:
    	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um den Inhalt der Linkseite zu bearbeiten.";
    	writenavigationItem("edit.png", "_admin_links.php","?ux=".$ux."&dx=".$dx, " Bearbeiten", $strCurrentTitle);
    }


    // ##############################
    // 9.) AFRO - Bereich
    // Admin
    // Inhalte bearbeiten:
    if (($cursecuritylevel=="A"))
    {
    	writenavigationItemHeader("afro.gif", "AFRO - Turnier");
    	
    	// ########################################
    	// 9.1.) Bearbeiten:
    	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um die Inhalte und Einstellungen des AFRO-Turniers zu bearbeiten.";
    	writenavigationItem("edit.png", "_admin_select_afro.php","?ux=".$ux."&dx=".$dx, " Seiteninhalte und Einstellungen bearbeiten", $strCurrentTitle);

    	// ########################################
    	// 9.2.) Spielerdaten bearbeiten:
    	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einzelne AFRO-Teilnehmer zu bearbeiten.";
    	writenavigationItem("member.png", "_admin_select_afro_player.php","?ux=".$ux."&dx=".$dx, " AFRO-Teilnehmer bearbeiten", $strCurrentTitle, "width='12'", "heigth='12'");
    	 
    	// ########################################
    	// 9.3.) Spielerdaten löschen:
    	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen bereits vorhandenen AFRO-Teilnehmer zu l&ouml;schen.";
    	writenavigationItem("delete.png", "_admin_del_afro_player.php","?ux=".$ux."&dx=".$dx, " AFRO-Teilnehmer l&ouml;schen", $strCurrentTitle);

    	// ########################################
    	// 9.4.) Spielerliste ELO:
    	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine AFRO-Teilnehmer sortiert nach ELO zu erhalten.";
    	writenavigationItem("table.gif", "_admin_afro_player_list.php","?ux=".$ux."&dx=".$dx."&orderby=ELO", " AFRO-Teilnehmer-Liste nach ELO", $strCurrentTitle);
    	
    	// ########################################
    	// 9.5.) Spielerliste ALPHA:
    	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine AFRO-Teilnehmer sortiert nach den Namen zu erhalten.";
    	writenavigationItem("table.gif", "_admin_afro_player_list.php","?ux=".$ux."&dx=".$dx."&orderby=ALPHA", " AFRO-Teilnehmer-Liste nach Alphabet", $strCurrentTitle);
    }


	// ##############################
    // 10.) Mitglieder - Bereich:
    writenavigationItemHeader("member.png", "Vereinsmitglieder");
    
    // #####
	// Admin
    if (($cursecuritylevel=="A"))
    {
    	// ########################################
    	// 10.1.) Neu:
    	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um ein neues Vereinsmitglied zu erzeugen.";
    	writenavigationItem("new.png", "members/_admin_new_member.php","?ux=".$ux."&dx=".$dx, " Neu erzeugen", $strCurrentTitle);
    	 
    	// ########################################
    	// 10.2.) Bearbeiten:
    	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um ein bereits vorhandenes Vereinsmitglied zu bearbeiten.";
    	writenavigationItem("edit.png", "_admin_select.php","?ux=".$ux."&dx=".$dx."&objectclass=MEMBERS", " Bearbeiten", $strCurrentTitle);
    	 
    	// ########################################
    	// 10.3.) Löschen:
    	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um ein bereits vorhandenes Vereinsmitglied zu l&ouml;schen.";
    	writenavigationItem("delete.png", "_admin_delete.php","?ux=".$ux."&dx=".$dx."&objectclass=MEMBERS", " L&ouml;schen", $strCurrentTitle);
    	
    	echo "<BR>";
    }

    // ########################################
  	// 10.4.) Mitgliedsliste:
   	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um ein Vereinsmitgliederliste zu erstellen.";
   	writenavigationItem("group.gif", "members/_admin_member_list.php","?ux=".$ux."&dx=".$dx, " Vereinsmitgliederliste", $strCurrentTitle);
    	
   	// #####
   	// Admin
	if (($cursecuritylevel=="A"))
	{
		$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um die aktuellen ELO-/DWZ-Werte vom deutschen Schachbund zu holen und die Mitgliedsdaten damit zu aktualisieren.";
		writenavigationItem("sys.jpg", "members/_admin_member_update_dwz.php","?ux=".$ux."&dx=".$dx, " DWZ / ELO Update durchf&uuml;hren", $strCurrentTitle);
	}

	// ########################################
	// 11.) Fotogalerie:
	writenavigationItemHeader("pictures.png", "Fotogalerien");
	
	// ########################################
	// 11.1.) Neu:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine neue Fotogalerie zu erzeugen.";
	writenavigationItem("new.png", "galery/_admin_new_galery.php","?ux=".$ux."&dx=".$dx, " Neu erzeugen", $strCurrentTitle);
	
	// ########################################
	// 11.2.) Bearbeiten:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine bereits vorhandene Fotogalerie zu bearbeiten.";
	writenavigationItem("edit.png", "_admin_select.php","?ux=".$ux."&dx=".$dx."&objectclass=GALERIES", " Bearbeiten", $strCurrentTitle);
	
	// ########################################
	// 11.3.) Löschen:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine bereits vorhandene Fotogalerie zu l&ouml;schen.";
	writenavigationItem("delete.png", "galery/_admin_del_galery.php","?ux=".$ux."&dx=".$dx, " L&ouml;schen", $strCurrentTitle);
	
	
	// #######################################################
	// 12.) Sonstiges:
	writenavigationItemHeader("others.png", "Sonstiges");
	
	// Admin oder Homepagerverwalter:
	if (($cursecuritylevel=="A") || ($cursecuritylevel=="H"))
	{
		// ########################################
		// 12.1.) Neu:
		$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um eine neuen Download zu erzeugen.";
		writenavigationItem("new.png", "downloads/_admin_new_download.php","?ux=".$ux."&dx=".$dx, " Neuen Download erzeugen", $strCurrentTitle);
		
		// ########################################
		// 12.2.) Bearbeiten:
		$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen bereits vorhandenen Download zu bearbeiten.";
		writenavigationItem("edit.png", "_admin_select.php","?ux=".$ux."&dx=".$dx."&objectclass=DOWNLOADS", " Download bearbeiten", $strCurrentTitle);
		
		// ########################################
		// 12.3.) Löschen:
		$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen bereits vorhandenen Download zu l&ouml;schen.";
		writenavigationItem("delete.png", "downloads/_admin_del_download.php","?ux=".$ux."&dx=".$dx, " Download l&ouml;schen", $strCurrentTitle);
		
		echo "<BR>";
	    
		// ###########
		// Kommentare:
		
		// ########################################
		// 12.4.) Anzeigen:
		$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um die vorhandenen Kommentare als Liste anzusehen.";
		writenavigationItem("table.gif", "comments/_admin_show_comment.php","?ux=".$ux."&dx=".$dx, " Kommentare als Liste anzeigen", $strCurrentTitle);
	}
		
	// ########################################
	// 12.5.) Bearbeiten:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen bereits vorhandenen Kommentar zu bearbeiten.";
	writenavigationItem("edit.png", "comments/_admin_select_comment.php","?ux=".$ux."&dx=".$dx, " Kommentar bearbeiten", $strCurrentTitle);
	
	// ########################################
	// 12.6.) Löschen:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um einen bereits vorhandenen Kommentar zu l&ouml;schen.";
	writenavigationItem("delete.png", "comments/_admin_del_comment.php","?ux=".$ux."&dx=".$dx, " Kommentar l&ouml;schen", $strCurrentTitle);
	
	echo "<BR>";

	// ########################################
	// 12.7.) Jahrbuch erstellen:
	$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um das Jahrbuch für letzte Saison zu erstellen.";
	writenavigationItem("table.gif", "_admin_year_book.php","?ux=".$ux."&dx=".$dx, " Jahrbuch erstellen", $strCurrentTitle);


	// ###################
	// 12.8.) Systeminfos:
	if (($cursecuritylevel=="A"))
	{
		echo "<BR>";
		$strCurrentTitle = "Klicken Sie auf diese Schaltfl&auml;che, um die System - Infos einzusehen.";
		writenavigationItem("sys.jpg", "_admin_sys_info.php","?ux=".$ux."&dx=".$dx, " System - Infos anzeigen", $strCurrentTitle);
	}
  }
?>