UPDATE  `wow_db_version` SET  `version` =  '177';

CREATE TABLE  `wow_forum_threads_reads` (
`thread_id` INT NOT NULL ,
`account` INT NOT NULL ,
`read_date` DATETIME NOT NULL,
`page` INT NOT NULL
) ENGINE = MYISAM ;

ALTER TABLE  `wow_forum_threads_reads` ADD UNIQUE (`thread_id` ,`account`);

