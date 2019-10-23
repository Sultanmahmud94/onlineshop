<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('products.index') }}">Start Shoping</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ route('shopPage')}}">Shop</a>
                    </li>
                    <li>
                        <a href="{{ route('login')}}">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('admin')}}">Admin</a>
                    </li>
                     <li>

                      <?php $qty = 0;
                      foreach(session()->all() as $name => $value) {
                        if($value > 0) {
                          if(substr($name, 0, 8) === "product_") {
                            $qty += $value;
                          }
                        }
                      } ?>
                      
                        <a href="{{ route('checkout')}}">Checkout <span class="badge">{{ $qty }}</span></a>
                    </li>
                    <li>
                        <a href="{{ route('contact')}}">Contact</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>