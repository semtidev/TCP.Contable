@extends('layouts.pdfmodellandscape')

@section('title', 'Registro de Efectivo')

@section('content')
    <!------------------------------------------
    ---------    PAGE CASH REGISTER    ---------
    ------------------------------------------->
    <table class="table_rules mt-0" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="4" style="text-align: center">
                <h3>Entrada - Salida Efectivo en Caja</h3>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: #666; font-size: 12px;">&nbsp;Cuenta</span><br>
                <div class="tablesubtitle" style="width: 100%; text-align: center; line-height: 12px;">
                    {{ $account_desc }}
                </div>
            </td>
            <td width="150">
                <span style="color: #666; font-size: 12px;">&nbsp;C&oacute;digo</span><br>
                <div class="tablesubtitle" style="width: 100%; text-align: center; line-height: 12px;">
                    {{ $account_code }}
                </div>
            </td>
            <td width="150">
                <span style="color: #666; font-size: 12px;">&nbsp;Per&iacute;odo Contable</span><br>
                <div class="tablesubtitle" style="width: 100%; text-align: center; line-height: 12px;">
                    {{ month_name(intval($month)).'/'.$year }}
                </div>
            </td>
            <td width="150">
                <span style="color: #666; font-size: 12px;">&nbsp;Fecha Elaboraci&oacute;n</span><br>
                <div class="tablesubtitle" style="width: 100%; text-align: center; line-height: 12px;">
                    {{ date('d/m/Y') }}
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: #666; font-size: 12px;">&nbsp;Empresa</span><br>
                <div class="tablesubtitle" style="width: 100%; text-align: center; line-height: 12px;">
                    {{ $tcp->company }}
                </div>
            </td>
            <td colspan="2" width="150">
                <span style="color: #666; font-size: 12px;">&nbsp;Actividad</span><br>
                <div class="tablesubtitle" style="width: 100%; text-align: center; line-height: 12px;">
                    {{ $tcp->act_code .'-'. $tcp->act_desc }}
                </div>
            </td>
            <td width="150">
                <span style="color: #666; font-size: 12px;">&nbsp;Plantilla</span><br>
                <div class="tablesubtitle" style="width: 100%; text-align: center; line-height: 12px;">
                    {{ $tcp->workers . ' Trabajador(es)' }}
                </div>
            </td>
        </tr>
    </table>
    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td class="tablesubtitle" style="text-align:center;">D&iacute;a</td>
            <td class="tablesubtitle" width="45" style="text-align:right;">Ventas</td>
            <td class="tablesubtitle" width="40" style="text-align:right;">MPM</td>
            <td class="tablesubtitle" width="40" style="text-align:right;">MPV</td>
            <td class="tablesubtitle" width="50" style="text-align:right;">Combust.</td>
            <td class="tablesubtitle" width="50" style="text-align:right;">Elect.</td>
            <td class="tablesubtitle" width="50" style="text-align:right;">Salario</td>
            <td class="tablesubtitle" width="60" style="text-align:right;">Impuestos</td>
            <td class="tablesubtitle" width="60" style="text-align:right;">Dep. Banco</td>
            <td class="tablesubtitle" width="50" style="text-align:right;">D&eacute;bito</td>
            <td class="tablesubtitle" width="50" style="text-align:right;">Cr&eacute;dito</td>
            <td class="tablesubtitle" width="50" style="text-align:right;">Saldo</td>
        </tr>
        @php $count = 0; @endphp
        @foreach ($regcash as $key => $data)
            @php $count++; @endphp
            @if ($count == 1)
            <tr>
                <td colspan="11" @if ($count%2 != 0) bgcolor="#EAECED" @endif></td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right; font-weight: 700">
                    @if ($data['sald'] != null && $data['sald'] != '') {!! $data['sald'] !!} @endif
                </td>
            </tr>
            @elseif ($count == 22)
            @php $count++; @endphp
            <tr>
                <td class="tablesubtitle" style="text-align:center;">D&iacute;a</td>
                <td class="tablesubtitle" width="45" style="text-align:right;">Ventas</td>
                <td class="tablesubtitle" width="40" style="text-align:right;">MPM</td>
                <td class="tablesubtitle" width="40" style="text-align:right;">MPV</td>
                <td class="tablesubtitle" width="50" style="text-align:right;">Combust.</td>
                <td class="tablesubtitle" width="50" style="text-align:right;">Elect.</td>
                <td class="tablesubtitle" width="50" style="text-align:right;">Salario</td>
                <td class="tablesubtitle" width="60" style="text-align:right;">Impuestos</td>
                <td class="tablesubtitle" width="60" style="text-align:right;">Dep. Banco</td>
                <td class="tablesubtitle" width="50" style="text-align:right;">D&eacute;bito</td>
                <td class="tablesubtitle" width="50" style="text-align:right;">Cr&eacute;dito</td>
                <td class="tablesubtitle" width="50" style="text-align:right;">Saldo</td>
            </tr>
            <tr>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                    {!! $data['day'] !!}
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['sales'] != null && $data['sales'] != '') {!! $data['sales'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['mpm'] != null && $data['mpm'] != '') {!! $data['mpm'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['mpv'] != null && $data['mpv'] != '') {!! $data['mpv'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['fuel'] != null && $data['fuel'] != '') {!! $data['fuel'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['elect'] != null && $data['elect'] != '') {!! $data['elect'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['workers'] != null && $data['workers'] != '') {!! $data['workers'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['tax'] != null && $data['tax'] != '') {!! $data['tax'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['bank_deposit'] != null && $data['bank_deposit'] != '') {!! $data['bank_deposit'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['debit'] != null && $data['debit'] != '') {!! $data['debit'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['credit'] != null && $data['credit'] != '') {!! $data['credit'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['sald'] != null && $data['sald'] != '') {!! $data['sald'] !!} @endif
                </td>
            </tr>
            @else
            <tr>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                    {!! $data['day'] !!}
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['sales'] != null && $data['sales'] != '') {!! $data['sales'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['mpm'] != null && $data['mpm'] != '') {!! $data['mpm'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['mpv'] != null && $data['mpv'] != '') {!! $data['mpv'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['fuel'] != null && $data['fuel'] != '') {!! $data['fuel'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['elect'] != null && $data['elect'] != '') {!! $data['elect'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['workers'] != null && $data['workers'] != '') {!! $data['workers'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['tax'] != null && $data['tax'] != '') {!! $data['tax'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['bank_deposit'] != null && $data['bank_deposit'] != '') {!! $data['bank_deposit'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['debit'] != null && $data['debit'] != '') {!! $data['debit'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['credit'] != null && $data['credit'] != '') {!! $data['credit'] !!} @endif
                </td>
                <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                    @if ($data['sald'] != null && $data['sald'] != '') {!! $data['sald'] !!} @endif
                </td>
            </tr>
            @endif
        @endforeach
    </table>

    <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <span style="color: #666; font-size: 12px;">&nbsp;TCP Titular</span><br>
                <div class="tablesubtitle" style="width: 100%; text-align: center; line-height: 12px;">
                    {{ $tcp->name .' '.$tcp->last_name }}
                </div>
            </td>
            <td colspan="2" width="150">
                <span style="color: #666; font-size: 12px;">&nbsp;C&oacute;digo NIT</span><br>
                <div class="tablesubtitle" style="width: 100%; text-align: center; line-height: 12px;">
                    {{ $tcp->act_code .'-'. $tcp->nit }}
                </div>
            </td>
            <td width="150">
                <span style="color: #666; font-size: 12px;">&nbsp;Firma</span><br>
                <div class="tablesubtitle" style="width: 100%; text-align: center; line-height: 12px;">
                    &nbsp;
                </div>
            </td>
        </tr>
    </table>  
    <!------------------------------------------
    --------    END PAGE CASH REGISTER    -------
    ------------------------------------------->
@stop