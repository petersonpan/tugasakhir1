@extends('layoutbackend')
@section('titlebackend',"Edit Roles")
@section('addoncss')
  <link rel="stylesheet" type="text/css" href="{{asset('css')}}/bootstrap-tagsinput.css">
@endsection('addoncss')
@section('contentbackend')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Role</h1>
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
		<div class="col-md-6">
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Roles</h3>
					<div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
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
            	<form action="{{route('roles.update',$role->id)}}" class="card-body" method="POST">
            		@csrf
            		@method('PUT')
					<div class="form-group">
						<label for="roleName">Role Name</label>
						<input type="text" name="role_name" id="role_name" class="form-control"  value="{{$role->name}}" required>
					</div>
					<div class="form-group">
						<label for="roleSlug">Role Slug</label>
						<input type="text" name="role_slug" id="role_slug" class="form-control" value="{{$role->slug}}" required>
					</div>
					<div class="form-group">
						<label for="rolePermission">Edit Permissions</label>
						<input type="text" data-role="tagsinput" name="roles_permissions" id="roles_permissions" class="form-control"  value="@foreach($role->permissions as $permission){{$permission->name.','}}@endforeach">
					</div>
					<div class="form-group pt-2">
				        <input class="btn btn-primary" type="submit" value="Submit">
				    </div>
  				</form>
			</div>
		</div>		
	</div>
</section>
@endsection
@section("addon")
  <script src='{{asset("js")}}/bootstrap-tagsinput.js'></script>
  <script type="text/javascript">
     $(document).ready(function(){
            $('#role_name').keyup(function(e){
                var str = $('#role_name').val();
                str = str.replace(/\W+(?!$)/g, '-').toLowerCase();//rplace stapces with dash
				console.log(str);
                $('#role_slug').val(str);
                $('#role_slug').attr('placeholder', str);
            });
        });

  </script>
@endsection