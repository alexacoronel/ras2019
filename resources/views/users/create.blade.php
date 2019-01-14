@extends('layouts.home')

<!-- @section('title', '| Add User') -->

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">
  <ol class="breadcrumb breadcrumb-settings">
    <li class="breadcrumb-item">
      <a href="{{route('dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{route('users.index')}}">Users</a>
      </li>
    <li class="breadcrumb-item active">Add User</li>
  </ol>
 <div class="row">
    <div class="col-lg-5 mt-3 mx-auto">
      {{-- @include ('errors.list') --}}

      {{ Form::open(array('url' => 'users')) }}

      {{ csrf_field() }}
      <div class="form-group">
          {{ Form::label('name', 'Name') }}
          {{ Form::text('name', '', array('class' => 'form-control')) }}
      </div>

      <div class="form-group">
          {{ Form::label('email', 'Email') }}
          {{ Form::email('email', '', array('class' => 'form-control')) }}

          @if ($errors->has('email'))
              <span class="help-block">
                <div class="alert alert-danger">
                  <strong>{{ $errors->first('email') }}</strong>
                </div>
              </span>
          @endif

      </div>

      <div class='form-group'>
          @foreach ($roles as $role)
              {{ Form::checkbox('roles[]',  $role->id ) }}
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

      {{ Form::submit('Add User', array('class' => 'btn btn-primary')) }}

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
