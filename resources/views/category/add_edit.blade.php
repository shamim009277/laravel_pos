@if(!empty($single_category))
  @php  $title = "Inventory | Update Product Category";  @endphp
@else
   @php  $title = "Inventory | Add Product Category"; @endphp
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
						@if(!empty($single_category))
						    <h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Update Product Category
							</h3>
						@else
							<h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Add Product Category
							</h3>
						@endif	
						</div>
					    </br>
						<div class="panel-body">
							<div class="row mx-auto">
								<div class="col-md-10 mx-auto" style="float:none;margin:auto;">
		@if(!empty($single_category))
		 {!! Form::open(array('route'=>['category.update',$single_category->id],'method'=>'PUT','files'=>true)) !!}
           @php  $btn = "Update Category"; @endphp
		@else
								  
         {!! Form::open(array('route'=>['category.store'],'method'=>'POST','files'=>true))!!} 
                @php  $btn = "Submit"; @endphp
        @endif          
									<div class="form-group">
									    <label for="name">Product Category Name</label>
									    	<input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category Name" value="{!!isset($single_category)?$single_category->category_name:old('category_name')!!}">
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
