<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AftProduct extends Model
{
    protected $table = 'aft_products';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tcp', 'id_group', 'product', 'um', 'ctdad', 'price', 'import', 'pay_date', 'live_year', 'dep_year', 'dep_month',
    ];
}
