UPDATE  `wow_db_version` SET  `version` =  '170';

ALTER TABLE `wow_forum_posts` ADD `author_account` INT NOT NULL AFTER `author_id` ;
