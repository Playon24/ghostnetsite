<div id="content">
<div class="content-top">
<div class="content-trail">
<?php WoW_Template::NavigationMenu(); ?>
<!--<ol class="ui-breadcrumb">
<li>
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/" rel="np">
World of Warcraft
</a>
</li>
<li>
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/forum/" rel="np">
<?php echo WoW_Locale::GetString('template_menu_forums'); ?>
</a>
</li>
<li>
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/forum/#forum<?php echo WoW_Forums::GetGlobalCategoryId(); ?>/" rel="np">
<?php echo WoW_Forums::GetGlobalCategoryTitle(); ?>
</a>
</li>
<li>
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/forum/<?php echo WoW_Forums::GetCategoryId(); ?>/" rel="np">
<?php echo WoW_Forums::GetCategoryTitle(); ?>
</a>
</li>
<li class="last">
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/forum/topic/<?php echo WoW_Forums::GetThreadId(); ?>" rel="np">
<?php echo WoW_Forums::GetThreadTitle(); ?>
</a>
</li>
</ol>-->
</div>
<div class="content-bot">
	<script type="text/javascript">
	//<![CDATA[
        $(function(){
			Cms.Topic.topicInit(<?php echo WoW_Forums::GetThreadId() ?>,<?php echo WoW_Forums::GetCategoryId(); ?>,1);
		});
	//]]>
	</script>

    <!--[if IE 6]>
	<script type="text/javascript">
	//<![CDATA[
		$(function(){ Cms.Topic.topicInitIe(); });
	//]]>
	</script>
	<![endif]-->



	<div id="forum-content">
	    
		<div class="section-header">
                <span class="blizzard_icon">
                    <a class="nextBlizz" href="../topic/<?php echo WoW_Forums::GetThreadId(); ?>#1" data-tooltip="Первое сообщение Blizzard">
                    </a>
                </span>
            <span class="topic">Тема</span><span class="sub-title"><?php echo WoW_Forums::GetThreadTitle(); ?></span>

        </div>


	
    <div class="forum-actions top">
		<div class="actions-panel">










	<a class="ui-button button1<?php echo WoW_Forums::IsClosedThread() ? ' disabled' : null; ?>" href="<?php echo WoW_Forums::IsClosedThread() ? ' javascript:;' : '#new-post'; ?>">
		<span>
			<span>
                	Разместить ответ
</span>
		</span>
	</a>


	<span class="clear"><!-- --></span>
        </div>

    </div>

        <div id="thread">
            <?php
            $posts = WoW_Forums::GetThreadPosts();
            if(is_array($posts)) {
                $post_num = 1;
                foreach($posts as $post) {
                    echo sprintf('<div id="post-%d" class="post%s">
					<span id="%d"></span>
					
                	<div class="post-interior">
                            <table><tr><td class="post-character">
	<div class="post-user">
        <div class="character-info">
    <div class="user-name">
		<span class="char-name-code" style="display: none">
			%s 
		</span>
	<div id="context-2" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>
			<div class="context-user">
				<strong>%s</strong>
			</div>
			<div class="context-links">
					<a href="%s/wow/search?f=post&amp;a=%s&amp;sort=time" title="%s" rel="np" class="icon-posts link-first link-last">
						%s
					</a>
			</div>
		</div>

	</div>

        <a href="javascript:;" class="context-link" rel="np">
        	%s
        </a>
    </div>


            <div class="blizzard-title">Customer Service</div>
        </div>
	</div>
							</td><td>
                                <div class="post-edited">
                                        %s
                                </div>
                                
                                <div class="post-detail">
                                %s
                                </div>
                            </td><td class="post-info">
                                <div class="post-info-int">
                                    <div class="postData">
										
										<a href="#%d">
											#%d
										</a>
                                        
										<div class="date" data-tooltip="%s">
                                        	%s
                                        </div>
										
                                    </div>
                                    
                                        <div class="blizzard_icon">
                                            <a class="nextBlizz" 
												href="../topic/%d#%d" 
												data-tooltip="Следущее сообщение Blizzard">
                                            </a>
                                        </div>
                                    
                                    
                                </div>
                            </td></tr>
                            </table>
                            <div class="post-options">
                                	<div class="no-post-options"><!-- --></div>
	<span class="clear"><!-- --></span>
                            </div>

                	</div>
                </div>', $post['post_id'], $post['blizzpost'] ? ' blizzard' : null, $post_num, $post['author'], $post['author'], WoW::GetWoWPath(), '', WoW_Locale::GetString('template_blog_lookup_forum_messages'), WoW_Locale::GetString('template_blog_lookup_forum_messages'),
                $post['author'], '', $post['message'], $post_num, $post_num, $post['fully_formated_date'], $post['formated_date'], $post['thread_id'], WoW_Forums::GetNextBlizzPostIdInThread());
                }
            }
            ?>
			
				
        </div>
		
		
	
    <div class="forum-actions bottom">
		<div class="actions-panel">

