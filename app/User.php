<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','firstName','lastName','street','city','stateId','pinCode','DocumentType','documentNumber'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function visitToken()
    {
        return $this->hasMany('App\Token');
    }

    public function state()
    {
        return $this->belongsTo('App\State','stateId');
    }

    protected $hidden = [
        'password', 'remember_token',
    ];
}
