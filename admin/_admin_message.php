<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// Hat der aktuelle Benutzer eine Emailadresse?
	$strSQL = "SELECT * FROM skk_members WHERE lastlogin IS NOT NULL AND del='N' AND active!='N'";
	$strSQL = $strSQL." AND name='".$ulx."' AND vorname='".$ufx."' AND modifieddate IS NULL AND (mail IS NOT NULL AND mail !='');";


	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	if ($RecordCount==0)
	{
		// Der Benutzer hat keine Emailadresse!
		// Hinweis ausgeben:
		echo "<BR><table border='2' width='100%' bordercolordark='#FF0000' bordercolorlight='#FF0000' bgcolor='#FFFFA5'>".chr(13).chr(10);
  		echo "<tr>".chr(13).chr(10);
    	echo "<td width='100%'><U><B>Wichtiger redaktioneller Hinweis:</U></B>".chr(13).chr(10);
      	echo "<p>Damit bei Deinen neu verfassten Berichten k&uuml;nftig Kommentare".chr(13).chr(10);
      	echo "hinterlegt werden k&ouml;nnen, muss bei Deinem Benutzer eine g&uuml;ltige".chr(13).chr(10);
      	echo "Emailadresse hinterlegt werden. Bei Dir fehlt derzeit noch eine".chr(13).chr(10);
      	echo "Emailadresse. M&ouml;chtest Du dieses Programmfeature weiter verwenden, dann".chr(13).chr(10);
      	echo "hinterlege bei <I><B>'Mitgliedsdaten &auml;ndern'</I></B> bitte eine g&uuml;ltige Emailadresse. Du wirst dann immer".chr(13).chr(10);
      	echo "automatisch darüber informiert, wenn jemand bei Deinem Bericht einen".chr(13).chr(10);
      	echo "Kommentar hinzugef&uuml;gt hat.</p>".chr(13).chr(10);
      	echo "Alle Kommentare, die Ihrem Wesen nach dazu geeignet sind,".chr(13).chr(10);
      	echo "dem Ruf und dem Ansehen des Schachklub Kriegshaber oder seiner".chr(13).chr(10);
      	echo "Vorstandschaft zu schaden, sind dann jedoch umgehend nach ihrem Bekanntwerden, d.h.,".chr(13).chr(10);
      	echo "ohne schuldhaftes Z&ouml;gern, von dem jeweiligen Berichtsverfasser in Eigenregie zu".chr(13).chr(10);
      	echo "entfernen.</td>".chr(13).chr(10);
  		echo "</tr>".chr(13).chr(10);
		echo "</table>".chr(13).chr(10);
	}
?>