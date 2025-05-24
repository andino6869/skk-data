<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Fotogalerien (Archiv)");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/string/str.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// #############################
	// 1.) Datenbankverbindung aufbauen:
	$objDBCon = GetCon();


	// ##############################################
	// 2.) In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	// Welcher Seiteninhalt soll angezeigt werden?
	writeNavigationBar(9, $objDBCon);

	echo "</CENTER>".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);

	$Monat[12]="Dezember";
	$Monat[11]="November";
	$Monat[10]="Oktober";
	$Monat[9]="September";
	$Monat[8]="August";
	$Monat[7]="Juli";
	$Monat[6]="Juni";
	$Monat[5]="Mai";
	$Monat[4]="April";
	$Monat[3]="M&auml;rz";
	$Monat[2]="Februar";
	$Monat[1]="Januar";

	// #########################################################
	// 3.) Gab es Probleme beim Verbindungsaufbau?
	if ($objDBCon == "")
	{
		echo "<BR>Problem mit dem Verbindungsaufbau zur Datenbank: Das Verbindungsobjekt konnte nicht erzeugt werden!<BR>".chr(13).chr(10);
		echo "</BODY></HTML>".chr(13).chr(10);
		exit;
	}

	echo "<SPAN CLASS=he1>Fotogaleriearchiv (GALERY - Tabelle), Inhalt absteigend sortiert nach dem Galeriedatum</SPAN><BR><BR>".chr(13).chr(10);

	// #########################################################
	// 4.) Daten aus Datenbank holen:
	$strSQL = "select * from skk_galery WHERE modifieddate IS NULL AND ";
	$strSQL = $strSQL."del='N'";
	$strSQL = $strSQL." ORDER BY galerydate DESC";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount > 0)
	{
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$ID[$i] = $row->id;
			$galery[$i] = $row->galery;
			$galerydate[$i] = $row->galerydate;
			$category[$i] = $row->category;
			$creator[$i] = $row->creator;
				
			$i++;
		}
	}
	

	// Gibt es Datensätze?
	if ($RecordCount == 0)
	{
		echo "<table border=0><tr><td width=500 valign=top>".chr(13).chr(10);
	    echo "<td width=15></td>".chr(13).chr(10);
		echo "<B>Es sind derzeit keine Fotogalerien hinterlegt.</B>".chr(13).chr(10);
		echo "</td></tr></table><BR>".chr(13).chr(10);
	}
	else
	{
		// #################################
		// Merker setzen:
		$bSetMonth = "FALSE";


		// Daten ausgeben:
		$counter = 0;

		for($i=0; $i<$RecordCount; $i++)
		{
			// #################################
			// Ausgabe der Monatsansicht:
			if ($bSetMonth == "FALSE")
			{
		    	echo "<BR><BR><SPAN CLASS='red_head'> ".$Monat[(double)substr($galerydate[$i],5,2)]." ".substr($galerydate[$i],0,4)."</SPAN>";
				echo "<HR noshade size=1 color='#5B2E00'>".chr(13).chr(10);
				$bSetMonth = "TRUE";
			}

			// #################################
			// Der Link auf die Bildergalerie
			echo "<table border=0><tr><td width='100%' valign=top>".chr(13).chr(10);
			echo "<a href='galery_pics.php?Nr=".$ID[$i]."'>";

			$strItem = formatoutput($galery[$i]);
			echo $strItem."</A><BR>".chr(13).chr(10);

			// ###################################
			// Welches Icon soll angezeigt werden?
			if (is_file("pics/icons/thunder.gif"))
			{
				$strPath = "pics/icons/";
			}
			else
			{
				if (is_file("../pics/icons/thunder.gif"))
				{
					$strPath = "../pics/icons/";
				}
				else 
				{
					$strPath = "../../pics/icons/";
				}
			}
			
			switch (trim(strtolower($category[$i])))
			{
			case "erwachsene":
				echo "<IMG SRC='".$strPath."thunder.gif' height='10' width='10'>".chr(13).chr(10);
				break;
	
			case "afro":
				echo "<IMG SRC='".$strPath."afro.gif' height='10' width='10'>".chr(13).chr(10);
				break;

			case "sport":
				echo "<IMG SRC='".$strPath."sport.gif' height='10' width='10'>".chr(13).chr(10);
				break;

			case "jugend":
				echo "<IMG SRC='".$strPath."youth.gif' height='10' width='10'>".chr(13).chr(10);
				break;
			}

			// ###################################
			// Das Datum der Galerie:
			echo "[".substr($galerydate[$i], 8, 2).".".substr($galerydate[$i],5,2).".".substr($galerydate[$i],0,4)."]".chr(13).chr(10);

			// ###################################
			// Der Ersteller:
		    echo "<I> von ".trim($creator[$i])."</I>".chr(13).chr(10);
			echo "</td></tr></table><BR>".chr(13).chr(10);

			// ###################################
			// Einen neuen Monat erreicht?
			if($i<$RecordCount-1)
			{
				// Jahreswechsel?
				if (substr($galerydate[$i],0,4) > substr($galerydate[$i+1],0,4))
				{
					$bSetMonth = "FALSE";
				}
				else
				{
					// Der nächste Monat?
					if (substr($galerydate[$i],5,2) > substr($galerydate[$i+1],5,2))
					{
						$bSetMonth = "FALSE";
					}
					else
					{
						// Der Jahreswechsel wurde bis dato vergessen!
						if (substr($galerydate[$i],5,2) == "01" && substr($galerydate[$i+1],5,2) == "12")
						{
							$bSetMonth = "FALSE";
						}
					}
  				}
			}
		}
	}


	include("../includes/forms/middler.php");

	// ######################################
	// Die neue Suchfunktion:
	include("../includes/forms/seekgalery.php");
	writeseekgalery("", "TRUE");

	// ######################################
	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>
