@extends('layouts.pdfbooklandscape')

@section('title', 'Registro de Ingresos')

@section('content')
    <!------------------------------------------
    ---------------    PAGE 1    ---------------
    ------------------------------------------->
    <div class="cover">
        <div class="logo">
            <img src="{{ public_path('images/onat-piramidal.jpg') }}">
        </div>
        <div class="system">Sistema Contable</div>
        <div class="reportname">Registro de las Operaciones<br>de Gastos para<br>el Trabajador por Cuenta Propia</div>
        <div class="year">A&ntilde;o {{ $year }}</div>
    </div>
    
    <div class="page-break"></div>
    <!------------------------------------------
    -------------    END PAGE 1    -------------
    ------------------------------------------->

    <!------------------------------------------
    ---------------    PAGE 2    ---------------
    ------------------------------------------->
    <table class="table_rules" cellspacing="0" cellpadding="0" rules="rows">
        <tr>
            <td class="title">Instrucciones para la conservaci&oacute;n del registro de ingresos<br>El cumplimiento de deberes formales y de las reglas y normas contables</td>
        </tr>
        <tr>
            <td class="content">
                <strong>Objetivo:</strong>&nbsp;Proporcionar al contribuyente, los elementos que le permitan garantizar la conservaci&oacute;n del Registro, el cumplimiento de deberes formales, y las reglas y normas contables establecidas.<br>
                <ul>
                    <li>El Registro debe coservarse limpio y en buen estado. Cuando presenta deterioro, que impide la comprobci&oacute;n de la actividad, el contribuyente concurre a la Oficina Municipal en que est&aacute; inscripto, con el Registro que debe sustituirse, para la obtenci&oacute;n de uno nuevo. En caso de extravio concurre a solicitar uno nuevo.</li>
                    <li>Se lleva un Registro por cada actividad autorizada al Trabajador por cuenta propia.</li>
                    <li>El Registro debe mantenerse actualizado.</li>
                    <li>El Registro se conserva por cinco (5) a&ntilde;os, contados a partir del cierre del a&ntilde;o fiscal en que se utilizan para respaldar las operaciones de ingresos reflejadas en el Registro, cuando el tipo de actividad que se deesarrolla as&iacute; lo requiere.</li>
                    <li>El Registro se llena a tinta y en letra de molde legible.</li>
                    <li>El Registro no puede tener borrones, enmiendas ni tachaduras, cuando el contribuyente se equivoca pasa una raya para anular toda la fila y en el maren derecho escribe la letra <strong>E/</strong>, que significa <strong>ERROR</strong>. En la siguiente fila anota los datos correctos y tambien en el margen derecho escribe la letra <strong>C/</strong>, que significa <strong>CORRECCI&Oacute;N</strong></li>
                    <li>En los d&iacute;as en que no se obtienen ingresos no se efect&uacute;an anotaciones en el Registro.</li>
                    <li>Cuando se obtienen ingresos que se cobran en pesos convertibles (CUC) los importes se anotan en pesos (CUP) al tipo de cambio vigente para las opreciones de compra de CUC a la poblaci&oacute;n.</li>
                    <li>Al finalizar cada mes, se pasa raya diagonal anulando las filas no utilizadas y se suman los ingresos en la fila: <strong>Total</strong></li>
                </ul>
            </td>
        </tr>
    </table>

    <div class="page-break"></div>
    <!------------------------------------------
    -------------    END PAGE 2    -------------
    ------------------------------------------->

    <!------------------------------------------
    ---------------    PAGE 3    ---------------
    ------------------------------------------->
    <header>
        <div style="width: 100%; text-align:center; padding-top: 3px;"><font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif;">-&nbsp;<span class="pagenum"></span>&nbsp;-</font></div>
    </header>
    <table class="table_tcp" cellspacing="0" cellpadding="0" rules="rows">
        <tr>
            <td>
                <table  width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    <tr>
                        <td width="85%" style="text-align: center; text-transform: uppercase; padding: 10px 20px; border-right: #333 1px solid;">
                            <strong>Registro de las operaciones de ingresos para el trabajador por cuenta propia</strong>
                        </td>
                        <td style="padding: 0;" valign="top">
                            <span style="color: #666; font-size: 12px;">&nbsp;A&ntilde;o</span><br>
                            <div style="width: 100%; text-align: center;">{{ $year }}</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table  width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    <tr>
                        <td width="85%" style="padding: 0; border-right: #333 1px solid;" valign="top">
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
                        <td width="80%" style="text-align: center; text-transform: uppercase; padding: 5px 20px;">
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
                        <td width="70%" style="padding: 2px 20px; border-right: #333 1px solid; border-bottom: #333 1px solid;">
                            - {{ $obligation->obligation }}
                        </td>
                        <td style="padding: 2px 20px; border-right: #333 1px solid; border-bottom: #333 1px solid;">
                            {{ $obligation->code }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    </table>
    <table class="table_tcp" cellspacing="0" cellpadding="0" rules="rows">
        <tr>
            <td colspan="2">
                <table  width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    <tr>
                        <td width="80%" style="text-align: center; text-transform: uppercase; padding: 5px 20px;">
                            <strong>Acreditaci&oacute;n del Registro</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td width="70%">
                <table width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    <tr>
                        <td width="80%" style="padding: 0; border-right: #333 1px solid; border-bottom: #333 1px solid;" valign="top">
                            <span style="color: #666; font-size: 12px;">&nbsp;Municipio</span><br>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0; border-right: #333 1px solid;" valign="top">
                            <span style="color: #666; font-size: 12px;">&nbsp;Nombre del funcionario</span><br>
                            &nbsp;
                        </td>
                    </tr>
                </table>
            </td>
            <td style="padding: 0;" valign="top">
                <span style="color: #666; font-size: 12px;">&nbsp;Firma</span><br>
                &nbsp;
            </td>
        </tr>
    </table>
    <br>
    <table align="center" width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="70%" valign="top">
                <table align="center" width="180px" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>D</td>
                        <td>M</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                </table>
            </td>
            <td>
                <div style="border: #000 1px solid; height:50px; text-align:center; padding-top:20px">Para uso de la ONAT</div>
            </td>
        </tr>
    </table>
    <div class="page-break"></div>
    <!------------------------------------------
    -------------    END PAGE 3    -------------
    ------------------------------------------->

    <!------------------------------------------
    ------------    PAGES MONTHS    ------------
    ------------------------------------------->
    @foreach ($expensesmonth as $month => $expenses)
    <header>
        <div style="width: 100%; text-align:center; padding-top: 3px;"><font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif;">-&nbsp;<span class="pagenum"></span>&nbsp;-</font></div>
    </header>
    <table class="table-page" width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td class="monthreport" colspan="2"><strong>{{ $month }}</strong></td>
          <td class="monthreportitle" colspan="12" align="center"><strong>Gastos de operaci&oacute;n</strong></td>
        </tr>
        <tr>
          <td class="tablesubtitle" colspan="13" align="center">Subcuentas</td>
          <td class="tablesubtitle" rowspan="3" align="center">Total Gastos Autorizados Posibles a Deducir</td>
        </tr>
        <tr>
          <td class="tablesubtitle" colspan="13" align="center">Posibles a deducir dentro de los límites de gastos autorizados</td>
        </tr>
        <tr>
          <td width="20" class="tablesubtitle" align="center">D&iacute;a</td>
          <td width="55" class="tablesubtitle" align="center">Materias primas y Materiales</td>
          <td width="55" class="tablesubtitle" align="center">Mercancias para la venta</td>
          <td width="55" class="tablesubtitle" align="center">Combustible</td>
          <td width="55" class="tablesubtitle" align="center">Energía Eléctrica</td>
          <td width="55" class="tablesubtitle" align="center">Salarios Personal Contratado</td>
          <td class="tablesubtitle" align="center">
            @if ($tcp_columns['col7'] != '')
                {{ $tcp_columns['col7'] }}
            @endif
          </td>
          <td class="tablesubtitle" align="center">
            @if ($tcp_columns['col8'] != '')
                {{ $tcp_columns['col8'] }}
            @endif
          </td>
          <td class="tablesubtitle" align="center">
            @if ($tcp_columns['col9'] != '')
                {{ $tcp_columns['col9'] }}
            @endif
          </td>
          <td class="tablesubtitle" align="center">
            @if ($tcp_columns['col10'] != '')
                {{ $tcp_columns['col10'] }}
            @endif
          </td>
          <td class="tablesubtitle" align="center">
            @if ($tcp_columns['col11'] != '')
                {{ $tcp_columns['col11'] }}
            @endif
          </td>
          <td class="tablesubtitle" align="center">
            @if ($tcp_columns['col12'] != '')
                {{ $tcp_columns['col12'] }}
            @endif
          </td>
          <td width="45" class="tablesubtitle" align="center">Otros Gastos</td>
        </tr>
        <tr>
          <td class="help">(1)</td>
          <td class="help">(2)</td>
          <td class="help">(3)</td>
          <td class="help">(4)</td>
          <td class="help">(5)</td>
          <td class="help">(6)</td>
          <td class="help">(7)</td>
          <td class="help">(8)</td>
          <td class="help">(9)</td>
          <td class="help">(10)</td>
          <td class="help">(11)</td>
          <td class="help">(12)</td>
          <td class="help">(13)</td>
          <td class="help">(14)</td>
        </tr>
        @foreach ($expenses as $key => $value)
        @if ($value['id'] != '-1')
        <tr>
            <td class="data" align="center">{{ $value['day'] }}</td>
            <td class="data @if ($value['mp_materials'] == '') cell-mark @endif" align="center">
                {{ $value['mp_materials'] }}
            </td>
            <td class="data @if ($value['goods'] == '') cell-mark @endif" align="center">
                {{ $value['goods'] }}
            </td>
            <td class="data @if ($value['fuel'] == '') cell-mark @endif" align="center">
                {{ $value['fuel'] }}
            </td>
            <td class="data @if ($value['power'] == '') cell-mark @endif" align="center">
                {{ $value['power'] }}
            </td>
            <td class="data @if ($value['salary'] == '') cell-mark @endif" align="center">
                {{ $value['salary'] }}
            </td>
            <td class="data @if ($value['col7'] == '') cell-mark @endif" align="center">
                {{ $value['col7'] }}
            </td>
            <td class="data @if ($value['col8'] == '') cell-mark @endif" align="center">
                {{ $value['col8'] }}
            </td>
            <td class="data @if ($value['col9'] == '') cell-mark @endif" align="center">
                {{ $value['col9'] }}
            </td>
            <td class="data @if ($value['col10'] == '') cell-mark @endif" align="center">
                {{ $value['col10'] }}
            </td>
            <td class="data @if ($value['col11'] == '') cell-mark @endif" align="center">
                {{ $value['col11'] }}
            </td>
            <td class="data @if ($value['col12'] == '') cell-mark @endif" align="center">
                {{ $value['col12'] }}
            </td>
            <td class="data @if ($value['others'] == '') cell-mark @endif" align="center">
                {{ $value['others'] }}
            </td>
            <td class="data @if ($value['expense_pd'] == '') cell-mark @endif" align="center">
                {{ $value['expense_pd'] }}
            </td>
        </tr>
        @else
        <tr>
            <td class="data" align="center">{!! $value['day'] !!}</td>
            <td class="data" align="center">{!! $value['mp_materials'] !!}</td>
            <td class="data" align="center">{!! $value['goods'] !!}</td>
            <td class="data" align="center">{!! $value['fuel'] !!}</td>
            <td class="data" align="center">{!! $value['power'] !!}</td>
            <td class="data" align="center">{!! $value['salary'] !!}</td>
            <td class="data" align="center">{!! $value['col7'] !!}</td>
            <td class="data" align="center">{!! $value['col8'] !!}</td>
            <td class="data" align="center">{!! $value['col9'] !!}</td>
            <td class="data" align="center">{!! $value['col10'] !!}</td>
            <td class="data" align="center">{!! $value['col11'] !!}</td>
            <td class="data" align="center">{!! $value['col12'] !!}</td>
            <td class="data" align="center">{!! $value['others'] !!}</td>
            <td class="data" align="center">{!! $value['expense_pd'] !!}</td>
        </tr>
        @endif
        @endforeach
    </table>
    <div class="page-break"></div>
    <header>
        <div style="width: 100%; text-align:center; padding-top: 3px;"><font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif;">-&nbsp;<span class="pagenum"></span>&nbsp;-</font></div>
    </header>
    <table class="table-page" width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td class="monthreportitle" colspan="8"><strong>Gastos de operaci&oacute;n</strong></td>
          <td class="monthreport" colspan="4" align="right"><strong>{{ $month }}</strong></td>
        </tr>
        <tr>
          <td class="tablesubtitle" colspan="5">Subcuentas</td>
          <td width="50" class="tablesubtitle" rowspan="3">Total deducir de la base imponible</td>
          <td class="tablesubtitle">Subcuentas</td>
          <td width="50" class="tablesubtitle" rowspan="3">Total Gastos de operacion</td>
          <td class="tablesubtitle" colspan="2">Creditos</td>
          <td width="50" class="tablesubtitle" rowspan="3">Total Pagado</td>
          <td width="100" class="tablesubtitle" rowspan="3">Detalle</td>
        </tr>
        <tr>
          <td class="tablesubtitle" colspan="5">Deducible directamente de la base imponible</td>
          <td width="50" class="tablesubtitle" rowspan="2">Egresos NIEI autorizado MFP</td>
          <td width="50" class="tablesubtitle" rowspan="2">Efectivo Caja</td>
          <td width="50" class="tablesubtitle" rowspan="2">Efectivo Banco</td>
        </tr>
        <tr>
          <td width="20" class="tablesubtitle">Dia</td>
          <td width="60" class="tablesubtitle">Pagos arrendam. Bienes Estado</td>
          <td width="50" class="tablesubtitle">
            @if ($tcp_columns['col17'] != '')
                {{ $tcp_columns['col17'] }}
            @endif
          </td>
          <td width="50" class="tablesubtitle">
            @if ($tcp_columns['col18'] != '')
                {{ $tcp_columns['col18'] }}
            @endif
          </td>
          <td width="50" class="tablesubtitle">
            @if ($tcp_columns['col19'] != '')
                {{ $tcp_columns['col19'] }}
            @endif
          </td>
        </tr>
        <tr>
          <td class="help">(15)</td>
          <td class="help">(16)</td>
          <td class="help">(17)</td>
          <td class="help">(18)</td>
          <td class="help">(19)</td>
          <td class="help">(20)</td>
          <td class="help">(21)</td>
          <td class="help">(22)</td>
          <td class="help">(23)</td>
          <td class="help">(24)</td>
          <td class="help">(25)</td>
          <td class="help">(26)</td>
        </tr>
        @foreach ($expenses as $key => $value)
        @if ($value['id'] != '-1')
        <tr>
            <td class="data" align="center">{{ $value['day'] }}</td>
            <td class="data @if ($value['lease_state'] == '') cell-mark @endif" align="center">
                {{ $value['lease_state'] }}
            </td>
            <td class="data @if ($value['col17'] == '') cell-mark @endif" align="center">
                {{ $value['col17'] }}
            </td>
            <td class="data @if ($value['col18'] == '') cell-mark @endif" align="center">
                {{ $value['col18'] }}
            </td>
            <td class="data @if ($value['col19'] == '') cell-mark @endif" align="center">
                {{ $value['col19'] }}
            </td>
            <td class="data @if ($value['expense_dbi'] == '') cell-mark @endif" align="center">
                {{ $value['expense_dbi'] }}
            </td>
            <td class="data @if ($value['expenses_ncei'] == '') cell-mark @endif" align="center">
                {{ $value['expenses_ncei'] }}
            </td>
            <td class="data @if ($value['expense_ope'] == '') cell-mark @endif" align="center">
                {{ $value['expense_ope'] }}
            </td>
            <td class="data @if ($value['cash_box'] == '') cell-mark @endif" align="center">
                {{ $value['cash_box'] }}
            </td>
            <td class="data @if ($value['cash_bank'] == '') cell-mark @endif" align="center">
                {{ $value['cash_bank'] }}
            </td>
            <td class="data @if ($value['total_paid'] == '') cell-mark @endif" align="center">
                {{ $value['total_paid'] }}
            </td>
            <td class="data @if ($value['detail'] == '') cell-mark @endif" align="center">
                {{ $value['detail'] }}
            </td>
        </tr>
        @else
        <tr>
            <td class="data" align="center">{!! $value['day'] !!}</td>
            <td class="data" align="center">{!! $value['lease_state'] !!}</td>
            <td class="data" align="center">{!! $value['col17'] !!}</td>
            <td class="data" align="center">{!! $value['col18'] !!}</td>
            <td class="data" align="center">{!! $value['col19'] !!}</td>
            <td class="data" align="center">{!! $value['expense_dbi'] !!}</td>
            <td class="data" align="center">{!! $value['expenses_ncei'] !!}</td>
            <td class="data" align="center">{!! $value['expense_ope'] !!}</td>
            <td class="data" align="center">{!! $value['cash_box'] !!}</td>
            <td class="data" align="center">{!! $value['cash_bank'] !!}</td>
            <td class="data" align="center">{!! $value['total_paid'] !!}</td>
            <td class="data" align="center"></td>
        </tr>
        @endif
        @endforeach
    </table>
    <div class="page-break"></div>
    @endforeach
    <!------------------------------------------
    ----------    END PAGES MONTHS    ----------
    ------------------------------------------->

    <!------------------------------------------
    -------------    PAGES YEAR    -------------
    ------------------------------------------->
    <header>
        <div style="width: 100%; text-align:center; padding-top: 3px;"><font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif;">-&nbsp;<span class="pagenum"></span>&nbsp;-</font></div>
    </header>
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td class="monthreportitle" colspan="14" align="center"><strong>Resumen Anual de Gastos de Operaci&oacute;n</strong></td>
        </tr>
        <tr>
          <td class="tablesubtitle" colspan="13" align="center">Subcuentas</td>
          <td class="tablesubtitle" rowspan="3" align="center">Total Gastos Autorizados Posibles a Deducir</td>
        </tr>
        <tr>
          <td class="tablesubtitle" colspan="13" align="center">Posibles a deducir dentro de los límites de gastos autorizados</td>
        </tr>
        <tr>
          <td width="50" class="tablesubtitle" align="center">Mes</td>
          <td width="55" class="tablesubtitle" align="center">Materias primas y Materiales</td>
          <td width="55" class="tablesubtitle" align="center">Mercancias para la venta</td>
          <td width="55" class="tablesubtitle" align="center">Combustible</td>
          <td width="45" class="tablesubtitle" align="center">Energía Eléctrica</td>
          <td width="55" class="tablesubtitle" align="center">Salarios Personal Contratado</td>
          <td class="tablesubtitle" align="center">&nbsp;</td>
          <td class="tablesubtitle" align="center">&nbsp;</td>
          <td class="tablesubtitle" align="center">&nbsp;</td>
          <td class="tablesubtitle" align="center">&nbsp;</td>
          <td class="tablesubtitle" align="center">&nbsp;</td>
          <td class="tablesubtitle" align="center">&nbsp;</td>
          <td width="40" class="tablesubtitle" align="center">Otros Gastos</td>
        </tr>
        <tr>
          <td class="help">(1)</td>
          <td class="help">(2)</td>
          <td class="help">(3)</td>
          <td class="help">(4)</td>
          <td class="help">(5)</td>
          <td class="help">(6)</td>
          <td class="help">(7)</td>
          <td class="help">(8)</td>
          <td class="help">(9)</td>
          <td class="help">(10)</td>
          <td class="help">(11)</td>
          <td class="help">(12)</td>
          <td class="help">(13)</td>
          <td class="help">(14)</td>
        </tr>
        @foreach ($expensesyear as $key => $monthsummary)
        @if ($key != 12)
        <tr>
            <td class="data" align="center">{{ $monthsummary['month'] }}</td>
            @if ($monthsummary['mp_materials'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['mp_materials'] }}</td>
            @endif
            @if ($monthsummary['goods'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['goods'] }}</td>
            @endif
            @if ($monthsummary['fuel'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['fuel'] }}</td>
            @endif
            @if ($monthsummary['power'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['power'] }}</td>
            @endif
            @if ($monthsummary['salary'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['salary'] }}</td>
            @endif
            @if ($monthsummary['col7'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['col7'] }}</td>
            @endif
            @if ($monthsummary['col8'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['col8'] }}</td>
            @endif
            @if ($monthsummary['col9'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['col9'] }}</td>
            @endif
            @if ($monthsummary['col10'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['col10'] }}</td>
            @endif
            @if ($monthsummary['col11'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['col11'] }}</td>
            @endif
            @if ($monthsummary['col12'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['col12'] }}</td>
            @endif
            @if ($monthsummary['others'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['others'] }}</td>
            @endif
            <td class="data" align="center">{{ $monthsummary['expense_pd'] }}</td>
        </tr>
        @else
        <tr>
            <td class="data" align="center">{!! $monthsummary['month'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['mp_materials'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['goods'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['fuel'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['power'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['salary'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['col7'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['col8'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['col9'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['col10'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['col11'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['col12'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['others'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['expense_pd'] !!}</td>
        </tr>
        @endif
        @endforeach
    </table>
    <div class="page-break"></div>
    <header>
        <div style="width: 100%; text-align:center; padding-top: 3px;"><font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif;">-&nbsp;<span class="pagenum"></span>&nbsp;-</font></div>
    </header>
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td class="monthreportitle" colspan="11" align="center">
              <strong>Resumen Anual de Gastos de operaci&oacute;n</strong>
            </td>
        </tr>
        <tr>
          <td class="tablesubtitle" colspan="5">Subcuentas</td>
          <td width="50" class="tablesubtitle" rowspan="3">Total deducir de la base imponible</td>
          <td class="tablesubtitle">Subcuentas</td>
          <td width="50" class="tablesubtitle" rowspan="3">Total Gastos de operacion</td>
          <td class="tablesubtitle" colspan="2">Creditos</td>
          <td width="50" class="tablesubtitle" rowspan="3">Total Pagado</td>
        </tr>
        <tr>
          <td class="tablesubtitle" colspan="5">Deducible directamente de la base imponible</td>
          <td width="50" class="tablesubtitle" rowspan="2">Egresos NIEI autorizado MFP</td>
          <td width="50" class="tablesubtitle" rowspan="2">Efectivo Caja</td>
          <td width="50" class="tablesubtitle" rowspan="2">Efectivo Banco</td>
        </tr>
        <tr>
          <td width="50" class="tablesubtitle">Mes</td>
          <td width="60" class="tablesubtitle">Pagos arrendam. Bienes Estado</td>
          <td width="40" class="tablesubtitle">&nbsp;</td>
          <td width="40" class="tablesubtitle">&nbsp;</td>
          <td width="40" class="tablesubtitle">&nbsp;</td>
        </tr>
        <tr>
          <td class="help">(15)</td>
          <td class="help">(16)</td>
          <td class="help">(17)</td>
          <td class="help">(18)</td>
          <td class="help">(19)</td>
          <td class="help">(20)</td>
          <td class="help">(21)</td>
          <td class="help">(22)</td>
          <td class="help">(23)</td>
          <td class="help">(24)</td>
          <td class="help">(25)</td>
        </tr>
        @foreach ($expensesyear as $key => $monthsummary)
        @if ($key != 12)
        <tr>
            <td class="data" align="center">{{ $monthsummary['month'] }}</td>
            @if ($monthsummary['lease_state'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['lease_state'] }}</td>
            @endif
            @if ($monthsummary['col17'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['col17'] }}</td>
            @endif
            @if ($monthsummary['col18'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['col18'] }}</td>
            @endif
            @if ($monthsummary['col19'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['col19'] }}</td>
            @endif
            <td class="data" align="center">{{ $monthsummary['expense_dbi'] }}</td>
            @if ($monthsummary['expenses_ncei'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['expenses_ncei'] }}</td>
            @endif
            <td class="data" align="center">{{ $monthsummary['expense_ope'] }}</td>
            @if ($monthsummary['cash_box'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['cash_box'] }}</td>
            @endif
            @if ($monthsummary['cash_bank'] == 0)
            <td class="data cell-mark">&nbsp;</td>
            @else
            <td class="data" align="center">{{ $monthsummary['cash_bank'] }}</td>
            @endif
            <td class="data" align="center">{{ $monthsummary['total_paid'] }}</td>
        </tr>
        @else
        <tr>
            <td class="data" align="center">{!! $monthsummary['month'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['lease_state'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['col17'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['col18'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['col19'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['expense_dbi'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['expenses_ncei'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['expense_ope'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['cash_box'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['cash_bank'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['total_paid'] !!}</td>
        </tr>
        @endif
        @endforeach
    </table>
    <div class="page-break"></div>
    <!----------------------------------------
    ----------    END PAGES YEAR    ----------
    ----------------------------------------->

    <!------------------------------------------
    --------------    PAGE TAX    --------------
    ------------------------------------------->
    <header>
        <div style="width: 100%; text-align:center; padding-top: 3px;"><font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif;">-&nbsp;<span class="pagenum"></span>&nbsp;-</font></div>
    </header>
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td class="monthreportitle" colspan="11" align="center">
              <strong>Tributos pagados asociados a la actividad</strong>
            </td>
        </tr>
        <tr>
            <td width="75" class="tablesubtitle">Mes</td>
            <td width="55" class="tablesubtitle">Impuesto Ventas o Servicios</td>
            <td width="55" class="tablesubtitle">Impuesto Fuerza de Trabajo</td>
            <td width="55" class="tablesubtitle">Impuesto Documentos</td>
            <td width="55" class="tablesubtitle">Tasa Anuncios y propaganda</td>
            <td width="85" class="tablesubtitle">Contribuci&oacute;n Especial Seguridad Social</td>
            <td width="55" class="tablesubtitle">Otros Tributos</td>
            <td width="55" class="tablesubtitle">Subtotal</td>
            <td width="70" class="tablesubtitle">Contribuci&oacute;n Restauraci&oacute;n y Preservaci&oacute;n zonas de la actividad</td>
            <td width="50" class="tablesubtitle">Cuota Mensual</td>
            <td class="tablesubtitle">Total Pagado en el mes</td>
        </tr>
        @foreach ($taxyear as $key => $monthsummary)
        @if ($key != 12)
        <tr>
            <td class="data" align="center">{{ $monthsummary['month'] }}</td>
            <td class="data @if ($monthsummary['sales_services'] == '') cell-mark @endif" align="center">{{ $monthsummary['sales_services'] }}</td>
            <td class="data @if ($monthsummary['workforce'] == '') cell-mark @endif" align="center">{{ $monthsummary['workforce'] }}</td>
            <td class="data @if ($monthsummary['documents'] == '') cell-mark @endif" align="center">{{ $monthsummary['documents'] }}</td>
            <td class="data @if ($monthsummary['commercial_ads'] == '') cell-mark @endif" align="center">{{ $monthsummary['commercial_ads'] }}</td>
            <td class="data @if ($monthsummary['social_security'] == '') cell-mark @endif" align="center">{{ $monthsummary['social_security'] }}</td>
            <td class="data @if ($monthsummary['others'] == '') cell-mark @endif" align="center">{{ $monthsummary['others'] }}</td>
            <td class="data @if ($monthsummary['subtotal'] == '') cell-mark @endif" align="center">{{ $monthsummary['subtotal'] }}</td>
            <td class="data @if ($monthsummary['restoration_repair'] == '') cell-mark @endif" align="center">{{ $monthsummary['restoration_repair'] }}</td>
            <td class="data @if ($monthsummary['monthly_fee'] == '') cell-mark @endif" align="center">{{ $monthsummary['monthly_fee'] }}</td>
            <td class="data @if ($monthsummary['total_pay'] == '') cell-mark @endif" align="center">{{ $monthsummary['total_pay'] }}</td>
        </tr>
        @else
        <tr>
            <td class="data" align="center">{!! $monthsummary['month'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['sales_services'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['workforce'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['documents'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['commercial_ads'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['social_security'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['others'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['subtotal'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['restoration_repair'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['monthly_fee'] !!}</td>
            <td class="data" align="center">{!! $monthsummary['total_pay'] !!}</td>
        </tr>
        @endif
        @endforeach
    </table>
    <div class="page-break"></div>
    <!----------------------------------------
    -----------    END PAGE TAX    -----------
    ----------------------------------------->

    <!------------------------------------------
    -------------    PAGES HELP    -------------
    ------------------------------------------->
    <table class="table_help" cellspacing="0" cellpadding="0" rules="rows">
        <tr>
            <td class="title">Instrucciones para la anotaciones de las operaciones de gastos</td>
        </tr>
        <tr>
            <td class="content">
                <strong>Objetivo:</strong>&nbsp;Proporcionar al contribuyente, que debe utilizar un <strong>Sistema Contable</strong>, los elementos que le permitan la correcta anotaci&oacute;n de la operaciones de gastos en el Registro, ateniendo al Principio de Caja que regula la Norma Contable que rige la actividad.<br>
                <strong>Generales:</strong><br>
                El registro est&aacute; formado por dos p&aacute;ginas para cada mes, una a continuaci&oacute;n de otra, de forma que en un solo plano se puedan regitrar todas las operaciones de un mes; un Resumen anual de gastos y una p&aacute;gina para registrar los Tributos asociados a la actividad, pagados y deducibles en la Declaraci&oacute;n Jurada.<br>
                <strong>Se registran todos los Gastos en que incurre para el desarrollo de la actividad</strong>, a fin de obtener los resultados de las operaciones del ejercicio.<br>
                Los Gastos han sido diferenciados en tres secciones,<br>
                &nbsp;&nbsp;<strong>- DEBITOS: GASTOS DE OPERACI&Oacute;N:</strong> A fin de facilitar la confecci&oacute;n de la Declaraci&oacute;n Jurada, estos a su vez <strong>se conforman en tres grupos:</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>- Gastos propios de la actividad, posibles a deducir en la Declaraci&oacute;n Jurada</strong>. Del total de esos gastos se deduce hasta el % l&iacute;mite autorizado por el MFP. Para deducir, de los gastos registrados, el % m&aacute;ximo, solo se exige justificaci&oacute;n del 50% del l&iacute;mite autorizado, por grupo de actividades.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>- Gastos deducibles directamente de la Base Imponible</strong>. Para la deducci&oacute;n, se exige justificaci&oacute;n del total de los gastos.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>- Egresos no incluidos a efectos de impuesto, autorizados por el MFP</strong>. Estos importes deben estar respaldados por justificantes.<br>
                &nbsp;&nbsp;<strong>- CR&Eacute;DITOS: </strong> Efectivo en Caja y Efectivo en Banco.</strong><br>
                &nbsp;&nbsp;<strong>- DETALLE:</strong><br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>- Columnas:</strong>
                <ul>
                    <li>
                        <strong>1)&nbsp;&nbsp;- D&iacute;a:</strong> Se anota el d&iacute;a a que corresponden los gastos. <strong>En la misma fila de cada d&iacute;a</strong>, se anota el <strong>importe de los gastos incurridos por los diferentes conceptos</strong> que aparecen en las columnas de cualquiera de los grupos que conforman el Registro.<br>
                        <strong>Gastos propios de la actividad posibles a deducir en la Declarai&oacute;n Jurada.</strong> Columnas 2 a la 13. A los efectos de la decucci&oacute;n de los gastos registrados, solo se exige justificaci&oacute;n documental del 50% del l&iacute;mite autorizado por el MFP, por grupo de actividades.
                    </li>
                    <li>
                        <strong>2)&nbsp;&nbsp;- Materias primas y materiales:</strong> Incluyen la compra de productos que se procesan para la prestaci&oacute;n del servicio o la venta.
                    </li>
                    <li>
                        <strong>3)&nbsp;&nbsp;- Mercanc&iacute;as para la venta:</strong> Incluyen los productos que se compran ya elaborados para su venta. <strong>Ejemplo:</strong> Cigarros y Tabacos.
                    </li>
                    <li>
                        <strong>4)&nbsp;&nbsp;- Combustible:</strong> Se registra el importe del combustible que se compra para el consumo de la actividad que se realiza. <strong>Ejemplo:</strong> Gasolina o Petroleo para el transporte que se utiliza directamente en la actividad; petroleo, gas o carb&oacute;n para cocinar en actividades de productos alimenticios u otras que requieran el uso de combustible.
                    </li>
                    <li>
                        <strong>5)&nbsp;&nbsp;- Energ&iacute;a El&eacute;ctrica:</strong> Se registra el importe de la energ&iacute;a el&eacute;ctrica que se consume directamente en la actividad, cuyo consumo puede ser identificado.
                    </li>
                    <li>
                        <strong>6)&nbsp;&nbsp;- Remuneraciones al personal contratado:</strong> Se anota el importe de la n&oacute;mina o documento que se utiliza para el pago al personal contratado.
                    </li>
                    <li>
                        <strong>7 a la 12)&nbsp;&nbsp;- Columnas en Blanco:</strong> Las columnas <strong>7 hasta la 12 se han dejado en blanco</strong> para que se puedan habilitar con los gastos m&aacute;s frecuentes, seg&uacute;n la actividad que desarrolle el contribuyente. <strong>Ejemplo:</strong> Materiales de higiene y limpieza, Servicio de Lavander&iacute;a, Servicio de Limpieza con personal dom&eacute;stico (TCP). Arrendamiento de espacios a otro TCP, publicidad y otros. Puede incluir reparaciones y mantenimientos cuyos importes sean significativos aunque no sean repetitivos, especialmente en los casos de los Modelos de Gesti&oacute;n de arrendamiento de bienes a entidades estatales, excepto las igualas del Modelo de Gesti&oacute;n de Transporte que se deducen d ela base imponible.
                    </li>
                    <li>
                        <strong>13)&nbsp;&nbsp;- Otros gastos monetarios y financieros:</strong> Incluye gastos en los que no se incurre con frecuencia y cuyo monto no es significativo. <strong>Ejemplo:</strong> Intereses y servicios bancarios, Reparaciones y mantenimientos cuando no sean repetitivos y sus importes no sean significativos.
                    </li>
                    <li>
                        <strong>14)&nbsp;&nbsp;- Total gastos autorizados posibles a deducir:</strong> Columna 14 = 2 + 3 + 4 + 5 + 6 + 7 + 8 + 9 + 10 + 11 + 12 + 13.
                    </li>
                </ul>
            </td>
        </tr>
    </table>
    <div class="page-break"></div>
    <table class="table_help3" cellspacing="0" cellpadding="0" rules="rows">
        <tr>
            <td class="content">
                <div class="help-title">Gastos deducibles directamente de la Base Imponible</div>
                <ul>
                    <li>
                        <strong>15)&nbsp;&nbsp;- D&iacute;a:</strong> Se repite el d&iacute;a anotado en la columna 1, aunque no se haya incurrido en gastos que deban ser registrados en cualquiera de las columnas que conforman esta p&aacute;gina del Registro, a fin de facilitar la correcta anotaci&oacute;n por filas y cuadre con el total de los Gastos de oeraci&oacute;n; y con los cr&eacute;ditos a Caja y Banco.
                    </li>
                    <li>
                        <strong>16)&nbsp;&nbsp;- Pago por arrendamiento de bienes a entidades estatales:</strong> Comprende los pagos que se ralizan a las entidades estatales autorizadas a arrendar locales, espacios y otros bienes, seg&uacute;n las carater&iacute;sticas de las actividades y cl&aacute;usulas del contrato. <strong>Ejemplo:</strong> Modelos de gesti&oacute;n de Gastronom&iacute;a, Servicios de Transportaci&oacute;n y otros autorizados.
                    </li>
                    <li>
                        <strong>17 a la 19)&nbsp;&nbsp;- Columnas en Blanco:</strong> Las columnas <strong>17, 18 y 19 se han dejado en blanco</strong> para que se puedan habilitar con los gastos autorizados a deducir, seg&uacute;n la actividad que desarrolle el contribuyente. <strong>Ejemplo:</strong> Igualas en el Modelo de Transporte, Ron embotellado que se compra a precio de poblaci&oacute;n en el Modelo de Gastronomi&acute;a, exoneraci&oacute;n del importe del arrendamiento cuando se asuman reparaciones.
                    </li>
                    <li>
                        <strong>20)&nbsp;&nbsp;- Total a deducir de la Base Imponible:</strong> Columna 20 = 16 + 17 + 18+ 19.
                    </li>
                    <li>
                        <strong>21)&nbsp;&nbsp;- Egresos no incuidos a efectos de impuesto, autorizados por el MFP:</strong> Corresponde al pago de las compras de cigarros y tabacos, no incluidos en los gastos a efectos del pago de los impuestos sobre los ingresos personales y sobre los servicios, autorizados por el MFP; otros, que expresamente se autoricen por el MFP; otros importes deben estar respaldados por justificantes y corresponderse con el importe registrado en la columna 3 del Registro de ingresos.
                    </li>
                    <li>
                        <strong>22)&nbsp;&nbsp;- Total Gasto de Operaci&oacute;n:</strong> Columna 22 = 14 + 20 + 21.
                    </li>
                    <li>
                        <strong>23)&nbsp;&nbsp;- Efectivo en Caja:</strong> Se registra el importe total de los gastos incurridos en el d&iacute;a pagados en efectivo.
                    </li>
                    <li>
                        <strong>24)&nbsp;&nbsp;- Efectivo en Banco:</strong> Se registra el importe de todos los cheques emitidos en el d&iacute;a para el pago de las compras y otros gastos que deban ser pagados por este instrumento de pago.
                    </li>
                    <li>
                        <strong>25)&nbsp;&nbsp;- Total Pagado:</strong> Columna 25 = 23 + 24. El importe de esta columna debe coincidir con la columna 22, Total Gastos de Operai&oacute;n.
                    </li>
                    <li>
                        <strong>26)&nbsp;&nbsp;- Detalle:</strong> Se anota cualquier informaci&acute;n que resulte de inter&eacute;s para el an&aacute;lisis y el control de las operaciones registradas.
                    </li>
                </ul>
            </td>
        </tr>
    </table>
    <table class="table_help2" cellspacing="0" cellpadding="0" rules="rows">
        <tr>
            <td class="title">Instrucciones para la anotaci&oacute;n de las operaciones en el resumen anual de gastos</td>
        </tr>
        <tr>
            <td class="content">
                <strong>Objetivo:</strong> Proporcionar al contribuyente los elementos que le permitan la correcta anotaci&oacute;n de las Operaciones de Gastos en el RESUMEN ANUAL DE GASTOS, lo que permite conocer el valor total de gastos del a&ntilde;o y facilitar la confecci&oacute;n de la Declaraci&oacute;n Jurada.<br>
                <strong>Generales:</strong><br>
                &nbsp;&nbsp;&nbsp;- Se anota el resultado de la suma de las coumnas 2 a la 14 y 16 a la 25, de la fila total, de los folios 2 al 25 del Registro, correspondiente a cada mes.<br>
                &nbsp;&nbsp;&nbsp;- Las filas y columnas se suman y cuadran seg&uacute;n las instrucciones para la anotaci&oacute;n de las operaciones en cada mes.
            </td>
        </tr>
    </table>
    <table class="table_help2" cellspacing="0" cellpadding="0" rules="rows">
        <tr>
            <td class="title2">Instrucciones para la anotaci&oacute;n de los tributos asociados a la actividad pagados y deducibles en la declarac. jurada</td>
        </tr>
        <tr>
            <td class="content">
                <strong>Objetivo:</strong> Proporcionar al cotribuyente los elementos que le permitan la correcta anotaci&oacute;n de los impuestos pagados.<br>
                <strong>Generales:</strong><br>
                &nbsp;&nbsp;&nbsp;- En la <strong>fila de cada mes</strong> se anota el <strong>importe del tributo pagado en ese mes, correspondiente a obligaciones de meses anteriores o futuras, atendiendo al principio de caja que</strong> regula la Norma Contable que rige la actividad.<br>
                &nbsp;&nbsp;&nbsp;- En la columna <strong>Otros</strong> se refleja el importe del tributo pagado, asociado a la actividad, no considerado en las otras columnas, <strong>Ejemplo:</strong> Pago del Impuesto Forestal por el corte de la madera para la elaboraci&oacute;n de escobas u otros utensilios. No se incluyen Transporte Terrestre ni Embarcaciones, por ser impuestos patrimoniales.<br>
                &nbsp;&nbsp;&nbsp;- Al finalizar el a&ntilde;o se suman verticalmente todas las columnas y <strong>el resultado se anota en la fila Total Pagado</strong>. El importe de los tributos pagados de cada columna de la 1 a la 6 de esta fila, <strong>se anota</strong> en la <strong>Secci&oacute;n F</strong> de la Declaraci&oacute;n Jurada, seg&uacute;n corresponda; el importe de la columna 8 Contribuci&oacute;n para la restauraci&oacute;n y preservaci&oacute;n de las zonas donde desarrolla su actividad, <strong>se deduce de la Base Imponible en la fila 15, de la Secci&oacute;n B</strong> de la Declaraci&oacute;n Jurada; el importe de la columna 9, Cuota mensual <strong>se deduce en la fila 23 de la Secci&oacute;n C</strong> de la Declaraci&oacute;n Jurada.<br>
                &nbsp;&nbsp;&nbsp;- La <strong>suma horizontal</strong> de la <strong>fila Total Pagado</strong> es el resultado de sumar: columnas 1 + 2 + 3 + 4 + 5 + 6 = columna 7 <strong>Subtotal de tributos</strong> + columna 8 Contribuci&oacute;n para la restauraci&oacute;n y preservaci&oacute;n de las zonas donde desarrollan su actividad + Columna 9 = <strong>Total pagado en el mes</strong>.
            </td>
        </tr>
    </table>
    <!------------------------------------------
    -----------    END PAGES HELP    -----------
    ------------------------------------------->
@stop