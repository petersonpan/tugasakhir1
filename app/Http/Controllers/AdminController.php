<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{

    // public function index(){
    //     return view('backend.login');
    // }

    public function login(){
    	return view('backend.login');
    }

    //submit_login
    public function submit_login(Request $request){
    	$request->validate([
    		'username' => 'required','password'=>'required'
    	]);

    	$userCheck=Admin::where(['username'=>$request->username,'password'=>$request->password])->count();

    	if($userCheck > 0){
    	   $adminData=Admin::where(['username'=>$request->username,'password'=>$request->password])->first();
    	   $request->session()->put('adminData',$adminData);
    	   return redirect('admin/dashboard');
    	}else{
    	   return redirect('admin/login')->with('error','invalid username/password');
    	}
    }

    public function users(){
        $data=User::orderBy('id','desc')->paginate(5);
        return view('backend.users.index',['data'=>$data])->with('i',(request()->input('page',1)-1)*5);
    }

    public function dashboard(){

    		$products=Product::latest()->paginate(5);
    		$categories=Category::latest()->paginate(5);
    		//$loggedAdminInfo=Admin::where('id','=',session('adminData'))->first();
    		// $data = [
    		// 	'loggedAdminInfo'=>$user
    		// ];	
    		//return view('backend.dashboard',$data);
    		return view('backend.dashboard',compact('products','categories'))->with('i',(request()->input('page',1)-1)*5);
    }

    public function logout(){
    	if(session()->has('adminData')){
    		session()->forget([
    		'adminData']);
    		return redirect('admin/login');
    	}
    }
}
