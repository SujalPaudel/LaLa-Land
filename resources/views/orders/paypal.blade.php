@extends('layouts.frontLayout.front_design')
@section('content')

  <section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">ThankYou</li>
        </ol>
      </div>
    </div>
  </section>


  <section id="do_action">
    <div class="container">
      <div class="heading">
        <h3>Your ORDER HAS BEEN PLACED</h3>
        <p>Your order id is {{Session::get('order_id')}} and total payable amount is {{Session::get('grand_total')}}</p>
        <p>Please make the purchase by clicking the below button</p>
      </div>

      <?php 
      use App\Order;
      $orderDetails = Order::getOrderDetails(Session::get('order_id'))->first();
      // $orderDetails = 10;
      // $orderDetails = json_decode(json_encode($orderDetails));
      // echo "<pre>";print_r($orderDetails);die;
      $nameArr = explode(' ', $orderDetails->name);

      ?>
     
      <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="thesujal17-facilitator@gmail.com">

        <input type="text" name="item_name" value="{{Session::get('order_id')}}">

        <input type="text" name="currency_code" value="USD">

        <input type="text" name="amount" value="{{ Session::get('grand_total') }}">

        <input type="text" name="first_name" value="{{$nameArr[0]}}">
        <input type="text" name="last_name" value="{{ $nameArr[1] }}">
        <input type="text" name="address1" value="{{ $orderDetails->address }}">
        <input type="text" name="address2" value="">
        <input type="text" name="city" value="{{ $orderDetails->city }}">
        <input type="text" name="state" value="{{ $orderDetails->state }}">
        <input type="text" name="zip" value="{{ $orderDetails->zip_code}}">
        <input type="text" name="email" value="{{ $orderDetails->user_email }}">
        <input type="image" name="submit"
          src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
          alt="PayPal - The safer, easier way to pay online">
      </form>        
        
    </div>
  </section><!--/#do_action-->

@endsection



