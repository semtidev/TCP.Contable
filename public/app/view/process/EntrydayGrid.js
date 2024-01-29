Ext.define('TCPContable.view.process.EntrydayGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'entrydaygrid',
    id: 'entrydaygrid',
    requires: [
        'Ext.grid.plugin.CellEditing',
        'Ext.grid.column.Action'
    ],
    store: 'Entryday',
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

    initComponent: function() {
        var me                = this,
            cellEditingPlugin = Ext.create('Ext.grid.plugin.CellEditing', { pluginId:'entryGridEditing', clicksToEdit: 2 });

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
                    xtype: 'rownumberer',
                    text: 'D\xEDa',
                    width: 45,
                    align: 'center',
                }, {
                    text: 'D\xC9BITOS',
                    menuDisabled: true,
                    columns: [
                        {
                            text: 'EFECTIVO EN CAJA',
                            //id: 'FileGridTitleName',
                            dataIndex: 'cash_box',
                            align: 'right',
                            width: 130,
                            emptyCellText: '',
                            editor: {
                                xtype: 'textfield',
                                selectOnFocus: true
                            },
                            menuDisabled: true
                        }
                    ]
                }, {
                    text: 'CR\xC9DITOS',
                    menuDisabled: true,
                    columns: [
                       {
                           text: 'SUBCUENTAS DE INGRESOS',
                           menuDisabled: true,
                           columns: [
                                {
                                    text: 'Ingreso NCEI',
                                    //id: 'FileGridTitleName',
                                    dataIndex: 'cash_ncei',
                                    align: 'right',
                                    width: 120,
                                    emptyCellText: '',
                                    editor: {
                                        xtype: 'textfield',
                                        selectOnFocus: true
                                    },
                                    menuDisabled: true
                                },{
                                    text: 'Ingresos',
                                    //id: 'FileGridTitleName',
                                    dataIndex: 'entry',
                                    align: 'right',
                                    width: 120,
                                    emptyCellText: '',
                                    editable: false,
                                    menuDisabled: true
                                }
                           ]
                        }, {
                            text: 'TOTAL INGRESOS',
                            //id: 'FileGridTitleName',
                            dataIndex: 'totalentry',
                            align: 'right',
                            width: 120,
                            emptyCellText: '',
                            editable: false,
                            menuDisabled: true
                        }
                    ]
                }, {
                    text: 'DETALLES',
                    //id: 'FileGridTitleName',
                    dataIndex: 'detail',
                    align: 'left',
                    flex: 2,
                    emptyCellText: '',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    menuDisabled: true
                },{
                    xtype: 'actioncolumn',
                    text: 'Eliminar',
                    cls: 'tasks-icon-column-header tasks-delete-column-header',
                    width: 70,
                    icon: 'images/icons/delete.png',
					iconCls: 'x-hidden',
					align: 'center',
                    tooltip: 'Eliminar Ingresos del D\xEDa',
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
            read: 'api/entryday/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
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
            'recordedit',
            
            /**
             * @event reminderselect
             * Fires when a reminder time is selected from the reminder column's dropdown menu
             * @param {SimpleTasks.model.Task} task    the underlying record of the row that was clicked to show the reminder menu
             * @param {String|Number} value      The value that was selected
             */
            'reminderselect'
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
     * Handles a "select" event on the reminder column
     * @private
     * @param {SimpleTasks.model.Task} task    the underlying record of the row that was clicked to show the reminder menu
     * @param {String|Number} value      The value that was selected
     */
    handleReminderSelect: function(task, value) {
        this.fireEvent('reminderselect', task, value);
    },

    /**
     * Handles the CellEditing plugin's "edit" event
     * @private
     * @param {Ext.grid.plugin.CellEditing} editor
     * @param {Object} e                                an edit event object
     */
    handleCellEdit: function(editor, e) {
        this.fireEvent('recordedit', e.record);
    },

    /**
     * Reapplies the store's current filters. This is needed because when data in the store is modified
     * after filters have been applied, the filters do not automatically get applied to the new data.
     */
    refreshFilters: function() {
        var store = this.store,
            filters = store.filters;

        // save a reference to the existing task filters before clearing them
        filters = filters.getRange(0, filters.getCount() - 1);

        // clear the tasks store's filters and reapply them.
        store.clearFilter();
        store.filter(filters);
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
        var listsStore = Ext.getStore('Entryday'),
            node = value ? listsStore.getNodeById(value) : listsStore.getRootNode();

        return node.get('name');
    }

});