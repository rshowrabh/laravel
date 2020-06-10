<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserFriend;

class MyStudentsController extends Controller
{
     public function __construct()
    {
        
        $this->middleware('auth:api');
    }

    public function index(){
    	$uid = auth()->id();

    	$users = UserFriend::where('tutor_id',$uid)->where('status',1)->get();

    	$student = [];

    	foreach ($users as $user) {
    		$students[]= $user->userStudent;
    	}

    	return $students;
    }
}
