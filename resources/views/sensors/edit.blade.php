@extends('layouts.home')

<!-- @section('title', '| Edit Sensor') -->

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">

  <ol class="breadcrumb breadcrumb-settings">
    <li class="breadcrumb-item">
      <a href="{{route('dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{route('sensors.index')}}">Sensors</a></li>
    <li class="breadcrumb-item active">Edit {{$sensor->c_name}}</li>
  </ol>

  <div class="row">
     <div class="col-lg-5 mt-3 mx-auto">

    <!-- <h2><i class='fa fa-key'></i> Edit sensor: {{$sensor->c_name}}</h2> -->
    <!-- <hr> -->
    {{-- @include ('errors.list')
 --}}
    {{ Form::model($sensor, array('route' => array('sensors.update', $sensor->c_id), 'method' => 'PUT')) }}
        {{ csrf_field() }}
    <div class="form-group">
        {{ Form::label('name', 'Sensor name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('type', 'Type') }}
        {{ Form::select('type', $projects, null, ['class' => 'form-control']) }}
    </div>

    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
    </div>
  </div>
</div>

@endsection

@section('footer')
<footer class="py-5 bg-dark" style="">
  <div class="container">
    <p class="m-0 text-center text-white">Copyright &copy; ADMU Monitoring 2018</p>
  </div>
  <!-- /.container -->
</footer>
@endsection('footer')
