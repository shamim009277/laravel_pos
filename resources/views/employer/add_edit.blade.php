@if(!empty($single_employee))
  @php  $title = "Inventory | Update Employee";  @endphp
@else
   @php  $title = "Inventory | Add Employee"; @endphp
@endif

@extends('layouts.app')
@section('title',$title)
@push('css')

@endpush
@section('content')
<div class="main">           
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
               	   <div class="panel panel-headline">
						<div class="panel-heading">
						@if(!empty($single_employee))
						    <h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Update Employee
							</h3>
						@else
							<h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Create New Employee
							</h3>
						@endif	
						</div>
					    </br>
						<div class="panel-body">
							<div class="row mx-auto">
								<div class="col-md-10 mx-auto" style="float:none;margin:auto;">
		@if(!empty($single_employee))
		 {!! Form::open(array('route'=>['employee.update',$single_employee->id],'method'=>'PUT','files'=>true)) !!}
           @php  $btn = "Update Employee"; @endphp
		@else
								  
         {!! Form::open(array('route'=>['employee.store'],'method'=>'POST','files'=>true))!!} 
                @php  $btn = "Submit"; @endphp
        @endif          
									<div class="form-group">
									    <label for="name">Full Name</label>
									    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" value="{!! isset($single_employee)?$single_employee->name:old('name') !!}" required>
									</div>
									<div class="form-group">
									    <label for="email">Email</label>
									    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required value="{!! isset($single_employee)?$single_employee->email:old('email') !!}">
									</div>
									<div class="form-group">
									    <label for="phone">Phone Number</label>
									    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required value="{!! isset($single_employee)?$single_employee->phone:old('phone') !!}">
									</div>
									<div class="form-group">
									    <label for="address">Address</label>
									    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Full Address" required value="{!! isset($single_employee)?$single_employee->address:old('address') !!}">
									</div>
									<div class="form-group">
									    <label for="experience">Eperience</label>
									    <input type="text" class="form-control" id="experience" name="experience" placeholder="Enter Experience" required value="{!! isset($single_employee)?$single_employee->experience:old('experience') !!}">
									</div>
									<div class="form-group">
									    <label for="nid_no">NIT NO</label>
									    <input type="text" class="form-control" id="nid_no" name="nid_no" placeholder="Enter NID Number" required value="{!! isset($single_employee)?$single_employee->nid_no:old('nid_no') !!}">
									</div>
									<div class="form-group">
									    <label for="salary">Salary</label>
									    <input type="text" class="form-control" id="salary" name="salary" placeholder="Enter Salary" required value="{!! isset($single_employee)?$single_employee->salary:old('salary') !!}">
									</div>
									<div class="form-group">
									    <label for="birth">Date of Birth</label>
									    <input type="date" class="form-control" id="birth" name="birth" placeholder="Enter Salary" required value="{!! isset($single_employee)?$single_employee->birth:old('birth') !!}">
									</div>
									<div class="form-group">
									    <label for="vacation">Vocation</label>
									    <input type="text" class="form-control" id="vacation" name="vacation" placeholder="vacation" required value="{!! isset($single_employee)?$single_employee->vacation:old('vacation') !!}">
									</div>
									<div class="form-group">
									    <label for="city">City</label>
									    <input type="text" class="form-control" id="city" name="city" placeholder="City" required value="{!! isset($single_employee)?$single_employee->city:old('city') !!}">
									</div>

									@if(isset($single_employee))
									<div class="form-group">
		                              <label for="photo">Old Photo</label>
		                        
		                                <img src="{{ asset('images/employee/' . $single_employee->photo) }}" style="width:120px"> 
		                              
		                            </div>

									<div class="form-group">
									    <label for="photo">New Photo</label>
									    <input type="file" class="form-control" id="photo" name="photo"
									     onchange="loadFile(event)">
									    <img id="output" width="20%" style="margin-top:5px;" />
									</div>

									@else

									<div class="form-group">
									    <label for="photo">Photo</label>
									    <input type="file" class="form-control" id="photo" name="photo"
									     onchange="loadFile(event)">
									    <img id="output" width="20%" style="margin-top:5px;" />
									</div>
                                    @endif
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
<script>
 var loadFile = function(event) {
 var reader = new FileReader();
 reader.onload = function(){
 var output = document.getElementById('output');
 output.src = reader.result;
                             };
reader.readAsDataURL(event.target.files[0]);
};
</script>
@endsection
@push('scripts')
<script>
	  
</script>
@endpush