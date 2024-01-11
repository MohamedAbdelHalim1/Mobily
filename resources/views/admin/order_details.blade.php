@extends('admin.layouts.layout')
@section('title')
<title>Dashboard</title>

@endsection

@section('style')

@endsection

@section('content')
@if (\Session::has('delete'))

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>{!! \Session::get('delete') !!}</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

@endif


@foreach($order_details as $order_details)
<div class="card text-center" style="width:75%;margin:auto;">
  <div class="card-header">
    {{$order_details->product->name}} ({{$order_details->product->category->name}}) - <b>{{$order_details->product->price}}LE</b>
  </div>
  <div style="display:flex;">
  <div class="card-body text-left">
    <h5 class="card-title"><small">Description</small>:<b>{{$order_details->product->description}}</b></h5>
    <h5 class="card-title"><small>Storage</small>:<b>{{$order_details->product->storage}}</b></h5>
    <h5 class="card-title"><small>Ram</small>:<b>{{$order_details->product->ram}}</b></h5>
    <h5 class="card-title"><small>Main Camera</small>:<b>{{$order_details->product->main_camera}}</b></h5>
    <h5 class="card-title"><small">Front Camera</small>:<b>{{$order_details->product->front_camera}}</b></h5>
    <h5 class="card-title"><small">Operating System</small>:<b>{{$order_details->product->operating_system}}</b></h5>
    <h5 class="card-title"><small">Color</small>:<b>{{$order_details->product->color}}</b></h5>
    <h5 class="card-title"><small">Quantity</small>:<b>{{$order_details->quantity}}</b></h5>

  </div>

<div id="carouselExampleControls{{$order_details->product->id}}" class="carousel slide" data-ride="carousel" style="width:300px;height:350px;">
  <div class="carousel-inner">
  @foreach($order_details->product->product_images as $key => $slider)
            <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
              <img src="/storage/files/{{ $slider->path }}"  alt="{{ $order_details->product->name }}" style="width:300px;height:350px;">
            </div>
        @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls{{$order_details->product->id}}" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls{{$order_details->product->id}}" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

  </div>
  <div class="card-footer text-muted" style="display:flex;justify-content:space-around;">
     
     <b>ADDED : {{$order_details->order->created_at->toDateString()}}</b>
     <div style="display:flex;">
     <a type="button" class="btn btn-primary" href="{{route('admin.edititem' , ['id'=>$order_details->id,'order_id'=>$order_id,'user_id'=>$user_id])}}">Edit</a>
     <form action="{{route('admin.deleteitem' , $order_details->id)}}" method="post">
        @csrf 
        @method('delete')
      <button class="btn btn-danger">Delete</button>
     </form>
</div>
  </div>
</div>
<br>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection


