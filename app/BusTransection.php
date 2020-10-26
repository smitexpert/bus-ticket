<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusTransection extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'trxID',
        'bus_ticket_id',
        'discount',
        'service_charge',
        'total',
        'payment_method'
    ];
}
