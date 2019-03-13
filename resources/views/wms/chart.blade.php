@extends('layouts.WMS')
@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('wms.summary')}}">Weather Monitoring</a>
  </li>
  <li class="breadcrumb-item active">Chart</li>
  <li class="breadcrumb-item active">Line</li>
</ol>

<div class="card mb-3">
    <div class="card-header"><i class="fa fa-area-chart"></i> WMS Chart</div>
        <div class="card-body">
          {{ Form::select('sensor', $stationsArray, null, array('onchange' => 'this.form.submit();')) }}
          <div id="container" width="100%" height="30"></div>
        </div>
<div class="card-footer small text-muted">Last updated at <?php echo str_replace('"','',$lastDate); ?> </div>
</div>

<!-- <div class="form-inline" style="margin-bottom: 1em;"> -->

<form method="get" action="">

  {{-- Using the Laravel HTML Form Collective to create our form --}}

</form>

<!-- <a href="{{ route('wms.exportData') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Download data</a> -->

<!-- </div> -->

<style>
/* Style The Dropdown Button */
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
</style>

<div class="dropdown">
  <button class="dropbtn">Download Data</button>
  <div class="dropdown-content">
    <a href="{{ route('wms.exportData') }}">All</a>
    <a href="{{ route('wms.exportTempData') }}">Temperature</a>
    <a href="{{ route('wms.exportPressureData') }}">Pressure</a>
    <a href="{{ route('wms.exportHumidityData') }}">Humidity</a>
    <a href="{{ route('wms.exportRainRateData') }}">Rain rate</a>
    <a href="{{ route('wms.exportDailyRainfallData') }}">Daily rainfall</a>
    <a href="{{ route('wms.exportSoundData') }}">Sound level</a>
    <a href="{{ route('wms.exportWindData') }}">Wind Speed</a>
    <a href="{{ route('wms.exportWaterLevelData') }}">Water Level</a>
  </div>
</div>

<script type="text/javascript">



