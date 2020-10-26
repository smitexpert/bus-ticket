<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusSeatPlan extends Model
{
    use SoftDeletes;
    protected $fillable = ['type'];
}
