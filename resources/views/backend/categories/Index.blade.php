@extends('layoutbackend')
@section('titlebackend',$title)
@section('contentbackend')
@push('style')
<link rel="stylesheet" href="{{url('backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                            <h3 class="card-title">Product Category</h3>
                            <div class="card-tools">
                                <a href="{{route('categories.create')}}" type="button" class="btn btn-tool" title="Create Category">
                                  <i class="fas fa-plus"></i></a>
                              </div>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <table id="example1" width="100%" cellspacing="0" class="table table-bordered">
                              <thead>
                                <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Name</th>
                                  <th>Parent Category</th>
                                  <th>description</th>
                                  <th>Date Created</th>
                                  <th>Status</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                 @if(count($categories) > 0)    
                                    @foreach($categories as $category)
                                    @php
                                    $parentCates=\App\Models\Category::where('parent_id',$category->parent_id)->get();
                                    @endphp
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$category->name}}</td>
                                            <td>@foreach($parentCates as $parentCate)
                                              {{$parentCate->name}}
                                            @endforeach
                                            </td>
                                            <td>{{$category->description}}</td>
                                            <td>{{date_format($category->created_at,'jS M Y')}}</td>
                                            <td>{{($category->status == 0)?'Disabled':'Enable'}}</td>
                                            <td>
                                                <form action="{{route('categories.destroy',$category->id)}}" method="POST">
                                                    <a href="{{route('categories.show',$category->id)}}" title="show"><i class="fas fa-eye text-success fa-lg"></i></a>
                                                    <a href="{{route('categories.edit',$category->id)}}">
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
                                        <td colspan="7" class="text-center">EOD</td>
                                    </tr>
                                @endif
                              </tbody>
                            </table>
                          </div>
                          <!-- /.card-body -->
                     </div>
                </div>
            </div>
{!! $categories->links() !!}
        </div>
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
</script>
@endpush