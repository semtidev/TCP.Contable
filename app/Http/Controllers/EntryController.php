<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Province;
use App\Models\City;
use App\Models\Tcp;
use App\Models\TcpObligation;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Display a listing of days.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDay($tcp, $month, $year)
    {
        $entryday = array();
        $days_db  = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');

        for ($i=0; $i < date('t', strtotime($year.'-'.$month.'-01')); $i++) { 
            
            $date = $year .'-'. $month .'-'. $days_db[$i];
            if(Entry::where('id_tcp', $tcp)->whereDate('date', $date)->exists()) {
                
                $entry = Entry::where('id_tcp', $tcp)->whereDate('date', $date)->first();
                $entrynet = number_format($entry->cash_box, 2, '.', '') - number_format($entry->cash_ncei, 2, '.', ''); 
                $totalentry = $entry->cash_ncei + $entrynet; 
                $entryday[$i] = array(
                    'id' => $entry->id,
                    'day' => $i + 1, 
                    'id_tcp' => $tcp, 
                    'date' => $entry->date, 
                    'cash_box' => number_format($entry->cash_box, 2, '.', ','), 
                    'cash_ncei'=> number_format($entry->cash_ncei, 2, '.', ','), 
                    'entry' => number_format($entrynet, 2, '.', ','), 
                    'totalentry'=> number_format($totalentry, 2, '.', ','),
                    'detail'=> $entry->detail
                );
            }
            else{
                $entryday[$i] = array(
                    'id' => '',
                    'day' => $i + 1,
                    'id_tcp' => $tcp, 
                    'date' => '', 
                    'cash_box' => '', 
                    'cash_ncei'=> '', 
                    'entry' => '', 
                    'totalentry'=> '', 
                    'detail'=> ''
                );
            }          
        }
        
        $response = array('success' => true, 'entryday' => $entryday);    
        return response()->json($response, 200);
    }

    /**
     * Display a listing of Months.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMonth($tcp, $year)
    {
        $entrymonth = array();
        $months     = array('', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
        $year_total_entry_box  = 0;
        $year_total_entry_ncei = 0;
        $year_total_entry_net  = 0;
        $year_total_entry_full = 0;

        for ($i=1; $i < 13; $i++) { 
            
            if ($i < 10) { $month = '0' . $i; }
            else { $month = $i; }
            $date = $year .'-'. $month .'-01';

            $entry = Entry::select(DB::raw('SUM(cash_box) as total_entry_box'), DB::raw('SUM(cash_ncei) as total_entry_ncei'))
                        ->where('id_tcp', $tcp)
                        ->whereMonth('date', $month)
                        ->whereYear('date', $year)
                        ->first();
            
            $total_entry_box  = floatval($entry->total_entry_box);
            $total_entry_ncei = floatval($entry->total_entry_ncei);
            $total_entry_net  = number_format($total_entry_box, 2, '.', '') - number_format($total_entry_ncei, 2, '.', '');
            $total_entry_full = $total_entry_ncei + $total_entry_net;

            $year_total_entry_box  += $total_entry_box;
            $year_total_entry_ncei += $total_entry_ncei;
            $year_total_entry_net  += $total_entry_net;
            $year_total_entry_full += $total_entry_full;

            $entrymonth[$i - 1] = array(
                'month' => $months[$i],
                'cash_box' => number_format($total_entry_box, 2, '.', ','), 
                'cash_ncei' => number_format($total_entry_ncei, 2, '.', ','),
                'entry' => number_format($total_entry_net, 2, '.', ','),
                'totalentry' => number_format($total_entry_full, 2, '.', ',')
            );
        }

        $entrymonth[12] = array(
            'month' => '<strong>TOTAL</strong>',
            'cash_box' => '<strong>$ ' . number_format($year_total_entry_box, 2, '.', ',') . '</strong>', 
            'cash_ncei' => '<strong>$ ' . number_format($year_total_entry_ncei, 2, '.', ',') . '</strong>',
            'entry' => '<strong>$ ' . number_format($year_total_entry_net, 2, '.', ',') . '</strong>',
            'totalentry' => '<strong>$ ' . number_format($year_total_entry_full, 2, '.', ',') . '</strong>'
        );
        
        $response = array('success' => true, 'entrymonth' => $entrymonth);    
        return response()->json($response, 200);
    }

    /**
     * Store a Entry.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->day < 10){ $date = $request->year . '-' . $request->month . '-0' . $request->day; }
        else { $date = $request->year . '-' . $request->month . '-' . $request->day; }

        $entry = Entry::create([
            'id_tcp' => $request->tcp,
            'date' => $date,
            'cash_box' => floatval(str_replace(',','',$request->cash_box)),
            'cash_ncei' => floatval(str_replace(',','',$request->cash_ncei)),
            'detail' => $request->detail
        ]);

        $response = array('success' => true);    
        return response()->json($response,201);
    }

    /**
     * Update a Entry.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->day < 10){ $date = $request->year . '-' . $request->month . '-0' . $request->day; }
        else { $date = $request->year . '-' . $request->month . '-' . $request->day; }

        $entry = Entry::find($request->id)->update([
            'id_tcp' => $request->tcp,
            'date' => $date,
            'cash_box' => floatval(str_replace(',','',$request->cash_box)),
            'cash_ncei' => floatval(str_replace(',','',$request->cash_ncei)),
            'detail' => $request->detail
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
        Entry::where('id', $request->id)->delete();

        $response = array('success' => true);        
        return response()->json($response,200);
    }

    /**
     * Export to PDF book of Entry.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfEntry($id_tcp, $year)
    {
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
        $entriesmonth = array();
        $days_db  = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
        $monthsname = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        for ($i=0; $i < 12; $i++) { 
            
            if ($i < 9) { $month = '0' . strval($i + 1); }
            else { $month = strval($i + 1); }

            $month_total_entry_box  = 0;
            $month_total_entry_ncei = 0;
            $month_total_entry_net  = 0;
            $month_total_entry_full = 0;

            $entryday = array();
            for ($j=0; $j < date('t', strtotime($year.'-'.$month.'-01')); $j++) { 
            
                $date = $year .'-'. $month .'-'. $days_db[$j];
                if(Entry::where('id_tcp', $id_tcp)->whereDate('date', $date)->exists()) {
                    
                    $entry = Entry::where('id_tcp', $id_tcp)->whereDate('date', $date)->first();
                    $entrynet = number_format($entry->cash_box, 2, '.', '') - number_format($entry->cash_ncei, 2, '.', ''); 
                    $totalentry = $entry->cash_ncei + $entrynet; 
                    $entryday[$j] = array(
                        'id' => $entry->id,
                        'day' => $j + 1, 
                        'id_tcp' => $id_tcp, 
                        'date' => $entry->date, 
                        'cash_box' => number_format($entry->cash_box, 2, '.', ','), 
                        'cash_ncei'=> number_format($entry->cash_ncei, 2, '.', ','), 
                        'entry' => number_format($entrynet, 2, '.', ','), 
                        'totalentry'=> number_format($totalentry, 2, '.', ','), 
                        'detail'=> $entry->detail
                    );

                    $month_total_entry_box  += $entry->cash_box;
                    $month_total_entry_ncei += $entry->cash_ncei;
                    $month_total_entry_net  += number_format($entry->cash_box, 2, '.', '')  - number_format($entry->cash_ncei, 2, '.', '') ;
                    $month_total_entry_full += $entry->cash_box;
                }
                else{
                    $entryday[$j] = array(
                        'id' => '',
                        'day' => $j + 1,
                        'id_tcp' => $id_tcp, 
                        'date' => '', 
                        'cash_box' => '', 
                        'cash_ncei'=> '', 
                        'entry' => '', 
                        'totalentry'=> '', 
                        'detail'=> ''
                    );
                }          
            }

            $entryday[$j + 1] = array(
                'id' => '-1',
                'day' => '<strong>Total</strong>', 
                'id_tcp' => $id_tcp, 
                'date' => '', 
                'cash_box' => '<strong>' . number_format($month_total_entry_box, 2, '.', ',') . '</strong>', 
                'cash_ncei'=> '<strong>' . number_format($month_total_entry_ncei, 2, '.', ',') . '</strong>', 
                'entry' => '<strong>' . number_format($month_total_entry_net, 2, '.', ',') . '</strong>', 
                'totalentry'=> '<strong>' . number_format($month_total_entry_full, 2, '.', ',') . '</strong>', 
                'detail'=> ''
            );

            $entriesmonth[$monthsname[$i]] = $entryday;
        }
        
        // Año
        $entryear = array();
        $months   = array('', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
        $year_total_entry_box  = 0;
        $year_total_entry_ncei = 0;
        $year_total_entry_net  = 0;
        $year_total_entry_full = 0;

        for ($i=1; $i < 13; $i++) { 
            
            if ($i < 10) { $month = '0' . $i; }
            else { $month = $i; }
            $date = $year .'-'. $month .'-01';

            $entry = Entry::select(DB::raw('SUM(cash_box) as total_entry_box'), DB::raw('SUM(cash_ncei) as total_entry_ncei'))
                        ->where('id_tcp', $id_tcp)
                        ->whereMonth('date', $month)
                        ->whereYear('date', $year)
                        ->first();
            
            $total_entry_box  = floatval($entry->total_entry_box);
            $total_entry_ncei = floatval($entry->total_entry_ncei);
            $total_entry_net  = number_format($total_entry_box, 2, '.', '') - number_format($total_entry_ncei, 2, '.', '');
            $total_entry_full = $total_entry_ncei + $total_entry_net;

            $year_total_entry_box  += $total_entry_box;
            $year_total_entry_ncei += $total_entry_ncei;
            $year_total_entry_net  += $total_entry_net;
            $year_total_entry_full += $total_entry_full;

            $entryear[$i - 1] = array(
                'month' => $months[$i],
                'cash_box' => number_format($total_entry_box, 2, '.', ','), 
                'cash_ncei' => number_format($total_entry_ncei, 2, '.', ','),
                'entry' => number_format($total_entry_net, 2, '.', ','),
                'totalentry' => number_format($total_entry_full, 2, '.', ',')
            );
        }

        $entryear[12] = array(
            'month' => '<strong>TOTAL</strong>',
            'cash_box' => '<strong>$ ' . number_format($year_total_entry_box, 2, '.', ',') . '</strong>', 
            'cash_ncei' => '<strong>$ ' . number_format($year_total_entry_ncei, 2, '.', ',') . '</strong>',
            'entry' => '<strong>$ ' . number_format($year_total_entry_net, 2, '.', ',') . '</strong>',
            'totalentry' => '<strong>$ ' . number_format($year_total_entry_full, 2, '.', ',') . '</strong>'
        );
        
        $pdf = PDF::loadView('pdf.entries', compact('tcp', 'year', 'obligations', 'entriesmonth', 'entryear'))->setPaper('letter');
        return $pdf->download('Registro Ingresos '. $tcp['name']. ' ' . $tcp['last_name'] .' '.date('d-m-Y').'.pdf');
    }
}
