@extends('layouts.app')
@section('style')
<style>

</style>
@endsection
@section('content')


<h1 style="margin:0 0 0 25px;"><b>Products You Like</b></h1><br><br>

<div class="container">
  <div class="row">


  @if(count($favourites)>0)
        @foreach($favourites as $fav)

        <div class="col-md-3 mt-2">
            <div class="card" style="overflow:hidden;">
                <div class="card-body" style="margin:auto;">
                        @foreach($fav->product->product_images as $key => $slider)
                                @if($key == 0)
                                <img src="/storage/files/{{ $slider->path }}"  alt="{{ $fav->product->name }}" style="width:200px;height:200px;">
                                @endif
                            @endforeach
                <h5 class="card-title font-weight-bold  ">{{$fav->product->name}}</h5>
                <p class="card-text"><b>Brand : </b>{{$fav->product->category->name}}</p>
                <p class="card-text"><b>Price : </b>{{$fav->product->price}}</p>
                <a href="{{route('more_details',$fav->product->id)}}" class="btn btn-primary btn-block">See More</a>
                <i class='fa fa-cart-plus' style='font-size:24px;padding:8px 10px 0 0;'></i>
                    <a onclick="delFav({{$fav->product->id}})"><span id="boot-icon" class="bi bi-heart" style="font-size:22px;padding:8px 5px 0 0; color: rgb(255, 0, 0); opacity: 1; -webkit-text-stroke-width: 1px;"></span></a>                
                </div>
            </div>
            </div>
            @endforeach
     @else
        <h2>No Products in Favourites Yet</h2>
     @endif          

  </div>
</div>


<script type="text/javascript">
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



function delFav(id){
  var product_id = id;
  jQuery.ajax({
                    url : "{{route('delfav')}}",
                    data: {product_id:product_id},
                    type:'post',
                    success:function(data){
                      location.reload();
                  }

                })
}

</script>


@endsection
