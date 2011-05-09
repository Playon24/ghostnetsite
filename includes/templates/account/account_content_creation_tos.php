<div id="layout-middle">
<div class="wrapper">
<div id="content">
<div id="page-header">
<p class="privacy-message"><?php echo WoW_Locale::GetString('template_account_creation_privacy_notify'); ?></p>
</div>
<form action="/account/creation/tos.html" method="get" class="country-select">
<div class="input-row input-row-select">
<span class="input-left">
<label for="country">
<span class="label-text">
<?php echo WoW_Locale::GetString('template_account_creation_select_country'); ?>
</span>
<span class="input-required"></span>
</label>
</span>
<span class="input-right">
<span class="input-select input-select-small">
<select name="country" id="country" class="small border-5 glow-shadow-2" tabindex="1">
<optgroup>
<option value="GBR"<?php echo WoWConfig::$DefaultLocaleID == LOCALE_EN ? ' selected="selected"' : null; ?>><?php echo WoW_Locale::GetString('template_country_usa'); ?></option>
<option value="FRA"<?php echo WoWConfig::$DefaultLocaleID == LOCALE_FR ? ' selected="selected"' : null; ?>><?php echo WoW_Locale::GetString('template_country_fr'); ?></option>
<option value="DEU"<?php echo WoWConfig::$DefaultLocaleID == LOCALE_DE ? ' selected="selected"' : null; ?>><?php echo WoW_Locale::GetString('template_country_de'); ?></option>
<option value="ESP"<?php echo WoWConfig::$DefaultLocaleID == LOCALE_ES ? ' selected="selected"' : null; ?>><?php echo WoW_Locale::GetString('template_country_es'); ?></option>
<option value="RUS"<?php echo WoWConfig::$DefaultLocaleID == LOCALE_RU ? ' selected="selected"' : null; ?>><?php echo WoW_Locale::GetString('template_country_ru'); ?></option>
</optgroup>
</select>
<span class="inline-message" id="country-message"> </span>
</span>
<button
class="ui-button button1 "
type="submit"
id="country-submit"
tabindex="1">
<span>
<span><?php echo WoW_Locale::GetString('template_account_creation_change_country'); ?></span>
</span>
</button>
</span>
</div>
<div class="input-row input-row-note" id="country-warning" style="display: none">
<div class="input-note border-5 glow-shadow">
<div class="input-note-content">
<p class="caption"><?php echo WoW_Locale::GetString('template_account_creation_change_country_confirm'); ?></p>
<p>
<a
class="ui-button button1 "
href="/account/creation/tos.html"
tabindex="1">
<span>
<span><?php echo WoW_Locale::GetString('template_account_creation_change_country_confirm_yes'); ?></span>
</span>
</a>
<a class="ui-cancel "
href="/account/creation/tos.html"
tabindex="1">
<span>
<?php echo WoW_Locale::GetString('template_wow_dashboard_upgrade_account_cancel'); ?> </span>
</a>
</p>
</div>
<div class="input-note-arrow"></div>
</div>
</div>
</form>
<script type="text/javascript">
//<![CDATA[
(function() {
var countrySubmit = document.getElementById('country-submit');
countrySubmit.style.display = 'none';
})();
//]]>
</script>
<div id="page-content">
<form action="/account/creation/tos.html" method="post" id="creation">
<div class="input-hidden">
<input type="hidden" name="csrftoken" value="e6612910-483b-48e5-8f12-c8b370277606" />
<input name="country" value="
<?php
switch(WoWConfig::$DefaultLocaleID) {
    default:
    case LOCALE_EN:
        echo 'GBR'; // Great Britain, but I'm using this as USA
        break;
    case LOCALE_DE:
        echo 'DEU';
        break;
    case LOCALE_FR:
        echo 'FRA';
        break;
    case LOCALE_ES:
        echo 'ESP';
        break;
    case LOCALE_RU:
        echo 'RUS';
        break;
}
 ?>" />
