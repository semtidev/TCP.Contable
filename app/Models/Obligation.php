<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obligation extends Model
{
    protected $table = 'obligations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'obligation', 'code',
    ];
}
