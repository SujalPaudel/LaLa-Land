@extends('layouts.frontLayout.front_design')

@section('content')

<body>
  <div class="container text-center">
    <div class="content-404">
      <img src="images/404/404.png" class="img-responsive" alt="" />
      <h1><b>OOPS!</b></h1>
      <p>We Couldn’t Find this Page</p> 
      <h2><a href="{{ asset('./') }}">Bring me back Home</a></h2>
    </div>
  </div>
</body>
@endsection