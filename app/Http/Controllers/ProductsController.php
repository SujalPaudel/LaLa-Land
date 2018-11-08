<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Category;
use App\Products;
use App\ProductAttribute;
use App\ProductsImage;
use App\Coupon;
use App\User;
use App\DeliveryAddress;
use Image;
use DB;
use Session;

 

class ProductsController extends Controller
{
    public function addProduct(Request $request){

      if($request->isMethod('post')){
        $data = $request->all();
        // echo "<pre>"; print_r($data);die;
       if(empty($data['category_id'])){
        return redirect()->back()->with('flash_message_error', 'Under Category field is mandatoy!!');
       } 
        $product = new Products;
        $product->category_id = $data['category_id'];
        $product->product_name = $data['product_name'];
        $product->product_code = $data['product_code'];
        $product->product_color = $data['product_color'];
        $product->description = $data['description'];

        if(!empty($data['acc_care'])){
          $product->accessories_care = $data['acc_care'];
        }else{
          $product->accessories_care = '';
        }

        $product->price = $data['price'];
        
        // upload image
        if($request->hasFile('image')){
          $image_tmp = Input::file('image');
          if($image_tmp->isValid()){
            $extension = $image_tmp->getClientOriginalExtension();
            $filename = rand(111, 99999).'.'.$extension;
            $large_image_path = 'images/backend_images/products/large_images/'.$filename;
            $medium_image_path = 'images/backend_images/products/medium_images/'.$filename;
            $small_image_path = 'images/backend_images/products/small_images/'.$filename;
            // Resize Image

            Image::make($image_tmp)->save($large_image_path);
            Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
            Image::make($image_tmp)->resize(300,300)->save($small_image_path);

            // store image in products table
            $product->image = $filename;

          }
        }

        $product->save();
        return redirect('/admin/view-products')->with('flash_message_success','Product has been added successfully!');
      }

      $categories =  Category::where(['parent_id'=>0])->get();
      $categories_dropdown = "<option value = '' selected disabled>Select</option>";
      foreach($categories as $cat){
        $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
        $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
        foreach ($sub_categories as $sub_cat){
          $categories_dropdown .= "<option value = '".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
        }
      }
      return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }

    public function viewProducts(Request $request){
      $products = Products::orderBy('id', 'DESC')->get();
      $products = json_decode(json_encode($products));
      foreach($products as $key => $val){{

        $category_name =  Category::where(['id'=>$val->category_id])->first();
        $products[$key]->category_name = $category_name['name'];
      }}
      // echo "<pre>";print_r($products);die;  
      return view('admin.products.view_products')->with(compact('products'));
    }

    public function editProduct(Request $request, $id = null){

      if($request->isMethod('post')){
        $data = $request->all();

        // upload image
        if($request->hasFile('image')){
          $image_tmp = Input::file('image');
          if($image_tmp->isValid()){
            $extension = $image_tmp->getClientOriginalExtension();
            $filename = rand(111, 99999).'.'.$extension;
            $large_image_path = 'images/backend_images/products/large_images/'.$filename;
            $medium_image_path = 'images/backend_images/products/medium_images/'.$filename;
            $small_image_path = 'images/backend_images/products/small_images/'.$filename;
            // Resize Image

            Image::make($image_tmp)->save($large_image_path);
            Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
            Image::make($image_tmp)->resize(300,300)->save($small_image_path);      
          }}
          else{
            $filename = $data['current_image'];
          }       

          if(empty($data['status'])){
            $status = 0;
          }else{
            $status = 1;
          }

        Products::where(['id'=>$id])->update(['category_id'=>$data['category_id'],
                                             'product_name'=>$data['product_name'],
                                             'product_code'=>$data['product_code'],
                                             'product_color'=>$data['product_color'],
                                             'description'=>$data['description'],
                                             'price'=>$data['price'],
                                             'image'=>$filename,
                                             'status'=>$status
                                             ]
                                             );
      
        return redirect()->back()->with('flash_message_success', 'Product has been updated successfully');
      }

      if($request->isMethod('post')){
        $data = $request->all();
      }
      $productDetails = Products::where(['id'=>$id])->first();

      $categories =  Category::where(['parent_id'=>0])->get();
      $categories_dropdown = "<option value='' selected disabled>Select</option>";
      foreach($categories as $cat){
        if($cat->id==$productDetails->category_id){
          $selected = "selected";
        }
        else{
          $selected = "";
        }
        $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
        $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
        foreach ($sub_categories as $sub_cat){
          if($sub_cat->id == $productDetails->category_id){
            $selected = "selected";
          }else{
            $selected = "";
          }
          $categories_dropdown .= "<option value = '".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
        }
      }

      return view('admin.products.edit_products')->with(compact('productDetails', 'categories_dropdown'));
    }

