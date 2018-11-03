<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function register(Request $request){
      if($request->isMethod('post')){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;  

        $userCount = User::where('email', $data['email'])->count();
        if($userCount >0){
          return redirect()->back()->with('flash_message_error', 'The user with this Email Id already exists !!');
        }else{
          echo "success";die;
          // $users = new User;
          // $user->name = $data['name'];
          // $user->email = $data['email'];
          // $user->email = $data['email'];
        }  
      }
      return view('users.login_register');
    }

    public function checkMail(Request $request){
      $data = $request->all();
      $usersCount = User::where('email',$data['email'])->count();
      if($usersCount>0){
        echo "false";
      }else{
        echo "True";
      }
    }
}
