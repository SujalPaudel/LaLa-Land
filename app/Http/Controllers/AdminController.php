<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use Session;

class AdminController extends Controller
{
    public function login(Request $request){
      if($request->isMethod('post')){
        $data = $request->input();
        if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password'], 'admin'=>'1'])){ // to check the credentials of admin
          Session::put('adminSession', $data['email']);
          return redirect('/admin/dashboard');

        }else{
          return redirect('/admin')->with('flash_message_error', 'Invalid Username or Password');
        }
      }
      return view('admin.admin_login'); // inside the admin folder in view
    }

    public function dashboard(){
      if(Session::has('adminSession')){
      return view('admin.dashboard');
    }else{
      return redirect('/admin')->with('flash_message_error', "Please login to Enter");
    }
  }

    public function logout(){
      Session::flush();
      return redirect('/admin')->with('flash_message_success', 'Logged Out Successfully');

    }
}
