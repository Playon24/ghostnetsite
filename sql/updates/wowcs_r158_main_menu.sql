UPDATE  `wow_main_menu` SET  `href` =  '/' WHERE  `id` =1 LIMIT 1 ;
UPDATE  `wow_main_menu` SET  `href` =  '/game/' WHERE  `id` =2 LIMIT 1 ;
UPDATE  `wow_main_menu` SET  `href` =  '/community/' WHERE  `id` =3 LIMIT 1 ;
UPDATE  `wow_main_menu` SET  `href` =  '/media/' WHERE  `id` =4 LIMIT 1 ;
UPDATE  `wow_main_menu` SET  `href` =  '/forum/' WHERE  `id` =5 LIMIT 1 ;
UPDATE  `wow_main_menu` SET  `href` =  '/services/' WHERE  `id` =6 LIMIT 1 ;
-- Drop unused tables
DROP TABLE  `wow_bookmarks` ,
`wow_instance_template` ,
`wow_item_sources` ,
`wow_items` ,
`wow_login_characters`, `wow_talenttab` ;
ALTER TABLE  `wow_source` RENAME  `wow_item_sources` ;