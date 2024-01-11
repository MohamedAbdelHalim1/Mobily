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
<header>Add New Category</header>
<div class="form-outer">
  <form method="POST" action="{{ route('admin.add.category') }}" enctype="multipart/form-data">
     @csrf 
              <div class="page slidepage">					
                            <div class="field">
                                <label class="label">Name</label>
                                <input type="text" id="name" name="name" required>
                            </div>	
                            <div class="field">
                                <label class="label">Image</label>
                                <input type="file"  name="image" >
                            </div>
					
                            <div class="field">
                              <select name="category" id="category">
                                <option value="">Choose Parent</option>
                                    @foreach ($categories as $category)
                                        
                                        <option value = "{{$category->id}}">{{$category->name}}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
				

                <div class="field btns">
                    <button type="submit" class="submit">Submit</button>
                </div>

</div>
  </form>
</div>

</div>



</body>


@endsection


