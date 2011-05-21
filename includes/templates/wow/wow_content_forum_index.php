<div id="content">
<div class="content-top">
<div class="content-trail">
<ol class="ui-breadcrumb">
<li>
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/" rel="np">
World of Warcraft
</a>
</li>
<li class="last">
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/forum/" rel="np">
<?php echo WoW_Locale::GetString('template_menu_forums'); ?>
</a>
</li>
</ol>
</div>
<div class="content-bot">	<script type="text/javascript">
		$(function(){Cms.Station.init();});
	</script>

	<div id="station-view">


            <div class="bt-lite">
                <div class="bt-link readmore"><?php echo WoW_Locale::GetString('template_forums_blizztracker_title'); ?> <span><a href="blizztracker/"><?php echo WoW_Locale::GetString('template_forums_all_blizz_posts'); ?></a></span></div>
                    <a href="javascript:;" onclick="Cms.Station.btLiteScroll(1)" class="bt-left"></a>
                    <a href="javascript:;" onclick="Cms.Station.btLiteScroll(-1)" class="bt-right"></a>
                <div class="bt-adjust">
                    <div class="bt-mask">
                        <div id="bt-holder">
                                <?php
                                $blizz_posts = WoW_Forums::GetLatestBlizzPosts();
                                if(is_array($blizz_posts)) {
                                    $set_count = 1;
                                    $set_closed = false;
                                    $set_opened = false;
                                    foreach($blizz_posts as $post) {
                                        if($set_count == 1) {
                                            $set_opened = true;
                                            echo '<div class="bt-set">';
                                        }
                                        echo sprintf('<a href="topic/%d#%d">
                                        <span class="desc">
											<span class="int">
                                            «%s»
                                        </span>
										</span>
                                        <span class="info">
                                                <span class="char">%s</span>
                                                 %s
                                                 %s <strong>%s</strong>:
                                                 "%s"
                                         </span>
                                         </a>', $post['thread_id'], $post['post_count'], $post['message_short'], $post['author'], $post['date'], WoW_Locale::GetString('template_forums_in'), $post['categoryTitle'], $post['threadTitle_short']);
                                        if($set_count == 3) {
                                            echo '</div>';
                                            $set_count = 1;
                                            $set_closed = true;
                                            $set_opened = false;
                                        }
                                        else {
                                            ++$set_count;
                                        }
                                    }
                                    if($set_opened && !$set_closed) {
                                        echo '</div>';
                                    }
                                }
                                ?>
                                <div class="bt-set">
                                    <a href="blizztracker/">
                                        <span class="desc">
											<span class="int">
                                            <?php echo WoW_Locale::GetString('template_forums_blizztracker_all'); ?>
                                        </span>
										</span>
                                        <span class="info">
                                         </span>
                                    </a>
                                </div>
                        </div>
                    </div>

                    <div class="bt-mask-l"></div>
                    <div class="bt-mask-r"></div>
                </div>
            </div>
		<div id="station-content">
			<div class="station-content-wrapper">
				<div class="station-inner-wrapper">
					<div id="forum-list">
						<div id="forum-list-interior">
                            <?php
                            $forum_categories = WoW_Forums::GetForumCategories();
                            if(is_array($forum_categories)) {
                                foreach($forum_categories as $category) {
                                    $info = $category['category_info'];
                                    $subcats = $category['subcategories'];
                                    echo sprintf('<a id="forum%d" href="javascript:;" onclick="Cms.Station.parentToggle(\'%d\',this)" class="forum-parent">%s</a>', $info['cat_id'], $info['cat_id'], $info['title']);
                                    if(is_array($subcats)) {
                                        $realms_filter = '<div class="filter-options">
													<a href="javascript:;" class="selected" onclick="Cms.Station.toggleFilter(this)">%s</a>
													<a href="javascript:;" onclick="Cms.Station.toggleFilter(this,true)">%s</a>
												</div>';
                                        echo sprintf('<div class="child-forums%s%s" id="child%d">', $info['realm_cat'] == 1 ? ' filtered-parent' : null, $info['short'] == 1 ? ' non-verbose' : null, $info['cat_id']);
                                        if($info['realm_cat'] == 1) {
                                            echo sprintf('<div class="child-filter">
											<div class="forum-filter png-fix">
												<img width="27" src="%s/wow/static/images/icons/mag-glass.png" />
												<input class=\'filter\' type="text"/>
											</div>
												%s
                                                <span class="clear"><!-- --></span>
										</div>
                                            <div class="forums-list">', WoW::GetWoWPath(), WoW_Account::IsLoggedIn() ? sprintf($realms_filter, WoW_Locale::GetString('template_forums_my_realms'), WoW_Locale::GetString('template_forums_all_realms')) : null);
                                            foreach($subcats as $subcat) {
                                                if(!WoW::IsRealm($subcat['title'])) {
                                                    continue;
                                                }
                                                if(WoW_Account::IsLoggedIn()) {
                                                    $isMy = WoW_Account::IsHaveCharacterOnRealm($subcat['title']);
                                                }
                                                else {
                                                    $isMy = false;
                                                }
                                                echo sprintf('<a href="%d/" class="forum-link%s"%s>
                                                    <span class="forum-icon">
													</span>
                                                    <span class="int">
														<span class="int-padding">
															%s
                                                            <span class="desc"></span>
														</span>
													</span>
                                                </a>', $subcat['cat_id'], (!$isMy && WoW_Account::IsLoggedIn()) ? ' pre-filtered' : null, ($isMy && WoW_Account::IsLoggedIn()) ? ' alt="flagged"' : null, $subcat['title']);
                                            }
                                            echo '</div></div>';
                                        }
                                        else {
                                            echo sprintf('<div class="forums-list">');
                                            foreach($subcats as $subcat) {
                                                echo sprintf('<a href="%d/" class="forum-link" >
    
    													<span class="forum-icon">
    															%s
    													</span>
    
    													<span class="int">
    														<span class="int-padding">
    															%s
                                                                <span class="desc">%s</span>
    														</span>
    													</span>
    
    												</a>
                                            ', $subcat['cat_id'], $subcat['icon'] != null ? sprintf('<img src="%s/cms/forum_icon/%s"/>', WoW::GetWoWPath(), $subcat['icon']) : null, $subcat['title'], $subcat['desc']);
                                            }
                                            echo '</div></div>';
                                        }
                                    }
                                }
                            }
                            ?>
                            
						</div>
					</div>


				<div id="popular-topics">
					<div class="readmore">
						<?php echo WoW_Locale::GetString('template_forums_popular_threads'); ?>
					</div>
					<div id="popular-topics-inner"></div>
				</div>
	   			<div class="coc"> 
	   					<a href="<?php echo WoW::GetWoWPath(); ?>/community/conduct"><?php echo WoW_Locale::GetString('template_forums_forum_rules'); ?></a>.
	   			</div>
	<span class="clear"><!-- --></span>
				</div>
			</div>
		</div>
	</div>

</div>
</div>
</div>
