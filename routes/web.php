<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ProductController@index')->name('products.index');
Route::get('/shop', 'ProductController@shop')->name('shopPage');
Route::get('/contact', 'ProductController@contact')->name('contact');


Route::get('index/add-to-cart', 'ProductController@indexPageCart')->name('cart.index');
Route::get('shop/add-to-cart', 'ProductController@shopCart')->name('cart.shop');
Route::get('checkout/add-to-cart', 'ProductController@getAddToCart')->name('cart.checkout');
Route::get('product/add-to-cart', 'ProductController@singlePageCart')->name('product.checkout');
Route::get('/checkout', 'ProductController@checkout')->name('checkout');
Route::get('/thank-you', 'ProductController@thanks')->name('thanks');


Route::get('/login', 'UserController@getSignin')->name('login');
Route::post('/login', 'UserController@postSignin')->name('login');
Route::get('/register', 'UserController@getSignup')->name('register');
Route::post('/register', 'UserController@postSignup')->name('register');
Route::get('/logout', 'UserController@getLogout')->name('logout');


Route::get('/adminarea', 'UserController@admin')->name('admin');
Route::get('/adminarea/orders', 'UserController@orders')->name('admin.orders');
Route::get('/adminarea/products', 'UserController@products')->name('admin.products');

Route::get('/adminarea/add-product', 'UserController@getAddProduct')->name('admin.addProduct');
Route::post('/adminarea/add-product', 'UserController@postAddProduct')->name('admin.addProduct');

Route::get('/adminarea/delete-product/{product}', 'UserController@delete')->name('admin.deleteProduct');

Route::get('/adminarea/edit-product/{id}', 'UserController@getEditProduct')->name('admin.editProduct');
Route::post('/adminarea/edit-product/{id}', 'UserController@postEditProduct')->name('admin.editProduct');

Route::get('/adminarea/categories', 'UserController@getCategories')->name('admin.categories');
Route::post('/adminarea/categories', 'UserController@PostCategories')->name('admin.categories');
Route::get('/adminarea/delete-category/{category}', 'UserController@deleteCat')->name('admin.deleteCat');

Route::get('/adminarea/users', 'UserController@users')->name('admin.users');

Route::get('/adminarea/add-user', 'UserController@getAddUser')->name('admin.addUser');
Route::post('/adminarea/add-user', 'UserController@postAddUser')->name('admin.addUser');

Route::get('/adminarea/edit-user/{id}', 'UserController@getEditUser')->name('admin.editUser');
Route::post('/adminarea/edit-user/{id}', 'UserController@postEditUser')->name('admin.editUser');

Route::get('/adminarea/users/{user}', 'UserController@destroy')->name('admin.deleteUser');


Route::get('/product/{product}', 'ProductController@show')->name('singleProduct');
Route::get('/category/{id}', 'ProductController@categories')->name('singleCategory');

