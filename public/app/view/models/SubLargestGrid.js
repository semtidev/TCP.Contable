Ext.define('TCPContable.view.models.SubLargestGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'sublargestgrid',
    id: 'sublargestgrid',
    requires: [
        'Ext.grid.plugin.CellEditing',
        'Ext.grid.column.Action'
    ],
    store: 'Sublargest',
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
    frame: false,
    iconCls: "icon_informes",
    title: 'Submayor de Cuenta',
    layout: 'fit',
    initComponent: function() {
        var me = this;
            cellEditingPlugin = Ext.create('Ext.grid.plugin.CellEditing', { 
                pluginId:'sublargestGridEditing', 
                clicksToEdit: 2,
                listeners: {
                    beforeedit: function(editor, e, eOpts) {
                        var grid       = Ext.ComponentQuery.query("gridpanel")[0],
                            gridHeader = grid.getView().headerCt,
                            column     = gridHeader.child("#sublargest_desc");
                        
                        if (e.record.get('desc') == 'Saldo al Inicio del Mes') {
                            column.setEditor(null)
                        }
                        else {
                            column.setEditor({
                                xtype: 'textfield',
                                selectOnFocus: true
                            });
                        }
                    }
                }
            });

        me.plugins = [cellEditingPlugin];
        me.columns = {
            defaults: {
                draggable: false,
                resizable: false,
                hideable: false,
                sortable: false
            },
            items: [
                {
                    text: 'FECHA',
                    menuDisabled: true,
                    columns: [
                         {
                             text: 'D',
                             dataIndex: 'day',
                             align: 'center',
                             width: 55,
                             emptyCellText: '',
                             menuDisabled: true,
                             editor: new Ext.form.field.ComboBox({
                                typeAhead: true,
                                triggerAction: 'all',
                                store: [
                                    ['01','01'], ['02','02'], ['03','03'],
                                    ['04','04'], ['05','05'], ['06','06'],
                                    ['07','07'], ['08','08'], ['09','09'], 
                                    ['10','10'], ['11','11'], ['12','12'],
                                    ['13','13'], ['14','14'], ['15','15'],
                                    ['16','16'], ['17','17'], ['18','18'],
                                    ['19','19'], ['20','20'], ['21','21'],
                                    ['22','22'], ['23','23'], ['24','24'],
                                    ['25','25'], ['26','26'], ['27','27'],
                                    ['28','28'], ['29','29'], ['30','30'],
                                    ['31','31']
                                ],
                                editable: false,
                                value: '01'
                            })
                         },{
                             text: 'M',
                             dataIndex: 'month',
                             align: 'center',
                             width: 55,
                             emptyCellText: '',
                             editable: false,
                             menuDisabled: true
                         }
                    ]
                }, {
                    text: 'REFERENCIA',
                    menuDisabled: true,
                    columns: [
                         {
                             text: 'Clave',
                             dataIndex: 'code',
                             align: 'center',
                             width: 60,
                             emptyCellText: '',
                             editable: false,
                             menuDisabled: true
                         },{
                             text: 'N\xFAmero',
                             dataIndex: 'number',
                             align: 'center',
                             width: 80,
                             emptyCellText: '',
                             editable: false,
                             menuDisabled: true
                         }
                    ]
                }, {
                    text: 'DETALLE',
                    emptyCellText: '',
                    menuDisabled: true,
                    dataIndex: 'desc',
                    id: 'sublargest_desc',
                    align: 'left',
                    flex: 1
                }, {
                    text: 'DEBE',
                    menuDisabled: true,
                    dataIndex: 'debit',
                    align: 'right',
                    width: 110,
                    emptyCellText: '',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    }
                }, {
                    text: 'HABER',
                    menuDisabled: true,
                    dataIndex: 'credit',
                    align: 'right',
                    width: 110,
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    }
                }, {
                    text: 'SALDO',
                    menuDisabled: true,
                    dataIndex: 'sald',
                    editable: false,
                    align: 'right',
                    width: 110,
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    }
                }, {
                    xtype: 'actioncolumn',
                    id: 'bank_cash_action',
                    hidden: true,
                    text: 'Eliminar',
                    cls: 'tasks-icon-column-header tasks-delete-column-header',
                    width: 70,
                    icon: '/images/icons/delete.png',
					iconCls: 'x-hidden',
					align: 'center',
                    tooltip: 'Eliminar Operaci\xF3n',
                    menuDisabled: true,
                    sortable: false,
                    handler: Ext.bind(me.handleDeleteClick, me)
                }
            ]
        };

        me.dockedItems = [{
            xtype: 'toolbar',
            id: 'sublargestoolbar',
            cls: 'toolbar',
            items: [{
                    iconCls: 'icon-reload',
                    cls: 'toolbar_button',
                    text: 'Actualizar',
                    tooltip: 'Actualizar Submayor de Cuenta',
                    action: 'reload'
                },
                {
                    iconCls: 'icon_pdf',
                    id: 'sublargestprt',
                    cls: 'toolbar_button',
                    text: 'Generar Submayor',
                    tooltip: 'PDF Registro de Submayor de Cuenta',
                    action: 'pdf'
                }, 
                {
                    iconCls: 'icon-add',
                    id: 'btnaddoperation',
                    cls: 'toolbar_button',
                    hidden: true,
                    text: 'Agregar Operaci\xF3n',
                    tooltip: 'Nueva Operaci\xF3n Bancaria',
                    action: 'addBankOperation'
                }, '->', 
                {
                    xtype: 'combobox',
                    name: 'account',
                    id: 'account',
                    fieldLabel: 'Cuenta',
                    width: 265,
                    margin: '0 20 0 0',
                    labelAlign: 'right',
                    labelWidth: 60,
                    store: Ext.create('TCPContable.store.Accountscombo'),
                    queryMode: 'local',
                    editable: false,
                    displayField: 'account',
                    valueField: 'code',
                    value: '100',
                    action: 'sublargestchangeaccount'
                },
                {
                    xtype: 'monthcombo',
                    margin: '0 20 0 0',
                    action: 'sublargestchangemonth',
                    value: localStorage.getItem('month')
                },
                {
                    xtype: 'yearcombo',
                    action: 'sublargestchangeyear',
                    value: localStorage.getItem('year')
                }]
        }];

        me.callParent(arguments);

        // Load Store
        var proxy = me.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/sublargest/' + localStorage.getItem('tcp') + '/' + Ext.getCmp('account').getValue() + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
        });
        me.getStore().load();

        // Add Events
        me.addEvents(

            /**
             * @event edit
             * Fires when a record is edited using the CellEditing plugin or the statuscolumn
             * @param {SimpleTasks.model.Task} task     The task record that was edited
             */
            'recordedit',
        );

        cellEditingPlugin.on('edit', me.handleCellEdit, this);

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
     * Handles the CellEditing plugin's "edit" event
     * @private
     * @param {Ext.grid.plugin.CellEditing} editor
     * @param {Object} e                                an edit event object
     */
    handleCellEdit: function(editor, e) {
        this.fireEvent('recordedit', e);
    }
});