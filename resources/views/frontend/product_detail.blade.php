@extends('layoutfrontend')
@section('fronttitle',"product detail")
@section('frontendcss')
    
    <link rel='stylesheet' href='{{asset("css/lightslider.css")}}'>
    <!-- <script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js" ></script> -->
    <!-- <script src='https://code.jquery.com/jquery-3.2.1.min.js' integrity='sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=' crossorigin='anonymous'> -->

@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('frontend.layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="row no-gutters">
                <div class="col-md-5 pr-2">
                <div class="">
                    <div class="slideshow">
                        <ul class="big">
                            <li data-thumb="{{url('imgs/full',$detail_product->image)}}"> <img src="{{url('imgs/full',$detail_product->image)}}" /> </li>
                            @if(count($imagesGallery) > 0)
                             @foreach($imagesGallery as $img)    
                            <li data-thumb="{{url('imgs/full',$img['image'])}}"> <img src="{{url('imgs/full',$img['image'])}}" /> </li>
                              @endforeach
                            @else
                            <li data-thumb="{{url('imgs/thumb','no-image.png')}}"> <img src="{{url('imgs/thumb','no-image.png')}}" /> </li>        
                            @endif
                        </ul>
                        <ul class='controls'>
                            <li class='prev'>&lt;</li>
                            <li class='next'>&gt;</li>
                        </ul>
                        <ul class="thumb">
                            <li data-thumb="{{url('imgs/full',$detail_product->image)}}"> <img src="{{url('imgs/thumb',$detail_product->image)}}" /> </li>
                        @if(count($imagesGallery) > 0)    
                            @foreach($imagesGallery as $img)    
                                <li data-thumb="{{url('imgs/full',$img['image'])}}"> <img src="{{url('imgs/thumb',$img['image'])}}" /> </li>
                             @endforeach
                        @else
                            <li data-thumb="{{url('imgs/full','no-image.png')}}"> <img src="{{url('imgs/full','no-image.png')}}" /> </li>
                        @endif
                        </ul>
                    </div>

                </div>
                <!-- <div class="card mt-2 p-2">
                    <h6>Reviews</h6>
                    <div class="d-flex flex-row">
                        <div class="stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div> <span class="ml-1 font-weight-bold">4.6</span>
                    </div>
                    <hr>
                    <div class="badges"> <span class="badge bg-dark ">All (230)</span> <span class="badge bg-dark "> <i class="fa fa-image"></i> 23 </span> <span class="badge bg-dark "> <i class="fa fa-comments-o"></i> 23 </span> <span class="badge bg-warning"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="ml-1">2,123</span> </span> </div>
                    <hr>
                    <div class="comment-section">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row align-items-center"> <img src="https://i.imgur.com/o5uMfKo.jpg" class="rounded-circle profile-image">
                                <div class="d-flex flex-column ml-1 comment-profile">
                                    <div class="comment-ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div> <span class="username">Lori Benneth</span>
                                </div>
                            </div>
                            <div class="date"> <span class="text-muted">2 May</span> </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row align-items-center"> <img src="https://i.imgur.com/tmdHXOY.jpg" class="rounded-circle profile-image">
                                <div class="d-flex flex-column ml-1 comment-profile">
                                    <div class="comment-ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div> <span class="username">Timona Simaung</span>
                                </div>
                            </div>
                            <div class="date"> <span class="text-muted">12 May</span> </div>
                        </div>
                    </div>
                </div> -->
                </div>
                <div class="col-md-7">
                <div class="card cardcustom">
                    <form action="" method="POST">
                        @csrf
                        <input type="hidden" value="{{$detail_product->id}}" name="product_id">
                        <input type="hidden" value="{{$detail_product->name}}" name="product_name">
                        <input type="hidden" value="{{$detail_product->p_code}}" name="product_code">
                        <input type="hidden" value="{{$detail_product->price}}" name="product_price">
                    <!-- <div class="d-flex flex-row align-items-center">
                        <div class="p-ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div> <span class="ml-1">5.0</span>
                    </div> -->
                    <div class="about"> <span class="font-weight-bold">{{$detail_product->name}}</span>
                        <h4 class="font-weight-bold">Rp{{$detail_product->price}}</h4>
                    </div>
                    <div class="buttons"> 
                        <button class="btn btn-outline-warning btn-long cart">Add to Cart</button> <!-- <button class="btn btn-warning btn-long buy">Buy it Now</button> --> <!-- <button class="btn btn-light wishlist"> <i class="fa fa-heart"></i> </button> --> </div>
                    <hr>
                    <div class="product-description">
                        <div><span class="font-weight-bold">Color:</span>
                            <?php $listColor=explode(',', $detail_product->color); ?>
                            <span style="background-color:{{$detail_product->color}};border-c olor:{{$detail_product->color}};"></span></div>
                        <div class="my-color"> 
                            @foreach($listColor as $value => $key)
                                <label class="radio"><input type="radio" name="p_color[]" value="<?php echo $key ?>" @if($value==0)
                                <?php echo "checked" ?> @endif ><span style="background-color:<?php echo $key;?>;border-color:<?php echo $key;?>;"></span> </label>
                            @endforeach
                            <!-- <label class="radio"><input type="radio" name="p_color[]" value="FEMALE"> <span class="blue"></span> </label> 
                            <label class="radio"> <input type="radio" name="p_color[]" value="FEMALE"> <span class="green"></span> </label> 
                            <label class="radio"> <input type="radio" name="p_color[]" value="FEMALE"> <span class="orange"></span> </label> --> 
                        </div>
                        <div>
                            <span class="font-weight-bold">Select Size:</span>
                            <label for="" class="radio">
                                <select name="productsize" id="Productsize">
                                    <option value="">Select Size</option>
                                     @foreach($detail_product->attributes as $attr)       
                                    <option value="{{$detail_product->id}}-{{$attr->size}}"><?php echo $attr->size;?></option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class="d-flex flex-row align-items-center"> <i class="fa fa-calendar-check-o"></i> <span class="ml-1">Delivery from sweden, 15-45 days</span> </div>
                        <div class="mt-2"> <span class="font-weight-bold">Description</span>
                            <p>{{$detail_product->description}}</p>
                            <div class="bullets">
                                <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text">Best in Quality</span> </div>
                                <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text">Anti-creak joinery</span> </div>
                                <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text">Sturdy laminate surfaces</span> </div>
                                <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text">Relocation friendly design</span> </div>
                                <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text">High gloss, high style</span> </div>
                                <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text">Easy-access hydraulic storage</span> </div>
                            </div>
                        </div>
                        <div class="mt-2"> <span class="font-weight-bold">Store</span> </div>
                            <div class="d-flex flex-row align-items-center"> <img src="https://i.imgur.com/N2fYgvD.png" class="rounded-circle store-image">
                                <div class="d-flex flex-column ml-1 comment-profile">
                                    <div class="comment-ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div> <span class="username">Rare Boutique</span> <small class="followers">25K Followers</small>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
@section('frontendjs')
<script type="text/javascript" src='{{asset("js/jquery.min.js")}}'></script>
<script type="text/javascript">
    $(document).ready(function(){
    //When we click on thumb img
$('.thumb li', '.slideshow').click(function() {
    
    var
        //SlideShow
        sshow = $(this).closest('.slideshow'),
        //Big
        big = sshow.find('.big'),
        //thumb
        thumb = sshow.find('.thumb'),
        //Get index
        indx = thumb.find('li').index(this),
        //Current index
        currentIndx = big.find('li').index(big.find('li:visible'));
    
    //If currentIndx is same as clicked indx don't do anything
    if(currentIndx == indx) {
        return;
    }
    
    big
        //Fadeout current image
        .find('li:visible').fadeOut().end()
        //Fadein new image
        .find('li:eq(' + indx + ')').fadeIn();
});

//When we click on any li inside controls section
$('.controls li').click(function() {
    var
        //Slideshow
        sshow = $(this).closest('.slideshow'),
        //Increment
        incr = $(this).hasClass('prev') ? -1 : 1,
        //Current Index
        currentIndx = sshow.find('.big li').index(sshow.find('.big li:visible')),
        //Final Index
        finalIndx = currentIndx + incr;
    
    //Check ranges
    finalIndx = (finalIndx >= 4) ? 0 : ( (finalIndx < 0) ? 3 : finalIndx);
    
    //Now trigger click event on respective image in nav
    sshow.find('.thumb li:eq(' + finalIndx + ')').trigger('click');
});

});
</script>
@endsection