<?php

namespace App\Http\Controllers;

use App\Models\ImageModel;
use App\Models\Product;
use Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class ImageProductController extends Controller
{
    //
    public function store(Request $request,ImageModel $images){
    	//dd($images);
         $request->validate([
            'postImages.*' => 'required|mimes:jpg,jpeg,png|max:8000'            
        ]);

       $inputData=$request->all();
       $products=Product::find($request->productid);
       if($request->hasFile('postImages')){
       		$images=$request->file('postImages');
            foreach ($images as $image){
                if($image->isValid()){
                	$extension=$image->getClientOriginalExtension();
                    //$filename=rand(100,999999).time().'.'.$extension;
                    $filename=time().'-'.Str::slug($products->name,"-").'.'.$extension;
                    $large_image_path=public_path('imgs/full/'.$filename);
                    $medium_image_path=public_path('imgs/thumb/'.$filename);
                    $small_image_path=public_path('imgs/smallthumb/'.$filename);
                    //// Resize Images
                    //dd($filename);
                    Image::make($image)->save($large_image_path);
                    Image::make($image)->resize(300,300)->save($medium_image_path);
                    Image::make($image)->resize(150,150)->save($small_image_path);
                	$inputData['image']=$filename;
                	$inputData['products_id']=$request->productid;
                	ImageModel::create($inputData);
                }    
                
            }      
            
    		return back()->with('success','Post created successfully');	
    	}    	
    	
    }

    public function show($id){
    	$menu_active="products";
    	$products=Product::findOrFail($id);
    	$imageGalleries=ImageModel::where('products_id',$id)->get();
        return view('backEnd.products.addproductimage',compact('menu_active','products','imageGalleries'));
    }

    public function destroy($id){
    	$delete=ImageModel::findOrFail($id);
    	$image_large=public_path().'/imgs/full/'.$delete->image;
        $image_medium=public_path().'/imgs/thumb/'.$delete->image;
        $image_small=public_path().'/imgs/smallthumb/'.$delete->image;
        if($delete->delete()){
            unlink($image_large);
            unlink($image_medium);
            unlink($image_small);
        }
        return back()->with('success','Delete Success!');
    }

}