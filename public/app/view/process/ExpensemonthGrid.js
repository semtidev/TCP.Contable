Ext.define('TCPContable.view.process.ExpensemonthGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'expensemonthgrid',
    id: 'expensemonthgrid',
    store: 'Expensemonth',
    viewConfig: {
		columnLines: true
    },
    initComponent: function() {
        this.columns = {
            defaults: {
                draggable: false,
                resizable: false,
                hideable: false,
                sortable: false,
                menuDisabled: true
            },
            items: [
                {
                    text: 'MESES',
                    dataIndex: 'month',
                    width: 150
                }, 
                {
                    text: 'SUBCUENTAS',
                    lockable: false,
                    menuDisabled: true,
                    columns: [
                        {
                            text: 'POSIBLES A DEDUCIR DENTRO DE LOS LIMITES DE GASTOS AUTORIZADOS',
                            lockable: false,
                            menuDisabled: true,
                            columns: [
                                {
                                    text: 'Materias Primas y Materiales',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'mp_materials',
                                    emptyCellText: '',
                                    width: 110
                                }, {
                                    text: 'Mercancias para la Venta',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'goods',
                                    width: 100
                                }, {
                                    text: 'Combustible',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'fuel',
                                    width: 100
                                }, {
                                    text: 'Energ\xEDa Ele\xE9ctrica',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'power',
                                    width: 100
                                }, {
                                    text: 'Salarios del personal contratado',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'salary',
                                    width: 100
                                }, {
                                    text: 'Columna-7',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col7',
                                    width: 100
                                }, {
                                    text: 'Columna-8',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col8',
                                    width: 100
                                }, {
                                    text: 'Columna-9',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col9',
                                    width: 100
                                }, {
                                    text: 'Columna-10',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col10',
                                    width: 100
                                }, {
                                    text: 'Columna-11',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col11',
                                    width: 100
                                }, {
                                    text: 'Columna-12',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col12',
                                    width: 100
                                }, {
                                    text: 'Otros Gastos',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'others',
                                    width: 100
                                }
                            ]
                        }                        
                    ]
                },
                {
                    text: 'TOTAL GASTOS AUTORIZADOS POSIBLES A DEDUCIR',
                    width: 125,
                    lockable: false,
                    align: 'right',
                    dataIndex: 'expense_pd',
                    menuDisabled: true
                },
                {
                    text: 'SUBCUENTAS',
                    lockable: false,
                    menuDisabled: true,
                    columns: [
                        {
                            text: 'DEDUCIBLE DIRECTAMENTE DE LA BASE IMPONIBLE',
                            lockable: false,
                            menuDisabled: true,
                            columns: [
                                {
                                    text: 'Arrendam. Bienes Estatales',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'lease_state',
                                    width: 110
                                }, {
                                    text: 'Columna-17',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col17',
                                    width: 100
                                }, {
                                    text: 'Columna-18',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col18',
                                    width: 100
                                }, {
                                    text: 'Columna-19',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col19',
                                    width: 100
                                }
                            ]
                        }                        
                    ]
                },
                {
                    text: 'TOTAL A DEDUCIR DE LA BASE IMPONIBLE',
                    width: 110,
                    lockable: false,
                    align: 'right',
                    dataIndex: 'expense_dbi',
                    menuDisabled: true
                },
                {
                    text: 'SUBCUENTAS',
                    lockable: false,
                    menuDisabled: true,
                    columns: [
                        {
                            text: 'Egresos de Impuestos NCEI por el MFP',
                            width: 110,
                            lockable: false,
                            align: 'right',
                            dataIndex: 'expenses_ncei',
                            menuDisabled: true
                        }                        
                    ]
                },
                {
                    text: 'TOTAL GASTOS DE OPERACION',
                    width: 110,
                    lockable: false,
                    align: 'right',
                    dataIndex: 'expense_ope',
                    menuDisabled: true
                },
                {
                    text: 'CREDITOS',
                    lockable: false,
                    menuDisabled: true,
                    columns: [
                        {
                            text: 'EFECTIVO EN CAJA',
                            width: 110,
                            lockable: false,
                            align: 'right',
                            dataIndex: 'cash_box',
                            menuDisabled: true
                        },
                        {
                            text: 'EFECTIVO EN BANCO',
                            width: 110,
                            lockable: false,
                            align: 'right',
                            dataIndex: 'cash_bank',
                            menuDisabled: true
                        }                      
                    ]
                },
                {
                    text: 'TOTAL PAGADO',
                    width: 110,
                    lockable: false,
                    align: 'right',
                    dataIndex: 'total_paid',
                    menuDisabled: true
                }
            ]
        };

        this.callParent(arguments);

        // Load Store
        var proxy = this.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/expensemonth/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('year')
        });
        this.getStore().load();
        
    }
});