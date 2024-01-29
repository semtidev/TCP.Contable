Ext.define('TCPContable.view.app.Yearcombo', {
    extend: 'Ext.form.ComboBox',
    alias: 'widget.yearcombo',
    id: 'yearcombo',
    width: 110,
    fieldLabel: 'A\xF1o',
    labelWidth: 30,
    store: Ext.create('TCPContable.store.Yearcombo'),
    queryMode: 'local',
    editable: false,
    displayField: 'year',
    valueField: 'year',
    value: localStorage.getItem('year')
});