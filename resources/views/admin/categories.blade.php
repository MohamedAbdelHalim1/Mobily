@extends('admin.layouts.layout')
@section('title')
<title>Dashboard</title>

@endsection

@section('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
body {
	color: #566787;
	background: #f5f5f5;
	font-family: 'Varela Round', sans-serif;
	font-size: 13px;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
	background: #fff;
	padding: 20px 25px;
	border-radius: 3px;
	min-width: 1000px;
	box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {        
	padding-bottom: 15px;
	background: #435d7d;
	color: #fff;
	padding: 16px 30px;
	min-width: 100%;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}
.table-title h2 {
	margin: 5px 0 0;
	font-size: 24px;
}
.table-title .btn-group {
	float: right;
}
.table-title .btn {
	color: #fff;
	float: right;
	font-size: 13px;
	border: none;
	min-width: 50px;
	border-radius: 2px;
	border: none;
	outline: none !important;
	margin-left: 10px;
}
.table-title .btn i {
	float: left;
	font-size: 21px;
	margin-right: 5px;
}
.table-title .btn span {
	float: left;
	margin-top: 2px;
}
table.table tr th, table.table tr td {
	border-color: #e9e9e9;
	padding: 12px 15px;
	vertical-align: middle;
}
table.table tr th:first-child {
	width: 60px;
}
table.table tr th:last-child {
	width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
	background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
	background: #f5f5f5;
}
table.table th i {
	font-size: 13px;
	margin: 0 5px;
	cursor: pointer;
}	
table.table td:last-child i {
	opacity: 0.9;
	font-size: 22px;
	margin: 0 5px;
}
table.table td a {
	font-weight: bold;
	color: #566787;
	display: inline-block;
	text-decoration: none;
	outline: none !important;
}
table.table td a:hover {
	color: #2196F3;
}
table.table td a.edit {
	color: #FFC107;
}
table.table td a.delete {
	color: #F44336;
}
table.table td i {
	font-size: 19px;
}
table.table .avatar {
	border-radius: 50%;
	vertical-align: middle;
	margin-right: 10px;
}
.pagination {
	float: right;
	margin: 0 0 5px;
}
.pagination li a {
	border: none;
	font-size: 13px;
	min-width: 30px;
	min-height: 30px;
	color: #999;
	margin: 0 2px;
	line-height: 30px;
	border-radius: 2px !important;
	text-align: center;
	padding: 0 6px;
}
.pagination li a:hover {
	color: #666;
}	
.pagination li.active a, .pagination li.active a.page-link {
	background: #03A9F4;
}
.pagination li.active a:hover {        
	background: #0397d6;
}
.pagination li.disabled i {
	color: #ccc;
}
.pagination li i {
	font-size: 16px;
	padding-top: 6px
}
.hint-text {
	float: left;
	margin-top: 10px;
	font-size: 13px;
}    
/* Custom checkbox */
.custom-checkbox {
	position: relative;
}
.custom-checkbox input[type="checkbox"] {    
	opacity: 0;
	position: absolute;
	margin: 5px 0 0 3px;
	z-index: 9;
}
.custom-checkbox label:before{
	width: 18px;
	height: 18px;
}
.custom-checkbox label:before {
	content: '';
	margin-right: 10px;
	display: inline-block;
	vertical-align: text-top;
	background: white;
	border: 1px solid #bbb;
	border-radius: 2px;
	box-sizing: border-box;
	z-index: 2;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
	content: '';
	position: absolute;
	left: 6px;
	top: 3px;
	width: 6px;
	height: 11px;
	border: solid #000;
	border-width: 0 3px 3px 0;
	transform: inherit;
	z-index: 3;
	transform: rotateZ(45deg);
}
.custom-checkbox input[type="checkbox"]:checked + label:before {
	border-color: #03A9F4;
	background: #03A9F4;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
	border-color: #fff;
}
.custom-checkbox input[type="checkbox"]:disabled + label:before {
	color: #b8b8b8;
	cursor: auto;
	box-shadow: none;
	background: #ddd;
}
/* Modal styles */
.modal .modal-dialog {
	max-width: 400px;
}
.modal .modal-header, .modal .modal-body, .modal .modal-footer {
	padding: 20px 30px;
}
.modal .modal-content {
	border-radius: 3px;
	font-size: 14px;
}
.modal .modal-footer {
	background: #ecf0f1;
	border-radius: 0 0 3px 3px;
}
.modal .modal-title {
	display: inline-block;
}
.modal .form-control {
	border-radius: 2px;
	box-shadow: none;
	border-color: #dddddd;
}
.modal textarea.form-control {
	resize: vertical;
}
.modal .btn {
	border-radius: 2px;
	min-width: 100px;
}	
.modal form label {
	font-weight: normal;
}	
</style>

@endsection

@section('content')

<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage <b>Categories</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#"  class="btn btn-success" id="open-add"  data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Category/Subcategory</span></a>
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>Name</th>
						<th>Parent</th>
                        <th>Image</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
                @foreach($categories as $category)
					<tr>
                        
						<td>
							{{$category->id}}
						</td>

						<td>{{$category->name}}</td>

						@if($category->maincategory == null)
						<td>-</td>
						@else
						<td>{{$category->maincategory->name}}</td>
						@endif

						@if($category->image_path == null)
						<td>-</td>
						@else
                        <td><img src="/storage/files/{{ $category->image_path }}" width="70px" hight="70px"></td>
						@endif						
					
						<td>
							<a href="#" class="open-edit" > <span id="{{$category->id}}"></span> <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#" class="open-remove" > <span id="{{$category->id}}"></span> <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
						</td>
					</tr>
    
              @endforeach
	
				</tbody>
			</table>
<!-- Edit Modal -->
<div id="editModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="editForm" method="post" enctype="multipart/form-data">
			@csrf
                
                <input type="hidden" name="id" id="id">
				<div class="modal-header">						
					<h4 class="modal-title">Edit Category</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="border-radius : 10px;">&times;</button>
				</div>
      
				<div class="modal-body">					
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" id="name" value="" required>
					</div>
                    <div class="form-group">
						<label>Image</label>
						<input type="file" class="form-control" name="image" id="image" required>
					</div>

					<div class="form-group">
					<select name="category" id="category" class="form-control">
					<option>Choose parent Category</option>
						@foreach ($categories as $category)
							
							<option value = "{{$category->id}}">{{$category->name}}</option>
							
						@endforeach
					</select>
					</div>
                    				
				</div>
				<div class="modal-footer">
                    
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save" id="submit">
                    
				</div>
                </form> 
            
		</div>
	</div>
</div>

<!-- Delete Modal HTML -->
<div class="modal fade" id="removeModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="deleteForm" method="post" >
			{{ csrf_field()}}
			<input type="hidden" name="id" id="myid">

				<div class="modal-header">						
					<h4 class="modal-title">Delete Category</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="border-radius : 10px;">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you want to delete these Records?</p>
				</div>
                
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
         






			<div class="clearfix">
				<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
				<ul class="pagination">
					<li class="page-item disabled"><a href="#">Previous</a></li>
					<li class="page-item"><a href="#" class="page-link">1</a></li>
					<li class="page-item"><a href="#" class="page-link">2</a></li>
					<li class="page-item active"><a href="#" class="page-link">3</a></li>
					<li class="page-item"><a href="#" class="page-link">4</a></li>
					<li class="page-item"><a href="#" class="page-link">5</a></li>
					<li class="page-item"><a href="#" class="page-link">Next</a></li>
				</ul>
			</div>
		</div>
	</div>        
</div>


<!-- Add Modal HTML -->
<div id="addmodel" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="addForm" method="post" enctype="multipart/form-data">
			   @csrf
				<div class="modal-header">						
					<h4 class="modal-title">Add Category</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" id="name" name="name" required>
					</div>	
                    <div class="form-group">
						<label>Image</label>
						<input type="file" class="form-control"  name="image" required>
					</div>
					
					  	<div class="form-group">
						  <select name="category" id="category" class="form-control">
								@foreach ($categories as $category)
									
									<option value = "{{$category->id}}">{{$category->name}}</option>
									
								@endforeach
						 </select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->



@endsection

@section('script')

<script type="text/javascript">

// edit ajax request

$(document).ready(function(){

    $('.open-edit').on('click',function(){
        $('#editModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        $('#id').val(data[0]);
        $('#name').val(data[1]);

    });


	$('#editForm').on('submit', function(e){
		e.preventDefault();
		var id = $("#id").val();
		let noteFormData = new FormData(this);
        noteFormData.append('image', document.getElementById('image').files[0]);
	$.ajax({
		type : "POST",
		header:{
			'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
				},
		url : "edit_category/" + id,
		data : noteFormData,
		contentType: false,
        processData: false,
        cache: false,
		success : function(response){
			$('#editmodal').modal('hide');
			location.reload();
			alert("Category updated!");
		},
		error : function(error){
			console.log(error);
		}


	});
});


});


// delete ajax request

$(document).ready(function(){

	$('.open-remove').on('click',function(){
		$('#removeModal').modal('show');

		$tr = $(this).closest('tr');

			var data = $tr.children("td").map(function(){
				return $(this).text();
			}).get();
			$('#myid').val(data[0]);

	});



    $('#deleteForm').on('submit', function(e){
        e.preventDefault();
        var myid = $("#myid").val();
        $.ajax({
            type : "POST",
            url : "delete_category/" + myid,
            data :{ "_token": "{{ csrf_token() }}",
                    "id": myid},
            success : function(response){
                $('#removeModal').modal('hide');
                location.reload();
                alert("Category Deleted!");
            },
            error : function(error){
                console.log(error);
            }


        });
    });

});
	

	//add ajax request

$(document).ready(function(){

	$('#open-add').on('click',function(){
		$('#addmodel').modal('show');

	});

	$('#addForm').on('submit', function(e){
		e.preventDefault();
		let noteFormData = new FormData(this);
        noteFormData.append('image', document.getElementById('image').files[0]);
	$.ajax({
		type : "POST",
		header:{
			'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
				},
		url : "add_category",
		data : noteFormData,
		contentType: false,
        processData: false,
        cache: false,
		success : function(response){
			$('#addmodel').modal('hide');
			location.reload();
			alert("Category Added!");
		},
		error : function(error){
			console.log(error);
		}


	});
});


});




</script>





@endsection


