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

<section class="pt-5 pb-5 updated_cart">
  <div class="container">
    <div class="row w-100">
        <div class="col-lg-12 col-md-12 col-12">
            <h3 class="display-5 mb-2 text-center" style="font-style: oblique;"><b>Search Results</b></h3>
            <p class="mb-5 text-center">
            <table id="shoppingCart" class="table table-condensed table-responsive">
                <tbody>
                    @if(count($search) == 0)
                    <tr><td> <h1>Sorry! there is no Product Like this.</h1></td></tr>
                    @else
                        @foreach($search as $search)
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-md-3 text-left">
                                    @foreach($search->product_images as $key => $slider)
                                        @if($key == 0)
                                        <img src="/storage/files/{{ $slider->path }}"  alt="{{ $search->name }}" style="width:160px;height:160px;">
                                        @endif
                                    @endforeach        
                                    </div>
                                    <div class="col-md-9 text-left mt-sm-2">
                                    <a href="{{route('more_details',$search->id)}}"> <h4><b style="background:yellow;">{{$search->name}}</b>, {{$search->operating_system}} {{$search->ram}}GB Ram {{$search->storage}}GB Storage</h4></a>
                                        <b>Brand : </b>{{$search->category->name}}<br>
                                        <b>Color : </b>{{$search->color}}<br>
                                    </div>
                                </div>
                            </td>
                        </tr><br>
                        @endforeach
                     @endif   
                </tbody>
            </table>
           
        </div>
    </div>
    
</div>
</section>





@endsection
