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

// Auth::routes(['verify'=>true]);

Route::get('/admin/dashboard', 'AdminController@dashboard');

Route::get('/logout', 'AdminController@logout');

// Category/Listing page
Route::get('/category/{url}', 'ProductsController@products');

// Product Detail page
Route::get('/product/{id}', 'ProductsController@product');

// For the autoComplete Sessions

Route::post('/ramlal', 'UsersController@checkCurrentSearch');


// For the cart
Route::match(['get', 'post'], '/cart', 'ProductsController@cart');

// Route for adding product to cart
Route::match(['get', 'post'], '/add-cart', 'ProductsController@addtocart');

// Deleting product from the cart
Route::get('/cart/delete-product/{id}', 'ProductsController@deleteCartProduct');

// Update the product quantity in the cart
Route::get('/cart/update-quantity/{id}/{quantity}', 'ProductsController@updateCartQuantity');

//get the price of choice
Route::get('/get-product-price', 'ProductsController@getProductPrice');

//Apply Coupon
Route::post('/cart/apply-coupon', 'ProductsController@applyCoupon');

//Check if the user already exists
Route::match(['get', 'post'], '/check-email', 'UsersController@checkMail');

Route::match(['get', 'post'], '/check-email-for-login', 'UsersController@checkMailForLogin');

Route::get('/about-us', 'TitlebarController@displayAboutPage');

// Route for about artist page

Route::get('/our-artist', 'TitlebarController@displayOurArtist');

// Route about searching product

Route::match(['get', 'post'], '/search', 'ProductsController@searchProduct');

// The grouped routes are protected by the middleware
// All routes after being logged in

Route::group(['middleware' => ['frontLogin']], function(){
  Route::match(['get', 'post'], '/account', 'UsersController@account'); // use the middleware in this route.

  Route::post('/check-current-pwd', 'UsersController@checkCurrentPassword');

  Route::post('/update-user-pwd', 'UsersController@UpdateUserPassword');

  Route::match(['get', 'post'], '/checkout', 'ProductsController@checkOut');
  
  Route::match(['get', 'post'], '/order-review', 'ProductsController@orderReview');

  Route::match(['get', 'post'], '/place-order', 'ProductsController@placeOrder');

  Route::get('/thanks', 'ProductsController@thanks');

  // paypal function

  Route::get('/paypal', 'ProductsController@paypal');

  // Users orders page

  Route::get('/orders', 'ProductsController@userOrders');

  // Users ordered products
  Route::get('/order/{id}', 'ProductsController@userOrderDetails');

  // Paypal thanks page
  Route::get('/paypal/thanks', 'ProductsController@paypalThanks');

  // Paypal cancel page
  Route::get('/paypal/cancel', 'ProductsController@paypalCancel');

});

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

  // Coupon Routes

  Route::match(['get', 'post'], '/admin/add-coupon', 'CouponsController@addCoupon');
  Route::get('/admin/view-coupons', 'CouponsController@viewCoupons');
  Route::match(['get', 'post'], '/admin/edit-coupon/{id}', 'CouponsController@editCoupon');
  Route::get('/admin/del-coupon/{id}', 'CouponsController@deleteCoupon');

  // Banner Routes

  Route::match(['get', 'post'], '/admin/add-banner', 'BannerController@addBanner');
  Route::get('/admin/view-banners', 'BannerController@viewBanners');
  Route::match(['get','post'], '/admin/edit-banner/{id}', 'BannerController@editBanner');
  Route::get('/admin/delete-banner/{id}', 'BannerController@deleteBanner');

  // the title bar section

  // For adding about us section
  Route::match(['get', 'post'], '/admin/add-aboutUs', 'TitlebarController@addAboutUs');

  // For adding artist interview section

  Route::match(['get', 'post'], '/admin/add-artist', 'TitlebarController@addOurArtist');

});

// About the user Login/Register

Route::get('/login-register', 'UsersController@userLoginRegister');

// Post the users registration credentials

Route::post('/user-register', 'UsersController@register');

Route::get('/user-logout', 'UsersController@logout');

Route::post('/user-login', 'UsersController@login');




