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
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/forum/#forum<?php echo WoW_Forums::GetGlobalCategoryId(); ?>" rel="np">
<?php echo WoW_Forums::GetGlobalCategoryTitle(); ?>
</a>
</li>
<li>
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/forum/<?php echo WoW_Forums::GetCategoryId(); ?>/" rel="np">
<?php echo WoW_Forums::GetCategoryTitle(); ?>
</a>
</li>
<li class="last">
<a href="<?php echo WoW::GetWoWPath(); ?>/wow/forum/<?php echo WoW_Forums::GetCategoryId(); ?>/topic" rel="np">
New Topic
</a>
</li>
</ol>-->
</div>
<div class="content-bot">    
	<script type="text/javascript">
	//<![CDATA[
		$(function() {
			Cms.Topic.topicInit();
		});
	//]]>
	</script>
    
    <div id="forum-content">
	
    <div class="talkback new-post"><a id="new-post"></a>
        <form method="post" onsubmit="return Cms.Topic.postValidate(this);" action="#new-post">
			<div>
        	<input type="hidden" name="xstoken" value="396a2031-47e2-44b8-99d3-a77c2f8ec2d5"/>
        	<input type="hidden" name="sessionPersist" value="forum.topic.form"/>
			<?php
			if(WoW_Account::IsLoggedIn()) {
			?>
            <div class="post general">
                    <div class="post-user-details ">
                        <h4>
                        	Create Thread
                                                    </h4>
	<div class="post-user ajax-update">

            <div class="avatar">
                <div class="avatar-interior">
                        <a href="<?php echo WoW_Account::GetActiveCharacterInfo('url'); ?>">
                        	<img height="84" src="<?php echo WoW::GetWoWPath(); ?>/wow/static/images/2d/avatar/<?php echo WoW_Account::GetActiveCharacterInfo('race'); ?>-<?php echo WoW_Account::GetActiveCharacterInfo('gender'); ?>.jpg" alt="" />
                        </a>
                </div>
            </div>

        <div class="character-info">



    <div class="user-name">
		<span class="char-name-code" style="display: none">
			<?php echo WoW_Account::GetActiveCharacterInfo('name'); ?> 
		</span>



	<div id="context-2" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong><?php echo WoW_Account::GetActiveCharacterInfo('name'); ?></strong>
						<br />
						<span class="realm up"><?php echo WoW_Account::GetActiveCharacterInfo('realmName'); ?></span>
			</div>







					

			<div class="context-links">
					<a href="<?php echo WoW_Account::GetActiveCharacterInfo('url'); ?>" title="Profile" rel="np"
					   class="icon-profile link-first"
					   >
						Profile
					</a>
					<a href="<?php echo WoW::GetWoWPath(); ?>/wow/search?f=post&amp;a=<?php echo urlencode(WoW_Account::GetActiveCharacterInfo('name') . ' @ ' . WoW_Account::GetActiveCharacterInfo('realmName')); ?>&amp;sort=time" title="View my posts" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="<?php echo WoW::GetWoWPath(); ?>/wow/vault/character/auction/<?php echo WoW_Account::GetActiveCharacterInfo('faction') == FACTION_HORDE ? 'horde' : 'alliance'; ?>/" title="View auctions" rel="np"
					   class="icon-auctions"
					   >
						
					</a>
					<a href="<?php echo WoW::GetWoWPath(); ?>/wow/vault/character/event" title="View events" rel="np"
					   class="icon-events link-last"
					   >
						
					</a>
			</div>
		</div>

	</div>

        <a href="<?php echo WoW_Account::GetActiveCharacterInfo('url'); ?>" class="context-link color-c<?php echo WoW_Account::GetActiveCharacterInfo('class'); ?>" rel="np">
        	<?php echo WoW_Account::GetActiveCharacterInfo('name'); ?>
        </a>
    </div>


            

            	<div class="userCharacter">



						<div class="character-desc">

							<span class="color-c<?php echo WoW_Account::GetActiveCharacterInfo('class'); ?>">
								<?php echo WoW_Account::GetActiveCharacterInfo('level'); ?> <?php echo WoW_Account::GetActiveCharacterInfo('race_text'); ?> <?php echo WoW_Account::GetActiveCharacterInfo('class_text'); ?>
							</span>
						</div>

							<?php
                            if(WoW_Account::GetActiveCharacterInfo('guildId') > 0) {
                                echo sprintf('<div class="guild">
								<a href="%s">%s</a>
							</div>', WoW_Account::GetActiveCharacterInfo('guildUrl'), WoW_Account::GetActiveCharacterInfo('guildName'));
                            }
                            ?>
                            

								<div class="achievements">0</div>

                </div>

        </div>
	</div>
                    </div>

                        <div class="post-edit">

                                <div id="post-errors">
                                    </div>

						 <div class="talkback-controls">
                            <a href="javascript:;" onclick="Cms.Topic.previewToggle(this, 'preview')" class="preview-btn">
                            	<span class="arr"></span><span class="r"></span><span class="c">Preview</span>
                            </a>
                            <a href="javascript:;" onclick="Cms.Topic.previewToggle(this, 'edit')" class="edit-btn selected">
                            	<span class="arr"></span><span class="r"></span><span class="c">Edit</span>
                            </a>
                        </div>


                        <div class="editor1" id="post-edit">
                        	<a id="editorMax" rel="5000"></a>

    <input type="text" id="subject" name="subject" value="" class="post-subject" maxlength="55"    />


    <textarea id="postCommand.detail" name="postCommand.detail" class="post-editor" cols="78" rows="13"></textarea>

							<script type="text/javascript" src="<?php echo WoW::GetWoWPath(); ?>/wow/static/local-common/js/bml.js"></script>
	<script type="text/javascript">
	//<![CDATA[
								$(function() {
										Wow.addBmlCommands();
									BML.initialize('#post-edit', false);
								});
	//]]>
	</script>
                        </div>

						<div class="post-detail" id="post-preview"></div>

                        <div class="talkback-btm">
	<table class="dynamic-center ">
		<tr>
			<td>                            	<div id="submitBtn">
                                	

	<button
		class="ui-button button1 "
			type="submit"
			
		
		
		
		
		
		
		>
		<span>
			<span>Submit</span>
		</span>
	</button>

                                </div>
</td>
		</tr>
	</table>
                        </div>


                    </div>
	<span class="clear"><!-- --></span>


            </div>
			</div>
			<?php }
			else {
			?>
			<div class="post ">
	<table class="dynamic-center ">
		<tr>
			<td>
		<a class="ui-button button1 " href="?login" onclick="return Login.open('<?php echo WoW::GetWoWPath(); ?>/login/login.frag')">
			<span>
				<span>Add a reply</span>
			</span>
		</a>
		</td>
		</tr>
	</table>
            </div>
			</div>
			<?php } ?>
        </form>
	<span class="clear"><!-- --></span>
        <div class="talkback-code">
			<div class="talkback-code-interior">
                <div class="talkback-icon">
                    <h4 class="code-header">Please report any Code of Conduct violations, including:</h4>
                    <p>Threats of violence. <strong>We take these seriously and will alert the proper authorities.</strong></p>
                    <p>Posts containing personal information about other players. <strong>This includes physical addresses, e-mail addresses, phone numbers, and inappropriate photos and/or videos.</strong></p>
                    <p>Harassing or discriminatory language. <strong>This will not be tolerated.</strong></p>
                    	<p>Click <a href="http://battle.net/community/conduct">here</a> to view the Forums Code of Conduct.</p>
                </div>
			</div>
        </div>

    </div>

	</div>

</div>
</div>
</div>
