@extends('layouts.pdfbookmodels')

@section('title', 'Estados Financieros')

@section('content')
    <!------------------------------------------
    ---------------    PAGE 1    ---------------
    ------------------------------------------->
    <div class="cover">
        <div class="logo">
            <img src="{{ public_path('images/onat-piramidal.jpg') }}">
        </div>
        <div class="system">Sistema Contable</div>
        <div class="reportname">Estados Financieros</div>
        <div class="year">Ejercicio Contable {{ $year }}</div>
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
                            <strong>Estados Financieros</strong>
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
    <!------------------------------------------
    -------------    END PAGE 2    -------------
    ------------------------------------------->

    <div class="page-break"></div>

    <!------------------------------------------
    ----------    PAGE RESULT STATE    ---------
    ------------------------------------------->
    <header>
        <div style="width: 100%; text-align:center; padding-top: 3px;"><font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif;">-&nbsp;<span class="pagenum"></span>&nbsp;-</font></div>
    </header>
    <div class="header-page">
        <h2>Estado de Resultado</h1>
        <h4>TCP: {{ $tcp->name . ' ' . $tcp->last_name }}</h5>
        <h5>Ejercicio Contable {{ $year }}</h6>    
        <h5>Fecha de Elaboraci&oacute;n: {{ date('d/m/Y') }}</h6>
    </div>
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">PARTIDA</td>
            <td bgcolor="#777" class="tablesubtitle" width="100" style="text-align:right; color:#fff; border-color:#484A4B">SUBTOTAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="100" style="text-align:right; color:#fff; border-color:#484A4B">TOTAL</td>
        </tr>
        @php $count = 0; @endphp
        @foreach ($resultdata as $key => $data)
            @php $count++; @endphp
            <tr>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="entrydata">
                    {!! $data->item !!}
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="entrydata" style="text-align:right;">
                    {{ $data->subtotal }}
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="entrydata" style="text-align:right;">
                    {!! $data->total !!}
                </td>
            </tr>
        @endforeach
    </table>
    <!------------------------------------------
    --------    END PAGE RESULT STATE    -------
    ------------------------------------------->

    <div class="page-break"></div>

    <!------------------------------------------
    --------    PAGE SITUATION STATE    --------
    ------------------------------------------->
    <header>
        <div style="width: 100%; text-align:center; padding-top: 3px;"><font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif;">-&nbsp;<span class="pagenum"></span>&nbsp;-</font></div>
    </header>
    <div class="header-page">
        <h2>Estado de Situaci&oacute;n</h1>
        <h4>TCP: {{ $tcp->name . ' ' . $tcp->last_name }}</h5>
        <h5>Ejercicio Contable {{ $year }}</h6>    
        <h5>Fecha de Elaboraci&oacute;n: {{ date('d/m/Y') }}</h6>
    </div>
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td bgcolor="#777" class="tablesubtitle" style="text-align:left; color:#fff; border-color:#484A4B">PARTIDA</td>
            <td bgcolor="#777" class="tablesubtitle" width="100" style="text-align:right; color:#fff; border-color:#484A4B">SUBTOTAL</td>
            <td bgcolor="#777" class="tablesubtitle" width="100" style="text-align:right; color:#fff; border-color:#484A4B">TOTAL</td>
        </tr>
        @php $count = 0; @endphp
        @foreach ($situationdata as $key => $data)
            @php $count++; @endphp
            <tr>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="entrydata">
                    {!! $data->item !!}
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="entrydata" style="text-align:right;">
                    {{ $data->subtotal }}
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="entrydata" style="text-align:right;">
                    {!! $data->total !!}
                </td>
            </tr>
        @endforeach
    </table>
    <!------------------------------------------
    ------    END PAGE SITUATION STATE    ------
    ------------------------------------------->
@stop