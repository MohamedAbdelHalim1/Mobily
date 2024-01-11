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


<a href="{{route('admin.add_product')}}" class="btn btn-primary" style="margin-left:13px;"><span>Add New Product</span></a><br><br>
@foreach($products as $product)
<div class="card text-center" style="width:75%;margin:auto;">
  <div class="card-header">
    {{$product->name}} ({{$product->category->name}}) - <b>{{$product->price}}LE</b>
  </div>
  <div style="display:flex;">
  <div class="card-body text-left">
    <h5 class="card-title"><small">Description</small>:<b>{{$product->description}}</b></h5>
    <h5 class="card-title"><small>Storage</small>:<b>{{$product->storage}}</b></h5>
    <h5 class="card-title"><small>Ram</small>:<b>{{$product->ram}}</b></h5>
    <h5 class="card-title"><small>Main Camera</small>:<b>{{$product->main_camera}}</b></h5>
    <h5 class="card-title"><small">Front Camera</small>:<b>{{$product->front_camera}}</b></h5>
    <h5 class="card-title"><small">Operating System</small>:<b>{{$product->operating_system}}</b></h5>
    <h5 class="card-title"><small">Color</small>:<b>{{$product->color}}</b></h5>
    <h5 class="card-title"><small">Quantity in Stock</small>:<b>{{$product->quantity}}</b></h5>
    <h5 class="card-title"><small">Recommended</small>:<b>@if($product->recommended == 0) No @else Yes @endif </b></h5>
    <h5 class="card-title"><small">New Arrival</small>:<b>@if($product->new_arrival == 0) No @else Yes @endif </b></h5>


  </div>

<div id="carouselExampleControls{{$product->id}}" class="carousel slide" data-ride="carousel" style="width:300px;height:350px;">
  <div class="carousel-inner">
  @foreach($product->product_images as $key => $slider)
            <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
              <img src="/storage/files/{{ $slider->path }}"  alt="{{ $product->name }}" style="width:300px;height:350px;">
            </div>
        @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls{{$product->id}}" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls{{$product->id}}" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

  </div>
  <div class="card-footer text-muted" style="display:flex;justify-content:space-around;">
     
     <b>ADDED : {{$product->created_at->toDateString()}}</b>
     <div style="display:flex;">
     <a type="button" class="btn btn-primary" href="{{route('admin.editproduct' , $product->id)}}">Edit</a>
     <form action="{{route('admin.deleteproduct' , $product->id)}}" method="post">
        @csrf 
        @method('delete')
      <button class="btn btn-danger">Delete</button>
     </form>
</div>
  </div>
</div>
<br>
@endforeach

<div class="clearfix">
				{{$products->links()}}
			
             </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection


