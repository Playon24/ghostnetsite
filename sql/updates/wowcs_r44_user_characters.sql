DROP TABLE IF EXISTS `wow_user_characters`;
CREATE TABLE `wow_user_characters` (
  `account` int(11) NOT NULL,
  `index` int(11) default '1',
  `guid` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `class` smallint(6) NOT NULL,
  `class_text` varchar(50) NOT NULL,
  `race` smallint(6) NOT NULL,
  `race_text` varchar(50) NOT NULL,
  `gender` smallint(6) NOT NULL,
  `level` int(11) NOT NULL,
  `realmId` int(11) NOT NULL default '0',
  `realmName` varchar(255) NOT NULL,
  `isActive` int(11) default NULL,
  `faction` smallint(1) NOT NULL,
  `faction_text` varchar(15) NOT NULL,
  `guildId` int(11) NOT NULL,
  `guildName` varchar(50) NOT NULL,
  `guildUrl` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY  (`account`,`guid`,`realmId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;