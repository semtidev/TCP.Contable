Ext.define('TCPContable.view.process.AftGrid', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.aftgrid',
    id: 'aftgrid',
    requires: [
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.tip.QuickTipManager'
    ],
    listeners: {
        'selectionchange': function(view, records) {
            this.down('#edit').setDisabled(!records.length);//Se Habilita el Boton Editar
            this.down('#delete').setDisabled(!records.length);//Se Habilita el Boton Delete
        }
    },
    frame: false,
    iconCls: "icon_informes",
    title: 'Inventario del Patrimonio',
    layout: 'fit',
    store: 'Aft',
    features: [{
        id: 'group',
        ftype: 'groupingsummary',
        groupHeaderTpl: '{name}',
        hideGroupedHeader: true,
        enableGroupingMenu: false
    }],
    columnLines: true,
    columns: {
        defaults: {
            sortable: false,
            resizable: false,
            hideable: false
        },
        items: [
            { 
                header: "Producto", 
                flex: 1.2, 
                dataIndex: 'product',
                summaryType: 'count',
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return '<strong>Total</strong>';
                }
            },
            {
                header: 'Grupo',
                width: 180,
                dataIndex: 'group'
            },
            { 
                header: "UM", 
                width: 50,
                align: 'center',
                dataIndex: 'um'
            },
            { 
                header: "Ctdad", 
                width: 60,
                align: 'center',
                dataIndex: 'ctdad'
            },
            { 
                header: "Precio", 
                width: 100,
                dataIndex: 'price', 
                align: 'right'
            },
            { 
                header: "Importe", 
                width: 100,
                align: 'right',
                dataIndex: 'import',
                summaryType: 'sum',
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return '<strong>$ ' + value + '</strong>';
                }
            },
            { 
                header: "Vida \xDAtil", 
                width: 90,
                align: 'center',
                dataIndex: 'current_live',
                renderer: function(value){
                    return value + ' a\xF1os';
                },
            },
            { 
                header: "Dep. Anual", 
                width: 100,
                align: 'right',
                dataIndex: 'dep_year',
                summaryType: 'sum',
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return '<strong>$ ' + value + '</strong>';
                }
            },
            { 
                header: "Dep. Mensual", 
                width: 110,
                align: 'right',
                dataIndex: 'dep_month',
                /*renderer: function(value){
                    return '$ ' + value;
                },*/
                summaryType: 'sum',
                summaryRenderer: function(value, summaryData, dataIndex) {
                    return '<strong>$' + value + '</strong>';
                }
            }
        ]
    },
    viewConfig: {stripeRows: true},
    initComponent: function() {

        this.dockedItems = [{
                xtype: 'toolbar',
                cls: 'toolbar',
                items: [{
                        iconCls: 'icon-add',
                        cls: 'toolbar_button',
                        xtype: 'button',
                        id: 'tcpCreateBtn',
                        text: 'Agregar',
                        tooltip: 'Nuevo Producto',
                        action: 'create'
                    }, {
                        itemId: 'edit',
                        iconCls: 'icon-edit',
                        cls: 'toolbar_button',
                        text: 'Modificar',
                        disabled: true,
                        tooltip: 'Modificar Producto seleccionado',
                        action: 'update'
                    }, {
                        itemId: 'delete',
                        iconCls: 'icon-delete',
                        cls: 'toolbar_button',
                        text: 'Eliminar',
                        disabled: true,
                        tooltip: 'Eliminar Producto seleccionado',
                        action: 'delete'
                    }, '->', {
                        iconCls: 'icon-reload',
                        cls: 'toolbar_button',
                        text: 'Actualizar',
                        tooltip: 'Actualizar Listado de Productos',
                        action: 'reload'
                    },
                    {
                        iconCls: 'icon_pdf',
                        cls: 'toolbar_button',
                        text: 'Generar Informe',
                        tooltip: 'Informe PDF',
                        action: 'pdf'
                    }]
            }];

        this.callParent(arguments);
        
        var proxy = this.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: 'api/aft/' + localStorage.getItem('tcp')
        });
        this.getStore().load();
    }
});