Ext.define('TCPContable.view.process.ExpenseTab', {
    extend: 'Ext.tab.Panel',
    alias: 'widget.expensetab',
    id: 'expensetab',
    frame:false,
    layout: 'fit',
    requires: [
        'Ext.tab.*',
        'Ext.tip.QuickTipManager'
    ],
    activeTab: 0,
    items: [
        {
            iconCls: "icon_operations",
            title: 'Gastos de Operaciones Diarias',
            xtype: 'expensedaygrid',
            itemId: 'expensedaytab',
            bodyPadding: 0
        },
        {
            iconCls: "icon_operations",
            title: 'Resumen Anual de Gastos',
            xtype: 'expensemonthgrid',
            itemId: 'expensemonthtab',
            bodyPadding: 0
        },
        {
            iconCls: "icon_operations",
            title: 'Pago de Tributos',
            xtype: 'taxgrid',
            itemId: 'expensetributetab',
            bodyPadding: 0
        }
    ],
    initComponent: function() {

        this.dockedItems = [{
                xtype: 'toolbar',
                id: 'entrytoolbar',
                cls: 'toolbar',
                items: [{
                        iconCls: 'icon-reload',
                        cls: 'toolbar_button',
                        text: 'Actualizar',
                        tooltip: 'Actualizar Operaciones de Gastos',
                        action: 'reload'
                    }, 
                    {
                        iconCls: 'icon_pdf',
                        cls: 'toolbar_button',
                        text: 'Libro Registro Gastos',
                        tooltip: 'Informe PDF Registro de Gastos',
                        action: 'pdf'
                    },
                    {
                        iconCls: 'icon_columns',
                        cls: 'toolbar_button',
                        text: 'Columnas Opcionales',
                        tooltip: 'Definir Nombre de Columnas Opcionales',
                        action: 'columns'
                    }, '->', {
                        xtype: 'monthcombo',
                        margin: '0 20 0 0',
                        action: 'expensechangemonth',
                        value: localStorage.getItem('month')
                    },
                    {
                        xtype: 'yearcombo',
                        action: 'expensechangeyear',
                        value: localStorage.getItem('year')
                    }]
            }];

        this.callParent(arguments);
    }
});