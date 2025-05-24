<?php
	function writeheader($strPageArea)
	{
		echo "<HTML>".chr(13).chr(10);
		echo "<TITLE>".chr(13).chr(10);
		echo "AFRO - ".$strPageArea.chr(13).chr(10);
		echo "</TITLE>".chr(13).chr(10);

		// Darstellung des Icons:
		echo "<HEAD>".chr(13).chr(10);

		if (is_file("pics/icons/favicon_afro.ico"))
		{
			echo "<link rel='shortcut icon' href='pics/icons/favicon_afro.ico' type='image/x-icon'>".chr(13).chr(10);
		}
		else
		{
			if (is_file("../pics/icons/favicon_afro.ico"))
			{
				echo "<link rel='shortcut icon' href='../pics/icons/favicon_afro.ico' type='image/x-icon'>".chr(13).chr(10);
			}
			else
			{
				echo "<link rel='shortcut icon' href='../../pics/icons/favicon_afro.ico' type='image/x-icon'>".chr(13).chr(10);
			}
		}

		echo "</HEAD>".chr(13).chr(10);

		// Stylesheet:
		echo "<LINK REL='stylesheet' HREF='skk.css'>".chr(13).chr(10);
		echo "<BODY topmargin='5' marginheight='0' bgcolor='#C3CCD0' marginwidth='0' leftmargin='0'>".chr(13).chr(10);

		// Das Javaskript zum Austauschen der einzelnen Menübilder:
		echo "<SCRIPT LANGUAGE='JScript'>".chr(13).chr(10);
		echo "function flipImage(evt, url)".chr(13).chr(10);
		echo "{".chr(13).chr(10);
		echo "var target = evt.target? evt.target : window.event.srcElement;".chr(13).chr(10);
		echo "if (target.tagName == \"IMG\")".chr(13).chr(10);
		echo "target.src = url;".chr(13).chr(10);
		echo "return true;".chr(13).chr(10);
		echo "}".chr(13).chr(10);
		echo "</SCRIPT>".chr(13).chr(10);

		echo "<TABLE cellspacing=0 cellpadding=0 border=0 bordercolor='#000000' bordercolorlight='#000000' align='center' width='100%'>".chr(13).chr(10);
		echo "<TR bgcolor=#C3CCD0>".chr(13).chr(10);
		echo "<TD WIDTH='25%'align='center'>".chr(13).chr(10);

		echo "<img border='0' src='../pics/forms/clublogo.tif' width=115 height=100 align='center'>".chr(13).chr(10);

		echo "</TD>".chr(13).chr(10);
		echo "<TD WIDTH='50%'>".chr(13).chr(10);
		echo "<p align='center'>".chr(13).chr(10);

		echo "<img border='0' src='pics/forms/afrologo.png' width=500 height=105>".chr(13).chr(10);


		echo "</TD>".chr(13).chr(10);
		echo "<TD WIDTH='25%'align='center'>".chr(13).chr(10);
		echo "<img src='../pics/forms/logo_figuren.gif'  width=140 height=100 align='center'>".chr(13).chr(10);

		echo "</TD></TR></TABLE>".chr(13).chr(10);


	}
?>
