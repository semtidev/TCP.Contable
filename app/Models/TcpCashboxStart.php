<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TcpCashboxStart extends Model
{
    protected $table = 'tcp_startsald_cashbox';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tcp', 'date_start', 'sald',
    ];
}
