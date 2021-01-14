@if(!empty($single_product))
  @php  $title = "Inventory | Update Products";  @endphp
@else
   @php  $title = "Inventory | Add Products"; @endphp
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
						@if(!empty($single_product))
						    <h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Update Product
							</h3>
						@else
							<h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Add Product
							</h3>
						@endif	
						</div>
					    </br>
						<div class="panel-body">
							<div class="row mx-auto">
								<div class="col-md-10 mx-auto" style="float:none;margin:auto;">
		@if(!empty($single_product))
		 {!! Form::open(array('route'=>['products.update',$single_product->id],'method'=>'PUT','files'=>true)) !!}
           @php  $btn = "Update Category"; @endphp
		@else
								  
         {!! Form::open(array('route'=>['products.store'],'method'=>'POST','files'=>true))!!} 
                @php  $btn = "Submit"; @endphp
        @endif          
									<div class="form-group">
									    <label for="name">Product Name</label>
									    	<input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter Product Name" value="{!!isset($single_product)?$single_product->product_name:old('product_name')!!}">
									</div>

									<div class="form-group">
										<label for="name">Category</label>
										<select name="cat_id" id="cat_id" class="form-control">
										@isset($single_product)
										   <option value="{{$single_product->cat_id}}">{{$single_product->category->category_name}}</option>}
										   @foreach($categories as $category)
										      @if(($single_product->category->category_name)!==($category->category_name))
											     <option value="{{$category->id}}">{{$category->category_name}}</option>
                                               @endif
										   @endforeach
										@else 
											<option value="">---Select Category---</option>
											@foreach($categories as $category)
											<option value="{{$category->id}}">{{$category->category_name}}</option>
											@endforeach
										@endif	
										</select>
									</div>

									<div class="form-group">
										<label for="name">Supplier</label>
										<select name="sup_id" id="sup_id" class="form-control">
										@isset($single_product)
										  <option value="{{$single_product->sup_id}}">{{$single_product->supplier->name}}</option>}
										 
										    @foreach($suppliers as $supplier)
										      @if(($single_product->supplier->name)!==($supplier->name))
												<option value="{{$supplier->id}}">{{$supplier->name}}</option>
											  @endif	
											@endforeach
										@else
											<option value="">---Select Supplier---</option>
											@foreach($suppliers as $supplier)
											<option value="{{$supplier->id}}">{{$supplier->name}}</option>
											@endforeach
										@endif	
										</select>
									</div>

									<div class="form-group">
									    <label for="name">Product Code</label>
									    	<input type="text" name="product_code" id="product_code" class="form-control" placeholder="Enter Product Name" value="{!!isset($single_product)?$single_product->product_code:old('product_code')!!}">
									</div>

									<div class="form-group">
									    <label for="name">Garage</label>
									    	<input type="text" name="product_garage" id="product_garage" class="form-control" placeholder="Enter Product Name" value="{!!isset($single_product)?$single_product->product_garage:old('product_garage')!!}">
									</div>

									<div class="form-group">
									    <label for="birth">Buying Date</label>
									    <input type="date" class="form-control" id="buy_date" name="buy_date" placeholder="Enter Salary" required value="{!! isset($single_product)?$single_product->buy_date:old('buy_date') !!}">
									</div>

									<div class="form-group">
									    <label for="birth">Expire Date</label>
									    <input type="date" class="form-control" id="expire_date" name="expire_date" required value="{!! isset($single_product)?$single_product->expire_date:old('expire_date') !!}">
									</div>

									<div class="form-group">
									    <label for="birth">Buying Price</label>
									    <input type="text" class="form-control" id="buying_price" name="buying_price" placeholder="Enter Buying Price" required value="{!! isset($single_product)?$single_product->buying_price:old('buying_price') !!}">
									</div>

									<div class="form-group">
									    <label for="birth">Selling Price</label>
									    <input type="text" class="form-control" id="selling_price" name="selling_price" placeholder="Enter Selling Price" required value="{!! isset($single_product)?$single_product->selling_price:old('selling_price') !!}">
									</div>

									@if(isset($single_product))
									<div class="form-group">
		                              <label for="product_image">Old Photo</label>
		                        
		                                <img src="{{ asset('images/products/' . $single_product->product_image) }}" style="width:120px"> 
		                              
		                            </div>

									<div class="form-group">
									    <label for="product_image">New Product image</label>
									    <input type="file" class="form-control" id="product_image" name="product_image"
									     onchange="loadFile(event)">
									    <img id="output" width="20%" style="margin-top:5px;" />
									</div>

									@else

									<div class="form-group">
									    <label for="product_image">Product Image</label>
									    <input type="file" class="form-control" id="product_image" name="product_image"
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
