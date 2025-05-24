<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Objekt l&ouml;schen");
?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/forms/navigation.php")?>
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

	// ##################################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
  	include("_admin_param_ux.php");

  	// ##############################################
  	// 3.1.) Den aktuellen Dispatcher ermitteln:
  	include("_admin_param_dx.php");
  	
	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "R")==0)
	{
		// Keine Gültigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}

	// #######################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("_admin_param_ux.php");
	
	// ###########
	// 6.) Die ID:
	$Nr = strGetParam($objDBCon,"Nr");

	// ##############################################
	// 7.) Die Tabelle. aus der gelöscht werden soll:
	$CurrentTable = strGetParam($objDBCon,"CurrentTable");
	
	// ##############################################
	// 8.) Das Objektklassenicon:
	$objectclassicon = strGetParam($objDBCon,"objectclassicon");
	
	// #####################################
	// 9.) Der Anzeigename der Objektklasse:
	$CurrentObjectClassShownname = strGetParam($objDBCon,"CurrentObjectClassShownname");
	
	// ##############################################
	// 10.) Das Formular aufbauen:
	// 10.1.) Die Grafik ausgeben:
	include("forms/objectclassicon.php");
	
	// #########################
	// 11.) Löschen durchführen:
	$now = date("Y-m-d H:i:s");

	$strSQL = "UPDATE $CurrentTable SET del='J', modifieddate='$now', modifier='$curUser' WHERE ID=".$Nr." AND del='N' AND ";
	$strSQL = $strSQL."modifieddate IS NULL;";

	echo "<SPAN CLASS=he1>".$CurrentObjectClassShownname." l&ouml;schen</SPAN><BR><BR>".chr(13).chr(10);

	if (!mysqli_query ($objDBCon, $strSQL))
	{

		echo "Datensatz konnte nicht gel&ouml;scht werden!<BR>".chr(13).chr(10);
		echo mysql_error($objDBCon);
		echo "<BR>Statement: ".$strSQL."<BR>".chr(13).chr(10);
	}
	else
	{
		$strSQL = "DELETE FROM skk_userdesks_contents WHERE objectid=".$Nr." AND objecttable='".$CurrentTable."';";
		
		if (!mysqli_query ($objDBCon, $strSQL))
		{
		
			echo "Datensatz konnte nicht gel&ouml;scht werden!<BR>".chr(13).chr(10);
			echo mysql_error($objDBCon);
			echo "<BR>Statement: ".$strSQL."<BR>".chr(13).chr(10);
		}
		else 
		{
			echo "Datensatz wurde erfolgreich gel&ouml;scht.<BR><BR>".chr(13).chr(10);
			echo "<A HREF='_admin_index.php?ux=$ux&dx=$dx' TITLE='Klicken Sie auf diese Schaltfl&auml;che, um ".chr(13).chr(10);
			echo "wieder auf die Start - Seite zu wechseln.'><IMG SRC='../pics/admin/arrow.gif' border=0>".chr(13).chr(10);
			echo " OK</A>".chr(13).chr(10);
		}
	}

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>





























