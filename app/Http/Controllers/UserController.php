<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;


class UserController extends Controller
{
    //
    public function index(){
    	$data=User::orderBy('id','desc')->paginate(5);
        return view('backend.users.index',['data'=>$data])->with('i',(request()->input('page',1)-1)*5);
    }

    public function create(Request $request){
    	if($request->ajax()){
    		$roles=Role::where('id',$request->role_id)->first();
    		$permissions=$roles->permissions;
    		return $permissions;
    	}
    	$roles=Role::all();
    	return view('backend.users.create',['roles'=>$roles]);
    }

    public function store(Request $request){
    	$request->validate([
    		'name'=>'required|max:255',
    		'email'=>'required"max:255',
    		'password'=>'required|between:8,255|confirmed',
    		'password_confirm'=>'required'
    	]);
    	$user=new User();
    	$user->name=$request->name;
    	$user->email=$request->email;
    	$user->password=Hash::make($request->password);

    	if($request->role!=null){
    		$user->roles()->attach($request->role);
    		$user->save;

    	}

    	if($request->permissions != null){
    		foreach ($request->permissions as $permission) {
    			$user->permissions()->attach($permission);
    			$user->save();
    		}
    	}

    	return redirect('/users');

    }

}
