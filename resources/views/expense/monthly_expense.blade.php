@extends('layouts.app')
@section('title','Inventory | Monthly Expense')
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
								<i class="fa fa-list"></i> Monthly Expense List({{$month}})
							</h3>
							<a href="{{route('add.expense')}}" class="btn btn-info btn-sm pull-right">Add Expense</a>
						</div>
						</br>
						<div class="panel-heading">
					       <a href="{{route('expense.january')}}" class="btn btn-dark btn-sm">January</a>
					       <a href="{{route('expense.february')}}" class="btn btn-primary btn-sm">February</a>
					       <a href="{{route('expense.march')}}" class="btn btn-success btn-sm">March</a>
					       <a href="{{route('expense.april')}}" class="btn btn-danger btn-sm">April</a>
					       <a href="{{route('expense.may')}}" class="btn btn-warning btn-sm">May</a>
					       <a href="{{route('expense.june')}}" class="btn btn-light btn-sm">June</a>
					       <a href="{{route('expense.july')}}" class="btn btn-warning btn-sm">July</a>
					       <a href="{{route('expense.august')}}" class="btn btn-info btn-sm">August</a>
					       <a href="{{route('expense.september')}}" class="btn btn-success btn-sm">September</a>
					       <a href="{{route('expense.october')}}" class="btn btn-danger btn-sm">October</a>
						   <a href="{{route('expense.november')}}" class="btn btn-info btn-sm">November</a>
						   <a href="{{route('expense.december')}}" class="btn btn-warning btn-sm">December</a>
						</div>
					    
					    <h4 class="text-center text-danger"><b>Total Amount: {{$total}}</b></h4>

						<div class="panel-body">
					        <table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Details</th>
										<th>Amount</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
								        $n=0;
								    @endphp
								  @foreach($expenses as $expense)
								    <tr>
								    	<td>@php echo ++$n; @endphp</td>
								    	<td>{{$expense->details}}</td>
								    	<td>{{$expense->amount}}</td>
								    	<td>{{$expense->date}}</td>
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