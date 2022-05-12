@extends('layoutfrontend')
@section('fronttitle',"Product Category")
@section('content')
	<div class="row">
        <div class="col-md-3">
            @include('frontend.layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="row">
            	<div class="col-md-12 mb-4">
        <?php
            if($getMainCat){
                echo "<h2 class='title text-center'>".$getMainCat->name."</h2>";
            }else{
                echo "<h2 class='title text-center'>Features Item</h2>";
            }
         	?>
            	</div>
            	@foreach($productlist as $product)
            	 @if($product->category->status == 1)
            	<div class="col-md-3 col-sm-3">
            		<div class="card">
            			<img src="{{url('imgs/thumb',$product->image)}}" alt="" class="card-img-top px-2 py-3">
						<div class="card-body px-2">
							<span>{{$product->category->name}}</span>
							<h5 class="card-title">{{$product->name}}</h5>
							<p class="card-text">{{$product->price}}</p>
                            @role('superadmin')
							<a href="#" class="btn btn-primary float-left">Buy <i class="fa fa-shopping-bag"></i></a>@endrole
							<a href="{{route('productdetail',$product->id)}}" class="btn btn-danger float-right">View <i class="fa fa-product-hunt"></i></a>
						</div>
            		</div>
            	</div>
            	 @endif
            	@endforeach
            </div>
        </div>
    </div>
@endsection