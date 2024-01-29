Ext.define('TCPContable.controller.Tcp', {
    extend: 'Ext.app.Controller',
    models: ['Tcp', 'Tcpcombo', 'Provincescombo', 'Citiescombo'],
    stores: ['Tcp', 'Tcpcombo', 'Provincescombo', 'Citiescombo'],
    views: [
        'tcp.TcpGrid',
        'tcp.TcpBinding',
        'tcp.TcpForm',
        'tcp.TcpCombo',
        'tcp.Provincescombo',
        'tcp.Citiescombo'
    ],
    refs: [
        {
            ref: 'tcpgrid',
            selector: 'tcpgrid'
        },{
            ref: 'tcpbinding',
            selector: 'tcpbinding'
        },{
            ref: 'tcpcombo',
            selector: 'tcpcombo'
        },
        {
            ref: 'provincescombo',
            selector: 'provincescombo'
        },
        {
            ref: 'citiescombo',
            selector: 'citiescombo'
        }
    ],
    init: function() {

        this.control({
            'tcpgrid dataview': {
                itemdblclick: this.updateTcp
            },
            'tcpgrid button[action=reload]': {
                click: this.reloadTcp
            },
            'tcpgrid button[action=create]': {
                click: this.createTcp
            },
            'tcpgrid button[action=update]': {
                click: this.updateTcp
            },
            'tcpgrid button[action=delete]': {
                click: this.deleteTcp
            },
            'tcpform button[action=save]': {
                click: this.saveTcp
            },
            'provincescombo': {
                change: this.loadCities
            }
        });
    },
    
    reloadTcp: function() {

        var grid = this.getTcpgrid();
        grid.getStore().load();
    },

    loadCities: function(combo, newValue, oldValue, eOpts) {

        var citiescombo  = this.getCitiescombo();
        // Load Day Store
        var cityproxy = citiescombo.getStore().getProxy();
        Ext.apply(cityproxy.api, {
            read: 'api/citieslist/' + newValue
        });
        citiescombo.getStore().load();
    },
    
    createTcp: function(grid, record) {

        var create = Ext.create('TCPContable.view.tcp.TcpForm'),
            firstField = Ext.getCmp('tcpFormCompany');

        create.setTitle('Nuevo TCP');
        create.show();
        firstField.focus();
    },
    
    updateTcp: function(grid, record) {

        var grid   = this.getTcpgrid();
        var record = grid.getSelectionModel().getSelection()[0];
        var id_tcp = record.get('id');

        var update     = Ext.create('TCPContable.view.tcp.TcpForm'),
            firstField = Ext.getCmp('tcpFormCompany');

        update.setTitle('Modificar TCP');
        update.show();
        firstField.focus();

        if (id_tcp != null || id_tcp != '') {

            var UpdateForm = update.down('form');
            UpdateForm.loadRecord(record);
        }
    },

    saveTcp: function(button) {

        var win         = button.up('window'),
            form        = win.down('form'),
            values      = form.getValues(),
            store       = this.getTcpStore(),
            tcpcombo    = this.getTcpcombo(),
            obligations = values.obligations.toString();
        
        if (form.isValid()) {
            if (values.id > 0) {

                // UPDATE
                form.getForm().submit({
                    method: 'POST',
                    url: 'api/updateTcp',
                    waitTitle: 'Espere',
                    waitMsg: 'Modificando TCP...',
                    params: {
                        str_obligations: obligations
                    },
                    success: function(form, action) {
                        var response = Ext.decode(action.response.responseText);
                        win.close();
                        store.load();
                        tcpcombo.getStore().load();
                        // define a template to use for the detail view
                        var bookTplMarkup = [
                            '<div class="details-info"><div class="details-left"><strong>Empresa</strong>: ' + response.tcp.company + '</br>',
                            '<strong>Nombre</strong>: ' + response.tcp.name + '<br/>',
                            '<strong>Apellidos</strong>: ' + response.tcp.last_name + '<br/>',
                            '<strong>No. Identidad</strong>: ' + response.tcp.ci + '<br/>',
                            '<strong>Direcci\xF3n</strong>: ' + response.tcp.address + '<br/>',
                            '<strong>Tel\xE9fono</strong>: ' + response.tcp.telephone + '<br/>',
                            '<strong>Correo</strong>: ' + response.tcp.email + '</div>',
                            '<div class="details-right"><strong>Obligaciones</strong>:</br> ' + response.tcp.html_obligations + '</div></div>'
                        ];
                        var bookTpl = Ext.create('Ext.Template', bookTplMarkup);
                        var detailPanel = Ext.getCmp('detailPanel');
                        detailPanel.update(bookTpl);
                    },
                    failure: function(form, action) {
                        Ext.MessageBox.show({
                            title: 'Mensaje del Sistema',
                            msg: 'Ha ocurrido un error en la operaci\xF3n. Por favor, compruebe que sean v\xE1lidos todos sus datos, de continuar el problema consulte al Administrador del Sistema.',
                            icon: Ext.MessageBox.ERROR,
                            buttons: Ext.Msg.OK
                        });
                    }
                });
            }
            else {

                // CREATE
                form.getForm().submit({
                    method: 'POST',
                    url: 'api/createTcp',
                    waitTitle: 'Espere',
                    waitMsg: 'Creando TCP...',
                    params: {
                        str_obligations: obligations
                    },
                    success: function() {
                        win.close();
                        store.load();
                        tcpcombo.getStore().load();
                    },
                    failure: function(form, action) {
                        Ext.MessageBox.show({
                            title: 'Mensaje del Sistema',
                            msg: 'Ha ocurrido un error en la operaci\xF3n. Por favor, compruebe que sean v\xE1lidos todos sus datos, de continuar el problema consulte al Administrador del Sistema.',
                            icon: Ext.MessageBox.ERROR,
                            buttons: Ext.Msg.OK
                        });
                    }
                });
            }
        }
    },

    deleteTcp: function() {

        var grid   = this.getTcpgrid();
        var record = grid.getSelectionModel().getSelection()[0];
        var id     = record.get('id');
        var store  = this.getTcpStore();

        Ext.Msg.confirm("Eliminar TCP", "Este TCP  ser\xE1 eliminado definitivamente. Confirma que desea realizar esta operaci\xF3n?", function(btnText) {
            
            if (btnText === "yes") {
                Ext.Ajax.request({ 
                    url: 'api/deleteTcp',
                    method: 'POST',
                    waitTitle: 'Espere',
                    waitMsg: 'Eliminando TCP..',
                    params: {id: id},
                    success: function() {
                        store.load();
                        // define a template to use for the detail view
                        var bookTplMarkup = [
                            '<p class="details-info">Por favor, haga clic en un rengl\xF3n del Registro para ver los datos adicionales del TCP Titular de la Empresa.</p>'
                        ];
                        var bookTpl = Ext.create('Ext.Template', bookTplMarkup);
                        var detailPanel = Ext.getCmp('detailPanel');
                        detailPanel.update(bookTpl);
                    },
                    failure: function() {
                        Ext.MessageBox.show({
                            title: 'Mensaje del Sistema',
                            msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operacion, de continuar el problema consulte al Administrador del Sistema.',
                            buttons: Ext.MessageBox.OK,
                            icon: Ext.MessageBox.ERROR
                        });
                    }
                });
            }
        }, this);
    }
})