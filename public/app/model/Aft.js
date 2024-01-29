Ext.define('TCPContable.model.Aft',{
	extend: 'Ext.data.Model',
	fields: ['id', 'group', 'form_group', 'code', 'desc', 'product', 'um', 'ctdad', {name: 'price', type: 'float'}, {name: 'import', type: 'float'}, 'pay_date', 'live_year', {name: 'dep_year', type: 'float'}, {name: 'dep_month', type: 'float'}, 'current_live']
});