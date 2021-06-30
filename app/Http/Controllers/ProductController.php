<?php
namespace App\Http\Controllers;

use App\Models\Product as Product;
use App\Models\Category;
use App\Models\Admin;
use App\Models\Satuan;
use Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use Illuminate\Http\UploadedFile;

class ProductController extends Controller
{


    public $menu_active=[0=>"products"];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_active=$this->menu_active[0];
        $products=Product::latest()->paginate(5);
        return view('backend.products.index',compact('products','menu_active'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $url=$request->path();
        $url=explode('/', $url);
        $url=$url[2];
        $productsatuan=Satuan::all();
        $categories=Category::where('parent_id',0)->pluck('name','id')->all();
        return view('backend.products.create',compact('url','categories','productsatuan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'code' => 'required',
            'category'=>'required',
            'postImage' => 'required|mimes:jpg,jpeg,png|max:8000'            
        ]);
        //Product::create($request->all());
        //example post thumbnail //field=post_thumb
        //field=post_image
        if($request->hasFile('postImage')){
           $image1=$request->file('postImage');
           $fileName=time().'-'.Str::slug($request->name,"-").'.'.$image1->getClientOriginalExtension();
           //directory file image thumb
           $destThumbnailSize=public_path('imgs/thumb');
           $destLargeSize=public_path('imgs/full');
           //$image1->move($dest1,$reThumbImage);
           Image::make($image1)->resize(300,300,function($constrain){
                $constrain->aspectRatio();
           })->save($destThumbnailSize.'/'.$fileName);
           Image::make($image1)->save($destLargeSize.'/'.$fileName);
        }else{
            $fileName='na';
        }


        $prod=new Product;
        $prod->name=$request->name;
        $prod->user_id=$request->userid;
        $prod->cat_id=$request->category;
        $prod->p_code=$request->code;
        $prod->color=$request->color;
        $prod->image=$fileName;
        $prod->description=$request->description;
        $prod->price=$request->price;
        $prod->satuan_id=$request->satuanid;
        $prod->save();

        return redirect()->route('products.index')->with('success','Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,Request $request)
    {
        //
        $menu_active=$this->menu_active[0];
        $uri=$request->path();
        $uri=explode('/', $uri);
        $uri=$uri[1];
        return view('backend.products.show',compact('product','uri','menu_active'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $menu_active=$this->menu_active[0];
        $category=Category::where('parent_id',0)->pluck('name','id')->all();
        $product=Product::findOrFail($id);
        //dd($product);
        $prodsatuan=Satuan::findOrFail($product->satuan_id);
        $satuan=Satuan::all();
        $edit_category=Category::findOrFail($product->cat_id);
        return view('backend.products.edit',compact('product','category','edit_category','prodsatuan','satuan','menu_active'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $prod=Product::findorFail($id);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'PostImage'=>'image|mimes:png,jpg,jpeg|max:1000'
        ]);
        
        $formInput=$request->all();
        if($formInput['PostImage'] != ''){
            $pathfull=public_path().'/imgs/full/';
            $paththumb=public_path().'/imgs/thumb/';

            if(file_exists(public_path('imgs/full/'.$prod->image)) && file_exists(public_path('imgs/thumb/'.$prod->image))){
                $patholdfull=$pathfull.$prod->image;
                $patholdthumb=$paththumb.$prod->image;
                unlink($patholdfull);
                unlink($patholdthumb);

                // $file=$request->file();
                // $fileName=time().'-'.Str::slug($formInput["name"],"-").$file->getClientOriginalExtension();  
                // Image::make($file)->resize(300,300)->save($paththumb.$fileName);
                // $file->move($pathfull,$fileName);
                //dd('File is Exists ');
            }
                $file=$formInput['PostImage'];
                //dd($file);
                $fileName=time().'-'.Str::slug($formInput["name"],"-").".".$file->getClientOriginalExtension();  
                Image::make($file)->resize(300,300)->save($paththumb.$fileName);
                $file->move($pathfull,$fileName);
            

        }

        $prod->name=$request->name;
        $prod->user_id=$request->userid;
        $prod->cat_id=$request->category;
        $prod->p_code=$request->code;
        $prod->color=$request->color;
        $prod->image=$fileName;
        $prod->description=$request->description;
        $prod->price=$request->price;
        $prod->save();

        return redirect()->route('products.index')->with("success","Product updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$product->delete();
        $delete=Product::findorFail($id);
        //dd($delete);
        $imgFull=public_path()."/imgs/full/".$delete->image;
        $imgThumb=public_path()."/imgs/thumb/".$delete->image;
        //dd($imgThumb);
        if($delete->delete()){
            unlink($imgFull);
            unlink($imgThumb);
        }
        return redirect()->route('products.index')->with("success","Product deleted successfully");
    }
}