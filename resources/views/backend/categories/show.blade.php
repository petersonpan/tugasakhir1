@extends('layoutbackend')
@section('titlebackend',"show")
@section('contentbackend')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Show category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Dashboard</a></li>
              @for($i=2;$i<=count(Request::segments())-1;$i++)
              <li class="breadcrumb-item active">
                  <a href="">{{Request::segment($i)}}</a>
              </li>
              @endfor
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
              <h3 class="card-title">Category</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Category Name</label>
                <input type="text" name="name" id="inputName" class="form-control" value="{{$categories->name}}">
              </div>
              <div class="form-group">
                <label for="inputDescription">Category Description</label>
                <textarea id="inputDescription" name="description" class="form-control" rows="4">{{$categories->description}}</textarea>
              </div>
              <div class="form-group">
                  <label>Created at:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    @php
                        $date=date_create($categories->created_at)
                    @endphp
                    <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" value="{{date_format($date,'d/m/Y')}}" im-insert="false">
                  </div>
                  <!-- /.input group -->
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
</section>  
@endsection