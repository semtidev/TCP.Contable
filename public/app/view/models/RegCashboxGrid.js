Ext.define('TCPContable.view.models.RegCashboxGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'regcashboxgrid',
    id: 'regcashboxgrid',
    requires: [
        'Ext.grid.plugin.CellEditing'
    ],
    store: 'Regcashbox',
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
    title: 'Entrada-Salida de Efectivo en Caja',
    layout: 'fit',
    initComponent: function() {
        var me = this;
            cellEditingPlugin = Ext.create('Ext.grid.plugin.CellEditing', { 
                pluginId:'regcashGridEditing', 
                clicksToEdit: 2,
                listeners: {
                    beforeedit: function(editor, e, eOpts) {
                        if (e.record.get('id') == null){
                            return false;
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
                    text: 'D\xEDa',
                    dataIndex: 'day',
                    menuDisabled: true,
                    width: 45,
                    align: 'center',
                }, {
                    text: 'Ventas',
                    menuDisabled: true,
                    dataIndex: 'sales',
                    align: 'right',
                    width: 100
                }, {
                    text: 'Compra de MPM',
                    menuDisabled: true,
                    dataIndex: 'mpm',
                    align: 'right',
                    width: 100
                }, {
                    text: 'Compra de MPV',
                    menuDisabled: true,
                    dataIndex: 'mpv',
                    align: 'right',
                    width: 100
                }, {
                    text: 'Compra de Comustible',
                    menuDisabled: true,
                    dataIndex: 'fuel',
                    align: 'right',
                    width: 100
                }, {
                    text: 'Pago de Electricidad',
                    menuDisabled: true,
                    dataIndex: 'elect',
                    align: 'right',
                    width: 100
                }, {
                    text: 'Pago a Trabajadores',
                    menuDisabled: true,
                    dataIndex: 'workers',
                    align: 'right',
                    width: 100
                }, {
                    text: 'Pago de Impuestos',
                    menuDisabled: true,
                    dataIndex: 'tax',
                    align: 'right',
                    width: 100
                }, {
                    text: 'Dep\xF3sito en Banco',
                    menuDisabled: true,
                    dataIndex: 'bank_deposit',
                    align: 'right',
                    width: 100,
                    emptyCellText: '',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    }
                }, {
                    text: 'D\xC9BITO',
                    menuDisabled: true,
                    dataIndex: 'debit',
                    align: 'right',
                    flex: 1,
                    minWidth: 100,
                    emptyCellText: '',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    }
                }, {
                    text: 'CR\xC9DITO',
                    menuDisabled: true,
                    dataIndex: 'credit',
                    align: 'right',
                    width: 100
                }, {
                    text: 'SALDO',
                    menuDisabled: true,
                    dataIndex: 'sald',
                    align: 'right',
                    width: 100
                }
            ]
        };

        me.dockedItems = [{
            xtype: 'toolbar',
            id: 'regcashtoolbar',
            cls: 'toolbar',
            items: [{
                    iconCls: 'icon-reload',
                    cls: 'toolbar_button',
                    text: 'Actualizar',
                    tooltip: 'Actualizar Registro de Efectivo en Caja',
                    action: 'reload'
                },
                {
                    iconCls: 'icon_pdf',
                    cls: 'toolbar_button',
                    text: 'Generar Registro',
                    tooltip: 'PDF Registro de Efectivo en Caja',
                    action: 'pdf'
                }, {
                    iconCls: 'icon_form',
                    cls: 'toolbar_button',
                    text: 'Saldo Inicial Efectivo en Caja',
                    tooltip: 'Saldo Efectivo en Caja al iniciar la actividad',
                    action: 'saldbegin'
                }, '->', {
                    xtype: 'monthcombo',
                    margin: '0 20 0 0',
                    action: 'regcashchangemonth',
                    value: localStorage.getItem('month')
                },
                {
                    xtype: 'yearcombo',
                    action: 'regcashchangeyear',
                    value: localStorage.getItem('year')
                }]
        }];

        me.callParent(arguments);

        // Load Store
        var proxy = me.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/regcash/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
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
     * Handles a "checkchange" event on the "done" column
     * @private
     * @param {SimpleTasks.ux.StatusColumn} column
     * @param {Number} rowIndex
     * @param {Boolean} checked
     */
    handleCheckChange: function(column, rowIndex, checked) {
        this.fireEvent('recordedit', this.store.getAt(rowIndex));
    },

    /**
     * Handles the CellEditing plugin's "edit" event
     * @private
     * @param {Ext.grid.plugin.CellEditing} editor
     * @param {Object} e                                an edit event object
     */
    handleCellEdit: function(editor, e) {
        this.fireEvent('recordedit', e.record);
    }

});