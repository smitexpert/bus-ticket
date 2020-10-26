<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusRoute extends Model
{
    protected $fillable = [
        'from',
        'to',
        'bus_organization_id'
    ];

    public function from_city()
    {
        return $this->belongsTo('App\District', 'from', 'id');
    }

    public function to_city()
    {
        return $this->belongsTo('App\District', 'to', 'id');
    }

    public function organization()
    {
        return $this->belongsTo('App\BusOrganization', 'bus_organization_id', 'id');
    }

    public function schedules()
    {
        return $this->hasMany('App\BusSchedule', 'bus_route_id', 'id')->orderBy('dep_time');
    }
}
