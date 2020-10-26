<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusTicket extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'ticket_no',
        'bus_schedule_id',
        'bus_boarding_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'gender',
        'payment_method',
        'total_seat',
        'seat_charge',
        'date',
        'status'
    ];

    public function ticket_seat()
    {
        return $this->hasMany('App\BusTicketSeat', 'bus_ticket_id', 'id');
    }

    public function schedule()
    {
        return $this->belongsTo('App\BusSchedule', 'bus_schedule_id', 'id');
    }

    public function boarding()
    {
        return $this->belongsTo('App\BusBordingPoint', 'bus_schedule_id', 'bus_schedule_id');
    }

    public function cancel()
    {
        return $this->hasOne('App\BusTicketCancel', 'ticket_id', 'id');
    }

    public function transection()
    {
        return $this->hasOne('App\BusTransection', 'bus_ticket_id', 'id');
    }
}
