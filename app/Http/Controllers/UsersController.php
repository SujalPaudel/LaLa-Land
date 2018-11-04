<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{

    public function userLoginRegister(){
      return view('users.login_register');
    }

    public function register(Request $request){
      if($request->isMethod('post')){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;  
        $usersCount = User::where('email', $data['email'])->count();
        if($usersCount>0){
          return redirect()->back()->with('flash_message_error', 'The user with this Email already exists!!');
        }else{
          $users = new User;
          $users->name = $data['name'];
          $users->email = $data['email'];
          $users->password = bcrypt($data['password']);
          $users->save();
          // return redirect()->back()->with('flash_message_success', 'You have been successfully registered');
          
          // After the above operation is performed the next job is to login the user simultaneously
          if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
            return redirect('/cart');
          }
        }
      }            
    }

    public function checkMail(Request $request){
      $data = $request->all();
      $usersCount = User::where('email',$data['email'])->count();
      if($usersCount>0){
        echo "false";
      }else{
        echo "true";die;
      }
    }

    public function checkMailForLogin(Request $request){
      $data = $request->all();
      $usersCount = User::where('email',$data['email'])->count();
      if($usersCount>0){
        echo "true";
      }else{
        echo "false";die;
      }
    }    

    public function logout(){
      Auth::logout();
      return redirect('/')->with('flash_message_success', 'You have been successfully logged out!!');
    }

    public function login(Request $request){
      if($request->isMethod('post')){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
          return redirect('/cart');
        }else{
          return redirect()->back()->with('flash_message_error', 'The credentials are invalid');
        }
     }
  }
}