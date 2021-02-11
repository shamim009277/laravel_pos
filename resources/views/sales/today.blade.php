@extends('layouts.app')
@section('title','Inventory | Sales Report')
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
								<i class="fa fa-list"></i> Today Sales Report
							</h3>
						</div>
					    </br>
					    <div class="panel-body">
					    	<div class="row">
					    		<div class="col-md-4">
					    			<h4 class="text-danger"><b>Total Sales : {{$total}}<span class="text-primary"></span></b></h4>
					    		</div>
					    		<div class="col-md-4">
					    			<h4 class="text-danger"><b>Total Pay Amount : {{$pay}}<span class="text-primary"></span></b></h4>
					    		</div>
					    		<div class="col-md-4">
					    			<h4 class="text-danger"><b>Total Due Amount : {{$due}}<span class="text-primary"></span></b></h4>
					    		</div>
					    	</div>
					    </div>

						<div class="panel-body">
							<table id="example" class="table table-striped table-bordered ">
								<thead>
									<tr>
										<th>Order Id</th>
										<th>Customer Name</th>
										<th>Order Date</th>
										<th>Total</th>
										<th>Payment Status</th>
										<th>Pay</th>
										<th>Due</th>
									</tr>
								</thead>
								<tbody>
								   @foreach($orders as $order)
								    <tr>
                                        <td>{{$order->id}}</td>
								    	<td>{{$order->customer->name}}</td>
								    	<td>{{$order->order_date}}</td>
								    	<td>{{$order->total}}</td>
								    	<td>{{$order->payment_status}}</td>
								    	<td>{{$order->pay}}</td>
								    	<td>{{$order->due}}</td>
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