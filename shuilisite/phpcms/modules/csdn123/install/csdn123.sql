DROP TABLE IF EXISTS `phpcms_zd_news`;
CREATE TABLE `phpcms_zd_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(800) DEFAULT NULL,
  `getdatetime` int(11) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `fromurl` varchar(800) DEFAULT NULL,
  `typeid` int(11) DEFAULT NULL,
  `is_import` int(11) DEFAULT NULL,
  `showfromurl` int(11) DEFAULT NULL,
  `savelocalimg` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
