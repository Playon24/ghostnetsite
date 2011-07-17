UPDATE  `wow_db_version` SET  `version` =  '182';

ALTER TABLE  `wow_forum_posts` ADD `deleted` INT( 11 ) NULL DEFAULT NULL;
