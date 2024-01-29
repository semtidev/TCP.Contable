Ext.define('TCPContable.view.process.AftForm', {
    extend: 'Ext.window.Window',
    alias: 'widget.aftform',
    requires: ['Ext.form.Panel', 'Ext.form.field.Text', 'Ext.form.field.ComboBox', 'Ext.ux.DataTip'],
    layout: 'fit',
    autoShow: true,
    width: 580,
    modal: true,
    //animateTarget: 'tcpCreateBtn',
    iconCls: 'icon_informes',
    initComponent: function() {
        this.items = [{
                xtype: 'form',
                border: false,
                padding: 20,
                bodyStyle: {
                    background: '#FFF'
                },
                fieldDefaults: {
                    anchor: '100%',
                    labelAlign: 'left',
                    labelWidth: 80,
                    combineErrors: true,
                    msgTarget: 'side'
                },
                items: [{
                    xtype: 'textfield',
                    name: 'id',
                    hidden: true
                }, {
                    xtype: 'textfield',
                    name: 'tcp',
                    value: localStorage.getItem('tcp'),
                    hidden: true
                }, {
                    xtype: 'aftgroupcombo',
                    id: 'aftFormGroup',
                    allowBlank: false,
                    fieldLabel: 'Grupo',
                    emptyText: 'Elija el Grupo...',
                    labelWidth: 60,
                    flex: 1,
                    margin: '0 0 10 0',
                    name: 'form_group',
                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                }, {
                    xtype: 'textfield',
                    allowBlank: false,
                    fieldLabel: 'ATF',
                    emptyText: 'Nombre Activo Fijo Tangible',
                    labelWidth: 60,
                    flex: 1,
                    margin: '0 0 10 0',
                    name: 'product',
                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                }, {
                    xtype: 'fieldcontainer',
                    combineErrors: true,
                    msgTarget: 'none', // qtip  title  under
                    margin: '0 auto 10 auto',
                    layout: 'hbox',

                    items: [{
                            xtype: 'numberfield',
                            allowBlank: false,
                            fieldLabel: 'Ctdad',
                            labelWidth: 60,
                            flex: .7,
                            minValue: 1,
                            maxValue: 100,
                            value: 1,
                            margin: '0 10 5 0',
                            name: 'ctdad',
                            afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                        }, {
                            xtype: 'textfield',
                            allowBlank: false,
                            fieldLabel: 'Precio',
                            tooltip: 'Precio Unitario CUP',
                            emptyText: '0.00',
                            flex: .8,
                            margin: '0 10 5 0',
                            labelWidth: 60,
                            labelAlign: 'right',
                            name: 'price',
                            afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                        }, {
                            xtype: 'datefield',
                            allowBlank: false,
                            fieldLabel: 'Fecha',
                            tooltip: 'Fecha Adquisici\xF3n',
                            emptyText: 'dd/mm/aaaa',
                            flex: 1,
                            margin: '0 0 5 0',
                            labelWidth: 60,
                            labelAlign: 'right',
                            name: 'pay_date',
                            maxValue: new Date(),
                            value: new Date(),
                            format: 'Y-m-d',
                            afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                        }]
                }]
            }];

        this.dockedItems = [{
                xtype: 'toolbar',
                dock: 'bottom',
                id: 'buttons',
                ui: 'footer',
                items: ['->', {
                        iconCls: 'icon-save',
                        text: 'Agregar',
                        action: 'save'
                    }, {
                        //iconCls: 'icon-reset',
                        text: 'Cancelar',
                        scope: this,
                        handler: this.close
                    }]
            }];

        this.callParent(arguments);
    }
});