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
if(!is_array($url_data) || !isset($url_data['action1']) || $url_data['action1'] != 'creation') {
    header('Location: ' . WoW::GetWoWPath() . '/account/creation/tos.html');
    exit;
}
WoW_Template::SetTemplateTheme('account');
if(preg_match('/tos.html/i', $url_data['action2'])) {
    if(isset($_POST['csrftoken'])) {
        $registration_allowed = true;
        $required_post_fields = array(
            'firstname', 'lastname', array('emailAddress', 'emailAddressConfirmation'), array('password', 'rePassword'),
            'gender', 'question1', 'answer1', 'dobDay', 'dobMonth', 'dobYear', 'country'
        );
        // Check POST fields
        foreach($required_post_fields as $field) {
            if(is_array($field)) {
                if(!isset($_POST[$field[0]], $_POST[$field[1]])) {
                    $registration_allowed = false;
                    WoW_Template::SetPageData('account_creation_error_msg', WoW_Locale::GetString('template_account_creation_error_fields'));
                }
                if(($_POST[$field[0]] != $_POST[$field[1]]) || empty($_POST[$field[0]]) || empty($_POST[$field[1]])) {
                    $registration_allowed = false;
                    WoW_Template::SetPageData('account_creation_error_msg', WoW_Locale::GetString('template_account_creation_error_fields'));
                }
            }
            else {
                if(!isset($_POST[$field]) || $_POST[$field] == null) {
                    $registration_allowed = false;
                    WoW_Template::SetPageData('account_creation_error_msg', WoW_Locale::GetString('template_account_creation_error_fields'));
                }
            }
        }
        if(!$registration_allowed) {
            WoW_Template::SetPageData('creation_error', true);
            WoW_Template::SetPageIndex('creation_tos');
            WoW_Template::SetPageData('page', 'creation_tos');
        }
        else {
            $user_data = array(
                'first_name' => $_POST['firstname'],
                'last_name' => $_POST['lastname'],
                'password' => $_POST['password'],
                'sha' => sha1(strtoupper($_POST['emailAddress']) . ':' . strtoupper($_POST['password'])),
                'treatment' => $_POST['gender'],
                'email' => $_POST['emailAddress'],
                'question_id' => $_POST['question1'],
                'question_answer' => $_POST['answer1'],
                'birthdate' => strtotime(sprintf('%d.%d.%d', $_POST['dobDay'], $_POST['dobMonth'], $_POST['dobYear'])),
                'country_code' => $_POST['country']
            );
            if(WoW_Account::RegisterUser($user_data, true)) {
                header('Location: ' . WoW::GetWoWPath() . '/account/management/');
                exit;
                //WoW_Template::SetPageIndex('creation_success');
                //WoW_Template::SetPageData('page', 'creation_success');
                //WoW_Template::SetPageData('email', $_POST['emailAddress']);
            }
            else {
                WoW_Template::SetPageIndex('creation_tos');
                WoW_Template::SetPageData('page', 'creation_tos');
            }
        }
    }
    else {
        WoW_Template::SetPageIndex('creation_tos');
        WoW_Template::SetPageData('page', 'creation_tos');
    }
}
else {
}
WoW_Template::LoadTemplate('creation_index');
?>
