<?
	function import_deadline($con)
	{
		// Datenübernahme Prowide: Termine
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (377, '2008-11-30', 'Regionalliga Süd-West, Kriegshaber I - Garching II', '1.Mannschaft', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);

		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (376, '2008-11-30', 'Schwabenliga II Nord, Kriegshaber II - Günzburg/Reisensburg', '2.Mannschaft', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (375, '2008-11-28', 'KO-System (bei remis Blitzentscheidung), Bedenkzeit 2 Std./40 Züge, 0,5 Std. Rest, keine DWZ-Auswertung', 'Stefan Schneider-Pokal', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (374, '2008-11-15', 'Kreisliga II, Kriegshaber IV - Inchenhofen I, Beginn 18.00 Uhr, Heimspiel', 'Kriegshaber IV', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (373, '2008-11-15', 'Kreisliga I, 2. Runde, Kriegshaber III - Göggingen II, Beginn 18.00 Uhr', '3.Mannschaft', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (372, '2008-11-14', 'Zollhauspokal 3. Runde, Beginn 20.00 Uhr, Bedenkzeit 1 Stunde / Partie', 'Zollhauspokal 2008', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (371, '2008-11-15', 'Augsburger Schülerliga (4er-Mannschaften U12), 1. Spieltag', 'Augsburger Schülerliga', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (370, '2008-11-08', 'Augsburger Kreisjugendeinzelmeisterschaft 2008 in den Altersklassen U14, U16 und U18, Höltl-Schachraum Haunstetten, Beginn 10 Uhr', 'Augsburger Kreisjugendmeisterschaft 2008', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (369, '2008-11-07', '4.Runde Neusäß Open, Steppach, TSV-Sportheim, Beginn 19:45 Uhr', 'Neusäß Open 2008', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (368, '2008-11-07', 'Monatsblitz November 2008, 5 Minuten Bedenkzeit, Beginn 20.00 Uhr', 'Monatsblitz', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (367, '2008-10-31', 'Nachholtag für die 2. Runde,', 'Zollhauspokal', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (366, '2008-10-26', 'Schwabenliga II Gruppe Nord, 1. Runde, Beginn 10.00 Uhr', '2. Mannschaft', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (365, '2008-10-26', 'Regionalliga Süd-West, 2. Runde: München Süd-Ost - Kriegshaber I, Beginn: 10.00 Uhr', '1.Mannschaft', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (362, '2008-10-24', '3. Runde, beim TSV Steppach, Beginn 19:45 Uhr', 'Neusäß Open', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (363, '2008-10-24', 'Zollhauspokal 2. Runde, Beginn 20.00 Uhr', 'Zollhauspokal', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (364, '2008-10-25', 'C-Klasse, SGA Augsburg 1873 IV - Kriegshaber VI, Spitalgasse 3, Beginn 16.00 Uhr', '6. Mannschaft', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (361, '2008-10-18', 'Kreisliga II: SG Augsburg 1873 II - SK Kriegshaber IV  -  ACHTUNG: Spiellokal verlegt, die Begegnung findet in Kriegshaber im alten Zollhaus statt!', '4.Mannschaft', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (360, '2008-08-29', 'Sommerblitz 3. Runde, 5 Minuten Bedenkzeit, kein Start- kein Preisgeld, just for fun, Beginn 20.00 Uhr', 'Sommerblitz', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (359, '2008-08-22', 'Sommerblitz 2. Runde, 5 Minuten Bedenkzeit, kein Start- kein Preisgeld, just for fun, Beginn 20.00 Uhr', 'Sommerblitz', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (358, '2008-08-15', 'Sommerblitz 1. Runde, 5 Minuten Bedenkzeit, kein Start- kein Preisgeld, just for fun, Beginn 20.00 Uhr', 'Sommerblitz', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (357, '2008-08-10', '15. AFRO 2008, 4. Spieltag, 7.Runde beginnt um 9:30 Uhr,  Siegerehrung ca. 15:00 Uhr', '15. AFRO 2008, 4. Spieltag', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (356, '2008-08-09', '15. AFRO 2008, 3. Spieltag, 5.Runde beginnt um 9:30 Uhr,  6.Runde beginnt um 15.30 Uhr. Turnhalle des TSV Kriegshaber, Kobelweg', '15. AFRO 2008, 3. Spieltag', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (355, '2008-08-08', '15. AFRO 2008, 2. Spieltag, 3.Runde beginnt um 9:30 Uhr,  4.Runde beginnt um 15.30 Uhr. Turnhalle des TSV Kriegshaber, Kobelweg', '15. AFRO 2008, 2. Spieltag', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (354, '2008-08-08', 'Augsburger Friedensfest-Open 2008, 3. und 4. Runde, Details siehe AFRO-Seite auf der Hauptseite dieser Homepage', '15. AFRO 2008', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (337, '2008-05-30', 'Zollhauspokal 3. Runde, Beginn 20.00 Uhr', 'Zollhauspokal', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (338, '2008-06-06', '5 Minuten-Blitz, mit Jahreswertung, Beginn 20.00 Uhr, Kein Startgeld', 'Monatsblutz', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (348, '2008-07-04', '5-Minuten-Blitz mit Jahreswertung, Beginn 20.00 Uhr. Kein Startgeld. G&auml;ste und Freizeitspieler willkommen.', 'Monatsblitz', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (318, '2008-04-04', '5-Minutenblitz mit Jahreswertung', 'Monatsblitzturnier', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (319, '2008-04-05', 'Kreisliga I: Haunstetten II - Kriegshaber III in Haunstetten, Beginn 18.00 Uhr', '3.Mannschaft', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (320, '2008-04-05', 'Kreisliga II: Kriegshaber IV - Inchenhofen I, Beginn 18.00, Heimspiel', '4.Mannschaft', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (321, '2008-04-11', '1. Runde Zollhauspokal, Beginn 20.00 Uhr', 'Zollhauspokal', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (349, '2008-06-27', '5. Runde des Zollhauspokals 2008. Beginn 20.00 Uhr, Turnierpartien. Weitere Infos jeweils im Neuigkeitenticker abrufbar.', 'Zollhauspokal', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (330, '2008-05-02', '5-Minutenblitz, Beginn 20.00 Uhr, Ulmer Str. 182 (Zollhaus in Kriegshaber)', 'Monatsblitzturnier Mai 08', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (350, '2008-07-11', '6. Runde des Zollhauspokals 2008. Beginn 20.00 Uhr, Turnierpartien. Weitere Infos jeweils im Neuigkeitenticker abrufbar.', 'Zollhauspokal', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (351, '2008-07-25', '7. und letzte Runde des Zollhauspokals 2008. Beginn 20.00 Uhr, Turnierpartien. Weitere Infos siehe Neuigkeitenticker.', 'Zollhauspokal', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (352, '2008-08-01', 'Monatsblitzturnier August 2008, Beginn 20.00 Uhr, 5 Minuten, Kein Startgeld, keine Preise, Jahreswertung', 'Monatsblitzturnier', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);
		$strSQL = "INSERT INTO skk_deadline (id, deadlinedate, deadline, kind, category, createdate, creator) VALUES (353, '2008-08-07', 'Augsburger Friedensfest-Open, 1. und 2. Runde, Details siehe AFRO-Seiten auf der Hauptseite', '15. AFRO 2008', 'Alle', '2008-12-05', 'DATENÜBERNAHME PROWIDE');";
		mysql_query ($strSQL, $con);

	}
?>