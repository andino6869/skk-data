<?PHP
		function writeseekgalery($SEEK, $CURRENTSEASON)
		{
			echo "<FORM METHOD=POST ACTION='galery_seek.php'>";
			echo "<SPAN CLASS=red_head>";
			echo "Bilder suchen:<HR noshade size=1>";
			echo "</SPAN>";
			echo "<TABLE width='100%'>";
			echo "<TR><TD width='100%'><INPUT TYPE=TEXT SIZE='10' MAXLENGTH=50 VALUE='".$SEEK."' TITLE='Hier haben Sie die Möglichkeit, ";
			echo "die Kommentare und die Dateinamen der Bilder nach einem Schlagwort zu durchsuchen.' style='width:100%' NAME=Seek></TD>";
			echo "<TD><INPUT TYPE=Submit VALUE='Suchen'></TD>".chr(13).chr(10);
			echo "</TR>";
			echo "</TABLE>";

			echo "<TABLE Width='100%'>";
			echo "<TR><TD width='100%'>";
			echo "<SPAN CLASS=a_footer>";
			echo "<INPUT TYPE='CHECKBOX' ";
			echo "NAME='CURRENTSEASON' VALUE='Nur aktuelle Saison' TITLE='Setzen Sie hier ";
			echo "einen Haken, wenn Sie nur Bilder aus der aktuellen Saison durchsuchen möchten.'";

			if ($CURRENTSEASON == "TRUE")
			{
				echo " CHECKED";
			}
			echo ">Nur aus aktueller Saison</SPAN><TD></TR>";
			echo "</TR>".chr(13).chr(10);

			echo "</TABLE>";
			echo "</FORM>";
		}
?>