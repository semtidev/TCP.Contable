Ext.define('TCPContable.controller.Sublargest', {
    extend: 'Ext.app.Controller',
    models: ['Sublargest'],
    stores: ['Sublargest'],
    views: [
        'models.SubLargestGrid',
        'models.SubLargestForm',
        'app.Monthcombo',
        'app.Yearcombo'
    ],
    refs: [
        {
            ref: 'sublargestgrid',
            selector: 'sublargestgrid'
        },
        {
            ref: 'sublargestform',
            selector: 'sublargestform'
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
            'sublargestgrid': {
                recordedit: this.updateSublargestNewRow,
                itemmouseenter: this.showActions,
                itemmouseleave: this.hideActions,
                deleteclick: this.sublargestHandleGridDeleteIconClick
            },
            'sublargestgrid button[action=reload]': {
                click: this.reloadSublargestGrid
            },
            'sublargestgrid button[action=addBankOperation]': {
                click: this.addBankOperation
            },
            'sublargestgrid combobox[action=sublargestchangeaccount]': {
                change: this.reloadSublargestAccount
            },
            'sublargestgrid combobox[action=sublargestchangemonth]': {
                change: this.reloadSublargestMonth
            },
            'sublargestgrid combobox[action=sublargestchangeyear]': {
                change: this.reloadSublargestYear
            },
            'sublargestgrid button[action=pdf]': {
                click: this.pdfSublargest
            }/*,
            'sublargestgrid menu[lid=menuSublargestRange] menuitem[lid=sublargestPdfRange]': {
                click: this.rangeForm
            },
            'sublargestform button[action=pdf]': {
                click: this.pdfRangeSublargest
            }*/
        });
    },

    showActions: function(view, task, node, rowIndex, e) {

        var icons = Ext.DomQuery.select('.x-action-col-icon', node);
        Ext.each(icons, function(icon) {
            Ext.get(icon).removeCls('x-hidden');
        });
    },

    hideActions: function(view, task, node, rowIndex, e) {

        var icons = Ext.DomQuery.select('.x-action-col-icon', node);
        Ext.each(icons, function(icon) {
            Ext.get(icon).addCls('x-hidden');
        });
    },

    rangeForm: function(){

        var rangeForm = Ext.create('TCPContable.view.models.SubLargestForm'),
            account   = Ext.getCmp('account').getValue(),
            id_tcp    = localStorage.getItem('tcp');
        
        Ext.getCmp('SLForm_id_tcp').setValue(id_tcp);
        Ext.getCmp('SLForm_account').setValue(account);

        if (localStorage.getItem('tcp_cashbox_datestart') && localStorage.getItem('tcp_cashbox_datestart') != '') {
            
            var cash_datestart = localStorage.getItem('tcp_cashbox_datestart').split('/'),
                strdate = '1/' + parseInt(cash_datestart[1]) + '/' + parseInt(cash_datestart[2]);
                datejs = new Date(strdate);
                //datejs.setDate(datejs.getDate() - 1);
            Ext.getCmp('slf_datestart').setMinValue(datejs);
            Ext.getCmp('slf_datend').setMinValue(datejs);
        }
        rangeForm.show();
    },
    
    addBankOperation: function(button) {

        var grid  = this.getSublargestgrid(),
            month = localStorage.getItem('month');
        if (grid.getStore().count() == 0) {
            // Create a model instance
            var rec = new TCPContable.model.Sublargest({
                id: null,
                id_db: '',
                day: '01',
                month: month,
                code: 'CO',
                number: '1',
                desc: 'Saldo al Inicio del Mes',
                debit: '',
                credit: '',
                sald: ''
            });
            grid.getStore().insert(0, rec);
            grid.plugins[0].startEditByPosition({
                row: 0,
                column: 7
            });
        }
        else {
            // Create a model instance
            var rec = new TCPContable.model.Sublargest({
                id: null,
                id_db: '',
                day: '01',
                month: month,
                code: 'CO',
                number: '',
                desc: '',
                debit: '',
                credit: '',
                sald: ''
            });
            grid.getStore().insert(0, rec);
            grid.plugins[0].startEditByPosition({
                row: 0,
                column: 0
            });
        }
    },
    
    reloadSublargestGrid: function() {

        var grid  = this.getSublargestgrid();

        // Load Day Store
        var proxy = grid.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/sublargest/' + localStorage.getItem('tcp') + '/' + Ext.getCmp('account').getValue() + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
        });
        grid.getStore().load();
    },

    reloadSublargestAccount: function(combo, newValue, oldValue, eOpts) {
        
        var grid       = this.getSublargestgrid(),
            gridHeader = grid.getView().headerCt,
            column     = gridHeader.child("#bank_cash_action"),
            account    = newValue;
        
        if (newValue == '110') {
            Ext.getCmp('btnaddoperation').setVisible(true);
            column.setVisible(true);
        }
        else {
            Ext.getCmp('btnaddoperation').setVisible(false);
            column.setVisible(false);
        }

        // Load Store
        var proxy = grid.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/sublargest/' + localStorage.getItem('tcp') + '/' + account + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
        });
        grid.getStore().load();
    },

    reloadSublargestMonth: function(combo, newValue, oldValue, eOpts) {
        
        var grid  = this.getSublargestgrid(),
            month = newValue; //parseInt(newValue);
        
        localStorage.setItem('month', month);
        // Load Store
        var proxy = grid.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/sublargest/' + localStorage.getItem('tcp') + '/' + Ext.getCmp('account').getValue() + '/' + month + '/' + localStorage.getItem('year')
        });
        grid.getStore().load();
    },
    
    reloadSublargestYear: function(combo, newValue, oldValue, eOpts) {
        
        var grid  = this.getSublargestgrid(),
            month = localStorage.getItem('month'),
            year  = parseInt(newValue);
        
        localStorage.setItem('year', year);

        // Load Day Store
        var proxy = grid.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/sublargest/' + localStorage.getItem('tcp') + '/' + Ext.getCmp('account').getValue() + '/' + month + '/' + year
        });
        grid.getStore().load();
    },
    
    updateSublargestNewRow: function(e) {

        var grid   = this.getSublargestgrid(),
            id     = e.record.get('id_db'),
            day    = e.record.get('day'),
            month  = e.record.get('month'),
            desc   = e.record.get('desc'),
            credit = e.record.get('credit'),
            debit  = e.record.get('debit'),
            sald   = e.record.get('sald'),
            field  = e.field,
            tcp    = localStorage.getItem('tcp'),
            year   = localStorage.getItem('year');
        
        if (credit != '' && debit != '') {
            Ext.MessageBox.show({
                title: 'Mensaje del Sistema',
                msg: 'Ha introducido valores en las colunmas DEBE y HABER. Por favor, revice antes de continuar, recuerde que la operaci\xF3n solo puede DEBITAR o ACREDITAR su saldo.',
                buttons: Ext.MessageBox.OK,
                icon: Ext.MessageBox.ERROR
            });
            grid.getStore().load();
            return;
        }
        else if (desc != 'Saldo al Inicio del Mes' && field == 'sald') {
            Ext.MessageBox.show({
                title: 'Mensaje del Sistema',
                msg: 'El Saldo solo se debe introducir al inicio del mes, en el resto de las operaciones se calcula por el sistema.',
                buttons: Ext.MessageBox.OK,
                icon: Ext.MessageBox.ERROR
            });
            grid.getStore().load();
            return;
        }
        else {
            
            Ext.Ajax.request({
                url: 'api/updateCashBankAccount',
                method: 'POST',
                params: {
                    id: id,
                    tcp: tcp,
                    year: year,
                    day: day,
                    month: month,
                    desc: desc,
                    credit: credit,
                    debit: debit,
                    sald: sald,
                    field: field
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
        }
    },

    sublargestHandleGridDeleteIconClick: function(view, rowIndex, colIndex, column, e) {

        var grid = this.getSublargestgrid()
            id   = grid.getStore().getAt(rowIndex).get('id_db');
        
        if (id == '') { return; }
        this.sublargestDeleteElementGrid(grid.getStore().getAt(rowIndex));
    },
    
    sublargestDeleteElementGrid: function(record, successCallback) {

        var grid = this.getSublargestgrid(),
            id   = record.get('id_db');

        Ext.Msg.show({
            title: 'Confirmaci\xF3n',
            msg: 'Confirma que desea Eliminar esta Operaci\xF3n del Efectivo en Banco?',
            buttons: Ext.Msg.YESNO,
            icon: Ext.MessageBox.WARNING,
            fn: function(response) {
                if (response === 'yes') {

                    Ext.Ajax.request({
                        url: 'api/deleteOperationBankCash',
                        method: 'POST',
                        params: {id: id},
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
                }
            }
        });
    },
    
    pdfSublargest: function() {
        
        var account = Ext.getCmp('account').getValue(),
            id_tcp  = localStorage.getItem('tcp'),
            month   = this.getMonthcombo().getValue(),
            year    = this.getYearcombo().getValue();

        var formpdf = Ext.create('Ext.form.Panel', {items: [
                        { xtype: 'hiddenfield', name: 'id_tcp', value: id_tcp},
                        { xtype: 'hiddenfield', name: 'account', value: account},
                        { xtype: 'hiddenfield', name: 'month', value: month},
                        { xtype: 'hiddenfield', name: 'year', value: year}
                      ]});

        formpdf.getForm().doAction('standardsubmit',{
            url: 'api/pdfSublargest/',
            standardSubmit: true,
            scope: this,
            method: 'GET',
            waitTitle: 'Creando PDF...',
            waitMsg: 'Esta operaci\xF3n puede tardar unos minutos. Por favor, espere.',
            success: function(form, action) {
                formpdf.destroy();
            }
        });
        Ext.defer(function() {
            Ext.MessageBox.hide();
        }, 5000);
    },

    pdfRangeSublargest: function(button) {
        
        var win  = button.up('window'),
            form = win.down('form');

        if (form.isValid()) {

            form.getForm().doAction('standardsubmit',{
                url: 'api/pdfRangeSublargest/',
                standardSubmit: true,
                scope: this,
                method: 'GET',
                waitTitle: 'Creando PDF...',
                waitMsg: 'Esta operaci\xF3n puede tardar unos minutos. Por favor, espere.',
                success: function(form, action) {
                    win.close();
                }
            });
            Ext.defer(function() {
                Ext.MessageBox.hide();
            }, 5000);
        }
    }

})