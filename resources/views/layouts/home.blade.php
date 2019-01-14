<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ADMU Monitoring Systems </title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('css/2-col-portfolio.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{asset('/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <!-- <link href="{{asset('/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet"> -->

    <!-- Custom made CSS -->
    <link href="{{asset('/css/custom.css')}}" rel="stylesheet">


    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="{{asset('js/bootstrap.min.js')}}"></script> -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"}></script>

    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <!-- <script src="{{asset('js/sb-admin.min.js')}}"></script> -->
    <!-- Custom scripts for this page-->
    <script src="{{asset('js/sb-admin-datatables.min.js')}}"></script>

  </head>

  <body style="display:block" >

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">ADMU Monitoring Systems</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{route('home')}}">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item dropdown ">
              <a class="nav-link dropdown-toggle" id="projectsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Projects
                </a>
                <div class="dropdown-menu" aria-labelledby="accountDropdown">
                  <a class="dropdown-item small " href="{{route('dms.home')}}">
                    Dam Monitoring
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item small" href="{{route('wms.summary')}}">
                    Weather Monitoring
                  </a>
                </div>
              </li>
              @if (Auth::guest())
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
              </li>
              @else
              <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard')}}">
                  <i class="fa fa-fw fa-wrench"></i>
                  {{Auth::user()->name}}
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                  <i class="fa fa-fw fa-sign-out nav-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"></i>Logout</a>
              </li>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>

            </ul>
            @endif
        </div>
      </div>
    </nav>
   <!-- /Navigation -->

    <!-- Page Content -->
        @yield('content')
    <!-- /.container -->

    <!-- Footer -->
    @section('footer')

    @show

    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">Logout</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>

          </div>
        </div>
      </div>
    </div>


  </body>
</html>
