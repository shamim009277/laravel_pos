
@extends('layouts.app')
@section('title','Inventory | Employee Salary Sheet')
@push('css')
<style>
	.message{
		border: 2px solid #768;
        margin: 14px;
        border-radius: 5px;
	} 
	.message h5{

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
								<i class="fa fa-user"></i> Employee Salary Sheet
							</h3>
						</div>
					    </br>
						<div class="panel-body">
							<div class="row mx-auto">
								<div class="col-md-10 mx-auto" style="float:none;margin:auto;">
		
								  
         {!! Form::open(array('route'=>['salary.store'],'method'=>'POST','files'=>true))!!} 
                @php  $btn = "Pay Salary"; @endphp

							<div class="row">
                            <div id="salary">
                                <div class="col-md-12 message">
                                	<h5 class="text-danger">Your final salary depend on your attendence as well as yor advance salary.If you attend 100% then you get extra bonus. But if you not attend 100% then your salary will be dected.</h5>
                                </div>

                                <h4 class="text-center text-success"><b>Previous Due : {{$advance_salary}} </b></h4>

                                <div class="col-md-6">
                                	<div class="form-group">
									    <label for="name">Employee ID</label>
									    <input type="text" class="form-control" name="emp_id" value="{{$id}}" readonly>
									</div>
                                </div>

                                <div class="col-md-6">
                                	<div class="form-group">
									    <label for="name">Employee Name</label>
									    <p class="form-control">{{$name}}</p>
									</div>
                                </div>

                                <div class="col-md-6">
                                	<div class="form-group">
									    <label for="name">Salary Month</label>
									    <input type="text" class="form-control" name="month" value="{{$month}}" readonly>
									</div>
                                </div>

                                <div class="col-md-6">
                                	<div class="form-group">
									    <label for="name">Salary Year</label>
									    <input type="text" class="form-control" name="year" value="{{$year}}" readonly>
									</div>
                                </div>

                                <div class="col-md-6">
                                	<div class="form-group">
									    <label for="name">Total Working Days</label>
									    <p class="form-control">{{$total_day}}</p>
									</div>
                                </div>

                                <div class="col-md-6">
                                	<div class="form-group">
									    <label for="name">Total Present</label>
									    <p class="form-control">{{$working}} <span class="text-danger">(Attendence Bonus : {{$atten_donus}})</span></p>
									</div>
                                </div>

                                <div class="col-md-6">
                                	<div class="form-group">
									    <label for="name">Base Salary</label>
									    <p class="form-control">{{$base_salary}}</p>
									</div>
                                </div>

                                <div class="col-md-6">
                                	<div class="form-group">
									    <label for="name">Final Salary</label>
									    <input type="text" class="form-control" name="amount" value="{{$total_salary}}" readonly>
									</div>
                                </div>
    	
                            </div>    
									
                                <div class="col-md-12">
                                	<div class="form-group">
									    <button type="submit" class=" btn btn-primary pull-right">
									    	@php echo $btn; @endphp
                                        </button>
									</div>
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
</div>
@endsection
