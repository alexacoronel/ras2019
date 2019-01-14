@extends('layouts.home')

<!-- @section('title', '| Edit Permission') -->

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">

    <ol class="breadcrumb breadcrumb-settings">
      <li class="breadcrumb-item">
        <a href="{{route('dashboard')}}">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{route('permissions.index')}}">Permissions</a>
        </li>
      <li class="breadcrumb-item active">Edit {{$permission->name}}</li>
    </ol>

    {{-- @include ('errors.list') --}}

    <div class="row">
       <div class="col-lg-5 mt-3 mx-auto">

    <!-- <h1><i class='fa fa-key'></i> Edit {{$permission->name}}</h1>
    <br> -->
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}
    {{ csrf_field() }}
    <div class="form-group">
        {{ Form::label('name', 'Permission Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    {{ Form::submit('Edit Permission', array('class' => 'btn btn-primary')) }}

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