var chart;

  $(document).ready(function(){

      Highcharts.setOptions({
        global: {
          useUTC: false
        }
      });

      var temp_data = <?php echo $temp_dataFinal; ?>;
      var water_level_data = <?php echo $water_level_dataFinal; ?>;
      var hum_data = <?php echo $hum_dataFinal; ?>;
      var wind_data = <?php echo $wind_dataFinal; ?>;
      var rain_rate_data = <?php echo $rain_rate_dataFinal; ?>;
      var total_rain_data = <?php echo $total_rain_dataFinal; ?>;
      var sound_level_data = <?php echo $sound_level_dataFinal; ?>;
      var dir_data = <?php echo $dir_dataFinal; ?>;
      var pres_data = <?php echo $pres_dataFinal; ?>;
      var stationName= <?php echo $stationName; ?>

      var config = {
                    chart: {
                      renderTo: 'container',
                      events: {
                      },
                      type: 'spline'
                    },
                    colors: ['#ee6d6d','#fc913a','#ffc100','#718d70','#586d92','#5c626d','#4f6283', '#a1c2d1'],
                    rangeSelector: {
                        selected: 1
                    },
                    title: {
                        text: "Sensor data at " + stationName
                    },
                    plotOptions: {
                        series: {
                            compare: 'percent',
                            showInNavigator: true,
                            events: {
                          }
                        }
                    },

                    navigator: {
                        series: {
                            type: 'spline'
                        }
                    },
                    legend: {
                        enabled: true,
                        align: 'left',
                        layout: 'vertical',
                        verticalAlign: 'top',
                        y: 100,
                    },
                    yAxis: {
                      opposite: false,
                      visible: false,
                    },
                    rangeSelector: {
                        selected: 5,
                    },
                    series: [{
                        name: "Temperature",
                        data:  temp_data,
                        type: 'spline',
                        threshold: null,
                        tooltip: {
                            valueDecimals: 2,
                            valueSuffix: " °C"
                        },
                        marker: {
                            enabled: true,
                            radius: 3
                        },
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        visible: true
                    },
                    {
                        name: "Pressure",
                        data:  pres_data,
                        type: 'spline',
                        threshold: null,
                        tooltip: {
                            valueDecimals: 2,
                            valueSuffix: " mb"
                        },
                        marker: {
                            enabled: true,
                            radius: 3
                        },
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[1]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        visible: true
                    },
                    {
                        name: "Humidity",
                        data:  hum_data,
                        type: 'line',
                        dashStyle: 'longdash',
                        threshold: null,
                        tooltip: {
                            valueDecimals: 2,
                            valueSuffix: " %"
                        },
                        marker: {
                            enabled: true,
                            radius: 3
                        },
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[2]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[2]).setOpacity(0).get('rgba')]
                            ]
                        },
                        visible: true
                    },
                    {
                        name: "Rain rate",
                        data:  rain_rate_data,
                        // dashStyle: 'longdash',
                        step: true,
                        threshold: null,
                        tooltip: {
                            valueDecimals: 2,
                            valueSuffix: " mm/hr"
                        },
                        marker: {
                            enabled: true,
                            radius: 3
                        },
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        visible: true
                    },
                    {
                        name: "Daily rainfall",
                        data:  total_rain_data,
                        type: 'spline',
                        dashStyle: 'ShortDashDot',
                        threshold: null,
                        marker: {
                            enabled: true,
                            radius: 3
                        },
                        tooltip: {
                            valueDecimals: 2,
                            valueSuffix: " mm"
                        },
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        visible: true
                    },
                    {
                        name: "Sound level",
                        data:  sound_level_data,
                        type: 'column',
                        threshold: null,
                        tooltip: {
                            valueDecimals: 2,
                            valueSuffix: " dB"
                        },
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[3]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        visible: true
                    },
                    {
                        name: "Wind speed",
                        data:  wind_data,
                        dashStyle: 'shortdot',
                        type: 'spline',
                        threshold: null,
                        tooltip: {
                            valueDecimals: 2,
                            valueSuffix: " km/h"
                        },
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[5]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        visible: true
                    },
                    {
                        name: "Water Level",
                        data:  water_level_data,
                        dashStyle:'Dash',
                        threshold: null,
                        tooltip: {
                            valueDecimals: 2,
                            valueSuffix: " cm"
                        },
                        marker: {
                            enabled: true,
                            radius: 3
                        },
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[7]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        visible: true
                    }
                  ]

          };
          chart = new Highcharts.StockChart(config);
  });

  var $temp_button = $('#temp_button');
  var $temp_button = $('#water_level_button');
  var $pres_button = $('#pres_button');
  var $hum_button = $('#hum_button');
  var $rain_rate_button = $('#rain_rate_button');
  var $total_rain_button = $('#total_rain_button');
  var $sound_level_button = $('#sound_level_button');
  var $wind_button = $('#wind_button');
  var $dir_button = $('#dir_button');

  // colors: ['#ee6d6d','#ec7c7c','#ee876d','#5e8692','#586d92','#4f6283']

  $temp_button.click(function () {
      var series = chart.series[0];
      if (series.visible) {
          series.hide();
          temp_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          temp_button.style.backgroundColor = '#ee6d6d';
      }
  });

  $pres_button.click(function () {
      var series = chart.series[1];
      if (series.visible) {
          series.hide();
          pres_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          pres_button.style.backgroundColor = '#ec7c7c';
      }
  });

  $hum_button.click(function () {
      var series = chart.series[2];
      if (series.visible) {
          series.hide();
          hum_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          hum_button.style.backgroundColor = '#ee876d';
      }
  });

  $rain_rate_button.click(function () {
      var series = chart.series[3];
      if (series.visible) {
          series.hide();
          rain_rate_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          rain_rate_button.style.backgroundColor = '#5e8692';
      }
  });

  $total_rain_button.click(function () {
      var series = chart.series[4];
      if (series.visible) {
          series.hide();
          total_rain_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          total_rain_button.style.backgroundColor = '#5e8692';
      }
  });

  $sound_level_button.click(function () {
      var series = chart.series[5];
      if (series.visible) {
          series.hide();
          sound_level_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          sound_level_button.style.backgroundColor = '#5e8692';
      }
  });

  $wind_button.click(function () {
      var series = chart.series[6];
      if (series.visible) {
          series.hide();
          wind_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          wind_button.style.backgroundColor = '#586d92';
      }
  });

  $dir_button.click(function () {
      var series = chart.series[7];
      if (series.visible) {
          series.hide();
          dir_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          dir_button.style.backgroundColor = '#4f6283';
      }
  });

  $water_level_button.click(function () {
      var series = chart.series[8];
      if (series.visible) {
          series.hide();
          water_level_button.style.backgroundColor = '#E5E5E5';
      } else {
          series.show();
          water_level_button.style.backgroundColor = '#4f6283';
      }
  });

</script>


<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>

@stop
