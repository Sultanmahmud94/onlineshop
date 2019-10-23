<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::to('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::to('css/heroic-features.css')}}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('styles')
</head>

<body>
@include('partials.header')

<!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>A Warm Welcome!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <p><a class="btn btn-primary btn-large">Call to action!</a>
            </p>
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>All Products in "{{ $products[1]->category->title }}" Category</h3>
            </div>
        </div>
        <!-- /.row -->
      @foreach ($products->chunk(3) as $productChunk)

        <!-- Page Features -->
        <div class="row text-center">

      @foreach ($productChunk as $product)
        
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                  <?php
                    $path = $product->imagePath;
                    $index = strpos($path, 'css');
                    if(substr($path, 0, $index) !== "product_") {
                        $length = (int) strlen($path);
                        $imagePath = substr($path, $index, $length);
                    }
                  ?>
                    <img src="{{ URL::to($imagePath) }}" alt="">
                    <div class="caption">
                        <h3>{{ $product->title }}</h3>
                        <p>{{ $product->description }}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Add to Cart</a> <a href="{{ route('singleProduct', $product->id)}}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

       @endforeach     

        </div>
        <!-- /.row -->

      @endforeach 


        <hr>
  @include('partials.footer')
</div>

<!-- jQuery -->
    <script src="{{ URL::to('js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::to('js/bootstrap.min.js')}}"></script>
    @yield('scripts')
</body>
</html>