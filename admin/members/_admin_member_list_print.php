<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/string/str.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	echo "<HTML>";
	echo "<TITLE>Mitgliederliste des Schachklub Kriegshaber</TITLE>";
	echo "<BODY>";

	// 1.) Das Verbindungsobjekt ermitteln:
	$objDBCon = GetCon();


	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	if (isset($_GET["ux"]))
	{
		$ux = $_GET["ux"];
	}

	if (isset($_REQUEST["ux"]))
	{
		$ux = $_REQUEST["ux"];
	}
	$curUser = strGetCurrentUserByID($objDBCon, $ux);


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

	echo "<SPAN CLASS=he1><B><U>Mitgliederliste SK Kriegshaber (alphabetisch sortiert)</U></B></SPAN><BR><BR>".chr(13).chr(10);
	echo "<SPAN CLASS=he1><B>Aktive Mitglieder</B></SPAN><BR><BR>".chr(13).chr(10);
	echo "<table cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);

	// Die Daten der aktiven Mitglieder holen:
	$strSQL = "select * from skk_members WHERE del='N' AND modifieddate IS NULL AND membertype='A' ORDER BY name ASC";
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Konnten Datensätze ermittelt werden:
	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
  			$ID[$i] = $row->id;
  			$Name[$i] = formatoutput($row->name);
  			$Vorname[$i] = formatoutput($row->vorname);
  			$Telefon[$i] = $row->telephone;
  			$Mobiltelefon[$i] = $row->mobile;
  			$Email[$i] = $row->mail;
			$Strasse[$i] = formatoutput($row->addrstreet);
			$PLZ[$i] = $row->addrzipcode;
			$Ort[$i] = formatoutput($row->addrcity);
			$Geburtstag[$i] = $row->birthdate;

			if ($i%2==0)
   			{ echo "<tr bgcolor=eeeeee>".chr(13).chr(10);; }
  			else
   			{ echo "<tr bgcolor=fefefe>".chr(13).chr(10);; }

			echo "<td valign=top><b>".$Name[$i]."</b>,<BR> &nbsp; ".chr(13).chr(10);
			echo $Vorname[$i]."</td><td valign=top><SPAN CLASS=sm>".chr(13).chr(10);
			echo $Strasse[$i]."<BR>".chr(13).chr(10);
			echo $PLZ[$i]." ".chr(13).chr(10);
			echo $Ort[$i]."</SPAN></td><td valign=top><a STYLE='font-size:7pt;' href='mailto:",$Email[$i],"'>".chr(13).chr(10);
			echo $Email[$i]."<a/><BR><SPAN CLASS=sm>".chr(13).chr(10);
			echo $Telefon[$i]."<BR>".chr(13).chr(10);
			echo $Mobiltelefon[$i]."<BR>".chr(13).chr(10);

			// Keine leeren Werte ausgeben:
			if ((trim($Geburtstag[$i])!="0000-00-00") && trim($Geburtstag[$i])!="")
			{
				echo "Geb. ".substr($Geburtstag[$i],8,2).".".substr($Geburtstag[$i],5,2).".".substr($Geburtstag[$i],0,4).chr(13).chr(10);
			}
			
			$i++;
		}
	}
	else
	{
		echo "<tr><td>Es sind derzeit keine aktiven Mitglieder hinterlegt!".chr(13).chr(10);
	}

	echo "</table>".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);
	echo "<SPAN CLASS=he1><B>Passive Mitglieder</B></SPAN><BR><BR>".chr(13).chr(10);
	echo "<table cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);

	// Die Daten der passiven Mitglieder holen:
	$strSQL = "select * from skk_members WHERE del='N' AND modifieddate IS NULL AND membertype='P' ORDER BY name DESC";
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Konnten Datensätze ermittelt werden:
	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
  			$ID[$i] = $row->id;
  			$Name[$i] = formatoutput($row->name);
  			$Vorname[$i] = formatoutput($row->vorname);
  			$Telefon[$i] = $row->telephone;
  			$Mobiltelefon[$i] = $row->mobile;
  			$Email[$i] = $row->mail;
			$Strasse[$i] = formatoutput($row->addrstreet);
			$PLZ[$i] = $row->addrzipcode;
			$Ort[$i] = formatoutput($row->addrcity);
			$Geburtstag[$i] = $row->birthdate;

			if ($i%2==0)
   			{ echo "<tr bgcolor=eeeeee>".chr(13).chr(10); }
  			else
   			{ echo "<tr bgcolor=fefefe>".chr(13).chr(10); }

			echo "<td valign=top><b>".$Name[$i]."</b>,<BR> &nbsp; ".chr(13).chr(10);
			echo $Vorname[$i]."</td><td valign=top><SPAN CLASS=sm>".chr(13).chr(10);
			echo $Strasse[$i]."<BR>".chr(13).chr(10);
			echo $PLZ[$i]." ";
			echo $Ort[$i]."</SPAN></td><td valign=top><a STYLE='font-size:7pt;' href='mailto:".$Email[$i]."'>".chr(13).chr(10);
			echo $Email[$i]."<a/><BR><SPAN CLASS=sm>".chr(13).chr(10);
			echo $Telefon[$i]."<BR>".chr(13).chr(10);
			echo $Mobiltelefon[$i]."<BR>".chr(13).chr(10);

			// Keine leeren Werte ausgeben:
			if ((trim($Geburtstag[$i])!="0000-00-00") && trim($Geburtstag[$i])!="")
			{
				echo "Geb. ".substr($Geburtstag[$i],8,2).".".substr($Geburtstag[$i],5,2).".".substr($Geburtstag[$i],0,4).chr(13).chr(10);
			}
		}
	}
	else
	{
		echo "<tr><td>Es sind derzeit keine passiven Mitglieder hinterlegt!".chr(13).chr(10);
	}

	mysqli_close($objDBCon);
	
	echo "</table>".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);
	echo "</BODY></HTML>".chr(13).chr(10);
?>