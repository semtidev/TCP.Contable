<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Models\Tcp;
use App\Models\Province;
use App\Models\City;
use App\Models\TcpObligation;
use App\Models\CashBank;
use App\Models\Entry;
use App\Models\Expense;
use App\Models\Tax;
use App\Models\ModelOption;
use App\Models\TcpCashboxStart;
use App\Models\AftGroup;
use App\Models\AftSubgroup;
use App\Models\AftProduct;
use App\Models\Account;
use App\Models\AftProductsubgroup;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use Illuminate\Http\Request;

class SublargestController extends Controller
{
    /**
     * Display a listing of days.
     *
     * @return \Illuminate\Http\Response
     */
    public function sublargest($tcp, $account, $month, $year)
    {
        $sublargest = array();
        $sald       = 0;
        $sald_prev  = 0;
        $number     = 0;

        $date_send = intval($year.$month.'01');        
        $firstday = $year .'-'. $month .'-01';

        // BOX CASH
        if ($account == '100'){
            
            // START SALD
            if (TcpCashboxStart::where('id_tcp', $tcp)->exists()){
            
                $saldstart = TcpCashboxStart::where('id_tcp', $tcp)->first();
                $date_start_arr = explode('-', $saldstart->date_start);
                $date_start = $date_start_arr[0] . '-' . $date_start_arr[1] . '-01';
                $date_start_num = intval($date_start_arr[0].$date_start_arr[1].'01');
                $day_start = intval($date_start_arr[2]);
                $sald_start = $saldstart->sald;
                
                if ($date_send < $date_start_num) {
                    $response = array(
                        'success' => false, 
                        'message' => 'El Submayor de esta Cuenta solo se puede generar a patir del mes en que fue definido el Saldo Inicial de Efectivo en Caja al inicio de la actividad.',
                        'regcash' => null
                    );    
                    return response()->json($response, 200);
                }

                $d_start = new DateTime($date_start);
                $d_end   = new DateTime($firstday);

                $dif = $d_start->diff($d_end);
                $months = ( $dif->y * 12 ) + $dif->m;
                
                if ($months == 0){ $sald += $saldstart->sald; $sald_monthstart = $sald; }
                else 
                {
                    $months_current = date("Y-m-d",strtotime($firstday . '- '.$months.' month'));  
                    
                    for ($j=0; $j < $months; $j++)
                    {
                        for ($k=0; $k < date('t', strtotime($months_current)); $k++) {
                            
                            if($j + 1 == 1 && $k + 1 == 1) {
                                $sald += $sald_start;
                            }
                            $prev_date_arr = explode('-', $months_current);
                            $months_date_current = $prev_date_arr[0] . '-' .$prev_date_arr[1] . '-' . db_day($k);

                        
                            // ENTRY
                            $debit = 0;
                            if(Entry::where('id_tcp', $tcp)->whereDate('date', $months_date_current)->exists()) {
                                $entry = Entry::where('id_tcp', $tcp)->whereDate('date', $months_date_current)->first();
                                $debit = $entry->cash_box;
                            }
                            if ($debit > 0) {
                                $sald += $debit;
                            }
                            
                            // EXPENSE
                            if(Expense::where('id_tcp', $tcp)->whereDate('date', $months_date_current)->exists()) {
                                $expense = Expense::where('id_tcp', $tcp)->whereDate('date', $months_date_current)->first();
                                if ($expense->mp_materials > 0) {
                                    $credit = $expense->mp_materials;
                                    $sald   = $sald - $credit;
                                }
                                if ($expense->goods > 0) {
                                    $credit = $expense->goods;
                                    $sald   = $sald - $credit;
                                }
                                if ($expense->fuel > 0) {
                                    $credit = $expense->fuel;
                                    $sald   = $sald - $credit;
                                }
                                if ($expense->power > 0) {
                                    $credit = $expense->power;
                                    $sald   = $sald - $credit;
                                }
                                if ($expense->salary > 0) {
                                    $credit = $expense->salary;
                                    $sald   = $sald - $credit;
                                }
                            }
                            
                            // TAX
                            if($k + 1 == date('t', strtotime($months_current))) {
                
                                // Get Tax Sales/Services
                                $cash_box = Entry::select(DB::raw('SUM(cash_box) as total_cash_box'))
                                                ->where('id_tcp', $tcp)
                                                ->whereMonth('date', $prev_date_arr[1])
                                                ->whereYear('date', $prev_date_arr[0])
                                                ->first()->total_cash_box;    
                                if ($cash_box == 0) { $sales_services = 0; }
                                else { $sales_services = ($cash_box * 10) / 100; }
                
                                if(Tax::where('id_tcp', $tcp)->where('month', $prev_date_arr[1])->where('year', $prev_date_arr[0])->exists()) {
                                    
                                    $tax = Tax::where('id_tcp', $tcp)->where('month', $prev_date_arr[1])->where('year', $prev_date_arr[0])->first();
                                    $subtotal  = $sales_services + $tax->workforce + $tax->documents + $tax->commercial_ads + $tax->social_security + $tax->others; 
                                    $total_pay = $subtotal + $tax->restoration_repair + $tax->monthly_fee;
                                    $paytax    = $total_pay;

                                    $credit = $paytax;
                                    $sald   = $sald - $credit;
                                }
                            } 
                        }
                        $months_current = date("Y-m-d",strtotime($months_current . '+ 1 month'));
                    }
                }
            }            
            
            // MONTH SELECT
            for ($i=0; $i < date('t', strtotime($year.'-'.$month.'-01')); $i++) { 
            
                $date = $year .'-'. $month .'-'. db_day($i);
                
                // Start Sald
                if ($i + 1 == 1 && $month == '01') {
                    $sublargest[$number] = array(
                        'id' => $number + 1,
                        'id_db' => '',
                        'day' => '01',
                        'month' => '01',
                        'code'=> 'CO',
                        'number' => $number + 1, 
                        'desc'=> 'Saldo Inicial de Efectivo en Caja declarado por el Titular', 
                        'debit'=> number_format($sald, 2, '.', ','),
                        'credit'=> '',
                        'sald'=> number_format($sald, 2, '.', ',')
                    );
                    $number++;
                }
                
                // ENTRY
                $debit = 0;
                if(Entry::where('id_tcp', $tcp)->whereDate('date', $date)->exists()) {
                    $entry = Entry::where('id_tcp', $tcp)->whereDate('date', $date)->first();
                    $debit = $entry->cash_box;
                }
                if ($debit > 0) {
                    $credit = '';
                    $sald = $sald + $debit;
                    $sublargest[$number] = array(
                        'id' => $number + 1,
                        'id_db' => $entry->id,
                        'day' => db_day($i),
                        'month' => $month,
                        'code'=> 'CO',
                        'number' => $number + 1, 
                        'desc'=> 'Ventas en Efectivo de ' . month_name(intval($month)), 
                        'debit'=> number_format($debit, 2, '.', ','),
                        'credit'=> $credit,
                        'sald'=> number_format($sald, 2, '.', ',')
                    );
                    $number++;
                }                
                
                // EXPENSE
                if(Expense::where('id_tcp', $tcp)->whereDate('date', $date)->exists()) {
                    $expense = Expense::where('id_tcp', $tcp)->whereDate('date', $date)->first();
                    if ($expense->mp_materials > 0) {
                        $debit  = '';
                        $credit = $expense->mp_materials;
                        $sald   = $sald - $credit;
                        $sublargest[$number] = array(
                            'id' => $number + 1,
                            'id_db' => $expense->id,
                            'day' => db_day($i), 
                            'month' => $month, 
                            'code'=> 'CO', 
                            'number' => $number + 1, 
                            'desc'=> 'Compra de Materias Primas y Materiales de ' . month_name(intval($month)), 
                            'debit'=> $debit,
                            'credit'=> number_format($credit, 2, '.', ','),
                            'sald'=> number_format($sald, 2, '.', ',')
                        );
                        $number++;
                    }
                    if ($expense->goods > 0) {
                        $debit  = '';
                        $credit = $expense->goods;
                        $sald   = $sald - $credit;
                        $sublargest[$number] = array(
                            'id' => $number + 1,
                            'id_db' => $expense->id,
                            'day' => db_day($i), 
                            'month' => $month, 
                            'code'=> 'CO', 
                            'number' => $number + 1, 
                            'desc'=> 'Compra de Mercancias para la Venta de ' . month_name(intval($month)), 
                            'debit'=> $debit,
                            'credit'=> number_format($credit, 2, '.', ','),
                            'sald'=> number_format($sald, 2, '.', ',')
                        );
                        $number++;
                    }
                    if ($expense->fuel > 0) {
                        $debit  = '';
                        $credit = $expense->fuel;
                        $sald   = $sald - $credit;
                        $sublargest[$number] = array(
                            'id' => $number + 1,
                            'id_db' => $expense->id,
                            'day' => db_day($i), 
                            'month' => $month, 
                            'code'=> 'CO', 
                            'number' => $number + 1, 
                            'desc'=> 'Compra de Combustible de ' . month_name(intval($month)), 
                            'debit'=> $debit,
                            'credit'=> number_format($credit, 2, '.', ','),
                            'sald'=> number_format($sald, 2, '.', ',')
                        );
                        $number++;
                    }
                    if ($expense->power > 0) {
                        $debit  = '';
                        $credit = $expense->power;
                        $sald   = $sald - $credit;
                        $sublargest[$number] = array(
                            'id' => $number + 1,
                            'id_db' => $expense->id,
                            'day' => db_day($i), 
                            'month' => $month, 
                            'code'=> 'CO', 
                            'number' => $number + 1, 
                            'desc'=> 'Pago de Electricidad de ' . month_name(intval($month)), 
                            'debit'=> $debit,
                            'credit'=> number_format($credit, 2, '.', ','),
                            'sald'=> number_format($sald, 2, '.', ',')
                        );
                        $number++;
                    }
                    if ($expense->salary > 0) {
                        $debit  = '';
                        $credit = $expense->salary;
                        $sald   = $sald - $credit;
                        $sublargest[$number] = array(
                            'id' => $number + 1,
                            'id_db' => $expense->id,
                            'day' => db_day($i), 
                            'month' => $month, 
                            'code'=> 'CO', 
                            'number' => $number + 1, 
                            'desc'=> 'Pago a Trabajadores de ' . month_name(intval($month)), 
                            'debit'=> $debit,
                            'credit'=> number_format($credit, 2, '.', ','),
                            'sald'=> number_format($sald, 2, '.', ',')
                        );
                        $number++;
                    }
                }
                
                // TAX
                if($i + 1 == date('t', strtotime($year.'-'.$month.'-01'))) {
    
                    // Get Tax Sales/Services
                    $cash_box = Entry::select(DB::raw('SUM(cash_box) as total_cash_box'))
                                    ->where('id_tcp', $tcp)
                                    ->whereMonth('date', $month)
                                    ->whereYear('date', $year)
                                    ->first()->total_cash_box;    
                    if ($cash_box == 0) { $sales_services = 0; }
                    else { $sales_services = ($cash_box * 10) / 100; }
    
                    if(Tax::where('id_tcp', $tcp)->where('month', $month)->where('year', $year)->exists()) {
                        
                        $tax = Tax::where('id_tcp', $tcp)->where('month', $month)->where('year', $year)->first();
                        $subtotal  = $sales_services + $tax->workforce + $tax->documents + $tax->commercial_ads + $tax->social_security + $tax->others; 
                        $total_pay = $subtotal + $tax->restoration_repair + $tax->monthly_fee;
                        $paytax    = $total_pay;

                        $debit  = '';
                        $credit = $paytax;
                        $sald   = $sald - $credit;
                        $sublargest[$number] = array(
                            'id' => $number + 1,
                            'id_db' => $tax->id,
                            'day' => db_day($i), 
                            'month' => $month, 
                            'code'=> 'CO',
                            'number' => $number + 1,
                            'desc'=> 'Pago de Impuestos de ' . month_name(intval($month)), 
                            'debit'=> $debit,
                            'credit'=> number_format($credit, 2, '.', ','),
                            'sald'=> number_format($sald, 2, '.', ',')
                        );
                        $number++;
                    }
                }                
            }
        }
        // BANK CASH
        elseif ($account == '110'){

            // MONTH SELECT
            for ($i=0; $i < date('t', strtotime($year.'-'.$month.'-01')); $i++) {
            
                $date = $year .'-'. $month .'-'. db_day($i);
                if(CashBank::where('id_tcp', $tcp)->whereDate('date', $date)->exists()) {
                    $bank_cash = CashBank::where('id_tcp', $tcp)->whereDate('date', $date)->get();
                    foreach ($bank_cash as $row) {
                        if ($row->sald > 0) {
                            $debit  = '';
                            $credit = '';
                            $sald   += $row->sald;
                            $sublargest[$number] = array(
                                'id' => $number + 1,
                                'id_db' => $row->id,
                                'day' => db_day($i), 
                                'month' => $month, 
                                'code'=> 'CO', 
                                'number' => $number + 1, 
                                'desc'=> $row->desc, 
                                'debit'=> $debit,
                                'credit'=> $credit,
                                'sald'=> number_format($sald, 2, '.', ',')
                            );
                            $number++;
                        }
                        elseif ($row->debit > 0) {
                            $debit  = $row->debit;
                            $credit = '';
                            $sald   += $debit;
                            $sublargest[$number] = array(
                                'id' => $number + 1,
                                'id_db' => $row->id,
                                'day' => db_day($i), 
                                'month' => $month, 
                                'code'=> 'CO', 
                                'number' => $number + 1, 
                                'desc'=> $row->desc, 
                                'debit'=> number_format($debit, 2, '.', ','),
                                'credit'=> $credit,
                                'sald'=> number_format($sald, 2, '.', ',')
                            );
                            $number++;
                        }
                        elseif ($row->credit > 0) {
                            $debit  = '';
                            $credit = $row->credit;
                            $sald   -= $credit;
                            $sublargest[$number] = array(
                                'id' => $number + 1,
                                'id_db' => $row->id,
                                'day' => db_day($i), 
                                'month' => $month, 
                                'code'=> 'CO', 
                                'number' => $number + 1, 
                                'desc'=> $row->desc, 
                                'debit'=> $debit,
                                'credit'=> number_format($credit, 2, '.', ','),
                                'sald'=> number_format($sald, 2, '.', ',')
                            );
                            $number++;
                        }
                        else {
                            $debit  = '';
                            $credit = '';
                            $sublargest[$number] = array(
                                'id' => $number + 1,
                                'id_db' => $row->id,
                                'day' => db_day($i), 
                                'month' => $month, 
                                'code'=> 'CO', 
                                'number' => $number + 1, 
                                'desc'=> $row->desc, 
                                'debit'=> $debit,
                                'credit'=> $credit,
                                'sald'=> number_format($sald, 2, '.', ',')
                            );
                            $number++;
                        }
                    }                    
                }
            }
        }
        // ATF
        elseif ($account == '200'){

            $total_aft = 0;

            $groups = AftGroup::all();

            foreach ($groups as $group) {
                
                $aft = AftProduct::select(DB::raw('SUM(import) as import'))
                                ->where('id_tcp', $tcp)
                                ->where('id_group', $group->id)
                                ->first();
                
                $sublargest[$number] = array(
                    'id' => $number + 1,
                    'id_db' => -1,
                    'day' => date('t', strtotime($year.'-'.$month.'-01')), 
                    'month' => $month, 
                    'code'=> 'CO', 
                    'number' => $number + 1, 
                    'desc'=> 'Total de AFT ' . $group->desc, 
                    'debit'=> number_format($aft->import, 2, '.', ','),
                    'credit'=> '',
                    'sald'=> number_format($aft->import, 2, '.', ',')
                );
                $number++;
                $total_aft += $aft->import;
            }

            $sublargest[$number] = array(
                'id' => $number + 1,
                'id_db' => -1,
                'day' => '<strong>'.date('t', strtotime($year.'-'.$month.'-01')).'</strong>', 
                'month' => '<strong>'.$month.'</strong>', 
                'code'=> '<strong>CO</strong>', 
                'number' => '<strong>'.($number + 1).'</strong>', 
                'desc'=> '<strong>Total de AFT al cierre del Periodo Contable</strong>', 
                'debit'=> '<strong>'.number_format($total_aft, 2, '.', ',').'</strong>',
                'credit'=> '',
                'sald'=> '<strong>'.number_format($total_aft, 2, '.', ',').'</strong>'
            );
        }
        
        if (empty($sublargest)) {
            $response = array(
                'success' => false, 
                'message' => 'El Submayor de esta Cuenta no contiene renglones porque esta empresa no registr&oacute; ninguna operaci&oacute;n en el mes seleccionado.', 
                'sublargest' => null
            );
            return response()->json($response, 200);
        }
        else {
            \Cache::forever('sublargest', $sublargest);        
            $response = array('success' => true, 'sublargest' => $sublargest);    
            return response()->json($response, 200);
        }  
    }

