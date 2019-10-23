@extends('layouts.master')

@section('title')

  Shop Checkout

@endsection

@section('styles')

  <!-- Custom CSS -->
  <link href="{{ URL::to('css/heroic-features.css')}}" rel="stylesheet">
  <link href="{{ URL::to('css/app.css')}}" rel="stylesheet">

@endsection

@section('content')

<div class="row">
      <h4 class="text-center bg-danger">{{ session()->has('status') ? session()->get('status') : "" }}</h4>
      <h1>Checkout</h1>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
{{ csrf_field() }}
  <input type="hidden" name="cmd" value="_cart">
  <input type="hidden" name="business" value="micheal@ecom.com">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
          </tr>
        </thead>
        <tbody>
        <?php $total = 0; $qty = 0; $cart = [];
          $item_name = 1; $item_number = 1; $amount = 1; $quantity = 1;
        ?>
        @foreach(session()->all() as $name => $value)
          @if($value > 0)
            @if(substr($name, 0, 8) === "product_")
              <?php
                $length = (int) strlen($name);
                $id = (int) substr($name, 8, $length);
                $productA = DB::table('products')->where('id', $id)->get();
                $product = $productA[0];
                $sub = ($product->price) * (session()->has('product_' . $product->id) ? session()->get('product_' . $product->id) : 0);
                $subQty = session()->has('product_' . $product->id) ? session()->get('product_' . $product->id) : 0;
              ?>
              <tr>
                <td>{{ $product->title }}</td>
                <td>&#36;{{ $product->price }}</td>
                <td>{{ $subQty }}</td>
                <td>&#36;{{ $sub }}</td>
                <td>
                  <a class="btn btn-success" href="{{ route('cart.checkout', ['add' => $product->id]) }}"><span class="glyphicon glyphicon-plus"></span></a>
                  <a class="btn btn-warning" href="{{ route('cart.checkout', ['remove' => $product->id]) }}"><span class="glyphicon glyphicon-minus"></span></a>
                  <a class="btn btn-danger" href="{{ route('cart.checkout', ['removeAll' => $product->id]) }}"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
              </tr>
              <input type="hidden" name="item_name_{{ $item_name }}" value="{{ $product->title }}">
              <input type="hidden" name="item_number_{{ $item_number }}" value="{{ $product->id }}">
              <input type="hidden" name="amount_{{ $amount }}" value="{{ $product->price }}">
              <input type="hidden" name="quantity_{{ $quantity }}" value="{{ $value }}">
              <?php $total += $sub; $qty += $subQty; 
                $item_name++; $item_number++; $amount++; $quantity++;
                //array_push($cart, ['product_id'=>$product->id, 'title'=>$product->title, 'itemPrice'=>$product->price, 'quantity'=>$subQty, 'totalAmount'=> $sub]);

              ?>
            @endif
          @endif
        @endforeach
        </tbody>
    </table>
    @if($qty > 0)
      <input type="image" name="upload"
      src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
      alt="PayPal - The safer, easier way to pay online">
    @endif
    <input type="hidden" name="return" value="http://project-ecom.site/thank-you">
</form>

<!--  ***********CART TOTALS*************-->
       <?php 
       //array_unshift($cart, ['totalItems'=> $qty, 'totalPrice'=> $total]);
       //session()->put('cart', $cart); ?>

  <div class="col-xs-4 pull-right ">
    <h2>Cart Totals</h2>

    <table class="table table-bordered" cellspacing="0">

      <tr class="cart-subtotal">
        <th>Items:</th>
        <td><span class="amount">{{ $qty }}</span></td>
      </tr>
      <tr class="shipping">
        <th>Shipping and Handling</th>
        <td>Free Shipping</td>
      </tr>

      <tr class="order-total">
        <th>Order Total</th>
        <td><strong><span class="amount">&#36;{{ $total }}</span></strong> </td>
      </tr>


      </tbody>

    </table>

  </div><!-- CART TOTALS-->

</div><!--Main Content-->

@endsection