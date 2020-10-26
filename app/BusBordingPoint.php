<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusBordingPoint extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'bus_schedule_id',
        'bus_counter_id',
        'arr_time'
    ];

    public function counter()
    {
        return $this->belongsTo('App\BusCounter', 'bus_counter_id', 'id');
    }

    public function schedule()
    {
        return $this->belongsTo('App\BusSchedule', 'bus_schedule_id', 'id')->orderBy('dep_time');;
    }

    public function tickets()
    {
        return $this->hasMany('App\BusTicket', 'bus_boarding_id', 'id');
    }
}
