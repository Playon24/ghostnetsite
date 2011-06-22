<div id="layout-middle">
  <div class="wrapper">
    <div id="content">    
      <div id="page-header">
        <h2 class="subcategory">Password Retrieval</h2>
        <h3 class="headline">Can’t log in?</h3>
      </div> 
      <p>To verify that you are the registered user of the account <?php echo $_SESSION['wow_password_recovery']['username'] . "^" . $_SESSION['wow_password_recovery']['email']; ?>, please provide one of the following:  </p>
      <form id="support-form" method="post" action="<?php echo WoW::GetWoWPath(); ?>/account/support/password-reset-secred-answer.html">
        <h3 class="caption choose">Choose Verification Method:</h3>  
        <div class="wide-radio-button">
          <div class="form-row-checkbox required">
            <span class="checkbox">
              <input type="radio" name="verificationMethod" value="SECURITY_QUESTION" class="required" id="verificationMethod-0" tabindex="1"/>
            </span>
            <label class="required" for="verificationMethod-0" >
              <strong>Answer my Battle.net security question</strong>
            </label>
          </div>
          <div class="indented">
            <a href="http://eu.blizzard.com/support/article.xml?locale=en_GB&amp;tag=authkeyhelp" onclick="window.open(this.href);return false;">
              <img height='16' width='16' src='/account/images/icons/tooltip-help.gif' alt=''/>&#160;&#160;Where can I find this?</a>
          </div>
          <div id="footnote">
            <p>Can’t provide either?  Please <a href="index.html">contact Customer Support</a>.</p>
          </div>
        </div>
        <fieldset class="ui-controls " > 
          <button class="ui-button button1 disabled" type="submit" disabled="disabled" id="support-submit">
            <span><span>Continue</span></span>
          </button> 
          <a class="ui-cancel" href="password-reset.html" tabindex="1"><span>Back</span></a>
          </fieldset>
      </form> 
    </div>
  </div>
</div>
