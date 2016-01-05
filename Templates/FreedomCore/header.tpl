{include file = 'head.tpl'}
<body class="{$Language} {$Page.bodycss}">
    <div id="layout-top">
        <div id="nav-client-header" class="nav-client compact">
            <div id="nav-client-bar">
                <div class="grid-container nav-header-content">
                    <ul class="nav-list nav-left" id="nav-client-main-menu">
                        <li>
                            <a id="nav-client-home" class="nav-item nav-home" href="/" data-analytics="global-nav" data-analytics-placement="Nav - {$AppName} Icon"></a>
                        </li>
                        <li>
                            <a id="nav-client-shop" class="nav-item nav-link" href="/shop" data-analytics="global-nav" data-analytics-placement="Nav - {#Menu_Shop#}">{#Menu_Shop#}</a>
                        </li>
                        <li>
                            <a id="nav-client-api" class="nav-item nav-link" href="/api" data-analytics="global-nav" data-analytics-placement="Nav - API">API</a>
                        </li>
                        {if isset($smarty.session.loggedin) && $smarty.session.loggedin == true}
                            {if $User.access_level == 4}
                                <li>
                                    <a id="nav-client-update" class="nav-item nav-link" href="/Update" data-analytics="global-nav" data-analytics-placement="Nav - Update">Update</a>
                                </li>
                            {/if}
                        {/if}
                    </ul>
                    <ul class="nav-list nav-right" id="nav-client-account-menu">
                        {if !isset($smarty.session.loggedin) || isset($smarty.session.loggedin) && $smarty.session.loggedin == false}
                            <li>
                                <div id="username">
                                    <div class="dropdown pull-right">
                                        <a class="nav-link username username--loggedout needsclick dropdown-toggle" data-toggle="dropdown" rel="navbar">
                                            {#Account_Management#}
                                            <b class="caret"></b>
                                        </a>
                                        <div class="dropdown-menu">
                                            <div class="arrow top"></div>
                                            <div class="user-profile">
                                                <div class="dropdown-section">
                                                    <div class="nav-box">
                                                        <a class="nav-item nav-btn nav-btn-block nav-login-btn" href="/account/login" data-analytics="global-nav" data-analytics-placement="Nav - Account - Log In">
                                                            {#Account_Management_Login#}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="dropdown-section">
                                                    <ul class="nav-list">
                                                        <li>
                                                            <a class="nav-item nav-a nav-item-box" href="{$HTTPHost}/account/management" data-analytics="global-nav" data-analytics-placement="Nav - Account - Settings">
                                                                <i class="nav-icon-24-blue nav-icon-character-cog"></i>
                                                                {#Account_Parameters#}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        {else}

                        {/if}
                        <li>
                            <a id="nav-client-support-link" class="nav-item nav-link needsclick" href="{$HTTPHost}/support" data-analytics="global-nav" data-analytics-placement="Nav - Support">
                                {#Account_Support#}
                            </a>
                        </li>
                        <li>
                            <div class="nav-notification-icon">
                                <a class="dropdown-toggle needsclick nav-item" rel="navbar">
                                    <i class="needsclick nav-icon-bell"></i>
                                </a>
                                <div class="nav-notification-dropdown dropdown-menu">
                                    <div class="arrow-top"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nav-notification-responsive-container">
                <div class="nav-notification-dropdown dropdown-menu">
                    <div class="arrow top"></div>
                </div>
            </div>
        </div>
