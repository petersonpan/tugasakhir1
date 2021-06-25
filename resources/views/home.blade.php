@extends('layoutfrontend')
@section('fronttitle',"Home")
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="card">
                        <a href=""><img src="#" class="card-img-top" alt="" /></a>
                        <div class="card-body">
                            <h5 class="card-title"><a href="">
                                @role('developer')
                                    Hai Developer
                                @endrole
                            </a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <form action="">
                        <div class="input-group">
                          <input type="text" name="q" class="form-control" />
                          <div class="input-group-append">
                            <button class="btn btn-dark" type="button" id="button-addon2">Search</button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Recent Posts -->
            <div class="card mb-4">
                <h5 class="card-header">Recent Posts</h5>
                <div class="list-group list-group-flush">
                    <a href="" class="list-group-item"></a>
                </div>
            </div>
            <!-- Popular Posts -->
            <div class="card mb-4">
                <h5 class="card-header">Popular Posts</h5>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item">Post 1</a>
                    <a href="#" class="list-group-item">Post 2</a>
                </div>
            </div>
        </div>
    </div>
@endsection('content')