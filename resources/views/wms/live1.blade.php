@extends('layouts.WMS')
@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{route('wms.summary')}}">Weather Monitoring</a>
  </li>
  <li class="breadcrumb-item active">Chart</li>
  <li class="breadcrumb-item active">Live</li>
</ol>
<script src="{{asset('vendor/chart.js/Chart.js')}}"></script>

<div class="card mb-3">
    <div class="card-header"><i class="fa fa-area-chart"></i> WMS Live Chart</div>
        <div class="card-body">
          {{ Form::select('station', $stationsArray, null, array('onchange' => 'this.form.submit();')) }}
          <canvas id="myChart" height="100"></canvas>
        </div>
<div class="card-footer small text-muted">Last updated at <?php echo str_replace('"','',$lastDate); ?> </div>
</div>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        <canvas id="myChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let ctx = document.getElementById("myChart");

    let myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Online'],
            datasets: [{
                label: '# of Users',
                data: [3],
                borderWidth: 1
            }]
        },
        update() {
            Echo.join('chart')
                .here((users) => {
                    this.count = users.length;
                    this.drawChart();
                })
                .joining((user) => {
                    this.count++;
                    this.drawChart();
                })
                .leaving((user) => {
                    this.count--;
                    this.drawChart();
                });
        }
    });
    // import Chart from 'chart.js'
    //
    // export default {
    //     data() {
    //         return {
    //             count: 0,
    //             labels: ['Online']
    //         }
    //     },
    //     mounted() {
    //         this.update();
    //         this.drawChart();
    //     },
    //     methods: {
    //         drawChart() {
    //             let ctx = document.getElementById("myChart");
    //             let myChart = new Chart(ctx, {
    //                 type: 'bar',
    //                 data: {
    //                     labels: this.labels,
    //                     datasets: [{
    //                         label: '# of Users',
    //                         data: [this.count],
    //                         borderWidth: 1
    //                     }]
    //                 },
    //                 options: {
    //                     scales: {
    //                         yAxes: [{
    //                             ticks: {
    //                                 beginAtZero:true
    //                             }
    //                         }]
    //                     }
    //                 }
    //             });
    //         },
    //         update() {
    //             Echo.join('chart')
    //                 .here((users) => {
    //                     this.count = users.length;
    //                     this.drawChart();
    //                 })
    //                 .joining((user) => {
    //                     this.count++;
    //                     this.drawChart();
    //                 })
    //                 .leaving((user) => {
    //                     this.count--;
    //                     this.drawChart();
    //                 });
    //         }
    //     }
    // }
</script>


@stop
