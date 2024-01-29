Ext.define('TCPContable.view.app.MainMenu', {
    extend: 'Ext.tree.Panel',
    id: 'treeMainmenu',
    alias: 'widget.treeMainmenu',
    region:'north',
    split: true,
    flex: 1,
    rootVisible: false,
    autoScroll: true,
    store: Ext.create('Ext.data.TreeStore', {
        root: {
            expanded: true,
            children: [
                { text: "Registro TCP", iconCls: "icon_tcp", cls: "linked", leaf: true, tcp: false, id: 'lnk_companies' },
                { text: "Registro Ingresos", iconCls: "icon_operations", cls: "linked", tcp: true, id: 'lnk_entries', leaf: true },
                { text: "Registro Gastos", iconCls: "icon_operations", cls: "linked", tcp: true, id: 'lnk_expenses', leaf: true },
                { text: "Modelos", iconCls: "icon_folder", cls: "system_name", expanded: false, children: [
                    { text: "Comprobante Compras", iconCls: "icon_informes", cls: "linked", tcp: true, leaf: true, id: 'lnk_compreceipt' },
                    { text: "Comprobante Operaciones", iconCls: "icon_informes", cls: "linked", tcp: true, leaf: true, id: 'lnk_opereceipt' },
                    { text: "Entrada-Salida de Efectivo", iconCls: "icon_informes", cls: "linked", tcp: true, leaf: true, id: 'lnk_regcashbox'},
                    { text: "Submayor de Cuenta", iconCls: "icon_informes", cls: "linked", tcp: true, leaf: true, id: 'lnk_sublargest'},
                    /*{ text: "Mayor de Cuenta", iconCls: "icon_informes", cls: "linked", tcp: true, leaf: true},*/
                    { text: "Inventario del Patrimonio", iconCls: "icon_informes", cls: "linked", tcp: true, leaf: true, id: 'lnk_aft'},
                    { text: "Estados Financieros", id: 'lnk_states', iconCls: "icon_informes", cls: "linked", tcp: true, leaf: true}
                ] },
                { text: "Base Legal", iconCls: "icon_folder", cls: "system_name", expanded: false, children: [
                    { text: '<a href="documents/Res-386-2010 Contabilidad Simplificada.pdf" target="_blank">Res-386-2010 Contabilidad Simplificada</a>', iconCls: "icon_pdf", cls: "linked", tcp: false, leaf: true },
                    { text: '<a href="documents/ANEXO 1 nctcp 1 Res 386-10.pdf" target="_blank">ANEXO 1 nctcp 1 Res 386-10</a>', iconCls: "icon_pdf", cls: "linked", tcp: false, leaf: true},
                    { text: '<a href="documents/ANEXO 2 Nomenclador Res 386-10.pdf" target="_blank">ANEXO 2 Nomenclador Res 386-10</a>', iconCls: "icon_pdf", cls: "linked", tcp: false, leaf: true},
                    { text: '<a href="documents/ANEXO 3 USO Y CONTENIDO Res 386-10.pdf" target="_blank">ANEXO 3 USO Y CONTENIDO Res 386-10</a>', iconCls: "icon_pdf", cls: "linked", tcp: false, leaf: true},
                    { text: '<a href="documents/ANEXO 4 Asientos tipos.pdf" target="_blank">ANEXO 4 Asientos tipos</a>', iconCls: "icon_pdf", cls: "linked", tcp: false, leaf: true},
                    { text: '<a href="documents/ANEXO  5 Ejemplos de Registros.pdf" target="_blank">ANEXO  5 Ejemplos de Registros</a>', iconCls: "icon_pdf", cls: "linked", tcp: false, leaf: true}
                ] }
            ]
        }
    })
})