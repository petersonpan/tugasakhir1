@extends('layoutfrontend')
@section('fronttitle',"Home")
@section('content')
    <div class="row">
        <div class="col-md-8">
            @include('frontend.maincontent')
        </div>
        <div class="col-md-4">
            @include('frontend.layouts.sidebar')
        </div>
    </div>
@endsection('content')