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
        <h3>Your COD ORDER HAS BEEN PLACED</h3>
        <p>Your order id is {{Session::get('order_id')}}</p>
      </div>
    </div>
  </section><!--/#do_action-->

@endsection

<?php
  Session::forget('order_id');
  Session::forget('grand_total');
?>