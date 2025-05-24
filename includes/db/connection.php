<?PHP
	// ###################################
	// Modul-Update August 2019
	// ###################################
	function GetCon()
	// Creates the database.
	{
		$curDB = "DB424698";
		$curUser = "U424698";

		// 1. Open connection object:
		// Version STRATO:
		//if (!($conLocal = mysql_connect("rdbms.strato.de", $curUser,"h!SWjuWW")))
		// Version LOCALHOST:
		// if (!($conLocal = mysql_connect("localhost:/var/lib/mysql/mysql.sock", $curUser,"h!SWjuWW")))
		// VERSION SKK:
		if (!($conLocal = mysqli_connect("localhost", $curUser,"h!SWjuWW")))
		{
			echo("Server connection to database failed!<P>");
			echo mysqli_error($conLocal);
			return "";
		}

		$strSQL = "CREATE DATABASE IF NOT EXISTS ".$curDB;

		if (!(mysqli_query ($conLocal, $strSQL)))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
		}


		// 2. Select database:
		if (!mysqli_select_db ($conLocal, $curDB))
		{
			echo("Database selection error!<P>");
			echo mysqli_error($conLocal);
			return "";
		}

		// 3. Die Tabellen erstellen:
		// 3.1. Tabelle für die Mannschaften
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_teams (id int(11) NOT NULL auto_increment, team varchar(100) ";
		$strSQL = $strSQL."NOT NULL default '', league varchar(100) NOT NULL default '', numberofplayers int(1) default 8 NOT NULL, P1 int(5) default 0, ";
		$strSQL = $strSQL."P2 int(5) default 0, P3 int(5) default 0, P4 int(5) default 0, P5 int(5) default 0, ";
		$strSQL = $strSQL."P6 int(5) default 0, P7 int(5) default 0, P8 int(5) default 0, P9 int(5) default 0, ";
		$strSQL = $strSQL."P10 int(5) default 0, P11 int(5) default 0, P12 int(5) default 0, P13 int(5) default 0, ";
		$strSQL = $strSQL."P14 int(5) default 0, P15 int(5) default 0, P16 int(5) default 0, season varchar(9) ";
		$strSQL = $strSQL."NOT NULL, createdate datetime NOT NULL, creator varchar(50) NOT NULL, modifieddate ";
		$strSQL = $strSQL."datetime, modifier varchar(50), del varchar(1) NOT NULL default 'N', PRIMARY KEY ";
		$strSQL = $strSQL."(id, createdate, del)) ENGINE=MyISAM DEFAULT COLLATE=latin1_german1_ci CHARSET=latin1;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error: $strSQL<P>");
			echo mysqli_error($conLocal);
			return "";
		}

		// 3.2. Tabelle für die Mitglieder:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_members (id int(5) NOT NULL auto_increment, ";
		$strSQL = $strSQL."name varchar(50) character set latin1 collate latin1_german1_ci ";
		$strSQL = $strSQL."NOT NULL, vorname varchar(50) character set latin1 collate ";
		$strSQL = $strSQL."latin1_german1_ci NOT NULL, dwz varchar(10) default '0', ";
		$strSQL = $strSQL."elo varchar(10) default '0', title varchar(6), sex varchar(1), mail ";
		$strSQL = $strSQL."varchar(100) character set latin1 collate latin1_german1_ci default ";
		$strSQL = $strSQL."NULL, telephone varchar(50) character set latin1 collate latin1_german1_ci default ";
		$strSQL = $strSQL."NULL, mobile varchar(50) character set latin1 collate latin1_german1_ci default ";
		$strSQL = $strSQL."NULL, addrstreet varchar(50) character set latin1 collate latin1_german1_ci default ";
		$strSQL = $strSQL."NULL, addrzipcode varchar(5) character set latin1 collate latin1_german1_ci default ";
		$strSQL = $strSQL."NULL, addrcity varchar(50) character set latin1 collate latin1_german1_ci default ";
		$strSQL = $strSQL."NULL, entrydate timestamp not null default now(), ";
		$strSQL = $strSQL."birthdate date, birthplace varchar(50) ";
		$strSQL = $strSQL."character set latin1 collate latin1_german1_ci, info varchar(100) ";
		$strSQL = $strSQL."character set latin1 collate latin1_german1_ci, pwd varchar(30) ";
		$strSQL = $strSQL."character set latin1 collate latin1_german1_ci, active varchar(1) ";
		$strSQL = $strSQL."character set latin1 collate latin1_german1_ci NOT NULL default 'N', ";
		$strSQL = $strSQL."lastlogin datetime, ip varchar(25), picture varchar(255), sendmailifnewcomment varchar(1) default 'N', createdate datetime NOT NULL, ";
		$strSQL = $strSQL."creator varchar(50) NOT NULL, modifieddate datetime, modifier varchar(50), ";
		$strSQL = $strSQL."del varchar(1) NOT NULL default 'N', membertype varchar(1) NOT NULL default 'A', UseCMS varchar(1) NOT NULL default 'N', PRIMARY KEY (id, createdate, del)) ";
		$strSQL = $strSQL."ENGINE=MyISAM COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error: $strSQL<P>");
			echo mysqli_error($conLocal);
			return "";
		}
