<?php

namespace App\Http\Controllers;

use App\Models\Tcp;
use App\Models\Province;
use App\Models\City;
use App\Models\TcpObligation;
use App\Models\Tax;
use App\Models\AftProduct;
use App\Models\AftProductsubgroup;
use App\Models\AftSubgroup;
use App\Models\Entry;
use App\Models\Expense;
use App\Models\ModelOption;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    /**
     * Result State list.
     *
     * @return \Illuminate\Http\Response
     */
    public function resultState($tcp, $year)
    {
        $resultstate = array();
        
        $year_total_entry_net    = 0;
        $year_expenses_materials = 0;
        $year_expenses_goods     = 0;
        $year_expenses_fuel      = 0;
        $year_expenses_power     = 0;
        $year_expenses_salary    = 0;
        $year_expenses_others    = 0;
        $year_depreciation_aft   = 0;
        $year_tax_sales          = 0;
        $year_tax_document       = 0;
        $year_tax_workforce      = 0;
        $year_tax_others         = 0;
        $year_tax_entries        = 0;
        $year_tax_security       = 0;
 
        for ($i=1; $i < 13; $i++) { 
            
            if ($i < 10) { $month = '0' . $i; }
            else { $month = $i; }
            $date = $year .'-'. $month .'-01';

            // SALES
            $entry = Entry::select(DB::raw('SUM(cash_box) as total_entry_box'), DB::raw('SUM(cash_ncei) as total_entry_ncei'))
                        ->where('id_tcp', $tcp)
                        ->whereMonth('date', $month)
                        ->whereYear('date', $year)
                        ->first();

            $total_entry_box  = floatval($entry->total_entry_box);
            $total_entry_ncei = floatval($entry->total_entry_ncei);
            $total_entry_net  = number_format($total_entry_box, 2, '.', '') - number_format($total_entry_ncei, 2, '.', '');
            $year_total_entry_net  += $total_entry_net;

            // EXPENSES
            $expense = Expense::select(DB::raw('SUM(mp_materials) as mp_materials'), DB::raw('SUM(goods) as goods'), DB::raw('SUM(fuel) as fuel'), DB::raw('SUM(power) as power'), DB::raw('SUM(salary) as salary'), DB::raw('SUM(col7) as col7'), DB::raw('SUM(col8) as col8'), DB::raw('SUM(col9) as col9'), DB::raw('SUM(col10) as col10'), DB::raw('SUM(col11) as col11'), DB::raw('SUM(col12) as col12'), DB::raw('SUM(others) as others'), DB::raw('SUM(lease_state) as lease_state'), DB::raw('SUM(col17) as col17'), DB::raw('SUM(col18) as col18'), DB::raw('SUM(col19) as col19'))
                ->where('id_tcp', $tcp)
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->first();

            $total_expenses_materials = floatval($expense->mp_materials);
            $total_expenses_goods     = floatval($expense->goods);
            $total_expenses_fuel      = floatval($expense->fuel);
            $total_expenses_power     = floatval($expense->power);
            $total_expenses_salary    = floatval($expense->salary);
            $total_expenses_others    = number_format($expense->col7, 2, '.', '') + number_format($expense->col8, 2, '.', '') + number_format($expense->col9, 2, '.', '') + number_format($expense->col10, 2, '.', '') + number_format($expense->col11, 2, '.', '') + number_format($expense->col12, 2, '.', '') + number_format($expense->others, 2, '.', '') + number_format($expense->lease_state, 2, '.', '') + number_format($expense->col17, 2, '.', '') + number_format($expense->col18, 2, '.', '') + number_format($expense->col19, 2, '.', '');

            $year_expenses_materials += $total_expenses_materials;
            $year_expenses_goods     += $total_expenses_goods;
            $year_expenses_fuel      += $total_expenses_fuel;
            $year_expenses_power     += $total_expenses_power;
            $year_expenses_salary    += $total_expenses_salary;
            $year_expenses_others    += $total_expenses_others;

            // TAX
            // Get Tax Sales/Services
            $cash_box = Entry::select(DB::raw('SUM(cash_box) as total_cash_box'))
                            ->where('id_tcp', $tcp)
                            ->whereMonth('date', $month)
                            ->whereYear('date', $year)
                            ->first()->total_cash_box;
            if ($cash_box == 0) {
                $sales_services = 0;
            }
            else {
                $sales_services = ($cash_box * 10) / 100;
            }

            if(Tax::where('id_tcp', $tcp)->where('month', $i)->where('year', $year)->exists()) {
            
                $tax = Tax::where('id_tcp', $tcp)->where('month', $i)->where('year', $year)->first();
                $year_tax_document  += $tax->documents;
                $year_tax_workforce += $tax->workforce;
                $year_tax_entries   += $tax->monthly_fee;
                $year_tax_security  += $tax->social_security;
                $year_tax_others    += $tax->commercial_ads + $tax->others + $tax->restoration_repair;
            }

            $year_tax_sales += $sales_services;
        }

        // AFT
        $aft = AftProduct::leftJoin('aft_groups', 'aft_groups.id', '=', 'aft_products.id_group')
                    ->select('aft_groups.code', 'aft_groups.desc', 'aft_products.id', 'aft_products.product', 'aft_products.um', 'aft_products.ctdad', 'aft_products.price', 'aft_products.import', 'aft_products.pay_date', 'aft_products.live_year', 'aft_products.dep_year', 'aft_products.dep_month')
                    ->where('aft_products.id_tcp', $tcp)
                    ->get();
        
        foreach ($aft as $row) {
            $pay_year     = explode('-', $row->pay_date);
            $current_year = $year;
            $current_live = $row->live_year - ($current_year - $pay_year[0]);
            $row['current_live'] = $current_live;
            if ($current_live < 1) {
                $row['dep_year']  = $row->import;
                $row['dep_month'] = $row->import;
            }
            $year_depreciation_aft += $row['dep_year'];
        }

        // RESULT STATE ITEMS
        $sales         = $year_total_entry_net;
        $materials     = $year_expenses_materials;
        $goods         = $year_expenses_goods;
        $fuel          = $year_expenses_fuel;
        $power         = $total_expenses_salary;
        $salary        = $year_expenses_salary;
        $others        = $year_expenses_others;
        $dep_aft       = $year_depreciation_aft;
        $expenses      = $materials + $goods + $fuel + $power + $salary + $others + $dep_aft;
        $taxs          = $year_tax_document + $year_tax_others + $year_tax_sales + $year_tax_workforce;
        $tax_sales     = $year_tax_sales;
        $tax_document  = $year_tax_document;
        $tax_others    = $year_tax_others;
        $tax_workforce = $year_tax_workforce;
        $tax_security  = $year_tax_security;
        $utility_loss  = $sales - $expenses - $taxs;

        // TCP ENTRIES TAX
        if (ModelOption::where('id_tcp', $tcp)->where('year', $year)->exists()){
            $model_option = ModelOption::where('id_tcp', $tcp)
                                        ->where('year', $year)
                                        ->where('model', 'states')
                                        ->where('key', 'tax_entries')
                                        ->first();
            $tax_entries = $model_option->value; 
        }
        else {
            $tax_entries = 0;
        }

        $utility_net     = $utility_loss - $tax_entries - $tax_security;
        $pay_tax_entries = $year_tax_entries;
        $debt            = $tax_entries - $pay_tax_entries;
        if ($debt < 1) {
            $debt = 0;
        }

        $resultstate[] = array('id' => 1, 'item' => '<strong>- Ventas o Servicios</strong>', 'subtotal' => '', 'total' => '<strong>' . number_format(floor($sales*100)/100, 2, '.', ',') . '</strong>');
        $resultstate[] = array('id' => 2, 'item' => 'MENOS:', 'subtotal' => '', 'total' => '');
        $resultstate[] = array('id' => 3, 'item' => '<strong>- Gastos Directos de Operaci&oacute;n</strong>', 'subtotal' => '', 'total' => '<strong>' . number_format(floor($expenses*100)/100, 2, '.', ',') . '</strong>');
        $resultstate[] = array('id' => 4, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Materias Primas y Materiales', 'subtotal' => number_format(floor($materials*100)/100, 2, '.', ','), 'total' => '');
        $resultstate[] = array('id' => 5, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Combustible', 'subtotal' => number_format(floor($fuel*100)/100, 2, '.', ','), 'total' => '');
        $resultstate[] = array('id' => 6, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Energ&iacute;a El&eacute;ctrica', 'subtotal' => number_format(floor($power*100)/100, 2, '.', ','), 'total' => '');
        $resultstate[] = array('id' => 7, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Remuneraci&oacute;n al personal contratado', 'subtotal' => number_format(floor($salary*100)/100, 2, '.', ','), 'total' => '');
        $resultstate[] = array('id' => 8, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Depreciaci&oacute;n de activos fijos tangibles', 'subtotal' => number_format(floor($dep_aft*100)/100, 2, '.', ','), 'total' => '');
        $resultstate[] = array('id' => 9, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Otros Gastos monetarios y financieros', 'subtotal' => number_format(floor($others*100)/100, 2, '.', ','), 'total' => '');
        $resultstate[] = array('id' => 10, 'item' => '<strong>- Impuestos y Tasas</strong>', 'subtotal' => '', 'total' => '<strong>' . number_format(floor($taxs*100)/100, 2, '.', ',') . '</strong>');
        $resultstate[] = array('id' => 11, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Impuestos sobre Ventas o Servicios', 'subtotal' => number_format(floor($tax_sales*100)/100, 2, '.', ','), 'total' => '');
        $resultstate[] = array('id' => 12, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Impuestos sobre Documentos', 'subtotal' => number_format(floor($tax_document*100)/100, 2, '.', ','), 'total' => '');
        $resultstate[] = array('id' => 13, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Impuestos por la utilizaci&oacute; de Fuerza de Trabajo', 'subtotal' => number_format(floor($tax_workforce*100)/100, 2, '.', ','), 'total' => '');
        $resultstate[] = array('id' => 14, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Otros Impuestos y Tasas', 'subtotal' => number_format(floor($tax_others*100)/100, 2, '.', ','), 'total' => '');
        $resultstate[] = array('id' => 15, 'item' => '<strong>- Utilidad o P&eacute;rdida en Operaciones</strong>', 'subtotal' => '', 'total' => '<strong>' . number_format(floor($utility_loss*100)/100, 2, '.', ',') . '</strong>');
        $resultstate[] = array('id' => 16, 'item' => '- Impuesto sobre Ingresos personales', 'subtotal' => '', 'total' => number_format(floor($tax_entries*100)/100, 2, '.', ','));
        $resultstate[] = array('id' => 17, 'item' => '- Contribuci&oacute;n a la Seguridad Social', 'subtotal' => '', 'total' => number_format(floor($tax_security*100)/100, 2, '.', ','));
        $resultstate[] = array('id' => 18, 'item' => '<strong>- Utilidad o P&eacute;rdida Neta</strong>', 'subtotal' => '', 'total' => '<strong>' . number_format(floor($utility_net*100)/100, 2, '.', ',') . '</strong>');
        $resultstate[] = array('id' => 19, 'item' => '- Pago a cuenta del impuesto sobre ingresos personales', 'subtotal' => '', 'total' => number_format(floor($pay_tax_entries*100)/100, 2, '.', ','));
        $resultstate[] = array('id' => 20, 'item' => '- Deuda con el Fisco', 'subtotal' => '', 'total' => number_format(floor($debt*100)/100, 2, '.', ','));
        
        $response = array('success' => true, 'resultstate' => $resultstate);    
        return response()->json($response, 200);
    }

    /**
     * Situation State list.
     *
     * @return \Illuminate\Http\Response
     */
    public function situationState($tcp, $year)
    {
        $situationstate = array();
        
        $year_cash            = 0;
        $year_cash_box        = 0;
        $year_cash_bank       = 0;
        $year_atf_net         = 0;
        $year_atf_edmueq      = 0;
        $year_aft_deprec      = 0;
        $year_tax_entries     = 0;
        $year_total_entry_net = 0;
        $year_expenses_materials = 0;
        $year_expenses_goods     = 0;
        $year_expenses_fuel      = 0;
        $year_expenses_power     = 0;
        $year_expenses_salary    = 0;
        $year_expenses_others    = 0;
        $year_tax_sales          = 0;
        $year_tax_document       = 0;
        $year_tax_workforce      = 0;
        $year_tax_others         = 0;
        $year_tax_security       = 0;
 
        for ($i=1; $i < 13; $i++) {
            
            if ($i < 10) { $month = '0' . $i; }
            else { $month = $i; }
            $date = $year .'-'. $month .'-01';

            // Cash
            $cash_box = Entry::select(DB::raw('SUM(cash_box) as total_entry_box'), DB::raw('SUM(cash_ncei) as total_entry_ncei'))
                        ->where('id_tcp', $tcp)
                        ->whereMonth('date', $month)
                        ->whereYear('date', $year)
                        ->first();

            $total_cash_box  = floatval($cash_box->total_entry_box);
            $total_cash_ncei = floatval($cash_box->total_entry_ncei);
            $total_entry_net  = number_format($total_cash_box, 2, '.', '') - number_format($total_cash_ncei, 2, '.', '');
            $year_total_entry_net  += $total_entry_net;
            
            // EXPENSES
            $expense = Expense::select(DB::raw('SUM(mp_materials) as mp_materials'), DB::raw('SUM(goods) as goods'), DB::raw('SUM(fuel) as fuel'), DB::raw('SUM(power) as power'), DB::raw('SUM(salary) as salary'), DB::raw('SUM(col7) as col7'), DB::raw('SUM(col8) as col8'), DB::raw('SUM(col9) as col9'), DB::raw('SUM(col10) as col10'), DB::raw('SUM(col11) as col11'), DB::raw('SUM(col12) as col12'), DB::raw('SUM(others) as others'), DB::raw('SUM(lease_state) as lease_state'), DB::raw('SUM(col17) as col17'), DB::raw('SUM(col18) as col18'), DB::raw('SUM(col19) as col19'))
                ->where('id_tcp', $tcp)
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->first();

            $total_expenses_materials = floatval($expense->mp_materials);
            $total_expenses_goods     = floatval($expense->goods);
            $total_expenses_fuel      = floatval($expense->fuel);
            $total_expenses_power     = floatval($expense->power);
            $total_expenses_salary    = floatval($expense->salary);
            $total_expenses_others    = number_format($expense->col7, 2, '.', '') + number_format($expense->col8, 2, '.', '') + number_format($expense->col9, 2, '.', '') + number_format($expense->col10, 2, '.', '') + number_format($expense->col11, 2, '.', '') + number_format($expense->col12, 2, '.', '') + number_format($expense->others, 2, '.', '') + number_format($expense->lease_state, 2, '.', '') + number_format($expense->col17, 2, '.', '') + number_format($expense->col18, 2, '.', '') + number_format($expense->col19, 2, '.', '');

            $year_expenses_materials += $total_expenses_materials;
            $year_expenses_goods     += $total_expenses_goods;
            $year_expenses_fuel      += $total_expenses_fuel;
            $year_expenses_power     += $total_expenses_power;
            $year_expenses_salary    += $total_expenses_salary;
            $year_expenses_others    += $total_expenses_others;
            $year_cash_box           += $total_cash_box;

            // TAX
            // Get Tax Sales/Services
            $cash_box = Entry::select(DB::raw('SUM(cash_box) as total_cash_box'))
                            ->where('id_tcp', $tcp)
                            ->whereMonth('date', $month)
                            ->whereYear('date', $year)
                            ->first()->total_cash_box;
            if ($cash_box == 0) {
                $sales_services = 0;
            }
            else {
                $sales_services = ($cash_box * 10) / 100;
            }

            if(Tax::where('id_tcp', $tcp)->where('month', $i)->where('year', $year)->exists()) {
            
                $tax = Tax::where('id_tcp', $tcp)->where('month', $i)->where('year', $year)->first();
                $year_tax_entries   += $tax->monthly_fee;
                $year_tax_document  += $tax->documents;
                $year_tax_workforce += $tax->workforce;
                $year_tax_security  += $tax->social_security;
                $year_tax_others    += $tax->commercial_ads + $tax->others + $tax->restoration_repair;
            }

            $year_tax_sales += $sales_services;
        }

        // Cash Bank
        if (ModelOption::where('id_tcp', $tcp)->where('year', $year)->where('model', 'states')->where('key', 'cash_bank')->exists()){
            $cash_bank = ModelOption::where('id_tcp', $tcp)
                                        ->where('year', $year)
                                        ->where('model', 'states')
                                        ->where('key', 'cash_bank')
                                        ->first();
            $cash_bank = $cash_bank->value; 
        }
        else {
            $cash_bank = 0;
        }

        $year_cash = $year_cash_box + $cash_bank;

        // AFT
        $aft = AftProduct::leftJoin('aft_groups', 'aft_groups.id', '=', 'aft_products.id_group')
                    ->select('aft_groups.code', 'aft_groups.desc', 'aft_products.id', 'aft_products.product', 'aft_products.um', 'aft_products.ctdad', 'aft_products.price', 'aft_products.import', 'aft_products.pay_date', 'aft_products.live_year', 'aft_products.dep_year', 'aft_products.dep_month')
                    ->where('aft_products.id_tcp', $tcp)
                    ->get();
        
        foreach ($aft as $row) {
            $pay_year     = explode('-', $row->pay_date);
            $current_year = $year;
            $current_live = $row->live_year - ($current_year - $pay_year[0]);
            $row['current_live'] = $current_live;
            if ($current_live < 1) {
                $row['dep_year']  = $row->import;
                $row['dep_month'] = $row->import;
            }
            $year_atf_edmueq += $row->import;
            $year_aft_deprec += $row['dep_year'];
            $year_atf_net    += $row->import - $row['dep_year'];
        }

        // TCP ENTRIES TAX
        if (ModelOption::where('id_tcp', $tcp)->where('year', $year)->where('model', 'states')->where('key', 'tax_entries')->exists()){
            $model_option = ModelOption::where('id_tcp', $tcp)
                                        ->where('year', $year)
                                        ->where('model', 'states')
                                        ->where('key', 'tax_entries')
                                        ->first();
            $tax_entries = $model_option->value; 
        }
        else {
            $tax_entries = 0;
        }

        // TCP ACCOUNTS RECEIVABLE
        if (ModelOption::where('id_tcp', $tcp)->where('year', $year)->where('model', 'states')->where('key', 'acc_receiv')->exists()){
            $model_option = ModelOption::where('id_tcp', $tcp)
                                        ->where('year', $year)
                                        ->where('model', 'states')
                                        ->where('key', 'acc_receiv')
                                        ->first();
            $acc_receiv = $model_option->value;
        }
        else {
            $acc_receiv = 0;
        }

        // TCP SHORT TERM BANK OBLIGATIONS
        if (ModelOption::where('id_tcp', $tcp)->where('year', $year)->where('model', 'states')->where('key', 'bank_oblig_short')->exists()){
            $model_option = ModelOption::where('id_tcp', $tcp)
                                        ->where('year', $year)
                                        ->where('model', 'states')
                                        ->where('key', 'bank_oblig_short')
                                        ->first();
            $bank_oblig_short = $model_option->value;
        }
        else {
            $bank_oblig_short = 0;
        }

        // TCP LONG TERM BANK OBLIGATIONS
        if (ModelOption::where('id_tcp', $tcp)->where('year', $year)->where('model', 'states')->where('key', 'bank_oblig_long')->exists()){
            $model_option = ModelOption::where('id_tcp', $tcp)
                                        ->where('year', $year)
                                        ->where('model', 'states')
                                        ->where('key', 'bank_oblig_long')
                                        ->first();
            $bank_oblig_long = $model_option->value;
        }
        else {
            $bank_oblig_long = 0;
        }

        // TCP PLUS CONTRIBUTION
        if (ModelOption::where('id_tcp', $tcp)->where('year', $year)->where('model', 'states')->where('key', 'plus_contribution')->exists()){
            $model_option = ModelOption::where('id_tcp', $tcp)
                                        ->where('year', $year)
                                        ->where('model', 'states')
                                        ->where('key', 'plus_contribution')
                                        ->first();
            $plus_contribution = $model_option->value;
        }
        else {
            $plus_contribution = 0;
        }

        // TCP OTHER EXPENSES
        if (ModelOption::where('id_tcp', $tcp)->where('year', $year)->where('model', 'states')->where('key', 'other_expenses')->exists()){
            $model_option = ModelOption::where('id_tcp', $tcp)
                                        ->where('year', $year)
                                        ->where('model', 'states')
                                        ->where('key', 'other_expenses')
                                        ->first();
            $other_expenses = $model_option->value;
        }
        else {
            $other_expenses = 0;
        }

        // SITUATION STATE ITEMS
        $cash            = $year_cash + $acc_receiv;
        $cash_box        = $year_cash_box;
        $aft_net         = $year_atf_net;
        $aft_edmueq      = $year_atf_edmueq;
        $aft_deprec      = $year_aft_deprec;
        $actives         = $cash + $year_atf_net;
        $pay_tax_entries = $year_tax_entries;
        $debt            = $tax_entries - $pay_tax_entries;
        if ($debt < 1) { $debt = 0; }
        $pasives_circ    = $debt + $bank_oblig_short;
        $pasives_long    = $bank_oblig_long;
        $pasives         = $pasives_circ + $pasives_long;
        $sales           = $year_total_entry_net;
        $materials       = $year_expenses_materials;
        $goods           = $year_expenses_goods;
        $fuel            = $year_expenses_fuel;
        $power           = $total_expenses_salary;
        $salary          = $year_expenses_salary;
        $others          = $year_expenses_others;
        $expenses        = $materials + $goods + $fuel + $power + $salary + $others + $aft_deprec;
        $taxs            = $year_tax_document + $year_tax_others + $year_tax_sales + $year_tax_workforce;
        $tax_sales       = $year_tax_sales;
        $tax_document    = $year_tax_document;
        $tax_others      = $year_tax_others;
        $tax_workforce   = $year_tax_workforce;
        $tax_security    = $year_tax_security;
        $utility_loss    = $sales - $expenses - $taxs;
        $utility_net     = $utility_loss - $tax_entries - $tax_security;
        $patrimony_net   = $aft_edmueq + $plus_contribution - $other_expenses - $pay_tax_entries - $year_tax_security + $utility_net;
        $pasive_patrim   = $pasives + $patrimony_net;

        $situationstate[] = array('id' => 1, 'item' => '<strong>ACTIVOS</strong>', 'subtotal' => '', 'total' => '<strong>'.number_format(floor($actives*100)/100, 2, '.', ',').'</strong>');
        $situationstate[] = array('id' => 2, 'item' => '- Activo Circulante', 'subtotal' => '', 'total' => number_format(floor($cash*100)/100, 2, '.', ','));
        $situationstate[] = array('id' => 3, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Efectivo en Caja</strong>', 'subtotal' => number_format(floor($cash_box*100)/100, 2, '.', ','), 'total' => '');
        $situationstate[] = array('id' => 4, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Efectivo en Banco</strong>', 'subtotal' => number_format(floor($cash_bank*100)/100, 2, '.', ','), 'total' => '');
        $situationstate[] = array('id' => 5, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Cuentas por Cobrar</strong>', 'subtotal' => number_format(floor($acc_receiv*100)/100, 2, '.', ','), 'total' => '');
        $situationstate[] = array('id' => 6, 'item' => '- Activos Fijos Tangibles Neto', 'subtotal' => '', 'total' => number_format(floor($aft_net*100)/100, 2, '.', ','));
        $situationstate[] = array('id' => 7, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Edificaciones, Muebles y Equipos</strong>', 'subtotal' => number_format(floor($aft_edmueq*100)/100, 2, '.', ','), 'total' => '');
        $situationstate[] = array('id' => 8, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; (MENOS:) Depreciaci&oacute;n Acumulada</strong>', 'subtotal' => number_format(floor($aft_deprec*100)/100, 2, '.', ','), 'total' => '');
        //$situationstate[] = array('id' => 9, 'item' => 'Total Activos', 'subtotal' => '', 'total' => number_format($actives, 2, '.', ','));
        $situationstate[] = array('id' => 10, 'item' => '<strong>PASIVOS</strong>', 'subtotal' => '', 'total' => '<strong>'.number_format(floor($pasives*100)/100, 2, '.', ',').'</strong>');
        $situationstate[] = array('id' => 11, 'item' => '- Pasivos Circulante', 'subtotal' => '', 'total' => number_format(floor($pasives_circ*100)/100, 2, '.', ','));
        $situationstate[] = array('id' => 12, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Tasas, Impuestos y Contribuciones por pagar', 'subtotal' => number_format(floor($debt*100)/100, 2, '.', ','), 'total' => '');
        $situationstate[] = array('id' => 13, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Obligaciones Bancarias a Corto Plazo', 'subtotal' => number_format(floor($bank_oblig_short*100)/100, 2, '.', ','), 'total' => '');
        $situationstate[] = array('id' => 14, 'item' => '- Pasivos a Largo Plazo', 'subtotal' => '', 'total' => number_format($pasives_long, 2, '.', ','));
        $situationstate[] = array('id' => 15, 'item' => '&nbsp;&nbsp;&nbsp;&#8226; Obligaciones Bancarias a Largo Plazo', 'subtotal' => number_format(floor($bank_oblig_long*100)/100, 2, '.', ','), 'total' => '');
        //$situationstate[] = array('id' => 16, 'item' => 'Total Pasivos', 'subtotal' => '', 'total' => number_format($pasives, 2, '.', ','));
        $situationstate[] = array('id' => 17, 'item' => '<strong>PATRIMONIO NETO</strong>', 'subtotal' => '', 'total' => '<strong>'.number_format(floor($patrimony_net*100)/100, 2, '.', ',').'</strong>');
        $situationstate[] = array('id' => 18, 'item' => 'Saldo del Patrimonio del TCP al inicio del ejercicio contable', 'subtotal' => number_format(floor($aft_edmueq*100)/100, 2, '.', ','), 'total' => '');
        $situationstate[] = array('id' => 19, 'item' => '(MAS:) Incremento de aportes del TCP en el ejercicio contable', 'subtotal' => number_format(floor($plus_contribution*100)/100, 2, '.', ','), 'total' => '');
        $situationstate[] = array('id' => 20, 'item' => '(MENOS:) Erogaciones efectuadas por el TCP en el ejercicio contable', 'subtotal' => number_format(floor($other_expenses*100)/100, 2, '.', ','), 'total' => '');
        $situationstate[] = array('id' => 21, 'item' => '(MENOS:) Pagos a cuenta de Impuesto sobre Ingresos Personales', 'subtotal' => number_format(floor($pay_tax_entries*100)/100, 2, '.', ','), 'total' => '');
        $situationstate[] = array('id' => 22, 'item' => '(MENOS:) Contribución a la Seguridad Social', 'subtotal' => number_format(floor($year_tax_security*100)/100, 2, '.', ','), 'total' => '');
        $situationstate[] = array('id' => 23, 'item' => '(MAS:) Utilidad Neta en Operaciones', 'subtotal' => number_format(floor($utility_net*100)/100, 2, '.', ','), 'total' => '');
        //$situationstate[] = array('id' => 24, 'item' => 'Total Patrimonio Neto', 'subtotal' => '', 'total' => number_format($patrimony_net, 2, '.', ','));
        $situationstate[] = array('id' => 25, 'item' => '<strong>PASIVO + PATRIMONIO</strong>', 'subtotal' => '', 'total' => '<strong>'.number_format(floor($pasive_patrim*100)/100, 2, '.', ',').'</strong>');
        
        $response = array('success' => true, 'situationstate' => $situationstate);    
        return response()->json($response, 200);
    }

    /**
     * Update TCP Added Liquidation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateModelOption(Request $request)
    {

        if (ModelOption::where('id_tcp', $request->tcp)->where('year', $request->year)->where('model', $request->model)->where('key', $request->key)->exists()){
            ModelOption::where('id_tcp', $request->tcp)->where('year', $request->year)->where('model', $request->model)->where('key', $request->key)->update([
                'value' => str_replace(',', '', $request->value)
            ]);
        }
        else {
            ModelOption::create([
                'id_tcp' => $request->tcp,
                'year' => $request->year,
                'model' => $request->model,
                'key' => $request->key,
                'value' => str_replace(',', '', $request->value)
            ]);
        }

        $response = array('success' => true);    
        return response()->json($response,200);
    }

    /**
     * Export to PDF book of Result States.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfStates(Request $request)
    {
        $year = $request->year;
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
        
        $resultdata = json_decode($request->resultdata);
        $situationdata = json_decode($request->situationdata);

        $pdf = PDF::loadView('pdf.states', compact('tcp', 'obligations', 'year', 'resultdata', 'situationdata'))->setPaper('letter');
        return $pdf->download('Estados Financieros '. $tcp['name']. ' ' . $tcp['last_name'] .' '.date('d-m-Y').'.pdf');
    }
}
