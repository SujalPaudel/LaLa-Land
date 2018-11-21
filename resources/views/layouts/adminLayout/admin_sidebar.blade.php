<?php echo $url = url()->current(); ?>

<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li @if(preg_match('/dashboard/i', $url)) class="active" @endif><a href="{{url('/admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
  
    <li  @if(preg_match('/categor/i', $url)) class = "submenu open" @else class = "submenu" @endif> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">2</span></a>
      <ul>
        <li @if(preg_match('/add-category/i', $url)) class = "active" style = "display: block;" @endif><a href="{{url('/admin/add-category')}}">Add Category</a></li>
        <li @if(preg_match('/view-categories/i', $url)) class = "active" @endif><a href="{{url('/admin/view-categories')}}">View Categories</a></li>
      </ul>
    </li>

    <li @if(preg_match('/product/i', $url)) class = "submenu open" @else class = "submenu" @endif> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span> <span class="label label-important">2</span></a>
      <ul>
        <li @if(preg_match('/add-product/i', $url)) class = "active" @endif><a href="{{url('/admin/add-product')}}">Add Product</a></li>
        <li @if(preg_match('/view-products/i', $url)) class = "active" @endif><a href="{{url('/admin/view-products')}}">View Products</a></li>
      </ul>
    </li>

    <li @if(preg_match('/coupon/i', $url)) class = "submenu open" @else class = "submenu" @endif> <a href="#"><i class="icon icon-th-list"></i> <span>Coupons</span> <span class="label label-important">2</span></a>
      <ul>
        <li @if(preg_match('/add-coupon/i', $url)) class = "active" @endif ><a href="{{url('/admin/add-coupon')}}">Add Coupon</a></li>
        <li @if(preg_match('/view-coupons/i', $url)) class = "active" @endif ><a href="{{url('/admin/view-coupons')}}">View Coupons</a></li>
      </ul>
    </li>

    <li @if(preg_match('/banner/i', $url)) class = "submenu open" @else class = "submenu" @endif> <a href="#"><i class="icon icon-th-list"></i> <span>Banners</span> <span class="label label-important">2</span></a>
      <ul>
        <li @if(preg_match('/add-banner/i', $url)) class = "active" @endif ><a href="{{url('/admin/add-banner')}}">Add Banner</a></li>
        <li @if(preg_match('/view-banners/i', $url)) class = "active" @endif ><a href="{{url('/admin/view-banners')}}">View Banners</a></li>
      </ul>
    </li>    

    <li @if(preg_match('/aboutUs/i', $url)) class = "submenu open" @else class = "submenu" @endif> <a href="#"><i class="icon icon-th-list"></i> <span>About Us</span> <span class="label label-important">2</span></a>
      <ul>
        <li @if(preg_match('/add-aboutUs/i', $url)) class = "active" @endif ><a href="{{url('/admin/add-aboutUs')}}">Add About Us</a></li>
        <li @if(preg_match('/view-banners/i', $url)) class = "active" @endif ><a href="#">View AboutUs</a></li>
      </ul>
    </li> 

    <li @if(preg_match('/artist/i', $url)) class = "submenu open" @else class = "submenu" @endif> <a href="#"><i class="icon icon-th-list"></i> <span>Artist</span> <span class="label label-important">2</span></a>
      <ul>
        <li @if(preg_match('/add-artist/i', $url)) class = "active" @endif ><a href="{{url('/admin/add-artist')}}">Add Artist</a></li>
        <li @if(preg_match('/view-artists/i', $url)) class = "active" @endif ><a href="#">View AboutUs</a></li>
      </ul>
    </li> 

  </ul>
</div>