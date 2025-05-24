<?php
	function strCypt($strInput, $strKey, $bCrypt)
	// Verschlüsselt und entschlüsselt Zeichenketten:
   	{
   		$intPos=0;
   		$lngKeyNumber = 0;
   		$intOrgNumber = 0;
   		$intCptNumber = 0;
   		$strCpt = "";
   		$strReturn = "";

		for ($inti=1;$i<strlen($strInput);$i++)
		{
			$intPos = $intPos + 1;

			if ($intPos==strlen($strInput))
			{
				$intPos = 1;
			}

			$lngKeyNumber = ord(substr($strKey, $intPos, 1));

			if ($bCrypt==1)
			{
				// Es soll verschlüsselt werden:
				$intOrgNumber = ord(substr($strInput, intI, 1));
				$intCptNumber = $intOrgNumber ^ $lngKeyNumber;
				$strCpt = dechex($intCptNumber);

				if (strlen($strCpt) < 2)
				{
					$strCpt="0".$strCpt;
				}
				$strReturn = $strReturn.$strCpt;
			}
			else
			{
				// Es soll entschlüsselt werden:
				if (intI > (strlen($strInput) / 2))
				{
					break;
				}

				$intCptNumber = hexdec(substr($strInput, (intI * 2) - 1, 2));
				$intOrgNumber = $intCptNumber ^ $lngKeyNumber;
				$strReturn = $strReturn.chr($intOrgNumber);
			}
		}

		return $strReturn;
	}


	function strCypt64($strInput)
	// Verschlüsselt und entschlüsselt Zeichenketten:
   	{
   		$strInput=Strrev($strInput);
   		$strInput=base64_encode($strInput);
   		return $strInput;
   	}

	function strDeCypt64($strInput)
	// Verschlüsselt und entschlüsselt Zeichenketten:
   	{
   		$strInput=base64_decode($strInput);
   		$strInput=Strrev($strInput);
   		return $strInput;
   	}


?>