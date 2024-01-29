Ext.application({
    name: 'TCPContable',
    appFolder: 'app',
    controllers: ['App', 'Tcp', 'Aft', 'Entry', 'Expense', 'States', 'Regcash', 'Receipts', 'Sublargest'],
    launch: function() {
        
        // Set LocalStorage month & year
        var month = new Date().getMonth() + 1;
        if (month < 10) { month = '0' + month; }
        localStorage.setItem('month', month);
        localStorage.setItem('year', new Date().getFullYear());

        if(localStorage.getItem('user') != null){
            Ext.create('TCPContable.view.app.App');
        }
        else{
            Ext.create('TCPContable.view.app.Login').center();
        }

        // Go Home
        $(document).on('click', '#homeBtn', function(){
            
            var panel = Ext.getCmp('content-panel'),
                treepanel = $('.x-grid-table');

            // remove previous wrapper        
            panel.removeAll(false);
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
        });

        // User logout
        $(document).on('click', '#logoutBtn', function(){
            Ext.MessageBox.confirm('Confirmaci\xF3n', 'Est\xE1 seguro que desea finalizar su sesi\xF3n en CTP.Contable?', function(btn){
                    if(btn == 'yes') {
                        localStorage.removeItem('user');
                        localStorage.removeItem('name');
                        localStorage.removeItem('rol');
                        localStorage.removeItem('tcp');
                        localStorage.removeItem('tcp-company');
                        localStorage.removeItem('tcp-workers');
                        localStorage.removeItem('tcp-nit');
                        localStorage.removeItem('tcp-activity');
                        localStorage.removeItem('month');
                        localStorage.removeItem('year');
                        localStorage.removeItem('col7');
                        localStorage.removeItem('col8');
                        localStorage.removeItem('col9');
                        localStorage.removeItem('col10');
                        localStorage.removeItem('col11');
                        localStorage.removeItem('col12');
                        localStorage.removeItem('col17');
                        localStorage.removeItem('col18');
                        localStorage.removeItem('col19');
                        localStorage.removeItem('tcp_cashbox_saldstart');
                        localStorage.removeItem('tcp_cashbox_datestart');
                        document.location.reload();
                    }
                });
        });
    }
});