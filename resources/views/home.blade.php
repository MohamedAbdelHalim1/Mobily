@extends('layouts.app')
@section('style')
<style>
  html {
  scroll-behavior: smooth;
}
  .nav {
  overflow: hidden;
  background-color:  #0062ff;
  width: 100%;
  height:40px;
  display: flex;
  justify-content: center;
}

.nav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 9px 16px;
  text-decoration: none;
  font-size: 15px;
}

.nav a:hover {
  background: #ddd;
  color: black;
}

.button4 {
  background-color: white;
  color: black;
  border: 2px solid #e7e7e7;
}
.button4:hover {background-color: #e7e7e7;}


</style>
@endsection

@section('nav')

<div class="nav">
@foreach ($models as $model) 
@if($model->maincategory != null)
<a href="{{route('model',$model->id)}}">{{$model->name}}</a>
@endif
@endforeach
</div>

@endsection


@section('content')


<div class="w3-container w3-animate-bottom" id="section1"  data-aos="fade-up" style="width:75%;margin:30px 0 30px 160px;">
  <div class="row" style="padding:25px;">
  <h1 style="margin:0 0 25px 0; text-transform: uppercase;color: #4CAF50;"><b>Our Categories</b></h1><br><br>

  @foreach ($models as $model) 
    @if($model->maincategory != null)
    <div class="col-md-3 mt-2">
      <a href="{{route('model',$model->id)}}">
        <img src="/storage/files/{{ $model->image_path }}"  alt="{{ $model->name }}" style="width:140px;height:120px;border-radius:50%;" loading="lazy">
      </a>
    </div> 
    @endif
    @endforeach
  </div>
</div>



<div class="container w3-animate-bottom" id="section2" data-aos="fade-down">

  <div class="row">

<h1 style="margin:0 0 25px 25px; text-transform: uppercase;color: #4CAF50;"><b>Recommended Products</b></h1><br><br>

<div class="container">
  <div class="row">

  @foreach ($recommended as $product) 
      @php
        $has_fav = \App\Models\UserFavourite::where('product_id','=',$product->id)->where('user_id','=',Auth::id())->first();
      @endphp
      @if($product->quantity != 0)
  <div class="col-md-3 mt-2">
      <div class="card" style="overflow:hidden;">
        <div class="card-body" style="margin:auto;">
                   @foreach($product->product_images as $key => $slider)
                        @if($key == 0)
                        <img src="/storage/files/{{ $slider->path }}"  alt="{{ $product->name }}" style="width:200px;height:200px;" loading="lazy">
                        @endif
                    @endforeach
           <h5 class="card-title font-weight-bold  ">{{$product->name}}</h5>
           <h6 class="card-text"><b>Brand : </b>{{$product->category->name}}</h6>
           <h6 class="card-text"><b>Price : </b>{{$product->price}} LE</h6>
           <a href="{{route('more_details',$product->id)}}" class="btn btn-primary btn-block">See More</a>
           <a onclick="cart({{$product->id}})" style="cursor: pointer;"><i class='fa fa-cart-plus' style='font-size:24px;padding:8px 10px 0 0;'></i></a>
           <a onclick="fav({{$product->id}})" style="cursor: pointer;"><span id="boot-icon{{$product->id}}" class="bi bi-heart @if($has_fav) active @else inactive @endif" style="font-size:22px;padding:8px 5px 0 0; opacity: 1;"></span></a>
          
            
                        
        </div>
      </div>
    </div>
    @endif
    <!-- col-md-2 end -->
    @endforeach

  </div>
</div><br>






<div class="container w3-animate-bottom" id="section3" data-aos="fade-down">

  <div class="row">

<h1 style="margin:25px 0 25px 25px; text-transform: uppercase;color: #4CAF50;"><b>New Arrival Products</b></h1><br><br>

<div class="container">
  <div class="row">

  @foreach ($new_arrival as $product) 
      @php
        $has_fav = \App\Models\UserFavourite::where('product_id','=',$product->id)->where('user_id','=',Auth::id())->first();
      @endphp
      @if($product->quantity != 0)
  <div class="col-md-3 mt-2">
      <div class="card" style="overflow:hidden;">
        <div class="card-body" style="margin:auto;">
                   @foreach($product->product_images as $key => $slider)
                        @if($key == 0)
                        <img src="/storage/files/{{ $slider->path }}"  alt="{{ $product->name }}" style="width:200px;height:200px;" loading="lazy">
                        @endif
                    @endforeach
           <h5 class="card-title font-weight-bold  ">{{$product->name}}</h5>
           <h6 class="card-text"><b>Brand : </b>{{$product->category->name}}</h6>
           <h6 class="card-text"><b>Price : </b>{{$product->price}} LE</h6>
           <a href="{{route('more_details',$product->id)}}" class="btn btn-primary btn-block">See More</a>
           <a onclick="cart({{$product->id}})" style="cursor: pointer;"><i class='fa fa-cart-plus' style='font-size:24px;padding:8px 10px 0 0;'></i></a>
           <a onclick="fav({{$product->id}})" style="cursor: pointer;"><span id="boot-icon{{$product->id}}" class="bi bi-heart @if($has_fav) active @else inactive @endif" style="font-size:22px;padding:8px 5px 0 0; opacity: 1;"></span></a>
          
            
                        
        </div>
      </div>
    </div>
    @endif
    <!-- col-md-2 end -->
    @endforeach

  </div>
  <a href="#section1" class="button button4 slide" style="float:right;width:100px;height:50px;text-decoration:none;color:blue;text-align:center;padding-top:10px;font-weight:bold;font-size:15px;">SCROLL-UP</a>
</div>









<script type="text/javascript">


// Test for the ugliness.
if (window.location.hash === "#_=_"){

// Check if the browser supports history.replaceState.
if (history.replaceState) {

    // Keep the exact URL up to the hash.
    var cleanHref = window.location.href.split("#")[0];

    // Replace the URL in the address bar without messing with the back button.
    history.replaceState(null, null, cleanHref);

} else {

    // Well, you're on an old browser, we can get rid of the _=_ but not the #.
    window.location.hash = "";

}

}


  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function fav(id){
  var product_id = id;
  jQuery.ajax({
                    url : "{{route('fav')}}",
                    data: {product_id:product_id},
                    type:'post',
                    success:function(data){
                      if (data.message == "Added") {
                        document.getElementById('boot-icon'+id).classList.remove('inactive');
                        document.getElementById('boot-icon'+id).classList.add('active');
                      }else{
                        document.getElementById('boot-icon'+id).classList.remove('active');
                        document.getElementById('boot-icon'+id).classList.add('inactive');
                      }
                  }

                })
}


function cart(id){
  var product_id = id;
  jQuery.ajax({
                    url : "{{route('add-cart')}}",
                    data: {product_id:product_id},
                    type:'post',
                    success:function(data){
                      if (data.alreadyAdded) {
                        Swal.fire("Already Added!");
                      }else{
                        Swal.fire("Added Successfully To Your Cart!");

                      }
                      

                  }

                })

}




$(document).ready(function(){
  // Add smooth scrolling to all links
  $(".slide").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 250, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});


AOS.init({
  duration: 1200,
})


</script>


@endsection
