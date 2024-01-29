Ext.define('TCPContable.controller.Receipts', {
    extend: 'Ext.app.Controller',
    views: [
        'models.ReceiptForm'
    ],
    refs: [
        {
            ref: 'receiptform',
            selector: 'receiptform'
        }
    ],
    init: function() {

        this.control({
            'receiptform button[action=pdf]': {
                click: this.pdfReceipts
            }
        });
    },
    
    pdfReceipts: function(button) {
        
        var win    = button.up('window'),
            form   = win.down('form'),
            values = form.getValues(),
            tcp    = localStorage.getItem('tcp');
        
        if (values.receipt_bank_yes == 'on' && (parseFloat(values.mpm) == 0 || values.mpm == '')) {

            Ext.MessageBox.show({
                title: 'Mensaje del Sistema',
                msg: 'Ha ocurrido un error en la operaci\xF3n. Por favor, compruebe que sea v\xE1lido el gasto de compra de Materias Primas y Materiales, debe ser un n\xFAmero mayor que cero.',
                icon: Ext.MessageBox.ERROR,
                buttons: Ext.Msg.OK
            });
            return;
        }
        else {

            form.getForm().doAction('standardsubmit',{
            url: 'api/pdfReceipts/',
            standardSubmit: true,
            scope: this,
            method: 'GET',
            params: {id_tcp: tcp},
            waitTitle: 'Creando PDF...',
            waitMsg: 'Esta operaci\xF3n puede tardar unos minutos. Por favor, espere.',
            success: function(form, action) {
                formpdf.destroy();//or destroy();
            }
            });
            
            Ext.defer(function() {
                Ext.MessageBox.hide();
            }, 5000);
        }
    }
})