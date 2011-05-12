-- 
-- Copyright (C) 2010-2011 Shadez <https://github.com/Shadez>
--
-- This program is free software; you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation; either version 2 of the License, or
-- (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program; if not, write to the Free Software
-- Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
-- 
--
-- Database: `wowcs`
-- Database_prefix: `wow`


-- --------------------------------------------------------
--
-- General Description:
-- 
-- The  `wow_item_tab_*` tables, contain all the data
-- related to "the Sources" Tabs in the item page of the 
-- "wowcs"; 
-- This data has to be dumped from the world/mangos DB.
-- Part 2,only `wow_item_tab_currency_for_items` is missing
--
-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Structure for the table `wow_item_tab_created_by`
--

DROP TABLE IF EXISTS `wow_item_tab_created_by`;
CREATE TABLE `wow_item_tab_created_by` (
  `itemID` int(20) NOT NULL,
  `spellID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `drop_count` varchar(55),
  PRIMARY KEY  (`itemID`,`spellID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Structure for the table `wow_item_tab_provided_for_quest`
--

DROP TABLE IF EXISTS `wow_item_tab_provided_for_quest`;
CREATE TABLE `wow_item_tab_provided_for_quest` (
  `itemID` int(20) NOT NULL,
  `questID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `level` int(3) NOT NULL,
  `location` int(20) NOT NULL,
  `objectives` varchar(255),
  `requirements` varchar(255),
  `rewards` varchar(255),
  PRIMARY KEY  (`itemID`,`questID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Structure for the table `wow_item_tab_objective_of_quest`
--

DROP TABLE IF EXISTS `wow_item_tab_objective_of_quest`;
CREATE TABLE `wow_item_tab_objective_of_quest` (
  `itemID` int(20) NOT NULL,
  `questID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `level` int(3) NOT NULL,
  `location` int(20) NOT NULL,
  `objectives` varchar(255),
  `requirements` varchar(255),
  `rewards` varchar(255),
  PRIMARY KEY  (`itemID`,`questID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Structure for the table `wow_item_tab_reward_from_quest`
--

DROP TABLE IF EXISTS `wow_item_tab_reward_from_quest`;
CREATE TABLE `wow_item_tab_reward_from_quest` (
  `itemID` int(20) NOT NULL,
  `questID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `level` int(3) NOT NULL,
  `location` int(20) NOT NULL,
  `objectives` varchar(255),
  `requirements` varchar(255),
  `rewards` varchar(255),
  PRIMARY KEY  (`itemID`,`questID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Structure for the table `wow_item_tab_pickpocket_from_creatures`
--

DROP TABLE IF EXISTS `wow_item_tab_pickpocket_from_creatures`;
CREATE TABLE `wow_item_tab_pickpocket_from_creatures` (
  `itemID` int(20) NOT NULL,
  `npcID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `type` int(5) NOT NULL,
  `level` int(3) NOT NULL,
  `location` int(20) NOT NULL,
  `drop_rate` int(5) NOT NULL,
  PRIMARY KEY  (`itemID`,`npcID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Structure for the table `wow_item_tab_skinned_from_creatures`
--

DROP TABLE IF EXISTS `wow_item_tab_skinned_from_creatures`;
CREATE TABLE `wow_item_tab_skinned_from_creatures` (
  `itemID` int(20) NOT NULL,
  `npcID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `type` int(5) NOT NULL,
  `level` int(3) NOT NULL,
  `location` int(20) NOT NULL,
  `drop_rate` int(5) NOT NULL,
  PRIMARY KEY  (`itemID`,`npcID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Structure for the table `wow_item_tab_gathered_from_creatures`
--

DROP TABLE IF EXISTS `wow_item_tab_gathered_from_creatures`;
CREATE TABLE `wow_item_tab_gathered_from_creatures` (
  `itemID` int(20) NOT NULL,
  `npcID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `type` int(5) NOT NULL,
  `level` int(3) NOT NULL,
  `location` int(20) NOT NULL,
  `drop_rate` int(5) NOT NULL,
  PRIMARY KEY  (`itemID`,`npcID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Structure for the table `wow_item_tab_mined_from_creatures`
--

DROP TABLE IF EXISTS `wow_item_tab_mined_from_creatures`;
CREATE TABLE `wow_item_tab_mined_from_creatures` (
  `itemID` int(20) NOT NULL,
  `npcID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `type` int(5) NOT NULL,
  `level` int(3) NOT NULL,
  `location` int(20) NOT NULL,
  `drop_rate` int(5) NOT NULL,
  PRIMARY KEY  (`itemID`,`npcID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Structure for the table `wow_item_tab_currency_for_items`
--

-- TODO
 


-- --------------------------------------------------------