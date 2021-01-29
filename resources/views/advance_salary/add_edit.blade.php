@if(!empty($single_advance))
  @php  $title = "Inventory | Update Advance Salary";  @endphp
@else
   @php  $title = "Inventory | Pay Advance Salary"; @endphp
@endif

@extends('layouts.app')
@section('title',$title)

@section('content')
<div class="main">           
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
               	   <div class="panel panel-headline">
						<div class="panel-heading">
						@if(!empty($single_advance))
						    <h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Update Advance Salary
							</h3>
						@else
							<h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Pay Advance Salary
							</h3>
						@endif	
						</div>
					    </br>
						<div class="panel-body">
							<div class="row mx-auto">
								<div class="col-md-10 mx-auto" style="float:none;margin:auto;">
		@if(!empty($single_advance))
		 {!! Form::open(array('route'=>['advance_salary.update',$single_advance->id],'method'=>'PUT','files'=>true)) !!}
           @php  $btn = "Update Advance"; @endphp
		@else
								  
         {!! Form::open(array('route'=>['advance_salary.store'],'method'=>'POST','files'=>true))!!} 
                @php  $btn = "Pay Advance"; @endphp
        @endif          
									<div class="form-group">
									    <label for="name">Employee Name</label>
									    <select name="emp_id" id="emp_id" class="form-control" required>
									    	
									    @if(isset($single_advance))
						 
									    	<option value="{{$single_advance->emp_id}}" >{{$single_advance->employee->name}}</option>
									    	
									    @else
									      <option value="" >--- Select Employee ---</option>
									    	@foreach($employees as $employee) 
									    	<option value="{{$employee->id}}" >{{$employee->name}}</option>
									    	@endforeach
									    @endif	
									    </select>
									</div>

									<div class="form-group">
									    <label for="name">Salary Month</label>
									    <select name="month" id="month" class="form-control" required>
									    @if(isset($single_advance))
									        <option value="{{$single_advance->month}}">{{$single_advance->month}}</option>
									    @else	
									    	<option value="" >--- Select Month ---</option>
									    	<option value="January">January</option>
									    	<option value="February">February</option>
									    	<option value="March">March</option>
									    	<option value="April">April</option>
									    	<option value="May">May</option>
									    	<option value="June">June</option>
									    	<option value="July">July</option>
									    	<option value="August">August</option>
									    	<option value="September">September</option>
									    	<option value="October">October</option>
									    	<option value="November">November</option>
									    	<option value="December">December</option>
									    @endif
									    </select>
									</div>
									
									<div class="form-group">
									    <label for="advance_salary">Advance Salary</label>
									    <input type="text" class="form-control" id="advance_salary" name="advance_salary" placeholder="Advance Salary" required value="{!! isset($single_advance)?$single_advance->advance_salary:old('advance_salary') !!}">
									</div>
									
									<div class="form-group">
									    <label for="year">Year</label>
									    <input type="text" class="form-control" id="year" name="year" placeholder="Year" required value="{!! isset($single_advance)?$single_advance->year:old('year') !!}">
									</div>


									<div class="form-group">
									    <button type="submit" class=" btn btn-primary pull-right">
									    	@php echo $btn; @endphp
                                        </button>
									</div>
							{!! Form::close() !!}		
							  
								</div>
							</div>
						</div>
					</div>
               </div>
            </div>        
        </div>
    </div>         
</div>
@endsection
