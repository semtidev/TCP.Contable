Ext.define('TCPContable.store.Accountscombo', {
	extend: 'Ext.data.Store',
	fields: ['code', 'account'],
    data : [
        {"code": "100", "account": "100 - Efectivo en Caja"},
        {"code": "110", "account": "110 - Efectivo en Banco"},
        {"code": "200", "account": "200 - Activos Fijos Tangibles"}
    ]
});