<?php
	// $intMessageType:
	// 1 = Kritisch
	// 2 = Warnung
	// 3 = Information
	function MessageBox($strMessage, $objDBCon, $intMessageType = "1", $bViewDeadlines = "TRUE", $bViewDownloads = "TRUE")
	{
		// ############################################
		// 1.) Je nach Typ das passende Bild ermitteln:
		$strPicPath = "../pics/admin/";
		
		switch ($intMessageType)
		{
			case 1:
				$strPicPath = $strPicPath."critical.gif";
				break;
			case 2:
				$strPicPath = $strPicPath."warning.gif";
				break;
			default:
				$strPicPath = $strPicPath."info.gif";
				break;
		}
		
		// #####################################
		// 2.) Die Position des Bilds ermitteln:
		// Die Position der Dateien kann anders lauten!
		if (!(is_file($strPicPath)))
		{
			$strPicPath = "../".$strPicPath;

			if (!(is_file($strPicPath)))
			{
				$strPicPath = "../".$strPicPath;
			}
		}
		
		echo "<IMG SRC=".chr(34).$strPicPath.chr(34)." border=0>".chr(13).chr(10);

		// ######################
		// 3.) Den Text ausgeben:
		echo $strMessage.chr(13).chr(10);
		
		// ##########################
		// 4.) Die Seite abschlieﬂen:
		include("../includes/forms/middler.php");
				
		if ($bViewDeadlines == "TRUE")
		{
			include("../includes/db/deadlines_shortview.php");			
			get_deadlines_shortview($objDBCon);
			echo "<BR><BR><BR><BR>".chr(13).chr(10);
		}
		
		// #######################
		// 5.) Downloads anzeigen?
		if ($bViewDownloads == "TRUE")
		{
			include("../includes/forms/downloads.php");
			get_downloads($objDBCon);
		}
		
		include("../includes/forms/footer.php");
		exit;
	}
?>