<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AftProductsubgroup extends Model
{
    protected $table = 'aft_product_subgroup';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_product', 'id_subgroup',
    ];
}