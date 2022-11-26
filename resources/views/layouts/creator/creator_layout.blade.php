<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <link rel="stylesheet" href="{{ url('assets/css/admin_css/bootstrap-float-label.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('assets/plugins/admin_plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!--Datatables-->
  <link rel="stylesheet" href="{{ url('assets/plugins/admin_plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ url('assets/plugins/admin_plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('assets/plugins/admin_plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/plugins/admin_plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('assets/plugins/admin_plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ url('assets/plugins/admin_plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('assets/css/admin_css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('assets/plugins/admin_plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('assets/plugins/admin_plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ url('assets/plugins/admin_plugins/summernote/summernote-bs4.min.css') }}">
  
  {{-- js files --}}
  <script src="{{asset('assets/js/admin_js/jquery/jquery-3.6.0.min.js')}}"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <p class="animation__shake" >
      preload
    </p>
  </div> --}}

  <!-- Navbar -->
  
  @include('layouts.creator.creator_header')
  <!-- /.navbar -->
  
  @include('layouts.creator.creator_sidebar')
  <!-- Main Sidebar Container -->
 
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>@yield('title')</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            @yield('breadcrumb-item')
            <li class="breadcrumb-item active">@yield('breadcrumb-active')</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->
</div>
</div>
  <!-- jQuery -->
  <script src="{{ url('assets/plugins/admin_plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ url('assets/plugins/admin_plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{url('assets/js/admin_js/custom.js')}}"></script>


<!-- Bootstrap 4 -->
<script src="{{url('assets/plugins/admin_plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{url('assets/plugins/admin_plugins/select2/js/select2.full.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('assets/plugins/admin_plugins/chart.js/Chart.min.js')}}"></script>
<!-- Datatables -->
<script src="{{ url('assets/plugins/admin_plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/plugins/admin_plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
  $(function () {
    $("#sections").DataTable();
    $("#categories").DataTable();
    $("#products").DataTable();
    $("#admins").DataTable();
    $("#creators").DataTable();
    $("#customers").DataTable();
    $("#orders").DataTable();
  });
</script>
<!-- Sparkline -->
<script src="{{url('assets/plugins/admin_plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{url('assets/plugins/admin_plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('assets/plugins/admin_plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('assets/plugins/admin_plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('assets/plugins/admin_plugins/moment/moment.min.js')}}"></script>
<script src="{{url('assets/plugins/admin_plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('assets/plugins/admin_plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{url('assets/plugins/admin_plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('assets/plugins/admin_plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('assets/js/admin_js/adminlte.js')}}"></script>

<script src="{{url('assets/js/admin_js/pages/dashboard.js')}}"></script>
@yield('scripts')
</body>
</html>


 


  
