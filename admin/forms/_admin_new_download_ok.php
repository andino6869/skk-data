<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Neuen Download hinzuf&uuml;gen - Check");
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

	// Die Inhalte überprüfen:
	$errText = "";

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
	// UPDATE 30.04.2014: Array muss nun direkt auf den Namen verweisen, da ansonsten 
	// die Upload - Zeichenkette leer ist.
	$file = $_FILES["file"]["name"];


	if (trim($file)=="")
	{
		$file=$_GET["file"];
	}

	if (trim($file)=="")
	{
		$file=$_REQUEST["file"];
	}


	// UPDATE: Trim allein reicht nicht aus!
	if (strlen(trim($file)) <> 0)
	{

		// Nach Leerzeichen im Dateinamen suchen:
		$pos=strpos($file, " ");

		if (!($pos === false))
		{
			$errText = $errText."Der angegebene Dateiname beinhaltet unzulässige Leerzeichen!<BR>";
		}
		else
		{
			include("../../includes/files/upload_downloads.php");
		}
	}
	else
	{
		$errText = $errText."Es wurde keine Download - Datei mit angegeben!<BR>";
	}

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

	$objectclassicon = "download.jpg";
	include("../forms/objectclassicon.php");
	echo "<SPAN CLASS=he1>Neuen Download speichern (DOWNLOAD - Tabelle)</SPAN><BR><BR>".chr(13).chr(10);

	// ###################################################################
	// Gab es Fehler?
	if (trim($errText)!="")
	{
		include("../_admin_eingabe_fehler.php");
	}
	else
	{
		// Wurde dieser Download bereits gespeichert?
		// File hat bereits die Anf&uuml;hrungszeichen!
		// Achtung, es wird hier bewusst nur auf den Dateinamen abgestellt!!!!
		$strSQL = "SELECT id FROM skk_downloads WHERE filename=$file";
		$strSQL = $strSQL." AND del='N' AND modifieddate IS NULL;";

		if (bCheckRecordset($con, $strSQL)==1)
		{
			$errText = "Die aktuelle Meldung wurde bereits in der Datenbank gespeichert!";
			include("_admin_eingabe_fehler.php");
		}
		else
		{
		  	$now = date("Y-m-d H:i:s");

			$strSQL = "insert into skk_downloads (filename, viewname, expiredate, category, creator, createdate, del) VALUES ";
			$strSQL = $strSQL."($file, '$viewname', '$expiredate', '$category', '$curUser', '$now', 'N')";

			if (!mysql_query ($strSQL, $con))
			{
				$errText = $strSQL."<BR>".mysql_error()."<BR>".chr(13).chr(10);
		  		include("_admin_eingabe_fehler.php");
			}
			else
			{
		  		echo "Die Datei <b>".$file."</b> steht unter der Bezeichnung ".$viewname." nun bis";
				echo " '".$expire_day.".".$expire_month.".".$expire_year."' zum Download zur Verf&uuml;gung.<BR><BR>".chr(13).chr(10);
				
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