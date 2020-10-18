<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'firstname', 'lastname', 'is_vendor', 'is_admin', 'profile_picture', 'email_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Jwt function for token generation
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    //Jwt function
    public function getJWTCustomClaims()
    {
        return [];
    }

    //Mutator to encrypt the password by bcrypt
    public function setPasswordAttribute($value)
    {
       return $this->attributes['password'] = bcrypt($value);
    }

    public function blogs()
    {
        return $this->hasMany('App\Blog');
    }

    public function blogsComments()
    {
        return $this->hasMany('App\BlogsComment');
    }
}
