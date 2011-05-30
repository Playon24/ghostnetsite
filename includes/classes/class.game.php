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

Class WoW_Game {
    private static $m_zones = array();
    private static $m_zone = array();
    private static $m_zone_key = array();
    
    public static function LoadZones() {
        self::$m_zones = DB::WoW()->select("SELECT
        `a`.`zone_id`, 
        `a`.`zone_key`, 
        `a`.`name_%s` AS `name`,
        `a`.`name_en` AS `nameOriginal`,
        `a`.`minLevel`, 
        `a`.`maxLevel`, 
        `a`.`minLevelExtra`, 
        `a`.`maxLevelExtra`, 
        `a`.`flags`, 
        `a`.`expansion`, 
        `a`.`itemLevel`, 
        `a`.`patch`, 
        `a`.`dungeonGroup`,
        `b`.`name_%s` AS `dungeonGroupName`,
        `b`.`name_en` AS `dungeonGroupNameOriginal`
        FROM `DBPREFIX_instances` AS `a`
        LEFT JOIN `DBPREFIX_instances_groups` AS `b` ON `b`.`group_id` = `a`.`dungeonGroup`", WoW_Locale::GetLocale(), WoW_Locale::GetLocale());
        if(!self::$m_zones) {
            return false;
        }
        self::HandleZones();
    }
    
    public static function LoadZone($zone_key) {
        if($zone_key == null) {
            WoW_Log::WriteError('%s : zone_key is empty, ignore.', __METHOD__);
            return false;
        }
        self::$m_zone_key = $zone_key;
        self::$m_zone = DB::WoW()->selectRow("
        SELECT
        `a`.`zone_id`,
        `a`.`zone_key`,
        `a`.`name_%s` AS `name`,
        `a`.`intro_%s` AS `intro`,
        `a`.`desc_%s` AS `desc`,
        `a`.`minLevel`,
        `a`.`maxLevel`,
        `a`.`minLevelExtra`,
        `a`.`maxLevelExtra`,
        `a`.`flags`,
        `a`.`expansion`,
        `a`.`location`, 
        `a`.`itemLevel`,
        `a`.`patch`,
        `a`.`dungeonGroup`,
        `b`.`name_%s` AS `dungeonGroupName`,
        `b`.`name_en` AS `dungeonGroupNameOriginal`,
        `c`.`name_%s` AS `locationName`,
        `c`.`name_en` AS `locationNameOriginal`
        FROM `DBPREFIX_instances` AS `a`
        LEFT JOIN `DBPREFIX_instances_groups` AS `b` ON `b`.`group_id` = `a`.`dungeonGroup`
        LEFT JOIN `DBPREFIX_areas` AS `c` ON `c`.`id` = `a`.`location`
        WHERE `a`.`zone_key` = '%s' LIMIT 1", WoW_Locale::GetLocale(), WoW_Locale::GetLocale(), WoW_Locale::GetLocale(), WoW_Locale::GetLocale(), WoW_Locale::GetLocale(), self::$m_zone_key);
        if(!self::$m_zone) {
            WoW_Log::WriteError('%s : zone "%s" was not found in %s_instances table!', __METHOD__, self::$m_zone_key, DB::WoW()->GetDatabaseInfo('prefix'));
            return false;
        }
        self::LoadZoneBosses();
        self::HandleZone();
    }
    
    public static function IsZone($zone_key) {
        return DB::WoW()->selectCell("SELECT 1 FROM `DBPREFIX_instances` WHERE `zone_key` = '%s' LIMIT 1", $zone_key);
    }
    
    private static function HandleZones() {
        if(!is_array(self::$m_zones)) {
            return false;
        }
        $zones_data = array(
            EXPANSION_CATA => array(
                'dungeons' => array(),
                'raids' => array()
            ),
            EXPANSION_WRATH => array(
                'dungeons' => array(),
                'raids' => array()
            ),
            EXPANSION_BC => array(
                'dungeons' => array(),
                'raids' => array()
            ),
            EXPANSION_CLASSIC => array(
                'dungeons' => array(),
                'raids' => array()
            )
        );
        foreach(self::$m_zones as $zone) {
            switch($zone['expansion']) {
                case EXPANSION_CLASSIC:
                case EXPANSION_BC:
                case EXPANSION_WRATH:
                case EXPANSION_CATA:
                    if($zone['flags'] <= 0) {
                        WoW_Log::WriteError('%s : instance %d (zoneID: %d, name: "%s") has no flags setted!', __METHOD__, $zone['zone_id'], $zone['name']);
                        continue;
                    }
                    if($zone['name'] == null) {
                        $zone['name'] = $zone['nameOriginal'];
                    }
                    if($zone['dungeonGroupName'] == null && $zone['dungeonGroup'] > 0) {
                        $zone['dungeonGroupName'] = $zone['dungeonGroupNameOriginal'];
                    }
                    if($zone['flags'] & INSTANCE_FLAG_DUNGEON) {
                        if($zone['flags'] & INSTANCE_FLAG_REVAMPED && $zone['flags'] & INSTANCE_FLAG_CATA_REVAMP) {
                            $zones_data[$zone['expansion']]['dungeons'][] = $zone;
                            // Add to classic roster
                            $zones_data[EXPANSION_CLASSIC]['dungeons'][] = $zone;
                        }
                        else {
                            $zones_data[$zone['expansion']]['dungeons'][] = $zone;
                        }
                    }
                    elseif($zone['flags'] & INSTANCE_FLAG_RAID) {
                        $zones_data[$zone['expansion']]['raids'][] = $zone;
                    }
                    else {
                        WoW_Log::WriteError('%s : instance %d (zoneID: %d, name: "%s") has no type flag (dungeon/raid)!', __METHOD__, $zone['zone_id'], $zone['name']);
                    }
                    break;
            }
        }
        self::$m_zones = $zones_data;
        unset($zones_data, $zone);
        return true;
    }
    
    private static function HandleZone() {
        if(!is_array(self::$m_zone)) {
            return false;
        }
        if(self::$m_zone['expansion'] < EXPANSION_CLASSIC || self::$m_zone['expansion'] > EXPANSION_CATA) {
            WoW_Log::WriteError('%s : instance %d (zone key: "%s") has wrong expansionID (%d)!', __METHOD__, self::$m_zone['zone_id'], self::$m_zone['zone_key'], self::$m_zone['expansion']);
            return false;
        }
        if(self::$m_zone['flags'] <= 0) {
            WoW_Log::WriteError('%s : instance %d (zone key: "%s") has no flags setted!', __METHOD__, self::$m_zone['zone_id'], self::$m_zone['zone_key']);
            return false;
        }
        if(!(self::$m_zone['flags'] & INSTANCE_FLAG_DUNGEON) && !(self::$m_zone['flags'] & INSTANCE_FLAG_RAID)) {
            WoW_Log::WriteError('%s : instance %d (zone key: "%s") has no type flag (dungeon/raid)!', __METHOD__, self::$m_zone['zone_id'], self::$m_zone['zone_key']);
            return false;
        }
        if(self::$m_zone['name'] == null) {
            self::$m_zone['name'] = self::$m_zone['nameOriginal'];
        }
        if(self::$m_zone['dungeonGroupName'] == null && self::$m_zone['dungeonGroup'] > 0) {
            self::$m_zone['dungeonGroupName'] = self::$m_zone['dungeonGroupNameOriginal'];
        }
        if(self::$m_zone['locationName'] == null) {
            self::$m_zone['locationName'] = self::$m_zone['locationNameOriginal'];
        }
        if(self::$m_zone['flags'] & INSTANCE_FLAG_DUNGEON) {
            self::$m_zone['type'] = 'dungeon';
            self::$m_zone['players'] = 5;
        }
        else {
            self::$m_zone['type'] = 'raid';
            if(self::$m_zone['flags'] & INSTANCE_FLAG_RAID1_MODE_ONLY) {
                self::$m_zone['players'] = 10;
            }
            elseif(self::$m_zone['flags'] & INSTANCE_FLAG_RAID2_MODE_ONLY) {
                self::$m_zone['players'] = 25;
            }
            elseif(self::$m_zone['flags'] & INSTANCE_FLAG_RAID3_MODE_ONLY) {
                self::$m_zone['players'] = 40;
            }
            else {
                self::$m_zone['players'] = '10/25';
            }
        }
        self::$m_zone['location_name'] = sprintf('%s%s', self::$m_zone['dungeonGroupName'] != null ? self::$m_zone['dungeonGroupName'] . ', ' : null, self::$m_zone['locationName']);
        self::$m_zone['suggested_level'] = self::$m_zone['minLevel'] == self::$m_zone['maxLevel'] ? self::$m_zone['maxLevel'] : sprintf('%d–%d', self::$m_zone['minLevel'], self::$m_zone['maxLevel']);
        self::$m_zone['heroic_level'] = 0;
        if(self::$m_zone['flags'] & INSTANCE_FLAG_REVAMPED && self::$m_zone['flags'] & INSTANCE_FLAG_CATA_REVAMP) {
            self::$m_zone['suggested_level'] = self::$m_zone['minLevelExtra'] == self::$m_zone['maxLevelExtra'] ? self::$m_zone['maxLevelExtra'] : sprintf('%d–%d', self::$m_zone['minLevelExtra'], self::$m_zone['maxLevelExtra']);
            self::$m_zone['heroic_level'] = max(self::$m_zone['maxLevel'], self::$m_zone['maxLevelExtra']);
        }
        elseif(self::$m_zone['maxLevelExtra'] > self::$m_zone['maxLevel']) {
            self::$m_zone['heroic_level'] = self::$m_zone['maxLevelExtra'];
        }
        if(is_array(self::$m_zone['bosses'])) {
            $bossesCount = count(self::$m_zone['bosses']);
            $ids = array();
            $bosses = self::$m_zone['bosses'];
            for($i = 0; $i < $bossesCount; ++$i) {
                if($bosses[$i]['name_id'] > 0) {
                    $bosses[$i]['id'] = $bosses[$i]['name_id'];
                }
                if($bosses[$i]['idExtra'] > 0) {
                    $bosses[$i]['id'] = $bosses[$i]['idExtra'];
                }
                unset($bosses[$i]['name_id'], $bosses[$i]['idExtra']);
                if(in_array($bosses[$i]['id'], $ids)) {
                    continue;
                }
                $ids[] = $bosses[$i]['id'];
                $bosses[$i]['nameOriginal'] = strtolower($bosses[$i]['nameOriginal']);
                $bosses[$i]['nameOriginal'] = str_replace(array(' ', '\''), array('-', ''), $bosses[$i]['nameOriginal']);
                $bosses[$i]['key'] = $bosses[$i]['nameOriginal'];
                unset($bosses[$i]['nameOriginal']);
            }
            self::$m_zone['bosses'] = $bosses;
            unset($bosses);
        }
        WoW_Template::SetPageData('zone_name', self::$m_zone['name']);
        WoW_Template::SetPageData('zone_key', self::$m_zone['zone_key']);
    }
    
    private static function LoadZoneBosses() {
        if(!is_array(self::$m_zone)) {
            return false;
        }
        self::$m_zone['bosses'] = DB::WoW()->select("SELECT `id`, `name_id`, `name_%s` AS `name`, `name_en` AS `nameOriginal`, `idExtra` FROM `DBPREFIX_instance_data` WHERE `instance_id` = %d", WoW_Locale::GetLocale(), self::$m_zone['zone_id']);
    }
    
    public static function GetZones() {
        if(!self::$m_zones) {
            self::LoadZones();
        }
        return self::$m_zones;
    }
    
    public static function GetZone() {
        if(!self::$m_zone) {
            self::LoadZone();
        }
        return self::$m_zone;
    }
}
?>