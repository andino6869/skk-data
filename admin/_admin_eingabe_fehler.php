<?php 
	echo "<font color='#FF0000' size=4><b>Fehler beim Speichern</b><BR><BR></font>".chr(13).chr(10);
	echo "<b>Der neue Datensatz konnte leider aus folgenden Gr&uuml;nden nicht gespeichert werden:</b><BR><BR>".chr(13).chr(10);
	echo "<I>".$errText."</I>".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);
	echo "Bitte wechseln Sie zur&uuml;ck auf die letzte Webseite und &uuml;berpr&uuml;fen Sie Ihre Eingaben.".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);
	echo "<INPUT TYPE=BUTTON VALUE='Zur&uuml;ck' onClick='history.back()'".chr(13).chr(10);
?>