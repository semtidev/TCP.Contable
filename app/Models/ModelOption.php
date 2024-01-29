<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelOption extends Model
{
    protected $table = 'model_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tcp', 'date', 'year', 'model', 'key', 'value',
    ];
}
