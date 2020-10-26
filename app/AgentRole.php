<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AgentRole extends Model
{
    protected $fillable = [
        'name'
    ];

    public function agents()
    {
        return BelongsToMany('App\Agent');
    }
}
