Ext.define('TCPContable.view.app.Monthcombo', {
    extend: 'Ext.form.ComboBox',
    alias: 'widget.monthcombo',
    id: 'monthcombo',
    width: 150,
    fieldLabel: 'Mes',
    labelWidth: 30,
    store: Ext.create('TCPContable.store.Monthcombo'),
    queryMode: 'local',
    editable: false,
    displayField: 'name',
    valueField: 'id',
    value: localStorage.getItem('month')
});