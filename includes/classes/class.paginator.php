<?php

/**
 * Copyright (C) 2011 Shadez <https://github.com/Shadez>
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

class WoW_Paginator
{
    private static $_current_page = 1;
    private static $_total_results = 1;
    private static $_per_page = 10;
    private static $total_pages = 0;
    private static $_padding = 2;
    private static $link_prefix = '/?page=';
    private static $link_suffix = '';
    private static $tpl_first = '<a href="{link}">&laquo;</a> | ';
    private static $tpl_last = ' | <a href="{link}">&raquo;</a> ';
    private static $separator = ' | ';
    private static $tpl_prev = '<a href="{link}">&lsaquo;</a> | ';
    private static $tpl_next = ' | <a href="{link}">&rsaquo;</a> ';
    private static $tpl_page_nums = '<span><a href="{link}">{page}</a></span>';
    private static $tpl_cur_page_num = '<span>{page}</span>';
    private static $_output = '';
    private static $outside_template = '';
 
    public static function Initialize($page, $totalResults, $perPage, $link_prefix, $link_suffix, $tpl_first, $tpl_last, $separator, $tpl_prev, $tpl_next, $tpl_page_nums, $tpl_cur_page_num, $outside_template)
    {
        if($page > 0) {
            self::$_current_page = $page;
            self::$_total_results = $totalResults;
            self::$_per_page = $perPage;
            self::$link_prefix = $link_prefix;
            self::$link_suffix = $link_suffix;
            self::$tpl_first = $tpl_first;
            self::$tpl_last = $tpl_last;
            self::$separator = $separator;
            self::$tpl_prev = $tpl_prev;
            self::$tpl_next = $tpl_next;
            self::$tpl_page_nums = $tpl_page_nums;
            self::$tpl_cur_page_num = $tpl_cur_page_num;
            self::$outside_template = $outside_template;
            
            return self::paginate();
        }
        else {
            return false;
        }
    }
 
    public static function paginate()
    {
        $output = '';
        self::$total_pages = ceil(self::$_total_results / self::$_per_page);

        if(self::$total_pages <= 1)
        {
        	return false;
        }

        if(self::$_current_page > self::$total_pages)
            self::$_current_page = self::$total_pages;
 
        $start = (self::$_current_page - self::$_padding > 0) ? self::$_current_page - self::$_padding : 1;
        $finish = (self::$_current_page + self::$_padding <= self::$total_pages) ? self::$_current_page + self::$_padding : self::$total_pages;
 
        ###########################################
        # ADD FIRST TO OUTPUT IF CURRENT PAGE > 1 #
        ###########################################
        if(self::$_current_page > 1) {
            $output .= preg_replace('/\{link\}/i', self::$link_prefix . '1' . self::$link_suffix, self::$tpl_first);
        }
 
        ##########################################
        # ADD PREV TO OUTPUT IF CURRENT PAGE > 1 #
        ##########################################
        if(self::$_current_page > 1) {
            $output .= preg_replace('/\{link\}/i', self::$link_prefix . (self::$_current_page - 1) . self::$link_suffix, self::$tpl_prev);
        }
 
        ################################################
        # GET LIST OF LINKED NUMBERS AND ADD TO OUTPUT #
        ################################################
        $nums = array();
        for($i = $start; $i <= $finish; $i++) {
            if ($i == self::$_current_page) {
                $nums[] = preg_replace('/\{page\}/i', $i, self::$tpl_cur_page_num);
            } else {
                $patterns = array('/\{link\}/i', '/\{page\}/i');
                $replaces = array(self::$link_prefix . $i . self::$link_suffix, $i);
                $nums[] = preg_replace($patterns, $replaces, self::$tpl_page_nums);
            }
        }
        $output .= implode('', $nums);
 
        ##################################################
        # ADD NEXT TO OUTPUT IF CURRENT PAGE < MAX PAGES #
        ##################################################
        if (self::$_current_page < self::$total_pages) {
            $output .= preg_replace('/\{link\}/i', self::$link_prefix . (self::$_current_page + 1) . self::$link_suffix, self::$tpl_next);
        }
 
        ############################################
        # ADD LAST TO OUTPUT IF FINISH < MAX PAGES #
        ############################################
        if (self::$_current_page < $finish) {
            $output .= preg_replace('/\{link\}/i', self::$link_prefix . self::$total_pages, self::$tpl_last);
        }
 
        return self::$_output = sprintf(self::$outside_template, $output);
    }
}
?>
