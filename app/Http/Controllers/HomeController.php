<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\ImageModel;
use App\Models\ProductAttr;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
    	
        try {
            if($request->has('q')){
                $q=$request('q');
                $products=Product::where('name','like','%'.$q.'%')->orderBy('id','desc')->paginate(5);
            }else{
                $products=Product::latest()->paginate(5);
            }
        } catch (\Exception $e) {
            // if (!($e instanceof SQLException)) {
            //     app()->make(\App\Exceptions\Handler::class)->report($e); // Report the exception if you don't know what actually caused it
            // }
            //     request()->session()->flash('unsuccessMessage', 'Failed to add comment !!!');
            \Log::error($e);
            return redirect()->back()->with(['unsuccessMessage' => 'There was an error']);
        }
    	$categories=Category::latest()->paginate(5);
    	return view('frontend.home',compact('products','categories'))->with('i',(request()->input('page',1)-1)*5);
    }


    public function ListByCat($id){
        $productlist=Product::where('cat_id',$id)->get();
        $bycategory=Category::select('name','parent_id')->where('id',$id)->get();
        $getMainCat=Category::select('name')->where('id',$bycategory[0]->parent_id)->first();
        return view('frontend.products',compact('productlist','getMainCat'));
    }

    public function productDetails($id){
        $detail_product=Product::findOrFail($id);
        $imagesGallery=Imagemodel::where('products_id',$id)->get();
        $totalStock=ProductAttr::where('products_id',$id)->sum('stock');
        $relateProducts=Product::where([['id','!=',$id],['cat_id',$detail_product->cat_id]])->get();
        return view('frontend.product_detail')->with(compact('imagesGallery','detail_product'));
    }

}