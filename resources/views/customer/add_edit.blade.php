@if(!empty($single_customer))
  @php  $title = "Inventory | Update Customer";  @endphp
@else
   @php  $title = "Inventory | Add Customer"; @endphp
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
						@if(!empty($single_customer))
						    <h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Update Customer
							</h3>
						@else
							<h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Create New Customer
							</h3>
						@endif	
						</div>
					    </br>
						<div class="panel-body">
							<div class="row mx-auto">
								<div class="col-md-10 mx-auto" style="float:none;margin:auto;">
		@if(!empty($single_customer))
		 {!! Form::open(array('route'=>['customer.update',$single_customer->id],'method'=>'PUT','files'=>true)) !!}
           @php  $btn = "Update Employee"; @endphp
		@else
								  
         {!! Form::open(array('route'=>['customer.store'],'method'=>'POST','files'=>true))!!} 
                @php  $btn = "Submit"; @endphp
        @endif          
									<div class="form-group">
									    <label for="name">Full Name</label>
									    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" value="{!! isset($single_customer)?$single_customer->name:old('name') !!}" required>
									</div>
									<div class="form-group">
									    <label for="email">Email</label>
									    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required value="{!! isset($single_customer)?$single_customer->email:old('email') !!}">
									</div>
									<div class="form-group">
									    <label for="phone">Phone Number</label>
									    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required value="{!! isset($single_customer)?$single_customer->phone:old('phone') !!}">
									</div>
									<div class="form-group">
									    <label for="address">Address</label>
									    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Full Address" required value="{!! isset($single_customer)?$single_customer->address:old('address') !!}">
									</div>
									<div class="form-group">
									    <label for="experience">Shop Name</label>
									    <input type="text" class="form-control" id="shop_name" name="shop_name" placeholder="Enter Shop Name" required value="{!! isset($single_customer)?$single_customer->shop_name:old('shop_name') !!}">
									</div>
									<div class="form-group">
									    <label for="account_holder">Account Holder</label>
									    <input type="text" class="form-control" id="account_holder" name="account_holder" placeholder="Enter Bank Holder Name" required value="{!! isset($single_customer)?$single_customer->account_holder:old('account_holder') !!}">
									</div>
									<div class="form-group">
									    <label for="account_number">Account Number</label>
									    <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Enter Account Number" required value="{!! isset($single_customer)?$single_customer->account_number:old('account_number') !!}">
									</div>
									<div class="form-group">
									    <label for="bank_name">Bank Name</label>
									    <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter Your Bank Name" required value="{!! isset($single_customer)?$single_customer->bank_name:old('bank_name') !!}">
									</div>
									
									<div class="form-group">
									    <label for="bank_branch">Bank Branch</label>
									    <input type="text" class="form-control" id="bank_branch" name="bank_branch" placeholder="Bank Branch" required value="{!! isset($single_customer)?$single_customer->bank_branch:old('bank_branch') !!}">
									</div>

									<div class="form-group">
									    <label for="city">City</label>
									    <input type="text" class="form-control" id="city" name="city" placeholder="City" required value="{!! isset($single_customer)?$single_customer->city:old('city') !!}">
									</div>

									@if(isset($single_customer))
									<div class="form-group">
		                              <label for="photo">Old Photo</label>
		                        
		                                <img src="{{ asset('images/customer/' . $single_customer->photo) }}" style="width:120px"> 
		                              
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


@endpush