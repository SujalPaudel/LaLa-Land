@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style = "margin-top: 20px;"><!--form-->
  <div class="container">
  <div class = "breadcrumbs">
    <ol class = "breadcrumb">
      <li><a href = "#">Home</a></li>
      <li class = "active">Check Out</a></li>
    </ol>
  </div>
  @include('repetition_alert')

  <form action = "{{url('/checkout')}}" method = "post"> {{csrf_field()}}
    <div class="row">
      <div class="col-sm-4 col-sm-offset-1">
        <div class="login-form form-group" ><!--login form-->
          <h2>Bill To</h2>
        <form action="#">
          <div class = "form-group">
            <input type="text" id = "billing_name" name = "billing_name" placeholder="Billing Name" class="form-control" @if(!empty($userDetails->name)) value = "{{$userDetails->name}}" @endif />
          </div>
          <div class = "form-group">
            <input type="text" id = "billing_address" name = "billing_address" placeholder="Billing Address" class="form-control" @if(!empty($userDetails->address)) value = "{{$userDetails->address}}" @endif />
          </div>
          <div class = "form-group">
            <input type="text" id = "billing_city" name = "billing_city" placeholder="City" class="form-control" @if(!empty($userDetails->city)) value = "{{$userDetails->city}}" @endif />
          </div>

          <div class = "form-group">
            <input type="text" id = "billing_zip" name = "billing_zip" placeholder="Zip Code" class="form-control" @if(!empty($userDetails->zip_code)) value = "{{$userDetails->zip_code}}" @endif />
          </div>

          <?php 
          use App\Country;
          use App\State;
          $countries = Country::get();
          $states = State::get();
          ?>

          <div class = "form-group">
            <select id = "billing_state" name = "billing_state" placeholder="State">
              <option value="">Select State</option>
                  @foreach($states as $state)
                    <option value="{{$state->abbr}}" 
                    @if(!empty($userDetails->state))
                      @if($userDetails->state == $state->abbr) selected = "{{$userDetails->state}}
                      @endif
                    @endif">{{$state->abbr}}</option>
                  @endforeach
            </select>
          </div>     

          <div class = "form-group">
            <select id = "billing_country" name = "billing_country" placeholder="Country">
              <option value="">Select Country</option>
                  @foreach($countries as $country)
                    <option value="{{$country->country_name}}" 
                    @if(!empty($userDetails->country))
                      @if($userDetails->country == $country->country_name) selected = "{{$userDetails->country}}" 
                      @endif
                    @endif>{{$country->country_name}}</option>
                  @endforeach
            </select>
          </div>        
               

                   
          <div class = "form-group">
            <input type="tel" id = "billing_mobile" name = "billing_mobile" placeholder="Billing Mobile Number" class="form-control" @if(!empty($userDetails->mobile)) value = "{{$userDetails->mobile}}" @endif />
          </div>          
          <div class = "form-check">
            <input type = "checkbox" class = "form-check-input" id = "billtoship">
            <label class = "form-check-label" for = "billtoship">Delievering Address same as Billing Address</label>
          </div>           
        </div><!--/login form-->
      </div>
      <div class="col-sm-1">
      </div>
      <div class="col-sm-4">
        <div class="signup-form form-group"><!--sign up form-->
          <h2>Deliever To</h2>         
          <div class = "form-group">          
            <input type="text" id = "shipping_name" name = "shipping_name" placeholder="Ship To (Name)" @if(!empty($shippingDetails->name)) value = "{{$shippingDetails->name}}" @endif class="form-control"/>
          </div>
          <div class = "form-group">          
            <input type="text" id = "shipping_address" name = "shipping_address" placeholder="Shipping Address" @if(!empty($shippingDetails->address)) value = "{{$shippingDetails->address}}" @endif class="form-control"/>
          </div>

          <div class = "form-group">          
            <input type="text" id = "shipping_city" name = "shipping_city" placeholder="Shipping City" @if(!empty($shippingDetails->city)) value = "{{$shippingDetails->city}}" @endif class="form-control"/>
          </div>

          <div class = "form-group">
            <input type="text" id = "shipping_zip" name = "shipping_zip" placeholder="Zip Code" class="form-control" @if(!empty($shippingDetails->zip_code)) value = "{{$shippingDetails->zip_code}}" @endif />
          </div>          

          <div class = "form-group">
            <select id = "shipping_state" name = "shipping_state" placeholder="State">
              <option value="">Select State</option>
                  @foreach($states as $state)
                    <option value="{{$state->abbr}}" 
                    @if(!empty($shippingDetails->state))
                      @if($shippingDetails->state == $state->abbr) selected = "{{$shippingDetails->state}}"
                      @endif
                    @endif>{{$state->abbr}}</option>
                  @endforeach
            </select>
          </div>

          <div class = "form-group">
            <select id = "shipping_country" name = "shipping_country" placeholder="Country">
              <option value="">Select Country</option>
                  @foreach($countries as $country)
                    <option value="{{$country->country_name}}" 
                    @if(!empty($shippingDetails->country))
                      @if($shippingDetails->country == $country->country_name) selected = "{{$shippingDetails->country}}" 
                      @endif
                    @endif>{{$country->country_name}}</option>
                  @endforeach
            </select>
          </div>                   
                     
          <div class = "form-group">          
            <input type="tel" id = "shipping_mobile" name = "shipping_mobile" placeholder="Shipping Mobile Number" @if(!empty($shippingDetails->mobile)) value = "{{$shippingDetails->mobile}}" @endif class="form-control"/>  
          </div>   

            <button type="submit" class="btn btn-success">CheckOut</button>
        </div><!--/sign up form-->
      </div>
      </form>
    </div>
  </div>
</section><!--/form-->




@endsection