<?PHP
		// ###################################
		// Modul-Update August 2019
		// ###################################

		function writetournamentarea($objDBCon, $TOURNAMENT, $CURRENTSEASON, $SHOWCONTENT)
		{
			// Wurden Turnierdaten hinterlegt?
			$strSQL = "select tournament FROM skk_tournaments WHERE del='N' AND modifieddate IS NULL ORDER BY tournament DESC;";

			$rs = mysqli_query ($objDBCon, $strSQL);
			$RecordCount = mysqli_num_rows($rs);

			// Wurden Datensätze gefunden?
			if ($RecordCount == 0)
			{
				return;
			}

			echo "<FORM METHOD=POST ACTION='tournament_seek.php'>";
			echo "<SPAN CLASS=red_head>";
			echo "News und Meldungen zu Turnier:<HR noshade size=1>";
			echo "<TABLE width='100%'>";
			echo "<TR><TD width='100%'>";

			// Die Auswahl des Turniers:
			echo "<SELECT NAME=tournament style='width:100%' TITLE='Hier haben Sie die Möglichkeit, ";
			echo "die Kopfzeilen der News und Meldungen nach einem bestimmten Vereinsturnier zu durchsuchen.'>";

			if ($RecordCount > 0) 
			{
				$i = 0;
				
				while ($row = $rs->fetch_object())
				{
					$tournament[$i] = $row->tournament;
					
					if (trim($tournament[$i]) == trim($TOURNAMENT))
					{
						echo "<OPTION SELECTED>".$tournament[$i];
					}
					else
					{
						echo "<OPTION>".$tournament[$i];
					}
					$i++;
				}
			}
			

			echo "</SELECT></TD>".chr(13).chr(10);
			echo "<TD><INPUT TYPE=Submit VALUE='Suchen'></TD>".chr(13).chr(10);
			echo "</TR>";
			echo "</TABLE>";

			echo "<TABLE Width='100%'>";
			echo "<TR><TD width='100%'>";
			echo "<SPAN CLASS=a_footer>";
			echo "<INPUT TYPE='CHECKBOX' ";
			echo "NAME='TOURNAMENT_CURRENTSEASON' VALUE='Nur aktuelle Saison' TITLE='Setzen Sie hier ";
			echo "einen Haken, wenn Sie News & Meldungen nur aus der aktuellen Saison durchsuchen möchten.'";

			if ($CURRENTSEASON == "TRUE")
			{
				echo " CHECKED";
			}
			echo ">Nur aus aktueller Saison</SPAN></TD></TR>";

			echo "<TR><TD width='100%'>";
			echo "<SPAN CLASS=a_footer>";
			echo "<INPUT TYPE='CHECKBOX' ";
			echo "NAME='TOURNAMENT_SHOWCONTENT' VALUE='Inhalte anzeigen' TITLE='Setzen Sie hier ";
			echo "einen Haken, wenn Sie statt einer Linkliste gleich die gesamten Inhalte der gefundenen News und ";
			echo "Meldungen einsehen möchten.'";

			if ($SHOWCONTENT == "TRUE")
			{
				echo " CHECKED";
			}

			echo ">Inhalte sofort anzeigen</SPAN></TD></TR>";


			echo "</TABLE>";
			echo "</FORM><BR><BR>";
		}
?>