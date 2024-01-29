Ext.define('TCPContable.controller.Entry', {
    extend: 'Ext.app.Controller',
    models: ['Entryday', 'Entrymonth'],
    stores: ['Entryday', 'Entrymonth'],
    views: [
        'process.EntryTab',
        'process.EntrydayGrid',
        'process.EntrymonthGrid',
        'app.Monthcombo',
        'app.Yearcombo'
    ],
    refs: [
        {
            ref: 'entrydaygrid',
            selector: 'entrydaygrid'
        },
        {
            ref: 'entrymonthgrid',
            selector: 'entrymonthgrid'
        },
        {
            ref: 'entrytab',
            selector: 'entrytab'
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
            'entrydaygrid': {
                recordedit: this.entryUpdateGridElement,
                deleteclick: this.entryHandleGridDeleteIconClick,
                itemmouseenter: this.showActions,
                itemmouseleave: this.hideActions
            },
            'entrytab button[action=reload]': {
                click: this.reloadEntry
            },
            'entrytab combobox[action=entrychangemonth]': {
                change: this.reloadEntryMonth
            },
            'entrytab combobox[action=entrychangeyear]': {
                change: this.reloadEntryYear
            },
            'entrytab button[action=pdf]': {
                click: this.pdfEntries
            }
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

    entryUpdateGridElement: function(record) {

        var daygrid   = this.getEntrydaygrid(),
            monthgrid = this.getEntrymonthgrid()
            id        = record.get('id'),
            cash_box  = record.get('cash_box'),
            cash_ncei = record.get('cash_ncei'),
            detail    = record.get('detail'),
            day       = record.get('day'),
            month     = localStorage.getItem('month'),
            year      = localStorage.getItem('year'),
            tcp       = localStorage.getItem('tcp');
        
        if (id == '') {
            
            // Create Entry
            Ext.Ajax.request({
                url: 'api/createEntry',
                method: 'POST',
                params: {tcp: tcp, day: day, month: month, year: year, cash_box: cash_box, cash_ncei: cash_ncei, detail: detail},
                success: function(result, request) {
                    daygrid.getStore().load();
                    monthgrid.getStore().load();
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
        else {

            // Update Entry
            Ext.Ajax.request({
                url: 'api/updateEntry',
                method: 'POST',
                params: {id: id, tcp: tcp, day: day, month: month, year: year, cash_box: cash_box, cash_ncei: cash_ncei, detail: detail},
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
                        daygrid.getStore().load();
                        monthgrid.getStore().load();
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

    entryHandleGridDeleteIconClick: function(view, rowIndex, colIndex, column, e) {

        var grid = this.getEntrydaygrid()
            id   = grid.getStore().getAt(rowIndex).get('id');
        
        if (id == '') { return; }
        this.entryDeleteElementGrid(grid.getStore().getAt(rowIndex));
    },
    
    entryDeleteElementGrid: function(record, successCallback) {

        var grid = this.getEntrydaygrid(),
            id   = record.get('id');

        Ext.Msg.show({
            title: 'Confirmaci\xF3n',
            msg: 'Se Eliminar\xE1n los Ingresos de este d\xEDa del sistema. Confirma que desea realizar esta operaci\xF3n?',
            buttons: Ext.Msg.YESNO,
            icon: Ext.MessageBox.WARNING,
            fn: function(response) {
                if (response === 'yes') {

                    Ext.Ajax.request({

                        url: 'api/deleteEntry',
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
    
    reloadEntry: function() {

        var daygrid  = this.getEntrydaygrid(),
            monthgrid = this.getEntrymonthgrid();

        // Load Day Store
        var dayproxy = daygrid.getStore().getProxy();
        Ext.apply(dayproxy.api, {
            read: 'api/entryday/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
        });
        daygrid.getStore().load();

        // Load Month Store
        var monthproxy = monthgrid.getStore().getProxy();
        Ext.apply(monthproxy.api, {
            read: 'api/entrymonth/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('year')
        });
        monthgrid.getStore().load();
    },

    reloadEntryMonth: function(combo, newValue, oldValue, eOpts) {
        
        var grid  = this.getEntrydaygrid(),
            month = newValue; //parseInt(newValue);
        
        localStorage.setItem('month', month);
        // Load Store
        var proxy = grid.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/entryday/' + localStorage.getItem('tcp') + '/' + month + '/' + localStorage.getItem('year')
        });
        grid.getStore().load();
    },

    reloadEntryYear: function(combo, newValue, oldValue, eOpts) {
        
        var daygrid    = this.getEntrydaygrid(),
            monthgrid  = this.getEntrymonthgrid(),
            month      = localStorage.getItem('month'),
            year       = parseInt(newValue);
        
        localStorage.setItem('year', year);

        // Load Day Store
        var dayproxy = daygrid.getStore().getProxy();
        Ext.apply(dayproxy.api, {
            read: 'api/entryday/' + localStorage.getItem('tcp') + '/' + month + '/' + year
        });
        daygrid.getStore().load();

        // Load Month Store
        var monthproxy = monthgrid.getStore().getProxy();
        Ext.apply(monthproxy.api, {
            read: 'api/entrymonth/' + localStorage.getItem('tcp') + '/' + year
        });
        monthgrid.getStore().load();
    },
    
    
    pdfEntries: function() {
        
        var year   = this.getYearcombo().getValue();
        document.location = 'api/pdfEntry/' + localStorage.getItem('tcp') + '/' + year;
    }
})