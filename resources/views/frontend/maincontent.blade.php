<div class="row mb-5">
@role('superadmin')   
    <div class="col-md-12 mb-4">
        <div class="card">
            <a href=""><img src="#" class="card-img-top" alt="" /></a>
            <div class="card-body">
                <h5 class="card-title"><a href="">
                        Hai Superadmin
                </a></h5>
            </div>
        </div>
    </div>
 @endrole
    <div class="col-md-12 mb-4">
        <h2 class="title text-center">Features Product</h2>
    </div>
    @foreach($products as $product)
        @if($product->category->status==1)
        <div class="col-md-3 col-sm-3">
            <div class="card">
                <img src="{{url('imgs/thumb',$product->image)}}" class="card-img-top col-12 px-2 py-3" alt="">
                <div class="card-body px-2">
                    <span>{{$product->category->name}}</span>
                    <h5 class="card-title">{{$product->name}}</h5>
                    <p class="card-text">{{$product->price}}</p>
                    @role('superadmin')
                    <a href="#" class="btn btn-primary float-left">Buy <i class="fa fa-shopping-bag"></i></a>
                    @endrole
                    <a href="{{route('productdetail',$product->id)}}" class="btn btn-danger float-right">View <i class="fa fa-product-hunt"></i></a>
                </div>
            </div>
        </div>
        @endif
    @endforeach
</div>