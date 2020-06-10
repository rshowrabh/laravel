<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Cache;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

   protected $guarded = [];

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


    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    public function userEx()
    {
      return  $this->hasOne('App\UserExtend');
    }

    public function tutor()
    {
        return  $this->hasMany('App\UserFriend', 'tutor_id');
    }

    public function student()
    {
        return  $this->hasMany('App\UserFriend', 'student_id');
    }

    public function instantTutor()
    {
        return  $this->hasOne('App\InstantTutor', 'student_id');
    }
 
   
}
