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

#listul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#listul #listli {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block;
  position: relative;
}



.close {
  cursor: pointer;
  position: absolute;
  top: 50%;
  right: 0%;
  padding: 12px 16px;
  transform: translate(0%, -50%);
}

.close:hover {background: #bbb;}
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
            <h3 class="display-5 mb-1" style="font-style: oblique;"><b>Search History</b></h3>
            <button onclick="deleteAll()" type="button" style="float:right;" class="btn btn-danger">Delete All</button>
            <p class="mb-5 text-center">
                    
                        <ul id="listul">
                            @if($retrieve_history)
                                @foreach($retrieve_history as $history)
                            <li id="listli"><a href="{{route('search' , $history->content)}}" style="text-decoration:none;color:black;">{{$history->content}}</a><span onclick="delhis({{$history->id}})" class="close">&times;</span></li>
                                @endforeach
                            @else
                            <h1>History is Empty</h1>
                            @endif   
                        
                        </ul>
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



<script>
    function delhis(id){
        var history_id = id;
        $.ajax({
            type : "POST",
            url : "delete_history_item/" + history_id,
            data :{ "_token": "{{ csrf_token() }}",
                    "id": history_id},
            success : function(response){
              
                Swal.fire({
                title: "Item Deleted",

                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    location.reload();
                }
                });
                
            },
            error : function(error){
                console.log(error);
            }


        });

    }


    function deleteAll(){
        Swal.fire({
                title: "Delete All History! Are You Sure?",
                showCancelButton: true,

                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                        $.ajax({
                        type : "POST",
                        url : "delete_history_all/",
                        data :{ "_token": "{{ csrf_token() }}",
                                },
                        success : function(response){
                                    location.reload();
                                    }
                        });




                }
                });

    }
</script>

@endsection
