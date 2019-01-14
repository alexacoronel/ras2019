
<script type="text/javascript">

  $(function() {

    var data_value = <?php echo $dataFinal; ?>;
    var parameter = <?php echo $parameter; ?>;
    var stationName= <?php echo $stationName; ?>

    $('#container').highcharts('StockChart', {

              rangeSelector: {
                  selected: 1
              },

              title: {
                  text: parameter + " at " + stationName
              },

              series: [{
                  name: parameter,
                  data:  data_value,
                  type: 'areaspline',
                  threshold: null,
                  tooltip: {
                      valueDecimals: 2
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
                  }
              }]
        });
    });

</script>


<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>

<div class="card mb-3">
    <div class="card-header"><i class="fa fa-area-chart"></i> WMS Chart</div>
        <div class="card-body">
          <div id="container" width="100%" height="30"></div>
        </div>
<div class="card-footer small text-muted">Last updated at <?php echo str_replace('"','',$lastDate); ?> </div>
</div>

<form method="get" action="" >
  {{-- Using the Laravel HTML Form Collective to create our form --}}
        Station:
          {{ Form::select('station', $stationsArray, null, []) }}
        Parameter:
          {{ Form::select('parameter', $parametersArray, null, []) }}

  {{ Form::submit('Update') }}

</form>
