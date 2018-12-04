@extends('layouts.frontLayout.front_design')
@section('content')

<script src = "{{asset('/js/frontend_js/jquery.js')}}"></script>

<script src = "{{asset('/js/frontend_js/best_zoom.js')}}"></script>

<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">

        @if(Session::has('flash_message_error'))
          <div class = "alert alert-error alert-block" style="background-color: #D03D33;">
              <button type = "button" class = "close" data-dismiss = "alert">x</button>
                  <strong>{!! session('flash_message_error') !!}</strong>
          </div>
        @endif

        <div class="product-details"><!--product-details-->
          <div class="col-sm-5">

            <img id = "zoom_01" src="{{asset('images/backend_images/products/large_images/'.$productDetails->image)}}" data-zoom-image = "{{asset('images/backend_images/products/large_images/'.$productDetails->image)}}" width="100%" />


                
            <div class = "row" id = "thumb-image">
              @foreach($productAltImages as $altImages)
                <div class = "col-sm-3">


                  <a href="#" data-image = "{{asset('images/backend_images/products/small_images/'.$altImages->image)}}"
                                    data-zoom-image = "{{asset('images/backend_images/products/large_images/'.$altImages->image)}}">


                     <img id="img_01" src = "{{asset('images/backend_images/products/small_images/'.$altImages->image)}}"
                               height="100px">

                  </a>

                </div>
              @endforeach

            </div>             

            <script>
              $('#zoom_01').elevateZoom({gallery: 'thumb-image',
                                         cursor: 'pointer',
                                         galleryActiveClass: 'active',
                                         imageCrossfade: true,
                                         tint: true,
                                         tintColour: '#999', 
                                         tintOpacity: 0.5,
                                         scrollZoom: true});
            </script>

            <hr>

            <div class = "col-sm-5" style="margin-top: 10px;">
              Ramlal in the house
            </div>


          </div>
          <div class="col-sm-7">
            <form name = "addtocartform" id = "addtocartform" action = "{{url('/add-cart')}}" method = "post">{{csrf_field()}}
              <input type = "hidden" name = "product_id" value = "{{$productDetails->id}}">
              <input type = "hidden" name = "product_name" value = "{{$productDetails->product_name}}">
              <input type = "hidden" name = "product_code" value = "{{$productDetails->product_code}}">
              <input type = "hidden" name = "product_color" value = "{{$productDetails->product_color}}">
              <input type = "hidden" name = "product_price" id = "price" value = "{{$productDetails->price}}">
              <input type = "hidden" name = "product_image" value = "{{$productDetails->image}}">
            <div class="product-information"><!--/product-information-->
              <img src="images/product-details/new.jpg" class="newarrival" alt="" />
              <h2>{{$productDetails->product_name}}</h2>
              <p>Code: {{$productDetails->product_code}}</p>
              <span class = "price-money">$ {{$productDetails->price}}</span>
              <br>
                <div class = "inner-quantity" style="position: relative;">
                  <label style="position: absolute; top: 0px;left: 0px;">Quantity:</label>
                  <button class = "btn btn-default decrease-pins" type = "button" id = "decrease">-</button>
                  <input type="text" class = "form-control-one" id = "pins" name = "quantity" value="1" readonly />
                  <br>
                  <button class = "btn btn-default increase-pins" type = "button" id = "increase">+</button>    

<!--                   <input type = "text" id = "ramlal" value="1">
 -->
                  

                  <div class = "detail-cart">
                    <button type="Submit" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>
                    Add to cart</button>   
                  </div>
                </div> 


                <div class = "vdo">
                  <iframe src="http://www.youtube.com/embed/W7qWa52k-nE"
                          width="100%" height="130%" frameborder="0" allowfullscreen></iframe>
              </div>
              
            
                
          </div>
        </div><!--/product-details-->
        
        <div class="category-tab shop-details-tab"><!--category-tab-->
          <div class="col-sm-12">
            <ul class="nav nav-tabs">
              <li class = "active"><a href="#description" data-toggle="tab">Description</a></li>
              <li><a href="#care" data-toggle="tab">Accessories & Care</a></li>
              <li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane active in" id="description">
              <div class = "col-sm-6">
                <p>{{$productDetails->description}}</p>
              </div>
            </div>
            
            <div class="tab-pane fade" id="care" >
              <div class = "col-sm-6">
                <p>{{$productDetails->accessories_care}}</p>
              </div>
            </div>
            
            <div class="tab-pane fade" id="delivery" >
              <div class = "col-sm-6">
                <p>Ramlal on the house</p>
              </div>
            </div>
            
            <div class="tab-pane fade" id="reviews" >
              <div class="col-sm-12">
                <ul>
                  <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                  <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                  <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>
                
                <form action="#">
                  <span>
                    <input type="text" placeholder="Your Name"/>
                    <input type="email" placeholder="Email Address"/>
                  </span>
                  <textarea name="" ></textarea>
                  <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                  <button type="button" class="btn btn-default pull-right">
                    Submit
                  </button>
                </form>
              </div>
            </div>
            
          </div>
        </div><!--/category-tab-->
        
        <div class="recommended_items"><!--recommended_items-->
          <h2 class="title text-center">You Might Also Like</h2>
          
          <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <?php $count = 1; ?>
              @foreach($relatedProducts->chunk(3) as $chunk)
                <div <?php if($count == 1){?> class = "item active" <?php } else { ?> class = "item" <?php } ?>>  
                  @foreach($chunk as $item)
                    <div class="col-sm-4">
                      <div class="product-image-wrapper">
                        <div class="single-products">
                          <div class="productinfo text-center">                     
                            <img src="{{asset('images/backend_images/products/small_images/'.$item->image)}}" alt="" />
                            <h2>Rs {{$item->price}}</h2>
                            <p>{{$item->product_name}}</p>
                            <a href = "{{url('/product/'.$item->id)}}">
                              <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
              </div>
              <?php $count++; ?>
              @endforeach
            </div>
             <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
              <i class="fa fa-angle-left"></i>
              </a>
              <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
              <i class="fa fa-angle-right"></i>
              </a>      
          </div>
        </div><!--/recommended_items-->
        
      </div>
    </div>
  </div>
</section>

@endsection