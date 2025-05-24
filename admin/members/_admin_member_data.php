<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Mitgliedsdaten");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/string/str.php")?>
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
	if (IsSessionValid($objDBCon, $ux, "A")==0)
	{
		// Keine Gültigkeit mehr!
		include("../../includes/forms/middler.php");
		include("../forms/navigation_access_denied.php");
		include("../../includes/forms/footer.php");

		exit;
	}

	echo "<SPAN CLASS=he1>Mitgliedsdaten</SPAN><BR><BR>".chr(13).chr(10);
	echo "<table cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("../_admin_param_dx.php");

	// ####################
	// 6.) Die ID erfragen:
	include("../_admin_param_id.php");
	
	// ##################################
	// 7.) Die Daten des Mitglieds holen:
	$strSQL = "select * from skk_members WHERE del='N' AND modifieddate IS NULL AND ID=$ID ORDER BY name DESC";
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Konnten Datensätze ermittelt werden:	
	if ($RecordCount > 0)
	{
		$row = $rs->fetch_object();
		
		$ID = $row->id;
		$Name = formatoutput($row->name);
		$Vorname = formatoutput($row->vorname);
		$Telefon = $row->telephone;
		$Mobiltelefon = $row->mobile;
		$Strasse = formatoutput($row->addrstreet);
		$PLZ = $row->addrzipcode;
		$Ort = formatoutput($row->addrcity);
		$Email = formatoutput($row->mail);
		$Geburtsdatum = $row->birthdate;
		$Eintrittsdatum = $row->entrydate;
		$Geburtsort = formatoutput($row->birthplace);
		$Merkmal = formatoutput($row->membertype);
		$picture = $row->picture;

		if (strtolower(trim($Merkmal))=="p")
		{
			$Merkmal="Passiv";
		}
		else
		{
			$Merkmal="Aktiv";
		}

		$Sonstiges = $row->info;
		$sex = $row->sex;

		if (strtolower(trim($sex))=="w")
		{
			$sex="Weiblich";
		}
		else
		{
			$sex="M&auml;nnlich";
		}

		$active = $row->active;

		if (strtolower(trim($active))=="j")
		{
			$active="Ja";
		}
		else
		{
			$active="Nein";
		}


		$DWZ = $row->dwz;
		$ELO = $row->elo;
		$Titel = $row->title;

		echo "<tr bgcolor=eeeeee><td width=150>Name:</td><td width=120>".$Name."</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=fefefe><td>Vorname:</td><td>".$Vorname."</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=eeeeee><td>Telefon:</td><td>".$Telefon."</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=fefefe><td>Telefon mobil:</td><td>".$Mobiltelefon."</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=eeeeee><td>Strasse:</td><td>".$Strasse."</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=fefefe><td>PLZ:</td><td>".$PLZ."</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=eeeeee><td>Ort:</td><td>".$Ort."</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=fefefe><td>Email:</td><td>".$Email."</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=eeeeee><td>Geburtsdatum:</td><td>".substr($Geburtsdatum, 8, 2).".".substr($Geburtsdatum,5,2).".".substr($Geburtsdatum,0,4),"</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=fefefe><td>Eintrittsdatum:</td><td>".substr($Eintrittsdatum, 8, 2).".".substr($Eintrittsdatum,5,2).".".substr($Eintrittsdatum,0,4),"</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=eeeeee><td>Geburtsort:</td><td>".$Geburtsort."</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=fefefe><td>Merkmal:</td><td>".$Merkmal."</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=eeeeee><td>Sonstiges:</td><td>".$Sonstiges."</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=fefefe><td>DWZ:</td><td>".$DWZ."</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=eeeeee><td>ELO:</td><td>".$ELO."</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=fefefe><td>Titel:</td><td>".$Titel."</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=eeeeee><td>Geschlecht:</td><td>".$sex."</td></tr>".chr(13).chr(10);

		echo "<tr bgcolor=fefefe><td>Zugriffsrechte auf den Adminbereich:</td><td>";

		switch (strtolower($active))
  		{
  			case "n":
  				echo "Keine Zugriffsrechte auf den Administrationbereich".chr(13).chr(10);
  				break;

  			case "r":
  				echo "Online-Redakteur".chr(13).chr(10);
  				break;

  			case "h":
  				echo "Online-Redakteur und Homepageverwalter".chr(13).chr(10);
  				break;

  			default:
  				echo "Administrator".chr(13).chr(10);
  				break;
  		}

		echo "</td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=eeeeee><td>Hinterlegte Grafikdatei:</td><td>".$picture."</td></tr>".chr(13).chr(10);
	}
	else
	{
		echo "<TR><TD>Es konnten zu dem gewählten Mitglied keine Daten aus der Datenbank gelesen werden.</TD></TR>".chr(13).chr(10);
	}


	echo "</table>".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);
	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>







