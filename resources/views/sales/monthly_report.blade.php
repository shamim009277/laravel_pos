@extends('layouts.app')
@section('title','Inventory | Sales Report')
@push('css')
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">
 <style>
 	.custom{
 		background-color: #252b3e;
        padding: 4px 15px;
        color: #fff;
        border-radius: 5px;
 	}
 </style>
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
								<i class="fa fa-list"></i> Sales Report
							</h3>
                    
							<div class="dropdown custom pull-right">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span><b>Report By Months</b></span> <i class="icon-submenu lnr lnr-chevron-down" style="font-size: 10px;font-weight: bold;"></i></a>
								<ul class="dropdown-menu">
									<li><a href="{{route('monthly.report')}}">All Report</a></li>
								    @foreach($months as $month)

									   <li><a href="{{route('monthly.report')}}?month={{$month->month}}">
									   	  @if($month->month==1)
									   	    January
									   	  @elseif($month->month==2)
                                            Fabruary
									   	  @elseif($month->month==3)
                                            March
									   	  @elseif($month->month==4)
									   	    April
									   	  @elseif($month->month==5)
									   	    May
									   	  @elseif($month->month==6)
									   	    June
									   	  @elseif($month->month==7)
									   	    July
									   	  @elseif($month->month==8)
									   	    August
									   	  @elseif($month->month==9)
									   	    September
									   	  @elseif($month->month==10)
									   	    October
									   	  @elseif($month->month==11)
                                            November
									   	  @else()
									   	    December
									   	  @endif
									   </a></li>
                                    @endforeach
								</ul>
						    </div>

						</div>
					    </br>
					    <div class="panel-body">
					    	<div class="row">
					    		<div class="col-md-4">
					    			<h4 class="text-danger"><b>Total Sales :<span class="text-primary"> {{$total}}</span></b></h4>
					    		</div>
					    		<div class="col-md-4">
					    			<h4 class="text-danger"><b>Total Pay Amount :<span class="text-primary"> {{$pay}}</span></b></h4>
					    		</div>
					    		<div class="col-md-4">
					    			<h4 class="text-danger"><b>Total Due Amount :<span class="text-primary"> {{$due}}</span></b></h4>
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