<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InstantTutor;
use Auth;

class InstantTutorController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth:api');
    }

    public function index(){
    	$user = Auth::user()->instantTutor;
    	return $user;
    }

    public function updateInstantTutor(Request $request){

    	$user = Auth::user()->instantTutor;

        $this->validate($request, [

        ]);
        $current = $user->image;
        if($request->image != $current){
            $name = time().'.'.explode('/',explode(':',substr($request->image,0,strpos($request->image, ';')))[1])[1];
        }
        \Image::make($request->image)->save(public_path('storage/users-image/'.  $name));
        $userPhoto = public_path('storage/users-image/').$current;
        if(file_exists($userPhoto)){
            @unlink($userPhoto);
        };

       
         $input = $request->all();
      
        $input['image'] = $name;



        $user->update($input);
    }

    public function getInstantTutor(){
        $user = Auth::user();
        $userEx = $user->userEx;
        $skills = $userEx->skills;

        if($skills !== null){

        $instantTutor = InstantTutor::where('skills',$skills)->with('user')->latest('updated_at')->get();

        return $instantTutor;
      }
    }
}
