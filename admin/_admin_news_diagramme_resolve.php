<?php 
// ##################
// UPDATE 25.10.2015:
// Diagramme auflösen:
$pos = strpos($Text , "#DIAGRAMM:");

if (!($pos === false))
{
	// echo "FOUND 1";

	// Es gibt Einträge, also dananch suchen!
	$arrText = explode("#", $Text);
	$intI=0;
	// echo "COUNT ".count($arrText);

	for ($intI=0; $intI < count($arrText); $intI++)
	{
		//echo $arrText[$intI]."<BR>";
			
		if (strlen($arrText[$intI]) > 14)
		{
		// ################################
			// Haben wir ein Diagramm gefunden?
			$pos = strpos($arrText[$intI] , "DIAGRAMM:");
	
			if (!($pos === false))
			{
				// Daten Dateinamen extrahieren:
				$strCurrentFile = $arrText[$intI];
				$strCurrentFile = str_replace("DIAGRAMM:", "", $strCurrentFile);
							
				// ########################################
				// Konnte der Abschlusstag gefunden werden?
				if (is_file($strCurrentFile))
				{	
					// Diagramm soll eingerückt sein:
					$strTmp = "<BR><BR><TABLE width='100%'><TR><TD width=".chr(34)."1%".chr(34)."></TD><TD width=".chr(34)."99%".chr(34)."><img src=".chr(34).$strCurrentFile.chr(34);
					$diagramm_title = "";
	
					// Die Größenangaben ermitteln, falls vorgschrieben:
					$strCurrentSQLFile = str_replace("../pics/diagramme/","", $strCurrentFile);
					$strSQL = "SELECT * FROM `skk_diagramme` WHERE diagramm_file='$strCurrentSQLFile' AND del='N' AND modifieddate IS NULL";
	
					$rs = mysqli_query($objDBCon, $strSQL);
					$RecordCount = mysqli_num_rows($rs);
	
					if ($RecordCount > 0)
					{
						$row = $rs->fetch_object();
						$diagramm_title = $row->diagramm_title;
						$intdiagramm_width = $row->diagramm_width;
						$intdiagramm_height = $row->diagramm_height;
					}
	
					// Hilfetext:
					$strTmp = $strTmp." TITLE=".chr(34).$diagramm_title.chr(34);
	
					// Breite:
					//echo "AAA".$intdiagramm_width;
	
					if (trim($intdiagramm_width)!="")
					{
						if (is_numeric($intdiagramm_width))
						{
							$strTmp = $strTmp." WIDTH=".chr(34).$intdiagramm_width.chr(34);
						}
					}
	
					// Höhe:
					if (trim($intdiagramm_height)!="")
					{
						if (is_numeric($intdiagramm_height))
						{
							$strTmp = $strTmp." HEIGTH=".chr(34).$intdiagramm_height.chr(34);
						}
					}

					$strTmp = $strTmp."></TD></TR>";

					// Zweite Zeile für Titel:
					if (trim($diagramm_title!=""))
					{
						$strTmp = $strTmp."<TR><TD width=".chr(34)."1%".chr(34)."></TD><TD width=".chr(34)."99%".chr(34)."><B><I>".$diagramm_title."</I></B></TD></TR>";
					}
					$strTmp = $strTmp."</TABLE><BR>";

					// Den Tag ersetzen:
					$Text = str_replace("#DIAGRAMM:".$strCurrentFile."#", $strTmp, $Text);
				}
			}
		}
	}
}

// UPDATE Ende
// ###########
?>