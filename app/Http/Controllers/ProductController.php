<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Cart;
use App\Order;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
  public function index() {
    $products = Product::paginate(9);
    return view('shop.products', compact('products'));
  }


  public function show(Product $product) {
    return view('shop.singleProduct', compact('product'));
  }

  public function categories($cat_id) {
    $products = Product::where('category_id', $cat_id)->with('category')->get();
    return view('shop.category', compact('products'));
  }

  public function shop() {
    $products = Product::paginate(9);
    return view('shop.shop', compact('products'));
  }


  public function contact() {
    return view('info.contact');
  }


  public function checkout() {
    return view('shop.checkout');
  }


  public function thanks() {
    try {
      if (request()->input('tx')) {
        $amount = request()->query('amt');
        $transId = request()->query('tx');
        $currency = request()->query('cc');
        $status = request()->query('st');
        
        $cart = Cart::getCartItems();
        $orderInfo = array_shift($cart);

        $order = new Order();
  
        $order->paypal_amount =  $amount;
        $order->transaction_id = $transId;
        $order->currency = $currency;
        $order->status = $status;
        $order->total_items = $orderInfo['totalItems'];
        $order->total_price = $orderInfo['totalPrice'];
        $order->cart = serialize($cart);
        $order->save();

        session()->flush();
        return view('shop.thanks');
      }
      return redirect()->route('products.index');
    } catch (\Exception $e) {
      echo('Something went wrong. Please try agian');
      return header("refresh:5; url=" . route('products.index'));
    }
  }


  public function getAddToCart(Request $request) {
    $getAdd = $request->input('add');
    if(isset($getAdd)) {
      Cart::addOneItem($request, $getAdd);
    }

    $getRemove = $request->input('remove');
    if(isset($getRemove)) {
      Cart::removeOneItem($request, $getRemove);
    }

    $getRemoveAll = $request->input('removeAll');
    if(isset($getRemoveAll)) {
      Cart::removeAll($request, $getRemoveAll);
    }

    return redirect()->route('checkout');
  }


  public function indexPageCart(Request $request) {
    $this->CartAdd($request);
    return redirect()->route('products.index');
  }


  public function shopCart(Request $request) {
    $this->CartAdd($request);
    return redirect()->route('shopPage');
  }

  public function singlePageCart(Request $request) {
    $this->CartAdd($request);
    $id = request()->query('add');
    return redirect()->route('singleProduct', $id);
  }





  public function CartAdd($request) {
    $getAdd = $request->input('add');
    if(isset($getAdd)) {
      Cart::addOneItem($request, $getAdd);
    }
  }


}
