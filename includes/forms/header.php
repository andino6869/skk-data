<?PHP
	function writeheader($strPageArea, $useCMS = "FALSE")
	{
	    // ############################################
	    // UPDATE 13.09.2023 wegen Problem mit TinyMCE:
	    echo "<!DOCTYPE html>";
	    
		// ###########################
		// Die Grundeinträge:
		echo "<HTML lang=".chr(34)."de".chr(34).">".chr(13).chr(10);
		echo "<TITLE>".chr(13).chr(10);
		echo "Schachklub Kriegshaber - ".$strPageArea.chr(13).chr(10);
		echo "</TITLE>".chr(13).chr(10);
				
		// ###########################
		// Sind wir in einem Adminbereich?
		$pos = strpos($strPageArea, "Admin -");

		if (!($pos === false))
		{
			$bAdmin = "TRUE";
		}
		else
		{
			$bAdmin = "FALSE";
		}


		// ###########################
		// Javascripte für die Menüs im Adminbereich:
		/*if ($bAdmin == "TRUE")
		{
			echo "<script type='text/javascript'>";

	  		
	   		* Fügt den Listeneinträgen Eventhandler und CSS Klassen hinzu,
			* um die Menüpunkte am Anfang zu schließen.
	   		*
			* menu: Referenz auf die Liste.
			* data: String, der die Nummern aufgeklappter Menüpunkte enthält.
	   		

	  		echo "function treeMenu_init(menu, data)".chr(13).chr(10);
	   		echo "{".chr(13).chr(10);
	    	echo "var array = new Array(0);".chr(13).chr(10);

	    	echo "if(data != null && data != '') {".chr(13).chr(10);
	      	echo "array = data.match(/\d+/g);".chr(13).chr(10);
	    	echo "}".chr(13).chr(10);

	    	echo "var items = menu.getElementsByTagName('li');".chr(13).chr(10);
	    	echo "for(var i = 0; i < items.length; i++) {".chr(13).chr(10);
	      	echo "items[i].onclick = treeMenu_handleClick;".chr(13).chr(10);
	      	echo "if(!treeMenu_contains(treeMenu_getClasses(items[i]), 'treeMenu_opened') && items[i].getElementsByTagName('ul').length + items[i].getElementsByTagName('ol').length > 0) {".chr(13).chr(10);
	        echo "var classes = treeMenu_getClasses(items[i]);".chr(13).chr(10);
	        echo "if(array.length > 0 && array[0] == i) {".chr(13).chr(10);
	        echo "classes.push('treeMenu_opened')".chr(13).chr(10);
	        echo "}".chr(13).chr(10);
	        echo "else {".chr(13).chr(10);
	        echo "classes.push('treeMenu_closed')".chr(13).chr(10);
	        echo "}".chr(13).chr(10);
	        echo "items[i].className = classes.join(' ');".chr(13).chr(10);
	        echo "if(array.length > 0 && array[0] == i) {".chr(13).chr(10);
	        echo "array.shift();".chr(13).chr(10);
	        echo "}".chr(13).chr(10);
	      	echo "}".chr(13).chr(10);
	    	echo "}".chr(13).chr(10);
	  		echo "}".chr(13).chr(10);

	  		
			* Ändert die Klasse eines angeclickten Listenelements, sodass
		    * geöffnete Menüpunkte geschlossen und geschlossene geöffnet
			* werden.
	   		*
			* event: Das Event Objekt, dass der Browser übergibt.
	   		
	  		echo "function treeMenu_handleClick(event) {".chr(13).chr(10);
	  		//Workaround für die fehlenden DOM Eigenschaften im IE
	    	echo "if(event == null) {".chr(13).chr(10);
	      	echo "event = window.event;".chr(13).chr(10);
	      	echo "event.currentTarget = event.srcElement;".chr(13).chr(10);
	      	echo "while(event.currentTarget.nodeName.toLowerCase() != 'li') {".chr(13).chr(10);
	        echo "event.currentTarget = event.currentTarget.parentNode;".chr(13).chr(10);
	      	echo "}".chr(13).chr(10);
	      	echo "event.cancelBubble = true;".chr(13).chr(10);
	    	echo "}".chr(13).chr(10);
	    	echo "else {".chr(13).chr(10);
	      	echo "event.stopPropagation();".chr(13).chr(10);
	    	echo "}".chr(13).chr(10);
	    	echo "var array = treeMenu_getClasses(event.currentTarget);".chr(13).chr(10);
	    	echo "for(var i = 0; i < array.length; i++) {".chr(13).chr(10);
	      	echo "if(array[i] == 'treeMenu_closed') {".chr(13).chr(10);
	        echo "array[i] = 'treeMenu_opened';".chr(13).chr(10);
	      	echo "}".chr(13).chr(10);
	      	echo "else if(array[i] == 'treeMenu_opened') {".chr(13).chr(10);
	        echo "array[i] = 'treeMenu_closed'".chr(13).chr(10);
	      	echo "}".chr(13).chr(10);
	    	echo "}".chr(13).chr(10);
	    	echo "event.currentTarget.className = array.join(' ');".chr(13).chr(10);
	  		echo "}".chr(13).chr(10);

	  		
			* Gibt alle Klassen zurück, die einem HTML-Element zugeordnet sind.
	   		*
			* element: Das HTML-Element
		    * return: Die zugeordneten Klassen.
	   		
	  		echo "function treeMenu_getClasses(element) {".chr(13).chr(10);
	    	echo "if(element.className) {".chr(13).chr(10);
	      	echo "return element.className.match(/[^ \\t\\n\\r]+/g);".chr(13).chr(10);
	    	echo "}".chr(13).chr(10);
	    	echo "else {".chr(13).chr(10);
	      	echo "return new Array(0);".chr(13).chr(10);
	    	echo "}".chr(13).chr(10);
	  		echo "}".chr(13).chr(10);

	  		
			* Überprüft, ob ein Array ein bestimmtes Element enthält.
	   		*
			* array: Das Array
			* element: Das Element
			* return: true, wenn das Array das Element enthält.
	   		

	  		echo "function treeMenu_contains(array, element) {".chr(13).chr(10);
	    	echo "for(var i = 0; i < array.length; i++) {".chr(13).chr(10);
	      	echo "if(array[i] == element) {".chr(13).chr(10);
	        echo "return true;".chr(13).chr(10);
	      	echo "}".chr(13).chr(10);
	    	echo "}".chr(13).chr(10);
	    	echo "return false;".chr(13).chr(10);
	  		echo "}".chr(13).chr(10);

			
			* Gibt einen String zurück, indem die Nummern aller geöffneten
			* Menüpunkte stehen.
	   		*
			* menu: Referenz auf die Liste
			* return: Der String
	   		
	  		echo "function treeMenu_store(menu) {".chr(13).chr(10);
	    	echo "var result = new Array();".chr(13).chr(10);
	    	echo "var items = menu.getElementsByTagName('li');".chr(13).chr(10);
	    	echo "for(var i = 0; i < items.length; i++) {".chr(13).chr(10);
	      	echo "if(treeMenu_contains(treeMenu_getClasses(items[i]), 'treeMenu_opened')) {".chr(13).chr(10);
	        echo "result.push(i);".chr(13).chr(10);
	      	echo "}".chr(13).chr(10);
	    	echo "}".chr(13).chr(10);
	    	echo "return result.join(' ');".chr(13).chr(10);
	  		echo "}".chr(13).chr(10);
			echo "</script>".chr(13).chr(10);


			echo "<style type=".chr(34)."text/css".chr(34).">".chr(13).chr(10);
	  		echo "li.treeMenu_opened ul {".chr(13).chr(10);
	    	echo "display: block;".chr(13).chr(10);
	  		echo "}".chr(13).chr(10);
	  		echo "li.treeMenu_closed ul {".chr(13).chr(10);
	    	echo "display: none;".chr(13).chr(10);
	  		echo "}".chr(13).chr(10);
			echo "</style>".chr(13).chr(10);

			// Style für die Darstellung der Buttons:

			echo "<style type=".chr(34)."text/css".chr(34).">".chr(13).chr(10);
  			echo "body {".chr(13).chr(10);
    		echo "font: normal 100.01% Helvetica, Arial, sans-serif;".chr(13).chr(10);
    		echo "color: black; background-color: #f8ffa7;".chr(13).chr(10);
  			echo "}".chr(13).chr(10);

  			echo "ul#menu {".chr(13).chr(10);
    		echo "width: 100%;".chr(13).chr(10);
    		echo "margin: 0; padding: 0.2em 0.8em 0.8em;".chr(13).chr(10);
    		echo "border: 0px solid black;".chr(13).chr(10);
    		echo "background-color: #f8ffa7;".chr(13).chr(10);
  			echo "}".chr(13).chr(10);

  			echo "* html ul#menu {   Korrekturen fuer IE 5.x ".chr(13).chr(10);
    		echo "width: 18.6em;".chr(13).chr(10);
    		echo "w\idth: 10em;".chr(13).chr(10);
    		echo "padding-left: 0;".chr(13).chr(10);
    		echo "padd\ing-left: 0.8em;".chr(13).chr(10);
  			echo "}".chr(13).chr(10);

  			echo "ul#menu li {".chr(13).chr(10);
    		echo "list-style: none;".chr(13).chr(10);
    		echo "margin: 0.4em; padding: 0;".chr(13).chr(10);
    		echo "width: 100%;".chr(13).chr(10);
  			echo "}".chr(13).chr(10);

			echo "ul#menu a, ul#menu span, ul#menu h2 {".chr(13).chr(10);
			echo "display:block;".chr(13).chr(10);
			echo "padding: 0.2em;".chr(13).chr(10);
			echo "text-decoration: none; font-weight: bold;".chr(13).chr(10);
			echo "border: 1px solid black;".chr(13).chr(10);
			echo "border-left-color: white; border-top-color: white;".chr(13).chr(10);
			echo "color: black; background-color: #ccc;".chr(13).chr(10);
			echo "}".chr(13).chr(10);

			echo "* html ul#menu a, * html ul#menu span, * html ul#menu h2 {".chr(13).chr(10);
			echo "width: 100%;     Breitenangabe fuer IE 5.x ".chr(13).chr(10);
			echo "w\idth: 8.8em;   Breitenangabe fuer IE 6 ".chr(13).chr(10);
			echo "}".chr(13).chr(10);
			echo "ul#menu a:hover, ul#menu span {".chr(13).chr(10);
			echo "border-color: white;".chr(13).chr(10);
			echo "border-left-color: black; border-top-color: black;".chr(13).chr(10);
			echo "color: white; background-color: gray;".chr(13).chr(10);
			echo "}".chr(13).chr(10);

			echo "ul#menu h2 {".chr(13).chr(10);
			echo "font-size: 1em;".chr(13).chr(10);
			echo "margin: 1.1em 0 0;".chr(13).chr(10);
			echo "border-color: gray;".chr(13).chr(10);
			echo "color: black; background-color: #eee;".chr(13).chr(10);
			echo "}".chr(13).chr(10);


			echo "</style>".chr(13).chr(10);

		}*/

		// ######################
		// Darstellung des Icons:
		echo "<HEAD>".chr(13).chr(10);
		
		// ##################
		// UPDATE 11.09.2023:
		echo "<meta charset=".chr(34)."utf-8".chr(34).">";
		// UPDATE Ende
		// ###########

		if (is_file("pics/icons/favicon.ico"))
		{
			echo "<link rel='shortcut icon' href='pics/icons/favicon.ico' type='image/x-icon'>".chr(13).chr(10);
		}
		else
		{
			if (is_file("../pics/icons/favicon.ico"))
			{
				echo "<link rel='shortcut icon' href='../pics/icons/favicon.ico' type='image/x-icon'>".chr(13).chr(10);
			}
			else
			{
				echo "<link rel='shortcut icon' href='../../pics/icons/favicon.ico' type='image/x-icon'>".chr(13).chr(10);
			}
		}

		// ###############################################################
		// RSS Ticker - Funktionalität laut Matthias Rahlf vom 23.04.2009:
		// echo '<link href="rss.xml" type="application/rss+xml" rel="alternate" title="RSS Feed" />'.chr(13).chr(10);

		// Gegendarstellung Matthias Rahlf vom 13.01.2011:
		echo '<link href="http://www.skk.de/rss/rss.xml" type="application/rss+xml" rel="alternate" title="RSS 2.0" />'.chr(13).chr(10);

		echo "</HEAD>".chr(13).chr(10);

		// Die aktuelle Ordnerposition kann varieren!
		if (is_file("../skk.css"))
		{
			echo "<LINK REL='stylesheet' HREF='../skk.css'>".chr(13).chr(10);
		}
		else
		{
			if (is_file("../../skk.css"))
			{
				echo "<LINK REL='stylesheet' HREF='../../skk.css'>".chr(13).chr(10);
			}
			else
			{
				echo "<LINK REL='stylesheet' HREF='../../../skk.css'>".chr(13).chr(10);
			}
		}

		echo "<BODY ";

		// ################################################################################
		// Soll ein Initialisierungsereignis für das Menü im Adminbereich ausgelöst werden?
		if ($bAdmin == "TRUE")
		{
			echo "onload=".chr(34)."treeMenu_init(document.getElementById('menu'), '')".chr(34);
		}
		echo " topmargin='5' marginheight='0' bgcolor='#D2D5CA' marginwidth='0' leftmargin='0'>".chr(13).chr(10);

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

		// #####################################
		// Soll CMS als System auf der aktuellen Seite verwendet werden?
		if ($useCMS == "TRUE")
		{
			// Prüfen, ob der Zugriff auf das CMS - SYSTEM überhaupt gewünscht ist:
			$curDB = "DB424698";
			$curUser = "U424698";

			// Verbindung aufbauen:
			if (!($conDBLocal = mysqli_connect("localhost", $curUser,"h!SWjuWW", $curDB)))
			{
				echo("Server connection to database failed!<P>");
				echo mysql_error($curDB);
			}

			// ##############################################
			// Die ID des Benutzers ermitteln und dekodieren:
			if (!(isset($ux)))
			{
				$ux = "";
			}
			 
			if ((trim($ux)=="") && (isset($_GET["ux"])))
			{
				$ux = $_GET["ux"];
			}
			
			if ((trim($ux)=="") && (isset($_REQUEST["ux"])))
			{
				$ux = $_REQUEST["ux"];
			}

			// Nummer umcodieren:
			$ux = base64_decode($ux);
			$ux = strrev($ux);

			// Die Einstellung des Benutzers ermitteln:
			$strSQL = "SELECT usecms FROM skk_members WHERE id=".$ux;
			$strSQL = $strSQL." AND del='N' AND active!='N' AND modifieddate IS NULL AND ip IS NOT NULL;";

			// Der Standardfall:
			$buser_usecms = "FALSE";

			$rs = mysqli_query($conDBLocal, $strSQL);
			$RecordCount = mysqli_num_rows($rs);

			if ($RecordCount > 0)
			{
				$row = $rs->fetch_object();
				$user_usecms[0] = $row->usecms;
			}
			$conDBLocal->close();

			if (strtolower( $user_usecms[0])=="j")
			{
				$buser_usecms = "TRUE";
			}

			// ##########################
			// Soll CMS nun verwendet werden?
			if ($buser_usecms == "TRUE")
			{
				if (is_file("../jscripts/tinymce/js/tinymce/tinymce.js"))
				{
					echo "<script type='text/javascript' src='../jscripts/tinymce/js/tinymce/tinymce.js'></script>".chr(13).chr(10);
				}
				else
				{
					if (is_file("../../jscripts/tinymce/js/tinymce/tinymce.js"))
					{
						echo "<script type='text/javascript' src='../../jscripts/tinymce/js/tinymce/tinymce.js'></script>".chr(13).chr(10);
					}
					else
					{
						echo "<script type='text/javascript' src='../../../jscripts/tinymce/js/tinymce/tinymce.js'></script>".chr(13).chr(10);
					}
				}

				echo "<script type='text/javascript'>".chr(13).chr(10);
				echo "tinymce.init({".chr(13).chr(10);

				echo "selector: 'textarea', "; // change this value according to your HTML
				echo "plugins: 'table lists | code', ";
				echo "toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | indent outdent | numlist bullist | code', ";
				echo "menu: {";
				echo "    file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },";
				echo "    edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },";
				echo "    view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },";
				echo "    insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },";
				echo "    format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align lineheight | forecolor backcolor | removeformat' },";
				echo "    tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },";
				echo "    table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },";
				echo "    help: { title: 'Help', items: 'help' }";
				echo "}";							
				
				echo "});";
				echo "</script>".chr(13).chr(10);
			}
		}

		// #######################################
		// Stylesheet verwenden!
		echo "<SPAN CLASS='pre'>".chr(13).chr(10);
		// echo "<TABLE cellspacing=0 cellpadding=0 border=0 bordercolor='#000000' bordercolorlight='#000000' align='center' width='100%'>".chr(13).chr(10);
		echo "<TABLE cellspacing=0 cellpadding=0 border=0 align='center' width='100%'>".chr(13).chr(10);
		// echo "<TR bgcolor=8eca33>".chr(13).chr(10);
		echo "<TD WIDTH='25%'align='center'>".chr(13).chr(10);


		if (is_file("../pics/forms/clublogo.tif"))
		{
			echo "<img border='0' src='../pics/forms/clublogo.tif' width=115 height=100 align='center'>".chr(13).chr(10);
		}
		else
		{
			if (is_file("../../pics/forms/clublogo.tif"))
			{
				echo "<img border='0' src='../../pics/forms/clublogo.tif' width=115 height=100 align='center'>".chr(13).chr(10);
			}
			else
			{
				echo "<img border='0' src='../../../pics/forms/clublogo.tif' width=115 height=100 align='center'>".chr(13).chr(10);
			}
		}

		echo "</TD>".chr(13).chr(10);
		echo "<TD WIDTH='50%'>".chr(13).chr(10);
		echo "<p align='center'>".chr(13).chr(10);

	    if (is_file("../pics/forms/name.png"))
		{
			echo "<img border='0' src='../pics/forms/name.png' width=400 height=85>".chr(13).chr(10);
		}
		else
		{
			if (is_file("../../pics/forms/name.png"))
			{
				echo "<img border='0' src='../../pics/forms/name.png' width=400 height=85>".chr(13).chr(10);
			}
			else
			{
				echo "<img border='0' src='../../../pics/forms/name.png' width=400 height=85>".chr(13).chr(10);
			}
		}

		echo "</TD>".chr(13).chr(10);
		echo "<TD WIDTH='25%'align='center'>".chr(13).chr(10);


		// #######################################################
		// ACHTUNG!
		// WERBEAKTION von Peter Grabowski für playchess.com, abgestimmt mit Eckhardt Frank vom 02.12.2009
		// UPDATE 29.04.2014: Werbeaktion mit Playchess.com ist abgeschlossen. Bild soll laut Vorstandschaft 
		// wieder entfernt werden.
		// ALTER CODE:
		/* $timeout = 10; //timeout in sekunden

		if(@fsockopen("playchess.com", "80", $errno, $errstr, $timeout))
		{
			// Logo von playchess.com:
			echo "<BR>";

			if (is_file("../pics/forms/playchess.png"))
			{
				echo "<A HREF='http://www.playchess.com'><IMG SRC='../pics/forms/playchess.png' BORDER=0 TITLE='Schach Online - Der gr&ouml;ßte Server der Welt, um Schach zu spielen.'></A><BR><BR>".chr(13).chr(10);
			}
			else
			{
				if (is_file("../../pics/forms/playchess.png"))
				{
					echo "<A HREF='http://www.playchess.com'><IMG SRC='../../pics/forms/playchess.png' BORDER=0 TITLE='Schach Online - Der gr&ouml;ßte Server der Welt, um Schach zu spielen.'></A><BR><BR>".chr(13).chr(10);
				}
				else
				{
					echo "<A HREF='http://www.playchess.com'><IMG SRC='../../../pics/forms/playchess.png' BORDER=0 TITLE='Schach Online - Der gr&ouml;ßte Server der Welt, um Schach zu spielen.'></A><BR><BR>".chr(13).chr(10);
				}
			}
		}
		else
		{*/
		// Alter Code ENDE
		if (is_file("../pics/forms/logo_figuren.gif"))
		{
			echo "<img src='../pics/forms/logo_figuren.gif' width=140 height=100 align='center'>".chr(13).chr(10);
		}
		else
		{
			if (is_file("../../pics/forms/logo_figuren.gif"))
			{
				echo "<img src='../../pics/forms/logo_figuren.gif' width=140 height=100 align='center'>".chr(13).chr(10);
			}
			else
			{
				echo "<img src='../../../pics/forms/logo_figuren.gif' width=140 height=100 align='center'>".chr(13).chr(10);
			}
		}
		// }

		echo "</TD></TR></TABLE>".chr(13).chr(10);
		echo "</SPAN>".chr(13).chr(10);
		
		//echo "<p align='center'><font face='Arial' size='4' color='#FFFF00'><B>ACHTUNG!!! DIES IST EINE TESTINSTALLATION UND STELLT DAMIT NICHT DIE AKTUELLE SEITE DES SCHACHKLUB KRIEGSHABERS DAR!!!!</B></FONT></P>".chr(13).chr(10);
	}
?>
