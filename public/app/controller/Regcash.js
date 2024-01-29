Ext.define('TCPContable.controller.Regcash', {
    extend: 'Ext.app.Controller',
    models: ['Regcashbox'],
    stores: ['Regcashbox'],
    views: [
        'models.RegCashboxGrid',
        'models.RegCashboxForm',
        'app.Monthcombo',
        'app.Yearcombo'
    ],
    refs: [
        {
            ref: 'regcashboxgrid',
            selector: 'regcashboxgrid'
        },
        {
            ref: 'regcashboxform',
            selector: 'regcashboxform'
        },
        {
            ref: 'monthcombo',
            selector: 'monthcombo'
        },
        {
            ref: 'yearcombo',
            selector: 'yearcombo'
        }
    ],
    init: function() {

        this.control({
            'regcashboxgrid': {
                recordedit: this.updateRegcashCell
            },
            'regcashboxgrid button[action=reload]': {
                click: this.reloadRegcashGrid
            },
            'regcashboxgrid button[action=saldbegin]': {
                click: this.saldForm
            },
            'regcashboxform button[action=store]': {
                click: this.saldStore
            },
            'regcashboxgrid combobox[action=regcashchangemonth]': {
                change: this.reloadRegcashMonth
            },
            'regcashboxgrid combobox[action=regcashchangeyear]': {
                change: this.reloadRegcashYear
            },
            'regcashboxgrid button[action=pdf]': {
                click: this.pdfRegcash
            }
        });
    },

    saldForm: function(){

        var saldForm = Ext.create('TCPContable.view.models.RegCashboxForm');
        if (localStorage.getItem('tcp_cashbox_datestart') != null && localStorage.getItem('tcp_cashbox_datestart') != ''){
            Ext.getCmp('dateRegcashForm').setValue(localStorage.getItem('tcp_cashbox_datestart'));
        }
        if (localStorage.getItem('tcp_cashbox_saldstart') != null && localStorage.getItem('tcp_cashbox_saldstart') != ''){
            Ext.getCmp('saldRegcashForm').setValue(localStorage.getItem('tcp_cashbox_saldstart'));
        }
        saldForm.show();
    },

    saldStore: function(button) {

        var grid = this.getRegcashboxgrid(),
            win  = button.up('window'),
            form = win.down('form'),
            tcp  = localStorage.getItem('tcp');

        if (form.isValid()) {

            form.getForm().submit({
                method: 'POST',
                url: 'api/regcash/saldstart',
                params: {tcp : tcp},
                waitTitle: 'Espere', //Titulo del mensaje de espera
                waitMsg: 'Procesando datos...', //Mensaje de espera
                success: function(form, action) {
                    var data = Ext.decode(action.response.responseText);
                    localStorage.setItem('tcp_cashbox_datestart', data.date_start);
                    localStorage.setItem('tcp_cashbox_saldstart', data.sald);
                    win.close();
                    grid.getStore().load();
                },
                failure: function(form, action) {
                    var data = Ext.decode(action.response.responseText);
                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: data.message,
                        icon: 'icon-MessageBox-error',
                        buttons: Ext.Msg.OK
                    });
                }
            });
        }
    },

    reloadRegcashGrid: function() {

        var grid  = this.getRegcashboxgrid();

        // Load Day Store
        var proxy = grid.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/regcash/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
        });
        grid.getStore().load();
    },

    reloadRegcashMonth: function(combo, newValue, oldValue, eOpts) {
        
        var grid  = this.getRegcashboxgrid(),
            month = newValue; //parseInt(newValue);
        
        localStorage.setItem('month', month);
        // Load Store
        var proxy = grid.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/regcash/' + localStorage.getItem('tcp') + '/' + month + '/' + localStorage.getItem('year')
        });
        grid.getStore().load();
    },

    reloadRegcashYear: function(combo, newValue, oldValue, eOpts) {
        
        var grid  = this.getRegcashboxgrid(),
            month = localStorage.getItem('month'),
            year  = parseInt(newValue);
        
        localStorage.setItem('year', year);

        // Load Day Store
        var proxy = grid.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/regcash/' + localStorage.getItem('tcp') + '/' + month + '/' + year
        });
        grid.getStore().load();
    },
    
    updateRegcashCell: function(record) {

        var grid  = this.getRegcashboxgrid(),
            value = record.get('bank_deposit'),
            day   = record.get('day'),
            month = localStorage.getItem('month'),
            year  = localStorage.getItem('year'),
            tcp   = localStorage.getItem('tcp'),
            date  = '';

        if (day < 10) { day = '0' + day; }
        if (month < 10) { month = '0' + month; }
        date = year + '-' + month + '-' + day;
                
        // Update Situation State Cell
        Ext.Ajax.request({
            url: 'api/updateRegcashCell',
            method: 'POST',
            params: {
                tcp: tcp,
                date: date,
                year: year,
                model: 'regcash',
                key: 'bank_deposit',
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
                    grid.getStore().load();
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
    
    pdfRegcash: function() {
        
        var grid    = this.getRegcashboxgrid(),
            id_tcp  = localStorage.getItem('tcp'),
            month   = this.getMonthcombo().getValue(),
            year    = this.getYearcombo().getValue();

        /*// Create Array 
        for (var i = 0; i < records.length; i++) {
            //console.log(records[i].data);
            arr.push(records[i].data);
        }

        var saveData = Array(); //Declaro el arreglo
        saveData[0] = 2;
        saveData[1] = 1;

        var jObject={};
        for(i in saveData)
        {
            jObject[i] = saveData[i];
        }

        //data = Ext.JSON.encode(arr);
        data = arr.serialize();
        //data = JSON.stringify(data);

        $('<form action="/api/pdfRegcash" method="post"><input type="hidden" name="data" value="'+data+'"></form>').appendTo('body').submit();

        //console.log(data);
        //document.body.innerHTML += '<form id="dynForm" action="/api/pdfRegcash" method="post"><input type="hidden" name="data" value="'+data+'"></form>';
        //document.getElementById("dynForm").submit();*/

        var formpdf = Ext.create('Ext.form.Panel', {items: [
                            { xtype: 'hiddenfield', name: 'id_tcp', value: id_tcp},
                            { xtype: 'hiddenfield', name: 'month', value: month},
                            { xtype: 'hiddenfield', name: 'year', value: year}
                        ]});
        
        formpdf.getForm().doAction('standardsubmit',{
            url: 'api/pdfRegcash/',
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
    }

})