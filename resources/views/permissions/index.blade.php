@extends('layouts.home')

<!-- @section('title', '| Permissions') -->

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
        <li class="breadcrumb-item active">Permissions</li>
      </ol>

      <div class="btn-settings">
            <a href="{{ URL::to('permissions/create') }}" class="btn btn-success">Add Permission</a>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Users</a>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Roles</a>
      </div>

            <table class="table table-bordered table-striped" id="dataTable" cellspacing="0" width="100%">

                <thead>
                    <tr class="d-flex">
                        <th class="col-10">Permissions</th>
                        <th class="col-2">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                    <tr class="d-flex">
                        <td class="col-sm-10">{{ $permission->name }}</td>
                        <td class="col-sm-2">
                        <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                        {!! Form::open([
                            'method' => 'DELETE',
                            'route' => ['permissions.destroy', $permission->id],
                            'onsubmit' => "return confirm('Are you sure you want to delete this permission?')"
                        ]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
