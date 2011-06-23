<div id="content">
<div class="content-top">
<div class="content-trail">
<ol class="ui-breadcrumb">
<li><a href="<?php echo WoW::GetWoWPath(); ?>/wow/" rel="np">World of Warcraft</a></li>
<li><a href="<?php echo WoW::GetWoWPath(); ?>/wow/game/" rel="np"><?php echo WoW_Locale::GetString('template_menu_game'); ?></a></li>
<li><a href="<?php echo WoW::GetWoWPath(); ?>/wow/game/race/" rel="np"><?php echo WoW_Locale::GetString('template_game_race_index'); ?></a></li>
<li class="last"><a href="<?php echo WoW::GetWoWPath(); ?>/wow/game/race/<?php echo WoW_Template::GetPageData('race'); ?>" rel="np"><?php echo WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race')); ?></a></li>
</ol>
</div>
<div class="content-bot">
			<div id="content-subheader">
				<a class="race-parent" href="./"><?php echo WoW_Locale::GetString('template_game_race_title'); ?></a>
	      <span class="clear"><!-- --></span>
				<h4><?php echo WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race')); ?></h4>
			</div>	<span class="clear"><!-- --></span>
			<div class="faction-req">
<?php
      $alliance_races = array(1 =>'worgen','draenei','dwarf','gnome','human','night-elf');
      $horde_races = array(1 =>'goblin','blood-elf','orc','tauren','troll','forsaken' );
      $races = array(
          'alliance' => $alliance_races,
          'horde' => $horde_races
      );
      $exp_races = array(
          'cataclysm' => array(1 =>'worgen', 'goblin'),
          'bc' =>  array(1 =>'draenei', 'blood-elf')
      );
      foreach ($races as $faction => $value) {
          if(array_search(WoW_Template::GetPageData('race'), $races[$faction]) == true) {
              $group = $faction;
          }
      }
      $req = null;
      foreach ($exp_races as $exp => $value) {
          if(array_search(WoW_Template::GetPageData('race'), $exp_races[$exp]) == true) {
              $req = sprintf('<span class="req %s">%s</span>', $exp, WoW_Locale::GetString('template_game_race_req_'.$exp));
          }
      }
      echo sprintf('<span class="group %s">%s</span>%s', $group, WoW_Locale::GetString('template_game_race_'.$group), $req);
?>			
      </div>
	    <span class="clear"><!-- --></span>
			<div class="left-col">
				<div class="story-highlight"><?php echo WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_story'); ?></div>
				<div class="story-main"><?php echo WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_story_long'); ?></div>
