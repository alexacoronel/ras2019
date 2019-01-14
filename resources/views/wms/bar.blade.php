@extends('layouts.WMS')
@section('content')


  <ol class="breadcrumb">
    <li class="breadcrumb-item" href="{{route('wms.summary')}}">
      <a href="wms">Weather Monitoring</a>
    </li>
    <li class="breadcrumb-item active">Charts</li>
    <li class="breadcrumb-item active">Bar</li>
  </ol>

  @if($status != 'success')
      <div class="alert alert-danger">
        <em> Trouble connecting to API <br> </em>
        <em> {!! $status !!}</em>
      </div>
  @endif

  <script type="text/javascript">

  var data_value = <?php echo $dataFinal; ?>;
  var parameter = <?php echo $parameter; ?>;
  var stationName= <?php echo $stationName; ?>

  $(function () {

      // create the chart
      Highcharts.stockChart('container', {
          chart: {
              alignTicks: false
          },

          rangeSelector: {
              selected: 1
          },

          title: {
              text: parameter + " at " + stationName
          },

          series: [{
              type: 'column',
              name: parameter + " at " + stationName,
              data: data_value,
              dataGrouping: {
                  units: [[
                      'week', // unit name
                      [1] // allowed multiples
                  ], [
                      'month',
                      [1, 2, 3, 4, 6]
                  ]]
              }
          }]
      });
  });
  </script>


  <script src="https://code.highcharts.com/stock/highstock.js"></script>
  <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>

  <div class="card mb-3">
      <div class="card-header"><i class="fa fa-bar-chart"></i> WMS Bar Chart</div>
          <div class="card-body">
            <div id="container" width="100%" height="30"></div>
          </div>
  <div class="card-footer small text-muted">Last updated at {{$lastDate}} </div>
  </div>

  <form method="get" action="" >
    {{-- Using the Laravel HTML Form Collective to create our form --}}
          Station:
            {{ Form::select('station', $stationsArray, null, []) }}
          Parameter:
            {{ Form::select('parameter', $parametersArray, null, []) }}

    {{ Form::submit('Update') }}

  </form>


@endsection
