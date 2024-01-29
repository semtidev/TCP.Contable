Ext.define('TCPContable.view.models.StateSituationGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'statesituationgrid',
    id: 'statesituationgrid',
    requires: [
        'Ext.grid.plugin.CellEditing'
    ],
    store: 'Statesituation',
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
        var me = this,
            cellEditingPlugin = Ext.create('Ext.grid.plugin.CellEditing', {
                pluginId:'situationstateGridEditing', 
                clicksToEdit: 2,
                listeners: {
                    beforeedit: function(editor, e, eOpts) {
                        if (e.record.get('id') != 4  && e.record.get('id') != 5  && e.record.get('id') != 13  && e.record.get('id') != 15  && e.record.get('id') != 19  && e.record.get('id') != 20){
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
                    text: 'PARTIDA',
                    dataIndex: 'item',
                    flex: 2,
                    menuDisabled: true
                }, 
                {
                    text: 'SUBTOTAL',
                    id: 'situationsubtotal',
                    dataIndex: 'subtotal',
                    flex: 1,
                    align: 'right',
                    menuDisabled: true,
                    emptyCellText: '',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    }
                },
                {
                    text: 'TOTAL',
                    id: 'situationtotal',
                    dataIndex: 'total',
                    flex: 1,
                    align: 'right',
                    menuDisabled: true
                }
            ]
        };

        me.callParent(arguments);

        // Load Store
        var proxy = this.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/situationstate/' + localStorage.getItem('tcp') + '/' + localStorage.getItem('year')
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
     * @param {Object} e
     */
    handleCellEdit: function(editor, e) {
        this.fireEvent('recordedit', e.record);
    }

});