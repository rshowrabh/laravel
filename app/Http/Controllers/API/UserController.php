<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;
use Cache;
class UserController extends Controller
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
        
        $this->authorize('isAdmin');
        $users = User::with('role')->get();
        
        return  $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|min:8',
            'role_id' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        return User::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = auth('api')->user();
        return $user;
    }
    public function upadteEx(Request $request)
    {

        $user = auth('api')->user();

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|',
            'avatar' => 'required',
        ]);
        $current = $user->avatar;
        if($request->avatar != $current){
            $name = time().'.'.explode('/',explode(':',substr($request->avatar,0,strpos($request->avatar, ';')))[1])[1];
        }
        \Image::make($request->avatar)->save(public_path('storage/users-avatar/'.  $name));
        $userPhoto = public_path('storage/users-avatar/').$current;

        if($current != 'avatar.png'){
           if(file_exists($userPhoto)){
            @unlink($userPhoto);
           };
        }

        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
        }
        if ($request->avatar == '') {
            $input = $request->except('avatar');
        } else {
            $input = $request->all();
        }

        $input['avatar'] = $name;


        $user->update($input);
    }
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
        ]);

        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
        }
        $user->update($input);
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        User::find($id)->delete();
    }


    public function userOnlineStatus()
    {
        $users = User::all();
        $items = [];

        foreach ($users as $user) {
            if (Cache::has($user->id)){
                
             $items[] =  $user->id;
        }
        
    }
        return $items;
   }
   public function changeStatus(Request $request)
    {
        
        $id = $request->user_id;
        
        $user = User::where('id', '=', $id)->first();

        $user->active_status = $request->is_active;

        $user->save();

        return response()->json(['success' => 'Status change successfully.']);
    
    }
    
}
