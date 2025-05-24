<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################
	function get_player($objDBCon, $strTournament, $orderby)
	{
		// Die Daten aus dem jeweiligen Turnier aus em aktuellen Jahr holen:
		$strSQL = "select * from skk_afro_players WHERE tournament='$strTournament' AND ";
		$strSQL = $strSQL."curyear='".substr(date("Y-m-t"),0,4)."' AND del='N' AND modifieddate ";
		$strSQL = $strSQL."IS NULL ".$orderby;

		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
   			$surname[$i] = $row->surname;
   			$firstname[$i] =$row->firstname;

   			$telephone[$i] = $row->telephone;
   			$email[$i] = $row->email;

   			$birthdate[$i] = $row->birthdate;

		   	$dwz[$i] = $row->dwz;
		   	$elo[$i] = $row->elo;
		   	$organization[$i] = $row->organization;
		   	$title[$i] = $row->title;
		   	$verified[$i] = $row->verified;
		   	$i++;
  		}

  		// #############################
		// Den Tabellenheader schreiben:
		echo "<table cellpadding=".chr(34)."5".chr(34)." cellspacing=".chr(34)."0".chr(34)." border=".chr(34)."0".chr(34)." width=".chr(34)."100%".chr(34).">".chr(13).chr(10);
		echo "<tbody><tr bgcolor=".chr(34)."#000000".chr(34)." width=".chr(34)."100%".chr(34)."><td colspan=".chr(34)."100%".chr(34)." height=".chr(34)."1".chr(34)."></td></tr>".chr(13).chr(10);
		echo "<tr><td colspan=".chr(34)."6".chr(34)." width=".chr(34)."100%".chr(34)."><b>Turnier $strTournament (sortiert nach ELO und DWZ)</b></td></tr>".chr(13).chr(10);
		echo "<tr bgcolor=".chr(34)."#000000".chr(34)."><td colspan=".chr(34)."100%".chr(34)." height=".chr(34)."1".chr(34)."></td></tr>".chr(13).chr(10);
		
		echo "<tr bgcolor=".chr(34)."#dddddd".chr(34).">".chr(13).chr(10);
		echo "<td width=".chr(34)."5%".chr(34).">Nr.</td>".chr(13).chr(10);
		echo "<td width=".chr(34)."5%".chr(34).">Tit.</td>".chr(13).chr(10);
		echo "<td width=".chr(34)."30%".chr(34).">Spielername</td>".chr(13).chr(10);
		echo "<td width=".chr(34)."20%".chr(34).">Kontakt</td>".chr(13).chr(10);
		echo "<td width=".chr(34)."5%".chr(34).">Geburtstag</td>".chr(13).chr(10);
		echo "<td width=".chr(34)."15%".chr(34).">Verein</td>".chr(13).chr(10);
		echo "<td width=".chr(34)."10%".chr(34).">ELO</td>".chr(13).chr(10);
		echo "<td width=".chr(34)."10%".chr(34).">DWZ</td>".chr(13).chr(10);
		echo "<td width=".chr(34)."10%".chr(34).">Anmeldung best&auml;tigt</td>".chr(13).chr(10);
		echo "</tr>".chr(13).chr(10);

		// Die Daten ausgeben, sofern welche vorhanden sind:
		if ($RecordCount > 0 )
		{
	   		for ($i=0;$i<$RecordCount;$i++)
	  		{
	  			// Darstellung in Abhängigkeit davon, ob Anmeldung bestätigt worden ist:
	  			if (trim($verified[$i])=="j" || trim($verified[$i])=="J")
	  			{
	  				echo "<TR bgcolor=".chr(34)."eeeeee".chr(34).">";
	  			}
	  			else 
	  			{
	  				echo "<TR bgcolor=".chr(34)."ff0000".chr(34).">";
	  			}	   			
	   			
	   			echo "<TD><b>".($i+1)."</b></TD><TD>".$title[$i]."</TD>";
				echo "<TD>".$surname[$i].", ".$firstname[$i]."</TD>";

				// ##############################
				// Kontakt:
				echo "<TD>";

				if (trim($telephone[$i]) != "")
				{
					echo "Telefon: ".$telephone[$i];

					if (trim($email[$i]) != "")
					{
						echo "<BR>";
					}
				}

				if (trim($email[$i]) != "")
				{
					echo "Email: ".$email[$i];
				}

				echo "</TD>";

				// ########################
				// Geburtstag:
				echo "<TD>";

				if (trim($birthdate[$i]) != "")
				{
					echo substr($birthdate[$i],8,2).".".substr($birthdate[$i],5,2).".".substr($birthdate[$i],0,4);
				}

				echo "</TD>";

				// #########################
				// Verein:
				echo "<TD>".$organization[$i]."</TD>";

				if (trim($elo[$i])=="" || $elo[$i]=="0")
				{
					echo "<TD>-</TD>";
				}
				else
				{
					echo "<TD>".$elo[$i]."</TD>";
				}

				// ####
				// DWZ:
				if (trim($dwz[$i])=="" || $dwz[$i]=="0")
				{
					echo "<TD>-</TD>";
				}
				else
				{
					echo "<TD>".$dwz[$i]."</TD>";
				}
				
				// #######################
				// Registeriung bestätigt:
				if (trim($verified[$i])=="n" || trim($verified[$i])=="N" || trim($verified[$i])=="")
				{
					echo "<TD>Nein</TD>";
				}
				else 
				{
					echo "<TD>Ja</TD>";
				}
				
				echo "</TR>".chr(13).chr(10);
	  		}
		}
  		else
  		{
  			echo "<TR bgcolor=eeeeee><TD><b>&nbsp</b></TD><TD>&nbsp</TD><TD><I>Derzeit sind noch keine Spieler gemeldet.</I></TD><TD>&nbsp</TD><TD>&nbsp</TD><TD>&nbsp</TD><TD>&nbsp</TD><TD>&nbsp</TD><TD>&nbsp</TD></TR>".chr(13).chr(10);
  		}

  		echo "<tr bgcolor='#000000'><td colspan='100%' height='1'></td></tr>".chr(13).chr(10);
		echo "</tbody></table>".chr(13).chr(10);
	}
?>
