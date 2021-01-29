@extends('layouts.app')
@section('title','Inventory | Employee Salary List')
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
								<i class="fa fa-list"> </i> Paid Salary List
							</h3>
							<a href="{{route('employee.salary')}}" class="btn btn-success pull-right">Pay Salary</a>
						</div>
					    </br>
						<div class="panel-body">
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Employee Name</th>
										<th>Photo</th>
										<th>Address</th>
										<th>Salary Month</th>
										<th>Pay Amount</th>
										<th>Pay Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@php $n=0; @endphp
								 @foreach($salaries as $salary)
								   <tr>
								   	  <td><?php echo ++$n; ?></td>
								   	  <td>{{$salary->employee->name}}</td>
								   	  <td>
								   	  	<img src="{{asset('images/employee/'.$salary->employee->photo)}}" alt="Image" width="50%">
								   	  </td>
								   	  <td>{{$salary->employee->address}}</td>
								   	  <td>{{$salary->month }} || {{$salary->year}}</td>
								   	  <td>{{$salary->amount}}</td>
								   	  <td>{{$salary->created_at}}</td>
								   	  <td>
								   	  	<a href="" class="btn btn-info btn-sm">
												<i class="lnr lnr-pencil"></i>
											</a>
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