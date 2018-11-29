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
     
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="business" value="thesujal17-facilitator@gmail.com">
        <input type="hidden" name="item_name" value="hat">
        <input type="hidden" name="item_number" value="123">
        <input type="hidden" name="amount" value="15.00">
        <input type="hidden" name="first_name" value="John">
        <input type="hidden" name="last_name" value="Doe">
        <input type="hidden" name="address1" value="9 Elm Street">
        <input type="hidden" name="address2" value="Apt 5">
        <input type="hidden" name="city" value="Berwyn">
        <input type="hidden" name="state" value="PA">
        <input type="hidden" name="zip" value="19312">
        <input type="hidden" name="night_phone_a" value="610">
        <input type="hidden" name="night_phone_b" value="555">
        <input type="hidden" name="night_phone_c" value="1234">
        <input type="hidden" name="email" value="jdoe@zyzzyu.com">
        <input type="image" name="submit"
          src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
          alt="PayPal - The safer, easier way to pay online">
      </form>        
        
    </div>
  </section><!--/#do_action-->

@endsection

<?php
  Session::forget('order_id');
  Session::forget('grand_total');
?>


