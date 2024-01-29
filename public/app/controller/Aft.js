Ext.define('TCPContable.controller.Aft', {
    extend: 'Ext.app.Controller',
    models: ['Aft', 'Aftgroupcombo'],
    stores: ['Aft', 'Aftgroupcombo'],
    views: [
        'process.AftGrid',
        'process.AftgroupCombo',
        'process.AftForm'
    ],
    refs: [
        {
            ref: 'aftgrid',
            selector: 'aftgrid'
        }
    ],
    init: function() {

        this.control({
            'aftgrid dataview': {
                itemdblclick: this.updateAft
            },
            'aftgrid button[action=reload]': {
                click: this.reloadAft
            },
            'aftgrid button[action=create]': {
                click: this.createAft
            },
            'aftgrid button[action=update]': {
                click: this.updateAft
            },
            'aftgrid button[action=delete]': {
                click: this.deleteAft
            },
            'aftform button[action=save]': {
                click: this.saveAft
            },
            'aftgrid button[action=pdf]': {
                click: this.pdfAft
            },
        });
    },
    
    reloadAft: function() {

        var grid  = this.getAftgrid(),
            proxy = grid.getStore().getProxy();
        
        Ext.apply(proxy.api, {
            read: 'api/aft/' + localStorage.getItem('tcp')
        });
        grid.getStore().load();
    },
    
    createAft: function(grid, record) {

        var create = Ext.create('TCPContable.view.process.AftForm'),
            firstField = Ext.getCmp('aftFormGroup');

        create.setTitle('Nuevo AFT');
        create.show();
        //firstField.focus();
    },
    
    updateAft: function(grid, record) {

        var grid   = this.getAftgrid();
        var record = grid.getSelectionModel().getSelection()[0];
        var id_aft = record.get('id');

        var update     = Ext.create('TCPContable.view.process.AftForm'),
            firstField = Ext.getCmp('aftFormGroup');

        update.setTitle('Modificar AFT');
        update.show();
        firstField.focus();

        if (id_aft != null || id_aft != '') {
            var UpdateForm = update.down('form');
            UpdateForm.loadRecord(record);
        }
    },

    saveAft: function(button) {

        var win         = button.up('window'),
            form        = win.down('form'),
            values      = form.getValues(),
            store       = this.getAftStore();
        
        if (form.isValid()) {
            if (values.id > 0) {

                // UPDATE
                form.getForm().submit({
                    method: 'POST',
                    url: 'api/updateAft',
                    waitTitle: 'Espere',
                    waitMsg: 'Modificando AFT...',
                    success: function(form, action) {
                        store.sync();
                        store.load();
                        win.close();
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
                    url: 'api/createAft',
                    waitTitle: 'Espere',
                    waitMsg: 'Creando Aft...',
                    success: function() {
                        store.sync();
                        store.load();
                        win.close();
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

    deleteAft: function() {

        var grid   = this.getAftgrid();
        var record = grid.getSelectionModel().getSelection()[0];
        var id     = record.get('id');
        var store  = this.getAftStore();

        Ext.Msg.confirm("Eliminar AFT", "Este AFT  ser\xE1 eliminado definitivamente. Confirma que desea realizar esta operaci\xF3n?", function(btnText) {
            
            if (btnText === "yes") {
                Ext.Ajax.request({ 
                    url: 'api/deleteAft',
                    method: 'POST',
                    waitTitle: 'Espere',
                    waitMsg: 'Eliminando AFT..',
                    params: {id: id},
                    success: function() {
                        store.sync();
                        store.load();
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
    },

    pdfAft: function() {

        document.location = 'api/pdfAft/' + localStorage.getItem('tcp');
    }
})