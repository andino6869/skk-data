<?
	function import_heads($con)
	{
		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1924', 'Schilling', NULL, 'Sch�rtl', 'Bauer', NULL, 'Egner', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1925', 'Egner', NULL, 'Sch�rtl', 'Buck', 'Riedelmeier', 'Hradetzky', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1926', 'Egner', NULL, 'Sch�rtl', 'Buck', 'Riedelmeier', 'Hradetzky', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1927', 'Egner', NULL, 'Sch�rtl', 'Schilling', 'Roth', 'Diebold', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1928', 'Mendle', NULL, 'Sch�rtl', 'Egner', 'Roth', 'Simon', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1929', 'Mendle', NULL, 'Thalmeier', 'Egner', 'Roth', 'Sch�rtl', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1930', 'Sch�rtl', NULL, 'Thalmeier', 'Braun', 'Schmid', 'Cepelak', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1931', 'Sch�rtl', NULL, 'Thalmeier', 'Braun', 'Schmid', 'Cepelak', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1932', 'Sch�rtl', NULL, 'Braun', 'Egner', NULL, 'Cepelak', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1933-1945', 'Keine Unterlagen (die entsprechenden Seiten sind aus dem Protokollbuch herausgerissen)', NULL, NULL, NULL, NULL, NULL, NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1946', 'Hochstatter', NULL, 'Wagner', 'Hochstatter', NULL, NULL, NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1947', 'Hochstatter', NULL, 'Wagner', 'Rabe Kretschmer', NULL, 'Told', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1948', 'Hochstatter', NULL, 'Wagner', 'Rabe', NULL, 'Told', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1949', 'Hochstatter', NULL, NULL, 'Schieg', NULL, NULL, NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1950', 'Keine Wahlen, keine Versammlung', NULL, NULL, NULL, 'Keine Wahlen, keine Versammlung', NULL, NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1951', 'Hochstatter', NULL, 'Schottenhammer', 'Stoppe', 'Riedelmeier', 'J.Birkle', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1952', 'Hochstatter', NULL, 'Schottenhammer', 'Stoppe, Slameka', 'Riedelmeier', 'J.Birkle', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1953', 'Hochstatter', NULL, 'W.Frank', 'Stoppe', 'Riedelmeier', 'Slamecka', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1954', 'Keine Versammlung', NULL, NULL, NULL, 'Keine Versammlung', NULL, NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1955', 'Hochstatter', NULL, 'W.Frank', 'Stoppe,E.G�nsler', 'Riedelmeier', 'Slamecka', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1956', 'Hochstatter', NULL, 'W.Frank', 'Stoppe,Kretschmer', 'Riedelmeier', 'Slamecka', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1957', 'Hochstatter', NULL, 'W.Frank', 'Dr.v.Wilpert,Stoppe', 'Riedelmeier', 'O.G�nsler', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1958', 'Hochstatter', NULL, 'W.Frank', 'E.G�nsler,Dr.v.Wilpert', 'Riedelmeier', 'O.G�nsler', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1959', 'Hochstatter', NULL, 'W.Frank', 'E.G�nsler,Dr.v.Wilpert', 'Riedelmeier', 'O.G�nsler', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1960', 'Hochstatter', NULL, 'W.Frank', 'Er.Bartel,E.G�nsler', 'Sileikis', 'O.G�nsler', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1961', 'Hochstatter', 'Stoppe', 'W.Frank', 'O.G�nsler,E.G�nsler', 'Riedelmeier, Sileikis', 'Er.Bartel', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1962', 'Hochstatter', 'Stoppe', 'W.Frank', 'Dr.v.Wilpert,Wei�', 'Riedelmeier', 'Stahl', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1963', 'Keine Versammlung', NULL, NULL, NULL, 'Keine Versammlung', NULL, '', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1964', 'Hochstatter', 'Er.Bartel', 'Lucht', 'Lucht,Dr.v.Wilpert', 'Riedelmeier,Sileikis', 'Kl�ber', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1965', 'Keine Versammlung', NULL, NULL, NULL, NULL, NULL, NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1966', 'Keine Versammlung', NULL, NULL, NULL, 'Keine Versammlung', NULL, NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1967', 'Hochstatter', 'Er.Bartel', 'Lucht', 'Lucht,Dr.v.Wilpert', 'Wei�,Sileikis', 'Kl�ber', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1968', 'Keine Versammlung', NULL, NULL, NULL, 'Keine Versammlung', NULL, NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1969', 'Er.Bartel', 'Stoppe', 'Lucht', 'Lucht,Dr.v.Wilpert', 'Wei�', 'Kl�ber', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1970', 'Er.Bartel', 'Hochstatter', 'Lucht', 'Lucht,Dr.v.Wilpert', 'Wei�', 'Kl�ber', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1971', 'Er.Bartel', 'Hochstatter', 'Lucht', 'Lucht,Kretschmer', 'Wei�', 'Kl�ber', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1972', 'Er.Bartel', 'Wei�', 'Lucht', 'Lucht,Kretschmer', 'Wei�', 'Kl�ber', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1973', 'Er.Bartel', 'Wei�', 'Lucht', 'Lucht,Kretschmer', 'Wei�', 'Kl�ber', NULL, '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1974', 'Er.Bartel', 'Wei�', 'Lucht', 'Lucht,Kretschmer', 'Wei�', 'Kl�ber', 'E.Frank,Benesch', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1975', 'Er.Bartel', 'Wei�', 'B.Stubenrauch', 'E.Frank,E.G�nsler', 'Wei�', 'B.Stubenrauch', 'Benesch,Mayinger', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1976', 'Er.Bartel', 'Wei�', 'B.Stubenrauch', 'E.Frank, E.G�nsler', 'Wei�, Kumpfe', 'B.Stubenrauch', 'Benesch, B.Stubenrauch', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1977', 'Er.Bartel', 'Wei�', 'B.Stubenrauch', 'E.G�nsler, E.Frank', 'Wei�, Kumpfe', 'B.Stubenrauch', 'Benesch, B.Stubenrauch', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1978', 'Er.Bartel', 'Merkt', 'B.Stubenrauch', 'E.G�nsler, E.Frank', 'Kumpfe, El.Bartel', 'B.Stubenrauch', 'B.Stubenrauch', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1979', 'Er.Bartel', 'Merkt', 'B.Stubenrauch', 'E.Frank', 'El.Bartel', 'B.Stubenrauch', 'B.Stubenrauch', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1980', 'Er.Bartel', 'Merkt', 'B.Stubenrauch', 'E.Frank', 'El.Bartel', 'B.Stubenrauch', 'Zillmann', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1981', 'Er.Bartel', 'Merkt', 'B.Stubenrauch', 'E.Frank', 'El.Bartel', 'B.Stubenrauch', 'A.Bartel', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1982', 'Schury', 'Merkt', 'B.Stubenrauch', 'Zillmann', 'El.Bartel', 'B.Stubenrauch', 'A.Bartel', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1983', 'E.Frank', 'Merkt', 'B.Stubenrauch', 'El.Bartel', 'El.Bartel', 'B.Stubenrauch', 'A.Bartel', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1984', 'E.Frank', 'Merkt', 'B.Stubenrauch', 'El.Bartel', 'Bacher', 'El.Bartel', 'B.Strohmeier', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1986', 'E.Frank', 'Zillmann', 'B.Stubenrauch', 'El.Bartel', 'Bacher', 'El.Bartel', 'B.Strohmeier', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1988', 'E.Frank', 'Zillmann', 'B.Stubenrauch', 'El.Bartel', 'St�r, W�nsch', 'El.Bartel', 'Buchert', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1990', 'E.Frank', 'Zillmann', 'W�nsch, Vo�', 'Vo�, El.Bartel', 'St�r', 'El.Bartel', 'Matevzic', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1992', 'E.Frank', 'Zillmann', 'Vo�', 'Schneider, Vo�', 'Buchert', 'El.Bartel', 'Gl�ck', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1994', 'E.Frank', 'Gl�ck', 'Vo�', 'Vo�', 'Buchert', 'El.Bartel', 'Schneider', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1996', 'E.Frank', 'Gl�ck', 'Gergen', 'Vo�', 'Buchert', 'El.Bartel', 'Vuckovic', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		$strSQL = "INSERT INTO skk_heads (year, firsthead, secondhead, cashier, gameleader, stuffhead, writehead, youthhead, createdate, creator) VALUES ('1998', 'E.Frank', 'Gl�ck', 'Gergen', 'St�dele, F.Wieser', 'Buchert', 'El.Bartel', 'Reichardt', '2008-12-05', 'ALTDATEN�BERNAHME PROWIDE');";
		if (!mysql_query ($strSQL, $con))
		{
			echo mysql_error()."<BR>";
			echo $strSQL."<BR>";
			exit;
		}


		mysql_query ("Delete FROM skk_heads WHERE firsthead IS NULL;", $con);
	}
?>
