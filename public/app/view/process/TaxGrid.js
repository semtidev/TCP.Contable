Ext.define('TCPContable.view.process.TaxGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'taxgrid',
    id: 'taxgrid',
    requires: [
        'Ext.grid.plugin.CellEditing',
        'Ext.grid.column.Action'
    ],
    store: 'Tax',
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

    viewConfig: {
		columnLines: true
    },
    initComponent: function() {
        var me                = this,
            cellEditingPlugin = Ext.create('Ext.grid.plugin.CellEditing', { 
                pluginId:'taxGridEditing', 
                clicksToEdit: 2,
                listeners: {
                    beforeedit: function(editor, e, eOpts) {
                        if (e.record.get('id') == -1 ){
                            return false;
                        }
                    }
                } 
            })

        me.plugins = [cellEditingPlugin];
        me.columns = {
            defaults: {
                draggable: false,
                resizable: false,
                hideable: false,
                sortable: false,
                menuDisabled: true
            },
            items: [
                {
                    text: 'MES',
                    lockable: true,
                    locked: true,
                    menuDisabled: true,
                    dataIndex: 'month',
                    emptyCellText: '',
                    width: 150
                }, {
                    text: 'Impuesto sobre las Ventas o los Servicios',
                    lockable: false,
                    menuDisabled: true,
                    align: 'right',
                    dataIndex: 'sales_services',
                    width: 130
                }, {
                    text: 'Impuesto Utilizaci\xF3n Fuerza Trabajo',
                    lockable: false,
                    menuDisabled: true,
                    align: 'right',
                    dataIndex: 'workforce',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    width: 130
                }, {
                    text: 'Impuesto sobre Documentos',
                    lockable: false,
                    menuDisabled: true,
                    align: 'right',
                    dataIndex: 'documents',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    width: 130
                }, {
                    text: 'Tasa Anuncios y Propaganda Comercial',
                    lockable: false,
                    menuDisabled: true,
                    align: 'right',
                    dataIndex: 'commercial_ads',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    width: 130
                }, {
                    text: 'Contribuci\xF3n especial a la seguridad social',
                    lockable: false,
                    menuDisabled: true,
                    align: 'right',
                    dataIndex: 'social_security',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    width: 130
                }, {
                    text: 'Otros Tributos',
                    lockable: false,
                    menuDisabled: true,
                    align: 'right',
                    dataIndex: 'others',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    width: 130
                }, {
                    text: 'SUBTOTAL',
                    lockable: false,
                    editable: false,
                    menuDisabled: true,
                    align: 'right',
                    dataIndex: 'subtotal',
                    width: 130
                }, {
                    text: 'Contribuci\xF3n Restauraci\xF3n y Preservaci\xF3n',
                    lockable: false,
                    menuDisabled: true,
                    align: 'right',
                    dataIndex: 'restoration_repair',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    width: 130
                }, {
                    text: 'Cuota Mensual',
                    lockable: false,
                    menuDisabled: true,
                    align: 'right',
                    dataIndex: 'monthly_fee',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    width: 130
                }, {
                    text: 'TOTAL PAGADO',
                    lockable: false,
                    editable: false,
                    menuDisabled: true,
                    align: 'right',
                    dataIndex: 'total_pay',
                    width: 130
                }
            ]
        };

        me.callParent(arguments);

        // Load Store
        var proxy = me.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/taxmonthly/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('year')
        });
        me.getStore().load();

        // Add Events
        me.addEvents(

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
                    month_num: e.record.data.month_num,
                    year: e.record.data.year,
                    field: e.column.dataIndex,
                    newvalue: e.value
                }
            this.fireEvent('recordedit', record);
        });
        
    }
});