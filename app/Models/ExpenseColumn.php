<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseColumn extends Model
{
    protected $table = 'expenses_columns';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tcp', 'col7', 'col8', 'col9', 'col10', 'col11', 'col12', 'col17', 'col18', 'col9',
    ];
}
