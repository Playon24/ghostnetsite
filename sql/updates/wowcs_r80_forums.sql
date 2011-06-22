DROP TABLE IF EXISTS `wow_forum_category`;
CREATE TABLE `wow_forum_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `header` smallint(1) NOT NULL DEFAULT '0',
  `parent_cat` int(11) NOT NULL DEFAULT '-1',
  `short` smallint(1) DEFAULT '0',
  `realm_cat` smallint(1) NOT NULL DEFAULT '0',
  `gmlevel` int(11) NOT NULL DEFAULT '0',
  `title_de` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_es` varchar(255) NOT NULL,
  `title_fr` varchar(255) NOT NULL,
  `title_ru` varchar(255) NOT NULL,
  `desc_de` varchar(255) NOT NULL,
  `desc_en` varchar(255) NOT NULL,
  `desc_es` varchar(255) NOT NULL,
  `desc_fr` varchar(255) NOT NULL,
  `desc_ru` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

INSERT INTO `wow_forum_category` VALUES (1, 1, -1, 0, 0, 0, 'Support', 'Support', 'Asistencia', 'Assistance', 'Поддержка', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (2, 1, -1, 0, 0, 0, 'Community', 'Community', 'Comunidad', 'Communaut&#233;', 'Сообщество', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (3, 1, -1, 0, 0, 0, 'Gameplay', 'Gameplay', 'Experiencia de juego', 'Exp&#233;rience de jeu', 'Игровой процесс', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (4, 1, -1, 0, 0, 0, 'PvP - Spieler gegen Spieler', 'Player versus Player', 'JcJ', 'Joueur contre Joueur', 'Бои между игроками (PvP)', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (5, 1, -1, 0, 0, 0, 'Klassenrollen', 'Class Roles', 'Funci&#243;n de clases', 'Fonctions des classes', 'Классовые роли', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (6, 1, -1, 1, 0, 0, 'Klassen', 'Classes', 'Clases', 'Classes', 'Классы', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (7, 0, 1, 0, 0, 0, '', 'Customer Support', '', '', 'Служба поддержки', '', 'Blizzard Support Agent moderated forum to discuss and inquire about in-game and account related issues.', '', '', 'Форум, модерируемый представителями служб поддержки Blizzard, предназначенный для вопросов и обсуждения проблем, связанных с игрой или учетными записями.', 'gmsupport.gif');
INSERT INTO `wow_forum_category` VALUES (8, 0, 1, 0, 0, 0, 'Technical Support', '', '', '', 'Техническая поддержка', '', 'For technical issues including problems installing or patching World of Warcraft, connecting to the realms or crashing during game play.', '', '', 'Помощь в устранении технических проблем с установкой и обновлением World of Warcraft, соединением с игровыми мирами и зависанием игры.', 'techsupport.gif');
INSERT INTO `wow_forum_category` VALUES (9, 0, 1, 0, 0, 0, '', 'Service Status', '', '', 'Состояние игровых миров', '', 'Collection of important messages regarding the status of services, such as issues relating to realms.', '', '', 'Собрание важных сообщений о статусе игровых миров.', 'blizzard.gif');
INSERT INTO `wow_forum_category` VALUES (10, 0, 2, 0, 0, 0, '', 'Recruitment', '', '', 'Поиск игроков', '', 'Meeting place for those seeking a guild, new members, Arena teammates and leveling partners.', '', '', 'Место встречи одиноких душ: здесь вы найдете гильдию, подберете напарников для Арены и «прокачки» персонажей.', 'recruitment.gif');
INSERT INTO `wow_forum_category` VALUES (11, 0, 2, 0, 0, 0, '', 'Raid and Guild Leadership', '', '', 'Главы гильдий и лидеры рейдов', '', 'A place for new or experienced raid or guild leaders to share tips, discuss challenges and encourage positive leadership development.', '', '', 'Поделитесь своими советами и узнайте все самое захватывающее о буднях глав гильдий и лидеров рейдов.', 'leadership.gif');
INSERT INTO `wow_forum_category` VALUES (12, 0, 2, 0, 0, 0, '', 'Events and Fan Creations', '', '', 'Жизнь сообщества', '', 'Share the amazing creativity of the World of Warcraft community.', '', '', 'Поделитесь своим творчеством с другими игроками или вместе организуйте незабываемое мероприятие.', 'events.gif');
INSERT INTO `wow_forum_category` VALUES (13, 0, 2, 0, 0, 0, '', 'BlizzCon', '', '', 'BlizzCon', '', 'The place to share travel tips, past experiences, expectations, and everything else concerning BlizzCon.', '', '', 'Поделитесь советами для путешествующих, прошлым опытом, ожиданиями и всем остальным, что касается BlizzCon.', 'blizzcon.gif');
INSERT INTO `wow_forum_category` VALUES (14, 0, 3, 0, 0, 0, '', 'Newcomers', '', '', 'Помощь новичкам', '', 'Beginners of all levels, meet experienced and helpful players. First stop for those key hints and tips.', '', '', 'Чувствуете себя новичком? Не беда! Здесь вам подскажут выход из ситуации.', 'newcomers.gif');
INSERT INTO `wow_forum_category` VALUES (15, 0, 3, 0, 0, 0, '', 'Quests', '', '', 'Задания', '', 'Interesting or tricky quests, or just which quests to do when.', '', '', 'Застряли в ходе выполнения? Или просто хотите поделиться интересными заданиями? Тогда вам сюда.', 'quests.gif');
INSERT INTO `wow_forum_category` VALUES (16, 0, 3, 0, 0, 0, '', 'Professions', '', '', 'Профессии', '', 'Crafters of every trade, share your wisdom and experience.', '', '', 'Раскройте секреты мастеров различных ремесел, а также поделитесь информацией о самых «рыбных» местах.', 'professions.gif');
INSERT INTO `wow_forum_category` VALUES (17, 0, 3, 0, 0, 0, '', 'Achievements', '', '', 'Достижения', '', 'There is an achievement for almost everything. Some want them all, some just want the really tough ones.', '', '', 'Одни пытаются добиться всего и сразу, а другие усердно работают над получением самых сложных достижений.', 'achievements.gif');
INSERT INTO `wow_forum_category` VALUES (18, 0, 3, 0, 0, 0, '', 'Role-Playing', '', '', 'Ролевая игра', '', 'The gathering place for both role-playing and talking about role-playing.', '', '', 'Посидите в таверне с орками и эльфийками, а также обсудите все аспекты ролевой игры с единомышленниками.', 'roleplay.gif');
INSERT INTO `wow_forum_category` VALUES (19, 0, 3, 0, 0, 0, '', 'Story', '', '', 'История', '', 'Uncover and discuss the Warcraft Universe and storylines of Azeroth.', '', '', 'Узнайте все об истории Азерота и вселенной Warcraft.', 'lore.gif');
INSERT INTO `wow_forum_category` VALUES (20, 0, 3, 0, 0, 0, '', 'Raids and Dungeons', '', '', 'Рейды и подземелья', '', 'Whether you are 5, 10 or 25, this is your hall of discussion.', '', '', 'Пять вас, десять или двадцать пять – значения не имеет. Этот раздел создан специально для вас!', 'dungeons.gif');
INSERT INTO `wow_forum_category` VALUES (21, 0, 3, 0, 0, 0, '', 'General', '', '', 'Общие темы', '', 'Can&#39;t find a dedicated forum for your gameplay topic? The melting pot of General at your service.', '', '', 'Не можете найти подходящий раздел для обсуждения игры? Добро пожаловать в общий котел! ', 'general.gif');
INSERT INTO `wow_forum_category` VALUES (22, 0, 3, 0, 0, 0, '', 'Interface and Macros', '', '', 'Интерфейс и макросы', '', 'Custom interface and helpful macros, always worth checking out.', '', '', 'Пытаетесь настроить макросы и изменить пользовательский интерфейс? Загляните сюда.', 'ui.gif');
INSERT INTO `wow_forum_category` VALUES (23, 0, 4, 0, 0, 0, '', 'Arena and Rated Battlegrounds', '', '', 'Арена и рейтинговые поля боя ', '', 'Do you compete in Arenas or Rated Battlegrounds? Share tactics, thoughts and experiences with your peers here.', '', '', 'Любите соревнования и сражения на максимуме возможностей? Тогда вам сюда. Здесь обсуждаются бои на Аренах и рейтинговых полях боя.', 'arenas.gif');
INSERT INTO `wow_forum_category` VALUES (24, 0, 4, 0, 0, 0, '', 'Battlegrounds and World PvP', '', '', 'PvP на полях боя и за их пределами', '', 'Find or share advice, tips, and thoughts about Battlegrounds and World PvP.', '', '', 'Вы новичок в PvP? Любите ходить на поля боя ради развлечения или сражаться за их пределами? Тогда вы непременно найдете единомышленников в этом разделе.', 'pvp.gif');
INSERT INTO `wow_forum_category` VALUES (25, 0, 5, 0, 0, 0, '', 'Damage Dealing', '', '', 'Нанесение урона', '', 'Whether by steel or magic, damage - lots of it - is your art of perfection.', '', '', 'Будь то магия или клинок, большой урон – ваш способ доказать свое превосходство.', 'role_dd.gif');
INSERT INTO `wow_forum_category` VALUES (26, 0, 5, 0, 0, 0, '', 'Healing', '', '', 'Лечение', '', 'Keeping your allies alive, sometimes seemingly against their intentions.', '', '', 'Здесь вы узнаете, как сохранить жизнь вашим союзникам, даже если они всячески сопротивляются.', 'role_heal.gif');
INSERT INTO `wow_forum_category` VALUES (27, 0, 5, 0, 0, 0, '', 'Tanking', '', '', 'Танкование', '', 'Blocking the path of your enemy, shielding your companions from certain death.', '', '', 'Враг не пройдет, а щит прикроет спины стремительно отступающих героев!', 'role_tank.gif');
INSERT INTO `wow_forum_category` VALUES (28, 0, 6, 0, 0, 0, '', 'Warrior', '', '', 'Воин', '', '', '', '', '', 'class_1.gif');
INSERT INTO `wow_forum_category` VALUES (29, 0, 6, 0, 0, 0, '', 'Paladin', '', '', 'Паладин', '', '', '', '', '', 'class_2.gif');
INSERT INTO `wow_forum_category` VALUES (30, 0, 6, 0, 0, 0, '', 'Druid', '', '', 'Друид', '', '', '', '', '', 'class_11.gif');
INSERT INTO `wow_forum_category` VALUES (31, 0, 6, 0, 0, 0, '', 'Rogue', '', '', 'Разбойник', '', '', '', '', '', 'class_4.gif');
INSERT INTO `wow_forum_category` VALUES (32, 0, 6, 0, 0, 0, '', 'Priest', '', '', 'Жрец', '', '', '', '', '', 'class_5.gif');
INSERT INTO `wow_forum_category` VALUES (33, 0, 6, 0, 0, 0, '', 'Death Knight', '', '', 'Рыцарь Смерти', '', '', '', '', '', 'class_6.gif');
INSERT INTO `wow_forum_category` VALUES (34, 0, 6, 0, 0, 0, '', 'Mage', '', '', 'Маг', '', '', '', '', '', 'class_8.gif');
INSERT INTO `wow_forum_category` VALUES (35, 0, 6, 0, 0, 0, '', 'Warlock', '', '', 'Чернокнижник', '', '', '', '', '', 'class_9.gif');
INSERT INTO `wow_forum_category` VALUES (36, 0, 6, 0, 0, 0, '', 'Hunter', '', '', 'Охотник', '', '', '', '', '', 'class_3.gif');
INSERT INTO `wow_forum_category` VALUES (37, 0, 6, 0, 0, 0, '', 'Shaman', '', '', 'Шаман', '', '', '', '', '', 'class_7.gif');
INSERT INTO `wow_forum_category` VALUES (38, 1, -1, 1, 1, 0, '', 'Realm Forums', '', '', 'Игровые миры', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (39, 0, 38, 1, 0, 0, '', 'Armory Realm', '', '', 'Armory Realm', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (40, 0, 38, 1, 0, 0, '', 'Armory Realm 2', '', '', 'Armory Realm 2', '', '', '', '', '', '');

DROP TABLE IF EXISTS `wow_forum_posts`;
CREATE TABLE `wow_forum_posts` (
  `post_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `author_guid` int(11) NOT NULL,
  `blizzpost` smallint(1) NOT NULL DEFAULT '0',
  `blizz_name` varchar(12) NOT NULL,
  `message` text NOT NULL,
  `post_count` int(11) NOT NULL,
  `post_date` int(11) NOT NULL,
  `author_ip` varchar(15) NOT NULL,
  `edit_date` int(11) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `wow_forum_posts` VALUES (0, 1, 7, 1, 1, 1, '', 'This is sample Blizzard''s post. It should be longer than 115 characters to display cropped message on main page (forums).', 1, 1305989614, '127.0.0.1', 0);

DROP TABLE IF EXISTS `wow_forum_threads`;
CREATE TABLE `wow_forum_threads` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `author_guid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `views` int(11) NOT NULL,
  `flags` int(11) NOT NULL,
  PRIMARY KEY (`thread_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `wow_forum_threads` VALUES (1, 7, 1, 1, 'Test Thread', 0, 4);