    public function deleteProduct($id = null){
      Products::where(['id'=>$id])->delete();
      return redirect()->back()->with('flash_message_success', 'Product has been removed successfully!!');
    }

    public function deleteProductImage($id = null){

      // get the product details
      $productImage = Products::where(['id'=>$id])->first();

      $large_image_path = 'images/backend_images/products/large_images/';
      $medium_image_path = 'images/backend_images/products/medium_images/';
      $small_image_path = 'images/backend_images/products/small_images/';

      // Delete the large image if it exists in the folder
      if(file_exists($large_image_path.$productImage->image)){
        unlink($large_image_path.$productImage->image);
      }

      // Delete the large image if it exists in the folder
      if(file_exists($medium_image_path.$productImage->image)){
        unlink($medium_image_path.$productImage->image);
      }

      // Delete the large image if it exists in the folder
      if(file_exists($small_image_path.$productImage->image)){
        unlink($small_image_path.$productImage->image);
      }

      Products::where(['id'=>$id])->update(['image'=>'']);
      return redirect()->back()->with('flash_message_success', 'The product image has been successfully deleted');
    }

    public function deleteAltImage($id = null){

      // get the product details
      $productImage = ProductsImage::where(['id'=>$id])->first();

      $large_image_path = 'images/backend_images/products/large_images/';
      $medium_image_path = 'images/backend_images/products/medium_images/';
      $small_image_path = 'images/backend_images/products/small_images/';

      // Delete the large image if it exists in the folder
      if(file_exists($large_image_path.$productImage->image)){
        unlink($large_image_path.$productImage->image);
      }

      // Delete the large image if it exists in the folder
      if(file_exists($medium_image_path.$productImage->image)){
        unlink($medium_image_path.$productImage->image);
      }

      // Delete the large image if it exists in the folder
      if(file_exists($small_image_path.$productImage->image)){
        unlink($small_image_path.$productImage->image);
      }

      ProductsImage::where(['id'=>$id])->delete();
      return redirect()->back()->with('flash_message_success', 'The product image has been successfully deleted');
    }



    public function addAttributes(Request $request, $id = null){
      $productDetails = Products::with('attributes')->where(['id'=>$id])->first(); // this is basically the fetch operation, here the variable stores the value
      if($request->isMethod('post')){
        $data = $request->all();


        foreach($data['sku'] as $key => $val){ // val represents value of key
          if(!empty($val)){

            // SKU Check
            $attrCountSKU = ProductAttribute::where('sku', $val)->count();
            if($attrCountSKU>0){
              return redirect('/admin/add-attributes/'.$id)->with('flash_message_error', 'SKU already exists! Please add another SKU.');              
            }

            $attrCountSizes = ProductAttribute::where(['product_id'=>$id, 'size'=>$data['size'][$key]])->count();
            if($attrCountSizes>0){
              return redirect('/admin/add-attributes/'.$id)->with('flash_message_error', ''.$data['size'][$key].' Size already exists. Please add new one!!');
            }

            $attribute = new ProductAttribute;
            $attribute->product_id = $id;
            $attribute->sku = $val;
            $attribute->size = $data['size'][$key];
            $attribute->price = $data['price'][$key];
            $attribute->stock = $data['stock'][$key];
            $attribute->save();

          }

        }
        return redirect('/admin/add-attributes/'.$id)->with('flash_message_success', 'Product attributes are successfully added');
      }
     return view('admin.products.add_attributes')->with(compact('productDetails'));
    }

