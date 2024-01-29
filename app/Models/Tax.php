<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = 'tax';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tcp', 'month', 'year', 'workforce', 'documents', 'commercial_ads', 'social_security', 'others', 'restoration_repair', 'monthly_fee',
    ];
}
