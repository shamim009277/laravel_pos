@extends('layouts.app')
@section('title','Inventory | Settings')
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
								<i class="fa fa-list"> </i> Additional Settings
							</h3>
							<a href="{{route('settings.create')}}" class="btn btn-success pull-right">Add Settings</a>
						</div>
					    </br>
						<div class="panel-body">
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Company Name</th>
										<th>Company Logo</th>
										<th>Address</th>
										<th>Phone</th>
										<th>VAT</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@php $n=0; @endphp
								 @foreach($settings as $setting)
								   <tr>
								   	  <td><?php echo ++$n; ?></td>
								   	  <td>{{$setting->name}}</td>
								   	  <td>
								   	  	<img src="{{asset('images/'.$setting->logo)}}" alt="Image" width="20%">
								   	  </td>
								   	  <td>{{$setting->address}}</td>
								   	  <td>{{$setting->phone}}</td>
								   	  <td>{{$setting->vat}}</td>
								   	  <td></td>
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