    public function editAttributes(Request $request, $id = null){
      if($request->isMethod('post')){
        $data = $request->all();
        foreach($data['idAttr'] as $key => $value){ // for each data as key value pair
          // echo "<pre>";print_r($key);die; 
          ProductAttribute::where(['id'=>$data['idAttr'][$key]])->update(['price'=>$data['price'][$key], 'stock'=>$data['stock'][$key]]); // where id is attribute id based on key(0, 1, 2)
        }
        return redirect()->back()->with('flash_message_success', 'Product attribute has been updated successfully!!');
      }
    }

    public function addImages(Request $request, $id = null){
      $productDetails = Products::with('attributes')->where(['id'=>$id])->first(); // this is basically the fetch operation, here the variable stores the value
      if($request->isMethod('post')){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        if($request->hasFile('image')){
          $files = $request->file('image');
          // Upload images after resize
          foreach($files as $file){
            $image = new ProductsImage;
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(111, 999999).'.'.$extension;
            $large_image_path = 'images/backend_images/products/large_images/'.$fileName;
            $medium_image_path = 'images/backend_images/products/medium_images/'.$fileName;
            $small_image_path = 'images/backend_images/products/small_images/'.$fileName;
            Image::make($file)->save($large_image_path);
            Image::make($file)->resize(600,600)->save($medium_image_path);
            Image::make($file)->resize(300,300)->save($small_image_path);
            $image->image = $fileName;
            $image->product_id = $data['product_id'];
            $image->save();
          }
        }
        return redirect('/admin/add-images/'.$id)->with('flash_message_success', 'Product Images is added successfully');
      }

      $productsImages = ProductsImage::where(['product_id'=>$id])->get();
      // $productsImages = json_decode(json_encode($productsImages));
      // echo "<pre>";print_r($productsImages);die;

     return view('admin.products.add_images')->with(compact('productDetails', 'productsImages'));
    }

    public function deleteAttribute($id = null){
      ProductAttribute::where(['id'=>$id])->delete();
      return redirect()->back()->with('flash_message_success', 'Product Attribute has been removed successfully!!');
    }

    public function products($url = null){
      
      $countCategory = Category::where(['url'=>$url, 'status'=>1])->count();
      if($countCategory == 0){
        abort(404);
      }
      $categories = Category::with('subcategories')->where(['parent_id'=>0])->get();
      $categoryDetails = Category::where(['url'=>$url])->first();  

      if($categoryDetails->parent_id==0){
        $subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
        $cat_ids[] = "";
        foreach($subCategories as $subcat){
          $cat_ids[]= $subcat->id;
        }
 
        $productsAll = Products::whereIn('category_id', $cat_ids)->get();
        $productsAll = json_decode(json_encode($productsAll));

      }else{
        //if it is the subCategory
        $productsAll = Products::where(['category_id' => $categoryDetails->id])->where('status',1)->get();

      }   
      return view('products.listing')->with(compact('categories','categoryDetails','productsAll'));
  
  }

  public function product($id = null){

    $productCount = Products::where(['id'=>$id, 'status'=>1])->count();
    if($productCount == 0){
      abort(404);
   }
    $productDetails = Products::with('attributes')->where(['id'=>$id])->first();
    // $productDetails = json_decode(json_encode($productDetails));
    // echo "<pre>";print_r($productDetails);die;
    // echo "<pre>";print_r($productDetails->attributes);die;

    $relatedProducts = Products::where('id','!=',$id)->where(['category_id'=>$productDetails->category_id])->get();
    // $relatedProducts = json_decode(json_encode($relatedProducts));
    // echo "<pre>";print_r($relatedProducts);die;

    $productAltImages = ProductsImage::where(['product_id'=>$id])->get();


    $categories = Category::with('subcategories')->where(['parent_id'=>0])->get();

    $total_stock = ProductAttribute::where('product_id', $id)->sum('stock');
    return view('products.detail')->with(compact('productDetails', 'categories', 'productAltImages', 'total_stock', 'relatedProducts'));
  }

