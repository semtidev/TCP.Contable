Ext.define('TCPContable.view.models.ReceiptForm', {
    extend: 'Ext.window.Window',
    alias : 'widget.receiptform',  
    requires: ['Ext.form.*'],
    layout: 'fit',
    autoShow: true,
    width: 480,
	modal: true,
	
	title: 'Comprobantes de Operaciones',
     
    iconCls: 'icon_form',
    
    initComponent: function() {
        this.items = [{
        	xtype: 'form',
            padding: '15 15 15 15',
            border: false,
			modal: true,
            style: 'background-color: #fff;',
                 
            fieldDefaults: {
            	anchor: '100%',
                labelAlign: 'left',
				labelWidth: 110,
                combineErrors: true,
                msgTarget: 'side'
            },
            items: [{
                xtype: 'fieldcontainer',
                layout: 'hbox',
                height: 80,
                msgTarget: 'none',
                padding: 0,
                margin: 0,
                items: [
                    {
                        xtype: 'combobox',
                        name: 'range',
                        fieldLabel: '\xBFQu\xE9 Per\xEDodo desea comprobar?',
                        flex: 1,
                        margin: '0',
                        labelAlign: 'top',
                        store: Ext.create('TCPContable.store.Receiptcombo'),
                        queryMode: 'local',
                        editable: false,
                        displayField: 'name',
                        valueField: 'abbr',
                        value: 'cmonth',
                        listeners: {
                            'change': function(combo, newValue, oldValue, eOpts) {
                                if (newValue === 'cmonth') {
                                    Ext.getCmp('receipt_month').setVisible(true);
                                    Ext.getCmp('receipt_year').setVisible(true);
                                }
                                else {
                                    Ext.getCmp('receipt_month').setVisible(false);
                                    Ext.getCmp('receipt_year').setVisible(true);
                                }
                            }
                        }
                    },
                    {
                        xtype: 'monthcombo',
                        name: 'month',
                        id: 'receipt_month',
                        margin: '0 0 0 20',
                        labelAlign: 'top',
                        width: 110,
                        action: 'regcashchangemonth',
                        value: localStorage.getItem('month')
                    },
                    {
                        xtype: 'yearcombo',
                        name: 'year',
                        id: 'receipt_year',
                        margin: '0 0 0 20',
                        labelAlign: 'top',
                        width: 70,
                        action: 'regcashchangeyear',
                        value: localStorage.getItem('year')
                    }
                ]
            },
            {
                xtype: 'fieldcontainer',
                layout: 'hbox',
                height: 50,
                msgTarget: 'none',
                padding: 0,
                margin: 0,
                items: [
                    {
                        xtype: 'component',
                        flex: 1,
                        html: 'Generar Comprobante de Compra de Insumos y Materiales por la Cuenta Bancaria',
                        margin: '0 20 0 0',
                    },
                    {
                        xtype: 'checkboxfield',
                        allowBlank: false,
                        name: 'receipt_bank_no',
                        id: 'receipt_bank_no',
                        fieldLabel: 'No',
                        width: 40,
                        labelWidth: 20,
                        padding: 0,
                        margin: '0 10 0 0',
                        labelAlign: 'right',
                        checked: true,
                        listeners: {
                            'change': function(checkbox, newValue) {
                                if (newValue === true) {
                                    Ext.getCmp('receipt_bank_yes').setValue(false);
                                    Ext.getCmp('recipt_bank_expenses').setVisible(false);
                                }
                                else {
                                    Ext.getCmp('receipt_bank_yes').setValue(true);
                                    Ext.getCmp('recipt_bank_expenses').setVisible(true);
                                }
                            }
                        }
                    },{
                        xtype: 'checkboxfield',
                        allowBlank: false,
                        name: 'receipt_bank_yes',
                        id: 'receipt_bank_yes',
                        fieldLabel: 'Si',
                        width: 40,
                        labelWidth: 20,
                        padding: 0,
                        margin: 0,
                        labelAlign: 'right',
                        listeners: {
                            'change': function(checkbox, newValue) {
                                if (newValue === true) {
                                    Ext.getCmp('receipt_bank_no').setValue(false);
                                    Ext.getCmp('recipt_bank_expenses').setVisible(true);
                                }
                                else {
                                    Ext.getCmp('receipt_bank_no').setValue(true);
                                    Ext.getCmp('recipt_bank_expenses').setVisible(false);
                                }
                            }
                        }
                    }
                ]
            },
            {
                xtype: 'fieldcontainer',
                id: 'recipt_bank_expenses',
                layout: 'hbox',
                hidden: true,
                height: 40,
                msgTarget: 'none',
                padding: 0,
                margin: 0,
                items: [
                    {
                        xtype: 'textfield',
                        name: 'mpm',
                        fieldLabel: 'Materia Prima y Materiales',
                        emptyText: '0.00',
                        labelWidth: 170,
                        flex: 1,
                        afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Campo Obligatorio"> *</span>'
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