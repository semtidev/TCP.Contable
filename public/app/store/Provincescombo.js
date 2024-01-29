Ext.define('TCPContable.store.Provincescombo', {
	extend: 'Ext.data.Store',
	model: 'TCPContable.model.Provincescombo',
	autoLoad: true,
	proxy: {
		type: 'ajax',
		url : 'api/provinceslist',
		reader: {
			type: 'json',
			root: 'provinces',
			successProperty: 'success'
		}
	}	
});