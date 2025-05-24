<?php include("../includes/db/connection.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################
	
	// 1.) Das Verbindungsobjekt ermitteln:
	$objDBCon = GetCon();

	// ##############################################
	// 2.) Die ID des Benutzers ermitteln und dekodieren:
	include("_admin_param_ux.php");

	// ##############################################
	// 3.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "A")==0)
	{
		exit;
	}
	echo "<HTML><TITLE>Systeminformationen</TITLE><BODY>".chr(13).chr(10);

	phpinfo();

	echo "<BR></BODY></HTML>".chr(13).chr(10);
?>