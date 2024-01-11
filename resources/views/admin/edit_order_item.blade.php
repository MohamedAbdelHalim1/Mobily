@extends('admin.layouts.layout')
@section('title')
<title>Dashboard</title>

@endsection

@section('style')
<style>

.container{
  width:100%;
  text-align:center;
 
}
.container header{
  font-size : 35px;
  font-weight : 600;
  margin : 0 0 30px 0;
}
.container .form-outer{
width : 100%;

}

.form-outer form .page{
  width: 100%;
  transition : margin-left 0.3s ease-in-out;
}
.form-outer form .page .title{
  text-align : left;
  font-size:25px;
  font-weight : 500;


}
.form-outer form .page .field{
  height : 45px;
  width: 100%;
  margin: 45px 0;
  display:flex;
  position: relative;
}
.form-outer form .page .field .label{
 position: absolute;
 top : -20px;
 font-weight: 500;

}

form .page .field select{
  width:100%;
  padding-left:10px;
  font-size:17px;
  font-weight : 500;

}

.form-outer form .page .field input{
  height : 100%;
  width: 100%;
  border : 1px solid lightgrey;
  border-radius : 5px;
  font-size : 18px;
  padding-left : 15px;

}
.form-outer form .page .field button{
  width : 100%;
  height : calc(100% + 5px);
  margin-top : -20px;
  border : 1px;
  background : #F5F5DC;
  font-size : 18px;
  text-transform : uppercase;
  letter-spacing : 1px;
  cursor : pointer;
}
.form-outer form .page .field button:hover{
  background :  #AFA79F;
  color : white;
}

</style>
@endsection

@section('content')

<body class="body">

@if (\Session::has('caution'))
    <div class="alert alert-warning close" style="width:100%;">
        <ul>
            <li>{!! \Session::get('caution') !!}</li>
        </ul>
    </div>
@endif


<div class="container">
<header>EDIT Order Item</header>
<div class="form-outer">
  <form method="POST" action="{{ route('admin.uploaditem') }}">
     @csrf 
     <input type="hidden" name="order_id" value="{{$order_id}}">
     <input type="hidden" name="user_id" value="{{$user_id}}">     
     <input type="hidden" name="item_id" value="{{$order_item->id}}">

    <div class="page slidepage">
      <div class="field">
        <div class="label"><b><large>{{$order_item->product->name}} - <span style="color:blue;">({{$order_item->product->quantity}} in Stock)</span></large></b></div>
        </div>

         <div class="field">
                <div class="label">Quantity</div>
                <input type="number" name="quantity" id="quantity" value="{{$order_item->quantity}}">
                </div>
                

        </div>
        <div style="float:left;">     
         <input type="submit" value="Submit" class="btn btn-success">        
        </div>
      </div>
    </div>
  </form>
  
</div>
</div>

</div>



</body>


@endsection


