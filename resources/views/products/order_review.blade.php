@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style = "margin-top: 20px;"><!--form-->
  <div class="container">
    @include('repetition_alert');  
    <div class = "breadcrumbs">
    <ol class = "breadcrumb">
      <li><a href = "#">Home</a></li>
      <li class = "active">Order Review</a></li>
    </ol>
  </div>
    <div class="row">
      <div class="col-sm-4 col-sm-offset-1">
        <div class="login-form form-group" ><!--login form-->
          <h2>Bill To</h2>
          <div class = "form-group">
            {{$userDetails->name}}
          </div>
          <div class = "form-group">
            {{$userDetails->address}}
          </div>
          <div class = "form-group">
            {{$userDetails->city}}
          </div>
          <div class = "form-group">
            {{$userDetails->khalti_number}}
          </div>          
          <div class = "form-group">
            {{$userDetails->mobile}}
          </div>                     
        </div><!--/login form-->
      </div>
      <div class="col-sm-1">
      </div>
      <div class="col-sm-4">
        <div class="signup-form form-group"><!--sign up form-->
          <h2>Deliever To</h2>         
          <div class = "form-group">          
            {{$shippingDetails->name}}
          </div>
          <div class = "form-group">          
            {{$shippingDetails->address}}
          </div>
          <div class = "form-group">          
            {{$shippingDetails->city}}
          </div>
          <div class = "form-group">
           {{$shippingDetails->khalti_number}}
          </div>           
          <div class = "form-group">          
            {{$shippingDetails->mobile}}  
          </div>   
        </div><!--/sign up form-->
      </div>
    </div>
  </div>
</section><!--/form-->



@endsection