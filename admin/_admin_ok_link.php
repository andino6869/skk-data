<?php
	if (is_file("_admin_index.php"))
	{
		echo "<A HREF='_admin_index.php?ux=$ux&dx=$dx'";
	}
	else 
	{
		echo "<A HREF='../_admin_index.php?ux=$ux&dx=$dx'";
	}
	
	echo " TITLE='Klicken Sie auf diese Schaltfl&auml;che, um ".chr(13).chr(10);
	echo "wieder auf die Start - Seite zu wechseln.'>".chr(13).chr(10);

	if (is_file("../pics/admin/arrow.gif"))
	{
		echo "<IMG SRC='../pics/admin/arrow.gif' border=0>".chr(13).chr(10);
	}
	else
	{
		echo "<IMG SRC='../../pics/admin/arrow.gif' border=0>".chr(13).chr(10);
	}

	echo " OK</A>".chr(13).chr(10); 
?>

