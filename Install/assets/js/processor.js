var Processor = {
    addDatabase: function() {
        var $form = $('#databaseAddForm');

        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),

            success: function(data, status) {
                $('#addServerModal').modal('hide');
            }
        });
        Processor.loadDatabases();
        return false;
    },

    addWebsite: function(){
        var $form = $('#websiteAddForm');

        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),

            success: function(data, status){
                console.log(data);
                $('#addSiteModal').modal('hide');
                $('#addwebsitedatabase').hide();
            }
        });

        Processor.loadDatabases();
        return false;
    },

    loadDatabases: function(){
        var List = $('#databasesList')
        List.html('');

        $.ajax({
            type: 'GET',
            url: '/Install/handler?action=get-databases',
            data: [],
            dataType: 'json',
            success: function(data, status) {
                $.each(data, function(index, element) {
                    var Block, Box, Header, Body, H3;
                    Block = Processor.createElement('div', 'col-md-4');
                    Box = Processor.createElement('div', 'box box-solid');

                    Header = Processor.createElement('div', 'box-header with-border');
                    H3 = Processor.createElement('h3', 'box-title');
                    if(element.database_auth != undefined){
                        H3.innerHTML = '<i class="fa fa-database"></i> '+element.patch_name;
                        Header.appendChild(H3);

                        Body = Processor.createElement('div', 'box-body');
                        Body.appendChild(Processor.createBoxBody(element));
                        $('#addwebsitedatabase').hide();
                    } else {
                        H3.innerHTML = '<i class="fa fa-database"></i> Website Database';
                        Header.appendChild(H3);

                        Body = Processor.createElement('div', 'box-body');
                        Body.appendChild(Processor.createWebsiteBox(element));
                    }

                    Box.appendChild(Header);
                    Box.appendChild(Body);
                    Block.appendChild(Box);
                    List.append(Block);
                });
            }
        });
        return false;
    },

    createElement: function(ElementName, ClassName) {
        var Element = document.createElement(ElementName);
        Element.className = ClassName;
        return Element;
    },

    createBoxBody: function(data) {
        var BodyElement = Processor.createElement('p', ' ');

        BodyElement.appendChild(Processor.createFormGroup(data.patch_real, 'text', 'db_host', 'Host', data.database_host));
        BodyElement.appendChild(Processor.createFormGroup(data.patch_real, 'text', 'db_port', 'Port', data.database_port));
        BodyElement.appendChild(Processor.createFormGroup(data.patch_real, 'text', 'db_username', 'Username', data.database_user));
        BodyElement.appendChild(Processor.createFormGroup(data.patch_real, 'password', 'db_password', 'Password', data.database_password));
        BodyElement.appendChild(Processor.createFormGroup(data.patch_real, 'text', 'db_auth', 'Auth DB', data.database_auth));
        BodyElement.appendChild(Processor.createFormGroup(data.patch_real, 'text', 'db_char', 'Char DB', data.database_characters));
        BodyElement.appendChild(Processor.createFormGroup(data.patch_real, 'text', 'db_world', 'World DB', data.database_world));

        return BodyElement;
    },

    createWebsiteBox: function(data){
        var BodyElement = Processor.createElement('p', ' ');

        BodyElement.appendChild(Processor.createFormGroup('website', 'text', 'database_host', 'Host', data.database_host));
        BodyElement.appendChild(Processor.createFormGroup('website', 'text', 'database_port', 'Port', data.database_port));
        BodyElement.appendChild(Processor.createFormGroup('website', 'text', 'database_username', 'Username', data.database_user));
        BodyElement.appendChild(Processor.createFormGroup('website', 'password', 'database_password', 'Password', data.database_password));
        BodyElement.appendChild(Processor.createFormGroup('website', 'text', 'database_website', 'Database', data.database_website));
        BodyElement.appendChild(Processor.createFormGroup('website', 'text', 'database_encoding', 'Encoding', data.database_encoding));

        return BodyElement;
    },

    createFormGroup: function(PatchVersion, Type, ID, Name, Value){
        var MainDiv = Processor.createElement('div', 'form-group');
        var ElementID = ID+PatchVersion;
        MainDiv.appendChild(Processor.createLabel(ElementID, Name));
        MainDiv.appendChild(Processor.createInputRO(Type, ElementID, Value));
        return MainDiv;
    },

    createLabel: function(For, Name){
        var Element = Processor.createElement('label', 'col-sm-4 control-label');
        Element.setAttribute('for', For);
        Element.setAttribute('style', 'padding-top: 7px; margin-bottom: 0; text-align: right;')
        Element.innerHTML = '<strong>'+Name+'</strong>:';
        return Element;
    },

    createInputRO: function(Type, Id, Value){
        var Element = Processor.createElement('div', 'col-sm-8');
        var Input = Processor.createElement('input', 'form-control');
        Input.setAttribute('type', Type);
        Input.setAttribute('id', Id);
        Input.setAttribute('name', Id);
        Input.setAttribute('value', Value);
        Input.setAttribute('readonly', 'readonly');
        Input.setAttribute('style', 'text-align: center;')
        Element.appendChild(Input);
        return Element;
    },

    createButton: function(ClassName, DataWidget, InnerObject, Reference){
        var Element = document.createElement('button');
        Element.className = ClassName;
        Element.setAttribute('onclick', 'Processor.showHide("#body'+Reference+'");');
        Element.setAttribute('data-widget', DataWidget);
        Element.appendChild(InnerObject);
        return Element;
    },

    showHide: function(Reference){
        var Element = $(Reference);
        console.log(Element);
        if($(Reference+':visible')){
            $(function(){
                Element.attr('style', 'display: none;');
            });
        } else {
            $(function(){
                Element.attr('style', 'display: block;');
            });
        }
        return false;
    }
};