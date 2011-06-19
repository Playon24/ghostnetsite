ALTER TABLE `wow_forum_threads` ADD `author_account` INT NOT NULL AFTER `author_id` ;
ALTER TABLE `wow_forum_posts` CHANGE `post_id` `post_id` INT( 11 ) DEFAULT NULL AUTO_INCREMENT;