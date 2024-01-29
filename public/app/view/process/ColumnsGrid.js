Ext.define('TCPContable.view.process.ColumnsGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'columnsgrid',
    id: 'columnsgrid',
    requires: [
        'Ext.grid.plugin.CellEditing',
        'Ext.grid.column.Action'
    ],
    store: 'Columns',
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
            cellEditingPlugin = Ext.create('Ext.grid.plugin.CellEditing', { pluginId:'columnsGridEditing', clicksToEdit: 2 });

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
                    text: 'Columna',
                    dataIndex: 'column',
                    menuDisabled: true,
                    flex: .5,
                    emptyCellText: '',
                    editable: false,
                    menuDisabled: true
                }, {
                    text: 'Nombre',
                    dataIndex: 'value',
                    menuDisabled: true,
                    flex: 2,
                    emptyCellText: '',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    menuDisabled: true
                }, {
                    xtype: 'actioncolumn',
                    text: 'Eliminar',
                    cls: 'tasks-icon-column-header tasks-delete-column-header',
                    width: 70,
                    icon: '/images/icons/delete.png',
					iconCls: 'x-hidden',
					align: 'center',
                    tooltip: 'Eliminar Nombre de la Columna',
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
            read: 'api/expensecolumn/' + localStorage.getItem('tcp')
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
                    tcp: e.record.data.tcp,
                    column: e.record.data.column,
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