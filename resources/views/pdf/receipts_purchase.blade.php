@extends('layouts.pdfbookpurchasereceipts')

@section('title', 'Comprobantes de Compra')

@section('content')
    <!------------------------------------------
    -----------    PAGE RECEIPTS    -----------
    ------------------------------------------->
    
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="250">

                <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px; font-size: 14px;">
                                <strong>COMPROBANTE DE COMPRAS</strong>
                            </div>
                            <div style="float:right; width:200px; height:20px; text-align:right;">
                                Fecha: ___/___/{{ date('Y') }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px">
                                <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px">
                                <strong>PROVEEDOR:</strong>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#777" class="entrydata" width="5" style="text-align:center; color:#fff; border-color:#484A4B">No.</td>
                        <td bgcolor="#777" class="entrydata" style="text-align:left; color:#fff; border-color:#484A4B">PRODUCTO</td>
                        <td bgcolor="#777" class="entrydata" width="10" style="text-align:center; color:#fff; border-color:#484A4B">U/M</td>
                        <td bgcolor="#777" class="entrydata" width="20" style="text-align:right; color:#fff; border-color:#484A4B">CTDAD</td>
                        <td bgcolor="#777" class="entrydata" width="40" style="text-align:right; color:#fff; border-color:#484A4B">PRECIO</td>
                        <td bgcolor="#777" class="entrydata" width="40" style="text-align:right; color:#fff; border-color:#484A4B">IMPORTE</td>
                    </tr>
                    @for ($i = 1; $i < 9; $i++)
                    <tr>
                        <td style="text-align: center">{{ $i }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endfor
                    <tr>
                        <td colspan="5" class="entrydata" style="text-align: right"><strong>TOTAL:</strong></td>
                        <td class="entrydata">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="height:30px" colspan="4" class="entrydata" valign="top">(&nbsp;&nbsp;) Se neg&oacute; a firmar</td>
                        <td style="height:30px" colspan="2" class="entrydata" valign="top">Firma:</td>
                    </tr>
                </table>

            </td>
            <td width="25">&nbsp;</td>
            <td width="250">

                <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px; font-size: 14px;">
                                <strong>COMPROBANTE DE COMPRAS</strong>
                            </div>
                            <div style="float:right; width:200px; height:20px; text-align:right;">
                                Fecha: ___/___/{{ date('Y') }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px">
                                <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px">
                                <strong>PROVEEDOR:</strong>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#777" class="entrydata" width="5" style="text-align:center; color:#fff; border-color:#484A4B">No.</td>
                        <td bgcolor="#777" class="entrydata" style="text-align:left; color:#fff; border-color:#484A4B">PRODUCTO</td>
                        <td bgcolor="#777" class="entrydata" width="10" style="text-align:center; color:#fff; border-color:#484A4B">U/M</td>
                        <td bgcolor="#777" class="entrydata" width="20" style="text-align:right; color:#fff; border-color:#484A4B">CTDAD</td>
                        <td bgcolor="#777" class="entrydata" width="40" style="text-align:right; color:#fff; border-color:#484A4B">PRECIO</td>
                        <td bgcolor="#777" class="entrydata" width="40" style="text-align:right; color:#fff; border-color:#484A4B">IMPORTE</td>
                    </tr>
                    @for ($i = 1; $i < 9; $i++)
                    <tr>
                        <td style="text-align: center">{{ $i }}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    @endfor
                    <tr>
                        <td colspan="5" class="entrydata" style="text-align: right"><strong>TOTAL:</strong></td>
                        <td class="entrydata">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="height:30px" colspan="4" class="entrydata" valign="top">(&nbsp;&nbsp;) Se neg&oacute; a firmar</td>
                        <td style="height:30px" colspan="2" class="entrydata" valign="top">Firma:</td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
    
    <br>&nbsp;
    <br>&nbsp;

    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="250">

                <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px; font-size: 14px;">
                                <strong>COMPROBANTE DE COMPRAS</strong>
                            </div>
                            <div style="float:right; width:200px; height:20px; text-align:right;">
                                Fecha: ___/___/{{ date('Y') }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px">
                                <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px">
                                <strong>PROVEEDOR:</strong>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#777" class="entrydata" width="5" style="text-align:center; color:#fff; border-color:#484A4B">No.</td>
                        <td bgcolor="#777" class="entrydata" style="text-align:left; color:#fff; border-color:#484A4B">PRODUCTO</td>
                        <td bgcolor="#777" class="entrydata" width="10" style="text-align:center; color:#fff; border-color:#484A4B">U/M</td>
                        <td bgcolor="#777" class="entrydata" width="20" style="text-align:right; color:#fff; border-color:#484A4B">CTDAD</td>
                        <td bgcolor="#777" class="entrydata" width="40" style="text-align:right; color:#fff; border-color:#484A4B">PRECIO</td>
                        <td bgcolor="#777" class="entrydata" width="40" style="text-align:right; color:#fff; border-color:#484A4B">IMPORTE</td>
                    </tr>
                    @for ($i = 1; $i < 9; $i++)
                    <tr>
                        <td style="text-align: center">{{ $i }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endfor
                    <tr>
                        <td colspan="5" class="entrydata" style="text-align: right"><strong>TOTAL:</strong></td>
                        <td class="entrydata">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="height:30px" colspan="4" class="entrydata" valign="top">(&nbsp;&nbsp;) Se neg&oacute; a firmar</td>
                        <td style="height:30px" colspan="2" class="entrydata" valign="top">Firma:</td>
                    </tr>
                </table>

            </td>
            <td width="25">&nbsp;</td>
            <td width="250">

                <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px; font-size: 14px;">
                                <strong>COMPROBANTE DE COMPRAS</strong>
                            </div>
                            <div style="float:right; width:200px; height:20px; text-align:right;">
                                Fecha: ___/___/{{ date('Y') }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px">
                                <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px">
                                <strong>PROVEEDOR:</strong>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#777" class="entrydata" width="5" style="text-align:center; color:#fff; border-color:#484A4B">No.</td>
                        <td bgcolor="#777" class="entrydata" style="text-align:left; color:#fff; border-color:#484A4B">PRODUCTO</td>
                        <td bgcolor="#777" class="entrydata" width="10" style="text-align:center; color:#fff; border-color:#484A4B">U/M</td>
                        <td bgcolor="#777" class="entrydata" width="20" style="text-align:right; color:#fff; border-color:#484A4B">CTDAD</td>
                        <td bgcolor="#777" class="entrydata" width="40" style="text-align:right; color:#fff; border-color:#484A4B">PRECIO</td>
                        <td bgcolor="#777" class="entrydata" width="40" style="text-align:right; color:#fff; border-color:#484A4B">IMPORTE</td>
                    </tr>
                    @for ($i = 1; $i < 9; $i++)
                    <tr>
                        <td style="text-align: center">{{ $i }}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    @endfor
                    <tr>
                        <td colspan="5" class="entrydata" style="text-align: right"><strong>TOTAL:</strong></td>
                        <td class="entrydata">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="height:30px" colspan="4" class="entrydata" valign="top">(&nbsp;&nbsp;) Se neg&oacute; a firmar</td>
                        <td style="height:30px" colspan="2" class="entrydata" valign="top">Firma:</td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

    <br>&nbsp;
    <br>&nbsp;

    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="250">

                <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px; font-size: 14px;">
                                <strong>COMPROBANTE DE COMPRAS</strong>
                            </div>
                            <div style="float:right; width:200px; height:20px; text-align:right;">
                                Fecha: ___/___/{{ date('Y') }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px">
                                <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px">
                                <strong>PROVEEDOR:</strong>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#777" class="entrydata" width="5" style="text-align:center; color:#fff; border-color:#484A4B">No.</td>
                        <td bgcolor="#777" class="entrydata" style="text-align:left; color:#fff; border-color:#484A4B">PRODUCTO</td>
                        <td bgcolor="#777" class="entrydata" width="10" style="text-align:center; color:#fff; border-color:#484A4B">U/M</td>
                        <td bgcolor="#777" class="entrydata" width="20" style="text-align:right; color:#fff; border-color:#484A4B">CTDAD</td>
                        <td bgcolor="#777" class="entrydata" width="40" style="text-align:right; color:#fff; border-color:#484A4B">PRECIO</td>
                        <td bgcolor="#777" class="entrydata" width="40" style="text-align:right; color:#fff; border-color:#484A4B">IMPORTE</td>
                    </tr>
                    @for ($i = 1; $i < 9; $i++)
                    <tr>
                        <td style="text-align: center">{{ $i }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endfor
                    <tr>
                        <td colspan="5" class="entrydata" style="text-align: right"><strong>TOTAL:</strong></td>
                        <td class="entrydata">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="height:30px" colspan="4" class="entrydata" valign="top">(&nbsp;&nbsp;) Se neg&oacute; a firmar</td>
                        <td style="height:30px" colspan="2" class="entrydata" valign="top">Firma:</td>
                    </tr>
                </table>

            </td>
            <td width="25">&nbsp;</td>
            <td width="250">

                <table class="table_rules" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px; font-size: 14px;">
                                <strong>COMPROBANTE DE COMPRAS</strong>
                            </div>
                            <div style="float:right; width:200px; height:20px; text-align:right;">
                                Fecha: ___/___/{{ date('Y') }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px">
                                <strong>TCP:</strong> {{ $tcp->name . ' ' . $tcp->last_name }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="entrydata" style="height:20px">
                            <div style="float:left; width:300px; height:20px">
                                <strong>PROVEEDOR:</strong>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#777" class="entrydata" width="5" style="text-align:center; color:#fff; border-color:#484A4B">No.</td>
                        <td bgcolor="#777" class="entrydata" style="text-align:left; color:#fff; border-color:#484A4B">PRODUCTO</td>
                        <td bgcolor="#777" class="entrydata" width="10" style="text-align:center; color:#fff; border-color:#484A4B">U/M</td>
                        <td bgcolor="#777" class="entrydata" width="20" style="text-align:right; color:#fff; border-color:#484A4B">CTDAD</td>
                        <td bgcolor="#777" class="entrydata" width="40" style="text-align:right; color:#fff; border-color:#484A4B">PRECIO</td>
                        <td bgcolor="#777" class="entrydata" width="40" style="text-align:right; color:#fff; border-color:#484A4B">IMPORTE</td>
                    </tr>
                    @for ($i = 1; $i < 9; $i++)
                    <tr>
                        <td style="text-align: center">{{ $i }}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    @endfor
                    <tr>
                        <td colspan="5" class="entrydata" style="text-align: right"><strong>TOTAL:</strong></td>
                        <td class="entrydata">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="height:30px" colspan="4" class="entrydata" valign="top">(&nbsp;&nbsp;) Se neg&oacute; a firmar</td>
                        <td style="height:30px" colspan="2" class="entrydata" valign="top">Firma:</td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

    <!------------------------------------------
    ---------    END PAGE RECEIPTS    ----------
    ------------------------------------------->

@stop