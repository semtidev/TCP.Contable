Ext.define('TCPContable.view.process.EntrymonthGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'entrymonthgrid',
    id: 'entrymonthgrid',
    store: 'Entrymonth',
    viewConfig: {
		columnLines: true
    },
    initComponent: function() {
        this.columns = {
            defaults: {
                draggable: false,
                resizable: false,
                hideable: false,
                sortable: false
            },
            items: [
                {
                    text: 'MESES',
                    dataIndex: 'month',
                    flex: 1
                }, {
                    text: 'D\xC9BITOS',
                    columns: [{
                        text: 'EFECTIVO EN CAJA',
                        dataIndex: 'cash_box',
                        align: 'right',
                        flex: 1
                    }]
                }, {
                    text: 'CR\xC9DITOS',
                    columns: [{
                        text: 'SUBCUENTAS DE INGRESOS',
                        columns: [{
                            text: 'Ingresos NCEI',
                            dataIndex: 'cash_ncei',
                            align: 'right',
                            flex: 1
                        }, {
                            text: 'Ingresos Obtenidos',
                            dataIndex: 'entry',
                            align: 'right',
                            flex: 1
                        }]
                    }, {
                        text: 'TOTAL INGRESOS',
                        dataIndex: 'totalentry',
                        align: 'right',
                        flex: 1
                    }]
                }
            ]
        };

        this.callParent(arguments);

        // Load Store
        var proxy = this.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/entrymonth/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('year')
        });
        this.getStore().load();
    }
});