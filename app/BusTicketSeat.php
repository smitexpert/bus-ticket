<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusTicketSeat extends Model
{
    protected $fillable = [
        'bus_ticket_id',
        'seat_id'
    ];
}
