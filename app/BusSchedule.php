<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusSchedule extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'bus_organization_id',
        'bus_route_id',
        'seat_plan_id',
        'bus_id',
        'coach',
        'agent_id',
        'bus_number',
        'charge',
        'total_seat',
        'available_seat',
        'limit',
        'dep_time',
        'arr_time'
    ];


    public function organization()
    {
        return $this->belongsTo('App\BusOrganization', 'bus_organization_id', 'id');
    }

    public function route()
    {
        return $this->belongsTo('App\BusRoute', 'bus_route_id', 'id');
    }

    public function bus()
    {
        return $this->belongsTo('App\Bus', 'bus_id', 'id');
    }

    public function agent()
    {
        return $this->belongsTo('App\Agent', 'agent_id', 'id');
    }

    public function boarding()
    {
        return $this->hasMany('App\BusBordingPoint', 'bus_schedule_id', 'id');
    }

    public function tickets()
    {
        return $this->hasMany('App\BusTicket', 'bus_schedule_id', 'id');
    }
}
