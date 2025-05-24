<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Logout aus dem Redaktionssystem");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// 1.) Das Verbindungsobjekt ermitteln:
	$objDBCon = GetCon();

	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon, "TRUE");


	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("_admin_param_ux.php");

	$id = base64_decode($ux);
	$id = strrev($id);


	// ##############################################
	// 4.) Die Session in der Datenbak schliessen:
	$strSQL = "UPDATE skk_members SET lastlogin=NULL, ip=NULL WHERE lastlogin IS NOT NULL AND ";
	$strSQL = $strSQL."ip IS NOT NULL AND active!='N' AND del='N' AND modifieddate ";
	$strSQL = $strSQL."IS NULL AND id=".$id.";";

	echo "<SPAN CLASS=he1>Admin-Bereich</SPAN><BR><BR>".chr(13).chr(10);
	echo "<TABLE BORDER=0 width='100%'><TR><TD>";

	if (!mysqli_query ($objDBCon, $strSQL))
	{
		// Die Position der Dateien kann anders lauten!
		if (is_file("../pics/admin/critical.gif"))
		{
			echo "<IMG SRC='../pics/admin/critical.gif' border=0>";
		}
		else
		{
			if (is_file("../../pics/admin/critical.gif"))
			{
				echo "<IMG SRC='../../pics/admin/critical.gif' border=0>";
			}
			else
			{
				echo "<IMG SRC='../../../pics/admin/critical.gif' border=0>";
			}
		}

		echo "</TD><TD><B>Sie konnten nicht erfolgreich aus dem Administrationsbereich abgemeldet werden!</B><BR>".chr(13).chr(10);
		echo mysql_error($objDBCon);
		echo "Statement: " . $strSQL . "</TD></TR>".chr(13).chr(10);
	}
	else
	{
		// Die Position der Dateien kann anders lauten!
		if (is_file("../pics/admin/success.gif"))
		{
			echo "<IMG SRC='../pics/admin/success.gif' border=0>".chr(13).chr(10);
		}
		else
		{
			if (is_file("../../pics/admin/success.gif"))
			{
				echo "<IMG SRC='../../pics/admin/success.gif' border=0>".chr(13).chr(10);
			}
			else
			{
				echo "<IMG SRC='../../../pics/admin/success.gif' border=0>".chr(13).chr(10);
			}
		}

		echo "</TD><TD>Sie konnten erfolgreich aus dem Administrationsbereich abgemeldet werden.</TR></TD>".chr(13).chr(10);

		$ux="";
		
		if (isset($_SESSION['ux']))
		{
			unset($_SESSION['ux']);
		}
	}

	echo "</TABLE>";
?>

<?php include("../includes/forms/middler.php")?>
<?php include("../includes/forms/footer.php")?>