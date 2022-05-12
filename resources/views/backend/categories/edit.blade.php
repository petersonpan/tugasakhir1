@extends('layoutbackend')
@section('titlebackend',$title)
@section('contentbackend')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit category</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Category Edit</li>
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
                    <?php echo $menu_active; ?>
                </ul>
            </div>
            @endif
            <form action="{{route('categories.update',$category->id)}}" method="POST" class="card-body">
            @csrf
            @method('PUT')
              <div class="form-group">
                <label for="inputName">Category Name</label>
                <input type="text" name="name" id="inputName" class="form-control" value="{{$category->name}}">
              </div>
              <div class="form-group">
                <label for="inputName">Category Level</label>
                  <select class="custom-select" name="parent_id">
                    @foreach($cate_levels as $key => $value)
                      <option value="{{$key}}" {{($category->parent_id == $key)?'selected':''}}>{{$value}}</option>
                        @php
                          $subCategory=\App\Models\Category::where('parent_id',$key)->select('name','id')->get();
                        @endphp
                        @if($key!=0)
                          @if(count($subCategory) > 0)
                            @foreach($subCategory as $subCate => $val)
                              <option value="{{$val->id}}">&nbsp;&nbsp;---{{$val->name}}---</option>
                            @endforeach
                          @endif
                        @endif
                    @endforeach
                  }
                </select>
              </div>
              <div class="form-group">
                <label for="inputDescription">Category Description</label>
                <textarea id="inputDescription" name="description" class="form-control" rows="4">{{$category->description}}</textarea>
              </div>
              <div class="form-group">
                <label for="inputDescription">URL Description</label>
                <input type="text" name="url" id="inputName" class="form-control" value="{{$category->url}}">
              </div>
              <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" value="1" {{($category->status==0)?'':'checked'}}>
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
@endsection