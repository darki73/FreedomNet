{include file = 'account/lr_header.tpl'}
<div class="input" id="login-wrapper">
    <form action="" class="username-required input-focus" id="password-form" method="post" name="password-form">
        <div class="alert alert-error alert-icon hide" id="js-errors">
            <p class="hide" id="cookie-check">
                Your browser's cookies are disabled. Please reenable cookies to continue.
            </p>
        </div><noscript>
            <div class="alert alert-error alert-icon" id="javascript-disabled">
                JavaScript must be enabled to use this site.
            </div></noscript>
        <div class="control-group">
            <label class="control-label" for="accountName" id="accountName-label">{#Account_Login_Email#}</label>
            <div class="controls">
                <input aria-labelledby="accountName-label" class="input-block input-large" id="accountName" maxlength="320" name="accountName" placeholder="{#Account_Login_Email#}" spellcheck="false" tabindex="1" title="{#Account_Login_Email#}" type="text">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="password" id="password-label">{#Account_Login_Password#}</label>
            <div class="controls">
                <input aria-labelledby="password-label" autocomplete="off" class="input-block input-large" id="password" maxlength="16" name="password" placeholder="{#Account_Login_Password#}" spellcheck="false" tabindex="1" title="{#Account_Login_Password#}" type="password">
            </div>
        </div>

        <div class="control-group">
            <div class="captcha">
                <a id="captcha-anchor" role="button" href="javascript:;" onclick=" return ReloadCaptcha();">
                    <i class="icon-48-refresh"></i>
                    <div class="captcha-image" id="captcha-image">
                        <img id="sec-string" align="middle" src="/account/captcha.jpg" alt="{#Account_Captcha_Renew#}" title="{#Account_Captcha_Renew#}" />
                    </div>
                </a>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="control-group">
            <label id="captchaInput-label" class="control-label" for="captchaInput">{#Account_Captcha_Code#}</label>
            <div class="controls">
                <input aria-labelledby="captchaInput-label" id="captchaInput" name="captchaInput" title="{#Account_Captcha_Code#}" maxlength="320" type="text" tabindex="1" class="input-block input-large" autocomplete="off" placeholder="{#Account_Captcha_Code#}" autocorrect="off" spellcheck="false" />
            </div>
        </div>

        <input id="useSrp" name="useSrp" type="hidden" value="false">
        <input id="publicA" name="publicA" type="hidden" value="">
        <input id="clientEvidenceM1" name="clientEvidenceM1" type="hidden" value="">

        <div class="persistWrapper">
            <label class="checkbox-label css-label hide" for="persistLogin" id="persistLogin-label">
                <input aria-labelledby="persistLogin-label" checked="checked" id="persistLogin" name="persistLogin" tabindex="1" type="checkbox">
                <span class="input-checkbox"></span>
                {#Account_Login_Remember_Me#}
            </label>
        </div>
        <div class="control-group submit">
            <button class="btn btn-primary btn-large btn-block" data-loading-text="" id="submit" tabindex="1" type="submit">
                {#Account_Login_Authorization#}
                <i class="spinner-battlenet"></i>
            </button>
        </div>
        <ul id="help-links">
            <li>
                <a class="btn btn-block btn-large" href="http://eu.battle.net/account/creation/tos.html?theme=bnet" id="signup" rel="external" tabindex="1">
                    {#Account_Login_Create_Account#}
                </a>
            </li>
            <li>
                <a class="" href="http://eu.battle.net/account/support/login-support.html?theme=bnet" id= "loginSupport" rel="external" tabindex="1">
                    {#Account_Login_Cant_Login#}
                </a>
            </li>
        </ul>
        <input id="csrftoken" name="csrftoken" type="hidden" value="{$CSRFToken}">
    </form>
</div>
{include file = 'account/lr_footer.tpl'}