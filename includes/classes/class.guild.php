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

Class WoW_Guild {
    private static $guild_id = 0;
    private static $guild_name = '';
    private static $guild_realmName = '';
    private static $guild_realmID = '';
    private static $guildleader_guid = 0;
    private static $guild_roster = array();
    private static $guild_emblem_style = 0;
    private static $guild_emblem_color = 0;
    private static $guild_border_style = 0;
    private static $guild_border_color = 0;
    private static $guild_bg_color = 0;
    private static $guild_info = '';
    private static $guild_motd = '';
    private static $guild_create_date = 0;
    private static $guild_factionID = -1;
    private static $guild_level = 1; // In WOTLK calculated by createdate timestamp.
    private static $guild_feed = array();
    private static $guild_feed_data = array();
    private static $guild_member_guids = array();
    private static $guild_perks_data = array();
    private static $guild_ranks = array();
    private static $guild_members_filtered = 0;
    private static $guild_roster_page = 0;
    private static $guild_professions = array();
    
    public static function LoadGuild($guild_name, $realm_id) {
        // Data checks
        if(!$guild_name || !is_string($guild_name)) {
            WoW_Log::WriteError('%s : $guild_name must be a string (%s given)!', __METHOD__, gettype($guild_name));
            return false;
        }
        if(!$realm_id || $realm_id <= 0) {
            WoW_Log::WriteError('%s : $realm_id must be a correct realm ID (%d given)!', __METHOD__, $realm_id);
            return false;
        }
        if(!isset(WoWConfig::$Realms[$realm_id])) {
            WoW_Log::WriteError('%s : unable to find realm with ID #%d. Check your configs.', __METHOD__, $realm_id);
            return false;
        }
        DB::ConnectToDB(DB_CHARACTERS, $realm_id, true, false);
        if(!DB::Characters()->TestLink()) {
            return false;
        }
        self::$guild_name = $guild_name;
        self::$guild_realmID = $realm_id;
        self::$guild_realmName = WoWConfig::$Realms[$realm_id]['name'];
        $guild_data = DB::Characters()->selectRow("
            SELECT
            `guildid` AS `guild_id`,
            `leaderguid` AS `guildleader_guid`,
            `EmblemStyle` AS `guild_emblem_style`,
            `EmblemColor` AS `guild_emblem_color`,
            `BorderStyle` AS `guild_border_style`,
            `BorderColor` AS `guild_border_color`,
            `BackgroundColor` AS `guild_bg_color`,
            `info` AS `guild_info`,
            `motd` AS `guild_motd`,
            `createdate` AS `guild_create_date`
            FROM `guild` WHERE `name` = '%s' LIMIT 1", urldecode($guild_name));
        if(!$guild_data) {
            WoW_Log::WriteError('%s : guild %s was not found in DB!', __METHOD__, $guild_name);
            return false;
        }
        foreach($guild_data as $data_key => $data) {
            self::${$data_key} = $data;
        }
        self::LoadGuildMembers();
        self::GenerateGuildMembersGUIDs();
        self::LoadGuildFeed();
        self::LoadGuildRanks();
        self::HandleGuildFeed();
        self::CalculateGuildLevel();
        return true;
    }
    
    public static function IsCorrect() {
        if(!self::$guild_id || !self::$guild_name || !self::$guildleader_guid) {
            return false;
        }
        return true;
    }
    
    public static function GetGuildID() {
        return self::$guild_id;
    }
    
    public static function GetGuildName() {
        return self::$guild_name;
    }
    
    public static function GetGuildRealmName() {
        return self::$guild_realmName;
    }
    
    public static function GetGuildMembersCount() {
        return count(self::$guild_roster);
    }
    
    public static function GetGuildMembers() {
        return self::$guild_roster;
    }
    
    public static function GetFilteredGuildMembersCount() {
        if(self::GetGuildMembersCount() <= 100) {
            self::$guild_members_filtered = self::GetGuildMembersCount();
        }
        else {
            self::$guild_members_filtered = 100;
        }
        return self::$guild_members_filtered;
    }
    
    public static function GetGuildURL() {
        return sprintf('%s/wow/%s/guild/%s/%s/', WoW::GetWoWPath(), WoW_Locale::GetLocale(), self::GetGuildRealmName(), self::GetGuildName());
    }
    
    public static function GetGuildFactionText() {
        return self::GetGuildFactionID() == FACTION_ALLIANCE ? 'alliance' : 'horde';
    }
    
    public static function GetGuildFactionID() {
        return self::$guild_factionID;
    }
    
    public static function GetGuildEmblemInfo() {
        return array(
            'emblem_style' => self::$guild_emblem_style,
            'emblem_color' => self::$guild_emblem_color,
            'border_style' => self::$guild_border_style,
            'border_color' => self::$guild_border_color,
            'bg_color'     => self::$guild_bg_color
        );
    }
    
    public static function GetGuildLevel() {
        return self::$guild_level;
    }
    
    public static function GetGuildMembersGUIDs() {
        return self::$guild_member_guids;
    }
    
    public static function GetGuildFeedCount() {
        return count(self::$guild_feed_data);
    }
    
    public static function GetGuildFeed() {
        return self::$guild_feed_data;
    }
    
    public static function GetGuildRanks() {
        return self::$guild_ranks;
    }
    
    public static function GetGuildProfessions() {
        return self::$guild_professions;
    }
    
    public static function GetGuildMOTD() {
        return self::$guild_motd;
    }
    
    public static function GetGuildInfo() {
        return self::$guild_info;
    }
    
    private static function GenerateGuildMembersGUIDs() {
        if(!self::IsCorrect()) {
            WoW_Log::WriteError('%s : guild was not found.', __METHOD__);
            return false;
        }
        if(!self::$guild_roster) {
            self::LoadGuildMembers();
        }
        foreach(self::$guild_roster as $member) {
            self::$guild_member_guids[] = $member['guid'];
        }
        return true;
    }
    
    private static function LoadGuildMembers() {
        if(!self::IsCorrect()) {
            WoW_Log::WriteError('%s : guild was not found.', __METHOD__);
            return false;
        }
        $members = DB::Characters()->select("
            SELECT
            `guild_member`.`guid`,
            `guild_member`.`rank` AS `rankID`,
            `guild_rank`.`rname` AS `rankName`,
            `characters`.`name`,
            `characters`.`race` AS `raceID`,
            `characters`.`class` AS `classID`,
            `characters`.`gender` AS `genderID`,
            `characters`.`level`
            FROM `guild_member` AS `guild_member`
            JOIN `guild_rank` AS `guild_rank` ON `guild_rank`.`rid`=`guild_member`.`rank` AND `guild_rank`.`guildid`=%d
            JOIN `characters` AS `characters` ON `characters`.`guid`=`guild_member`.`guid`
            WHERE `guild_member`.`guildid`=%d
        ", self::GetGuildID(),  self::GetGuildID());
        if(!$members) {
            WoW_Log::WriteError('%s : unable to find any member of guild %s (GUILDID: %d). Guild is empty?', __METHOD__, self::GetGuildName(), self::GetGuildID());
            return false;
        }
        $roster = array();
        foreach($members as $member) {
            $member['race_text'] = WoW_Locale::GetString('character_race_' . $member['raceID']);
            $member['class_text'] = WoW_Locale::GetString('character_class_' . $member['classID']);
            $member['url'] = sprintf('%s/wow/%s/character/%s/%s/', WoW::GetWoWPath(), WoW_Locale::GetLocale(), self::GetGuildRealmName(), $member['name']);
            $achievement_ids = DB::Characters()->select("SELECT `achievement` FROM `character_achievement` WHERE `guid` = %d", $member['guid']);
            if(is_array($achievement_ids)) {
                $ids = array();
                foreach($achievement_ids as $ach) {
                    $ids[] = $ach['achievement'];
                }
                if(is_array($ids)) {
                    $member['achievement_points'] = DB::WoW()->selectCell("SELECT SUM(`points`) FROM `DBPREFIX_achievement` WHERE `id` IN (%s)", $ids);
                }
                else {
                    $member['achievement_points'] = 0;
                }
            }
            else {
                $member['achievement_points'] = 0;
            }
            $roster[] = $member;
        }
        self::$guild_roster = $roster;
        unset($roster);
        // Set faction
        self::$guild_factionID = WoW_Utils::GetFactionId(self::GetMemberInfo(0, 'raceID'));
        return true;
    }
    
    private static function LoadGuildFeed() {
        if(!self::IsCorrect()) {
            WoW_Log::WriteError('%s : guild was not found.', __METHOD__);
            return false;
        }
        self::$guild_feed = DB::Characters()->select("
        SELECT
        `character_feed_log`.`guid`,
        `character_feed_log`.`type`,
        `character_feed_log`.`data`, 
        `character_feed_log`.`date`, 
        `character_feed_log`.`item_guid`, 
        `character_feed_log`.`item_quality`,
        `characters`.`name` AS `charName`,
        `characters`.`gender`
        FROM `character_feed_log`
        INNER JOIN `characters` ON `characters`.`guid` = `character_feed_log`.`guid`
        WHERE `character_feed_log`.`guid` IN (%s)
        AND
        (
            (
                `character_feed_log`.`type` = %d 
                AND
                `character_feed_log`.`item_quality` >= 3
            )
            OR
            (
                `type` = %d
            )
        )
        ORDER BY `date` DESC
        LIMIT 50", self::GetGuildMembersGUIDs(), TYPE_ITEM_FEED, TYPE_ACHIEVEMENT_FEED);
        if(!self::$guild_feed) {
            WoW_Log::WriteLog('%s : no feed data found for guild members (GUILD: %s, GUILDID: %d)', __METHOD__, self::GetGuildName(), self::GetGuildID());
            return false;
        }
        $feed_count = count(self::$guild_feed);
        for($i = 0; $i < $feed_count; $i++) {
            if(self::$guild_feed[$i]['type'] == TYPE_ACHIEVEMENT_FEED) {
                self::$guild_feed[$i]['date'] = DB::Characters()->selectCell("SELECT `date` FROM `character_achievement` WHERE `guid` = %d AND `achievement` = %d LIMIT 1", self::$guild_feed[$i]['guid'], self::$guild_feed[$i]['data']);
            }
        }
        return true;
    }
    
    private static function LoadGuildRanks() {
        if(!self::IsCorrect()) {
            WoW_Log::WriteError('%s : guild was not found.', __METHOD__);
            return false;
        }
        self::$guild_ranks = DB::Characters()->select("SELECT `rid` AS `rankID`, `rname` AS `rankName` FROM `guild_rank` WHERE `guildid` = %d", self::GetGuildID());
        return true;
    }
    
    private static function HandleGuildFeed() {
        if(!self::IsCorrect()) {
            WoW_Log::WriteError('%s : guild was not found.', __METHOD__);
            return false;
        }
        if(!self::$guild_feed) {
            self::LoadGuildFeed();
        }
        $feeds_data = array();
        $periods = array(WoW_Locale::GetString('template_feed_sec'), WoW_Locale::GetString('template_feed_min'), WoW_Locale::GetString('template_feed_hour'));
        $today = date('d.m.Y');
        $lengths = array(60, 60, 24);
        $feed_count = 0;
        foreach(self::$guild_feed as $event) {
            if($feed_count >= 25) {
                break;
            }
            $date_string = date('d.m.Y', $event['date']);
            if($date_string == $today) {
                $diff = time() - $event['date'];
                for($i = 0; $diff >= $lengths[$i]; $i++) {
                    $diff /= $lengths[$i];
                }
                $diff = round($diff);
                $date_string = sprintf('%s %s %s', $diff, $periods[$i], WoW_Locale::GetString('template_feed_ago'));
            }
            $feed = array();
            switch($event['type']) {
                case TYPE_ACHIEVEMENT_FEED:
                    $achievement = WoW_Achievements::GetAchievementInfo($event['data']);
                    if(!$achievement) {
                        WoW_Log::WriteLog('%s : wrong feed data (TYPE_ACHIEVEMENT_FEED, achievement ID: %d), ignore.', __METHOD__, $event['data']);
                        continue;
                    }
                    $feed = array(
                        'type' => TYPE_ACHIEVEMENT_FEED,
                        'date' => $date_string,
                        'id'   => $event['data'],
                        'points' => $achievement['points'],
                        'name' => $achievement['name'],
                        'desc' => $achievement['desc'],
                        'icon' => $achievement['iconname'],
                        'category' => $achievement['categoryId'],
                        'charName' => $event['charName'],
                        'gender' => $event['gender']
                    );
                    break;
                case TYPE_ITEM_FEED:
                    $item = WoW_Items::GetItemInfo($event['data']);
                    if(!$item) {
                        WoW_Log::WriteLog('%s : wrong feed data (TYPE_ITEM_FEED, item ID: %d), ignore.', __METHOD__, $event['data']);
                        continue;
                    }
                    $item_icon = WoW_Items::GetItemIcon($item['entry'], $item['displayid']);
                    $data_item = null;
                    $feed = array(
                        'type' => TYPE_ITEM_FEED,
                        'date' => $date_string,
                        'id'   => $event['data'],
                        'name' => WoW_Locale::GetLocale() == 'en' ? $item['name'] : WoW_Items::GetItemName($item['entry']),
                        'data-item' => $data_item,
                        'quality' => $item['Quality'],
                        'icon' => $item_icon,
                        'charName' => $event['charName'],
                        'gender' => $event['gender']
                    );
                    break;
                case TYPE_BOSS_FEED:
                    // Not supported here.
                    continue;
                default:
                    WoW_Log::WriteError('%s : unknown feed type (%d)!', __METHOD__, $event['type']);
                    continue;
            }
            $feeds_data[] = $feed;
            $feed_count++;
        }
        self::$guild_feed_data = $feeds_data;
        return true;
    }
    
    private static function GetMemberInfo($index, $subindex) {
        return isset(self::$guild_roster[$index][$subindex]) ? self::$guild_roster[$index][$subindex] : false;
    }
    
    /*
        Guild level in Cataclysm will be calculated by server.
        Now, in WotLK, 1 additional level will be granted to guild by every month (since created).
        If guild was created less than 1 month ago, it will have just 1 level. One month - 2, two month - 3, etc.
        You can change time that required to "level up" by changing
            $start_stamp -= 1 * IN_MONTHS;
        to
            $start_stamp -= 2 * IN_WEEKS / 5 * IN_DAYS / 60 * IN_MINUTES; etc.
     */
    private static function CalculateGuildLevel() {
        $level = 1;
        $start_stamp = self::$guild_create_date;
        while($start_stamp > 0) {
            $start_stamp -= 1 * IN_MONTHS;
            $level++;
        }
        self::$guild_level = min(25, $level);
    }
    
    public static function InitPerks() {
        self::LoadPerksData();
    }
    
    private static function LoadPerksData() {
        if(self::$guild_perks_data && is_array(self::$guild_perks_data)) {
            return true;
        }
        self::$guild_perks_data = DB::WoW()->select("SELECT `id`, `level`, `icon`, `spell_id`, `name_%s` AS `name`, `desc_%s` AS `desc` FROM `DBPREFIX_guild_perks`", WoW_Locale::GetLocale(), WoW_Locale::GetLocale());
    }
    
    private static function LoadProfessions() {
        if(!self::IsCorrect()) {
            WoW_Log::WriteError('%s : guild was not found.', __METHOD__);
            return false;
        }
        $skills_professions = array(
            SKILL_BLACKSMITHING,
            SKILL_LEATHERWORKING,
            SKILL_ALCHEMY,
            SKILL_HERBALISM,
            SKILL_MINING,
            SKILL_TAILORING,
            SKILL_ENGINERING,
            SKILL_ENCHANTING,
            SKILL_SKINNING,
            SKILL_JEWELCRAFTING,
            SKILL_INSCRIPTION
        );
        DB::ConnectToDB(DB_CHARACTERS, self::$guild_realmID, true, false);
        if(!DB::Characters()->TestLink()) {
            return false;
        }
        self::$guild_professions = DB::Characters()->select("SELECT * FROM `character_skills` WHERE `guid` IN (%s) AND `skill` IN (%s)", self::GetGuildMembersGUIDs(), $skills_professions);
        if(!is_array(self::$guild_professions)) {
            WoW_Log::WriteError('%s : no professions were found for guild %s (GUILDID: %d).', __METHOD__, self::GetGuildName(), self::GetGuildID());
            return false;
        }
        return true;
    }
    
    private static function HandleProfessions() {
        if(!self::IsCorrect()) {
            WoW_Log::WriteError('%s : guild was not found.', __METHOD__);
            return false;
        }
        if(!is_array(self::$guild_professions)) {
            if(!self::LoadProfessions()) {
                return false;
            }
        }
        $professions = self::$guild_professions;
        self::$guild_professions = array();
        foreach($professions as $prof) {
            self::AddProfession($prof); // Add profession to professions list
            self::AddProfessionToGuildMember($prof); // Add professions to guild roster
        }
        unset($professions, $prof);
        return true;
    }
    
    public static function InitProfessions() {
        self::LoadProfessions();
        self::HandleProfessions();
    }
    
    private static function AddProfessionToGuildMember($profession) {
        if(!self::IsCorrect()) {
            WoW_Log::WriteError('%s : guild was not found.', __METHOD__);
            return false;
        }
        $count = self::GetGuildMembersCount();
        for($i = 0; $i < $count; ++$i) {
            if(self::$guild_roster[$i]['guid'] == $profession['guid']) {
                if(!isset(self::$guild_roster[$i]['professions'])) {
                    self::$guild_roster[$i]['professions'] = array();
                }
                self::$guild_roster[$i]['professions'][] = $profession;
                return true;
            }
        }
        return false;
    }
    
    private static function AddProfession($profession) {
        if(!self::IsCorrect()) {
            WoW_Log::WriteError('%s : guild was not found.', __METHOD__);
            return false;
        }
        $skills_professions = array(
            SKILL_BLACKSMITHING,
            SKILL_LEATHERWORKING,
            SKILL_ALCHEMY,
            SKILL_HERBALISM,
            SKILL_MINING,
            SKILL_TAILORING,
            SKILL_ENGINERING,
            SKILL_ENCHANTING,
            SKILL_SKINNING,
            SKILL_JEWELCRAFTING,
            SKILL_INSCRIPTION
        );
        if(!in_array($profession['skill'], $skills_professions)) {
            WoW_Log::WriteError('%s : wrong skill ID (%d) for player %d (Realm: %s), ignore.', __METHOD__, $profession['skill'], $profession['guid'], self::GetGuildRealmName());
            return false;
        }
        if(!isset(self::$guild_professions[$profession['skill']])) {
            self::$guild_professions[$profession['skill']] = array();
        }
        self::$guild_professions[$profession['skill']][] = $profession;
        return true;
    }
    
    public static function GetGuildPerkFromDB($perk_id = 0, $level = 0) {
        if($level > 1 && $level <= 25) {
            return DB::WoW()->selectRow("SELECT `id`, `level`, `icon`, `spell_id`, `name_%s` AS `name`, `desc_%s` AS `desc` FROM `DBPREFIX_guild_perks` WHERE `level` = %d", WoW_Locale::GetLocale(), WoW_Locale::GetLocale(), $level);
        }
        elseif($perk_id > 0 && $perk_id < 25) {
            return DB::WoW()->selectRow("SELECT `id`, `level`, `icon`, `spell_id`, `name_%s` AS `name`, `desc_%s` AS `desc` FROM `DBPREFIX_guild_perks` WHERE `id` = %d", WoW_Locale::GetLocale(), WoW_Locale::GetLocale(), $perk_id);
        }
    }
    
    public static function GetGuildPerksData() {
        if(!self::$guild_perks_data) {
            self::LoadPerksData();
        }
        return self::$guild_perks_data;
    }
}
?>