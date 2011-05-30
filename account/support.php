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
$url_data = WoW::GetUrlData('support');
if(!is_array($url_data) || !isset($url_data['action1']) || $url_data['action1'] != 'support') {
    header('Location: ' . WoW::GetWoWPath() . '/account/support/');
    exit;
}
WoW_Template::SetTemplateTheme('account');

if(!WoW_Account::IsLoggedIn() && preg_match('/password-reset.html/i', $url_data['action2'])) {
    WoW_Template::SetPageIndex('password_reset');
    WoW_Template::SetPageData('page', 'password_reset');
}
elseif(!WoW_Account::IsLoggedIn() && preg_match('/password-reset-select.html/i', $url_data['action2'])) {
    if(isset($_POST['csrftoken'])) {
      $user_data = array(
          'email' => $_POST['email'],
          'username' => $_POST['firstName']
      );
      
      WoW_Account::DropLastErrorCode();
      if(WoW_Account::RecoverPasswordSelect($user_data)) {
          $_SESSION['wow_password_recovery'] = WoW_Account::GetRecoverPasswordData();
          WoW_Template::SetPageIndex('password_reset_select');
          WoW_Template::SetPageData('page', 'password_reset_select');
      }
      else {
          WoW_Account::SetLastErrorCode(ERORR_INVALID_PASSWORD_RECOVERY_COMBINATION);
          WoW_Template::SetPageIndex('password_reset');
          WoW_Template::SetPageData('page', 'password_reset');
      }
    }
}
elseif(!WoW_Account::IsLoggedIn() && preg_match('/password-reset-secred-answer.html/i', $url_data['action2'])) {
    WoW_Account::SetRecoverPasswordData($_SESSION['wow_password_recovery']);
    if(isset($_POST['verificationMethod']) && $_POST['verificationMethod'] == 'SECURITY_QUESTION') {
        WoW_Template::SetPageIndex('password_reset_secred_answer');
        WoW_Template::SetPageData('page', 'password_reset_secred_answer');
    }
    else {
        WoW_Template::SetPageIndex('password_reset_select');
        WoW_Template::SetPageData('page', 'password_reset_select');
    }
}
elseif(!WoW_Account::IsLoggedIn() && preg_match('/password-reset-success.html/i', $url_data['action2'])) {
    WoW_Account::SetRecoverPasswordData($_SESSION['wow_password_recovery']);
    if(isset($_POST['secretAnswer'])) {
      WoW_Account::DropLastErrorCode();
      if(WoW_Account::RecoverPasswordSuccess($_POST['secretAnswer'])) {
          WoW_Template::SetPageIndex('password_reset_success');
          WoW_Template::SetPageData('page', 'password_reset_success');
      }
      else {
          WoW_Account::SetLastErrorCode(ERORR_INVALID_PASSWORD_RECOVERY_ANSWER);
          WoW_Template::SetPageIndex('password_reset_secred_answer');
          WoW_Template::SetPageData('page', 'password_reset_secred_answer');
      }
    }
}
else {
    WoW_Template::SetPageIndex('password_reset');
    WoW_Template::SetPageData('page', 'password_reset');
}
WoW_Template::LoadTemplate('support_index');
?>
