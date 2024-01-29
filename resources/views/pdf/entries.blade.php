@extends('layouts.pdfbook')

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
        <div class="reportname">Registro de las Operaciones<br>de Ingresos para<br>el Trabajador por Cuenta Propia</div>
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
                        <td width="80%" style="text-align: center; text-transform: uppercase; padding: 10px 20px; border-right: #333 1px solid;">
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
    <br>
    <table class="table_tcp" cellspacing="0" cellpadding="0" rules="rows">
        <tr>
            <td colspan="2">
                <table  width="100%" cellspacing="0" cellpadding="0" style="border: 0;">
                    <tr>
                        <td width="80%" style="text-align: center; text-transform: uppercase; padding: 10px 20px;">
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
        <tr height="200px">
            <td width="70%">
                <table align="center" width="180px" border="1" cellspacing="0" cellpadding="0" style="margin-top: 50px;">
                    <tr>
                        <td align="center">D</td>
                        <td align="center">M</td>
                        <td align="center">A</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td>
                <table align="right" width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center" style="height: 150px; font-size: 10px">Para uso de la ONAT</td>
                    </tr>
                </table>
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
    @foreach ($entriesmonth as $month => $entries)
    <header>
        <div style="width: 100%; text-align:center; padding-top: 3px;"><font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif;">-&nbsp;<span class="pagenum"></span>&nbsp;-</font></div>
    </header>
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td class="monthreport" colspan="2"><strong>{{ $month }}</strong></td>
            <td class="monthreportitle" colspan="4"><strong>Registro de las operaciones de ingresos</strong></td>
        </tr>
        <tr>
            <td rowspan="3" width="40" align="center">D&iacute;a</td>
            <td class="tablesubtitle" width="50">D&eacute;bitos</td>
            <td class="tablesubtitle" colspan="3">Cr&eacute;ditos</td>
            <td class="tablesubtitle" width="200" rowspan="3">Detalle</td>
        </tr>
        <tr>
            <td class="tablesubtitle" rowspan="2">Efectivo en Caja</td>
            <td class="tablesubtitle" colspan="2">Subcuentas ingresos</td>
            <td class="tablesubtitle" width="50" rowspan="2">Total Ingresos</td>
        </tr>
        <tr>
            <td class="tablesubtitle" width="50">Ingresos NCEI</td>
            <td class="tablesubtitle" width="50">Ingresos Obtenidos</td>
        </tr>
        <tr>
            <td class="help">(1)</td>
            <td class="help">(2)</td>
            <td class="help">(3)</td>
            <td class="help">(4)</td>
            <td class="help">(5)</td>
            <td class="help">(6)</td>
        </tr>
        @foreach ($entries as $key => $value)
            @if ($value['id'] != '-1')
            <tr>
                <td class="entrydata" align="center">{{ $value['day'] }}</td>
                <td class="entrydata @if ($value['cash_box'] == '') cell-mark @endif" align="right" >{{ $value['cash_box'] }}</td>
                <td class="entrydata @if ($value['cash_ncei'] == '') cell-mark @endif" align="right">{{ $value['cash_ncei'] }}</td>
                <td class="entrydata @if ($value['entry'] == '') cell-mark @endif" align="right">{{ $value['entry'] }}</td>
                <td class="entrydata @if ($value['totalentry'] == '') cell-mark @endif" align="right">{{ $value['totalentry'] }}</td>
                <td class="entrydata">{{ $value['detail'] }}</td>
            </tr>
            @else
            <tr>
                <td class="entrydata" align="center">{!! $value['day'] !!}</td>
                <td class="entrydata" align="right">{!! $value['cash_box'] !!}</td>
                <td class="entrydata" align="right">{!! $value['cash_ncei'] !!}</td>
                <td class="entrydata" align="right">{!! $value['entry'] !!}</td>
                <td class="entrydata" align="right">{!! $value['totalentry'] !!}</td>
                <td class="entrydata"></td>
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
            <td class="monthreport" colspan="5" align="center"><strong>Resumen anual de las operaciones de ingresos</strong></td>
        </tr>
        <tr>
            <td class="tablesubtitle" width="20%" rowspan="3" style="text-align:left;">Meses</td>
            <td class="tablesubtitle" width="18%" align="center">Débitos</td>
            <td class="tablesubtitle" colspan="3" align="center">Créditos</td>
        </tr>
        <tr>
            <td class="tablesubtitle" rowspan="2" align="center">Efectivo en Caja</td>
            <td class="tablesubtitle" colspan="2" align="center">Subcuentas Ingresos</td>
            <td class="tablesubtitle" width="20%" rowspan="2">Total Ingresos</td>
        </tr>
        <tr>
            <td class="tablesubtitle" width="22%">Ingresos NCEI</td>
            <td class="tablesubtitle" width="20%">Ingresos Obtenidos</td>
        </tr>
        <tr>
            <td class="help">(1)</td>
            <td class="help">(2)</td>
            <td class="help">(3)</td>
            <td class="help">(4)</td>
            <td class="help">(5)</td>
        </tr>
        @foreach ($entryear as $key => $monthsummary)
        @if ($key != 12)
        <tr>
            <td class="entrydata">{{ $monthsummary['month'] }}</td>
            <td class="entrydata" align="right">{{ $monthsummary['cash_box'] }}</td>
            <td class="entrydata" align="right">{{ $monthsummary['cash_ncei'] }}</td>
            <td class="entrydata" align="right">{{ $monthsummary['entry'] }}</td>
            <td class="entrydata" align="right">{{ $monthsummary['totalentry'] }}</td>
        </tr>
        @else
        <tr>
            <td class="entrydata">{!! $monthsummary['month'] !!}</td>
            <td class="entrydata" align="right">{!! $monthsummary['cash_box'] !!}</td>
            <td class="entrydata" align="right">{!! $monthsummary['cash_ncei'] !!}</td>
            <td class="entrydata" align="right">{!! $monthsummary['entry'] !!}</td>
            <td class="entrydata" align="right">{!! $monthsummary['totalentry'] !!}</td>
        </tr>
        @endif
        @endforeach
    </table>
    <div class="page-break"></div>
    <!------------------------------------------
    -----------    END PAGES YEAR    -----------
    ------------------------------------------->

    <!------------------------------------------
    -------------    PAGE HELP    --------------
    ------------------------------------------->
    <table class="table_help" cellspacing="0" cellpadding="0" rules="rows">
        <tr>
            <td class="title">Instrucciones para la anotaci&oacute;n de las operaciones de ingresos</td>
        </tr>
        <tr>
            <td class="content">
                <strong>Objetivo:</strong>&nbsp;Proporcionar al contribuyente que debe utilizar un <strong>Sistema Contable</strong>, los elementos que le permitan la correcta anotaci&oacute;n de las operaciones de ingresos en el Registro, atendiendo al Principio de Caja que regula la Norma Contable que rige la actividad.<br>
                <strong>Generales:</strong><br>
                El Registro est&aacute; conformado por una p&aacute;gina para cada mes y un Resumen Anual de Ingresos.<br>
                Los ingresos han sido diferenciados en tres secciones:
                <ul>
                    <li>- <strong>D&Eacute;BITOS:</strong> EFECTIVO EN CAJA</li>
                    <li>- <strong>CR&Eacute;DITOS:</strong> INGRESOS</li>
                    <li>- <strong>DETALLE</strong></li>
                </ul>
                <strong>Columnas:</strong><br>
                <ul>
                    <li><strong>1) D&iacute;a:</strong> Se anota el d&iacute;a a que corresponden los ingresos.</li>
                    <li><strong>2) EFECTIVO EN CAJA:</strong> Se anota el importe del efectivo en caja recaudado en el d&iacute;a por las ventas o servicios prestados.</li>
                    <li><strong>3) NO CONSIDERADOS A EFECTOS DE IMPUESTOS:</strong> Se anota el importe total de los ingresos obtenidos en el d&iacute;a por las ventas o servicios prestados, <strong>no considerados para el pago de los impuestos</strong> sobre las Ventas o los Servicios. <strong>Ejemplo:</strong> exenci&oacute;n del pago del impuesto en los primeros tres (3) meses de operaciones; ingresos por la venta de cigarros y tabacos no conserados a los efectos del pago de los Impuestos sobre los ingresos personales y sobre los servicios; otros que expresamente se autoricen por el MFP.</li>
                    <li><strong>4) INGRESOS OBTENIDOS:</strong> Se anota el importe de los ingresos obtenidos en el d&iacute;a, por las ventas o servicios por cuyo valor se paga el impuesto sobre las Ventas o sobre los Servicios: incluye todos los ingresos recibidos, excepto los reflejados en la columna 3.</li>
                    <li><strong>5) TOTAL INGRESOS:</strong> columna 5 = 3 + 4. Este importe debe coincidir con el anotado en la columna 2.</li>
                    <li><strong>6) DETALLE:</strong> Se refleja el <strong>concepto</strong> de los ingresos no considerados para el pago de los impuestos, que fueron anotados en la columna tres (3) o cualquier otra informaci&oacute;n que resute de inter&eacute;s para el an&aacute;lisis y el control de las operaciones registradas.</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td class="title">Instrucciones para la anotaci&oacute;n de las operaciones en el resumen anual de ingresos</td>
        </tr>
        <tr>
            <td class="content">
                <strong>Objetivo:</strong>&nbsp;Proporcionar al contribuyente los elementos que le permitan la correcta anotaci&oacute;n de ingresos en el RESUMEN ANUAL DE INGRESOS, lo que permite conocer el volumen del total de Ingresos del a&ntilde;o y facilita la confecci&oacute;n de la Declaraci&oacute;n Jurada.<br>
                <strong>Generales:</strong><br>
                <ul>
                    <li>- Se anota el resultado de la suma de las columnas 2, 3, 4 y 5 de la fila total, de los folios 2 al 13 del Registro, correspondientes a cada mes.</li>
                    <li>- A los efectos de la confecci&oacute;n de la Declaraci&oacute;n Jurada, el importe de la suma de la colummna 4, INGRESOS OBTENIDOS, de la fila TOTAL, se anota en la fila correspondiente a la actividad que desarrolla, en la <strong>casilla 12, INGRESOS OBTENIDOS</strong>.</li>
                </ul>
            </td>
        </tr>
    </table>
    <!------------------------------------------
    -----------    END PAGE HELP    ------------
    ------------------------------------------->
@stop