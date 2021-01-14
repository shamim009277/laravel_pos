@extends('layouts.app')
@section('title','POS')
@push('css')
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">
@endpush
@section('content')
<div class="main">
            <!-- MAIN CONTENT -->
<div class="main-content">
<div class="container-fluid">
                    <!-- OVERVIEW -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><b>POS (Point of Sale)</b></h3>
        </div>
        
        <div class="panel-body">
            <div class="row">
            @foreach($categories as $category)    
                <a class="btn btn-info btn-sm">{{$category->category_name}}</a>
            @endforeach
            </div>
            <br>
            <br>
            <div class="row">
               <div class="col-md-6">
                   
                   <br>
                    <?php 
                           $items = Cart::content();
                        
                     ?>
                   <div class="metric">
                       <table class="table">
                            <thead style="background-color: #164065;color:white;">
                                <tr>
                                    <th style="padding:8px !important;">Name</th>
                                    <th>Qty</th>
                                    <th>Single Price</th>
                                    <th>Sub Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)    
                                <tr>
                                    <td style="padding:8px !important;">{{$item->name}}</td>
                                    <td>
                                      <form action="{{route('update.cart')}}" method="POST">
                                        @csrf
                                        <input type="number" name="qty" value="{{$item->qty}}" style="width:40px;">
                                        <input type="hidden" name="rowId" value="{{$item->rowId}}">
                                        <button type="submit" class="btn btn-sm btn-success" style="padding:3px 10px !important;margin-top:-4px;">
                                            <i class="fa fa-check"></i>
                                        </button>
                                      </form>
                                    </td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->subtotal}}</td>
                                    <td>
                                        <a href="{{route('remove.cart',$item->rowId)}}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <?php Cart::setTax($item->rowId, 5); ?>
                                </tr>
                            @endforeach    
                            </tbody>
                        </table>
                        <div class="total" style="background-color: #164065;padding: 2px 6px;color: white;">
                            <table width="100%" style="padding:5px 0px">
                                <thead>
                                    <tr>
                                        <th width="25%"><h4>Quantity</h4></th>
                                        <th width="50%"><h4>{{Cart::count()}}</h4></th>
                                    </tr>
                                    <tr>
                                        <th width="25%"><h4>Sub Total</h4></th>
                                        <th width="50%"><h4>{{Cart::subtotal()}}</h4></th>
                                    </tr>
                                    <tr>
                                        <th width="25%"><h4>Vat (5%)</h4></th>
                                        <th width="50%"><h4>{{Cart::tax()}}</h4></th>
                                    </tr>
                                </thead>
                            </table>
                             
                             <hr>
                             <h3 class="text-center">Total Amount : {{Cart::total()}}</h3>
                        </div> 
                    </div>
                <div class="customer">
                    <div class="panel panel-info">   
                    <form action="{{route('create.invoice')}}" method="POST" accept-charset="utf-8">
                        @csrf
                    <div class="panel-heading">
                       <h4 class="pull-left">Customer</h4>
                        <a href="#" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#exampleModal">Add New</a>
                    </div> 
                    <div class="panel-body">
                    <div class="form-group">   
                       <select name="customer_id" class="form-control">
                           <option value="" disabled selected>---Select Customer---</option>
                        @foreach($customers as $customer)
                           <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach   
                       </select>
                    </div>   
                       <center><button type="submit" class="btn btn-warning btn-md">Create Invoice</button></center>  
                    </div>
                    </form>
                    </div> 
                </div>
               </div>
               <div class="col-md-6">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="padding:8px !important;">Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>price</th>
                            </tr>
                        </thead>
                        <tbody>  
                         @foreach($products as $product)    
                            <tr>
                                <form action="{{route('product.cart')}}" method="POST">
                                  @csrf
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <input type="hidden" name="name" value="{{$product->product_name}}">
                                <input type="hidden" name="price" value="{{$product->selling_price}}">

                                <td style="padding:8px !important;">
                                    
                                    <button type="submit"><i class="fa fa-plus-square"> </i></button>
                                    <img src="{{asset('images/products/'.$product->product_image)}}" alt="Image" style="width:80px">
                                </td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->category->category_name}}</td>
                                <td>{{$product->selling_price}}</td>
                                
                                </form>
                            </tr>
                         @endforeach
                        </tbody>
                    </table>
               </div>   
            </div>   
        </div>
    </div>
    <!-- END OVERVIEW -->   
</div>
</div>   <!-- END MAIN CONTENT -->
</div>


<!-- Modal For Attendence-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-primary" id="exampleModalLabel"><b>New Customer</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <form action="" method="get" accept-charset="utf-8">
          
      
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Full Address" required >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="experience">Shop Name</label>
                    <input type="text" class="form-control" id="shop_name" name="shop_name" placeholder="Enter Shop Name" required >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="account_holder">Account Holder</label>
                    <input type="text" class="form-control" id="account_holder" name="account_holder" placeholder="Enter Bank Holder Name" required >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="account_number">Account Number</label>
                    <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Enter Account Number" required >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bank_name">Bank Name</label>
                    <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter Your Bank Name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bank_branch">Bank Branch</label>
                    <input type="text" class="form-control" id="bank_branch" name="bank_branch" placeholder="Bank Branch" required >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="City" required >
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo"
                     onchange="loadFile(event)">
                    <img id="output" width="20%" style="margin-top:5px;" />
                </div>
            </div>    

        </div>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!--End modal-->
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