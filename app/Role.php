<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillabel = ['name'];

    public function user()
    {
        return $this->hasMany('App\User');
    }

}
