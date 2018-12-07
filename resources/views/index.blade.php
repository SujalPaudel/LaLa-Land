@extends('layouts.frontLayout.front_design')

@section('content')

  <section id="slider"><!--slider-->
    <div class="container">
      <div class="row">
        <div class="col-sm-12" style="height: 120%;">
          <div id="slider-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
              <li data-target="#slider-carousel" data-slide-to="1"></li>
              <li data-target="#slider-carousel" data-slide-to="2"></li>
              <li data-target="#slider-carousel" data-slide-to="3"></li>
              <li data-target="#slider-carousel" data-slide-to="4"></li>
              <li data-target="#slider-carousel" data-slide-to="5"></li>
              <li data-target="#slider-carousel" data-slide-to="6"></li>
              <li data-target="#slider-carousel" data-slide-to="7"></li>
              <li data-target="#slider-carousel" data-slide-to="8"></li>
              <li data-target="#slider-carousel" data-slide-to="9"></li>
            </ol>
            
            <div class="carousel-inner">

              @foreach($banners as $key => $banner)
                <div class="item @if($key == 0) active @endif">

                <div class = "sm-wrapper" style="max-height: 300px;">
                  <div class="col-sm-6">
                    <h1><span>{{$banner->title}}</span></h1>
                    <div class = "cont_master" style="max-height: 200px;">
                    <p>{{$banner->content}}</p>
                    </div>
                    <a href = "{{url('/category/'.$banner->link)}}" class="btn btn-default get">Get it Now</a>
                  </div>
                </div>
                  <div class = "col-sm-6">
                    <img src = "{{asset('images/frontend_images/banners/'.$banner->image)}}">
                  </div>
                </div>    
              @endforeach                        
            </div>
            
            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
              <i class="fa fa-angle-left"></i>
            </a>
            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
              <i class="fa fa-angle-right"></i>
            </a>
        
          
        </div>
      </div>
    </div>
  </div>
  </section><!--/slider-->
  
<style>

</style>

  <section>
    <div class="container">
      <div class="row">

  
        
        <div class="col-sm-12 padding-right">
          <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Featured Items</h2>
            @foreach($productsAll as $product)
              <div class="col-sm-3 ">
                <div class="product-image-wrapper">
                  <div class="single-products">
                      <div class="productinfo text-center">
                        <img src="{{asset('images/backend_images/products/large_images/'.$product->image)}}" alt="" />
                        <h2>$ {{ $product->price }}</h2>
                        <p>{{$product->product_name}}</p>
                        <a href="{{url('/product/'.$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Pin to cart</a>
                      </div>
                  </div>
                </div>
              </div>
            @endforeach

          </div>   
        </div>
      </div>
    </div>
  </section> 


@endsection