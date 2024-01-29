Ext.define('TCPContable.store.Sublargest', {
	extend: 'Ext.data.Store',
    model: 'TCPContable.model.Sublargest',
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
            root: 'sublargest',
            successProperty: 'success',
            messageProperty: 'message'
        },
        writer: {
            type: 'json',
            encode: true,
            root: 'sublargest'
        },
        listeners: {
            exception: function(proxy, response, operation) {
                var store = Ext.getStore('Sublargest');
                store.removeAll();
                Ext.MessageBox.show({
                    title: 'Mensaje del Sistema',
                    msg: operation.getError(),
                    icon: Ext.MessageBox.ERROR,
                    buttons: Ext.Msg.OK
                });
            }
        }
    },
    listeners: {
        load: function( store, records, successful, eOpts ) {
            if (successful) {
                Ext.getCmp('sublargestprt').setDisabled(false);
            }
            else {
                Ext.getCmp('sublargestprt').setDisabled(true);
            }
        }
    }
});