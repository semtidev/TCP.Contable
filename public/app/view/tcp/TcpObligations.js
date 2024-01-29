Ext.define('TCPContable.view.tcp.TcpObligations', {
    extend: 'Ext.form.field.ComboBox',
    alias : 'widget.TcpObligations',
 	store: Ext.create('TCPContable.store.Obligation'),
	displayField: 'obligation',
	valueField: 'id',
	editable: false
});
	