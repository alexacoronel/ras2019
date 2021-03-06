@extends('layouts.WMS')
@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('wms.summary')}}">Weather Monitoring</a>
  </li>
  <li class="breadcrumb-item active">Chart</li>
  <li class="breadcrumb-item active">Live</li>
</ol>

<div class="card mb-3">
    <div class="card-header"><i class="fa fa-area-chart"></i> WMS Live Chart</div>
        <div class="card-body">
          {{ Form::select('station', $stationsArray, null, array('onchange' => 'this.form.submit();')) }}
          <div id="container" width="100%" height="30"></div>
        </div>
<div class="card-footer small text-muted">Last updated at <?php echo str_replace('"','',$lastDate); ?> </div>
</div>

<div class="form-inline" style="margin-bottom: 1em;">

<script type="text/javascript">

var chart;
var url;

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

      function getData(){
          $.ajax({
               type: "GET",
               url: url,
               success: function(data){
                 var series = chart.series[0];
                 var returned = JSON.parse(data);
                 var shift = series.data.length > 20;
                 var date = Date.parse(returned[0].c_time);
                 chart.series[0].addPoint([date, returned[0].c_value], true, shift);
                 console.log(date);
               }
          });
           setTimeout(getData, 1000);
      };

      var config = {
                    chart: {
                        renderTo: 'container',
                        type: 'spline',
                        events: {
                            load: getData
                        }
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
                            // compare: 'percent',
                            showInNavigator: true,
                            events: {
                              legendItemClick: function(event) {
                                  var selected = this.index;
                                  var allSeries = this.chart.series;

                                  $.each(allSeries, function(index, series) {
                                      selected == index ? series.show() : series.hide();
                                  });

                                  return false;
                              }
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
                    rangeSelector: {
                        selected: 1
                    },
                    yAxis: [{
                    },
                    {//Rain Rate Y-Axis
                      plotBands:[{
                        from: 0.01,
                        to: 2.5,
                        color: 'rgba(68, 170, 213, 0.1)',
                        label:{
                          text: 'Light Rain',
                          style: {
                            color: '#606060'
                          }
                        }
                      }, {
                    from: 2.5,
                    to: 7.5,
                    color: 'rgba(0, 0, 0, 0)',
                    label:{
                      text: 'Moderate Rain',
                      style: {
                        color: '#606060'
                      }
                    }
                    }, {
                    from: 7.5,
                    to: 15,
                    color: 'rgba(68, 170, 213, 0.1)',
                    label:{
                      text: 'Heavy Rain',
                      style: {
                        color: '#606060'
                      }
                    }
                    }, {
                    from: 15,
                    to: 30,
                    color: 'rgba(0, 0, 0, 0)',
                    label:{
                      text: 'Intense Rain',
                      style: {
                        color: '#606060'
                        }
                      }
                    }, {
                    from: 30,
                    to: 100,
                    color: 'rgba(68, 170, 213, 0.1)',
                    label:{
                      text: 'Torrential Rain',
                      style: {
                        color: '#606060'
                      }
                    }
                    }
                  ],
                  labels:{
                    formatter: function(){
                      return this.value + ' mm/h';
                    }
                  }
                  },
                  {//temperature
                    labels:{
                      formatter: function(){
                        return this.value + ' °C';
                      }
                    }
                  },
                  {//pressure
                    labels:{
                      formatter: function(){
                        return this.value + ' mb';
                      }
                    }
                  },
                  {//humidity
                    labels:{
                      formatter: function(){
                        return this.value + ' %';
                      }
                    }
                  },
                  {//daily rainfall
                    labels:{
                      formatter: function(){
                        return this.value + ' mm';
                      }
                    }
                  },
                  {//sound level
                    plotBands:[{
                      from: 0,
                      to: 30,
                      color: 'rgba(68, 170, 213, 0.1)',
                      label:{
                        text: 'No Rain',
                        style: {
                          color: '#606060'
                        }
                      }
                    }, {
                    from: 30,
                    to: 36,
                    color: 'rgba(0, 0, 0, 0)',
                    label:{
                      text: 'Light Rain',
                      style: {
                        color: '#606060'
                      }
                    }
                    }, {
                    from:36,
                    to: 42,
                    color: 'rgba(68, 170, 213, 0.1)',
                    label:{
                      text: 'Moderate Rain',
                      style: {
                        color: '#606060'
                      }
                    }
                    }, {
                    from: 42,
                    to: 46,
                    color: 'rgba(0, 0, 0, 0)',
                    label:{
                      text: 'Heavy Rain',
                      style: {
                        color: '#606060'
                        }
                      }
                    }, {
                    from: 46,
                    to: 54,
                    color: 'rgba(68, 170, 213, 0.1)',
                    label:{
                      text: 'Intense Rain',
                      style: {
                        color: '#606060'
                        }
                      }
                    }, {
                    from: 54,
                    to: 60,
                    color: 'rgba(0, 0, 0, 0)',
                    label:{
                      text: 'Torrential Rain',
                      style: {
                        color: '#606060'
                        }
                      }
                    }],
                    labels:{
                      formatter: function(){
                        return this.value + ' dB';
                      }
                    }
                  },
                  {//wind speed
                    labels:{
                      formatter: function(){
                        return this.value + ' km/h';
                      }
                    }
                  },
                  {//Water Level
                    plotBands:[{
                      from: 0,
                      to: 152.40,
                      color: 'rgba(68, 170, 213, 0.1)',
                      label:{
                        text: 'Low',
                        style: {
                          color: '#606060'
                        }
                      }
                    }, {
                    from: 152.40,
                    to: 304.80,
                    color: 'rgba(0, 0, 0, 0)',
                    label:{
                      text: 'Medium',
                      style: {
                        color: '#606060'
                      }
                    }
                    }, {
                    from:330.2,
                    to: 457.20,
                    color: 'rgba(68, 170, 213, 0.1)',
                    label:{
                      text: 'High',
                      style: {
                        color: '#606060'
                      }
                    }
                    }, {
                    from: 482.60,
                    to: 914.40,
                    color: 'rgba(0, 0, 0, 0)',
                    label:{
                      text: 'Very High',
                      style: {
                        color: '#606060'
                        }
                      }
                    }, {
                    from: 914.40,
                    to: 2000,
                    color: 'rgba(68, 170, 213, 0.1)',
                    label:{
                      text: 'Extremely High',
                      style: {
                        color: '#606060'
                        }
                      }
                    }],
                labels:{
                  formatter: function(){
                    return this.value + ' mm';
                  }
                }
                },
                    ],
                    series: [{
                        name: "Temperature",
                        data:  temp_data,
                        type: 'spline',
                        threshold: null,
                        yAxis:2,
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
                        yAxis: 3,
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
                        visible: false
                    },
                    {
                        name: "Humidity",
                        data:  hum_data,
                        type: 'line',
                        yAxis: 4,
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
                        visible: false
                    },
                    {
                        name: "Rain rate",
                        data:  rain_rate_data,
                        step: true,
                        threshold: null,
                        yAxis: 1,
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
                        visible: false
                    },
                    {
                        name: "Daily rainfall",
                        data:  total_rain_data,
                        type: 'spline',
                        dashStyle: 'ShortDashDot',
                        threshold: null,
                        yAxis: 5,
                        tooltip: {
                            valueDecimals: 2,
                            valueSuffix: " mm"
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
                        visible: false
                    },
                    {
                        name: "Sound level",
                        data:  sound_level_data,
                        type: 'line',
                        yAxis: 6,
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
                        visible: false
                    },
                    {
                        name: "Wind speed",
                        data:  wind_data,
                        dashStyle: 'shortdot',
                        type: 'spline',
                        yAxis: 7,
                        threshold: null,
                        tooltip: {
                            valueDecimals: 2,
                            valueSuffix: " km/h"
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
                                [0, Highcharts.getOptions().colors[5]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        visible: false
                    },
                    {
                        name: "Water Level",
                        data:  water_level_data,
                        type: 'spline',
                        dashStyle:'Dash',
                        threshold: null,
                        yAxis:8,
                        tooltip: {
                            valueDecimals: 2,
                            valueSuffix: " mm"
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
                        visible: false
                    }
                  ]
          };

          chart = new Highcharts.StockChart(config);

          if (chart.series[0].visible) {
            url = "{{route('wms.lastTemp')}}";
          } else if (chart.series[1].visible) {
            url = "{{route('wms.lastPres')}}";
          } else if (chart.series[2].visible) {
            url = "{{route('wms.lastHum')}}";
          } else if (chart.series[3].visible) {
            url = "{{route('wms.lastRR')}}";
          } else if (chart.series[4].visible) {
            url = "{{route('wms.lastTR')}}";
          } else if (chart.series[5].visible) {
            url = "{{route('wms.lastSound')}}";
          } else if (chart.series[6].visible) {
            url = "{{route('wms.lastWS')}}";
          }

  });


  // colors: ['#ee6d6d','#ec7c7c','#ee876d','#5e8692','#586d92','#4f6283']

</script>


<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>

@stop
