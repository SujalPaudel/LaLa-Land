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
          <div class="col-sm-12">
            <div class="contactinfo" style="position: relative;">
              <ul class="nav nav-pills">
                <li><a href = "{{url('/about-us')}}">About Us</a></li>
                <li><a href = "{{url('/our-artist')}}">Our Artists</a></li>
                <li><a href = "{{url('/Customer-service')}}">Customer Service</a></li>
                <li><a href = "{{url('/wholesale')}}">Wholesale</a></li>
                <li><a href = "{{url('/blog')}}">Blog</a></li>
                <li><a href = "{{url('/new-items')}}">New ITEMS</a></li>
                <li><a href = "{{url('/sale')}}">Sale</a></li>
                <li><a href = "{{url('/gift-certifications')}}">Gift Certificates</a></li>
                <li><a>Store</a></li>
                <li><a>Our Collections</a></li>
                <li><a>Meet Us</a></li>
              </ul>
            </div>
          
            <div class="social-icons pull-right" style="position: absolute;top:0;left: 85%;">
              <ul class="nav navbar-nav">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <!-- <li><a href="#"><i class="fa fa-dribbble"></i></a></li> -->
                <!-- <li><a href="#"><i class="fa fa-google-plus"></i></a></li> -->
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
          <div class="col-sm-9 shyamlal">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <div class="mainmenu">
              <ul class="nav navbar-nav collapse navbar-collapse">
                @foreach($categories as $cat)
                  @if($cat->status == '1')
                    <li><a href="{{url('/category/'.$cat->url)}}" target="_blank">{{$cat->name}}
                      <i class="fa fa-angle-down"></i></a>
                        
                          <ul role="menu" class="sub-menu {{$cat->name}}">
                              
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

  <!-- <div class = "parent"> -->
