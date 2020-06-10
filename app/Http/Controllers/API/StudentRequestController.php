<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserExtend;

class StudentRequestController extends Controller
{
    public function index(){
        $user = auth('api')->user();
        $role_id = $user->role_id;
        $userEx = $user->userEx;
        $skills = $userEx->skills;
        $class = $userEx->class;
        if($skills !== null){
        $student = UserExtend::where('role_id', '=', '3')
                    ->where('skills','=', $skills)
                    ->where('class', '=', $class)
                    ->with('user')
                    ->latest('updated_at')->get();

        


        return $student;
    }
        // $items = [];
        // foreach ($student as  $value) {
        //     $items[] = $value->user->with('userEx')->first();
        // };
        // return $items;
    }
}
