Ext.define('TCPContable.view.app.App', {
	extend: 'Ext.Viewport',
	layout: 'border',
	id: 'mainviewport',
	requires: [
        'Ext.tip.QuickTipManager',
        'Ext.container.Viewport',
        'Ext.layout.*',
        'Ext.form.Panel',
        'Ext.form.Label',
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.tree.*',
        'Ext.selection.*',
        'Ext.tab.Panel',
        'Ext.ux.layout.Center'
    ],
	initComponent: function() {
	
        Ext.tip.QuickTipManager.init();
        Ext.apply(this, {
		
			items: [
                {
                    xtype: 'box',
                    id: 'header',
                    region: 'north',
                    contentEl: 'topnav',
                    height: 40
                },{
                    layout: 'border',
                    id: 'layout-browser',
                    region:'west',
                    title: 'Contabilidad & Finanzas',
                    border: false,
                    split:true,
                    margins: '2 0 5 5',
                    width: 250,
                    minWidth: 250,
                    maxSize: 300,
                    collapsible: true,
				    animCollapse: true,
                    items: [
                        {
                            xtype: 'treeMainmenu'
                        }, 
                        {
                            id: 'details-company',
                            listeners: {
                                'afterrender': function(viewport, eOpts) {
                                    if(localStorage.getItem('tcp') != null){
                                        var bookTplMarkup = [
                                            '<div class="details-company"><strong>Empresa:</strong><h4>'+localStorage.getItem('tcp-company')+'</h4>',
                                            '<strong>Plantilla:</strong><h4>'+localStorage.getItem('tcp-workers')+' Trabajador(es)</h4>',
                                            '<strong>NIT:</strong><h4>'+localStorage.getItem('tcp-nit')+'</h4>',
                                            '<strong>Actividad:</strong><h4>'+localStorage.getItem('tcp-activity')+'</h4></div>'
                                        ];
                                        var bookTpl = Ext.create('Ext.Template', bookTplMarkup);
                                        var detailPanel = Ext.getCmp('details-company');
                                        detailPanel.update(bookTpl);
                                    }
                                }
                            },
                            title: 'Ficha del TCP',
                            region: 'center',
                            collapsible: true,
                            collapseDirection: 'bottom',
                            //collapseMode: 'header',
                            autoScroll: true,
                            bodyStyle: 'padding-bottom:15px;background:#eee;',
                            html: '<p class="details-company">Cuando seleccione el TCP, los datos de su Empresa se mostrar\xE1n aqu\xED.</p>'
                        }
                    ]
                }, {
                    id: 'content-panel',
                    region: 'center',
                    layout: 'fit',
                    margins: '2 5 5 0',
                    border: false,
                    activeItem: 0,
                    items: [{
                        itemId: 'lnk_home',
                        bodyStyle: {
                            "background": "url(images/desktop.jpg)",
                            "background-size": "cover"
                        },
                        html: '<div class="home_appname"><h1>TCP.Contable</h1>Sistema de Gesti&oacute;n de Contabilidad Simplificada<h6>Copyright &copy; 2020 SEMTI. Todos los derechos reservados.</h6></div>'
                    }]
                }
            ]		
		})
	    
        // TCP Selector
        Ext.create('TCPContable.view.tcp.TcpCombo', {
            fieldLabel: 'TCP',
            labelWidth: 30,
            labelStyle: 'color: white',
            emptyText: 'Seleccione el TCP...',
            editable: false,
            renderTo: 'tcpselector'
        });

        Ext.getBody().setStyle({
            "background": "#3892d3",
            "background-size": "unset"
        });

        this.callParent(arguments);

    }
});