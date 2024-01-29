Ext.define('TCPContable.view.models.SubLargestForm', {
    extend: 'Ext.window.Window',
    id: 'sublargestform',
    alias : 'widget.sublargestform',
    requires: ['Ext.form.*'],

    title: 'Generar PDF Submayor de Cuenta',
    iconCls: 'icon_pdf',
    layout: 'fit',
    autoShow: true,
    width: 400,
    height: 160,
	modal: true,

	initComponent: function() {
		this.items = [{
        	xtype: 'form',
            padding: '15 15 15 15',
            border: false,
			modal: true,
            style: 'background-color: #fff;',
            waitMsgTarget: true,
            fieldDefaults: {
            	anchor: '100%',
                labelAlign: 'top',
                combineErrors: true,
                msgTarget: 'side'
            },
            items: [
                { xtype: 'hiddenfield', id: 'SLForm_id_tcp', name: 'id_tcp'},
                { xtype: 'hiddenfield', id: 'SLForm_account', name: 'account'},
                {
                    xtype: 'fieldcontainer',
                    combineErrors: true,
                    msgTarget: 'none', // qtip  title  under
                    margin: '0 auto 10 auto',
                    layout: 'hbox',

                    items: [{
                            xtype: 'datefield',
                            id: 'slf_datestart',
                            allowBlank: false,
                            fieldLabel: 'Desde',
                            value: new Date(),
                            format: 'd/m/Y',
                            editable: false,
                            flex: 1,
                            margin: '0 15 5 5',
                            name: 'date_start',
                            afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                        }, {
                            xtype: 'datefield',
                            id: 'slf_datend',
                            allowBlank: false,
                            fieldLabel: 'Hasta',
                            value: new Date(),
                            format: 'd/m/Y',
                            editable: false,
                            flex: 1,
                            margin: '0 5 5 5',
                            name: 'date_end',
                            afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                        }
                    ]
                }
            ]
        }];
         
        this.dockedItems = [{
            xtype: 'toolbar',
            dock: 'bottom',
            id: 'buttons',
            ui: 'footer',
            items: ['->', {
                iconCls: 'icon-save',
                text: 'Aceptar',
                action: 'pdf'
            },{
                //iconCls: 'icon-reset',
                text: 'Cancelar',
                scope: this,
                handler: this.close
            }]
        }];
 
        this.callParent(arguments);
    }
});