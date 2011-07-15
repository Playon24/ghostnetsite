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

Class DB implements DB_Interface {
    private static $database_objects     = array();
    private static $database_configs     = array();
    private static $database_connections = array();
    private static $realm_id             = 0;
    
    public static function LoadConfigs() {
        self::$database_configs[DB_WORLD]  = (object) DatabaseConfig::$world;
        self::$database_configs[DB_REALM]  = (object) DatabaseConfig::$realm;
        self::$database_configs[DB_WOW]    = (object) DatabaseConfig::$wow;
        foreach(DatabaseConfig::$characters as $realm_id => $realm_info) {
            self::$database_configs[DB_CHARACTERS + $realm_id + 5] = (object) $realm_info;
        }
        return true;
    }
    
    public static function ConnectToAllDBs() {
        self::ConnectToDB(DB_WORLD);
        self::ConnectToDB(DB_REALM);
        self::ConnectToDB(DB_WOW);
        return true;
    }
    
    public static function ConnectToDB($database_type, $realm_id = 1, $add = true, $return = false) {
        if($database_type == DB_CHARACTERS) {
            $database_type = DB_CHARACTERS + $realm_id + 5;
            self::$realm_id = $realm_id;
        }
        if(self::IsConnected($database_type)) {
            return true;
        }
        $configs = isset(self::$database_configs[$database_type]) ? self::$database_configs[$database_type] : false;
        if(!$configs) {
            return false;
        }
        $db = new WoW_DatabaseHandler($configs->host, $configs->user, $configs->password, $configs->db_name, $configs->charset, $configs->db_prefix);
        // Store object (even if it's unable to establish connection)
        if($add) {
            self::$database_objects[$database_type] = $db;
            self::$database_connections[$database_type] = true;
        }
        if(!$db || !$db->TestLink()) {
            WoW_Log::WriteError('%s : unable to establish connection to MySQL server (database: %s)!', __METHOD__);
            return false;
        }
        if($return) {
            return $db;
        }
        return true;
    }
    
    public static function CloseConnection($database_type, $realm_id = 1) {
        if($database_type == DB_CHARACTERS) {
            $database_type = DB_CHARACTERS + $realm_id + 5;
        }
        if(self::IsConnected($database_type)) {
            unset(self::$database_connections[$database_type]);
        }
        return true;
    }
    
    public static function IsConnected($database_type) {
        return isset(self::$database_connections[$database_type]);
    }
    
    private static function GetDB($database_type) {
        if(!self::IsConnected($database_type)) {
            self::ConnectToDB($database_type);
        }
        if(!isset(self::$database_objects[$database_type])) {
            WoW_Log::WriteError('%s : attempt to access non-existed %d database type!', __METHOD__, $database_type);
            return null;
        }
        return self::$database_objects[$database_type];
    }
    
    public static function Characters() {
        if(!self::IsConnected(DB_CHARACTERS + self::$realm_id + 5)) {
            self::ConnectToDB(DB_CHARACTERS, self::$realm_id);
        }
        return self::GetDB(DB_CHARACTERS + self::$realm_id + 5);
    }
    
    public static function Realm() {
        if(!self::IsConnected(DB_REALM)) {
            self::ConnectToDB(DB_REALM);
        }
        return self::GetDB(DB_REALM);
    }
    
    public static function WoW() {
        if(!self::IsConnected(DB_WOW)) {
            self::ConnectToDB(DB_WOW);
        }
        return self::GetDB(DB_WOW);
    }
    
    public static function World() {
        if(!self::IsConnected(DB_WORLD)) {
            self::ConnectToDB(DB_WORLD);
        }
        return self::GetDB(DB_WORLD);
    }
}

?>
