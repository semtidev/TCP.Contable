Ext.define('TCPContable.view.models.RegCashboxForm', {
    extend: 'Ext.window.Window',
    id: 'regcashboxform',
    alias : 'widget.regcashboxform',
    requires: ['Ext.form.*'],

    title: 'Saldo inicial de Efectivo en Caja',
    iconCls: 'icon_form',
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
            items: [{
                xtype: 'fieldcontainer',
                combineErrors: true,
                msgTarget: 'none', // qtip  title  under
                margin: '0 auto 10 auto',
                layout: 'hbox',

                items: [{
                        xtype: 'datefield',
                        id: 'dateRegcashForm',
                        allowBlank: false,
                        fieldLabel: 'Fecha Inicio Actividad',
                        value: new Date(),
                        format: 'd/m/Y',
                        flex: 1,
                        margin: '0 10 5 0',
                        name: 'date_start',
                        afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                    }, {
                        xtype: 'textfield',
                        id: 'saldRegcashForm',
                        allowBlank: false,
                        fieldLabel: 'Saldo Inicial',
                        emptyText: '0.00',
                        flex: 1,
                        margin: '0 0 5 0',
                        name: 'sald',
                        afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                    }
                ]
            }]
        }];
         
        this.dockedItems = [{
            xtype: 'toolbar',
            dock: 'bottom',
            id: 'buttons',
            ui: 'footer',
            items: ['->', {
                iconCls: 'icon-save',
                text: 'Aceptar',
                action: 'store'
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