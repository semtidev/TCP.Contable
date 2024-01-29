<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AftSubgroup extends Model
{
    protected $table = 'aft_subgroups';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_group', 'name',
    ];
}