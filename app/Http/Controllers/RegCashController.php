<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Models\Tcp;
use App\Models\Province;
use App\Models\City;
use App\Models\TcpObligation;
use App\Models\Entry;
use App\Models\Expense;
use App\Models\Tax;
use App\Models\Account;
use App\Models\ModelOption;
use App\Models\TcpCashboxStart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use Illuminate\Http\Request;

class RegCashController extends Controller
{

    /**
     * Display a listing of days.
     *
     * @return \Illuminate\Http\Response
     */
    public function regCash($tcp, $month, $year)
    {
        $regcash   = array();
        $sald      = 0;
        $sald_prev = 0;
        
        $days_db  = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');

        //if ($month < 10) { $month = '0' . $month; }
        $date_send = intval($year.$month.'01');
        
        $firstday = $year .'-'. $month .'-01';
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
                    'message' => 'El Registo de Efectivo solo se puede generar a patir del mes en que fue definido el Saldo Inicial de Efectivo en Caja al inicio de la actividad.', 
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
                            $sald_prev += $sald_start;
                        }
                        $prev_date_arr = explode('-', $months_current);
                        $months_date_current = $prev_date_arr[0] . '-' .$prev_date_arr[1] . '-' . $days_db[$k];

                        // REGISTER TAX PREV
                        $regtax_prev = 0;
                        if($k + 1 == date('t', strtotime($months_current))) {
                            
                            // Get Tax Sales/Services
                            $cash_box_prev = Entry::select(DB::raw('SUM(cash_box) as total_cash_box'))
                                            ->where('id_tcp', $tcp)
                                            ->whereMonth('date', $prev_date_arr[1])
                                            ->whereYear('date', $prev_date_arr[0])
                                            ->first()->total_cash_box;

                            if ($cash_box_prev == 0) { $sales_services_prev = 0; }
                            else { $sales_services_prev = ($cash_box_prev * 10) / 100; }

                            if(Tax::where('id_tcp', $tcp)->where('month', $prev_date_arr[1])->where('year', $prev_date_arr[0])->exists()) {
                                
                                $tax_prev = Tax::where('id_tcp', $tcp)->where('month', $prev_date_arr[1])->where('year', $prev_date_arr[0])->first();

                                $subtotal_prev = $sales_services_prev + $tax_prev->workforce + $tax_prev->documents + $tax_prev->commercial_ads + $tax_prev->social_security + $tax_prev->others;
                                
                                $total_pay_prev = $subtotal_prev + $tax_prev->restoration_repair + $tax_prev->monthly_fee;
                                
                                $regtax_prev = $total_pay_prev;
                            }
                            
                        }
                        
                        // BANK DEPOSIT PREV
                        $bank_prev = 0;
                        if (ModelOption::where('id_tcp', $tcp)->where('date', $months_date_current)->where('model', 'regcash')->where('key', 'bank_deposit')->exists()){
                            $bank_prev = ModelOption::where('id_tcp', $tcp)
                                                ->where('date', $months_date_current)
                                                ->where('model', 'regcash')
                                                ->where('key', 'bank_deposit')
                                                ->first()->value;
                        }

                        // ENTRY
                        $debit_prev = 0;
                        if(Entry::where('id_tcp', $tcp)->whereDate('date', $months_date_current)->exists()) {
                            $entry_prev = Entry::where('id_tcp', $tcp)->whereDate('date', $months_date_current)->first();
                            $debit_prev = $entry_prev->cash_box;
                        }

                        // EXPENSE
                        $credit_prev       = 0;
                        $mp_materials_prev = 0;
                        $goods_prev        = 0;
                        $fuel_prev         = 0;
                        $power_prev        = 0;
                        $salary_prev       = 0;
                        if(Expense::where('id_tcp', $tcp)->whereDate('date', $months_date_current)->exists()) {
                            $expense_prev = Expense::where('id_tcp', $tcp)->whereDate('date', $months_date_current)->first();
                            $mp_materials_prev = $expense_prev->mp_materials;
                            $goods_prev        = $expense_prev->goods;
                            $fuel_prev         = $expense_prev->fuel;
                            $power_prev        = $expense_prev->power;
                            $salary_prev       = $expense_prev->salary;
                        }
                        $credit_prev = $mp_materials_prev + $goods_prev + $fuel_prev + $power_prev + $salary_prev + $regtax_prev + $bank_prev;