  public function getProductPrice(Request $request){
    $data = $request->all();
    $proArr = explode("-",$data['choice']);
    $id =  $proArr[0];
    $specific = $proArr[1];
    // echo $id;die;
    $one = ProductAttribute::where(['product_id'=>$id, 'size'=>$specific])->first();
    echo $one->price;
    echo "#";
    echo $one->stock;
  }


  public function addtocart(Request $request){
    Session::forget('CouponAmount');
    Session::forget('CouponCode');


    $data = $request->all();
    // echo "<pre>";print_r($data);die;
    if(empty($data['user_email'])){
      $data['user_email'] = "";
    }

    $session_id = Session::get('session_id');

    if(empty($session_id)){
      $session_id = str_random(40);
      Session::put('session_id', $session_id);
    }
    


    $sizeArr = explode("-", $request->choices);

    $countProducts = DB::table('cart')->where(['product_id'=>$data['product_id'],
                                               'product_color'=>$data['product_color'],
                                               'size'=>$sizeArr[1],
                                               'session_id'=>$session_id])->count();

    if($countProducts>0){ 
      return redirect()->back()->with('flash_message_error', 'Product already exists on the cart !!');
    }
    else{

       $getSKU = ProductAttribute::select('sku')->where(['product_id'=>$data['product_id'], 'size'=>$sizeArr[1]])->first();
       $getSKU = json_decode(json_encode($getSKU));
       // echo "<pre>";print_r($getSKU);die;

       DB::table('cart')->insert(['product_id'=>$data['product_id'],
                                     'product_name'=>$data['product_name'], 
                                     'product_code'=>$getSKU->sku,
                                     'product_color'=>$data['product_color'],
                                     'price'=>$data['product_price'],
                                     'size'=>$sizeArr[1],
                                     'quantity'=>$data['quantity'],
                                     'user_email'=>$data['user_email'],
                                      'image'=>$data['product_image'],
                                     'session_id'=>$session_id]);
     
    }
   return redirect('cart')->with('flash_message_success', 'Product Successfully added into the cart !!');
  }

  public function cart(){
    $session_id = Session::get('session_id');
    $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
    // echo "<pre>";print_r($userCart);die;
    foreach($userCart as $key => $product){
      // echo $product->product_id;
      $productDetails = Products::where(['id'=>$product->product_id])->first();
      // $userCart[$key]->image = $productDetails->image;
      $userCart[$key]->image = $productDetails->image;

    }
    // echo "<pre>";print_r($userCart);

    return view('products.cart')->with(compact('userCart'));
  }

  public function deleteCartProduct($id = null){

    Session::forget('CouponAmount');
    Session::forget('CouponCode');

    DB::table('cart')->where(['id'=>$id])->delete();
    return redirect()->back()->with('flash_message_success', 'Successfully removed the product from the cart !!');
  }

  public function updateCartQuantity($id = null, $quantity){

    Session::forget('CouponAmount');
    Session::forget('CouponCode');

    $getCartDetails = DB::table('cart')->where('id',$id)->first();
    $getAttributeStock = ProductAttribute::where('sku',$getCartDetails->product_code)->first();
    $inStock = $getAttributeStock->stock;echo '--';
    $inDemand = $getCartDetails->quantity+$quantity;

    if($inStock >= $inDemand){
      DB::table('cart')->where('id', $id)->increment('quantity');
      return redirect('cart')->with('flash_message_success', 'Updated quantity successfully');
    }else{
      return redirect()->back()->with('flash_message_error', 'The product is out of stock !!');
    }

  }

