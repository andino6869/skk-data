<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################
	echo "<FORM METHOD=POST ACTION='../admin/_admin_index.php'>";

	// Sicherheitseinstellungen:
	$now = date("Y-m-d H:i:s");
	$dx = strrev($now);
	$dx = base64_encode($dx);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	// Kommt der Login von der Anfrageadresse?
	// Aktuelle Adresse:
	$ip = $_SERVER['REMOTE_ADDR'];

	if (trim($ip)=="")
	{
		$ip = "NO_IP_HEADER";
	}

	$ix = strrev($ip);
	$ix = base64_encode($ix);

	echo "<INPUT TYPE='HIDDEN' NAME='ix' Value='".$ix."'>".chr(13).chr(10);

	// 10 Minuten Loginzeit zulassen, dann das Formular verwerfen!
	$strSQL = "SELECT DATE_ADD('$now', INTERVAL 10 MINUTE)";
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Wurden Datensätze gefunden?
	if ($RecordCount > 0)
	{
		$row = $rs->fetch_row();
		$tx = $row[0];
		$tx = strrev($tx);
		$tx = base64_encode($tx);
		echo "<INPUT TYPE='HIDDEN' NAME='tx' Value='$tx'>".chr(13).chr(10);
	}

	// Ausgabe der Textes:
	echo "<BR>";
	echo "<table>".chr(13).chr(10);
	echo "<tr>".chr(13).chr(10);
	echo "<td width=250>Nachname (max. 30 Zeichen):</td>".chr(13).chr(10);
	echo "<td>".chr(13).chr(10);
	echo "<INPUT TYPE=TEXT SIZE=30 maxlength=30 NAME=ulx>".chr(13).chr(10);
	echo "</td>".chr(13).chr(10);
	echo "</tr>".chr(13).chr(10);
	echo "<tr>".chr(13).chr(10);
	echo "<td width=250>Vorname (max. 30 Zeichen):</td>".chr(13).chr(10);
	echo "<td>".chr(13).chr(10);
	echo "<INPUT TYPE=TEXT SIZE=30 maxlength=30 NAME=ufx>".chr(13).chr(10);
	echo "</td>".chr(13).chr(10);
	echo "</tr>".chr(13).chr(10);
	echo "<tr>".chr(13).chr(10);
	echo "<td>Passwort (max. 12 Zeichen):</td>".chr(13).chr(10);
	echo "<td>".chr(13).chr(10);
	echo "<INPUT TYPE=PASSWORD SIZE=30 maxlength=12 NAME=px>".chr(13).chr(10);
	echo "</td>".chr(13).chr(10);
	echo "</tr>".chr(13).chr(10);
	echo "<tr>".chr(13).chr(10);
	echo "<td></td>".chr(13).chr(10);
	echo "<td>".chr(13).chr(10);
	echo "<INPUT TYPE=SUBMIT VALUE='Anmeldung durchf&uuml;hren'>".chr(13).chr(10);
	echo "</td>".chr(13).chr(10);
	echo "</tr>".chr(13).chr(10);
	echo "</table>".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);
?>
