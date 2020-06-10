<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserExtend;
use App\User;
use App\InstantTutor;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role_id == null) {
              return view('socialEx');
        }else{
            if (!$user->userEx) {
                UserExtend::create(['user_id' => $user->id,'role_id' => $user->role_id]);
                
            }if (!$user->instantTutor){
                InstantTutor::create(['student_id' => $user->id]);
            }
             return view('home');
            }
        
    }
    public function changeStatus(Request $request)

    {


        $id = Auth::user()->id;
        $user = User::where('id', '=', $id)->first();

        $user->active_status = $request->is_active;

        $user->save();



        return response()->json(['success' => 'Status change successfully.']);
    }
}
