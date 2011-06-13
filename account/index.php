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
$url_data = WoW::GetUrlData('management');
if(!is_array($url_data) || !isset($url_data['action1']) || $url_data['action1'] != 'management') {
    header('Location: ' . WoW::GetWoWPath() . '/account/management/');
    exit;
}
if(!WoW_Account::IsLoggedIn()) {
    header('Location: ' . WoW::GetWoWPath() . '/login/');
    exit;
}
WoW_Template::SetTemplateTheme('account');
WoW_Account::UserGames();
if($url_data['action2'] == 'wow' && preg_match('/dashboard.html/i', $url_data['action3'])) {
    WoW_Account::InitializeAccount($_GET['accountName']);
    WoW_Template::SetPageIndex('dashboard');
    WoW_Template::SetMenuIndex('games');
    WoW_Template::SetPageData('page', 'dashboard');
}
/*
elseif($url_data['action2'] == 'add-game.html') {
    if(isset($_POST['gameAcountName']) && isset($_POST['gameAcountPass'])) {
        $account_data = array(
            'username' => $_POST['gameAcountName'],
            'sha' => sha1(strtoupper($_POST['gameAcountName']) . ':' . strtoupper($_POST['gameAcountPass']))
        );
        if(WoW_Account::RegisterGameAccount($account_data)) {
            header('Location: ' . WoW::GetWoWPath() . '/account/management/');
            exit;
        }
        else {
            WoW_Template::SetPageIndex('add_game');
            WoW_Template::SetMenuIndex('games');
            WoW_Template::SetPageData('page', 'add_game');
        }
        WoW_Template::SetPageIndex('management');
        WoW_Template::SetMenuIndex('management');
        WoW_Template::SetPageData('page', 'management');
    }
    else{
        WoW_Template::SetPageIndex('add_game');
        WoW_Template::SetMenuIndex('games');
        WoW_Template::SetPageData('page', 'add_game');
    }
}
*/
else {
    WoW_Template::SetPageIndex('management');
    WoW_Template::SetMenuIndex('management');
    WoW_Template::SetPageData('page', 'management');
}
WoW_Template::LoadTemplate('page_index');
?>
