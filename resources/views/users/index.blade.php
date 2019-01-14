@extends('layouts.home')

<!-- @section('title', '| Users') -->

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
    <li class="breadcrumb-item active">Users</li>
  </ol>

 <div class="btn-settings">
  <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>
    <!-- <div style=""> -->
      <a href="{{ route('roles.index') }}" class="btn btn-secondary">Roles</a>
      <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Permissions</a></h1>
    <!-- </div> -->
</div>
  <div class="table-responsive">
        <table class="table table-bordered table-striped" id="dataTable" cellspacing="0" width="100%">

            <thead>
                <tr class="d-flex">
                    <th class="col-2">Name</th>
                    <th class="col-3">Email</th>
                    <th class="col-3">Date/Time Added</th>
                    <th class="col-2">User Roles</th>
                    <th class="col-2">Operations</th>
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
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info" style="">Edit</a>
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
