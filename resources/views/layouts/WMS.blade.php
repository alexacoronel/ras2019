<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>ADMU - Weather Monitoring System</title>
  <!-- Bootstrap core CSS-->
  <link href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{asset('/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="{{asset('/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{asset('/css/sb-admin.css')}}" rel="stylesheet">
  <!-- Custom made CSS  -->
  <link href="{{asset('/css/custom.css')}}" rel="stylesheet">

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"}></script>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{route('wms.summary')}}">Weather Monitoring System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Summary">
          <a class="nav-link" href="{{route('wms.summary')}}">
            <i class="fa fa-fw fa-calendar"></i>
            <span class="nav-link-text">Summary</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Charts</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="{{route('wms.chart')}}">
                <i class="fa fa-line-chart"></i> Line</a>
            </li>
            <li>
              <a href="{{route('wms.wind')}}">
                <i class="fa fa-dashboard"></i> Wind</a>
            </li>
            <li>
              <a href="{{route('wms.live')}}">
                <i class="fa fa-bar-chart"></i> Live</a>
            </li>
          </ul>
          <!-- <a class="nav-link" href="{{route('wms.chart')}}">
            <i class="fa fa-fw fa-line-chart"></i>
            <span class="nav-link-text">Chart</span>
          </a> -->
        </li>
        <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Live">
          <a class="nav-link" href="">
            <i class="fa fa-fw fa-line-chart"></i>
            <span class="nav-link-text">Live</span>
          </a> -->
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="{{route('wms.tables')}}">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Tables</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Map">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents1" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-map"></i>
            <span class="nav-link-text">Maps</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents1">
            <li>
              <a href="{{route('wms.waterLevelMap')}}">
                <i class="fa fa-fw fa-map"></i> Sensor Location</a>
            </li>
            <li>
              <a href="{{route('wms.rainfallMap')}}">
                <i class="fa fa-fw fa-map"></i> Rainfall Interpolation</a>
            </li>
          </ul>
      </ul>

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


  <div class="content-wrapper">
    <div class="container-fluid">
      @yield('content')
    </div>
  </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © ADMU Monitoring 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
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

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <!-- Page level plugin JavaScript-->
  <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin.min.js')}}"></script>
  <!-- Custom scripts for this page-->
  <script src="{{asset('js/sb-admin-datatables.min.js')}}"></script>
</body>

</html>
