<footer class="footer en-gb" id="footer">
    <div class="nav-client" id="nav-client-footer">
        <div class=
             "mobileFooterEnabled footer-content footer-desktop grid-container">
            <div class="nav-section support-feedback">
                <div class="nav-left">
                    <div id="nav-feedback"></div>
                </div>
            </div>
            <div class="nav-section">
                <div class="nav-left nav-logo-group">
                    <div class="footer-logo nav-left">
                        <a class="nav-item logo-link" data-analytics="global-nav" data-analytics-placement="Footer - {$AppName} Logo" href="/">
                            <img alt="" class="blizzard-logo" src="{$HTTPHost}/Templates/{$Template}/images/nav-client/blizzard.png">
                        </a>
                    </div>
                    <div class="footer-links nav-left">
                            <a class="nav-item nav-a" data-analytics="global-nav" data-analytics-placement="Footer - eula" href="/company/legal/eula">
                                EULA
                            </a>
                        <span>|</span>
                            <a class="nav-item nav-a" data-analytics="global-nav" data-analytics-placement="Footer - Privacy" href="/company/about/privacy.html">
                                Privacy
                            </a>
                        <span>|</span>
                            <a class="nav-item nav-a" data-analytics="global-nav" data-analytics-placement="Footer - Terms" href="/company/legal/">
                                Terms
                            </a>
                        <span>|</span>
                            <a class="nav-item nav-a" data-analytics="global-nav" data-analytics-placement="Footer - copyright" href="/company/about/infringementnotice.html">
                                Copyright Infringement
                            </a>
                        <div class="copyright">
                            © {$AppName}, {'Y'|date}
                        </div>
                        <div class="nav-footer-icon-container">
                            <ul class="nav-footer-icon-list"></ul>
                        </div>
                    </div>
                </div>
                <div class="nav-ratings"></div>
            </div>
        </div>
        <div class="mobileFooterEnabled footer-content footer-mobile grid-container">
            <div class="nav-logo-group">
                <div class="footer-logo">
                    <a class="nav-item logo-link" data-analytics="global-nav" data-analytics-placement="Footer - {$AppName} Logo" href="/">
                        <img alt="" class="blizzard-logo" src="{$HTTPHost}/Templates/{$Template}/images/nav-client/blizzard.png">
                    </a>
                </div>
                <div class="footer-links">
                    <a class="nav-item nav-a" data-analytics="global-nav" data-analytics-placement="Footer - eula" href="/company/legal/eula">
                        EULA
                    </a>
                    <span>|</span>
                    <a class="nav-item nav-a" data-analytics="global-nav" data-analytics-placement="Footer - Privacy" href="/company/about/privacy.html">
                        Privacy
                    </a>
                    <span>|</span>
                    <a class="nav-item nav-a" data-analytics="global-nav" data-analytics-placement="Footer - Terms" href="/company/legal/">
                        Terms
                    </a>
                    <span>|</span>
                    <a class="nav-item nav-a" data-analytics="global-nav" data-analytics-placement="Footer - copyright" href="/company/about/infringementnotice.html">
                        Copyright Infringement
                    </a>
                </div>
                <div class="copyright">
                    © {$AppName}, {'Y'|date}
                </div>
                <div class="nav-footer-icon-container">
                    <ul class="nav-footer-icon-list"></ul>
                </div>
                <div class="nav-ratings"></div>
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
</footer>

</div>
</body>
</html>