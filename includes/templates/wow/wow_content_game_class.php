<div id="content">
<div class="content-top">
<div class="content-trail">
<ol class="ui-breadcrumb">
<li><a href="<?php echo WoW::GetWoWPath(); ?>/wow/" rel="np">World of Warcraft</a></li>
<li><a href="<?php echo WoW::GetWoWPath(); ?>/wow/game/" rel="np"><?php echo WoW_Locale::GetString('template_menu_game'); ?></a></li>
<li><a href="<?php echo WoW::GetWoWPath(); ?>/wow/game/race/" rel="np"><?php echo WoW_Locale::GetString('template_game_class_index'); ?></a></li>
<li class="last"><a href="<?php echo WoW::GetWoWPath(); ?>/wow/game/race/<?php echo WoW_Template::GetPageData('class'); ?>" rel="np"><?php echo WoW_Locale::GetString('template_game_classes_'.WoW_Template::GetPageData('class')); ?></a></li>
</ol>
</div>
    <div class="content-bot">
      <div id="content-subheader">
        <a class="class-parent" href="./"><?php echo WoW_Locale::GetString('template_game_classes_title'); ?></a>
        <span class="clear"><!-- --></span>
        <h4><?php echo WoW_Locale::GetString('template_game_classes_'.WoW_Template::GetPageData('class')); ?></h4>
      </div>
      <div class="faction-req"><?php echo (WoW_Template::GetPageData('class') == 'death-knight') ? '<span class="req wrath">'.WoW_Locale::GetString('template_game_class_req_wrath').'</span>' : ''; ?>
      </div>
      <span class="clear"><!-- --></span>
      <div class="left-col">
        <div class="story-highlight">
          <p><?php echo WoW_Locale::GetString('template_game_class_'.WoW_Template::GetPageData('class').'_story'); ?></p>
        </div>
        <div class="story-main">
          <div class="story-illustration"></div>
          <?php echo WoW_Locale::GetString('template_game_class_'.WoW_Template::GetPageData('class').'_story_long'); ?>
        </div>
        <div class="basic-info-box-list basic-info">
          <div class="basic-info-box-list-title">
            <span><?php echo sprintf(WoW_Locale::GetString('template_game_class_inforamtion'), WoW_Locale::GetString('template_game_classes_'.WoW_Template::GetPageData('class'))); ?></span>
          </div>
          <div class="list-box">
            <div class="wrapper">
              <p><?php echo WoW_Locale::GetString('template_game_class_'.WoW_Template::GetPageData('class').'_information'); ?></p>
              <ul>
                <li><span class="basic-info-title"><?php echo WoW_Locale::GetString('template_game_class_type'); ?></span><?php echo WoW_Locale::GetString('template_game_class_'.WoW_Template::GetPageData('class').'_type'); ?></li>
                <li><span class="basic-info-title"><?php echo WoW_Locale::GetString('template_game_class_bars'); ?></span><?php echo WoW_Locale::GetString('template_game_class_'.WoW_Template::GetPageData('class').'_bars'); ?></li>
                <li><span class="basic-info-title"><?php echo WoW_Locale::GetString('template_game_class_armor'); ?></span><?php echo WoW_Locale::GetString('template_game_class_'.WoW_Template::GetPageData('class').'_armor'); ?></li>
                <li><span class="basic-info-title"><?php echo WoW_Locale::GetString('template_game_class_weapons'); ?></span><?php echo WoW_Locale::GetString('template_game_class_'.WoW_Template::GetPageData('class').'_weapons'); ?></li>
              </ul>
              <span class="clear"><!-- --></span>
            </div>
          </div>
        </div>
        <div class="basic-info-box-list talent-info">
          <div class="basic-info-box-list-title">
            <span><?php echo sprintf(WoW_Locale::GetString('template_game_class_talents'), WoW_Locale::GetString('template_game_classes_'.WoW_Template::GetPageData('class'))); ?></span>
          </div>
          <div class="list-box">
            <div class="wrapper">
              <p><?php echo WoW_Locale::GetString('template_game_class_'.WoW_Template::GetPageData('class').'_talents'); ?></p>
              <div class="talent-info-wrapper">
                <div class="talent-header"><?php echo sprintf(WoW_Locale::GetString('template_game_class_talent_trees'), WoW_Locale::GetString('template_game_classes_'.WoW_Template::GetPageData('class'))); ?></div>
                <a href="javascript:;" data-fansite="talentcalc|warrior|000000000000000" class="fansite-link "></a>
                <span class="clear"><!-- --></span>