    /**
     * Update Cash Bank Account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateCashBankAccount(Request $request)
    {
        $date = $request->year .'-'. $request->month .'-'. $request->day;

        if (CashBank::where('id', $request->id)->exists()){
            if ($request->desc != 'Saldo al Inicio del Mes') {
                CashBank::where('id', $request->id)->update([
                    'date' => $date,
                    'desc' => $request->desc,
                    'debit' => floatval(str_replace(',','',$request->debit)),
                    'credit' => floatval(str_replace(',','',$request->credit))
                ]);
            }
            else {
                CashBank::where('id', $request->id)->update([
                    'date' => $date,
                    'desc' => $request->desc,
                    'debit' => floatval(str_replace(',','',$request->debit)),
                    'credit' => floatval(str_replace(',','',$request->credit)),
                    'sald' => floatval(str_replace(',','',$request->sald))
                ]);
            }
        }
        else {
            if ($request->desc != 'Saldo al Inicio del Mes') {
                CashBank::create([
                    'id_tcp' => $request->tcp,
                    'date' => $date,
                    'desc' => $request->desc,
                    'debit' => floatval(str_replace(',','',$request->debit)),
                    'credit' => floatval(str_replace(',','',$request->credit))
                ]);
            }
            else {
                CashBank::create([
                    'id_tcp' => $request->tcp,
                    'date' => $date,
                    'desc' => $request->desc,
                    'debit' => floatval(str_replace(',','',$request->debit)),
                    'credit' => floatval(str_replace(',','',$request->credit)),
                    'sald' => floatval(str_replace(',','',$request->sald))
                ]);
            }
        }

        $response = array('success' => true);    
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CashBank  $bank_cash
     * @return \Illuminate\Http\Response
     */
    public function deleteOperationBankCash(Request $request)
    {
        CashBank::where('id', $request->id)->delete();

        $response = array('success' => true);        
        return response()->json($response,200);
    }

