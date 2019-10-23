<?php
$products = \App\Product::with('category')->paginate(9);
?>
<div class="row">

  <h1 class="page-header">All Products</h1>
  <h3 class="bg-success text-center">{{ session()->has('productStatus') ? session()->get('productStatus') : "" }}</h3>
  <table class="table table-hover">

      <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Price</th>
        </tr>
      </thead>

      <tbody>
        @foreach($products as $product)
          <tr>
            <td>{{ $product->id }}</td>
            <td><a href="{{ route('admin.editProduct', $product->id) }}">{{ $product->title }}  <br>
              <?php
                  $path = $product->imagePath;
                  $index = strpos($path, 'images');
                  if(substr($path, 0, $index) !== "product_") {
                      $length = (int) strlen($path);
                      $imagePath = substr($path, $index, $length);
                  }
                ?>
              <img width="200px" height="200px" src="{{ asset('storage/' . $imagePath) }}" alt="{{ $product->title }}"></a>
            </td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->category['title'] }}</td>
            <td>&#36;{{ $product->price }}</td>
            <td><a class="btn btn-danger" href="{{ route('admin.deleteProduct', $product->id) }}"><span class="glyphicon glyphicon-remove"></span></a></td>
          </tr>
        @endforeach
    </tbody>

  </table>
<nav>{{ $products->links() }}</nav>
</div>