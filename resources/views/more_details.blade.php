@extends('layouts.app')
@section('style')
<style>
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}
#myImg:hover {opacity: 0.7;}
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}
/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}
@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}
/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}

 
</style>
@endsection
@section('content')
<div class="row">
    <div style="width:150px;margin:30px 0 0 0;" class="col-md-2">
    
            @foreach($product->product_images as $slider)
            
                <img onclick="enlarge({{$slider->id}})" id="myImg{{$slider->id}}" src="/storage/files/{{ $slider->path }}"  alt="{{$product->name}}" style="width:100%;max-width:100px;height:100px;cursor: zoom-in;" class="zoom-in">
                <!-- The Modal -->
                <div id="myModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="img01">
                <div id="caption" style="font-size:30px;"></div>
                </div>
            
            <br>
            @endforeach
    </div>
    <div id="carouselExample" class="carousel slide col-md-6" style="margin:50px 0 0 80px;width:35%;height:350px;">
    <div class="carousel-inner" style="text-align:center;">
    @foreach($product->product_images as $key => $slider)
                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                <img src="/storage/files/{{ $slider->path }}"  alt="slider" style="width:85%;height:350px;">

                </div>
            @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>

    <div class="col-md-4" style="margin:50px 0 0 30px;">
        <h1>{{$product->name}}</h1>
        <h3>{{$product->description}}</h3>
        <hr>
        <h3><b>Price : </b> {{$product->price}}</h3>
        <h3><b>Color : </b> {{$product->color}}</h3>
        <h3><b>Brand : </b> {{$product->category->name}}</h3>
        <h5 style="color:blue;">( {{$product->quantity}} items in stock )</h5><br>
        <a onclick="cart({{$product->id}})" style="cursor: pointer;"><i class='fa fa-cart-plus' style='font-size:24px;padding:8px 10px 0 0;'></i></a>
       
          @php
            $has_fav = \App\Models\UserFavourite::where('product_id','=',$product->id)->where('user_id','=',Auth::id())->first();
          @endphp
          <a onclick="fav({{$product->id}})"><span id="boot-icon{{$product->id}}" class="bi bi-heart @if($has_fav) active @else inactive @endif" style="font-size:22px;padding:8px 5px 0 0; opacity: 1;"></span></a>
   </div>

</div>
<br><hr style="width:50%;margin:auto;color:black;"><br><br>


    <div class="container" style="margin:0 0 0 20px;">
        <h1><b>More Details</b></h1><br>
        <h3><b>Name : </b> {{$product->name}}</h3>
        <h3><b>Brand : </b> {{$product->category->name}}</h3>
        <h3><b>Price : </b> {{$product->price}}</h3>
        <h3><b>Color : </b> {{$product->color}}</h3>
        <h3><b>Ram : </b> {{$product->ram}}</h3>
        <h3><b>Storage : </b> {{$product->storage}}</h3>
        <h3><b>Operating System : </b> {{$product->operating_system}}</h3>
        <h3><b>Main Camera : </b> {{$product->main_camera}}</h3>
        <h3><b>Front Camera : </b> {{$product->front_camera}}</h3>
    </div><br><hr style="width:50%;margin:auto;color:black;"><br><br>

    <div class="container" style="margin:0 0 0 20px;">
        <h1><b>Customers Reviews</b></h1><br>

        <!-- Reviews -->

            <div class="row d-flex justify-content-center">
              <div class="col-md-8 col-lg-6" style="width:85%;">
                <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                  <div class="card-body p-4">
                  <!-- <div  id="message" class="alert alert-success close" style="width:50%;">
                       
                    </div> -->
                    <div class="form-outline mb-4">
                    <form action="{{route('add_review',$product->id)}}" method="post" id="ajax-upload">
                        @csrf
                    <input type="text" id="addANote" class="form-control" placeholder="Type Review..." name="content"/>
                    <input type="submit" value="Add Review" style="margin:5px 0 0 4px;"/>
                    </form> 
                    </div>

                    <div class="card mb-4">
                        
                        @foreach($reviews as $review)
                            
                      <div class="card-body">
                        <p><i>"{{$review->content}}"</i></p>

                        <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            
                            <p class="small mb-0 ms-2"><b>Posted by : </b>{{$review->user->name}}</p>
                            <p class="small mb-0 ms-2"><b>Date : </b>{{$review->created_at->toDateString()}}</p>
                        </div>
                        </div>
                     </div><hr>
                     @endforeach
                     
                    </div>

                    
                </div>
                </div>
            </div>
            </div>
        
        <!-- Reviews -->


    </div>


    <script type="text/javascript">
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


        $(document).ready(function(){
            $('#ajax-upload').on('submit',function(e){
                e.preventDefault();
                jQuery.ajax({
                    url : "{{route('add_review',$product->id)}}",
                    data: jQuery('#ajax-upload').serialize(),
                    type:'post',
                    success:function(result){
                        jQuery('#ajax-upload')[0].reset();
                        location.reload();
                    }

                })

            });
        });



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


function enlarge(id){
    
// Get the modal

    var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg"+id);
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}



}


    </script>

@endsection
