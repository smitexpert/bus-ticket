<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectTicket extends Model
{
    protected $fillable = [
        'seat',
        'bus_schedule_id',
        'date',
        'time'
    ];
}
