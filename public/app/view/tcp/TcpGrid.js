Ext.define('TCPContable.view.tcp.TcpGrid', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.tcpgrid',
    requires: [
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.panel.*',
        'Ext.layout.container.Border'
    ],
    listeners: {
        'selectionchange': function(view, records) {
            this.down('#edit').setDisabled(!records.length);//Se Habilita el Boton Editar
            this.down('#delete').setDisabled(!records.length);//Se Habilita el Boton Delete
            if (records.length) {
                // define a template to use for the detail view
                var bookTplMarkup = [
                    '<div class="details-info"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="top"><strong>Empresa</strong>: {company}</br>',
                    '<strong>Nombre</strong>: {name}<br/>',
                    '<strong>Apellidos</strong>: {last_name}<br/>',
                    '<strong>No. Identidad</strong>: {ci}<br/>',
                    '<strong>Direcci\xF3n</strong>: {address}<br/>',
                    '<strong>Tel\xE9fono</strong>: {telephone}<br/>',
                    '<strong>Correo</strong>: {email}</td>',
                    '<td width="50%" valign="top"><strong>Obligaciones</strong>:</br> {html_obligations}</td><tr></table></div>'
                ];
                var bookTpl = Ext.create('Ext.Template', bookTplMarkup);
                var detailPanel = Ext.getCmp('detailPanel');
                detailPanel.update(bookTpl.apply(records[0].data));
            }
        }
    },
    store: 'Tcp',
    columnLines: true,
    forceFit: true,
    flex: 2,
    split: true,
    region: 'north',
    columns: [
        { header: "Empresa", flex: 1.2, dataIndex: 'company' },
        { header: "Direcci\xF3n Fiscal", flex: 1.3, dataIndex: 'address_company' }, 
        { header: "NIT", flex: .5, dataIndex: 'nit' }, 
        { header: "Act. C\xF3digo", flex: .5, dataIndex: 'act_code', align: 'center', sortable: false }, 
        { header: "Act. Descripci\xF3n", flex: 1.3, dataIndex: 'act_desc' }, 
        { header: "Obreros", flex: .4, dataIndex: 'workers', align: 'center' } 
    ],
    viewConfig: {stripeRows: true},
    initComponent: function() {

        this.dockedItems = [{
                xtype: 'toolbar',
                cls: 'toolbar',
                items: [{
                        iconCls: 'icon-add',
                        cls: 'toolbar_button',
                        xtype: 'button',
                        id: 'tcpCreateBtn',
                        text: 'Nuevo',
                        tooltip: 'Nuevo TCP',
                        action: 'create'
                    }, {
                        itemId: 'edit',
                        iconCls: 'icon-edit',
                        cls: 'toolbar_button',
                        text: 'Modificar',
                        disabled: true,
                        tooltip: 'Modificar TCP seleccionado',
                        action: 'update'
                    }, {
                        itemId: 'delete',
                        iconCls: 'icon-delete',
                        cls: 'toolbar_button',
                        text: 'Eliminar',
                        disabled: true,
                        tooltip: 'Eliminar TCP seleccionado',
                        action: 'delete'
                    }, '->', {
                        iconCls: 'icon-reload',
                        cls: 'toolbar_button',
                        text: 'Actualizar',
                        tooltip: 'Actualizar Listado de TCP',
                        action: 'reload'
                    }]
            }];

        this.callParent(arguments);
    }
});

