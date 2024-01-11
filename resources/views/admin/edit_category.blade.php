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

@if (\Session::has('success'))
    <div class="alert alert-success close" style="width:100%;">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif


<div class="container">
<header>EDIT Category</header>
<div class="form-outer">
  <form method="POST" action="{{ route('admin.uploadCat' , $specific_category->id) }}" enctype="multipart/form-data">
     @csrf 
    <div class="page slidepage">
      <div class="field">
        <div class="label">Name</div>
        <input type="text" name="name" id="name" value="{{$specific_category->name}}">
      </div>
    
      <div class="field">
        <div class="label">Choose Parent</div>
        <select class="custom-select" id="inputGroupSelect01" name="parent">
        <option selected value="{{$specific_category->maincategory->id}}">{{$specific_category->maincategory->name}}</option>

          @foreach($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>
          @endforeach
        </select>
       
      </div>

      <div class="field">
        <div class="label">Images</div>
        <input type="file" name="image" id="images">
      </div>
      
      <div class="field btns">
        <button type="submit" class="submit">Submit</button>
      </div>

    </div>
    <div style="display:flex;">
  </form>
  
  @if($specific_category->image_path != null)
     
      <form action="{{route('admin.deletecatimage',$specific_category->id)}}" method="post">
        @csrf 
        @method('delete')
        <button class="btn text-danger" style="width:15px;height:15px;"><b>x</b></button><br><br><br>
      </form>
     
      <img src="/storage/files/{{ $specific_category->image_path }}"  alt="{{ $specific_category->name }}" style="width:150px;height:150px;">
     @else
     @endif
      
</div>
</div>

</div>



</body>


@endsection


