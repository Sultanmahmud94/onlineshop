@extends('layouts.master')

@section('title')

  Shop Homepage

@endsection

@section('styles')

  <!-- Custom CSS -->
  <link href="{{ URL::to('css/shop-homepage.css')}}" rel="stylesheet">
  <link href="{{ URL::to('css/app.css')}}" rel="stylesheet">

@endsection

@section('content')

  @include('partials.sideNav')

  <div class="col-md-9">

  @include('partials.slider')
  <h4 class="text-center bg-danger">{{ session()->has('status') ? session()->get('status') : "" }}</h4>
  @foreach ($products->chunk(3) as $productChunk)

    <div class="row">
    
      @foreach ($productChunk as $product)

        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
                <?php
                  $path = $product->imagePath;
                  $index = strpos($path, 'images');
                  if(substr($path, 0, $index) !== "product_") {
                      $length = (int) strlen($path);
                      $imagePath = substr($path, $index, $length);
                      //dd(asset('storage/' . $imagePath));
                      //$framgents = explode('/', $path);
                      //dump($framgents);
                  }
                ?>
                <a href="{{ route('singleProduct', $product->id) }}"><img style="height:260px; width:260px;" src="{{ asset('storage/' . $imagePath) }}" alt=""></a>
                <div class="caption caption_height">
                    <h4 class="pull-right">&#36;{{ $product->price }}</h4>
                    <h4><a href="{{ route('singleProduct', $product->id) }}">{{ $product->title }}</a>
                    </h4>
                    <p>{{ $product->description }}</p>
                    <a class="btn btn-primary" href="{{ route('cart.index', ['add' => $product->id]) }}">Add To Cart</a>
                </div>
            </div>
        </div>

      @endforeach

    </div>
<?php //die(); ?>
  @endforeach
  <nav>{{ $products->links() }}</nav>
  </div>


@endsection



{{-- <nav>
  <ul class="pagination">
    <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav> --}}

{{-- <div class="ratings">
    <p class="pull-right">15 reviews</p>
    <p>
        <span class="glyphicon glyphicon-star"></span>
        <span class="glyphicon glyphicon-star"></span>
        <span class="glyphicon glyphicon-star"></span>
        <span class="glyphicon glyphicon-star"></span>
        <span class="glyphicon glyphicon-star"></span>
    </p>
</div> --}}

{{-- <div class="col-sm-4 col-lg-4 col-md-4">
    <h4><a href="#">Like this template?</a>
    </h4>
    <p>If you like this template, then check out <a target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">this tutorial</a> on how to build a working review system for your online store!</p>
    <a class="btn btn-primary" target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">View Tutorial</a>
</div> --}}

<?php
/*
list($width, $height, $type, $attr) = getimagesize($imagePath);
echo $width . " " . $height . " Type: " . $type . " " . $attr;

$im = imagecreatefromjpeg($imagePath);
//$size = min(imagesx($im), imagesy($im));
$im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => 700, 'height' => 700]);
if ($im2 !== FALSE) {
    imagejpeg($im2, 'cropped.jpeg');
    imagedestroy($im2);
}
imagedestroy($im);*/

?>
