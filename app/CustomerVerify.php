<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerVerify extends Model
{
    protected $fillable = [
        'verify_code',
        'customer_id'
    ];
}
