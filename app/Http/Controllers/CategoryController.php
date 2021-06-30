<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
class CategoryController extends Controller
{

    public $title=["index","create","edit","show"];
    public $menu_active=[0=>'category'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $title=$this->title[1];
        $menu_active=$this->menu_active[0];
        $categories=Category::latest()->paginate(5);
        return view('backend.categories.index',compact('categories','title','menu_active'))->with('i',(request()->input('page',1)-1)*5);
        
    }

    public function jsonCategory(){
        return Datatables::of(Category::all())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu_active=$this->menu_active[0];
        $plucked=Category::where('parent_id',0)->pluck('name','id');
        
        $cate_levels=['0'=>'Main Category']+$plucked->all();
        // $subCategory=DB::table('categories')->select('id','name')->where('parent_id',$key)->get();
        return view('backend.categories.create',compact('cate_levels','menu_active'));
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
            'name' => 'required|max:255|unique:categories,name',
            'description' => 'required',
            'url' => 'required'

        ]);

        Category::create($request->all());
        return redirect()->route('categories.create')->with('success','Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu_active=$this->menu_active;    
        $categories=Category::find($id);
        return view('backend.categories.show',compact('categories','menu_active'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $title=$this->title[2];
        $menu_active=$this->menu_active[0];
        $plucked=Category::where('parent_id',0)->pluck('name','id');
        $cate_levels=['0'=>'Main Category']+$plucked->all();

        $category=Category::findorFail($id);
        return view('backend.categories.edit',compact('category','title','cate_levels','menu_active'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateCat=Category::findorFail($id);
        $request->validate([
            'name' => 'required||max:255|unique:categories,name,'.$updateCat->id,
            'description' => 'required'
        ]);
        $inputData=$request->all();
        if(empty($inputData['status'])){
            $inputData['status']=0;
        }    

        //fungsi eloquent untuk mengupdate data inputan kita
        $updateCat->update($inputData);
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('categories.index')->with('success','category updated successfully');
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data
        Category::find($id)->delete();

        //jika data berhasil didelete, akan kembali ke halaman utama 
        return redirect()->route('categories.index')->with("success","category deleted successfully");
    }
}