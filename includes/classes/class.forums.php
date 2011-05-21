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

Class WoW_Forums {
    private static $forum_categories = array();
    private static $category_threads = array();
    private static $thread_posts = array();
    private static $blizz_tracker = array();
    private static $latest_blizz_posts = array();
    private static $blizz_tracker_active = false;
    
    private static $active_category_id = 0;
    private static $active_category_title = '';
    private static $active_thread_id = 0;
    private static $active_thread_title = '';
    
    public static function InitForums() {
        if(self::GetCategoryId() == 0 && self::GetThreadId() == 0) {
            self::LoadForumCategories();
        }
        elseif(self::GetCategoryId() > 0 && self::GetThreadId() == 0) {
            self::$active_category_title = DB::WoW()->selectCell("SELECT `title_%s` FROM `DBPREFIX_forum_category` WHERE `cat_id` = %d AND `header` = 0", WoW_Locale::GetLocale(), self::GetCategoryId());
            self::LoadCategoryThreads();
        }
        elseif(self::GetCategoryId() > 0 && self::GetThreadId() > 0) {
            self::LoadThreadPosts();
        }
        else {
            WoW_Log::WriteError('%s : unhandled exception (category ID: %d, thread ID: %d)!', __METHOD__, self::GetCategoryId(), self::GetThreadId());
            return false;
        }
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
        self::HandleCategoryThreads();
    }
    
    private static function LoadThreadPosts() {
        self::HandleThreadPosts();
    }
    
    private static function LoadBlizzPosts($latest = false) {
        self::$latest_blizz_posts = DB::WoW()->select("
        SELECT
        `a`.`thread_id`,
        `a`.`cat_id`,
        `a`.`author_id`,
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
        JOIN `DBPREFIX_user_characters` AS `d` ON `d`.`account` = `a`.`author_id` AND `d`.`guid` = `a`.`author_guid`
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
        
    }
    
    private static function HandleThreadPosts() {
        
    }
    
    public static function SetBlizzTrackerActive() {
        self::$blizz_tracker_active = true;
    }
    
    public static function SetCategoryId($cat_id) {
        if($cat_id < 0) {
            WoW_Log::WriteError('%s : wrong category ID (%d), unable to handle.', __METHOD__, $cat_id);
            return false;
        }
        self::$active_category_id = $cat_id;
    }
    
    public static function SetThreadId($thread_id) {
        if($thread_id < 0) {
            WoW_Log::WriteError('%s : wrong thread ID (%d), unable to handle.', __METHOD__, $thread_id);
            return false;
        }
        self::$active_thread_id = $thread_id;
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
    
    public static function GetCategoryTitle() {
        return self::$active_category_title;
    }
    
    public static function GetThreadTitle() {
        return self::$active_thread_title;
    }
}

?>