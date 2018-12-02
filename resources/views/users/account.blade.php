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
                  <option value = "">Select State</option>
                    @foreach($states as $state)
                      <option value = "{{$state->abbr}}" @if($userDetails->state == $state->abbr) selected = "{{$userDetails->state}}" @endif>{{$state->abbr}}</option>
                    @endforeach
                </select>

              
                <select id = "country" name= "country" style="margin-bottom: 1rem; padding:1rem; display: inline-block;">
                  <option value="">Select Country</option>
                  @foreach($countries as $country)
                    <option value="{{$country->country_name}}" @if($userDetails->country == $country->country_name) selected = "{{$userDetails->country}}" @endif>{{$country->country_name}}</option>
                  @endforeach
                </select>



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
