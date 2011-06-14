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
 
/**
 * How works *.local config files?
 *  
 * There is two same config files for Database and WoWCS with only one difference:
 * In *.local.php set your configuration for your localhost server where you are testing
 * your changes. In files without .local suffix set your configuration to your public server.
 * This is usefull if your configurations as dblogin, dbpass, dbname, etc.. are different
 * on your test and public servers. All 4 files (DatabaseConfig.php, DatabaseConfig.local.php,
 * WoWConfig.php and WoWConfig.local.php) can exists on both your servers configuration dirs,
 * but for property works there is one file which must be created only in public server
 * configuration dir. This file name is ".public" and it is not included.
 * 
 * IMPORTANT:
 * 1) create file named ".public" in "WOW_DIRECTORY./includes/configs/" ONLY in your public server, NOT in localhost
 **/
Class WoWConfig {
    public static $DefaultBGName     = 'Massive Network';
    public static $UseCache          = false; // NYI
    public static $CacheLifeTime     = 86400; // NYI
    public static $MinLevelToDisplay = 10;
    public static $MinLevelToSearch  = 0;
    public static $EnableMaintenance = false; // NYI
    public static $UseLog            = true;
    public static $LogLevel          = 2;
    public static $ConfigVersion     = '0101201101';
    public static $CheckVersionType  = 'show';
    public static $DefaultLocale     = 'ru';
    public static $DefaultLocaleID   = 8;
    public static $SkipBanned        = false;
    public static $WoW_Path          = ''; // Without slash at the end of path. If your site is in root directory, leave this empty.
                                           // For example: site is available at http://example.org/wowcs/
                                           // That means that you should set this variable as '/wowcs'.
    public static $DefaultExpansion  = 2; // 0 - Classic, 1 - Burning Crusade, 2 - Wrath, 3 - Cataclysm

    public static $Realms            = array(
        1 => array(
            'id'   => 1,
            'name' => 'Armory Realm',
            'type' => SERVER_MANGOS
        )
    );
}
?>