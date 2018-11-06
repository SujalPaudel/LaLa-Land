@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style = "margin-top: 20px;"><!--form-->

@include('repetition_alert');

  <div class="container">
  <form action = "{{url('/checkout')}}" method = "post"> {{csrf_field()}}
    <div class="row">
      <div class="col-sm-4 col-sm-offset-1">
        <div class="login-form form-group" ><!--login form-->
          <h2>Bill To</h2>
        <form action="#">
          <div class = "form-group">
            <input type="text" id = "billing_name" name = "billing_name" placeholder="Billing Name" class="form-control"  value = "{{$userDetails->name}}" />
          </div>
          <div class = "form-group">
            <input type="text" id = "billing_address" name = "billing_address" placeholder="Billing Address" class="form-control"  value = "{{$userDetails->address}}" />
          </div>
          <div class = "form-group">
            <input type="text" id = "billing_city" name = "billing_city" placeholder="Billing City" class="form-control"  value = "{{$userDetails->city}}" />
          </div>
          <div class = "form-group">
            <input type="text" id = "billing_khalti" name = "billing_khalti" placeholder="Khalti number" class="form-control"  value = "{{$userDetails->khalti_number}}" />
          </div>          
          <div class = "form-group">
            <input type="tel" id = "billing_mobile" name = "billing_mobile" placeholder="Billing Mobile Number" class="form-control" value = "{{$userDetails->mobile}}" />
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
            <input type="text" id = "shipping_name" name = "shipping_name" placeholder="Ship To (Name)" value = "{{$shippingDetails->name}}" class="form-control"/>
          </div>
          <div class = "form-group">          
            <input type="text" id = "shipping_address" name = "shipping_address" placeholder="Shipping Address" value = "{{$shippingDetails->address}}" class="form-control"/>
          </div>
          <div class = "form-group">          
            <input type="text" id = "shipping_city" name = "shipping_city" placeholder="Shipping City" value = "{{$shippingDetails->city}}" class="form-control"/>
          </div>
          <div class = "form-group">
            <input type="text" id = "shipping_khalti" name = "shipping_khalti" placeholder="Shipping Khalti number" value = "{{$shippingDetails->khalti_number}}" class="form-control" />
          </div>           
          <div class = "form-group">          
            <input type="tel" id = "shipping_mobile" name = "shipping_mobile" placeholder="Shipping Mobile Number" value = "{{$shippingDetails->  mobile}}" class="form-control"/>  
          </div>   

            <button type="submit" class="btn btn-success">CheckOut</button>
        </div><!--/sign up form-->
      </div>
      </form>
    </div>
  </div>
</section><!--/form-->


@endsection