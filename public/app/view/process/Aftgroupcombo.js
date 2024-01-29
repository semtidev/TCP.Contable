Ext.define('TCPContable.view.process.AftgroupCombo', {
    extend: 'Ext.form.field.ComboBox',
    alias : 'widget.aftgroupcombo',
    store: Ext.create('TCPContable.store.Aftgroupcombo'),
	displayField: 'group',
    valueField: 'group',
    editable: false
});