Ext.define('TCPContable.controller.App', {
    extend: 'Ext.app.Controller',
    models: ['Tcp', 'Obligation', 'Tcpcombo', 'Aft', 'Entryday', 'Entrymonth', 'Expenseday', 'Expensemonth', 'Tax', 'Stateresult', 'Statesituation', 'Regcashbox', 'Sublargest'],
    stores: ['Tcp', 'Obligation', 'Tcpcombo', 'Aft', 'Monthcombo', 'Yearcombo', 'Entryday', 'Entrymonth', 'Expenseday', 'Expensemonth', 'Tax', 'Stateresult', 'Statesituation', 'Regcashbox', 'Receiptcombo', 'Sublargest'],
    views: [
        'app.Login',
        'app.MainMenu',
        'app.App',
        'tcp.TcpBinding',
        'tcp.TcpObligations',
        'tcp.TcpCombo'
    ],
    init: function() {

        this.control({
            'login #loginPass': {
                specialkey: this.loginSpecialKey
            },
            'login button[action=login]': {
                click: this.login
            },
            'treepanel': {
                itemclick: this.openSystem
            }
        });
    },
    
    loginSpecialKey: function(field, e){
        // e.HOME, e.END, e.PAGE_UP, e.PAGE_DOWN,
        // e.TAB, e.ESC, arrow keys: e.LEFT, e.RIGHT, e.UP, e.DOWN
        if (e.getKey() == e.ENTER) {
            var button = Ext.getCmp('login_btn');
            this.login(button);
        }
    },

    login: function(button) {

        var form = button.up('form');

        if (form.isValid()) {

            form.getForm().submit({
                method: 'POST',
                url: 'api/login',
                waitTitle: 'Espere', //Titulo del mensaje de espera
                waitMsg: 'Autenticando usuario...', //Mensaje de espera
                success: function(form, action) {
                    var data = Ext.decode(action.response.responseText);
                    localStorage.setItem('user', data.user);
                    localStorage.setItem('name', data.name);
                    localStorage.setItem('rol', data.rol);
                    Ext.getCmp('loginCmp').destroy();
                    Ext.create('TCPContable.view.app.App');
                },
                failure: function(form, action) {
                    var data = Ext.decode(action.response.responseText);
                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: data.message,
                        icon: 'icon-MessageBox-error',
                        buttons: Ext.Msg.OK
                    });
                }
            });
        }
    },

    openSystem: function(t, record, item, index) {

        if (record.get('leaf')) {

            if (record.raw.tcp && (localStorage.getItem('tcp') == null || localStorage.getItem('tcp') == '')) {
                Ext.MessageBox.show({
                    title: 'Mensaje del Sistema',
                    msg: 'Debe seleccionar el TCP antes de acceder a esta opci\xF3n del Sistema',
                    icon: 'icon-MessageBox-info',
                    buttons: Ext.Msg.OK
                });
            }
            else
            {
                var panel = Ext.getCmp('content-panel');

                if (record.internalId == 'lnk_companies') {
                    panel.removeAll(true);
                    panel.add(Ext.create('TCPContable.view.tcp.TcpBinding'));
                }
                else if (record.internalId == 'lnk_entries') {
                    var entrydayStore = this.getEntrydayStore(),
                        entrymonthStore = this.getEntrymonthStore();
                    if (entrydayStore.isDestroyed) {
                        Ext.create('TCPContable.store.Entryday');
                    }
                    if (entrymonthStore.isDestroyed) {
                        Ext.create('TCPContable.store.Entrymonth');
                    }
                    panel.removeAll(true);
                    panel.add(Ext.create('TCPContable.view.process.EntryTab'));
                }
                else if (record.internalId == 'lnk_expenses') {
                    var expensedayStore   = this.getExpensedayStore(),
                        expensemonthStore = this.getExpensemonthStore(),
                        taxStore          = this.getTaxStore();
                    if (expensedayStore.isDestroyed) {
                        Ext.create('TCPContable.store.Expenseday');
                    }
                    if (expensemonthStore.isDestroyed) {
                        Ext.create('TCPContable.store.Expensemonth');
                    }
                    if (taxStore.isDestroyed) {
                        Ext.create('TCPContable.store.Tax');
                    }
                    panel.removeAll(true);
                    panel.add(Ext.create('TCPContable.view.process.ExpenseTab'));
                }
                else if (record.internalId == 'lnk_regcashbox') {
                    var regcashStore = this.getRegcashboxStore();
                    if (regcashStore.isDestroyed) {
                        Ext.create('TCPContable.store.Regcashbox');
                    }
                    panel.removeAll(true);                 
                    panel.add(Ext.create('TCPContable.view.models.RegCashboxGrid'));
                }
                else if (record.internalId == 'lnk_sublargest') {
                    var sublargestStore = this.getSublargestStore();
                    if (sublargestStore.isDestroyed) {
                        Ext.create('TCPContable.store.Sublargest');
                    }
                    panel.removeAll(true);               
                    panel.add(Ext.create('TCPContable.view.models.SubLargestGrid'));
                }
                else if (record.internalId == 'lnk_compreceipt') {
                    document.location = 'api/pdfPurchaseReceipts/' + localStorage.getItem('tcp');
                }
                else if (record.internalId == 'lnk_opereceipt') {
                    var receiptForm = Ext.create('TCPContable.view.models.ReceiptForm');
                    receiptForm.show();
                }
                else if (record.internalId == 'lnk_aft') {
                    var aftStore = this.getAftStore();
                    if (aftStore.isDestroyed) {
                        Ext.create('TCPContable.store.Aft');
                    }
                    panel.removeAll(true);                 
                    panel.add(Ext.create('TCPContable.view.process.AftGrid'));
                }
                else if (record.internalId == 'lnk_states') {
                    var resultStore    = this.getStateresultStore(),
                        situationStore = this.getStatesituationStore();
                    if (resultStore.isDestroyed) {
                        Ext.create('TCPContable.store.Stateresult');
                    }
                    if (situationStore.isDestroyed) {
                        Ext.create('TCPContable.store.Statesituation');
                    }
                    panel.removeAll(true);                
                    panel.add(Ext.create('TCPContable.view.models.StatesTab'));
                }
            }
        }
    }
})