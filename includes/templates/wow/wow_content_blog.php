<div id="content">
<div class="content-top">
<div class="content-trail">
<ol class="ui-breadcrumb">
<li>
<a href="/wow/" rel="np">
World of Warcraft
</a>
</li>
<li class="last">
<a href="/wow/blog/<?php echo WoW::GetBlogData('id'); ?>" rel="np">
<?php echo WoW::GetBlogData('title'); ?>
</a>
</li>
</ol>
</div>
<div class="content-bot">	
	<script type="text/javascript">
	//<![CDATA[
	$(function(){ Cms.Blog.init(); })
		var addthis_config = {
			 username: "blizzardwebteam"
		};
	//]]>
	</script>
	<div id="blog-wrapper">
    <div id="left">
        <div id="blog-container">
  <?php WoW_Template::LoadTemplate('block_featured_news'); ?>
            <div id="blog">
					<h3 class="blog-title">
						<?php echo WoW::GetBlogData('title'); ?>
					</h3>
					<div class="byline">
						<div class="blog-info">
                    	<a href="/wow/search?a=<?php echo WoW::GetBlogData('author'); ?>&amp;f=article"><?php echo WoW::GetBlogData('author'); ?></a>
							<span>//</span> <?php echo date('d M Y H:i', WoW::GetBlogData('postdate')); ?>
						</div>
							<a class="comments-link" href="#comments"><?php echo WoW::GetBlogData('comments_count'); ?></a>
	<span class="clear"><!-- --></span>
					</div>
						<div class="header-image">
							<img alt="<?php echo WoW::GetBlogData('title'); ?>" src="/cms/blog_header/<?php echo WoW::GetBlogData('header_image'); ?>" />
						</div>
					<div class="detail"><div>
	<?php echo WoW::GetBlogData('text'); ?>
</div>
<style type="text/css">
#blog .detail img {
-moz-border-radius:4px;
-webkit-border-radius:4px;
border-radius:4px;
-moz-box-shadow:0 0 20px #000000;
-webkit-box-shadow:0 0 20px #000000;
box-shadow:0 0 20px #000000;
border: 1px solid #372511;
max-width: 570px !important;
padding: 1px;
}
#blog .detail td:hover > a img, #blog .detail a img:hover {
border: 1px solid #CD9000;
}</style>
</div>
					<div class="keyword-list">
					</div>
            </div>
	<script type="text/javascript">
	//<![CDATA[
		$(function(){
			Cms.Comments.commentInit();
		});
	//]]>
	</script>
	<!--[if IE 6]>
	<script type="text/javascript">
	//<![CDATA[
		$(function() {
			Cms.Comments.commentInitIe();
		});
	//]]>
	</script>
	<![endif]-->
    <div id="report-post">
            <table id="report-table">
                <tr>
                    <td class="report-desc"> </td>
                    <td class="report-detail report-data"> <?php echo WoW_Locale::GetString('template_blog_report_post'); ?> </td>
                    <td class="post-info"></td>
                </tr>
                <tr>
                    <td class="report-desc"><div><?php echo WoW_Locale::GetString('template_blog_report_reason'); ?></div></td>
                    <td class="report-detail">
                    	<select id="report-reason">
                                	<?php echo WoW_Locale::GetString('template_blog_report_reasons'); ?>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="report-desc"><div><?php echo WoW_Locale::GetString('template_blog_report_description'); ?></div></td>
                    <td class="report-detail"><textarea id="report-detail" class="post-editor" cols="78" rows="13"></textarea></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" class="report-submit">
                    	<div>
                            <a href="javascript:;" onclick="Cms.Topic.reportSubmit('comments')"><?php echo WoW_Locale::GetString('template_blog_send_report'); ?></a>
                             |
                            <a href="javascript:;" onclick="Cms.Topic.reportCancel()"><?php echo WoW_Locale::GetString('template_blog_cancel_report'); ?></a>
                        </div></td>
                </tr>
            </table>
            <div id="report-success" style="text-align:center">
            	<h4><?php echo WoW_Locale::GetString('template_blog_report_success'); ?></h4>
            	[<a href='javascript:;' onclick='$("#report-post").hide()'><?php echo WoW_Locale::GetString('template_blog_close_report'); ?></a>]
            </div>
    </div>
    <span id="comments"></span>
    <div id="page-comments">
    	<div class="page-comment-interior">
            <h3>
                <?php echo sprintf('%s (%d)', WoW_Locale::GetString('template_blog_comments'), WoW::GetBlogData('comments_count')); ?>
            </h3>
			<div class="comments-container">
	<script type="text/javascript">
		//<![CDATA[
			var textAreaFocused = false;
		//]]>
	</script>

