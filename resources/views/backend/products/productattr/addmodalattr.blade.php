<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
        <div class="modal-content">            
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
               <form action="" method="POST" enctype="multipart/form-data" class="card-body">
              <div class="form-group">
                <label for="inputSKU">Product SKU</label>
                <input type="text" name="sku" id="inputsku" class="form-control" value=""  autocomplete="off" placeholder="SKU" required>
              </div>
              <div class="form-group">
                <label for="inputName">Product Size</label>
                <input type="text" name="size" id="inputsize" class="form-control" value="{{old('size')}}" autocomplete="off" placeholder="input product size">
              </div>
              <div class="form-group">
                <label for="inputDescription">Product Price</label>
                <input type="number" min="1000" name="price" id="inputprice" class="form-control" value="{{old('price')}}" autocomplete="off" placeholder="input product price" >
              </div>
              <div class="form-group">
                <label for="inputStock">Product Stock</label>
                <input type="number" name="stock" id="inputstock" class="form-control" value="{{old('stock')}}" autocomplete="off" placeholder="input product stock" min=0>
              </div>
              <div class="row">
                <div class="col-12">
                  <a href="" class="btn btn-secondary">Cancel</a>
                  <input type="hidden" name="productid" value="">
                  <input type="submit" value="Save Changes" class="btn btn-success">
                </div>
              </div>
            </form>
            <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>