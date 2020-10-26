<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusCounter extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'bus_organizations_id',
        'agent_id'
    ];

    public function agent()
    {
        return $this->belongsTo('App\Agent', 'agent_id', 'id');
    }

    public function organization()
    {
        return $this->belongsTo('App\BusOrganization', 'bus_organizations_id', 'id');
    }

    public function boarding()
    {
        return $this->hasMany('App\BusBordingPoint', 'bus_counter_id', 'id');
    }
}
