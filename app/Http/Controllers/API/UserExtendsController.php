<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;


class UserExtendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $user = auth('api')->user();
        return $user->userEx;
    }
    public function updateEx(Request $request)
    {
       $this->validate($request, [
        ]);

         $user = auth('api')->user();
          $input = $request->all();
          if($user->userEx){ 
          $user->userEx->update($input);
          }else{
            $user->userEx->create($input); 
          }
    }
 
}
