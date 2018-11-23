<?php
use App\Http\Controllers\Controller;
use App\Category;

$mainCategories = Controller::mainCategories();
$mainCategories = json_decode(json_encode($mainCategories));
?>



  <footer id="footer"><!--Footer-->
     <div class="footer-widget">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="single-widget">
              <h2>Right Now</h2>
              <ul class="nav nav-pills nav-stacked">
                @foreach($mainCategories as $mainCat)
                  <li><a href="#">{{$mainCat->name}}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
   
          <div class="col-sm-4">
            <div class="single-widget">
              <h2>About Shopper</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Company Information</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Store Location</a></li>
                <li><a href="#">Affillate Program</a></li>
                <li><a href="#">Copyright</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="single-widget come-closer">
              <h2>Lets Come Closer</h2>
                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                <p>Email: <strong style="color: black;">info@harmonicgrace.com</strong></p>
              </form>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <p class="pull-left"">Copyright © 2018 harmonicgrace. All rights reserved.</p>
        </div>
      </div>
    </div>
    
  </footer><!--/Footer-->