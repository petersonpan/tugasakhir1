@extends('layoutfrontend')
@section('fronttitle',"Home")
@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('frontend.layouts.sidebar')
        </div>
        <div class="col-md-9">
            @include('frontend.maincontent')
        </div>
    </div>
@endsection('content')