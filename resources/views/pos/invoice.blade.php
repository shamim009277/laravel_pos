@extends('layouts.app')
@section('title','POS | Invoice')
@push('css')
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">
 <style>
     .customer h3{
        margin: 5px;
        font-size: 22px;
        color: #01012b;
     }
     .customer h5{
        margin: 5px;
     }
     .order h4{
        font-size: 18px;
        margin: 5px;
        font-weight: 500;
        font-family: emoji;
     }
     .com_name{
        text-align: center;
     }
     .com_name h3, h5{
        margin: 5px;
     }
 </style>
@endpush
@section('content')
<div class="main">
            <!-- MAIN CONTENT -->
<div class="main-content">
<div class="container-fluid">
    <div class="panel panel-default">
       <div class="panel-body">
           <div class="row">
               <div class="col-md-12">
                   <div class="com_name">
                       <img src="{{asset('images/'.$setting->logo)}}" alt="" width="10%" class="circle">
                       <h3>{{$setting->name}}</h3>
                       <h5>{{$setting->address}}</h5>
                       <h5>Phone: {{$setting->phone}}</h5>
                       <h5>Email: {{$setting->email}}</h5>
                   </div>
               </div>
           </div>
            
           <div class="row">
               <div class="col-md-6 col-sm-12" style="margin:60px 0px;">
                   <div class="customer pull-left">
                       <h3>{{$customer->shop_name}}</h3>
                       <h5>{{$customer->address}}</h5>
                       <h5>Phone: {{$customer->phone}}</h5>
                       <h5>Email: {{$customer->email}}</h5>
                   </div>
               </div>
               <div class="col-md-6 col-sm-12" style="margin:60px 0px;">
                   <div class="order pull-right">
                       <h4>Order Date: <strong><?php echo date('jS \of F, Y'); ?></strong></h4>
                       <h4>Order Status: </h4>
                       <h4>OrderId: 0398</h4>
                   </div>
               </div>
               <div class="col-md-12" style="margin-bottom:40px;">
                   <table class="table table-bordered">
                       <thead>
                           <tr>
                               <th>#</th>
                               <th>Name</th>
                               <th>Qty</th>
                               <th>Single Price</th>
                               <th>Price</th>

                           </tr>
                       </thead>
                       
                       <tbody>
                        @php $n=0; @endphp
                        @foreach($products as $product)
                           <tr>
                               <td><?php echo ++$n; ?></td>
                               <td>{{$product->name}}</td>
                               <td>{{$product->qty}}</td>
                               <td>{{$product->price}}</td>
                               <td>{{$product->subtotal}}</td>
                           </tr>
                        @endforeach   
                       </tbody>
                   </table>
               </div>
               <div class="col-md-6">
                   
               </div>
               <div class="col-md-6">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th><b>Total Quantity</b></th>
                              <th>{{Cart::count()}}</th>
                          </tr>
                          <tr>
                              <th><b>Sub Total</b></th>
                              <th>{{Cart::subtotal()}}</th>
                          </tr>
                          <tr>
                              <th><b>Vat (5%)</b></th>
                              <th>{{Cart::tax()}}</th>
                          </tr>
                          <tr>
                              <th><b>Total Amount</b></th>
                              <th>{{Cart::total()}}</th>
                          </tr>
                      </thead>
                  </table>
               </div>
           </div>
           <hr>

           <div class="row">
              <div class="col-md-12" style="margin:50px 0px;">
                  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">
                       Submit
                  </button> 
               </div> 
           </div>
       </div>
    </div>
</div>
</div>   <!-- END MAIN CONTENT -->
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-info pull-left" id="exampleModalLabel"><b>Invoice of {{$customer->name}}</b></h4>
        <h4 class="modal-title text-info pull-right"><b>Total {{Cart::total()}}</b></h4>
      </div>
    <form action="{{route('order.confirm')}}" method="POST">
       @csrf 
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="due">Payment</label>
                    <select name="payment_status" class="form-control">
                        <option value="">Select Payment</option>
                        <option value="Hand Cash">Hand Cash</option>
                        <option value="Cache">Cache</option>
                        <option value="Due">Due</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="due">Pay</label>
                    <?php 
                           $cart = Cart::total();
                           $cart=str_replace(",","",$cart);
                     ?>
                    <input type="hidden" name="total" id="total" value="<?php echo round($cart); ?>">
                    <input type="text" class="form-control" onkeyup="makeDue()" id="pay" name="pay">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="due">Due</label>
                    <input type="text" class="form-control" onkeyup="makeDue()" id="due" name="due" value="<?php echo round($cart); ?>">
                    <input type="hidden" name="customer_id" value="{{$customer->id}}">
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

@endsection
@push('scripts')
  <script >
    function makeDue(){
        var total = document.getElementById("total").value;
        var pay = document.getElementById("pay").value;
        
        if(pay==""){
            pay=0; 
            document.getElementById('due').value=total; 
        }
        else{
            var pay = document.getElementById('pay').value; 
        }
            document.getElementById('pay').value=pay;
            var total = (total-pay);
            document.getElementById('due').value=total;
        }

  </script>
  <script>
    $(document).ready(function() {
         $('#example').DataTable();
    } );
</script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
@endpush