<?php
      $talent_trees = array(
          'warrior' => array(1 => 'ability_warrior_savageblow.jpg','ability_warrior_innerrage.jpg','ability_warrior_defensivestance.jpg'),
          'paladin' => array(1 => 'spell_holy_holybolt.jpg','ability_paladin_shieldofthetemplar.jpg','spell_holy_auraoflight.jpg'),
          'hunter' => array(1 => 'ability_hunter_bestialdiscipline.jpg','ability_hunter_focusedaim.jpg','ability_hunter_camouflage.jpg'),
          'rogue' => array(1 => 'ability_rogue_eviscerate.jpg','ability_backstab.jpg','ability_stealth.jpg'),
          'priest' => array(1 => 'spell_holy_powerwordshield.jpg','spell_holy_guardianspirit.jpg','spell_shadow_shadowwordpain.jpg'),
          'death-knight' => array(1 => 'spell_deathknight_bloodpresence.jpg','spell_deathknight_frostpresence.jpg','spell_deathknight_unholypresence.jpg'),
          'shaman' => array(1 => 'spell_nature_lightning.jpg','spell_nature_lightningshield.jpg','spell_nature_magicimmunity.jpg',),
          'mage' => array(1 => 'spell_holy_magicalsentry.jpg','spell_fire_firebolt02.jpg','spell_frost_frostbolt02.jpg'),
          'warlock' => array(1 => 'spell_shadow_deathcoil.jpg','spell_shadow_metamorphosis.jpg','spell_shadow_rainoffire.jpg'),
          'druid' => array(1 => 'spell_nature_starfall.jpg','ability_racial_bearform.jpg','spell_nature_healingtouch.jpg')
      );
      
      for($i=1;$i<4;++$i) {
              echo '<div class="talent-wrapper">
                  <div class="talent-block" style="background-image:url('.WoW::GetWoWPath().'/wow/icons/56/'.$talent_trees[WoW_Template::GetPageData('class')][$i].')">
                    <span class="circle-frame"></span>
                  </div>'.WoW_Locale::GetString('template_game_class_'.WoW_Template::GetPageData('class').'_talent'.$i).'
                </div>';
      }

?>                
                <span class="clear"><!-- --></span>
              </div>
              <span class="clear"><!-- --></span>
            </div>
          </div>
        </div>
      </div>
      <div class="right-col">
        <div class="game-scrollbox">
          <div class="scroll-title">
            <span>Warrior Features</span>
          </div>
          <div class="scroll-content">
            <div class="wrapper">
              <div class="feature-list">
