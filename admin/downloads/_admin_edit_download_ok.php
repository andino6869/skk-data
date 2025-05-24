<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Download bearbeiten - Check");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/date/date.php")?>
<?php include("../_admin_param.php")?>
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
	if (IsSessionValid($objDBCon, $ux, "H")==0)
	{
		// Keine Gültigkeit mehr!
		include("../../includes/forms/middler.php");
		include("../forms/navigation_access_denied.php");
		include("../../includes/forms/footer.php");

		exit;
	}

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("../_admin_param_dx.php");

	// ######################
	// Die ID:
	$ID = strGetParam($objDBCon, "ID");

	// ######################
	$now = date("Y-m-d H:i:s");

	// Die Inhalte überprüfen:
	$errText = "";

	// ####################################################################################
	// 1.) Anzeigename:
	$viewname = strGetParam($objDBCon, "viewname");

	if (trim($viewname)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Anzeigename.<BR>";
	}
	$viewname = mysqli_escape_string($objDBCon, $viewname);


	// ###################################################################
	// 2.) Das Datumsfeld:
	// Der Tag:
	$expire_day = strGetParam($objDBCon, "expire_day");
	
	// Der Monat:
	$expire_month = strGetParam($objDBCon, "expire_month");

	// Das Jahr:
	$expire_year = strGetParam($objDBCon, "expire_year");

	// Ein gültiges Datum?
	$bCheckdate = checkdate($expire_month, $expire_day, $expire_year);

	if ( !$bCheckdate )
	{
		$errText = $errText."Das eingegebene Ablaufdatum ist kein gültiges Datum.<BR>";
	}

 	$expiredate = mysqli_escape_string($objDBCon, $expire_year.".".$expire_month.".".$expire_day);

	// Liegt das Datum bereits in de Vergangenheit?
	$now = date("Y-m-d");

	if ($expiredate < $now)
	{
		$errText = $errText."Das eingegebene Ablaufdatum liegt bereits jetzt in der Vergangenheit.<BR>";
	}


	// #######################################
	// 3.) Die Datei:
	// UPDATE 30.04.2014: Datei ist nur zum Lesen angezeigt!
	// $downloadfile = $_FILES["downloadfile"];
	$downloadfile = strGetParam($objDBCon, "downloadfile");
	$downloadfile=mysqli_escape_string($objDBCon, $downloadfile);

	// ####################################################################################
	// 4.) Kategorie:
	$category = strGetParam($objDBCon, "category");

	if (trim($category)=="")
	{
		$category = $errText."Es fehlt ein Eintrag im Feld Kategorie.<BR>";
	}
	$category = mysqli_escape_string($objDBCon, $category);

	if (trim($category)=="0")
	{
		$category = "ALLE";
	}

	if (trim($category)=="1")
	{
		$category = "AFRO";
	}

	if (trim($category)=="2")
	{
	    $category = "100-Jahre-Feier";
	}

	$objectclassicon = "download.jpg";
	include("../forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Download aktualisieren (DOWNLOAD - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);
	
	// ###################################################################
	// Gab es Fehler?
	if (trim($errText)!="")
	{
		include("../_admin_eingabe_fehler.php");
	}
	else
	{
		$now = date("Y-m-d H:i:s");

		// Der UPDATE:
		$strSQL = "UPDATE skk_downloads SET modifier='$curUser', modifieddate='$now' WHERE ID=$ID";

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo "Der Download konnte nicht aktualisiert werden!<BR>".chr(13).chr(10);
			echo mysql_error($objDBCon).chr(13).chr(10);
			echo "<BR>Statement: " . $strSQL . "<BR>".chr(13).chr(10);
		}
		else
		{
			$strSQL = "insert into skk_downloads (id, filename, viewname, expiredate, category, creator, createdate, del) VALUES ";
			$strSQL = $strSQL."($ID, '$downloadfile', '$viewname', '$expiredate', '$category', '$curUser', '$now', 'N')";

			if (!mysqli_query ($objDBCon, $strSQL))
			{
				echo "Der Download konnte nicht aktualisiert werden!<BR>".chr(13).chr(10);
				echo mysqli_error($objDBCon).chr(13).chr(10);
				echo "<BR>Statement: " . $strSQL . "<BR>".chr(13).chr(10);
			}
			else
			{
		  		echo "Die Datei <b>".$downloadfile."</b> steht unter der Bezeichnung ".$viewname." nun bis";
				echo " '".$expire_day.".".$expire_month.".".$expire_year."' wieder zum Download zur Verf&uuml;gung.<BR><BR>".chr(13).chr(10);
				
				include("../_admin_ok_link.php");
			}
		}
	}

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>