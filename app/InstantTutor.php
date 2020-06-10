<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstantTutor extends Model
{
      protected $guarded = [];

       public function user()
    {
        return $this->belongsTo('App\User','student_id');
    }
}
