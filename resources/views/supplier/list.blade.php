@extends('layouts.app')
@section('title','Inventory | Supplier')
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
								<i class="fa fa-list"></i> All Supplier
							</h3>
							<a href="{{route('supplier.create')}}" class="btn btn-success pull-right">Add Supplier</a>
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
								 @foreach($suppliers as $supplier)	
									<tr>
										<td>@php echo ++$n; @endphp</td>
										<td>{{$supplier->name}}</td>
										<td>{{$supplier->phone}}</td>
										<td>{{$supplier->address}}</td>
										<td>
											<img src="{{asset('images/supplier/'.$supplier->photo)}}" alt="Image">
										</td>
										@php 
										    $id = Crypt::encrypt($supplier->id); 
										@endphp
										<td>
											<a href="{{route('supplier.edit',$id)}}" class="btn btn-info btn-sm">
												<i class="lnr lnr-pencil"></i>
											</a>
											<form id="delete-form-{{$supplier->id}}" action="{{route('supplier.destroy',$supplier->id)}}" method="POST" style="display:none;">
												@csrf
												@method('DELETE')
											</form>
											<button class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this permanently')){
                                                  event.preventDefault();
                                                  document.getElementById('delete-form-{{$supplier->id}}').submit();
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