<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RolesController extends Controller
{
    //
    public function index(){
        $i=0;
    	$roles=Role::orderBy('id','desc')->get();
    	return view('backend.roles.index',['roles'=>$roles,'i'=>$i]);
    }

    public function create(){
    	return view('backend.roles.create');
    }

    public function show(Role $role){
    	return view('backend.roles.show',['role'=>$role]);
    }

    public function store(Request $request){
    	$request->validate([
    		'role_name'=>'required|max:255',
    		'role_slug'=>'required|max:255'
    	]);

    	$role=new Role();
    	$role->name=$request->role_name;
    	$role->slug=$request->role_slug;
    	$role->save();

    	$listOfPermissions=explode(',',$request->roles_permissions);

    	foreach ($listOfPermissions as $permission) {
    		$permissions=new Permission();
    		$permissions->name=$permission;
    		$permissions->slug=strtolower(str_replace(" ", "-", $permission));
    		$permissions->save();
    		$role->permissions()->attach($permissions->id);
    		$role->save();
    	}

    	return redirect()->route('roles.create')->with('success','Post created successfully');

    }

    public function edit(Role $role){
        return view('backend.roles.edit',['role'=>$role]);
    }

    public function update(Request $request,Role $role){
        $request->validate([
            'role_name'=>'required|max:255',
            'role_slug'=>'required|max:255'
        ]);

        $role=new Role();
        $role->name=$request->role_name;
        $role->slug=$request->role_slug;
        $role->save();

        $role->permissions()->delete();
        $role->permissions()->detach();

        $listOfPermissions=explode(',',$request->roles_permissions);

        foreach ($listOfPermissions as $permission) {
            $permissions=new Permission();
            $permissions->name=$permission;
            $permissions->slug=strtolower(str_replace(" ", "-", $permission));
            $permissions->save();
            $role->permissions()->attach($permissions->id);
            $role->save();
        }
        return redirect()->route('roles.index')->with('success','Post edit successfully');        
    }

    public function destroy(Role $role){
        $role->permissions()->delete();
        $role->delete();
        $role->permissions()->detach();
        return redirect()->route('roles.index')->with('success','Post delete successfully');
    }

}
