

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
                <h1>Your Order has been received</h1>
    			<h2>Invoice (Free returns in 14 Days)</h2><h3 class="pull-right">Order # {{$data['order_id']}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-6 text-start">
    				<address>
    				<strong>Billed To:</strong><br>
    					{{$data['username']}}<br>
    					{{$data['city']}}<br>
    					{{$data['address']}}<br>
    					phone number: {{$data['phone']}}<br>
                        <strong>Payment Method:</strong><br>
    					Cash on delivery<br>
                        <strong>Order Date:</strong><br>
    					{{$data['created_at']}}<br>
    				</address>
    			</div>
    			<div class="col-6 text-end">
                <strong>Shipped To:</strong><br>
    					{{$data['username']}}<br>
    					{{$data['city']}}<br>
    					{{$data['address']}}<br>
    					phone number: {{$data['phone']}}<br>
                        <strong>purchase Summary:</strong><br>
                        Subtotal: {{$data['subtotal']}}<br>
                        Shipping: {{$data['shipping']}}<br>
                        Total Price: <span style="color:blue;"> {{$data['total_price']}} </span>
    				</address>
    			</div>
    		</div>
			<div class="row">
						<table style=" border: 1px solid; width: 100%; border-collapse: collapse;">
							<tr>
								<th style=" border: 1px solid;">Item name</th>
								<th style=" border: 1px solid;">Quantity</th>
								<th style=" border: 1px solid;">Price</th>
								
							</tr>
							@php

							$order_items = App\Models\OrderDetails::where('order_id','=',$data['order_id'])->get();

							@endphp
							@foreach($order_items as $item)
							<tr>
								<td style=" border: 1px solid;">{{$item->product->name}}</td>
								<td style=" border: 1px solid;">{{$item->quantity}}</td>
								<td style=" border: 1px solid;">{{$item->price}}</td>
							</tr>
							@endforeach

						</table>
			</div>
    	</div>
    </div>
    
  
</div>


