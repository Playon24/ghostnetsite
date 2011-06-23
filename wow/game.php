<?php

/**
 * Copyright (C) 2010-2011 Shadez <https://github.com/Shadez>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 **/

include('../includes/WoW_Loader.php');
WoW_Template::SetPageData('body_class', sprintf('%s  game-index', WoW_Locale::GetLocale(LOCALE_DOUBLE)));
WoW_Template::SetTemplateTheme('wow');
$url_data = WoW::GetUrlData('game');
if($url_data['action0'] == 'game') {
    if(empty($url_data['action1'])) {
        WoW_Template::SetPageIndex('game');
        WoW_Template::SetPageData('page', 'game');
    }
    elseif($url_data['action1'] == 'guide') {
        if(empty($url_data['action2'])) {
            WoW_Template::SetPageIndex('game_guide_what_is_wow');
            WoW_Template::SetPageData('body_class', 'game-guide-what-is-wow');
            WoW_Template::SetPageData('page', 'game_guide_what_is_wow');
        }
        elseif($url_data['action2'] == 'getting-started') {
            WoW_Template::SetPageIndex('game_guide_getting_started');
            WoW_Template::SetPageData('body_class', 'game-guide-getting-started');
            WoW_Template::SetPageData('page', 'game_guide_getting_started');
        }
        elseif($url_data['action2'] == 'how-to-play') {
            WoW_Template::SetPageIndex('game_guide_how_to_play');
            WoW_Template::SetPageData('body_class', 'game-guide-how-to-play');
            WoW_Template::SetPageData('page', 'game_guide_how_to_play');
        }
        elseif($url_data['action2'] == 'playing-together') {
            WoW_Template::SetPageIndex('game_guide_playing_together');
            WoW_Template::SetPageData('body_class', 'game-guide-playing-together');
            WoW_Template::SetPageData('page', 'game_guide_playing_together');
        }
        
        elseif($url_data['action2'] == 'late-game') {
            WoW_Template::SetPageIndex('game_guide_late_game');
            WoW_Template::SetPageData('body_class', 'game-guide-late-game');
            WoW_Template::SetPageData('page', 'game_guide_late_game');
        }
        else {
            WoW_Template::SetPageIndex('game');
            WoW_Template::SetPageData('page', 'game');
        }
    }
    elseif($url_data['action1'] == 'race') {
        if(in_array($url_data['action2'], array('worgen','draenei','dwarf','gnome','human','night-elf','goblin','blood-elf','orc','tauren','troll','forsaken') )) {
            WoW_Template::SetPageIndex('game_race');
            WoW_Template::SetPageData('body_class', 'race-'.$url_data['action2']);
            WoW_Template::SetPageData('race', $url_data['action2']);
            WoW_Template::SetPageData('page', 'game_race');
        }
        else {
            WoW_Template::SetPageIndex('game_race_index');
            WoW_Template::SetPageData('body_class', 'game-race-index');
            WoW_Template::SetPageData('page', 'game_race_index');
        }
    }
    elseif($url_data['action1'] == 'class') {
        if(in_array($url_data['action2'], array('warrior','paladin','hunter','rogue','priest','death-knight','shaman','mage','warlock','druid') )) {
            WoW_Template::SetPageIndex('game_class');
            WoW_Template::SetPageData('body_class', 'class-'.$url_data['action2']);
            WoW_Template::SetPageData('class', $url_data['action2']);
            WoW_Template::SetPageData('page', 'game_class');
        }
        else {
            WoW_Template::SetPageIndex('game_class_index');
            WoW_Template::SetPageData('body_class', 'game-classes-index');
            WoW_Template::SetPageData('page', 'game_class_index');
        }
    }
    
}
else {
    
}
WoW_Template::SetMenuIndex('menu-game');
WoW_Template::LoadTemplate('page_index');
?>
