@extends('layouts.app')
@section('title','Inventory | Employee Salary')
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
								<i class="fa fa-list"></i> Employee List
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
										<th>Photo</th>
										<th>Base Salary</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								 @php $n=0; @endphp
								 @foreach($employees as $employee)
                                    <tr>
                                    	<td><?php echo ++$n; ?></td>
                                    	<td>{{$employee->name}}</td>
                                    	<td>
                                    		<img src="{{asset('images/employee/'.$employee->photo)}}" alt="" style="width:70px;height:40px;">
                                    	</td>
                                    	<td>{{$employee->salary}}</td>
                                    	@php
                                                $id = Crypt::encrypt($employee->id);
                                    	@endphp
                                    	<td>
                                    		<a href="{{route('pay.salary',$id)}}" class="btn btn-info btn-md"><i class="fa fa-money" aria-hidden="true"> </i> Pay Salary</a>
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