    /**
     * Export to PDF book of Entries Book.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfSublargest(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $account_code = $request->account;
        $account_desc = Account::where('code', $account_code)->first()->desc;
        $tcp = Tcp::where('id', $request->id_tcp)->first();
        
        $province = Province::where('id', $tcp->province)->first()->province;
        $province_company = Province::where('id', $tcp->province_company)->first()->province;
        $city = City::where('id', $tcp->city)->first()->city;
        $city_company = City::where('id', $tcp->city_company)->first()->city;
        $tcp['province'] = $province;
        $tcp['province_company'] = $province_company;
        $tcp['city'] = $city;
        $tcp['city_company'] = $city_company;

        $obligations = TcpObligation::leftJoin('obligations', 'obligations.id', '=', 'tcp_obligations.id_obligation')
                        ->select('obligations.obligation', 'obligations.code')
                        ->where('tcp_obligations.id_tcp', $tcp->id)->get();
        
        
        $sublargest = \Cache::get('sublargest');

        $pdf = PDF::loadView('pdf.sublargest', compact('tcp', 'obligations', 'month', 'year', 'sublargest', 'account_code', 'account_desc'))->setPaper('letter', 'landscape');
        return $pdf->download('Submayor '. $account_desc.' '. $tcp['name']. ' ' . $tcp['last_name'] .' '.  $month .'-'. $year . '.pdf');
    }

    /**
     * Export to PDF book of Entries Book.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfRangeSublargest(Request $request)
    {
        return $request;
        $sublargest = array();
        $sald       = 0;
        $sald_prev  = 0;
        $number     = 0;

        $date_send = intval($year.$month.'01');        
        $firstday  = $year .'-'. $month .'-01';

        // BOX CASH
        if ($account == '100'){
            
            // START SALD
            if (TcpCashboxStart::where('id_tcp', $tcp)->exists()){
            
                $saldstart = TcpCashboxStart::where('id_tcp', $tcp)->first();
                $date_start_arr = explode('-', $saldstart->date_start);
                $date_start = $date_start_arr[0] . '-' . $date_start_arr[1] . '-01';
                $date_start_num = intval($date_start_arr[0].$date_start_arr[1].'01');
                $day_start = intval($date_start_arr[2]);
                $sald_start = $saldstart->sald;
                
                /*if ($date_send < $date_start_num) {
                    $response = array(
                        'success' => false, 
                        'message' => 'El Submayor de esta Cuenta solo se puede generar a patir del mes en que fue definido el Saldo Inicial de Efectivo en Caja al inicio de la actividad.',
                        'regcash' => null
                    );    
                    return response()->json($response, 200);
                }*/

