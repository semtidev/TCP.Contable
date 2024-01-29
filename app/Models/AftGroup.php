<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AftGroup extends Model
{
    protected $table = 'aft_groups';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'desc',
    ];
}
