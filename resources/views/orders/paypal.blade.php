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
        <p>Your order id is {{Session::get('order_id')}}</p>
        <p>Please make the purchase by clicking the below button</p>

        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
          <input type="hidden" name="cmd" value="_s-xclick">
          <input type="hidden" name="business" value="thesujal17-facilitator@gmail.com">

          <input type="hidden" name="item_name" value="{{Session::get('order_id') }}">
          <input type="hidden" name="item_number" value="{{Session::get('order_id')}}">
          <input type="hidden" name="amount" value="{{Session::get('grand_total')}}">

          <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png" alt="Buy Now">
          <img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>        
        
      </div>
    </div>
  </section><!--/#do_action-->

@endsection

<?php
  Session::forget('order_id');
  Session::forget('grand_total');
?>