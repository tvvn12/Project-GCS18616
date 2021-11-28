@extends('layouts.admin')

@section('content')


<div class="card">
<div class="card-body">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <style type="text/css">
        .box{
            width:800px;
            margin:0 auto;
        }
    </style>
            <div class="col-md-10 col-md-offset-1">
               
                  
                    <div class="panel-body" align="center">
                        <div id="pie_chart" style="width:750px; height:450px;">
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var jsonData = <?php echo $data; ?>

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart()
        {
            // var data = google.visualization.arrayToDataTable(analytics);
            var options = {
                title : 'Statistics of products sold of E-shop'
            };
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Task');
            data.addColumn('number', 'Hours per Day');
            data.addRows(jsonData);

            var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
            chart.draw(data, options);
        }
    </script>

   </div>
</div>
@endsection
