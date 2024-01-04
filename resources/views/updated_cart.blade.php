<section class="pt-5 pb-5 updated_cart">
  <div class="container">
    <div class="row w-100">
        <div class="col-lg-12 col-md-12 col-12">
            <h3 class="display-5 mb-2 text-center" style="font-style: oblique;"><b>Shopping Cart</b></h3>
            <p class="mb-5 text-center">
            <table id="shoppingCart" class="table table-condensed table-responsive">
                <thead>
                    <tr>
                        <th style="width:60%">Product</th>
                        <th style="width:12%">Price</th>
                        <th style="width:10%">Quantity</th>
                        <th style="width:16%"></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($carts) == 0)
                    <tr><td> <h1>NO Items In Cart</h1></td></tr>
                    @else
                        @foreach($carts as $cart)
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-md-3 text-left">
                                    @foreach($cart->product->product_images as $key => $slider)
                                        @if($key == 0)
                                        <img src="/storage/files/{{ $slider->path }}"  alt="{{ $cart->product->name }}" style="width:160px;height:160px;">
                                        @endif
                                    @endforeach        
                                    </div>
                                    <div class="col-md-9 text-left mt-sm-2">
                                        <h4><b>{{$cart->product->name}}</b></h4>
                                        <b>Brand : </b>{{$cart->product->category->name}}<br>
                                        <small style="color:blue;">( {{$cart->product->quantity}} items in stock )</small>
                                    </div>
                                </div>
                            </td>
            
                            <td data-th="Price">{{$cart->product->price}}</td>
                            <td data-th="Quantity">
                                <input type="number" id="quantity{{$cart->product->id}}" onchange="quantity({{$cart->product->id}})" class="form-control form-control-lg text-center" value="{{$cart->quantity}}">
                            </td>
                            <td class="actions" data-th="">
                                <div class="text-right">
                                <button class="btn btn-danger" onclick="delCart({{$cart->product->id}})">Delete</button>
                            </div>
                            </td>
                        </tr>
                        @endforeach
                     @endif   
                </tbody>
            </table>
            <div style="float:right;">
                <h4>Subtotal:( <span id="itemsQuantity"> {{$counter}} </span> items)</h4>
                <h2 id="total_price">{{$total}} LE</h2>
            </div>
        </div>
    </div>
    <div class="row mt-4 d-flex align-items-center">
        <div class="col-sm-6 order-md-2">
            <a  class="btn btn-primary" style="float:right;">Checkout</a>
        </div>
        <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
            <a onclick="history.back()" style="color:blue;cursor: pointer;">
                <i class="fa fa-arrow-left mr-2"></i> Continue Shopping</a>
        </div>
    </div>
</div>
</section>