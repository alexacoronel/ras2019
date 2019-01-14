@extends('layouts.home')
@section('content')

<div class="container" style="margin: auto">
  <div class="row" style = "overflow: hidden; padding-top: 30px;" >
    <div class="col-lg-6 portfolio-item">
      <div class="card h-100">
        <!-- <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a> -->
        <div class="card-body">
          <h4 class="card-title">
            <a href="dms">Dam monitoring</a>
          </h4>
          <p class="card-text">Dam monitoring system and visualization of collected by three dam sensors: a flow rate sensor, an ultrasonic sensor, and a soil moisture sensor.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-6 portfolio-item">
      <div class="card h-100">
        <!-- <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a> -->
        <div class="card-body">
          <h4 class="card-title">
            <a href="{{ route('wms.summary') }}">Weather monitoring</a>
          </h4>
          <p class="card-text">Weather monitoring system and data visualization that monitors several environmental parameters such as temperature, pressure, humidity, wind speed and direction, and rainfall.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.row -->

@stop

@section('footer')
<footer class="py-5 bg-dark" style="">
  <div class="container">
    <p class="m-0 text-center text-white">Copyright &copy; ADMU Monitoring 2018</p>
  </div>
  <!-- /.container -->
</footer>
@endsection('footer')
