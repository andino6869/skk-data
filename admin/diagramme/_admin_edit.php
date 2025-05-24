<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Diagramm bearbeiten");
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

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	$Nr = strGetParam($objDBCon, "Nr");

	$objectclassicon = "schachbrett.png";
	include("../forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Diagramm bearbeiten (DIAGRAMM - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##################################
	include("../forms/fields_not_null.php");

    echo "<form method=post action='_admin_edit_ok.php' enctype=".Chr(34)."multipart/form-data".Chr(34).">".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='ID' Value='$Nr'>".chr(13).chr(10);

	// Die Daten holen:
	$strSQL = "select * from skk_diagramme WHERE del='N' AND modifieddate IS NULL AND ID=".$Nr;
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Konnten Datensätze ermittelt werden:
	if ($RecordCount > 0)
	{
		$i = 0;
		
		while ($row = $rs->fetch_object())
		{			
	  		$diagramm_file[$i] = $row->diagramm_file;
	  		$diagramm_title[$i] = $row->diagramm_title;
	  		$diagramm_height[$i] = $row->diagramm_height;
	  		$diagramm_width[$i] = $row->diagramm_width;
	  		$ID[$i] = $row->id;
	  	}

	  	// Den alten Wert zwischenspeichern:
		echo "<INPUT TYPE='HIDDEN' NAME='diagramm_file' Value='".$diagramm_file[0]."'>".chr(13).chr(10);

		// Die Tabelle erstellen:
		echo "<TABLE width='100%' border=1>".chr(13).chr(10);

		// ##########
		// Die Datei:
		echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Datei f&uuml;r Schachdiagramm:</U></B> *".chr(13).chr(10);

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Erlaubte Dateitypen: gif, jpg, png / Max. ";
			echo "Gr&ouml;&szlig;e: 1024 KB / Keine Leer- und Sonderzeichen im Dateinamen.</I>".chr(13).chr(10);
		}
		echo "</TD></TR>".chr(13).chr(10);
		echo "<TR><TD width=".Chr(34)."100%".Chr(34)."><input type=".Chr(34)."file".Chr(34)." name=".Chr(34)."diagramm_file".Chr(34)." value=".Chr(34).".$diagramm_file[0].".Chr(34)." style=".Chr(34)."width:100%".Chr(34)."></td></tr>".chr(13).chr(10);
		
		// ##########################
		// Titel des Schachdiagramms:
		echo "<TR><TD width=".Chr(34)."100%".Chr(34)." bgcolor=".Chr(34)."#C0C0C0".Chr(34)."><B><U>Titel des Schachdiagramms (max. 100 Zeichen):</U></B> *".chr(13).chr(10);
		
		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Geben Sie hier die Beschreibung an, mit der dieses Diagramm beschriftet werden soll.</I>".chr(13).chr(10);
		}
		echo "</TD></TR>".chr(13).chr(10);
		echo "<TR><TD width=".Chr(34)."100%".Chr(34)."><INPUT TYPE=Text style=".Chr(34)."width:100%".Chr(34)." NAME=diagramm_title VALUE='".$diagramm_title[0]."' TITLE=".Chr(34)."Geben Sie hier den Titel an, mit dem das Diagramm dann angezeigt werden soll.".Chr(34)." size=100></td></tr>".chr(13).chr(10);
		
		// #####
		// Höhe:
		echo "<TR><TD width=".Chr(34)."100%".Chr(34)." bgcolor=".Chr(34)."#C0C0C0".Chr(34)."><B><U>Optionale H&ouml;he des Schachdiagramms:</U></B>".chr(13).chr(10);
		
		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Geben Sie hier optional die H&ouml;he des Schachdiagramms an, wie dieses dann dargestellt werden soll.</I>".chr(13).chr(10);
		}
		echo "</TD></TR>".chr(13).chr(10);
		echo "<TR><TD width=".Chr(34)."100%".Chr(34)."><INPUT TYPE=Text style=".Chr(34)."width:100%".Chr(34)." NAME=diagramm_height VALUE='".$diagramm_height[0]."' TITLE=".Chr(34)."Geben Sie hier optional die H&ouml;he des Schachdiagramms an, wie dieses dann dargestellt werden soll.".Chr(34)." size=4></td></tr>".chr(13).chr(10);
		
		// #######
		// Breite:
		echo "<TR><TD width=".Chr(34)."100%".Chr(34)." bgcolor=".Chr(34)."#C0C0C0".Chr(34)."><B><U>Optionale Breite des Schachdiagramms:</U></B>".chr(13).chr(10);
		
		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Geben Sie hier optional die Breite des Schachdiagramms an, wie dieses dann dargestellt werden soll.</I>".chr(13).chr(10);
		}
		echo "</TD></TR>".chr(13).chr(10);
		echo "<TR><TD width=".Chr(34)."100%".Chr(34)."><INPUT TYPE=Text style=".Chr(34)."width:100%".Chr(34)." NAME=diagramm_width VALUE='".$diagramm_width[0]."' TITLE=".Chr(34)."Geben Sie hier optional die Breite des Schachdiagramms an, wie dieses dann dargestellt werden soll.".Chr(34)." size=4></td></tr>".chr(13).chr(10);
		
		// ##################
		// Tabelle schließen:		
		echo "</table>".chr(13).chr(10);
		echo "<BR><INPUT TYPE=submit VALUE='Diagramm aktualisieren'>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'><BR><BR>".chr(13).chr(10);
		
		echo "</FORM>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
	}
	else
	{
		echo "Es konnten keine Diagrammdaten lokalisiert werden.";
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>