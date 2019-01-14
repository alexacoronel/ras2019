@extends('layouts.home')

<!-- @section('title', '| Edit Role') -->

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">
    <ol class="breadcrumb breadcrumb-settings">
      <li class="breadcrumb-item">
        <a href="{{route('dashboard')}}">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{route('roles.index')}}">Roles</a>
        </li>
      <li class="breadcrumb-item active">Edit {{$role->name}}</li>
    </ol>
   <div class="row">
      <div class="col-lg-5 mt-3 mx-auto">
    {{-- @include ('errors.list')
 --}}
    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
        {{ csrf_field() }}
    <div class="form-group">
        {{ Form::label('name', 'Role Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Assign Permissions</b></h5>
    @foreach ($permissions as $permission)

        {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
        {{Form::label($permission->name, ucfirst($permission->name)) }}<br>

    @endforeach
    <br>
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
