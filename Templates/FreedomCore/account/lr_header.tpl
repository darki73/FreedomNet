{include file = 'account/lr_head.tpl'}
<body class="{$Language} login-template web {$STheme}" data-embedded-state="STATE_LOGIN">
<script type="text/javascript">
    //<![CDATA[
    (function() {
        var body = document.getElementsByTagName("body")[0];
        body.className = body.className + " js-enabled preload";
    })();
    $(function(){
        $('body').removeClass('preload');
    });
    //]]>
</script>
<div class="grid-container wrapper">
    <h1 class="logo">{$AppName} {#Account_Login#}</h1>
    <div class="hide" id="info-wrapper">
        <h2><strong class="info-title"></strong></h2>
        <p class="info-body"></p>
        <button class="btn btn-block hide visible-phone" id="info-phone-close">Close</button>
    </div>