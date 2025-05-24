<?php include("../includes/forms/header.php")?>
<?php
	writeheader("Impressum");
?>
<?php include("../includes/forms/navigation.php")?>
<?php include("../includes/files/dir.php")?>
<?php include("../includes/db/connection.php")?>
<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	// Datenbankverbindung aufbauen:
	$objDBCon = GetCon();

	// UPDATE Schneider 05.05.2008:
	// In Abhängigkeit von der aktuellen Position wird nun der Navigationsbar
	// geschrieben:
	writeNavigationBar(999, $objDBCon);
	// UPDATE Ende
?>

		<SPAN CLASS=he1>Impressum</SPAN><BR><BR>
		<TABLE>
		<TR><TD width=300 VALIGN=TOP><b>Kontakt</b></TD>
		    <TD>
		    SK Kriegshaber e.V.<BR>
		    Ulmer Str. 182<BR>
		    86156 Augsburg<BR><BR>
		    Telefon: 0821 / 401267<BR>
		    Email: <a href="mailto:skkriegshaber@web.de?subject=Kontaktaufnahme"><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' border=0> skkriegshaber@web.de</a><BR><BR>
		    </TD></TR>
		<TR><TD width=300 VALIGN=TOP><b>Vorstand:</b></TD>
			<TD>
			1. Vorsitzender<BR>
			Eckhardt Frank<BR>
			Hummelstr. 3<BR>
			86156 Augsburg<BR><BR>			
			Die weiteren Vorstandsmitglieder finden Sie unter <SPAN CLASS=sm><a href="heads.php"><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' border=0> Vorst&auml;nde</A>.</SPAN><BR><BR>			
			</TD></TR>
		<TR><TD width=300 VALIGN=TOP><b>Beschwerdemanagement:</b></TD><TD>Anmerkungen oder Einspr&uuml;che zu einzelnen Inhalten senden Sie bitte unter Angabe Ihres Namens und der ID des Berichts an: <a href="mailto:metaphora@gmx.de?subject=Beschwerdemanagement"><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' border=0> SKK-Beschwerdemanagement</a>.<BR><BR>
			Zu Ihrem Anliegen geben Sie bitte den Inhalt an, auf den Sie sich beziehen und eine Begr&uuml;ndung, warum Sie hier einen &Auml;nderungsbedarf sehen. Anfragen, welche diese Angaben nicht beinhalten, werden in der Folge nicht weiter bearbeitet.<BR><BR>
		</TD></TR>
		<TR><TD width=300 VALIGN=TOP><b>Programmierung und Entwicklung:</b></TD><TD>S. Schneider<BR><BR></TD></TR>
		<TR><TD width=300 VALIGN=TOP><b>Systemkonfiguration und Administration:</b></TD><TD>A. St&ouml;r und E. Bartel<BR><BR></TD></TR>
		<TR><TD width=300 VALIGN=TOP><b>Karikaturen:</b></TD><TD>J. Cantner<BR><BR></TD></TR>
		<TR><TD width=300 VALIGN=TOP><b>Grafiken und Bilder:</b></TD><TD>M. Kling und S. Schneider<BR><BR></TD></TR>
		<TR><TD width=300 VALIGN=TOP><b>Support Chess Engine:</b></TD><TD>M. Rahlf<BR><BR></TD></TR>
		<TR><TD width=300 VALIGN=TOP><b>Version</b></TD><TD>3.0.9.2 vom 24.07.2024<BR><BR></TD></TR>
        <TR><TD colspan=2><b>Copyright &copy; 1999-<?php echo substr(date("Y-m-t"),0,4);?> - alle Rechte vorbehalten.</b>
		</TD></TR>
		</TABLE>

<?php
	// Datenbankverbindung aufbauen:
	$con = GetCon();

	include("../includes/forms/middler.php");
	include("../includes/db/deadlines_shortview.php");

	get_deadlines_shortview($objDBCon);
	echo "<BR><BR><BR><BR>".chr(13).chr(10);

	include("../includes/forms/downloads.php");
	get_downloads($objDBCon);
	include("../includes/forms/footer.php");
?>
























