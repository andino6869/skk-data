<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Turnierdaten bearbeiten");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../_admin_param.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// 1.) Das Verbindungsobjekt ermitteln:
	$objDBCon = GetCon();

	// 2.) In Abh�ngigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon, "FALSE");

	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("../_admin_param_ux.php");

	// ##############################################
	// 4.) Ist der aktuelle Login noch g�ltig?
	if (IsSessionValid($objDBCon, $ux, "H")==0)
	{
		// Keine G�ltigkeit mehr!
		include("../../includes/forms/middler.php");
		include("../forms/navigation_access_denied.php");
		include("../../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("../_admin_param_dx.php");

  	echo "<SPAN CLASS=he1>Turnierdaten bearbeiten (TOURNAMENT - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// #####################
	// Die ID erfragen:
	$Nr = strGetParam($objDBCon, "Nr");

	// #####################
  	$strSQL="select * from skk_tournaments WHERE id=".$Nr." AND del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
		    $ID[$i] = $row->id;
		    $tournament[$i] = $row->tournament;
	   
	  		$i++;
		}
	}

	// #####################
	include("../forms/fields_not_null.php");

	// #####################
	echo "<FORM METHOD=POST ACTION='_admin_edit_tournament_ok.php'>".chr(13).chr(10);
	echo "<INPUT TYPE=HIDDEN NAME=ID Value=".$ID[0].">".chr(13).chr(10);
	echo "<INPUT TYPE=HIDDEN NAME=year Value=".$year[0].">".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	echo "<TABLE cellpadding=5 cellspacing=0 border=1 width='100%'>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
	echo "<TD valign=top bgcolor='#C0C0C0'><B><U>Name des Turniers (max. 255 Zeichen): *</U></B>";

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR>".chr(13).chr(10);
		echo "<I>Hier geben Sie den Namen des Turniers ein, das mit in der Auswahlliste auf der News - Seite mit ";
		echo "angezeigt werden soll. Es werden dann bei der Auswahl solche Turniere selektiert, die in ihren ";
		echo "Kopfzeilen diesen hier eingetragenen Begriff beinhalten.</I>";
	}
	echo "</TD></TR>".chr(13).chr(10);

	echo "<tr><td><INPUT TYPE=Text NAME=tournament style='width:100%' VALUE='".$tournament[0]."' size=255 MAXLENGTH=255></td></tr>".chr(13).chr(10);
	echo "</table>".chr(13).chr(10);
	echo "<BR><INPUT TYPE=Submit VALUE='Turnier aktualisieren'>".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);

  	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

  	include("../../includes/forms/footer.php");
?>