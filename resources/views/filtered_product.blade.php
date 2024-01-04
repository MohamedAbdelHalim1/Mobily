 
      <div class="row">
        @if(count($products)>0)
        @foreach ($products as $product) 
  
        <div class="col-3" style="width:230px;">
          <div class="card">
            <div class="card-body" style="margin:auto;">
                      @foreach($product->product_images as $key => $slider)
                            @if($key == 0)
                            <img src="/storage/files/{{ $slider->path }}"  alt="{{ $product->name }}" style="width:130px;height:130px;">
                            @endif
                        @endforeach
              <h5 class="card-title font-weight-bold  ">{{$product->name}}</h5>
              <p class="card-text"><b>Brand : </b>{{$product->category->name}}</p>
              <p class="card-text"><b>Price : </b>{{$product->price}}</p>
              <a href="{{route('more_details',$product->id)}}" class="btn btn-primary btn-block">See More</a>
              <i class='fa fa-cart-plus' style='font-size:24px;padding:8px 10px 0 0;'></i>
              <i class="fa fa-heart-o" style="font-size:22px;padding:8px 5px 0 0;"></i>
            </div>
          </div>
        </div>
    
        @endforeach
        @else
        <h3 style="text-align:center;"> NO Products Found </h3>
        @endif
      </div>
   