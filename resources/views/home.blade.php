@extends('layouts.app')
@section('style')
<style>
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




<br><div class="container">
  <div class="row">

<h1 style="margin:0 0 0 25px;"><b>Recommended & New Arrival</b></h1><br><br>

<div class="container">
  <div class="row">

  @foreach ($recommended_and_newArrival_products as $product) 
      @php
        $has_fav = \App\Models\UserFavourite::where('product_id','=',$product->id)->where('user_id','=',Auth::id())->first();
      @endphp
  <div class="col-md-3 mt-2">
      <div class="card" style="overflow:hidden;">
        <div class="card-body" style="margin:auto;">
                   @foreach($product->product_images as $key => $slider)
                        @if($key == 0)
                        <img src="/storage/files/{{ $slider->path }}"  alt="{{ $product->name }}" style="width:200px;height:200px;">
                        @endif
                    @endforeach
           <h5 class="card-title font-weight-bold  ">{{$product->name}}</h5>
           <p class="card-text"><b>Brand : </b>{{$product->category->name}}</p>
           <p class="card-text"><b>Price : </b>{{$product->price}}</p>
           <a href="{{route('more_details',$product->id)}}" class="btn btn-primary btn-block">See More</a>
           <a onclick="cart({{$product->id}})" style="cursor: pointer;"><i class='fa fa-cart-plus' style='font-size:24px;padding:8px 10px 0 0;'></i></a>
           <a onclick="fav({{$product->id}})" style="cursor: pointer;"><span id="boot-icon{{$product->id}}" class="bi bi-heart @if($has_fav) active @else inactive @endif" style="font-size:22px;padding:8px 5px 0 0; opacity: 1;"></span></a>
            
            
                        
        </div>
      </div>
    </div>
    <!-- col-md-2 end -->
    @endforeach

  </div>
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


</script>


@endsection
