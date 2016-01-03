{include file = 'header.tpl'}
    <div class="wrapper">
        <div id="header">
            <div class="search-bar">
                <form action="/search" method="get" autocomplete="off">
                    <div>
                        <div class="ui-typeahead-ghost">
                            <input type="text" value autocomplete="off" readonly="readonly" class="search-field input input-ghost">
                            <input type="search" class="search-field input" name="q" id="search-field" maxlength="200" tabindex="40" alt="{#Head_Opensearch_Meta#} {$AppName}" value="{#Head_Opensearch_Meta#} {$AppName}">
                        </div>
                        <input type="submit" class="search-button" value tabindex="41">
                    </div>
                </form>
            </div>
            <h1 id="logo">
                <a href="{$HTTPHost}">{$AppName}</a>
            </h1>
            <div id="section">
                <div id="welcome-intro">
                    <div id="welcome-left">
                        <h2 style="color: white;">
                            {#Account_Management_HomePage_WelcomeMessage#}
                        </h2>
                        <a class="button" href="{$HTTPHost}/account/creation/tos">
                            {#Account_Management_Create_Account#}
                        </a>
                        <a href="?login">{#Account_Management_Login#}</a>
                    </div>
                    <div id="welcome-right">
                        <a href="/app">
                            <span class="clear"> <!-- --></span>
                            <div class="app-screen"></div>
                            <span class="text">
                                {#Account_Management_DownloadApplication#}
                            </span>
                        </a>
                    </div>
                </div>
                <span class="clear"> <!-- --></span>
            </div>
        </div>
    </div>
</div>

<div id="layout-middle">
    <div class="wrapper">
        <div id="content">
            <div id="homepage">
                {foreach $InstalledPatches as $Patch}
                    <div class="game-column" id="home-game-wow">
                        <a href="{$HTTPHost}/{$Patch.site_link}" class="game-promo promo-{$Patch.site_link}" tabindex="0">
                            <div class="game-tip">
                                {$Patch.patch_name}
                            </div>
                        </a>
                    </div>
                {/foreach}
                <span class="clear"> <!-- --></span>
            </div>
        </div>
    </div>
</div>

{include file = 'footer.tpl'}