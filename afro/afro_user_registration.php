<?php
	function get_user_registration($objDBCon)
	{
		// Prüfen, ob ein Anmelden neuer Spieler aktuell zugelassen ist:
		$now = date("Y-m-d H:i:s");

		$strSQL = "select * from skk_afro_config WHERE allowusermessage!='N' AND allowusermessageto ";
		$strSQL = $strSQL."> '$now' AND del='N' ";
		$strSQL = $strSQL."AND modifieddate IS NULL;";

		// Die Datenbanktabelle mit den Daten auslesen:
		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);

 		if ($RecordCount > 0)
  		{
  			// Prüfen, wie viele Spieler derzeit schon angemeldet sind:
  			$row = $rs->fetch_object();
			$maxnumberofplayers = $row->maxnumberofplayers;
						
			$strSQL = "select COUNT(*) AS Anz from skk_afro_players WHERE curyear='".substr($now,0,4)."' AND del='N' ";
			$strSQL = $strSQL."AND modifieddate IS NULL;";

			$rs = mysqli_query($objDBCon, $strSQL);
			$RecordCount = mysqli_num_rows($rs);

			if ($RecordCount > 0)
			{
				$row = $rs->fetch_object();
				$curnumber = $row->Anz;

				//echo "AAA".$maxnumberofplayers."BBB".$curnumber."CCC";
				
				if ($curnumber < ($maxnumberofplayers + 1))
				{
					// Ein Anmelden ist erlaubt!
					echo "<font color=#4300FF><b>ONLINE - Anmeldung (max. ".$maxnumberofplayers." Teilnehmer/innen)</B></font><HR noshade size=1>".chr(13).chr(10);
					echo "<A HREF='afro_register_player.php'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' border=0> Ja, ich will mich hier gleich online anmelden.</A><BR><BR>".chr(13).chr(10);
					echo "<A HREF='afro_registered_players.php'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' border=0> Wer hat sich schon angemeldet?</A>".chr(13).chr(10);
					echo "<BR><BR><BR><BR>".chr(13).chr(10);
				}
				else 
				{
				    echo "<font color=#4300FF><b>ONLINE - Anmeldung</B></font><HR noshade size=1><BR>".chr(13).chr(10);
				    echo "Die maximal m&ouml;gliche Anzahl an Voranmeldungen ist bereits eingegangen, weshalb eine Anmeldung ";
				    echo "derzeit nicht mehr m&ouml;glich ist.<BR><BR>Sofern Sie sich nicht mehr online anmelden konnten, ";
				    echo "&uuml;berweisen Sie bitte kein Startgeld mehr, da eine Teilnahme nicht mehr garantiert werden kann.<BR><BR><BR><BR>";
				}
			}
		}
	}
?>