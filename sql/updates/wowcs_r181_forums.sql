UPDATE  `wow_db_version` SET  `version` =  '181';

DROP TABLE IF EXISTS `wow_forum_posts`;
CREATE TABLE IF NOT EXISTS `wow_forum_posts` (
  `post_id` int(11) NOT NULL auto_increment,
  `thread_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `bn_id` int(11) NOT NULL,
  `character_guid` int(11) NOT NULL,
  `blizzpost` smallint(1) NOT NULL default '0',
  `blizz_name` varchar(12) NOT NULL,
  `message` text NOT NULL,
  `post_date` datetime NOT NULL,
  `author_ip` varchar(15) NOT NULL,
  `edit_date` datetime default NULL,
  PRIMARY KEY  (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `wow_forum_threads`;
CREATE TABLE IF NOT EXISTS `wow_forum_threads` (
  `thread_id` int(11) NOT NULL auto_increment,
  `cat_id` int(11) NOT NULL,
  `bn_id` int(11) NOT NULL,
  `character_guid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `views` int(11) NOT NULL,
  `flags` int(11) NOT NULL,
  PRIMARY KEY  (`thread_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `wow_forum_threads_reads`;
CREATE TABLE IF NOT EXISTS `wow_forum_threads_reads` (
  `thread_id` int(11) NOT NULL,
  `bn_id` int(11) NOT NULL,
  `read_date` datetime NOT NULL,
  `page` int(11) NOT NULL,
  `last_post_id` int(11) NOT NULL,
  UNIQUE KEY `thread_id` (`thread_id`,`bn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
