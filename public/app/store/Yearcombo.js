var year = new Date().getFullYear();
Ext.define('TCPContable.store.Yearcombo', {
    extend: 'Ext.data.Store',
    fields: ['year'],
    data : [
        {"year": year - 4},
        {"year": year - 3},
        {"year": year - 2},
        {"year": year - 1},
        {"year": year},
    ]
});