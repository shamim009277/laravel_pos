@extends('layouts.app')
@section('title','Inventory | Products')
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
								<i class="fa fa-list"></i> All Product List
							</h3>
							<a href="{{route('products.create')}}" class="btn btn-success pull-right">Add Product</a>
						</div>
					    </br>
						<div class="panel-body">
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Product Name</th>
										<th>Supplier</th>
										<th>Category</th>
										<th>Product Code</th>
										<th>Garage</th>
										<th>Buy Date</th>
										<th>Expire Date</th>
										<th>Selling Price</th>
										<th>Image</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								   @php
								      $n=0;
								   @endphp
								 @foreach($products as $product)	
									<tr>
										<td>@php echo ++$n; @endphp</td>
										<td>{{$product->product_name}}</td>
										<td>{{$product->supplier->name}}</td>
										<td>{{$product->category->category_name}}</td>
										<td>{{$product->product_code}}</td>
										<td>{{$product->product_garage}}</td>
					<td>{{ Carbon\Carbon::parse($product->buy_date)->format('d-m-Y') }}</td>
					<td>{{ Carbon\Carbon::parse($product->expire_date)->format('d-m-Y') }}</td>
										<td>{{$product->selling_price}}</td>
										<td>
											<img src="{{asset('images/products/'.$product->product_image)}}" alt="Image" style="width:80px">
										</td>
										@php 
										    $id = Crypt::encrypt($product->id); 
										@endphp
										<td>
											<a href="{{route('products.edit',$id)}}" class="btn btn-info btn-sm">
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