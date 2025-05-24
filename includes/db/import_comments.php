<?
	function import_comments($con)
	{
		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (8, 18, 'Italo-Bondi', 'Zu dumm, ihr seid mir auf der Azzurro-Spuro! Ich setze mich heute zu meinen Mafia-Amigos nach Datschiburg ab. Da bin ich vor euch sicher. Ciao!', '2003-12-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (5, 16, 'Harry', 'Das seh ich auch so! Paul muß in die Erste!!! Und zwar schnell!!!', '2003-12-18', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (19, 29, 'Uli Baeuml', 'Lieber Eckhardt,\r\nwas willst Du eigentlich bei Deinem Bericht mit folgener Bemerkung zum Ausdruck bringen:...ist ZWAR fuer Dillingen spielberechtigt,ABER doch auch sehr in Haunstetten aktiv.Vielleicht kannst Du es mir ja in einer ruhigen Minute mal erkl', '2004-02-14', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (7, 16, 'Gerd Heigemeir', 'Vorweihnachtliche Grüße aus Steppach:\r\nHabe mich über den Sieg unserer 2.Mann-\r\nschaft gefreut. Jungs, weiter so!', '2003-12-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (9, 14, 'Michael Martin', 'starke Leistung!', '2003-12-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (10, 22, 'Stefan Kiechl', 'Mit etwas Glück hätten wir den Mannschaftskampf sogar zu unseren Gunsten entscheiden können, denn Detlev hatte ein Endspiel mit einem Mehrbauern, sein Gegner K. Liepert verteidigte sich jedoch sehr geschickt, ebenso Peter Grabowski, der auch ein Endspiel', '2004-01-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (11, 20, 'Lucky', 'Auch von meiner Seite aus nochmal herzlichen Dank an Ecki für das gute Essen, ohne Dich wär der SKK aufgeschnissen!', '2004-01-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (12, 20, 'Harald', 'Ein wares Wort unseres 2. Vorsitzenden :-)', '2004-01-14', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (13, 25, 'Thomas Reis', 'Ich glaube, die Tabelle ist nicht ganz korrekt, denn Dorfen und Haunstetten haben gegeneinander gespielt und beide hatten bereits vor der Begegnung 2 Punkte. Wie die Begegnung endete, weiß ich allerdings nicht.', '2004-01-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (14, 25, 'Uli Baeuml', 'Ich moechte eigentlich eher allgemein etwas zu Eurer HP sagen:Ich finde sie absolut aktuell,sehr informativ und witzig (Los Dilettantos).Absolut spitzenmaessig:-)Und ich wuensche Euch ausserdem ,dass Ihr die Klasse halten koennt! Gruss aus Dillingen  Uli', '2004-01-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (15, 25, 'Uli Baeuml', 'Nachtrag:Ähm,derletzte satz des unten stehenden Beitrages bezieht sich in erster Linie auf Eure 1. Mannschaft.Ich denke,Ihr versteht was ich meine und seid mir nicht boese:-) Nochmals Gruss Uli Baeuml', '2004-01-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (16, 25, 'Lucky', 'Das mit den Links auf die jeweiligen Partien ist eine super Idee!', '2004-01-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (17, 25, 'Wolfgang Malcher', 'Du hast recht Thomas. Mein alter Verein hat (unglücklicherweise) mit 5 - 3 gegen Dorfen gewonnen.', '2004-01-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (18, 25, 'Harald', 'das Ergebnis Dorfen-Haunstetten (3:5) liegt offiziell erst seit dem 20.01.2004 vor - die Tabelle ist inzwischen korrigiert.', '2004-01-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (20, 33, 'Martin', 'kleine Korrektur:\r\nSKK - Neuburg 0.5 : 3.5', '2004-02-17', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (21, 42, 'Thomas Reis', 'Ich finde die Liga ist in diesem Jahr spannend wie nie !\r\nMan beachte: Ingolstadt kann noch aus eigener Kraft Meister werden, denn die spielen in den letzten beiden Runden gegen den Münchner SC und Pfarrkirchen.\r\nDer TSV Haunstetten trifft in der letzten', '2004-03-08', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (22, 42, 'Thomas Reis', 'Der TSV Haunstetten trifft in der letzten Runde auf Siemens München.', '2004-03-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (23, 42, 'Harri', 'Hätten wir gegen Ingolstadt nicht 3.5-4.5 verloren, sondern 4.5 zu 3.5 gewonnen, wären wir jetzt auf dem 3. Platz', '2004-03-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (24, 46, NULL, NULL, '2004-03-30', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (25, 48, 'Peter', 'Schade dass es einen so vernünftigen Voschlag nur an diesem Datum geben kann........', '2004-04-01', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (26, 48, 'Paul', 'hmm,ich halt die regelung für schwachfug; wenn ich bei nem open ne remisstellung habe, lass ich mich also einfach einzügig mattsetzen oder so, dann krieg ich immer noch nen halben. besser für sieg 3, für remis 1, das schließt solche tricks aus...', '2004-04-01', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (27, 48, 'Dima', 'Wer in einer Theoriestellung Remis macht, sollte für die nächste Runde gesperrt werden...', '2004-04-01', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (28, 48, 'Lucky', 'Ich find das Sch..., dann hätte ich über mein ganzes Leben gesehen fast ein negatives Score', '2004-04-01', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (29, 48, 'Thomas Reis', 'Ich habe leider in dieser Saison 5 Remisen gemacht (und der Christoph erst). Vielleicht steigen wir ja doch noch ab, wenn die Regel rückwirkend eingerechnet wird.', '2004-04-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (30, 48, 'Achim', 'April , April !!!\r\n', '2004-04-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (31, 48, 'Christoph', 'Hm, ich finde, wer in der Partie angreift und dann doch nur Remis spielt (trotz der Versuche, zu gewinnen), sollte 1,5 Punkte als Schmerzensgeld bekommen. So wäre meine Saisonleistung ansehnlicher. Vielleicht werde ich den Vorschlag am 1. April 2005 mache', '2004-04-03', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (32, 46, 'Peter', 'Valeria und ihre Teamkameradinnen haben sich damit für die Deutsche Mannschaftsmeisterschaft im Dezember qualifiziert!!', '2004-04-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (33, 53, 'Keep on (space) truckin’, Dark Vader', 'Da werden ja wahre Delikatessen angeboten! – Besonders angetan bin ich von der Pate de Moonfruit, aber auch der Hauptgang ist nicht ohne ... Ich hoffe doch sehr, dass „Big Becky“ beim Hinterschinken lediglich als Namensgeberin fungiert?! Wo ist die Dame e', '2004-04-15', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (34, 53, 'SKK-Interessengemeinschaft Mampf&Schluck', 'Der Hinweis „für SKK-Mitglieder kostenfrei“ mit der späteren Einschränkung „d.h., nur die Empfehlung“ ist eine bodenlose Frechheit! Zur Strafe sollte Bondi Bocuse unsere Saisonabschlussfeier catern - auf eigene Rechnung!!!', '2004-04-15', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (35, 53, 'Mrs. Moneypenny', 'Wein predigen und Wasser saufen – unser Bondi ist doch ein wahres Vorbild! Er selbst ernährt sich ganz asketisch von bloßen Bond-Burgers! (Und übrigens trägt er woll’ne U-Hosen.)', '2004-04-15', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (36, 53, 'A. Schubeck, München', 'Schuster, bleib bei Deinen Leisten! Das Dilettieren am Schachbrett steht Bondi besser als das Kochen mit zweifelhaften Ingredenzien ...', '2004-04-16', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (37, 53, 'Güni von Greenpeace', 'Das Menü-Bild mit dem Hinterschinken ist ganz offensichtlich gefaked - das Prachtsteil stammt aus unserer Posteraktion „Save the Whale“! Doch wo ist „Big Becky“?', '2004-04-16', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (38, 53, 'Dr. No(e)', '“Skandal um Becky ...?” – Keine Panik, Leute! Sie ist wohlauf und arbeitet als Putze im Bondi Cafe. Das Pärchen ist offensichtlich wieder zusammen, nun anscheinend mit vertauschten Rollen ... har-har-har!', '2004-04-16', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (39, 62, 'Achim', 'Liebe Schachfreunde,\r\nbei mir gehts langsam aber sicher bergab,wenn man die 70 übershritten hat,ein normaler Vorgang !!!\r\nMeine 7 aus 10 spiegeln nicht die  Qualität meiner Partien wieder.\r\nZum Teil hatte ich unverdientes Glück!\r\nIch hoffe insgeheim, da', '2004-04-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (40, 56, 'jörg aus krumbach', 'war wirklich ein harter fight, verdienter sieg für euch und knappster klassenerhalt ever für uns. die tabelle weist aber noch lauingen vor krumbach II aus, fälschlicherweise.', '2004-04-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (41, 62, 'Harald', 'Quatsch Achim! Wieso bergab? Jetzt kommt doch der dritte Frühling! Mit frischer ELO-Zahl wird jetzt noch mal richtig angegriffen', '2004-04-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (42, 69, 'Joe Van Cantner', 'Hi Setzter! Das Stimmchen wurde eher vom Dessert ruiniert ... hust-hust-hust', '2004-05-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (43, 75, 'Achim', 'Hallo Spotfreunde,\r\nich gratuliere zur tollen Leistung!\r\nschon beachtlich was Ihr da abgeliefert habt!', '2004-06-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (44, 75, 'Dr. No(e)', 'Hi Harry / Tommi / Stefan, vielen Dank für die umfängliche Berichterstattung in Wort & Bild!. Da hab’ ich ja bei meinem Break offenbar einiges verpasst, z.B. Endspurt Harry, Koma Paul, ... har-har-har!!!', '2004-06-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (45, 75, 'Buchi', 'Dr. No(e) kann ich nur zustimmen -  die Berichterstattung hält in Qualität was wir Läufer vorgelegt haben! Bei solch´ grandiosen Internetangeboten lege auch ich alle (Computer-)Hemmungen ab!', '2004-06-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (46, 75, 'Turboschnecke (anonym)', 'diesmal haben wir euch glatt versägt, 3:09:03 - da liegen ja Welträume zwischen uns! Ein Tipp: trainieren hilft (leider) - saufen (leider) nicht, hähähähähä', '2004-06-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (47, 75, 'Mario B.', 'so a Schmarrn, mei Erdinga drink i scho seit jahrn, is isodonisch, des wois do a jehda', '2004-06-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (48, 75, 'BILD', '3:09:03 - Deutschland hat wieder Helden!', '2004-06-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (49, 75, 'Harry', 'also wenn Buchi sich wegen meiner SKK-Berichterstattung nen Computer kauft, freß ich nen Besen', '2004-06-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (50, 75, 'Stefan', 'Hallo liebe Turboschnecke, wir sehen uns nächstes Jahr in Zusmarshausen; dort werden wir Euch, wie man in Augschburg so schön sagt, nach Lechhausen schicken!', '2004-06-30', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (51, 75, 'Harry', 'einen schönen Bericht mit vielen Bildern gibt es auch hier: http://www.lechlaeufer.de/bilderseite/lkl04/rahmen.htm', '2004-06-30', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (52, 75, 'Lothar', 'Hm, könnten wir nicht nächstes Jahr gleich zwei Teams melden? Eine Raucher- und eine Nichtrauchermannschaft. Muss gleich mal mit Herby reden...', '2004-07-01', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (53, 75, 'Wolfgang B.', 'Na klar Lothar, SKK II gibts bereits. Die Einberufungsbescheide gehen demnächst raus.', '2004-07-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (54, 75, 'Bekele', 'Ja, dieser Mannschaft gehört die Zukunft!', '2004-07-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (55, 76, 'Harry', 'will unbedingt ne Kiste Chili-Sticks haben', '2004-07-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (56, 76, 'amtliches Fotofinish (Tommi)', 'Da hat sich doch einer bei der Durchschnittsgeschwindigkeit verrechnet:\r\nYvonne   29,39 km/h\r\nJoe      38,18 km/h\r\nBuchi    34,29 km/h\r\nStöri    37,75 km/h\r\nTommi    37,06 km/h', '2004-07-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (57, 76, 'El Tamarindo', 'Die Chili-Sticks werden dann Ende September in extra scharf geliefert!', '2004-07-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (58, 76, 'Dr. No(e) zum amtlichen Fotofinish', 'Verrechnet – aber zu unseren Gunsten! Und wenn man zudem bedenkt, dass die Strecke in Wirklichkeit nur 2,6 km lang war ... har-har-har!', '2004-07-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (59, 76, 'Harry', 'Tommi tritt jetzt wohl in die Fußstapfen von Statistik-Fuchs Buchi und rechnet alles nach! Respekt!', '2004-07-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (60, 77, 'Blondi', 'Vorschlag von 00(7): Tb5 ...?', '2004-07-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (61, 77, 'Holzwurm', 'Ich meine das es mit Rd5 probieren sollte.', '2004-07-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (62, 77, 'Blondi zu Holzwurm', 'Mach erst Teutschkurs!', '2004-07-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (63, 79, 'Thomas Reis', 'Herzlichen Glückwunsch an Achim\r\nzu dieser tollen Leistung.\r\nAber auch unser Dima hat natürlich eine ELO Zahl (2162).', '2004-07-12', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (64, 79, 'Wolfgang Malcher', 'Hallo Achim!  Alter schützt vor ELO nicht . . . . so sagt man!  Herzlichen Glückwunsch zu dieser Leistung und weiter so . . . schließlich sollte der FM Titel Dein nächstes Ziel sein!!!', '2004-07-12', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (65, 81, 'Achim', 'War mit meiner Leistung voll zufrieden.3,5 aus 7 gegen Gegnerschnitt von 2082 kann sich sehen lassen.Leider vermurkse ich oft klar gewonnene Gewinnstellungen!(z.B. geg. Steiger!!!)', '2004-07-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (66, 81, 'Harald', 'tja nix is schwerer, als gewonnene Stellungen auch zu gewinnen :-)', '2004-07-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (67, 79, 'Harald', 'da hat der Autor doch glatt den Dima vergessen ... Asche auf mein Haupt', '2004-07-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (68, 77, 'Eckhardt', 'Schon GM Czajka rät, stets ein Schach zu geben, denn man weiß nie obs net matt wird. Ich hätte Ld7 gespielt und dann geschaut, was passiert...', '2004-07-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (69, 82, NULL, 'Haben die Kokusmakronen Ihnen gut geschmeckt?', '2004-07-22', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (70, 77, 'pils', 'Ld7!!', '2004-07-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (71, 84, 'Niedermayer Julian', 'Hallo!\r\nEinige von euch kennen mich ja schon. Den höflichen Christoph Baiter bitte ich doch einen meiner Kommentare zu meinem Eintrag ins Gästebuch www.steffans-schachseiten.de zu lesen.\r\nAlle Kriegshaber, v.a. aber die Kinder bitte ich, sich in Georg Mül', '2004-07-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (72, 84, 'Niedermayer, Julian', 'Müllers Gästebuch einzutragen und auch\r\nm i c h  zu grüßen.(Georg ist ein Freund von mir www.georg-mueller.steffans-schachseiten.de) \r\nGruß!  Euer Julian', '2004-07-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (73, 84, 'Niedermayer, Julian', 'Müllers Gästebuch einzutragen und auch\r\nm i c h  zu grüßen.(Georg ist ein Freund von mir www.georg-mueller.steffans-schachseiten.de) \r\nGruß!  Euer Julian', '2004-07-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (74, 84, 'Niedermayer, Julian', 'Müllers Gästebuch einzutragen und auch\r\nm i c h  zu grüßen.(Georg ist ein Freund von mir www.georg-mueller.steffans-schachseiten.de) \r\nGruß!  Euer Julian', '2004-07-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (75, 82, 'Michael Reiß', 'Nichts gegen die syphatischen schwäbischen Schachfreundinnen, lieber Herr Sepp, aber wenn München nur einen Teil seiner Titelträgerinnen (Levushkina, Ankerst, Dengler, Spiel, Stangl) ans Brett brächte, würde Schwaben höchstens noch im Wetthäkeln gewinnen', '2004-08-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (76, 85, 'pauleta', 'gibt es ein Spieler maximum?', '2004-08-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (77, 85, 'toppel töppitz', 'schöne geschichte, ich dahcted afro hei0t was anderes ;)', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (78, 85, 'großer bauer', '-Bemerkenswert ist auch, daß wir mit über 50 Kindern und Jugendlichen rechnen. -\r\n\r\nmacht doch nebenbei direkt ein kinderturnier', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (79, 85, 'arno nühm', '-Bemerkenswert ist auch, daß wir mit über 50 Kindern und Jugendlichen rechnen.-\r\n\r\nwird ,daß nicht nach neuer rechtschreibung mit doppel s geschrieben also dass ?????\r\ncya', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (80, 85, 'Frank', 'wow, hier werden ja fleißig kommentare geschrieben wie wird das erst sein wenns läuft....', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (81, 85, 'dieter', 'ja, da muss ich dem arno aber recht geben.\r\naber heir geht es ja nicht um die art wie es geschrieben wird sondern um die news. ein kinder und seniorenturneir wäre vielleicht keine schlechte idee', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (82, 85, 'Dieter Max Otto', 'ich habe bemerkt, dass in dieser umgebung eher weniger turniere stattfinden aber wenn welche sind, sind diese immer sehr stark besetzt.', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (83, 85, 'Sven', 'ich wollte erst auch teilnehemen konnte dann leider doch nicht. nächstes jahr bin ich aber dabei. freue mich schon darauf ich werde dieses turneir aber mit großer spannung verfolgen', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (84, 85, 'fritz', 'wie sah das mit dem preisgeld bzw startgeld aus ?', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (85, 85, 'Holger und Gaby', 'ja, nächstes jahr sind wir zwei auch dabei und nehmen wohl noch nen freund mit', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (86, 85, 'sido fuhrman', 'schach ist schon ein toller sport', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (87, 85, 'matthias', 'um ein wirklich gelungenes turneir abzuliefern muss man seine gedanken frei haben das geht am besten wenn man lange spaziergänge macht um seine seele der natur zu öffnen', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (88, 85, 'werner', 'es kommet meiner meinung anch imemr auf die richtige vorbereitung an, ein misch aus naturheilmittlen und schachtraining und man findet den rechten weg zum einklang zwischen dem körper und der natur', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (89, 85, 'franziska', 'Für mich ist es imemr interessant gegen Männer zu spielen, und den Geschlechterkampf im Schach auszutragen. leider ziehe ich sportlich meist den Kürzeren', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (90, 85, 'Schwachsinn', 'Das ist hier doch kein Kinder-Chat-Room,\r\nWerner,such´ dir ´nen anderen Spielplatz!', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (91, 85, 'Schachfreund', 'Für jedes Turneir das ich spiele schaue ich mir ein neues Repertoire an. Dies ist wichtig um die Vorbereitung der anderen Spieler von mir zu entfernen und sie durch diesen Hinterhalt zu besiegen', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (92, 85, 'Werner', 'Hallo nochmal, ich meine das hier sehr ernst und finde es echt beschämend wie du dich hier verhällst. du bist bestimtm hinter deinem PC ein ganz kleiner der im realen leben die zähne nicht auseinander bekommt. oich stehe zu meiner einstellung zum leben un', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (93, 85, 'franz', 'Grpßt euch, wir soltlen doch beim Thema blkeiben. Das ist hier eindeutig Schach. Fremde Kräfte vopn was wei0 ich wem interessieren heri nicht udn sind fehl am Platze.', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (94, 85, 'Bianca', 'Ich drücke allen Schachspielern ganz Doll die Daumen!', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (95, 85, 'Peace', 'Sachte Sachte Leudde immer schön chilllleeeennnn!!!', '2004-08-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (96, 91, NULL, 'B-Turnier??', '2004-08-08', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (97, 91, 'Uli Baeuml', 'Grosses Kompliment an Ecki und all seinen Helfern fuer ein wie gewohnt tolles AFRO ! Gruss Uli', '2004-08-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (98, 91, 'Julian Niedermayer,TSV 1860 Mü', 'mit 1,0 Punkten Letzter\r\nEs war ein sehr schönes Turnier. Habe leider geblitzt. Komme wieder! Julian', '2004-08-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (99, 97, NULL, NULL, '2004-09-03', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (100, 91, 'Massoud Amir Sawadkuhi', 'Die Organisation, die Stadt Augsburg und das Friedensfest waren super; ich bin nächstes mal wieder dabei. Eine Randbemerkung: Hat man die ELO-, und DWZ-Auswertung an den DSB weitergeleitet?', '2004-09-03', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (101, 100, 'Markus', 'Ein dickes Lob an den Autor. Innerhalb einem solchem kurzfristigem Zeitraum ein derartiges umfangreiches Feedback abzugeben. Und das auch noch im Ehrenamt... Danke im Namen aller Interessierten. Da kann ein mancher noch davon lernen.', '2004-10-01', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (102, 102, 'Lothar', 'Ich oute micht jetzt einfach mal: Wer zum Teufel sind Kienzle und Hauser?', '2004-10-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (103, 104, 'Lothar', 'Hey, klasse Arthur! Der erste Punkt ist immer der schwerste :-)', '2004-10-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (104, 105, 'Lucky', 'Kompliment an beide Seiten: an die starkspielenden (ich bin Anhänger der alten Rechtschreibung) Jugendlichen und an die engagierten Betreuer und Jugendleiter!', '2004-10-12', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (105, 102, 'Eckhardt', 'Das legendäre Frontal-Politmagazin im ZDF mit den Moderatoren Kienzle und Hauser. Jaja, a Matt in 7 find ma, und dann mangelts an den Basics', '2004-10-15', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (106, 117, 'Achim', 'Danke Peter für den Bericht.\r\nZu meiner Partie ist zu sagen, daß mein Gegner offenbar nur Remi wollte.\r\nDie Stellung war eigentlich Totremi.\r\n\r\nIch überzog, da ich unbedingt gewinnen wollte. So gehts dann!', '2004-11-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (107, 117, 'Lothar', 'Zu meiner eigenen Partie muss ich sagen, dass ich unbedingt verlieren wollte, und das habe ich auch geschafft :-)', '2004-11-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (108, 125, 'Lothar', 'War das nicht vor zehn bis fünfzehn Jahren mal eine Veranstaltung mit regelmäßig deutlich mehr als 20 teilnehmenden Mannschaften? So habe ich das jedenalls noch in Erinnerung. Where have all the flowers gone?', '2004-12-01', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (109, 125, 'Eckhardt', 'Stimmt! Wir haben es mal vor 20 Jahren ausgetragen und damals waren wir mit 26 Teilnehmern an den Grenzen von Tischen / Spielmaterial / Platz.', '2004-12-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (110, 126, 'Markus', 'Ja, ja das war wirklich ein turbulenter Tag. Andi hat mal wieder nicht übertrieben, auch nicht mit seiner nassen Hose/ Schuhe (oder hat er die gar nicht erwähnt?)', '2004-12-03', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (111, 126, 'Lothar', 'Nein, wieso, was war da los? Ich schäume schier über vor schadenfroher Neugier, hahaha - her mit der Geschichte!!', '2004-12-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (112, 126, 'Andreas', 'Es hat nie eine nasse Hose gegeben. Der Bericht sämtliche Ereignisse des Tages erschöpfend angesprochen.', '2004-12-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (113, 126, 'Andreas', '...hat.... So viel zum Thema vollständigkeit. *räusper*', '2004-12-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (114, 126, 'Lothar', 'Es gibt Dementis, die erzeugen mehr Verdacht, als sie ausräumen. Also, was war mit der Hose?? Unser Spielleiter wird doch nicht etwa im kalten November ein unfreiwilliges Bad genommen haben?', '2004-12-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (115, 127, 'Lothar', 'Der angehängten Tabelle fehlen, wie leicht ersichtlich, die bisherigen Ergebnisse. Bin dabei, das zu reparieren, sobald mir Dan verrät, wie das geht', '2004-12-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (116, 127, 'Blicknix', 'ach, lass die Tabelle doch so wie sie ist, der zweite Platz schaut doch ganz freundlich aus.......', '2004-12-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (117, 94, 'W Degle', 'Hallo,\r\nweiß jemand ob bzw. unter welchem link die afro 2004-Partien hinterlegt sind.\r\ndanke', '2004-12-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (118, 127, 'Lothar', 'Hm - stimmt eigentlich', '2004-12-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (119, 129, 'Thomas Reis', 'Super Artikel Felix. Spiegelt genau die Situation wider. Ich zittere jetzt noch. (-: Frohe Weihnachten an alle Kriegshaberaner.', '2004-12-22', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (120, 129, 'Lothar', 'Schluck - ich glaub, dem Fanclub unserer Ersten trete ich nach dem Bericht nun doch nicht bei. Meine Nerven würden dem nicht standhalten.', '2004-12-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (121, 131, 'Achim', 'Hallo Stefan,\r\ndanke für Deinen tollen Bericht!\r\nFür mich wird es bald Zeit. dass ich Segel streiche.\r\nWie ich gute Stellungen kaputtmache, grausam! Hatte wiedermal meinen Lieblingszug auf dem Brett, machte ihn aber nicht.\r\nFrag nicht warum.\r\nIch suchte 1', '2005-01-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (122, 131, 'Eckhardt', 'Stefan, das ist in Kriegshaber Tradition: in jedem Jubiläumsjahr spielen wir grottenschlecht und steigen ab; die Krönung war der Abstieg unserer 1.Mannschaft 1974 zum 50jährigen in die A-Klasse... (who wants come up must come down...)', '2005-01-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (123, 129, 'Lucky', 'Während des Pitlturniers habe ich Buchi auf den Vorfall angesprochen, und er erzählte mir, er habe sich beim Angreifen die Königsstellung aufgerissen; außerdem hat er (der Gegener) einen DREEEECKSspringer, der ihm die ganze Zeit Ärger macht, darüberhi', '2005-01-14', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (124, 133, 'Christoph', '*schnief, heul* von meiner Partie kein Sterbenswörtchen *grins*\r\n\r\nAber im Ernst. ich denke, wir sollten uns vor dem nächsten Kampf mal zusammensetzen. Vermutlich ist es - ganz klassisch - ein mentales Problem, sprich eine Frage des Selbstvertrauens. Andi', '2005-01-17', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (125, 133, 'Lucky', 'Da macht´s die zweite schon besser. Schade nur, daß die erste anscheinend nur dann gewinnen kann, wenn die zweite verliert und andersrum', '2005-01-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (126, 132, 'Georg Weigant', 'Hallo Eckhardt,\r\nmit dem Schachspielen habe ich ja nach wie vor nix am Hut, obwohl ich seit 19 Jahren Besitzer und Eigentümer eines Schachcomuters bin! Das is doch was, oder? \r\nHeute bin ich per Zufall im Internet auf deinen Schach-Artikel gestoßen. Es is', '2005-01-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (127, 133, 'Harald', 'sorry Christoph - Du hast natürlich auch eine tolle Partie gespielt! War ein blitzsauberer Sieg', '2005-01-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (128, 131, 'Lothar', 'Ah, diesmal macht Stefan den Bericht - Klasse! Dann muss nicht immer *ich* der Buhmann sein, der die Niederlage verkündet. Mich wundert nur die hohe Zahl von Zugriffen auf die Meldung - es weiß doch eh jeder, dass die Dritte bestimmt mal wieder gesandelt', '2005-01-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (129, 138, 'Lucky', 'Das ist ja Premiere in dieser Saison, daß die erste und die zweite gleichzeitig gewinnen!', '2005-01-31', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (130, 138, 'Eckhardt', 'Oh Mann, 3 Punkte müssten reichen... Wo sind die Bad Boys hingekommen, die aus 3 Begegnungen nicht mal mit 7 Punten zufrieden waren???', '2005-02-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (131, 142, 'Markus', 'Ich glaube dieser weite Ausflug hat sich wirklich gelohnt und finde das Gesamtergebnis doch hervorragend. Auch ein Lob an den Autor, der  hier sehr ausführlich das Geschehene wieder geben konnte. Tolles Engagement aller Beteiligten.', '2005-02-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (132, 138, 'Harald', '???', '2005-02-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (133, 142, 'Eckhardt', 'Klasse Ergebnis, und auch Bericht mit Photos, ausführlicher Kommentierung und den Partien ist stark. Kompliment an Spieler und Betreuer!', '2005-02-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (134, 145, 'Dr. No(e)', 'Zur Partie von Felix: Cool geblieben und dann ein Remis erzielt - herzlichen Glückwunsch!', '2005-02-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (135, 145, 'Lothar', 'Hey, schöner Bericht, Peter - Klasse auch, dass Dima die Partien so schnell kommentiert hat!', '2005-02-12', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (136, 145, 'Julian Niedermayer', 'Hi Felix: Super Remis gegen Kilian \r\n          gespielt ;-)', '2005-02-14', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (137, 147, 'Lucky', 'Tja, wie gehabt, die zweite gewinnt, die erste verliert', '2005-02-14', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (138, 126, 'annonym', 'starke Leistung - diese I. hat`s in sich', '2005-02-15', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (139, 145, 'jh', 'Schade dass es nicht so recht Klappen wollte, mit den Punkten, bei ...', '2005-02-15', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (140, 147, 'Stefan', 'Ich will ja nicht meckern, aber wo bleibt der Bericht...?!?', '2005-02-15', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (141, 148, 'Eckhardt', 'jaja, meine Helden in Strumpfhosen: Angst vor dem Aufstieg und Friedberg im Herzen. An dieser Stelle möchte ich doch den (manchmal zugegebenermaßen nicht immer voll zurechnungsfähig wirkenden) Sportkollegen Kahn und seinen Ruf nach Eiern, wir brauchen', '2005-02-16', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (142, 103, 'Ingo Thorn', 'Sehr geehrter Schachfreund Frank,\r\n\r\nein kleiner Hinweis, es handelt sich hier um einen Ligabetrieb und kein Einladungsturnier, da weiß man, daß man qualifiziert ist und sollte ggf. rechtzeitig absagen. Zweitens war der Veranstaltungstermin schon Anfang d', '2005-02-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (143, 149, 'Schönau', 'Tolle Leistung, wie versprochen 20 l Freibier nächsten Freitag.', '2005-02-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (144, 142, 'Rolf', '... wieder ein toller Bericht zum Turnier und dem Drumherum. Ein großes DANKESCHÖN auch an die beiden Fahrer-Betreuer-Mädchen für alles für diese gelungene Aktion. Für die Kinder war das ein tolles Wochenende und ein unvergessliches Erlebnis.', '2005-02-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (145, 151, 'Lucky', 'Viktor hat seinen beiden Namen, Vor- wie Nachname, alle Ehre gemacht. Da hat man gesehen, wie pure Willenskraft drei bis vier Gewichtsklassen wettmachen kann', '2005-03-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (146, 152, 'Andi', 'Schade', '2005-03-15', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (147, 99, 'Thommy', 'Super, Rosi !', '2005-03-16', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (148, 154, 'Andreas', 'Super Bericht! Kleine Korrektur: Meine Matt-KOMBINATION war VIER-zügig!', '2005-03-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (149, 154, 'Nebelwerfer', 'Gut kommentiert!!', '2005-03-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (150, 155, 'Lothar', 'Ihr wollt dann mit der Vierten gegen unsere Dritte antreten? Nach unserer Leistung dieses Jahr wird das wohl eine satte Blamage für die Dritte', '2005-03-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (151, 160, 'Lothar', 'Hm - andere Idee: Statt ein oder zwei beste Verlierer wieder mit ins Turnier reinzunehmen, könnte man doch auch den schlechtesten Gewinner rausschmeißen (= der die meisten Züge brauchte, bis sein Gegner aufgab). Oder noch besser: Wir spielen diesen Kr', '2005-04-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (152, 161, 'Lothar', 'Bravo Julian! Bravissimo Valeria!!', '2005-04-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (153, 159, 'Stefan', 'Bester Verlierer ist wirklich unsinnig - können wir vielleicht sogar den Pokal gewinnen, indem wir gar keine Figur bewegen, oder vielleicht als bester Verlierer im Finale...irgendwann wird es absurd!', '2005-04-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (154, 159, 'Wiedemann Manfred', 'Von Steppacher Seite kann ich dazu nur sagen dass wir eigentlich als Lucky Looser ( Betonung auf Looser, falls wir tatsächlich mit 2 Niederlagen weiterkommen sollten ) nicht mehr antreten sollten - was aber wieder eine kampflose Partie zur Folge hätte ! E', '2005-04-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (163, 164, 'B. aus S.', 'Falls jemand auf die Idee käme, diesen Artikel als Unsinn zu bezeichnen,würde ich dem vehement widersprechen.', '2005-04-14', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (156, 162, 'Wolfgang Buchert', 'mir fällt gerade nichts ein', '2005-04-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (157, 163, 'Eckhardt', 'Wieso 3 Absteiger? Aus der Oberliga kommt doch nur 1 Mannschaft in die LL Süd?', '2005-04-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (158, 163, 'Christoph', 'ich verstehs auch nicht. Vielleicht sollte man doch wegen der Schieberei von Waldkirchen-Pfarrkrichen protestieren...\r\nAber warum 3 Absteiger???', '2005-04-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (159, 162, 'Felix', '...zuviel Lob für mich, zu wenig Dank an meine Gegner...', '2005-04-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (160, 165, 'Lothar', 'Wir warten auf die nächste Verschlimmbesserung.', '2005-04-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (161, 132, 'Jens Weichelt', 'Hallo Eckhardt, da ich Deine email-Adresse auf Eurer Seite vergeblich gesucht habe, versuche ich es auf diese Art. Der SK Rochade möchte am 29.04.05 sein Schnellschachturnier austragen. Da ich die Termine der anderen Vereine nicht weiß, möchte ich Dich fr', '2005-04-12', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (162, 165, 'Andi', 'Glueckwunsch !!!!!\r\n\r\nGut, dass ich die letzten Tage kein Internet hatte und so das Hin und Her\r\nnicht mibekam. \r\nHoffentlich bleibt es dabei !!\r\nViele Gruesse aus Coban/Guatemala', '2005-04-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (164, 164, 'Clemens Wlokka', 'Eckhardt, der Herr B. aus S. hat leider nicht recht, denn die Berliner Wertung gilt nur im direkten Vergleich. Punktgleichstand unter den Verlierern bedeutet losen. Sonst wäre er ja nicht lucky. Deswegen müßt ihr nun mit den Lechhäusern vorlieb nehmen.', '2005-04-16', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (165, 167, 'Siegfried Zagler', 'Forza Ecki....\r\nIch stimme dir in allem zu...nur eins möchte ich noch hinzufügen :\r\nDie mutmaßliche Schieberei zwischen Donauwörth und Zusamspringer scheint so offensichtlich, dass meineserachtens ein Ermittlungsbedarf besteht...ein paar Fragen und schon', '2005-04-18', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (166, 167, 'Lucky', 'Da wird Herr H. aus Z. aber bächtig möse sein, wenn er das liest', '2005-04-18', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (167, 167, 'Bernd', 'Auch das Spiel Waldkirchen gegen Pfarrkirchen in der Landesliga scheint mir geschoben zu sein. Würde mich auf einen hohen Sieg von Kriegshaber gegen Pfarrkirchen in der nächsten Saison freuen.', '2005-04-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (168, 169, 'Eckhardt', 'Glückwünsche an unsere Damenmannschaft! Gottseidank, jetzt haben wir heuer im Sommer doch ne Aufstiegsfeier!', '2005-04-25', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (169, 167, 'Ein Nordschwabe', 'Die Furore die um dieses angeblich so offensichtlich geschobene 6-2 der Zusamspringer gemacht wird klingt erfreut doch jedem Nordschwaben die Ohren! Da spürt ein greiser Kreis wohl den Anfang vom Ende seiner Vormachtstellung. Köstlich komisch erheitert de', '2005-04-25', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (170, 169, 'Manfred Wiedemann', 'Herzliche Glückwünsche an die Damen !!\r\nUnd Danke an Ecki für die Gratulation - leider ist die Kreis-Homepage sehr unaktuell.', '2005-04-26', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (171, 169, 'Thomas Reis', 'Herzlichen Glückwunsch an die Damen.\r\nIhr habt die Saison für Kriegshaber gerettet. Jetzt gibt es ja doch noch einen Grund für eine Jahresabschlussfeier !', '2005-04-26', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (172, 167, 'Ein anderer Nordschwabe (aus Lauingen)', 'nana, wer wird denn alle nordschwaben in einen topf werfen !? zur schwäbischen generalversammlung sei nur soviel gesagt: nach der letztjährigen trauerveranstaltung dieser ach so wichtigen und intelligenten funktionäre werden wir es so halten wie früher: e', '2005-04-26', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (173, 167, 'Nochmal der andere Nordschwabe', '...so halten wie früher: einfach nicht hingehen !...wollte ich sagen. ts ts, hier wird einem einfach das wort abgeschnitten.', '2005-04-26', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (174, 169, 'Jörg Wiendieck', 'Herzlichen Glückwunsch zum Aufstieg. Dann steigt ja nächstes Jahr schwäbisches Regionalligaduell mit Krumbach. Die Orga in der RL-SW allerdings ist auch nicht toll. Unsere Mädels wurden zum falschen Spielort geschickt und verloren dadurch kampflos gegen e', '2005-04-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (175, 171, 'Schwabinger SG Spitzenspieler', 'Ihr Versager!!', '2005-05-18', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (176, 177, 'Lutz Riedel', 'Wo findet man überhaupt etwas auf der schwäb. Seite??  Lutz Riedel,SK Krumbach', '2005-06-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (177, 184, 'Stefan K.', 'Auf der Homepage www.lechlaeufer.de ist ein ausführlicher Bericht über den Landkreislauf, dort ist u.a. auch ein Foto von Stefan Schneider bei seinem tollen Endspurt zu sehen - unsere Mannschaft war spitze!!', '2005-06-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (178, 184, 'Joe', 'Herzlichen Glückwunsch - zum Lauf und zum launigen Artikel! Beste Grüße von Joe', '2005-06-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (179, 184, 'Markus', 'Gratuliere Euch allen zu diesem spektakulären Event. Paul dank dir fürs Vertreten, bin mittlerweile wieder mit beiden Füßen unterwegs. Feedback für den Autor: Absolut gelungene Berichterstattung.', '2005-06-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (180, 182, 'Florian Bühler', 'Vielen Dank für das bereitgestellte Frühstück und das Spiellokal.Leider fiel das Turnier ja der Sonne zum Opfer.Wenigstens die Vorangemeldeten hätten kommen können.', '2005-06-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (181, 185, 'Andreas Anhäuser', 'Super Ergebnis (ist ja egal, wie es zu Stande kam; wir sind weiter!). Tut mir Leid; das mit der Verlegung habe ich vergessen, Christoph mitzuteilen. )-:\r\nIch werde mich bessern...', '2005-06-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (182, 186, 'Eckhardt', 'Wie kann man denn .rar-Format anschauen?', '2005-07-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (183, 186, 'Stefan S.', 'Zum Öffnen einer RAR - Datei wird unter Windwos das Programm WinRAR benötigt, unter Linux müsste je nach Installation ein passender Entpacker bereits vorliegen.', '2005-07-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (184, 186, 'Andi', 'vielleicht kann jemand die Bilder einfach mal auf den Vereinsrechner kopieren...?', '2005-07-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (185, 186, 'Harald', 'tja, Flo liefert halt nur .rar', '2005-07-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (186, 186, 'Stefan R.', 'aus gutem Grund! Wer benutzt heute noch .zip?', '2005-07-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (187, 186, 'Harald', 'tja, wahrscheinlich die Leute, die gerne eure Bilder ansehen würden', '2005-07-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (188, 186, 'Lothar', 'weder zip noch rar - ich nehm TAR!', '2005-07-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (189, 186, 'Thomas', 'unter www.winrar.de kann ein entsprechendes Programm heruntergeladen werden', '2005-07-18', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (192, 190, NULL, ':-)', '2005-08-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (193, 192, 'Andi', 'Glueckwunsch an Ecki samt Truppe,\r\nwar dank der Internetberichterstattung fast dabei\r\n\r\n\r\n', '2005-08-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (194, 192, 'Hans Mahrla', 'Gratuliere zum reibungslosen Ablauf. Als ich das Spiellokal sah, war ich schon enttäuscht - im Vergleich zum früheren Ambiente im Kloster. Wünsche Ihnen gerade in Anbetracht der Bedeutung Ihres schönen Turniers fürs nächste Jahr ein würdigeres Spiellokal', '2005-08-08', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (195, 192, 'Uli Baeuml', 'Kompliment,dass Ihr trotz widriger Umstaende Euer Turnier wieder prima ueber die Buehne gebracht habt.Bez.des Spiellokals moechte ich mich dem Kollegen Mahrla anschliessen.Aber ich bin mir sicher,Ihr findet fuer naechstes Jahr was Passendes (und finan', '2005-08-08', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (196, 192, NULL, NULL, '2005-08-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (197, 192, 'Uhlmanns Kammerjäger', 'Die räumlichen Bedingungen ließen etwas zu wünschen übrig, aber daran kann man ja leider nichts ändern, genauso wenig wie an meiner persönlichen, enttäuschenden Leistung. Bis auf die Auslosung der 1. Runde (Arthur, du bist schuld) ging das Turnier aber re', '2005-08-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (198, 193, 'Domenico Giannino', 'Sehr geehrter Herr Eckardt!\r\nIch finde es eine Unverschämtheit, dass ich in Ihrem Artikel als so genannter Uhrenkiller auftauche. Diese Bezeichnung ist eine persönliche Beleidigung.\r\nIch gebe zu, dass ich nach meiner verdienten Niederlage gegen die sp', '2005-08-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (199, 194, 'Oliver Billing', 'Hallo liebe Schachfreunde,\r\n\r\nzu den schwierigen Spielbedingungen auch aufgrund der hohen Teilnehmerzahl ist ja schon einiges gesagt worden und vielleicht gibt es hier im nächsten Jahr eine bessere Lösung. \r\n\r\nIch möchte an dieser Stelle aber auch einmal', '2005-08-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (211, 207, 'Stefan Herb', 'LOL im Dunkel der Ergebnismeldungen bringt die Sache schön auf den Punkt. Ich scheue seit 2 Wochen auf der offiziellen schwäbischen Homepage nach, habe sogar eine kurze Gästebuchanfrage geschrieben, aber wie immer - no effect...', '2005-10-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (202, 194, 'Stefan Schneider', 'Auch von meiner Seite aus vielen herzlichen Dank an alle Beteiligten. Es ist sehr schön, dass auch dieses Mal wieder so viele Kollegen mitgewirkt haben, denn ohne diesen Umstand kann  ein solch großes Turniervorhaben nicht funktionieren.', '2005-08-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (209, 199, 'Thomas Städele', 'das ist bitterböse', '2005-10-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (210, 199, 'Dr. No(e)', 'Hi Tommi, werde aus Deinem Kommentar zu Wünsche for Bundeskanzler?! nicht ganz schlau. Meinst Du etwa, dass unser gouder Wünsche ein bitterböser Bundeskanzler wäre? Dann lies erst einmal das brandaktuelle Stern-Kanzlerinterview mit Heinrich v. Pierer!', '2005-10-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (206, 194, 'Martin Lerch', 'Nur ganz kurz: Ihr habt euch Riesenmühe gegeben, das Catering war 1A, Spaß hats gemacht. Jetzt die schlechte Nachricht: Ich drohe wieder zu kommen!\r\n\r\nEuer\r\n\r\nMartin Lerch\r\n(TSV Gauting SAbt.)', '2005-08-12', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (208, 194, 'Hans-Jürgen Pollack', '...Einfach phänomenal, wie die Riesenorganisation geschafft wurde!\r\nDas Interesse wird eher noch zunehmen.', '2005-08-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (212, 207, 'Otto Helmschrott', 'Von Seiten des Veranstalters SC Zusamspringer wurde das Ergebnis an Herrn Wlokka sowie an die Schachzeitschrift Rochade weitergeleitet. Nur die Rochade (November-Ausgabe)hat das Ergebnis bisher veröffentlicht!', '2005-10-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (213, 171, 'Peter', 'Wir kommen wieder!!!:-)', '2005-11-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (214, 225, 'Lucky', 'Das mit den 50% wird nicht einfach, da müsste ich nach meiner Auftaktniederlage ja noch eine Partie gewinnen', '2005-11-16', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (215, 225, 'Harald', '@Lucky: macht nix - ich werd einfach in Deine Fußstapfen treten', '2005-11-16', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (216, 225, 'Eckhardt', 'jaja, die Remis-Winsler...', '2005-11-18', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (217, 228, 'Schlurfi', 'Im mp3-File heißt’s zum Schluß: „Sherlock Hotti-Hotti-Hotti – is nun Kompotti!“ - Isser denn nu hi???', '2005-11-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (218, 228, 'Biggerbang', 'Zu Schlurfis Comment: ich glaub eher, er macht ne Kukident-Diät!', '2005-11-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (219, 228, 'Monster', 'Ja, der hat bloß was aufs Maul bekommen!', '2005-11-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (220, 228, 'Chrissly', 'Hat er auch verdient, der alte Sozi!!!', '2005-11-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (221, 228, 'Monster', 'Und sogar noch mehr!!! Man sollte ihm die Pfeife ...', '2005-11-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (222, 228, 'Chrissly', 'Nichdoch, nimm dazu lieber das Didge ;-)', '2005-11-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (223, 228, 'Dr. No(e)', 'Hey Leute, schlechte Nachricht: Sherlock hat sich beschwert!', '2005-11-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (224, 228, 'Monster', 'Wat, der kann schowidder sprechen?!', '2005-11-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (225, 228, 'Dr. No(e)', 'Hey Leute, gute Nachricht: Sherlock will eventuell den SKK verklagen ;-)', '2005-11-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (226, 228, 'Chrissly', 'Gib uns seine Adresse, den besuchen wir!!!', '2005-11-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (227, 228, 'Biggerbang', 'Ich komm mit, hehehe!!!', '2005-11-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (228, 228, 'Dr. No(e)', 'Also gut: Baker Street 221b, London City - übrigens fährt Sherlock Volkswagen, dazu ‘nen roten!', '2005-11-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (229, 228, 'Schlurfi', 'Eigentlich sollte er sich korekterweise nennen: Sherlock Heuli', '2005-11-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (230, 226, 'Christoph', 'Das Lob an Ecki kann ich nur unterstreichen :-)))))', '2005-11-25', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (231, 227, 'Markus', 'Verweise auch auf den sehr guten Bericht auf unserer Jugendseite bezüglich dieser Begegnung.', '2005-11-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (232, 230, 'Siegfried Zagler', 'Hi Ecki, gut das du die die C-Klasse pflegt...:Rain gewinnt gegen Lechhausen mit 3,5 : 2,5, wie mir Meister Meiranke mitteilte...Einzelergebnisse:\r\nC3 : C1 0:1\r\nC4 : C3 0:1\r\nC5 : C4 1:0\r\nC6 : C5 1:0\r\nE12: C6 1:0\r\nE13: E4 1/2', '2005-11-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (233, 230, 'Siegfried Zagler', 'Hi Ecki, gut das du die die C-Klasse pflegt...:Rain gewinnt gegen Lechhausen mit 3,5 : 2,5, wie mir Meister Meiranke mitteilte...Einzelergebnisse:\r\nC3 : C1 0:1\r\nC4 : C3 0:1\r\nC5 : C4 1:0\r\nC6 : C5 1:0\r\nE12: C6 1:0\r\nE13: E4 1/2', '2005-11-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (234, 230, 'Dr. No(e) – 1v2', 'Kritik an „Lance“ Rothbauer’s Fete ist unberechtigt. Davon wurde lediglich 1 Spieler tangiert – nämlich ich!', '2005-11-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (235, 230, 'Dr. No(e) – 2v2', 'Ursächlich für den Spielerausfall dürfte wohl eher der Spielbeginn am frühen Nachmittag sein. Hier sollte man m.E. zum alten Modus zurückkehren!', '2005-11-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (236, 230, 'Eckhardt', 'Danke an Siggi Zagler für direkte (oben) und indirekte (Caissa Homepage) von C-Klassen-Ergebnissen.', '2005-11-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (237, 230, 'Dr. Urs Achen-Forschung', 'Der Einfluß von Feiern in Niederbayern auf die Schlagkraft unserer Mannschaften sollte im größeren Rahmen noch näher untersucht werden und mit entsprechenden Kenngrößen korreliert werden', '2005-11-30', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (238, 230, 'Dr. No(e)', 'Zu Dr. Urs A.: Hallo Kollege - prima Vorschlag! Welchen Fördertopf können wir dazu anzapfen?!', '2005-11-30', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (239, 230, 'Dr. Urs Achen-Forschung', 'Lieber Dr. No(e)! Mir schwebte vor die Experten von SAS unter persönlicher Leitung des sicherlich in kürze zeitlich reich gesegneten Nun-doch-nicht-Superminister St. und Anlassgeber E. F. zu stellen. Personell könnte dann schon mal nichts mehr schiefgehen', '2005-11-30', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (240, 230, 'Eckhardt', 'ne kalte Dusche und ein paar Aspirin könnten helfen. Gehts sonst gut?', '2005-11-30', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (241, 230, 'Buchi', 'ganz im Gegenteil Ecki: heiße Bäder, Sauna und eine Massage wirken Wunder. Wärst Du nur mit nach Bad Birnbach gefahren', '2005-11-30', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (242, 229, 'Lucky', 'Wie viel Mannschaften steigen eigentlich aus dieser Liga ab?\r\n', '2005-12-01', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (243, 229, 'Thomas Reis', 'Meistens steigen 2 Mannschaften ab.\r\nEs könnte aber bei ungünstiger Konstellation auch 3 treffen.', '2005-12-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (244, 232, 'Stefan Rothbauer', 'Hallo liebe Schachfreunde,\r\n\r\nüber die Vertretungsdelegation in persona Stefan S. und Joe haben wir uns sehr gefreut. Euer Kalender - mit viel Mühe, bis ins Detail treffend und gelungen - hat schon einen Ehrenplatz bekommen, wo wird noch nicht verraten, d', '2005-12-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (249, 241, 'Dr. No(e)', 'Hi Ecki, einige Partien wurden bereits gespielt, aber die Ergebnisse wurden anscheinend nicht weitergegeben (z.B. Joe vs. Helmut: 0-1)', '2006-01-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (248, 239, 'Zagler', 'Fast schon eine Reportage über euer Inside-Duell...Egon-Erwin-Kisch-preisverdächtig ! Hallo Lukas: Vielleicht tröstet es dich ein wenig, wenn ich dir sage, dass ich einen fast gleichen Partieverlauf schon in der Schwabenliga beobachten konnte...', '2005-12-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (247, 232, 'Stefan Rothbauer', 'darf aber beim Langlauf-Event bestaunt werden! Ein Termin und das Programm für letzteres wird noch in Absprache und unter Einbeziehung sämtlicher Mannschaftstermine bekanntgegeben. \r\n\r\nBis demnächst im Klub!\r\n', '2005-12-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (250, 241, 'Eckhardt', 'Danke, habs aktualisiert. Jetzt haben wir fast schon 50 Prozent der 4.Runde gespielt...', '2006-01-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (251, 229, 'Der junge Kontrahent', '1.c3 rulez!', '2006-01-08', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (252, 245, 'Lucky', 'Der Thomas hat noch gewonnen???!!! Wie ist das denn passiert?', '2006-01-16', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (253, 245, 'Thomas', 'Mein Gegner hat öfters nur den Zweitbesten gefunden', '2006-01-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (254, 246, 'Alex', 'Hi Ecki,\r\ngutte Besserung und verzweifle nicht ob Deiner momentanen Misere. Es kommen auch wieder fette Jahre! :) \r\n\r\nCiao, AV', '2006-01-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (255, 246, 'Achim', 'Lieber Ecki,\r\nalles erdenklich Gute wünscht Dir Dein Schachfreund Achim.\r\nWir alle hoffen, dass wir Dich bald in alter Frische erleben dürfen.\r\n', '2006-01-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (256, 246, 'Siggi Zagler', 'Hi Ecki, gute Besserung und der Hinweis auf den Artikel in der AZ vom Freitag zum Thema Schleudertrauma...Wie hat eure 5te eigentlich gegen Rain gespielt?', '2006-01-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (257, 247, 'Hans-Jürgen Pollack', 'Besten Dank, lieber Ecki für Deine umfangreiche Arbeit im Dienste des Augsburger Schach, sowie Deine treffenden Kommentare!\r\n', '2006-01-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (258, 251, 'Dr. No(e)', 'Hi Ekci&Elmar, nochmals vielen Dank für die Orga - hat Spass gemacht!', '2006-01-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (259, 250, 'Ludwig Hehl', 'Brett 8 hatte kein Konditionsproblem, sondern behandelte bereits die Eröffnung unglücklich.', '2006-01-30', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (260, 255, 'Achim', 'Zu meiner Partie gegen Ludwig Hehl: \r\nRosi sah im 48. Zug einen starken Springerzug meines Gegners!\r\nHätte Ludwig den gemacht, so hätte die plagerei von mir zu einen früheren Ende \r\nzu meinen gunsten geführt!!!', '2006-02-12', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (261, 259, 'Thomas Reis', 'Wir werden im nächsten Kampf auf keinen Fall jemanden aus eurer Stamm 8 abziehen.\r\nViel Erfolg !', '2006-02-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (262, 259, 'Lucky', 'an mir soll es nicht liegen, ich hab schon fest zugesagt, außerdem brauch ich noch einen Punkt für meine 50%', '2006-02-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (263, 260, 'Lucky', 'wie viele steigen eigentlich bei euch ab?\r\n', '2006-02-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (264, 260, 'Thomas Reis', '2 steigen sicher ab. Je nach Absteiger aus den oberen Ligen könnten es auch 3 Mannschaften sein. Sieht aber im Moment so aus, dass nur 2 Mannschaften absteigen.', '2006-02-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (265, 259, 'Bernd Bauer', 'Glückwunsch habt ihr gut hinbekommen.', '2006-02-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (266, 259, 'Eckhardt', 'Welcher Tabellenführer Kötz? An dieser Stelle ein DANKE nach Lechhausen!', '2006-02-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (267, 262, 'Andreas A.', 'Weiß jemand was von der 6.?', '2006-02-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (268, 262, 'der Ältere', 'Aichach-Keres 2-4', '2006-02-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (269, 262, 'Thommy', 'Habt ihr auch die einzelnen Gegenspieler zu den Mannschaften 5 und 6? Ich such nämlich auch noch die Ergebnisse zusammen, da auf der offiziellen Seite mal wieder nichts zu finden ist.', '2006-02-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (270, 262, 'Eckhardt', 'Thommy, ich arbeite dran; wenn ich meinen Mannschaftsführern was entlocken kann ergänze ich die Listen oben', '2006-02-22', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (271, 260, 'Eckhardt', 'BL2Süd: kein Absteiger nach Bayern, BL2Ost: Nürnberg sicher, evtl. Passau und oder Kötzting. Oberliga: die letzten beiden gegen i.d.LL Nord', '2006-02-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (272, 260, 'Eckhardt', 'M.E. kommt im worst case 1 Absteiger aus der Oberliga i.d.LL Süd, also zeichnet sich derzeit max. 2 Absteiger ab, vielleicht sogar nur einer.', '2006-02-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (273, 260, 'Eckhardt', 'Turnierordnung Bayern: Aus der Landesliga und der Regionalliga steigen so viele Mannschaften ab, dass jede Gruppe erneut zehn Mannschaften umfasst. Der Letztplatzierte steigt in jedem Fall ab. da könnt sogar noch Waldkirchen drin bleiben.', '2006-02-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (274, 265, 'Peter R.', 'Die Partie Sepp-Reichardt wurde längst gespielt, mit dem Ergebnis 0 : 1\r\nGrüße\r\nPeter', '2006-03-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (275, 267, 'Alex', 'Meine Gratulation! Eine Mannschaft, die im LAufe der Saison so viel Moral bewiesen hat, hat es auch verdient nicht nur einmal zu gewinnen, sondern auch die Klasse zu halten!\r\n\r\nWeiter so! :)', '2006-03-12', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (276, 270, 'Aleksandar Vuckovic', 'Gratulation! Nun hoffe ich, daß es Euch endlich gelingen wird, aus diesem vermaledeiten Fahrstuhl auszusteigen!\r\nViele Grüße, Alex', '2006-03-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (277, 268, 'Aleksandar Vuckovic', 'Hallo Thomas,\r\nhoffentlich nimmst Du es mir nicht krumm, wenn ich Deine eingangs erwähnten Symptome als Überfoderung deute - nach drei Jahren bei Stuttgart bin ich quasi Experte auf diesem Gebiet! Ihr müßt einfach mehr trainieren und Turniere spielen, d', '2006-03-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (278, 268, 'Aleksandar Vuckovic', '... Turniere spielen, dann wird das in der kommenden Saison nicht wieder vorkommen.\r\nAuf alle Fälle gratuliere ich Euch zum Klassenerhalt und wünsche mir weniger Spannung in der nächsten Spielzeit.\r\nGrüße, Alex', '2006-03-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (279, 268, 'Thomas Reis', 'Hallo Aleks! Das nehme ich dir nicht übel, denn es ist wahr! Bei uns spielen im Moment fast alle, was sie halt gerade können. Wenig Trainingseifer und Ambitionen...', '2006-03-14', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (280, 270, 'Thomas Reis', 'Herzlichen Glückwunsch zu dieser super Leistung! Vielen Dank auch an euren Captain Viktor Kaiser, der unserer ersten Mannschaft immer wieder starke Ersatzspieler aus seiner Mannschaft abgetreten hat.', '2006-03-14', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (281, 270, 'Florian Wieser', 'Herzlichen Glückwunsch zum Aufstieg! Zu diesen sensationellen Leistungen fallen mir momentan nur drei berühmte Zitate von Otto Rehhagel ein: (1)Wer erster ist hat immer Recht. (2)Jetzt haben wir den Salat, sind aufgestiegen und müssen uns in der [Schwaben', '2006-03-15', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (282, 270, 'Florian Wieser', '[Schwaben-]liga [I] richtig anstrengen. (bei der Kaiserslauterer Aufstiegsfeier 97). Naja und Drittens ist ja klar: Die Wahrheit liegt auf`m Platz, äh Brett! Viele Grüße aus dem Süden und bis zur Aufstiegsfeier!', '2006-03-15', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (283, 270, 'Lothar', 'Subbrrglassä, Jungs! - Extradank an Helmut für die regelmäßigen Spielberichte mit Anleihen aus der Fußballsprache :-)', '2006-03-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (284, 267, 'Lothar', 'Also, wenn die 4. die Klasse hält und wir nicht nochmal mit 2 Teams in derselben Liga spielen wollen - dann *muss* die Dritte ja aufsteigen :-)', '2006-03-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (285, 272, 'Alex', NULL, '2006-03-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (286, 272, 'Alex', 'Hi Ecki, ich war dabei und während ich um 21.00 Uhr bei der IV. noch Kampfgeist entdecken konnte - Super-Rosi - mußte ich Buchi eine 1:7- Prognose vermelden. Schade!', '2006-03-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (287, 272, 'Stefan', 'Enttäuschender als das Ergebnis ist, dass offensichtlich der Begriff Mannschaftsgeist an Stellenwert verloren hat!', '2006-03-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (288, 271, 'Stefan Schneider', 'Herzliche Glückwunsche aus Hof zum Mannschaftsergebnis, habt Ihr einmal mehr toll gemacht. Das lässt ja weiter auf den Klassenerhalt hoffen ...', '2006-03-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (289, 272, 'Lucky', 'dem Alex würd´ ich genauso viel glauben wie dem Buchi, was Stellungseinschätzungen betrifft; war da nicht ein Bauer auf e6???', '2006-03-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (290, 272, 'Alex', 'Roland: Ich weiß wirklich nicht wovon Du sprichst! ;-)', '2006-03-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (291, 277, 'Eckhardt', 'im Vergleich zu uns ist Waldkirchen praktisch unabsteigbar.', '2006-04-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (292, 282, 'Helmut Schönau', 'Klasse Zusammenfassung', '2006-04-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (293, 276, 'Lance', 'Einfach unglaublich, wie motiviert die Mannschaft schon so früh in der Saison ist! Das passt hervorragend ins Bild, Buchert ist laut eigener Aussage auch 2 Monate und 4 kg dem Plan voraus - so kündigen sich neue Rekorde an!', '2006-04-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (294, 285, 'Dr. No(e)', 'So ein Flo-Zirkus, har-har-har ...', '2006-04-16', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (295, 285, 'Eckhardt', '1860 München hat in so nem Fall den Vorsitzenden ausgetauscht und macht Trainingslager in Österreich.', '2006-04-18', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (296, 285, 'Uli', 'Hallo an alle!\r\n\r\n Ihr könnt gerne mal auf unserer neuen Homepage unter www.scdillingen.de vorbeischaun und Eure Meinung im Gästebuch kundttun ,ob sie Euch gefällt..:-)\r\n\r\nGruß Uli', '2006-04-30', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (297, 282, 'Bernd', 'Mein Glück wunsch an einen sehr sympathischen Verein, wen sucht ihr denn als Verstärkung?', '2006-05-01', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (298, 287, 'Andy', 'Es gab noch Zeiten, da wussten wir die Termine auf schwäbischer und bayerischer locker 4 Wochen vorher. Wenn das mit den last-minute Ankündigungen so weiter geht, wird sich auch künftig nichts ändern ! Ist nicht der einzige Grund,\r\naber aus meiner Sicht e', '2006-05-01', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (299, 288, 'Lucky', 'lol\r\n', '2006-05-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (300, 287, 'Christoph', 'Ich kann Andy nur zustimmen... Ankündigung 5 Minuen vorher und praktisch keine Werbung für die Turniere - was soll man da erwarten?', '2006-05-15', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (301, 288, 'Michi', '...lol...', '2006-06-17', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (302, 287, 'Riedel,SKKrumbach', 'ohne rechtzeitige,schlüssige Ausschreibung geht halt nichts.Die jeweiligen Spielleiter in den Vereinen schaffen in der Regel keine kurzfristigzusammengestellte Mannschaften.\r\nBei den schwäb Schnellschachmeisterschaften Mannschaft wars im Grunde dasselbe D', '2006-06-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (303, 291, 'Dr. No(e)', 'Herzlichen Glückwunsch! Bin gespannt auf die Foto-Anhänge ... ;-)', '2006-07-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (304, 291, 'Lance', 'Glückwunsch an die Mannschaft! Was mich besonders gefreut hat, war, dass schon Monate vorher die Kandidaten hochmotiviert waren!', '2006-07-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (305, 295, 'Hans-Jürgen Pollack', 'Dieses Turnier fand endlich in optimaler Umgebung statt und wurde wieder einmal glänzend organisiert!\r\nVon den Klorollen bis zum perfekten Bohneneintopf stimmte einfach alles - großes Kompliment!', '2006-08-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (306, 295, 'Eckhardt Frank', 'In der logischen Reihenfolge kommt das Chili vor den Klorollen :-).   Danke für das Kompliment!', '2006-08-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (307, 295, 'Uli', 'Stimme Herrn Pollack zu und hoffe,daß es so bleibt...Erste Partien gibt es übrigens auf www.scdillingen.de :-)', '2006-08-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (308, 296, 'Michael Stegmaier', 'Die Partie H.Rau-A.Jussopow  ging 1:0 aus.\r\nAm Vortag hatte er in gewonnener Stellung seinen Läufer weggestellt, was wohl seine Titelträume begraben ließ', '2006-08-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (309, 296, 'Korrektor', 'Der Alex ist erst 13', '2006-08-08', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (310, 296, 'Hannes Rau', 'Ja das stimmt,die Partie ging klar 1:0 aus.Ich finde es schon etwas enttäuschend wie wenig Mühe sich der Berichterstatter bei der Recherche gegeben hat.Auch gehört Eppingen dem badischen Schachverband an...Damit ich hier nicht nur Kritik übe, möchte ich n', '2006-08-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (311, 296, 'Georg Wiest', 'Schönes Turnier, guter Turniersaal - bis zum nächsten Jahr!', '2006-08-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (312, 296, 'einem Teilnehmer', 'wo bleiben die versprochenen Partien?', '2006-09-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (313, 296, 'auch', 'ja ... genau ... wo ??', '2006-09-03', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (314, 233, 'gilbert gotmann', 'je voudrais en savoir plus sur albert gotmann', '2006-09-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (315, 297, 'Lucky', 'zu Brett 6: Detlev war zwischendrin wohl kaputt, am Ende, als remis vereinbart wurde, stand er auf Gewinn', '2006-09-18', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (316, 296, 'einem sehr enttäuschten Teilnehmer', 'wenn ihrs nicht auf die Reihe kriegt, Partien zu veröffentlichen, kündigt das doch bitte nicht an... dann hätten wir das Turnier nur in positiver Erinnerung gehabt', '2006-09-25', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (317, 299, 'Lucky', 'Weiß irgendjemand was genaueres von der Schlägerei, die das stattgefunden haben soll?', '2006-09-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (318, 300, 'Uli', 'Hallo! Bei aller Sympathie für Euch finde ich (und nicht nur ich!) Euer Nichtantreten be...eindruckend schwach. Gruß Uli', '2006-09-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (319, 296, 'ebenfalls ent-täuschter', 'langsam wirds zeit mit den Partien, sonst bleibt da ein bitterer Beigeschmack', '2006-09-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (320, 304, 'Alex', 'Das ist sehr erfreulich und ich gratuliere dem Team zum gelungenen Saisonstart, doch wo bleibt der Artikel über die Erste?', '2006-10-17', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (321, 311, 'Peter Grabowski', 'Da bin ich einfach sprachlos! Herzlichen Glückwunsch zu diesem eindrucksvollen Ergebnis. Ich bin schon sehr gespannt darauf, wie sich unsere Leute auf der Augsburger Kreiseinzel in knapp zwei Wochen präsentieren werden.', '2006-10-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (322, 311, 'Lothar', 'Tolle Leistung, Leute!', '2006-10-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (323, 311, 'Eckhardt', 'Ein großes Kompliment an die Trainer!', '2006-10-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (324, 312, 'Alex', 'Wer ist denn Lothar Weimer? Er wird weder in der DWZ-Liste des SKK noch in der DWZ-Liste des DSB erwähnt, scheint aber stark genug zu sein, Altmeister Birkle zu schlagen.', '2006-10-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (325, 312, 'Michi', 'Lothar Weimer ist Lothar Sepp.', '2006-10-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (326, 312, 'Peter Grabowski', 'Eigentlich wollte ich zu Lothar noch etwas sagen, bin aber davon ausgegangen, dass es sich mittlerweile herumgesprochen hat, dass er Anfang Oktober geheiratet hat. Bitte weitersagen!', '2006-10-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (327, 312, 'Eckhardt', 'Die Idee, dass die 5.Revanche nehmen wollte (wobei die 6. heuer mit Lothar verstärkt war) ist nett', '2006-10-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (328, 312, 'Alex', 'Danke für die Info, Michi.', '2006-10-25', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (329, 315, 'Eckhardt', 'Gratulation und Danke für den Bericht. Wir haben gegen  Rain unser bestes gegeben, hat leider nicht ganz gereicht...', '2006-10-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (330, 316, 'Stefan', 'an der Motivation lags wahrlich nicht. Zeitnotschlachten und ausgekämpfte Remisen, das ist doch was die Fans (neben Buchi) sehen wollen...', '2006-10-30', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (331, 317, 'Eckhardt', 'Gratulation an alle Teilnehmer und besonders an Anton und Carina - starke Leistung!', '2006-11-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (332, 317, 'Andi dem Abtruennigen', 'Das geht ja mit grossen Schritten voran. Zu grosse Schritte.\r\nIhr muesst damit aufhoeren! Wisst ihr, was Ihr anrichtet? Als Anton die Stadtmeisterschaft, gewonnen hat, ist das hier passiert: http://de.wikipedia.org/wiki/Bild:Uluru_Australia%281%29.jpg  \r\n', '2006-11-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (333, 317, 'Peter', 'Hallo Andi, na dann mach Dich mal auf was gefasst (siehe Tabellen:-)', '2006-11-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (334, 316, 'Alex', 'Thomas, ich kenne dieses frustrierende Gefühl, doch betrachte es positiv. Denn wenn ich mich richtig erinnere, dann seid ihr letztes Jahr nicht abgestiegen - wäre doch wieder schön, oder?', '2006-11-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (335, 317, 'Andi', 'Nicht schon wieder! Das in der U16 haette nun wirklich nicht sein muessen! Geologen haben gewarnt, dass der Vulkan Mt Taranaki in den naechsten 20 Jahren wieder ausbricht. Ich glaube ja nicht, dass das noch so lange dauert... )-:', '2006-11-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (336, 316, 'Thomas Reis', 'Hallo Alex. Danke für deine aufmunternden Worte. Unser Ziel ist selbstverständlich der Klassenerhalt. Dieses Jahr hoffentlich ohne große Turbulenzen...', '2006-11-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (337, 317, 'Peter', 'Könnte sein, dass es nächstes Jahr schon soweit sein wird, wenn Julian beschließt die U18 zu gewinnen :-)', '2006-11-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (338, 319, 'Eckhardt', 'Ihr seid Klasse! Großes Kompliment an jede(n) einzelne(n) Teilnehmer(in) und an alle Trainer!', '2006-11-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (339, 319, 'Eckhardt', 'Von wegen Masse statt Klasse: 2005 2 mal Platz 1, 3 mal Platz 2 und einmal Platz 3, 2006: 3 mal Platz 1, 3 mal Platz 2 und 2 mal Platz 3! 8 statt 6 Plätze auf dem Treppchen!', '2006-11-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (340, 319, 'Eckhardt', 'Insgesamt gehts im Augsburger Jugendschach aufwärts: 2004 38 Teilnehmer (19 Kriegshaber), 2005 49 (16 Kriegshaber), 2006 65 Teilnehmer (24 Kriegshaber) Das ist Rekord! Super! Maria: Gratulation!!!', '2006-11-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (341, 319, 'Peter R.', 'Auch von mir ein Riesenkompliment an alle teilnehmenden Kinder, vor allem an diejenigen für die es das erste Turnier war!', '2006-11-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (342, 319, NULL, 'und ein weiteres an alle Trainer, Betreuer und die mitfiebernden Eltern! Ganz besondere Glückwünsche an alle Treppchensieger; viel Glück bei der Schwäbischen!!', '2006-11-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (343, 319, 'Stefan Kiechl', 'Masse statt Klasse, das ist doch Blödsinn! Zunächst muss doch anerkannt werden, dass die Jugendarbeit beim SKK einfach gut ist! Wer das leugnet ist wohl neidisch, denn die Jugendleiter sind allesamt ja auch beruflich eingespannt und keine Schachprofis! Ga', '2006-11-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (344, 319, 'Stefan Kiechl', 'an dieser Stelle ein ganz großes Kompliment an unsere Jugend und deren Betreuer!', '2006-11-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (345, 319, 'Stefan Kiechl', 'an dieser Stelle ein ganz großes Kompliment an unsere Jugend und deren Betreuer!', '2006-11-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (346, 321, 'Alex', 'Hallo Ecki, Du solltest öfter einmal ein Turnier spielen, dann wäre Dir auch nicht das Gefühl fremd, vom Gipfel die Tabelle zu betrachten! ;-)\r\nNur keine Panik, ich glau an Dich!!', '2006-11-08', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (347, 323, 'Lucky', 'für eure Mannschaftspunkte habt ihr zumindest die optimale Brettpunktezahl :-)', '2006-11-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (348, 329, 'Florian Wieser', 'Großartig! Freut mich sehr, dass Schach an St.Stephan wieder lebt!', '2006-12-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (349, 330, 'Siggi Zagler', 'wunderbarer Artikel...', '2006-12-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (350, 330, 'Siggi Zagler', 'und jetzt noch Rudis Angriff abwehren, dann kann dann klappt das...\r\n...und in allen Häusern der Stadt wird man von deinem Triumphe sprechen.', '2006-12-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (351, 330, 'Alex', 'Nur gut, daß ich schon frühzeitig auf Deinen TUrniersieg gesetzt habe, denn nun bekommt man nicht mehr eine so gute Quote wie bei Turnierbeginn!\r\nWeiter so Ecki, möge Fortuna, äehm, natürlich Caissa weiterhin mit Dir sein!! :)', '2006-12-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (352, 329, 'Stefan Schneider', 'Da kann ich mich eigentlich nur anschließen, schön, dass die mittlerweile langjährige Schachtradition an St. Stephan fortgeführt wird.', '2006-12-15', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (353, 331, 'Lothar', 'Die Erlaubnis zum Abstieg kriegt ihr nur gegen das Versprechen, im Folgejahr sofort wieder aufzusteigen :-)', '2006-12-17', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (354, 329, 'Markus Buchberger', 'Super Leistung, und Danke an Aleksandar für sein Engagement und die tolle Einschätzung der Spieler/innen.', '2006-12-17', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (355, 331, 'Thomas Reis', 'Hallo Lothar. Ich glaube nicht, dass wir absteigen. Wir wollen das im neuen Jahr unbedingt noch drehen.', '2006-12-18', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (356, 333, 'Kiwi-Andi', 'immerhin ist der Bericht erstklassig!', '2006-12-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (357, 333, 'Stefan K.', 'Stimmt, der Bericht ist trefflich formuliert; schön, dass Michael Kling für mich spielen konnte - ich hatte schon die Befürchtung, dass wir nur mit sieben Spielern antreten ...', '2006-12-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (358, 335, 'Dr. No(e)', 'jammer-schluchz-winsel', '2006-12-22', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (359, 335, 'Lothar', 'Hey Joe, where are you going with that gun in your hand? (um mal Jimi Hendrix aus seinem Grab sprechen zu lassen)', '2006-12-22', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (360, 337, 'rudi forster', 'hallo eckhardt,\r\ndanke für die schnelle insnetzstellung. kannst du mir erklären, wie sich die punkte errechnen, da sie ja nicht mit den tatsächlichen identisch sind.\r\ngrüße rudi', '2007-01-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (361, 337, 'Bernhard Derix', 'Fleißige Auflistung, Danke.\r\nDas Ergebnis des Turniers der SG Augsburg findet sich unter http://www.sg-augsburg.de.\r\nViele Grüße', '2007-01-08', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (362, 337, 'der ältere', NULL, '2007-01-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (363, 337, 'der ältere', 'wann gibts denn die Liste der Qualifizierten???', '2007-01-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (364, 338, 'Eckhardt Frank', 'Folgende Zusagen liegen vor (10.1.07, 22 Uhr): Vitus Lederle, Mark Safyanovsky, Michael Voß, Florian Wieser', '2007-01-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (365, 338, 'Eckhardt Frank', 'Weitere Zusagen liegen vor (11.1.07, 10 Uhr): Josef Neiß und Winfried Rebitzer', '2007-01-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (366, 338, 'der ältere', 'auf diesem Wege erfolgt auch die Zusage von H.Ostertag', '2007-01-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (367, 338, 'Eckhardt Frank', 'Zusage Aleksandar Vuckovic liegt vor (11.1.07 17 Uhr)', '2007-01-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (368, 343, 'Markus Buchberger', 'Gratuliere zu dem Erfolg. Kommt da die Aufstiegsmannschaft?', '2007-01-14', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (369, 344, 'Alex', 'Mein lieber Stefan, nach Deiner geglückten OP und dem Besuches meines Schachkurses bin ich überzeugt, daß wir von Dir noch viele weitere erfolgsmeldungen hören werden! :)', '2007-01-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (370, 345, 'Dr. No(e)', 'Hi Ecki, vielen Dank für die DWZ-Beförderung?!', '2007-01-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (371, 345, 'Lothar', 'OK, *so* können wir natürlich auch vermeiden, nächstes Jahr wieder 2 Teams in der Kreis II zu haben', '2007-01-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (372, 353, 'Lothar', 'Prima, dass Du dabei bist, Stefan! Halt uns auf dem Laufenden', '2007-02-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (373, 354, 'Andi (Schachfreunde Otorohanga)', 'Hervorragender Artikel bei zurfrieden stellendem Ergebnis. Dennoch hätte sich sicher der ein oder andere einen deutlicheren Sieg gewünscht. *Deckungsuch*', '2007-02-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (374, 354, 'Stefan Kiechl', 'Super Artikel,tolles Ergebnis mit den Diagrammen kommt ja richtig Farbe auf unsere Homepage!!\r\n', '2007-02-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (375, 354, 'Alex', 'Ein Beitrag der begeistert!! Ich gratuliere Euch und hoffe, noch weitere solche Artikel hier zu lesen!!', '2007-02-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (376, 354, 'Lothar', 'Ich hoffe, Andi, Du hast eine *gute* Deckung gefunden in Otorohanga. Wo auch immer das liegen mag', '2007-02-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (377, 354, 'Andi aus sicherer Entfernung', 'Übrigens ist der Kampf SG Augsburg V - Rainer SC II (vor dem Spieltag beide Tabellenführer) 2,5:2,5 ausgegangen. Damit haben sich zwei Mannschaftspunkte, die auf dem Weg zum Aufstieg hinderlich sein könnten, in Luft aufgelöst. (-:', '2007-02-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (378, 354, 'Lothar', 'Der Witz SGA5 - Rain 2 wurde bei uns natürlich schon dankbar zur Kenntnis genommen :-)', '2007-02-14', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (379, 355, 'Alex', 'Wieder ein toller Bericht, auch wenn ich immer nur auf 5.3 komme! Lothar, möchtest Du künftig die berichte für alle Kämpfe schreiben? ;)', '2007-02-18', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (380, 355, 'Stefan K.', 'Lothar, vielen Dank für Deinen Bericht - aber wir haben 5-3 gewonnen nicht 6-2!!! Zwei Niederlagen, zwei Remisen und vier Siege!!! Und wenn Dr. Otto noch auf meine Mattdrohung reingefallen wäre, wäre ich nach Altötting gepilgert!', '2007-02-18', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (381, 355, 'Lothar', 'Asche auf mein Haupt! Ich habe den Fehler berichtigt, so schnell ich konnte, aber ihr wart einfach noch schneller!', '2007-02-18', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (382, 355, 'Alex', '@Lothar: Macht ja nichts, dafür hast Du uns ja diesen netten Bericht geschenkt! :))', '2007-02-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (383, 353, 'Imperator', 'Stefan passt sowohl in der Spielstärke als auch als überaus angenehmer Spieler hervorragend in die Gruppe 2!\r\nNoch mehr Ergebnisse gibt es laufend auf der Seite http://www.sk-caissa.de unter Ergebnisse - externe Turniere.', '2007-02-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (384, 358, 'Helmut Schönau', 'muss meine Aussage korrigieren. habs mit fritz nachgesehen, hatte mich am schluss alles andere als befreit, niederlage völlig ok.', '2007-02-26', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (385, 358, 'Lucky', 'Wobei ich immer noch nicht weiß, ob die Schlußstellung für mich gewonnen war, einfach wär es nicht geworden', '2007-03-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (386, 0, NULL, NULL, '2007-03-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (387, 360, 'Lucky', 'Wie viele steigen eigentlich ab? Momentan sieht´s ja noch ganz gut aus für uns', '2007-03-12', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (388, 360, 'Thommy', 'Freaggles das sind wir, literweise Dosenbier :-)', '2007-03-12', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (389, 360, 'Eckhardt', 'Zahl der Absteiger hängt von den bayerischen Ligen ab, ich rechne heuer mit 3 Absteigern aus der SL I', '2007-03-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (390, 360, 'Eckhardt', 'Bei der Situation i.d.Bundesliga II Ost kann man mit 3 Abstiegern in die Oberliga rechnen, dort ebenfalls 3 Absteiger alle in die LL Süd...', '2007-03-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (391, 360, 'Eckhardt', 'In der LL Süd verabschieden sich dann 3 Mannschaften in die Regionalliga Süd-West, was dort wohl zu 4 Absteigern führen kann (von denen derzeit 3 aus Schwaben kommen).', '2007-03-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (392, 360, 'Lucky', '????? Soll das heißen, daß man als fünfter auch noch absteigen kann?', '2007-03-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (393, 360, 'Eckhardt', 'Nein, in Schwaben maximal 3; kommen von oben mehr Absteiger runter wird die Reduzierung über die nächste Saison gestreckt.', '2007-03-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (394, 250, 'Christian Keasler', 'Herr Hehl ist Klasse!!!', '2007-03-14', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (395, 360, 'Georg Wiest', 'Schw.Turnierordnung 4.14.3: SL mit 8 Teams > max. 2 Absteiger!', '2007-03-18', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (396, 360, 'Georg Wiest', '... oder interpretiere ich den betr. Passus falsch?', '2007-03-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (397, 363, 'Lucky', 'Wenn ihr absteigt, dann blockiert ihr ja uns, falls wir aufsteigen sollten :-)', '2007-03-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (398, 363, 'Stefan K.', 'Hallo Lucky, ich fürchte, Du kennst noch nicht das Ergebnis unserer Zweiten gegen Göggingen...:-(', '2007-03-19', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (399, 363, 'Lucky', 'Doch, das Ergebnis kenn ich schon, aber erstens haben wir noch Kaufbeuren und angeblich steigen doch nur zwei Mannschaften aus der SLI ab', '2007-03-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (400, 363, 'Christoph', 'Noch zwei Siege und dann schau mer mal - die Hoffnung stirbt zuletzt!', '2007-03-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (401, 360, 'Helmut  Schönau', 'Max. 2 Absteiger bei acht Mannschaften, ist korrekt. Burlafingen hat verloren und liegt noch hinter uns. Glück auf.', '2007-03-22', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (402, 364, 'Markus', 'Gratulation an unsere VI.\r\nDa wird doch der 14.4. und 12.5. auch noch zu meistern sein....', '2007-03-26', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (403, 360, 'Peter', 'Zur aktuellen Situation im Schwäbischen Spielbetrieb (insb. Info über HP): Wozu gibt es eigentlich einen 2.Spielleiter? Müsste der die Aufgaben des 1. nicht in so einem Fall übernehmen? Und was macht eigentlich der 1.Vorsitzende???', '2007-03-26', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (404, 364, 'Peter', 'Herzliche Glückwünsche! Die 5. hat ja auch gewonnen! Man darf wohl weiter vom Doppelaufstieg träumen!', '2007-03-26', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (405, 365, 'Georg Wiest', 'Korrektur zu Lauingen: An 6 haben wir gewonnen, an 8 verloren.', '2007-03-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (406, 366, 'Michael', 'Danke für die Gratulation, aber das war weder mein Debut in dieser Saison, noch mein erster ganzer Punkt. Es handelt sich vielmehr um meine vierte Partie und den 3,5ten Punkt in dieser Saison.\r\nAnsonsten ein sehr erfreulicher Artikel, weil endlich mal was', '2007-03-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (407, 368, 'Lucky', 'Ist das Ernst oder ein Aprilscherz??', '2007-04-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (408, 372, 'Mr.Objektiv', 'Bei 4 Absteigern aus der Landesliga Süd stirbt spgar die Hoffnung irgendwann', '2007-04-22', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (409, 373, 'Thomas Reis', 'Ein weiteres kurzes Update von mir:\r\nDer SC Pasing hat bereits seine Mannschaft zurückgezogen.\r\nDamit steigen im Moment nur 3 Mannschaften ab.', '2007-04-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (410, 374, 'Thomas Reis', 'Herzlichen Glückwunsch zum Klassenerhalt!\r\nTolle Leistung.', '2007-04-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (411, 372, 'Thomas Reis', 'Hallo Mr. Objektiv. Der SC Pasing hat bereits seine Mannschaft zurückgezogen.\r\nSomit gibt es nun schon nur noch 3 Absteiger! Hoffen ist noch erlaubt.', '2007-04-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (412, 372, 'Mr.Objektiv', 'Ist schon bekannt, in welche Liga der SC Pasing seine 1.Mannschaft zurückzieht?', '2007-04-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (413, 372, 'Thomas Reis', 'Der SC Pasing zieht sich laut Herrn Decker aus allen Bayerischen Ligen zurück, was auch immer das heißen mag. Ingolstadt steigt definitiv nicht aus der Landesliga Süd ab.', '2007-04-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (414, 374, 'Eckhardt', 'Glückwunsch! - Nächste Saison wird härter (2 Absteiger aus der RL und die aufgerüsteten und zu allem entschlossenen Meringer, sowie Krumbach II. Beide souveräne Aufsteiger.', '2007-04-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (415, 374, 'Lucky', 'aber vielleicht gibts auch mehr Mannschaften in der Liga, ich hab da was von Aufstocken auf zehn Teams gehört', '2007-04-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (416, 375, 'Bernhard Seidl, Rainer SC', 'Danke für ihre tolle Arbeit, so kommen wir auch zu Infos.\r\nDas ihnen fehlende Spiel endete 4,5 :1,5\r\nfür Rain III  gegen Gersthofen.\r\nbis zum 12. Mai.\r\nGruß B. Seidl', '2007-04-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (417, 380, 'Flo', 'Der legendäre SKK- Laufachter scheint ja schon bestens präpariert! Da wird es dieses Jahr sicher ein Hauen und Stechen um die begehrten Plätze geben.', '2007-05-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (418, 380, 'Flo', 'Gibt es eigentlich schon erste Trainingsanalysen von Chefcoach Wolfgang B.?', '2007-05-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (419, 380, 'Lance', 'Die Analysen haben nach vier Tagen ergeben, dass die Laufstrecke tendenziell vielleicht nicht ganz so oder auch anders, in jedem Fall aber ist nichts gesichert und die Prognosen bleiben spannend...', '2007-05-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (420, 380, 'Andi', 'Der Ernstfall ist übrigens am 8.Juli und nicht Juni - für den Fall dass der ein oder andere (Stefan K., Victor) noch Lust bekommen', '2007-05-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (421, 380, 'Aus Spass wird Ernst', 'Nachtrag zum Nachtrag: der erste Ernstfall ist der Landkreislauf am 24. Juni und der zweite Ernstfall dann der Kampenwandlauf am 8. Juli - auch hier gibt es eine Teamwertung (die in der Kategorie Schachklub) zu gewinnen sein dürfte', '2007-05-08', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (422, 373, 'Dragan Popp', 'Wie im Falle von Greuther Fürth,gönn ich auch ein Wunder,\r\nCaissa zum Gruß', '2007-05-15', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (423, 389, 'Tommy', 'Gratulation an alle Beteiligte. Ich freu mich schon auf die näheren Analysen im Klub', '2007-06-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (424, 389, 'Thomas Anhäuser', 'Hallo Yvonne Scheuerlein.\r\nIch habe 136 Fotos vom Landkreislauf die ich Euch gerne geben möchte. Leider weiß ich nicht wem ich sie geben soll. Ich bin telefonisch unter Andreas Anhäuser zu erreichen - die Nummer habt Ihr ja.', '2007-06-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (425, 389, 'Florian Wieser', 'Herzlichen Glückwunsch zur erneuten Leistungssteigerung! Bin auch schon auf die Einschätzung von Wolfgang B. gespannt!', '2007-06-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (426, 395, 'Markus', 'Danke für den ausführlichen Bericht.', '2007-07-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (427, 393, 'Markus Buchberger', 'Ein herzliches Dankeschön auch von der Jugend. Ein grandioser Einsatz und eine wirklich unangenehme Arbeit wurde hier wirklich erfolgreich durch gezogen. Vielen herzlichen Dank nochmal.', '2007-07-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (428, 393, 'Stefan K.', 'Eine super Handwerkerleistung - dadurch haben unsere Spielbedingungen ein wesentlich höheres Niveau erreicht! Dank an alle, die mitgearbeitet haben!', '2007-07-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (429, 396, 'Wolfgang Malcher', 'Unser Buchi, der Professor, Dottore, Maestro unter den Wissenschaftlern und Analytikern hat mit diesem Bericht mal wieder zugeschlagen und sich damit wie immer mal wieder übertroffen.  Treffender kann man Analysen nicht zu Papier bringen!!!  Klasse Buch', '2007-07-03', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (430, 396, 'Eckhardt', 'Fahrradtacho für den Landkreislauf??? Jetzt übertreib ma aber!', '2007-07-03', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (431, 396, 'Sonn Enklar', 'dass bei dem Tempo jetzt kabellose Präzisionstachos mit dreistelliger Anzeige gefragt sind', '2007-07-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (432, 393, 'Lothar', 'Boh - und ich dachte letztens, ich hätte im Suff versehentlich das Klo der AIDS-Hilfe ein Stockwerk tiefer erwischt', '2007-07-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (433, 397, 'Reinmund Hobmaier', 'Servus Yvonne, \r\nda ich den Bericht sehr gut finde, möchte ich gerne von der Kampenwandlauf-Seite einen Link darauf und auch zu den Bildern setzen. Ist das o.k. ?\r\nViele Grüße\r\nReinmund', '2007-07-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (434, 397, 'Andreas Stör', 'Hallo Reinmund: das geht in Ordnung', '2007-07-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (435, 396, 'Lothar', 'Diese Analyse ist eindeutig ein Plagiat. Ein orignal Buchert wäre mindestens 4x länger', '2007-07-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (436, 407, 'steinmüller', 'ja, sachen gibts... als meine partie dann fertig war...1:0 gegenpogan sebastian. knurrten bei den restlichen 6 puschendorfern so der magen, daß ich mich als verantwortlicher sofort um das leibliche wohl der kleinen kümmern musste. ich hoffe, wir könen d', '2007-08-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (437, 408, 'John', 'Update wie jedes Jahr miserabel, STUNDEN NACH RUNDENENDE nicht mal Ergebnisse ... SCHWACH !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!', '2007-08-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (438, 412, 'Georg Wiest', 'Ein rundum gelungenes Turnier. Ihr habt ausgezeichnete Arbeit geleistet!', '2007-08-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (439, 411, NULL, NULL, '2007-08-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (440, 114, 'Sussi Mülsler', 'Also der Autor hat echt keine Ahnung,was damals wirklich abgelaufen ist,der soll mal lieber das nächste mal besseer aufpassen...oder wie man sagt,einfach mal live dabei sein....man man man', '2007-08-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (441, 422, 'Dr. No(e)', 'Witzige Berichterstattung - wÃ¤re ohne Hieroglyphen noch besser. Also: das nÃ¤chste mal gleich Keilschrift!', '2007-09-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (442, 422, 'Lucky', 'Ich denke, ich muÃŸ da mal in der Kerre vorbeischauen und euch rÃ¤chen', '2007-09-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (443, 422, 'Insider', 'Codepageproblem. Ansonsten der treffende Bericht zu einem grandiosem Schachkampf. Wer ist den dieser H.P.???', '2007-09-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (444, 422, 'Stefan K.', 'Kompliment an beide Mannschaften - es war ein spannender Kampf!', '2007-09-24', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (445, 422, 'ofti', 'hi lothar, danke fÃ¼r den super bericht.\r\nkommst du am mittwoch in die kerre?\r\ndie goiÃŸen warten!', '2007-09-25', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (446, 422, 'Hans und Ingrid', 'Hut ab Vossi, finden wir.', '2007-09-25', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (447, 422, 'Lothar', 'Mittwochs Spiessrutenlaufen in der Kerre? Logisch!', '2007-09-25', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (448, 422, 'Lothar', 'Tschuldigung Ã¼brigens wegen des Zeichensatzproblems. Glatt vegessen, dass schon auf UTF-8 umgestellt war', '2007-09-25', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (449, 422, 'Hubert', 'Genialer Bericht, Lothar. Aber, zu Brett 8: Beim Damenendspiel stehen selbige doch auf und nicht neben dem Brett!? Am Ende wars ein Bauernendspiel - todremis. Trotzdem dickes Kompliment an Vossi, weil viele weiter spielen wÃ¼rden.\r\nNoch Mal vielen Dank fÃ', '2007-09-26', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (450, 426, 'Peter', 'Meine Partie war aus der Eröffnung heraus strategisch gewonnen,dann fiel schnell ein Turm, aber mein Gegner hatte Spass am Weiterspielen sodass wir noch zwei weitere Stunden am Brett sassen.', '2007-09-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (451, 424, 'Markus Buchberger', 'Ja - hat wirklich Spaß gemacht. Danke für den schönen Bericht und ganz besondere Gratulation an alle Jugendlichen dieser Begegnung.', '2007-09-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (452, 425, 'Lucky', 'Kleine Zwischenfrage: Gibt es eigentlich schon sowas wie einen Terminplan für die Schwaben I ? Auf der Homepage krieg ich immer nur den 404-Fehler', '2007-09-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (453, 425, 'Lucky', 'Und normalerweise waren die ersten Spiele immer so Anfang Oktober', '2007-09-27', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (454, 422, 'Horsti', '1.Ein President ist niemals frech, er stellt nur Tatsachen fest. 2. Deine Berichterstattung ist klasse... meine Hochachtung. 3. Eure Tatik, den Raucherraum nicht frei zu geben, war umsonst, da wir zur Not Nikotinpflaster dabei haben. 4. Gratulation zu Dei', '2007-10-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (455, 427, 'Andi', 'Vielen Dank für den Schadensbericht!', '2007-10-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (456, 439, 'Manfred Wiedemann', 'High, Ecki - prima Analyse, ich stimme überein. Tja, und das ich mit Zeitgutschrift (regulär) wieder über 5 Minuten war und mitschreiben muss (wohl genauso regulär) war mit meinem Puls zu diesem Zeitpunkt ( ich hatte die Partie eigentlich schon längst abg', '2007-10-29', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (457, 438, 'Lothar', 'Yeah, suppi Jungs! Weiter so', '2007-11-01', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (458, 444, 'Alex', 'Was ist denn da passiert, daß ein Monatsblitz mit nur SECHS Teilnehmern hat stattfinden müssen? Um dieses Trauerspiel zu beenden, kündige ich hiermit an, im Dezember mit von der Partie zu sein - wären dann schon sieben! ;-)', '2007-11-03', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (459, 444, 'Lothar', 'Yeah, danke Alex! Wird auch Zeit, dass wieder Leben in die Bude kommt.', '2007-11-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (460, 445, 'Zagler', 'Wer,Was,Wann,Wie,Wo???...Außerhalb eures Schachklubs kann mit diesem Text keine Sau etwas anfangen...', '2007-11-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (461, 444, 'Eckhardt', 'Alex, nimm die Kinder mit, dann sinds schon zehn!', '2007-11-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (462, 444, 'Alex', '@Ecki: Marianne hat voraussichtlich am 07.12. frei, womit es schon ELF Teilnehmer sein könnten! Dürfen sich überhaupt so viele Spieler in den Räumen des SKK aufhalten? ;-)', '2007-11-16', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (463, 449, 'Lothar', 'Hey Matze, danke für den Bericht!', '2007-11-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (464, 451, 'Thomas Reis', 'Herzlichen Glückwunsch zum erneuten Sieg!\r\nIch als bekennender Bernd Bauer Fan freue mich sehr für euch, dass es so gut läuft. Drücke euch auch weiterhin die Daumen...', '2007-11-26', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (465, 454, 'Stefan Kiechl', 'Danke für den Bericht, die Parteinotation ist eine schöne Zugabe zum Artikel; das macht unsere Homepage lesenswert!', '2007-12-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (466, 454, 'Stefan Kiechl', 'es muss natürlich Partienotation heißen...', '2007-12-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (467, 454, 'Lothar', 'Komme selbst gerade vom Kampfeinsatz der 2. in Königsbrunn zurück. Eben kurz Antons Partie angeguckt. Bravo!', '2007-12-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (468, 456, 'Alex', 'Tja Leute, auch wenn ich für eine starke Steigerung der Teilnehmerzahl, prozentual gesehen, gesorgt habe, so ist die Teilnehmerzahl absolut betrachtet, doch sehr enttäuschend! :-(', '2007-12-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (469, 456, 'Alex', '@Ecki: Für das nächste Blitzturnier empfehle ich, es mit einem Schach-Star zu probieren und auf mich als Zugpferdchen zu verzichten. Ungeachtet dessen, werde ich im Januar WIEDER teilnehmen!! :-)\r\n', '2007-12-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (470, 454, 'Viktor', 'Antons Partie ist absolut klasse !!!', '2007-12-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (471, 456, 'Lucky', 'Dann komm ich auch, wenn der Alex kommt!', '2007-12-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (472, 456, 'Lucky', 'Das wäre dann eine Steigerung um 12,5%! Von so viel Zinsen kann man nur träumen! Und das monatlich!', '2007-12-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (473, 456, 'Alex', '@Lucky: Das finde ich ja klasse!! Aber wie kommt es, dass Du an diesem Freitag nicht wieder im Bus nach Kroatien sitzen musst? ;-)', '2007-12-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (474, 456, 'Lucky', 'Da hab ich freibekommen :-)', '2007-12-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (475, 456, 'Lothar', 'Also gut, dann stelle ich mich im Januar auch wieder freiwillig als Daueropfer und Punktelieferant zur Verfügung.', '2007-12-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (476, 456, 'Alex', '@Lothar: Lothar wir danken Dir! Sowohl für die Turnierleitung als auch, etwas mehr natürlich, für die Punkte! :-))', '2007-12-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (477, 114, 'Larissa', 'Der Autor war mein Trainer und war live dabei! (3 Platz! U12) Haha\r\n\r\n', '2008-01-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (478, 462, 'Stefan Kiechl', 'Danke für den Bericht - die Tabelle ist auch ohne Sortierung übersichtlich und schön anzusehen; toll, dass auf unsere Homepage nun auch wieder ordentliche Tabellen zu sehen sind!', '2008-01-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (479, 462, NULL, NULL, '2008-01-13', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (480, 471, 'Lucky', 'Was heißt hier Abstieg? SGA 1 Punkt, Göggingen 3 Punkte, Lauingen 4 Punkte ...\r\nWenn wir gegen SGA und Göggingen zweimal gewinnen, dann sind wir gut im Geschäft!', '2008-01-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (481, 471, 'Lucky', 'Und in der letzten Runde gegen Mering, die bis dahin vielleicht gar nicht mehr aufsteigen können', '2008-01-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (482, 471, 'Lothar', 'Und noch ein weiterer Pluspunkt: *Ich* kann die 2. Mannschaft nicht nochmal schwächen, weil ich schon 3mal eingesetzt war :-)', '2008-01-21', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (483, 471, 'Helmut', 'Ein Malus bleibt: Ich spiele auch die restlichen Partien noch mit.', '2008-01-28', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (484, 473, 'Viktor', NULL, '2008-02-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (485, 473, 'Viktor', 'Ich fands klasse, dass alle zu Ende gespielt haben. Als Bedenkzeit fände ich 120 Minuten für die gesamte Partie oder 90 Minuten für 40 Züge und 30 Minuten für den Rest ok. So wären die Partien vor 24 Uhr zu Ende. Der Zeitpunkt der Clubmeisterschaft ist mi', '2008-02-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (486, 475, 'Lothar', 'Danke für den Bericht! - Aber warum schreibt eigentlich Stefan Kiechl über Stefan Kiechl in der dritten Person?', '2008-02-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (487, 480, 'Stefan K.', 'Super Leistung! Schade, dass ich nicht dabei sein konnte!', '2008-02-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (488, 480, 'Lothar', 'Bravo!', '2008-02-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (489, 484, 'Zagler', 'Hi Elmar, schöner Bericht und Dankeschön für die Tabelle...', '2008-02-14', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (490, 484, 'Lothar', 'Remisantrag nach 10.2 FIDE bei 3 Minuten auf der Uhr wäre ohnehin gegen Regel gewesen. Geht erst unter 2. Das aber nur nebenbei.', '2008-02-14', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (491, 483, 'Georg Stiegel, SK Göggingen', 'Liebe Schachfreunde vom SK Kriegshaber, die Tabelle stimmt nicht ganz. Göggingen hat gegen Rain mit 6½ zu 1½ gewonnen. Es ist schade, dass die Seiten des KVA in letzter Zeit nicht immer ganz aktuell sind.', '2008-02-20', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (492, 489, 'Andi', 'SUPER, Valeria!!\r\n...alle anderen auch toll!', '2008-03-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (493, 489, 'Andi', 'SUPER, Valeria!!\r\n...alle anderen auch toll!', '2008-03-02', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (494, 489, 'Lucky', 'Valeria verwandelt SEINEN Mehrbauern :-)', '2008-03-03', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (495, 489, 'Alex', '@Lucky: Welcher Witz ist mir da entgangen, Du Reisender zwischen den Welten - Valeria verwandelt SEINEN Mehrbauern? (kratz am Hinterkopf) :-)', '2008-03-03', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (496, 489, 'Lucky', 'Irgendjemand hat da an der Seite was geändert ... Anfangs hieß es noch so wie von mir zitiert. Dir als Serben fällt da natürlich nichts auf (Stichwort reflexives Possesivpronomen)', '2008-03-04', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (497, 489, 'Irgendjemand', 'Soll doch keiner sagen, dass ich die Kommentare der geneigten Leserschaft nicht berücksichtige...  :-)', '2008-03-06', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (498, 492, 'Bernhard Seidl', 'Hallo Mitaufsteiger,\r\n\r\nSeid nicht so unbescheiden, jetzt seid ihr auch noch vor uns,denkt an unsere  Geschenke    bei euch\r\nGruß B. Seidl,\r\n\r\nDanke für eure Infos \r\nGruß B. Seidl', '2008-03-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (499, 492, 'Zagler', 'Rain schlägt Mering mit 5,5\r\n\r\nVielen Dank an die Kriegshaberer für die Tabellen\r\n', '2008-03-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (500, 493, 'Witali', '@meine Partie. Ich war mir auch nicht so sicher, aber Fritz sagt: Remi', '2008-03-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (501, 493, 'Helmut S.', 'Was muss passieren, damit wir nicht absteigen?', '2008-03-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (502, 493, 'Lucky', 'Es darf nur einer absteigen und wir müssen vorletzter werden.', '2008-03-10', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (503, 493, 'Peter Endisch', 'Hat Kriegshaber II Ambitionen auf die C-Klasse? Oder wieso dann diese Tabelle?', '2008-03-11', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (504, 506, 'Viktor Kaiser', 'Warum irgendwelche nichtpassenden Tabellen meine Schreibergüsse am Ende zieren ,weiss ich nicht.(war auch schon beim letzten Bericht so)', '2008-04-07', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (505, 507, 'Michael Fischer', 'Sehr verwirrend-auch der Artikel. War denn nun irgendein Plättchen gefallen oder nicht? \r\nUnd wieso eventuell Remis?', '2008-04-08', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (506, 506, 'Helmut Schönau', 'Kleine Berichtigung: Auch wenn ich (ausnahmsweise) nicht ganz so schlecht wie sonst gespielt habe, ohne Glück wärs nicht gegangen.', '2008-04-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (507, 507, 'Andi A.', 'Nach hause gehen ist sicher nicht das Geschickteste in so einer Situation. Merkwürdiges Verhalten', '2008-04-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (508, 506, 'Lucky', 'Was sollte uns am Wiederaufstieg hindern?', '2008-04-09', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (509, 506, 'Lothar', 'He, Lucky, ich dachte für die Formulierung Was sollte mich an XYZ hindern? hat Zille das Copyright', '2008-04-12', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (510, 506, 'Florian Bühler', 'Na ja, da fiele mir schon ein Verein ein...', '2008-04-12', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (511, 504, 'Dr. Wolfgang Baur', 'Sehr geehrter Herr Frank! In Ihrer Spielübersicht sind zwei Namen falsch: an Brett 4 hat für Inchenhofen nicht Richlich gespielt, sondern Hans-Peter Hoch, an Brett 5 nicht Hoch, sondern Dr. Wolfgang Baur - ich muß es wissen, denn ich war ja dabei!\r\nMit fr', '2008-04-16', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (512, 397, 'Uwe Linner', 'Lese Artikel heute zufällig !!\r\nFinde es gut das der Auslöser nicht gedrückt wurde. Sonst gäbe es ja ein Zielfoto und keine zwei neunte Plätze.\r\nGruß die 186', '2008-04-22', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (513, 507, 'Christoph Hahn', 'Au der Seite vom BSB ist der Kampf jetzt 4:3 für uns gewertet(!) - noch ne Version (vom 23.4.08)', '2008-04-23', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (514, 519, 'Andi', 'der Moment ist mir leider live entgangen. Danke also für das Diagramm! (-:', '2008-05-05', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (515, 536, 'Stefan', 'Nochmals Glückwunsch an Alle: die Zeit und Platzierung ist für unsere verjüngte und aufstrebende Mannschaft ein Erfolg!', '2008-06-16', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (516, 536, 'Lucky', 'Wenn die Abschnitte nicht so lang wären, würde ich auch mitlaufen', '2008-06-16', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (517, 536, 'Lothar', 'Großartig, Leute! Immerhin habt ihr 148 der 185 Teams hinter Euch gelassen!', '2008-06-17', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (518, 536, 'Lance', 'ach was Roland, keine falsche Bescheidenheit! Als amtierender Sieger des legendären Fette-Sau-Nachfolgers bist Du eigentlich gesetzt!', '2008-06-17', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_comments (id, nr, nameanswer, answer, createdate, creator, ip) VALUES (519, 536, 'Flo', 'Super Leistung, meinen Respekt! Da könnt Ihr von Glück (also nicht von dem Glück:-) reden, dass ich verletzt war und euch so die Zeit nicht versauen konnte..', '2008-06-18', 'ALTDATENÜBERNAHME PROWIDE', '127.0.0.1');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		mysql_query ("Delete FROM skk_comments WHERE nameanswer IS NULL OR answer IS NULL;", $con);
	}
?>
