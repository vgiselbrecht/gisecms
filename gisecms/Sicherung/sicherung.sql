DROP TABLE `content`;
CREATE TABLE `content` (  `id` bigint(4) NOT NULL AUTO_INCREMENT,  `seite` varchar(80) NOT NULL,  `type` varchar(80) NOT NULL,  `position` text NOT NULL,  `public` varchar(4) NOT NULL,  `text` longtext NOT NULL,  PRIMARY KEY (`id`),  FULLTEXT KEY `name` (`seite`),  FULLTEXT KEY `name_2` (`seite`),  FULLTEXT KEY `text` (`text`),  FULLTEXT KEY `name_3` (`seite`),  FULLTEXT KEY `text_2` (`text`),  FULLTEXT KEY `text_3` (`text`)) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;
INSERT INTO `content` VALUES('78', '62', 'Texteditor', '7', '', '<p>test</p>');
INSERT INTO `content` VALUES('80', '62', 'HTML-PHP Editor', '6', '', '            			4');
INSERT INTO `content` VALUES('82', '62', 'HTML-PHP Editor', '4', '', '                        <?php echo \"test\"; ?>          															');
INSERT INTO `content` VALUES('86', '62', 'Texteditor', '5', '', '<p>t</p>');
INSERT INTO `content` VALUES('85', '62', 'Texteditor', '1', '', '<p>2</p>');
INSERT INTO `content` VALUES('87', '11', 'Texteditor', '1', '', '<p>Willkommen auf der Testumgebung</p>');
INSERT INTO `content` VALUES('91', '62', 'HTML-PHP Editor', '3', '', '                                hdfh   									');
INSERT INTO `content` VALUES('92', '62', 'Image Gallery', '2', '', '');
INSERT INTO `content` VALUES('93', '11', 'Image Gallery', '2', '', '');
INSERT INTO `content` VALUES('100', '69', 'HTML-PHP Editor', '2', '', '            <?php print \"Hallo\"; ?>            						');
INSERT INTO `content` VALUES('99', '69', 'Texteditor', '1', '', '<p>Test Text</p>');
INSERT INTO `content` VALUES('101', '69', 'Image Gallery', '3', '', '');
INSERT INTO `content` VALUES('102', '81', 'HTML-PHP Editor', '1', '', '');
DROP TABLE `gallery`;
CREATE TABLE `gallery` (  `id` tinyint(4) NOT NULL AUTO_INCREMENT,  `seite` varchar(80) NOT NULL,  `text` text NOT NULL,  `link` text NOT NULL,  PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
INSERT INTO `gallery` VALUES('37', '101', 'Parker', '/daten/image/427px-Sarah_Jessica_Parker_at_the_2009_Tribeca_Film_Festival_3.jpg');
INSERT INTO `gallery` VALUES('35', '93', 'dfsfd', '/daten/image/569px-MartinLandau2008TIFF.jpg');
INSERT INTO `gallery` VALUES('36', '101', 'Johny Depp', '/daten/image/494px-Johnny_Depp_(July_2009)_2.jpg');
INSERT INTO `gallery` VALUES('31', '92', 'ertt', '/daten/image/569px-MartinLandau2008TIFF.jpg');
INSERT INTO `gallery` VALUES('33', '92', '', '/daten/image/_Enjoy_your_breakfast__by_nocturnalMoTH.jpg');
DROP TABLE `login`;
CREATE TABLE `login` (  `id` tinyint(4) NOT NULL AUTO_INCREMENT,  `name` varchar(80) NOT NULL,  `passwort` varchar(80) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
INSERT INTO `login` VALUES('1', 'Admin', '098f6bcd4621d373cade4e832627b4f6');
INSERT INTO `login` VALUES('2', '', 'd41d8cd98f00b204e9800998ecf8427e');
DROP TABLE `menu1`;
CREATE TABLE `menu1` (  `id` tinyint(4) NOT NULL AUTO_INCREMENT,  `template_id` varchar(80) NOT NULL,  `menu_nr` varchar(80) NOT NULL,  `css` text NOT NULL,  `code` text NOT NULL,  PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
INSERT INTO `menu1` VALUES('15', '20', '2', '', '<hr>');
INSERT INTO `menu1` VALUES('14', '20', '1', 'font-family: Verdana;\r\n', '<hr>');
DROP TABLE `menu_zustande`;
CREATE TABLE `menu_zustande` (  `id` tinyint(4) NOT NULL AUTO_INCREMENT,  `template_id` varchar(80) NOT NULL,  `menu_nr` varchar(80) NOT NULL,  `name` text NOT NULL,  PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;
INSERT INTO `menu_zustande` VALUES('46', '20', '1', 'zustand2');
INSERT INTO `menu_zustande` VALUES('47', '20', '1', 'zustand1');
DROP TABLE `menupunkte`;
CREATE TABLE `menupunkte` (  `id` bigint(20) NOT NULL AUTO_INCREMENT,  `zustand_id` varchar(80) NOT NULL,  `name` varchar(80) NOT NULL,  `position` varchar(80) NOT NULL,  `link` text NOT NULL,  `einruckung` varchar(80) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=182 DEFAULT CHARSET=latin1;
INSERT INTO `menupunkte` VALUES('154', '47', 'gt', '2', '', '0');
INSERT INTO `menupunkte` VALUES('153', '47', 'hallo', '1', 'http://www.priesterseminar-muenchen.de/repos/pic_content_left_popup/animation.gif', '0');
INSERT INTO `menupunkte` VALUES('130', '41', 'ert', '1', '', '0');
INSERT INTO `menupunkte` VALUES('131', '41', 'gert', '2', '', '0');
INSERT INTO `menupunkte` VALUES('132', '41', 't', '3', '', '0');
INSERT INTO `menupunkte` VALUES('177', '46', 'google', '4', 'http://www.google.at', '0');
INSERT INTO `menupunkte` VALUES('178', '46', 'start', '3', 'Home', '0');
INSERT INTO `menupunkte` VALUES('180', '46', 'fd', '2', 'fdsgf', '0');
INSERT INTO `menupunkte` VALUES('181', '46', 'fgds', '1', 'fgsdf', '0');
DROP TABLE `seiten`;
CREATE TABLE `seiten` (  `id` tinyint(4) NOT NULL AUTO_INCREMENT,  `name` varchar(80) NOT NULL,  `template` varchar(80) NOT NULL,  `menu1` varchar(80) NOT NULL,  `menu2` varchar(80) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;
INSERT INTO `seiten` VALUES('29', 'Dokumentation', 'modern', '46', '');
INSERT INTO `seiten` VALUES('18', 'Download', 'modern', '46', '');
INSERT INTO `seiten` VALUES('11', 'Home', 'modern', '46', '');
INSERT INTO `seiten` VALUES('21', 'Screenshots', 'modern', '46', '');
INSERT INTO `seiten` VALUES('62', 'Impressum', 'modern', '', '');
INSERT INTO `seiten` VALUES('64', 'hallo', 'modern', '', '');
INSERT INTO `seiten` VALUES('77', 'hallo/test', 'modern', '', '');
DROP TABLE `template`;
CREATE TABLE `template` (  `id` tinyint(4) NOT NULL AUTO_INCREMENT,  `name` varchar(80) NOT NULL,  `css` text NOT NULL,  `code` text NOT NULL,  PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
INSERT INTO `template` VALUES('20', 'modern', '	<style type=\"text/css\">\r\n	a:hover { text-decoration:none !important; }\r\n	.header h1 {color: #47c8db; font: bold 32px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 40px;}\r\n	.header p {color: #c6c6c6; font: normal 12px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 18px;}\r\n	.sidebar table.toc-table  { color: #767676; margin: 0; padding: 0; font-size: 12px;font-family: Helvetica, Arial, sans-serif; }\r\n	.sidebar table.toc-table td {padding: 0 0 5px; margin: 0;}\r\n	.sidebar h4{color:#eb8484; font-size: 11px;line-height: 16px;font-family: Helvetica, Arial, sans-serif; margin: 0; padding: 0;}\r\n	.sidebar p {color: #989898; font-size: 11px;line-height: 16px;font-family: Helvetica, Arial, sans-serif; margin: 0; padding: 0;}\r\n	.sidebar p a{color: #0eb6ce; text-decoration: none;}\r\n	.content h2 {color:#646464; font-weight: bold; margin: 0; padding: 0; line-height: 26px; font-size: 18px; font-family: Helvetica, Arial, sans-serif;  }\r\n	.content p {color:#767676; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 12px;font-family: Helvetica, Arial, sans-serif;}\r\n	.content a {color: #0eb6ce; text-decoration: none;}\r\n	.footer p {font-size: 11px; color:#7d7a7a; margin: 0; padding: 0; font-family: Helvetica, Arial, sans-serif;}\r\n	.footer a {color: #0eb6ce; text-decoration: none;}\r\n	.cont {\r\n        position: relative;\r\n        z-index: 0;\r\n        width: 400px;\r\n        text-align: left;\r\n        font-family: Arial;\r\n        }\r\n	</style>\r\n', '  <body style=\"margin: 0; padding: 0; background: #4b4b4b url(images/bg_email.png);\" bgcolor=\"#4b4b4b\">\r\n  	<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" width=\"100%\" style=\"padding: 35px 0; background: #4b4b4b url(images/bg_email.png);\" bgcolor=\"#4b4b4b\">\r\n		  <tr>\r\n		  	<td align=\"center\" style=\"margin: 0; padding: 0; background: url(images/bg_email.png);\" >\r\n			    <table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" width=\"600\" style=\"font-family: Helvetica, Arial, sans-serif;background:#2a2a2a;\" class=\"header\">\r\n			      	<tr>\r\n						<td width=\"600\" align=\"left\" style=\"padding: font-size: 0; line-height: 0; height: 7px;\" height=\"7\" colspan=\"2\"><img src=\"images/bg_header.png\" alt=\"header bg\"></td>\r\n				      </tr>\r\n					<tr>\r\n					<td width=\"20\"style=\"font-size: 0px;\"> </td>\r\n			        <td width=\"580\" align=\"left\" style=\"padding: 18px 0 10px;\">\r\n						<h1 style=\"color: #47c8db; font: bold 32px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 40px;\">GiseCMS</h1>\r\n						<p style=\"color: #c6c6c6; font: normal 12px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 18px;\">Free Content Management System</p>\r\n			        </td>\r\n			      </tr>\r\n				</table><!-- header-->\r\n				<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" width=\"600\" style=\"font-family: Helvetica, Arial, sans-serif; background: #fff url(images/bg_table.png) repeat-y;\" bgcolor=\"#fff\">\r\n\r\n					<tr>\r\n\r\n					<td width=\"186\" valign=\"top\" align=\"left\" style=\"font-family: Helvetica, Arial, sans-serif; background: #fff url(images/bg_table.png) repeat-y;\" bgcolor=\"#fff\" class=\"sidebar\">\r\n						<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\"  style=\"color: #717171; font: normal 11px Helvetica, Arial, sans-serif; margin: 0; padding: 0;\" width=\"150\">\r\n                         \r\n	<td style=\"padding: 15px 0 7px 20px;\"  valign=\"top\" align=\"left\">\r\n		\r\n<!-- left -->\r\n\r\n		<hr><a href=\"Home\" style=\"text-decoration:none;\"><font color=\"black\">Startseite</font></a><br />\r\n	        <hr><a href=\"Download\" style=\"text-decoration:none;\"><font color=\"black\">Download</font></a><br />\r\n		<hr><a href=\"Dokumentation\" style=\"text-decoration:none;\"><font color=\"black\">Dokumentation</font></a><br />\r\n		<hr><a href=\"Screenshots\" style=\"text-decoration:none;\"><font color=\"black\">Screenshots</font></a><br />\r\n		<hr><a href=\"Impressum\" style=\"text-decoration:none;\"><font color=\"black\">Impressum</font></a><br />\r\n		<hr>\r\n<?php include(\"frames/suche.php\"); ?><br />\r\n<br />\r\n<?php include(\"frames/menu1.php\"); ?>\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<?php include(\"frames/menu2.php\"); ?>\r\n<br />\r\n<br />\r\n<br />\r\n<br />					\r\n					\r\n\r\n				</td>\r\n\r\n						</table>\r\n					</td>\r\n\r\n					<td width=\"414\" valign=\"top\" align=\"left\" style=\"font-family: Helvetica, Arial, sans-serif; padding: 0px 0 0;\" class=\"content\">\r\n						<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\"  style=\"color: #717171; font: normal 11px Helvetica, Arial, sans-serif; margin: 0; padding: 0;\" width=\"394\">\r\n\r\n	<td style=\"padding: 15px 0 7px 20px;\"  valign=\"top\" align=\"left\">\r\n		\r\n                         <!-- content --> \r\n                         <div class=\"cont\">\r\n<?php include(\"frames/content.php\"); ?>\r\n</div>\r\n				</td>\r\n\r\n						</table>\r\n					</td>\r\n			      </tr>\r\n				  	<tr>\r\n						<td width=\"600\" align=\"left\" style=\"padding: font-size: 0; line-height: 0; height: 3px;\" height=\"3\" colspan=\"2\"><img src=\"images/bg_bottom.png\" alt=\"header bg\"></td>\r\n				      </tr>\r\n				</table><!-- body -->\r\n				<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" width=\"600\" style=\"font-family: Helvetica, Arial, sans-serif; line-height: 10px;\" class=\"footer\">\r\n				<tr>\r\n			        <td align=\"center\" style=\"padding: 5px 0 10px; font-size: 11px; color:#7d7a7a; margin: 0; line-height: 1.2;font-family: Helvetica, Arial, sans-serif;\" valign=\"top\">\r\n						\r\n					</td>\r\n			      </tr>\r\n				</table><!-- footer-->\r\n		  	</td>\r\n		</tr>\r\n    </table>\r\n  </body>');
DROP TABLE `zusatz`;
CREATE TABLE `zusatz` (  `id` tinyint(4) NOT NULL AUTO_INCREMENT,  `name` varchar(80) NOT NULL,  `info` varchar(80) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
INSERT INTO `zusatz` VALUES('1', 'startseite', 'Home');
INSERT INTO `zusatz` VALUES('2', 'startseite', 'Home');