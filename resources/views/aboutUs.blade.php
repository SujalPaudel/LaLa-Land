@extends('layouts.frontLayout.front_design')

@section('content')

  
<div class="container">
  <div class="row">

      <div class="col-sm-12">
        <iframe width="100%" style="height: 50rem;" 
        src="https://www.youtube.com/embed/tgbNymZ7vqY">
        </iframe>  
      </div>

      <div class = "col-sm-12 about-text-section">
        @foreach($about as $abt)
          <p>{{$abt->content}}</p>
        @endforeach
      </div>

      <div class = "col-sm-12">
        @foreach($images as $image)
          <img src = "{{url('images/backend_images/aboutUs/'.$image->image)}}" height="250px;" style="margin: 10px;">
        @endforeach
      </div>
  </div>
</div>



@endsection