DROP TABLE IF EXISTS `wow_users`;
CREATE TABLE `wow_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `treatment` tinyint(4) DEFAULT NULL,
  `email` text NOT NULL,
  `sha_pass_hash` text,
  `question_id` tinyint(4) DEFAULT NULL,
  `question_answer` text,
  `birthdate` int(11) DEFAULT NULL,
  `country_code` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;