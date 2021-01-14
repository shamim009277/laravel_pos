@extends('layouts.app')
@section('title','Inventory | Employee Attendence')
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
								<i class="fa fa-list"></i> All Attendence List
							</h3>
							<a href="{{route('attendence.take')}}" class="btn btn-success pull-right">Take Attendence</a>
						</div>
					    </br>
						<div class="panel-body">
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								   @php
								      $n=0;
								   @endphp
								 @foreach($attendences as $row)	
									<tr>
										<td>@php echo ++$n; @endphp</td>
										<td id="att_date">{{$row->att_date}}</td>
										@php 
										    $att_date = Crypt::encrypt($row->att_date); 
										@endphp
										<td>
											<a href="{{route('edit.attendence',$att_date)}}" class="btn btn-info btn-sm">
												<i class="lnr lnr-pencil"></i>
											</a>
											<a href="" class="btn btn-danger btn-sm">
												<i class="lnr lnr-trash"></i>
											</a>
											<a class="btn btn-success btn-sm" id="showAttendence">
												<i class="lnr lnr-pencil"></i>
											</a>
										</td>
									</tr>
								 @endforeach
								</tbody>
							</table>
							
						</div>


						<!-- Modal For Attendence-->
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h4 class="modal-title" id="exampleModalLabel">Employee Attendence List</h4>
						        <h4 class="text-center text-danger"><b>Data</b></h4>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						        </button>
						      </div>
						      
						       
						      <div class="modal-body">
						         <table id="example" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Photo</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody id="body">
										
									</tbody>
								</table>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>
                        <!--End modal-->

					</div>
               </div>
            </div>        
        </div>
    </div>         
</div>
@endsection
@push('scripts')
  <script>
  	$(document).ready(function (){
       $('#showAttendence').on('click',function(e){
       	   e.preventDefault();
       	   var id = $('#att_date').text();
       	   $('#exampleModal').modal('show');
       	   
       	   $.ajax({
       	   	 url:"get_attendence/"+id,
       	   	 method:"GET",
       	   	 data:{ 
                _token:'{{ csrf_token() }}'
                },
                dataType:'json',
       	   	 success:function(data){
       	   	 	console.log(data);
                $.each(data,function(index,row){
                	$("#body").append("<tr>"+
                          "<td>"+(index+1)+"</td>"
                		+"</tr>");
                    console.log(row);
                });  
       	   	 }
       	   })

       })
  	});
  </script>
  <script>
	$(document).ready(function() {
         $('#example').DataTable();
    } );
</script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
@endpush