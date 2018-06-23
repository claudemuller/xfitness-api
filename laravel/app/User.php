<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_verified'
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
     * Get the key that will represet the subject claim of the JWT
     *
     * @return mixed
     */
    public function getJwtIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return custom claims to be added to the JWT
     *
     * @return array
     */
    public function getJwtCustomClaims()
    {
        return [];
    }
}
