@extends('layouts.app')
@section('title','Inventory | Product Category')
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
							<h3 class="panel-title pull-left">
								<i class="fa fa-list"></i> All Expense List
							</h3>
						</div>
					    </br>
						<div class="panel-body">
					        <table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Category Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="table_body">
								  
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
  	$(document).ready(function(){
        var url = "{{URL('admin')}}";
  		
  			$.ajax({
  				url : "/admin/get_category",
  				method: "POST",
  				data:{ 
                _token:'{{ csrf_token() }}'
                },
                dataType: 'json',
  				success:function(data){
                  console.log(data);
                  $.each(data,function(index,row){
                  	console.log(row);
                  	
						$("#table_body").append("<tr>" +
						"<td>" + (index+1) + "</td>" +
						"<td>" + row.category_name + "</td>" +
						"<td>" + row.category_name + "</td>" +
						"</tr>");

                  })
                  
  				}
  			})
  	
  	})

  </script>

@endpush