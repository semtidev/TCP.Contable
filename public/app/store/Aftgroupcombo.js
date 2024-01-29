Ext.define('TCPContable.store.Aftgroupcombo', {
	extend: 'Ext.data.Store',
	model: 'TCPContable.model.Aftgroupcombo',
	autoLoad: true,
	proxy: {
		type: 'ajax',
		url : 'api/aftgrouplist',
		reader: {
			type: 'json',
			root: 'aftgroup',
			successProperty: 'success'
		}
	}	
});