@extends('layouts.app')
@section('title','Inventory | Product Category')
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
								<i class="fa fa-list"></i> All Sales List
							</h3>
						</div>
					    </br>
						<div class="panel-body">
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Order Id</th>
										<th>Customer Name</th>
										<th>Order Date</th>
										<th>Total</th>
										<th>Payment Status</th>
										<th>Pay</th>
										<th>Due</th>
										<th>Due collect</th>
										<th>Action</th>
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
								    	<?php $due= $order->due;?>
								    	<td>
								    		@if($due==0)
								    		   <span class="label label-primary">CLEAR</span>
								    		@else
								    		   <span class="label label-primary">PAY DUE</span>
								    		@endif
								    	</td>
								    	<td>
								    		<a href="" class="btn btn-info btn-sm">
												<i class="lnr lnr-eye"></i>
											</a>
											<a href="" class="btn btn-danger btn-sm">
												<i class="lnr lnr-trash"></i>
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