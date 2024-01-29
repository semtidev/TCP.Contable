<?php

namespace App\Http\Controllers;

use App\Models\Tcp;
use App\Models\Province;
use App\Models\City;
use App\Models\Obligation;
use App\Models\TcpObligation;
use App\Models\ExpenseColumn;
use App\Models\TcpCashboxStart;
use Illuminate\Http\Request;

class TcpController extends Controller
{
    /**
     * Show the TCP index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tcp = Tcp::all();
        foreach ($tcp as $row) {
            $obligations = TcpObligation::leftJoin('obligations', 'obligations.id', '=', 'tcp_obligations.id_obligation')
                            ->select('obligations.id', 'obligations.obligation')
                            ->where('id_tcp', $row->id)->get();
            $count = 0;
            $combo_obligations = array();
            $html_obligations  = '';
            foreach ($obligations as $obligation) {
                $combo_obligations[] = $obligation->id;
                $html_obligations .= '&nbsp;&nbsp;<i class="fas fa-check"></i> ' . $obligation->obligation . '<br/>';
            }
            $row['obligations'] = $combo_obligations;
            $row['html_obligations'] = $html_obligations;
            
            if ($row['telephone'] == null) {
                $row['telephone'] = '';
            }
            if ($row['email'] == null) {
                $row['email'] = '';
            }
        } 
        
        $response = array('success' => true, 'tcp' => $tcp);     
        return response()->json($response,200);
    }

    /**
     * Get TCP list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tcpList()
    {
        $tcp = array();
        $query = Tcp::select('id', 'name', 'last_name', 'company', 'workers', 'act_desc', 'nit')->get();
        foreach ($query as $row) {
            
            // Cash Start
            $tcp_cashbox_saldstart = '';
            $tcp_cashbox_datestart = '';
            if (TcpCashboxStart::where('id_tcp', $row->id)->exists()){            
                $cash_start = TcpCashboxStart::where('id_tcp', $row->id)->first();
                $tcp_cashbox_saldstart = $cash_start->sald;
                $tcp_cashbox_datestart = $cash_start->date_start;
                $arr_cashbox_datestart = explode('-', $tcp_cashbox_datestart);
                $tcp_cashbox_datestart = $arr_cashbox_datestart[2].'/'.$arr_cashbox_datestart[1].'/'.$arr_cashbox_datestart[0];
            }

            // expenses columns
            if (ExpenseColumn::where('id_tcp', $row->id)->exists())
            {                
                $columns = ExpenseColumn::where('id_tcp', $row->id)->first();
                $tcp[] = array(
                    'id' => $row->id, 
                    'name' => $row->name .' '. $row->last_name, 
                    'company' => $row->company, 
                    'workers' => $row->workers, 
                    'act_desc' => $row->act_desc,
                    'nit' => $row->nit,
                    'tcp_cashbox_saldstart' => $tcp_cashbox_saldstart,
                    'tcp_cashbox_datestart' => $tcp_cashbox_datestart,
                    'col7' => $columns->col7,
                    'col8' => $columns->col8,
                    'col9' => $columns->col9,
                    'col10' => $columns->col10,
                    'col11' => $columns->col11,
                    'col12' => $columns->col12,
                    'col17' => $columns->col17,
                    'col18' => $columns->col18,
                    'col19' => $columns->col19
                );
            }
            else
            {
                $tcp[] = array(
                    'id' => $row->id, 
                    'name' => $row->name .' '. $row->last_name, 
                    'company' => $row->company, 
                    'workers' => $row->workers, 
                    'act_desc' => $row->act_desc,
                    'nit' => $row->nit,
                    'tcp_cashbox_saldstart' => $tcp_cashbox_saldstart,
                    'tcp_cashbox_datestart' => $tcp_cashbox_datestart,
                    'col7' => '',
                    'col8' => '',
                    'col9' => '',
                    'col10' => '',
                    'col11' => '',
                    'col12' => '',
                    'col17' => '',
                    'col18' => '',
                    'col19' => ''
                );
            }
        } 
               
        $response = array('success' => true, 'tcp' => $tcp);     
        return response()->json($response,200);
    }

    /**
     * Get Provinces list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function provincesList()
    {
        $provinces = Province::all();
               
        $response = array('success' => true, 'provinces' => $provinces);     
        return response()->json($response,200);
    }

    /**
     * Get Citties list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function citiesList($province)
    {
        $cities = City::where('id_province', $province)->get();
               
        $response = array('success' => true, 'cities' => $cities);     
        return response()->json($response,200);
    }

    /**
     * Store a TCP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Store TCP
        $tcp = Tcp::create([
            'company' => $request->company,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'ci' => $request->ci,
            'nit' => $request->nit,
            'act_code' => $request->act_code,
            'act_desc' => $request->act_desc,
            'workers' => $request->workers,
            'address' => $request->address,
            'address_company' => $request->address_company,
            'province_company' => $request->province_company,
            'city_company' => $request->city_company,
            'province' => $request->province,
            'city' => $request->city,
            'telephone' => $request->telephone,
            'email' => $request->email
        ]);

        // Store Obligations
        $obligations = explode(',', $request->str_obligations); 
        foreach ($obligations as $key => $value) {
            TcpObligation::create([
                'id_tcp' => $tcp->id,
                'id_obligation' => $value
            ]);
        }

        $response = array('success' => true, 'tcp' => $tcp);        
        return response()->json($response,201);
    }

    /**
     * Update a TCP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Update TCP
        Tcp::find($request->id)->update([
            'company' => $request->company,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'ci' => $request->ci,
            'nit' => $request->nit,
            'act_code' => $request->act_code,
            'act_desc' => $request->act_desc,
            'workers' => $request->workers,
            'address' => $request->address,
            'address_company' => $request->address_company,
            'province_company' => $request->province_company,
            'city_company' => $request->city_company,
            'province' => $request->province,
            'city' => $request->city,
            'telephone' => $request->telephone,
            'email' => $request->email
        ]);

        // Delete previus obligations
        TcpObligation::where('id_tcp', $request->id)->delete();

        // Store Obligations
        $obligations = explode(',', $request->str_obligations); 
        foreach ($obligations as $key => $value) {
            TcpObligation::create([
                'id_tcp' => $request->id,
                'id_obligation' => $value
            ]);
        }

        // Get TCP
        $tcp = Tcp::where('id', $request->id)->first();
        $obligations = TcpObligation::leftJoin('obligations', 'obligations.id', '=', 'tcp_obligations.id_obligation')
                        ->select('obligations.id', 'obligations.obligation')
                        ->where('tcp_obligations.id_tcp', $tcp->id)->get();
        $count = 0;
        $combo_obligations = array();
        $html_obligations  = '';
        foreach ($obligations as $obligation) {
            $combo_obligations[] = $obligation->id;
            $html_obligations .= '&nbsp;&nbsp;<i class="fas fa-check"></i> ' . $obligation->obligation . '<br/>';
        }
        $tcp['html_obligations'] = $html_obligations;
        
        if ($tcp['telephone'] == null) {
            $tcp['telephone'] = '';
        }
        if ($tcp['email'] == null) {
            $tcp['email'] = '';
        }

        $response = array('success' => true, 'tcp' => $tcp);        
        return response()->json($response,200);
    }

    /**
     * Delete a TCP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        // Delete TCP Obligations
        TcpObligation::where('id_tcp', $request->id)->delete();
        // Delete TCP 
        Tcp::where('id', $request->id)->delete();

        $response = array('success' => true);        
        return response()->json($response,200);
    }
}
