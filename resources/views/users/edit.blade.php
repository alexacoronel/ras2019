@extends('layouts.home')

<!-- @section('title', '| Edit User') -->

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">
  <ol class="breadcrumb breadcrumb-settings">
    <li class="breadcrumb-item">
      <a href="{{route('dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{route('users.index')}}">Users</a>
      </li>
    <li class="breadcrumb-item active">Edit {{$user->name}}</li>
  </ol>
 <div class="row">
    <div class="col-lg-5 mt-3 mx-auto">
    {{-- @include ('errors.list') --}}

    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }} {{-- Form model binding to automatically populate our fields with user data --}}

    {{ csrf_field() }}
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, array('class' => 'form-control')) }}

        @if ($errors->has('email'))
            <span class="help-block">
              <div class="alert alert-danger">
                <strong>{{ $errors->first('email') }}</strong>
              </div>
            </span>
        @endif

    </div>

    <h5><b>Give Role</b></h5>

    <div class='form-group'>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Password') }}<br>
        {{ Form::password('password', array('class' => 'form-control')) }}

        @if ($errors->has('password'))
            <span class="help-block">
              <div class="alert alert-danger">
                  <strong>{{ $errors->first('password') }}</strong>
              </div>
            </span>
        @endif

    </div>

    <div class="form-group">
        {{ Form::label('password', 'Confirm Password') }}<br>
        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

    </div>

    {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}

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
