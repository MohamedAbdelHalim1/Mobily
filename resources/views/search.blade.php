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

<section class="pt-5 pb-5">
  <div class="container">
    <div class="row w-100">
        <div class="col-lg-12 col-md-12 col-12">
            <h3 class="display-5 mb-1" style="font-style: oblique;"><b>Results</b></h3>
            <p class="mb-5 text-center">
            <table class="table table-condensed table-responsive">
               
                <tbody>
                    
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-md-3 text-left">
        
                                        <img src=""  alt="image" style="width:120px;height:120px;">
                                       
                                    </div>
                                    <div class="col-md-9 text-left mt-sm-2">
                                        <h4><b>name</b></h4>
                                        <b>Brand : </b>brand<br>
                                    </div>
                                </div>
                            </td>
                           
                            
                        </tr>
                       
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-4 d-flex align-items-center">
        <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
            <a href="{{route('home')}}" style="text-decoration:none;">
                <i class="fa fa-arrow-left mr-2"></i> Home </a>
        </div>
    </div>
</div>
</section>





@endsection
