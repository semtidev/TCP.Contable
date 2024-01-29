@extends('layouts.pdfmodellandscape')

@section('title', 'Submayor de Cuenta')

@section('content')

    <!---------------------------------------
    ---------    PAGE SUBLARGEST    ---------
    ---------------------------------------->
    <table class="table_rules mt-0" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="4" style="text-align: center">
                <h3>Submayor de Cuenta</h3>
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
            <td colspan="2" class="tablesubtitle" style="text-align:center;">Fecha</td>
            <td colspan="2" class="tablesubtitle" style="text-align:center;">Referencia</td>
            <td rowspan="2" class="tablesubtitle" style="text-align:left;">Detalle</td>
            <td rowspan="2" class="tablesubtitle" style="text-align:right;" width="70">Debe</td>
            <td rowspan="2" class="tablesubtitle" style="text-align:right;" width="70">Haber</td>
            <td rowspan="2" class="tablesubtitle" style="text-align:right;" width="70">Saldo</td>
        </tr>
        <tr>
            <td class="tablesubtitle" style="text-align:center;" width="30">D</td>
            <td class="tablesubtitle" style="text-align:center;" width="30">M</td>
            <td class="tablesubtitle" style="text-align:center;" width="40">Clave</td>
            <td class="tablesubtitle" style="text-align:center;" width="40">No.</td>
        </tr>
        @php $count = 0; @endphp
        @foreach ($sublargest as $key => $data)
        @php $count++; @endphp
        @if ($count == 21)
        <tr>
            <td colspan="2" class="tablesubtitle" style="text-align:center;">Fecha</td>
            <td colspan="2" class="tablesubtitle" style="text-align:center;">Referencia</td>
            <td rowspan="2" class="tablesubtitle" style="text-align:left;">Detalle</td>
            <td rowspan="2" class="tablesubtitle" style="text-align:right;" width="70">Debe</td>
            <td rowspan="2" class="tablesubtitle" style="text-align:right;" width="70">Haber</td>
            <td rowspan="2" class="tablesubtitle" style="text-align:right;" width="70">Saldo</td>
        </tr>
        <tr>
            <td class="tablesubtitle" style="text-align:center;" width="30">D</td>
            <td class="tablesubtitle" style="text-align:center;" width="30">M</td>
            <td class="tablesubtitle" style="text-align:center;" width="40">Clave</td>
            <td class="tablesubtitle" style="text-align:center;" width="40">No.</td>
        </tr>
        <tr>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['day'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['month'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['code'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['number'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:left;">
                {!! $data['desc'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                @if ($data['debit'] != '') {!! $data['debit'] !!} @else 0.00 @endif
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                @if ($data['credit'] != '') {!! $data['credit'] !!} @else 0.00 @endif
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                @if ($data['sald'] != '') {!! $data['sald'] !!} @else 0.00 @endif
            </td>
        </tr>
        @else
        <tr>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['day'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['month'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['code'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:center;">
                {!! $data['number'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:left;">
                {!! $data['desc'] !!}
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                @if ($data['debit'] != '') {!! $data['debit'] !!} @else 0.00 @endif
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                @if ($data['credit'] != '') {!! $data['credit'] !!} @else 0.00 @endif
            </td>
            <td @if ($count%2 != 0) bgcolor="#EAECED" @endif class="data" style="text-align:right;">
                @if ($data['sald'] != '') {!! $data['sald'] !!} @else 0.00 @endif
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
    <!----------------------------------------
    --------    END PAGE SUBLARGEST    -------
    ----------------------------------------->
@stop