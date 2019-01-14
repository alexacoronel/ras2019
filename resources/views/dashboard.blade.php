@extends('layouts.home')

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">

      <!-- <div class="alert alert-danger">
        <em> {/!/!$status!!} </em>
      </div> -->

      <div class="card mb-3">
        <div class="card-header"><span class="glyphicon glyphicon-user"></span>
          <h5>Profile</h5>
        </div>

        <div class="card-body">

            <!-- <div style="float:left; margin-right: 1em;"> <a><img src="http://via.placeholder.com/200"></a></div> -->
              <h1>{{Auth::user()->name}}</h1>
              <h4>{{ Auth::user()->getRoleNames()->implode(',')}}</h4>
              <h5>{{ Auth::user()->email}}</h5>
              <!-- <?php
                $timezone = date_default_timezone_get();
                // $date = date("Y-m-d H:i:s");
                $date = new DateTime();
                $date->setTimezone(new DateTimeZone('Asia/Manila'));

                $fdate = $date->format('Y-m-d H:i:s');
                echo "The current server timezone is: " . $timezone .  "</br>";
                echo "Today is " . $fdate;
              ?> -->
        </div>

      </div>

      <script type="text/javascript">
          $(document).ready(function(){
              $('#userTable').DataTable();
          });
      </script>
    @can('Administer roles & permissions')

    <div class="card card-login" style="margin-top:10px">
        <div class="card-header"><span class="glyphicon glyphicon-user"></span><h5>Users</h5></div>
        <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered table-striped" id="dataTable" cellspacing="0" width="100%">
                <thead>
                    <tr class="d-flex">
                        <th class="col-2">Name</th>
                        <th class="col-3">Email</th>
                        <th class="col-3">Date/Time Added</th>
                        <th class="col-2">User Roles</th>
                        <th class="col-2">Operation</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                    <tr class="d-flex">

                        <td class="col-sm-2">{{ $user->name }}</td>
                        <td class="col-sm-3">{{ $user->email }}</td>
                        <td class="col-sm-3">{{ $user->created_at->format('F d, Y h:ia') }}</td>
                        <td class="col-sm-2">{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                        <td class="col-sm-2">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left">Edit</a>

                        {!! Form::open([
                            'method' => 'DELETE',
                            'route' => ['users.destroy', $user->id],
                            'onsubmit' => "return confirm('Are you sure you want to delete this user?')"
                        ]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
          <a class="btn btn-success" href="{{route('users.index')}}"> View user settings </a>
        </div>
    <div class="card-footer small text-muted">Updated at {{$lastDateUser}}</div>
    </div>
    @endcan

    @if(Auth::user()->hasAnyPermission(['Add sensor', 'Delete sensor', 'Edit sensor']))
    <div class="card card-login" style="margin-top:10px; margin-bottom: 10px" >
      <div class="card-header"><span class="glyphicon glyphicon-user"></span><h5>Sensors</h5></div>
        <div class="card-body">
          <div class="table-responsive">
              <table class="table table-striped table-bordered" id="userTable" cellspacing="0" width="100%">
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
          <a href="{{ route('sensors.index') }}" class="btn btn-success">View all sensors</a>

        </div>
        <div class="card-footer small text-muted">Updated at {{$lastDateSensor}}</div>
    </div>

</div>
@endif

@stop

@section('footer')
<footer class="py-5 bg-dark" style="width: 100%">
    <p class="m-0 text-center text-white">Copyright &copy; ADMU Monitoring 2018</p>
  <!-- /.container -->
</footer>
@endsection('footer')