                $d_start = new DateTime($date_start);
                $d_end   = new DateTime($firstday);

                $dif = $d_start->diff($d_end);
                $months = ( $dif->y * 12 ) + $dif->m;
                
                if ($months == 0){ $sald += $saldstart->sald; $sald_monthstart = $sald; }
                else 
                {
                    $months_current = date("Y-m-d",strtotime($firstday . '- '.$months.' month'));  
                    
                    for ($j=0; $j < $months; $j++)
                    {
                        for ($k=0; $k < date('t', strtotime($months_current)); $k++) {
                            
                            if($j + 1 == 1 && $k + 1 == 1) {
                                $sald += $sald_start;
                            }
                            $prev_date_arr = explode('-', $months_current);
                            $months_date_current = $prev_date_arr[0] . '-' .$prev_date_arr[1] . '-' . db_day($k);

                        
                            // ENTRY
                            $debit = 0;
                            if(Entry::where('id_tcp', $tcp)->whereDate('date', $months_date_current)->exists()) {
                                $entry = Entry::where('id_tcp', $tcp)->whereDate('date', $months_date_current)->first();
                                $debit = $entry->cash_box;
                            }
                            if ($debit > 0) {
                                $sald += $debit;
                            }
                            
                            // EXPENSE
                            if(Expense::where('id_tcp', $tcp)->whereDate('date', $months_date_current)->exists()) {
                                $expense = Expense::where('id_tcp', $tcp)->whereDate('date', $months_date_current)->first();
                                if ($expense->mp_materials > 0) {
                                    $credit = $expense->mp_materials;
                                    $sald   = $sald - $credit;
                                }
                                if ($expense->goods > 0) {
                                    $credit = $expense->goods;
                                    $sald   = $sald - $credit;
                                }
                                if ($expense->fuel > 0) {
                                    $credit = $expense->fuel;
                                    $sald   = $sald - $credit;
                                }
                                if ($expense->power > 0) {
                                    $credit = $expense->power;
                                    $sald   = $sald - $credit;
                                }
                                if ($expense->salary > 0) {
                                    $credit = $expense->salary;
                                    $sald   = $sald - $credit;
                                }
                            }
                            
                            // TAX
                            if($k + 1 == date('t', strtotime($months_current))) {
                
                                // Get Tax Sales/Services
                                $cash_box = Entry::select(DB::raw('SUM(cash_box) as total_cash_box'))
                                                ->where('id_tcp', $tcp)
                                                ->whereMonth('date', $prev_date_arr[1])
                                                ->whereYear('date', $prev_date_arr[0])
                                                ->first()->total_cash_box;    
                                if ($cash_box == 0) { $sales_services = 0; }
                                else { $sales_services = ($cash_box * 10) / 100; }
                
                                if(Tax::where('id_tcp', $tcp)->where('month', $prev_date_arr[1])->where('year', $prev_date_arr[0])->exists()) {
                                    
                                    $tax = Tax::where('id_tcp', $tcp)->where('month', $prev_date_arr[1])->where('year', $prev_date_arr[0])->first();
                                    $subtotal  = $sales_services + $tax->workforce + $tax->documents + $tax->commercial_ads + $tax->social_security + $tax->others; 
                                    $total_pay = $subtotal + $tax->restoration_repair + $tax->monthly_fee;
                                    $paytax    = $total_pay;

                                    $credit = $paytax;
                                    $sald   = $sald - $credit;
                                }
                            } 
                        }
                        $months_current = date("Y-m-d",strtotime($months_current . '+ 1 month'));
                    }
                }
            }            
            
            // MONTH SELECT
            for ($i=0; $i < date('t', strtotime($year.'-'.$month.'-01')); $i++) { 
            
                $date = $year .'-'. $month .'-'. db_day($i);
                
                // Start Sald
                if ($i + 1 == 1 && $month == '01') {
                    $sublargest[$number] = array(
                        'id' => $number + 1,
                        'id_db' => '',
                        'day' => '01',
                        'month' => '01',
                        'code'=> 'CO',
                        'number' => $number + 1, 
                        'desc'=> 'Saldo Inicial de Efectivo en Caja declarado por el Titular', 
                        'debit'=> number_format($sald, 2, '.', ','),
                        'credit'=> '',
                        'sald'=> number_format($sald, 2, '.', ',')
                    );
                    $number++;
                }
                
                // ENTRY
                $debit = 0;
                if(Entry::where('id_tcp', $tcp)->whereDate('date', $date)->exists()) {
                    $entry = Entry::where('id_tcp', $tcp)->whereDate('date', $date)->first();
                    $debit = $entry->cash_box;
                }
                if ($debit > 0) {
                    $credit = '';
                    $sald = $sald + $debit;
                    $sublargest[$number] = array(
                        'id' => $number + 1,
                        'id_db' => $entry->id,
                        'day' => db_day($i),
                        'month' => $month,
                        'code'=> 'CO',
                        'number' => $number + 1, 
                        'desc'=> 'Ventas en Efectivo de ' . month_name(intval($month)), 
                        'debit'=> number_format($debit, 2, '.', ','),
                        'credit'=> $credit,
                        'sald'=> number_format($sald, 2, '.', ',')
                    );
                    $number++;
                }                
                
                // EXPENSE
                if(Expense::where('id_tcp', $tcp)->whereDate('date', $date)->exists()) {
                    $expense = Expense::where('id_tcp', $tcp)->whereDate('date', $date)->first();
                    if ($expense->mp_materials > 0) {
                        $debit  = '';
                        $credit = $expense->mp_materials;
                        $sald   = $sald - $credit;
                        $sublargest[$number] = array(
                            'id' => $number + 1,
                            'id_db' => $expense->id,
                            'day' => db_day($i), 
                            'month' => $month, 
                            'code'=> 'CO', 
                            'number' => $number + 1, 
                            'desc'=> 'Compra de Materias Primas y Materiales de ' . month_name(intval($month)), 
                            'debit'=> $debit,
                            'credit'=> number_format($credit, 2, '.', ','),
                            'sald'=> number_format($sald, 2, '.', ',')
                        );
                        $number++;
                    }
                    if ($expense->goods > 0) {
                        $debit  = '';
                        $credit = $expense->goods;
                        $sald   = $sald - $credit;
                        $sublargest[$number] = array(
                            'id' => $number + 1,
                            'id_db' => $expense->id,
                            'day' => db_day($i), 
                            'month' => $month, 
                            'code'=> 'CO', 
                            'number' => $number + 1, 
                            'desc'=> 'Compra de Mercancias para la Venta de ' . month_name(intval($month)), 
                            'debit'=> $debit,
                            'credit'=> number_format($credit, 2, '.', ','),
                            'sald'=> number_format($sald, 2, '.', ',')
                        );
                        $number++;
                    }
                    if ($expense->fuel > 0) {
                        $debit  = '';
                        $credit = $expense->fuel;
                        $sald   = $sald - $credit;
                        $sublargest[$number] = array(
                            'id' => $number + 1,
                            'id_db' => $expense->id,
                            'day' => db_day($i), 
                            'month' => $month, 
                            'code'=> 'CO', 
                            'number' => $number + 1, 
                            'desc'=> 'Compra de Combustible de ' . month_name(intval($month)), 
                            'debit'=> $debit,
                            'credit'=> number_format($credit, 2, '.', ','),
                            'sald'=> number_format($sald, 2, '.', ',')
                        );
                        $number++;
                    }
                    if ($expense->power > 0) {
                        $debit  = '';
                        $credit = $expense->power;
                        $sald   = $sald - $credit;
                        $sublargest[$number] = array(
                            'id' => $number + 1,
                            'id_db' => $expense->id,
                            'day' => db_day($i), 
                            'month' => $month, 
                            'code'=> 'CO', 
                            'number' => $number + 1, 
                            'desc'=> 'Pago de Electricidad de ' . month_name(intval($month)), 
                            'debit'=> $debit,
                            'credit'=> number_format($credit, 2, '.', ','),
                            'sald'=> number_format($sald, 2, '.', ',')
                        );
                        $number++;
                    }
                    if ($expense->salary > 0) {
                        $debit  = '';
                        $credit = $expense->salary;
                        $sald   = $sald - $credit;
                        $sublargest[$number] = array(
                            'id' => $number + 1,
                            'id_db' => $expense->id,
                            'day' => db_day($i), 
                            'month' => $month, 
                            'code'=> 'CO', 
                            'number' => $number + 1, 
                            'desc'=> 'Pago a Trabajadores de ' . month_name(intval($month)), 
                            'debit'=> $debit,
                            'credit'=> number_format($credit, 2, '.', ','),
                            'sald'=> number_format($sald, 2, '.', ',')
                        );
                        $number++;
                    }
                }
                
                // TAX
                if($i + 1 == date('t', strtotime($year.'-'.$month.'-01'))) {
    
                    // Get Tax Sales/Services
                    $cash_box = Entry::select(DB::raw('SUM(cash_box) as total_cash_box'))
                                    ->where('id_tcp', $tcp)
                                    ->whereMonth('date', $month)
                                    ->whereYear('date', $year)
                                    ->first()->total_cash_box;    
                    if ($cash_box == 0) { $sales_services = 0; }
                    else { $sales_services = ($cash_box * 10) / 100; }
    
                    if(Tax::where('id_tcp', $tcp)->where('month', $month)->where('year', $year)->exists()) {
                        
                        $tax = Tax::where('id_tcp', $tcp)->where('month', $month)->where('year', $year)->first();
                        $subtotal  = $sales_services + $tax->workforce + $tax->documents + $tax->commercial_ads + $tax->social_security + $tax->others; 
                        $total_pay = $subtotal + $tax->restoration_repair + $tax->monthly_fee;
                        $paytax    = $total_pay;

                        $debit  = '';
                        $credit = $paytax;
                        $sald   = $sald - $credit;
                        $sublargest[$number] = array(
                            'id' => $number + 1,
                            'id_db' => $tax->id,
                            'day' => db_day($i), 
                            'month' => $month, 
                            'code'=> 'CO',
                            'number' => $number + 1,
                            'desc'=> 'Pago de Impuestos de ' . month_name(intval($month)), 
                            'debit'=> $debit,
                            'credit'=> number_format($credit, 2, '.', ','),
                            'sald'=> number_format($sald, 2, '.', ',')
                        );
                        $number++;
                    }
                }                
            }
        }
        // BANK CASH
        /*elseif ($account == '110'){

            // MONTH SELECT
            for ($i=0; $i < date('t', strtotime($year.'-'.$month.'-01')); $i++) {
            
                $date = $year .'-'. $month .'-'. db_day($i);
                if(CashBank::where('id_tcp', $tcp)->whereDate('date', $date)->exists()) {
                    $bank_cash = CashBank::where('id_tcp', $tcp)->whereDate('date', $date)->get();
                    foreach ($bank_cash as $row) {
                        if ($row->sald > 0) {
                            $debit  = '';
                            $credit = '';
                            $sald   += $row->sald;
                            $sublargest[$number] = array(
                                'id' => $number + 1,
                                'id_db' => $row->id,
                                'day' => db_day($i), 
                                'month' => $month, 
                                'code'=> 'CO', 
                                'number' => $number + 1, 
                                'desc'=> $row->desc, 
                                'debit'=> $debit,
                                'credit'=> $credit,
                                'sald'=> number_format($sald, 2, '.', ',')
                            );
                            $number++;
                        }
                        elseif ($row->debit > 0) {
                            $debit  = $row->debit;
                            $credit = '';
                            $sald   += $debit;
                            $sublargest[$number] = array(
                                'id' => $number + 1,
                                'id_db' => $row->id,
                                'day' => db_day($i), 
                                'month' => $month, 
                                'code'=> 'CO', 
                                'number' => $number + 1, 
                                'desc'=> $row->desc, 
                                'debit'=> number_format($debit, 2, '.', ','),
                                'credit'=> $credit,
                                'sald'=> number_format($sald, 2, '.', ',')
                            );
                            $number++;
                        }
                        elseif ($row->credit > 0) {
                            $debit  = '';
                            $credit = $row->credit;
                            $sald   -= $credit;
                            $sublargest[$number] = array(
                                'id' => $number + 1,
                                'id_db' => $row->id,
                                'day' => db_day($i), 
                                'month' => $month, 
                                'code'=> 'CO', 
                                'number' => $number + 1, 
                                'desc'=> $row->desc, 
                                'debit'=> $debit,
                                'credit'=> number_format($credit, 2, '.', ','),
                                'sald'=> number_format($sald, 2, '.', ',')
                            );
                            $number++;
                        }
                        else {
                            $debit  = '';
                            $credit = '';
                            $sublargest[$number] = array(
                                'id' => $number + 1,
                                'id_db' => $row->id,
                                'day' => db_day($i), 
                                'month' => $month, 
                                'code'=> 'CO', 
                                'number' => $number + 1, 
                                'desc'=> $row->desc, 
                                'debit'=> $debit,
                                'credit'=> $credit,
                                'sald'=> number_format($sald, 2, '.', ',')
                            );
                            $number++;
                        }
                    }                    
                }
            }
        }
        // ATF
        elseif ($account == '200'){

            $total_aft = 0;

            $groups = AftGroup::all();

            foreach ($groups as $group) {
                
                $aft = AftProduct::select(DB::raw('SUM(import) as import'))
                                ->where('id_tcp', $tcp)
                                ->where('id_group', $group->id)
                                ->first();
                
                $sublargest[$number] = array(
                    'id' => $number + 1,
                    'id_db' => -1,
                    'day' => date('t', strtotime($year.'-'.$month.'-01')), 
                    'month' => $month, 
                    'code'=> 'CO', 
                    'number' => $number + 1, 
                    'desc'=> 'Total de AFT ' . $group->desc, 
                    'debit'=> number_format($aft->import, 2, '.', ','),
                    'credit'=> '',
                    'sald'=> number_format($aft->import, 2, '.', ',')
                );
                $number++;
                $total_aft += $aft->import;
            }

            $sublargest[$number] = array(
                'id' => $number + 1,
                'id_db' => -1,
                'day' => '<strong>'.date('t', strtotime($year.'-'.$month.'-01')).'</strong>', 
                'month' => '<strong>'.$month.'</strong>', 
                'code'=> '<strong>CO</strong>', 
                'number' => '<strong>'.($number + 1).'</strong>', 
                'desc'=> '<strong>Total de AFT al cierre del Periodo Contable</strong>', 
                'debit'=> '<strong>'.number_format($total_aft, 2, '.', ',').'</strong>',
                'credit'=> '',
                'sald'=> '<strong>'.number_format($total_aft, 2, '.', ',').'</strong>'
            );
        }*/

        $pdf = PDF::loadView('pdf.sublargest', compact('tcp', 'obligations', 'month', 'year', 'sublargest', 'account_code', 'account_desc'))->setPaper('letter', 'landscape');
        return $pdf->download('Submayor '. $account_desc.' '. $tcp['name']. ' ' . $tcp['last_name'] .' '.  $month .'-'. $year . '.pdf');
    }
}
