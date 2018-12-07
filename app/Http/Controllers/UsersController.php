<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\State;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Country;

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
            }

          // return redirect()->back()->with('flash_message_success', 'You have been successfully registered');
          
          // After the above operation is performed the next job is to login the user simultaneously

            if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
              Session::put('frontSession', $data['email']); 
              if(!empty(Session::get('session_id'))){
                $session_id = Session::get('session_id');
                DB::table('cart')->where('session_id', $session_id)->update(['user_email'=>$data['email']]);
                
                return redirect('/cart');
          }
        }
      }
    }
                  
    public function checkCurrentSearch(Request $request){
        $query = $request->all();
        $data = DB::table('products')->where('product_name', 'LIKE', '%'.$query.'%')->get();
        
        $output = '<ul style = "display:block;position:relative;">';
        foreach ($data as $row) {
          $output .= '<li><a href = "#">'.$row->product_name.'</a></li>';
        }
        $output .= '</ul>';
        echo $output;
    
    }

    public function checkCurrentPassword(Request $request){
      $data = $request->all();
      $current_password = $data['current_pwd'];
      $user_id = Auth::User()->id;
      $check_password = User::where('id', $user_id)->first();
      if(Hash::check($current_password, $check_password->password)){
        echo "true";die;
      }else{
        echo "false";die;
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

    public function account(Request $request){
      $user_id = Auth::user()->id;
      $userDetails = User::find($user_id);
      $userDetails = json_decode(json_encode($userDetails));
      // echo '<pre>';print_r($userDetails);die;
      $countries = Country::get();
      // $countries = json_decode(json_encode($countries));

      // echo '<pre>';print_r($countries);die;
      $states = State::get();
    

      if($request->isMethod('post')){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $user = User::find($user_id);
        $user->name = $data['name'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->state = $data['state'];
        $user->country = $data['country'];
        // $user->country = $data['zipcode'];
        $user->mobile = $data['mobile'];
        $user->save();
        return redirect()->back()->with('flash_message_success', 'Your Account Credentials has been Updated !!');
      }
      return view('users.account')->with(compact('countries', 'states', 'userDetails'));
    }    

    public function logout(){
      Auth::logout();
      Session::forget('frontSession');
      Session::forget('session_id'); 
      return redirect('/')->with('flash_message_success', 'You have been successfully logged out!!');
    }

    public function login(Request $request){
      if($request->isMethod('post')){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $session_id = Session::get('session_id');
        if(!empty($session_id)){
          DB::table('cart')->where('session_id', $session_id)->update(['user_email'=>$data['email']]);
        }
        if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
          Session::put('frontSession', $data['email']);
          return redirect('/cart');
        }else{
          return redirect()->back()->with('flash_message_error', 'The credentials are invalid');
        }
     }
  }

  public function UpdateUserPassword(Request $request){
    if($request->isMethod('post')){
      $data = $request->all();
      $userDetails = User::where('id', Auth::User()->id)->first();
    
      $currentPassword = $data['current_pwd'];
      if(Hash::check($currentPassword, $userDetails->password )){
        $newPassword = bcrypt($data['new_pwd']);
        User::where('id', Auth::User()->id)->update(['password'=>$newPassword]);
        return redirect()->back()->with('flash_message_success', 'Congratulations, the Password is Updated !!');
      }else{
        return redirect()->back()->with('flash_message_error', 'Current Password is Incorrect !!');
      }
    }
  }
}