<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Category;
use App\Products;
use App\ProductAttribute;
use App\ProductsImage;
use Image;

 

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
          }
          else{
            $filename = $data['current_image'];
          }
        }

        Products::where(['id'=>$id])->update(['category_id'=>$data['category_id'],
                                             'product_name'=>$data['product_name'],
                                             'product_code'=>$data['product_code'],
                                             'product_color'=>$data['product_color'],
                                             'description'=>$data['description'],
                                             'price'=>$data['price'],
                                             'image'=>$filename]
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
     return view('admin.products.add_images')->with(compact('productDetails'));
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
        $productsAll = Products::where(['category_id' => $categoryDetails->id])->get();

      }   
      return view('products.listing')->with(compact('categories','categoryDetails','productsAll'));
  
  }

  public function product($id = null){
    $productDetails = Products::with('attributes')->where(['id'=>$id])->first();
    $productDetails = json_decode(json_encode($productDetails));
    // echo "<pre>";print_r($productDetails);die;
    $categories = Category::with('subcategories')->where(['parent_id'=>0])->get();
    return view('products.detail')->with(compact('productDetails', 'categories'));
  }

  public function getProductPrice(Request $request){
    $data = $request->all();
    echo "<pre>"; print_r($data);die;
    $proArr = explode("-",$data['choice']);
    $id =  $proArr[0];
    $specific = $proArr[1];
    // echo $id;die;
    $one = ProductAttribute::where(['product_id'=>$id, 'size'=>$specific])->first();
    echo $one->price;
  }


}
