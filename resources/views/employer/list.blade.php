@extends('layouts.app')
@section('title','Inventory | Employee')
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">
@endpush
@section('content')
<div class="main">           
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
               	   <div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title pull-left">
								<i class="fa fa-list"></i> All Employee
							</h3>
							<a href="{{route('employee.create')}}" class="btn btn-success pull-right">Add Employee</a>
						</div>
					    </br>
						<div class="panel-body">
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Phone</th>
										<th>Address</th>
										<th>Photo</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@php
								  $n=0;
								@endphp
								 @foreach($employees as $employee)	
									<tr>
										<td>@php echo ++$n; @endphp</td>
										<td>{{$employee->name}}</td>
										<td>{{$employee->phone}}</td>
										<td>{{$employee->address}}</td>
										<td>
											<img src="{{asset('images/employee/'.$employee->photo)}}" alt="Image">
										</td>
										@php 
										    $id = Crypt::encrypt($employee->id); 
										@endphp
										<td>
											<a href="{{route('employee.edit',$id)}}" class="btn btn-info btn-sm">
												<i class="lnr lnr-pencil"></i>
											</a>
											<form id="delete-{{$employee->id}}" action="{{route('employee.destroy',$employee->id)}}" method="POST" style="display:none;">
												@csrf
												@method('DELETE')
											</form>
											<button class="btn btn-danger btn-sm" onclick="if(confirm('Ate you sure tou want to delete this')){
												event.preventDefault();
												document.getElementById('delete-{{$employee->id}}');
											}else{
												event.preventDefault();
											}
											">
												<i class="lnr lnr-trash"></i>
											</button>
										</td>
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
</div>
@endsection
@push('scripts')
   <script>
	$(document).ready(function() {
         $('#example').DataTable();
    } );
</script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
@endpush