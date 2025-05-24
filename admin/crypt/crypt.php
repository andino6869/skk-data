<?php
	function strCypt($strInput, $strKey, $bCrypt)
	// Verschl�sselt und entschl�sselt Zeichenketten:
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
				// Es soll verschl�sselt werden:
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
				// Es soll entschl�sselt werden:
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
	// Verschl�sselt und entschl�sselt Zeichenketten:
   	{
   		$strInput=Strrev($strInput);
   		$strInput=base64_encode($strInput);
   		return $strInput;
   	}

	function strDeCypt64($strInput)
	// Verschl�sselt und entschl�sselt Zeichenketten:
   	{
   		$strInput=base64_decode($strInput);
   		$strInput=Strrev($strInput);
   		return $strInput;
   	}


?>