<?php
      $features = array(
          'warrior' => array(1 => 'ability_defend.jpg','ability_meleedamage.jpg','spell_nature_ancestralguardian.jpg','ability_warrior_offensivestance.jpg',),
          'paladin' => array(1 => 'spell_holy_avengersshield.jpg','spell_holy_crusaderstrike.jpg','spell_holy_devotionaura.jpg','spell_holy_layonhands.jpg',),
          'hunter' => array(1 => 'ability_hunter_beasttaming.jpg','inv_weapon_bow_02.jpg','spell_frost_chainsofice.jpg','ability_upgrademoonglaive.jpg',),
          'rogue' => array(1 => 'ability_stealth.jpg','inv_weapon_shortblade_15.jpg','spell_shadow_shadowward.jpg','ability_rogue_eviscerate.jpg',),
          'priest' => array(1 => 'spell_holy_greaterheal.jpg','spell_shadow_shadowform.jpg','spell_holy_powerwordshield.jpg','spell_shadow_shadowworddominate.jpg',),
          'death-knight' => array(1 => 'spell_nature_shamanrage.jpg','spell_deathknight_empowerruneblade.jpg','spell_shadow_raisedead.jpg','spell_deathknight_frozenruneweapon.jpg',),
          'shaman' => array(1 => 'spell_nature_healingwavegreater.jpg','spell_shaman_unleashweapon_wind.jpg','spell_nature_lightning.jpg','spell_shaman_dropall_02.jpg'),
          'mage' => array(1 => 'spell_fire_flamebolt.jpg','spell_frost_icestorm.jpg','spell_nature_polymorph.jpg','spell_arcane_portaldalaran.jpg',),
          'warlock' => array(1 => 'spell_shadow_summonfelhunter.jpg','spell_shadow_lifedrain02.jpg','spell_shadow_shadowbolt.jpg','inv_misc_gem_amethyst_02.jpg',),
          'druid' => array(1 => 'ability_druid_mastershapeshifter.jpg','spell_nature_resistnature.jpg','ability_druid_demoralizingroar.jpg','inv_misc_monsterclaw_03.jpg',)
      );
      
      for($i=1;$i<((WoW_Template::GetPageData('class') == 'blood-elf')?4:5);++$i) {
              echo '<div class="feature-item clear-after">
								<span class="icon-frame-gloss float-left" style="background-image: url('.WoW::GetWoWPath().'/wow/icons/56/'.$features[WoW_Template::GetPageData('class')][$i].')">
									<span class="frame"></span>
								</span>
								<div class="feature-wrapper">
									<span class="feature-item-title">'.WoW_Locale::GetString('template_game_class_'.WoW_Template::GetPageData('class').'_feature_title'.$i).'</span>
									<p class="feature-item-desc">'.WoW_Locale::GetString('template_game_class_'.WoW_Template::GetPageData('class').'_feature_desc'.$i).'</p>
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
          <div class="available-info-box-title"><?php echo sprintf(WoW_Locale::GetString('template_game_class_races'), WoW_Locale::GetString('template_game_classes_'.WoW_Template::GetPageData('class'))); ?></div>
          <span class="available-info-box-desc">
          </span>
          <div class="list-box">
            <div class="wrapper">
              <ul>
<?php
              //don't change order of this array, "next" & "prev" buttons depend's on it
              $races = array(
                  'warrior' => array(RACE_DRAENEI, RACE_DWARF, RACE_GNOME, RACE_HUMAN, RACE_NIGHTELF, 22, RACE_BLOODELF, 9, RACE_ORC, RACE_TAUREN, RACE_TROLL, RACE_UNDEAD),
                  'paladin' => array(RACE_DRAENEI, RACE_DWARF, RACE_HUMAN, RACE_TAUREN),
                  'hunter' => array(RACE_DRAENEI, RACE_DWARF, RACE_HUMAN, RACE_NIGHTELF, 22, RACE_BLOODELF, 9, RACE_ORC, RACE_TAUREN, RACE_TROLL, RACE_UNDEAD),
                  'rogue' => array(RACE_DWARF, RACE_GNOME, RACE_HUMAN, RACE_NIGHTELF, 22, RACE_BLOODELF, 9, RACE_ORC, RACE_TROLL, RACE_UNDEAD),
                  'priest' => array(RACE_DRAENEI, RACE_DWARF, RACE_GNOME, RACE_HUMAN, RACE_NIGHTELF, 22, RACE_BLOODELF, 9, RACE_TAUREN, RACE_TROLL, RACE_UNDEAD),
                  'death-knight' => array(RACE_DRAENEI, RACE_DWARF, RACE_GNOME, RACE_HUMAN, RACE_NIGHTELF, 22, RACE_BLOODELF, 9, RACE_ORC, RACE_TAUREN, RACE_TROLL, RACE_UNDEAD),
                  'shaman' => array(RACE_DRAENEI, RACE_DWARF, 9, RACE_ORC, RACE_TAUREN, RACE_TROLL),
                  'mage' => array(RACE_DRAENEI, RACE_DWARF, RACE_GNOME, RACE_HUMAN, RACE_NIGHTELF, 22, RACE_BLOODELF, 9, RACE_ORC, RACE_TROLL, RACE_UNDEAD),
                  'warlock' => array(RACE_DWARF, RACE_GNOME, RACE_HUMAN, 22, RACE_BLOODELF, 9, RACE_ORC, RACE_TROLL, RACE_UNDEAD),
                  'druid' => array(RACE_NIGHTELF, 22, RACE_TAUREN, RACE_TROLL),
              );
              $names = array(RACE_DRAENEI => 'draenei',
                             RACE_DWARF => 'dwarf',
                             RACE_GNOME => 'gnome',
                             RACE_HUMAN => 'human',
                             RACE_NIGHTELF => 'night-elf',
                             22 => 'worgen',
                             RACE_BLOODELF => 'blood-elf',
                             9 => 'goblin',
                             RACE_ORC => 'orc',
                             RACE_TAUREN => 'tauren',
                             RACE_TROLL => 'troll',
                             RACE_UNDEAD => 'forsaken'
              );
              $alliance_races = array(1 =>'worgen','draenei','dwarf','gnome','human','night-elf');
              $horde_races = array(1 =>'goblin','blood-elf','orc','tauren','troll','forsaken' );
              $mf = array('female', 'male');
              for($i=0;$i<count($races[WoW_Template::GetPageData('class')]);++$i) {
                  echo '<li>
								<a href="../race/'.$names[$races[WoW_Template::GetPageData('class')][$i]].'">
									<span class="icon-frame frame-36" style="background-image: url('.WoW::GetWoWPath().'/wow/icons/36/race_'.$names[$races[WoW_Template::GetPageData('class')][$i]].'_'.$mf[array_rand($mf)].'.jpg);">
										<span class="frame"></span>
									</span>
									<span class="list-title">'.WoW_Locale::GetString('template_game_race_'.$names[$races[WoW_Template::GetPageData('class')][$i]]).'
                    <span class="list-faction '.((in_array($names[$races[WoW_Template::GetPageData('class')][$i]], $alliance_races)) ? 'alliance' : 'horde').'">'.((in_array($names[$races[WoW_Template::GetPageData('class')][$i]], $alliance_races)) ? WoW_Locale::GetString('template_game_class_alliance') : WoW_Locale::GetString('template_game_class_horde')).'</span></span>
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
              <a href="<?php echo WoW::GetWoWPath(); ?>/wow/media/artwork/wow-classes?view=&amp;keywords=<?php echo WoW_Template::GetPageData('class'); ?>">
                <img src="<?php echo WoW::GetWoWPath(); ?>/wow/static/images/game/class/thumbnails/<?php echo WoW_Template::GetPageData('class'); ?>-artwork.jpg" alt="<?php echo WoW_Locale::GetString('template_game_class_artwork'); ?>" title="<?php echo WoW_Locale::GetString('template_game_class_artwork'); ?>" width="327" height="134" /></a>
              <div class="caption"><a href="<?php echo WoW::GetWoWPath(); ?>/wow/media/artwork/wow-classes?view=&amp;keywords=<?php echo WoW_Template::GetPageData('class'); ?>" class="view-all"><?php echo WoW_Locale::GetString('template_game_class_viewall'); ?></a><?php echo WoW_Locale::GetString('template_game_class_artwork'); ?>
                <span class="clear"><!-- --></span>
              </div></td>
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
              <a href="<?php echo WoW::GetWoWPath(); ?>/wow/media/screenshots/classes?keywords=<?php echo WoW_Template::GetPageData('class'); ?>">
                <img src="<?php echo WoW::GetWoWPath(); ?>/wow/static/images/game/class/thumbnails/<?php echo WoW_Template::GetPageData('class'); ?>-screenshot.jpg" alt="<?php echo WoW_Locale::GetString('template_game_class_screenshots'); ?>" title="<?php echo WoW_Locale::GetString('template_game_class_screenshots'); ?>" width="327" height="134" /></a>
              <div class="caption"><a href="javascript:;" class="view-all"><?php echo WoW_Locale::GetString('template_game_class_viewall'); ?></a><?php echo WoW_Locale::GetString('template_game_class_screenshots'); ?>
                <span class="clear"><!-- --></span>
              </div></td>
            <td class="mr"></td>
          </tr>
          <tr>
            <td class="bl"></td>
            <td class="bm"></td>
            <td class="br"></td>
          </tr>
        </table>
        <span class="clear">
          <!-- -->
        </span> 
        <div class="fansite-link-box">
          <div class="wrapper">
            <span class="fansite-box-title"><?php echo WoW_Locale::GetString('template_game_class_more'); ?></span>
            <p><?php echo WoW_Locale::GetString('template_game_class_more_desc'); ?></p>
            <div id="sdgksdngklsdngl35">
            </div>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
Fansite.generate($('#sdgksdngklsdngl35'), "class|1|Warrior");
});
//]]>
</script>
          </div>
        </div>
      </div>
      <span class="clear">
        <!-- -->
      </span>
      <div class="guide-page-nav">
        <span class="current-guide-title"><?php echo WoW_Locale::GetString('template_game_classes_'.WoW_Template::GetPageData('class')); ?></span>
<?php
$list_classes = array_keys($races);
reset($list_classes);
for($i=0;$i<count($list_classes);$i++) {
    if($list_classes[key($list_classes)] != WoW_Template::GetPageData('class')) {
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

echo '<a class="ui-button next-class button1-next" href="'.$next.'"><span><span>'.sprintf(WoW_Locale::GetString('template_game_race_next'), WoW_Locale::GetString('template_game_classes_'.$next)).'</span></span></a>
<a class="ui-button previous-class button1-previous" href="'.$prev.'"><span><span>'.sprintf(WoW_Locale::GetString('template_game_race_prev'), WoW_Locale::GetString('template_game_classes_'.$prev)).'</span></span></a>';
?>
      </div>
