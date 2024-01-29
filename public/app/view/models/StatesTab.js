Ext.define('TCPContable.view.models.StatesTab', {
    extend: 'Ext.tab.Panel',
    alias: 'widget.statestab',
    id: 'statestab',
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
            title: 'Estado de Resultado',
            xtype: 'stateresultgrid',
            itemId: 'stateresultab',
            bodyPadding: 0
        },
        {
            iconCls: "icon_operations",
            title: 'Estado de Situaci\xF3n',
            xtype: 'statesituationgrid',
            itemId: 'statesituationtab',
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
                        tooltip: 'Actualizar Estados Financieros',
                        action: 'reload'
                    }, 
                    {
                        iconCls: 'icon_pdf',
                        cls: 'toolbar_button',
                        text: 'Libro Estados Financieros',
                        tooltip: 'Informe PDF Estados Financieros',
                        action: 'pdf'
                    }, '->', {
                        xtype: 'yearcombo',
                        action: 'stateschangeyear',
                        value: localStorage.getItem('year')
                    }]
            }];

        this.callParent(arguments);
    }
});