@extends('layouts.pdfbookmodels')

@section('title', 'Comprobantes de Operaciones')

@section('content')
    <!------------------------------------------
    ---------------    PAGE 1    ---------------
    ------------------------------------------->
    <div class="cover">
        <div class="logo">
            <img src="{{ public_path('images/onat-piramidal.jpg') }}">
        </div>
        <div class="system">Sistema Contable</div>
        <div class="reportname">Comprobantes de Operaciones</div>
        <div class="year">Ejercicio Contable @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}</div>
    </div>
    
    <div class="page-break"></div>
    <!------------------------------------------
    -------------    END PAGE 1    -------------
    ------------------------------------------->

    <!------------------------------------------
    ---------------    PAGE 2    ---------------
    ------------------------------------------->
    <header>
        <div style="width: 100%; text-align:center; padding-top: 3px;"><font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif;">-&nbsp;<span class="pagenum"></span>&nbsp;-</font></div>
    </header>
    <table class="table_tcp" cellspacing="0" cellpadding="0" rules="rows">
        <tr>
            <td>
                <table  width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    <tr>
                        <td width="80%" style="text-align: center; text-transform: uppercase; padding: 10px 20px; border-right: #333 1px solid;">
                            <strong>Comprobantes de Operaciones</strong>
                        </td>
                        <td style="padding: 0;" valign="top">
                            <span style="color: #666; font-size: 12px;">&nbsp;Per&iacute;odo</span><br>
                            <div style="width: 100%; text-align: center;">
                                @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table  width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    <tr>
                        <td width="80%" style="padding: 0; border-right: #333 1px solid;" valign="top">
                            <span style="color: #666; font-size: 12px;">&nbsp;Nombre(s) y Apellidos del Contribuyente</span><br>
                            <div style="width: 100%; text-align: center;">
                                {{ $tcp->name . ' ' . $tcp->last_name }}
                            </div>
                        </td>
                        <td style="padding: 0;" valign="top">
                            <span style="color: #666; font-size: 12px;">&nbsp;NIT</span><br>
                            <div style="width: 100%; text-align: center;">
                                {{ $tcp->nit }}
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table  width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    <tr>
                        <td style="padding: 0;" valign="top">
                            <span style="color: #666; font-size: 12px;">&nbsp;Domicilio fiscal (lugar donde desarrolla la actividad): Calle, No, Apto, entre calles</span><br>
                            <div style="width: 100%; text-align: center;">
                                {{ $tcp->address_company }}
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table  width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    <tr>
                        <td width="50%" style="padding: 0; border-right: #333 1px solid;" valign="top">
                            <span style="color: #666; font-size: 12px;">&nbsp;Municipio</span><br>
                            <div style="width: 100%; text-align: center;">
                                {{ $tcp->city_company }}
                            </div>
                        </td>
                        <td style="padding: 0;" valign="top">
                            <span style="color: #666; font-size: 12px;">&nbsp;Provincia</span><br>
                            <div style="width: 100%; text-align: center;">
                                {{ $tcp->province_company }}
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table  width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    <tr>
                        <td style="padding: 0;" valign="top">
                            <span style="color: #666; font-size: 12px;">&nbsp;Domicilio legal (seg&uacute;n Carnet de Identidad): Calle, No, Apto, entre calles</span><br>
                            <div style="width: 100%; text-align: center;">
                                {{ $tcp->address }}
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table  width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    <tr>
                        <td width="50%" style="padding: 0; border-right: #333 1px solid;" valign="top">
                            <span style="color: #666; font-size: 12px;">&nbsp;Municipio</span><br>
                            <div style="width: 100%; text-align: center;">
                                {{ $tcp->city }}
                            </div>
                        </td>
                        <td style="padding: 0;" valign="top">
                            <span style="color: #666; font-size: 12px;">&nbsp;Provincia</span><br>
                            <div style="width: 100%; text-align: center;">
                                {{ $tcp->province }}
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table  width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    <tr>
                        <td width="80%" style="padding: 0; border-right: #333 1px solid;" valign="top">
                            <span style="color: #666; font-size: 12px;">&nbsp;Actividad</span><br>
                            <div style="width: 100%; text-align: center;">
                                {{ $tcp->act_desc }}
                            </div>
                        </td>
                        <td style="padding: 0;" valign="top">
                            <span style="color: #666; font-size: 12px;">&nbsp;C&oacute;digo</span><br>
                            <div style="width: 100%; text-align: center;">
                                {{ $tcp->act_code }}
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="table_tcp" cellspacing="0" cellpadding="0" rules="rows">
        <tr>
            <td>
                <table  width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    <tr>
                        <td width="80%" style="text-align: center; text-transform: uppercase; padding: 10px 20px;">
                            <strong>Obligaciones</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table  width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    <tr>
                        <td width="70%" style="padding: 5px 20px; border-right: #333 1px solid;">
                            <strong>Nombre del Tributo</strong>
                        </td>
                        <td style="padding: 5px 20px; border-right: #333 1px solid;">
                            <strong>P&aacute;rrafo</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table  width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    @foreach ($obligations as $obligation)
                    <tr>
                        <td width="70%" style="padding: 5px 20px; border-right: #333 1px solid; border-bottom: #333 1px solid;">
                            - {{ $obligation->obligation }}
                        </td>
                        <td style="padding: 5px 20px; border-right: #333 1px solid; border-bottom: #333 1px solid;">
                            {{ $obligation->code }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    </table>
    <!------------------------------------------
    -------------    END PAGE 2    -------------
    ------------------------------------------->

    <div class="page-break"></div>

    <!------------------------------------------
    -----------    PAGES RECEIPTS    -----------
    ------------------------------------------->
    <header>
        <div style="width: 100%; text-align:center; padding-top: 3px;"><font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif;">-&nbsp;<span class="pagenum"></span>&nbsp;-</font></div>
    </header>
    
    <!-- INVENTORY INPUTS -->
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="5" class="entrydata" style="height:20px">
                <div style="float:left; width:300px; height:20px">
                    <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                </div>
                <div style="float:right; width:200px; height:20px; text-align:right;">
                    <strong>Per&iacute;odo:</strong> @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}
                </div>
            </td>
        </tr>
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">DETALLE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:center; color:#fff; border-color:#484A4B">C&Oacute;DIGO</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">PARCIAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">DEBE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">HABER</td>
        </tr>
        <tr>
            <td class="entrydata">Gastos de Operaci&oacute;n</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Gastos de Operación', $accounts)) 
                {{ $accounts['Gastos de Operación'] }} 
                @endif
            </td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $inventory_inputs }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Materias Primas y Materiales</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Materias Primas y Materiales', $subaccounts)) 
                {{ $subaccounts['Materias Primas y Materiales'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $inventory_inputs }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">Patrimonio del TCP</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Patrimonio del TCP', $accounts)) 
                {{ $accounts['Patrimonio del TCP'] }} 
                @endif
            </td>
            <td></td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $inventory_inputs }}</td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Saldo de Inicio del Per&iacute;odo</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Saldo al inicio del ejercicio', $subaccounts)) 
                {{ $subaccounts['Saldo al inicio del ejercicio'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $inventory_inputs }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">
                <strong>Registrando el Inventario de Insumos Declarados.</strong>
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $inventory_inputs }}</strong></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $inventory_inputs }}</strong></td>
        </tr>
    </table>
    <!-- END INVENTORY INPUTS -->

    <hr>

    <!-- AFT -->
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="5" class="entrydata" style="height:20px">
                <div style="float:left; width:300px; height:20px">
                    <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                </div>
                <div style="float:right; width:200px; height:20px; text-align:right;">
                    <strong>Per&iacute;odo:</strong> @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}
                </div>
            </td>
        </tr>
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">DETALLE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:center; color:#fff; border-color:#484A4B">C&Oacute;DIGO</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">PARCIAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">DEBE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">HABER</td>
        </tr>
        <tr>
            <td class="entrydata">Activos Fijos Tangibles</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Activos Fijos Tangibles', $accounts)) 
                {{ $accounts['Activos Fijos Tangibles'] }} 
                @endif
            </td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $atf_edmueq }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">Patrimonio del TCP</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Patrimonio del TCP', $accounts)) 
                {{ $accounts['Patrimonio del TCP'] }} 
                @endif
            </td>
            <td></td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $atf_edmueq }}</td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Saldo de Inicio del Per&iacute;odo</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Saldo al inicio del ejercicio', $subaccounts)) 
                {{ $subaccounts['Saldo al inicio del ejercicio'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $atf_edmueq }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">
                <strong>Registrando el Inventario de Activos Fijos Tangibles Declarados.</strong>
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $atf_edmueq }}</strong></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $atf_edmueq }}</strong></td>
        </tr>
    </table>
    <!-- END AFT -->
    
    <hr>    

    <!-- BOX CASH -->
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="5" class="entrydata" style="height:20px">
                <div style="float:left; width:300px; height:20px">
                    <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                </div>
                <div style="float:right; width:200px; height:20px; text-align:right;">
                    <strong>Per&iacute;odo:</strong> @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}
                </div>
            </td>
        </tr>
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">DETALLE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:center; color:#fff; border-color:#484A4B">C&Oacute;DIGO</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">PARCIAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">DEBE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">HABER</td>
        </tr>
        <tr>
            <td class="entrydata">Efectivo en Caja</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Efectivo en Caja', $accounts)) 
                {{ $accounts['Efectivo en Caja'] }} 
                @endif
            </td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $box_cash }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">Ventas</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Ventas', $accounts)) 
                {{ $accounts['Ventas'] }} 
                @endif
            </td>
            <td></td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $box_cash }}</td>
        </tr>
        <tr>
            <td class="entrydata">
                <strong>Registrando la venta, seg&uacute;n registro de control de ingresos correspondiente al per&iacute;odo.</strong>
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $box_cash }}</strong></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $box_cash }}</strong></td>
        </tr>
    </table>
    <!-- END BOX CASH -->

    <div class="page-break"></div>

    <!-- BANK CASH -->
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="5" class="entrydata" style="height:20px">
                <div style="float:left; width:300px; height:20px">
                    <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                </div>
                <div style="float:right; width:200px; height:20px; text-align:right;">
                    <strong>Per&iacute;odo:</strong> @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}
                </div>
            </td>
        </tr>
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">DETALLE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:center; color:#fff; border-color:#484A4B">C&Oacute;DIGO</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">PARCIAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">DEBE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">HABER</td>
        </tr>
        <tr>
            <td class="entrydata">Efectivo en Banco</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Efectivo en Banco', $accounts)) 
                {{ $accounts['Efectivo en Banco'] }} 
                @endif
            </td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $bank_cash }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">Efectivo en Caja</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Efectivo en Caja', $accounts)) 
                {{ $accounts['Efectivo en Caja'] }} 
                @endif
            </td>
            <td></td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $bank_cash }}</td>
        </tr>
        <tr>
            <td class="entrydata">
                <strong>Registrando el depósito al Banco de la Venta.</strong>
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $bank_cash }}</strong></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $bank_cash }}</strong></td>
        </tr>
    </table>
    <!-- END BANK CASH -->

    <hr>

    <!-- EXPENSE MP-MATERIALS CASH -->
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="5" class="entrydata" style="height:20px">
                <div style="float:left; width:300px; height:20px">
                    <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                </div>
                <div style="float:right; width:200px; height:20px; text-align:right;">
                    <strong>Per&iacute;odo:</strong> @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}
                </div>
            </td>
        </tr>
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">DETALLE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:center; color:#fff; border-color:#484A4B">C&Oacute;DIGO</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">PARCIAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">DEBE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">HABER</td>
        </tr>
        <tr>
            <td class="entrydata">Gastos de Operaci&oacute;n</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Gastos de Operación', $accounts)) 
                {{ $accounts['Gastos de Operación'] }} 
                @endif
            </td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $inventory_inputs }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Materias Primas y Materiales</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Materias Primas y Materiales', $subaccounts)) 
                {{ $subaccounts['Materias Primas y Materiales'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $inventory_inputs }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">Efectivo en Caja</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Efectivo en Caja', $accounts)) 
                {{ $accounts['Efectivo en Caja'] }} 
                @endif
            </td>
            <td></td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $inventory_inputs }}</td>
        </tr>
        <tr>
            <td class="entrydata">
                <strong>Registrando la compra de insumos en efectivo.</strong>
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $inventory_inputs }}</strong></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $inventory_inputs }}</strong></td>
        </tr>
    </table>
    <!-- END EXPENSE MP-MATERIALS CASH -->

    <hr>

    <!-- SERVICES EXPENSES CASH -->
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="5" class="entrydata" style="height:20px">
                <div style="float:left; width:300px; height:20px">
                    <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                </div>
                <div style="float:right; width:200px; height:20px; text-align:right;">
                    <strong>Per&iacute;odo:</strong> @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}
                </div>
            </td>
        </tr>
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">DETALLE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:center; color:#fff; border-color:#484A4B">C&Oacute;DIGO</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">PARCIAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">DEBE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">HABER</td>
        </tr>
        <tr>
            <td class="entrydata">Gastos de Operaci&oacute;n</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Gastos de Operación', $accounts)) 
                {{ $accounts['Gastos de Operación'] }} 
                @endif
            </td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $services_expenses }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Energía Eléctrica</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Energía Eléctrica', $subaccounts)) 
                {{ $subaccounts['Energía Eléctrica'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $power }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Otros Gastos Monetarios y Financieros</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Otros Gastos Monetarios y Financieros', $subaccounts)) 
                {{ $subaccounts['Otros Gastos Monetarios y Financieros'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $other_expenses }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">Efectivo en Caja</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Efectivo en Caja', $accounts)) 
                {{ $accounts['Efectivo en Caja'] }} 
                @endif
            </td>
            <td></td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $services_expenses }}</td>
        </tr>
        <tr>
            <td class="entrydata">
                <strong>Registrando el pago de servicios recibidos en efectivo.</strong>
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $services_expenses }}</strong></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $services_expenses }}</strong></td>
        </tr>
    </table>
    <!-- END SERVICES EXPENSES CASH -->

    <div class="page-break"></div>

    <!-- TAX ONAT -->
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="5" class="entrydata" style="height:20px">
                <div style="float:left; width:300px; height:20px">
                    <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                </div>
                <div style="float:right; width:200px; height:20px; text-align:right;">
                    <strong>Per&iacute;odo:</strong> @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}
                </div>
            </td>
        </tr>
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">DETALLE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:center; color:#fff; border-color:#484A4B">C&Oacute;DIGO</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">PARCIAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">DEBE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">HABER</td>
        </tr>
        <tr>
            <td class="entrydata">Impuestos y Tasas</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Impuestos y Tasas', $accounts)) 
                {{ $accounts['Impuestos y Tasas'] }} 
                @endif
            </td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $tax_onat }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Impuesto sobre las Ventas</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Impuesto sobre las Ventas', $subaccounts)) 
                {{ $subaccounts['Impuesto sobre las Ventas'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $sales_services }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Otros Impuestos y Tasas</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Otros Impuestos y Tasas', $subaccounts)) 
                {{ $subaccounts['Otros Impuestos y Tasas'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $other_tax }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">Efectivo en Caja</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Efectivo en Caja', $accounts)) 
                {{ $accounts['Efectivo en Caja'] }} 
                @endif
            </td>
            <td></td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $tax_onat }}</td>
        </tr>
        <tr>
            <td class="entrydata">
                <strong>Registrando el pago de impuestos y Tasas a la ONAT.</strong>
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $tax_onat }}</strong></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $tax_onat }}</strong></td>
        </tr>
    </table>
    <!-- END TAX ONAT -->

    <hr>

    <!-- TAX PERSONAL ENTRIES -->
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="5" class="entrydata" style="height:20px">
                <div style="float:left; width:300px; height:20px">
                    <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                </div>
                <div style="float:right; width:200px; height:20px; text-align:right;">
                    <strong>Per&iacute;odo:</strong> @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}
                </div>
            </td>
        </tr>
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">DETALLE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:center; color:#fff; border-color:#484A4B">C&Oacute;DIGO</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">PARCIAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">DEBE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">HABER</td>
        </tr>
        <tr>
            <td class="entrydata">Patrimonio del TCP</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Patrimonio del TCP', $accounts)) 
                {{ $accounts['Patrimonio del TCP'] }} 
                @endif
            </td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $tax_personal_entries }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Pagos de Cuotas del Impuesto sobre Ingresos Personales</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Pagos de Cuotas del Impuesto sobre Ingresos Personales', $subaccounts)) 
                {{ $subaccounts['Pagos de Cuotas del Impuesto sobre Ingresos Personales'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $tax_mfee }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Contribución a la Seguridad Social</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Contribución a la Seguridad Social', $subaccounts)) 
                {{ $subaccounts['Contribución a la Seguridad Social'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $tax_security }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">Efectivo en Caja</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Efectivo en Caja', $accounts)) 
                {{ $accounts['Efectivo en Caja'] }} 
                @endif
            </td>
            <td></td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $tax_personal_entries }}</td>
        </tr>
        <tr>
            <td class="entrydata">
                <strong>Registrando el pago de cuotas del Impuesto sobre Ingresos Personales y de la Contribución a la Seguridad Social.</strong>
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $tax_personal_entries }}</strong></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $tax_personal_entries }}</strong></td>
        </tr>
    </table>
    <!-- END TAX PERSONAL ENTRIES -->

    <hr>

    <!-- TAX SALARY WORKERS -->
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="5" class="entrydata" style="height:20px">
                <div style="float:left; width:300px; height:20px">
                    <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                </div>
                <div style="float:right; width:200px; height:20px; text-align:right;">
                    <strong>Per&iacute;odo:</strong> @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}
                </div>
            </td>
        </tr>
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">DETALLE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:center; color:#fff; border-color:#484A4B">C&Oacute;DIGO</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">PARCIAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">DEBE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">HABER</td>
        </tr>
        <tr>
            <td class="entrydata">Gastos de Operaci&oacute;n</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Gastos de Operación', $accounts)) 
                {{ $accounts['Gastos de Operación'] }} 
                @endif
            </td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $salary_workers }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Remuneraciones al Personal Contratado</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Remuneraciones al Personal Contratado', $subaccounts)) 
                {{ $subaccounts['Remuneraciones al Personal Contratado'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $salary_workers }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">Efectivo en Caja</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Efectivo en Caja', $accounts)) 
                {{ $accounts['Efectivo en Caja'] }} 
                @endif
            </td>
            <td></td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $salary_workers }}</td>
        </tr>
        <tr>
            <td class="entrydata">
                <strong>Registrando la entrega de remuneraciones a trabajadores.</strong>
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $salary_workers }}</strong></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $salary_workers }}</strong></td>
        </tr>
    </table>
    <!-- END SALARY WORKERS -->

    <div class="page-break"></div>

    <!-- AFT DEPRECIATION -->
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="5" class="entrydata" style="height:20px">
                <div style="float:left; width:300px; height:20px">
                    <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                </div>
                <div style="float:right; width:200px; height:20px; text-align:right;">
                    <strong>Per&iacute;odo:</strong> @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}
                </div>
            </td>
        </tr>
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">DETALLE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:center; color:#fff; border-color:#484A4B">C&Oacute;DIGO</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">PARCIAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">DEBE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">HABER</td>
        </tr>
        <tr>
            <td class="entrydata">Gastos de Operaci&oacute;n</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Gastos de Operación', $accounts)) 
                {{ $accounts['Gastos de Operación'] }} 
                @endif
            </td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $atf_deprec }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Depreciación de AFT</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Depreciación de AFT', $subaccounts)) 
                {{ $subaccounts['Depreciación de AFT'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $atf_deprec }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">Depreciación Acumulada de AFT</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Depreciación de AFT', $accounts)) 
                {{ $accounts['Depreciación de AFT'] }} 
                @endif
            </td>
            <td></td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $atf_deprec }}</td>
        </tr>
        <tr>
            <td class="entrydata">
                <strong>Registrando el gasto de la depreciación de los Activos Fijos Tangibles correspondiente al ejercicio.</strong>
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $atf_deprec }}</strong></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $atf_deprec }}</strong></td>
        </tr>
    </table>
    <!-- END AFT DEPRECIATION -->

    <hr>

    <!-- EROGATIONS TCP -->
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="5" class="entrydata" style="height:20px">
                <div style="float:left; width:300px; height:20px">
                    <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                </div>
                <div style="float:right; width:200px; height:20px; text-align:right;">
                    <strong>Per&iacute;odo:</strong> @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}
                </div>
            </td>
        </tr>
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">DETALLE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:center; color:#fff; border-color:#484A4B">C&Oacute;DIGO</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">PARCIAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">DEBE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">HABER</td>
        </tr>
        <tr>
            <td class="entrydata">Patrimonio del TCP</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Patrimonio del TCP', $accounts)) 
                {{ $accounts['Patrimonio del TCP'] }} 
                @endif
            </td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $erogation_tcp }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Erogaciones efectuadas por el TCP en el ejercicio contable</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Erogaciones efectuadas por el TCP en el ejercicio contable', $subaccounts)) 
                {{ $subaccounts['Erogaciones efectuadas por el TCP en el ejercicio contable'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $erogation_tcp }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">Efectivo en Caja</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Efectivo en Caja', $accounts)) 
                {{ $accounts['Efectivo en Caja'] }} 
                @endif
            </td>
            <td></td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $erogation_tcp }}</td>
        </tr>
        <tr>
            <td class="entrydata">
                <strong>Registrando el retiro de efectivo por decisión del TCP.</strong>
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $erogation_tcp }}</strong></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $erogation_tcp }}</strong></td>
        </tr>
    </table>
    <!-- END EROGATIONS TCP -->

    <hr>

    <!-- PLUS CONTRIBUTION -->
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="5" class="entrydata" style="height:20px">
                <div style="float:left; width:300px; height:20px">
                    <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                </div>
                <div style="float:right; width:200px; height:20px; text-align:right;">
                    <strong>Per&iacute;odo:</strong> @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}
                </div>
            </td>
        </tr>
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">DETALLE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:center; color:#fff; border-color:#484A4B">C&Oacute;DIGO</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">PARCIAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">DEBE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">HABER</td>
        </tr>
        <tr>
            <td class="entrydata">Efectivo en Caja</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Efectivo en Caja', $accounts)) 
                {{ $accounts['Efectivo en Caja'] }} 
                @endif
            </td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $plus_contribution }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">Patrimonio del TCP</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Patrimonio del TCP', $accounts)) 
                {{ $accounts['Patrimonio del TCP'] }} 
                @endif
            </td>
            <td></td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $plus_contribution }}</td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Incrementos de aportes del TCP en el ejercicio contable</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Incrementos de aportes del TCP en el ejercicio contable', $subaccounts)) 
                {{ $subaccounts['Incrementos de aportes del TCP en el ejercicio contable'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $plus_contribution }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">
                <strong>Registrando la entrada de efectivo por decisi&oacute;n del TCP.</strong>
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $plus_contribution }}</strong></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $plus_contribution }}</strong></td>
        </tr>
    </table>
    <!-- END PLUS CONTRIBUTION -->

    @if ($mpm != null)
    <div class="page-break"></div>

    <!-- BANK PURCHASE MPM -->
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="5" class="entrydata" style="height:20px">
                <div style="float:left; width:300px; height:20px">
                    <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                </div>
                <div style="float:right; width:200px; height:20px; text-align:right;">
                    <strong>Per&iacute;odo:</strong> @if ($month != 'all') {{ month_name(intval($month)) . ' /' }} @endif {{ $year }}
                </div>
            </td>
        </tr>
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">DETALLE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:center; color:#fff; border-color:#484A4B">C&Oacute;DIGO</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">PARCIAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">DEBE</td>
            <td bgcolor="#777" class="tablesubtitle" width="70" style="text-align:right; color:#fff; border-color:#484A4B">HABER</td>
        </tr>
        <tr>
            <td class="entrydata">Gastos de Operaci&oacute;n</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Gastos de Operación', $accounts)) 
                {{ $accounts['Gastos de Operación'] }} 
                @endif
            </td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $mpm }}</td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">&nbsp;- Materias Primas y Materiales</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Materias Primas y Materiales', $subaccounts)) 
                {{ $subaccounts['Materias Primas y Materiales'] }} 
                @endif
            </td>
            <td class="entrydata" style="text-align:right;">{{ $mpm }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="entrydata">Efectivo en Banco</td>
            <td class="entrydata" style="text-align:center;">
                @if (array_key_exists('Efectivo en Banco', $accounts)) 
                {{ $accounts['Efectivo en Banco'] }} 
                @endif
            </td>
            <td></td>
            <td></td>
            <td class="entrydata" style="text-align:right;">{{ $mpm }}</td>
        </tr>
        <tr>
            <td class="entrydata">
                <strong>Registrando la compra de insumos por la cuenta bancaria.</strong>
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $mpm }}</strong></td>
            <td class="entrydata" style="text-align:right;"><strong>$ {{ $mpm }}</strong></td>
        </tr>
    </table>
    <!-- END BANK PURCHASE MPM -->
    @endif

    <!------------------------------------------
    ---------    END PAGE RECEIPTS    ----------
    ------------------------------------------->

@stop