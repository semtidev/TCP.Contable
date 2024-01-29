<?php

namespace App\Http\Controllers;

use App\Models\Tcp;
use App\Models\Province;
use App\Models\City;
use App\Models\TcpObligation;
use App\Models\Tax;
use App\Models\AftProduct;
use App\Models\Entry;
use App\Models\Expense;
use App\Models\ModelOption;
use App\Models\Account;
use App\Models\Subaccount;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * Export to PDF book of Receipts.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfReceipts(Request $request)
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

        // Accounts
        $accounts = array();
        $qry_accounts = Account::all();
        foreach ($qry_accounts as $value_account) {
            $accounts[$value_account->desc] = $value_account->code;
        }

        // SubAccounts
        $subaccounts = array();
        $qry_subaccounts = Subaccount::all();
        foreach ($qry_subaccounts as $value_subaccount) {
            $subaccounts[$value_subaccount->desc] = $value_subaccount->code;
        }

        $obligations = TcpObligation::leftJoin('obligations', 'obligations.id', '=', 'tcp_obligations.id_obligation')
                        ->select('obligations.obligation', 'obligations.code')
                        ->where('tcp_obligations.id_tcp', $tcp->id)->get();
        
        // RANGE MONTH
        if ($request->range == 'cmonth') {
            
            $month = $request->month;

            // INVENTORY INPUTS
            $expense = Expense::select(DB::raw('SUM(mp_materials) as mp_materials'), DB::raw('SUM(power) as power'), DB::raw('SUM(col7) as col7'), DB::raw('SUM(col8) as col8'), DB::raw('SUM(col9) as col9'), DB::raw('SUM(col10) as col10'), DB::raw('SUM(col11) as col11'), DB::raw('SUM(col12) as col12'), DB::raw('SUM(salary) as salary'))
                        ->where('id_tcp', $request->id_tcp)
                        ->whereMonth('date', $request->month)
                        ->whereYear('date', $request->year)
                        ->first();
            $inventory_inputs = number_format($expense->mp_materials, 2, '.', ',');

            // AFT
            $atf_edmueq = 0;
            $atf_deprec = 0;
            $aft = AftProduct::leftJoin('aft_groups', 'aft_groups.id', '=', 'aft_products.id_group')
                            ->select('aft_products.import', 'aft_products.pay_date', 'aft_products.live_year', 'aft_products.dep_year', 'aft_products.dep_month')
                            ->where('aft_products.id_tcp', $request->id_tcp)
                            ->get();        
            foreach ($aft as $row) {
                $atf_edmueq += $row->import;
                $pay_year     = explode('-', $row->pay_date);
                $current_year = $request->year;
                $current_live = $row->live_year - ($current_year - $pay_year[0]);
                $row['current_live'] = $current_live;
                if ($current_live < 1) {
                    $row['dep_month'] = $row->import;
                }
                $atf_deprec += $row['dep_month'];
            }
            $atf_edmueq = number_format($atf_edmueq, 2, '.', ',');
            $atf_deprec = number_format($atf_deprec, 2, '.', ',');

            // BANK CASH
            $bank_cash = ModelOption::select(DB::raw('SUM(value) as value'))
                            ->where('id_tcp', $request->id_tcp)
                            ->where('model', 'regcash')
                            ->where('key', 'bank_deposit')
                            ->whereMonth('date', $request->month)
                            ->whereYear('date', $request->year)
                            ->first()->value;
            $bank_cash = number_format($bank_cash, 2, '.', ',');               
            
            // BOX CASH
            $box_cash = Entry::select(DB::raw('SUM(cash_box) as cash_box'))
                            ->where('id_tcp', $request->id_tcp)
                            ->whereMonth('date', $request->month)
                            ->whereYear('date', $request->year)
                            ->first()->cash_box;
            $box_cash = number_format($box_cash, 2, '.', ',');
            
            // SERVICES EXPENSES CASH
            $power = $expense->power;
            $other_expenses = $expense->col7 + $expense->col8 + $expense->col9 + $expense->col10 + $expense->col11 + $expense->col12;
            $services_expenses = number_format($power + $other_expenses, 2, '.', ',');
            $power = number_format($power, 2, '.', ',');
            $other_expenses = number_format($other_expenses, 2, '.', ',');

            // TAX ONAT
            $tax = Tax::select(DB::raw('SUM(workforce) as workforce'), DB::raw('SUM(documents) as documents'), DB::raw('SUM(commercial_ads) as commercial_ads'), DB::raw('SUM(others) as others'), DB::raw('SUM(restoration_repair) as restoration_repair'), DB::raw('SUM(social_security) as social_security'), DB::raw('SUM(monthly_fee) as monthly_fee'))
                        ->where('id_tcp', $request->id_tcp)
                        ->where('month', intval($request->month))
                        ->where('year', $request->year)
                        ->first();
            $cash_box = Entry::select(DB::raw('SUM(cash_box) as total_cash_box'))
                        ->where('id_tcp', $request->id_tcp)
                        ->whereMonth('date', $request->month)
                        ->whereYear('date', $request->year)
                        ->first()->total_cash_box;
            if ($cash_box == 0) { $sales_services = 0; }
            else { $sales_services = ($cash_box * 10) / 100; }

            $other_tax = $tax->workforce + $tax->documents + $tax->commercial_ads + $tax->others + $tax->restoration_repair;
            $tax_onat = number_format($sales_services + $other_tax, 2, '.', ',');
            $sales_services = number_format($sales_services, 2, '.', ',');
            $other_tax = number_format($other_tax, 2, '.', ',');

            // TAX PERONSAL ENTRIES
            $tax_security = $tax->social_security;
            $tax_mfee = $tax->monthly_fee;
            $tax_personal_entries = number_format($tax_security + $tax_mfee, 2, '.', ',');
            $tax_security = number_format($tax_security, 2, '.', ',');
            $tax_mfee = number_format($tax_mfee, 2, '.', ',');

            // SALARY WORKERS
            $salary_workers = number_format($expense->salary, 2, '.', ',');

            // TCP OTHER EXPENSES
            if (ModelOption::where('id_tcp', $request->id_tcp)->where('year', $request->year)->where('model', 'states')->where('key', 'other_expenses')->exists()){
                $model_option = ModelOption::where('id_tcp', $request->id_tcp)
                                            ->where('year', $request->year)
                                            ->where('model', 'states')
                                            ->where('key', 'other_expenses')
                                            ->first();
                $erogation_tcp = $model_option->value;
            }
            else {
                $erogation_tcp = 0;
            }
            $erogation_tcp = number_format($erogation_tcp, 2, '.', ',');

            // TCP PUS CONTRIBUTION
            if (ModelOption::where('id_tcp', $request->id_tcp)->where('year', $request->year)->where('model', 'states')->where('key', 'plus_contribution')->exists()){
                $model_option = ModelOption::where('id_tcp', $request->id_tcp)
                                            ->where('year', $request->year)
                                            ->where('model', 'states')
                                            ->where('key', 'plus_contribution')
                                            ->first();
                $plus_contribution = $model_option->value;
            }
            else {
                $plus_contribution = 0;
            }
            $plus_contribution = number_format($plus_contribution, 2, '.', ',');

            if ($request->receipt_bank_yes && $request->receipt_bank_yes == 'on') {
                $mpm = number_format($request->mpm, 2, '.', ',');
            }
            else {
                $mpm = null;
            }

        }
        else {
            
            $month = 'all';

            // INVENTORY INPUTS
            $expense = Expense::select(DB::raw('SUM(mp_materials) as mp_materials'), DB::raw('SUM(power) as power'), DB::raw('SUM(col7) as col7'), DB::raw('SUM(col8) as col8'), DB::raw('SUM(col9) as col9'), DB::raw('SUM(col10) as col10'), DB::raw('SUM(col11) as col11'), DB::raw('SUM(col12) as col12'), DB::raw('SUM(salary) as salary'))
                        ->where('id_tcp', $request->id_tcp)
                        ->whereYear('date', $request->year)
                        ->first();
            $inventory_inputs = number_format($expense->mp_materials, 2, '.', ',');

            // AFT
            $atf_edmueq = 0;
            $atf_deprec = 0;
            $aft = AftProduct::leftJoin('aft_groups', 'aft_groups.id', '=', 'aft_products.id_group')
                            ->select('aft_products.import', 'aft_products.pay_date', 'aft_products.live_year', 'aft_products.dep_year', 'aft_products.dep_month')
                            ->where('aft_products.id_tcp', $request->id_tcp)
                            ->get();        
            foreach ($aft as $row) {
                $atf_edmueq += $row->import;
                $pay_year     = explode('-', $row->pay_date);
                $current_year = $request->year;
                $current_live = $row->live_year - ($current_year - $pay_year[0]);
                $row['current_live'] = $current_live;
                if ($current_live < 1) {
                    $row['dep_month'] = $row->import;
                }
                $atf_deprec += $row['dep_month'];
            }
            $atf_edmueq = number_format($atf_edmueq, 2, '.', ',');
            $atf_deprec = number_format($atf_deprec, 2, '.', ',');

            // BANK CASH
            $bank_cash = ModelOption::select(DB::raw('SUM(value) as value'))
                            ->where('id_tcp', $request->id_tcp)
                            ->where('model', 'regcash')
                            ->where('key', 'bank_deposit')
                            ->whereYear('date', $request->year)
                            ->first()->value;
            $bank_cash = number_format($bank_cash, 2, '.', ',');               
            
            // BOX CASH
            $box_cash = Entry::select(DB::raw('SUM(cash_box) as cash_box'))
                            ->where('id_tcp', $request->id_tcp)
                            ->whereYear('date', $request->year)
                            ->first()->cash_box;
            $box_cash = number_format($box_cash, 2, '.', ',');
            
            // SERVICES EXPENSES CASH
            $power = $expense->power;
            $other_expenses = $expense->col7 + $expense->col8 + $expense->col9 + $expense->col10 + $expense->col11 + $expense->col12;
            $services_expenses = number_format($power + $other_expenses, 2, '.', ',');
            $power = number_format($power, 2, '.', ',');
            $other_expenses = number_format($other_expenses, 2, '.', ',');

            // TAX ONAT
            $tax = Tax::select(DB::raw('SUM(workforce) as workforce'), DB::raw('SUM(documents) as documents'), DB::raw('SUM(commercial_ads) as commercial_ads'), DB::raw('SUM(others) as others'), DB::raw('SUM(restoration_repair) as restoration_repair'), DB::raw('SUM(social_security) as social_security'), DB::raw('SUM(monthly_fee) as monthly_fee'))
                        ->where('id_tcp', $request->id_tcp)
                        ->where('year', $request->year)
                        ->first();
            $cash_box = Entry::select(DB::raw('SUM(cash_box) as total_cash_box'))
                        ->where('id_tcp', $request->id_tcp)
                        ->whereYear('date', $request->year)
                        ->first()->total_cash_box;
            if ($cash_box == 0) { $sales_services = 0; }
            else { $sales_services = ($cash_box * 10) / 100; }

            $other_tax = $tax->workforce + $tax->documents + $tax->commercial_ads + $tax->others + $tax->restoration_repair;
            $tax_onat = number_format($sales_services + $other_tax, 2, '.', ',');
            $sales_services = number_format($sales_services, 2, '.', ',');
            $other_tax = number_format($other_tax, 2, '.', ',');

            // TAX PERONSAL ENTRIES
            $tax_security = $tax->social_security;
            $tax_mfee = $tax->monthly_fee;
            $tax_personal_entries = number_format($tax_security + $tax_mfee, 2, '.', ',');
            $tax_security = number_format($tax_security, 2, '.', ',');
            $tax_mfee = number_format($tax_mfee, 2, '.', ',');

            // SALARY WORKERS
            $salary_workers = number_format($expense->salary, 2, '.', ',');

            // TCP OTHER EXPENSES
            if (ModelOption::where('id_tcp', $request->id_tcp)->where('year', $request->year)->where('model', 'states')->where('key', 'other_expenses')->exists()){
                $model_option = ModelOption::where('id_tcp', $request->id_tcp)
                                            ->where('year', $request->year)
                                            ->where('model', 'states')
                                            ->where('key', 'other_expenses')
                                            ->first();
                $erogation_tcp = $model_option->value;
            }
            else {
                $erogation_tcp = 0;
            }
            $erogation_tcp = number_format($erogation_tcp, 2, '.', ',');

            // TCP PUS CONTRIBUTION
            if (ModelOption::where('id_tcp', $request->id_tcp)->where('year', $request->year)->where('model', 'states')->where('key', 'plus_contribution')->exists()){
                $model_option = ModelOption::where('id_tcp', $request->id_tcp)
                                            ->where('year', $request->year)
                                            ->where('model', 'states')
                                            ->where('key', 'plus_contribution')
                                            ->first();
                $plus_contribution = $model_option->value;
            }
            else {
                $plus_contribution = 0;
            }
            $plus_contribution = number_format($plus_contribution, 2, '.', ',');

            if ($request->receipt_bank_yes && $request->receipt_bank_yes == 'on') {
                $mpm = number_format($request->mpm, 2, '.', ',');
            }
            else {
                $mpm = null;
            }

        }
        
        $pdf = PDF::loadView('pdf.receipts', compact('tcp', 'obligations', 'month', 'year', 'accounts', 'subaccounts', 'inventory_inputs', 'atf_edmueq', 'bank_cash', 'box_cash', 'power', 'other_expenses', 'services_expenses', 'sales_services', 'other_tax', 'tax_onat', 'tax_security', 'tax_mfee', 'tax_personal_entries', 'salary_workers', 'atf_deprec', 'erogation_tcp', 'plus_contribution', 'mpm'))->setPaper('letter');
        return $pdf->download('Comprobantes ' . $tcp['name']. ' ' . $tcp['last_name'] . ' ' . date('d-m-Y').'.pdf');
    }
    
    /**
     * Export to PDF book of Receipts.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfPurchaseReceipts($id_tcp)
    {
        $tcp = Tcp::where('id', $id_tcp)->first();
        $pdf = PDF::loadView('pdf.receipts_purchase', compact('tcp'))->setPaper('letter');
        return $pdf->download('Comprobantes de Compra ' .$tcp['name']. ' ' . $tcp['last_name'] .'.pdf');
    }
}
