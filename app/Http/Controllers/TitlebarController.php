<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use App\AboutImage;
use App\AboutContent;
use App\ArtistInterview;
// use App\AboutusImages;
// use App\Promotions;

class TitlebarController extends Controller
{
    public function addAboutUs(Request $request){

      if($request->isMethod('post')){
        $data = $request->all();
        // $files = $request->file('image');
        // echo "<pre>";print_r($data);die;

        $aboutus = new AboutContent;
        $aboutus->content = $data['content'];

        $aboutus->save();


        if($request->hasFile('image')){
          // Upload images after resize
          $files = $request->file('image');

          foreach($files as $file){

            $image = new AboutImage;

            $extension = $file->getClientOriginalExtension();

            $fileName = rand(111, 999999).'.'.$extension;

            $medium_image_path = 'images/backend_images/aboutUs/'.$fileName;

            Image::make($file)->resize(600,600)->save($medium_image_path);

            $image->image = $fileName;

            $image->save();

          }
        }
         return redirect()->back()->with('flash_message_success', 'Yes done successfully');

      }   
      return view('admin.titleBar.add_aboutUs');
    }

    public function displayAboutPage(){

        $about = AboutContent::get();
        // $about = json_decode(json_encode($about));
        // echo "<pre>";print_r($about);die;
        $images = AboutImage::get();
        // $images = json_decode(json_encode($images));
        // echo "<pre>";print_r($images);die;
       
        return view('aboutUs')->with(compact('about', 'images'));
    }

    public function addOurArtist(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            
            $interview = new ArtistInterview;
            $interview->name = $data['name'];
            $interview->artist_interview = $data['content'];

            if($request->hasFile('image')){
                $file = $request->file('image');
                // echo($files);die;
                $extension = $file->getClientOriginalExtension();

                $fileName = rand(111, 999999).'.'.$extension;

                $medium_image_path = 'images/backend_images/artist/'.$fileName;

                Image::make($file)->resize(600,600)->save($medium_image_path);

                $interview->artist_image = $fileName;

                $interview->save();
            }
            return redirect()->back()->with('flash_message_success', 'Artist is successfully added');

        }
        return view('admin.titleBar.add_ourArtist');
    }


    public function displayOurArtist(){
        $interviews = ArtistInterview::get();
        // $interview = json_decode(json_encode($interview));
        // echo "<pre>";print_r($interview);die;
        return view('ourArtist')->with(compact('interviews'));
    }
}
  
  
