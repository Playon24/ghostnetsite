<?php

// Talents data
$talents = WoW_Characters::GetTalentsData();
$audit = WoW_Characters::GetAudit();
echo '<!--
';
print_r($audit);
echo '
-->';
?>
<div id="content">
<div class="content-top">
<div class="content-trail">
<ol class="ui-breadcrumb">
<li>
<a href="/wow/" rel="np">
World of Warcraft
</a>
</li>
<li>
<a href="/wow/game/" rel="np">
Игра
</a>
</li>
<li class="last">
<a href="<?php echo WoW_Characters::GetURL(); ?>advanced" rel="np">
<?php echo sprintf('%s @ %s', WoW_Characters::GetName(), WoW_Characters::GetRealmName()); ?>
</a>
</li>
</ol>
</div>
<div class="content-bot">
	<div id="profile-wrapper" class="profile-wrapper profile-wrapper-advanced profile-wrapper-<?php echo WoW_Characters::GetFactionName(); ?> profile-wrapper-light">
		<div class="profile-sidebar-anchor">
			<div class="profile-sidebar-outer">
				<div class="profile-sidebar-inner">
					<div class="profile-sidebar-contents">

		<div class="profile-info-anchor">
			<div class="profile-info">
				<div class="name"><a href="<?php echo WoW_Characters::GetURL(); ?>" rel="np"><?php echo WoW_Characters::GetName(); ?></a></div>
				<div class="title-guild">
                    <?php
                    echo sprintf('<div class="title">%s</div>
                    <div class="guild">
							<a href="%s?character=%s">%s</a>
						</div>', WoW_Characters::GetTitleInfo('title'), WoW_Characters::GetGuildURL(), urlencode(WoW_Characters::GetName()), WoW_Characters::GetGuildName());
                    ?>						
				</div>
	<span class="clear"><!-- --></span>
				<div class="under-name color-c<?php echo WoW_Characters::GetClassID(); ?>">
						<a href="/wow/game/race/<?php echo WoW_Characters::GetRaceKey(); ?>" class="race"><?php echo WoW_Characters::GetRaceName(); ?></a>-<a href="/wow/game/class/<?php echo WoW_Characters::GetClassKey(); ?>" class="class"><?php echo WoW_Characters::GetClassName(); ?></a> (<span id="profile-info-spec" class="spec tip"><?php echo $talents['specsData'][WoW_Characters::GetActiveSpec()]['name']; ?></span>) <span class="level"><strong><?php echo WoW_Characters::GetLevel(); ?></strong></span> <?php echo WoW_Locale::GetString('template_lvl'); ?><span class="comma">,</span>
					<span class="realm tip" id="profile-info-realm" data-battlegroup="<?php echo WoWConfig::$DefaultBGName; ?>">
						<?php echo WoW_Characters::GetRealmName(); ?>
					</span>
				</div>
				<div class="achievements"><a href="<?php echo WoW_Characters::GetURL(); ?>achievement"><?php echo WoW_Achievements::GetAchievementsPoints(); ?></a></div>
			</div>
		</div>
	<?php
    WoW_Template::LoadTemplate('block_profile_menu');
    ?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="profile-contents">

		<div class="summary-top">
		
			<div class="summary-top-right">


	<ul class="profile-view-options" id="profile-view-options-summary">
			<li>
				<a href="javascript:;" rel="np" class="threed disabled">
					3D
				</a>
			</li>
			<li class="current">
				<a href="<?php echo WoW_Characters::GetURL(); ?>advanced" rel="np" class="advanced">
					<?php echo WoW_Locale::GetString('template_profile_advanced_profile'); ?>
				</a>
			</li>
			<li>
				<a href="<?php echo WoW_Characters::GetURL(); ?>simple" rel="np" class="simple">
					<?php echo WoW_Locale::GetString('template_profile_simple_profile'); ?>
				</a>
			</li>
	</ul>


					<div class="summary-averageilvl">
	<div class="rest">
		<?php echo WoW_Locale::GetString('template_profile_avg_itemlevel'); ?><br />
		(<span class="equipped"><?php echo WoW_Characters::GetAVGEquippedItemLevel(); ?></span> <?php echo WoW_Locale::GetString('template_profile_avg_equipped_itemlevel'); ?>)
	</div>
	<div id="summary-averageilvl-best" class="best tip" data-id="averageilvl">
		<?php echo WoW_Characters::GetAVGItemLevel(); ?>
	</div>
					</div>

			</div>
		
				<div class="summary-top-inventory">


	<div id="summary-inventory" class="summary-inventory summary-inventory-advanced">
    <?php
    //WoW_Characters::GetEquippedItemInfo(EQUIPMENT_SLOT_HEAD, true);
    
    $item_slots = array(
        EQUIPMENT_SLOT_HEAD      => array('slot' => 1,  'style' => ' left: 0px; top: 0px;'),
        EQUIPMENT_SLOT_NECK      => array('slot' => 2,  'style' => ' left: 0px; top: 58px;'),
        EQUIPMENT_SLOT_SHOULDERS => array('slot' => 3,  'style' => 'left: 0px; top: 116px;'),
        EQUIPMENT_SLOT_BACK      => array('slot' => 16, 'style' => ' left: 0px; top: 174px;'),
        EQUIPMENT_SLOT_CHEST     => array('slot' => 5,  'style' => ' left: 0px; top: 232px;'),
        EQUIPMENT_SLOT_BODY      => array('slot' => 4,  'style' => ' left: 0px; top: 290px;'),
        EQUIPMENT_SLOT_TABARD    => array('slot' => 19, 'style' => ' left: 0px; top: 348px;'),
        EQUIPMENT_SLOT_WRISTS    => array('slot' => 9,  'style' => ' left: 0px; top: 406px;'),
        EQUIPMENT_SLOT_HANDS     => array('slot' => 10, 'style' => ' top: 0px; right: 0px;'),
        EQUIPMENT_SLOT_WAIST     => array('slot' => 6,  'style' => ' top: 58px; right: 0px;'),
        EQUIPMENT_SLOT_LEGS      => array('slot' => 7,  'style' => ' top: 116px; right: 0px;'),
        EQUIPMENT_SLOT_FEET      => array('slot' => 8,  'style' => ' top: 174px; right: 0px;'),
        EQUIPMENT_SLOT_FINGER1   => array('slot' => 11, 'style' => ' top: 232px; right: 0px;'),
        EQUIPMENT_SLOT_FINGER2   => array('slot' => 11, 'style' => ' top: 290px; right: 0px;'),
        EQUIPMENT_SLOT_TRINKET1  => array('slot' => 12, 'style' => ' top: 348px; right: 0px;'),
        EQUIPMENT_SLOT_TRINKET2  => array('slot' => 12, 'style' => ' top: 406px; right: 0px;'),
        EQUIPMENT_SLOT_MAINHAND  => array('slot' => 21, 'style' => ' left: 241px; bottom: 0px;'),
        EQUIPMENT_SLOT_OFFHAND   => array('slot' => 22, 'style' => ' left: 306px; bottom: 0px;'),
        EQUIPMENT_SLOT_RANGED    => array('slot' => 28, 'style' => ' left: 371px; bottom: 0px;')
    );
    
    ?>
    <div data-id="0" data-type="1" class="slot slot-1 item-quality-3" style=" left: 0px; top: 0px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/58155" class="item" data-item="i=58155&amp;e=4207&amp;g0=1810&amp;g1=1779&amp;d=60"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_helm_robe_dungeonrobe_c_04.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Клобук приятной меланхолии</span>
							<span class="name color-q3">
								
								<a href="/wow/item/58155" data-item="i=58155&amp;e=4207&amp;g0=1810&amp;g1=1779&amp;d=60">Клобук приятной меланхолии</a>
							</span>
								<span class="enchant-shadow">
									+60 к интеллекту и 35 к рейтингу критического удара
								</span>
								<div class="enchant color-q2">
+60 к интеллекту и 35 к рейтингу критического удара								</div>
							<span class="level">346</span>
								<span class="sockets">
	<span class="icon-socket socket-1">
			<a href="/wow/item/52291" class="gem">
				<img src="http://eu.battle.net/wow-assets/static/images/icons/18/inv_misc_metagem_b.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
	<span class="icon-socket socket-8">
			<a href="/wow/item/52236" class="gem">
				<img src="http://eu.battle.net/wow-assets/static/images/icons/18/inv_misc_cutgemsuperior3.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
								</span>
						</div>
			</div>
		</div>
	</div>


	 	




	<div data-id="1" data-type="2" class="slot slot-2 item-quality-3" style=" left: 0px; top: 58px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/56288" class="item" data-item="i=56288&amp;s=1540433984"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_misc_necklacea1.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Подвеска из рыбы-иглы</span>
							<span class="name color-q3">
								
								<a href="/wow/item/56288" data-item="i=56288&amp;s=1540433984">Подвеска из рыбы-иглы</a>
							</span>
							<span class="level">346</span>
						</div>
			</div>
		</div>
	</div>


	 	




	<div data-id="2" data-type="3" class="slot slot-3 item-quality-3" style=" left: 0px; top: 116px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/56399" class="item" data-item="i=56399&amp;g0=1779&amp;s=672462032&amp;d=59"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_shoulder_robe_dungeonrobe_c_03.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Накидка мастера Чо</span>
							<span class="name color-q3">
								
								<a href="/wow/item/56399" data-item="i=56399&amp;g0=1779&amp;s=672462032&amp;d=59">Накидка мастера Чо</a><a href="javascript:;" class="audit-warning"></a>
							</span>
							<span class="level">346</span>
								<span class="sockets">
	<span class="icon-socket socket-8">
			<a href="/wow/item/52236" class="gem">
				<img src="http://eu.battle.net/wow-assets/static/images/icons/18/inv_misc_cutgemsuperior3.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
								</span>
						</div>
			</div>
		</div>
	</div>


	 	




	<div data-id="14" data-type="16" class="slot slot-16 item-quality-3" style=" left: 0px; top: 174px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/56267" class="item" data-item="i=56267&amp;e=4087&amp;s=1751315584"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_misc_cape_cataclysm_caster_b_01.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Литториновый плащ</span>
							<span class="name color-q3">
								
								<a href="/wow/item/56267" data-item="i=56267&amp;e=4087&amp;s=1751315584">Литториновый плащ</a>
							</span>
								<span class="enchant-shadow">
									критический удар I
								</span>
								<div class="enchant color-q2">
<a href="/wow/item/52764">критический удар I</a>								</div>
							<span class="level">346</span>
						</div>
			</div>
		</div>
	</div>


	 	




	<div data-id="4" data-type="5" class="slot slot-5 item-quality-3" style=" left: 0px; top: 232px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/58153" class="item" data-item="i=58153&amp;e=4063&amp;g0=1750&amp;g1=1779&amp;d=104"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_chest_robe_dungeonrobe_c_04.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Одеяния благовоний тьмы</span>
							<span class="name color-q3">
								
								<a href="/wow/item/58153" data-item="i=58153&amp;e=4063&amp;g0=1750&amp;g1=1779&amp;d=104">Одеяния благовоний тьмы</a>
							</span>
								<span class="enchant-shadow">
									все характеристики VIII
								</span>
								<div class="enchant color-q2">
<a href="/wow/item/52744">все характеристики VIII</a>								</div>
							<span class="level">346</span>
								<span class="sockets">
	<span class="icon-socket socket-2">
			<a href="/wow/item/52207" class="gem">
				<img src="http://eu.battle.net/wow-assets/static/images/icons/18/inv_misc_cutgemsuperior6.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
	<span class="icon-socket socket-8">
			<a href="/wow/item/52236" class="gem">
				<img src="http://eu.battle.net/wow-assets/static/images/icons/18/inv_misc_cutgemsuperior3.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
								</span>
						</div>
			</div>
		</div>
	</div>


	 	




	<div data-id="3" data-type="4" class="slot slot-4" style=" left: 0px; top: 290px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="javascript:;" class="empty"><span class="frame"></span></a>
			</div>
		</div>
	</div>


	 	




	<div data-id="18" data-type="19" class="slot slot-19 item-quality-1" style=" left: 0px; top: 348px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/65905" class="item" data-item="i=65905"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_misc_tabard_earthenring.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Гербовая накидка Служителей Земли</span>
							<span class="name color-q1">
								
								<a href="/wow/item/65905" data-item="i=65905">Гербовая накидка Служителей Земли</a>
							</span>
							<span class="level">85</span>
						</div>
			</div>
		</div>
	</div>


	 	




	<div data-id="8" data-type="9" class="slot slot-9 item-quality-3" style=" left: 0px; top: 406px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/56389" class="item" data-item="i=56389&amp;e=4071&amp;s=1404020224&amp;d=30"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_bracer_robe_dungeonrobe_c_03.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Нарукавье песчаного шелка</span>
							<span class="name color-q3">
								
								<a href="/wow/item/56389" data-item="i=56389&amp;e=4071&amp;s=1404020224&amp;d=30">Нарукавье песчаного шелка</a>
							</span>
								<span class="enchant-shadow">
									критический удар I
								</span>
								<div class="enchant color-q2">
<a href="/wow/item/52752">критический удар I</a>								</div>
							<span class="level">346</span>
						</div>
			</div>
		</div>
	</div>


	 
	




	<div data-id="9" data-type="10" class="slot slot-10 slot-align-right item-quality-3" style=" top: 0px; right: 0px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/58158" class="item" data-item="i=58158&amp;e=4068&amp;g0=1775&amp;d=35"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_gauntlets_robe_dungeonrobe_c_04.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Перчатки тихой полночи</span>
							<span class="name color-q3">
								
								<a href="/wow/item/58158" data-item="i=58158&amp;e=4068&amp;g0=1775&amp;d=35">Перчатки тихой полночи</a>
							</span>
								<span class="enchant-shadow">
									ускорение II
								</span>
								<div class="enchant color-q2">
<a href="/wow/item/52749">ускорение II</a>								</div>
							<span class="level">346</span>
								<span class="sockets">
	<span class="icon-socket socket-4">
			<a href="/wow/item/52232" class="gem">
				<img src="http://eu.battle.net/wow-assets/static/images/icons/18/inv_misc_cutgemsuperior.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
								</span>
						</div>
			</div>
		</div>
	</div>


	 
	




	<div data-id="5" data-type="6" class="slot slot-6 slot-align-right item-quality-4" style=" top: 58px; right: 0px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/54504" class="item" data-item="i=54504&amp;es=3729&amp;g0=1779&amp;g1=1750&amp;s=777109312&amp;d=40"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_belt_cloth_raidpriest_i_01.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Пояс глубин</span>
							<span class="name color-q4">
								
								<a href="/wow/item/54504" data-item="i=54504&amp;es=3729&amp;g0=1779&amp;g1=1750&amp;s=777109312&amp;d=40">Пояс глубин</a>
							</span>
							<span class="level">359</span>
								<span class="sockets">
	<span class="icon-socket socket-8">
			<a href="/wow/item/52236" class="gem">
				<img src="http://eu.battle.net/wow-assets/static/images/icons/18/inv_misc_cutgemsuperior3.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
	<span class="icon-socket socket-14">
			<a href="/wow/item/52207" class="gem">
				<img src="http://eu.battle.net/wow-assets/static/images/icons/18/inv_misc_cutgemsuperior6.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
								</span>
						</div>
			</div>
		</div>
	</div>


	 
	




	<div data-id="6" data-type="7" class="slot slot-7 slot-align-right item-quality-4" style=" top: 116px; right: 0px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/54505" class="item" data-item="i=54505&amp;e=4114&amp;g0=1750&amp;s=1457437952&amp;d=87"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_pant_cloth_raidpriest_i_01.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Брюки избавления от кошмаров</span>
							<span class="name color-q4">
								
								<a href="/wow/item/54505" data-item="i=54505&amp;e=4114&amp;g0=1750&amp;s=1457437952&amp;d=87">Брюки избавления от кошмаров</a>
							</span>
								<span class="enchant-shadow">
									Освященная чародейская нить
								</span>
								<div class="enchant color-q2">
<span class="tip" onmouseover="Tooltip.show(this, '#lsdklgns34-wow-10001');">Освященная чародейская нить</span>	<div id="lsdklgns34-wow-10001" style="display: none">
		<div class="item-tooltip">
 




		<span  class="icon-frame frame-56" style='background-image: url("http://eu.battle.net/wow-assets/static/images/icons/56/spell_nature_astralrecalgroup.jpg");'>
		</span>
			<h3>Освященная чародейская нить</h3>
			<span class="color-tooltip-yellow">Вышивка чародейской нитью на штанах, увеличивающая интеллект на 95 и дух на 55.



Вышиты могут быть только собственные штаны заклинателя; после вышивки предмет становится персональным.</span>
		</div>
	</div>
								</div>
							<span class="level">359</span>
								<span class="sockets">
	<span class="icon-socket socket-2">
			<a href="/wow/item/52207" class="gem">
				<img src="http://eu.battle.net/wow-assets/static/images/icons/18/inv_misc_cutgemsuperior6.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
								</span>
						</div>
			</div>
		</div>
	</div>


	 
	




	<div data-id="7" data-type="8" class="slot slot-8 slot-align-right item-quality-4" style=" top: 174px; right: 0px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/62450" class="item" data-item="i=62450&amp;e=4069&amp;g0=1775&amp;d=57"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_boots_cloth_raidwarlock_i_01.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Сандалии странника пустынь</span>
							<span class="name color-q4">
								
								<a href="/wow/item/62450" data-item="i=62450&amp;e=4069&amp;g0=1775&amp;d=57">Сандалии странника пустынь</a>
							</span>
								<span class="enchant-shadow">
									ускорение
								</span>
								<div class="enchant color-q2">
<a href="/wow/item/52750">ускорение</a>								</div>
							<span class="level">359</span>
								<span class="sockets">
	<span class="icon-socket socket-4">
			<a href="/wow/item/52232" class="gem">
				<img src="http://eu.battle.net/wow-assets/static/images/icons/18/inv_misc_cutgemsuperior.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
								</span>
						</div>
			</div>
		</div>
	</div>


	 
	




	<div data-id="10" data-type="11" class="slot slot-11 slot-align-right item-quality-4" style=" top: 232px; right: 0px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/58188" class="item" data-item="i=58188&amp;e=4080"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_misc_diamondring1.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Перстень тайных имен</span>
							<span class="name color-q4">
								
								<a href="/wow/item/58188" data-item="i=58188&amp;e=4080">Перстень тайных имен</a>
							</span>
								<span class="enchant-shadow">
									интеллект
								</span>
								<div class="enchant color-q2">
<span class="tip" onmouseover="Tooltip.show(this, '#lsdklgns34-wow-10002');">интеллект</span>	<div id="lsdklgns34-wow-10002" style="display: none">
		<div class="item-tooltip">
 




		<span  class="icon-frame frame-56" style='background-image: url("http://eu.battle.net/wow-assets/static/images/icons/56/trade_engraving.jpg");'>
		</span>
			<h3>Чары для кольца - интеллект</h3>
			<span class="color-tooltip-yellow">Наложение на ваше собственное кольцо чар, повышающих интеллект на 40. Любое зачарованное кольцо становится персональным. Чтобы чары продолжали действовать, ваш навык наложения чар должен быть не ниже 475.</span>
		</div>
	</div>
								</div>
							<span class="level">359</span>
						</div>
			</div>
		</div>
	</div>


	 
	




	<div data-id="11" data-type="11" class="slot slot-11 slot-align-right item-quality-3" style=" top: 290px; right: 0px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/56276" class="item" data-item="i=56276&amp;e=4080&amp;s=688176608"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_misc_stonering2.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Кольцо антии</span>
							<span class="name color-q3">
								
								<a href="/wow/item/56276" data-item="i=56276&amp;e=4080&amp;s=688176608">Кольцо антии</a>
							</span>
								<span class="enchant-shadow">
									интеллект
								</span>
								<div class="enchant color-q2">
<span class="tip" onmouseover="Tooltip.show(this, '#lsdklgns34-wow-10003');">интеллект</span>	<div id="lsdklgns34-wow-10003" style="display: none">
		<div class="item-tooltip">
 




		<span  class="icon-frame frame-56" style='background-image: url("http://eu.battle.net/wow-assets/static/images/icons/56/trade_engraving.jpg");'>
		</span>
			<h3>Чары для кольца - интеллект</h3>
			<span class="color-tooltip-yellow">Наложение на ваше собственное кольцо чар, повышающих интеллект на 40. Любое зачарованное кольцо становится персональным. Чтобы чары продолжали действовать, ваш навык наложения чар должен быть не ниже 475.</span>
		</div>
	</div>
								</div>
							<span class="level">346</span>
						</div>
			</div>
		</div>
	</div>


	 
	




	<div data-id="12" data-type="12" class="slot slot-12 slot-align-right item-quality-3" style=" top: 348px; right: 0px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/56400" class="item" data-item="i=56400&amp;s=1606991616"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/spell_nature_invisibilitytotem.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Песнь печали</span>
							<span class="name color-q3">
								
								<a href="/wow/item/56400" data-item="i=56400&amp;s=1606991616">Песнь печали</a>
							</span>
							<span class="level">346</span>
						</div>
			</div>
		</div>
	</div>


	 
	




	<div data-id="13" data-type="12" class="slot slot-12 slot-align-right item-quality-3" style=" top: 406px; right: 0px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/56407" class="item" data-item="i=56407&amp;s=520420800"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_misc_book_17.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Песенник Ануура</span>
							<span class="name color-q3">
								
								<a href="/wow/item/56407" data-item="i=56407&amp;s=520420800">Песенник Ануура</a>
							</span>
							<span class="level">346</span>
						</div>
			</div>
		</div>
	</div>


	 




	<div data-id="15" data-type="21" class="slot slot-21 slot-align-right item-quality-3" style=" left: -6px; bottom: 0px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/56271" class="item" data-item="i=56271&amp;e=4083&amp;s=1423551232&amp;d=83"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_stave_2h_cataclysm_c_02.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Посох из островерхой раковины</span>
							<span class="name color-q3">
								
								<a href="/wow/item/56271" data-item="i=56271&amp;e=4083&amp;s=1423551232&amp;d=83">Посох из островерхой раковины</a>
							</span>
								<span class="enchant-shadow">
									ураган
								</span>
								<div class="enchant color-q2">
<a href="/wow/item/52760">ураган</a>								</div>
							<span class="level">346</span>
						</div>
			</div>
		</div>
	</div>


	 




	<div data-id="16" data-type="22" class="slot slot-22" style=" left: 271px; bottom: 0px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="javascript:;" class="empty"><span class="frame"></span></a>
			</div>
		</div>
	</div>


	 




	<div data-id="17" data-type="15" class="slot slot-15 item-quality-3" style=" left: 548px; bottom: 0px;">
		<div class="slot-inner">
			<div class="slot-contents">
					<a href="/wow/item/65172" class="item" data-item="i=65172&amp;d=54"><img src="http://eu.battle.net/wow-assets/static/images/icons/56/inv_staff_02.jpg" alt="" /><span class="frame"></span></a>
						<div class="details">
							<span class="name-shadow">Мешалка повара</span>
							<span class="name color-q3">
								
								<a href="/wow/item/65172" data-item="i=65172&amp;d=54">Мешалка повара</a>
							</span>
							<span class="level">346</span>
						</div>
			</div>
		</div>
	</div>
	</div>

	<script type="text/javascript">
	//<![CDATA[
		$(document).ready(function() {
			new Summary.Inventory({ view: "advanced" }, {
			<?php
            if(isset($item_slots) && is_array($item_slots)) {
                foreach($item_slots as $slot => $style) {
                    $item_info = WoW_Characters::GetEquippedItemInfo($slot);
                    if(!$item_info) {
                        continue;
                    }
                    echo sprintf('
             %d: {
                    name: "%s",
                    quality: %d,
                    icon: "%s"
                },', $slot, $item_info['name'], $item_info['quality'], $item_info['icon']);
                }
            }
            ?>
			});
		});
	//]]>
	</script>

				</div>

		</div>

			<div class="summary-middle">
				<div class="summary-middle-inner">

					<div class="summary-middle-right">
						<div class="summary-audit" id="summary-audit">
							<div class="category-right"><span class="tip" id="summary-audit-whatisthis">Что это?</span></div>
								<h3 class="category ">Осмотр персонажа</h3>

							<div class="profile-box-simple">

	<ul class="summary-audit-list">
    <?php
    if(isset($audit[AUDIT_TYPE_EMPTY_GLYPH_SLOT]) && $audit[AUDIT_TYPE_EMPTY_GLYPH_SLOT] > 0) {
        echo sprintf('<li><span class="number">%d</span> пустые ячейки символов</li>', $audit[AUDIT_TYPE_EMPTY_GLYPH_SLOT]);
    }
    if(isset($audit[AUDIT_TYPE_UNSPENT_TALENT_POINTS]) && $audit[AUDIT_TYPE_UNSPENT_TALENT_POINTS] > 0) {
        echo sprintf('<li><span class="number">%d</span> неиспользованные очки талантов</li>', $audit[AUDIT_TYPE_UNSPENT_TALENT_POINTS]);
    }
    if(isset($audit[AUDIT_TYPE_UNENCHANTED_ITEM]) && is_array($audit[AUDIT_TYPE_UNENCHANTED_ITEM])) {
        $unench_slots = '';
        $unench_slots_js_tpl = '"unenchantedItems": {%s},';
        $unench_slots_js = '';
        $count_unech_items = count($audit[AUDIT_TYPE_UNENCHANTED_ITEM]);
        for($i = 0; $i < $count_unech_items; ++$i) {
            if($i) {
                $unench_slots .= ',';
                $unench_slots_js .= ",";
            }
            $unench_slots .= $audit[AUDIT_TYPE_UNENCHANTED_ITEM][$i][0];
            $unench_slots_js .= $audit[AUDIT_TYPE_UNENCHANTED_ITEM][$i][0] . " : 1";
        }
        $unenchanted_items_js = sprintf($unench_slots_js_tpl, $unench_slots_js);
        echo sprintf('<li data-slots="%s">
        <span class="tip"><span class="number">%d</span> незачарованный предмет</span>
        </li>', $unench_slots, $count_unech_items);
    }
    if(isset($audit[AUDIT_TYPE_EMPTY_SOCKET]) && is_array($audit[AUDIT_TYPE_EMPTY_SOCKET])) {
        $empty_sockets_slots = '';
        $empty_sockets_slots_js_tpl = '"itemsWithEmptySockets": {%s},';
        $empty_sockets_slots_js = '';
        $count_empty_sockets = 0;
        $i = 0;
        foreach($audit[AUDIT_TYPE_EMPTY_SOCKET] as $tmp) {
            if($i < count($audit[AUDIT_TYPE_EMPTY_SOCKET])-1) {
                $empty_sockets_slots .= ',';
                $empty_sockets_slots_js .= ',';
            }
            $count_empty_sockets += $tmp['count'];
            $empty_sockets_slots .= $tmp['slot'];
            $empty_sockets_slots_js .= $tmp['slot'] . ': ' . $tmp['count'];
            ++$i;
        }
        $empty_sockets_js = sprintf($empty_sockets_slots_js_tpl, $empty_sockets_slots_js);
        echo sprintf('<li data-slots="%s">
        <span class="number">%d</span> пустые гнезда в <span class="tip">предметах «%d»</span>
        </li>', $empty_sockets_slots, $count_empty_sockets, count($audit[AUDIT_TYPE_EMPTY_SOCKET]));
    }
    if(isset($audit[AUDIT_TYPE_NONOPTIMAL_ARMOR]) && is_array($audit[AUDIT_TYPE_NONOPTIMAL_ARMOR])) {
        $nonop_armor_slots = '';
        $nonop_armor_slots_js = '';
        $nonop_armor_slots_js_tpl = '"inappropriateArmorItems": {%s},';
        foreach($audit[AUDIT_TYPE_NONOPTIMAL_ARMOR] as $tmp) {
            
        }
        echo sprintf('<li data-slots="%d">
        <span class="tip"><span class="number">%d</span> предмет из неподходящего материала (не %s)</span>
        </li>');
    }
    ?>
	</ul>

	<script type="text/javascript">
	//<![CDATA[
		$(document).ready(function() {
			new Summary.Audit({
			 <?php
             echo $unenchanted_items_js;
             echo $empty_sockets_js;
             
             ?>
             
                 "foo": true
			});
		});
	//]]>
	</script>
							</div>
						</div>
						<div id="summary-reforging" class="summary-reforging">
								<h3 class="category ">Перековка</h3>

							<div class="profile-box-simple">

		Ни один предмет не был перекован.
							</div>
						</div>
					</div>
				
					<div class="summary-middle-left">
						<div class="summary-bonus-tally">
								<h3 class="category ">Бонус за чары / камень</h3>

							<div class="profile-box-simple">


		<div class="numerical">
			<ul>
					<li>
						<span class="value">+510</span> Интеллект
					</li>
					<li>
						<span class="value">+214</span> Рейтинг критического удара
					</li>
					<li>
						<span class="value">+190</span> Рейтинг скорости боя
					</li>
					<li>
						<span class="value">+190</span> Дух
					</li>
					<li>
						<span class="value">+20</span> Рейтинг искусности
					</li>
					<li>
						<span class="value">+15</span> Сила
					</li>
					<li>
						<span class="value">+15</span> Ловкость
					</li>
					<li>
						<span class="value">+15</span> Выносливость
					</li>
					<li>
						<span class="value">+10</span> Рейтинг меткости
					</li>
			</ul>
		</div>
	
		<div class="other">
				<span class="name"><a href="/wow/item/52760">ураган</a></span><span class="comma">,</span>
				<span class="name"><a href="/wow/item/52291">Хаотический мглистый алмаз</a></span>
		</div>
		
							</div>
						</div>

						<div class="summary-gems">
								<h3 class="category ">Камни</h3>

							<div class="profile-box-simple">


	<div class="summary-gems">
		<ul>
				<li>
					<span class="value">4</span>
					<span class="times">x</span>
					<span class="icon">	<span class="icon-socket socket-10">
			<a href="/wow/item/52236" class="gem">
				<img src="http://eu.battle.net/wow-assets/static/images/icons/18/inv_misc_cutgemsuperior3.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
</span>
					<a href="/wow/item/52236" class="name color-q3">Очищенное око демона</a>
	<span class="clear"><!-- --></span>
				</li>
				<li>
					<span class="value">3</span>
					<span class="times">x</span>
					<span class="icon">	<span class="icon-socket socket-2">
			<a href="/wow/item/52207" class="gem">
				<img src="http://eu.battle.net/wow-assets/static/images/icons/18/inv_misc_cutgemsuperior6.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
</span>
					<a href="/wow/item/52207" class="name color-q3">Сверкающий инфернальный рубин</a>
	<span class="clear"><!-- --></span>
				</li>
				<li>
					<span class="value">2</span>
					<span class="times">x</span>
					<span class="icon">	<span class="icon-socket socket-4">
			<a href="/wow/item/52232" class="gem">
				<img src="http://eu.battle.net/wow-assets/static/images/icons/18/inv_misc_cutgemsuperior.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
</span>
					<a href="/wow/item/52232" class="name color-q3">Мягкий янтарный самоцвет</a>
	<span class="clear"><!-- --></span>
				</li>
				<li>
					<span class="value">1</span>
					<span class="times">x</span>
					<span class="icon">	<span class="icon-socket socket-1">
			<a href="/wow/item/52291" class="gem">
				<img src="http://eu.battle.net/wow-assets/static/images/icons/18/inv_misc_metagem_b.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
</span>
					<a href="/wow/item/52291" class="name color-q3">Хаотический мглистый алмаз</a>
	<span class="clear"><!-- --></span>
				</li>
		</ul>
	</div>
							</div>
						</div>

	<span class="clear"><!-- --></span>
					</div>
	<span class="clear"><!-- --></span>
				</div>
			</div>

			<div class="summary-bottom">

				<div class="profile-recentactivity">
	<h3 class="category ">						Последние новости
</h3>
					<div class="profile-box-simple">
	<ul class="activity-feed">



	<li class="ach ">
	<dl>
		<dd>

		<a href="achievement#168:14922:a3011" rel="np" onmouseover="Tooltip.show(this, '#achv-tooltip-0');">
 




		<span  class="icon-frame frame-18" style='background-image: url("http://eu.battle.net/wow-assets/static/images/icons/18/inv_valentinescard02.jpg");'>
		</span>
		</a>

	Заработано достижение <a href="achievement#168:14922:a3011" rel="np" onmouseover="Tooltip.show(this, '#achv-tooltip-0');">Помиритесь и поцелуйтесь (25 игроков)</a> за 10 очков.

	<div id="achv-tooltip-0" style="display: none">
		<div class="item-tooltip">
 




		<span  class="icon-frame frame-56" style='background-image: url("http://eu.battle.net/wow-assets/static/images/icons/56/inv_valentinescard02.jpg");'>
		</span>

			<h3>Помиритесь и поцелуйтесь (25 игроков)</h3>
			<div class="color-tooltip-yellow">/Поцелуйте разозлившуюся на вас Сару в Ульдуаре в рейде на 25 игроков.</div>
		</div>
	</div>
</dd>
		<dt>7 ч назад</dt>
	</dl>
	</li>



	<li class="ach ">
	<dl>
		<dd>

		<a href="achievement#168:a4844" rel="np" onmouseover="Tooltip.show(this, '#achv-tooltip-1');">
 




		<span  class="icon-frame frame-18" style='background-image: url("http://eu.battle.net/wow-assets/static/images/icons/18/inv_helm_plate_twilighthammer_c_01.jpg");'>
		</span>
		</a>

	Заработано достижение <a href="achievement#168:a4844" rel="np" onmouseover="Tooltip.show(this, '#achv-tooltip-1');">Повелитель подземелий Cataclysm</a> за 20 очков.

	<div id="achv-tooltip-1" style="display: none">
		<div class="item-tooltip">
 




		<span  class="icon-frame frame-56" style='background-image: url("http://eu.battle.net/wow-assets/static/images/icons/56/inv_helm_plate_twilighthammer_c_01.jpg");'>
		</span>

			<h3>Повелитель подземелий Cataclysm</h3>
			<div class="color-tooltip-yellow">Добейтесь указанных ниже достижений в подземельях Cataclysm в героическом режиме.</div>
		</div>
	</div>
</dd>
		<dt>1 дн. назад</dt>
	</dl>
	</li>



	<li class="ach ">
	<dl>
		<dd>

		<a href="achievement#168:15067:a5060" rel="np" onmouseover="Tooltip.show(this, '#achv-tooltip-2');">
 




		<span  class="icon-frame frame-18" style='background-image: url("http://eu.battle.net/wow-assets/static/images/icons/18/achievement_dungeon_blackrockcaverns.jpg");'>
		</span>
		</a>

	Заработано достижение <a href="achievement#168:15067:a5060" rel="np" onmouseover="Tooltip.show(this, '#achv-tooltip-2');">Пещеры Черной горы (героич.)</a> за 10 очков.

	<div id="achv-tooltip-2" style="display: none">
		<div class="item-tooltip">
 




		<span  class="icon-frame frame-56" style='background-image: url("http://eu.battle.net/wow-assets/static/images/icons/56/achievement_dungeon_blackrockcaverns.jpg");'>
		</span>

			<h3>Пещеры Черной горы (героич.)</h3>
			<div class="color-tooltip-yellow">Убейте Повелителя Перерожденных Обсидия в героическом режиме.</div>
		</div>
	</div>
</dd>
		<dt>1 дн. назад</dt>
	</dl>
	</li>



	<li class="ach ">
	<dl>
		<dd>

		<a href="achievement#168:15067:a5283" rel="np" onmouseover="Tooltip.show(this, '#achv-tooltip-3');">
 




		<span  class="icon-frame frame-18" style='background-image: url("http://eu.battle.net/wow-assets/static/images/icons/18/achievement_dungeon_blackrockcaverns_karshsteelbender.jpg");'>
		</span>
		</a>

	Заработано достижение <a href="achievement#168:15067:a5283" rel="np" onmouseover="Tooltip.show(this, '#achv-tooltip-3');">Осторожно, горячо!</a> за 10 очков.

	<div id="achv-tooltip-3" style="display: none">
		<div class="item-tooltip">
 




		<span  class="icon-frame frame-56" style='background-image: url("http://eu.battle.net/wow-assets/static/images/icons/56/achievement_dungeon_blackrockcaverns_karshsteelbender.jpg");'>
		</span>

			<h3>Осторожно, горячо!</h3>
			<div class="color-tooltip-yellow">Убейте Карша Гнущего Сталь после того, как он 15 раз воспользуется эффектом перегретой обсидиановой брони в Пещерах Черной горы в героическом режиме.</div>
		</div>
	</div>
</dd>
		<dt>1 дн. назад</dt>
	</dl>
	</li>



	<li class="ach ">
	<dl>
		<dd>

		<a href="achievement#168:a5535" rel="np" onmouseover="Tooltip.show(this, '#achv-tooltip-4');">
 




		<span  class="icon-frame frame-18" style='background-image: url("http://eu.battle.net/wow-assets/static/images/icons/18/pvecurrency-valor.jpg");'>
		</span>
		</a>

	Заработано достижение <a href="achievement#168:a5535" rel="np" onmouseover="Tooltip.show(this, '#achv-tooltip-4');">1000 очков доблести</a> за 10 очков.

	<div id="achv-tooltip-4" style="display: none">
		<div class="item-tooltip">
 




		<span  class="icon-frame frame-56" style='background-image: url("http://eu.battle.net/wow-assets/static/images/icons/56/pvecurrency-valor.jpg");'>
		</span>

			<h3>1000 очков доблести</h3>
			<div class="color-tooltip-yellow">Заработайте 1000 очков доблести</div>
		</div>
	</div>
</dd>
		<dt>1 дн. назад</dt>
	</dl>
	</li>
	</ul>
	<a class="profile-linktomore" href="/wow/character/ревущии-фьорд/%d0%a2%d0%be%d0%bd%d0%ba%d1%81/feed" rel="np">Смотреть более ранние новости</a>

	<span class="clear"><!-- --></span>
					</div>

				</div>

				<div class="summary-bottom-left">

					<div class="summary-talents" id="summary-talents">
	<ul>

	<li class="summary-talents-1">
		<a href="/wow/character/ревущии-фьорд/%d0%a2%d0%be%d0%bd%d0%ba%d1%81/talent/secondary"><span class="inner">
			<span class="icon"><img src="http://eu.battle.net/wow-assets/static/images/icons/36/spell_holy_guardianspirit.jpg" alt="" /><span class="frame"></span></span>
				<span class="roles">
							<span class="icon-healer"></span>
				</span>
			<span class="name-build">
				<span class="name">Свет</span>
				<span class="build">4<ins>/</ins>34<ins>/</ins>3</span>
			</span>
		</span></a>
	</li>

	<li class="summary-talents-1">
		<a href="/wow/character/ревущии-фьорд/%d0%a2%d0%be%d0%bd%d0%ba%d1%81/talent/primary" class="active"><span class="inner">
				<span class="checkmark"></span>
			<span class="icon"><img src="http://eu.battle.net/wow-assets/static/images/icons/36/spell_shadow_shadowwordpain.jpg" alt="" /><span class="frame"></span></span>
				<span class="roles">
							<span class="icon-dps"></span>
				</span>
			<span class="name-build">
				<span class="name">Тьма</span>
				<span class="build">9<ins>/</ins>0<ins>/</ins>32</span>
			</span>
		</span></a>
	</li>
	</ul>
					</div>

					<div class="summary-health-resource">
	<ul>
		<li class="health" id="summary-health" data-id="health"><span class="name">Здоровье</span><span class="value">109791</span></li>
		<li class="resource-0" id="summary-power" data-id="power-0"><span class="name">Мана</span><span class="value">77340</span></li>
	</ul>
					</div>

					<div class="summary-stats-profs-bgs">


	<div class="summary-stats" id="summary-stats">
			<div id="summary-stats-advanced" class="summary-stats-advanced">
				<div class="summary-stats-advanced-base">
	<div class="summary-stats-column">
		<h4><?php echo WoW_Locale::GetString('template_profile_stats'); ?></h4>
		<ul>
        <?php
        $strength = WoW_Characters::GetCharacterStrength();
        $agility = WoW_Characters::GetCharacterAgility();
        $stamina = WoW_Characters::GetCharacterStamina();
        $intellect = WoW_Characters::GetCharacterIntellect();
        $spirit = WoW_Characters::GetCharacterSpirit();
        $melee_stats = WoW_Characters::GetMeleeStats();
        $ranged_stats = WoW_Characters::GetRangedStats();
        $spell = WoW_Characters::GetSpellStats();
        $defense = WoW_Characters::GetDefenseStats();
        $resistances = WoW_Characters::GetResistanceStats();
        switch(WoW_Characters::GetRole()) {
            case ROLE_CASTER:
                
                break;
            case ROLE_MELEE:
                echo sprintf('<li data-id="strength" class="">
		<span class="name">%s</span>
		<span class="value">%d</span>
	<span class="clear"><!-- --></span>
	</li>', WoW_Locale::GetString('stat_strength'), $strength['effective']);
                break;
        }
        ?>
	

	<li data-id="agility" class="">
		<span class="name"><?php echo WoW_Locale::GetString('stat_agility'); ?></span>
		<span class="value"><?php echo $agility['effective']; ?></span>
	<span class="clear"><!-- --></span>
	</li>
	<li data-id="stamina" class="">
		<span class="name"><?php echo WoW_Locale::GetString('stat_stamina'); ?></span>
		<span class="value color-q2"><?php echo $stamina['effective']; ?></span>
	<span class="clear"><!-- --></span>
	</li>
	<li data-id="intellect" class="">
		<span class="name"><?php echo WoW_Locale::GetString('stat_intellect'); ?></span>
		<span class="value color-q2"><?php echo $intellect['effective']; ?></span>
	<span class="clear"><!-- --></span>
	</li>
	<li data-id="spirit" class="">
		<span class="name"><?php echo WoW_Locale::GetString('stat_spirit'); ?></span>
		<span class="value color-q2"><?php echo $spirit['effective']; ?></span>
	<span class="clear"><!-- --></span>
	</li>
	<li data-id="mastery" class="">
		<span class="name"><?php echo WoW_Locale::GetString('stat_mastery'); ?></span>
		<span class="value">0,0</span>
	<span class="clear"><!-- --></span>
	</li>
		</ul>
	</div>
				</div>
				<div class="summary-stats-advanced-role">
	<div class="summary-stats-column">
		<h4>Другое</h4>
		<ul>

	 





	<li data-id="spellpower" class="">
		<span class="name">Сила заклинаний</span>
		<span class="value">5524</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="spellhaste" class="">
		<span class="name">Скорость</span>
		<span class="value">13,56%</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="spellhit" class="">
		<span class="name">Меткость</span>
		<span class="value">+13,08%</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="spellcrit" class="">
		<span class="name">Критический удар</span>
		<span class="value">12,73%</span>
	<span class="clear"><!-- --></span>
	</li>
		</ul>
	</div>
				</div>
				<div class="summary-stats-end"></div>
			</div>

		<div id="summary-stats-simple" class="summary-stats-simple" style=" display: none">
			<div class="summary-stats-simple-base">


	<div class="summary-stats-column">
		<h4>Характеристики</h4>
		<ul>

	 





	<li data-id="strength" class="">
		<span class="name">Сила</span>
		<span class="value color-q2">58</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="agility" class="">
		<span class="name">Ловкость</span>
		<span class="value color-q2">71</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="stamina" class="">
		<span class="name">Выносливость</span>
		<span class="value color-q2">4769</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="intellect" class="">
		<span class="name">Интеллект</span>
		<span class="value color-q2">3802</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="spirit" class="">
		<span class="name">Дух</span>
		<span class="value color-q2">498</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="mastery" class="">
		<span class="name">Искусность</span>
		<span class="value">13,52</span>
	<span class="clear"><!-- --></span>
	</li>
		</ul>
	</div>
			</div>
			<div class="summary-stats-simple-other">
				<a id="summary-stats-simple-arrow" class="summary-stats-simple-arrow" href="javascript:;"></a>


	<div class="summary-stats-column" style="display: none">
		<h4>Ближний бой</h4>
		<ul>

	 

	

	<li data-id="meleedamage" class="">
		<span class="name">Урон</span>
		<span class="value">358–531</span>
	<span class="clear"><!-- --></span>
	</li>

	 

	

	<li data-id="meleedps" class="">
		<span class="name">УВС</span>
		<span class="value">240,4</span>
	<span class="clear"><!-- --></span>
	</li>

	 




	<li data-id="meleeattackpower" class="">
		<span class="name">Сила атаки</span>
		<span class="value">96</span>
	<span class="clear"><!-- --></span>
	</li>

	 

	

	<li data-id="meleespeed" class="">
		<span class="name">Скорость атаки</span>
		<span class="value">1,85</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="meleehaste" class="">
		<span class="name">Скорость </span>
		<span class="value">13,56%</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="meleehit" class="">
		<span class="name">Меткость</span>
		<span class="value">+8,64%</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="meleecrit" class="">
		<span class="name">Критический удар</span>
		<span class="value">9,16%</span>
	<span class="clear"><!-- --></span>
	</li>

	 

	

	<li data-id="expertise" class="">
		<span class="name">Мастерство</span>
		<span class="value">0</span>
	<span class="clear"><!-- --></span>
	</li>
		</ul>
	</div>


	<div class="summary-stats-column" style="display: none">
		<h4>Дальний бой</h4>
		<ul>

	 

	

	<li data-id="rangeddamage" class="">
		<span class="name">Урон</span>
		<span class="value">879–1633</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="rangeddps" class="">
		<span class="name">УВС</span>
		<span class="value">1018,8</span>
	<span class="clear"><!-- --></span>
	</li>

	 




	<li data-id="rangedattackpower" class="">
		<span class="name">Сила атаки</span>
		<span class="value">0</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="rangedspeed" class="">
		<span class="name">Скорость</span>
		<span class="value">1,23</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="rangedhaste" class="">
		<span class="name">Скорость</span>
		<span class="value">13,56%</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="rangedhit" class="">
		<span class="name">Меткость</span>
		<span class="value">+8,64%</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="rangedcrit" class="">
		<span class="name">Критический удар</span>
		<span class="value">9,16%</span>
	<span class="clear"><!-- --></span>
	</li>
		</ul>
	</div>


	<div class="summary-stats-column">
		<h4>Заклинания</h4>
		<ul>

	 





	<li data-id="spellpower" class="">
		<span class="name">Сила заклинаний</span>
		<span class="value">5524</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="spellhaste" class="">
		<span class="name">Скорость</span>
		<span class="value">13,56%</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="spellhit" class="">
		<span class="name">Меткость</span>
		<span class="value">+13,08%</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="spellcrit" class="">
		<span class="name">Критический удар</span>
		<span class="value">12,73%</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="spellpenetration" class="">
		<span class="name">Проникающая способность </span>
		<span class="value">0</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="manaregen" class="">
		<span class="name">Восполнение маны</span>
		<span class="value">1543</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="combatregen" class="">
		<span class="name">Восполнение в бою</span>
		<span class="value">1028</span>
	<span class="clear"><!-- --></span>
	</li>
		</ul>
	</div>


	<div class="summary-stats-column" style="display: none">
		<h4>Защита</h4>
		<ul>

	 





	<li data-id="armor" class="">
		<span class="name">Броня</span>
		<span class="value">7442</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="dodge" class="">
		<span class="name">Уклонение</span>
		<span class="value">3,42%</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="parry" class="">
		<span class="name">Парирование</span>
		<span class="value">0,00%</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="block" class="">
		<span class="name">Блокирование</span>
		<span class="value">0,00%</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="resilience" class="">
		<span class="name">Устойчивость</span>
		<span class="value">0</span>
	<span class="clear"><!-- --></span>
	</li>
		</ul>
	</div>


	<div class="summary-stats-column" style="display: none">
		<h4>Сопротивление</h4>
		<ul>

	 





	<li data-id="arcaneres" class=" has-icon">
			<span class="icon"> 




		<span class="icon-frame frame-12">
			<img src="http://eu.battle.net/wow-assets/static/images/icons/18/resist_arcane.jpg" alt="" width="12" height="12" />
		</span>
</span>
		<span class="name">Тайная магия</span>
		<span class="value">85</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="fireres" class=" has-icon">
			<span class="icon"> 




		<span class="icon-frame frame-12">
			<img src="http://eu.battle.net/wow-assets/static/images/icons/18/resist_fire.jpg" alt="" width="12" height="12" />
		</span>
</span>
		<span class="name">Магия огня</span>
		<span class="value">0</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="frostres" class=" has-icon">
			<span class="icon"> 




		<span class="icon-frame frame-12">
			<img src="http://eu.battle.net/wow-assets/static/images/icons/18/resist_frost.jpg" alt="" width="12" height="12" />
		</span>
</span>
		<span class="name">Магия льда</span>
		<span class="value">0</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="natureres" class=" has-icon">
			<span class="icon"> 




		<span class="icon-frame frame-12">
			<img src="http://eu.battle.net/wow-assets/static/images/icons/18/resist_nature.jpg" alt="" width="12" height="12" />
		</span>
</span>
		<span class="name">Силы природы</span>
		<span class="value">0</span>
	<span class="clear"><!-- --></span>
	</li>

	 





	<li data-id="shadowres" class=" has-icon">
			<span class="icon"> 




		<span class="icon-frame frame-12">
			<img src="http://eu.battle.net/wow-assets/static/images/icons/18/resist_shadow.jpg" alt="" width="12" height="12" />
		</span>
</span>
		<span class="name">Темная магия</span>
		<span class="value">0</span>
	<span class="clear"><!-- --></span>
	</li>
		</ul>
	</div>
			</div>
			<div class="summary-stats-end"></div>
		</div>

			<a href="javascript:;" id="summary-stats-toggler" class="summary-stats-toggler"><span class="inner"><span class="arrow">Показать все характеристики</span></span></a>
	</div>
 
	<?php
    WoW_Template::LoadTemplate('block_profile_stats_js');
    ?>


						<div class="summary-stats-bottom">

							<div class="summary-battlegrounds">
	<ul>
		<li class="rating"><span class="name">Рейтинг на полях боя</span><span class="value">0</span>	<span class="clear"><!-- --></span>
</li>
		<li class="kills"><span class="name">Почетные победы</span><span class="value">11852</span>	<span class="clear"><!-- --></span>
</li>
	</ul>
							</div>

							<div class="summary-professions">
	<ul>
				<li>
	    
	
    
	<div class="profile-progress border-3 completed" >
		<div class="bar border-3" style="width: 100%"></div>
			<div class="bar-contents">						<span class="profession-details">
							<span class="icon"> 




		<span class="icon-frame frame-12">
			<img src="http://eu.battle.net/wow-assets/static/images/icons/18/trade_tailoring.jpg" alt="" width="12" height="12" />
		</span>
</span>
							<span class="name">Портняжное дело</span>
							<span class="value">525</span>
						</span>

	<a href="javascript:;" data-fansite="skill|197|Портняжное дело" class="fansite-link fansite-small"> </a>
</div>
	</div>
				</li>
				<li>
	    
	
    
	<div class="profile-progress border-3" >
		<div class="bar border-3" style="width: 97%"></div>
			<div class="bar-contents">						<span class="profession-details">
							<span class="icon"> 




		<span class="icon-frame frame-12">
			<img src="http://eu.battle.net/wow-assets/static/images/icons/18/trade_engraving.jpg" alt="" width="12" height="12" />
		</span>
</span>
							<span class="name">Наложение чар</span>
							<span class="value">510</span>
						</span>

	<a href="javascript:;" data-fansite="skill|333|Наложение чар" class="fansite-link fansite-small"> </a>
</div>
	</div>
				</li>
	</ul>
							</div>

	<span class="clear"><!-- --></span>
						</div>
					</div>
				</div>
	<span class="clear"><!-- --></span>
	<span class="clear"><!-- --></span>
			</div>
		</div>

	<span class="clear"><!-- --></span>
	</div>

	<script type="text/javascript" src="/wow/static/js/locales/summary_<?php echo WoW_Locale::GetLocale(); ?>.js"></script>

</div>
</div>
</div>
