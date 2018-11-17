<?php
use App\Http\Controllers\Controller;
use App\Category;

$mainCategories = Controller::mainCategories();
$categories= Category::with('subcategories')->where(['parent_id'=>0])->get();


// $sub_categories = Category::where(['parent_id'=>$cat->id])->get();


?>

  <header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="contactinfo">
              <ul class="nav nav-pills">
                <li><button class = "btn btn-primary"><a>Explore</a></button></li>
                <li><a>About Us</a></li>
                <li><a>Store</a></li>
                <li><a>Our Collections</a></li>
                <li><a>Meet Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="social-icons pull-right">
              <ul class="nav navbar-nav">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header_top-->
    
    <div class="header-middle"><!--header-middle-->
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="logo pull-left">
              <a href="{{url('/')}}"><img src="{{asset('images/frontend_images/home/logo.png')}}" alt="" /></a>
            </div>
          </div>


          <div class="col-sm-8">
            <div class="shop-menu pull-right">
              <ul class="nav navbar-nav">
                <!-- <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li> -->
                <li><a href="{{url('/checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                <li><a href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                @if(Auth::check())
                  <li><a href="{{url('/account')}}"><i class="fa fa-user"></i> Account</a></li>                
                  <li><a href="{{url('/user-logout')}}"><i class="fa fa-sign-out"></i>Logout</a></li>
                @else
                  <li><a href="{{url('/login-register')}}"><i class="fa fa-lock"></i>Login</a></li>
                @endif                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header-middle-->
  
    <div class="header-bottom"><!--header-bottom-->
      <div class="container">
        <div class="row">
          <div class="col-sm-9">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <div class="mainmenu pull-left">
              <ul class="nav navbar-nav collapse navbar-collapse">
                @foreach($categories as $cat)
                  @if($cat->status == '1')
                    <li><a href="">{{$cat->name}}
                      <i class="fa fa-angle-down"></i></a>
                        <ul role="menu" class="sub-menu">
                            
                        @foreach($cat->subcategories as $subc)
                          @if($subc->status == '1')
                            <li><a href="{{ $subc->url }}">{{$subc->name}}</a></li>
                          @endif
                        @endforeach
                      
                        </ul>
                  @endif
                @endforeach
            </div>

          </div>
          <div class="col-sm-3">
            <div class="search_box pull-right">
              <input type="text" placeholder="Search"/>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header-bottom-->
  </header><!--/header-->