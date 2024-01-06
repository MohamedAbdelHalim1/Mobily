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



<div class="row">
  <div class="col-md-8 mb-4">
    <div class="card mb-4">
      <div class="card-header py-3">
        <h5 class="mb-0">Biling details</h5>
      </div>
      <div class="card-body">
        <form action="{{route('order_details')}}" method="POST">
            @csrf
          <!-- number input -->
          <input type="hidden" value="{{$total}}" name="order_price">
          <input type="hidden" value="{{$quantity}}" name="quantity">
          <div class="form-outline mb-4">
            <label class="form-label" for="form7Example3"><b>Phone Number</b></label>
            <input type="number" id="phone" class="form-control" name="phone" />
          </div>

          <!-- Text input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="form7Example3"><b>City</b></label>
            <select class="form-select" aria-label="Default select example" id="city" name="city">
            <option selected>Choose City</option>
            @foreach($cities as $city)
            <option value="{{$city->price}}_{{$city->city}}">{{$city->city}}</option>
            @endforeach
            </select>
          </div>

  

          <!-- Message input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="form7Example7"><b>Your Address in Details</b></label>
            <textarea class="form-control" id="address" rows="4" name="address"></textarea>
          </div>

          <button type="submit" class="btn btn-primary btn-lg btn-block">
          Order Now
        </button>

        </form>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card mb-4">
      <div class="card-header py-3">
        <h5 class="mb-0">Summary <span style="color:blue;">(Only Cash on delivery)</span></h5>
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            Quantity
            <span><b>{{$quantity}}</b> Items</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            Order Price
            <span><b>{{$total}}</b> LE</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            Shipping
            <p><b><span id="shippingPrice">Choose City</span> </b>LE</p>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
            <div>
              <strong>Total Price</strong>
            </div>
            <strong><span id="total_price"></span></strong>
          </li>
        </ul>

        

      </div>
    </div>
  </div>
</div>

<script>
      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $("#city").on("change",function(){
        var shipping = document.getElementById("city").value;
        var shipping_price = shipping.substring(0, shipping.indexOf('_'));
    

        jQuery.ajax({
                    url : "{{route('shipping',['total'=>$total , 'quantity'=>$quantity])}}",
                    data: {shipping_price:shipping_price},
                    type:'post',
                    success:function(data){
                        document.getElementById('shippingPrice').textContent = data.shipping;
                        document.getElementById('total_price').textContent = data.total_price;

                  }

                })
    });
      

        
    
</script>

@endsection
