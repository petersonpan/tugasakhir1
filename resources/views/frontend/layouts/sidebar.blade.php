<?php
    $i=0; 
    $categories=DB::table('categories')->where([['status',1],['parent_id',0]])->get();
 ?>
<div class="accordion" id="accordionExample">
    @foreach($categories as $category)
        <?php 
        $sub_categories=DB::table('categories')->where([['status',1],['parent_id',$category->id]])->get();
         ?>
  <div class="card">
    <div class="card-header" id="heading{{$categories[$i]->id}}" data-toggle="collapse" data-target="#collapse{{$categories[$i]->id}}" aria-expanded="true" aria-controls="collapse{{$categories[$i]->id}}">
      <h6 class="mb-0">
      @if(count($sub_categories) > 0)
        <div>{{$categories[$i]->name}} <span class="fa fa-caret-down float-right"></span></div>
      @endif
      </h6>
    </div>
    <div id="collapse{{$category->id}}" class="collapse @if($category->id == 1) show @else '' @endif" aria-labelledby="heading{{$category->id}}" data-parent="#accordionExample">
      <div>
         <div class="list-group list-group-flush">
            <?php $j=0; ?>
            @foreach($sub_categories as $subcategory)
            <a href="{{route('cats',$subcategory->id)}}" class="list-group-item">{{$subcategory->name}}</a>
            <?php $j++; ?>
            @endforeach
          </div>
      </div>
    </div>
  </div>
  <?php $i++; ?>
  @endforeach
</div>