<?php
	echo "<font color=cc3300><b>ADMINBEREICH</B></font><BR><BR>";
	echo "&nbsp;<B>Zugriff verweigert</B><BR>";

	// ########################################
	// Hier beginnt das Menü:
	echo "<ul id='menu' width='100%'>".chr(13).chr(10);
	echo "<li><A HREF='";
		
	if (is_file("sites/index.php"))
	{
		echo "sites/index.php";
	}
	else 
	{
		if (is_file("../sites/index.php"))
		{
			echo "../sites/index.php";
		}
		else 
		{
			echo "../../sites/index.php";
		}
	}
	
	echo "' TITLE='Klicken Sie auf diese Schaltfl&auml;che, um ".chr(13).chr(10);
	echo "wieder auf die News - Seite zu wechseln.'><IMG SRC='";
			
	if (is_file("pics/admin/arrow.gif"))
	{
		echo "pics/admin/arrow.gif";
	}
	else 
	{
		if (is_file("pics/admin/arrow.gif"))
		{
			echo "../pics/admin/arrow.gif";
		}
		else
		{
			echo "../../pics/admin/arrow.gif";
		}
	}
			
	echo "' border=0>".chr(13).chr(10);
	echo " Zur&uuml;ck zur News - Seite</A></li>".chr(13).chr(10);
	echo "</ul>".chr(13).chr(10);
?>


