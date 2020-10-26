<?php

namespace App;

use App\Notifications\Agent\AgentResetPassword;
use App\Notifications\Agent\AgentVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agent extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'email', 'password', 'bus_organizations_id', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AgentResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new AgentVerifyEmail);
    }

    public function organization()
    {
        return $this->belongsTo('App\BusOrganization', 'bus_organizations_id', 'id');
    }

    public function roles()
    {
        return $this->belongsTo('App\AgentRole', 'role_id', 'id');
    }

    public function counters()
    {
        return $this->hasMany('App\BusCounter', 'id', 'agent_id');
    }

}
