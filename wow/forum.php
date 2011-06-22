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
WoW_Template::SetTemplateTheme('wow');
WoW_Template::SetPageData('body_class', WoW_Locale::GetLocale(LOCALE_DOUBLE));
WoW_Template::SetMenuIndex('menu-forums');

$url_data = WoW::GetUrlData('forum');
// Clear category/thread values
WoW_Forums::SetCategoryId(0);
WoW_Forums::SetThreadId(0);
// Check preview
if(isset($url_data['action3'], $url_data['action4'], $url_data['action5']) && (($url_data['action3'].$url_data['action4'].$url_data['action5']) == 'topicpostpreview')) {
    $post_text = isset($_POST['post']) ? $_POST['post'] : null;
    if($post_text == null) {
        WoW_Template::ErrorPage(500);
    }
    // Convert BB codes to HTML
    WoW_Forums::BBCodesToHTML($post_text);
    // Output json
    header('Content-type: text/json');
    echo '{"detail":"' . $post_text . '"}';
    exit;
}
// Set values (if any)
if($url_data['category_id'] > 0) {
    WoW_Forums::SetCategoryId($url_data['category_id']);
    if(isset($url_data['action4']) && $url_data['action4'] == 'topic') {
        // Check $_POST query
        if(isset($_POST['xstoken'])) {
            $post_allowed = true;
            $required_post_fields = array('xstoken', 'sessionPersist', 'subject', 'postCommand_detail');
            foreach($required_post_fields as $field) {
                if(!isset($_POST[$field])) {
                    $post_allowed = false;
                }
            }
            if($post_allowed) {
                $post_info = WoW_Forums::AddNewThread($url_data['category_id'], $_POST, false);
                if(is_array($post_info)) {
                    header('Location: ' . WoW::GetWoWPath() . '/wow/forum/topic/' . $post_info['thread_id']);
                    exit;
                }
            }
        }
        // Topic create
        WoW_Template::SetPageIndex('forum_new_topic');
        WoW_Template::SetPageData('page', 'forum_new_topic');
    }
    else {
        WoW_Template::SetPageIndex('forum_category');
        WoW_Template::SetPageData('page', 'forum_category');
    }
}
elseif($url_data['thread_id'] > 0) {
    WoW_Forums::SetThreadId($url_data['thread_id']);
    WoW_Template::SetPageIndex('forum_thread');
    WoW_Template::SetPageData('page', 'forum_thread');
}
else {
    // Set Blizz tracker as active
    WoW_Forums::SetBlizzTrackerActive();
    // Init Blizz tracker!
    WoW_Forums::InitBlizzTracker(true);
    WoW_Template::SetPageIndex('forum_index');
    WoW_Template::SetPageData('page', 'forum_index');
}
// Init the forums!
WoW_Forums::InitForums();
WoW_Template::SetPageData('forum_category_title', WoW_Forums::GetCategoryTitle());
WoW_Template::SetPageData('forum_thread_title', WoW_Forums::GetThreadTitle());

WoW_Template::LoadTemplate('page_index');
?>