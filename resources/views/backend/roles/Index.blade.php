@extends('layoutbackend')
@section('titlebackend',"Index Role Management")
@section('contentbackend')
@push('style')
<link rel="stylesheet" href="{{url('backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Role</li>
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
                            <h3 class="card-title">Role</h3>
                            <div class="card-tools">
                                <a href="{{route('roles.create')}}" type="button" class="btn btn-tool" title="Create Category">
                                  <i class="fas fa-plus"></i></a>
                              </div>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <table id="example1" class="table table-bordered">
                              <thead>
                                <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Role</th>
                                  <th>Slug</th>
                                  <th>Permissions</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Role</th>
                                  <th>Slug</th>
                                  <th>Permissions</th>
                                  <th>Actions</th>
                                </tr>
                              </tfoot>
                              <tbody>
                                 @if(count($roles) > 0)
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>{{$role->slug}}</td>
                                            <td>
                                              @if($role->permissions!=null)
                                                @foreach($role->permissions as $permission)
                                                  <span class="badge badge-secondary">
                                                    {{$permission->name}}
                                                  </span>
                                                @endforeach
                                              @endif
                                            </td>
                                            <td>
                                                <form action="{{route('roles.destroy',$role->id)}}" method="POST">
                                                    <a href="{{route('roles.show',$role->id)}}" title="show"><i class="fas fa-eye text-success fa-lg"></i></a>
                                                    <a href="{{route('roles.edit',$role->id)}}">
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