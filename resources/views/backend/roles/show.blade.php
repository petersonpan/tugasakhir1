@extends('layoutbackend')
@section('titlebackend',"show roles")
@section('contentbackend')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Show Role</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">{{Request::segment(2)}}</li>
          <li class="breadcrumb-item active">{{Request::segment(3)}}</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
	<div class="row">
		<div class="container-fluid">
			<div class="card">
				<div class="card-header">
					<h3>Name:{{$role['name']}}</h3>
					<h4>Slug:{{$role['slug']}}</h4>
				</div>
				<div class="card-body">
					<h5 class="card-title">Permissions</h5>
		            <p class="card-text">
		                @if($role->permissions!=null)
                            @foreach($role->permissions as $permission)
                              <span class="badge badge-secondary">
                                {{$permission->name}}
                              </span>
                            @endforeach
                          @endif
		            </p>
				</div>
				<div class="card-footer">
		            <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
		        </div>
			</div>
		</div>		
	</div>
</section>
@endsection