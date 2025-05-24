<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - News & Meldungen bearbeiten", "TRUE");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/content_get.php")?>
<?php include("../includes/db/team_get.php")?>
<?php include("../includes/date/date.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>
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
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("_admin_param_dx.php");

	// ##############################################
	$objectclassicon = "thunder.gif";
	include("forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>SQL-Anweisung ausführen:</SPAN><BR><BR>".chr(13).chr(10);
	
	// Die Änderungen durchführen:
	$now = date("Y-m-d H:i:s");
	
	// Der UPDATE:
	$strSQL = "UPDATE skk_objectclasses SET colsortorder='newsdate DESC' WHERE objectclassname='NEWS' AND del='N' ";
	$strSQL = $strSQL."AND modifieddate IS NULL;";
	
	if (!mysqli_query ($objDBCon, $strSQL))
	{
	    $errText = $strSQL."<BR>".mysql_error($objDBCon)."<BR>".chr(13).chr(10);
	    include("_admin_eingabe_fehler.php");
	}
	
	include("../includes/forms/middler.php");
	
	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);
	
	include("../includes/forms/footer.php");
	?>