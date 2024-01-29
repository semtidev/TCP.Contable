Ext.define('TCPContable.store.Regcashbox', {
	extend: 'Ext.data.Store',
    model: 'TCPContable.model.Regcashbox',
    autoLoad: false,
    autoDestroy: true,
    proxy: {
        pageParam: false, //to remove param "page"
        startParam: false, //to remove param "start"
        limitParam: false, //to remove param "limit"
        noCache: false, //to remove param "_dc"
        type: 'ajax',
        reader: {
            type: 'json',
            root: 'regcash',
            successProperty: 'success',
            messageProperty: 'message'
        },
        writer: {
            type: 'json',
            encode: true,
            root: 'regcash'
        },
        listeners: {
            exception: function(proxy, response, operation) {
                var store = Ext.getStore('Regcashbox');
                store.removeAll();                
                Ext.MessageBox.show({
                    title: 'Mensaje del Sistema',
                    msg: operation.getError(),
                    icon: Ext.MessageBox.ERROR,
                    buttons: Ext.Msg.OK
                });
            }
        }
    }
});