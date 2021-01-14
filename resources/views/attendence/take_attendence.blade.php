@extends('layouts.app')
@section('title','Inventory | Employee Attendence')

@section('content')
<div class="main">           
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
               	   <div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title pull-left">
								<i class="fa fa-list"></i> Take Attendence
							</h3>
							<a href="{{route('attendence.all')}}" class="btn btn-success pull-right">All Attendence</a>
						</div>
					    </br>
					    <h4 class="text-center text-danger"><b><?php echo date("F ")."(".date("d/m/yy").")";  ?></b></h4>
						<div class="panel-body">

            {!! Form::open(array('route'=>['attendence.store'],'method'=>'POST','files'=>true)) !!}
      
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Phone</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
								@php
								  $n=0;
								@endphp
								 @foreach($employees as $employee)	
									<tr>
										<td>@php echo ++$n; @endphp</td>
										<td>{{$employee->name}}</td>
										<td>
											<img src="{{asset('images/employee/'.$employee->photo)}}" alt="Image" style="width:80px;height:80px">
											<input type="hidden" name="emp_id[]" value="{{$employee->id}}">
											<input type="hidden" name="date" value="<?php echo date("d/m/y") ?>">
											<input type="hidden" name="year" value="<?php echo date("Y") ?>">
											<input type="hidden" name="att_date" value="<?php echo date("d.m.y") ?>">
											<input type="hidden" name="month" value="<?php echo date("F") ?>">
										</td>
										<td>
											<label class="fancy-radio">
												<input name="status[{{$employee->id}}]" value="Present" type="radio" required>
												<span><i></i>Present</span>
											</label>
											<label class="fancy-radio">
												<input name="status[{{$employee->id}}]" value="Absence" type="radio" required>
												<span><i></i>Absence</span>
											</label>
											<label class="fancy-radio">
												<input name="status[{{$employee->id}}]" value="Leave" type="radio" required>
												<span><i></i>Leave</span>
											</label>
										</td>
									</tr>
								 @endforeach	
								</tbody>
							</table>
							<button type="submit" class="btn btn-primary pull-right">Take Attendence</button>
						{!! Form::close() !!}	
						</div>
					</div>
               </div>
            </div>        
        </div>
    </div>         
</div>
@endsection
