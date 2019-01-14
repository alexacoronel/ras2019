@extends('layouts.home')

<!-- @section('title', '| Add Sensor') -->

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">

  <ol class="breadcrumb breadcrumb-settings">
    <li class="breadcrumb-item">
      <a href="{{route('dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{route('sensors.index')}}">Sensors</a>
    </li>
    <li class="breadcrumb-item active">Add Sensor</li>
  </ol>

  <div class="row">
     <div class="col-lg-5 mx-auto mt-3">
    <!-- <h2><i class='fa fa-key'></i> Add Sensor</h2> -->
    <!-- <hr> -->
    {{-- @include ('errors.list') --}}

    {{ Form::open(array('url' => 'sensors')) }}
        {{ csrf_field() }}
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('c_name', null, array('class' => 'form-control')) }}

        @if ($errors->has('c_name'))
            <span class="help-block">
              <div class="alert alert-danger">
                <strong>{{ $errors->first('c_name') }}</strong>
              </div>
            </span>
        @endif
    </div>

    <div class="form-group">
        {{ Form::label('type', 'Type') }}
        {{ Form::select('c_type', $projects, null, ['class' => 'form-control']) }}

    </div>

    {{ Form::submit('Add Sensor', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
  </div>
</div>
</div>

@endsection

@section('footer')
<footer class="py-5 bg-dark" style="width: 100%">
    <p class="m-0 text-center text-white">Copyright &copy; ADMU Monitoring 2018</p>
  <!-- /.container -->
</footer>
@endsection('footer')
