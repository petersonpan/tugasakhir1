@extends('layoutbackend')
@section('titlebackend',"Create User Management")
@section('contentbackend')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Create Users</h1>
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
					<h3 class="card-title">Users</h3>
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
            	<form action="{{route('user.store')}}" method="POST" class="card-body" enctype="multipart/form-data">
            		@csrf
					<div class="form-group">
						<label for="name">User Name</label>
						<input type="text" name="name" id="name" class="form-control"  value="{{ old('name') }}" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password"  name="password" id="password" class="form-control" required minlength="8" >
					</div>
					<div class="form-group">
						<label for="password">Password confirmation</label>
						<input type="password"  name="password_confirm" id="password_confirm" class="form-control" required minlength="8">
					</div>
					<div class="form-group">
				        <label for="role">Select Role</label>
				        <select class="role form-control" name="role" id="role">
				            <option value="">Select Role...</option>
				            @foreach ($roles as $role)
				            <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}">{{$role->name}}</option>
				            @endforeach
				        </select>
				    </div>
				    <div id="permissions_box" class="form-group">
				        <label for="roles">Select Permissions</label>
				        <div id="permissions_ckeckbox_list">
				        </div>
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
<script type="text/javascript">
	 $(document).ready(function(){
            var permissions_box = $('#permissions_box');
            var permissions_ckeckbox_list = $('#permissions_ckeckbox_list');

            permissions_box.hide(); // hide all boxes


            $('#role').on('change', function() {
                var role = $(this).find(':selected');    
                var role_id = role.data('role-id');
                var role_slug = role.data('role-slug');

                permissions_ckeckbox_list.empty();

                $.ajax({
                    url: "{{route('user.create')}}",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        role_id: role_id,
                        role_slug: role_slug,
                    }
                }).done(function(data) {
                    
                    console.log(data);
                    
                    permissions_box.show();                        
                    // permissions_ckeckbox_list.empty();

                    $.each(data, function(index, element){
                        $(permissions_ckeckbox_list).append(       
                            '<div class="custom-control custom-checkbox">'+                         
                                '<input class="custom-control-input" type="checkbox" name="permissions[]" id="'+ element.slug +'" value="'+ element.id +'">' +
                                '<label class="custom-control-label" for="'+ element.slug +'">'+ element.name +'</label>'+
                            '</div>'
                        );

                    });
                });
            });
        });

</script>
@endsection