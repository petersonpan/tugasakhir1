@extends('layoutbackend')
@section('titlebackend',"create")
@section('contentbackend')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Create category</li>
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
              <h3 class="card-title">General Category</h3>
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
            <form action="{{route('categories.store')}}" method="POST" class="card-body">
            @csrf
              <div class="form-group">
                <label for="inputName">Category Name</label>
                <input type="text" name="name" id="inputName" autocomplete="off" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">Category Level</label>
                 <select class="custom-select" name="parent_id">
                  @foreach($cate_levels as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                    @php
                  $subCategory=\App\Models\Category::where('parent_id',$key)->select('name','id')->get();
                    @endphp
                    @if($key!=0)
                      @if(count($subCategory) > 0)
                        @foreach($subCategory as $subCate)
                          <option value="{{$subCate->id}}">&nbsp;&nbsp;--{{$subCate->name}}--</option>
                        @endforeach
                      @endif
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="inputDescription">Category Description</label>
                <textarea id="inputDescription" name="description" class="form-control" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label for="inputName">Category URL</label>
                <input type="text" name="url" id="inputName" autocomplete="off" class="form-control">
              </div>
              <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" value="1">
                    <label class="form-check-label">Status Category</label>
                  </div>
                </div>
              <div class="row">
                <div class="col-12">
                  <a href="{{route('categories.index')}}" class="btn btn-secondary float-right">Cancel</a>&nbsp;
                  <input type="submit" value="Save Changes" class="btn btn-success float-left">
                </div>
              </div>
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
</section>
@endsection('contentbackend')