<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subaccount extends Model
{
    protected $table = 'acnt_subcounts';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_account', 'code', 'desc',
    ];
}
