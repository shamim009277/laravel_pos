@extends('layouts.app')
@section('title','Inventory | Advance Salary')
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
								<i class="fa fa-list"></i> All Advance Salary
							</h3>
							<a href="{{route('advance_salary.create')}}" class="btn btn-success pull-right">Pay Advance</a>
						</div>
					    </br>
						<div class="panel-body">
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Salary Month</th>
										<th>Year</th>
										<th>Amount</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								  @php $n=0; @endphp
								  @foreach($advances as $advance)
								    <tr>
								    	<td><?php echo ++$n; ?></td>
								    	<td>{{$advance->employee->name}}</td>
								    	<td>{{$advance->month}}</td>
								    	<td>{{$advance->year}}</td>
								    	<td>{{$advance->advance_salary}}</td>
								    	<td>
								    		<a href="{{route('advance_salary.edit',$advance->id)}}" class="btn btn-info btn-sm">
												<i class="lnr lnr-pencil"></i>
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