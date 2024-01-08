

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
                <h1>Your Order has been received</h1>
    			<h2>Invoice (For returns in 14 Days)</h2><h3 class="pull-right">Order # {{$data['order_id']}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-sm-6 text-start">
    				<address>
    				<strong>Billed To:</strong><br>
    					{{$data['username']}}<br>
    					{{$data['city']}}<br>
    					{{$data['address']}}<br>
    					phone number: {{$data['phone']}}<br>
                        <strong>Payment Method:</strong><br>
    					Cash on delivery<br>
                        <strong>Order Date:</strong><br>
    					{{$data['created_at']}}<br><br>
    				</address>
    			</div>
    			<div class="col-sm-6">
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
    	</div>
    </div>
    
  
</div>


