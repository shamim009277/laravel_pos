<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
</head>
<body>

<div class="container-fluid">
    <div class="panel panel-default">
       <div class="panel-body">
           <div class="row">
               <div class="col-md-12">
                   <div class="com_name">
                       <h3>Titan Store</h3>
                       <h5>House#12, Road#12, Uttara Model Town Dhaka</h5>
                       <h5>Phone: 01732036907</h5>
                   </div>
               </div>
           </div>
            
           <div class="row">
               <div class="col-md-6 col-sm-12" style="margin:60px 0px;">
                   <div class="customer pull-left">
                   	   <h3>{{$order->customer->name}}</h3>
                       <h3>{{$order->customer->shop_name}}</h3>
                       <h5>{{$order->customer->address}}</h5>
                       <h5>Phone: {{$order->customer->phone}}</h5>
                       <h5>Email: {{$order->customer->email}}</h5>
                   </div>
               </div>
               <div class="col-md-6 col-sm-12" style="margin:60px 0px;">
                   <div class="order pull-right">
                       <h4>Order Date: <strong>{{$order->order_date}}</strong></h4>
                       <h4>Payment Type: {{$order->payment_status}}</h4>
                   </div>
               </div>
               <div class="col-md-12" style="margin-bottom:40px;">
                   <table class="table table-bordered">
                       <thead>
                           <tr>
                               <th>#</th>
                               <th>Total Quantity</th>
                               <th>Sub Total</th>
                               <th>VAT</th>
                               <th>Total</th>
                               <th>Pay</th>
                               <th>Due</th>
                           </tr>
                       </thead>
                       
                       <tbody>
                        
                           <tr>
                               <td>1</td>
                               <td>{{$order->total_qty}}</td>
                               <td>{{$order->sub_total}}</td>
                               <td>{{$order->vat}}</td>
                               <td>{{$order->total}}</td>
                               <td>{{$order->pay}}</td>
                               <td>{{$order->due}}</td>
                           </tr>
                        
                       </tbody>
                   </table>
               </div>
           </div>
           <hr>
           <h4 style="margin-top: 50px;">Thank You-</h4>
       </div>
    </div>
</div>

</body>
</html>