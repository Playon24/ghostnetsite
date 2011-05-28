ALTER TABLE  `wow_users` ADD  `gender` ENUM(  'Mr',  'Ms',  'Mrs',  'Miss' ) NOT NULL ,
ADD  `email` TEXT NOT NULL ,
ADD  `password` TEXT NOT NULL ,
ADD  `secredQ` TEXT NOT NULL ,
ADD  `secredA` TEXT NOT NULL ,
ADD  `dob` DATE NOT NULL
