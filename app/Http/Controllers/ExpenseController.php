<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Tcp;
use App\Models\Province;
use App\Models\City;
use App\Models\Entry;
use App\Models\Tax;
use App\Models\TcpObligation;
use App\Models\ExpenseColumn;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of days.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDay($tcp, $month, $year)
    {
        $expenseday = array();
        $days_db  = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');

        for ($i=0; $i < date('t', strtotime($year.'-'.$month.'-01')); $i++) { 
            
            $date = $year .'-'. $month .'-'. $days_db[$i];
            if(Expense::where('id_tcp', $tcp)->whereDate('date', $date)->exists()) {
                
                $expense = Expense::where('id_tcp', $tcp)->whereDate('date', $date)->first();
                $expense_pd = $expense->mp_materials + $expense->goods + $expense->fuel + $expense->power + $expense->salary + $expense->col7 + $expense->col8 + $expense->col9 + $expense->col10 + $expense->col11 + $expense->col12 + $expense->others;
                $expense_dbi = $expense->col17 + $expense->col18 + $expense->col19;
                $expense_ope = $expense_pd + $expense_dbi + $expense->expenses_ncei;
                $total_paid  = $expense->cash_box + $expense->cash_bank;

                $expenseday[$i] = array(
                    'id' => $expense->id,
                    'day' => $i + 1, 
                    'id_tcp' => $tcp, 
                    'date' => $expense->date, 
                    'mp_materials' => number_format($expense->mp_materials, 2, '.', ','), 
                    'goods'=> number_format($expense->goods, 2, '.', ','), 
                    'fuel' => number_format($expense->fuel, 2, '.', ','), 
                    'power'=> number_format($expense->power, 2, '.', ','), 
                    'salary'=> number_format($expense->salary, 2, '.', ','),
                    'col7'=> number_format($expense->col7, 2, '.', ','),
                    'col8'=> number_format($expense->col8, 2, '.', ','),
                    'col9'=> number_format($expense->col9, 2, '.', ','),
                    'col10'=> number_format($expense->col10, 2, '.', ','),
                    'col11'=> number_format($expense->col11, 2, '.', ','),
                    'col12'=> number_format($expense->col12, 2, '.', ','),
                    'others'=> number_format($expense->others, 2, '.', ','),
                    'expense_pd'=> number_format($expense_pd, 2, '.', ','),
                    'lease_state'=> number_format($expense->lease_state, 2, '.', ','),
                    'col17'=> number_format($expense->col17, 2, '.', ','),
                    'col18'=> number_format($expense->col18, 2, '.', ','),
                    'col19'=> number_format($expense->col19, 2, '.', ','),
                    'expense_dbi'=> number_format($expense_dbi, 2, '.', ','),
                    'expenses_ncei'=> number_format($expense->expenses_ncei, 2, '.', ','),
                    'expense_ope'=> number_format($expense_ope, 2, '.', ','),
                    'cash_box'=> number_format($expense->cash_box, 2, '.', ','),
                    'cash_bank'=> number_format($expense->cash_bank, 2, '.', ','),
                    'total_paid'=> number_format($total_paid, 2, '.', ','),
                    'detail'=> $expense->detail
                );
            }
            else{
                $expenseday[$i] = array(
                    'id' => '',
                    'day' => $i + 1,
                    'id_tcp' => $tcp, 
                    'date' => '', 
                    'mp_materials' => '', 
                    'goods'=> '', 
                    'fuel' => '', 
                    'power'=> '', 
                    'salary'=> '',
                    'col7'=> '',
                    'col8'=> '',
                    'col9'=> '',
                    'col10'=> '',
                    'col11'=> '',
                    'col12'=> '',
                    'others'=> '',
                    'expense_pd'=> '',
                    'lease_state'=> '',
                    'col17'=> '',
                    'col18'=> '',
                    'col19'=> '',
                    'expense_dbi'=> '',
                    'expenses_ncei'=> '',
                    'expense_ope'=> '',
                    'cash_box'=> '',
                    'cash_bank'=> '',
                    'total_paid'=> '',
                    'detail'=> ''
                );
            }          
        }
        
        $response = array('success' => true, 'expenseday' => $expenseday);    
        return response()->json($response, 200);
    }

    /**
     * Display a listing of Months.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMonth($tcp, $year)
    {
        $expensemonth = array();
        $months     = array('', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
        $year_total_mp_materials  = 0; 
        $year_total_goods         = 0; 
        $year_total_fuel          = 0; 
        $year_total_power         = 0; 
        $year_total_salary        = 0;
        $year_total_col7          = 0;
        $year_total_col8          = 0;
        $year_total_col9          = 0;
        $year_total_col10         = 0;
        $year_total_col11         = 0;
        $year_total_col12         = 0;
        $year_total_others        = 0;
        $year_total_expense_pd    = 0;
        $year_total_lease_state   = 0;
        $year_total_col17         = 0;
        $year_total_col18         = 0;
        $year_total_col19         = 0;
        $year_total_expense_dbi   = 0;
        $year_total_expenses_ncei = 0;
        $year_total_expense_ope   = 0;
        $year_total_cash_box      = 0;
        $year_total_cash_bank     = 0;
        $year_total_total_paid    = 0;

        for ($i=1; $i < 13; $i++) { 
            
            if ($i < 10) { $month = '0' . $i; }
            else { $month = $i; }

            $expense = Expense::select(DB::raw('SUM(mp_materials) as mp_materials'), DB::raw('SUM(goods) as goods'), DB::raw('SUM(fuel) as fuel'), DB::raw('SUM(power) as power'), DB::raw('SUM(salary) as salary'), DB::raw('SUM(col7) as col7'), DB::raw('SUM(col8) as col8'), DB::raw('SUM(col9) as col9'), DB::raw('SUM(col10) as col10'), DB::raw('SUM(col11) as col11'), DB::raw('SUM(col12) as col12'), DB::raw('SUM(others) as others'), DB::raw('SUM(lease_state) as lease_state'), DB::raw('SUM(col17) as col17'), DB::raw('SUM(col18) as col18'), DB::raw('SUM(col19) as col19'), DB::raw('SUM(expenses_ncei) as expenses_ncei'), DB::raw('SUM(cash_box) as cash_box'), DB::raw('SUM(cash_bank) as cash_bank'))
                        ->where('id_tcp', $tcp)
                        ->whereMonth('date', $month)
                        ->whereYear('date', $year)
                        ->first();
            
            $expense_pd = $expense->mp_materials + $expense->goods + $expense->fuel + $expense->power + $expense->salary + $expense->col7 + $expense->col8 + $expense->col9 + $expense->col10 + $expense->col11 + $expense->col12 + $expense->others;
            $expense_dbi = $expense->col17 + $expense->col18 + $expense->col19;
            $expense_ope = $expense_pd + $expense_dbi + $expense->expenses_ncei;
            $total_paid  = $expense->cash_box + $expense->cash_bank;

            $total_mp_materials  = floatval($expense->mp_materials); 
            $total_goods         = floatval($expense->goods);
            //return $total_goods; 
            $total_fuel          = floatval($expense->fuel); 
            $total_power         = floatval($expense->power); 
            $total_salary        = floatval($expense->salary);
            $total_col7          = floatval($expense->col7);
            $total_col8          = floatval($expense->col8);
            $total_col9          = floatval($expense->col9);
            $total_col10         = floatval($expense->col10);
            $total_col11         = floatval($expense->col11);
            $total_col12         = floatval($expense->col12);
            $total_others        = floatval($expense->others);
            $total_expense_pd    = floatval($expense_pd);
            $total_lease_state   = floatval($expense->lease_state);
            $total_col17         = floatval($expense->col17);
            $total_col18         = floatval($expense->col18);
            $total_col19         = floatval($expense->col19);
            $total_expense_dbi   = floatval($expense_dbi);
            $total_expenses_ncei = floatval($expense->expenses_ncei);
            $total_expense_ope   = floatval($expense_ope);
            $total_cash_box      = floatval($expense->cash_box);
            $total_cash_bank     = floatval($expense->cash_bank);
            $total_total_paid    = floatval($total_paid);

            $year_total_mp_materials  += floatval($expense->mp_materials); 
            $year_total_goods         += floatval($expense->goods); 
            $year_total_fuel          += floatval($expense->fuel); 
            $year_total_power         += floatval($expense->power); 
            $year_total_salary        += floatval($expense->salary);
            $year_total_col7          += floatval($expense->col7);
            $year_total_col8          += floatval($expense->col8);
            $year_total_col9          += floatval($expense->col9);
            $year_total_col10         += floatval($expense->col10);
            $year_total_col11         += floatval($expense->col11);
            $year_total_col12         += floatval($expense->col12);
            $year_total_others        += floatval($expense->others);
            $year_total_expense_pd    += floatval($expense_pd);
            $year_total_lease_state   += floatval($expense->lease_state);
            $year_total_col17         += floatval($expense->col17);
            $year_total_col18         += floatval($expense->col18);
            $year_total_col19         += floatval($expense->col19);
            $year_total_expense_dbi   += floatval($expense_dbi);
            $year_total_expenses_ncei += floatval($expense->expenses_ncei);
            $year_total_expense_ope   += floatval($expense_ope);
            $year_total_cash_box      += floatval($expense->cash_box);
            $year_total_cash_bank     += floatval($expense->cash_bank);
            $year_total_total_paid    += floatval($total_paid);

            $expensemonth[$i - 1] = array(
                'month' => $months[$i],
                'mp_materials' => number_format($total_mp_materials, 2, '.', ','), 
                'goods'=> number_format($total_goods, 2, '.', ','), 
                'fuel' => number_format($total_fuel, 2, '.', ','), 
                'power'=> number_format($total_power, 2, '.', ','), 
                'salary'=> number_format($total_salary, 2, '.', ','),
                'col7'=> number_format($total_col7, 2, '.', ','),
                'col8'=> number_format($total_col8, 2, '.', ','),
                'col9'=> number_format($total_col9, 2, '.', ','),
                'col10'=> number_format($total_col10, 2, '.', ','),
                'col11'=> number_format($total_col11, 2, '.', ','),
                'col12'=> number_format($total_col12, 2, '.', ','),
                'others'=> number_format($total_others, 2, '.', ','),
                'expense_pd'=> number_format($total_expense_pd, 2, '.', ','),
                'lease_state'=> number_format($total_lease_state, 2, '.', ','),
                'col17'=> number_format($total_col17, 2, '.', ','),
                'col18'=> number_format($total_col18, 2, '.', ','),
                'col19'=> number_format($total_col19, 2, '.', ','),
                'expense_dbi'=> number_format($total_expense_dbi, 2, '.', ','),
                'expenses_ncei'=> number_format($total_expenses_ncei, 2, '.', ','),
                'expense_ope'=> number_format($total_expense_ope, 2, '.', ','),
                'cash_box'=> number_format($total_cash_box, 2, '.', ','),
                'cash_bank'=> number_format($total_cash_bank, 2, '.', ','),
                'total_paid'=> number_format($total_total_paid, 2, '.', ',')
            );
        }

        $expensemonth[12] = array(
            'month' => '<strong>TOTAL</strong>',
            'mp_materials' => '<strong>$ ' . number_format($year_total_mp_materials, 2, '.', ',') . '</strong>', 
            'goods'=> '<strong>$ ' . number_format($year_total_goods, 2, '.', ',') . '</strong>', 
            'fuel' => '<strong>$ ' . number_format($year_total_fuel, 2, '.', ',') . '</strong>', 
            'power'=> '<strong>$ ' . number_format($year_total_power, 2, '.', ',') . '</strong>', 
            'salary'=> '<strong>$ ' . number_format($year_total_salary, 2, '.', ',') . '</strong>',
            'col7'=> '<strong>$ ' . number_format($year_total_col7, 2, '.', ',') . '</strong>',
            'col8'=> '<strong>$ ' . number_format($year_total_col8, 2, '.', ',') . '</strong>',
            'col9'=> '<strong>$ ' . number_format($year_total_col9, 2, '.', ',') . '</strong>',
            'col10'=> '<strong>$ ' . number_format($year_total_col10, 2, '.', ',') . '</strong>',
            'col11'=> '<strong>$ ' . number_format($year_total_col11, 2, '.', ',') . '</strong>',
            'col12'=> '<strong>$ ' . number_format($year_total_col12, 2, '.', ',') . '</strong>',
            'others'=> '<strong>$ ' . number_format($year_total_others, 2, '.', ',') . '</strong>',
            'expense_pd'=> '<strong>$ ' . number_format($year_total_expense_pd, 2, '.', ',') . '</strong>',
            'lease_state'=> '<strong>$ ' . number_format($year_total_lease_state, 2, '.', ',') . '</strong>',
            'col17'=> '<strong>$ ' . number_format($year_total_col17, 2, '.', ',') . '</strong>',
            'col18'=> '<strong>$ ' . number_format($year_total_col18, 2, '.', ',') . '</strong>',
            'col19'=> '<strong>$ ' . number_format($year_total_col19, 2, '.', ',') . '</strong>',
            'expense_dbi'=> '<strong>$ ' . number_format($year_total_expense_dbi, 2, '.', ',') . '</strong>',
            'expenses_ncei'=> '<strong>$ ' . number_format($year_total_expenses_ncei, 2, '.', ',') . '</strong>',
            'expense_ope'=> '<strong>$ ' . number_format($year_total_expense_ope, 2, '.', ',') . '</strong>',
            'cash_box'=> '<strong>$ ' . number_format($year_total_cash_box, 2, '.', ',') . '</strong>',
            'cash_bank'=> '<strong>$ ' . number_format($year_total_cash_bank, 2, '.', ',') . '</strong>',
            'total_paid'=> '<strong>$ ' . number_format($year_total_total_paid, 2, '.', ',') . '</strong>'
        );
        
        $response = array('success' => true, 'expensemonth' => $expensemonth);    
        return response()->json($response, 200);
    }

    /**
     * Store a Expense.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->day < 10){ $date = $request->year . '-' . $request->month . '-0' . $request->day; }
        else { $date = $request->year . '-' . $request->month . '-' . $request->day; }

        $entry = Expense::create([
            'id_tcp' => $request->tcp,
            'date' => $date,
            $request->field => floatval(str_replace(',','',$request->newvalue))
        ]);

        $response = array('success' => true);    
        return response()->json($response,201);
    }

    /**
     * Update a Expense.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->day < 10){ $date = $request->year . '-' . $request->month . '-0' . $request->day; }
        else { $date = $request->year . '-' . $request->month . '-' . $request->day; }

        $entry = Expense::find($request->id)->update([
            $request->field => floatval(str_replace(',','',$request->newvalue))
        ]);

        $response = array('success' => true);    
        return response()->json($response,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        Expense::where('id', $request->id)->delete();

        $response = array('success' => true);        
        return response()->json($response,200);
    }

    /**
     * Export to PDF book of Expenses
     */
    public function pdfExpense($id_tcp, $year)
    {
        set_time_limit(300);

        // TCP columns
        if (ExpenseColumn::where('id_tcp', $id_tcp)->exists())
        {                
            $columns = ExpenseColumn::where('id_tcp', $id_tcp)->first();
            $tcp_columns = array(
                'col7' => $columns->col7,
                'col8' => $columns->col8,
                'col9' => $columns->col9,
                'col10' => $columns->col10,
                'col11' => $columns->col11,
                'col12' => $columns->col12,
                'col17' => $columns->col17,
                'col18' => $columns->col18,
                'col19' => $columns->col19,
            );
        }
        else
        {
            $tcp_columns = array(
                'col7' => '',
                'col8' => '',
                'col9' => '',
                'col10' => '',
                'col11' => '',
                'col12' => '',
                'col17' => '',
                'col18' => '',
                'col19' => '',
            );
        }
        
        $tcp = Tcp::where('id', $id_tcp)->first();
        
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

        // Meses
        $expensesmonth = array();
        $days_db = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
        $monthsname = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        for ($i=0; $i < 12; $i++) { 
            
            if ($i < 9) { $month = '0' . strval($i + 1); }
            else { $month = strval($i + 1); }

            $month_total_mp_materials  = 0; 
            $month_total_goods         = 0; 
            $month_total_fuel          = 0; 
            $month_total_power         = 0; 
            $month_total_salary        = 0;
            $month_total_col7          = 0;
            $month_total_col8          = 0;
            $month_total_col9          = 0;
            $month_total_col10         = 0;
            $month_total_col11         = 0;
            $month_total_col12         = 0;
            $month_total_others        = 0;
            $month_total_expense_pd    = 0;
            $month_total_lease_state   = 0;
            $month_total_col17         = 0;
            $month_total_col18         = 0;
            $month_total_col19         = 0;
            $month_total_expense_dbi   = 0;
            $month_total_expenses_ncei = 0;
            $month_total_expense_ope   = 0;
            $month_total_cash_box      = 0;
            $month_total_cash_bank     = 0;
            $month_total_total_paid    = 0;

            $expenseday = array();
            for ($j=0; $j < date('t', strtotime($year.'-'.$month.'-01')); $j++) { 
            
                $date = $year .'-'. $month .'-'. $days_db[$j];
                if(Expense::where('id_tcp', $id_tcp)->whereDate('date', $date)->exists()) {
                    
                    $expense = Expense::where('id_tcp', $id_tcp)->whereDate('date', $date)->first();
                    $expense_pd = $expense->mp_materials + $expense->goods + $expense->fuel + $expense->power + $expense->salary + $expense->col7 + $expense->col8 + $expense->col9 + $expense->col10 + $expense->col11 + $expense->col12 + $expense->others;
                    $expense_dbi = $expense->col17 + $expense->col18 + $expense->col19;
                    $expense_ope = $expense_pd + $expense_dbi + $expense->expenses_ncei;
                    $total_paid  = $expense->cash_box + $expense->cash_bank; 
                    $expenseday[$j] = array(
                        'id' => $expense->id,
                        'day' => $j + 1, 
                        'id_tcp' => $id_tcp, 
                        'date' => $expense->date, 
                        'mp_materials' => number_format($expense->mp_materials, 2, '.', ','), 
                        'goods'=> number_format($expense->goods, 2, '.', ','), 
                        'fuel' => number_format($expense->fuel, 2, '.', ','), 
                        'power'=> number_format($expense->power, 2, '.', ','), 
                        'salary'=> number_format($expense->salary, 2, '.', ','),
                        'col7'=> number_format($expense->col7, 2, '.', ','),
                        'col8'=> number_format($expense->col8, 2, '.', ','),
                        'col9'=> number_format($expense->col9, 2, '.', ','),
                        'col10'=> number_format($expense->col10, 2, '.', ','),
                        'col11'=> number_format($expense->col11, 2, '.', ','),
                        'col12'=> number_format($expense->col12, 2, '.', ','),
                        'others'=> number_format($expense->others, 2, '.', ','),
                        'expense_pd'=> number_format($expense_pd, 2, '.', ','),
                        'lease_state'=> number_format($expense->lease_state, 2, '.', ','),
                        'col17'=> number_format($expense->col17, 2, '.', ','),
                        'col18'=> number_format($expense->col18, 2, '.', ','),
                        'col19'=> number_format($expense->col19, 2, '.', ','),
                        'expense_dbi'=> number_format($expense_dbi, 2, '.', ','),
                        'expenses_ncei'=> number_format($expense->expenses_ncei, 2, '.', ','),
                        'expense_ope'=> number_format($expense_ope, 2, '.', ','),
                        'cash_box'=> number_format($expense->cash_box, 2, '.', ','),
                        'cash_bank'=> number_format($expense->cash_bank, 2, '.', ','),
                        'total_paid'=> number_format($total_paid, 2, '.', ','),
                        'detail'=> $expense->detail
                    );

                    $month_total_mp_materials  += floatval($expense->mp_materials); 
                    $month_total_goods         += floatval($expense->goods); 
                    $month_total_fuel          += floatval($expense->fuel); 
                    $month_total_power         += floatval($expense->power); 
                    $month_total_salary        += floatval($expense->salary);
                    $month_total_col7          += floatval($expense->col7);
                    $month_total_col8          += floatval($expense->col8);
                    $month_total_col9          += floatval($expense->col9);
                    $month_total_col10         += floatval($expense->col10);
                    $month_total_col11         += floatval($expense->col11);
                    $month_total_col12         += floatval($expense->col12);
                    $month_total_others        += floatval($expense->others);
                    $month_total_expense_pd    += floatval($expense_pd);
                    $month_total_lease_state   += floatval($expense->lease_state);
                    $month_total_col17         += floatval($expense->col17);
                    $month_total_col18         += floatval($expense->col18);
                    $month_total_col19         += floatval($expense->col19);
                    $month_total_expense_dbi   += floatval($expense_dbi);
                    $month_total_expenses_ncei += floatval($expense->expenses_ncei);
                    $month_total_expense_ope   += floatval($expense_ope);
                    $month_total_cash_box      += floatval($expense->cash_box);
                    $month_total_cash_bank     += floatval($expense->cash_bank);
                    $month_total_total_paid    += floatval($total_paid);
                }
                else{
                    $expenseday[$j] = array(
                        'id' => '',
                        'day' => $j + 1,
                        'id_tcp' => $id_tcp, 
                        'date' => '', 
                        'mp_materials' => '', 
                        'goods'=> '', 
                        'fuel' => '', 
                        'power'=> '', 
                        'salary'=> '',
                        'col7'=> '',
                        'col8'=> '',
                        'col9'=> '',
                        'col10'=> '',
                        'col11'=> '',
                        'col12'=> '',
                        'others'=> '',
                        'expense_pd'=> '',
                        'lease_state'=> '',
                        'col17'=> '',
                        'col18'=> '',
                        'col19'=> '',
                        'expense_dbi'=> '',
                        'expenses_ncei'=> '',
                        'expense_ope'=> '',
                        'cash_box'=> '',
                        'cash_bank'=> '',
                        'total_paid'=> '',
                        'detail'=> ''
                    );
                }          
            }

            $expenseday[$j + 1] = array(
                'id' => '-1',
                'day' => '<strong>Total</strong>', 
                'id_tcp' => $id_tcp, 
                'date' => '', 
                'mp_materials' => '<strong>' . number_format($month_total_mp_materials, 2, '.', ',') . '</strong>', 
                'goods'=> '<strong>' . number_format($month_total_goods, 2, '.', ',') . '</strong>', 
                'fuel' => '<strong>' . number_format($month_total_fuel, 2, '.', ',') . '</strong>', 
                'power'=> '<strong>' . number_format($month_total_power, 2, '.', ',') . '</strong>', 
                'salary'=> '<strong>' . number_format($month_total_salary, 2, '.', ',') . '</strong>',
                'col7'=> '<strong>' . number_format($month_total_col7, 2, '.', ',') . '</strong>',
                'col8'=> '<strong>' . number_format($month_total_col8, 2, '.', ',') . '</strong>',
                'col9'=> '<strong>' . number_format($month_total_col9, 2, '.', ',') . '</strong>',
                'col10'=> '<strong>' . number_format($month_total_col10, 2, '.', ',') . '</strong>',
                'col11'=> '<strong>' . number_format($month_total_col11, 2, '.', ',') . '</strong>',
                'col12'=> '<strong>' . number_format($month_total_col12, 2, '.', ',') . '</strong>',
                'others'=> '<strong>' . number_format($month_total_others, 2, '.', ',') . '</strong>',
                'expense_pd'=> '<strong>' . number_format($month_total_expense_pd, 2, '.', ',') . '</strong>',
                'lease_state'=> '<strong>' . number_format($month_total_lease_state, 2, '.', ',') . '</strong>',
                'col17'=> '<strong>' . number_format($month_total_col17, 2, '.', ',') . '</strong>',
                'col18'=> '<strong>' . number_format($month_total_col18, 2, '.', ',') . '</strong>',
                'col19'=> '<strong>' . number_format($month_total_col19, 2, '.', ',') . '</strong>',
                'expense_dbi'=> '<strong>' . number_format($month_total_expense_dbi, 2, '.', ',') . '</strong>',
                'expenses_ncei'=> '<strong>' . number_format($month_total_expenses_ncei, 2, '.', ',') . '</strong>',
                'expense_ope'=> '<strong>' . number_format($month_total_expense_ope, 2, '.', ',') . '</strong>',
                'cash_box'=> '<strong>' . number_format($month_total_cash_box, 2, '.', ',') . '</strong>',
                'cash_bank'=> '<strong>' . number_format($month_total_cash_bank, 2, '.', ',') . '</strong>',
                'total_paid'=> '<strong>' . number_format($month_total_total_paid, 2, '.', ',') . '</strong>',
                'detail'=> ''
            );

            $expensesmonth[$monthsname[$i]] = $expenseday;
        }
        
        // Año
        $expensesyear = array();
        $months       = array('', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');

        $year_total_mp_materials  = 0; 
        $year_total_goods         = 0; 
        $year_total_fuel          = 0; 
        $year_total_power         = 0; 
        $year_total_salary        = 0;
        $year_total_col7          = 0;
        $year_total_col8          = 0;
        $year_total_col9          = 0;
        $year_total_col10         = 0;
        $year_total_col11         = 0;
        $year_total_col12         = 0;
        $year_total_others        = 0;
        $year_total_expense_pd    = 0;
        $year_total_lease_state   = 0;
        $year_total_col17         = 0;
        $year_total_col18         = 0;
        $year_total_col19         = 0;
        $year_total_expense_dbi   = 0;
        $year_total_expenses_ncei = 0;
        $year_total_expense_ope   = 0;
        $year_total_cash_box      = 0;
        $year_total_cash_bank     = 0;
        $year_total_total_paid    = 0;

        for ($i=1; $i < 13; $i++) { 
            
            if ($i < 10) { $month = '0' . $i; }
            else { $month = $i; }
            $date = $year .'-'. $month .'-01';

            $expense = Expense::select(DB::raw('SUM(mp_materials) as mp_materials'), DB::raw('SUM(goods) as goods'), DB::raw('SUM(fuel) as fuel'), DB::raw('SUM(power) as power'), DB::raw('SUM(salary) as salary'), DB::raw('SUM(col7) as col7'), DB::raw('SUM(col8) as col8'), DB::raw('SUM(col9) as col9'), DB::raw('SUM(col10) as col10'), DB::raw('SUM(col11) as col11'), DB::raw('SUM(col12) as col12'), DB::raw('SUM(others) as others'), DB::raw('SUM(lease_state) as lease_state'), DB::raw('SUM(col17) as col17'), DB::raw('SUM(col18) as col18'), DB::raw('SUM(col19) as col19'), DB::raw('SUM(expenses_ncei) as expenses_ncei'), DB::raw('SUM(cash_box) as cash_box'), DB::raw('SUM(cash_bank) as cash_bank'))
                        ->where('id_tcp', $id_tcp)
                        ->whereMonth('date', $month)
                        ->whereYear('date', $year)
                        ->first();
            
            $expense_pd = $expense->mp_materials + $expense->goods + $expense->fuel + $expense->power + $expense->salary + $expense->col7 + $expense->col8 + $expense->col9 + $expense->col10 + $expense->col11 + $expense->col12 + $expense->others;
            $expense_dbi = $expense->col17 + $expense->col18 + $expense->col19;
            $expense_ope = $expense_pd + $expense_dbi + $expense->expenses_ncei;
            $total_paid  = $expense->cash_box + $expense->cash_bank; 

            $expensesyear[$i - 1] = array(
                'month' => $months[$i],
                'mp_materials' => number_format($expense->mp_materials, 2, '.', ','), 
                'goods'=> number_format($expense->goods, 2, '.', ','), 
                'fuel' => number_format($expense->fuel, 2, '.', ','), 
                'power'=> number_format($expense->power, 2, '.', ','), 
                'salary'=> number_format($expense->salary, 2, '.', ','),
                'col7'=> number_format($expense->col7, 2, '.', ','),
                'col8'=> number_format($expense->col8, 2, '.', ','),
                'col9'=> number_format($expense->col9, 2, '.', ','),
                'col10'=> number_format($expense->col10, 2, '.', ','),
                'col11'=> number_format($expense->col11, 2, '.', ','),
                'col12'=> number_format($expense->col12, 2, '.', ','),
                'others'=> number_format($expense->others, 2, '.', ','),
                'expense_pd'=> number_format($expense_pd, 2, '.', ','),
                'lease_state'=> number_format($expense->lease_state, 2, '.', ','),
                'col17'=> number_format($expense->col17, 2, '.', ','),
                'col18'=> number_format($expense->col18, 2, '.', ','),
                'col19'=> number_format($expense->col19, 2, '.', ','),
                'expense_dbi'=> number_format($expense_dbi, 2, '.', ','),
                'expenses_ncei'=> number_format($expense->expenses_ncei, 2, '.', ','),
                'expense_ope'=> number_format($expense_ope, 2, '.', ','),
                'cash_box'=> number_format($expense->cash_box, 2, '.', ','),
                'cash_bank'=> number_format($expense->cash_bank, 2, '.', ','),
                'total_paid'=> number_format($total_paid, 2, '.', ',')
            );

            $year_total_mp_materials  += floatval($expense->mp_materials); 
            $year_total_goods         += floatval($expense->goods); 
            $year_total_fuel          += floatval($expense->fuel); 
            $year_total_power         += floatval($expense->power); 
            $year_total_salary        += floatval($expense->salary);
            $year_total_col7          += floatval($expense->col7);
            $year_total_col8          += floatval($expense->col8);
            $year_total_col9          += floatval($expense->col9);
            $year_total_col10         += floatval($expense->col10);
            $year_total_col11         += floatval($expense->col11);
            $year_total_col12         += floatval($expense->col12);
            $year_total_others        += floatval($expense->others);
            $year_total_expense_pd    += floatval($expense_pd);
            $year_total_lease_state   += floatval($expense->lease_state);
            $year_total_col17         += floatval($expense->col17);
            $year_total_col18         += floatval($expense->col18);
            $year_total_col19         += floatval($expense->col19);
            $year_total_expense_dbi   += floatval($expense_dbi);
            $year_total_expenses_ncei += floatval($expense->expenses_ncei);
            $year_total_expense_ope   += floatval($expense_ope);
            $year_total_cash_box      += floatval($expense->cash_box);
            $year_total_cash_bank     += floatval($expense->cash_bank);
            $year_total_total_paid    += floatval($total_paid);
        }

        $expensesyear[12] = array(
            'month' => '<strong>TOTAL</strong>',
            'mp_materials' => '<strong>' . number_format($year_total_mp_materials, 2, '.', ',') . '</strong>', 
            'goods'=> '<strong>' . number_format($year_total_goods, 2, '.', ',') . '</strong>', 
            'fuel' => '<strong>' . number_format($year_total_fuel, 2, '.', ',') . '</strong>', 
            'power'=> '<strong>' . number_format($year_total_power, 2, '.', ',') . '</strong>', 
            'salary'=> '<strong>' . number_format($year_total_salary, 2, '.', ',') . '</strong>',
            'col7'=> '<strong>' . number_format($year_total_col7, 2, '.', ',') . '</strong>',
            'col8'=> '<strong>' . number_format($year_total_col8, 2, '.', ',') . '</strong>',
            'col9'=> '<strong>' . number_format($year_total_col9, 2, '.', ',') . '</strong>',
            'col10'=> '<strong>' . number_format($year_total_col10, 2, '.', ',') . '</strong>',
            'col11'=> '<strong>' . number_format($year_total_col11, 2, '.', ',') . '</strong>',
            'col12'=> '<strong>' . number_format($year_total_col12, 2, '.', ',') . '</strong>',
            'others'=> '<strong>' . number_format($year_total_others, 2, '.', ',') . '</strong>',
            'expense_pd'=> '<strong>' . number_format($year_total_expense_pd, 2, '.', ',') . '</strong>',
            'lease_state'=> '<strong>' . number_format($year_total_lease_state, 2, '.', ',') . '</strong>',
            'col17'=> '<strong>' . number_format($year_total_col17, 2, '.', ',') . '</strong>',
            'col18'=> '<strong>' . number_format($year_total_col18, 2, '.', ',') . '</strong>',
            'col19'=> '<strong>' . number_format($year_total_col19, 2, '.', ',') . '</strong>',
            'expense_dbi'=> '<strong>' . number_format($year_total_expense_dbi, 2, '.', ',') . '</strong>',
            'expenses_ncei'=> '<strong>' . number_format($year_total_expenses_ncei, 2, '.', ',') . '</strong>',
            'expense_ope'=> '<strong>' . number_format($year_total_expense_ope, 2, '.', ',') . '</strong>',
            'cash_box'=> '<strong>' . number_format($year_total_cash_box, 2, '.', ',') . '</strong>',
            'cash_bank'=> '<strong>' . number_format($year_total_cash_bank, 2, '.', ',') . '</strong>',
            'total_paid'=> '<strong>' . number_format($year_total_total_paid, 2, '.', ',') . '</strong>'
        );

        // Tax
        $taxyear = array();
        $year_sales_services     = 0;
        $year_workforce          = 0;
        $year_documents          = 0;
        $year_commercial_ads     = 0;
        $year_social_security    = 0;
        $year_others             = 0;
        $year_subtotal           = 0;
        $year_restoration_repair = 0;
        $year_monthly_fee        = 0;
        $year_total_pay          = 0;

        for ($i=1; $i < 13; $i++) { 
            
            if ($i < 10) { $month = '0' . $i; }
            else { $month = $i; }

            // Get Tax Sales/Services
            $cash_box = Entry::select(DB::raw('SUM(cash_box) as total_cash_box'))
                            ->where('id_tcp', $id_tcp)
                            ->whereMonth('date', $month)
                            ->whereYear('date', $year)
                            ->first()->total_cash_box;
            if ($cash_box == 0) {
                $sales_services = 0;
            }
            else {
                $sales_services = ($cash_box * 10) / 100;
            }

            if(Tax::where('id_tcp', $id_tcp)->where('month', $i)->where('year', $year)->exists()) {
            
                $tax = Tax::where('id_tcp', $id_tcp)->where('month', $i)->where('year', $year)->first();
                
                $subtotal = $sales_services + $tax->workforce + $tax->documents + $tax->commercial_ads + $tax->social_security + $tax->others; 
                $total_pay = $subtotal + $tax->restoration_repair + $tax->monthly_fee; 
                
                if ($tax->workforce != '') {
                    $workforce = number_format($tax->workforce, 2, '.', ',');
                }else { $workforce = ''; }

                if ($tax->documents != '') {
                    $documents = number_format($tax->documents, 2, '.', ',');
                }else { $documents = ''; }

                if ($tax->commercial_ads != '') {
                    $commercial_ads = number_format($tax->commercial_ads, 2, '.', ',');
                }else { $commercial_ads = ''; }

                if ($tax->social_security != '') {
                    $social_security = number_format($tax->social_security, 2, '.', ',');
                }else { $social_security = ''; }
                
                if ($tax->others != '') {
                    $others = number_format($tax->others, 2, '.', ',');
                }else { $others = ''; }

                if ($tax->restoration_repair != '') {
                    $restoration_repair = number_format($tax->restoration_repair, 2, '.', ',');
                }else { $restoration_repair = ''; }
                
                if ($tax->monthly_fee != '') {
                    $monthly_fee = number_format($tax->monthly_fee, 2, '.', ',');
                }else { $monthly_fee = ''; }
                
                $taxyear[$i - 1] = array(
                    'month' => $months[$i],
                    'sales_services'=> number_format($sales_services, 2, '.', ','), 
                    'workforce' => $workforce, 
                    'documents'=> $documents,
                    'commercial_ads'=> $commercial_ads,
                    'social_security'=> $social_security,
                    'others'=> $others,
                    'subtotal'=> number_format($subtotal, 2, '.', ','),
                    'restoration_repair'=> $restoration_repair,
                    'monthly_fee'=> $monthly_fee,
                    'total_pay'=> number_format($total_pay, 2, '.', ',')
                );

                $year_sales_services     += $sales_services;
                $year_workforce          += floatval($tax->workforce);
                $year_documents          += floatval($tax->documents);
                $year_commercial_ads     += floatval($tax->commercial_ads);
                $year_social_security    += floatval($tax->social_security);
                $year_others             += floatval($tax->others);
                $year_subtotal           += floatval($subtotal);
                $year_restoration_repair += floatval($tax->restoration_repair);
                $year_monthly_fee        += floatval($tax->monthly_fee);
                $year_total_pay          += floatval($total_pay);
            }
            else {
                $taxyear[$i - 1] = array(
                    'month' => $months[$i],
                    'sales_services'=> number_format($sales_services, 2, '.', ','), 
                    'workforce' => '',
                    'documents'=> '',
                    'commercial_ads'=> '',
                    'social_security'=> '',
                    'others'=> '',
                    'subtotal'=> number_format($sales_services, 2, '.', ','),
                    'restoration_repair'=> '',
                    'monthly_fee'=> '',
                    'total_pay'=> number_format($sales_services, 2, '.', ',')
                );
            }
        }

        $year_sales_services = number_format($year_sales_services, 2, '.', ',');
        $year_workforce = number_format($year_workforce, 2, '.', ',');
        $year_documents = number_format($year_documents, 2, '.', ',');
        $year_commercial_ads = number_format($year_commercial_ads, 2, '.', ',');
        $year_social_security = number_format($year_social_security, 2, '.', ',');
        $year_others = number_format($year_others, 2, '.', ',');
        $year_subtotal = number_format($year_subtotal, 2, '.', ',');
        $year_restoration_repair = number_format($year_restoration_repair, 2, '.', ',');
        $year_monthly_fee = number_format($year_monthly_fee, 2, '.', ',');
        $year_total_pay = number_format($year_total_pay, 2, '.', ',');

        $taxyear[12] = array(
            'month' => '<strong>TOTAL PAGADO</strong>',
            'sales_services'=> '<strong>'. $year_sales_services . '</strong>', 
            'workforce' => '<strong>'. $year_workforce . '</strong>',
            'documents'=> '<strong>'. $year_documents . '</strong>',
            'commercial_ads'=> '<strong>'. $year_commercial_ads . '</strong>',
            'social_security'=> '<strong>'. $year_social_security . '</strong>',
            'others'=> '<strong>'. $year_others . '</strong>',
            'subtotal'=> '<strong>'. $year_subtotal . '</strong>',
            'restoration_repair'=> '<strong>'. $year_restoration_repair . '</strong>',
            'monthly_fee'=> '<strong>'. $year_monthly_fee . '</strong>',
            'total_pay'=> '<strong>'. $year_total_pay . '</strong>'
        );
        
        $pdf = PDF::loadView('pdf.expenses', compact('tcp', 'obligations', 'year', 'expensesmonth', 'expensesyear', 'taxyear', 'tcp_columns'))->setPaper('letter', 'landscape');
        return $pdf->download('Registro Gastos '. $tcp['name']. ' ' . $tcp['last_name'] .' '.date('d-m-Y').'.pdf');
    }
}
