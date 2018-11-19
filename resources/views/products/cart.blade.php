@extends('layouts.frontLayout.front_design')
@section('content')

  <section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">Shopping Cart</li>
        </ol>
      </div>
      <div class="table-responsive cart_info">

        @if(Session::has('flash_message_error'))
          <div class = "alert alert-danger alert-block">
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

        <table class="table table-condensed">
          <thead>
            <tr class="cart_menu">
              <td class="image">Item</td>
              <td class="description">Description</td>
              <td class="price">Price</td>
              <td class="quantity">Pins</td>
              <td class="total">Total</td>
              <td></td>
            </tr>
        
          </thead>
          <tbody>
          <?php $total_amount = 0; ?>                  
          @foreach($userCart as $cart)
            <tr>
              <td class="cart_product">
                <a href=""><img src="{{asset('images/backend_images/products/small_images/'.$cart->image)}}" alt="" style = "width:80px;"></a>
              </td>
              <td class="cart_description">
                <h4>{{$cart->product_name}}</h4>
                <p>Code: {{$cart->product_code}} | {{$cart->size}} 
              </td>
              <td class="cart_price">
                <p>$ {{$cart->price}}</p>
              </td>
              <td class="cart_quantity">
                <div class="cart_quantity_button">
                  <button class="btn btn-default cart-pins-minus" id = "decrease"> - </button>
                  <input class="cart_quantity_input" type="text" name="quantity" id = "pins" value="{{$cart->quantity}}" autocomplete="off" size = "2" readonly>                  
                  <button class = "btn btn-default cart-pins-plus" id = "increase">+</button>                   
                  
                </div>
              </td>
              <td class="cart_total">
                <p class="cart_total_price">$ {{$cart->price * $cart->quantity}}</p>
              </td>
              <td class="cart_delete">
                <a class="cart_quantity_delete" href="{{url('/cart/delete-product/'.$cart->id)}}"><i class="fa fa-times"></i></a>
              </td>
            </tr>
            <?php $total_amount = $total_amount + ($cart->price * $cart->quantity) ?>
          @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </section> <!--/#cart_items-->

  <section id="do_action">
    <div class="container">
      <div class="heading">
        <h3>What would you like to do next?</h3>
        <p>Choose if you have a discount code.</p>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="chose_area">
            <ul class="user_option">
              <li>
                <form action = "{{url('/cart/apply-coupon')}}" method = "post" autocomplete="off">{{csrf_field()}}              
                <label>Coupon Code</label>
                  <input type = "text" name = "coupon_code">
                  <input type = "submit" value = "Apply" class = "btn btn-default">
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="total_area">
            <ul>
            @if(!empty(Session::get('CouponAmount')))
              <li>SubTotal<span>Rs {{$total_amount}}</span></li>
              <li>Coupon Discount<span>Rs {{Session::get('CouponAmount')}}</span></li>
              <li>Grand Total <span>Rs {{$total_amount - Session::get('CouponAmount')}}</span></li>              
            @else
              <li>Grand Total <span>Rs {{$total_amount}}</span></li>
            @endif
            </ul>
              <a class="btn btn-default update" href="">Update</a>
              <a class="btn btn-default check_out" href="{{url('/checkout')}}">Check Out</a>
          </div>
        </div>
      </div>
    </div>
  </section><!--/#do_action-->




@endsection