<ol class="ui-breadcrumb">
<li>
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/" rel="np">
World of Warcraft
</a>
</li>
<li>
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/forum/" rel="np">
<?php echo WoW_Locale::GetString('template_menu_forums'); ?>
</a>
</li>
<li>
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/forum/#forum<?php echo WoW_Forums::GetGlobalCategoryId(); ?>/" rel="np">
<?php echo WoW_Forums::GetGlobalCategoryTitle(); ?>
</a>
</li>
<li>
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/forum/<?php echo WoW_Forums::GetCategoryId(); ?>/" rel="np">
<?php echo WoW_Forums::GetCategoryTitle(); ?>
</a>
</li>
<li class="last">
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/forum/topic/<?php echo WoW_Forums::GetThreadId(); ?>" rel="np">
<?php echo WoW_Forums::GetThreadTitle(); ?>
</a>
</li>
</ol>
<span class="clear"><!-- --></span>
</div>
</div>
<div class="talkback"><a id="new-post"></a>
        <form method="post" onsubmit="return Cms.Topic.postValidate(this);" action="#new-post">
			<div>
        	<input type="hidden" name="xstoken" value="fbc9d52f-99bf-4639-b2b5-7a535e7f31fe"/>
        	<input type="hidden" name="sessionPersist" value="forum.topic.post"/>
            <div class="post general">
	<table class="dynamic-center ">
		<tr>
			<td>Тема закрыта.</td>
		</tr>
	</table>
            </div>
			</div>
        </form>
	<span class="clear"><!-- --></span>
        <div class="talkback-code">
			<div class="talkback-code-interior">
                <div class="talkback-icon">
                    <h4 class="code-header">Просим вас сообщать о нарушениях правил форума, в особенности о следующих:</h4>
                    <p>Угрозы насилия. <strong>Мы относимся к таким нарушениям крайне серьезно и немедленно предупреждаем о них соответствующие инстанции.</strong></p>
                    <p>Размещение личной информации, касающейся других игроков: <strong>почтовый и электронный адрес, телефон, неподобающие фотографии и видеозаписи.</strong></p>
                    <p>Оскорбления и словесная дискриминация. <strong>Это совершенно недопустимо.</strong></p>
                    	<p><a href="<?php echo WoW::GetWoWPath(); ?>/community/conduct">Правила форумов</a>.</p>
                </div>
			</div>
        </div>

    </div>



    </div>

    <div id="report-post">
            <table id="report-table">
                <tr>
                    <td class="report-desc"> </td>
                    <td class="report-detail report-data"> Сообщить модераторам о сообщении #<span id="report-postID"></span> игрока <span id="report-poster"></span> </td>
                    <td class="post-info"></td>
                </tr>
                <tr>
                    <td class="report-desc"><div>Причина</div></td>
                    <td class="report-detail">
                    	<select id="report-reason">
                                	<option value="SPAMMING">Спам</option>
                                	<option value="REAL_LIFE_THREATS">Угрозы в реальной жизни</option>
                                	<option value="BAD_LINK">«Битая» ссылка</option>
                                	<option value="ILLEGAL">Противозаконно</option>
                                	<option value="ADVERTISING_STRADING">Реклама</option>
                                	<option value="HARASSMENT">Оскорбления</option>
                                	<option value="OTHER">Иное</option>
                                	<option value="NOT_SPECIFIED">Не указано</option>
                                	<option value="TROLLING">Троллинг</option>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="report-desc"><div>Объяснение <small>(не более 256 символов)</small></div></td>
                    <td class="report-detail"><textarea id="report-detail" class="post-editor" cols="78" rows="13"></textarea></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" class="report-submit">
                    	<div>
                            <a href="javascript:;" onclick="Cms.Topic.reportSubmit('')">Отправить</a>
                             |
                            <a href="javascript:;" onclick="Cms.Topic.reportCancel()">Отмена</a>
                        </div></td>
                </tr>
            </table>
            <div id="report-success" style="text-align:center">
            	<h4>Готово!</h4>
            	[<a href='javascript:;' onclick='$("#report-post").hide()'>Закрыть</a>]
            </div>
    </div>
</div>
</div>
</div>
