@extends('layouts.home')

<!-- @section('title', '| Create Permission') -->

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">

  <ol class="breadcrumb breadcrumb-settings">
    <li class="breadcrumb-item">
      <a href="{{route('dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{route('permissions.index')}}">Permissions</a>
    </li>
    <li class="breadcrumb-item active">Add Permission</li>
  </ol>

    {{-- @include ('errors.list') --}}

    {{ Form::open(array('url' => 'permissions')) }}

    {{ csrf_field() }}
<div class="row">
   <div class="col-lg-5 mx-auto mt-3">
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}

        @if ($errors->has('name'))
            <span class="help-block">
              <div class="alert alert-danger">
                <strong>{{ $errors->first('name') }}</strong>
              </div>
            </span>
        @endif

    </div>
    <br>

    @if(!$roles->isEmpty())

        <h4>Assign Permission to Roles</h4>

        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach

    @endif

    <br>
    {{ Form::submit('Add Permission', array('class' => 'btn btn-primary')) }}

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
