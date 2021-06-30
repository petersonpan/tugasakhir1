@extends('layoutbackend')
@section('addoncss')
  <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
@endsection('addoncss')
@section('titlebackend',"create")
@section('contentbackend')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('products.index')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">{{Request::segment(2)}}</li>
              <li class="breadcrumb-item active">{{Request::segment(3)}}</li>
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
              <h3 class="card-title">General Product</h3>
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
            <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" class="card-body">
            @csrf
              <div class="form-group">
                <label for="inputName">Product Name</label>
                <input type="text" name="name" id="inputName" class="form-control" autocomplete="off">
              </div>
              <div class="row">
                <div class="col-md-7 col-sm-6">
                  <div class="form-group">
                    <label for="inputName">Product Price</label>
                    <input type="number"  name="price" id="inputName" class="form-control" autocomplete="off" min=1000>
                  </div>
                </div>
                <div class="col-md-5 col-sm-6">
                  <div class="form-group">
                    <label for="inputName">Product Satuan</label>
                    <select name="satuanid" id="satuanid" class="custom-select">
                      <option value="#">choose your measurement</option>
                      @foreach($productsatuan as $ky)
                      <option value="{{$ky->id}}">{{$ky->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Category Product</label>
                <select class="custom-select" name="category">
                @foreach($categories as $key => $value)
                  <option value="{{$key}}">{{$value}}</option>
                  @php
                    $subCategories=\App\Models\Category::where('parent_id',$key)->select('id','name')->get();
                  @endphp
                  @if($key!=0)
                    @if(count($subCategories) > 0)
                      @foreach($subCategories as $subCategory)
                        @php
                          $subCat2=\App\Models\Category::where('parent_id',$subCategory->id)->select('id','name')->get();
                        @endphp
                        <option value="{{$subCategory->id}}">&nbsp;&nbsp;--{{$subCategory->name}}--</option>
                        @if($subCategory->id!=0)
                          @if(count($subCat2) > 0)
                            @foreach($subCat2 as $subC)
                              <option value="{{$subC->id}}">&nbsp;&nbsp;&nbsp;&nbsp;-----{{$subC->name}}-----</option>
                            @endforeach
                          @endif
                        @endif
                      @endforeach
                    @endif
                  @endif                
                @endforeach
                </select>
                </div>
              <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea id="inputDescription" name="description" class="form-control" rows="4"></textarea>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                <label for="inputCode">Product Code</label>
                <input type="text" name="code" id="inputCode" class="form-control" autocomplete="off">
              </div>    
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label for="inputCode">Product Color</label>
                    <input type="text" name="color" id="inputColor" class="form-control inputColor" autocomplete="off">
                  </div>
                </div>
              </div>
                <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="postImage">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                </div>
              <div class="row">
                <div class="col-12">

                  <a href="{{route('products.index')}}" class="btn btn-secondary float-right">Cancel</a>
                  <input type="hidden" name="userid" value="{{Session::get('adminData')->id}}">
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
  <script src='{{url("backend")}}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js'></script>
  <script type="text/javascript">
    $('.inputColor').colorpicker();
  </script>
@endsection("addon")