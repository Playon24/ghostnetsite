ALTER TABLE  `wow_users` ADD  `pass_reset_ticket` VARCHAR( 32 ) NULL DEFAULT NULL AFTER  `sha_pass_hash` ADD UNIQUE (`pass_reset_ticket`);
