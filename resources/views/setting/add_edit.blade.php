@if(!empty($single_setting))
  @php  $title = "Inventory | Update Setting";  @endphp
@else
   @php  $title = "Inventory | Add Setting"; @endphp
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
						@if(!empty($single_setting))
						    <h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Update Additional Setting
							</h3>
						@else
							<h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Create New Additional Setting
							</h3>
						@endif	
						</div>
					    </br>
						<div class="panel-body">
							<div class="row mx-auto">
								<div class="col-md-10 mx-auto" style="float:none;margin:auto;">
		@if(!empty($single_setting))
		 {!! Form::open(array('route'=>['settings.update',$single_setting->id],'method'=>'PUT','files'=>true)) !!}
           @php  $btn = "Update Setting"; @endphp
		@else
								  
         {!! Form::open(array('route'=>['settings.store'],'method'=>'POST','files'=>true))!!} 
                @php  $btn = "Add Setting"; @endphp
        @endif          
									<div class="form-group">
									    <label for="name">Set Company Name</label>
									    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name" value="{!! isset($single_setting)?$single_setting->name:old('name') !!}" required>
									</div>
									<div class="form-group">
									    <label for="email">Set Company Email</label>
									    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Company Email" required value="{!! isset($single_setting)?$single_setting->email:old('email') !!}">
									</div>
									<div class="form-group">
									    <label for="phone">Company Phone Number</label>
									    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required value="{!! isset($single_setting)?$single_setting->phone:old('phone') !!}">
									</div>
									<div class="form-group">
									    <label for="address">Company Address</label>
									    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Full Address" required value="{!! isset($single_setting)?$single_setting->address:old('address') !!}">
									</div>
									<div class="form-group">
									    <label for="address">Set VAT(%)</label>
									    <input type="text" class="form-control" id="vat" name="vat" placeholder="eg. 7%" required value="{!! isset($single_setting)?$single_setting->vat:old('vat') !!}">
									</div>
								

									@if(isset($single_setting))
									<div class="form-group">
		                              <label for="logo">Old Logo</label>
		                        
		                                <img src="{{ asset('images/' . $single_setting->logo) }}" style="width:120px"> 
		                              
		                            </div>

									<div class="form-group">
									    <label for="logo">New Logo</label>
									    <input type="file" class="form-control" id="logo" name="logo"
									     onchange="loadFile(event)">
									    <img id="output" width="20%" style="margin-top:5px;" />
									</div>

									@else

									<div class="form-group">
									    <label for="logo">Upload Logo</label>
									    <input type="file" class="form-control" id="logo" name="logo"
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