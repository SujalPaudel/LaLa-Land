<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Banner;
use Image;

class BannerController extends Controller
{
    public function addBanner(Request $request){

      if($request->isMethod('post')){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $banner = new Banner;
        $banner->title = $data['title'];
        $banner->link = $data['link'];

        if(empty($data['status'])){
          $status = "0";
        }else{
          $status = "1";
        }

        $banner->status = $status;

        if($request->hasFile('image')){
          $image_tmp = Input::file('image');
          if($image_tmp->isValid()){
            $extension = $image_tmp->getClientOriginalExtension();
            $filename = rand(111, 99999).'.'.$extension;

            $banner_path = 'images/frontend_images/banners/'.$filename;
            
            Image::make($image_tmp)->resize(1140,340)->save($banner_path);

            // store image in products table
            $banner->image = $filename;

          }
        }

        $banner->save();
        return redirect()->back()->with('flash_message_success', 'Banner has been successfully added');
      }
      return view('admin.banners.add_banner');
    }

    public function viewBanners(){
      $banners = Banner::get();
      return view('admin.banners.view_banners')->with(compact('banners'));
    }

    public function editBanner(Request $request, $id = null){
      if($request->isMethod('post')){
        $data = $request->all();
        echo "<pre>";print_r($data);die;
      }
      $bannerDetails = Banner::where('id', $id)->first();
      // echo $banner;die;
      return view('admin.banners.edit_banners')->with(compact('bannerDetails'));
    }
}

