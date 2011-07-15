ALTER TABLE  `wow_users` ADD  `cookie_session_key` VARCHAR( 40 ) NULL DEFAULT NULL AFTER  `pass_reset_ticket`, ADD UNIQUE (`cookie_session_key`);
