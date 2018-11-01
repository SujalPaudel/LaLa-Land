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

//Homepage

Route::get('/', 'IndexController@index');

Route::match(['get', 'post'], '/admin', 'AdminController@login');

Auth::routes();

Route::get('/admin/dashboard', 'AdminController@dashboard');

Route::get('/logout', 'AdminController@logout');

// Category/Listing page
Route::get('/category/{url}', 'ProductsController@products');

// Product Detail page
Route::get('/product/{id}', 'ProductsController@product');

// For the cart
Route::match(['get', 'post'], '/cart', 'ProductsController@cart');

// Route for adding product to cart
Route::match(['get', 'post'], '/add-cart', 'ProductsController@addtocart');

// Deleting product from the cart
Route::get('/cart/delete-product/{id}', 'ProductsController@deleteCartProduct');

// Update the product quantity in the cart
Route::get('/cart/update-quantity/{id}/{quantity}', 'ProductsController@updateCartProduct');

//get the price of choice
Route::get('/get-product-price', 'ProductsController@getProductPrice');

Route::group(['middleware' => ['auth']], function(){
  Route::get('/admin/dashboard', 'AdminController@dashboard');
  Route::get('/admin/settings', 'AdminController@settings');
  Route::get('/admin/check-pwd', 'AdminController@chkPassword');
  Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword');

  // Categories Routes (Admin)

  Route::match(['get', 'post'], '/admin/add-category', 'CategoryController@addCategory'); // both the get and the post method 
  Route::match(['get', 'post'], '/admin/edit-category/{id}', 'CategoryController@editCategory');
  Route::match(['get', 'post'], '/admin/delete-category/{id}', 'CategoryController@deleteCategory');
  Route::get('/admin/view-categories', 'CategoryController@viewCategories');

  // Products Routes

  Route::match(['get', 'post'], '/admin/add-product', 'ProductsController@addProduct');
  Route::match(['get', 'post'], '/admin/edit-product/{id}', 'ProductsController@editProduct');
  Route::get('/admin/view-products', 'ProductsController@viewProducts');
  Route::get('/admin/delete-product/{id}', 'ProductsController@deleteProduct');
  Route::get('/admin/delete-product-image/{id}', 'ProductsController@deleteProductImage');
  Route::get('/admin/delete-alt-image/{id}', 'ProductsController@deleteAltImage');

  // Product Attributes

  Route::match(['get', 'post'], '/admin/add-attributes/{id}', 'ProductsController@addAttributes');
  Route::match(['get', 'post'], '/admin/edit-attributes/{id}', 'ProductsController@editAttributes');
  Route::match(['get', 'post'], '/admin/add-images/{id}', 'ProductsController@addImages');
  Route::get('/admin/delete-attribute/{id}', 'ProductsController@deleteAttribute');




});

Route::get('/home', 'HomeController@index')->name('home');
