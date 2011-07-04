<?php
include('../includes/WoW_Loader.php');
$all_features = array(
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
$i = 1;
foreach($all_features as $classKey => $features) {
	$class_id = WoW_Utils::GetClassIDByKey($classKey);
	if (!$class_id) continue;
	foreach($features as $feature) {
		echo "UPDATE wow_class_abilities SET icon = '" . $feature . "' WHERE id = " . $i . " AND class=" . $class_id. " LIMIT 1;\n";
		++$i;
	}
}