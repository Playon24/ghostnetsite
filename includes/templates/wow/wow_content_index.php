
        <div id="content">
            <div class="content-top">
              <div class="content-bot">
                <div id="homepage">
                  <div id="left">
                  <script type="text/javascript" src="<?php echo WoW::GetWoWPath(); ?>/wow/static/local-common/js/slideshow.js"></script>
                  <script type="text/javascript" src="<?php echo WoW::GetWoWPath(); ?>/wow/static/local-common/js/third-party/swfobject.js"></script>
<?php
if(!isset($_GET['page'])) {
    WoW_Template::LoadTemplate('block_slideshow');
}
WoW_Template::LoadTemplate('block_featured_news');
WoW_Template::LoadTemplate('block_news_updates');
?>
                  </div>
                  <div id="right" class="ajax-update">
<?php
WoW_Template::LoadTemplate('block_bn_ads');
WoW_Template::LoadTemplate('block_sidebar');
?>
                  </div>
                  <span class="clear"><!-- --></span>
                </div>
              </div>
            </div>
        </div>
