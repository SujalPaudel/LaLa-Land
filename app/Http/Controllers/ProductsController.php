<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Category;
use App\Products;
use App\ProductAttribute;
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
      $products = Products::get();
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
      Products::where(['id'=>$id])->update(['image'=>'']);
      return redirect()->back()->with('flash_message_success', 'The product image has been successfully deleted');
    }

    public function addAttributes(Request $request, $id = null){
      $productDetails = Products::with('attributes')->where(['id'=>$id])->first(); // this is basically the fetch operation, here the variable stores the value
      if($request->isMethod('post')){
        $data = $request->all();


        foreach($data['sku'] as $key => $val){ // val represents value of key
          if(!empty($val)){
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

    public function deleteAttribute($id = null){
      ProductAttribute::where(['id'=>$id])->delete();
      return redirect()->back()->with('flash_message_success', 'Product Attribute has been removed successfully!!');
    }



}
