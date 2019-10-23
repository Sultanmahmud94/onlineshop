<?php
$categories = \DB::table('categories')->get();
?>
<div class="col-md-12">

  <div class="row">
    <h1 class="page-header"> Add Product</h1>
  </div>
               


  <form action="{{ route('admin.addProduct') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-md-8">

        <div class="form-group">
          <label for="product-title">Product Title </label>
          <input type="text" name="title" id="product-title" class="form-control">
        </div>


        <div class="form-group">
          <label for="product-description">Product Description</label>
          <textarea name="description" id="product-description" cols="30" rows="10" class="form-control"></textarea>
        </div>



        <div class="form-group row">

          <div class="col-xs-3">
            <label for="product-price">Product Price</label>
            <input type="number" name="price" id="product-price" step="0.01" class="form-control" size="60">
          </div>

        </div>

      </div><!--Main Content-->


    <!-- SIDEBAR-->


    <aside id="admin_sidebar" class="col-md-4">

        
        <div class="form-group">
          <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
          <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
        </div>


        <!-- Product Categories-->

        <div class="form-group">
            <label for="product-category">Product Category</label>
            <select name="category" id="product-category" class="form-control">
              @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
              @endforeach
            </select>
        </div>

        <hr>
        <!-- Product Brands-->

        <div class="form-group">
          <label for="product-quantity">Quantity Available</label>
          <input type="number" name="quantity" id="product-quantity" class="form-control">
        </div>


    <!-- Product Tags -->
        <hr>

        {{-- <div class="form-group">
            <label for="product-image">Product Image Name</label>
            <input type="text" name="imageName" id="product-image" class="form-control">
        </div> --}}

        <!-- Product Image -->
        <div class="form-group">
            <label for="product-image">Product Image</label>
            <input type="file" name="imageFile" id="product-image">
        </div>

    </aside><!--SIDEBAR-->
 
  </form>
</div>