{include file = 'installation/step_header.tpl'}
<div id="wrap" style="margin-top:50px;">
    <div class="container">

        <div class="page-header" id="banner">
            <div class="row">
                <div class="col-lg-12">
                    <h1>{#Installation_Setup_HO#}</h1>
                    <p class="lead">{#Installation_Allowed#}</p>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-md-9">
                    <h2><strong>{#Installation_MySQL_Database#}</strong></h2>
                </div>
                <div class="col-md-3">
                    <a id="addwebsitedatabase" class="btn btn-app" data-toggle="modal" data-target="#addSiteModal">
                        <i class="fa fa-edit"></i>Add Site Database
                    </a>
                    <a class="btn btn-app" data-toggle="modal" data-target="#addServerModal">
                        <i class="fa fa-edit"></i>Add Game Database
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="databasesList">

                    </div>
                </div>
            </div>
        <form method="POST" action="/Install/process">
            <div class="row">
                <fieldset>
                    <legend>{#Installation_Common_Configuration#}</legend>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="site_title" class="control-label">{#Installation_Site_Title#}</label>
                            <input type="text" class="form-control" name="site_title" placeholder="FreedomCore">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="site_description" class="control-label">{#Installation_Site_Description#}</label>
                            <input type="text" class="form-control" name="site_description" placeholder="Best site... 4eva!!!!">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="site_keywords" class="control-label">{#Installation_Site_Keywords#}</label>
                            <input type="text" class="form-control" name="site_keywords" placeholder="WoW, FreedomCore, Darki73">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>{#Installation_Media_Links#}</legend>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="facebook_link" class="control-label"><i class="fa fa-facebook-official"></i> {#Installation_Media_Facebook_Label#}</label>
                            <input type="text" class="form-control" name="facebook_link" placeholder="https://facebook.com/groups/group_id">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="twitter_link" class="control-label"><i class="fa fa-twitter-square"></i> {#Installation_Media_Twitter_Label#}</label>
                            <input type="text" class="form-control" name="twitter_link" placeholder="https://twitter.com/user_name">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="vkontakte_link" class="control-label"><i class="fa fa-vk"></i> {#Installation_Media_Vkontakte_Label#}</label>
                            <input type="text" class="form-control" name="vkontakte_link" placeholder="https://vk.com/group_name">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="youtube_link" class="control-label"><i class="fa fa-youtube-square"></i> {#Installation_Media_Youtube_Label#}</label>
                            <input type="text" class="form-control" name="youtube_link" placeholder="https://www.youtube.com/channel/UCRrmYXcFyShWov9s-VzoXlA">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="skype_username" class="control-label"><i class="fa fa-skype"></i> {#Installation_Media_Skype_Label#}</label>
                            <input type="text" class="form-control" name="skype_username" placeholder="downloads3000">
                        </div>
                    </div>
                </fieldset>
                <br />
                <fieldset>
                    <legend>{#Installation_Google_Analytics_Header#}</legend>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ga_account" class="control-label">{#Installation_Google_Analytics_Account#}</label>
                            <input type="text" class="form-control" name="ga_account" placeholder="UA-12341412">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ga_domain" class="control-label">{#Installation_Google_Analytics_Domain#}</label>
                            <input type="text" class="form-control" name="ga_domain" placeholder="*.{$HTTPHost|replace:'//':''}">
                        </div>
                    </div>
                </fieldset>
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="Submit">{#Installation_Finalize_Install#}</button>
                        <button type="reset" class="btn btn-default">{#Installation_Site_Cancel#}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="addServerModal"  class="modal modal-primary fade"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Game Patch Database Manager</h4>
            </div>
            <form id="databaseAddForm" data-async action="/Install/handler?action=add-database" method="POST">
                <div class="modal-body">
                    <h3>{#Installation_MySQL_Database#}</h3>
                    <div class="form-group">
                        <label>{#Installation_MySQL_Host#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="127.0.0.1" name="database_host" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_MySQL_Port#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-lock"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="3306" name="database_port" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_MySQL_User#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="{#Installation_MySQL_User#}" name="database_username" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_MySQL_Password#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-key"></i>
                            </div>
                            <input type="password" class="form-control" placeholder="{#Installation_MySQL_Password#}" name="database_password" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_MySQL_AuthDB#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-database"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="auth" name="database_auth" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_MySQL_CharDB#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-database"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="characters" name="database_characters" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_MySQL_WorldDB#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-database"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="world" name="database_world" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_MySQL_Encoding#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-language"></i>
                            </div>
                            <select class="form-control" id="select" name="database_encoding" required="required">
                                <option value="UTF8" selected="selected">UTF8</option>
                                <option value="CP1251">CP1251</option>
                                <option value="KOI8R">KOI8-R</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_Game_Patch#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-wrench"></i>
                            </div>
                            <select class="form-control" id="select" name="game_patch" required="required">
                                <option value="3" selected="selected">Wrath of the Lich King</option>
                                <option value="4">Cataclysm</option>
                                <option value="5">Mists of Pandaria</option>
                                <option value="6">Warlords of Draenor</option>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <h3>{#Installation_SOAP_Header#}</h3>
                    <div class="form-group">
                        <label>{#Installation_SOAP_IP#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="127.0.0.1" name="soap_host" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_SOAP_Port#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-lock"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="7878" name="soap_port" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_SOAP_Account#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="{#Installation_SOAP_Account#}" name="soap_user" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_SOAP_Password#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-key"></i>
                            </div>
                            <input type="password" class="form-control" placeholder="{#Installation_SOAP_Password#}" name="soap_password" required="required">
                        </div>
                    </div>

                    <hr>
                    <h3>{#Installation_Common_Configuration#}</h3>

                    <div class="form-group">
                        <label>{#Installation_Site_Template#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-television"></i>
                            </div>
                            <select class="form-control" id="select" name="site_template" required>
                                <option value="WoD" selected="selected">Warlords of Draenor</option>
                                <option value="MoP">Mists of Pandaria</option>
                                <option value="Cata">Cataclysm</option>
                                <option value="WotLK">Wrath of the Lich King</option>
                                <option value="TBC">The Burning Crusade</option>
                            </select>
                        </div>
                    </div>

                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">{#Installation_Cancel#}</button>
                <button type="button" class="btn btn-outline" onclick="return Processor.addDatabase();">{#Installation_Add_Database#}</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="addSiteModal" class="modal modal-primary fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Website Database Manager</h4>
            </div>
            <form id="websiteAddForm" data-async action="/Install/handler?action=add-website" method="POST">
                <div class="modal-body">
                    <h3>{#Installation_MySQL_Database#}</h3>
                    <div class="form-group">
                        <label>{#Installation_MySQL_Host#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="127.0.0.1" name="database_host" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_MySQL_Port#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-lock"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="3306" name="database_port" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_MySQL_User#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="{#Installation_MySQL_User#}" name="database_username" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_MySQL_Password#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-key"></i>
                            </div>
                            <input type="password" class="form-control" placeholder="{#Installation_MySQL_Password#}" name="database_password" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_MySQL_SiteDB#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-database"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="freedomcore" name="database_website" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{#Installation_MySQL_Encoding#}:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-language"></i>
                            </div>
                            <select class="form-control" id="select" name="database_encoding" required="required">
                                <option value="UTF8" selected="selected">UTF8</option>
                                <option value="CP1251">CP1251</option>
                                <option value="KOI8R">KOI8-R</option>
                            </select>
                        </div>
                    </div>

                    <hr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">{#Installation_Cancel#}</button>
                    <button type="button" class="btn btn-outline" onclick="return Processor.addWebsite();">{#Installation_Add_Database#}</button>
                </div>
            </form>
        </div>
    </div>
</div>

{include file = 'installation/step_footer.tpl'}