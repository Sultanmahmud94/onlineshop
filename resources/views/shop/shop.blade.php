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
                }
              ?>
                <a href="{{ route('singleProduct', $product->id) }}"><img style="height:260px; width:260px;" src="{{ asset('storage/' . $imagePath) }}" alt=""></a>
                <div class="caption caption_height">
                    <h4 class="pull-right">&#36;{{ $product->price }}</h4>
                    <h4><a href="{{ route('singleProduct', $product->id) }}">{{ $product->title }}</a>
                    </h4>
                    <p>{{ $product->description }}</p>
                    <a class="btn btn-primary" href="{{ route('cart.shop', ['add' => $product->id]) }}">Add To Cart</a>
                </div>
            </div>
        </div>

      @endforeach

    </div>

  @endforeach
  <nav>{{ $products->links() }}</nav>
  </div>

@endsection