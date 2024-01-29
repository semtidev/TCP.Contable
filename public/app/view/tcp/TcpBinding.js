Ext.define('TCPContable.view.tcp.TcpBinding', {
    extend: 'Ext.Panel',
    alias: 'widget.tcpbinding',
    requires: [
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.panel.*',
        'Ext.layout.container.Border',
        'TCPContable.view.tcp.TcpGrid'
    ],
    frame: false,
    iconCls: "icon_tcp",
    title: 'REGISTRO DE TCP',
    layout: 'border',
    initComponent: function() {
	
        Ext.apply(this, {
		
			items: [
                // Grid Panel
                {
                    xtype: 'tcpgrid'
                },
                // Detail Panel 
                {
                    id: 'detailPanel',
                    region: 'center',
                    autoScroll: true,
                    flex: 1.5,
                    bodyStyle: "background: #fff;",
                    html: '<p class="details-info">Por favor, haga clic en un rengl\xF3n del Registro para ver los datos adicionales del TCP Titular de la Empresa.</p>'
                }
            ]
        });

        this.callParent(arguments);
    }
});
