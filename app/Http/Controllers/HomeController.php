<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public $title=["index","create","edit","show"];

    public function index(Request $request){
    	$title=$this->title[0];
    	
        if($request->has('q')){
            $q=$request('q');
            $products=Product::where('name','like','%'.$q.'%')->orderBy('id','desc')->paginate(5);
        }else{
            $products=Product::latest()->paginate(5);
        }
        
    	$categories=Category::latest()->paginate(5);
    	return view('frontend.home',compact('title','products','categories'))->with('i',(request()->input('page',1)-1)*5);
    }
    
}