<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TcpObligation extends Model
{
    protected $table = 'tcp_obligations';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tcp', 'id_obligation',
    ];
}
