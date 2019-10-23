<?php
$orders = DB::table('orders')->get();

?>
<div class="col-md-12">
<div class="row">
<h1 class="page-header">
   All Orders

</h1>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>Order ID</th>
           <th>Total Price</th>
           <th>Amount Charged</th>
           <th>Quantity</th>
           <th>Transaction ID</th>
           <th>Order Date</th>
           <th>Currency</th>
           <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->total_price }}</td>
            <td>{{ $order->paypal_amount }}</td>
            <td>{{ $order->total_items }}</td>
            <td>{{ $order->transaction_id }}</td>
            <?php
              $date = new \Carbon\Carbon($order->created_at);
              
            ?>
            <td>{{ $date->format('l, jS \\of F, Y') }}</td>
            <td>{{ $order->currency }}</td>
           <td>{{ $order->status }}</td>
        </tr>
      @endforeach

    </tbody>
</table>
</div>