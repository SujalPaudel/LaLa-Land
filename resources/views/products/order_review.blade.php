@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style = "margin-top: 20px;margin-bottom: 1rem;""><!--form-->
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
              <td class="description"></td>
              <td class="price">Price</td>
              <td class="quantity">Quantity</td>
              <td class="total">Total</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="cart_product">
                <a href=""><img src="images/cart/one.png" alt=""></a>
              </td>
              <td class="cart_description">
                <h4><a href="">Colorblock Scuba</a></h4>
                <p>Web ID: 1089772</p>
              </td>
              <td class="cart_price">
                <p>$59</p>
              </td>
              <td class="cart_quantity">
                <div class="cart_quantity_button">
                  <a class="cart_quantity_up" href=""> + </a>
                  <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                  <a class="cart_quantity_down" href=""> - </a>
                </div>
              </td>
              <td class="cart_total">
                <p class="cart_total_price">$59</p>
              </td>
              <td class="cart_delete">
                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
              </td>
            </tr>

            <tr>
              <td class="cart_product">
                <a href=""><img src="images/cart/two.png" alt=""></a>
              </td>
              <td class="cart_description">
                <h4><a href="">Colorblock Scuba</a></h4>
                <p>Web ID: 1089772</p>
              </td>
              <td class="cart_price">
                <p>$59</p>
              </td>
              <td class="cart_quantity">
                <div class="cart_quantity_button">
                  <a class="cart_quantity_up" href=""> + </a>
                  <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                  <a class="cart_quantity_down" href=""> - </a>
                </div>
              </td>
              <td class="cart_total">
                <p class="cart_total_price">$59</p>
              </td>
              <td class="cart_delete">
                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
              </td>
            </tr>
            <tr>
              <td class="cart_product">
                <a href=""><img src="images/cart/three.png" alt=""></a>
              </td>
              <td class="cart_description">
                <h4><a href="">Colorblock Scuba</a></h4>
                <p>Web ID: 1089772</p>
              </td>
              <td class="cart_price">
                <p>$59</p>
              </td>
              <td class="cart_quantity">
                <div class="cart_quantity_button">
                  <a class="cart_quantity_up" href=""> + </a>
                  <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                  <a class="cart_quantity_down" href=""> - </a>
                </div>
              </td>
              <td class="cart_total">
                <p class="cart_total_price">$59</p>
              </td>
              <td class="cart_delete">
                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
              </td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
              <td colspan="2">
                <table class="table table-condensed total-result">
                  <tr>
                    <td>Cart Sub Total</td>
                    <td>$59</td>
                  </tr>
                  <tr>
                    <td>Exo Tax</td>
                    <td>$2</td>
                  </tr>
                  <tr class="shipping-cost">
                    <td>Shipping Cost</td>
                    <td>Free</td>                   
                  </tr>
                  <tr>
                    <td>Total</td>
                    <td><span>$61</span></td>
                  </tr>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="payment-options">
          <span>
            <label><input type="checkbox"> Direct Bank Transfer</label>
          </span>
          <span>
            <label><input type="checkbox"> Check Payment</label>
          </span>
          <span>
            <label><input type="checkbox"> Paypal</label>
          </span>
        </div>
    </div>
  </section> <!--/#cart_items-->

@endsection