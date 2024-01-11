@extends('layouts.app')
@section('style')
<style>
  .filterbutton:hover{

   box-shadow: 0 12px 16px 0  brown;
 
  }
</style>
@endsection
@section('content')
<div id="carouselExample" class="carousel slide" style="width:100%;">
  <div class="carousel-inner" style="text-align:center;">
  @foreach($sliders as $key => $slider)
            <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
              <img src="/storage/files/{{ $slider->path }}"  alt="slider" style="width:75%;height:350px;padding:0 0 0 250px;margin:0 200px 0 0;">
              <a href="{{route('more_details',$slider->id)}}" style="text-decoration:none;color:black;"><h3 style="margin:0 250 0 0;">{{$slider->name}}</h3></a>
              <h6 style="margin:0 250 0 0;">{{$slider->description}}</h6>
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
</div><br><hr style="width:50%;margin:auto;color:black;"><br>



<div class="container" style="margin: 0 30px 0 0;">
  <div class="row">

    <div class="col-3" id="filter" style="margin:10px 50px 0 0;">
      <h2><small><b>Filter Products</b></small></h2>
      <hr>

      <h4><small><b>Price Range</b></small></h4>
      <div class="row">
        <div class="col-md-3">
          <input type="text" id="min_price" class="common_selector" name="min_price" style="width:80px;margin:0 0 0 8px;border:none;border-bottom:2px solid grey;" placeholder="min price">
        </div>
        <div class="col-md-3">
          <input type="text" id="max_price" class="common_selector" name="max_price" style="width:80px;margin:0 0 0 25px;border:none;border-bottom:2px solid grey;" placeholder="max price">
        </div>

      </div>
    
  
      <br>
      <h4><small><b>Ram</b></small></h4>
      @foreach($unique_ram as $ram)
      <input type="checkbox" id="ram" class="common_selector ram" name="ram[]"  value="{{$ram->ram}}">
      <label for="ram">{{$ram->ram}} GB</label><br>
      @endforeach   <br>
      <h4><small><b>Storage</b></small></h4>
      @foreach($unique_storage as $storage)
      <input type="checkbox" id="storage" class="common_selector storage" name="storage[]"  value="{{$storage->storage}}">
      <label for="storage">{{$storage->storage}}</label><br>
      @endforeach   <br>

      <h4><small><b>Color</b></small></h4>
      @foreach($unique_color as $color)
      <input type="checkbox" id="color" class="common_selector color" name="color[]" value="{{$color->color}}">
      <label for="color">{{$color->color}}</label><br>
      @endforeach  <br>


    </div>

    <div class="col-8 filter_data"> 
      <div class="row">
        @if(count($products_of_model)>0)
        @foreach ($products_of_model as $product) 
            @php
            $has_fav = \App\Models\UserFavourite::where('product_id','=',$product->id)->where('user_id','=',Auth::id())->first();
          @endphp
          @if($product->quantity != 0)
        <div class="col-3" style="width:230px;">
          <div class="card">
            <div class="card-body" style="margin:auto;">
                      @foreach($product->product_images as $key => $slider)
                            @if($key == 0)
                            <img src="/storage/files/{{ $slider->path }}"  alt="{{ $product->name }}" style="width:130px;height:130px;" loading="lazy">
                            @endif
                        @endforeach
              <h5 class="card-title font-weight-bold  ">{{$product->name}}</h5>
              <p class="card-text"><b>Brand : </b>{{$product->category->name}}</p>
              <p class="card-text"><b>Price : </b>{{$product->price}}</p>
              <a href="{{route('more_details',$product->id)}}" class="btn btn-primary btn-block">See More</a>
              <a onclick="cart({{$product->id}})" style="cursor: pointer;"><i class='fa fa-cart-plus' style='font-size:24px;padding:8px 10px 0 0;'></i></a>
              <a onclick="fav({{$product->id}})"><span id="boot-icon{{$product->id}}" class="bi bi-heart @if($has_fav) active @else inactive @endif" style="font-size:22px;padding:8px 5px 0 0; opacity: 1;"></span></a>

            </div>
          </div>
        </div>
          @endif
        @endforeach
        @else
        <h3 style="text-align:center;"> NO Products Found </h3>
        @endif
      </div>
    </div>

  </div>
</div>



    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>





<script type="text/javascript">
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.common_selector').on('change',function(){
       filter_data();
    });


function filter_data()
    {
        var min_price = $('#min_price').val();
        var max_price = $('#max_price').val();
        var ram = get_filter('ram');
        var storage = get_filter('storage');
        var color = get_filter('color');
          jQuery.ajax({
                    url : "{{route('filter_product',$id)}}",
                    data: {ram:ram , storage:storage , color:color, min_price:min_price , max_price:max_price},
                    type:'post',
                    success:function(data){
                      $('.filter_data').html(data);  //data is the view returned
                  }

                })

    }


  function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
      return filter;
    }


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
