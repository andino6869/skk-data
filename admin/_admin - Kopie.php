<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin-Bereich");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

 	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon);

	echo "<SPAN CLASS=he1>Admin-Bereich</SPAN><BR><BR>".chr(13).chr(10);
	echo "Bitte geben Sie hier Ihre Zugangsdaten ein:<BR<BR>".chr(13).chr(10);
	include("../admin/login/login.php");
?>

<?php include("../includes/forms/middler.php")?>
<?php include("../includes/forms/footer.php")?>




















