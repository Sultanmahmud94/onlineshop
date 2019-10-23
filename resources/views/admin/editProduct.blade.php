<?php
$categories = \DB::table('categories')->get();
?>
<div class="col-md-12">

  <div class="row">
    <h1 class="page-header">Edit Product</h1>
  </div>
               


  <form action="{{ route('admin.editProduct', $product->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-md-8">

        <div class="form-group">
          <label for="product-title">Product Title </label>
          <input type="text" name="title" id="product-title" class="form-control" value="{{ $product->title }}">
        </div>


        <div class="form-group">
          <label for="product-description">Product Description</label>
          <textarea name="description" id="product-description" cols="30" rows="10" class="form-control">{{ $product->description }}</textarea>
        </div>



        <div class="form-group row">

          <div class="col-xs-3">
            <label for="product-price">Product Price</label>
            <input type="number" name="price" id="product-price" class="form-control" step="0.01" size="60" value="{{ $product->price }}">
          </div>

        </div>

      </div><!--Main Content-->


    <!-- SIDEBAR-->


    <aside id="admin_sidebar" class="col-md-4">

        
        <div class="form-group">
          <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
          <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
        </div>


        <!-- Product Categories-->

        <div class="form-group">
            <label for="product-category">Product Category</label>
            <select name="category" id="product-category" class="form-control">
              @foreach($categories as $category)

               @if($category->id === $product->category_id)

                <option selected="selected" value="{{ $category->id }}">{{ $category->title }}</option>

               @else

                <option value="{{ $category->id }}">{{ $category->title }}</option>
                
               @endif

              @endforeach
            </select>
        </div>

        <hr>
        <!-- Product Brands-->

        <div class="form-group">
          <label for="product-quantity">Quantity Available</label>
          <input type="number" name="quantity" id="product-quantity" class="form-control" value="{{ $product->quantity }}">
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
            <input type="file" name="imageFile" id="product-image"><br>
            <?php
              $path = $product->imagePath;
              $index = strpos($path, 'css');
              if(substr($path, 0, $index) !== "product_") {
                  $length = (int) strlen($path);
                  $imagePath = substr($path, $index, $length);
              }
            ?>
            <img width="200px" src="{{ URL::to($imagePath) }}" alt="{{ $product->title }}">
        </div>

    </aside><!--SIDEBAR-->
 
  </form>
</div>