<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################

	echo "</TD></TR></TABLE>".chr(13).chr(10);
 	echo "</TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);

	// ##################
	// UPDATE 13.06.2015:
	// Führt ab IE 11 zu einer falschen Darstellung, daher entfernt:
	// echo "<TR height=2><TD colspan=3 bgcolor=cfe999></td></TR>".chr(13).chr(10);
	// UPDATE Ende
	// ###########

	echo "</TABLE>".chr(13).chr(10);
	echo "<TABLE width='100%' border='1'>".chr(13).chr(10);
	echo "<TR><TD font color='#FFFFFF' bgcolor='#CC9900' align='center'>".chr(13).chr(10);

	// ############
	// Datenschutz:
	$strRef = "";
	
	if (is_file("../sites/data_protection.php"))
	{
		$strRef = "../sites/data_protection.php";
	}
	else
	{
		$strRef = "../../sites/data_protection.php";
	}
	
	echo "&nbsp; &nbsp;<A HREF='".$strRef."'>Datenschutz</A> &nbsp; &nbsp; |".chr(13).chr(10);
	
	// ##################
	// Haftungsausschluß:
	$strRef = "";
	
	if (is_file("../sites/liability.php"))
	{
		$strRef = "../sites/liability.php";
	}
	else
	{
		$strRef = "../../sites/liability.php";		
	}
	
	echo "&nbsp; &nbsp;<A HREF='".$strRef."'>Haftungsausschlu&szlig;</A> &nbsp; &nbsp; |".chr(13).chr(10);
	
	// ##################################
	// Administration / Redaktionssystem:
	$strRef = "";
	
	if (is_file("../admin/_admin.php"))
	{
		$strRef = "../admin/_admin.php";		
	}
	else
	{
		$strRef = "../../admin/_admin.php";
	}
	
	echo "&nbsp; &nbsp;<A HREF='".$strRef."'>Administration / Redaktionssystem</A> &nbsp; &nbsp; |".chr(13).chr(10);

	// ##########
	// Impressum:
	if (is_file("../sites/masthead.php"))
	{
		$strRef = "../sites/masthead.php";
	}
	else
	{
		$strRef = "../../sites/masthead.php";
	}
	
	echo "&nbsp; &nbsp;<A HREF='".$strRef."'>Impressum</A>".chr(13).chr(10);

	echo "</TD>".chr(13).chr(10);
	echo "</TR>".chr(13).chr(10);
	echo "</TABLE>".chr(13).chr(10);

	// #########################################################
	// Zugriffscounter holen:
	$strSQL = "SELECT numberofhits FROM skk_hits WHERE del='N' AND modifieddate IS NULL;";
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$row = $rs->fetch_object();
		$numberofhits = $row->numberofhits;
		
		$strSQL = "SELECT MIN(createdate) AS tmp FROM skk_hits;";
		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

		if ($RecordCount > 0)
		{
			$row = $rs->fetch_object();
			$createdate = $row->tmp;
			
			echo "<p align='center'><font color='#FFFFFF'>Anzahl der Zugriffe seit ";

			echo substr($createdate,8,2).".";
			echo substr($createdate,5,2).".";
			echo substr($createdate,0,4)." um ";
			echo substr($createdate,11,2).":";
			echo substr($createdate,14,2)." Uhr";

			echo ": ".$numberofhits."</font></p>";
		}
	}

	echo "<p align='center'><font face='Arial' color='#FFFFFF'>Powered by PHP ".(float)phpversion()."</font></p>".chr(13).chr(10);
	echo "</BODY>".chr(13).chr(10);
	echo "</HTML>".chr(13).chr(10);
	
	// #####################################
	// Datenbankverbindung wieder schließen:
	try 
	{
		$objDBCon->close();
	} 
	catch (Exception $e) 
	{
	}
?>
