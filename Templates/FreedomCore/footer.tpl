    <div id="layout-bottom">
        <div class="wrapper">
            <div id="footer">
                <div id="nav-client-footer" class="nav-client">
                <div class="mobileFooterEnabled footer-content footer-desktop grid-container">
                        <div class="nav-section support-feedback">
                            <div class="nav-left">
                                <div id="nav-feedback">
                                    <a id="nav-client-news" class="nav-item nav-a nav-item-btn" href="//{$smarty.server.HTTP_HOST}/support/" data-analytics="global-nav" data-analytics-placement="Footer - Support">
                                        <i class="nav-icon-24-blue nav-icon-question-circle"></i>
                                        {#Account_Support#}
                                    </a>
                                </div>
                            </div>
                            <div class="nav-right">
                                <div id="nav-client-region-select">
                                    <div class="dropdown dropup pull-right">
                                        <a class="dropdown-toggle nav-item" data-toggle="dropdown">
                                            <i class="nav-icon-24-blue nav-icon-globe"></i>
                                            {if $Language == 'es'}
                                                Español
                                            {elseif $Language == 'en'}
                                                English
                                            {elseif $Language == 'ru'}
                                                Русский
                                            {elseif $Language == 'pt'}
                                                Português
                                            {elseif $Language == 'kr'}
                                                한국어
                                            {elseif $Language == 'fr'}
                                                Français
                                            {elseif $Language == 'de'}
                                                Deutsch
                                            {elseif $Language == 'it'}
                                                Italiano
                                            {elseif $Language == 'pl'}
                                                Polski
                                            {/if}
                                            <b class="caret"></b>
                                        </a>
                                        <div class="dropdown-menu" data-placement="top">
                                            <div class="arrow bottom"></div>
                                            <div id="nav-client-international-desktop">
                                                <div class="nav-international-container">
                                                    <div class="dropdown-section nav-column-container">
                                                        <div class="nav-column-50">
                                                            <div id="select-regions" class="nav-box regions">
                                                                <h3>{#Language_Region#}</h3>
                                                                <ul class="region-ul">
                                                                    <li class="region active current"><a class="nav-item select-region" href="javascript:;" data-target="world">World</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="nav-column-50">
                                                            <div id="select-language" class="nav-box languages">
                                                                <h3>{#Language_Locale#}</h3>
                                                                <div class="region region-languages active current" data-region="eu">
                                                                    <ul class="region-ul">
                                                                        <li class="{if $Language == 'de'}active current{/if}">
                                                                            <a class="nav-item select-language" href="/changelanguage/de/" data-target="world" data-language="de-de">Deutsch</a>
                                                                        </li>
                                                                        <li class="{if $Language == 'en'}active current{/if}">
                                                                            <a class="nav-item select-language" href="/changelanguage/en/" data-target="world" data-language="en-gb">English</a>
                                                                        </li>
                                                                        <li class="{if $Language == 'es'}active current{/if}">
                                                                            <a class="nav-item select-language" href="/changelanguage/es/" data-target="world" data-language="es-es">Español</a>
                                                                        </li>
                                                                        <li class="{if $Language == 'fr'}active current{/if}">
                                                                            <a class="nav-item select-language" href="/changelanguage/fr/" data-target="world" data-language="fr-fr">Français</a>
                                                                        </li>
                                                                        <li class="{if $Language == 'it'}active current{/if}">
                                                                            <a class="nav-item select-language" href="/changelanguage/it/" data-target="world" data-language="it-it">Italiano</a>
                                                                        </li>
                                                                        <li class="{if $Language == 'pl'}active current{/if}">
                                                                            <a class="nav-item select-language" href="/changelanguage/pl/" data-target="world" data-language="pl-pl">Polski</a>
                                                                        </li>
                                                                        <li class="{if $Language == 'pt'}active current{/if}">
                                                                            <a class="nav-item select-language" href="/changelanguage/pt/" data-target="world" data-language="pt-pt">Português</a>
                                                                        </li>
                                                                        <li class="{if $Language == 'ru'}active current{/if}">
                                                                            <a class="nav-item select-language" href="/changelanguage/ru/" data-target="world" data-language="ru-ru">Русский</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown-section dropdown-well nav-box localeChange">
                                                    <a id="nav-client-change-language-desktop" href="javascript:;" class="nav-lang-change nav-btn disabled">{#Language_Change#}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        </div>
                        <div class="nav-section">
                            <div class="nav-left nav-logo-group">
                                <div class="footer-logo nav-left">
                                    <a class="nav-item logo-link" href="/" data-analytics="global-nav" data-analytics-placement="Footer - {$AppName} Logo">
                                        <img class="blizzard-logo" src="/Templates/{$Template}/images/nav-client/blizzard.png" alt="">
                                    </a>
                                </div>
                                <div class="footer-links nav-left">
                                    <a class="nav-item nav-a" href="/about/legal/" data-analytics="global-nav" data-analytics-placement="Footer - Legal">{#Footer_Legal#}</a>
                                    <span>|</span>
                                    <a class="nav-item nav-a" href="/about/privacy" data-analytics="global-nav" data-analytics-placement="Footer - Privacy Policy">{#Footer_PP#}</a>
                                    <span>|</span>
                                    <a class="nav-item nav-a" href="/about/infringementnotice" data-analytics="global-nav" data-analytics-placement="Footer - Copyright Infringement">{#Footer_Copyright#}</a>
                                    <span>|</span>
                                    <a class="nav-item nav-a" href="/api" data-analytics="global-nav" data-analytics-placement="Footer - API">API</a>
                                    <div class="copyright">© {$AppName}, 2015 г.</div>
                                    <div class="nav-footer-icon-container">
                                        <ul class="nav-footer-icon-list">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="nav-ratings">
                                <div class="legal-rating"></div>
                            </div>
                        </div>
                    </div>
                <div class="mobileFooterEnabled footer-content footer-mobile grid-container"></div>
                <div class="modal eu-cookie-compliance desktop hide" id="eu-cookie-compliance">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal" id="cookie-compliance-close">
                            <i class="icon-remove icon-white"></i>
                        </a>
                        <h1>{#Account_Management_Cookies_Header#}</h1>
                    </div>
                    <div class="modal-body">
                        <p>
                            {#Account_Management_Cookies_Description#}
                        </p>
                    </div>
                    <button class="btn btn-primary" id="cookie-compliance-agree">
                        {#Account_Management_Cookies_Agree#}
                    </button>
                    <a class="btn" id="cookie-compliance-learn" href="{$HTTPHost}/about/privacy" target="_blank">
                        {#Account_Management_Cookies_More#}
                    </a>
                </div>
                <div class="modal eu-cookie-compliance mobile hide" id="eu-cookie-compliance">
                    <div class="modal-body">
                        <a class="close" data-dismiss="modal" id="cookie-compliance-close">
                            <i class="icon-remove icon-white"></i>
                        </a>
                        <p>
                            {#Account_Management_Cookies_Description_Mobile#}
                        </p>
                    </div>
                    <button class="btn btn-primary" id="cookie-compliance-agree">
                        {#Account_Management_Cookies_Agree#}
                    </button>
                    <a class="btn" id="cookie-compliance-learn" href="{$HTTPHost}/about/privacy" target="_blank">
                        {#Account_Management_Cookies_More#}
                    </a>
                </div>
            </div>
        </div>
    </div>
        <script type="text/javascript" src="{$HTTPHost}/Templates/{$Template}/js/common/menu.js"></script>
        <script type="text/javascript" src="{$HTTPHost}/Templates/{$Template}/js/bnet.js"></script>
        <script type="text/javascript">
            //<![CDATA[
            $(function() {
                Search.initialize('/search');
            });
            //]]>
        </script>
        <script type="text/javascript" src="{$HTTPHost}/Templates/{$Template}/js/nav-client/navbar-tk.js"></script>
</body>
</html>