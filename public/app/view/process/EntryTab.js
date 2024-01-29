Ext.define('TCPContable.view.process.EntryTab', {
    extend: 'Ext.tab.Panel',
    alias: 'widget.entrytab',
    id: 'entrytab',
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
            title: 'Ingresos de Operaciones Diarias',
            xtype: 'entrydaygrid',
            itemId: 'entrydaytab',
            bodyPadding: 0
        },
        {
            iconCls: "icon_operations",
            title: 'Resumen Anual de Ingresos',
            itemId: 'entrymonthtab',
            xtype: 'entrymonthgrid',
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
                        tooltip: 'Actualizar Operaciones de Ingresos',
                        action: 'reload'
                    },
                    {
                        iconCls: 'icon_pdf',
                        cls: 'toolbar_button',
                        text: 'Libro Registro Ingresos',
                        tooltip: 'Informe PDF Registro de Ingresos',
                        action: 'pdf'
                    }, '->', {
                        xtype: 'monthcombo',
                        margin: '0 20 0 0',
                        action: 'entrychangemonth',
                        value: localStorage.getItem('month')
                    },
                    {
                        xtype: 'yearcombo',
                        action: 'entrychangeyear',
                        value: localStorage.getItem('year')
                    }]
            }];

        this.callParent(arguments);
    }
});