<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################

	/*function GetCon()
	// Creates the database.
	{
		$curDB = "DB424698";
		$curUser = "U424698";

		// 1. Open connection object:
		if (!($conLocal = mysql_connect("localhost:/var/lib/mysql/mysql.sock", $curUser,"h!SWjuWW")))
		{
			echo("Server connection to database failed!<P>");
			echo mysql_error();
			return "";
		}

		$strSQL = "CREATE DATABASE IF NOT EXISTS ".$curDB;

		if (!mysql_query ($strSQL, $conLocal))
		{
			echo("Database delete error!<P>");
			echo mysql_error();
			return "";
		}


		// 2. Select database:
		if (!mysql_select_db ($curDB, $conLocal))
		{
			echo("Database selection error!<P>");
			echo mysql_error();
			return "";
		}

		// 3. Die Tabellen erstellen:
		// 3.1. Tabelle für die Mannschaften
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_teams (id int(11) NOT NULL auto_increment, team varchar(100) NOT NULL default '', league varchar(100) NOT NULL default '', P1 int(5) NOT NULL, P2 int(5) NOT NULL, P3 int(5) NOT NULL, P4 int(5) NOT NULL, P5 int(5), P6 int(5), P7 int(5), P8 int(5), P9 int(5), P10 int(5), P11 int(5), P12 int(5), P13 int(5), P14 int(5), P15 int(5), P16 int(5), season varchar(9) NOT NULL, createdate date NOT NULL, creator varchar(50) NOT NULL, modifeddate date, modifier varchar(50), del varchar(1) NOT NULL default 'N', PRIMARY KEY (id)) ENGINE=MyISAM DEFAULT COLLATE=latin1_german1_ci CHARSET=latin1;";
 
		if (!mysql_query ($strSQL, $conLocal))
		{
			echo("Database delete error!<P>");
			echo mysql_error();
			return "";
		}

		// 3.2. Tabelle für die Kommentare:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_members (id int(5) NOT NULL auto_increment, name varchar(100) character set latin1 collate latin1_german1_ci NOT NULL, vorname varchar(100) character set latin1 collate latin1_german1_ci NOT NULL, dwz int(4) NOT NULL default '0', mail varchar(255) character set latin1 collate latin1_german1_ci default NULL, telephone varchar(100) character set latin1 collate latin1_german1_ci default NULL, birthday date NOT NULL default '0000-00-00', pwd varchar(30) character set latin1 collate latin1_german1_ci NOT NULL, active varchar(1) character set latin1 collate latin1_german1_ci NOT NULL default 'J', createdate date NOT NULL, creator varchar(50) NOT NULL, modifeddate date, modifier varchar(50), del varchar(1) NOT NULL default 'N', PRIMARY KEY (id)) ENGINE=MyISAM  DEFAULT COLLATE=latin1_german1_ci CHARSET=latin1;";

		if (!mysql_query ($strSQL, $conLocal))
		{
			echo("Database delete error!<P>");
			echo mysql_error();
			return "";
		}

		// 3.3. Tabelle für die Zuordnung von Mannschaften und Mitgliedern:
		$strSQL ="CREATE TABLE IF NOT EXISTS skk_members_teams (id_member int(11) NOT NULL, id_team int(11) NOT NULL, position tinyint(1) NOT NULL, createdate date NOT NULL, creator varchar(50) NOT NULL, modifeddate date, modifier varchar(50), del varchar(1) NOT NULL default 'N', PRIMARY KEY (id_member, id_team)) ENGINE=MyISAM DEFAULT COLLATE=latin1_german1_ci CHARSET=latin1;";


		if (!mysql_query ($strSQL, $conLocal))
		{
			echo("Database delete error!<P>");
			echo mysql_error();
			return "";
		}

		// 3.4. Tabelle für die Inhaltsobjekte:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_content (id int(11) NOT NULL auto_increment, content_date date NOT NULL default '0000-00-00', title varchar(255) character set latin1 NOT NULL default '', Content blob NOT NULL, category varchar(100) character set latin1 NOT NULL default '', createdate date NOT NULL, creator varchar(50) NOT NULL, modifeddate date, modifier varchar(50), del varchar(1) NOT NULL default 'N', PRIMARY KEY (id)) ENGINE=MyISAM  DEFAULT COLLATE=latin1_german1_ci CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=252;";

		if (!mysql_query ($strSQL, $conLocal))
		{
			echo("Database delete error!<P>");
			echo mysql_error();
			return "";
		}

		// 3.5. Tabelle für die Kommentare
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_comments (id int(11) NOT NULL auto_increment, nr int(11) NOT NULL default '0', nameanswer varchar(255) character set latin1 collate latin1_german1_ci NOT NULL, answer varchar(255) character set latin1 collate latin1_german1_ci NOT NULL, answerdate datetime NOT NULL default '0000-00-00 00:00:00', ipaddress text character set latin1 collate latin1_german1_ci, os text character set latin1 collate latin1_german1_ci, PRIMARY KEY (id)) ENGINE=MyISAM  DEFAULT COLLATE=latin1_german1_ci CHARSET=latin1 AUTO_INCREMENT=544 ;";

		if (!mysql_query ($strSQL, $conLocal))
		{
			echo("Database delete error!<P>");
			echo mysql_error();
			return "";
		}

		// 3.6. Tabelle für die Ligen:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_leagues (id int(5) NOT NULL auto_increment, league varchar(100) NOT NULL default '', createdate date NOT NULL, creator varchar(50) NOT NULL, modifeddate date, modifier varchar(50), del varchar(1) NOT NULL default 'N', PRIMARY KEY (id)) ENGINE=MyISAM  DEFAULT COLLATE=latin1_german1_ci CHARSET=latin1 AUTO_INCREMENT=12 ;

		if (!mysql_query ($strSQL, $conLocal))
		{
			echo("Database delete error!<P>");
			echo mysql_error();
			return "";
		}


		// 3.7. Tabelle für die Ligen:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_news (id int(11) NOT NULL auto_increment, newsdate date NOT NULL default '0000-00-00', headline varchar(255) character set latin1 default NULL, headline2 varchar(255) character set latin1 default NULL, author varchar(100) character set latin1 default NULL, picture varchar(100) character set latin1 default NULL, text blob, shorttext varchar(255) character set latin1 default NULL, hits int(11) default NULL, answer1 blob, answer2blob, answer3 blob, answer4 blob, answer5 blob, newstable varchar(10) character set latin1 NOT NULL default '', category varchar(100) character set latin1 NOT NULL default '', content int(11) NOT NULL default '0', createdate date NOT NULL, creator varchar(50) NOT NULL, modifeddate date, modifier varchar(50), del varchar(1) NOT NULL default 'N', PRIMARY KEY (id)) ENGINE=MyISAM  DEFAULT COLLATE=latin1_german1_ci CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=522 ;";


		if (!mysql_query ($strSQL, $conLocal))
		{
			echo("Database delete error!<P>");
			echo mysql_error();
			return "";
		}

		// 3.8. Tabelle für die Partien:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_matches (id int(11) NOT NULL auto_increment, matchdate date NOT NULL default '0000-00-00', title varchar(100) NOT NULL default '',  shorttext varchar(255) NOT NULL default '', nomination blob NOT NULL, matchdata blob NOT NULL, moves blob NOT NULL, hits int(11) NOT NULL default '0', marks double NOT NULL default '0', votes int(11) NOT NULL default '0', createdate date NOT NULL, creator varchar(50) NOT NULL, modifeddate date, modifier varchar(50), del varchar(1) NOT NULL default 'N', PRIMARY KEY (id)) ENGINE=MyISAM  DEFAULT COLLATE=latin1_german1_ci CHARSET=latin1 AUTO_INCREMENT=81 ;";

		if (!mysql_query ($strSQL, $conLocal))
		{
			echo("Database delete error!<P>");
			echo mysql_error();
			return "";
		}

		// 3.9. Tabelle für die Termine
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_deadline (id int(11) NOT NULL auto_increment, deadlinedate date NOT NULL default '0000-00-00', deadline varchar(255) NOT NULL default '', kind varchar(255) NOT NULL default '', category varchar(100) NOT NULL default '', createdate date NOT NULL, creator varchar(50) NOT NULL, modifeddate date, modifier varchar(50), del varchar(1) NOT NULL default 'N', PRIMARY KEY (id)) ENGINE=MyISAM  DEFAULT COLLATE=latin1_german1_ci CHARSET=latin1 AUTO_INCREMENT=336 ;

		if (!mysql_query ($strSQL, $conLocal))
		{
			echo("Database delete error!<P>");
			echo mysql_error();
			return "";
		}


		return $conLocal;
	}*/
?>
