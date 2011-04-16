<?php
include('../includes/WoW_Loader.php');
WoW_Characters::LoadCharacter('Викодинка', 1);
WoW_Reputation::InitReputation(2);
echo '<pre>';
print_r(WoW_Reputation::$factions);
//$chain = WoW_Achievements::GenerateAchievementChain(12, 92);
//print_r($chain);
/*if(WoW_Utils::AnalyzeLocales('ru', 'en')) {
    echo 'Done.';
}
else {
    echo 'errors.';
}*/
?>