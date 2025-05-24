<?php
// UPDATE Schneider 05.05.2008:
// Mit den folgenden Zeilen lassen sich
// alle Dateien in dem Verzeichnis pics
// dynamisch auslesen.

// Den Kopfbereich schreiben:
function get_pics()
{
	echo "<SELECT SIZE='10' NAME='PICS' MULTIPLE style='width:100%'>".chr(13).chr(10);
	$found = "FALSE";

	// Das Basisverzeichnis der Bilder:
	$handle=opendir ("../pics/");

	while ($curfile = readdir ($handle))
	{
		// Keine Verzeichnisnavigation anzeigen:
		if ($curfile != ".")
		{
			if ($curfile != "..")
			{
				if (is_file("../pics/".$curfile))
				{
					echo "<OPTION VALUE='../pics/".$curfile."' onClick=".chr(34)."window.open('../pics/".$curfile."', '".$curfile."')".chr(34).">../pics/".$curfile.chr(13).chr(10);
					$found = "TRUE";
				}
			}
		}
	}

	$handle=opendir ("../pics/admin");

	while ($curfile = readdir ($handle))
	{
		// Keine Verzeichnisnavigation anzeigen:
		if ($curfile != ".")
		{
			if ($curfile != "..")
			{
				if (is_file("../pics/admin/".$curfile))
				{
					echo "<OPTION VALUE='../pics/admin/".$curfile."' onClick=".chr(34)."window.open('../pics/admin/".$curfile."', '".$curfile."')".chr(34).">../pics/admin/".$curfile.chr(13).chr(10);
					$found = "TRUE";
				}
			}
		}
	}

	$handle=opendir ("../pics/figures");

	while ($curfile = readdir ($handle))
	{
		// Keine Verzeichnisnavigation anzeigen:
		if ($curfile != ".")
		{
			if ($curfile != "..")
			{
				if (is_file("../pics/figures/".$curfile))
				{
					echo "<OPTION VALUE='../pics/figures/".$curfile."' onClick=".chr(34)."window.open('../pics/figures/".$curfile."', '".$curfile."')".chr(34).">../pics/figures/".$curfile;
					$found = "TRUE";
				}
			}
		}
	}

	$handle=opendir ("../pics/filetypes");

	while ($curfile = readdir ($handle))
	{
		// Keine Verzeichnisnavigation anzeigen:
		if ($curfile != ".")
		{
			if ($curfile != "..")
			{
				if (is_file("../pics/filetypes/".$curfile))
				{
					echo "<OPTION VALUE='../pics/filetypes/".$curfile."' onClick=".chr(34)."window.open('../pics/filetypes/".$curfile."', '".$curfile."')".chr(34).">../pics/filetypes/".$curfile;
				}
			}
		}
	}

	$handle=opendir ("../pics/forms");

	while ($curfile = readdir ($handle))
	{
		// Keine Verzeichnisnavigation anzeigen:
		if ($curfile != ".")
		{
			if ($curfile != "..")
			{
				if (is_file("../pics/forms/".$curfile))
				{
					echo "<OPTION VALUE='../pics/forms/".$curfile."' onClick=".chr(34)."window.open('../pics/forms/".$curfile."', '".$curfile."')".chr(34).">../pics/forms/".$curfile;
				}
			}
		}
	}

	$handle=opendir ("../pics/icons");

	while ($curfile = readdir ($handle))
	{
		// Keine Verzeichnisnavigation anzeigen:
		if ($curfile != ".")
		{
			if ($curfile != "..")
			{
				if (is_file("../pics/icons/".$curfile))
				{
					echo "<OPTION VALUE='../pics/icons/".$curfile."' onClick=".chr(34)."window.open('../pics/icons/".$curfile."', '".$curfile."')".chr(34).">../pics/icons/".$curfile;
				}
			}
		}
	}

	$handle=opendir ("../pics/maps");

	while ($curfile = readdir ($handle))
	{
		// Keine Verzeichnisnavigation anzeigen:
		if ($curfile != ".")
		{
			if ($curfile != "..")
			{
				if (is_file("../pics/maps/".$curfile))
				{
					echo "<OPTION VALUE='../pics/maps/".$curfile."' onClick=".chr(34)."window.open('../pics/maps/".$curfile."', '".$curfile."')".chr(34).">../pics/maps/".$curfile;
				}
			}
		}
	}

	// Handle wieder schliessen:
	closedir($handle);
	echo "</SELECT>".chr(13).chr(10);
}

?>
