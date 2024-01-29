Ext.define('TCPContable.store.Receiptcombo', {
	extend: 'Ext.data.Store',
	fields: ['abbr', 'name'],
    data : [
        {"abbr":"cmonth", "name":"Asientos Contables del Mes"},
        {"abbr":"cyear", "name":"Asientos Contables del A\xF1o"}
    ]
});