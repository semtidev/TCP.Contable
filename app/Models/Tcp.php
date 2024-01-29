<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tcp extends Model
{
    protected $table = 'tcp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company', 'name', 'last_name', 'ci', 'nit', 'act_code', 'act_desc', 'workers', 'address', 'address_company', 'province_company', 'city_company', 'province', 'city', 'telephone', 'email',
    ];
}
