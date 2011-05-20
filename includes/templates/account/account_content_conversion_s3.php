<div id="layout-middle">
<div class="wrapper">
<div id="content">
<div id="account-progress">
<span>Состояние 100%</span> [Шаг 3 из 3]
<div id="progress-bar" class="border-3">
<div id="current-progress" class="border-3" style="width: 100%"></div>
</div>
</div>
<div id="page-header">
<span class="float-right"><span class="form-req">*</span> Необходимо указать</span>
<h2 class="subcategory">Управление игрой</h2>
<h3 class="headline">Подтверждение объединения</h3>
</div>
<div id="page-content">
<p>
Когда вы щелкнете по кнопке «Завершить объединение»,
прежнее название вашей учетной записи станет недействительно.
</p>
<div class="conversion-content">
<div class="stats">
<span class="old-account-notice"><del class="caption">GETMANGOS</del></span>
<div class="conversion-msg">
<div class="merge-arrow"></div>
<span class="caption">Для авторизации в World of Warcraft нужно будет использовать новое название:</span>
</div>
<p class="new-account border-5">
<span class="headline"><?php echo WoW_Account::GetEmail(); ?></span>
</p>
</div>
<p>Прежде чем завершать объединение, обратите, пожалуйста, особое внимание на следующее:</p>
<div class="conversion-details">
<ul>
<li><span>После объединения записей для входа в World of Warcraft® нужно будет вводить название (<strong style="padding:0 3px;"><?php echo WoW_Account::GetEmail(); ?></strong>) и пароль учетной записи Battle.net.</span></li>
<li><span><strong>Объединение записей необратимо.</strong> «Разъединить» объединенные записи нельзя.</span></li>
<li><span>Из соображений безопасности перенос персонажей на другую учетную запись Battle.net будет закрыт в течение <strong>30 дней</strong> после объединения записей. Подробнее об этом читайте <a href="http://eu.blizzard.com/support/article.xml?locale=ru_RU&amp;articleId=36234" onclick="window.open(this.href);return false;">здесь</a>.</span></li>
</ul>
</div>
<form method="post" action="<?php echo WoW::GetWoWPath(); ?>/account/management/wow-account-conversion.html" id="convert-submit">
<input type="hidden" name="csrftoken" value="3ea60088-b2d5-4734-9577-efd4b518a963" />
<div class="input-hidden">
<input type="hidden" id="convert-target-page" name="targetpage" value="finish" />
</div>
<fieldset
class="ui-controls section-buttons"
>
<button
class="ui-button button1 "
type="submit"
tabindex="1">
<span>
<span>Завершить объединение</span>
</span>
</button>
<a class="ui-cancel "
href="#"
onclick="$('#convert-target-page').val('cancel'); $(this).parents('form:first').submit(); return false;"
tabindex="1">
<span>
Отмена </span>
</a>
</fieldset>
</form>
</div>
</div>
<!--[if lt IE 7]> <script type="text/javascript" src="<?php echo WoW::GetWoWPath(); ?>/account/local-common/js/third-party/DD_belatedPNG.js"></script>
<script type="text/javascript">
//<![CDATA[
DD_belatedPNG.fix('.merge-arrow');
DD_belatedPNG.fix('.conversion-details li');
//]]>
</script>
<![endif]-->
</div>
</div>
</div>