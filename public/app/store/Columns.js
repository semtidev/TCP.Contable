Ext.define('TCPContable.store.Columns', {
	extend: 'Ext.data.Store',
    model: 'TCPContable.model.Columns',
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
            root: 'columns',
            successProperty: 'success',
            messageProperty: 'message'
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