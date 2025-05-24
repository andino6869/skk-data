<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Admin - Objekt l&ouml;schen ");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/db/connection.php")?>
<?php include("../includes/forms/browsertype.php")?>
<?php include("_admin_param.php")?>
<?php include("../includes/string/str.php")?>
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
  	include("_admin_param_ux.php");


	// ##############################################
	// 4.) Ist der aktuelle Login noch gültig?
	if (IsSessionValid($objDBCon, $ux, "R")==0)
	{
		// Keine Gültigkeit mehr!
		include("../includes/forms/middler.php");
		include("forms/navigation_access_denied.php");
		include("../includes/forms/footer.php");

		exit;
	}

	// #######################################
	// 5.) Den aktuellen Dispatcher ermitteln:
	include("_admin_param_dx.php");

	// ########################################
	// 6.) Die aktuelle Objektklasse ermitteln:
	$objclass = strGetParam($objDBCon, "objectclass");
	
	// ############################################
	// 7.) Die Daten der aktuellen Klasse auslesen:
	$strSQL = "select * from skk_objectclasses where objectclassname='$objclass' AND del='N' AND modifieddate IS NULL;";
	
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);
	$row = $rs->fetch_object();
	
	$objectclassshownname = $row->objectclassshownname;
	$objectclassicon =  $row->objectclassicon;
	$objectclasstable =  $row->objectclasstable;
	$objectclasseditform = $row->objectclasseditform;
	$colsinseekform = $row->colsinseekform;
	
	// ##############################################
	// 8.) Das Formular aufbauen:
	// 8.1.) Die Grafik ausgeben:
	include("forms/objectclassicon.php");
	
	// ###############################
	// 8.2.) Die Objektklasse ausgeben:
	echo "<SPAN CLASS=he1>".$objectclassshownname." l&ouml;schen</SPAN><BR><BR>".chr(13).chr(10);
	echo "<form method=post action='_admin_delete_ok.php?CurrentTable=$objectclasstable&objectclassicon=$objectclassicon&CurrentObjectClassShownname=$objectclassshownname'>".chr(13).chr(10);
	
	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);
	
	// ####################
	// 9.) Die Daten holen:
	$strSQL = "select id,".$colsinseekform." from ".$objectclasstable." WHERE del='N' AND modifieddate IS NULL ORDER BY ".$colsinseekform." ASC";

	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);
	
	// ######################################
	// 10.) Konnten Einträge gefunden werden?
	if ($RecordCount > 0)
	{
		echo "<TABLE width='100%' border=1>".chr(13).chr(10);
		echo "<TR><TD width='100%'  bgcolor='#C0C0C0'><B><U>Eintrag:</U></B>";
	
		// ######################
		// 10.1.) Hilfe anzeigen?
		if ($dx==1)
		{
			echo "<BR><BR>".chr(13).chr(10);
			echo "<I>W&auml;hlen Sie hier den Datensatz aus, den Sie l&ouml;schen m&ouml;chten. Die hier angezeigten Datens&auml;tze stammen aus der Tabelle '".$objectclasstable."' und sind nach den Spalten '".$colsinseekform."' absteigend sortiert.</I>";
		}
		echo "</TD></TR>".chr(13).chr(10);
	
		// ###############################
		// 10.2.) Ausgabe der Auswahliste:
		echo "<TR><TD width='100%'><SELECT NAME=Nr style='width:100%'>".chr(13).chr(10);
	
		// Die betroffenen Felder ermitteln:
		$arrFields = explode(",", $colsinseekform);
		$max = sizeof($arrFields);
	
		// ########################################
		// 10.3.) Die Felder in der Liste ausgeben:
		for ($i=0; $i<$RecordCount; $i++)
		{
			$row = $rs->fetch_assoc();
		 
			for ($j=0;$j<$max;$j++)
			{
				if ($j==0)
				{
					// Die ID brauchen wir immer!
					$strTmp = $row["id"];
					echo "<OPTION Value='".$strTmp."'>";
				}
	
				$strTmp = $row[$arrFields[$j]]; 
				echo formatoutput($strTmp);

				if ($j<($max-1))
				{
					echo " - ";
				}
			}
			
			echo chr(13).chr(10);
		}
		
		echo "</SELECT></TD>".chr(13).chr(10);
		echo "</tr>".chr(13).chr(10);
		echo "</table>".chr(13).chr(10);
	
		// #############################################
		// 11.) Schaltflächen für den Anwender ausgeben:
		echo "<BR><INPUT TYPE=submit Value='Datensatz l&ouml;schen'>".chr(13).chr(10);
		echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
	}
	else
	{
		echo "<BR><B>Hinweis:</B><BR><BR>".chr(13).chr(10);
		echo "In der Tabelle '".$objectclasstable."' befinden sich derzeit keine l&ouml;schbaren Datens&auml;tze.<BR>".chr(13).chr(10);
	}
	
	echo "</FORM>".chr(13).chr(10);	

	include("../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../includes/forms/footer.php");
?>





























