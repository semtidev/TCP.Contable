Ext.define('TCPContable.view.tcp.TcpCombo', {
    extend: 'Ext.form.field.ComboBox',
    alias : 'widget.tcpcombo',
    store: Ext.create('TCPContable.store.Tcpcombo'),
	displayField: 'name',
    valueField: 'id',
    editable: false,
    listeners: {
        'render': function(combo, eOpts) {
            if (localStorage.getItem('tcp') != null && localStorage.getItem('tcp') != ''){
                combo.setValue(parseInt(localStorage.getItem('tcp')));
            }
        },
        'change': function(combo, newValue, oldValue, eOpts) {
            if (combo.getStore().count() > 0) {
                var record = combo.findRecord(combo.valueField || combo.displayField, newValue);
                var store = combo.getStore().getAt(record.index);
                // Local Storage TCP
                localStorage.setItem('tcp', newValue);
                localStorage.setItem('tcp-company', store.get('company'));
                localStorage.setItem('tcp-workers', store.get('workers'));
                localStorage.setItem('tcp-nit', store.get('nit'));
                localStorage.setItem('tcp-activity', store.get('act_desc'));
                localStorage.setItem('tcp_cashbox_saldstart', store.get('tcp_cashbox_saldstart'));
                localStorage.setItem('tcp_cashbox_datestart', store.get('tcp_cashbox_datestart'));
                // TCP Columns
                localStorage.setItem('col7', store.get('col7'));
                localStorage.setItem('col8', store.get('col8'));
                localStorage.setItem('col9', store.get('col9'));
                localStorage.setItem('col10', store.get('col10'));
                localStorage.setItem('col11', store.get('col11'));
                localStorage.setItem('col12', store.get('col12'));
                localStorage.setItem('col17', store.get('col17'));
                localStorage.setItem('col18', store.get('col18'));
                localStorage.setItem('col19', store.get('col19'));
                // define a template to use for the detail view
                var bookTplMarkup = [
                    '<div class="details-company"><strong>Empresa:</strong><h4>'+localStorage.getItem('tcp-company')+'</h4>',
                    '<strong>Plantilla:</strong><h4>'+localStorage.getItem('tcp-workers')+' Trabajador(es)</h4>',
                    '<strong>NIT:</strong><h4>'+localStorage.getItem('tcp-nit')+'</h4>',
                    '<strong>Actividad:</strong><h4>'+localStorage.getItem('tcp-activity')+'</h4></div>'
                ];
                var bookTpl = Ext.create('Ext.Template', bookTplMarkup);
                var detailPanel = Ext.getCmp('details-company');
                if (detailPanel) {
                    detailPanel.update(bookTpl);
                }

                // Go Home
                var panel = Ext.getCmp('content-panel'),
                    treepanel = $('.x-grid-table');

                // remove previous wrapper        
                panel.removeAll(true);
                treepanel.find('.x-grid-row').removeClass('x-grid-row-selected');
                treepanel.find('.x-grid-row').removeClass('x-grid-row-focused');

                // adds a new wrapper with accordion layout containing the items copy
                panel.add({
                    bodyStyle: {
                        "background": "url(images/desktop.jpg)",
                        "background-size": "cover"
                    },
                    html: '<div class="home_appname"><h1>TCP.Contable</h1>Sistema de Gesti&oacute;n Contable Simplificada<h6>Copyright &copy; 2019 SEMTI. Todos los derechos reservados.</h6></div>'
                });
            }
        }
    }
});