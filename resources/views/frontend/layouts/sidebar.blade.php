<!-- <div class="card mb-4">
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
</div> -->
<!-- Recent Posts -->
<div class="card mb-4">
    <h5 class="card-header">Recent Posts</h5>
    <div class="list-group list-group-flush">
        <a href="" class="list-group-item">Post 1</a>
    </div>
</div>
<!-- Popular Posts -->
<div class="card mb-4">
    <h5 class="card-header">Category Product</h5>
    <div class="list-group list-group-flush">
        <a href="#" class="list-group-item">Post 1</a>
    </div>
</div>

<?php 
    $categories=DB::table('categories')->where([['status',1],['parent_id',0]])->get();
 ?>
<div class="accordion" id="accordionExample">
    @foreach($categories as $category)
    <?php 
    $sub_categories=DB::table('categories')->where([['status',1],['parent_id',$categories->id]])->get();
     ?>
  <div class="card">
    <div class="card-header" id="heading{{$categories->id}}">
      <h6 class="mb-0">
        <div type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </div>
      </h6>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="">
         <div class="list-group list-group-flush">
            <a href="#" class="list-group-item">Post 1</a>
            <a href="#" class="list-group-item">Post 2</a>
          </div>
      </div>
    </div>
  </div>
  @endforeach
</div>