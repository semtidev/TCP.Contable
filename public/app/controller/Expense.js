Ext.define('TCPContable.controller.Expense', {
    extend: 'Ext.app.Controller',
    models: ['Expenseday', 'Expensemonth', 'Tax', 'Columns'],
    stores: ['Expenseday', 'Expensemonth', 'Tax', 'Columns'],
    views: [
        'process.ExpenseTab',
        'process.ExpensedayGrid',
        'process.ExpensemonthGrid',
        'process.TaxGrid',
        'app.Monthcombo',
        'app.Yearcombo',
        'process.ColumnsWindow',
        'process.ColumnsGrid'
    ],
    refs: [
        {
            ref: 'expensedaygrid',
            selector: 'expensedaygrid'
        },
        {
            ref: 'expensemonthgrid',
            selector: 'expensemonthgrid'
        },
        {
            ref: 'taxgrid',
            selector: 'taxgrid'
        },
        {
            ref: 'expensetab',
            selector: 'expensetab'
        },
        {
            ref: 'monthcombo',
            selector: 'monthcombo'
        },
        {
            ref: 'yearcombo',
            selector: 'yearcombo'
        },
        {
            ref: 'columnswindow',
            selector: 'columnswindow'
        },
        {
            ref: 'columnsgrid',
            selector: 'columnsgrid'
        }
    ],
    init: function() {

        this.control({
            'expensedaygrid': {
                recordedit: this.expenseUpdateGridElement,
                deleteclick: this.expenseHandleGridDeleteIconClick,
                itemmouseenter: this.showActions,
                itemmouseleave: this.hideActions
            },
            'columnsgrid': {
                recordedit: this.columnsUpdateGridElement,
                deleteclick: this.columnsHandleGridDeleteIconClick,
                itemmouseenter: this.showActions,
                itemmouseleave: this.hideActions
            },
            'taxgrid': {
                recordedit: this.taxUpdateGridElement
            },
            'expensetab button[action=reload]': {
                click: this.reloadExpense
            },
            'expensetab button[action=columns]': {
                click: this.columnsExpense
            },
            'expensetab combobox[action=expensechangemonth]': {
                change: this.reloadExpenseMonth
            },
            'expensetab combobox[action=expensechangeyear]': {
                change: this.reloadExpenseYear
            },
            'expensetab button[action=pdf]': {
                click: this.pdfExpenses
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

    columnsExpense: function() {

        var columnsStore = this.getColumnsStore();        
        if (columnsStore.isDestroyed) {
            Ext.create('TCPContable.store.Columns');
        }

        var columns = Ext.create('TCPContable.view.process.ColumnsWindow');
        columns.show();
    },
    
    columnsUpdateGridElement: function(record) {
        
        var columnsgrid = this.getColumnsgrid(),
            daygrid     = this.getExpensedaygrid(),
            tcpdb       = record.tcp,
            column      = record.column,
            newvalue    = record.newvalue,
            tcp         = localStorage.getItem('tcp');
        
        if (newvalue == '') { return; }
        
        if (tcpdb == '') {
            
            // Create Column
            Ext.Ajax.request({
                url: 'api/createExpensecolumn',
                method: 'POST',
                params: {
                    tcp: tcp, 
                    column: column, 
                    newvalue: newvalue
                },
                success: function(result, request) {
                    var jsonData = Ext.JSON.decode(result.responseText);
                    columnsgrid.getStore().load();
                    daygrid.columns.forEach( 
                        function(value) { 
                            if (value.dataIndex == jsonData.column) {
                                Ext.getCmp(jsonData.column).setText(jsonData.name);
                                localStorage.setItem(jsonData.column, jsonData.name);
                            }
                        }
                    );
                },
                failure: function() {

                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operaci\xF3n, de continuar el problema consulte al Administrador del Sistema.',
                        buttons: Ext.MessageBox.OK,
                        icon: Ext.MessageBox.ERROR
                    });
                }
            });
        }
        else {

            // Update Entry
            Ext.Ajax.request({
                url: 'api/updateExpensecolumn',
                method: 'POST',
                params: {
                    tcp: tcp, 
                    column: column, 
                    newvalue: newvalue
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
                        columnsgrid.getStore().load();
                        daygrid.columns.forEach( 
                            function(value) { 
                                if (value.dataIndex == jsonData.column) {
                                    Ext.getCmp(jsonData.column).setText(jsonData.name);
                                    localStorage.setItem(jsonData.column, jsonData.name);
                                }
                            }
                        );
                    }
                },
                failure: function() {

                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operaci\xF3n, de continuar el problema consulte al Administrador del Sistema.',
                        buttons: Ext.MessageBox.OK,
                        icon: Ext.MessageBox.ERROR
                    });
                }
            });
        }
    },
    
    expenseUpdateGridElement: function(record) {
        
        var daygrid       = this.getExpensedaygrid(),
            monthgrid     = this.getExpensemonthgrid(),
            id            = record.id,
            day           = record.day, 
            field         = record.field, 
            newvalue      = record.newvalue,
            month         = localStorage.getItem('month'),
            year          = localStorage.getItem('year'),
            tcp           = localStorage.getItem('tcp');
        
        if (newvalue == '') { return; }
        
        if (id == '') {

            // Create Entry
            Ext.Ajax.request({
                url: 'api/createExpense',
                method: 'POST',
                params: {
                    tcp: tcp, 
                    day: day, 
                    month: month, 
                    year: year, 
                    field: field, 
                    newvalue: newvalue
                },
                success: function(result, request) {
                    daygrid.getStore().load();
                    monthgrid.getStore().load();
                },
                failure: function() {

                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operaci\xF3n, de continuar el problema consulte al Administrador del Sistema.',
                        buttons: Ext.MessageBox.OK,
                        icon: Ext.MessageBox.ERROR
                    });
                }
            });
        }
        else {

            // Update Entry
            Ext.Ajax.request({
                url: 'api/updateExpense',
                method: 'POST',
                params: {
                    id: id,
                    tcp: tcp, 
                    day: day, 
                    month: month, 
                    year: year, 
                    field: field, 
                    newvalue: newvalue
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
                        daygrid.getStore().load();
                        monthgrid.getStore().load();
                    }
                },
                failure: function() {

                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operaci\xF3n, de continuar el problema consulte al Administrador del Sistema.',
                        buttons: Ext.MessageBox.OK,
                        icon: Ext.MessageBox.ERROR
                    });
                }
            });
        }
    },

    taxUpdateGridElement: function(record) {
        
        var taxgrid       = this.getTaxgrid(),
            id            = record.id,
            field         = record.field, 
            newvalue      = record.newvalue,
            month_num     = record.month_num,
            year          = record.year,
            tcp           = localStorage.getItem('tcp');
        
        if (newvalue == '' || newvalue == 0) { return; }
            
        if (id == '') {

            // Create Tax
            Ext.Ajax.request({
                url: 'api/createTax',
                method: 'POST',
                params: {
                    tcp: tcp, 
                    month_num: month_num, 
                    year: year, 
                    field: field, 
                    newvalue: newvalue
                },
                success: function(result, request) {
                    taxgrid.getStore().load();
                },
                failure: function() {

                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operaci\xF3n, de continuar el problema consulte al Administrador del Sistema.',
                        buttons: Ext.MessageBox.OK,
                        icon: Ext.MessageBox.ERROR
                    });
                }
            });
        }
        else {

            // Update Tax
            Ext.Ajax.request({
                url: 'api/updateTax',
                method: 'POST',
                params: {
                    id: id,
                    tcp: tcp, 
                    month_num: month_num, 
                    year: year, 
                    field: field, 
                    newvalue: newvalue
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
                        taxgrid.getStore().load();
                    }
                },
                failure: function() {

                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operaci\xF3n, de continuar el problema consulte al Administrador del Sistema.',
                        buttons: Ext.MessageBox.OK,
                        icon: Ext.MessageBox.ERROR
                    });
                }
            });
        }
    },

    columnsHandleGridDeleteIconClick: function(view, rowIndex, colIndex, column, e) {

        var grid  = this.getColumnsgrid(),
            value = grid.getStore().getAt(rowIndex).get('value');
        
        if (value == '') { return; }
        this.columnsDeleteElementGrid(grid.getStore().getAt(rowIndex));
    },
    columnsDeleteElementGrid: function(record, successCallback) {

        var grid   = this.getColumnsgrid(),
            tcp    = record.get('tcp'),
            column = record.get('column');

        Ext.Msg.show({
            title: 'Confirmaci\xF3n',
            msg: 'Se Eliminar\xE1 el nombre de esta columna. Confirma que desea realizar esta operaci\xF3n?',
            buttons: Ext.Msg.YESNO,
            icon: Ext.MessageBox.WARNING,
            fn: function(response) {
                if (response === 'yes') {

                    Ext.Ajax.request({

                        url: 'api/destroyExpensecolumn',
                        method: 'POST',
                        params: {tcp: tcp, column: column},
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
                                localStorage.setItem(jsonData.column, '');
                                Ext.getCmp(jsonData.column).setText(jsonData.name);
                                grid.getStore().load();
                            }
                        },
                        failure: function() {

                            Ext.MessageBox.show({
                                title: 'Mensaje del Sistema',
                                msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operaci\xF3n, de continuar el problema consulte al Administrador del Sistema.',
                                buttons: Ext.MessageBox.OK,
                                icon: Ext.MessageBox.ERROR
                            });
                        }
                    });
                }
            }
        });
    },
    
    expenseHandleGridDeleteIconClick: function(view, rowIndex, colIndex, column, e) {

        var grid = this.getExpensedaygrid(),
            id   = grid.getStore().getAt(rowIndex).get('id');
        
        if (id == '') { return; }
        this.expenseDeleteElementGrid(grid.getStore().getAt(rowIndex));
    },
    expenseDeleteElementGrid: function(record, successCallback) {

        var grid = this.getExpensedaygrid(),
            id   = record.get('id');

        Ext.Msg.show({
            title: 'Confirmaci\xF3n',
            msg: 'Se Eliminar\xE1n los Gastos de este d\xEDa del sistema. Confirma que desea realizar esta operaci\xF3n?',
            buttons: Ext.Msg.YESNO,
            icon: Ext.MessageBox.WARNING,
            fn: function(response) {
                if (response === 'yes') {

                    Ext.Ajax.request({

                        url: 'api/deleteExpense',
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
                                msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operaci\xF3n, de continuar el problema consulte al Administrador del Sistema.',
                                buttons: Ext.MessageBox.OK,
                                icon: Ext.MessageBox.ERROR
                            });
                        }
                    });
                }
            }
        });
    },
    
    reloadExpense: function() {

        var daygrid   = this.getExpensedaygrid(),
            monthgrid = this.getExpensemonthgrid(),
            taxgrid   = this.getTaxgrid();

        // Load Day Store
        var dayproxy = daygrid.getStore().getProxy();
        Ext.apply(dayproxy.api, {
            read: 'api/expenseday/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
        });
        daygrid.getStore().load();

        // Load Month Store
        var monthproxy = monthgrid.getStore().getProxy();
        Ext.apply(monthproxy.api, {
            read: 'api/expensemonth/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('year')
        });
        monthgrid.getStore().load();

        // Load Tax Store
        var taxproxy = taxgrid.getStore().getProxy();
        Ext.apply(taxproxy.api, {
            read: 'api/taxmonthly/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('year')
        });
        taxgrid.getStore().load();
    },

    reloadExpenseMonth: function(combo, newValue, oldValue, eOpts) {
        
        var grid  = this.getExpensedaygrid(),
            month = newValue; //parseInt(newValue);
        
        localStorage.setItem('month', month);
        // Load Store
        var proxy = grid.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/expenseday/' + localStorage.getItem('tcp') + '/' + month + '/' + localStorage.getItem('year')
        });
        grid.getStore().load();
    },

    reloadExpenseYear: function(combo, newValue, oldValue, eOpts) {
        
        var daygrid    = this.getExpensedaygrid(),
            monthgrid  = this.getExpensemonthgrid(),
            taxgrid    = this.getTaxgrid(),
            month      = localStorage.getItem('month'),
            year       = parseInt(newValue);
        
        //alert(year);
        localStorage.setItem('year', year);

        // Load Day Store
        var dayproxy = daygrid.getStore().getProxy();
        Ext.apply(dayproxy.api, {
            read: 'api/expenseday/' + localStorage.getItem('tcp') + '/' + month + '/' + year
        });
        daygrid.getStore().load();

        // Load Month Store
        var monthproxy = monthgrid.getStore().getProxy();
        Ext.apply(monthproxy.api, {
            read: 'api/expensemonth/' + localStorage.getItem('tcp') + '/' + year
        });
        monthgrid.getStore().load();

        // Load Tax Store
        var taxproxy = taxgrid.getStore().getProxy();
        Ext.apply(taxproxy.api, {
            read: 'api/taxmonthly/' + localStorage.getItem('tcp') + '/' + year
        });
        taxgrid.getStore().load();
    },
        
    pdfExpenses: function() {
        
        var year   = this.getYearcombo().getValue();
        document.location = 'api/pdfExpense/' + localStorage.getItem('tcp') + '/' + year;
    }
})