<?php
      if(WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_location') != '') {
?>
      <div class="race-basic start-location" style="background-image:url(<?php echo WoW::GetWoWPath(); ?>/wow/static/images/game/race/draenei/start-location.jpg)">
			 <h5 class="basic-header"><span class="overview-icon"></span><?php echo WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_location'); ?></h5>
			 <div class="basic-story"><?php echo WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_location_info'); ?></div>
<?php
      }
      
      if(WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_city') != '')
      {
?>      
      <div class="race-basic home-city" style="background-image:url(<?php echo WoW::GetWoWPath(); ?>/wow/static/images/game/race/<?php echo WoW_Template::GetPageData('race'); ?>/home.jpg)">
  			<h5 class="basic-header"><span class="overview-icon"></span><?php echo WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_city'); ?></h5>
  			<div class="basic-story"><?php echo WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_city_info'); ?></div>
<?php
      }
?>
      <div class="race-basic racial-mount" style="background-image:url(<?php echo WoW::GetWoWPath(); ?>/wow/static/images/game/race/<?php echo WoW_Template::GetPageData('race'); ?>/mount.jpg)">
  			<h5 class="basic-header"><span class="overview-icon"></span><?php echo WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_mount'); ?></h5>
  			<div class="basic-story"><?php echo WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_mount_info'); ?></div>
  		<div class="race-basic leader" style="background-image:url(<?php echo WoW::GetWoWPath(); ?>/wow/static/images/game/race/<?php echo WoW_Template::GetPageData('race'); ?>/leader.jpg)">
  			<h5 class="basic-header"><span class="overview-icon"></span><?php echo WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_leader'); ?></h5>
  			<div class="basic-story"><?php echo WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_leader_info'); ?></div>
		</div>
	   <span class="clear"><!-- --></span>
		</div>
	   <span class="clear"><!-- --></span>
<?php
		echo (WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_city') != '') ? '</div>' : '';
?>
	   <span class="clear"><!-- --></span>
<?php
		echo (WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_location') != '') ? '</div>' : '';
?>
		  </div>


			<div class="right-col">
	<div class="game-scrollbox">
		<div class="scroll-title"><span><?php echo sprintf(WoW_Locale::GetString('template_game_race_racial_traits'), WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race'))); ?></span></div>
		<div class="scroll-content">
			<div class="wrapper">
					<div class="feature-list">
					
<?php
      $features = array(
          'worgen' => array(1 => 'ability_mount_blackdirewolf.jpg','spell_shadow_antishadow.jpg','ability_druid_dash.jpg','achievement_worganhead.jpg',),
          'draenei' => array(1 => 'spell_holy_holyprotection.jpg','spell_shadow_detectinvisibility.jpg','inv_helmet_21.jpg','spell_misc_conjuremanajewel.jpg',),
          'dwarf' => array(1 => 'spell_shadow_unholystrength.jpg','spell_frost_wizardmark.jpg','inv_misc_map08.jpg','inv_musket_03.jpg',),
          'gnome' => array(1 => 'ability_rogue_trip.jpg','spell_nature_wispsplode.jpg','inv_enchant_essenceeternallarge.jpg','inv_misc_gear_01.jpg',),
          'human' => array(1 => 'spell_shadow_charm.jpg','inv_misc_note_02.jpg','inv_enchant_shardbrilliantsmall.jpg','ability_meleedamage.jpg',),
          'night-elf' => array(1 => 'ability_ambush.jpg','spell_nature_wispsplode.jpg','spell_nature_spiritarmor.jpg','ability_racial_shadowmeld.jpg',),
          'blood-elf' => array(1 => 'spell_shadow_teleport.jpg','inv_enchant_shardglimmeringlarge.jpg','spell_shadow_antimagicshell.jpg',),
          'orc' => array(1 => 'racial_orc_berserkerstrength.jpg','inv_helmet_23.jpg','ability_warrior_warcry.jpg','inv_axe_02.jpg',),
          'tauren' => array(1 => 'ability_warstomp.jpg','spell_nature_spiritarmor.jpg','spell_nature_unyeildingstamina.jpg','inv_misc_flower_01.jpg',),
          'troll' => array(1 => 'racial_troll_berserk.jpg','inv_misc_idol_02.jpg','spell_nature_regenerate.jpg','inv_weapon_bow_12.jpg',),
          'forsaken' => array(1 => 'spell_shadow_raisedead.jpg','spell_shadow_detectinvisibility.jpg','ability_racial_cannibalize.jpg','spell_shadow_demonbreath.jpg',),
          'goblin' => array(1 => 'ability_racial_rocketjump.jpg','inv_gizmo_rocketlauncher.jpg','ability_racial_packhobgoblin.jpg','ability_racial_bestdealsanywhere.jpg',)
      );
      
      for($i=1;$i<((WoW_Template::GetPageData('race') == 'blood-elf')?4:5);++$i) {
              echo '<div class="feature-item clear-after">
								<span class="icon-frame-gloss float-left" style="background-image: url('.WoW::GetWoWPath().'/wow/icons/56/'.$features[WoW_Template::GetPageData('race')][$i].')">
									<span class="frame"></span>
								</span>
								<div class="feature-wrapper">
									<span class="feature-item-title">'.WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_feature_title'.$i).'</span>
									<p class="feature-item-desc">'.WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race').'_feature_desc'.$i).'</p>
								</div>
	               <span class="clear"><!-- --></span>
							</div>';
      }

?>
					</div>
			</div>
		</div>
	</div>

	<div class="available-info-box ">
		<div class="available-info-box-title"><?php echo WoW_Locale::GetString('template_game_race_classes'); ?></div>
		<span class="available-info-box-desc"><?php echo sprintf(WoW_Locale::GetString('template_game_race_classes_desc'), WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race'))); ?></span>
		<div class="list-box">
			<div class="wrapper">
					<ul>
<?php
              //don't change order of this array, "next" & "prev" buttons depend's on it
              $classes = array(
                  'worgen' => array(CLASS_DK, CLASS_DRUID, CLASS_HUNTER, CLASS_MAGE, CLASS_PRIEST, CLASS_ROGUE, CLASS_WARLOCK, CLASS_WARRIOR),
                  'draenei' => array(CLASS_DK, CLASS_HUNTER, CLASS_MAGE, CLASS_PALADIN, CLASS_PRIEST, CLASS_SHAMAN, CLASS_WARRIOR),
                  'dwarf' => array(CLASS_DK, CLASS_HUNTER, CLASS_MAGE, CLASS_PALADIN, CLASS_PRIEST, CLASS_ROGUE, CLASS_SHAMAN, CLASS_WARLOCK, CLASS_WARRIOR),
                  'gnome' => array(CLASS_DK, CLASS_MAGE, CLASS_PRIEST, CLASS_ROGUE, CLASS_WARLOCK, CLASS_WARRIOR),
                  'human' => array(CLASS_DK, CLASS_HUNTER, CLASS_MAGE, CLASS_PALADIN, CLASS_PRIEST, CLASS_ROGUE, CLASS_WARLOCK, CLASS_WARRIOR),
                  'night-elf' => array(CLASS_DK, CLASS_DRUID, CLASS_HUNTER, CLASS_MAGE, CLASS_PRIEST, CLASS_ROGUE, CLASS_WARRIOR),

                  'blood-elf' => array(CLASS_DK, CLASS_HUNTER, CLASS_MAGE, CLASS_PALADIN, CLASS_PRIEST, CLASS_ROGUE, CLASS_WARLOCK, CLASS_WARRIOR),
                  'orc' => array(CLASS_DK, CLASS_HUNTER, CLASS_MAGE, CLASS_ROGUE, CLASS_SHAMAN, CLASS_WARLOCK, CLASS_WARRIOR),
                  'tauren' => array(CLASS_DK, CLASS_DRUID, CLASS_HUNTER, CLASS_PRIEST, CLASS_SHAMAN, CLASS_WARRIOR),
                  'troll' => array(CLASS_DK, CLASS_DRUID, CLASS_HUNTER, CLASS_MAGE, CLASS_PRIEST, CLASS_ROGUE, CLASS_SHAMAN, CLASS_WARLOCK, CLASS_WARRIOR),
                  'forsaken' => array(CLASS_DK, CLASS_HUNTER, CLASS_MAGE, CLASS_PRIEST, CLASS_ROGUE, CLASS_WARLOCK, CLASS_WARRIOR),
                  'goblin' => array(CLASS_DK, CLASS_HUNTER, CLASS_MAGE, CLASS_PRIEST, CLASS_ROGUE, CLASS_SHAMAN, CLASS_WARLOCK, CLASS_WARRIOR)
              );
              $names = array(CLASS_WARRIOR=> 'warrior',
                             CLASS_DRUID=> 'druid',
                             CLASS_PRIEST=> 'priest',
                             CLASS_MAGE=> 'mage',
                             CLASS_HUNTER=> 'hunter',
                             CLASS_PALADIN=> 'paladin',
                             CLASS_ROGUE=> 'rogue',
                             CLASS_DK=> 'death-knight',
                             CLASS_WARLOCK=> 'warlock',
                             CLASS_SHAMAN=> 'shaman'
              );
              for($i=0;$i<count($classes[WoW_Template::GetPageData('race')]);++$i) {
                  echo '<li>
								<a href="../class/'.$names[$classes[WoW_Template::GetPageData('race')][$i]].'">
									<span class="icon-frame frame-36 class-icon-36 class-icon-36-'.$names[$classes[WoW_Template::GetPageData('race')][$i]].'">
										<span class="frame"></span>
									</span>
									<span class="list-title">'.WoW_Locale::GetString('template_game_classes_'.$names[$classes[WoW_Template::GetPageData('race')][$i]]).'</span>
								</a>
							</li>';
              };
?>
					</ul>
        	<span class="clear"><!-- --></span>
        	<span class="clear"><!-- --></span>
			</div>
		</div>
	</div>
	<table class="media-frame">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
					<a href="<?php echo WoW::GetWoWPath(); ?>/wow/media/artwork/wow-races?view=&amp;keywords=<?php echo WoW_Template::GetPageData('race'); ?>"><img src="<?php echo WoW::GetWoWPath(); ?>/wow/static/images/game/race/<?php echo WoW_Template::GetPageData('race'); ?>/thumb-artwork.jpg" alt="<?php echo WoW_Locale::GetString('template_game_race_artwork'); ?>" title="<?php echo WoW_Locale::GetString('template_game_race_artwork'); ?>" width="327" height="134" /></a>
					<div class="caption">
						<a href="<?php echo WoW::GetWoWPath(); ?>/wow/media/artwork/wow-races?view=&amp;keywords=<?php echo WoW_Template::GetPageData('race'); ?>" class="view-all"><?php echo WoW_Locale::GetString('template_game_race_viewall'); ?></a>
            <?php echo WoW_Locale::GetString('template_game_race_artwork'); ?>
	         <span class="clear"><!-- --></span>
					</div>
			</td>
			<td class="mr"></td>
		</tr>
		<tr>
			<td class="bl"></td>
			<td class="bm"></td>
			<td class="br"></td>
		</tr>
	</table>
	<table class="media-frame">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
					<a href="<?php echo WoW::GetWoWPath(); ?>/wow/media/screenshots/races?keywords=<?php echo WoW_Template::GetPageData('race'); ?>"><img src="<?php echo WoW::GetWoWPath(); ?>/wow/static/images/game/race/<?php echo WoW_Template::GetPageData('race'); ?>/thumb-screenshot.jpg" alt="<?php echo WoW_Locale::GetString('template_game_race_screenshots'); ?>" title="<?php echo WoW_Locale::GetString('template_game_race_screenshots'); ?>" width="327" height="134" /></a>
					<div class="caption">
						<a href="javascript:;" class="view-all"><?php echo WoW_Locale::GetString('template_game_race_viewall'); ?></a>
						<?php echo WoW_Locale::GetString('template_game_race_screenshots'); ?>
	        <span class="clear"><!-- --></span>
					</div>
			</td>
			<td class="mr"></td>
		</tr>
		<tr>
			<td class="bl"></td>
			<td class="bm"></td>
			<td class="br"></td>
		</tr>
	</table>
				
				<div class="fansite-link-box">
					<div class="wrapper">
						<span class="fansite-box-title"><?php echo WoW_Locale::GetString('template_game_race_more'); ?></span>
						<p><?php echo WoW_Locale::GetString('template_game_race_more_desc'); ?></p>
						<div id="sdgksdngklsdngl35"></div>
	<script type="text/javascript">
	//<![CDATA[
							$(document).ready(function() {
								Fansite.generate($('#sdgksdngklsdngl35'), "race|22|worgen");
							});
	//]]>
	</script>
					</div>
				</div>
			</div>
	<span class="clear"><!-- --></span>

			<div class="guide-page-nav">
				<span class="current-guide-title"><?php echo WoW_Locale::GetString('template_game_race_'.WoW_Template::GetPageData('race')); ?></span>
<?php
$list_classes = array_keys($classes);
reset($list_classes);
for($i=0;$i<count($list_classes);$i++) {
    if($list_classes[key($list_classes)] != WoW_Template::GetPageData('race')) {
        next($list_classes);
    }
    else {
        break;
    }
}
if(!array_key_exists(key($list_classes)-1, $list_classes))
{
    end($list_classes);
    $prev = $list_classes[key($list_classes)];
    reset($list_classes);
}
else
{
    $prev = $list_classes[key($list_classes)-1];
}
$curr = $list_classes[key($list_classes)];
if(!array_key_exists(key($list_classes)+1, $list_classes))
{
    reset($list_classes);
    $next = $list_classes[key($list_classes)];
}
else
{
    $next = $list_classes[key($list_classes)+1];
}

echo '<a class="ui-button next-race button1-next" href="'.$next.'"><span><span>'.sprintf(WoW_Locale::GetString('template_game_race_next'), WoW_Locale::GetString('template_game_race_'.$next)).'</span></span></a>
<a class="ui-button previous-race button1-previous" href="'.$prev.'"><span><span>'.sprintf(WoW_Locale::GetString('template_game_race_prev'), WoW_Locale::GetString('template_game_race_'.$prev)).'</span></span></a>';
?>

			</div>
