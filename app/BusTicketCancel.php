<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusTicketCancel extends Model
{
    protected $fillable = [
        'ticket_id',
        'reason'
    ];
}
