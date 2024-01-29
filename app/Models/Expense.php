<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expenses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tcp', 'date', 'mp_materials', 'goods', 'fuel', 'power', 'salary', 'col7', 'col8', 'col9', 'col10', 'col11', 'col12', 'others', 'lease_state', 'col17', 'col18', 'col19', 'expenses_ncei', 'cash_box', 'cash_bank', 'detail',
    ];
}
