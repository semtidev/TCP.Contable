<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashBank extends Model
{
    protected $table = 'cash_bank';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tcp', 'date', 'desc', 'debit', 'credit', 'sald',
    ];
}
