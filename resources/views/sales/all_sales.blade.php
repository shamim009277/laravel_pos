@extends('layouts.app')
@section('title','Inventory | Sales List')
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
								    	<td class="id">{{$order->id}}</td>
								    	<td>{{$order->customer->name}}</td>
								    	<td>{{$order->order_date}}</td>
								    	<td>{{$order->total}}</td>
								    	<td>{{$order->payment_status}}</td>
								    	<td>{{$order->pay}}</td>
								    	<td>{{$order->due}}</td>
								    	<?php $due= $order->due;?>
								    	<td>
								    		@if($due==0)
								    		   <button class="btn btn-success btn-sm" disabled>CLEAR</button>
								    		@else
								    		   <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#dueModal" onclick="change(this)">PAY DUE</button>
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




<!-- Pay Due Modal -->
<div class="modal fade" id="dueModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body"> 
      <form action="{{route('due.collect')}}" method="POST" accept-charset="utf-8">
       @csrf
      <h4 class="modal-title text-center" id="exampleModalLabel"><b>Pay Due Amount</b></h4> 
         <div class="row">
         	<div class="col-md-12">
         		<div class="form-group">
                    <label for="due">Pay Amount</label>
                    <input type="hidden" name="order_id" id="order_id">
                    <input type="text" class="form-control" id="due" name="due" placeholder="Insert Pay Amount" required>
                </div>
         	</div>
         </div>
         <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm pull-right">Pay Due</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--End Pay Due Modal -->


@endsection
@push('scripts')
<script>
  function change(e){
  	//e.preventDefault();
   var id =$(e).closest('tr').find('.id').text();
   document.getElementById('order_id').value=id; 
}  
</script>
<script>
	$(document).ready(function() {
         $('#example').DataTable();
    } );
</script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
@endpush