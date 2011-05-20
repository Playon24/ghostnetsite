<div id="layout-middle">
<div class="wrapper">
<div id="content">
<div id="account-progress">
<span>Состояние 66%</span> [Шаг 2 из 3]
<div id="progress-bar" class="border-3">
<div id="current-progress" class="border-3" style="width: 66%"></div>
</div>
</div>
<div id="page-header">
<span class="float-right"><span class="form-req">*</span> Необходимо указать</span>
<h2 class="subcategory">Управление игрой</h2>
<h3 class="headline">Присоединение других записей</h3>
</div>
<div id="page-content">
<p class="caption">Прежде всего, подтвердите, пожалуйста, что другая учетная запись (или записи) World of Warcraft, которые вы хотите объединить со своей записью Battle.net, также принадлежат лично вам.</p>
<p>Учетная запись Battle.net и объединенные с нею записи World of Warcraft строго индивидуальны и не могут быть переданы другому лицу. В дальнейшем на Battle.net появятся новые функции общения, и чтобы пользоваться ими в полном объеме, нужно будет, чтобы все ваши игры были закреплены за вашим единым виртуальным «я». Поэтому важно, чтобы все записи World of Warcraft, объединенные с этой записью Battle.net, принадлежали лично вам и никому другому. Ваши друзья и близкие могут <a href="<?php echo WoW::GetWoWPath(); ?>/account/creation/tos.html">создать себе собственную запись Battle.net</a> и затем объединить с нею свою запись World of Warcraft.</p>
<div class="conversion-multi">
<p class="large-caption">Являетесь ли вы единственным пользователем этой записи?</p>
</div>
<form method="post" action="<?php echo WoW::GetWoWPath(); ?>/account/management/wow-account-conversion.html" id="convert-submit">
<input type="hidden" name="csrftoken" value="05276b85-cfa1-417e-a284-87fd5cee0502" />
<div class="input-hidden">
<input type="hidden" id="convert-target-page" name="targetpage" value="3" />
</div>
<fieldset
class="ui-controls section-buttons"
>
<button
class="ui-button button1 "
type="submit"
tabindex="1">
<span>
<span>Да: перейти к следующему шагу</span>
</span>
</button>
<a class="ui-cancel "
href="#"
onclick="$('#convert-target-page').val('cancel'); $(this).parents('form:first').submit(); return false;"
tabindex="1">
<span>
Нет: отменить объединение </span>
</a>
</fieldset>
</form>
</div>
</div>
</div>
</div>