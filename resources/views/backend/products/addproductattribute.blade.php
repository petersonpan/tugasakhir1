@extends('layoutbackend')
@section('titlebackend',"Add Attribute")
@section('contentbackend')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Product Attribute</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">{{Request::segment(2)}}</li>
              <li class="breadcrumb-item active">{{Request::segment(3)}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="info-box">
              <div class="info-box-icon">
                <p class="my-2 mx-1"><img width="80" src="{{asset('imgs/thumb')}}/{{$product->image}}" alt="{{$product->image}}"></p>
              </div>
              <div class="info-box-content">
                <span class="info-box-number">Product Code:{{$product->p_code}}</span>
                <span class="info-box-number">Product Color :<?php 
                $explode_arr=explode(",",$product->color);
                foreach ($explode_arr as $key => $value) {
                  echo "<span style='background-color:$value;margin:0 5px;' class='col-1'>&nbsp;</span>";
                }
                 ?></span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
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
              <form action="{{route('product_attr.store')}}" method="POST" enctype="multipart/form-data" class="card-body">
                @csrf
                <div class="form-group">
                  <label for="inputSKU">Product SKU</label>
                  <input type="text" name="sku" id="inputsku" class="form-control" value="{{$generatecode}}"  autocomplete="off" placeholder="SKU" required>
                </div>
                <div class="form-group">
                  <label for="inputName">Product Size</label>
                  <input type="text" name="size" id="inputsize" class="form-control" value="{{old('size')}}" autocomplete="off" placeholder="input product size" >
                </div>
                <div class="form-group">
                  <label for="inputDescription">Product Price</label>
                  <input type="number" min="1000" name="price" id="inputprice" class="form-control" value="{{old('price')}}" autocomplete="off" placeholder="input product price" >
                </div>
                <div class="form-group">
                  <label for="inputStock">Product Stock</label>
                  <input type="number" name="stock" id="inputstock" class="form-control" value="{{old('stock')}}" autocomplete="off" placeholder="input product stock" min=0>
                </div>
                <div class="row">
                  <div class="col-12">
                    <a href="{{route('products.index')}}" class="btn btn-secondary">Cancel</a>
                    <input type="hidden" name="productid" value="{{$product->id}}">
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
                  <h3 class="card-title">List Product Attribute</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <form action="{{route('product_attr.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                {{method_field("PUT")}}
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>SKU</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                       @if(count($attributes) > 0)
                          @foreach($attributes as $attribute)
                              <tr>
                                  <td>{{++$i}}</td>
                                  <td><input type="text" name="sku[]" id="idsku" class="form-control" value="{{$attribute->sku}}"  autocomplete="off" placeholder="SKU" required></td>
                                  <td><input type="text" name="size[]" id="sizeid" class="form-control" value="{{$attribute->size}}"  autocomplete="off" placeholder="size" required="required"></td>
                                  <td><input type="text" name="price[]" id="priceid" class="form-control" value="{{$attribute->price}}"  autocomplete="off" placeholder="price" required="required"></td>
                                  <td><input type="text" name="stock[]" id="stockid" class="form-control" value="{{$attribute->stock}}"  autocomplete="off" placeholder="stock" required="required"></td>
                                  <td>
                                    <input type="hidden" name="id[]" value="{{$attribute->id}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="submit" value="Edit Changes" class="btn btn-success float-left">
                                    <a href="{{route('product_attr.deleteattr',$attribute->id)}}" rel="" rel1="delete-attribute" class="btn btn-danger btn-mini deleteRecord float-md-right">Delete</a>
                                  </td>

                              </tr>
                          @endforeach
                      @else
                          <tr>
                              <td colspan="6" class="text-center">EOD</td>
                          </tr>
                      @endif             
                    </tbody>
                   </table>
                  </form>
                </div>
              <!-- /.card-body -->
              </div>
          </div>
       </div>
    </section>
@endsection('contentbackend')