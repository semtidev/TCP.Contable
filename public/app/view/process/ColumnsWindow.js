Ext.define('TCPContable.view.process.ColumnsWindow', {
    extend: 'Ext.window.Window',
    xtype: 'columnswindow',
    id: 'columnswindow',
    modal: true,
    iconCls: 'icon_columns',
    title: 'Columnas Opcionales',
    width: 600,
    height: 297,
    layout: 'fit',
    items: {
        xtype: 'columnsgrid',
        border: false
    }
})