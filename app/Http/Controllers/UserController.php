<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;


class UserController extends Controller
{
    //
    public $menu_active=[0=>"active",1=>"user"];

    public function index(){
        $menu_active=$this->menu_active;    
    	$data=User::orderBy('id','desc')->paginate(5);
        return view('backend.users.index',['data'=>$data,'menu_active'=>$menu_active])->with('i',(request()->input('page',1)-1)*5);
    }

    public function create(Request $request){
    	// dd($request->ajax);
		if($request->ajax()){
    		$roles=Role::where('id',$request->role_id)->first();
    		$permissions=$roles->permissions;
    		return $permissions;
    	}
    	$roles=Role::all();
    	return view('backend.users.create',['roles'=>$roles,'menu_active'=>$this->menu_active]);
    }

    public function store(Request $request){
    	$request->validate([
    		'name'=>'required|max:255',
    		'email'=>'required|max:255',
    		'password'=>'required|between:8,255',
    		'password_confirm'=>'required|between:8,255'
    	]);
    	$user=new User();
    	$user->name=$request->name;
    	$user->email=$request->email;
    	$user->password=Hash::make($request->password);
        $user->save();
    	if($request->role!=null){
    		$user->roles()->attach($request->role);
    		//$user->save;
    	}

    	if($request->permissions != null){
    		foreach ($request->permissions as $permission) {
    			$user->permissions()->attach($permission);
    			//$user->save();
    		}
    	}
    	return redirect('/user');

    }

}
