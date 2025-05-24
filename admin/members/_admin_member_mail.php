<?php include("../../includes/forms/header.php")?>
<?php
	writeheader("Admin - Massen - Email versenden");
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
  	include("../_admin_param_ux.php");


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
	include("../_admin_param_dx.php");

	echo "<SPAN CLASS=he1>Massen - Email versenden</SPAN><BR><BR>".chr(13).chr(10);
	echo "<FORM METHOD=POST ACTION='_admin_member_mail_ok.php''>".chr(13).chr(10);

	// Die aktuellen Benutzerdaten sichern:
	echo "<INPUT TYPE='HIDDEN' NAME='ux' Value='$ux'>".chr(13).chr(10);
	echo "<INPUT TYPE='HIDDEN' NAME='dx' Value='$dx'>".chr(13).chr(10);

	echo "<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=5 width='100%'>".chr(13).chr(10);
	echo "<TR>".chr(13).chr(10);

	$strSQL = "select * from skk_members WHERE del='N' AND modifieddate IS NULL AND mail IS NOT NULL AND mail!='-' ORDER BY name DESC";
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);

	// Konnten Datensätze ermittelt werden:
	if ($RecordCount > 0)
	{
		// Es sind Mitglieder mit Emailadresse vorhanden!
		echo "<TD valign=top bgcolor='#C0C0C0' width='33%'><B><U>Empf&auml;ngerliste:</b></U><BR>".chr(13).chr(10);
		echo "(falls mehrere Empf&auml;nger gew&uuml;nscht werden, bitte Shift- bzw. Strg-Taste zur Auswahl verwenden)</TD>".chr(13).chr(10);
		echo "<TD width='66%'>".chr(13).chr(10);
		echo "<SELECT NAME='Adresse[]' MULTIPLE SIZE=5 SIZE=50 style='width:100%'>".chr(13).chr(10);

	 	$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$Name[$i] = $row->name;
			$Vorname[$i] = $row->vorname;
			$Email[$i] = $row->mail;
			echo "<OPTION VALUE='".$Email[$i]."'>".$Name[$i].", ".$Vorname[$i].chr(13).chr(10);
			$i++;
	    }
	    echo "</SELECT>".chr(13).chr(10);


	    echo "</TD></TR>".chr(13).chr(10);
		echo "<TR><TD valign=top bgcolor='#C0C0C0'><B><U>Betreff: *</b></U></TD><TD>".chr(13).chr(10);
		echo "<INPUT TYPE=TEXT SIZE=50 NAME=Betreff style='width:100%'>".chr(13).chr(10);
		echo "</TD></TR>".chr(13).chr(10);
		echo "<TR><TD valign=top bgcolor='#C0C0C0'><B><U>Inhalt der Email:</b></U></TD><TD>".chr(13).chr(10);
		echo "<TEXTAREA NAME=Inhalt ROWS=10 COLS=40 style='width:100%'></TEXTAREA>".chr(13).chr(10);
		echo "</TD></TR>".chr(13).chr(10);

		// Hat der aktuelle Benutzer eine Email?
		$id = base64_decode($ux);
		$id = strrev($id);

		$strSQL = "SELECT mail FROM skk_members WHERE id=".$id." ";
		$strSQL = $strSQL."AND del='N' AND active!='N' AND modifieddate IS NULL AND mail IS NOT NULL AND mail!='';";

		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

		if ($RecordCount > 0)
		{
			echo "<TR><TD valign=top bgcolor='#C0C0C0'><B><U>Absender:</b></U></TD><TD>".chr(13).chr(10);
			
			$rs->fetch_object();
			$mail = $row->mail;

			echo "<INPUT TYPE=HIDDEN NAME=Absender Value=".$mail.">$mail".chr(13).chr(10);
			echo "</TD></TR>".chr(13).chr(10);
			echo "<TR><TD>&nbsp;".chr(13).chr(10);
			echo "</TD><TD><INPUT TYPE=SUBMIT VALUE='Emails senden'>".chr(13).chr(10);
		}
		else
		{
			// Die Position der Dateien kann anders lauten!
			echo "<TR><TD>".chr(13).chr(10);
			if (is_file("../pics/admin/critical.gif"))
			{
				echo "<IMG SRC='../pics/admin/critical.gif' border=0>".chr(13).chr(10);
			}
			else
			{
				if (is_file("../../pics/admin/critical.gif"))
				{
					echo "<IMG SRC='../../pics/admin/critical.gif' border=0>".chr(13).chr(10);
				}
				else
				{
					echo "<IMG SRC='../../../pics/admin/critical.gif' border=0>".chr(13).chr(10);
				}
			}

			echo "</TD><TD>In der Datenbank wurde für Sie derzeit keine Emailadresse hinterlegt. ".chr(13).chr(10);
			echo "Daher kann dieses Programmfeature derzeit nicht ausgef&uuml;hrt werden.".chr(13).chr(10);
		}
	}
	else
	{
		// Die Position der Dateien kann anders lauten!
		echo "<TD>".chr(13).chr(10);

		if (is_file("../pics/admin/critical.gif"))
		{
			echo "<IMG SRC='../pics/admin/critical.gif' border=0>".chr(13).chr(10);
		}
		else
		{
			if (is_file("../../pics/admin/critical.gif"))
			{
				echo "<IMG SRC='../../pics/admin/critical.gif' border=0>".chr(13).chr(10);
			}
			else
			{
				echo "<IMG SRC='../../../pics/admin/critical.gif' border=0>".chr(13).chr(10);
			}
		}

		echo "</TD><TD>Es konnten keine Mitglieder mit Emailadresse aus der Tabelle 'skk_members' ermittelt werden.<BR>".chr(13).chr(10);
		echo "Dieses Programmfeature kann daher aktuell nicht verwendet werden.".chr(13).chr(10);
	}

	echo "</TD></TR></TABLE>".chr(13).chr(10);
	echo "</FORM>".chr(13).chr(10);
	echo "<BR><BR>".chr(13).chr(10);

	include("../../includes/forms/middler.php");

	// Die Navigation schreiben:
	include("../forms/navigation.php");
	writenavigation($objDBCon, $ux, $dx);

	include("../../includes/forms/footer.php");
?>




