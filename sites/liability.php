<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Haftungsausschluss");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>

<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	$objDBCon = GetCon();
	// ############################
	// UPDATE Schneider 05.05.2008:
	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	writeNavigationBar(999, $objDBCon);
	// UPDATE Ende
?>



<SPAN CLASS=he1>Haftungsausschlu&szlig;</SPAN><BR><BR>
<DIV ALIGN=JUSTIFY>

Diese Website und ihr Inhalt sind "so wie sie sind" und "so wie sie verf&uuml;gbar sind" zur Verf&uuml;gung 
gestellt. Sie erkl&auml;ren sich ausdr&uuml;cklich einverstanden, dass die Nutzung der Website auf Ihre eigene 
Gefahr und Ihr eigenes Risiko erfolgt. Sie verstehen und stimmen zu, dass Sie allein f&uuml;r etwaige Sch&auml;den, 
etwa im Bezug auf Ihre Unternehmenst&auml;tigkeit, an Ihrem Computersystem oder f&uuml;r Datenverlust verantwortlich 
sind, die durch den Zugang zu, die Nutzung oder das Herunterladen von der Website entstehen k&ouml;nnten. 
<BR><BR>

Der Schachklub Kriegshaber haftet nicht f&uuml;r eine Verwertbarkeit, Richtigkeit, Sach- und Rechtsm&auml;ngelfreiheit 
der verf&uuml;gbar gemachten Informationen bzw. deren Eignung f&uuml;r einen bestimmten Zweck. Der Schachklub Kriegshaber &uuml;bernimmt keine Gew&auml;hr, 
dass diese Website oder ihr Inhalt die Anforderungen ihrer Besucher erf&uuml;llt oder dass die Website und ihr Inhalt richtig, 
rechtm&auml;&szlig;ig, ohne Unterbrechung, zeitgerecht, sicher oder fehlerfrei zur Verf&uuml;gung stehen oder dass etwaige Fehler korrigiert werden. 
<BR><BR>

Links, die sich auf dieser Web-Seite befinden, gew&auml;hren m&ouml;glicherweise Zugang zu Web-Seiten, die seitens des Schachklub Kriegshaber nicht &uuml;berwacht werden. 
Solange der Schachklub Kriegshaber keinen Einfluss &uuml;ber den Inhalt dieser Seiten hat, macht sich der Schachklub Kriegshaber oder seine Vorstandschaft diese nicht zu eigen 
und ist f&uuml;r diese somit auch nicht verantwortlich oder haftbar zu machen. Insbesondere sollte ein Link nicht die Notwendigkeit begr&uuml;nden, diesem auch zu folgen.
<BR><BR>

Die im Bereich "News & Meldungen" bzw. in den "Kommentaren" ge&auml;u&szlig;erten Meinungen und Ansichten sind
nicht zwangsl&auml;ufig auch die Meinung und Ansicht des Schachklub Kriegshaber oder dessen Vorstandsmitglieder. Generell ist jeder
Redakteur und jeder Kommentator f&uuml;r seine gehosteten Eintr&auml;ge selbst verantwortlich.
<BR><BR>
</DIV>

<?php include("../includes/forms/middler.php")?>
<?php
	include("../includes/db/deadlines_shortview.php");
	get_deadlines_shortview($objDBCon);
?>
<BR><BR><BR><BR>
<?php
	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
?>

<?php include("../includes/forms/footer.php")?>