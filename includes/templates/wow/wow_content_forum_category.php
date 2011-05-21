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
<div class="content-bot">            
    <div id="forum-content">
		<script type="text/javascript">
		//<![CDATA[
			$(function(){ Cms.Forum.threadListInit('<?php echo WoW_Forums::GetCategoryId(); ?>'); });
		//]]>
	    </script>
		<div class="forum-options">
            <a href="javascript:;"  onclick="Cms.Forum.setView('advanced',this)"><?php echo WoW_Locale::GetString('template_forums_type_advanced'); ?></a>
        	<a href="javascript:;"  class="active" onclick="Cms.Forum.setView('simple',this)"><?php echo WoW_Locale::GetString('template_forums_type_simple'); ?></a>
        </div>
	
    <div class="forum-actions top">
		<div class="actions-panel">
				<form action="<?php echo WoW::GetWoWPath(); ?>/wow/search" class="forum-search" method="get">
					<div>
						<input type="text" name="q" value="Search this forum…" alt="Search this forum…" id="forum-search-field" />
						<input type="hidden" name="f" value="post" />
						<input type="hidden" name="forum" value="<?php echo WoW_Forums::GetCategoryId(); ?>" />
					</div>
				</form>
			
	<script type="text/javascript">
	//<![CDATA[
					$(function() { Input.bind('#forum-search-field'); });
	//]]>
	</script>


	<a class="ui-button button1 " href="topic">
		<span>
			<span><?php echo WoW_Locale::GetString('template_forums_create_thread'); ?></span>
		</span>
	</a>


	<span class="clear"><!-- --></span>
        </div>


        <div class="pageNav">

            	<span class="active">1</span>

        </div>

	<span class="clear"><!-- --></span>
    </div>

    <div id="posts-container">
			<table id="posts" cellspacing="0" class="simple">
				<thead>
					<tr class="post-th">
						<td></td>
						<td colspan="2"><?php echo WoW_Locale::GetString('template_forums_table_thread'); ?></td>
						<td><?php echo WoW_Locale::GetString('template_forums_table_author'); ?></td>
							<td class="replies"><?php echo WoW_Locale::GetString('template_forums_table_replies'); ?></td>
							<td class="views"><?php echo WoW_Locale::GetString('template_forums_table_views'); ?></td>
							<td class="poster"><?php echo WoW_Locale::GetString('template_forums_table_last_post'); ?></td>
					</tr>
				</thead>
					<tbody class="featured">
					</tbody>
	
					<tbody class="sticky">
					</tbody>
				
					<tbody class="regular">
                    </tbody>

			</table>
    </div>

        


        <div class="forum-info">
	
    <div class="forum-actions topic-bottom">
		<div class="actions-panel">

        <div class="pageNav">

            	<span class="active">1</span>

        </div>

	<a class="ui-button button1 " href="topic" >
		<span>
			<span><?php echo WoW_Locale::GetString('template_forums_create_thread'); ?></span>
		</span>
	</a>


	<span class="clear"><!-- --></span>
        </div>

    </div>
        </div>
    </div>
</div>
</div>
</div>
