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
 * @todo TOTALLY REWRITE THIS CLASS
 **/
Class WoW_Forums {
    private static $forum_categories = array();
    private static $category_threads = array();
    private static $thread_posts = array();
    private static $blizz_tracker = array();
    private static $latest_blizz_posts = array();
    private static $blizz_tracker_active = false;
    
    private static $thread_data = array();
    
    private static $active_global_category_id = 0;
    private static $active_global_category_title = '';
    private static $active_category_id = 0;
    private static $active_category_title = '';
    private static $active_thread_id = 0;
    private static $active_thread_title = '';
    private static $active_thread_blizzard_posts_max = 0;
    private static $active_thread_blizzard_posts_current = 0;
    private static $active_thread_blizzard_posts = array();
    
    public static function InitForums() {
        if(self::GetCategoryId() == 0 && self::GetThreadId() == 0) {
            self::LoadCategories();
        }
        elseif(self::GetCategoryId() > 0 && self::GetThreadId() == 0) {
            self::LoadThreads();
        }
        elseif(self::GetCategoryId() == 0 && self::GetThreadId() > 0) {
            self::LoadThread();
        }
        else {
            WoW_Log::WriteError('%s : unhandled exception (category ID: %d, thread ID: %d)!', __METHOD__, self::GetCategoryId(), self::GetThreadId());
            return false;
        }
        return true;
    }
    
    private static function LoadCategories() {
        self::LoadForumCategories();
    }
    
    private static function LoadThreads() {
        self::LoadCategoryInfo();
        self::LoadCategoryThreads();
    }
    
    private static function LoadThread() {
        self::LoadCategoryInfo();
        self::LoadThreadPosts();
    }
    
    private static function LoadCategoryInfo() {
        if(self::GetCategoryId() > 0) {
            $category = DB::WoW()->selectRow("SELECT `title_%s` AS `title`, `parent_cat` FROM `DBPREFIX_forum_category` WHERE `cat_id` = %d AND `header` = 0", WoW_Locale::GetLocale(), self::GetCategoryId());
        }
        elseif(self::GetThreadId() > 0) {
            $category = DB::WoW()->selectRow("SELECT `title_%s` AS `title`, `parent_cat` FROM `DBPREFIX_forum_category` WHERE `cat_id` = %d AND `header` = 0", WoW_Locale::GetLocale(), DB::WoW()->selectCell("SELECT `cat_id` FROM `DBPREFIX_forum_threads` WHERE `thread_id` = %d", self::GetThreadId()));
        }
        else {
            $category = false;
        }
        if(!$category) {
            return false;
        }
        self::$active_category_title = $category['title'];
        self::$active_global_category_id = $category['parent_cat'];
        self::$active_global_category_title = DB::WoW()->selectCell("SELECT `title_%s` FROM `DBPREFIX_forum_category` WHERE `cat_id` = %d", WoW_Locale::GetLocale(), self::$active_global_category_id);
        return true;
    }
    
    public static function InitBlizzTracker($latest = false) {
        self::LoadBlizzPosts($latest);
    }
    
    private static function LoadForumCategories() {
        if(WoW_Account::IsLoggedIn()) {
            $user_gm_level = WoW_Account::GetGMLevel();
        }
        else {
            $user_gm_level = 0;
        }
        self::$forum_categories = DB::WoW()->select("SELECT `cat_id`, `header`, `parent_cat`, `short`, `realm_cat`, `title_%s` AS `title`, `desc_%s` AS `desc`, `icon` FROM `DBPREFIX_forum_category` WHERE `gmlevel` <= %d", WoW_Locale::GetLocale(), WoW_Locale::GetLocale(), $user_gm_level);
        self::HandleForumCategories();
    }
    
    private static function LoadCategoryThreads() {
        self::$category_threads = DB::WoW()->select("
        SELECT DISTINCT
        `a`.*,
        `b`.`name` AS `author`
        FROM `DBPREFIX_forum_threads` AS `a`
        JOIN `DBPREFIX_user_characters` AS `b` ON `b`.`bn_id` = `a`.`author_id` AND `b`.`account` = `a`.`author_account` AND `b`.`guid` = `a`.`author_guid`
        WHERE `a`.`cat_id` = %d", self::GetCategoryId());
        self::HandleCategoryThreads();
    }
    
    private static function LoadThreadPosts() {
        self::$thread_data = DB::WoW()->selectRow("SELECT * FROM `DBPREFIX_forum_threads` WHERE `thread_id` = %d", self::GetThreadId());
        self::$thread_posts = DB::WoW()->select("
        SELECT DISTINCT
        `a`.*,
        `b`.`title` AS `threadTitle`,
        `c`.`title_%s` AS `categoryTitle`,
        `d`.`name` AS `author`
        FROM `DBPREFIX_forum_posts` AS `a`
        JOIN `DBPREFIX_forum_threads` AS `b` ON `b`.`thread_id` = `a`.`thread_id`
        JOIN `DBPREFIX_forum_category` AS `c` ON `c`.`cat_id` = `a`.`cat_id`
        JOIN `DBPREFIX_user_characters` AS `d` ON `d`.`bn_id` = `a`.`author_id` AND `d`.`account` = `a`.`author_account` AND `d`.`guid` = `a`.`author_guid`
        WHERE `a`.`thread_id` = %d
        ORDER BY `a`.`post_date` DESC
        ", WoW_Locale::GetLocale(), self::GetThreadId());
        self::HandleThreadPosts();
        self::UpdateThreadViews();
    }
    
    private static function LoadBlizzPosts($latest = false) {
        self::$latest_blizz_posts = DB::WoW()->select("
        SELECT DISTINCT
        `a`.`thread_id`,
        `a`.`cat_id`,
        `a`.`author_id`,
        `a`.`author_account`,
        `a`.`author_guid`,
        `a`.`message`,
        `a`.`post_count`,
        `a`.`post_date`,
        `b`.`title` AS `threadTitle`,
        `c`.`title_%s` AS `categoryTitle`,
        `d`.`name` AS `author`
        FROM `DBPREFIX_forum_posts` AS `a`
        JOIN `DBPREFIX_forum_threads` AS `b` ON `b`.`thread_id` = `a`.`thread_id`
        JOIN `DBPREFIX_forum_category` AS `c` ON `c`.`cat_id` = `a`.`cat_id`
        JOIN `DBPREFIX_user_characters` AS `d` ON `d`.`bn_id` = `a`.`author_id` AND `d`.`account` = `a`.`author_account` AND `d`.`guid` = `a`.`author_guid`
        WHERE `a`.`blizzpost` = 1
        ORDER BY `a`.`post_date` DESC
        %s", WoW_Locale::GetLocale(), $latest ? 'LIMIT 15' : null);
        self::HandleBlizzPosts();
    }
    
    private static function HandleBlizzPosts() {
        if(is_array(self::$latest_blizz_posts)) {
            $blizz_posts = self::$latest_blizz_posts;
        }
        elseif(is_array(self::$blizz_tracker) && self::$blizz_tracker_active) {
            $blizz_posts = self::$blizz_tracker;
        }
        else {
            return false;
        }
        $posts = array();
        foreach($blizz_posts as $post) {
            // Crop message
            if(mb_strlen($post['message']) > 115) {
                $post['message_short'] = sprintf('%s…', mb_substr($post['message'], 0, 115));
            }
            else {
                $post['message_short'] = $post['message'];
            }
            // Crop thread title
            if(mb_strlen($post['threadTitle']) > 28) {
                $post['threadTitle_short'] = sprintf('%s…', mb_substr($post['threadTitle'], 0, 28));
            }
            else {
                $post['threadTitle_short'] = $post['threadTitle'];
            }
            // Set default author name
            if($post['author'] == '') {
                $post['author'] = 'Blizzard';
            }
            $post['date'] = date('d/m/Y', $post['post_date']);
            $posts[] = $post;
        }
        if(is_array(self::$latest_blizz_posts)) {
            self::$latest_blizz_posts = $posts;
        }
        elseif(is_array(self::$blizz_tracker) && self::$blizz_tracker_active) {
            self::$blizz_tracker = $posts;
        }
        else {
            unset($posts, $post);
            return false;
        }
        unset($posts, $post);
        return true;
    }
    
    private static function HandleForumCategories() {
        if(!is_array(self::$forum_categories)) {
            return false;
        }
        // First of all, create category header
        $forum_categories = array();
        foreach(self::$forum_categories as $category) {
            if($category['header'] == 1) {
                $forum_categories[$category['cat_id']] = array();
                $forum_categories[$category['cat_id']]['category_info'] = $category;
                $forum_categories[$category['cat_id']]['subcategories'] = array();
            }
        }
        // Load subcategories into parent categories. Each category can have only level 1 subcategories.
        foreach(self::$forum_categories as $category) {
            if($category['header'] == 0 && $category['parent_cat'] > 0) {
                if(!isset($forum_categories[$category['parent_cat']])) {
                    // Unknown category, continue.
                    WoW_Log::WriteError('%s : forum category %d ("%s") has parent_cat %d, but this category was not found.', __METHOD__, $category['cat_id'], $category['title'], $category['parent_cat']);
                    continue;
                }
                $forum_categories[$category['parent_cat']]['subcategories'][] = $category;
            }
        }
        // Save handled categories
        self::$forum_categories = $forum_categories;
        unset($forum_categories, $category);
        return true;
    }
    
    private static function HandleCategoryThreads() {
        if(!is_array(self::$category_threads)) {
            return false;
        }
        $threads = array(
            'featured' => array(),
            'sticky' => array(),
            'regular' => array()
        );
        foreach(self::$category_threads as $thread) {
            $th_data = DB::WoW()->selectRow("SELECT * FROM `DBPREFIX_forum_posts` WHERE `thread_id` = %d AND `post_count` = 1", $thread['thread_id']);
            $th_last_post = DB::WoW()->selectRow("
            SELECT
            `a`.*,
            `b`.`name` AS `author`
            FROM `DBPREFIX_forum_posts` AS `a`
            JOIN `DBPREFIX_user_characters` AS `b` ON `b`.`account` = `a`.`author_id` AND `b`.`guid` = `a`.`author_guid` 
            WHERE `a`.`thread_id` = %d AND `a`.`post_count` = (SELECT MAX(`post_count`) FROM `DBPREFIX_forum_posts` WHERE `thread_id` = %d)", $thread['thread_id'], $thread['thread_id']);
            if(!$th_data || !$th_last_post) {
                continue;
            }
            $thread['message'] = $th_data['message'];
            if(mb_strlen($thread['message']) > 250) {
                $thread['message_short'] = mb_substr($thread['message'], 0, 250) . '…';
            }
            else {
                $thread['message_short'] = $thread['message'];
            }
            $thread['post_date'] = $th_data['post_date'];
            $thread['last_author'] = $th_last_post['author'];
            $thread['replies'] = DB::WoW()->selectCell("SELECT COUNT(*)-1 FROM `DBPREFIX_forum_posts` WHERE `thread_id` = %d", $thread['thread_id']);
            $thread['last_post_date'] = $th_last_post['post_date'];
            $thread['blizz_post_id'] = DB::WoW()->selectCell("SELECT `post_count` FROM `DBPREFIX_forum_posts` WHERE `thread_id` = %d AND `blizzpost` = 1 LIMIT 1", $thread['thread_id']);
            if($thread['flags'] & THREAD_FLAG_FEATURED) {
                $threads['featured'][] = $thread;
            }
            elseif($thread['flags'] & THREAD_FLAG_PINNED) {
                $threads['sticky'][] = $thread;
            }
            else {
                $threads['regular'][] = $thread;
            }
        }
        self::$category_threads = $threads;
        unset($threads, $thread, $th_data);
        return true;
    }
    
    private static function HandleThreadPosts() {
        if(!is_array(self::$thread_posts)) {
            return false;
        }
        self::$active_thread_title = self::$thread_posts[0]['threadTitle'];
        self::SetCategoryId(self::$thread_posts[0]['cat_id']);
        self::$active_category_title = self::$thread_posts[0]['categoryTitle'];
        $postnum = 1;
        foreach(self::$thread_posts as $post) {
            if($post['blizzpost'] == 1) {
                self::$active_thread_blizzard_posts[] = $postnum;
                ++self::$active_thread_blizzard_posts_max;
            }
            ++$postnum;
        }
        self::$active_thread_blizzard_posts_current = 0;
    }
    
    public static function SetBlizzTrackerActive() {
        self::$blizz_tracker_active = true;
    }
    
    public static function SetCategoryId($cat_id) {
        if($cat_id < 0) {
            WoW_Log::WriteError('%s : wrong category ID (%d), unable to handle.', __METHOD__, $cat_id);
            return false;
        }
        if(!DB::WoW()->selectCell("SELECT 1 FROM `DBPREFIX_forum_category` WHERE `cat_id` = %d", $cat_id)) {
            return false;
        }
        self::$active_category_id = $cat_id;
        return true;
    }
    
    public static function SetThreadId($thread_id) {
        if($thread_id < 0) {
            WoW_Log::WriteError('%s : wrong thread ID (%d), unable to handle.', __METHOD__, $thread_id);
            return false;
        }
        if(!DB::WoW()->selectCell("SELECT 1 FROM `DBPREFIX_forum_threads` WHERE `thread_id` = %d", $thread_id)) {
            return false;
        }
        self::$active_thread_id = $thread_id;
        return true;
    }
    
    public static function GetCategoryId() {
        return self::$active_category_id;
    }
    
    public static function GetThreadId() {
        return self::$active_thread_id;
    }
    
    public static function GetForumCategories() {
        if(!is_array(self::$forum_categories)) {
            self::LoadForumCategories();
        }
        return self::$forum_categories;
    }
    
    public static function GetCategoryThreads() {
        if(!is_array(self::$category_threads)) {
            self::LoadCategoryThreads();
        }
        return self::$category_threads;
    }
    
    public static function GetThreadPosts() {
        if(!is_array(self::$thread_posts)) {
            self::LoadThreadPosts();
        }
        return self::$thread_posts;
    }
    
    public static function GetLatestBlizzPosts() {
        if(!is_array(self::$latest_blizz_posts)) {
            self::LoadBlizzPosts(true);
        }
        return self::$latest_blizz_posts;
    }
    
    public static function GetGlobalCategoryTitle() {
        return self::$active_global_category_title;
    }
    
    public static function GetGlobalCategoryId() {
        return self::$active_global_category_id;
    }
    
    public static function GetCategoryTitle() {
        return self::$active_category_title;
    }
    
    public static function GetThreadTitle() {
        return self::$active_thread_title;
    }
    
    public static function GetPopularThreads() {
        return DB::WoW()->select("
        SELECT
        `a`.*,
        `b`.`title_%s` AS `categoryTitle`
        FROM `DBPREFIX_forum_threads` AS `a`
        JOIN `DBPREFIX_forum_category` AS `b` ON `b`.`cat_id` = `a`.`cat_id`
        ORDER BY `a`.`views` DESC
        LIMIT 10", WoW_Locale::GetLocale());
    }
    
    public static function GetNextBlizzPostIdInThread() {
        if(!isset(self::$active_thread_blizzard_posts[self::$active_thread_blizzard_posts_current])) {
            return 0;
        }
        ++self::$active_thread_blizzard_posts_current;
        return self::$active_thread_blizzard_posts[self::$active_thread_blizzard_posts_current - 1];
    }
    
    public static function BBCodesToHTML(&$post_text) {
        $matches = array();
        if(preg_match_all('/\[item\=(.+?)\/]/x', $post_text, $matches)) {
            $count = count($matches[0]);
            // Replace [item] tag
            for($i = 0; $i < $count; ++$i) {
                $info = WoW_Items::GetItemInfo(isset($matches[1][$i]) ? str_replace('"', '', $matches[1][$i]) : 0);
                if(!$info) {
                    continue;
                }
                $post_text = str_replace($matches[0][$i], sprintf('<a href="%s/wow/item/%d" class="bml-link-item color-q%d"><span class="icon-frame frame-10"><img src="http://battle.net/wow-assets/static/images/icons/18/%s.jpg"> </span>%s</a>', WoW::GetWoWPath(), $info['entry'], $info['Quality'], WoW_Items::GetItemIcon(0, $info['displayid']), WoW_Items::GetItemName($info['entry'])), $post_text);
            }
        }
        // Replace [quote] tag
        $post_text = str_replace('[quote', '<blockquote', $post_text);
        // Replace other tags
        $post_text = str_replace(array('[', ']', "\n"), array('<', '>', '<br/>'), $post_text);
        $post_text = str_replace('"', '\"', $post_text);
    }
    
    public static function AddNewThread($category_id, &$post_data, $return_id = false) {
        DB::WoW()->query("INSERT INTO `DBPREFIX_forum_threads` (`cat_id`, `author_id`, `author_account`, `author_guid`, `title`, `views`, `flags`) VALUES (%d, %d, %d, %d, '%s', 0, %d)",
            $category_id, WoW_Account::GetUserID(), WoW_Account::GetActiveCharacterInfo('account'), WoW_Account::GetActiveCharacterInfo('guid'), $post_data['subject'], (WoW_Account::GetGMLevel() >= 3 ? (THREAD_FLAG_BLIZZARD) : 0));
        if(!$return_id) {
            return self::AddNewPost($category_id, DB::WoW()->GetInsertID(), $post_data);
        }
        return DB::WoW()->GetInsertID();
    }
    
    public static function AddNewPost($category_id, $thread_id, &$post_data) {
        self::BBCodesToHTML($post_data['postCommand_detail']);
        DB::WoW()->query("
        INSERT INTO `DBPREFIX_forum_posts`
        (
            `thread_id`, `cat_id`, `author_id`, `author_account`, `author_guid`, `blizzpost`,
            `blizz_name`, `message`, `post_count`, `post_date`, `author_ip` 
        )
        VALUES
        (
            %d, %d, %d, %d, %d, %d, '%s', '%s', 1, %d, '%s'
        )
        ",
            $thread_id, $category_id, WoW_Account::GetUserID(), WoW_Account::GetActiveCharacterInfo('account'), WoW_Account::GetActiveCharacterInfo('guid'), isset($post_data['blizz']) ? 1 : 0,
            (isset($post_data['blizzName'])) ? $post_data['blizzName'] : null, $post_data['postCommand_detail'], time(), $_SERVER['REMOTE_ADDR']
        );
        return array('cat_id' => $category_id, 'thread_id' => $thread_id, 'post_id' => DB::WoW()->GetInsertID());
    }
    
    public static function UpdateThreadViews() {
        DB::WoW()->query("UPDATE `DBPREFIX_forum_threads` SET `views` = `views` + 1 WHERE `thread_id` = %d", self::GetThreadId());
    }
    
    public static function IsClosedThread() {
        return self::$thread_data['flags'] & THREAD_FLAG_CLOSED;
    }
}
?>