@extends('layouts.frontLayout.front_design')
@section('content')

  <section id="form" style="margin-top: 0px;"><!--form-->
    <div class="container">
      <div class="row">

        @if(Session::has('flash_message_error'))
        <div class = "alert alert-error alert-block" style = "background-color: #f4d2d2">
            <button type = "button" class = "close" data-dismiss = "alert">x</button>
                <strong>{!! session('flash_message_error') !!}</strong>
        </div>
        @endif 

        @if(Session::has('flash_message_success'))
          <div class = "alert alert-success alert-block">
              <button type = "button" class = "close" data-dismiss = "alert">x</button>
                  <strong>{!! session('flash_message_success') !!}</strong>
          </div>
        @endif

        <div class="col-sm-4 col-sm-offset-1">
          <div class="login-form"><!--login form-->
            <h2>Update Account</h2>
              <form id="accountForm" name="accountForm" action="{{url('/account')}}" method = "post" autocomplete="off">{{ @csrf_field() }}
                <input name = "name" id = "name" type="text" placeholder="Name" value = "{{$userDetails->name}}"/>
                <input name = "address" id = "address" type="text" placeholder="Address" value = "{{$userDetails->address}}" />
                <input name = "city" id = "city" type="text" placeholder="City" value = "{{$userDetails->city}}" />
                <select id = "state" name = "state" style="margin-bottom: 1rem; padding:1rem; display: inline-block;">
                @foreach($states as $state)
                  <option value = "{{$state->state_name}}" @if($state->state_name == $userDetails->state) selected @endif>{{$state->state_name}}</option>
                @endforeach
                </select>
                <input name = "khalti_number" id = "khalti_number" type="text" placeholder="Khalti Number" value = "{{$userDetails->khalti_number}}"/>
                <input name = "mobile" id = "mobile" type="text" placeholder="Mobile" value = "{{$userDetails->mobile}}"/>
                <button type="submit" class="btn btn-default">Signup</button>
              </form>            
          </div><!--/login form-->
        </div>

        <div class="col-sm-1">
          <h2 class="or">OR</h2>
        </div>

        <div class="col-sm-4">
          <div class="signup-form"><!--sign up form-->
            <h2>Update Password</h2>
              <form id = "passwordForm" name = "passwordForm" action = "{{url('/update-user-pwd')}}" method = "POST">{{ csrf_field() }}
                <input type = "password" name = "current_pwd" id = "current_pwd" placeholder="Current Password">
                <span id = "chkPwd"></span>
                <input type = "password" name = "new_pwd" id = "new_pwd" placeholder="New Password">
                <input type = "password" name = "confirm_pwd" id = "confirm_pwd" placeholder="Confirm Password">
                <button type = "submit" class = "btn btn-default">Submit</button>
              </form>
          </div><!--/sign up form-->
        </div>
      </div>
    </div>
  </section><!--/form-->
@endsection
