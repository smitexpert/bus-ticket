<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'model',
        'class',
        'bus_organization_id',
        'bus_seat_plan_id'
    ];

    public function organization()
    {
        return $this->belongsTo('App\BusOrganization', 'bus_organization_id', 'id');
    }

    public function seatplan()
    {
        return $this->belongsTo('App\BusSeatPlan', 'bus_seat_plan_id', 'id');
    }

    public function clases()
    {
        return $this->belongsTo('App\BusClass', 'class', 'id');
    }
}
