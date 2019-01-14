@extends('layouts.home')

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">

  <ol class="breadcrumb breadcrumb-settings">
    <li class="breadcrumb-item">
      <a href="{{route('dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Logs</li>
  </ol>

    <!-- <h1><i class="fa fa-key"></i> Sensors
    </h1>
    <hr> -->

    <div class="btn-settings">
       <!-- <a href="{{ URL::to('sensors/create') }}" class="btn btn-success">Add Sensor</a> -->
       <!-- <div style=""> -->
         <!-- <a href="{{ route('users.index') }}" class="btn btn-secondary">Users</a> -->
         <!-- <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Permissions</a></h1> -->
       <!-- </div> -->
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="dataTable">
            <thead>
                <tr class="d-flex">
                    <th class="col-4">Operation date</th>
                    <th class="col-8">Log</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($activities as $activity)
                <tr class="d-flex">
                    <td class="col-sm-4">{{ $activity->causer->created_at }}</td>
                    <td class="col-sm-8">{{  $activity->description }}</td>
                    {{-- Retrieve array of permissions associated to a role and convert to string --}}
                </tr>
                @endforeach
           </tbody>
        </table>
    </div>

</div>

@stop

@section('footer')
<footer class="py-5 bg-dark" style="width: 100%">
    <p class="m-0 text-center text-white">Copyright &copy; ADMU Monitoring 2018</p>
  <!-- /.container -->
</footer>
@endsection('footer')
