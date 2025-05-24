<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Vorstandsdaten bearbeiten");
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
	
	$objectclassicon = "heads.png";
	include("../forms/objectclassicon.php");
  	echo "<SPAN CLASS=he1>Vorstandsdaten bearbeiten (HEADS - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

  	// #####################
	// 6.) Die ID erfragen:
  	$Nr = strGetParam($objDBCon, "Nr");
  	
  	// #####################
  	$strSQL="select * from skk_heads WHERE id=".$Nr." AND del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

  	if ($RecordCount > 0)
  	{
  		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
	        $ID[$i] = $row->id;
	        $year[$i] = $row->year;
	        $firsthead[$i] = $row->firsthead;
			$secondhead[$i] = $row->secondhead;
			$cashier[$i] = $row->cashier;
			$gameleader[$i] = $row->gameleader;
			$stuffhead[$i] = $row->stuffhead;
			$writehead[$i] = $row->writehead;
			$youthhead[$i] = $row->youthhead;
			$i++;
    	}
  	}

	// #####################
	include("../forms/fields_not_null.php");

	// #####################
	echo "<FORM METHOD=POST ACTION='_admin_edit_head_ok.php'>".chr(13).chr(10);
	echo "<INPUT TYPE=HIDDEN NAME=ID Value=".$ID[0].">".chr(13).chr(10);
	echo "<INPUT TYPE=HIDDEN NAME=year Value=".$year[0].">".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);

	echo "<tr><td>Vorstandsdaten f&uuml;r das Jahr:</td><td>".chr(13).chr(10);
	echo $year[0]."</td></tr>".chr(13).chr(10);

	echo "<tr><td>1. Vorstand (max. 255 Zeichen): *</td><td><INPUT TYPE=Text VALUE='".$firsthead[0]."' NAME=firsthead size=50></td></tr>".chr(13).chr(10);
	echo "<tr><td>2. Vorstand (max. 100 Zeichen):</td><td><INPUT TYPE=Text VALUE='".$secondhead[0]."' NAME=secondhead size=50></td></tr>".chr(13).chr(10);
	echo "<tr><td>Kassierer (max. 100 Zeichen):</td><td><INPUT TYPE=Text VALUE='".$cashier[0]."' NAME=cashier size=50></td></tr>".chr(13).chr(10);
	echo "<tr><td>Spielleiter (max. 100 Zeichen):</td><td><INPUT TYPE=Text VALUE='".$gameleader[0]."' NAME=gameleader size=50></td></tr>".chr(13).chr(10);
	echo "<tr><td>Materialwart (max. 100 Zeichen):</td><td><INPUT TYPE=Text VALUE='".$stuffhead[0]."' NAME=stuffhead size=50></td></tr>".chr(13).chr(10);
	echo "<tr><td>Schriftf&uuml;hrer (max. 100 Zeichen):</td><td><INPUT TYPE=Text VALUE='".$writehead[0]."' NAME=writehead size=50></td></tr>".chr(13).chr(10);
	echo "<tr><td>Jugendleiter (max. 100 Zeichen):</td><td><INPUT TYPE=Text VALUE='".$youthhead[0]."' NAME=youthhead size=50></td></tr>".chr(13).chr(10);

	echo "<tr><td>&nbsp;</td><td><INPUT TYPE=submit VALUE='Vorstandsdaten absenden'>".chr(13).chr(10);
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