@extends('layoutbackend')
@section('titlebackend',"User")
@section('contentbackend')
	 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
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
                            <h3 class="card-title">User</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body p-0">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                 @if(count($data) > 0)    
                                    @foreach($data as $User)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$User->name}}</td>
                                            <td>{{$User->email}}</td>
                                            <td>
                                                <form action="" method="POST">
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
{!! $data->links() !!}
        </div>
    </section>
@endsection('contentbackend')