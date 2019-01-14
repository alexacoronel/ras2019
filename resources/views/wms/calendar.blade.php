@extends('layouts.WMS')
@section('content')

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>

<script src="{{asset('/cal-heatmap-master/cal-heatmap.js')}}"></script>
<script src="{{asset('/cal-heatmap-master/cal-heatmap.css')}}"></script> -->

<script type="text/javascript" src="//d3js.org/d3.v3.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/cal-heatmap/3.3.10/cal-heatmap.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/cal-heatmap/3.3.10/cal-heatmap.css" />

<div id="cal-heatmap"></div>
<script type="text/javascript">
	var cal = new CalHeatMap();
  var daily_data = <?php echo $daily_data; ?>;
	cal.init({
    data: daily_data,
      id : "cal-heatmap",
      domain : "month",
      subDomain : "day",
      cellsize: 15,
      cellpadding: 3,
      domainGutter: 15

  });
</script>
@stop
