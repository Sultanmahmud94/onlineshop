<?php

namespace App;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class Cart
{
  public static function addOneItem($request, $input) {
      $quantity = Session::has('product_' . $input) ? Session::get('product_' . $input) : 0;
      $product = Product::find($input)->only(['quantity', 'title']);
      $quantity < $product['quantity'] ? $quantity++ : Session::flash('status', 'We only have ' . $product['quantity'] . ' items of ' . $product['title'] .  ' available!');
      Session::put('product_' . $input, $quantity);
      return true;
  }

  public static function removeOneItem($request, $input) {
      $quantity = Session::has('product_' . $input) ? Session::get('product_' . $input) : 0;
      $quantity < 1 ? $quantity : $quantity--;
      Session::put('product_' . $input, $quantity);
      return true;
  }

  public static function removeAll($request, $input) {
      $quantity = Session::has('product_' . $input) ? Session::get('product_' . $input) : "";
      $quantity = 0;
      Session::put('product_' . $input, $quantity);
      return true;
  }

  public static function getCartItems() {
    $total = 0; $qty = 0; $cart = [];

    foreach(session()->all() as $name => $value) {
      if($value > 0) {
        if(substr($name, 0, 8) === "product_") {
            $length = (int) strlen($name);
            $id = (int) substr($name, 8, $length);
            $productA = DB::table('products')->where('id', $id)->get();
            $product = $productA[0];
            $sub = ($product->price) * (session()->has('product_' . $product->id) ? session()->get('product_' . $product->id) : 0);
            $subQty = session()->has('product_' . $product->id) ? session()->get('product_' . $product->id) : 0;
          
            $total += $sub; $qty += $subQty; 

            array_push($cart, ['product_id'=>$product->id, 'title'=>$product->title, 'itemPrice'=>$product->price, 'quantity'=>$subQty, 'totalAmount'=> $sub]);
        }
      }
    }
    array_unshift($cart, ['totalItems'=> $qty, 'totalPrice'=> $total]);
    return $cart;
  }
}
