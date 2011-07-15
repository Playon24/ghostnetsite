DROP TABLE IF EXISTS `wow_db_version`;
CREATE TABLE `wow_db_version` (
  `version` int(11) NOT NULL DEFAULT '0',
  `prev_name` varchar(255) NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='DB version controller';

INSERT INTO `wow_db_version` VALUES (161, 'wow');