@extends('layouts.home')

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">



  @if(Session::has('flash_message'))
      <div class="alert alert-success">
        <em> {!! session('flash_message') !!}</em>
      </div>
  @endif

  <ol class="breadcrumb breadcrumb-settings">
    <li class="breadcrumb-item">
      <a href="{{route('dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Sensors</li>
  </ol>

    <!-- <h1><i class="fa fa-key"></i> Sensors
    </h1>
    <hr> -->

    <div class="btn-settings">
       <a href="{{ URL::to('sensors/create') }}" class="btn btn-success">Add Sensor</a>
       <!-- <div style=""> -->
         <!-- <a href="{{ route('users.index') }}" class="btn btn-secondary">Users</a> -->
         <!-- <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Permissions</a></h1> -->
       <!-- </div> -->
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="dataTable">
            <thead>
                <tr class="d-flex">
                    <th class="col-5">Name</th>
                    <th class="col-5">Project</th>
                    <th class="col-2">Operation</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($sensors as $sensor)
                <tr class="d-flex">
                    <td class="col-sm-5">{{ $sensor->c_name }}</td>
                    <td class="col-sm-5">{{  $sensor->c_type }}</td>
                    {{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td class="col-sm-2">
                    <a href="{{ URL::to('sensors/'.$sensor->c_id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['sensors.destroy', $sensor->c_id],
                        'onsubmit' => "return confirm('Are you sure you want to delete this sensor?')"
                    ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
           </tbody>
        </table>
    </div>

    <!-- <a href="{{ URL::to('sensors/create') }}" class="btn btn-success">Add Sensor</a> -->

</div>

@stop

@section('footer')
<footer class="py-5 bg-dark" style="width: 100%">
    <p class="m-0 text-center text-white">Copyright &copy; ADMU Monitoring 2018</p>
  <!-- /.container -->
</footer>
@endsection('footer')
