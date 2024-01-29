@extends('layouts.pdf')

@section('title', 'Inventario del Patrimonio')

@section('content')
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; font-weight:bold; margin:30px 0; width:100%">
        <tr>
            <td>&nbsp;Inventario del Patrimonio</td>
            <td width="120" style="text-align:right; font-size:14px; font-weight:normal">
                Fecha: {{ date('d/m/Y') }}&nbsp;
            </td>
        </tr>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
        <thead>
            <tr>
                <th width="20" style="padding: 7px 5px; font-size:12px; border-bottom:#333 1px solid; text-align: center">NO.</th>
                <th width="145" style="padding: 7px 5px; font-size:12px; border-bottom:#333 1px solid;">PRODUCTO</th>
                <th width="20" style="padding: 7px 5px; font-size:12px; border-bottom:#333 1px solid; text-align: center">UM</th>
                <th width="30" style="padding: 7px 5px; font-size:12px; border-bottom:#333 1px solid; text-align: center">CTDAD</th>
                <th width="55" style="padding: 7px 5px; font-size:12px; border-bottom:#333 1px solid; text-align: right">PRECIO</th>
                <th width="65" style="padding: 7px 5px; font-size:12px; border-bottom:#333 1px solid; text-align: right">IMPORTE</th>
                <th width="40" style="padding: 7px 5px; font-size:12px; border-bottom:#333 1px solid; text-align: center">V.UTIL</th>
                <th width="65" style="padding: 7px 5px; font-size:12px; border-bottom:#333 1px solid; text-align: right">DEP.ANUAL</th>
                <th width="65" style="padding: 7px 5px; font-size:12px; border-bottom:#333 1px solid; text-align: right">DEP.MENSUAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $key => $group)
            @php 
            $counter        = 0;
            $total_import   = 0;
            $total_depyear  = 0;
            $total_depmonth = 0;
            @endphp
            
            <tr>
                <th colspan="9" style="padding: 7px 5px; font-size:12px; border-bottom:#999 1px solid; background-color:#EBEFF1;">
                    &nbsp;Grupo {{ $group }}
                </th>
            </tr>            
                @foreach ($aft as $product)
                    @if ($product->id_group == $key)
                        @php 
                        $counter++;
                        $total_import   += $product->import;
                        $total_depyear  += $product->dep_year;
                        $total_depmonth += $product->dep_month;
                        @endphp
                        <tr>
                            <th style="padding: 7px 5px; font-size:12px; font-weight:500; border-bottom:#999 1px solid; text-align:center;">{{ $counter }}</th>
                            <th style="padding: 7px 5px; font-size:12px; font-weight:500; border-bottom:#999 1px solid;">{{ $product->product }}</th>  
                            <th style="padding: 7px 5px; font-size:12px; font-weight:500; border-bottom:#999 1px solid; text-align:center;">U</th>
                            <th style="padding: 7px 5px; font-size:12px; font-weight:500; border-bottom:#999 1px solid; text-align:center;">{{ $product->ctdad }}</th>
                            <th style="padding: 7px 5px; font-size:12px; font-weight:500; border-bottom:#999 1px solid; text-align:right;">{{ number_format($product->price, 2, '.', ',') }}</th>
                            <th style="padding: 7px 5px; font-size:12px; font-weight:500; border-bottom:#999 1px solid; text-align:right;">{{ number_format($product->import, 2, '.', ',') }}</th>
                            <th style="padding: 7px 5px; font-size:12px; font-weight:500; border-bottom:#999 1px solid; text-align:center;">{{ $product->current_live }}</th>
                            <th style="padding: 7px 5px; font-size:12px; font-weight:500; border-bottom:#999 1px solid; text-align:right;">{{ number_format($product->dep_year, 2, '.', ',') }}</th>
                            <th style="padding: 7px 5px; font-size:12px; font-weight:500; border-bottom:#999 1px solid; text-align:right;">{{ number_format($product->dep_month, 2, '.', ',') }}</th>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <th colspan="5" style="padding: 7px 5px; font-size:12px; font-weight:700; border-bottom:#999 1px solid;">&nbsp;Total</th>
                    <th style="padding: 7px 5px; font-size:12px; font-weight:700; border-bottom:#999 1px solid; text-align:right;">$ {{ number_format($total_import, 2, '.', ',') }}</th>  
                    <th style="border-bottom:#999 1px solid;">&nbsp;</th>
                    <th style="padding: 7px 5px; font-size:12px; font-weight:700; border-bottom:#999 1px solid; text-align:right;">$ {{ number_format($total_depyear, 2, '.', ',') }}</th>
                    <th style="padding: 7px 5px; font-size:12px; font-weight:700; border-bottom:#999 1px solid; text-align:right;">$ {{ number_format($total_depmonth, 2, '.', ',') }}</th>
                </tr>
            @endforeach
            
            
        </tbody>
    </table>
@stop