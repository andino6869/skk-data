<?php
	// ###################################
	// Modul-Update August 2019
	// ###################################

	function get_player($objDBCon, $strTournament)
	{
		// Die Daten aus dem jeweiligen Turnier aus em aktuellen Jahr holen:
		$strSQL = "select * from skk_afro_players WHERE tournament='$strTournament' AND ";
		$strSQL = $strSQL."curyear='".substr(date("Y-m-t"),0,4)."' AND del='N' AND modifieddate ";
		$strSQL = $strSQL."IS NULL AND verified='J' ORDER BY elo DESC, dwz DESC";

		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

		$i = 0;
			
		while ($row = $rs->fetch_object())
		{
			$surname[$i] = $row->surname;
			$firstname[$i] = $row->firstname;
			$dwz[$i] = $row->dwz;
			$elo[$i] = $row->elo;
			$organization[$i] = $row->organization;
			$title[$i] = $row->title;
			$i++;
		}
		

		// Den Tabellenheader schreiben:
		echo "<table cellpadding='5' cellspacing='0' border='0' width='100%'>".chr(13).chr(10);
		echo "<tbody><tr bgcolor='#000000'><td colspan='100%' height='1'></td></tr>".chr(13).chr(10);
		echo "<tr><td colspan='6'><b>Turnier $strTournament (sortiert nach ELO und DWZ)</b></td></tr>".chr(13).chr(10);
		echo "<tr bgcolor='#000000'><td colspan='100%' height='1'></td></tr>".chr(13).chr(10);
		echo "<tr bgcolor='#dddddd'>".chr(13).chr(10);
		echo "<td width='5%'>Nr</td>".chr(13).chr(10);
		echo "<td width='5%'>Tit.</td>".chr(13).chr(10);
		echo "<td width='35%'>Spielername</td>".chr(13).chr(10);
		echo "<td width='35%'>Verein</td>".chr(13).chr(10);
		echo "<td width='10%'>ELO</td>".chr(13).chr(10);
		echo "<td width='10%'>DWZ</td>".chr(13).chr(10);
		echo "</tr>".chr(13).chr(10);

		// Die Daten ausgeben, sofern welche vorhanden sind:
		if ($RecordCount > 0)
		{
	   		for ($i=0; $i<$RecordCount; $i++)
	  		{
	   			echo "<TR bgcolor=eeeeee><TD><b>".($i+1)."</b></TD><TD>".$title[$i]."</TD>";
				echo "<TD>".$surname[$i].", ".$firstname[$i]."</TD><TD>".$organization[$i]."</TD>";

				if (trim($elo[$i])=="" || $elo[$i]=="0")
				{
					echo "<TD>-</TD>";
				}
				else
				{
					echo "<TD>".$elo[$i]."</TD>";
				}

				if (trim($dwz[$i])=="" || $dwz[$i]=="0")
				{
					echo "<TD>-</TD>";
				}
				else
				{
					echo "<TD>".$dwz[$i]."</TD>";
				}
				echo "<TR>".chr(13).chr(10);
	  		}
		}
  		else
  		{
  			echo "<TR bgcolor=eeeeee><TD><b>&nbsp</b></TD><TD>&nbsp</TD><TD><I>Derzeit sind noch keine Spieler gemeldet.</I></TD><TD>&nbsp</TD><TD>&nbsp</TD><TD>&nbsp</TD></TR>".chr(13).chr(10);
  		}

  		echo "<tr bgcolor='#000000'><td colspan='6' height='1'></td></tr>".chr(13).chr(10);
		echo "</tbody></table>".chr(13).chr(10);
	}
?>
