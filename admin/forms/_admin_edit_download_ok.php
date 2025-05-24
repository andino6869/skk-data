<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Download bearbeiten - Check");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
<?php include("../../includes/date/date.php")?>
<?php
	// 1.) Das Verbindungsobjekt ermitteln:
	$con = GetCon();

	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
  	writeNavigationBar(999, $con, "FALSE");


	// ##############################################
	// 3.) Die ID des Benutzers ermitteln und dekodieren:
	include("../_admin_param_ux.php");


	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($con, $ux, "H")==0)
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
	if (trim($ID)=="")
	{
		$ID=$_GET["ID"];
	}

	if (trim($ID)=="")
	{
		$ID=$_REQUEST["ID"];
	}

	// ######################
	$now = date("Y-m-d H:i:s");

	// Die Inhalte überprüfen:
	$errText="";

	// ####################################################################################
	// 1.) Anzeigename:
	if (trim($viewname)=="")
	{
		$viewname=$_GET["viewname"];
	}

	if (trim($viewname)=="")
	{
		$viewname=$_REQUEST["viewname"];
	}

	if (trim($viewname)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Anzeigename.<BR>";
	}
	$viewname=mysql_escape_string($viewname);


	// ###################################################################
	// 2.) Das Datumsfeld:
	// Der Tag:
	if (trim($expire_day)=="")
	{
		$expire_day=$_GET["expire_day"];
	}

	if (trim($expire_day)=="")
	{
		$expire_day=$_REQUEST["expire_day"];
	}

	// Der Monat:
	if (trim($expire_month)=="")
	{
		$expire_month=$_GET["expire_month"];
	}

	if (trim($expire_month)=="")
	{
		$expire_month=$_REQUEST["expire_month"];
	}

	// Das Jahr:
	if (trim($expire_year)=="")
	{
		$expire_year=$_GET["expire_year"];
	}

	if (trim($expire_year)=="")
	{
		$expire_year=$_REQUEST["expire_year"];
	}

	// Ein gültiges Datum?
	$bCheckdate = checkdate($expire_month, $expire_day, $expire_year);

	if ( !$bCheckdate )
	{
		$errText = $errText."Das eingegebene Ablaufdatum ist kein gültiges Datum.<BR>";
	}

 	$expiredate = mysql_escape_string($expire_year.".".$expire_month.".".$expire_day);

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

	if (trim($downloadfile)=="")
	{
		$downloadfile=$_GET["downloadfile"];
	}

	if (trim($downloadfile)=="")
	{
		$downloadfile=$_REQUEST["downloadfile"];
	}
	$downloadfile=mysql_escape_string($downloadfile);

//echo "AAA".$downloadfile."BBB";


	// ####################################################################################
	// 4.) Kategorie:
	if (trim($category)=="")
	{
		$category=$_GET["category"];
	}

	if (trim($category)=="")
	{
		$category=$_REQUEST["category"];
	}

	if (trim($category)=="")
	{
		$category = $errText."Es fehlt ein Eintrag im Feld Kategorie.<BR>";
	}
	$category=mysql_escape_string($category);

	if (trim($category)=="0")
	{
		$category = "ALLE";
	}

	if (trim($category)=="1")
	{
		$category = "AFRO";
	}

	$category = strtoupper($category);

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

		if (!mysql_query ($strSQL, $con))
		{
			echo "Der Download konnte nicht aktualisiert werden!<BR>".chr(13).chr(10);
			echo mysql_error().chr(13).chr(10);
			echo "<BR>Statement: " . $strSQL . "<BR>".chr(13).chr(10);
		}
		else
		{
			$strSQL = "insert into skk_downloads (id, filename, viewname, expiredate, category, creator, createdate, del) VALUES ";
			$strSQL = $strSQL."($ID, '$downloadfile', '$viewname', '$expiredate', '$category', '$curUser', '$now', 'N')";

			if (!mysql_query ($strSQL, $con))
			{
				echo "Download konnte nicht aktualisiert werden!<BR>".chr(13).chr(10);
				echo mysql_error().chr(13).chr(10);
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
	writenavigation($ux, $dx);

	include("../../includes/forms/footer.php");
?>