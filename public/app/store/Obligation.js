Ext.define('TCPContable.store.Obligation', {
	extend: 'Ext.data.Store',
	model: 'TCPContable.model.Obligation',
	autoLoad: true,
	proxy: {
		type: 'ajax',
		url : 'api/obligations',
		reader: {
			type: 'json',
			root: 'obligations',
			successProperty: 'success'
		}
	}	
});