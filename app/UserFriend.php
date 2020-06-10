<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFriend extends Model
{
    protected $guarded = [];

    public function userStudent()
    {
        return $this->belongsTo('App\User','student_id');
    }
    public function userTutor()
    {
        return $this->belongsTo('App\User', 'tutor_id');
    }
}
