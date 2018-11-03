@extends('layouts.adminLayout.admin_design');
@section('content');

<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">View Bannerss</a> </div>
    <h1>Categories</h1>
    @if(Session::has('flash_message_error'))
      <div class = "alert alert-error alert-block">
          <button type = "button" class = "close" data-dismiss = "alert">x</button>
              <strong>{!! session('flash_message_error') !!}</strong>
      </div>
    @endif 

    @if(Session::has('flash_message_success'))
      <div class = "alert alert-success alert-block">
          <button type = "button" class = "close" data-dismiss = "alert">x</button>
              <strong>{!! session('flash_message_success') !!}</strong>
      </div>
    @endif
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Banners</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Banner ID</th>
                  <th>Title</th>
                  <th>Link</th>
                  <th>Status</th>
                  <th>Image</th>                  
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($banners as $banner)
                <tr class="gradeX">
                  <td class = "center" >{{ $banner->id }}</td>
                  <td class = "center" >{{ $banner->title }}</td>
                  <td class = "center" >{{ $banner->link}}</td>
                  <td class = "center" >{{ $banner->status}}</td>
                  <td class = "center" >
                  @if(!empty($banner->image ))
                    <img src = "{{asset('/images/frontend_images/banners/'.$banner->image)}}" style = "width: 250px;">     
                  </td>
                  @endif
                  
                  <td class="center">
                   
                    <a href = "{{url('/admin/edit-banner/'.$banner->id) }}" class = "btn btn-primary btn-mini" title = "Edit Product">Edit</a>
                    <a rel = "{{$banner->id}}" rel1 = "delete-banner" id = "delBanner" <?php /* href = "{{ url('/admin/delete-product/'.$product->id) }}"*/ ?> href = "javascript:" class = "btn btn-danger btn-mini deleteRecord">Delete</a>
                  </td>
                </tr>
                @endforeach                
                </div>              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection;

