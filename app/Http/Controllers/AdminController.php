<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{

    public $menu_active=[0=>"active",1=>"admin"];

    public function login(){
    	return view('backend.login');
    }

    //submit_login
    public function submit_login(Request $request){
    	// $request->validate([
    	// 	'username' => 'required','password'=>'required'
    	// ]);
        $request->validate([
            'email' => 'required','password'=>'required'
        ]);

         // if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'admin'=>'1'])){
            //Session::put('adminData',$input_data['email']);
        //     $request->session()->put('email',$request->email);
        //     return redirect('admin/dashboard');
        // }else{
        //     return redirect('admin/login')->with('error','Account is not Valid!');
        //}


    	$userCheck=Admin::where(['email'=>$request->email])->count();
        //dd($userCheck);
    	if(($userCheck > 0)){
    	   $adminData=Admin::where(['email'=>$request->email])->first();
           if(Hash::check($request->password,$adminData->password)){
                $request->session()->put('adminData',$adminData);
                return redirect('admin/dashboard'); 
           }else{
                return redirect('admin/login')->with('error','Account is not valid');     
           }
    	}else{
    	   return redirect('admin/login')->with('error','Account is not valid');
    	}

    }



    public function adminview(){
        $menu_active=$this->menu_active;
        $dataview=Admin::orderBy('id','desc')->paginate(5);
        return view('backend.users.adminindex',['dataview'=>$dataview,'menu_active'=>$menu_active])->with('i',(request()->input('page',1)-1)*5);
    }

    public function dashboard(){
            $menu_active=$this->menu_active[0];
    		$products=Product::latest()->paginate(5);
    		$categories=Category::latest()->paginate(5);
    		return view('backend.dashboard',compact('products','categories','menu_active'))->with('i',(request()->input('page',1)-1)*5);
    }

    public function logout(){    
    		session()->forget([
    		'adminData']);
            //Auth::logout();
    		return redirect('admin/login');
    }
}
