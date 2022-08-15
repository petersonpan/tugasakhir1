<?php

namespace App\Http\Controllers;

use App\Models\ProductAttr;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductAttrController extends Controller
{


    public $menu_active=[0=>"products"];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'sku'=>'required',
            'size'=>'required',
            'price'=>'required|numeric',
            'stock'=>'required|numeric'
        ]);
        //dd($request->all());
        //ProductAttr::create($request->all());
        $prod=new ProductAttr;
        $prod->sku=$request->sku;
        $prod->products_id=$request->productid;
        $prod->size=$request->size;
        $prod->stock=$request->stock;
        $prod->price=$request->price;
        $prod->save();

        return back()->with('message','Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductAttr  $productAttr
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //dd(ProductAtrr);
        $menu_active=$this->menu_active[0];
        $i=0;
        $attributes=ProductAttr::where('products_id',$id)->get();
        $product=Product::find($id);
        $lastSKUID=ProductAttr::OrderBy('id','desc')->first()->id;
        $lastIncrement=substr($lastSKUID,-3);
        $newOrderID='SKU'.date('Ymd').str_pad($lastIncrement + 1,3,0,STR_PAD_LEFT);

        return view('backend.products.addproductattribute',['product'=>$product,'attributes'=>$attributes,'generatecode'=>$newOrderID,'i'=>$i,'menu_active'=>$menu_active]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductAttr  $productAttr
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductAttr $productAttr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductAttr  $productAttr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataReq=$request->all();
        foreach($dataReq['id'] as $key => $value){
            $updateattribute=ProductAttr::where([['products_id',$id],['id',$dataReq['id'][$key]]])->update(['sku'=>$dataReq['sku'][$key],'size'=>$dataReq['size'][$key],'price'=>$dataReq['price'][$key],'stock'=>$dataReq['stock'][$key]]);
        }
        return back()->with('success','Update Attribute Successed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductAttr  $productAttr
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductAttr $productAttr,Request $request)
    {
        //
        dd($productAttr);

    }

    public function deleteattr($id){
        $delAttr=ProductAttr::findOrFail($id);
        $delAttr->delete();
        return back()->with('success','Delete Attribute Successed');
    }
}
