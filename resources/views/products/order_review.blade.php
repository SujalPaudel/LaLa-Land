@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style = "margin-top: 20px;margin-bottom: 1rem;""><!--form-->
  <div class="container">
    @include('repetition_alert')
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
            {{$userDetails->zip_code}}
          </div>
          <div class = "form-group">
            {{$userDetails->state}}
          </div>          
          <div class = "form-group">
            {{$userDetails->country}}
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
           {{$shippingDetails->zip_code}}
          </div>           
          <div class = "form-group">
           {{$shippingDetails->state}}
          </div>           
          <div class = "form-group">
           {{$shippingDetails->country}}
          </div>           
          <div class = "form-group">          
            {{$shippingDetails->mobile}}  
          </div>   
        </div><!--/sign up form-->
      </div>
    </div>
  </div>
</section><!--/form-->

  <section id="cart_items" >
    <div class="container" >

      <div class="review-payment">
        <h2>Review & Payment</h2>
      </div>

      <div class="table-responsive cart_info">
        <table class="table table-condensed">
          <thead>
            <tr class="cart_menu">
              <td class="image">Item</td>
              <td class="description">Description</td>
              <td class="price">Price</td>
              <td class="quantity">Quantity</td>
              <td class="total">Total</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
          <?php $total_amount = 0; ?>
          @foreach($userCart as $cartItem)
            <tr>
              <td class="cart_product">
                <a href=""><img src="{{ asset('/images/backend_images/products/small_images/'.$cartItem->image) }}" alt="" style="width:14rem;"></a>
              </td>
              <td class="cart_description">
                <h4><a href="">{{$cartItem->product_name}}</a></h4>
                <p>{{$cartItem->size}}</p>
              </td>
              <td class="cart_price">
               <p>$ {{$cartItem->price}}</p>
              </td>
              <td class="cart_quantity">
                <p>{{$cartItem->quantity}}</p>
              </td>
              <td class="cart_total">
                <p class="cart_total_price">$ {{$cartItem->quantity * $cartItem->price }}</p>
              </td>
            </tr>
            <?php $total_amount = $total_amount + ($cartItem->quantity * $cartItem->price); ?>
          @endforeach
            <tr>
              <td colspan="4">&nbsp;</td>
              <td colspan="2">
                <table class="table table-condensed total-result">
                  <tr>
                    <td>Cart Sub Total</td>
                    <td>Rs {{$total_amount}}</td>
                  </tr>

                  <tr class="shipping-cost">
                    <td>Shipping Cost (+)</td>
                    <td>Free</td>                   
                  </tr>
                  <tr class="shipping-cost">
                    <td>Discount Amount (-)</td>
                    @if(!empty(Session::get('CouponAmount')))
                      <td>Rs {{Session::get('CouponAmount')}}</td>  
                    @else
                      <td>Rs 0</td>   
                    @endif                                      
                  </tr>

                  <tr>
                    <td>Total</td>
                    <td><span>Rs {{$grand_total = $total_amount - Session::get('CouponAmount')}}</span></td>
                  </tr>
                </table>
              </td>
            </tr>          
          </tbody>
        </table>
      </div>
      <form class = "paymentForm" id = "paymentForm" action = "{{url('/place-order')}}" method = "post"> {{csrf_field()}}
      <input type = "hidden" name = "grand_total" value = "{{$grand_total}}" />
      <input type = "hidden" name = "couponAmount" @if(!empty(Session::get('CouponAmount'))) value = "{{Session::get('CouponAmount')}}" @else value = "0" @endif />
      <input type = "hidden" name = "CouponCode"/>
        <div class="payment-options">
            <span>
              <label><strong>Payment Method</strong></label>
            </span>
            <span>
              <label><strong><input name = "payment_method" type="radio" class = "paypal" id = "paypal" value = "PayPal"> Paypal</label></strong>
            </span>
            <span>
              <button type = "submit" class = "btn btn-success" onclick="return selectPaymentMethod();">Place Order</button>
            </span>
        </div>
      </form>
    </div>
  </section> <!--/#cart_items-->

@endsection