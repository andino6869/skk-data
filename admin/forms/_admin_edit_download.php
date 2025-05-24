<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Download bearbeiten");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/date/date.php")?>

<?php
	// 1.) Das Verbindungsobjekt ermitteln:
	$con = GetCon();

	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $con, "FALSE");


	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("../_admin_param_ux.php");


	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($con, $ux, "H")==0)
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
	if (trim($ID)=="")
	{
		$ID = $_GET["Nr"];
	}

	if (trim($ID)=="")
	{
		$ID = $_REQUEST["Nr"];
	}

	$objectclassicon = "download.jpg";
	include("../forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Download bearbeiten (DOWNLOAD - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##################################
	include("../forms/fields_not_null.php");

    	echo "<form method=post action='_admin_edit_download_ok.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='ID' Value='$ID'>".chr(13).chr(10);

	// Die Daten holen:
	$strSQL = "select * from skk_downloads WHERE del='N' AND modifieddate IS NULL AND ID=".$ID;
	$result = mysql_query($strSQL);
	$num = mysql_numrows($result);

	// Konnten Datensätze ermittelt werden:
	if ($num>0)
	{
		for ($i=0;$i<$num;$i++)
	  	{
	  		$nrak = $num - $i - 1;

	  		$viewname[$i] = mysql_result($result,$nrak,"viewname");
	  		$filename[$i] = mysql_result($result,$nrak,"filename");
	  		$category[$i] = mysql_result($result,$nrak,"category");
	  		$expiredate[$i] = mysql_result($result,$nrak,"expiredate");

	  		$ID[$i] = mysql_result($result,$nrak,"ID");
	  	}

		echo "<INPUT TYPE='HIDDEN' NAME='downloadfile' Value='".$filename[0]."'>".chr(13).chr(10);

		// Die Tabelle erstellen:
		echo "<TABLE width='100%' border=1>".chr(13).chr(10);

		// Die Datei:
		echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Datei für Download: *</U></B>".chr(13).chr(10);

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Erlaubte Dateitypen: doc, rtf, tif, pdf, pgn, zip / Max. ";
			echo "Gr&ouml;ße: 500 KB / Keine Leer- und Sonderzeichen im Dateinamen.</I>".chr(13).chr(10);
		}
		echo "</TD></TR>".chr(13).chr(10);

		echo "<TR><TD width='100%'>".$filename[0]."</td></tr>".chr(13).chr(10);

		// Gültigkeit:
		echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Download soll g&uuml;ltig sein bis (Format: TT.MM.JJJJ): *</U></B>";
		echo "</TD></TR>".chr(13).chr(10);

		echo "<TR><TD width='100%'>";

		// Das aktuelle Datum vorsteuern:
		$curYear = substr($expiredate[0],0,4);
		$curMonth = substr($expiredate[0],5,2);
		$curDay = substr($expiredate[0],8,2);

		writeDateField("expire_day", "expire_month", "expire_year", $curDay, $curMonth, $curYear);

		echo "</TD></TR>".chr(13).chr(10);

		// Kategorie:
		echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Kategorie:</U></B>".chr(13).chr(10);

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Beim Wert 'Alle' wird dieser Donwload generell angeboten. Bei AFRO NUR auf der AFRO - Seite!</I>".chr(13).chr(10);
		}
		echo "</TD></TR>".chr(13).chr(10);


		echo "<TR><TD width='100%'><SELECT NAME=category style='width:100%' TITLE='Beim Wert Alle wird dieser Download generell angeboten. Bei AFRO NUR auf der AFRO - Seite!'>".chr(13).chr(10);

		if($category[0]=="AFRO")
		{
			echo "<OPTION>Alle<OPTION SELECTED>AFRO";
		}
		else
		{
			echo "<OPTION SELECTED>ALLE<OPTION>AFRO";
		}

		echo "</SELECT>".chr(13).chr(10);
		echo "</td></tr>".chr(13).chr(10);


		// Anzeigename:
		echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Anzeigename im Downloadbereich (max. 100 Zeichen):</U></B>".chr(13).chr(10);

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Geben Sie hier die Beschreibung an, wie dieser Link im Browserfenster dann angezeigt werden soll.</I>".chr(13).chr(10);
		}
		echo "</TD></TR>".chr(13).chr(10);
		echo "<TR><TD width='100%'><INPUT TYPE=Text style='width:100%' NAME=viewname VALUE='".$viewname[0]."' TITLE='Geben Sie hier die Beschreibung an, wie dieser Link im Browserfenster dann angezeigt werden soll.' size=50></td></tr>".chr(13).chr(10);
		echo "</table>".chr(13).chr(10);

		echo "<BR><INPUT TYPE=submit VALUE='Download aktualisieren'>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'><BR><BR>".chr(13).chr(10);
		
		echo "</FORM>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
	}
	else
	{
		echo "Es konnten keine Downloaddaten lokalisiert werden.";
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($ux, $dx);

	include("../../includes/forms/footer.php");
?>