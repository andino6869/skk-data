<?php include("afro_header.php")?>
<?php
	writeheader("Tabellen");
?>
<?php include("afro_navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>

<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// 1.) Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// Gab es Probleme?
	if ($objDBCon == "")
	{
		echo "<BR>Problem mit dem Verbindungsaufbau zur Datenbank: Das Verbindungsobjekt konnte nicht erzeugt werden!<BR>";
		echo "</BODY></HTML>".chr(13).chr(10);
		exit;
	}

	// 2.) Prüfen, ob der Zugang auf die AFRO - Seite aktuell überhaupt erlaubt ist:
	if (bIsAFROValid($objDBCon)==0)
	{
		// Keine Gültigkeit mehr!
		include("afro_middler.php");
		include("afro_footer.php");

		exit;
	}

	// 3.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $objDBCon);

	// ###############
	// 4.) Der Inhalt:
  	if (isset($_REQUEST["Nr"]))
  	{
  		$Nr = $_REQUEST["Nr"];
  	}
  	else 
  	{
  		if (isset($_GET["Nr"]))
  		{
  			$Nr = $_GET["Nr"];
  		}
  		else 
  		{
  			$Nr = 0;
  		}
  	}
  	
	$strSQL="select * from skk_content WHERE ID=".$Nr." AND del='N' AND modifieddate IS NULL;";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$Titel[$i] = $row->title;
			$Content[$i] = $row->content;
			$i++;
		}
		
		$strItem = formatoutput($Titel[0]);
		$strItem = str_replace("\'", "'", $strItem);
		$strItem = str_replace("\\".chr(34), chr(34), $strItem);

		echo "<SPAN CLASS=he1>".$strItem."</SPAN><BR><BR>".chr(13).chr(10);

		$strItem = formatoutput($Content[0]);
		$strItem = str_replace("\'", "'", $strItem);
		$strItem = str_replace("\\".chr(34), chr(34), $strItem);

		echo $strItem.chr(13).chr(10);
	}
	else
	{
		echo "Der hinterlegte Content konnte nicht in der Datenbank gefunden werden!<BR>".chr(13).chr(10);
	}



	include("afro_middler.php");
	include("afro_user_registration.php");

	get_user_registration($objDBCon);

	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("afro_downloads.php");
	get_downloads($objDBCon);
	include("afro_footer.php");
?>
