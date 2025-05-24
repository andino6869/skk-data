<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Mannschaft bearbeiten");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/forms/cbo_members.php")?>
<?php include("_admin_param.php")?>

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
	include("_admin_param_ux.php");

	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "H")==0)
	{
		// Keine Gültigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("_admin_param_dx.php");

	$curYear = substr(date("Y-m-t"),0,4);
	$curYearNext = $curYear + 1;
	
	// #########################
	// Die Überschrift ausgeben:
	$objectclassicon = "team.jpg";
	include("forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Mannschaft f&uuml;r die Saison $curYear / $curYearNext bearbeiten (TEAM - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// #####################
	// Die ID erfragen:
	$Nr = strGetParam($objDBCon, "Nr");
	
	// #####################
	$strSQL="select * from skk_teams WHERE id=".$Nr." AND del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
		   	$ID[$i] = $row->id;
		   	$Mannschaft[$i] = $row->team;
		   	$Liga[$i] = $row->league;
		   	$numberofplayers[$i] = $row->numberofplayers;

		   	// Die einzelnen Spieler:
			$P1[$i] = $row->P1;
			$P2[$i] = $row->P2;
			$P3[$i] = $row->P3;
			$P4[$i] = $row->P4;

			$P5[$i] = $row->P5;
			$P6[$i] = $row->P6;
			$P7[$i] = $row->P7;
			$P8[$i] = $row->P8;

			$P9[$i] = $row->P9;
			$P10[$i] = $row->P10;
			$P11[$i] = $row->P11;
			$P12[$i] = $row->P12;

			$P13[$i] = $row->P13;
			$P14[$i] = $row->P14;
			$P15[$i] = $row->P15;
			$P16[$i] = $row->P16;

			$Season[$i] = $row->season;
			$i++;
		}
	}

	// #####################
	// Datenausgabe:
	echo "<FORM METHOD=POST ACTION='_admin_edit_team_ok.php'>".chr(13).chr(10);
	echo "<INPUT TYPE=HIDDEN NAME=ID Value='$ID[0]'>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	echo "<TABLE width='100%' border=1>".chr(13).chr(10);

	// Name:
	echo "<TR><TD width='100%' colspan='2' bgcolor='#C0C0C0'><B><U>Mannschaftsbezeichnung / Liga (max. 255 Zeichen): </U></B> *".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR><I>Geben Sie hier den Namen oder die Bezeichnung der neuen Mannschaft an. Dieser Name ";
		echo "erscheint dann auch in der Auswahlliste bei News & Meldungen. Die Angabe dieses Werte ist obligatorisch.</I>";
	}

	echo "</TD></TR>".chr(13).chr(10);
	echo "<TR><TD colspan='2' ><INPUT TYPE=TEXT SIZE=50 MAXLENGTH=100 style='width:100%' NAME=Mannschaft VALUE='$Mannschaft[0]' ></TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);

 	// Anzahl der Stammspieler:
	echo "<TR><TD width='100%' colspan='2' bgcolor='#C0C0C0'><B><U>Anzahl der Stammspieler: </U></B> *".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR><I>Geben Sie hier die Anzahl der Stammspieler f&uuml;r diese Mannschaft ein. Es wird Ihnen ";
		echo "sp&auml;ter automatisch die gleiche Anzahl an m&ouml;glichen Ersatzspielern vorgesteuert.</I>";
	}

	echo "</TD></TR>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);
 	echo "<TD colspan='2'><SELECT NAME=numberofplayers>".chr(13).chr(10);

 	if ($numberofplayers[0]==4)
 	{
 		echo "<OPTION VALUE='4' SELECTED>4</OPTION>".chr(13).chr(10);
 	}
 	else
 	{
 		echo "<OPTION>4</OPTION>".chr(13).chr(10);
 	}

	if ($numberofplayers[0]==6)
 	{
 		echo "<OPTION VALUE='6' SELECTED>6</OPTION>".chr(13).chr(10);
 	}
 	else
 	{
 		echo "<OPTION>6</OPTION>".chr(13).chr(10);
 	}

	if ($numberofplayers[0]==8)
 	{
 		echo "<OPTION VALUE='8' SELECTED>8</OPTION>".chr(13).chr(10);
 	}
 	else
 	{
 		echo "<OPTION>8</OPTION>".chr(13).chr(10);
 	}

	if ($numberofplayers[0]==10)
 	{
 		echo "<OPTION VALUE='10' SELECTED>10</OPTION>".chr(13).chr(10);
 	}
 	else
 	{
 		echo "<OPTION>10</OPTION>".chr(13).chr(10);
 	}

	if ($numberofplayers[0]==12)
 	{
 		echo "<OPTION VALUE='12' SELECTED>12</OPTION>".chr(13).chr(10);
 	}
 	else
 	{
 		echo "<OPTION>12</OPTION>".chr(13).chr(10);
 	}

	echo "</SELECT></TD>".chr(13).chr(10);
 	echo "</TR>".chr(13).chr(10);


	// Liga:
	echo "<TR><TD width='100%' colspan='2' bgcolor='#C0C0C0'><B><U>Liga: </U></B> *".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR><I>Geben Sie hier die Liga an, in welcher diese Mannschaft spielt.</I>";
	}

	echo "</TD></TR>".chr(13).chr(10);

	echo "<TR>".chr(13).chr(10);
	echo "<TD colspan='2'><SELECT NAME=Liga style='width:100%'>".chr(13).chr(10);

	// #####################
	// Ausgabe der aktuellen Liga:
	if ($Liga[0]=="Kreisklasse C")
	{
		echo "<OPTION SELECTED>Kreisklasse C</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>Kreisklasse C</OPTION>".chr(13).chr(10);
	}

	if ($Liga[0]=="Kreisklasse B")
	{
		echo "<OPTION SELECTED>Kreisklasse B</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>Kreisklasse B</OPTION>".chr(13).chr(10);
	}

	if ($Liga[0]=="Kreisklasse A")
	{
		echo "<OPTION SELECTED>Kreisklasse A</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>Kreisklasse A</OPTION>".chr(13).chr(10);
	}

	if ($Liga[0]=="Kreisklasse III")
	{
		echo "<OPTION SELECTED>Kreisklasse III</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>Kreisklasse III</OPTION>".chr(13).chr(10);
	}


	if ($Liga[0]=="Kreisklasse II")
	{
		echo "<OPTION SELECTED>Kreisklasse II</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>Kreisklasse II</OPTION>".chr(13).chr(10);
	}

	if ($Liga[0]=="Kreisklasse I")
	{
		echo "<OPTION SELECTED>Kreisklasse I</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>Kreisklasse I</OPTION>".chr(13).chr(10);
	}

	if ($Liga[0]=="Schwabenliga II Nord")
	{
		echo "<OPTION SELECTED>Schwabenliga II Nord</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>Schwabenliga II Nord</OPTION>".chr(13).chr(10);
	}

	if ($Liga[0]=="Schwabenliga II S&uuml;d")
	{
		echo "<OPTION SELECTED>Schwabenliga II S&uuml;d</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>Schwabenliga II S&uuml;d</OPTION>".chr(13).chr(10);
	}

	if ($Liga[0]=="Schwabenliga I")
	{
		echo "<OPTION SELECTED>Schwabenliga I</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>Schwabenliga I</OPTION>".chr(13).chr(10);
	}

	if ($Liga[0]=="Regionalliga S&uuml;d-West")
	{
		echo "<OPTION SELECTED>Regionalliga S&uuml;d-West</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>Regionalliga S&uuml;d-West</OPTION>".chr(13).chr(10);
	}

	if ($Liga[0]=="Landesliga S&uuml;d")
	{
		echo "<OPTION SELECTED>Landesliga S&uuml;d</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>Landesliga S&uuml;d</OPTION>".chr(13).chr(10);
	}

	if ($Liga[0]=="Oberliga")
	{
		echo "<OPTION SELECTED>Oberliga</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>Oberliga</OPTION>".chr(13).chr(10);
	}

	if ($Liga[0]=="2. Bundesliga")
	{
		echo "<OPTION SELECTED>2. Bundesliga</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>2. Bundesliga</OPTION>".chr(13).chr(10);
	}

	if ($Liga[0]=="1. Bundesliga")
	{
		echo "<OPTION SELECTED>1. Bundesliga</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>1. Bundesliga</OPTION>".chr(13).chr(10);
	}

	echo "</SELECT> </TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);


	// ######################
	// Saison:
	echo "<TR><TD width='100%' colspan='2' bgcolor='#C0C0C0'><B><U>Saison: </U></B> *".chr(13).chr(10);

	// Hilfe anzeigen?
	if ($dx==1)
	{
		echo "<BR><BR><I>Geben Sie hier die Spielsaison an, f&uuml;r die diese Einstellungen gelten sollen.</I>";
	}

	echo "</TD></TR>".chr(13).chr(10);
 	echo "<TR>".chr(13).chr(10);

	echo "<TD colspan='2'><SELECT NAME=Season style='width:100%'>".chr(13).chr(10);
	$curYear = substr(date("Y-m-t"),0,4);
	$curTmpYear = $curYear - 1;
	$nextYear = $curYear + 1;

	if ($curTmpYear."/".$curYear == $Season[0])
	{
		echo "<OPTION SELECTED>".$curTmpYear."/".$curYear."</OPTION>".chr(13).chr(10);
		echo "<OPTION>".$curYear."/".$nextYear."</OPTION>".chr(13).chr(10);
	}
	else
	{
		echo "<OPTION>".$curTmpYear."/".$curYear."</OPTION>".chr(13).chr(10);
		echo "<OPTION SELECTED>".$curYear."/".$nextYear."</OPTION>".chr(13).chr(10);
	}

	echo "</SELECT></TD>".chr(13).chr(10);

	// ######################
	// Die Spieler:
	echo "<TR>".chr(13).chr(10);
	echo "<TD  colspan='2' bgcolor='#C0C0C0'><B>Stammspieler:</B></TD>".chr(13).chr(10);

	// Die Stammspieler
	for ($i=1;$i<17;$i++)
	{
		if (($numberofplayers[0] + 1) == $i)
		{
			echo "<TR><TD colspan='2' bgcolor='#C0C0C0'><B>Ersatzspieler:</B></TD>".chr(13).chr(10);
		}

		// Spieler:
		echo "<TR><TD width='25%'>Brett $i:</TD><TD>".chr(13).chr(10);

		switch ($i)
		{
			case 1:
				FillCBOWithMembers($objDBCon, "P".$i, $P1[0]);
				break;
			case 2:
				FillCBOWithMembers($objDBCon, "P".$i, $P2[0]);
				break;
			case 3:
				FillCBOWithMembers($objDBCon, "P".$i, $P3[0]);
				break;
			case 4:
				FillCBOWithMembers($objDBCon, "P".$i, $P4[0]);
				break;
			case 5:
				FillCBOWithMembers($objDBCon, "P".$i, $P5[0]);
				break;
			case 6:
				FillCBOWithMembers($objDBCon, "P".$i, $P6[0]);
				break;
			case 7:
				FillCBOWithMembers($objDBCon, "P".$i, $P7[0]);
				break;
			case 8:
				FillCBOWithMembers($objDBCon, "P".$i, $P8[0]);
				break;
			case 9:
				FillCBOWithMembers($objDBCon, "P".$i, $P9[0]);
				break;
			case 10:
				FillCBOWithMembers($objDBCon, "P".$i, $P10[0]);
				break;
			case 11:
				FillCBOWithMembers($objDBCon, "P".$i, $P11[0]);
				break;
			case 12:
				FillCBOWithMembers($objDBCon, "P".$i, $P12[0]);
				break;
			case 13:
				FillCBOWithMembers($objDBCon, "P".$i, $P13[0]);
				break;
			case 14:
				FillCBOWithMembers($objDBCon, "P".$i, $P14[0]);
				break;
			case 15:
				FillCBOWithMembers($objDBCon, "P".$i, $P15[0]);
				break;
			case 16:
				FillCBOWithMembers($objDBCon, "P".$i, $P16[0]);
				break;
		}

		echo "</TR>".chr(13).chr(10);
	}

	// Die Schaltfläche zum Abschluss:
 	echo "</TR>".chr(13).chr(10);
	echo "</TABLE>".chr(13).chr(10);
	echo "<BR><INPUT TYPE=Submit VALUE='Mannschaft aktualisieren'>".chr(13).chr(10);
	echo "<INPUT TYPE=BUTTON VALUE='Abbrechen' onClick='history.back()'".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>















