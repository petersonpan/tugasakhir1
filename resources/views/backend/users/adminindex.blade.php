@extends('layoutbackend')
@section('titlebackend',"Create User Management")
@section('contentbackend')
	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">User</li>
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
                            <h3 class="card-title">Admin User</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body p-0">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Name</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                 @if(count($dataview) > 0)    
                                    @foreach($dataview as $data)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$data->username}}</td>
                                            <td>
                                                <form action="{{$data->id}}" method="POST">
                                                    <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                                        <i class="fas fa-trash fa-lg text-danger"></i>
                                                    </button>
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
                          </div>
                          <!-- /.card-body -->
                     </div>
                </div>
            </div>
{!! $dataview->links() !!}
        </div>
    </section>
@endsection('contentbackend')