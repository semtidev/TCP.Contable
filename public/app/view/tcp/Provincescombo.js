Ext.define('TCPContable.view.tcp.Provincescombo', {
    extend: 'Ext.form.field.ComboBox',
    alias : 'widget.provincescombo',
    store: Ext.create('TCPContable.store.Provincescombo'),
	displayField: 'province',
    valueField: 'id',
    editable: false
});