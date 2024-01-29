Ext.define('TCPContable.view.process.ExpensedayGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'expensedaygrid',
    id: 'expensedaygrid',
    requires: [
        'Ext.grid.plugin.CellEditing',
        'Ext.grid.column.Action'
    ],
    store: 'Expenseday',
    viewConfig: {
        getRowClass: function(record, rowIndex, rowParams, store){
            var due = record.get('due');
            if(record.get('done')) {
                return 'tasks-completed-task';
            } else if(due && (due < Ext.Date.clearTime(new Date()))) {
                return 'tasks-overdue-task';
            }
        },
		columnLines: true
    },
    listeners: {
        afterrender: function(grid, eOpts){ 
            if (localStorage.getItem('col7') != '' && localStorage.getItem('col7') != null) {
                Ext.getCmp('col7').setText(localStorage.getItem('col7'));
            }
            if (localStorage.getItem('col8') != '' && localStorage.getItem('col8') != null) {
                Ext.getCmp('col8').setText(localStorage.getItem('col8'));
            }
            if (localStorage.getItem('col9') != '' && localStorage.getItem('col9') != null) {
                Ext.getCmp('col9').setText(localStorage.getItem('col9'));
            }
            if (localStorage.getItem('col10') != '' && localStorage.getItem('col10') != null) {
                Ext.getCmp('col10').setText(localStorage.getItem('col10'));
            }
            if (localStorage.getItem('col11') != '' && localStorage.getItem('col11') != null) {
                Ext.getCmp('col11').setText(localStorage.getItem('col11'));
            }
            if (localStorage.getItem('col12') != '' && localStorage.getItem('col12') != null) {
                Ext.getCmp('col12').setText(localStorage.getItem('col12'));
            }
            if (localStorage.getItem('col17') != '' && localStorage.getItem('col17') != null) {
                Ext.getCmp('col17').setText(localStorage.getItem('col17'));
            }
            if (localStorage.getItem('col18') != '' && localStorage.getItem('col18') != null) {
                Ext.getCmp('col18').setText(localStorage.getItem('col18'));
            }
            if (localStorage.getItem('col19') != '' && localStorage.getItem('col19') != null) {
                Ext.getCmp('col19').setText(localStorage.getItem('col19'));
            }
        }
    },

    initComponent: function() {
        var me                = this,
            cellEditingPlugin = Ext.create('Ext.grid.plugin.CellEditing', { pluginId:'expenseGridEditing', clicksToEdit: 2 });

        me.plugins = [cellEditingPlugin];
        me.columns = {
            defaults: {
                draggable: false,
                resizable: false,
                hideable: false,
                sortable: false,
                lockable: false,
                menuDisabled: true
            },
            items: [
                {
                    xtype: 'rownumberer',
                    text: 'D\xEDa',
                    width: 45,
                    locked: true,
                    align: 'center',
                    editable: false
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
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    width: 110
                                }, {
                                    text: 'Mercancias para la Venta',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'goods',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    width: 100
                                }, {
                                    text: 'Combustible',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'fuel',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    width: 100
                                }, {
                                    text: 'Energ\xEDa Ele\xE9ctrica',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'power',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    width: 100
                                }, {
                                    text: 'Salarios del personal contratado',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'salary',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    width: 100
                                }, {
                                    text: 'Columna-7',
                                    id: 'col7',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col7',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    width: 100
                                }, {
                                    text: 'Columna-8',
                                    id: 'col8',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col8',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    width: 100
                                }, {
                                    text: 'Columna-9',
                                    id: 'col9',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col9',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    width: 100
                                }, {
                                    text: 'Columna-10',
                                    id: 'col10',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col10',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    width: 100
                                }, {
                                    text: 'Columna-11',
                                    id: 'col11',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col11',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    width: 100
                                }, {
                                    text: 'Columna-12',
                                    id: 'col12',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col12',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    width: 100
                                }, {
                                    text: 'Otros Gastos',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'others',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
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
                    menuDisabled: true,
                    editable: false
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
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    width: 110
                                }, {
                                    text: 'Columna-17',
                                    id: 'col17',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col17',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    width: 100
                                }, {
                                    text: 'Columna-18',
                                    id: 'col18',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col18',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    width: 100
                                }, {
                                    text: 'Columna-19',
                                    id: 'col19',
                                    lockable: false,
                                    menuDisabled: true,
                                    align: 'right',
                                    dataIndex: 'col19',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
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
                    menuDisabled: true,
                    editable: false
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
                            editor: {
                                xtype: 'textfield',
                                selectOnFocus: true
                            },
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
                    menuDisabled: true,
                    editable: false
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
                            editor: {
                                xtype: 'textfield',
                                selectOnFocus: true
                            },
                            menuDisabled: true
                        },
                        {
                            text: 'EFECTIVO EN BANCO',
                            width: 110,
                            lockable: false,
                            align: 'right',
                            dataIndex: 'cash_bank',
                            editor: {
                                xtype: 'textfield',
                                selectOnFocus: true
                            },
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
                    menuDisabled: true,
                    editable: false
                },
                {
                    text: 'DETALLES',                    
                    lockable: false,
                    menuDisabled: true,
                    dataIndex: 'detail',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    width: 400
                },
                {
                    xtype: 'actioncolumn',
                    text: 'Eliminar',
                    cls: 'tasks-icon-column-header tasks-delete-column-header',
                    width: 70,
                    //locked: true,
                    icon: '/images/icons/delete.png',
					iconCls: 'x-hidden',
					align: 'center',
                    tooltip: 'Eliminar Gastos del D\xEDa',
                    menuDisabled: true,
                    sortable: false,
                    handler: Ext.bind(me.handleDeleteClick, me)
                }
            ]
        };

        me.callParent(arguments);

        // Load Store
        var proxy = me.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/expenseday/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
        });
        me.getStore().load();
        
        // Add Events
        me.addEvents(

            /**
             * @event deleteclick
             * Fires when a delete icon is clicked
             * @param {Ext.grid.View} view
             * @param {Number} rowIndex
             * @param {Number} colIndex
             * @param {Ext.grid.column.Action} column
             * @param {EventObject} e
             */
            'deleteclick',

            /**
             * @event edit
             * Fires when a record is edited using the CellEditing plugin or the statuscolumn
             * @param {SimpleTasks.model.Task} task     The task record that was edited
             */
            'recordedit'
        );

        //cellEditingPlugin.on('edit', me.handleCellEdit, this);
        me.on('edit', function(edt, e){
            var record = {
                    id: e.record.data.id,
                    day: e.record.data.day,
                    field: e.column.dataIndex,
                    newvalue: e.value
                }
            this.fireEvent('recordedit', record);
        });
    },

    /**
     * Handles a click on a delete icon
     * @private
     * @param {Ext.grid.View} gridView
     * @param {Number} rowIndex
     * @param {Number} colIndex
     * @param {Ext.grid.column.Action} column
     * @param {EventObject} e
     */
    handleDeleteClick: function(gridView, rowIndex, colIndex, column, e) {
        // Fire a "deleteclick" event with all the same args as this handler
        this.fireEvent('deleteclick', gridView, rowIndex, colIndex, column, e);
    },

    /**
     * Renderer for the list column
     * @private
     * @param {Number} value
     * @param {Object} metaData
     * @param {SimpleTasks.model.Task} task
     * @param {Number} rowIndex
     * @param {Number} colIndex
     * @param {SimpleTasks.store.Tasks} store
     * @param {Ext.grid.View} view
     */
    renderList: function(value, metaData, task, rowIndex, colIndex, store, view) {
        var listsStore = Ext.getStore('Expenseday'),
            node = value ? listsStore.getNodeById(value) : listsStore.getRootNode();

        return node.get('name');
    }
});