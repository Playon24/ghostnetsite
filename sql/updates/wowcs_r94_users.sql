ALTER TABLE  `wow_users` ADD  `country` TEXT NOT NULL;
ALTER TABLE  `wow_users` DROP  `account_id`;
CREATE TABLE  `wow_users_accounts` (
`id` INT NOT NULL AUTO_INCREMENT,
`account_id` INT NOT NULL
) ENGINE = MYISAM ;
ALTER TABLE  `wow_users_accounts` DROP PRIMARY KEY ,
ADD PRIMARY KEY (  `id` ,  `account_id` ) ;
