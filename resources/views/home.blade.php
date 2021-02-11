@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="main">
            <!-- MAIN CONTENT -->
<div class="main-content">
<div class="container-fluid">
                    <!-- OVERVIEW -->
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Full Overview</h3>
            <p class="panel-subtitle">Period:</p>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                        <p>
                            <span class="number">{{$sales}}</span>
                            <span class="title">Sales Item</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-money"></i></span>
                        <p>
                            <span class="number">{{$total}}</span>
                            <span class="title">Total Amount</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-bar-chart"></i></span>
                        <p>
                            <span class="number">{{$pay}}</span>
                            <span class="title">Paid Amount</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-money"></i></span>
                        <p>
                            <span class="number">{{$due}}</span>
                            <span class="title">Due Amount</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    
                </div>
                <div class="col-md-6">
                    <div id="chart_area" style=""></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OVERVIEW -->  


    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Weekly Overview</h3>
            <p class="panel-subtitle">Period: {{\Carbon\Carbon::now()->subdays(7)->format('F d, Y ')}} - {{\Carbon\Carbon::now()->format('F d, Y ')}}</p>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                        <p>
                            <span class="number">{{$weak_sales}}</span>
                            <span class="title">Sales Item</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-money"></i></span>
                        <p>
                            <span class="number">{{$weak_total}}</span>
                            <span class="title">Total Amount</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-bar-chart"></i></span>
                        <p>
                            <span class="number">{{$weak_pay}}</span>
                            <span class="title">Paid Amount</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-money"></i></span>
                        <p>
                            <span class="number">{{$weak_due}}</span>
                            <span class="title">Due Amount</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div id="chart_div" style=""></div>
                </div>
                <div class="col-md-6">
                    <div id="piechart_3d" style=""></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OVERVIEW -->  




</div>
</div>
            <!-- END MAIN CONTENT -->
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
      
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Product', 'number'],
          <?php 

            foreach ($data as $key => $value) {
               echo "['$value->product',$value->number],";
            }   
           ?>
        ]);

        var options = {
          title: 'Product Items sales Report',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Sales'],
        <?php 
           foreach ($date as $key => $value) {
            $sales = DB::table('orders')->where('order_date',$value->order_date)
            ->where('created_at','>=',\Carbon\Carbon::now()->subdays(7))->get()->sum('total');
               echo "['$value->order_date',$sales],";
           }
         ?>
        ]);

        var options = {
          title : 'Weekly Sales Amount',
          vAxis: {title: 'Sales (Amount)'},
          hAxis: {title: 'Date'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Sales'],
        <?php 
           foreach ($months as $key => $value) {
            $total = DB::table('orders')->whereMonth('created_at',$value->month)->get()->sum('total');
            echo "['$value->month', $total],";
           }
         ?>
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_area'));
        chart.draw(data, options);
      }
    </script>
@endpush
