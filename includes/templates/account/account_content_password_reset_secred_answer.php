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
    if($error_code & ERORR_INVALID_PASSWORD_RECOVERY_ANSWER) {
        echo '<p class="error.email.invalid">Security answer not match!</p>';
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
        <h2 class="subcategory">Password Retrieval</h2>
        <h3 class="headline">Can’t log in?</h3>
      </div> 
      <form id="support-form" method="POST" action="<?php echo WoW::GetWoWPath(); ?>/account/support/password-reset-success.html">
        <div class="form-row">
          <span class="form-left"> Battle.net Security Question:</span>
          <span class="form-right"><?php echo WoW_Locale::GetString('template_account_creation_secret_question_'.$_SESSION['wow_password_recovery']['secredQ']); ?></span>
        </div>       
        <div class="form-row required">
          <label for="secretAnswer" class="label-full ">
            <strong> Answer:</strong>
            <span class="form-required">*</span>
          </label> 
          <input type="text" id="secretAnswer" name="secretAnswer" value="" class="input border-5 glow-shadow-2" maxlength="200" tabindex="1"    />
        </div>
        <fieldset class="ui-controls " > 
          <button class="ui-button button1 disabled" type="submit" disabled="disabled" id="support-submit">
            <span><span>Continue</span></span>
          </button> 
          <a class="ui-cancel" href="password-reset-select.html" tabindex="1"><span>Back</span></a>
          </fieldset>
      </form>  
    </div>
  </div>
</div>
