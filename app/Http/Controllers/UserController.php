<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Category;

class UserController extends Controller
{
  public function __construct() {
    //$this->middleware('guest', ['except' => ['getIndex', 'getProfile', 'getLogout']]);
    $this->middleware('auth', ['only' => ['getLogout', 'admin', 'orders', 'products', 'addProduct', 'categories', 'users']]);
  }

  

  public function getSignup() {
    return view('user.register');
  }



  public function postSignup() {
    $this->validate(request(), [
      'email' => 'email|required|unique:users',
      'password' => 'required|min:4'
    ]);

    $user = new User([
      'name' => request('name'),
      'email' => request('email'),
      'password' => bcrypt(request('password'))
    ]);

    $user->save();

    \Auth::login($user);

    if (\Session::has('oldUrl')) {
      $oldUrl = \Session::get('oldUrl');
      \Session::forget('oldUrl');
      return redirect()->to($oldUrl);
    }

    return redirect()->route('admin');
  }



  public function getSignin() {
    return view('user.login');
  }



  public function postSignin() {
    $signinInfo = request()->validate([
      'email' => 'email|required',
      'password' => 'required|min:4'
    ]);

    if (\Auth::attempt($signinInfo)) {
      if (\Session::has('oldUrl')) {
        $oldUrl = \Session::get('oldUrl');
        \Session::forget('oldUrl');
        return redirect()->to($oldUrl);
      }
      return redirect()->route('admin');
    }

    return redirect()->back();
  }



/*
  public function getProfile() {
    $orders = \Auth::user()->orders;
    $orders->transform(function($order, $key){
      $order->cart = unserialize($order->cart);
      return $order;
    });
    return view('user.profile', compact('orders'));
  }
*/



  public function getLogout() {
    \Auth::logout();
    return redirect()->route('products.index');
  }



  public function admin() {
    $userInfo = \Auth::user()->only(['name', 'email']);
    return view('admin.index', compact('userInfo'));
  }



  public function orders() {
    $userInfo = \Auth::user()->only(['name', 'email']);
    return view('admin.index', compact('userInfo'));
  }



  public function products() {
    $userInfo = \Auth::user()->only(['name', 'email']);
    return view('admin.index', compact('userInfo'));
  }

  public function getAddProduct() {
    $userInfo = \Auth::user()->only(['name', 'email']);
    return view('admin.index', compact('userInfo'));
  }

  public function postAddProduct() {
    try {
      if(request()->input('publish')) {
        $title = request()->input('title');
        $description = request()->input('description');
        $price = floatval(request()->input('price'));
        $inputCategory = (int) request()->input('category');
        $quantity = (int) request()->input('quantity');
        // image upload
        if(request()->hasFile('imageFile')) {
          $newfilename = str_random(32) . time();
          $newfilename = $newfilename . "." . request()->file('imageFile')->guessClientExtension();
          $image = request()->file('imageFile')->store('public/images'); //move(base_path('public\css'), $newfilename);
          
        }
        
        $product = new Product();

        $product->title = $title;
        $product->description = $description;
        $product->price = $price;
        $product->category_id = $inputCategory;
        $product->quantity = $quantity;
        $product->imagePath = $image;
        
        $product->save();
      }
      return redirect()->route('admin.products')->with('productStatus', "Product with ID {$product->id} added.");
    } catch (\Exception $e) {
      return redirect()->route('admin.products');
    }
  }

  public function getEditProduct($id) {
    $product = Product::find($id);
    $userInfo = \Auth::user()->only(['name', 'email']);
    return view('admin.index', compact('userInfo', 'product'));
  }

  public function postEditProduct($id) {
    if(request()->input('update')) {
      $title = request()->input('title');
      $description = request()->input('description');
      $price = floatval(request()->input('price'));
      $inputCategory = (int) request()->input('category');
      $quantity = (int) request()->input('quantity');

      $product = Product::where('id', $id)->get();
      $oldImage = $product[0]->imagePath;
      // image upload
      $image = null;
      if(request()->hasFile('imageFile')) {
        $newfilename = str_random(32) . time();
        $newfilename = $newfilename . "." . request()->file('imageFile')->guessClientExtension();
        $image = request()->file('imageFile')->move(base_path('public\css'), $newfilename);
      }

      $product[0]->title = $title;
      $product[0]->description = $description;
      $product[0]->price = $price;
      $product[0]->category_id = $inputCategory;
      $product[0]->quantity = $quantity;
      $product[0]->imagePath = $image ? $image : $oldImage;
      
      $product[0]->save();
    }
    return redirect()->route('admin.products')->with('productStatus', "Product with ID {$product[0]->id} updated.");
  }

  public function delete(Product $product) {
    $product->delete();
    return redirect()->route('admin.products')->with('productStatus', "Product with ID {$product->id} deleted.");
  }


  public function getCategories() {
    $userInfo = \Auth::user()->only(['name', 'email']);
    return view('admin.index', compact('userInfo'));
  }

  public function postCategories() {
    if(request()->input('title')) {
      $catTitle = request()->input('title');
      $category = new Category();
      $category->title = $catTitle;
      $category->save();
      return redirect()->route('admin.categories')->with('catStatus', "Category with ID {$category->id} added.");
    }
    return redirect()->route('admin.categories');
  }

  public function deleteCat(Category $category) {
    $category->delete();
    return redirect()->route('admin.categories')->with('catStatus', "Category with ID {$category->id} deleted.");
  }




  public function users() {
    $userInfo = \Auth::user()->only(['name', 'email']);
    return view('admin.index', compact('userInfo'));
  }

  public function getAddUser() {
    $userInfo = \Auth::user()->only(['name', 'email']);
    return view('admin.index', compact('userInfo'));
  }

  public function postAddUser() {
    $this->validate(request(), [
      'name' => 'required',
      'email' => 'email|required|unique:users',
      'password' => 'required|min:4'
    ]);

    $user = new User([
      'name' => request('name'),
      'email' => request('email'),
      'password' => bcrypt(request('password'))
    ]);

    $user->save();

    return redirect()->route('admin.users')->with('userStatus', "User with ID {$user->id} created.");
  }

  public function getEditUser($id) {
    $user = User::findOrFail($id);
    $userInfo = \Auth::user()->only(['name', 'email']);
    return view('admin.index', compact('userInfo', 'user'));
  }

  public function postEditUser($id) {
    if(request()->input('submit')) {

      if(request()->input('email')) {
        request()->validate([
          'email' => 'email'
        ]);
      }

      if(request()->input('password')) {
        request()->validate([
          'password' => 'min:4'
        ]);
      }

      $user = User::where('id', $id)->first();

      $name = request()->input('name');
      $email = request()->input('email');
      $password = bcrypt(request('password'));
      
      $user->name = $name;
      $user->email = $email;
      $user->password = $password;

      $user->save();

      return redirect()->route('admin.users')->with('userStatus', "Information of user with ID {$user->id} updated.");
    }
  }

  public function destroy($id) {
    $oldId = $id;
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('admin.users')->with('userStatus', "User with ID {$oldId} deleted.");
  }

}
