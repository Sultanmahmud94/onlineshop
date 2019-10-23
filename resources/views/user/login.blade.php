<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::to('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::to('css/shop-homepage.css')}}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    @include('partials.header')

    <!-- Page Content -->
    <div class="container">

      <header>
            <h1 class="text-center">Login</h1>
        <div class="col-sm-4 col-sm-offset-5">         
            <form class="" action="{{ route('login') }}" method="post" enctype="multipart/form-data">
                {{  csrf_field() }}
                <div class="form-group"><label for="email">
                    Email<input type="email" id="email" name="email" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Password<input type="text" id="password" name="password" class="form-control"></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" >
                </div>
            </form>
        </div>  
            <h4 class="text-center">Don't have an account? <a href="{{ route('register') }}" style="display:block">Sign up instead!</a></h4>

    </header>


        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        @include('partials.footer')

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="{{ URL::to('js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::to('js/bootstrap.min.js')}}"></script>

</body>

</html>