<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Massen - Email versenden - Check");
?>
<?php include("../../includes/forms/navigation.php")?>
<?php include("../../includes/db/connection.php")?>
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

	// ##############################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	if (isset($_GET["dx"]))
	{
		$dx = $_GET["dx"];
	}

	if (isset($_REQUEST["dx"]))
	{
		$dx = $_REQUEST["dx"];
	}

	if ($dx=="")
	{
		$dx = 0;
	}

	// Die ausgewählten Adressen holen:
	if (isset($_GET["Adresse"]))
	{
		$Adresse=$_GET["Adresse"];
	}

	if (isset($_REQUEST["Adresse"]))
	{
		$Adresse=$_REQUEST["Adresse"];
	}

	$count = count($Adresse);
	$count--;
	$i = 0;
	$A="'";

	// Die Anzahl der Aktionen ermitteln:
	while ($i<=$count)
	{
		$i++;
	}

	// Wurden überhaupt Emailadressen ausgewählt?
	if ($i==0)
	{
		$errText = $errText."Sie haben keine einzige Emailadresse für den Versand ausgew&auml;hlt.<BR>";
	}

	$A=$A."'";

	// Prüfen, ob wir überhaupt Inhalte haben!
	if (isset($_GET["Inhalt"]))
	{
		$Inhalt=$_GET["Inhalt"];
	}

	if (isset($_REQUEST["Inhalt"]))
	{
		$Inhalt=$_REQUEST["Inhalt"];
	}

	$Inhalt = str_replace("\n","<br>",$Inhalt);

	if (trim($Inhalt)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Inhalt.<BR>";
	}

	// Der Absender:
	if (isset($_GET["Absender"]))
	{
		$Absender = $_GET["Absender"];
	}

	if (isset($_REQUEST["Absender"]))
	{
		$Absender = $_REQUEST["Absender"];
	}

	if (trim($Absender)=="")
	{
		$errText = $errText."Es fehlt ein Eintrag im Feld Absender.<BR>";
	}

	// Gab es Fehler?
	if (trim($errText)!="")
	{
		echo "<font color='#FF0000' size=4><BR><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
		echo "<b>Die neue Email konnte leider aus folgenden Gr&uuml;nden nicht versendet werden:</b><BR><BR>".chr(13).chr(10);
		echo "<BR><I>".$errText."</I>".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
		echo "<BR><BR>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
	}
	else
	{
		echo "<SPAN CLASS=he1>Sendebest&auml;tigung</SPAN><BR><BR>".chr(13).chr(10);
		echo "Anzahl der zu &uuml;bertragenden Emails: ".$i."<BR><BR>".chr(13).chr(10);
		echo "<table cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);

		$headers = "Content-Type: text/html\n";
		$headers .= "Content-Transfer-Encoding: 8bit\n";
		$headers .= "From: <".$Absender.">\n";
		$headers .= "Reply-To: $Absender\n";


		ini_set('sendmail_from', 'SYSTEM@skk.de');

		for ($i=0;$i<=$count;$i++)
		{
			// Die Mail an die Adressaten versenden:
		  	if (mail($Adresse[$i], $Betreff, $Inhalt, $headers))
		  	{
		  		echo "<tr><td colspan=2>Status:<BR><BR>Die Mail wurde erfolgreich an '$Adresse[$i]' verschickt.</td><tr>".chr(13).chr(10);
		  	}
		  	else
		  	{
		  		echo "<tr><td colspan=2>Status:<BR><BR>Die Mail an '$Adresse[$i]' konnte <B>NICHT</B> verschickt werden.</td><tr>".chr(13).chr(10);
		  	}
		}
		echo "</table>".chr(13).chr(10);
	}

	echo "<BR><BR>".chr(13).chr(10);

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>





