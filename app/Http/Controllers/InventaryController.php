<?php

namespace App\Http\Controllers;

use App\Models\Tcp;
use App\Models\AftGroup;
use App\Models\AftSubgroup;
use App\Models\AftProduct;
use App\Models\AftProductsubgroup;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class InventaryController extends Controller
{
    /**
     * Show the ATF index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($tcp)
    {
        $aft = AftProduct::leftJoin('aft_groups', 'aft_groups.id', '=', 'aft_products.id_group')
                ->select('aft_groups.code', 'aft_groups.desc', 'aft_products.id', 'aft_products.product', 'aft_products.um', 'aft_products.ctdad', 'aft_products.price', 'aft_products.import', 'aft_products.pay_date', 'aft_products.live_year', 'aft_products.dep_year', 'aft_products.dep_month')
                ->where('aft_products.id_tcp', $tcp)
                ->get();
        
        $counter = 0;
        foreach ($aft as $row) {
            
            if (AftProductsubgroup::where('id_product', $row->id)->exists()) {
                $subgroup = AftProductsubgroup::where('id_product', $row->id)->first();
                $subgroup_name = AftSubgroup::where('id', $subgroup->id_subgroup)->first()->name;
                $row['form_group'] = $row->code . ' ' . $row->desc .' ('. $subgroup_name .')';
            }
            else{
                $row['form_group'] = $row->code . ' ' . $row->desc;
            }          

            $row['group'] = 'Grupo ' . $row->code . ': ' . $row->desc;
            $pay_year     = explode('-', $row->pay_date);
            $current_year = date('Y');
            $current_live = $row->live_year - ($current_year - $pay_year[0]);
            $row['current_live'] = number_format($current_live, 2, '.', ',');
            if ($current_live < 1) {
                $row['dep_year']  = $row->import;
                $row['dep_month'] = $row->import; 
            }
        } 
        
        $response = array('success' => true, 'aft' => $aft);     
        return response()->json($response,200);
    }

    /**
     * Get AFT Groups list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function aftgroupList()
    {
        $id = 0;
        $aftgroup = array();
        $query = AftGroup::select('id', 'code', 'desc')->get();
        foreach ($query as $row) {
            if ($row->code == '001') {
                $subgroups = AftSubgroup::where('id_group', $row->id)->get();
                foreach ($subgroups as $subgroup) {
                    $id++;
                    $aftgroup[] = array(
                        'id' => $id,
                        'id_group' => $row->id,
                        'group' => $row->code . ' ' . $row->desc .' ('. $subgroup->name .')'
                    );
                }
            }
            else {
                $id++;
                $aftgroup[] = array(
                    'id' => $id,
                    'id_group' => $row->id, 
                    'group' => $row->code . ' ' . $row->desc
                );
            }            
        }
              
        $response = array('success' => true, 'aftgroup' => $aftgroup);
        return response()->json($response,200);
    }

    /**
     * Store a AFT.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ctdad     = intval($request->ctdad);
        $price     = floatval($request->price);
        $import    = $ctdad * $price;
        $arr_group = explode(' ', $request->form_group);
        $id_subgroup = '';
        if ($arr_group[0] == '001' && $arr_group[2] == '(Madera/Plástico)') {
            $live_year = 16.6;
            $dep_year  = ($import * 6) / 100;
            $id_subgroup = AftSubgroup::where('name', substr($arr_group[2],1,-1))->first()->id;
        }
        elseif ($arr_group[0] == '001' && $arr_group[2] == '(Hormigón/Hierro)') {
            $live_year = 33.3;
            $dep_year  = ($import * 3) / 100;
            $id_subgroup = AftSubgroup::where('name', substr($arr_group[2],1,-1))->first()->id;
        }
        else{
            $live_year = 10;
            $dep_year  = ($import * 10) / 100;
        }
        $dep_month = $dep_year / 12;
        $id_group  = AftGroup::where('code', $arr_group[0])->first()->id;

        // Store AFT
        $aft = AftProduct::create([
            'id_tcp' => $request->tcp,
            'id_group' => $id_group,
            'product' => $request->product,
            'um' => 'U',
            'ctdad' => $ctdad,
            'price' => number_format($price, 2, '.', ''),
            'import' => number_format($import, 2, '.', ''),
            'pay_date' => $request->pay_date,
            'live_year' => $live_year,
            'dep_year' => number_format($dep_year, 2, '.', ''),
            'dep_month' => number_format($dep_month, 2, '.', '')
        ]);

        // Aft Subgroup
        if ($id_subgroup != '') {
            AftProductsubgroup::create([
                'id_product' => $aft->id,
                'id_subgroup' => $id_subgroup
            ]);
        }

        $response = array('success' => true, 'aft' => $aft);        
        return response()->json($response,201);
    }

    /**
     * Update a AFT.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $ctdad     = intval($request->ctdad);
        $price     = floatval($request->price);
        $import    = $ctdad * $price;
        $arr_group = explode(' ', $request->form_group);
        $id_subgroup = '';
        if ($arr_group[0] == '001' && $arr_group[2] == '(Madera/Plástico)') {
            $live_year = 16.6;
            $dep_year  = ($import * 6) / 100;
            $id_subgroup = AftSubgroup::where('name', substr($arr_group[2],1,-1))->first()->id;
        }
        elseif ($arr_group[0] == '001' && $arr_group[2] == '(Hormigón/Hierro)') {
            $live_year = 33.3;
            $dep_year  = ($import * 3) / 100;
            $id_subgroup = AftSubgroup::where('name', substr($arr_group[2],1,-1))->first()->id;
        }
        else{
            $live_year = 10;
            $dep_year  = ($import * 10) / 100;
        }
        $dep_month = $dep_year / 12;
        $id_group  = AftGroup::where('code', $arr_group[0])->first()->id;

        // Update AFT
        AftProduct::find($request->id)->update([
            'id_group' => $id_group,
            'product' => $request->product,
            'um' => 'U',
            'ctdad' => $ctdad,
            'price' => number_format($price, 2, '.', ''),
            'import' => number_format($import, 2, '.', ''),
            'pay_date' => $request->pay_date,
            'live_year' => $live_year,
            'dep_year' => number_format($dep_year, 2, '.', ''),
            'dep_month' => number_format($dep_month, 2, '.', '')
        ]);

        // Aft Subgroup
        AftProductsubgroup::where('id_product', $request->id)->delete();
        if ($id_subgroup != '') {
            $aft_id = AftProduct::where('id', $request->id)->first()->id;
            AftProductsubgroup::create([
                'id_product' => $aft_id,
                'id_subgroup' => $id_subgroup
            ]);
        }

        $response = array('success' => true);        
        return response()->json($response,200);
    }

    /**
     * Delete a AFT.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        // Delete AFT 
        AftProduct::where('id', $request->id)->delete();

        $response = array('success' => true);        
        return response()->json($response,200);
    }

    /**
     * Export to PDF a listing of AFT.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfAft($id_tcp)
    {
        $tcp = Tcp::where('id', $id_tcp)->select('company', 'name', 'last_name')->first();
        $company = $tcp->company;
        $tcp_name = $tcp->name .' '. $tcp->last_name;

        $productgroups = AftProduct::select('id_group')
                            ->where('id_tcp', $id_tcp)
                            ->distinct()
                            ->orderby('id_group', 'ASC')
                            ->get();
        
        $groups = array();
        foreach ($productgroups as $productgroup) {
            $group = AftGroup::where('id', $productgroup->id_group)->first();
            $groups[$productgroup->id_group] = $group->code .': '. $group->desc;
        }

        $aft = AftProduct::leftJoin('aft_groups', 'aft_groups.id', '=', 'aft_products.id_group')
                    ->select('aft_groups.code', 'aft_groups.desc', 'aft_products.id', 'aft_products.id_group', 'aft_products.product', 'aft_products.um', 'aft_products.ctdad', 'aft_products.price', 'aft_products.import', 'aft_products.pay_date', 'aft_products.live_year', 'aft_products.dep_year', 'aft_products.dep_month')
                    ->where('aft_products.id_tcp', $id_tcp)
                    ->get();
        
        $counter = 0;
        foreach ($aft as $row) {
            
            if (AftProductsubgroup::where('id_product', $row->id)->exists()) {
                $subgroup = AftProductsubgroup::where('id_product', $row->id)->first();
                $subgroup_name = AftSubgroup::where('id', $subgroup->id_subgroup)->first()->name;
                $row['form_group'] = $row->code . ' ' . $row->desc .' ('. $subgroup_name .')';
            }
            else{
                $row['form_group'] = $row->code . ' ' . $row->desc;
            }          

            $row['group'] = 'Grupo ' . $row->code . ': ' . $row->desc;
            $pay_year     = explode('-', $row->pay_date);
            $current_year = date('Y');
            $current_live = $row->live_year - ($current_year - $pay_year[0]);
            $row['current_live'] = $current_live;
            if ($current_live < 1) {
                $row['dep_year']  = $row->import;
                $row['dep_month'] = $row->import; 
            }
        }

        $pdf = PDF::loadView('pdf.aft', compact('company', 'tcp_name', 'groups', 'aft'))->setPaper('letter');;
        return $pdf->download('Patrimonio '. $tcp['name']. ' ' . $tcp['last_name'] .' '.date('d-m-Y').'.pdf');
    }
}
