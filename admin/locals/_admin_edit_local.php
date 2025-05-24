<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Vereinslokal bearbeiten");
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
	include("../_admin_param_dx.php");
	
	$objectclassicon = "locals.png";
	include("../forms/objectclassicon.php");

  	echo "<SPAN CLASS=he1>Vereinslokal bearbeiten (LOCALS - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

  	// #####################
  	// Die ID erfragen:
  	$Nr = strGetParam($objDBCon, "Nr");
  	
  	// #####################
  	$strSQL="select * from skk_locals WHERE id=".$Nr." AND del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

  	if ($RecordCount > 0)
  	{
  		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
	        $ID[$i] = $row->id;
	        $year[$i] = $row->year;
	        $local[$i] = $row->local;
	        $i++;
    	}
  	}

	// #####################
	include("../forms/fields_not_null.php");

	// #####################
	echo "<FORM METHOD=POST ACTION='_admin_edit_local_ok.php?ux=".$ux."&dx=".$dx."'>".chr(13).chr(10);
	echo "<INPUT TYPE=HIDDEN NAME=ID Value=".$ID[0].">";
	echo "<INPUT TYPE=HIDDEN NAME=year Value=".$year[0].">";

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$dx'>".chr(13).chr(10);

	echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);

	echo "<tr><td>Vereinslokal im Jahr:</td><td>".chr(13).chr(10);
	echo $year[0]."</td></tr>".chr(13).chr(10);

	echo "<tr><td>Vereinslokal in diesem Jahr (max. 255 Zeichen): *</td><td><INPUT TYPE=Text VALUE='".$local[0]."' NAME=skklocal size=50></td></tr>".chr(13).chr(10);

	echo "<tr><td>&nbsp;</td><td><INPUT TYPE=submit VALUE='Vereinslokaldaten aktualisieren'>".chr(13).chr(10);
	echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'></td></tr>".chr(13).chr(10);
  	echo "</table>".chr(13).chr(10);
  	echo "</FORM>".chr(13).chr(10);
  	echo "<BR><BR>".chr(13).chr(10);

  	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

  	include("../../includes/forms/footer.php");
?>