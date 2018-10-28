@extends('layouts.frontLayout.front_design')
@section('content')

<section>
	<div class="container">
		<div class="row">
			@include('layouts.frontLayout.front_sidebar');			
			<div class="col-sm-9 padding-right">
				<div class="product-details"><!--product-details-->
					<div class="col-sm-5">
						<div class="view-product">
							<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
								<a href = "{{asset('images/backend_images/products/large_images/'.$productDetails->image)}}">
								<img src="{{asset('images/backend_images/products/medium_images/'.$productDetails->image)}}" style = "width:300px;" class = "mainImage" alt="" />
							</div>
						</div>
						<div id="similar-product" class="carousel slide" data-ride="carousel">
							
							  <!-- Wrapper for slides -->
							    <div class="carousel-inner">
									<div class="item active thumbnails">
										@foreach($productAltImages as $altimage)
											<a href="{{asset('/images/backend_images/products/large_images/'.$altimage->image)}}" data-standard="{{asset('/images/backend_images/products/small_images/'.$altimage->image)}}">
										 	 <img src="{{asset('/images/backend_images/products/small_images/'.$altimage->image)}}" class = "changingImages" style="width:80px; cursor:pointer;"alt="">
										 	</a>
										@endforeach
									</div>
									</div>
						</div>

					</div>
					<div class="col-sm-7">
						<div class="product-information"><!--/product-information-->
							<img src="images/product-details/new.jpg" class="newarrival" alt="" />
							<h2>{{$productDetails->product_name}}</h2>
							<p>Code: {{$productDetails->product_code}}</p>
							<select id = "selChoice" name = "choices" style = "width:150px;">
								<option value = "">Select</option>
								@foreach($productDetails->attributes as $choices)
									<option value = "{{$productDetails->id}}-{{$choices->size}}">{{$choices->size}}</option>
								@endforeach
							</select>
							<span>
								<span id = "getPrice">Rs {{$productDetails->price}}</span>
								<label>Quantity:</label>
								<input type="text" value="3" />
								<button type="button" class="btn btn-fefault cart">
									<i class="fa fa-shopping-cart"></i>
									Add to cart
								</button>
							</span>
							<p><b>Availability:</b> In Stock</p>
							<p><b>Condition:</b> New</p>
							<p><b>Brand:</b> E-SHOPPER</p>
							<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
						</div><!--/product-information-->
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
							<div class = "col-sm-12">
								<p>{{$productDetails->product_name}}</p>
							</div>
						</div>
						
						<div class="tab-pane fade" id="care" >
							<div class = "col-sm-12">
								<p>{{$productDetails->accessories_care}}</p>
							</div>
						</div>
						
						<div class="tab-pane fade" id="delivery" >
							<div class = "col-sm-12">
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
					<h2 class="title text-center">recommended items</h2>
					
					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item active">	
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/recommend1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/recommend2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/recommend3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="item">	
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/recommend1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/recommend2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/recommend3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
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