                        // SALD
                        $sald_prev = $sald_prev + $debit_prev - $credit_prev;                        
                    }
                    $months_current = date("Y-m-d",strtotime($months_current . '+ 1 month'));
                }
                
                $sald += $sald_prev;
                $sald_monthstart = $sald;
            }
        }
        
        $regcash[0] = array(
            'id' => null,
            'day' => '', 
            'sales' => '',
            'mpm'=> '',
            'mpv' => '',
            'fuel'=> '',
            'elect'=> '',
            'workers'=> '',
            'tax'=> '',
            'bank_deposit'=> '',
            'debit'=> '',
            'credit'=> '',
            'sald'=> number_format($sald_monthstart, 2, '.', ',')
        );        
        
        for ($i=0; $i < date('t', strtotime($year.'-'.$month.'-01')); $i++) { 
            
            $date = $year .'-'. $month .'-'. $days_db[$i];
            
            // REGISTER TAX
            $regtax = 0;
            if($i + 1 == date('t', strtotime($year.'-'.$month.'-01'))) {

                // Get Tax Sales/Services
                //if ($month < 10) { $month_tax = '0' . $month; }
                $month_tax = $month;
                $cash_box = Entry::select(DB::raw('SUM(cash_box) as total_cash_box'))
                                ->where('id_tcp', $tcp)
                                ->whereMonth('date', $month_tax)
                                ->whereYear('date', $year)
                                ->first()->total_cash_box;

                if ($cash_box == 0) { $sales_services = 0; }
                else { $sales_services = ($cash_box * 10) / 100; }

                if(Tax::where('id_tcp', $tcp)->where('month', $month)->where('year', $year)->exists()) {
                    
                    $tax       = Tax::where('id_tcp', $tcp)->where('month', $month)->where('year', $year)->first();
                    $subtotal  = $sales_services + $tax->workforce + $tax->documents + $tax->commercial_ads + $tax->social_security + $tax->others; 
                    $total_pay = $subtotal + $tax->restoration_repair + $tax->monthly_fee;
                    $regtax    = $total_pay;
                }
            }

            // BANK DEPOSIT
            $bank = 0;
            if (ModelOption::where('id_tcp', $tcp)->where('date', $date)->where('model', 'regcash')->where('key', 'bank_deposit')->exists()){
                $bank = ModelOption::where('id_tcp', $tcp)
                                ->where('date', $date)
                                ->where('model', 'regcash')
                                ->where('key', 'bank_deposit')
                                ->first()->value;
            }     
                       
            // ENTRY
            $debit = 0;
            if(Entry::where('id_tcp', $tcp)->whereDate('date', $date)->exists()) {
                $entry = Entry::where('id_tcp', $tcp)->whereDate('date', $date)->first();
                $debit = $entry->cash_box;
            }

            // EXPENSE
            $credit       = 0;
            $mp_materials = 0;
            $goods        = 0;
            $fuel         = 0;
            $power        = 0;
            $salary       = 0;
            if(Expense::where('id_tcp', $tcp)->whereDate('date', $date)->exists()) {
                $expense = Expense::where('id_tcp', $tcp)->whereDate('date', $date)->first();
                $mp_materials = $expense->mp_materials;
                $goods        = $expense->goods;
                $fuel         = $expense->fuel;
                $power        = $expense->power;
                $salary       = $expense->salary;
            }
            $credit = $mp_materials + $goods + $fuel + $power + $salary + $regtax + $bank;

            // SALD
            $sald = $sald + $debit - $credit;
            
            $regcash[$i + 1] = array(
                'id' => $i + 1,
                'day' => $i + 1, 
                'sales' => number_format($debit, 2, '.', ','), 
                'mpm'=> number_format($mp_materials, 2, '.', ','), 
                'mpv' => number_format($goods, 2, '.', ','), 
                'fuel'=> number_format($fuel, 2, '.', ','), 
                'elect'=> number_format($power, 2, '.', ','),
                'workers'=> number_format($salary, 2, '.', ','),
                'tax'=> number_format($regtax, 2, '.', ','),
                'bank_deposit'=> number_format($bank, 2, '.', ','),
                'debit'=> number_format($debit, 2, '.', ','),
                'credit'=> number_format($credit, 2, '.', ','),
                'sald'=> number_format($sald, 2, '.', ',')
            );
            
        }

        \Cache::forever('regcash', $regcash);
        
        $response = array('success' => true, 'regcash' => $regcash);    
        return response()->json($response, 200);
    }

    /**
     * Update Register Cash Cell.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateModelOption(Request $request)
    {
        if (ModelOption::where('id_tcp', $request->tcp)->where('date', $request->date)->where('model', $request->model)->where('key', $request->key)->exists()){
            ModelOption::where('id_tcp', $request->tcp)->where('date', $request->date)->where('model', $request->model)->where('key', $request->key)->update([
                'value' => str_replace(',', '', $request->value)
            ]);
        }
        else {
            ModelOption::create([
                'id_tcp' => $request->tcp,
                'date' => $request->date,
                'model' => $request->model,
                'key' => $request->key,
                'value' => str_replace(',', '', $request->value)
            ]);
        }

        $response = array('success' => true);    
        return response()->json($response,200);
    }

    /**
     * Store/Update Sald Start.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSald(Request $request)
    {
        $datearr = explode('/', $request->date_start);
        $date_db = $datearr[2] . '-' . $datearr[1] . '-' . $datearr[0];

        if (TcpCashboxStart::where('id_tcp', $request->tcp)->exists()){
            TcpCashboxStart::where('id_tcp', $request->tcp)->update([
                'date_start' => $date_db,
                'sald' => str_replace(',', '', $request->sald),
            ]);
        }
        else {
            TcpCashboxStart::create([
                'id_tcp' => $request->tcp,
                'date_start' => $date_db,
                'sald' => str_replace(',', '', $request->sald)
            ]);
        }

        $response = array(
            'success' => true, 
            'date_start' => $request->date_start,
            'sald' => $request->sald
        );  
        return response()->json($response,200);
    }

    /**
     * Export to PDF book of Entries Book.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfRegcash(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $account_code = 100;
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
        
        
        $regcash = \Cache::get('regcash');

        /*return $regcash;*/
        $pdf = PDF::loadView('pdf.regcash', compact('tcp', 'obligations', 'month', 'year', 'account_code', 'account_desc', 'regcash'))->setPaper('letter', 'landscape');
        return $pdf->download('Registro '. $account_desc.' '. $tcp['name']. ' ' . $tcp['last_name'] .' '.  $month .'-'. $year .'.pdf');
    }
}
