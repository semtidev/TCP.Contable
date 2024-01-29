<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Models\Entry;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tcp, $year)
    {
        $taxmonthly = array();
        $months   = array('', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
        
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
            
                $tax       = Tax::where('id_tcp', $tcp)->where('month', $i)->where('year', $year)->first();
                $subtotal  = $sales_services + $tax->workforce + $tax->documents + $tax->commercial_ads + $tax->social_security + $tax->others; 
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
                
                $taxmonthly[$i - 1] = array(
                    'id' => $tax->id,
                    'id_tcp' => $tcp, 
                    'month_num' => $i,
                    'month' => $months[$i],
                    'year' => $year, 
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
                $taxmonthly[$i - 1] = array(
                    'id' => '',
                    'id_tcp' => $tcp, 
                    'month_num' => $i,
                    'month' => $months[$i],
                    'year' => $year, 
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

        $taxmonthly[12] = array(
            'id' => -1,
            'id_tcp' => $tcp, 
            'month_num' => '',
            'month' => '<strong>TOTAL</strong>',
            'year' => $year, 
            'sales_services'=> '<strong>'.number_format($year_sales_services, 2, '.', ',').'</strong>', 
            'workforce' => '<strong>'.number_format($year_workforce, 2, '.', ',').'</strong>',
            'documents'=> '<strong>'.number_format($year_documents, 2, '.', ',').'</strong>',
            'commercial_ads'=> '<strong>'.number_format($year_commercial_ads, 2, '.', ',').'</strong>',
            'social_security'=> '<strong>'.number_format($year_social_security, 2, '.', ',').'</strong>',
            'others'=> '<strong>'.number_format($year_others, 2, '.', ',').'</strong>',
            'subtotal'=> '<strong>'.number_format($year_subtotal, 2, '.', ',').'</strong>',
            'restoration_repair'=> '<strong>'.number_format($year_restoration_repair, 2, '.', ',').'</strong>',
            'monthly_fee'=> '<strong>'.number_format($year_monthly_fee, 2, '.', ',').'</strong>',
            'total_pay'=> '<strong>'.number_format($year_total_pay, 2, '.', ',').'</strong>'
        );
        
        $response = array('success' => true, 'taxmonthly' => $taxmonthly);    
        return response()->json($response, 200);
    }

    /**
     * Store a Tax.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $entry = Tax::create([
            'id_tcp' => $request->tcp,
            'month' => intval($request->month_num),
            'year' => $request->year,
            $request->field => floatval(str_replace(',','',$request->newvalue))
        ]);

        $response = array('success' => true);    
        return response()->json($response,201);
    }

    /**
     * Update a Tax.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $entry = Tax::find($request->id)->update([
            $request->field => floatval(str_replace(',','',$request->newvalue))
        ]);

        $response = array('success' => true);    
        return response()->json($response,201);
    }
}
