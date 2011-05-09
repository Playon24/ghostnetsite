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

class WoW_Auction {
    private static $auction_side = 0;
    private static $active_guid = 0;
    private static $active_realm = 0;
    private static $auction_initialized = false;
    private static $items_storage = array();
    private static $myitems_storage = array();
    private static $mail_storage = array();
    private static $sold_count = 0;
    private static $selling_count = 0;
    private static $finished_count = 0;
    private static $won_count = 0;
    private static $rebided_count = 0;
    private static $lost_count = 0;
    private static $money_amount = 0;
    private static $won_money_amount = 0;
    private static $mail_count = 0;
    
    public static function InitAuction() {
        if(!WoW_Account::IsLoggedIn()) {
            WoW_Log::WriteError('%s : no session, unable to initialize auction!', __METHOD__);
            return false;
        }
        self::$active_guid = WoW_Account::GetActiveCharacterInfo('guid');
        self::$active_realm = WoW_Account::GetActiveCharacterInfo('realmId');
        self::$auction_initialized = true;
        DB::ConnectToDB(DB_CHARACTERS, self::$active_realm);
        self::$money_amount = DB::Characters()->selectCell("SELECT `money` FROM `characters` WHERE `guid` = %d", self::$active_guid);
        self::$won_money_amount = 0;
        self::LoadMyAuctions();
        self::LoadAuctionMails();
        self::HandleAuctionData();
    }
    
    private static function LoadMyAuctions() {
        self::$myitems_storage = DB::Characters()->select("SELECT * FROM `auction` WHERE `itemowner` = %d", self::$active_guid);
    }
    
    private static function LoadAuctionMails() {
        self::$mail_storage = DB::Characters()->select("SELECT * FROM `mail` WHERE `receiver` = %d AND `messageType` = 2 AND `stationery` = 62", self::$active_guid);
    }
    
    private static function HandleAuctionData() {
        foreach(self::$mail_storage as $mail) {
            if($mail['has_items'] == 1 && $mail['money'] == 0) {
                self::$won_count++;
                self::$mail_count++;
            }
            elseif($mail['has_items'] == 0 && $mail['money'] > 0) {
                self::$won_money_amount += $mail['money'];
                self::$sold_count++;
                self::$mail_count++;
            }
        }
        self::$selling_count = count(self::$myitems_storage);
    }
    
    public static function GetSellingItemsCount() {
        return self::$selling_count;
    }
    
    public static function GetSoldItemsCount() {
        return self::$sold_count;
    }
    
    public static function GetWonMoneyAmount() {
        return self::$won_money_amount;
    }
    
    public static function GetMailsCount() {
        return self::$mail_count;
    }
    
    public static function GetWonItemsCount() {
        return self::$won_count;
    }
}
?>