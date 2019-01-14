@extends('layouts.WMS')
@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('wms.summary')}}">Weather Monitoring</a>
  </li>
  <li class="breadcrumb-item active">Chart</li>
  <li class="breadcrumb-item active">Wind</li>
</ol>

<div class="card mb-3">
    <div class="card-header"><i class="fa fa-dashboard"></i> WMS Wind rose</div>
        <div class="card-body">
          {{ Form::select('station', $stationsArray, null, array('onchange' => 'this.form.submit();')) }}
          <div id="container" width="100%" height="30"></div>
        </div>
<div class="card-footer small text-muted">Last updated at <?php echo str_replace('"','',$lastDate); ?> </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 420px; max-width: 600px; height: 400px;"></div>

<script>

$(document).ready(function(){

  var stationName = <?php echo $stationName ?>;
  var total = <?php echo $total ?>;
  var data_1 = <?php echo $data_1 ?>;
  var data_2 = <?php echo $data_2 ?>;
  var data_3 = <?php echo $data_3 ?>;
  var data_4 = <?php echo $data_4 ?>;

    var config = {
            chart: {
                polar: true,
                type: 'column'
            },

            title: {
                text: ' Wind rose for ' + stationName
            },

            // subtitle: {
            //     text: 'Source: or.water.usgs.gov'
            // },

            pane: {
                size: '100%'
            },

            legend: {
                align: 'right',
                verticalAlign: 'top',
                y: 100,
                layout: 'vertical'
            },

            xAxis: {
                tickmarkPlacement: 'on',
                type:'category',
                min: 0
            },

            yAxis: {
                min: 0,
                endOnTick: false,
                showLastLabel: true,
                reversedStacks: false
            },

            series: [{
                    // "data": [
                    //   ["N", data_1["N"]],
                    //   ["NNE", data_1["NNE"]],
                    //   ["NE", data_1["NE"]],
                    //   ["ENE", data_1["ENE"]]
                    //   ["E", data_1["E"]],
                    //   ["ESE", data_1["ESE"]],
                    //   ["SE", data_1["SE"]],
                    //   ["SSE",data_1["SSE"]],
                    //   ["S",data_1["S"]],
                    //   ["SSW",data_1["SSW"]],
                    //   ["SW",data_1["SW"]],
                    //   ["WSW",data_1["WSW"]],
                    //   ["W", data_1["W"]],
                    //   ["WNW", data_1["WNW"]],
                    //   ["NW", data_1["NW"]],
                    //   ["NNW", data_1["NNW"]],
                    // ],
                    "data": data_1,
                    "type": "column",
                    "name": "0-2 km/h",
                },{
                    "data": data_2,
                    "type": "column",
                    "name": "2-4 km/h"
                },{
                  "data": data_3,
                  "type": "column",
                  "name": "4-6 km/h"
                },{
                "data": data_4,
                "type": "column",
                "name": "> 6 km/h"
              }],
              plotOptions: {
                series: {
                    stacking: 'normal',
                    shadow: false,
                    groupPadding: 0,
                    pointPlacement: 'on'
                }
            }
        };
        Highcharts.chart('container', config);
});

</script>

@stop
