@extends('layouts.home')

<!-- @section('title', '| Add Role') -->

@section('content')
<div class="container" style="padding-top: 30px; padding-bottom: 30px">

    <ol class="breadcrumb breadcrumb-settings">
      <li class="breadcrumb-item">
        <a href="{{route('dashboard')}}">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{route('roles.index')}}">Roles</a>
      </li>
      <li class="breadcrumb-item active">Add Role</li>
    </ol>

    {{-- @include ('errors.list') --}}

    {{ Form::open(array('url' => 'roles')) }}
        {{ csrf_field() }}
<div class="row">
   <div class="col-lg-5 mx-auto mt-3">
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}

        @if ($errors->has('name'))
            <span class="help-block">
              <div class="alert alert-danger">
                <strong>{{ $errors->first('name') }}</strong>
              </div>
            </span>
        @endif
    </div>

    <h5>Assign Permissions</h5>

    <div class='form-group'>
        @foreach ($permissions as $permission)
            {{ Form::checkbox('permissions[]',  $permission->id ) }}
            {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>

        @endforeach
    </div>

    {{ Form::submit('Add Role', array('class' => 'btn btn-primary')) }}

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
