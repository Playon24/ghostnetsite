<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru-ru">
<head>
<title><?php echo WoW_Template::GetPageTitle(); ?></title>
<meta content="false" http-equiv="imagetoolbar" />
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
<link rel="shortcut icon" href="/account/local-common/images/favicons/bam.ico" type="image/x-icon"/>
<link rel="search" type="application/opensearchdescription+xml" href="http://eu.battle.net/ru-ru/data/opensearch" title="Поиск по Battle.net" />
<?php
WoW_Template::PrintCSSForBNPage();
?>
<script type="text/javascript" src="/account/local-common/js/third-party/jquery-1.4.4-p1.min.js"></script>
<script type="text/javascript" src="/account/local-common/js/core.js?v17"></script>
<script type="text/javascript" src="/account/local-common/js/tooltip.js?v17"></script>
<!--[if IE 6]> <script type="text/javascript">
//<![CDATA[
try { document.execCommand('BackgroundImageCache', false, true) } catch(e) {}
//]]>
</script>
<![endif]-->
<script type="text/javascript">
//<![CDATA[
Core.staticUrl = '/account';
Core.sharedStaticUrl= '/account/local-common';
Core.baseUrl = '/account';
Core.project = 'bam';
Core.locale = '<?php echo WoW_Locale::GetLocale(LOCALE_DOUBLE); ?>';
Core.buildRegion = 'eu';
Core.shortDateFormat= 'dd/MM/Y';
Core.loggedIn = true;
Flash.videoPlayer = '/wow/player/videoplayer.swf';
Flash.videoBase = '/wow/media/videos';
Flash.ratingImage = '/wow/player/rating-pegi.jpg';
//]]>
</script>
</head>
