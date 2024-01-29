Ext.define('TCPContable.store.Tcp', {
	extend: 'Ext.data.Store',
	model: 'TCPContable.model.Tcp',
	pageSize: 20,
    autoLoad: {start: 0, limit: 20},
    autoLoad: true,
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/tcp'
        },
        reader: {
            type: 'json',
            root: 'tcp',
            successProperty: 'success',
            messageProperty: 'message'
        },
        writer: {
            type: 'json',
            encode: true,
            root: 'tcp'
        },
        listeners: {
            exception: function(proxy, response, operation) {
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