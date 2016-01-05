<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$Language}" class="{$Language}">
<head xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
    <meta http-equiv="imagetoolbar" content="false" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{$Page.pagetitle} {$AppName}</title>

    <link rel="shortcut icon" href="//{$HTTPHost}/{$Template}/images/meta/favicon.ico" />
    <!--[if gt IE 8]><!--><link rel="stylesheet" type="text/css" media="all" href="{$HTTPHost}/Templates/{$Template}/css/toolkit/freedomnet-web.css" /><!-- <![endif]-->
    <link rel="stylesheet" type="text/css" media="all" href="{$HTTPHost}/Templates/{$Template}/css/account/global.css" />
    <link rel="stylesheet" type="text/css" media="all" href="{$HTTPHost}/Templates/{$Template}/css/nav-client/nav-client.css" />
    <link rel="stylesheet" type="text/css" media="(max-width:800px)" href="{$HTTPHost}/Templates/{$Template}/css/nav-client/nav-client-responsive.css" />
    <link rel="search" type="application/opensearchdescription+xml" href="{$HTTPHost}/data/opensearch" title="{#Head_Opensearch_Meta#} {$AppName}" />
    <script type="text/javascript" src="{$HTTPHost}/Templates/{$Template}/js/toolkit/third-party/jquery/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="{$HTTPHost}/Templates/{$Template}/js/core.js"></script>

    <meta name="viewport" content="width=device-width" />

    <script type="text/javascript">
        //<![CDATA[
        var Core = require("@freedomnet/core-client");
        var Login = require("@freedomnet/login-client");
        Core.staticUrl = '{$HTTPHost}/Templates/{$Template}/';
        Core.sharedStaticUrl = '{$HTTPHost}/Templates/{$Template}/';
        Core.baseUrl = '/';
        Core.projectUrl = '';
        Core.cdnUrl = '{$HTTPHost}';
        Core.supportUrl = '{$HTTPHost}/support/';
        Core.secureSupportUrl = 'https:{$HTTPHost}/support/';
        Core.project = 'login';
        Core.locale = '{$Language}';
        Core.language = '{$Language}';
        Core.region = 'global';
        Core.shortDateFormat = 'dd/MM/yyyy';
        Core.dateTimeFormat = 'dd/MM/yyyy HH:mm';
        Core.loggedIn = false;
        Core.userAgent = 'web';
        Login.embeddedUrl = '{$HTTPHost}/account/login.frag';
        //]]>
    </script>
</head>