<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$Language}" class="{$Language}">
<head xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
    <meta http-equiv="imagetoolbar" content="false" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{$Page.pagetitle} {$AppName}</title>
    <link rel="shortcut icon" href="{$HTTPHost}/Templates/{$Template}/images/meta/favicon.ico" />
    <link rel="search" type="application/opensearchdescription+xml" href="{$HTTPHost}/data/opensearch" title="{#Head_Opensearch_Meta#} {$AppName}" />
    <link rel="stylesheet" type="text/css" media="all" href="{$HTTPHost}/Templates/{$Template}/css/common.css" />
    <link rel="stylesheet" type="text/css" media="all" href="{$HTTPHost}/Templates/{$Template}/css/bnet.css" />
    <link rel="stylesheet" type="text/css" media="all" href="{$HTTPHost}/Templates/{$Template}/css/homepage.css" />
    <link rel="stylesheet" type="text/css" media="all" href="{$HTTPHost}/Templates/{$Template}/css/locale/{$Language}.css" />


    
    <meta name="description" content="{$AppDescription}" />
    <meta property="og:locale" content="{$Language}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{$HTTPHost}" />
    <meta property="og:image" content="{$HTTPHost}/Templates/{$Template}/images/meta/og-root.png" />
    <meta property="og:image" content="{$HTTPHost}/Templates/{$Template}/images/meta/og-company.png" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="{$AppName}" />
    <script type="text/javascript" src="{$HTTPHost}/Templates/{$Template}/js/third-party.js"></script>
    <script type="text/javascript" src="{$HTTPHost}/Templates/{$Template}/js/common-game-site.js"></script>
    <script type="text/javascript">
        //<![CDATA[
        var Core = Core || {ldelim}{rdelim},
        Login = Login || {ldelim}{rdelim};
        Core.staticUrl = '{$HTTPHost}/Templates/{$Template}/';
        Core.sharedStaticUrl = '{$HTTPHost}/Templates/{$Template}/';
        Core.baseUrl = '/';
        Core.projectUrl = '';
        Core.cdnUrl = '{$HTTPHost}';
        Core.supportUrl = '{$HTTPHost}/support/';
        Core.secureSupportUrl = 'https:{$HTTPHost}/support/';
        Core.project = 'root';
        Core.locale = '{$Language}';
        Core.language = '{$Language}';
        Core.region = 'global';
        Core.shortDateFormat = 'dd/MM/yyyy';
        Core.dateTimeFormat = 'dd/MM/yyyy HH:mm::ss';
        Core.loggedIn = false;
        Core.userAgent = 'web';
        Login.embeddedUrl = '{$HTTPHost}/login/login.frag';
        var Flash = Flash || {ldelim}{rdelim};
        Flash.videoPlayer = '{$HTTPHost}/Templates/{$Template}/global-video-player/themes/root/video-player.swf';
        Flash.videoBase = '{$HTTPHost}/root/media/videos';
        Flash.ratingImage = '{$HTTPHost}/Templates/{$Template}/global-video-player/ratings/root/ru-ru.jpg';
        Flash.expressInstall = '{$HTTPHost}/Templates/{$Template}/global-video-player/expressInstall.swf';
        //]]>
    </script>
    {if $GoogleAnalytics.Account != ''}
        <script>
            {literal}
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', '{/literal}{$GoogleAnalytics.Account}{literal}', 'auto');
            ga('send', 'pageview');
            {/literal}
        </script>
    {/if}
    <link rel="stylesheet" type="text/css" media="all" href="{$HTTPHost}/Templates/{$Template}/css/nav-client/nav-client-desktop.css?v=51" />
    <meta name="robots" content="NOODP" />
</head>
