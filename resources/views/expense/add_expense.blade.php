@if(!empty($single_expense))
  @php $title = "Inventory | Update Expense"; @endphp
@else
  @php $title = "Inventory | Add Expense"; @endphp
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
						@if(!empty($single_expense))
						    <h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Update Expense
							</h3>
						@else
							<h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Add Expense
							</h3>
							<a href="{{route('expense.today')}}" class="btn btn-info btn-md pull-right">Today</a>
							<a href="{{route('expense.monthly')}}" class="btn btn-danger btn-md pull-right">This Month</a>
						@endif	
						</div>
					    </br>

						<div class="panel-body">
							<div class="row mx-auto">
								<div class="col-md-10 mx-auto" style="float:none;margin:auto;">
		@if(!empty($single_expense))
		 {!! Form::open(array('route'=>['expense.update',$single_expense->id],'method'=>'POST','files'=>true)) !!}
           @php  $btn = "Update Expense"; @endphp
		@else
								  
         {!! Form::open(array('route'=>['expense.store'],'method'=>'POST','files'=>true))!!} 
                @php  $btn = "Add Expense"; @endphp
        @endif          
									<div class="form-group">
									    <label for="name">Expense Details</label>
									    	<textarea name="details" id="details" class="form-control" placeholder="Some Text here ...." rows="4">{!! isset($single_expense)?$single_expense->details:old('details')!!}</textarea>
									</div>

									<div class="form-group">
									    <label for="name">Amount</label>
									    <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" value="{{isset($single_expense)?$single_expense->amount:old('amount')}}">
									    <input type="hidden" name="date"  class="form-control" value="<?php echo date("d.m.Y"); ?>">
									    <input type="hidden" name="month"  class="form-control" value="<?php echo date("F"); ?>">	
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
