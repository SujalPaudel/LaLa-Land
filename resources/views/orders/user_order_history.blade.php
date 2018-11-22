@extends('layouts.frontLayout.front_design')
@section('content')

  <section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="{{url('/about-us')}}">Home</a></li>
          <li><a href="{{url('orders')}}">Order</a></li>
          <li class="active">{{$orderDetails->id}}</li>
        </ol>
      </div>
    </div>
  </section>

  <section id="do_action">
    <div class="container">
      <div class = "row">
        <div class = "col-sm-12">
          <div class="heading" align="center">
            <table id = "example" class = "table table-striped table-bordered" style = "width: 100%">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Product Color</th>
              <th>Product Price</th>
              <th>Product Quantity</th>           
            </tr>
          </thead>

          <tbody>
            @foreach($orderDetails->orders as $order)
              <tr>
                <td>{{$order->product_name}}</td>
                <td>{{$order->product_color}}</td>
                <td>{{$order->product_price}}</td>
                <td>{{$order->product_qty}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        </div>
        </div>
        </div>
    </div>
  </section><!--/#do_action-->

@endsection

<?php
  Session::forget('order_id');
  Session::forget('grand_total');
?>