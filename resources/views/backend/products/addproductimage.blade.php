@extends('layoutbackend')
@section('titlebackend',"Add Product Image")
@section('contentbackend')
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Image Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('products.index')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">{{Request::segment(2)}}</li>
              <li class="breadcrumb-item active">{{$products->name}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>
    <section class="content">
    <div class="row">
        <div class="col-md-6 col-sm-3 col-12">
          <div class="info-box">
            <div class="info-box-icon">
              <p class="my-2"><img width="80" src="{{asset('imgs/thumb')}}/{{$products->image}}" alt="{{$products->image}}"></p>
            </div>
            <div class="info-box-content">
              <span class="info-box-number">Product Code:{{$products->p_code}}</span>
              <span class="info-box-number">Product Color :              <?php 
              $explode_arr=explode(",",$products->color);
              foreach ($explode_arr as $key => $value) {
                echo "<span style='background-color:$value;margin:0 5px;' class='col-1'>&nbsp;</span>";
              }
               ?></span>

            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Product </h3>
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
            <form action="{{route('product-image.store')}}" method="POST" enctype="multipart/form-data" class="card-body">
              @csrf
              <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                      	<input type="hidden" name="productid" value="{{$products->id}}">
                        <input type="file" class="custom-file-input" id="exampleInputFile" multiple="multiple" name="postImages[]"><br>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label><br>
                      </div>
                    </div>

              </div>
              <div class="row">
                <div class="col-12">
                  <a href="{{route('products.index')}}" class="btn btn-secondary">Cancel</a>
                  <input type="hidden" name="productid" value="{{$products->id}}">
                  <input type="submit" value="Save Changes" class="btn btn-success">
                </div>
              </div>
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-12">
            <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">List Product Images</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">

              <table id="example1" class="table table-bordered">
                              <thead>
                                <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Image</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                              	<?php $i=0; ?>
                                 @if(count($imageGalleries) > 0)
                                    @foreach($imageGalleries as $image)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td><img src="{{url('imgs/smallthumb',$image->image)}}" class="img-responsive" alt="Image" width="60"></td>
                                            <td>
                                            <form action="{{route('product-image.destroy',$image->id)}}" method="POST">	
                                              <a href="javascript" rel="{{$image->id}}" rel1="delete-attribute" class="btn btn-danger btn-mini deleteRecord">Edit Changes</a>
                      												@csrf
                      												@method('DELETE')
                                              <input type="submit" value="DELETE IMAGE" class="btn btn-success float-left">
                                          	</form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">EOD</td>
                                    </tr>
                                @endif
                              </tbody>
              </table>
              <!-- <button type="submit" class="btn btn-success">Add</button> -->
            </div>
            <!-- /.card-body -->
          </div>
        </div>
     </div>
    </section>
@endsection
@section('addon')
<script type="text/javascript">
      
</script>
@endsection