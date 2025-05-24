<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Kommentar bearbeiten");
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
	if (IsSessionValid($objDBCon, $ux, "H")==0)
	{
		// Keine Gültigkeit mehr!
		include("../../includes/forms/middler.php");
		include("../forms/navigation_access_denied.php");
		include("../../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("../_admin_param_ux.php");

	// ##############################################
	// 6.) Den aktuellen Dispatcher ermitteln:
	include("../_admin_param_dx.php");
	
	// ##############################################
	// 7.) Den Kommentar ermitteln:
	$ID = strGetParam($objDBCon, "ID");

	echo "<SPAN CLASS=he1>Kommentar bearbeiten (COMMENTS - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ##################################
	include("../forms/fields_not_null.php");

    echo "<form method=post action='_admin_edit_comment_ok.php'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='ID' Value='$ID'>".chr(13).chr(10);

	// Die Daten holen:
	$strSQL = "select * from skk_comments WHERE del='N' AND modifieddate IS NULL AND ID=".$ID;
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Konnten Datensätze ermittelt werden:
	if ($RecordCount > 0)
	{
		$i = 0;
		
		while ($row = $rs->fetch_object())
		{
			$nameanswer[$i] = $row->nameanswer;
	  		$answer[$i] = $row->answer;
	  		$ip[$i] = $row->ip;
	  		$os[$i] = $row->os;
	  		$ID[$i] = $row->id;
	  		$nr[$i] = $row->nr;
	  		
			$i++;
		}
		
		echo "<INPUT TYPE='HIDDEN' NAME='os' Value='$os[0]'>".chr(13).chr(10);
		echo "<INPUT TYPE='HIDDEN' NAME='ip' Value='$ip[0]'>".chr(13).chr(10);
		echo "<INPUT TYPE='HIDDEN' NAME='nr' Value='$nr[0]'>".chr(13).chr(10);
		
		// Die Tabelle erstellen:
		echo "<TABLE width='100%' border=1>".chr(13).chr(10);

		// ####################################################################################################
		// Melder:
		echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Name des Melders (max. 255 Zeichen) *:</U></B>".chr(13).chr(10);

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Geben Sie hier den Namen des Melders an.</I>".chr(13).chr(10);
		}
		echo "</TD></TR>".chr(13).chr(10);
		echo "<TR><TD width='100%'><INPUT TYPE=Text style='width:100%' NAME='nameanswer' VALUE='".$nameanswer[0]."'";
		echo " size=255 maxlength='255'></td></tr>".chr(13).chr(10);

		// ####################################################################################################
		// Kommentar:
		echo "<TR><TD width='100%' bgcolor='#C0C0C0'><B><U>Kommentar (max. 255 Zeichen) *:</U></B>".chr(13).chr(10);

		// Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>Geben Sie hier den Kommentar ein.</I>".chr(13).chr(10);
		}
		echo "</TD></TR>".chr(13).chr(10);
		echo "<TR><TD width='100%'><TEXTAREA COLS=50 ROWS=8 NAME='answer' maxlength='255' style='width:100%' ";
		echo " size=255 maxlength='255'>".$answer[0]."</TEXTAREA></td></tr>".chr(13).chr(10);

		echo "</table>".chr(13).chr(10);

		echo "<BR><INPUT TYPE=submit VALUE='Kommentar aktualisieren'>".chr(13).chr(10);

		echo "<BR><BR>".chr(13).chr(10);
	}
	else
	{
		echo "Es konnten keine Kommentardaten lokalisiert werden.";
	}
	echo "</FORM>".chr(13).chr(10);

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>

