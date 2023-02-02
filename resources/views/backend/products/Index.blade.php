@extends('layoutbackend')
@section('titlebackend',"Index")
@section('contentbackend')
@push('style')
<link rel="stylesheet" href="{{url('backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Product</h3>
                            <div class="card-tools">
                                <a href="{{route('products.create')}}" type="button" class="btn btn-tool" title="Create Product">
                                  <i class="fas fa-plus"></i></a>
                              </div>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body table-responsive">
                            <table id="example1" class="table table-bordered">
                              <thead>
                                <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Name</th>
                                  <th>description</th>
                                  <th>Date Created</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                 @if(count($products) > 0)
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->description}}</td>
                                            <td>{{date_format($product->created_at,'jS M Y')}}</td>
                                            <!-- <td class="text-center"><a href="{{route('product_attr.show',$product->id)}}" class="btn btn-primary" title="add attibute product">add product attribute</a></td> -->
                                            <td class="text-center"><a  id="createProduct" class="btn btn-primary" title="add attibute product">add product attribute</a></td>
                                            <td class="text-center"><a href="{{route('product-image.show',$product->id)}}" class="btn btn-danger" title="add attibute product">add product gallery</a></td>
                                            <td>
                                                <form action="{{route('products.destroy',$product->id)}}" method="POST">
                            
                                                    <a href="{{route('products.show',$product->id)}}" title="show"><i class="fas fa-eye text-success fa-lg"></i></a>
                                                    <a href="{{route('products.edit',$product->id)}}">
                                                        <i class="fas fa-edit  fa-lg"></i>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                                        <i class="fas fa-trash fa-lg text-danger"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">EOD</td>
                                    </tr>
                                @endif
                              </tbody>
                            </table>
                          </div>
                          <!-- /.card-body -->
                     </div>
                </div>
            </div>
{!! $products->links() !!}
        </div>
@push('modals')
<div class="modal fade" id="modal-id">
  <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title" id="titleModal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
               <form action="" method="POST" enctype="multipart/form-data" class="card-body">
              <div class="form-group">
                <label for="inputSKU">Product SKU</label>
                <input type="text" name="sku" id="inputsku" class="form-control" value=""  autocomplete="off" placeholder="SKU" required>
              </div>
              <div class="form-group">
                <label for="inputName">Product Size</label>
                <input type="text" name="size" id="inputsize" class="form-control" value="{{old('size')}}" autocomplete="off" placeholder="input product size">
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
                  <a href="" class="btn btn-secondary">Cancel</a>
                  <input type="hidden" name="productid" value="">
                  <input type="submit" id="Submit" value="Save Changes" class="btn btn-success">
                </div>
              </div>
            </form>
            <!-- /.card-body -->
            </div>

        </div>
    </div>
</div>
@endpush('modals')        
    </section>
@endsection
@push('scripts')
<script src="{{url('backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('backend')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('backend')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript">
   $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
   $("body").on('click','#createProduct',function(e){
      e.preventDefault();
      $("#titleModal").html("Create Attribute Product");
      $("#modal-id").modal();
   });
   $("body",on('click','#'))
</script>
@endpush