<?php
if(WoW_Account::IsLoggedIn()) {
    WoW_Template::LoadTemplate('block_post_blog_reply_logged');
}
else {
    WoW_Template::LoadTemplate('block_post_blog_reply_not_logged');
}
?>
							<div style="z-index: 37;" class="comment" id="c-2037924340">
								<div class="avatar portrait-b">
										<a href="/wow/character/свежеватель-душ/%d0%9d%d0%b0%d0%b4%d0%b5%d0%b6%d0%b4%d0%b0/">
											<img height="64" src="http://eu.battle.net/static-render/eu/свежеватель-душ/223/46830815-avatar.jpg?alt=/wow/static/images/2d/avatar/10-1.jpg" alt="" />
										</a>
								</div>
<?php
if(WoW_Account::IsLoggedIn()) {
    // Karma
    echo sprintf('<div class="karma" id="k-2037923922">
            <div class="rate-btn-holder">
                <a href="javascript:;" onclick="Cms.Topic.vote(2037923922,\'up\',1,\'comments\')" class="rateup rate-btn"><span>%s</span></a>
            </div>
            <div class="rate-btn-holder">
                <a href="javascript:;" onclick="$(this).siblings(\'.rate-action\').show();" class="ratedown rate-btn"></a>
                <div class="rate-action">
                    <div class="ui-dropdown">
                        <div class="dropdown-wrapper">
                            <ul>
                                <li><a href="javascript:;" onclick="Cms.Topic.vote(2037923922,\'down\',1,\'comments\')">%s</a></li>
                                <li><a href="javascript:;" onclick="Cms.Topic.vote(2037923922,\'down\',2,\'comments\')">%s</a></li>
                                <li><a href="javascript:;" onclick="Cms.Topic.vote(2037923922,\'down\',3,\'comments\')">%s</a></li>
                                <li><a href="javascript:;" onclick="Cms.Topic.report(2037923922,\'Арикатамо\',\'c-2037923922\')" class="report">%s</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="prev-vote">%s</div>
	<span class="clear"><!-- --></span>
    </div>', WoW_Locale::GetString('template_blog_karma_up'), WoW_Locale::GetString('template_blog_karma_down'),
    WoW_Locale::GetString('template_blog_karma_trolling'), WoW_Locale::GetString('template_blog_karma_spam'),
    WoW_Locale::GetString('template_blog_karma_report'), WoW_Locale::GetString('template_blog_karma_already_rated'));
}
?>
    <div class="comment-interior">
        <div class="character-info user">
        <div class="user-name">
		<span class="char-name-code" style="display: none">
			Надежда 
		</span>
	<div id="context-4" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>
			<div class="context-user">
				<strong>Надежда</strong><br /><span>Свежеватель Душ</span>
			</div>
			<div class="context-links">
					<a href="/wow/character/свежеватель-душ/%d0%9d%d0%b0%d0%b4%d0%b5%d0%b6%d0%b4%d0%b0/" title="<?php echo WoW_Locale::GetString('template_profile_caption'); ?>" rel="np" class="icon-profile link-first">
					<?php echo WoW_Locale::GetString('template_profile_caption'); ?>
					</a>
					<a href="/wow/search?f=post&amp;a=%D0%9D%D0%B0%D0%B4%D0%B5%D0%B6%D0%B4%D0%B0%40%D0%A1%D0%B2%D0%B5%D0%B6%D0%B5%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8C%20%D0%94%D1%83%D1%88&amp;s=time" title="<?php echo WoW_Locale::GetString('template_blog_lookup_forum_messages'); ?>" rel="np" class="icon-posts">
					</a>
					<a href="javascript:;" title="<?php echo WoW_Locale::GetString('template_blog_add_to_black_list'); ?>" rel="np" class="icon-ignore link-last" onclick="Cms.ignore(13072262, false); return false;">
					</a>
			</div>
		</div>
	</div>
        <a href="/wow/character/свежеватель-душ/%d0%9d%d0%b0%d0%b4%d0%b5%d0%b6%d0%b4%d0%b0/" class="context-link" rel="np">
        	Надежда
        </a>
    </div>
    <span class="time"><a href="#c-2037924340">2 ч 18 мин назад</a></span>
    </div>
    <div class="content" >Comment text</div>
        <div class="comment-actions">
            <a class="reply-link" href="#c-2037924340" onclick="Cms.Comments.replyTo('2037924340','1304216959564','Надежда'); return false;"><?php echo WoW_Locale::GetString('template_blog_answer'); ?></a>
        </div>
    </div>
 </div>




                        <div class="nested">
							<div style="z-index: 36;" class="comment" id="c-2037854484">

								<div class="avatar portrait-c">

										<a href="/wow/character/ясеневыи-лес/%d0%91%d0%bb%d1%83%d0%b4%d0%b8%d0%ba%d0%bb%d0%be%d0%bb/">
											<img height="64" src="http://eu.battle.net/static-render/eu/ясеневыи-лес/111/60655215-avatar.jpg?alt=/wow/static/images/2d/avatar/1-0.jpg" alt="" />
										</a>

								</div>


                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Блудиклол 
		</span>



	<div id="context-5" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Блудиклол</strong>
						<br />
						<span>Ясеневый лес</span>
			</div>








			<div class="context-links">
					<a href="/wow/character/ясеневыи-лес/%d0%91%d0%bb%d1%83%d0%b4%d0%b8%d0%ba%d0%bb%d0%be%d0%bb/" title="<?php echo WoW_Locale::GetString('template_profile_caption'); ?>" rel="np"
					   class="icon-profile link-first"
					   >
						<?php echo WoW_Locale::GetString('template_profile_caption'); ?>
					</a>
					<a href="/wow/search?f=post&amp;a=%D0%91%D0%BB%D1%83%D0%B4%D0%B8%D0%BA%D0%BB%D0%BE%D0%BB%40%D0%AF%D1%81%D0%B5%D0%BD%D0%B5%D0%B2%D1%8B%D0%B9%20%D0%BB%D0%B5%D1%81&amp;s=time" title="<?php echo WoW_Locale::GetString('template_blog_lookup_forum_messages'); ?>" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="<?php echo WoW_Locale::GetString('template_blog_add_to_black_list'); ?>" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(18725897, false); return false;">
						
					</a>
			</div>
		</div>

	</div>


        <a href="/wow/character/ясеневыи-лес/%d0%91%d0%bb%d1%83%d0%b4%d0%b8%d0%ba%d0%bb%d0%be%d0%bb/" class="context-link" rel="np">
        	Блудиклол
        </a>
    </div>


                                    <span class="time"><a href="#c-2037854484">1 ч 59 мин назад</a></span>

                                </div>

                                <div class="content" >
                                    @Надежда: <br/>Answer 1
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2037854484" onclick="Cms.Comments.replyTo('2037854484','1304216959564','Блудиклол'); return false;"><?php echo WoW_Locale::GetString('template_blog_answer'); ?></a>
                                </div>
                            </div>
                        </div>




							<div style="z-index: 35;" class="comment" id="c-2037814493">

								<div class="avatar portrait-c">

										<a href="/wow/character/вечная-песня/%d0%a4%d1%83%d0%bd%d0%b5%d0%b1%d1%80%d0%b8%d1%83%d0%bc/">
											<img height="64" src="http://eu.battle.net/static-render/eu/вечная-песня/74/36432202-avatar.jpg?alt=/wow/static/images/2d/avatar/11-1.jpg" alt="" />
										</a>

								</div>


                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Фунебриум 
		</span>



	<div id="context-6" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Фунебриум</strong>
						<br />
						<span>Вечная Песня</span>
			</div>








			<div class="context-links">
					<a href="/wow/character/вечная-песня/%d0%a4%d1%83%d0%bd%d0%b5%d0%b1%d1%80%d0%b8%d1%83%d0%bc/" title="<?php echo WoW_Locale::GetString('template_profile_caption'); ?>" rel="np"
					   class="icon-profile link-first"
					   >
						<?php echo WoW_Locale::GetString('template_profile_caption'); ?>
					</a>
					<a href="/wow/search?f=post&amp;a=%D0%A4%D1%83%D0%BD%D0%B5%D0%B1%D1%80%D0%B8%D1%83%D0%BC%40%D0%92%D0%B5%D1%87%D0%BD%D0%B0%D1%8F%20%D0%9F%D0%B5%D1%81%D0%BD%D1%8F&amp;s=time" title="<?php echo WoW_Locale::GetString('template_blog_lookup_forum_messages'); ?>" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="<?php echo WoW_Locale::GetString('template_blog_add_to_black_list'); ?>" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(910912, false); return false;">
						
					</a>
			</div>
		</div>

	</div>


        <a href="/wow/character/вечная-песня/%d0%a4%d1%83%d0%bd%d0%b5%d0%b1%d1%80%d0%b8%d1%83%d0%bc/" class="context-link" rel="np">
        	Фунебриум
        </a>
    </div>


                                    <span class="time"><a href="#c-2037814493">10 мин назад</a></span>

                                </div>

                                <div class="content" >
                                    @Блудиклол: <br/>Answer 2
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2037814493" onclick="Cms.Comments.replyTo('2037814493','1304216959564','Фунебриум'); return false;"><?php echo WoW_Locale::GetString('template_blog_answer'); ?></a>
                                </div>
                            </div>
                        </div>


                        </div>


                <div class="page-nav-container">
                    <div class="page-nav-int">








        <!--<div class="pageNav">

            	<span class="active">1</span>


						<a href="/wow/blog/<?php echo WoW::GetBlogData('id'); ?>?page=2#page-comments">2</a>

						<div class="page-sep"></div>
						<a href="/wow/blog/<?php echo WoW::GetBlogData('id'); ?>?page=3#page-comments">3</a>

						<div class="page-sep"></div>
						<a href="/wow/blog/<?php echo WoW::GetBlogData('id'); ?>?page=4#page-comments">4</a>

						<div class="page-sep"></div>

            	<div class="page-sep">
            		…
        		</div>

	            <a href="/wow/blog/<?php echo WoW::GetBlogData('id'); ?>?page=14#page-comments">14</a>
		            	<a href="/wow/blog/<?php echo WoW::GetBlogData('id'); ?>?page=2#page-comments"><?php echo WoW_Locale::GetString('template_articles_full_caption'); ?> &gt;</a>
        </div>-->


                    </div>
                </div>
			</div>
        </div>
    </div>
                </div>
        </div>

		<div id="right">
        <?php WoW_Template::LoadTemplate('block_sidebar'); ?>
		</div>

	<span class="clear"><!-- --></span>
	</div>
</div>
</div>
</div>
