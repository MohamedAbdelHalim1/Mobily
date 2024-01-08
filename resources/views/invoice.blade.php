@extends('layouts.app')
@section('style')
<style>
 .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
                <h1>Your Order has been received</h1>
    			<h2>Invoice</h2><h3 class="pull-right">Order # {{$order->id}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-md-6 text-start">
    				<address>
    				<strong>Billed To:</strong><br>
    					{{$username}}<br>
    					{{$order->city}}<br>
    					{{$order->address}}<br>
    					phone number: {{$order->phone_number}}<br>
                        <strong>Payment Method:</strong><br>
    					Cash on delivery<br>
                        <strong>Order Date:</strong><br>
    					{{$order->created_at->toDateString()}}<br><br>
    				</address>
    			</div>
    			<div class="col-md-6 text-end">
                <strong>Shipped To:</strong><br>
    					{{$username}}<br>
    					{{$order->city}}<br>
    					{{$order->address}}<br>
    					phone number: {{$order->phone_number}}<br>
                        <strong>purchase Summary:</strong><br>
                        Subtotal: {{$order->subtotal}} LE<br>
                        Shipping: {{$order->shipping}} LE<br>
                        Total Price: <span style="color:blue;"> {{$order->total_price}} LE</span>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
                                @foreach($order->order_details as $order)
    							<tr>
    								<td>{{$order->product->name}}</td>
    								<td class="text-center">{{$order->product->price}} LE</td>
    								<td class="text-center">{{$order->quantity}} Items</td>
    								<td class="text-right">{{$order->product->price * $order->quantity}} LE</td>
    							</tr>
                                @endforeach
                       
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>


@endsection
