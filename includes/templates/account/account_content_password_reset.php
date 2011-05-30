<div id="layout-middle">
<div class="wrapper">
<div id="content">
<?php
if(WoW_Account::GetLastErrorCode() != ERROR_NONE) {
    echo '<div class="alert error closeable border-4 glow-shadow">
<div class="alert-inner">
<div class="alert-message">
<p class="title"><strong>An error has occurred.</strong></p>
';
    $error_code = WoW_Account::GetLastErrorCode();
    if($error_code & ERORR_INVALID_PASSWORD_RECOVERY_COMBINATION) {
        echo '<p class="error.email.invalid">Invalid email/account name combination.</p>';
    }
    echo '
</div>
</div>
<a class="alert-close" href="#" onclick="$(this).parent().fadeOut(250, function() { $(this).css({opacity:0}).animate({height: 0}, 100, function() { $(this).remove(); }); }); return false;">Close</a>
<span class="clear"><!-- --></span>
</div>';
}
?>
<div id="page-header">
<span class="float-right"><span class="form-req">*</span> Required</span>
<h3 class="headline">Can't log in?</h3>
</div>
<p class="introduction">There are several reasons you might not be able to log in. Check below for more information and possible solutions.</p>
<ul class="form-titles">
<li>
<a href="#form-password" class="form-anchor">
<span class="icon-32 closed"></span>
<span class="icon-32-label form-name">I forgot my Battle.net account password, or am currently locked out of my account.</span>
</a>
<div class="sub-form hide-element" id="form-password">
<form method="post" action="<?php echo WoW::GetWoWPath(); ?>/account/support/password-reset-select.html" id="support-form">
<input type="hidden" name="csrftoken" value="1d06ae50-e1c7-40fc-9563-a5ba3b31523f" />
<div class="form-row required">
<label for="email" class="label-full "><strong> E-mail Address:</strong><span class="form-required">*</span></label>
<input type="text" id="email" name="email" value="" class=" input border-5 glow-shadow-2" maxlength="150" tabindex="1" />
</div>
<div class="form-row required">
<label for="firstName" class="label-full "><strong> Account Name:</strong><span class="form-required">*</span></label>
<input type="text" id="firstName" name="firstName" value="" class=" input border-5 glow-shadow-2" maxlength="200" tabindex="2" />
</div>
<fieldset class="ui-controls " >
<button class="ui-button button1 disabled" type="submit" disabled="disabled" id="support-submit" tabindex="1">
<span><span>Continue</span></span>
</button>
</fieldset>
</form>
</div>
</li>
<li>
<a href="#form-hacked" class="form-anchor">
<span class="icon-32 closed"></span>
<span class="icon-32-label form-name">I think my account may have been hacked.</span>
</a>
<div class="sub-form hide-element" id="form-hacked">
<p class="small-subtitle">Here are some common signs:</p>
<ul class="signs-list">
<li class="signs">My password has been working fine until now</li>
<li class="signs">There is an authenticator attached to the account, but I didn’t attach&#160;one</li>
<li class="signs">My account got banned and I don’t know why</li>
<li class="signs">I’ve reset my password recently but it’s not working</li>
</ul>
<p class="small-subtitle">Do these signs apply to you? We can help.</p>
<p>Click the button below to start the Account Recovery process. We will help get these issues resolved as soon as we can.</p>
<fieldset class="ui-controls " >
<a class="ui-button button1 " href="/account/support/account-recovery.html">
<span>
<span>BEGIN ACCOUNT RECOVERY</span>
</span>
</a>
</fieldset>
</div>
</li>

</ul>
<span class="clear"><!-- --></span>
</div>
</div>
</div>
