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
--
-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Structure for the table `wow_item_tab_sold_by`
--

DROP TABLE IF EXISTS `wow_item_tab_sold_by`;
CREATE TABLE `wow_item_tab_sold_by` (
  `itemID` int(20) NOT NULL,
  `npcID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `level` int(3) NOT NULL,
  `location` int(20) NOT NULL,
  PRIMARY KEY  (`itemID`,`npcID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Structure for the table `wow_item_tab_contained_in`
--

DROP TABLE IF EXISTS `wow_item_tab_contained_in`;
CREATE TABLE `wow_item_tab_contained_in` (
  `itemID` int(20) NOT NULL,
  `goID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `location` int(20) NOT NULL,
  `drop_rate` int(5) NOT NULL,
  PRIMARY KEY  (`itemID`,`goID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Structure for the table `wow_item_tab_dropped_from`
--

DROP TABLE IF EXISTS `wow_item_tab_dropped_from`;
CREATE TABLE `wow_item_tab_dropped_from` (
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
-- Structure for the table `wow_item_tab_reagent_for`
--

DROP TABLE IF EXISTS `wow_item_tab_reagent_for`;
CREATE TABLE `wow_item_tab_reagent_for` (
  `itemID` int(20) NOT NULL,
  `spellID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `sell_price` int(10) NOT NULL,
  PRIMARY KEY  (`itemID`,`spellID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Structure for the table `wow_item_tab_disenchants_into`
--

DROP TABLE IF EXISTS `wow_item_tab_disenchants_into`;
CREATE TABLE `wow_item_tab_disenchants_into` (
  `itemID` int(20) NOT NULL,
  `item2ID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `level` int(3) NOT NULL,
  `drop_count` varchar(55) NOT NULL,
  `drop_rate` int(5) NOT NULL,
  PRIMARY KEY  (`itemID`,`item2ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Structure for the table `wow_item_tab_created_by`
--

-- TODO

--
-- Structure for the table `wow_item_tab_provided_for_quest`
--

-- TODO

--
-- Structure for the table `wow_item_tab_provided_objective_of_quest`
--

-- TODO

--
-- Structure for the table `wow_item_tab_provided_reward_from_quest`
--

-- TODO

-- Structure for the table `wow_item_tab_currency_for_items`
--

-- TODO

-- Structure for the table `wow_item_tab_skinned_from_creatures`
--

-- TODO

-- Structure for the table `wow_item_tab_pickpocket_from_creatures`
--

-- TODO

-- Structure for the table `wow_item_tab_mined_from_creatures`
--

-- TODO

-- --------------------------------------------------------