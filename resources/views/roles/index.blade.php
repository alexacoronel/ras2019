@extends('layouts.home')

<!-- @section('title', '| Roles') -->

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
      <li class="breadcrumb-item active">Roles</li>
    </ol>

   <div class="btn-settings">
    <a href="{{ route('roles.create') }}" class="btn btn-success">Add Role</a>
      <!-- <div style=""> -->
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Users</a>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Permissions</a></h1>
      <!-- </div> -->
   </div>

    <div class="table-responsive" style="margin-top:0.5em">
        <table class="table table-bordered table-striped" id="dataTable">
            <thead>
                <tr class="d-flex">
                    <th class="col-5">Role</th>
                    <th class="col-5">Permissions</th>
                    <th class="col-2">Operation</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr class="d-flex">

                    <td class="col-sm-5">{{ $role->name }}</td>

                    <td class="col-sm-5">{{  $role->permissions()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td class="col-sm-2">
                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['roles.destroy', $role->id],
                        'onsubmit' => "return confirm('Are you sure you want to delete this role?')"
                    ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <!-- <a href="{{ URL::to('roles/create') }}" class="btn btn-success">Add Role</a> -->

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
