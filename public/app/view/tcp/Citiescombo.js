Ext.define('TCPContable.view.tcp.Citiescombo', {
    extend: 'Ext.form.field.ComboBox',
    alias : 'widget.citiescombo',
    store: Ext.create('TCPContable.store.Citiescombo'),
	displayField: 'city',
    valueField: 'id',
    editable: false
});