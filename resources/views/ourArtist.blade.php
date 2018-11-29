@extends('layouts.frontLayout.front_design')
@section('content')

<div class="container">
  <div class="row">

      <div class="col-sm-12">
        <div class = "head_content">

         <h2 style="text-transform: uppercase;">Our Artists</h2> 
            <hr style="border-top: 2px solid #8c8b8b;"> 
               
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin porttitor condimentum volutpat. Quisque auctor quis nulla id finibus. Nullam nulla magna, molestie at scelerisque hendrerit, luctus ac augue. Pellentesque at est dolor. Sed mattis sodales urna id tempor. Integer tristique sodales tellus, sit amet porttitor ipsum aliquet nec. Mauris iaculis sapien quis fringilla dignissim. Suspendisse lacus libero, fermentum in ipsum id, cursus pellentesque sem. Sed faucibus, odio ac malesuada varius, lorem sapien interdum odio, eu pulvinar odio diam laoreet sapien. Nunc ac pharetra lacus. Curabitur porta nulla nec nulla consequat, id vehicula orci commodo.
              </p>        
            <hr style="border-top: 1px solid #8c8b8b;">

            @foreach($interviews as $interview)
              <div class = "col-sm-6">
                <h3>{{$interview->name}}</h3>
                <p>{{$interview->artist_interview}}</p>
                <hr style="border-top: 1px solid #8c8b8b;">
              </div>

              <div class = "col-sm-6">
                <img src = "{{url('/images/backend_images/artist/'.$interview->artist_image)}}" width="100%" height="400px" style="border-radius: 5px;">
                <hr style="border-top: 1px solid #8c8b8b;">
              </div>
            @endforeach

        </div>  
      </div>

  </div>
</div>


@endsection

      