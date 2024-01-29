Ext.define('TCPContable.view.app.Login', {
    extend: 'Ext.form.Panel',
    id: 'loginCmp',
    alias : 'widget.login',
    renderTo: Ext.getBody(),
    title: 'TCP.Contable',
    icon: 'images/icons/user.png',
    height: 225,
    width: 340,
    frame:true,
    bodyPadding: 23,
    fieldDefaults: {
        anchor: '100%',
        labelAlign: 'left',
        labelWidth: 80,
        combineErrors: true,
        msgTarget: 'side'
    },
	
	initComponent: function() {
	
		Ext.apply(this, {
		
            items: [
                {
                    xtype: 'label',
                    text: 'Control de Acceso al Sistema',
                    margin: '0 0 30 50',
                    style: {
                        color: '#C09340'
                    }
                },
                {
                    xtype: 'textfield',
                    allowBlank: false,
                    fieldLabel: 'Usuario',
                    name: 'user',
                    id: 'LoginFormUsuario',
                    style: {
                        "margin-top": "20px",
                        "margin-bottom": "15px"
                    },
                    listeners: {
                        /*afterrender: function(field) {
                          field.focus(false, 600);
                        },*/
                        specialkey: function(field, e){
                            // e.HOME, e.END, e.PAGE_UP, e.PAGE_DOWN,
                            // e.TAB, e.ESC, arrow keys: e.LEFT, e.RIGHT, e.UP, e.DOWN
                            if (e.getKey() == e.ENTER) {
                                Ext.getCmp('loginPass').focus();
                            }
                        }
                    }
                },
                {
                    xtype: 'textfield',
                    id: 'loginPass',
                    allowBlank: false,
                    fieldLabel: 'Contrase\xF1a',
                    inputType: 'password',
                    name: 'pass'
                }
            ],
            buttons: [
                {
                    id: 'login_btn',
                    text: 'Entrar',
                    iconCls: 'fa fa-sign-in-alt glyph icon-white',
                    action: 'login'
                }
            ]
        });
    
        Ext.getBody().setStyle({
            "background": "url(images/desktop.jpg)",
            "background-size": "cover"
        });

        this.callParent(arguments);
    }
});