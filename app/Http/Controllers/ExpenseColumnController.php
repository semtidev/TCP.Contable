<?php

namespace App\Http\Controllers;

use App\Models\ExpenseColumn;
use Illuminate\Http\Request;

class ExpenseColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tcp)
    {
        $columns = array();
        if (ExpenseColumn::where('id_tcp', $tcp)->exists()) {
            $columns_db = ExpenseColumn::where('id_tcp', $tcp)->first();
            $col7  = $columns_db->col7;
            $col8  = $columns_db->col8;
            $col9  = $columns_db->col9;
            $col10 = $columns_db->col10;
            $col11 = $columns_db->col11;
            $col12 = $columns_db->col12;
            $col17 = $columns_db->col17;
            $col18 = $columns_db->col18;
            $col19 = $columns_db->col19;
        }
        else {
            $tcp   = '';
            $col7  = '';
            $col8  = '';
            $col9  = '';
            $col10 = '';
            $col11 = '';
            $col12 = '';
            $col17 = '';
            $col18 = '';
            $col19 = '';
        }
        
        $columns[0] = array('id' => 1, 'tcp' => $tcp, 'column' => 'Columna-7', 'value' => $col7);
        $columns[1] = array('id' => 2, 'tcp' => $tcp, 'column' => 'Columna-8', 'value' => $col8);
        $columns[2] = array('id' => 3, 'tcp' => $tcp, 'column' => 'Columna-9', 'value' => $col9);
        $columns[3] = array('id' => 4, 'tcp' => $tcp, 'column' => 'Columna-10', 'value' => $col10);
        $columns[4] = array('id' => 5, 'tcp' => $tcp, 'column' => 'Columna-11', 'value' => $col11);
        $columns[5] = array('id' => 6, 'tcp' => $tcp, 'column' => 'Columna-12', 'value' => $col12);
        $columns[6] = array('id' => 7, 'tcp' => $tcp, 'column' => 'Columna-17', 'value' => $col17);
        $columns[7] = array('id' => 8, 'tcp' => $tcp, 'column' => 'Columna-18', 'value' => $col18);
        $columns[8] = array('id' => 9, 'tcp' => $tcp, 'column' => 'Columna-19', 'value' => $col19);

        $response = array('success' => true, 'columns' => $columns);
        return response()->json($response,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch ($request->column) {
            case 'Columna-7':
                $field = 'col7';
                break;
            case 'Columna-8':
                $field = 'col8';
                break;
            case 'Columna-9':
                $field = 'col9';
                break;
            case 'Columna-10':
                $field = 'col10';
                break;
            case 'Columna-11':
                $field = 'col11';
                break;
            case 'Columna-12':
                $field = 'col12';
                break;
            case 'Columna-17':
                $field = 'col17';
                break;
            case 'Columna-18':
                $field = 'col18';
                break;
            case 'Columna-19':
                $field = 'col19';
                break;
            default:
                $field = 'col7';
                break;
        }

        // Store Column
        $column = ExpenseColumn::create([
            'id_tcp' => $request->tcp,
            $field => $request->newvalue
        ]);

        $response = array('success' => true, 'column' => $field, 'name' => $request->newvalue);        
        return response()->json($response,201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpenseColumn  $expenseColumn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        switch ($request->column) {
            case 'Columna-7':
                $field = 'col7';
                break;
            case 'Columna-8':
                $field = 'col8';
                break;
            case 'Columna-9':
                $field = 'col9';
                break;
            case 'Columna-10':
                $field = 'col10';
                break;
            case 'Columna-11':
                $field = 'col11';
                break;
            case 'Columna-12':
                $field = 'col12';
                break;
            case 'Columna-17':
                $field = 'col17';
                break;
            case 'Columna-18':
                $field = 'col18';
                break;
            case 'Columna-19':
                $field = 'col19';
                break;
            default:
                $field = 'col7';
                break;
        }

        // Update Column
        ExpenseColumn::where('id_tcp', $request->tcp)->update([
            $field => $request->newvalue
        ]);

        $response = array('success' => true, 'column' => $field, 'name' => $request->newvalue);        
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpenseColumn  $expenseColumn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        switch ($request->column) {
            case 'Columna-7':
                $field = 'col7';
                break;
            case 'Columna-8':
                $field = 'col8';
                break;
            case 'Columna-9':
                $field = 'col9';
                break;
            case 'Columna-10':
                $field = 'col10';
                break;
            case 'Columna-11':
                $field = 'col11';
                break;
            case 'Columna-12':
                $field = 'col12';
                break;
            case 'Columna-17':
                $field = 'col17';
                break;
            case 'Columna-18':
                $field = 'col18';
                break;
            case 'Columna-19':
                $field = 'col19';
                break;
            default:
                $field = 'col7';
                break;
        }
        
        // Delete Column 
        ExpenseColumn::where('id_tcp', $request->tcp)->update([
                $field => ''
            ]);

        $response = array('success' => true, 'column' => $field, 'name' => $request->column);        
        return response()->json($response,200);
    }
}
