@extends('layouts.WMS')
@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('wms.summary')}}">Weather Monitoring</a>
  </li>
  <li class="breadcrumb-item active">Summary</li>
</ol>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous">
</script>

<script type="text/javascript" src="//d3js.org/d3.v3.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/cal-heatmap/3.3.10/cal-heatmap.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/cal-heatmap/3.3.10/cal-heatmap.css" />


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div class="card mb-3">
    <div class="card-header"><i class="fa fa-fw fa-dashboard"></i> WMS Summary</div>
        <div class="card-body">
          <!-- temp: C
          pressure: pascal
          humidity: %
          rain intensity: db
          wind speed: km/h
          direction: degrees -->

          <form style="margin-bottom: 4em" >
          <button type=submit name="parameter" value="Temperature" id="temp_button" class="btn btn-info pull-left" style="background-color:#ee6d6d; border:none">Temperature</button>
          <button type=submit name="parameter" value="Pressure" id="pres_button" class="btn btn-info pull-left" style="background-color:#ec7c7c; border:none">Pressure</button>
          <button type=submit name="parameter" value="Humidity" id="hum_button" class="btn btn-info pull-left" style="background-color:#ee876d; border:none">Humidity</button>
          <button type=submit name="parameter" value="Rain rate" id="rain_rate_button" class="btn btn-info pull-left" style="background-color:#5e8692; border:none">Rain rate</button>
          <button type=submit name="parameter" value="Total rain" id="tota_rain_button" class="btn btn-info pull-left" style="background-color:#5e8692; border:none">Total rain</button>
          <button type=submit name="parameter" value="Sound level" id="sound_level_button" class="btn btn-info pull-left" style="background-color:#5e8692; border:none">Sound level</button>
          <button type=submit name="parameter" value="Wind speed" id="wind_button" class="btn btn-info pull-left" style="background-color:#586d92; border:none">Wind speed</button>
          <button type=submit name="parameter" value="Wind direction" id="dir_button" class="btn btn-info pull-left" style="background-color:#4f6283; border:none;">Wind Direction</button>
          </form>
          <div style="margin-top: 4em" class="mx-auto" id="cal-heatmap" width="100%" height="50"> </div>

          <div class="mx-auto" id="averageData" width="100%" height="50"></div>

          <div class="mx-auto" id="highLow" width="100%" height="50"></div>

<?php echo $daily_data ?>
            <script>

            var daily_data = <?php echo $daily_data ?>;
            var parameter = {!!$parameter!!};
            var color;

            // ['#ee6d6d','#ec7c7c','#ee876d','#5e8692','#586d92','#4f6283'],
            if(parameter == 'Temperature'){
                color = "red";
            }else if(parameter == 'Pressure'){
                color = "peach";
            }else if(parameter == 'Humidity'){
                color = "yellow";
            }else if(parameter == 'Rain rate'){
                color = "blue";
            }else if(parameter == 'Total rain'){
                color = "blue";
            }else if(parameter == 'Sound level'){
                color = "blue";
            }else if(parameter == 'Temperature'){
                color = "teal";
            }else if(parameter == 'Wind speed'){
                color = "green";
            }else if(parameter == 'Wind direction'){
                color = "teal";
            }

            var cal = new CalHeatMap();

            cal.init({
                data : daily_data,
                start: new Date(2009, 03, 1),
                id : "cal-heatmap",
                domain : "month",
                subDomain : "x_day",
                cellsize: 15,
                cellpadding: 3,
                domainGutter: 15
            });

            </script>


        </div>
<div class="card-footer small text-muted">Last updated at <?php echo str_replace('"','',$lastDate); ?>  </div>
</div>
@stop