  public function applyCoupon(Request $request){
    
    Session::forget('CouponAmount');
    Session::forget('CouponCode');

    $data = $request->all();
    // echo "<pre>";print_r($data);die;
    $couponCount = Coupon::where(['coupon_code'=>$data['coupon_code']])->count();
    if($couponCount == 0){
      return redirect()->back()->with('flash_message_error', 'Sorry the CouponCode is Invalid !!');
    }else{
      $couponDetails = Coupon::where('coupon_code', $data['coupon_code'])->first();
      if($couponDetails->status == 0){
        return redirect()->back()->with('flash_message_error', 'The coupon is Inactive!!');
      }
      $expiryDate = $couponDetails->expiry_date;
      $currentDate = date('Y-m-d');
      if($expiryDate < $currentDate){
        return redirect()->back()->with('flash_message_error', 'Sorry, the coupon date is expired !!');
      }

      // Get the cart's totalAmount

      $session_id = Session::get('session_id');
      $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
      $totalAmount = 0;
      foreach($userCart as $item){
        $totalAmount = $totalAmount + ($item->price * $item->quantity);
      } 
      if($couponDetails->amount_type == "Fixed"){
        $couponAmount = $couponDetails->amount;
      }else{
        $couponAmount = $totalAmount * ($couponDetails->amount/100);
      }

      //Add CouponCode and Coupon Amount in the session
      Session::put('CouponAmount', $couponAmount);
      Session::put('CouponCode', $data['coupon_code']);

      return redirect()->back()->with('flash_message_success', 'Coupon Code successfully applied. You are availing discount.');
    }
  }

  public function checkOut(Request $request){
    $user_id = Auth::user()->id;
    $user_email = Auth::user()->email;
    $userDetails = User::find($user_id);
    $shippingDetails = array();

    // Check if the delevering address exists
    $shippingCount = DeliveryAddress::where('user_id', $user_id)->count();
    if($shippingCount>0){
      $shippingDetails = DeliveryAddress::where('user_id', $user_id)->first();
    }

    // get the session id of the current user

    $session_id = Session::get('session_id');
    DB::table('cart')->where('session_id', $session_id)->update(['user_email'=>$user_email]);


    if($request->isMethod('post')){
      $data = $request->all();
      if(empty($data['billing_name']) ||
         empty($data['billing_address']) ||
         empty($data['billing_city']) ||
         empty($data['billing_khalti']) ||
         empty($data['billing_mobile']) ||
         empty($data['shipping_name']) ||
         empty($data['shipping_address']) ||
         empty($data['shipping_city']) ||
         empty($data['shipping_khalti']) ||
         empty($data['shipping_mobile'])){
        return redirect()->back()->with('flash_message_error', 'Please fill all the fields to checkout');
      }

      // Update the passed Details

      User::where('id', $user_id)->update(['name'=>$data['billing_name'],
                                            'address'=>$data['billing_address'],
                                            'city'=>$data['billing_city'],
                                            'khalti_number'=>$data['billing_khalti'],
                                            'mobile'=>$data['billing_mobile']]);

      if($shippingCount>0){
        // Update the shipping address
        DeliveryAddress::where('user_id', $user_id)->update(['name'=>$data['shipping_name'],
                                                             'address'=>$data['shipping_address'],
                                                             'city'=>$data['shipping_city'],
                                                             'khalti_number'=>$data['shipping_khalti'],
                                                             'mobile'=>$data['shipping_mobile']]);
      }else{
        // Add new shipping Address
        $deliver = new DeliveryAddress;
        $deliver->user_id = $user_id;
        $deliver->user_email = $user_email;
        $deliver->name = $data['shipping_name'];
        $deliver->address = $data['shipping_address'];
        $deliver->city = $data['shipping_city'];
        $deliver->khalti_number = $data['shipping_khalti'];
        $deliver->mobile = $data['shipping_mobile'];
        $deliver->save();
      }
      return redirect()->action('ProductsController@orderReview');
    }
    return view('products.checkout')->with(compact('userDetails', 'shippingDetails'));
  }

  public function orderReview(){
    $user_id = Auth::user()->id;
    $user_email = Auth::user()->email;
    $session_id = Session::get('session_id');
    $userDetails = User::where('id', $user_id)->first();
    $shippingDetails = DeliveryAddress::where('user_id', $user_id)->first();
    $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
    // echo "<pre>";print_r($userCart);

    foreach($userCart as $key => $product){
      $productDetails = Products::where('id',$product->product_id)->first();
      $ramlalreview = $userCart[$key]->image;
      $ramlal_review = $productDetails->image;
    }
    // echo "<pre>";print_r($userCart);die;
    return view('products.order_review')->with(compact('userDetails','shippingDetails', 'userCart'));
  }

  public function placeOrder(Request $request){
    if($request->isMethod('post')){
      $data = $request->all();
      echo "<pre>";print_r($data);die;
    }
  }
}