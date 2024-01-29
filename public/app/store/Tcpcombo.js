Ext.define('TCPContable.store.Tcpcombo', {
	extend: 'Ext.data.Store',
	model: 'TCPContable.model.Tcpcombo',
	autoLoad: true,
	proxy: {
		type: 'ajax',
		url : 'api/tcplist',
		reader: {
			type: 'json',
			root: 'tcp',
			successProperty: 'success'
		}
	}	
});