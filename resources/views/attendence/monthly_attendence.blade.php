@extends('layouts.app')
@section('title','Inventory | Monthly Attendence')
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
								<i class="fa fa-list"></i> Monthly Attendence List 	
							</h3>
							<a href="{{route('attendence.take')}}" class="btn btn-info btn-sm pull-right">Take Attendence</a>
						</div>
						</br>
						<div class="panel-heading">
					       <a href="{{route('attendence.january')}}" class="btn btn-dark btn-sm">January</a>
					       <a href="{{route('attendence.february')}}" class="btn btn-primary btn-sm">February</a>
					       <a href="{{route('attendence.march')}}" class="btn btn-success btn-sm">March</a>
					       <a href="{{route('attendence.april')}}" class="btn btn-danger btn-sm">April</a>
					       <a href="{{route('attendence.may')}}" class="btn btn-warning btn-sm">May</a>
					       <a href="{{route('attendence.june')}}" class="btn btn-light btn-sm">June</a>
					       <a href="{{route('attendence.july')}}" class="btn btn-warning btn-sm">July</a>
					       <a href="{{route('attendence.august')}}" class="btn btn-info btn-sm">August</a>
					       <a href="{{route('attendence.september')}}" class="btn btn-success btn-sm">September</a>
					       <a href="{{route('attendence.october')}}" class="btn btn-danger btn-sm">October</a>
						   <a href="{{route('attendence.november')}}" class="btn btn-info btn-sm">November</a>
						   <a href="{{route('attendence.december')}}" class="btn btn-warning btn-sm">December</a>
						</div>
					    

						<div class="panel-body" id="printTable">
							<h4 class="text-center text-danger"><b>Attendence List: {{$month}}</b></h4>
					        <table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#Date</th>
									@foreach($emp_ids as $id)
										<th>{{$id->employee->name}}</th>
									@endforeach
									</tr>
								</thead>
								<tbody>
									@foreach($dates as $date)
									   <tr>
									   	  <td>{{$date->date}}</td>
									   	<?php 
                                            $status = DB::table('attendences')
                                                    ->where('date',$date->date)
                                                    ->orderBy('id','DESC')
                                                    ->get();
									   	 ?>
									   	@foreach($status as $stat)  
									   	  <td>{{$stat->status}}</td>
									   	@endforeach
									   </tr>
									@endforeach
								</tbody>
							</table>
								
						</div>
						<button type="button" id="print" class="btn btn-primary pull-right">Print</button>
					</div>
               </div>
            </div>        
        </div>
    </div>         
</div>
@endsection
@push('scripts')
   
<script>
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.innerHTML);
   newWin.print();
   newWin.close();
}

$('#print').on('click',function(){
     printData();
})
</script>
<script>
	$(document).ready(function() {
         $('#example').DataTable();
    } );
</script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
@endpush