</div>
<script type="text/javascript">
//<![CDATA[
var FormMsg = {
emailMessage1: '<?php echo WoW_Locale::GetString('template_account_creation_js_emailMessage1'); ?>',
emailError1: '<span class="inline-error"><?php echo WoW_Locale::GetString('template_account_creation_js_emailError1'); ?>.</span>',
emailError2: '<span class="inline-error"><?php echo WoW_Locale::GetString('template_account_creation_js_emailError2'); ?></span>',
passwordError1: '<span class="inline-error"><?php echo WoW_Locale::GetString('template_account_creation_js_passwordError1'); ?></span>',
passwordError2: '<span class="inline-error"><?php echo WoW_Locale::GetString('template_account_creation_js_passwordError2'); ?></span>',
passwordStrength0: '<?php echo WoW_Locale::GetString('template_account_creation_js_passwordStrength0'); ?>',
passwordStrength1: '<?php echo WoW_Locale::GetString('template_account_creation_js_passwordStrength1'); ?>',
passwordStrength2: '<?php echo WoW_Locale::GetString('template_account_creation_js_passwordStrength2'); ?>',
passwordStrength3: '<?php echo WoW_Locale::GetString('template_account_creation_js_passwordStrength3'); ?>'
};
//]]>
</script>
<div class="form-blockable" id="country-change">
<div class="input-row input-row-select">
<span class="input-left">
<label for="dobDay">
<span class="label-text">
<?php echo WoW_Locale::GetString('template_account_creation_birthday'); ?>
</span>
<span class="input-required">*</span>
</label>
</span>
<span class="input-right">
<span class="input-select input-select-extra-extra-extra-small">
<select name="dobDay" id="dobDay" class="extra-extra-extra-small border-5 glow-shadow-2" tabindex="1" required="required">
<option value="" selected="selected"><?php echo WoW_Locale::GetString('template_account_creation_birthday_day'); ?></option>
<?php
for($i = 1; $i < 32; ++$i) {
    echo sprintf("<option value=\"%d\">%d</option>\n", $i, $i);
}
?>
</select>
<span class="inline-message" id="dobDay-message"> </span>
</span>
<span class="input-select input-select-extra-extra-small">
<select name="dobMonth" id="dobMonth" class="extra-extra-small border-5 glow-shadow-2" tabindex="1" required="required">
<option value="" selected="selected"><?php echo WoW_Locale::GetString('template_account_creation_birthday_month'); ?></option>
<?php
for($i = 1; $i < 13; $i++) {
    echo sprintf('<option value="%d">%s</option>', $i, WoW_Locale::GetString('template_month_' . $i));
}
?>
</select>
<span class="inline-message" id="dobMonth-message"> </span>
</span>
<span class="input-select input-select-extra-extra-extra-small">
<select name="dobYear" id="dobYear" class="extra-extra-extra-small border-5 glow-shadow-2" tabindex="1" required="required">
<option value="" selected="selected"><?php echo WoW_Locale::GetString('template_account_creation_birthday_year'); ?></option>
<?php
for($i = date('Y'); $i >= 1900; --$i) {
    echo sprintf("<option value=\"%d\">%d</option>\n", $i, $i);
}
?>
</select>
<span class="inline-message" id="dobYear-message"> </span>
</span>
<span class="inline-note">
<span class="caption"><?php echo WoW_Locale::GetString('template_account_creation_child_notify'); ?></span>
</span>
</span>
</div>
<div class="input-row input-row-select">
<span class="input-left">
<label for="gender">
<span class="label-text">
<?php echo WoW_Locale::GetString('template_account_creation_treatment'); ?>
</span>
<span class="input-required">*</span>
</label>
</span>
<span class="input-right">
<span class="input-select input-select-small">
<select name="gender" id="gender" class="small border-5 glow-shadow-2" tabindex="1" required="required">
<option value="1" selected="selected"><?php echo WoW_Locale::GetString('template_account_creation_treatment_1'); ?></option>
<option value=" 2"><?php echo WoW_Locale::GetString('template_account_creation_treatment_2'); ?></option>
</select>
<span class="inline-message" id="gender-message"> </span>
</span>
</span>
</div>
<div class="input-row input-row-text">
<span class="input-left">
<label for="firstname">
<span class="label-text">
<?php echo WoW_Locale::GetString('template_account_creation_first_name'); ?>:
</span>
<span class="input-required">*</span>
</label>
</span>
<span class="input-right">
<span class="input-text input-text-small">
<input type="text" name="firstname" value="" id="firstname" class="small border-5 glow-shadow-2" autocomplete="off" maxlength="32" tabindex="1" required="required" placeholder="<?php echo WoW_Locale::GetString('template_account_creation_first_name'); ?>" />
<span class="inline-message" id="firstname-message"> </span>
</span>
<span class="input-text input-text-small">
<input type="text" name="lastname" value="" id="lastname" class="small border-5 glow-shadow-2" autocomplete="off" maxlength="32" tabindex="1" required="required" placeholder="<?php echo WoW_Locale::GetString('template_account_creation_last_name'); ?>" />
<span class="inline-message" id="lastname-message"> </span>
</span>
</span>
</div>
<div class="input-row input-row-text">
<span class="input-left">
<label for="emailAddress">
<span class="label-text">
<?php echo WoW_Locale::GetString('template_account_creation_email'); ?>
</span>
<span class="input-required">*</span>
</label>
</span>
<span class="input-right">
<span class="input-text input-text-small">
<input type="email" name="emailAddress" value="" id="emailAddress" class="small border-5 glow-shadow-2" autocomplete="off" onpaste="return false;" maxlength="320" tabindex="1" required="required" placeholder="<?php echo WoW_Locale::GetString('template_account_creation_set_email'); ?>" />
<span class="inline-message" id="emailAddress-message"> </span>
</span>
<span class="input-text input-text-small">
<input type="email" name="emailAddressConfirmation" value="" id="emailAddressConfirmation" class="small border-5 glow-shadow-2" autocomplete="off" onpaste="return false;" maxlength="320" tabindex="1" required="required" placeholder="<?php echo WoW_Locale::GetString('template_account_creation_confirm_email'); ?>" />
<span class="inline-message" id="emailAddressConfirmation-message"> </span>
</span>
</span>
</div>
<div class="input-row input-row-text">
<span class="input-left">
<label for="password">
<span class="label-text">
<?php echo WoW_Locale::GetString('template_account_creation_password'); ?>
</span>
<span class="input-required">*</span>
</label>
</span>
<span class="input-right">
<span class="input-text input-text-small">
<input type="password" id="password" name="password" value="" class="small border-5 glow-shadow-2" autocomplete="off" onpaste="return false;" maxlength="16" tabindex="1" required="required" placeholder="<?php echo WoW_Locale::GetString('template_account_creation_set_password'); ?>" />
<span class="inline-message" id="password-message"> </span>
</span>
<span class="input-text input-text-small">
<input type="password" id="rePassword" name="rePassword" value="" class="small border-5 glow-shadow-2" autocomplete="off" onpaste="return false;" maxlength="16" tabindex="1" required="required" placeholder="<?php echo WoW_Locale::GetString('template_account_creation_confirm_password'); ?>" />
<span class="inline-message" id="rePassword-message"> </span>
</span>
</span>
</div>
<div class="input-row input-row-note" id="password-strength" style="display: none">
<div class="input-note border-5 glow-shadow">
<div class="input-note-left">
<p class="caption"><?php echo WoW_Locale::GetString('template_account_creation_password_hint'); ?></p>
</div>
<div class="input-note-right border-5">
<div class="password-strength">
<span class="password-result">
<?php echo WoW_Locale::GetString('template_account_creation_security_level'); ?>
<strong id="password-result"></strong>
</span>
<span class="password-rating"><span class="rating rating-default" id="password-rating"></span></span>
</div>
<ul class="password-level" id="password-level">
<?php
for($i = 0; $i < 5; ++$i) {
    echo sprintf('<li id="password-level-%d">
<span class="icon-16"></span>
<span class="icon-16-label">%s</span>
</li>', $i, WoW_Locale::GetString('template_account_creation_security_' . $i));
}
?>
</ul>
</div>
<div class="clear"></div>
<div class="input-note-arrow"></div>
</div>
</div>
<div class="input-row input-row-select">
<span class="input-left">
<label for="question1">
<span class="label-text">
<?php echo WoW_Locale::GetString('template_account_creation_secret_question'); ?>
</span>
<span class="input-required">*</span>
</label>
</span>
<span class="input-right">
<span class="input-select input-select-small">
<select name="question1" id="question1" class="small border-5 glow-shadow-2" tabindex="1" required="required">
<option value="" selected="selected"><?php echo WoW_Locale::GetString('template_account_creation_secret_question_chose'); ?></option>
<?php
for($i = 1; $i < 11; $i++) {
    echo sprintf('<option value="%d">%s</option>', $i, WoW_Locale::GetString('template_account_creation_secret_question_' . $i));
}
?>
</select>
<span class="inline-message" id="question1-message"> </span>
</span>
<span class="input-text input-text-small">
<input type="text" name="answer1" value="" id="answer1" class="small border-5 glow-shadow-2" autocomplete="off" maxlength="100" tabindex="1" required="required" placeholder="<?php echo WoW_Locale::GetString('template_account_creation_secret_answer'); ?>" />
<span class="inline-message" id="answer1-message"> </span>
</span>
</span>
</div>
<div class="input-row input-row-note question-info" id="question-info" style="display: none;">
<span class="inline-message"><?php echo WoW_Locale::GetString('template_account_creation_secret_question_hint'); ?></span>
</div>
<div class="input-row input-row-checkbox input-row-important">
<span class="input-left">
<span class="title-text">
</span>
<span class="input-required"></span>
</span>
<span class="input-right">
<label for="agreedToToU">
<input type="checkbox" name="agreedToToU" value="true" id="agreedToToU" tabindex="1" required="required" />
<span class="label-text">
<?php echo WoW_Locale::GetString('template_account_creation_tos_agreement_text'); ?>
<span class="input-required">*</span>
</span>
</label>
</span>
<span class="input-left">
<span class="title-text">
</span>
<span class="input-required"></span>
</span>
<span class="input-right">
<label for="agreedToChatPolicy">
<input type="checkbox" name="agreedToChatPolicy" value="true" id="agreedToChatPolicy" tabindex="1" required="required" />
<span class="label-text">
<?php echo WoW_Locale::GetString('template_account_creation_pm_monitoring_agreement_text'); ?>
<span class="input-required">*</span>
</span>
</label>
</span>
</div>
<div class="input-row input-row-checkbox input-row-disclaimer">
<span class="input-left">
<span class="title-text">
</span>
<span class="input-required"></span>
</span>
</div>
<div class="submit-row">
<div class="input-left"></div>
<div class="input-right">
<button
class="ui-button button1 "
type="submit"
id="creation-submit"
tabindex="1">
<span>
<span><?php echo WoW_Locale::GetString('template_account_creation_create'); ?></span>
</span>
</button>
<a class="ui-cancel "
href="http://eu.battle.net/"
tabindex="1">
<span>
<?php echo WoW_Locale::GetString('template_wow_dashboard_upgrade_account_cancel'); ?> </span>
</a>
</div>
</div>
<script type="text/javascript">
//<![CDATA[
(function() {
var creationSubmit = document.getElementById('creation-submit');
creationSubmit.disabled = 'disabled';
creationSubmit.className = creationSubmit.className + ' disabled';
})();
//]]>
</script>
<div class="form-block" id="country-change-overlay" style="display: none"></div>
</div>
</form>
</div>
<script type="text/javascript">
//<![CDATA[
$(function() {
var inputs = new Inputs('#creation');
var creation = new Creation('#creation');
Core.loadDeferredScript('HTTPS://bs.serving-sys.com/BurstingPipe/ActivityServer.bs?cn=as&amp;ActivityID=99739&amp;Value=Revenue&amp;OrderID=OrderID&amp;ProductID=ProductID&amp;ProductInfo=ProductInfo');
});
//]]>
</script>
<!--[if IE 6]> <script type="text/javascript" src="/account/local-common/js/third-party/DD_belatedPNG.js?v17"></script>
<script type="text/javascript">
//<![CDATA[
DD_belatedPNG.fix('.icon-32');
DD_belatedPNG.fix('.icon-64');
DD_belatedPNG.fix('.input-note-arrow');
//]]>
</script>
<![endif]-->
</div>
</div>
</div>