/*
		// 3.2.1. Die Defaultmitglieder:
		if (bCheckMembers($conLocal) == 0)
		{
			// Es müssen die Mitglieder angelegt werden!
			// 3.2.2. Hierzu prüfen, ob die Liste des deutschen Schachbunds verfügbar ist:
			if (IsUrlAvailable("schachbund.de")=="TRUE")
			{
				$f="http://www.schachbund.de/dwz/db/verein-prn.html?zps=27113";

				// Den aktuelle Stand lokal in das DWZ - Verzeichnis sichern:
				$strContent = implode("", file("http://www.schachbund.de/verein.html?zps=27113&template=/template/drucker.tpl"));

				if (is_file("dwz/dwz.htm"))
				{
					$f1 = fopen("dwz/dwz.htm", "w");
				}
				else
				{
					if (is_file("../sites/dwz/dwz.htm"))
					{
						$f1 = fopen("../sites/dwz/dwz.htm", "w");
					}
					else
					{
						$f1 = fopen("../../sites/dwz/dwz.htm", "w");
					}
				}

				fputs($f1, $strContent);
				fclose($f1);

				// 3.2.3.) Inhalt aus der Datei in ein Array einlesen:
				if (is_file("dwz/dwz.htm"))
				{
					$f1 ="dwz/dwz.htm";
				}
				else
				{
					if (is_file("../sites/dwz/dwz.htm"))
					{
						$f1 = "../sites/dwz/dwz.htm";
					}
					else
					{
						$f1 = "../../sites/dwz/dwz.htm";
					}
				}
				$file=file ($f);

				// Marker setzen, wann mit dem Schreibvorgang begonnen werden soll:
				$bStartWriting="FALSE";
				$intCount = 0;
				$strSQL = "";

				// Die Feldinhalte:
				$id = "";
				$firstname = "";
				$lastname = "";
				$sex = "";
				$dwz = "";
				$elo = "";
				$title = "";

				for($i=0;$i<=count($file)-1;$i++)
				{
					// Zeile zum ausgeben?
					if ($bStartWriting=="FALSE")
					{
						// Soll eine Ausgabe erfolgen?
						$strLine = strtolower($file[$i]);

						// Der DWZ - Stand:
						if (strpos($strLine, "fide-titel")>0)
						{
							$bStartWriting="TRUE";
						}
					}
					else
					{
						// Wir sind in der Ausgabephase:
						// Hier der Orginalinhalt vom deutschen Schachbund:
						  <tr>
					        <td class="dwz_tabtitel" align="center">Pl.</td>
					        <td class="dwz_tabtitel" align="center">Sta-<br>tus</td>
					        <td class="dwz_tabtitel" align="left">Spielername</td>
					        <td class="dwz_tabtitel" align="center">Geschl.</td>
					        <td class="dwz_tabtitel" align="center">Letzte<br>Auswert.</td>
					        <td class="dwz_tabtitel" align="center">DWZ</td>
					        <td class="dwz_tabtitel" align="center">FIDE-Elo</td>
					        <td class="dwz_tabtitel" align="center">FIDE-Titel</td>
					      </tr><tr>
						$strLine = strtolower($file[$i]);

						// Das Ende der Tabelle erreicht?
						$pos=strpos($strLine, "</table>");

						// Wurde die Position gefunden?
						if (!($pos === false))
						{
							// Aufhören!
							break;
						}

						// Den Link auf den Spieler korrekt setzen:
						$pos=strpos($strLine, "</tr><tr>");

						// Wurde die Position gefunden?
						if (!($pos === false))
						{
							// SQL - Anweisung ausführen, falls möglich:
							if (!($lastname == ""))
							{
								$now = date("Y-m-d H:i:s");
								$strSQL = "INSERT INTO skk_members (id, name, vorname, active, sex, dwz, elo, title, createdate, creator)";
								$strSQL = $strSQL." VALUES ($id, '$lastname', '$firstname', 'N', '$sex', '$dwz', '$elo', $title, '$now', 'SYSTEM_DWZ_GERMAN')";


								if (!mysqli_query ($conLocal, $strSQL))
								{
									echo("Database insert error: $strSQL<P>");
									echo mysqli_error($conLocal);
									return "";
								}

								// Die Feldinhalte wieder zurücksetzen:
								$id = "";
								$firstname = "";
								$lastname = "";
								$sex = "";
								$dwz = "";
								$elo = "";
								$title = "";
							}
							// Den Counter für die Datenposition zurücksetzen:
							$intCount=0;
						}
						else
						{
							// Wir befinden uns an einer Datenposition!
							$intCount = $intCount + 1;

							// Unzulässige Inhalte entfernen:
							$strLine = $file[$i];
							$strLine = trim(strip_tags($strLine));
							$strLine = str_replace(chr(10), " ", $strLine);
							$strLine = str_replace(chr(13), " ", $strLine);
							$strLine = str_replace("&ouml;", "ö", $strLine);
							$strLine = str_replace("&auml;", "ä", $strLine);
							$strLine = str_replace("&uuml;", "ü", $strLine);
							$strLine = str_replace("&Ouml;", "Ö", $strLine);
							$strLine = str_replace("&Auml;", "Ä", $strLine);
							$strLine = str_replace("&Uuml;", "Ü", $strLine);
							$strLine = str_replace("&szlig;", "ß", $strLine);
							$strLine = str_replace("&nbsp;", " ", $strLine);
							$strLine = mysqli_real_escape_string($strLine, $conLocal);


							switch ($intCount)
							{
								case 1:
									// Nummer:
									$id = str_replace(".", "", $strLine);
									break;

								case 2:
									// Nothing to do!
									break;

								case 3:
									// Name:
									$arr = explode(",", $strLine);

									// Nachname:
									$lastname = $arr[0];

									// Vorname:
									if (count($arr)>1)
									{
										$firstname = $arr[1];
									}

									// Titel?
									if (count($arr)>2)
									{
										$firstname = $firstname.", ".$arr[2];
									}
									break;

								case 4:
									// Geschlecht:
									$sex = strtoupper(trim($strLine));

									if ($sex == "")
									{
										$sex = "M";
									}
									else
									{
										$sex = "W";
									}

									break;

								case 5:
									// Nothing to do!
									break;

								case 6:
									$dwz = $strLine;

									break;

								case 7:
									$elo = $strLine;
									break;

								case 8:
									if (($strLine == "") || ($strLine == " "))
									{
										$title = "NULL";
									}
									else
									{
										$title = "'".$strLine."'";
									}

									break;
							}
						}
					}
				}
				// Jetzt ein UPDATE für alle Benutzer, die zugreifen dürfen:
				$strSQL = "UPDATE skk_members SET active='J', pwd='start123' WHERE name='Frank' AND vorname='Eckhardt'";

				if (!mysqli_query ($conLocal, $strSQL))
				{
					// Nothing to do!
					echo $strSQL."<BR>";
					echo mysqli_error($conLocal)."<BR>";
				}

				$strSQL = "UPDATE skk_members SET active='J', pwd='start123' WHERE name='Schneider' AND vorname='Stefan'";

				if (!mysqli_query ($conLocal, $strSQL))
				{
					// Nothing to do!
					echo mysqli_error($conLocal);
				}

				$strSQL = "UPDATE skk_members SET active='J', pwd='start123' WHERE name='Bartel' AND vorname='Elmar'";

				if (!mysqli_query ($conLocal, $strSQL))
				{
					// Nothing to do!
					echo mysqli_error($conLocal);
				}

				$strSQL = "UPDATE skk_members SET active='J', pwd='start123' WHERE name='Stör' AND vorname='Andreas'";

				if (!mysqli_query ($conLocal, $strSQL))
				{
					// Nothing to do!
					echo mysqli_error($conLocal);
				}

				$strSQL = "UPDATE skk_members SET active='J', pwd='start123' WHERE name='Stoer' AND vorname='Andreas'";

				if (!mysqli_query ($conLocal, $strSQL))
				{
					// Nothing to do!
					echo mysqli_error($conLocal);
				}

				$strSQL = "UPDATE skk_members SET active='J', pwd='start123' WHERE name='Weimer' AND vorname='Lothar'";

				if (!mysqli_query ($conLocal, $strSQL))
				{
					// Nothing to do!
					echo mysqli_error($conLocal);
				}

			}
			else
			{
				// Die WEB - Seite ist nicht verfügbar!
				// Die Daten müssen händisch eingetragen werden!
				$now = date("Y-m-d H:i:s");
				$strSQL = "INSERT INTO skk_members (id, name, vorname, active, pwd, createdate, creator)";
				$strSQL = $strSQL." VALUES (1, 'Frank', 'Eckhardt', 'J', 'start123', '$now', 'SYSTEM')";

				if (!mysqli_query ($conLocal, $strSQL))
				{
					// Nothing to do!
				}

				$strSQL = "INSERT INTO skk_members (id, name, vorname, active, pwd, createdate, creator)";
				$strSQL = $strSQL." VALUES (2, 'Bartel', 'Elmar', 'J', 'start123', '$now', 'SYSTEM')";

				if (!mysqli_query ($conLocal, $strSQL))
				{
					// Nothing to do!
				}

				$strSQL = "INSERT INTO skk_members (id, name, vorname, active, pwd, createdate, creator)";
				$strSQL = $strSQL." VALUES (3, 'Stör', 'Andreas', 'J', 'start123', '$now', 'SYSTEM')";

				if (!mysqli_query ($conLocal, $strSQL))
				{
					// Nothing to do!
				}

				$strSQL = "INSERT INTO skk_members (id, name, vorname, active, pwd, createdate, creator)";
				$strSQL = $strSQL." VALUES (4, 'Schneider', 'Stefan', 'J', 'start123', '$now', 'SYSTEM')";

				if (!mysqli_query ($conLocal, $strSQL))
				{
					// Nothing to do!
				}

				$strSQL = "INSERT INTO skk_members (id, name, vorname, active, pwd, createdate, creator)";
				$strSQL = $strSQL." VALUES (5, 'Städele', 'Thomas', 'J', 'start123', '$now', 'SYSTEM')";

				if (!mysqli_query ($conLocal, $strSQL))
				{
					// Nothing to do!
				}

				$strSQL = "INSERT INTO skk_members (id, name, vorname, active, pwd, createdate, creator)";
				$strSQL = $strSQL." VALUES (6, 'Weimer', 'Lothar', 'J', 'start123', '$now', 'SYSTEM')";

				if (!mysqli_query ($conLocal, $strSQL))
				{
					// Nothing to do!
				}

				$strSQL = "INSERT INTO skk_members (id, name, vorname, active, pwd, createdate, creator)";
				$strSQL = $strSQL." VALUES (7, 'Buchberger', 'Markus', 'J', 'start123', '$now', 'SYSTEM')";

				if (!mysqli_query ($conLocal, $strSQL))
				{
					// Nothing to do!
				}
			}
		}*/

		// UPDATE für das CMS - SYSTEM:
		// Andi
		$strSQL = "UPDATE skk_members SET usecms = 'N' WHERE usecms IS NULL;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error: $strSQL<P>");
			echo mysqli_error($conLocal);
			return "";
		}

		// ####################################
		// 3.4. Tabelle für die Inhaltsobjekte:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_content (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."contentdate timestamp not null default now(), title varchar(255) ";
		$strSQL = $strSQL."character set latin1 NOT NULL default '', content blob NOT NULL, ";
		$strSQL = $strSQL."category varchar(100) character set latin1 NOT NULL default '', ";
		$strSQL = $strSQL."createdate datetime NOT NULL, creator varchar(50) NOT NULL, ";
		$strSQL = $strSQL."modifieddate datetime, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM  DEFAULT ";
		$strSQL = $strSQL."CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=252;";

		if (!(mysqli_query ($conLocal, $strSQL)))
		{
			echo("Database create error: $strSQL<P>");
			echo mysqli_error($conLocal);
			return "";
		}

		// ###############################
		// 3.5. Tabelle für die Kommentare
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_comments (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."nr int(11) NOT NULL default '0', nameanswer varchar(255) character ";
		$strSQL = $strSQL."set latin1 collate latin1_german1_ci, answer text ";
		$strSQL = $strSQL."character set latin1 collate latin1_german1_ci, createdate ";
		$strSQL = $strSQL."datetime NOT NULL, creator varchar(50) character set latin1 collate ";
		$strSQL = $strSQL."latin1_german1_ci, modifieddate datetime, modifier varchar(50), ";
		$strSQL = $strSQL."del varchar(1) NOT NULL default 'N', ip varchar(20), os text character set ";
		$strSQL = $strSQL."latin1 collate latin1_german1_ci, PRIMARY KEY (id, createdate, del)) ";
		$strSQL = $strSQL."ENGINE=MyISAM COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=544 ;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error: $strSQL<P>");
			echo mysqli_error($conLocal);
			return "";
		}

		// ###############################
		// 3.5.1. Tabelle für die einzelnen Kommentaranfragen
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_comments_requests (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."createdate ";
		$strSQL = $strSQL."datetime NOT NULL, creator varchar(50) character set latin1 collate ";
		$strSQL = $strSQL."latin1_german1_ci, modifieddate datetime, modifier varchar(50), ";
		$strSQL = $strSQL."del varchar(1) NOT NULL default 'N', ip varchar(20), os text character set ";
		$strSQL = $strSQL."latin1 collate latin1_german1_ci, PRIMARY KEY (id, createdate, del)) ";
		$strSQL = $strSQL."ENGINE=MyISAM COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=544 ;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error: $strSQL<P>");
			echo mysqli_error($conLocal);
			return "";
		}


		// ###############################
		// 3.6. Tabelle für die Ligen:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_leagues (id int(5) NOT NULL auto_increment, ";
		$strSQL = $strSQL."league varchar(100) NOT NULL default '', createdate datetime NOT ";
		$strSQL = $strSQL."NULL, creator varchar(50) NOT NULL, modifieddate datetime, ";
		$strSQL = $strSQL."modifier varchar(50), del varchar(1) NOT NULL default 'N', ";
		$strSQL = $strSQL."PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12" ;

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// ###############################
		// 3.7. Tabelle für die Neuigkeiten:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_news (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."newsdate timestamp not null default now(), headline varchar(255) ";
		$strSQL = $strSQL."character set latin1 default NULL, headline2 varchar(255) character ";
		$strSQL = $strSQL."set latin1 default NULL, author varchar(100) character set latin1 ";
		$strSQL = $strSQL."default NULL, picture varchar(100) character set latin1 default ";
		$strSQL = $strSQL."NULL, text blob, shorttext varchar(255) character set latin1 ";
		$strSQL = $strSQL."default NULL, hits int(11) NOT NULL DEFAULT 0, ";
		$strSQL = $strSQL."newstable varchar(10) character set latin1 default '', ";
		$strSQL = $strSQL."category varchar(100) character set latin1 default '', ";
		$strSQL = $strSQL."contentid int(11), teamid int(11), deadlinedate datetime, fadeifdeadlinereached ";
		$strSQL = $strSQL."varchar(1) NOT NULL default'N', createdate datetime NOT NULL, ";
		$strSQL = $strSQL."creator varchar(50) NOT NULL, modifieddate datetime, modifier ";
		$strSQL = $strSQL."varchar(50), del varchar(1) NOT NULL default 'N', rssguid varchar(50), PRIMARY KEY ";
		$strSQL = $strSQL."(id, createdate, del)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci AUTO_INCREMENT=522 ;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// Update für neues Kommentarfeld:
        // Andi  
		$strSQL = "UPDATE skk_news SET allowcomment='N' WHERE allowcomment IS NULL;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error: $strSQL<P>");
			echo mysqli_error($conLocal);
			return "";
		}

		// ######################################################
		// 3.7.1. Tabelle für die Zugriffszähler der Neuigkeiten:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_news_hits (news_id int(11) NOT NULL , ";
		$strSQL = $strSQL."hitdate timestamp not null default now(), hits_old int(11) NOT NULL, ";
		$strSQL = $strSQL."hits_new int(11) NOT NULL, ip varchar(20), os text character set ";
		$strSQL = $strSQL."latin1 collate latin1_german1_ci, pc text character set ";
		$strSQL = $strSQL."latin1 collate latin1_german1_ci, createdate datetime NOT NULL default now(), ";
		$strSQL = $strSQL."creator varchar(50) NOT NULL, modifieddate datetime, modifier ";
		$strSQL = $strSQL."varchar(50), del varchar(1) NOT NULL default 'N') ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1";

		if (!mysqli_query ($conLocal, $strSQL))
		{
		    echo("Database create error!<P>");
		    echo "<BR>SQL: ".$strSQL."<BR>";
		    echo mysqli_error($conLocal);
		    return "";
		}
		
		// ###############################
		// 3.8. Tabelle für die Partien:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_matches (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."matchdate timestamp not null default now(), title varchar(100) ";
		$strSQL = $strSQL."NOT NULL default '',  shorttext varchar(255) NOT NULL default '', ";
		$strSQL = $strSQL."nomination blob NOT NULL, matchdata blob NOT NULL, moves blob NOT ";
		$strSQL = $strSQL."NULL, hits int(11) NOT NULL default '0', marks double NOT NULL ";
		$strSQL = $strSQL."default '0', votes int(11) NOT NULL default '0', createdate ";
		$strSQL = $strSQL."datetime NOT NULL, creator varchar(50) NOT NULL, modifieddate ";
		$strSQL = $strSQL."datetime, modifier varchar(50), del varchar(1) NOT NULL default ";
		$strSQL = $strSQL."'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}


		// 3.9. Tabelle für die Termine
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_deadline (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."deadlinedate timestamp not null default now(), deadline varchar(255) ";
		$strSQL = $strSQL."NOT NULL default '', kind varchar(255) NOT NULL default '', ";
		$strSQL = $strSQL."category varchar(100) NOT NULL default '', createdate datetime ";
		$strSQL = $strSQL."NOT NULL, creator varchar(50) NOT NULL, modifieddate date, ";
		$strSQL = $strSQL."modifier varchar(50), del varchar(1) NOT NULL default 'N', ";
		$strSQL = $strSQL."PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM COLLATE=latin1_german1_ci DEFAULT ";
		$strSQL = $strSQL."CHARSET=latin1 AUTO_INCREMENT=336";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}


		// 3.10. Tabelle für die Downloads:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_downloads (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."viewname varchar(100) NOT NULL, filename varchar(255) NOT NULL, ";
		$strSQL = $strSQL."expiredate date NOT NULL, category varchar(20) NOT NULL, createdate datetime NOT NULL, creator ";
		$strSQL = $strSQL."varchar(50) NOT NULL, modifieddate date, modifier varchar(50), ";
		$strSQL = $strSQL."del varchar(1) NOT NULL default 'N', PRIMARY KEY (id, createdate, ";
		$strSQL = $strSQL."del)) ENGINE=MyISAM COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// 3.11. Tabelle für die Jugendseite:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_youth (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."text blob, createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// Den Standardseiteninhalt hinzufügen, falls nötig:
		$strSQL = "select id FROM skk_youth WHERE del='N' AND modifieddate IS NULL;";

		$result = mysqli_query($conLocal, $strSQL);
		$num = mysqli_num_rows($result);

		// Wurden Datensätze gefunden?
		if ($num == 0)
		{
			// Daten müssen erst noch geschrieben werden:
			$now = date("Y-m-d H:i");

			$strSQL = "<IMG SRC='../pics/forms/jugendschach.jpg' width=400 border=1><BR><BR>";
			$strSQL = $strSQL."<SPAN CLASS=he2>Infos zum Training und Jugendnachmittag</SPAN><BR><BR>";
			$strSQL = $strSQL."<B>Wann?</B><BR><BR>";
			$strSQL = $strSQL."Trainingstermine:<BR><BR>";
			$strSQL = $strSQL."<U>Dienstag von 18:30 bis 20:00 Uhr: </U><BR>";
			$strSQL = $strSQL."<IMG SRC='../pics/figures/koenig_weiss.gif'> Gruppe für jugendliche Mannschaftsspieler (Königsgruppe) --> Paul Demel <IMG SRC='../pics/figures/koenig_schwarz.gif'><BR>";
			$strSQL = $strSQL."Dazu diverse Vorträge der Kriegshaber Spitzenspieler zu individuellen Zeiten.<BR><BR>";
			$strSQL = $strSQL."<U>Mittwoch von 18:00 bis 20:00 Uhr: </U><BR>";
			$strSQL = $strSQL."<IMG SRC=".chr(34)."../pics/figures/turm_weiss.gif".chr(34)."> Gruppe für Kinder (Turmgruppe) --> Viktor Kaiser, Rosemarie Sodbakhsh und Peter Reichhardt <IMG SRC='../pics/figures/turm_schwarz.gif'> <BR><BR>";
			$strSQL = $strSQL."<U>Freitag von 17:00 bis 19:00 Uhr: </U><BR>";
			$strSQL = $strSQL."<IMG SRC='../pics/figures/bauer_weiss.gif'> Gruppe für Kinder (Bauerngruppe) --> Karin Grabowski <IMG SRC='../pics/figures/bauer_schwarz.gif'><BR>";
			$strSQL = $strSQL."<IMG SRC='../pics/figures/springer_weiss.gif'> Gruppe für Kinder (Springergruppe) --> David Schury <IMG SRC='../pics/figures/springer_schwarz.gif'><BR><BR>";
			$strSQL = $strSQL."<U>Freitag von 17:30 bis 19:30 Uhr:</U><BR>";
			$strSQL = $strSQL."<IMG SRC='../pics/figures/dame_weiss.gif'> Gruppe für Kinder (Damengruppe) --> Peter Grabowski <IMG SRC='../pics/figures/dame_schwarz.gif'><BR><BR>";
			$strSQL = $strSQL."<b>Wo?</b><BR><BR>";
			$strSQL = $strSQL."Beim Schachklub Kriegshaber, im Alten Zollhaus, Ulmer Str. 182, 86156 Augsburg.<BR>";
			$strSQL = $strSQL."Telefon: 0821-401267 <A HREF='../sites/journey.php'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Anfahrtskizze</A><BR><BR><BR>";
			$strSQL = $strSQL."<b>Wer?</b><BR><BR>";
			$strSQL = $strSQL."Unser Jugendleiter <B>Markus Buchberger</B> ist für die Jugendarbeit verantwortlich.";
			$strSQL = $strSQL."Dabei wird er von <B>Karin und Peter Grabowski, Paul Demel, David Schury, Viktor Kaiser, Rosemarie Sodbakhsh</B> und <B>Peter Reichhardt</B>";
			$strSQL = $strSQL."unterstützt, die auch erfahrene Vereinsspieler in unserem Klub sind. Weitere Unterstützung erfolgt durch weitere aktive Mitglieder.<BR><BR>";
			$strSQL = $strSQL."&nbsp; <A HREF='../sites/youth_ranking.php'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Jugendrangliste und Jugendliche ohne DWZ</A><BR>";

			$strSQL = mysqli_real_escape_string($conLocal, $strSQL);
			$strSQL = "INSERT INTO skk_youth (text, createdate, creator) VALUES ('".$strSQL."', ";
			$strSQL = $strSQL."'$now', 'SYSTEM');";

			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}
		}

		// 3.12. Tabelle für die Links:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_links (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."text blob, createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// Den Standardseiteninhalt hinzufügen, falls nötig:
		$strSQL = "select id FROM skk_links WHERE del='N' AND modifieddate IS NULL;";

		$result = mysqli_query ($conLocal, $strSQL);
		$num = mysqli_num_rows($result);

		// Wurden Datensätze gefunden?
		if ($num == 0)
		{
			// Daten müssen erst noch geschrieben werden:
			$now = date("Y-m-d H:i");

			$strSQL = "<SPAN CLASS=he1>Links</SPAN><BR><BR>";
			$strSQL = $strSQL."<SPAN CLASS='red_head'>Schachvereine in Schwaben</SPAN><HR noshade color=cc3300 size=1>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.sg-augsburg.de' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> SG Augsburg</a><BR>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.hjk-web.de/' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> SC Lechhausen</a><BR>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.sk-caissa.de/' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> SK Caissa Augsburg</a><BR>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.tsvhaunstetten.de/schach/schach.htm' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> TSV&nbsp;Haunstetten</a><BR>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.schachkomet.de/bsga.htm' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Blindenschachgruppe&nbsp;Augsburg</a><BR>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.bc-aichach.de/schach/frameset_schach.htm' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> BC&nbsp;Aichach</a><BR>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.tsv-steppach.de/html/schach.html' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> TSV&nbsp;Steppach</a><BR>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.svthierhaupten.de/schachabteilung/schach.htm' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> SV&nbsp;Thierhaupten</a><BR>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.scdillingen.de/' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> SK Dillingen</a><BR>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.reis-home.de' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> SK Kissing </a><BR>";
			$strSQL = $strSQL."<BR><BR>";
			$strSQL = $strSQL."<SPAN CLASS='red_head'>Verb&auml;nde</SPAN><HR noshade color=cc3300 size=1>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.fide.com' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Fide Online</a><BR>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.schachbund.de' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Deutscher Schachbund</a><BR>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.schachbund-bayern.de' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Bayerischer Schachbund</a><BR>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.schachbezirksverband-schwaben.de/' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Bezirksverband Schwaben</a><BR>";
			$strSQL = $strSQL."&nbsp; <a href='http://www.kreisverband-augsburg.jido.com' target='_blank'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Kreisverband Augsburg</a><BR>";

			$strSQL = mysqli_real_escape_string($conLocal, $strSQL);
			$strSQL = "INSERT INTO skk_links (text, createdate, creator) VALUES ('".$strSQL."', ";
			$strSQL = $strSQL."'$now', 'SYSTEM');";

			if (!mysqli_query ($strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}
		}

		// 3.13. Tabelle für Wir über uns:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_about (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."text blob, createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// Den Standardseiteninhalt hinzufügen, falls nötig:
		$strSQL = "select id FROM skk_about WHERE del='N' AND modifieddate IS NULL;";

		$result = mysqli_query ($conLocal, $strSQL);
		$num = mysqli_num_rows($result);

		// Wurden Datensätze gefunden?
		if ($num == 0)
		{
			// Daten müssen erst noch geschrieben werden:
			$now = date("Y-m-d H:i");

			$strSQL ="<SPAN CLASS=he1>Wir über uns</SPAN><BR><BR>";
			$strSQL = $strSQL."<IMG SRC='../pics/forms/about_verein.jpg' width=400 border=1><BR><BR>";
			$strSQL = $strSQL."<DIV ALIGN=JUSTIFY>";
			$strSQL = $strSQL."Der Schachklub Kriegshaber ist der gr&ouml;&szlig;te und aktivste Schachklub im Raum Augsburg. ";
			$strSQL = $strSQL."Mit zur Zeit über 90 Mitgliedern aller Altersgruppen haben wir viele interessante ";
			$strSQL = $strSQL."Spieler aller Spielst&auml;rkekategorien. Vom ";
			$strSQL = $strSQL."Anf&auml;nger bis zum ELO-Tr&auml;ger, vom Jugendlichen bis zum Senior findet man bei uns ";
			$strSQL = $strSQL."alles.<BR><BR><BR>";
			$strSQL = $strSQL."<B>Klubabend:</B><BR><BR>";
			$strSQL = $strSQL."Jeden Mittwoch, ab 20:00 Uhr und jeden Freitag ab 20:00 Uhr im Alten Zollhaus in ";
			$strSQL = $strSQL."Kriegshaber.<BR>Das Jugendtraining findet freitags ab 17:00 Uhr statt.<BR><BR><BR>";

			$strSQL = mysqli_real_escape_string($conLocal, $strSQL);
			$strSQL = "INSERT INTO skk_about (text, createdate, creator) VALUES ('".$strSQL."', ";
			$strSQL = $strSQL."'$now', 'SYSTEM');";

			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}
		}

		// ###########################################
		// 3.14. Tabelle für Geschichte:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_history (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."text blob, part int(1), createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// Den Standardseiteninhalt hinzufügen, falls nötig:
		$strSQL = "select id FROM skk_history WHERE del='N' AND modifieddate IS NULL;";

		$result = mysqli_query ($conLocal, $strSQL);
		$num = mysqli_num_rows($result);

		// Wurden Datensätze gefunden?
		if ($num == 0)
		{
			// Daten müssen erst noch geschrieben werden:
			$now = date("Y-m-d H:i");

			// Die Klubgeschichte Teil 1:
			$strSQL = "<SPAN CLASS=he1><IMG SRC='../pics/icons/history.gif'> Geschichte des SK Kriegshaber ";
			$strSQL = $strSQL."<IMG SRC='../pics/icons/history.gif'></SPAN><BR><BR>";
			$strSQL = $strSQL."<DIV ALIGN=JUSTIFY>";

			$strSQL = $strSQL."<IMG SRC='../pics/forms/clublogo.gif' height='200' width='200'><BR><BR>";

			$strSQL = $strSQL."'Auf Veranlassung der Herrn Ludwig Braun, Georg Schilling und Uwe Egner kam am 4. Juli 1924 die";
			$strSQL = $strSQL."Gründung des 'Schachklub Kriegshaber' im Gerstmayer’schen Gasthaus abends 8 Uhr zustanden.";
			$strSQL = $strSQL."Erschienen waren 16 Herren...' Mit diesen Worten beginnt das Protokoll der Gründungsversammlung";
			$strSQL = $strSQL."des Schachklubs Kriegshaber. Eine Kopie dieses handschriftlichen Protokolls hat Erich Bartel in";
			$strSQL = $strSQL."unserer Festschrift '50 Jahre Schachklub Kriegshaber' veröffentlicht.<BR><BR>";

			$strSQL = $strSQL."Dieses Jahr sind wir ein weiteres Vierteljahrhundert 'älter' geworden, viele Veränderungen haben";
			$strSQL = $strSQL."stattgefunden. Beispielsweise können wir inzwischen eigentlich zweimal 'Geburtstag' feiern, denn";
			$strSQL = $strSQL."wir haben eine zweite Vereinsgründung vorgenommen. Wie es damals halt üblich war, genügte ein";
			$strSQL = $strSQL."Gründungsprotokoll und schon war man ein Verein. Dann ersuchte man in den diversen Verbänden um";
			$strSQL = $strSQL."Aufnahme (dem wurde in der Regel stets entsprochen) und konnte am Spielbetrieb teilnehmen. Erst ein";
			$strSQL = $strSQL."paar Freundschaftsspiele und dann Verbandsligaspiele. Rechtlich gesehen waren wir natürlich gar nix,";
			$strSQL = $strSQL."rechtlich gesehen gab es uns nicht.<BR><BR>";

			$strSQL = $strSQL."Das war natürlich noch nicht von so exorbitanter Bedeutung, solange wir mit einer Mannschaft auf einem";
			$strSQL = $strSQL."Spielmaterial von etwa 12 Sätzen (mit Uhren, die älter als der Böhmerwald waren) herumkloppten und einem";
			$strSQL = $strSQL."Cafehaus mehr ähnelten als einem Sportverein. Unser Jahresetat 1873 betrug ca. 650 DM und davon wurden";
			$strSQL = $strSQL."100 DM durch eine Spende unseres Schachfreundes Wilhelm Gnann bestritten.<BR><BR>";

			$strSQL = $strSQL."Mit der Aufnahme des Bayerischen Schachbundes in den Bayerischen Landessportverband kam zuerst das Problem";
			$strSQL = $strSQL."der Gemeinnützigkeit: Um staatliche Zuschüsse und Spenden erhalten zu können, war der BLSV gezwungen, die";
			$strSQL = $strSQL."Gemeinnützigkeit zu erlangen. Bei einem Verband wird die Gemeinnützigkeit nur erteilt, wenn sämtliche, dem";
			$strSQL = $strSQL."Verband angeschlossenen Mitglieder (auf allen Ebenen) ebenfalls wieder als gemeinnützig anerkannt sind.";
			$strSQL = $strSQL."Dazu brauchten wir dann eine Satzung, die mit dem Finanzamt Augsburg abzustimmen war und nach einigen";
			$strSQL = $strSQL."Kontrollschleifen waren wir dann so gemein wie nützig. Seither müssen wir alle 2-3 Jahre einen Satz";
			$strSQL = $strSQL."Formulare fürs Finanzamt ausfüllen und Kopien der Hauptversammlungsprotokolle vorbeischicken.<BR><BR>";

			$strSQL = $strSQL."<IMG SRC='../pics/forms/history_part1.jpg' width=300 border=1><BR><BR>";

			$strSQL = $strSQL."Als wir dann 1974 mit 'Jugendarbeit' begannen und die Mannschaften erst auf 2, bald auf 3 anwuchsen, aber";
			$strSQL = $strSQL."besonders als wir uns 1983 von den Pfarrheimen und Kneipen aufmachten zu einem eigenen Klubheim, war dieser";
			$strSQL = $strSQL."Zustand vor allem haftungs- und mietrechtlich nicht mehr aufrechtzuerhalten. Der Verein mußte zu einer";
			$strSQL = $strSQL."eigenständigen juristischen Person werden (also zu einem eingetragenen Verein), denn bis dahin sprach und";
			$strSQL = $strSQL."haftete jede Einzelperson im Verein privat (ein Mietvertrag wäre dann z.B. nur als privater Mietvertrag";
			$strSQL = $strSQL."mit einem Menschen möglich gewesen, nicht für den Verein).<BR><BR>";

			$strSQL = $strSQL."Die Zeit drängte, denn wir hatten die Möglichkeit im alten Zollhaus in Kriegshaber Räume für uns anzumieten,";
			$strSQL = $strSQL."also mußte eine außerordentliche Mitgliederversammlung als 'Gründungsversammlung' einberufen werden.";
			$strSQL = $strSQL."Seither ist der Verein 'auch schon wer'.<BR><BR>";

			$strSQL = $strSQL."Unser 'neuestes Kind' ist seit 1998 eine Finanzordnung, um die sich Michael Voß große Verdienste für seine";
			$strSQL = $strSQL."Vorarbeiten dazu geschaffen hat. Scheint’s wir werden so richtig erwachsen!<BR><BR>";

			$strSQL = $strSQL."<IMG SRC='../pics/icons/home.gif'><b> Wo der Schachklub 'daheim' war </b><IMG SRC='../pics/icons/home.gif'><BR><BR>";

			$strSQL = $strSQL."Was das Heim des Schachklubs angeht, so sind wir inzwischen fast wieder 'zuhause' angekommen: das oben";
			$strSQL = $strSQL."erwähnte 'Gerstmayer’sche Gasthaus' ist schon längst der Spitzhacke zum Opfer gefallen. Auf dem alten";
			$strSQL = $strSQL."Grundstück steht heute u.a. die Pizzeria 'Quadri Foglio' und die ist ja genau gegenüber unserem heutigen";
			$strSQL = $strSQL."Domizil.<BR><BR>";
			$strSQL = $strSQL."</DIV>";

			$strSQL = mysqli_real_escape_string($conLocal, $strSQL);

			$strSQL = "INSERT INTO skk_history (text, part, createdate, creator) VALUES ('".$strSQL."', 1, ";
			$strSQL = $strSQL."'$now', 'SYSTEM');";

			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}

			// Die Klubgeschichte Teil 2:
			$strSQL = "<SPAN CLASS=he1><IMG SRC='../pics/icons/history.gif'> Geschichte des SK Kriegshaber <IMG SRC='../pics/icons/history.gif'></SPAN><BR><BR>";
			$strSQL = $strSQL."<DIV ALIGN=JUSTIFY>";

			$strSQL = $strSQL."In der langen Zeit von 75 Jahren gab es viele verschiedene <A HREF='../sites/heads.php'><IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0>Vorstände beim SK Kriegshaber</A>.";
			$strSQL = $strSQL."<BR><BR>";

			$strSQL = $strSQL."Aus lange vergangenen Zeiten (etwa bis 1976) stammt der Usus, daß sich das Häuflein der paar";
			$strSQL = $strSQL."Sommeraktiven in der Gartenlaube unseres damaligen Vorstandes Xaver Hochstatter traf, um die Schachsucht";
			$strSQL = $strSQL."zu befriedigen. Dieser Brauch schlief ein, als mit der Einführung des Sommerblitz (1974) den gesamten";
			$strSQL = $strSQL."Sommer durchgespielt wurde.<BR><BR>";

			$strSQL = $strSQL."Tja, wir hinterlassen so unsere Spuren in Kriegshaber, aber ich hoffe, es liegt nicht an uns, daß es die";
			$strSQL = $strSQL."meisten der genannten Lokal nicht mehr oder so nicht mehr gibt: Gerstmayer’sches Gasthaus abgerissen";
			$strSQL = $strSQL."(heute Quadri Foglio), die Unterbaarer Bierstuben sind auf unbekannte Zeit geschlossen, der Kurfürst";
			$strSQL = $strSQL."Max Emanuel dito, der 'Heimgarten' wurde in die Balkanstuben umbenannt und ist auch geschlossen, der";
			$strSQL = $strSQL."Prinzregent mutierte erst zu einem Thail&auml;ndischen Lokal und dann zu einem Thailändisch-Bayerischen Lokal,";
			$strSQL = $strSQL."der Lustige Hans stand jahrelang leer, soll nun ebenfalls als Trattoria zu neuem Leben erwachen. Das";
			$strSQL = $strSQL."Munkhaus ist ebenfalls den Weg allen Irdischen gegangen (heute steht dort ein Norma).<BR><BR>";

			$strSQL = $strSQL."Das erste Jahrzehnt im 'Zollhaus', in unseren eigenen Vereinsräumen, lief unter Rubrik 'abenteuerlich':";
			$strSQL = $strSQL."Einige Bilder haben sich eingepr&auml;gt:<BR><BR>";

			$strSQL = $strSQL."Renovierung - Herrmann Lucht reinigt die W&auml;nde der Toilette (Vorbereitung zum Tabezieren): mit der";
			$strSQL = $strSQL."Schleifmaschine! Unvergessen die dichten Staubschwaden, die dick (sah sehr ungesund aus!) von der Toilette";
			$strSQL = $strSQL."her&uuml;berdrangen. Dazwischen - hust, hust! - kommt Herrmann herüber mit den Worten 'janz Berlin war eene";
			$strSQL = $strSQL."Wolke'.<BR><BR>";

			$strSQL = $strSQL."Legend&auml;r unsere Heizung der ersten Jahre mit Holz und Sonstigem. Vor allem Sonstiges! Sehr interessant war,";
			$strSQL = $strSQL."was von Elmar gelegentlich als 'brennbar' erkl&auml;rt worden war; die maschinen&ouml;lgetränkten Massivholzteile der";
			$strSQL = $strSQL."MAN-Maschinenhalle waren dabei schon fast umweltfreundlich; leichtes Brennen in Kehle und Augen wiesen";
			$strSQL = $strSQL."gelegentlich auf irgendwelche nicht genauer zu definierenden Plastikteile hin. Wenn zum Jugendnachmittag";
			$strSQL = $strSQL."die Voreinschürung (mit entsprechender Qualmentwicklung) vorbei war, wenn dann am Spielabend die";
			$strSQL = $strSQL."Raumtemperatur zwischen 'kalt' (an der Wand) und 'zu hei&szlig;' (am Ofen) lag (zu erkennen daran, daß ein Teil";
			$strSQL = $strSQL."der Spieler im dicken Mantel, der andere Teil im T-Shirt dasa&szlig;), dann konnte mann wetten, daß - sobald";
			$strSQL = $strSQL."eine 'normale' Raumtemperatur herrschte - das Brennmaterial ausging. Entsprechend bildhafte Berichte von";
			$strSQL = $strSQL."diversen Mannschaftsk&auml;mpfen lassen sich auch der Vereinszeitung des SK Krumbach entnehmen.<BR><BR>";

			$strSQL = $strSQL."Buchi und das Beil: Tatort: Nebenraum. Tatzeit: Klubabend, fortgeschrittener Zeitpunkt. Ein etwas";
			$strSQL = $strSQL."entnervter Vorsitzender sitzt an einem wohl verlorenen Endspiel. Da: 'Wumm!' - ein Schlag erschüttert das";
			$strSQL = $strSQL."ganze Haus, der Boden bebt. Der Vorsitzende springt wie der Blitz in den Hauptraum: Buchi hat ein ca. 150cm";
			$strSQL = $strSQL."langes und ca 8cm dickes Kantholz flach auf den Boden gelegt, hält in der Hand ein Beil und versucht damit";
			$strSQL = $strSQL."das Kantholz in Stücke zu schlagen (das natürlich bei jeden Schlag vom Boden wegfedert). 'Buchi, was machst";
			$strSQL = $strSQL."Du da????' - 'Das hier ist das letzte Brennmaterial, es ist aber zu groß für den Ofen, deswegen will ich es";
			$strSQL = $strSQL."in ofengerechte Stücke...' - 'Buchi!!!! Das geht so nicht, Du brauchst eine Säge!'. Wieder rüber,";
			$strSQL = $strSQL."weiterspielen.<BR><BR>";

			$strSQL = $strSQL."2 Minuten sp&auml;ter: 'Tock,tock, tock!' (der Zimmerboden bebt schon wieder, allerdings etwas weniger): Buchi";
			$strSQL = $strSQL."hält nun das Langholz senkrecht mit der linken Hand, versucht es l&auml;ngs (1,50 m!!!) zu spalten, ohne dabei";
			$strSQL = $strSQL."aber seine linke Hand zu treffen (dadurch erreicht er auf dem Holz kaum sichtbare Einkerbungen).";
			$strSQL = $strSQL."Erl&auml;uterung: 'Ich hab mir gedacht, wenn ich es längs durchschlagen kann, dann kann ich es danach über dem";
			$strSQL = $strSQL."Knie in ofengerechte Stücke brechen.'<BR><BR>";

			$strSQL = $strSQL."<b>Mehr als 'nur' ein Schachklub</b><BR><BR>";

			$strSQL = $strSQL."Ein 'normaler' Schachklub waren wir scheint’s nie. Manchmal ziehen heute einige Schacherer etwas die Nase";
			$strSQL = $strSQL."hoch, beim beobachten einer Schafkopfrunde oder von Backgammonspielern. Frühen Protokollen kann man";
			$strSQL = $strSQL."entnehmen, daß bereits im ersten Jahr der Vereinsexistenz ein 'Vergnügungsausschuß' bestand, der sich um";
			$strSQL = $strSQL."den geselligen Teil des Vereinslebens kümmerte.<BR><BR>";

			$strSQL = $strSQL."Über diese länger zurückliegenden Zeiten hat Erich in '50 Jahre SKK' gebührend berichtet. In den letzten";
			$strSQL = $strSQL."25 Jahren sind verschiedene 'Moden' auch im 'gemütlichen Teil' des Abends zu beobachten gewesen:<BR>";

			$strSQL = $strSQL."Im Pfarrheim hatten wir einen gewissen Ruf (ich sage nicht welchen...) bezüglich des 'Bierlachs'";
			$strSQL = $strSQL."(die bayerische Abart des Skat). Der harte Kern (Bruno Stubenrauch, Erich Bartel, Herbert Benesch,";
			$strSQL = $strSQL."Hans Merkt, Hans Mayinger und ich) trieben Frau Grimminger vom Pfarrheim, die Bedienung und Schorsch";
			$strSQL = $strSQL."Grimminger an den Rand des Wahnsinns, wenn wir zu einer Zeit die Karten ergriffen und lauthals Brotzeiten";
			$strSQL = $strSQL."sowie eine Maß 'Gois' nach der anderen orderten, zu der die anderen Gäste schon daheim die erste Kuhle in";
			$strSQL = $strSQL."die Bettmatraze gelegen hatten. Der Abend endete meist in zähen Verhandlungen mit Familie Grimminger um";
			$strSQL = $strSQL."eine letzte, allerletzte und zuletzt noch eine ganz schnelle 'Gois', woraufhin wir mit den Worten";
			$strSQL = $strSQL."'Buabn, vertoilts eich fei glei!' entschlossen hinausexpediert wurden. Danach wurden noch stundenlang";
			$strSQL = $strSQL."'tiefsinnige' Gespräche (in durchaus interessanter Lautstärke, die Nachbarn sollten ja an unseren";
			$strSQL = $strSQL."Weisheiten teilhaben!) geführt, z.B. in welchen Kriegshaber Lokalitäten zum Hahnenschrei unter Umständen";
			$strSQL = $strSQL."noch etwas Flüssiges zu ergattern sein könnte.<BR><BR>";

			$strSQL = $strSQL."In den diversen Lokalen, durch die uns nach dem 'Rausschmi&szlig;' aus dem Pfarrheim der raue Wind der Zeiten";
			$strSQL = $strSQL."trieb, versuchten wir dann den ersten Anlauf einer Jugendarbeit. Wenn dabei später Nachwuchsspieler in";
			$strSQL = $strSQL."Regionalliga / Landesligaqualität heranreiften, dann w&uuml;rde ich das weniger unserer Jugendarbeit, denn eher";
			$strSQL = $strSQL."dem Talent dieser Spieler sowie dem Unterhaltungswert der Lokale zuschreiben. Den harten Kern bildeten";
			$strSQL = $strSQL."damals Armin und Elmar Bartel, Michael Müller (heute Romfeld), Michael Strohmeier, Jürgen Zillmann, Peter";
			$strSQL = $strSQL."Schury, Jörg Lemmel. Neben beachtlicher Spielstärke im Schach wurden erstaunliche Qualitäten im Flipper";
			$strSQL = $strSQL."(Unterbaarer Bierstuben) und Billard (Lustiger Hans) entwickelt, während wir schachlich 'nebenbei' die";
			$strSQL = $strSQL."niederen Gefilde der Schwabenliga 2 bis heute verlassen haben.<BR><BR>";

			$strSQL = $strSQL."<IMG SRC='../pics/forms/history_part2.jpg' width=300 border=1><BR><BR> Im 'Zollhaus' wandelte sich dann das Freizeitverhalten abermals: vor 15 Jahren wurde nächtelang geblitzt,";
			$strSQL = $strSQL."sp&auml;ter Tandem und Querschach bis in die Exzesse betrieben. Der harte Kern dieser Truppe - Michael Müller,";
			$strSQL = $strSQL."Wolfgang Reis, Michael Strohmeier, Andreas St&ouml;r, etwas sp&auml;ter Christian Matevzic, Helmut Silberhorn,";
			$strSQL = $strSQL."Michael Vo&szlig; und Martin M&ouml;bus - zockte alle Schachvarianten, Hauptsache die Bedenkzeit war minimal. Im";
			$strSQL = $strSQL."Nebenzimmer hatte sich dann schon die Schafkopfrunde etabliert (Bruno Stubenrauch, Hans Merkt, Erich Bartel,";
			$strSQL = $strSQL."Peter Gruber und Wolfgang Buchert). Die Blitzzocker sind fast verschwunden (höchstens 'normale Blitzer')";
			$strSQL = $strSQL."die Schafkopfrunden haben nach einer gewissen Hochzeit inzwischen fast die Existenz eingestellt; neben";
			$strSQL = $strSQL."Schach sind derzeit Brettspiele (Siedler von Catan, Backgammon) 'in'.<BR><BR>";

			$strSQL = $strSQL."Auch die 'gemütlichen Beisammensein' neben dem Vereinsabend sind Veränderungen unterworfen. In den 70er";
			$strSQL = $strSQL."Jahren waren 'gemütliche Abende' mit Tanz noch gelegentlich an der Tagesordnung, die dann aber einschliefen.";
			$strSQL = $strSQL."Seit 1984 hat sich an Silvester die gemeinsame Silvesterfeier im Schachklub etabliert, mit kaltem Buffet,";
			$strSQL = $strSQL."Brettspielen (aber kein Schach!), ratschen. Seit den 90er Jahren finden wir auch immer einen Grund für eine";
			$strSQL = $strSQL."Feier im Sommer, sei es eine Aufstiegsfeier, eine Nicht-Abstiegsfeier oder sogar eine Abstiegsfeier.<BR><BR>";

			$strSQL = $strSQL."<b>Vom 'Kaffeehausspiel' zum Schachsport</b><BR><BR>";

			$strSQL = $strSQL."Man muß nur die jährlichen Klagen der jeweiligen Spielleiter nachlesen, um einfach herauszubekommen, daß";
			$strSQL = $strSQL."etwa bis 1968/69 der Vereinsabend mit Sport (wie sich Schach heute versteht) wenig zu tun hatte. Das";
			$strSQL = $strSQL."Klubturnier hatte mehr Alibifunktion, auch bei den Mannschaftskämpfen passierten Dinge, die man heute als";
			$strSQL = $strSQL."recht erbaulich empfindet, die aber mit Sport weniger zu tun hatten. Unser Spiegelschach (Erwin und Otmar";
			$strSQL = $strSQL."G&auml;nsler im Mannschaftskampf gegen B&auml;renkeller) gehörte da noch zu den sportiveren Angelegenheiten.<BR><BR>";

			$strSQL = $strSQL."Ich datiere den Umstieg zum Sport auf die Jahre 1968/69. Damals fingen Erich Bartel, Kurt Weiß und";
			$strSQL = $strSQL."Herrmann Lucht, sowie Dr. Arno von Wilpert an, sich durchaus 'moderne' Gedanken zu machen, z.B. über";
			$strSQL = $strSQL."Marketing (Wurfzettelaktion in Kriegshaber), regelm&auml;&szlig;iger Spielbetrieb (Beginn des Dr.von-Wilpert-Pokals)";
			$strSQL = $strSQL."und Selbstdarstellung (die ersten Vereinszeitschriften erscheinen, jeweils einmal jährlich zur";
			$strSQL = $strSQL."Jahreshauptversammlung).<BR><BR>";

			$strSQL = $strSQL."Seit 1973 wird das Klubturnier modernisiert (und findet seither in verschiedenen Modi jährlich statt): Es";
			$strSQL = $strSQL."wird ein Terminplan für alle Runden herausgegeben, einige Jahre lang kommt sogar zu jeder Runde ein";
			$strSQL = $strSQL."wöchentliches Bulletin (mit Einzelergebnissen, Tabelle und locker flockigem Spielbericht) heraus.<BR><BR>";

			$strSQL = $strSQL."1974 (zum 50jährigen Jubiläum) werden wieder einige Neuerungen eingeführt:";
			$strSQL = $strSQL."Begründung des 'Sommerblitzkönigs'', anfangs noch mit 'gelben Trikot des Gesamtführenden und grünem Trikot des letzten Rundensiegers'";

			$strSQL = $strSQL."Erstmalige Austragung des Jugendpokals, sowie Angebot von Ferienschach.";

			$strSQL = $strSQL."Weil meinem Vater die extreme Qualmerei im Klub auf den Nerv ging, spendete er den Nichtraucherpokal, während dessen Austragung absolutes Rauchverbot herrschte. Dieses Blitzturnier ist zwischenzeitlich sanft entschlafen, weil einerseits kaum noch Raucher im Klub sind und andererseits die Trennung in Raucher- / Nichtraucher neue Rahmenbedingungen schufen.";

			$strSQL = $strSQL."Ab 1978 etwa beginnt die Teilnahme des Schachklubs an diversen Turnieren des Schachverbandes, wie an der Augsburger Stadtmeisterschaft, schwäbischen Jugend-meisterschaften, diversen Blitzturnieren. Anfangs in der Rolle des Kanonenfutters sammeln wir langsam aber zunehmend Spielstärke. Ich denke, in diesen Anfangsjahren liegt die Wurzel heutiger Blitzschacherfolge.";

			$strSQL = $strSQL."1984 - zum Einzug ins Zolhaus - stiftet 'Pokale Greiner' auf Anregung von Gerd Heigemeir den Zollhauspokal (90-Minuten-Turnier), der traditionell immer kurz vor der Ferienzeit stattfindet, und ebenso traditionell immer als Schweizer System.";

			$strSQL = $strSQL."Auf der Jahreshauptversammlung wurden als letztes Klubabend-Kind dann erst der Monatsblitz, später noch das Aktivschach-Turnier (20 Minunten) geboren, beide leider recht kränkelnd.<BR><BR>";

			$strSQL = $strSQL."<IMG SRC='../pics/icons/AFRO.gif'><b> Schachklub Kriegshaber goes Open </b><IMG SRC='../pics/icons/AFRO.gif'><BR><BR>";

			$strSQL = $strSQL."Mit Aktivitäten am Vereinsabend waren wir an unsere Grenzen gestoßen - wie man auch an der Teilnahme merkte,";
			$strSQL = $strSQL."die wieder zurückging. Mit Michael Voß entwickelte ich zum 70-jährigen Vereinsjubiläum 1994 die Idee, ein";
			$strSQL = $strSQL."Schach-Open auszurichten. Bei der Vorbereitung dominierten Begeisterung, Leidensfähigkeit und Unwissenheit.";
			$strSQL = $strSQL."Ursprünglich war das Turnier als einmaliges Ereignis geplant, durch Erschließung einer Geldquelle konnte";
			$strSQL = $strSQL."dann eine Ausrichtung für 3 Jahre garantiert werden, und obwohl ich mir jedes Jahr schwöre, daß es jetzt";
			$strSQL = $strSQL."wirklich reicht, sind wir jetzt in der 15. Ausrichtung. Inwischen fand das 15. Augsburger Friedensfest-Open statt,";
			$strSQL = $strSQL."wir sind eine Institution geworden. (immer am 2.August-Wochenende)<BR><BR>";
			$strSQL = $strSQL."</DIV>";

			$strSQL = mysqli_real_escape_string($conLocal, $strSQL);

			$strSQL = "INSERT INTO skk_history (text, part, createdate, creator) VALUES ('".$strSQL."', 2, ";
			$strSQL = $strSQL."'$now', 'SYSTEM');";

			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}
		}

		// ###########################################
		// 3.15. Tabelle für Anfahrtsbeschreibung:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_journey (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."text blob, createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// Den Standardseiteninhalt hinzufügen, falls nötig:
		$strSQL = "select id FROM skk_journey WHERE del='N' AND modifieddate IS NULL;";

		$result = mysqli_query ($conLocal, $strSQL);
		$num = mysqli_num_rows($result);

		// Wurden Datensätze gefunden?
		if ($num == 0)
		{
			// Daten müssen erst noch geschrieben werden:
			$now = date("Y-m-d H:i");

			$strSQL = "<SPAN CLASS=he1>Der Weg zum SK Kriegshaber</SPAN><BR><BR>";
			$strSQL = $strSQL."<DIV ALIGN=JUSTIFY>";
			$strSQL = $strSQL."Das Klublokal unseres Vereins ist das alte Zollhaus im Stadtteil Kriegshaber.";
			$strSQL = $strSQL."Es liegt im Nordwesten von Augsburg - mit Auto oder Bahn recht leicht zu erreichen.<BR><BR>";

			$strSQL = $strSQL."<IMG SRC='../pics/maps/anfahrt.gif'><BR><BR>";

			$strSQL = $strSQL."<BR>";
			$strSQL = $strSQL."<IMG SRC='../pics/icons/car.gif'><B>  Anfahrt mit dem Auto  </B><IMG SRC='../pics/icons/car.gif'><BR><BR>";
			$strSQL = $strSQL."Wenn Sie aus dem Westen, Norden oder Osten kommen, sollten Sie am";
			$strSQL = $strSQL."Autobahnkreuz Augsburg West auf die neue B17 in Richtung Landsberg";
			$strSQL = $strSQL."einbiegen. Fahren Sie an der Ausfahrt Zentralklinikum in den Kobelweg,";
			$strSQL = $strSQL."anschließend links in die Neusäßer Straße.";
			$strSQL = $strSQL."Die n&auml;chste große Kreuzung führt Sie nach links in die Ulmer Straße.";
			$strSQL = $strSQL."Nach ca. 500 Meter finden Sie links den Schachklub Kriegshaber im";
			$strSQL = $strSQL."sogenannten Zollhaus.<BR><BR>";

			$strSQL = $strSQL."Wenn Sie aus dem Süden kommen, sollten Sie die neue B17 Richtung";
			$strSQL = $strSQL."Donauw&ouml;rth benutzen. Biegen Sie nach links in die B&uuml;rgermeister";
			$strSQL = $strSQL."-Ackermann-Straße ein. An der nächsten Ampel fahren Sie nach rechts";
			$strSQL = $strSQL."in die Kriegshaber Straße.";
			$strSQL = $strSQL."Die nächste große Kreuzung führt Sie nach rechts in die Ulmer Straße.";
			$strSQL = $strSQL."Nach ca. 500 Meter finden Sie links den Schachklub Kriegshaber im";
			$strSQL = $strSQL."sogenannten Zollhaus.<BR><BR><BR>";

			$strSQL = $strSQL."<IMG SRC='../pics/icons/railway.gif'><B>  Anfahrt mit dem Nahverkehr  </B><IMG SRC='../pics/icons/bus.gif'><BR><BR>";

			$strSQL = $strSQL."Mit einer Straßenbahn- und mehreren AVV - Buslinien und einer Haltestelle";
			$strSQL = $strSQL."direkt vor der Haustür ist der Schachklub Kriegshaber optimal an das Augsburger";
			$strSQL = $strSQL."Nahverkehrssystem angebunden.<BR><BR>";

			$strSQL = $strSQL."Am besten erreichen Sie uns wohl mit der Straßenbahnlinie 2 Richtung 'P+R Augsburg West', Haltestelle";
			$strSQL = $strSQL."Kriegshaber. N&auml;here Informationen über diese Anbindung finden Sie hier:<BR><BR>";

			$strSQL = $strSQL."<a href='http://www.stawa.de/fahrgaeste/fahrplaene.php'>";
			$strSQL = $strSQL."<IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Fahrplanauskunftssytem der AVG</A><BR><BR>";


			$strSQL = $strSQL."Alternativ f&auml;hrt der AVV mit einigen Buslinien die Haltestelle Kriegshaber";
			$strSQL = $strSQL."an. Unter anderen sind dies die Linien:<BR><BR>";

			$strSQL = $strSQL."<UL>";
			$strSQL = $strSQL."<LI>500 - 501  Augsburg - Neusäß - Aystetten/Adelsried - Welden</LI>";
			$strSQL = $strSQL."<LI>504  Augsburg - Neusäß - Aystetten - Streitheim Ort</LI>";
			$strSQL = $strSQL."<LI>506 - 507  Augsburg - Biburg/H&auml;der - Au/Zusmarshausen - Wollbach/Steinek.</LI>";
			$strSQL = $strSQL."<LI>600  Augsburg - Diedorf - Gessertshausen - Ustersbach - (Krumbach)</LI>";
			$strSQL = $strSQL."<LI>601  Augsburg - Steppach - Diedorf - Anhausen</LI>";
			$strSQL = $strSQL."</UL>";

			$strSQL = $strSQL."N&auml;here Informationen &uuml;ber diese Anbindung finden Sie hier:<BR><BR>";

			$strSQL = $strSQL."<a href='http://efa.avv-augsburg.de/avv/index_de.htm'>";
			$strSQL = $strSQL."<IMG SRC='../pics/icons/pfeilrotaufgelb.gif' BORDER=0> Fahrplanauskunftsystem des AVV</A><BR><BR>";
			$strSQL = $strSQL."</DIV>";

			$strSQL = mysqli_real_escape_string($conLocal, $strSQL);

			$strSQL = "INSERT INTO skk_journey (text, createdate, creator) VALUES ('".$strSQL."', ";
			$strSQL = $strSQL."'$now', 'SYSTEM');";

			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}
		}


		// ###############################
		// 3.16. Tabelle für die einzelnen SKK - Turniere
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_tournaments (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."tournament varchar(255), createdate ";
		$strSQL = $strSQL."datetime NOT NULL, creator varchar(50) character set latin1 collate ";
		$strSQL = $strSQL."latin1_german1_ci, modifieddate datetime, modifier varchar(50), ";
		$strSQL = $strSQL."del varchar(1) NOT NULL default 'N', PRIMARY KEY (id, createdate, del)) ";
		$strSQL = $strSQL."ENGINE=MyISAM COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error: $strSQL<P>");
			echo mysqli_error($conLocal);
			return "";
		}

		// Den Standardinhalt hinzufügen, falls nötig:
		$strSQL = "select id FROM skk_tournaments WHERE del='N' AND modifieddate IS NULL;";

		$result = mysqli_query ($conLocal, $strSQL);
		$num = mysqli_num_rows($result);

		// Wurden Datensätze gefunden?
		if ($num == 0)
		{
			// Daten müssen erst noch geschrieben werden:
			$now = date("Y-m-d H:i");

			$strSQL = "INSERT INTO skk_tournaments (tournament, createdate, creator) VALUES ('Klubturnier', ";
			$strSQL = $strSQL."'$now', 'SYSTEM');";

			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}

			$strSQL = "INSERT INTO skk_tournaments (tournament, createdate, creator) VALUES ('Zollhauspokal', ";
			$strSQL = $strSQL."'$now', 'SYSTEM');";

			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}

			$strSQL = "INSERT INTO skk_tournaments (tournament, createdate, creator) VALUES ('Schneiderpokal', ";
			$strSQL = $strSQL."'$now', 'SYSTEM');";

			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}

			$strSQL = "INSERT INTO skk_tournaments (tournament, createdate, creator) VALUES ('Sommerblitz', ";
			$strSQL = $strSQL."'$now', 'SYSTEM');";

			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}

			$strSQL = "INSERT INTO skk_tournaments (tournament, createdate, creator) VALUES ('Monatsblitz', ";
			$strSQL = $strSQL."'$now', 'SYSTEM');";

			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}

			$strSQL = "INSERT INTO skk_tournaments (tournament, createdate, creator) VALUES ('Jugendpokal', ";
			$strSQL = $strSQL."'$now', 'SYSTEM');";

			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}
		}

		// ##################################
		// 3.17. Tabelle für die Fotogalerie:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_galery (";
		$strSQL = $strSQL."id mediumint(8) unsigned NOT NULL auto_increment, ";
		$strSQL = $strSQL."galery varchar(255), category varchar(100) character set latin1 NOT NULL default '', ";
		$strSQL = $strSQL."galerydate date NOT NULL, createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del));";


		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error: $strSQL<P>");
			echo mysqli_error($conLocal);
			return "";
		}

		$strSQL = "CREATE TABLE IF NOT EXISTS skk_galery_pics (";
		$strSQL = $strSQL."id_galery mediumint(8) unsigned NOT NULL, ";
		$strSQL = $strSQL."picture varchar(255) DEFAULT '0' NOT NULL, ";
		$strSQL = $strSQL."comment varchar(255), filecreatedate datetime, createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id_galery, picture, createdate, del));";


		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error: $strSQL<P>");
			echo mysqli_error($conLocal);
			return "";
		}


		// ###########################################
		// 3.18. Tabelle für Erfassung von Partien:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_games (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."player1 varchar(255) NOT NULL, player2 varchar(255) NOT NULL, ";
		$strSQL = $strSQL."club1 varchar(255), club2 varchar(255), ";
		$strSQL = $strSQL."event varchar(255), round varchar(2), result varchar(3), ";
		$strSQL = $strSQL."board varchar(2), comment blob, password varchar(25), ";
		$strSQL = $strSQL."moves blob, gamedate datetime, createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// ###########################################
		// 4. AFRO - Tabellen:
		// ###########################################
		// 4.1. Tabelle für die AFRO - Konfiguration:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_afro_config (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."allowusermessage varchar(1) NOT NULL default 'N', allowusermessageto date, ";
		$strSQL = $strSQL."showafrolink varchar(1) NOT NULL default 'J', maxnumberofplayers int(4), createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// Den Standardinhalt hinzufügen, falls nötig:
		$strSQL = "select id FROM skk_afro_config WHERE del='N' AND modifieddate IS NULL;";

		$result = mysqli_query ($conLocal, $strSQL);
		$num = mysqli_num_rows($result);

		// Wurden Datensätze gefunden?
		if ($num == 0)
		{
			// Den ersten Standarddatensatz schreiben:
			$now = date("Y-m-d H:i:s");
			$strSQL = "INSERT INTO skk_afro_config (id, allowusermessage, allowusermessageto, showafrolink, createdate, creator)";
			$strSQL = $strSQL." VALUES (1, 'N', NULL, 'J', '$now', 'SYSTEM');";

			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}
		}

		// ###########################################
		// 4.2. Tabelle für AFRO - Anfahrt:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_afro_journey (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."text blob, createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50) character set latin1 collate latin1_german1_ci, del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// Den Standardinhalt hinzufügen, falls nötig:
		$strSQL = "select id FROM skk_afro_journey WHERE del='N' AND modifieddate IS NULL;";

		$result = mysqli_query ($conLocal, $strSQL);
		$num = mysqli_num_rows($result);

		// Wurden Datensätze gefunden?
		if ($num == 0)
		{
			// Den ersten Standarddatensatz schreiben:
			$now = date("Y-m-d H:i:s");
			$strSQL = 'INSERT INTO skk_afro_journey (id, text, createdate, creator) VALUES (1, ';
			$strSQL = $strSQL.'"<font size=4 color=c3ccd0><BR><b>Anfahrtsbeschreibung</b><BR><BR></font>';
			$strSQL = $strSQL.'<IMG SRC=\"pics/way/car.gif\"><B> Anfahrt mit dem Auto </B><IMG SRC=\"pics/way/car.gif\"><BR><BR>';
			$strSQL = $strSQL.'Bundesautobahn A8, Ausfahrt Augsburg-West, Richtung Landsberg. Ausfahrt \"Neusäß / Kriegshaber (Klinikum)';
			$strSQL = $strSQL.'\" nach rechts abbiegen (Kobelweg), nach ca 430m Hofeinfahrt auf der rechten Straßenseite. Parkplätze sind vorhanden.<BR><BR>';
			$strSQL = $strSQL.'<IMG SRC=\"pics/anfahrt.gif\"><BR><BR>';
			$strSQL = $strSQL.'<IMG SRC=\"pics/way/railway.gif\"><B> Anfahrt mit öffentlichen Verkehrsmitteln</B> <IMG SRC=\"pics/way/bus.gif\"><BR><BR>';
			$strSQL = $strSQL.'	Straßenbahn Linie 2, Haltestelle Stenglinstraße, von dort zu Fuß ca 15 Minuten: Neusässer Straße stadtauswärts, ';
			$strSQL = $strSQL.'erste Kreuzung nach rechts abbiegen (Kobelweg stadteinwärts), ca. 400m auf der linken Seite.<BR><BR>';
			$strSQL = $strSQL.'Zeitweise hält direkt am Austragungsort auch die Buslinie 503 des AVV´s.<BR><BR>';
			$strSQL = $strSQL.'<IMG SRC=\"pics/x.gif\" width=15> <a href=\"http://portale.web.de/Auto/Routenplaner?tostreet=Kobelweg&toplz=D+-+86156&tocity=Augsburg\">Berechnung der Route durch Web.de &nbsp; </a>';
			$strSQL = $strSQL.'", "$now", "SYSTEM");';

			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}
		}

		// 4.3. Tabelle für AFRO - Ergebnisse:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_afro_results (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."text blob, createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// 4.4. Tabelle für AFRO - Ausschreibung:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_afro_writeout (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."text blob, createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// 4.5. Tabelle für AFRO - Hoteldaten:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_afro_hotel (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."text blob, createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// Den Standardinhalt hinzufügen, falls nötig:
		$strSQL = "select id FROM skk_afro_hotel WHERE del='N' AND modifieddate IS NULL;";

		$result = mysqli_query ($conLocal, $strSQL);
		$num = mysqli_num_rows($result);

		// Wurden Datensätze gefunden?
		if ($num == 0)
		{
			// Den ersten Standarddatensatz schreiben:
			$now = date("Y-m-d H:i:s");
			$strSQL = 'INSERT INTO skk_afro_hotel (id, text, createdate, creator) VALUES (1, "';
			$strSQL = $strSQL.'<font size=4 color=c3ccd0><BR><b>Hotels und Pensionen in der Nähe</b><BR><BR></font>';
			$strSQL = $strSQL.'<b>Hotel Neusässer Hof</b><BR>';
			$strSQL = $strSQL.'Hauptstr. 7a<BR>';
			$strSQL = $strSQL.'86356 Neusäß – Augsburg<BR>';
			$strSQL = $strSQL.'Telefon 0821/20 79 1-0<BR>';
			$strSQL = $strSQL.'Telefax 0821/46 83 62<BR>';
			$strSQL = $strSQL.'e-mail: <a href=\"mailto:info@neusaesserhof.com\">info@neusaesserhof.com</a><BR><BR>';
			$strSQL = $strSQL.'<BR><BR><BR>';
			$strSQL = $strSQL.'Weitere Infos bezüglich Hotelreservierung unter <A HREF=\"http://www.regio-augsburg.de\">http://www.regio-augsburg.de</A>"';

			$strSQL = $strSQL.', "$now", "SYSTEM");';

			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database create error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}
		}

		// 4.6. Tabelle für AFRO - Kontakt:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_afro_contact (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."text blob, createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}


		// 4.7. Tabelle für AFRO - Tabellen:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_afro_tables (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."text blob, createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// 4.8. Tabelle für AFRO - Spieler:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_afro_players (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."surname varchar(255) NOT NULL, firstname varchar(255) NOT NULL, ";
		$strSQL = $strSQL."addrstreet varchar(255), addrzipcode varchar(10), ";
		$strSQL = $strSQL."addrcity varchar(255), telephone varchar(255), ";
		$strSQL = $strSQL."email varchar(255), birthdate date, ";
		$strSQL = $strSQL."dwz int(4), elo int(0), title varchar(10), organization varchar(255), curyear integer NOT NULL, tournament varchar(1), ";
		$strSQL = $strSQL."createdate datetime NOT NULL, creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', ip varchar(25), os varchar(255), PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}
		
		// #################
		// UPDATE 29.05.2018
		// Anlass: EU-Datenschutzrichtlinie
		// Alte Spieler-Datensätze im September automatisch löschen, wenn AFRO-Turnier vorbei ist.
		$now = date("Y-m-d H:i:s");
		$curMonth = substr($now,5,2);
		$curYear = substr($now,0,4);
		
		if ($curMonth > 8)
		{
			$strSQL = "DELETE FROM skk_afro_players WHERE curyear = ".$curYear.";";
			
			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database update error!<P>");
				echo "<BR>SQL: ".$strSQL."<BR>";
				echo mysqli_error($conLocal);
				return "";
			}			
		}
		// UPDATE Ende
		// ###########
			
		

		// ###########################################
		// 5. Vorstände im Verein:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_heads (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."year varchar(9) NOT NULL, firsthead varchar(255), secondhead varchar(100), ";
		$strSQL = $strSQL."cashier varchar(100), gameleader varchar(100), stuffhead varchar(100), ";
		$strSQL = $strSQL."writehead varchar(100), youthhead varchar(100), createdate datetime NOT NULL, ";
		$strSQL = $strSQL."creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL , modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// ###########################################
		// 6. Vereinslokale:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_locals (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."year varchar(9) NOT NULL, local varchar(255), createdate datetime NOT NULL, ";
		$strSQL = $strSQL."creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (id, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// ###########################################
		// 7. Abgelaufene Logins zurücksetzen:
		// Alle Datensätze ermitteln, bei denen ein Logindatum hinterlegt ist:
		// Zuerst das Zieldatum ermitteln:
		$result = mysqli_query ($conLocal, "SELECT DATE_SUB(now(), INTERVAL 3 HOUR)");
		$num = mysqli_num_rows($result);

		// Wurden Datensätze gefunden?
		if ($num > 0)
		{
			// Alter Code:
			// $tmpDate = mysql_result($result,0,0);
			$result->data_seek(0);
			$row = $result->fetch_row();
			$tmpDate = $row[0];
			
			$strSQL = "select id FROM skk_members WHERE lastlogin < '$tmpDate';";

			$result = mysqli_query ($conLocal, $strSQL);
			$num = mysqli_num_rows($result);

			// Wurden Datensätze gefunden?
			if ($num > 0)
			{
				for ($i = 0; $i < $num; $i++)
				{
					// ###########################################
					// Alter Code:
					// $nrak = $num - $i - 1;
					// $curid = mysql_result($result,$nrak,"id");
					
					// ##############################
					// Die aktuelle Zeile anspringen:
					$result->data_seek($i);
					$row = $result->fetch_row();
					$curid = $row[0];
					

					// Login zurücksetzen:
					$strSQL = "UPDATE skk_members SET lastlogin = NULL, ip = NULL WHERE id=".$curid;

					if (!mysqli_query ($conLocal, $strSQL))
					{
						echo("Database update error!<P>");
						echo mysqli_error($conLocal);
						return "";
					}
				}
			}
		}


		// #####################################################################################################
		// 8. Alle abgelaufenen Downloads löschen, indem diese in das Verzeichnis wastebasket verschoben werden:
		$strSQL = "select id, filename FROM skk_downloads WHERE del='N' AND expiredate < NOW();";

		$result = mysqli_query ($conLocal, $strSQL);
		$num = mysqli_num_rows($result);

		// Wurden Datensätze gefunden?
		if ($num > 0)
		{
			// Datei wieder löschen:
			for ($i=0;$i<$num;$i++)
			{
				// ###########################################
				// Alter Code:
				// $nrak = $num - $i - 1;
				// $curid = mysql_result($result,$nrak,"id");
				// $curfilename = mysql_result($result,$nrak,"filename");
				$result->data_seek($i);
				$row = $result->fetch_row();
				$curid = $row[0];
				$curfilename = $row[1];
				
				// Den Zielpfad erstellen:
				$destdir = "";
				$strPath = "";

				if (is_dir("../downloads")==1)
				{
					$strPath = "../downloads";
					$destdir = "../wastebasket";
				}
				else
				{
					if (is_dir("../../downloads")==1)
					{
						$strPath = "../../downloads";
						$destdir = "../../wastebasket";
					}
					else
					{
						if (is_dir("../../../downloads")==1)
						{
							$strPath = "../../../downloads";
							$destdir = "../../../wastebasket";
						}
					}
				}

				// Gibt es die Zieldatei?
				if (is_file($strPath."/".$curfilename)==1)
				{
					// Die Datei in das Ablageverzeichnis verschieben:
					if (!rename($strPath."/".$curfilename, $destdir."/".$curfilename))
					{
						// Verschieben hat nicht funktioniert => Kein Update!
					}
					else
					{
						// Datei als gelöscht markieren:
						$strSQL = "UPDATE skk_downloads SET del = 'J', modifieddate=NOW(), modifier='SYSTEM' WHERE id=$curid";

						if (!mysqli_query ($conLocal, $strSQL))
						{
							echo("Database update error!<P>");
							echo mysqli_error($conLocal);
							return "";
						}
						
						// Die dazugehörigen Schreibtische bereinigen:
						$strSQL = "UPDATE skk_userdesks_contents SET del = 'J', modifieddate=NOW(), modifier='SYSTEM' WHERE id=$curid AND objecttable='skk_downloads';";
						
						if (!mysqli_query ($conLocal, $strSQL))
						{
							echo("Database update error!<P>");
							echo mysqli_error($conLocal);
							return "";
						}
					}
				}

			}
		}

		// ###########################################
		// 9. Counter:
		// 9.1.) Hauptseite:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_hits (numberofhits int(11), createdate datetime NOT NULL, ";
		$strSQL = $strSQL."creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (numberofhits, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// 9.2.) AFRO - Seite:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_afro_hits (numberofhits int(11), curyear int(4), createdate datetime NOT NULL, ";
		$strSQL = $strSQL."creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (numberofhits, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1;";

		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
			return "";
		}

		// 9.3.) 100-Jahre-Feier - Seite:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_100_hits (numberofhits int(11), curyear int(4), createdate datetime NOT NULL, ";
		$strSQL = $strSQL."creator varchar(50) NOT ";
		$strSQL = $strSQL."NULL, modifieddate date, modifier varchar(50), del varchar(1) NOT ";
		$strSQL = $strSQL."NULL default 'N', PRIMARY KEY (numberofhits, createdate, del)) ENGINE=MyISAM ";
		$strSQL = $strSQL."COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1;";
		
		if (!mysqli_query ($conLocal, $strSQL))
		{
		    echo("Database create error!<P>");
		    echo "<BR>SQL: ".$strSQL."<BR>";
		    echo mysqli_error($conLocal);
		    return "";
		}
		
		// ###########################################
		// 10. Alte Kommentarschreibanfragen zurücksetzen:
		// Dafür das notwendige Temporärdatum ermitteln:
		$result = mysqli_query ($conLocal, "SELECT DATE_SUB(now(), INTERVAL 10 DAY)");
		$num = mysqli_num_rows($result);

		// Wurden Datensätze gefunden?
		if ($num > 0)
		{
			// Das Temporärdatum ermitteln:
			// $tmpDate = mysql_result($result,0,0);
			$result->data_seek(0);
			$row = $result->fetch_row();
			$tmpDate = $row[0];

			$strSQL = "UPDATE skk_comments_requests SET del='J' WHERE createdate < '$tmpDate';";

			if (!mysqli_query ($conLocal, $strSQL))
			{
				// Nothing to do!
				echo $strSQL."<BR>";
				echo mysqli_error($conLocal)."<BR>";
			}
		}
		
		// ################################
		// 11.) Adminbereich: Schreibtische
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_userdesks (id int(11) NOT NULL auto_increment, skk_userdesks varchar(100) ";
		$strSQL = $strSQL."NOT NULL default '', userid int(11) NOT NULL, UseHelp varchar(1) NOT NULL Default 'N', createdate datetime NOT NULL, creator varchar(50) NOT NULL, modifieddate ";
		$strSQL = $strSQL."datetime, modifier varchar(50), del varchar(1) NOT NULL default 'N', PRIMARY KEY ";
		$strSQL = $strSQL."(id, createdate, del)) ENGINE=MyISAM DEFAULT COLLATE=latin1_german1_ci CHARSET=latin1;";
		
		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error: $strSQL<P>");
			echo mysqli_error($conLocal);
			return "";
		}
		
		// Liste der abgelegten Objetke in der Tabelle:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_userdesks_contents (id_userdesks int(11) ";
		$strSQL = $strSQL."NOT NULL, objecttable varchar(100) NOT NULL, objectid int(11) NOT NULL, userdesk_position int(11) NOT NULL, createdate datetime NOT NULL, creator varchar(50) NOT NULL, modifieddate ";
		$strSQL = $strSQL."datetime, modifier varchar(50), del varchar(1) NOT NULL default 'N', PRIMARY KEY ";
		$strSQL = $strSQL."(id_userdesks, objecttable, objectid, createdate, del)) ENGINE=MyISAM DEFAULT COLLATE=latin1_german1_ci CHARSET=latin1;";
		
		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error: $strSQL<P>");
			echo mysqli_error($conLocal);
			return "";
		}
		
		// ##################
		// 12. Objektklassen:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_objectclasses (id int(11) NOT NULL auto_increment, objectclassname varchar(100),  objectclassshownname varchar(100), objectclassicon varchar(100) NOT NULL default ''";
		$strSQL = $strSQL."NOT NULL default '', objectclasstable varchar(100) NOT NULL default '', objectclasseditform varchar(100) NOT NULL default '', colsinseekform varchar(100), createdate datetime NOT NULL, creator varchar(50) NOT NULL, modifieddate ";
		$strSQL = $strSQL."datetime, modifier varchar(50), del varchar(1) NOT NULL default 'N', PRIMARY KEY ";
		$strSQL = $strSQL."(id, createdate, del)) ENGINE=MyISAM DEFAULT COLLATE=latin1_german1_ci CHARSET=latin1;";
		
		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error: $strSQL<P>");
			echo mysqli_error($conLocal);
			return "";
		}
		
		// #################################################
		// 12.1.) Die Werte für die Objektklassen schreiben:
		$strSQL = "select id FROM skk_objectclasses WHERE del='N' AND modifieddate IS NULL;";
		
		$result = mysqli_query ($conLocal, $strSQL);
		$num = mysqli_num_rows($result);
		
		// Wurden Datensätze gefunden?
		if ($num == 0)
		{
			// Wir müsssen die Werte schreiben:
			$now = date("Y-m-d H:i:s");
			
			// News und Meldungen:
			$strSQL = "INSERT INTO skk_objectclasses (objectclassname, objectclassshownname, objectclassicon, objectclasstable, objectclasseditform, colsinseekform, createdate, creator) VALUES (";
			$strSQL = $strSQL ."'NEWS', 'News & Meldungen', 'thunder.gif', 'skk_news', '_admin_newsaendern.php', 'newsdate,headline', '".$now."', 'SYSTEM');";
						
			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database update error: $strSQL<P>");
				echo mysqli_error($conLocal);
			}
			
			// Termine:
			$strSQL = "INSERT INTO skk_objectclasses (objectclassname, objectclassshownname, objectclassicon, objectclasstable, objectclasseditform, colsinseekform, createdate, creator) VALUES (";
			$strSQL = $strSQL ."'DEADLINES', 'Termine', 'deadline.gif', 'skk_deadline', '_admin_terminaendern.php', 'deadlinedate,deadline', '".$now."', 'SYSTEM');";
			
			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database update error: $strSQL<P>");
				echo mysqli_error($conLocal);
			}
			
			// Partien:
			$strSQL = "INSERT INTO skk_objectclasses (objectclassname, objectclassshownname, objectclassicon, objectclasstable, objectclasseditform, colsinseekform, createdate, creator) VALUES (";
			$strSQL = $strSQL ."'GAMES', 'Partien', 'matches.jpg', 'skk_games', 'games/_admin_edit_game.php', 'player1,player2,event', '".$now."', 'SYSTEM');";
				
			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database update error: $strSQL<P>");
				echo mysqli_error($conLocal);
			}
			
			// Vorstände:
			$strSQL = "INSERT INTO skk_objectclasses (objectclassname, objectclassshownname, objectclassicon, objectclasstable, objectclasseditform, colsinseekform, createdate, creator) VALUES (";
			$strSQL = $strSQL ."'HEADS', 'Vorst&auml;nde', 'heads.png', 'skk_heads', 'heads/_admin_edit_head.php', 'year', '".$now."', 'SYSTEM');";
			
			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database update error: $strSQL<P>");
				echo mysqli_error($conLocal);
			}
			
			// Vereinslokale:
			$strSQL = "INSERT INTO skk_objectclasses (objectclassname, objectclassshownname, objectclassicon, objectclasstable, objectclasseditform, colsinseekform, createdate, creator) VALUES (";
			$strSQL = $strSQL ."'LOCALS', 'Vereinslokale', 'locals.png', 'skk_locals', 'locals/_admin_edit_local.php', 'year', '".$now."', 'SYSTEM');";
				
			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database update error: $strSQL<P>");
				echo mysqli_error($conLocal);
			}
			
			// Historie:
			$strSQL = "INSERT INTO skk_objectclasses (objectclassname, objectclassshownname, objectclassicon, objectclasstable, objectclasseditform, colsinseekform, createdate, creator) VALUES (";
			$strSQL = $strSQL ."'HISTORY', 'Historie', 'history.gif', 'skk_history', '_admin_edit_history.php', 'part', '".$now."', 'SYSTEM');";
			
			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database update error: $strSQL<P>");
				echo mysqli_error($conLocal);
			}
			
			// Mannschaften:
			$strSQL = "INSERT INTO skk_objectclasses (objectclassname, objectclassshownname, objectclassicon, objectclasstable, objectclasseditform, colsinseekform, createdate, creator) VALUES (";
			$strSQL = $strSQL ."'TEAMS', 'Mannschaft', 'team.jpg', 'skk_teams', '_admin_edit_team.php', 'team', '".$now."', 'SYSTEM');";
				
			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database update error: $strSQL<P>");
				echo mysqli_error($conLocal);
			}
			
			// Bildergalerie:
			$strSQL = "INSERT INTO skk_objectclasses (objectclassname, objectclassshownname, objectclassicon, objectclasstable, objectclasseditform, colsinseekform, createdate, creator) VALUES (";
			$strSQL = $strSQL ."'GALERIES', 'Bildergalerie', 'galery.gif', 'skk_galery', 'galery/_admin_edit_galery.php', 'galery', '".$now."', 'SYSTEM');";
			
			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database update error: $strSQL<P>");
				echo mysqli_error($conLocal);
			}
			
			// Downloads:
			$strSQL = "INSERT INTO skk_objectclasses (objectclassname, objectclassshownname, objectclassicon, objectclasstable, objectclasseditform, colsinseekform, createdate, creator) VALUES (";
			$strSQL = $strSQL ."'DOWNLOADS', 'Download', 'download.jpg', 'skk_downloads', 'downloads/_admin_edit_download.php', 'viewname', '".$now."', 'SYSTEM');";
				
			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database update error: $strSQL<P>");
				echo mysqli_error($conLocal);
			}
			
			// Downloads:
			$strSQL = "INSERT INTO skk_objectclasses (objectclassname, objectclassshownname, objectclassicon, objectclasstable, objectclasseditform, colsinseekform, createdate, creator) VALUES (";
			$strSQL = $strSQL ."'MEMBERS', 'Mitglied', 'team.jpg', 'skk_members', 'members/_admin_edit_member.php', 'name,vorname', '".$now."', 'SYSTEM');";
			
			if (!mysqli_query ($conLocal, $strSQL))
			{
				echo("Database update error: $strSQL<P>");
				echo mysqli_error($conLocal);
			}
		}
		
		// ####################
		// 13. Schachdiagramme:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_diagramme (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."diagramm_title varchar(100) NOT NULL, diagramm_file varchar(255) NOT NULL, ";
		$strSQL = $strSQL."diagramm_width int(4), diagramm_height int(4), createdate datetime NOT NULL, creator ";
		$strSQL = $strSQL."varchar(50) NOT NULL, modifieddate date, modifier varchar(50), ";
		$strSQL = $strSQL."del varchar(1) NOT NULL default 'N', PRIMARY KEY (id, createdate, ";
		$strSQL = $strSQL."del)) ENGINE=MyISAM COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336";
		
		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database create error!<P>");
			echo "<BR>SQL: ".$strSQL."<BR>";
			echo mysqli_error($conLocal);
		}
		
		// #######################
		// 14. Die Jugendschächer:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_chessbooks (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."chessbook_number int(3) NOT NULL, chessbook_file varchar(255) NOT NULL, ";
		$strSQL = $strSQL."chessbook_topic varchar(255), chessbook_date datetime NOT NULL, createdate datetime NOT NULL, creator ";
		$strSQL = $strSQL."varchar(50) NOT NULL, modifieddate date, modifier varchar(50), ";
		$strSQL = $strSQL."del varchar(1) NOT NULL default 'N', PRIMARY KEY (id, createdate, ";
		$strSQL = $strSQL."del)) ENGINE=MyISAM COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336";
		
		if (!mysqli_query ($conLocal, $strSQL))
		{
			echo("Database update error: $strSQL<P>");
			echo mysqli_error($conLocal);
		}
		
		// ########################
		// 15. Die verbotenen Bots:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_not_allowed_bots (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."server_name varchar(255) NOT NULL, ";
		$strSQL = $strSQL."createdate datetime NOT NULL, creator ";
		$strSQL = $strSQL."varchar(50) NOT NULL, modifieddate date, modifier varchar(50), ";
		$strSQL = $strSQL."del varchar(1) NOT NULL default 'N', PRIMARY KEY (id, createdate, ";
		$strSQL = $strSQL."del)) ENGINE=MyISAM COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336";
		
		if (!mysqli_query ($conLocal, $strSQL))
		{
		    echo("Database update error: $strSQL<P>");
		    echo mysqli_error($conLocal);
		}
		
		// Den Standardinhalt hinzufügen, falls nötig:
		$strSQL = "select id FROM skk_not_allowed_bots WHERE del='N' AND modifieddate IS NULL;";
		
		$result = mysqli_query ($conLocal, $strSQL);
		$num = mysqli_num_rows($result);
		
		// Wurden Datensätze gefunden?
		if ($num == 0)
		{
		    // Wir müssen die Werte schreiben:
		    $now = date("Y-m-d H:i:s");
		    
		    // Nicht erlaubte Bots und Crawler:
		    $strSQL = "INSERT INTO skk_not_allowed_bots (server_name, createdate, creator) VALUES (";
		    $strSQL = $strSQL ."'crawl', '$now', 'SYSTEM');";
		    
		    if (!mysqli_query ($conLocal, $strSQL))
		    {
		        echo("Database insert error: $strSQL<P>");
		        echo mysqli_error($conLocal);
		    }
		    
		    // Nicht erlaubte Bots und Crawler:
		    $strSQL = "INSERT INTO skk_not_allowed_bots (server_name, createdate, creator) VALUES (";
		    $strSQL = $strSQL ."'bot', '$now', 'SYSTEM');";
		    
		    if (!mysqli_query ($conLocal, $strSQL))
		    {
		        echo("Database insert error: $strSQL<P>");
		        echo mysqli_error($conLocal);
		    }
		}
		
		// ##########################################
		// 16. Das Protokoll für die verbotenen Bots:
		$strSQL = "CREATE TABLE IF NOT EXISTS skk_not_allowed_bots_log (id int(11) NOT NULL auto_increment, ";
		$strSQL = $strSQL."server_name varchar(255) NOT NULL, ip varchar(20), ";
		$strSQL = $strSQL."createdate datetime NOT NULL, creator ";
		$strSQL = $strSQL."varchar(50) NOT NULL, modifieddate date, modifier varchar(50), ";
		$strSQL = $strSQL."del varchar(1) NOT NULL default 'N', PRIMARY KEY (id, createdate, ";
		$strSQL = $strSQL."del)) ENGINE=MyISAM COLLATE=latin1_german1_ci DEFAULT CHARSET=latin1 AUTO_INCREMENT=336";
		
		if (!mysqli_query ($conLocal, $strSQL))
		{
		    echo("Database update error: $strSQL<P>");
		    echo mysqli_error($conLocal);
		}
		
		// ##################
		// UPDATE 08.09.2021:
		// Korrektur des Zählers.
		/*$strSQL = "SELECT * FROM skk_news WHERE createdate>'2020-09-01' AND modifieddate IS NULL AND del='N' AND hits>2000;";		
		$rs = mysqli_query ($conLocal, $strSQL);
		$num = mysqli_num_rows($rs);
		
		// Wurden Datensätze gefunden?
		if ($num != 0)
		{
		    // Den Zugriffszähler anhand der Log-Einträge neu berechnen:
		    $i = 0;
		    
		    while ($row = $rs->fetch_object())
		    {
		        $ID[$i] = $row->id;
		        $strSQL = "SELECT COUNT(*) AS AllHits FROM skk_news_hits WHERE news_id=". $ID[$i];

		        $rsCounter = mysqli_query ($conLocal, $strSQL);
		        $numCounter = mysqli_num_rows($rsCounter);

		        if ($numCounter != 0)
		        {
		            while ($rowCounter = $rsCounter->fetch_object())
		            {
		                $AllHits[0] = $rowCounter->AllHits;
		            }
		            $strSQL = "UPDATE skk_news SET hits=" .$AllHits[0]. " WHERE id=".$ID[$i];
		            
		            if (!mysqli_query ($conLocal, $strSQL))
		            {
		                echo("Database insert error: $strSQL<P>");
		                echo mysqli_error($conLocal);
		            }
		        }
		        
		        $i++;
		    }		    		     
		}
		// UPDATE ENDE
		// ###########
		*/
		
		return $conLocal;
	}




	function bCheckMembers($objDBCon)
	// Checks, if a member is available and returns 1, if a value
	// can be found, otherwise 0.
   	{

		// Send the query:
		$strSQL = "SELECT id FROM skk_members";

		if (!(mysqli_query ($objDBCon, $strSQL)))
		{
			echo("Query was not successful!<BR>");
			echo mysqli_error($objDBCon);
			echo("Statement: " . $strSQL . "<BR>");
			exit();
		}

		// Get the first result:
		$result = mysqli_query ($objDBCon, $strSQL);
		
		$num =  mysqli_num_rows($result);

		if ($num > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}




	function IsUrlAvailable($strUrl)
	{
		$timeout = 10; //timeout in sekunden

		if(@fsockopen($strUrl, "80",$errno,$errstr,$timeout))
		{
			return "TRUE";
		}
		else
		{
			return "FALSE";
		}
	}




	function strGetCurrentUser($objDBCon)
	{
		// Ermittelt den Namen des aktuellen Benutzers:
		$strSQL = "SELECT vorname, name FROM skk_members WHERE ip='".$_SERVER['REMOTE_ADDR']."'";
		$strSQL = $strSQL." AND del='N' AND active!='N' AND modifieddate IS NULL";

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo("Query was not successful!<BR>");
			echo mysqli_error($objDBCon);
			echo("Statement: " . $strSQL . "<BR>");
			return "";
		}

		$result = mysqli_query($objDBCon, $strSQL);
 		$num = mysqli_num_rows($result);

		if ($num > 0)
		{
			// $strReturn = mysql_result($result,0,"vorname");
			// $strReturn = $strReturn." ".mysql_result($result,0,"name");
			
			$result->data_seek(0);
			$row = $result->fetch_row();
			$strReturn = $row[0];
			$strReturn = $strReturn." ".$row[1];
			
   			return $strReturn;
		}
		else
		{
			return "SYSTEM";
		}
	}



	function strGetCurrentUserByID($objDBCon, $ux)
	{
		// Ermittelt den Namen des aktuellen Benutzers:
		$ux = base64_decode($ux);
		$ux = strrev($ux);

		$strSQL = "SELECT vorname, name FROM skk_members WHERE id=".$ux;
		$strSQL = $strSQL." AND del='N' AND active!='N' AND modifieddate IS NULL AND ip IS NOT NULL;";

		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo("Query was not successful!<BR>");
			echo mysqli_error($objDBCon);
			echo("Statement: " . $strSQL . "<BR>");
			return "";
		}

		$result = mysqli_query($objDBCon, $strSQL);
 		$num = mysqli_num_rows($result);

		if ($num > 0)
		{
			// ###############################################
			// $strReturn = mysql_result($result,0,"vorname");
   			// $strReturn = $strReturn." ".mysql_result($result,0,"name");
   			
   			$result->data_seek(0);
   			$row = $result->fetch_row();
   			$strReturn = $row[0];
   			$strReturn = $strReturn." ".$row[1];
   			
   			return $strReturn;
		}
		else
		{
			return "SYSTEM";
		}
	}


	function strGetValueFromTable($objDBCon, $strSQL, $strColToGet)
	{
		// ##########################################################
		// Ermittelt de Wert aus der übergebenen Tabelle $strColToGet
		// und gibt diesen zurück.	
		if (!mysqli_query ($objDBCon, $strSQL))
		{
			echo("Query was not successful!<BR>");
			echo mysqli_error($objDBCon);
			echo("Statement: " . $strSQL . "<BR>");
			return "";
		}
	
		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);
	
		if ($RecordCount > 0)
		{
			// $strReturn = mysql_result($result,0,$strColToGet);
			$row = $rs->fetch_assoc();
			$strReturn = $row[$strColToGet];
			
			return $strReturn;
		}
		else
		{
			return "NULL";
		}
	}


	function IsSessionValid($objDBCon, $ux, $neededsecuritylevel)
	{
		// Prüfen, ob der aktuelle Benutzer angemeldet ist:
		$id = base64_decode($ux);
		$id = strrev($id);

		if (trim($id)=="")
		{
			$strSQL = "SELECT ip, active FROM skk_members WHERE lastlogin IS NOT NULL AND del='N' ";
			$strSQL = $strSQL."AND active!='N' AND id=0 AND modifieddate IS NULL AND ip IS NOT NULL;";
		}
		else
		{
			$strSQL = "SELECT ip, active FROM skk_members WHERE lastlogin IS NOT NULL AND del='N' ";
			$strSQL = $strSQL."AND active!='N' AND id=".$id." AND modifieddate IS NULL AND ip IS NOT NULL;";
		}

		if (bCheckRecordset($objDBCon, $strSQL)==0)
		{
			echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
			echo "<TR><TD>".chr(13).chr(10);

			// Die Position der Dateien kann anders lauten!
			if (is_file("../pics/admin/warning.jpg"))
			{
				echo "<IMG SRC='../pics/admin/warning.jpg' border=0>".chr(13).chr(10);
			}
			else
			{
				if (is_file("../../pics/admin/warning.jpg"))
				{
					echo "<IMG SRC='../../pics/admin/warning.jpg' border=0>".chr(13).chr(10);
				}
				else
				{
					echo "<IMG SRC='../../../pics/admin/warning.jpg' border=0>".chr(13).chr(10);
				}
			}

			echo "</TD><TD>Ihre aktuelle Session ist abgelaufen. Bitte melden Sie sich neu im Administrationsbereich an. ".chr(13).chr(10);
			echo "Kopieren Sie bitte vorab nicht gespeicherte Informationen in die Zwischenablage, da diese ansonsten ".chr(13).chr(10);
			echo "verloren gehen k&ouml;nnten.<TD><TR></TABLE><BR><BR>".chr(13).chr(10);

			// Die Position der Dateien kann anders lauten!
			if (is_file("_admin.php"))
			{
				echo "<A HREF='_admin.php'><IMG SRC='../pics/admin/arrow.gif' border=0> Anmeldung im Administrationsbereich.</A><BR><BR>".chr(13).chr(10);
			}
			else
			{
				if (is_file("../_admin.php"))
				{
					echo "<A HREF='../_admin.php'><IMG SRC='../../pics/admin/arrow.gif' border=0> Anmeldung im Administrationsbereich.</A><BR><BR>".chr(13).chr(10);
				}
				else
				{
					echo "<A HREF='../../_admin.php'><IMG SRC='../../../pics/admin/arrow.gif' border=0> Anmeldung im Administrationsbereich.</A><BR><BR>".chr(13).chr(10);
				}
			}

			return 0;
		}
		else
		{
			// Hat der Benutzer die notwendige Berechtigung?
			$rs = mysqli_query($objDBCon, $strSQL);
    		$RecordCount = mysqli_num_rows($rs);

    		// ##########################################################
    		// Alter Code:
			// $nrak = $num - 0 - 1;			
      		// $cursecuritylevel = mysql_result($result,$nrak,"active");      		      		
      		$row = $rs->fetch_object();
      		$cursecuritylevel = $row->active;
      		$cursecuritylevel = trim(strtolower($cursecuritylevel));
			$bOK = "FALSE";

			// R = Redakteur
		    // H = Redakteur und Homepagepflege
	        // A = Admin
      		switch (trim(strtolower($neededsecuritylevel)))
      		{
				case "r":
					// Ist immer OK!
					$bOK = "TRUE";
					break;

				case "h":

					if (($cursecuritylevel=="a") || ($cursecuritylevel=="h"))
					{
						$bOK = "TRUE";
					}
					else
					{
						$bOK = "FALSE";
					}

					break;

				case "a":
					if ($cursecuritylevel=="a")
				 	{
						$bOK = "TRUE";
					}
					else
					{
						$bOK = "FALSE";
					}

					break;

				default:
					$bOK = "FALSE";
      		}

      		// Haben wir das benötigte Recht?
      		if ($bOK=="FALSE")
      		{
      		    echo "<TABLE cellpadding=5 cellspacing=0 border=0>".chr(13).chr(10);
				echo "<TR><TD>".chr(13).chr(10);

				// Die Position der Dateien kann anders lauten!
				if (is_file("../pics/admin/warning.jpg"))
				{
					echo "<IMG SRC='../pics/admin/warning.jpg' border=0>".chr(13).chr(10);
				}
				else
				{
					if (is_file("../../pics/admin/warning.jpg"))
					{
						echo "<IMG SRC='../../pics/admin/warning.jpg' border=0>".chr(13).chr(10);
					}
					else
					{
						echo "<IMG SRC='../../../pics/admin/warning.jpg' border=0>".chr(13).chr(10);
					}
				}

				echo "</TD><TD>Sie haben nicht ausreichend Rechte f&uuml;r das Ausf&uuml;hren dieser ";
				echo "Programmfunktion. Bitte w&auml;hlen Sie eine andere Programmfunktion.<TD><TR></TABLE><BR><BR>".chr(13).chr(10);

				return 0;
      		}
		}

		return 1;
	}


	function bCheckRecordset($objDBCon, $strSQL)
	// Checks, if a value is available and returns 1, if a value
	// can be found, otherwise 0.
   	{
		// Send the query:
		$rs = mysqli_query($objDBCon, $strSQL);
		$RecordCount = mysqli_num_rows($rs);
 		
		// Get the first result:
		if ($RecordCount > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}


	function bIsAFROValid($objDBCon)
	// Checks, if AFRO data are allowed to access through web user.
   	{
   		$curDB = "DB424698";
		$curUser = "U424698";

		// Verbindung aufbauen:
		// Version STRATO:
		//if (!($conLocal = mysql_connect("rdbms.strato.de", $curUser,"h!SWjuWW")))
		// Version LOCALHOST:
		//if (!($conLocal = mysql_connect("localhost:/var/lib/mysql/mysql.sock", $curUser,"h!SWjuWW")))
		// VERSION SKK:
		if (!($objDBCon = mysqli_connect("localhost", $curUser,"h!SWjuWW")))
		{
			echo "Server connection to database failed!<P>".chr(13).chr(10);
			echo mysqli_error($objDBCon);
			return 0;
		}

		// 2. Select database:
		if (!mysqli_select_db ($objDBCon, $curDB))
		{
			echo "Database selection error!<P>".chr(13).chr(10);
			echo mysqli_error($objDBCon);
			return 0;
		}

		// Send the query:
		$strSQL = "SELECT id FROM skk_afro_config WHERE showafrolink='J' AND modifieddate IS NULL AND del='N';";
		$result = mysqli_query($objDBCon, $strSQL);
 		$num = mysqli_num_rows($result);


		// Get the first result:
		if ($num > 0)
		{
			return 1;
		}
		else
		{
			echo "<TABLE cellpadding=5 cellspacing=0 border=1 bgcolor=#FFFFFF>".chr(13).chr(10);
			echo "<TR><TD>".chr(13).chr(10);

			// Die Position der Dateien kann anders lauten!
			if (is_file("../pics/admin/warning.jpg"))
			{
				echo "<IMG SRC='../pics/admin/warning.jpg' border=0>".chr(13).chr(10);
			}
			else
			{
				if (is_file("../../pics/admin/warning.jpg"))
				{
					echo "<IMG SRC='../../pics/admin/warning.jpg' border=0>".chr(13).chr(10);
				}
				else
				{
					echo "<IMG SRC='../../../pics/admin/warning.jpg' border=0>".chr(13).chr(10);
				}
			}

			echo "</TD><TD WIDTH='100%'>Der Zugang auf die Inhalte der AFRO - Seite ist derzeit deaktiviert. ";
			echo "Bitte versuchen Sie es zu einem späteren Zeitpunkt nochmals.<TD><TR></TABLE><BR><BR>".chr(13).chr(10);
		}
	}


	function bCheckCommentTimeInterval($objDBCon)
	// Checks, if there are more than 10 write requests for an user comment
	// in the last 10 minutes und returns 0, if this was the case.
   	{
   		/*$curDB = "DB424698";
		$curUser = "U424698";

		// Verbindung aufbauen:
		// Version STRATO:
		//if (!($conLocal = mysql_connect("rdbms.strato.de", $curUser,"h!SWjuWW")))
		// Version LOCALHOST:
		//if (!($conLocal = mysql_connect("localhost:/var/lib/mysql/mysql.sock", $curUser,"h!SWjuWW")))
		// VERSION SKK:
		if (!($objDBCon = mysqli_connect("localhost:/var/run/mysqld/mysqld.sock", $curUser,"h!SWjuWW")))
		{
			echo "Server connection to database failed!<P>".chr(13).chr(10);
			echo mysqli_error($objDBCon);
			return 0;
		}

		// 2. Select database:
		if (!mysqli_select_db ($objDBCon, $curDB))
		{
			echo "Database selection error!<P>".chr(13).chr(10);
			echo mysqli_error($conLocal);
			return 0;
		}*/

		$rs = mysqli_query ($objDBCon, "SELECT DATE_SUB(now(), INTERVAL 10 MINUTE)");
		$num = mysqli_num_rows($rs);

		// Wurden Datensätze gefunden?
		if ($num > 0)
		{
			// Das Temporärdatum ermitteln:
			// $tmpDate = mysql_result($result,0,0);
			$rs->data_seek(0);
			$row = $rs->fetch_row();
			$tmpDate = $row[0];
			
			$strSQL = "select id FROM skk_comments_requests WHERE createdate > '$tmpDate';";

			$rs = mysqli_query ($objDBCon, $strSQL);
			$num = mysqli_num_rows($rs);

			// Gab es mehr als 10 Anfragen innerhalb der letzten 10 Minuten?
			if ($num > 10)
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		return 0;
   	}
?>
