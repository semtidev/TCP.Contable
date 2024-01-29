Ext.define('TCPContable.view.tcp.TcpForm', {
    extend: 'Ext.window.Window',
    alias: 'widget.tcpform',
    requires: ['Ext.form.Panel', 'Ext.form.field.Text', 'Ext.form.field.ComboBox'],
    layout: 'fit',
    autoShow: true,
    width: 650,
    modal: true,
    //animateTarget: 'tcpCreateBtn',
    iconCls: 'icon_tcp',
    
    initComponent: function() {
        this.items = [{
                xtype: 'form',
                border: false,
                bodyStyle: {
                    background: '#F1F5F9',
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
                    xtype: 'fieldset',
                    flex: 1,
                    collapsible: false,
                    collapsed: false,
                    title: 'EMPRESA',
                    layout: 'anchor',
                    padding: '15 20 15 20',
                    margin: '15 20 10 20',
                    defaults: {
                            anchor: '100%',
                            labelWidth: 100,
                            hideEmptyLabel: true
                    },
                    items: [{
                            xtype: 'fieldcontainer',
                            combineErrors: true,
                            msgTarget: 'none', // qtip  title  under
                            margin: '0 auto 10 auto',
                            layout: 'hbox',
    
                            items: [{
                                    xtype: 'textfield',
                                    id: 'tcpFormCompany',
                                    allowBlank: false,
                                    fieldLabel: 'Nombre',
                                    emptyText: 'Nombre del Negocio',
                                    labelWidth: 60,
                                    flex: 2,
                                    margin: '0 10 5 0',
                                    name: 'company',
                                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                                }, {
                                    xtype: 'numberfield',
                                    minValue: 1,
                                    maxValue: 100,
                                    value: 1,
                                    tooltip: 'Cantidad de Trabajadores',
                                    allowBlank: false,
                                    fieldLabel: 'Obreros',
                                    flex: 1,
                                    margin: '0 0 5 0',
                                    labelWidth: 80,
                                    labelAlign: 'right',
                                    name: 'workers',
                                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                                }]
                        }, {
                            xtype: 'fieldcontainer',
                            combineErrors: true,
                            msgTarget: 'none', // qtip  title  under
                            margin: '0 auto 10 auto',
                            layout: 'hbox',
    
                            items: [{
                                    xtype: 'textfield',
                                    allowBlank: false,
                                    fieldLabel: 'Act. C\xF3digo',
                                    flex: 1,
                                    margin: '0 10 5 0',
                                    labelAlign: 'right',
                                    labelWidth: 85,
                                    name: 'act_code',
                                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                                }, {
                                    xtype: 'textfield',
                                    allowBlank: true,
                                    fieldLabel: 'Direcci\xF3n',
                                    emptyText: 'Direcci\xF3n Fiscal',
                                    flex: 2,
                                    margin: '0 0 5 0',
                                    labelAlign: 'right',
                                    labelWidth: 70,
                                    name: 'address_company'
                                }]
                        }, {
                            xtype: 'fieldcontainer',
                            combineErrors: true,
                            msgTarget: 'none', // qtip  title  under
                            margin: '0 auto 10 auto',
                            layout: 'hbox',
    
                            items: [{
                                    xtype: 'provincescombo',
                                    allowBlank: false,
                                    fieldLabel: 'Provincia',
                                    flex: 1,
                                    margin: '0 10 5 0',
                                    labelAlign: 'right',
                                    labelWidth: 70,
                                    name: 'province_company',
                                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                                }, {
                                    xtype: 'citiescombo',
                                    allowBlank: true,
                                    fieldLabel: 'Municipio',
                                    flex: 1,
                                    margin: '0 0 5 0',
                                    labelAlign: 'right',
                                    labelWidth: 70,
                                    name: 'city_company'
                                }]
                        },{
                            xtype: 'fieldcontainer',
                            combineErrors: true,
                            msgTarget: 'none', // qtip  title  under
                            margin: '0 auto 10 auto',
                            layout: 'hbox',
    
                            items: [{
                                    xtype: 'textfield',
                                    allowBlank: false,
                                    fieldLabel: 'Act. Descrip',
                                    flex: 2,
                                    margin: '0 10 5 0',
                                    labelAlign: 'right',
                                    labelWidth: 90,
                                    name: 'act_desc',
                                    emptyText: 'Descripci\xF3n Actividad',
                                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                                }, {
                                    xtype: 'textfield',
                                    allowBlank: false,
                                    name: 'nit',
                                    flex: 1,
                                    margin: '0 0 5 0',
                                    labelWidth: 35,
                                    labelAlign: 'right',
                                    fieldLabel: 'NIT',
                                    emptyText: 'N\xFAmero NIT',
                                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                                }]
                        }]
                }, {
                    xtype: 'fieldset',
                    flex: 1,
                    collapsible: false,
                    collapsed: false,
                    title: 'TITULAR',
                    //defaultType: 'datefield', // each item will be a checkbox
                    layout: 'anchor',
                    padding: '15 20 15 20',
                    margin: '15 20 10 20',
                    defaults: {
                            anchor: '100%',
                            labelWidth: 100,
                            hideEmptyLabel: true
                    },
                    items: [{
                            xtype: 'fieldcontainer',
                            combineErrors: true,
                            msgTarget: 'none', // qtip  title  under
                            margin: '0 auto 10 auto',
                            layout: 'hbox',
    
                            items: [{
                                    xtype: 'textfield',
                                    allowBlank: false,
                                    fieldLabel: 'Nombre',
                                    emptyText: 'Nombre del Titular',
                                    labelWidth: 60,
                                    flex: .9,
                                    margin: '0 10 5 0',
                                    name: 'name',
                                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                                }, {
                                    xtype: 'textfield',
                                    allowBlank: false,
                                    fieldLabel: 'Apellidos',
                                    emptyText: 'Apellidos del Titular',
                                    labelWidth: 80,
                                    margin: '0 0 5 0',
                                    labelAlign: 'right',
                                    name: 'last_name',
                                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                                }]
                        }, {
                            xtype: 'fieldcontainer',
                            combineErrors: true,
                            msgTarget: 'none', // qtip  title  under
                            margin: '0 auto 10 auto',
                            layout: 'hbox',
    
                            items: [{
                                    xtype: 'textfield',
                                    allowBlank: false,
                                    name: 'ci',
                                    flex: 1,
                                    margin: '0 10 5 0',
                                    labelWidth: 30,
                                    labelAlign: 'right',
                                    fieldLabel: 'CI',
                                    emptyText: 'No Identidad',
                                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                                },{
                                    xtype: 'textfield',
                                    allowBlank: false,
                                    fieldLabel: 'Direcci\xF3n',
                                    margin: '0 0 5 0',
                                    flex: 2,
                                    labelAlign: 'right',
                                    labelWidth: 80,
                                    name: 'address',
                                    emptyText: 'Direcci\xF3n Particular',
                                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                                }]
                        }, {
                            xtype: 'fieldcontainer',
                            combineErrors: true,
                            msgTarget: 'none', // qtip  title  under
                            margin: '0 auto 10 auto',
                            layout: 'hbox',
    
                            items: [{
                                    xtype: 'provincescombo',
                                    allowBlank: false,
                                    fieldLabel: 'Provincia',
                                    flex: 1,
                                    margin: '0 10 5 0',
                                    labelAlign: 'right',
                                    labelWidth: 70,
                                    name: 'province',
                                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                                }, {
                                    xtype: 'citiescombo',
                                    allowBlank: true,
                                    fieldLabel: 'Municipio',
                                    flex: 1,
                                    margin: '0 0 5 0',
                                    labelAlign: 'right',
                                    labelWidth: 70,
                                    name: 'city'
                                }]
                        }, {
                            xtype: 'fieldcontainer',
                            combineErrors: true,
                            msgTarget: 'none', // qtip  title  under
                            layout: 'hbox',
    
                            items: [{
                                    xtype: 'textfield',
                                    allowBlank: true,
                                    fieldLabel: 'Tel\xE9fono',
                                    flex: 1,
                                    margin: '0 10 5 0',
                                    labelAlign: 'right',
                                    labelWidth: 50,
                                    name: 'telephone'
                                }, {
                                    xtype: 'textfield',
                                    allowBlank: true,
                                    fieldLabel: 'Correo',
                                    flex: 1,
                                    margin: '0 0 5 0',
                                    labelAlign: 'right',
                                    labelWidth: 70,
                                    vtype:'email',
                                    name: 'email'
                                }]
                        }]
                }, {
                    xtype: 'fieldset',
                    flex: 1,
                    collapsible: false,
                    collapsed: false,
                    title: 'OBLIGACIONES',
                    //defaultType: 'datefield', // each item will be a checkbox
                    layout: 'anchor',
                    padding: '15 20 15 20',
                    margin: '15 20 20 20',
                    defaults: {
                            anchor: '100%',
                            labelWidth: 100,
                            hideEmptyLabel: true
                    },
                    items: [{
                            xtype: 'TcpObligations',
                            allowBlank: false,
                            editable: false,
                            multiSelect: true,
                            fieldLabel: 'Obligaciones',
                            emptyText: 'Elija las obligaciones...',
                            labelWidth: 90,
                            labelAlign: 'right',
                            flex: 1,
                            margin: '0 0 5 0',
                            name: 'obligations',
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