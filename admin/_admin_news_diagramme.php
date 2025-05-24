<?php
	// ##################
	// UPDATE 24.10.2015:
	// Grafiken und Diagramm mit anbieten, sofern vorhanden:
	$strSQL = "SELECT * FROM `skk_diagramme` WHERE del='N' AND creator='$curUser' AND modifieddate IS NULL ORDER BY createdate DESC LIMIT 5";
	$rs = mysqli_query($objDBCon, $strSQL);
	$RecordCount = mysqli_num_rows($rs);
	
	if ($RecordCount > 0)
	{
		echo "<TR><TD width='100%' bgcolor='#C0C0C0'>Die f&uumlnf zuletzt hinterlegten Diagramme / Bilder, die eingef&uumlgt werden k&ouml;nnen:<BR>";
		echo "<TABLE width='100%'><TR><TD>Titel</TD><TD>Einf&uuml;gen als Diagramm</TD><TD>Einf&uuml;gen als Grafik (bei Verwendung von CMS &uuml;ber Schaltfl&auml;che 'Insert/edit Image' ohne HTML-TAGS)</TD></TR>";
	
		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			echo "<TR><TD>".formatoutput($row->diagramm_title)."</TD><TD>#DIAGRAMM:../pics/diagramme/".$row->diagramm_file."#</TD><TD>&lt;img src='../pics/diagramme/".$row->diagramm_file."'&gt;</TD></TR>";
			$i++;
		}
		
		echo "</TABLE>";
		echo "</TD></TR>";
	}
	
	// UPDATE ENDE
	// ###########
?>