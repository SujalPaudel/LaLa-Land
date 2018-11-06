@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style = "margin-top: 20px;"><!--form-->
  <div class="container">
  <form action = "#">
    <div class="row">
      <div class="col-sm-4 col-sm-offset-1">
        <div class="login-form form-group" ><!--login form-->
          <h2>Bill To</h2>
        <form action="#">
          <div class = "form-group">
            <input type="text" placeholder="Billing Name" class="form-control" />
          </div>
          <div class = "form-group">
            <input type="text" placeholder="Billing Address" class="form-control" />
          </div>
          <div class = "form-group">
            <input type="text" placeholder="Billing City" class="form-control" />
          </div>
          <div class = "form-group">
            <input type="email" placeholder="Billing Mobile Number" class="form-control"/>
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
            <input type="text" placeholder="Shipping Name" class="form-control"/>
          </div>
          <div class = "form-group">          
            <input type="email" placeholder="Shipping Address" class="form-control"/>
          </div>
          <div class = "form-group">          
            <input type="password" placeholder="Shipping City" class="form-control"/>
          </div>
          <div class = "form-group">          
            <input type="email" placeholder="Shipping Mobile Number" class="form-control"/>  
          </div>   

            <button type="submit" class="btn btn-success">CheckOut</button>
        </div><!--/sign up form-->
      </div>
      </form>
    </div>
  </div>
</section><!--/form-->


@endsection