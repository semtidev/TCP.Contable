Ext.define('TCPContable.controller.States', {
    extend: 'Ext.app.Controller',
    models: ['Stateresult', 'Statesituation'],
    stores: ['Stateresult', 'Statesituation'],
    views: [
        'models.StatesTab',
        'models.StateResultGrid',
        'models.StateSituationGrid',
        'app.Yearcombo'
    ],
    refs: [
        {
            ref: 'statestab',
            selector: 'statestab'
        },
        {
            ref: 'stateresultgrid',
            selector: 'stateresultgrid'
        },
        {
            ref: 'statesituationgrid',
            selector: 'statesituationgrid'
        },
        {
            ref: 'yearcombo',
            selector: 'yearcombo'
        }
    ],
    init: function() {

        this.control({
            'stateresultgrid': {
                recordedit: this.updateResultStatesEntriesTax
            },
            'statesituationgrid': {
                recordedit: this.updateSituationStatesCell
            },
            'statestab combobox[action=stateschangeyear]': {
                change: this.reloadStatesYear
            },
            'statestab button[action=reload]': {
                click: this.reloadStates
            },
            'statestab button[action=pdf]': {
                click: this.pdfStates
            }
        });
    },
    
    reloadStatesYear: function(combo, newValue, oldValue, eOpts) {
        
        var resultgrid    = this.getStateresultgrid(),
            situationgrid = this.getStatesituationgrid(),
            year          = parseInt(newValue);
        
        localStorage.setItem('year', year);

        // Load Result Store
        var resultproxy = resultgrid.getStore().getProxy();
        Ext.apply(resultproxy.api, {
            read: 'api/resultstate/' + localStorage.getItem('tcp') + '/' + year
        });
        resultgrid.getStore().load();

        // Load Situation Store
        var situationproxy = situationgrid.getStore().getProxy();
        Ext.apply(situationproxy.api, {
            read: 'api/situationstate/' + localStorage.getItem('tcp') + '/' + year
        });
        situationgrid.getStore().load();
    },

    reloadStates: function() {

        var resultgrid    = this.getStateresultgrid(),
            situationgrid = this.getStatesituationgrid();

        // Load Result Store
        var resultproxy = resultgrid.getStore().getProxy();
        Ext.apply(resultproxy.api, {
            read: 'api/resultstate/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('year')
        });
        resultgrid.getStore().load();

        // Load Situation Store
        var situationproxy = situationgrid.getStore().getProxy();
        Ext.apply(situationproxy.api, {
            read: 'api/situationstate/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('year')
        });
        situationgrid.getStore().load();
    },

    updateResultStatesEntriesTax: function(record) {

        var resultgrid = this.getStateresultgrid()
            entries    = record.get('total'),
            year       = localStorage.getItem('year'),
            tcp        = localStorage.getItem('tcp');

        // Update TCP Entries Tax
        Ext.Ajax.request({
            url: 'api/updateStatesCell',
            method: 'POST',
            params: {
                tcp: tcp, 
                year: year, 
                model: 'states',
                key: 'tax_entries',
                value: entries
            },
            success: function(result, request) {
                var jsonData = Ext.JSON.decode(result.responseText);
                if (jsonData.failure) {
                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: jsonData.message,
                        buttons: Ext.MessageBox.OK,
                        icon: Ext.MessageBox.ERROR
                    });
                }
                else {
                    resultgrid.getStore().load();
                }
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
    },

    updateSituationStatesCell: function(record) {

        var resultgrid = this.getStatesituationgrid(),
            item       = record.get('id'),
            value      = record.get('subtotal'),
            year       = localStorage.getItem('year'),
            tcp        = localStorage.getItem('tcp'),
            key        = '';
        
        switch (item) {
            case 4:
                key = 'cash_bank';
                break;
            case 5:
                key = 'acc_receiv';
                break;
            case 13:
                key = 'bank_oblig_short';
                break;
            case 15:
                key = 'bank_oblig_long';
                break;
            case 19:
                key = 'plus_contribution';
                break;
            case 20:
                key = 'other_expenses';
                break;
            default:
                console.log('Sorry, we are out of ' + item + '.');
        }
        
        // Update Situation State Cell
        Ext.Ajax.request({
            url: 'api/updateStatesCell',
            method: 'POST',
            params: {
                tcp: tcp, 
                year: year, 
                model: 'states',
                key: key,
                value: value
            },
            success: function(result, request) {
                var jsonData = Ext.JSON.decode(result.responseText);
                if (jsonData.failure) {
                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: jsonData.message,
                        buttons: Ext.MessageBox.OK,
                        icon: Ext.MessageBox.ERROR
                    });
                }
                else {
                    resultgrid.getStore().load();
                }
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
    },

    pdfStates: function() {
        
        var resultgrid       = this.getStateresultgrid(),
            resultstore      = resultgrid.getStore(),
            situationgrid    = this.getStatesituationgrid(),
            situationstore   = situationgrid.getStore(),
            id_tcp           = localStorage.getItem('tcp'),
            year             = this.getYearcombo().getValue(),
            resultarr        = new Array(),
            resultdata       = "",
            resultrecords    = resultstore.getRange(),
            situationarr     = new Array(),
            situationdata    = "",
            situationrecords = situationstore.getRange();

        // Create Result Array 
        for (var i = 0; i < resultrecords.length; i++) {
            resultarr.push(resultrecords[i].data);
        }
        resultdata = Ext.JSON.encode(resultarr);
        
        // Create Situation Array
        for (var i = 0; i < situationrecords.length; i++) {
            situationarr.push(situationrecords[i].data);
        }
        situationdata = Ext.JSON.encode(situationarr);

        var formpdf = Ext.create('Ext.form.Panel', {items: [
                            { xtype: 'hiddenfield', name: 'id_tcp', value: id_tcp},
                            { xtype: 'hiddenfield', name: 'year', value: year},
                            { xtype: 'hiddenfield', name: 'resultdata', value: resultdata},
                            { xtype: 'hiddenfield', name: 'situationdata', value: situationdata}
                        ]});
        
        formpdf.getForm().doAction('standardsubmit',{
            url: 'api/pdfStates/',
            standardSubmit: true,
            scope: this,
            method: 'GET',
            waitTitle: 'Creando PDF...',
            waitMsg: 'Esta operaci\xF3n puede tardar unos minutos. Por favor, espere.',
            success: function(form, action) {
                formpdf.destroy();//or destroy();
            }
        });
        Ext.defer(function() {
            Ext.MessageBox.hide();
        }, 5000);

        /*formpdf.getForm().url = '/api/pdfStates/'; 
        formpdf.getForm().standardSubmit = true; 
        formpdf.getForm().method = 'POST'; 
        formpdf.getForm().submit();*/
    }
})