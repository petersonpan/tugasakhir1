@extends('layoutbackend')
@section('addoncss')
  <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css?id=190274109270">
  <link rel="stylesheet" type="text/css" href="{{asset('css')}}/bootstrap-tagsinput.css?id=90293270375">
@endsection('addoncss')
@section('titlebackend',"edit")
@section('contentbackend')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Product</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('products.index')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Product</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Product</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Error!! There are some problems with your input</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data" class="card-body">
            @csrf
            @method('PUT')
              <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" name="name" id="inputName" class="form-control" value="{{$product->name}}">
              </div>
              <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea id="inputDescription" name="description" class="form-control" rows="4">{{$product->description}}</textarea>
              </div>
              <div class="row">
                <div class="col-md-7 col-sm-6">
                  <div class="form-group">
                    <label for="inputName">Product Price</label>
                    <input type="number"  name="price" id="inputName" class="form-control" autocomplete="off" value="{{$product->price}}" min=1000>
                  </div>
                </div>
                <div class="col-md-5 col-sm-6">
                  <div class="form-group">
                    <label for="inputName">Product Satuan</label>
                    <select name="satuanid" id="satuanid" class="custom-select">
                      <option value="{{$prodsatuan->id}}">{{$prodsatuan->name}}</option>
                      @foreach($satuan as $ky)
                      <option value="{{$ky->id}}">{{$ky->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputName">Product Category</label>
                <select name="category" id="category_id" class="custom-select">
                    @foreach($category as $key => $value)
                      <option value="{{$key}}" {{($edit_category->id==$key)?"selected":""}}>{{$value}}</option>
                        @if($key!=0)
                          @php
                            $subCategory=\App\Models\Category::where('parent_id',$key)->select('name','id')->get();
                          @endphp
                          @if(count($subCategory) > 0)
                             @foreach($subCategory as $subCat)
                                <option value="{{$subCat->id}}" {{($edit_category->id == $subCat->id)?"selected":""}} >&nbsp;&nbsp;---{{$subCat->name}}---</option>
                             @endforeach 
                          @endif
                        @endif
                    @endforeach
                </select>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                      <label for="inputCode">Product Code</label>
                      <input type="text" name="code" id="inputCode" class="form-control" autocomplete="off" value="{{$product->p_code}}">
                    </div>    
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label for="inputCode">Product Color</label>
                    <input type="color" name="color1" id="inputColor1" class="form-control inputColor1" autocomplete="off">
                    <input type="text" name="color" id="inputColor" class="form-control inputColor" value="{{$product->color}}" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="form-group">
                    <p class="my-2"><img width="80" src="{{asset('imgs/thumb')}}/{{$product->image}}"/></p>
                    <label for="exampleInputFile">Product Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="PostImage">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                </div>
              <div class="row">
                <div class="col-12">
                  <input type="hidden" name="userid" value="{{session('adminData')->id}}">
                  <a href="{{route('products.index')}}" class="btn btn-secondary float-right">Cancel</a>&nbsp;
                  <input type="submit" value="Save Changes" class="btn btn-success float-left">
                </div>
              </div>
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    </div>
</section>
@endsection
@section("addon")
  <script src='{{asset("js")}}/bootstrap-tagsinput.js'></script>
  <script src='{{url("backend")}}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js'></script>
  <script type="text/javascript">
    $('#inputColor').tagsinput();
    var str=document.getElementById('inputColor').value;
    var arry=str.split(",");
    $('#inputColor1').on('change',function(e){
      console.log(this.value);
       if( this.value && arry.indexOf(this.value) === -1 ){
          arry.push(this.value);
          console.log(arry);
          $('#inputColor').val(arry.join(', '));
          //$('#inputColor').tagsinput('refresh');
          $('#inputColor').tagsinput('add',arry.join(', '));
       }
    });
  </script>
@endsection("addon")