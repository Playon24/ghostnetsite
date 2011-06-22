ALTER TABLE  `wow_users` ADD  `country` TEXT NOT NULL;
ALTER TABLE  `wow_users` DROP  `account_id`;
CREATE TABLE `wow_users_accounts` (
`id` INT NOT NULL ,
`account_id` INT NOT NULL ,
PRIMARY KEY ( `id` , `account_id` ) 
);